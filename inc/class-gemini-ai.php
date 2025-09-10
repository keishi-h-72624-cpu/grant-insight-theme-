<?php
/**
 * Gemini AI API統合クラス
 * 
 * @package WordPress_AI_Chatbot
 * @version 1.0.0
 * @author 中澤圭志
 */

if (!defined('ABSPATH')) {
    exit;
}

class Gemini_AI {
    
    private $api_key;
    private $model;
    private $api_base_url = 'https://generativelanguage.googleapis.com/v1beta/models/';
    private $max_tokens = 2048;
    private $temperature = 0.7;
    private $timeout = 30;
    
    /**
     * コンストラクタ
     */
    public function __construct($api_key = null, $model = 'gemini-pro') {
        $this->api_key = $api_key ?: get_option('gemini_api_key', '');
        $this->model = $model ?: get_option('gemini_model', 'gemini-pro');
        
        if (empty($this->api_key)) {
            throw new Exception('Gemini APIキーが設定されていません。');
        }
    }
    
    /**
     * メッセージを生成
     */
    public function generate_response($message, $conversation_history = []) {
        try {
            // メッセージの検証
            if (empty($message)) {
                throw new Exception('メッセージが空です。');
            }
            
            // 会話履歴を含めたコンテンツ構造を構築
            $contents = $this->build_conversation_contents($message, $conversation_history);
            
            // APIリクエストデータ
            $data = [
                'contents' => $contents,
                'generationConfig' => [
                    'temperature' => $this->temperature,
                    'topK' => 40,
                    'topP' => 0.95,
                    'maxOutputTokens' => $this->max_tokens,
                    'stopSequences' => []
                ],
                'safetySettings' => [
                    [
                        'category' => 'HARM_CATEGORY_HARASSMENT',
                        'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'
                    ],
                    [
                        'category' => 'HARM_CATEGORY_HATE_SPEECH',
                        'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'
                    ],
                    [
                        'category' => 'HARM_CATEGORY_SEXUALLY_EXPLICIT',
                        'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'
                    ],
                    [
                        'category' => 'HARM_CATEGORY_DANGEROUS_CONTENT',
                        'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'
                    ]
                ]
            ];
            
            // API呼び出し
            $response = $this->make_api_request($data);
            
            if (is_wp_error($response)) {
                throw new Exception('APIリクエストエラー: ' . $response->get_error_message());
            }
            
            $body = wp_remote_retrieve_body($response);
            $result = json_decode($body, true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('JSONデコードエラー: ' . json_last_error_msg());
            }
            
            // エラーチェック
            if (isset($result['error'])) {
                throw new Exception('Gemini APIエラー: ' . $result['error']['message']);
            }
            
            // レスポンスの抽出
            return $this->extract_response_text($result);
            
        } catch (Exception $e) {
            error_log('Gemini AI Error: ' . $e->getMessage());
            return $this->get_fallback_response();
        }
    }
    
    /**
     * 会話履歴を含めたコンテンツ構造を構築
     */
    private function build_conversation_contents($current_message, $conversation_history) {
        $contents = [];
        
        // システムプロンプトを追加
        $system_prompt = $this->get_system_prompt();
        if (!empty($system_prompt)) {
            $contents[] = [
                'role' => 'user',
                'parts' => [
                    ['text' => $system_prompt]
                ]
            ];
            $contents[] = [
                'role' => 'model',
                'parts' => [
                    ['text' => '了解しました。指示に従って対応させていただきます。']
                ]
            ];
        }
        
        // 会話履歴を追加（最大10件まで）
        $recent_history = array_slice($conversation_history, -10);
        foreach ($recent_history as $chat) {
            $role = ($chat['type'] === 'user') ? 'user' : 'model';
            $contents[] = [
                'role' => $role,
                'parts' => [
                    ['text' => $chat['message']]
                ]
            ];
        }
        
        // 現在のメッセージを追加
        $contents[] = [
            'role' => 'user',
            'parts' => [
                ['text' => $current_message]
            ]
        ];
        
        return $contents;
    }
    
    /**
     * システムプロンプトを取得
     */
    private function get_system_prompt() {
        return "あなたは親切で知識豊富なAIアシスタントです。日本語で明確に回答し、以下のガイドラインに従ってください：

1. 丁寧で親切な口調を保ちます
2. 複雑な質問でも分かりやすく説明します
3. 具体的な例を使って説明します
4. 必要に応じてステップバイステップのガイドを提供します
5. ビジネス、技術、創作活動など幅広い分野に対応します
6. 自信がない場合は正直に伝えます
7. 日本語で回答します（特に指定がない場合）
8. コード例を含める場合は適切にフォーマットします

ユーザーが質問に対して満足できる回答を提供してください。";
    }
    
    /**
     * APIリクエストを実行
     */
    private function make_api_request($data) {
        $url = $this->api_base_url . $this->model . ':generateContent?key=' . $this->api_key;
        
        $args = [
            'headers' => [
                'Content-Type' => 'application/json',
                'User-Agent' => 'WordPress AI Chatbot/1.0'
            ],
            'body' => json_encode($data),
            'timeout' => $this->timeout,
            'sslverify' => true
        ];
        
        return wp_remote_post($url, $args);
    }
    
    /**
     * レスポンステキストを抽出
     */
    private function extract_response_text($result) {
        if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
            return trim($result['candidates'][0]['content']['parts'][0]['text']);
        }
        
        if (isset($result['candidates'][0]['content']['parts'])) {
            $text_parts = [];
            foreach ($result['candidates'][0]['content']['parts'] as $part) {
                if (isset($part['text'])) {
                    $text_parts[] = $part['text'];
                }
            }
            return trim(implode('', $text_parts));
        }
        
        throw new Exception('有効な応答が見つかりませんでした。');
    }
    
    /**
     * フォールバック応答を取得
     */
    private function get_fallback_response() {
        $fallbacks = [
            '申し訳ございません。現在AI応答を生成できません。しばらく時間をおいて再度お試しください。',
            '現在サービスが混雑しているようです。もう一度お試しいただけますでしょうか。',
            '技術的な問題が発生しました。サポートチームにご連絡いただければ幸いです。'
        ];
        
        return $fallbacks[array_rand($fallbacks)];
    }
    
    /**
     * 会話の要約を生成
     */
    public function summarize_conversation($conversation_history) {
        if (empty($conversation_history)) {
            return '';
        }
        
        $conversation_text = '';
        foreach ($conversation_history as $chat) {
            $role = ($chat['type'] === 'user') ? 'ユーザー' : 'AI';
            $conversation_text .= "{$role}: {$chat['message']}\n";
        }
        
        $summary_prompt = "以下の会話を3行以内で要約してください：\n\n{$conversation_text}";
        
        try {
            $contents = [
                [
                    'role' => 'user',
                    'parts' => [
                        ['text' => $summary_prompt]
                    ]
                ]
            ];
            
            $data = [
                'contents' => $contents,
                'generationConfig' => [
                    'temperature' => 0.3,
                    'maxOutputTokens' => 200
                ]
            ];
            
            $response = $this->make_api_request($data);
            
            if (!is_wp_error($response)) {
                $body = wp_remote_retrieve_body($response);
                $result = json_decode($body, true);
                return $this->extract_response_text($result);
            }
        } catch (Exception $e) {
            error_log('Conversation summary error: ' . $e->getMessage());
        }
        
        return '';
    }
    
    /**
     * モデル情報を取得
     */
    public function get_model_info() {
        return [
            'model' => $this->model,
            'api_base_url' => $this->api_base_url,
            'max_tokens' => $this->max_tokens,
            'temperature' => $this->temperature
        ];
    }
    
    /**
     * APIキーの検証
     */
    public static function validate_api_key($api_key, $model = 'gemini-pro') {
        if (empty($api_key)) {
            return new WP_Error('empty_key', 'APIキーが空です。');
        }
        
        $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$api_key}";
        $data = [
            'contents' => [
                [
                    'role' => 'user',
                    'parts' => [
                        ['text' => 'こんにちは']
                    ]
                ]
            ],
            'generationConfig' => [
                'temperature' => 0.1,
                'maxOutputTokens' => 10
            ]
        ];
        
        $args = [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($data),
            'timeout' => 10
        ];
        
        $response = wp_remote_post($url, $args);
        
        if (is_wp_error($response)) {
            return $response;
        }
        
        $response_code = wp_remote_retrieve_response_code($response);
        if ($response_code !== 200) {
            $body = wp_remote_retrieve_body($response);
            $error_data = json_decode($body, true);
            $error_message = isset($error_data['error']['message']) ? $error_data['error']['message'] : 'APIキーが無効です。';
            return new WP_Error('invalid_key', $error_message);
        }
        
        return true;
    }
}