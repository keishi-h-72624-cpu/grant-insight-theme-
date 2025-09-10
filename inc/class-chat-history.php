<?php
/**
 * チャット履歴管理クラス
 * 
 * @package WordPress_AI_Chatbot
 * @version 1.0.0
 * @author 中澤圭志
 */

if (!defined('ABSPATH')) {
    exit;
}

class Chat_History {
    
    private $session_key = 'ai_chat_history';
    private $max_history_length = 50;
    private $conversation_timeout = 3600; // 1時間
    
    /**
     * コンストラクタ
     */
    public function __construct() {
        // セッションの初期化
        if (!session_id()) {
            session_start();
        }
        
        // 古い会話履歴のクリーンアップ
        $this->cleanup_old_conversations();
    }
    
    /**
     * チャット履歴を取得
     */
    public function get_history($user_id = null) {
        $session_id = $this->get_session_id();
        $key = $this->session_key . '_' . $session_id;
        
        // ログインユーザーの場合はユーザーIDベースで取得
        if ($user_id) {
            $history = get_user_meta($user_id, 'ai_chat_history', true);
        } else {
            $history = isset($_SESSION[$key]) ? $_SESSION[$key] : [];
        }
        
        if (!is_array($history)) {
            $history = [];
        }
        
        // タイムスタンプでソート
        usort($history, function($a, $b) {
            return strtotime($a['timestamp']) - strtotime($b['timestamp']);
        });
        
        return $history;
    }
    
    /**
     * メッセージを追加
     */
    public function add_message($message, $type, $user_id = null) {
        if (empty($message)) {
            return false;
        }
        
        $session_id = $this->get_session_id();
        $key = $this->session_key . '_' . $session_id;
        
        $history = $this->get_history($user_id);
        
        // 新しいメッセージを追加
        $new_message = [
            'message' => sanitize_text_field($message),
            'type' => $type === 'user' ? 'user' : 'ai',
            'timestamp' => current_time('mysql'),
            'session_id' => $session_id
        ];
        
        $history[] = $new_message;
        
        // 履歴の長さを制限
        if (count($history) > $this->max_history_length) {
            $history = array_slice($history, -$this->max_history_length);
        }
        
        // 保存
        if ($user_id) {
            update_user_meta($user_id, 'ai_chat_history', $history);
        } else {
            $_SESSION[$key] = $history;
        }
        
        return true;
    }
    
    /**
     * チャット履歴をクリア
     */
    public function clear_history($user_id = null) {
        $session_id = $this->get_session_id();
        $key = $this->session_key . '_' . $session_id;
        
        if ($user_id) {
            delete_user_meta($user_id, 'ai_chat_history');
        } else {
            unset($_SESSION[$key]);
        }
        
        return true;
    }
    
    /**
     * 会話の統計情報を取得
     */
    public function get_stats($user_id = null) {
        $history = $this->get_history($user_id);
        
        $stats = [
            'total_messages' => count($history),
            'user_messages' => 0,
            'ai_messages' => 0,
            'first_message_date' => null,
            'last_message_date' => null,
            'conversation_duration' => null
        ];
        
        if (empty($history)) {
            return $stats;
        }
        
        foreach ($history as $message) {
            if ($message['type'] === 'user') {
                $stats['user_messages']++;
            } else {
                $stats['ai_messages']++;
            }
        }
        
        // 最初と最後のメッセージ日時
        $first_message = reset($history);
        $last_message = end($history);
        
        $stats['first_message_date'] = $first_message['timestamp'];
        $stats['last_message_date'] = $last_message['timestamp'];
        
        // 会話期間（分）
        $first_time = strtotime($first_message['timestamp']);
        $last_time = strtotime($last_message['timestamp']);
        $stats['conversation_duration'] = round(($last_time - $first_time) / 60, 1);
        
        return $stats;
    }
    
    /**
     * 会話の要約を生成
     */
    public function get_conversation_summary($user_id = null) {
        $history = $this->get_history($user_id);
        
        if (empty($history)) {
            return '';
        }
        
        // Gemini AIを使用して要約を生成
        $gemini = new Gemini_AI();
        return $gemini->summarize_conversation($history);
    }
    
    /**
     * エクスポート用のデータを取得
     */
    public function export_history($user_id = null, $format = 'json') {
        $history = $this->get_history($user_id);
        $stats = $this->get_stats($user_id);
        
        $export_data = [
            'export_info' => [
                'exported_at' => current_time('mysql'),
                'format' => $format,
                'user_id' => $user_id,
                'session_id' => $this->get_session_id()
            ],
            'stats' => $stats,
            'messages' => $history
        ];
        
        switch ($format) {
            case 'json':
                return json_encode($export_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                
            case 'csv':
                return $this->convert_to_csv($export_data);
                
            case 'txt':
                return $this->convert_to_txt($export_data);
                
            default:
                return json_encode($export_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
    }
    
    /**
     * CSV形式に変換
     */
    private function convert_to_csv($data) {
        $csv = "日時,種類,メッセージ\n";
        
        foreach ($data['messages'] as $message) {
            $type = ($message['type'] === 'user') ? 'ユーザー' : 'AI';
            $message_text = str_replace('"', '""', $message['message']); // CSVエスケープ
            $csv .= "{$message['timestamp']},{$type},\"{$message_text}\"\n";
        }
        
        return $csv;
    }
    
    /**
     * テキスト形式に変換
     */
    private function convert_to_txt($data) {
        $txt = "=== AIチャット履歴エクスポート ===\n";
        $txt .= "エクスポート日時: {$data['export_info']['exported_at']}\n";
        $txt .= "会話統計:\n";
        $txt .= "- 総メッセージ数: {$data['stats']['total_messages']}\n";
        $txt .= "- ユーザーからのメッセージ: {$data['stats']['user_messages']}\n";
        $txt .= "- AIからのメッセージ: {$data['stats']['ai_messages']}\n";
        $txt .= "- 会話期間: {$data['stats']['conversation_duration']} 分\n";
        $txt .= "\n=== メッセージ履歴 ===\n\n";
        
        foreach ($data['messages'] as $message) {
            $role = ($message['type'] === 'user') ? '👤 ユーザー' : '🤖 AI';
            $txt .= "[{$message['timestamp']}] {$role}:\n{$message['message']}\n\n";
        }
        
        return $txt;
    }
    
    /**
     * セッションIDを取得
     */
    private function get_session_id() {
        if (!isset($_SESSION['ai_chat_session_id'])) {
            $_SESSION['ai_chat_session_id'] = uniqid('chat_', true);
        }
        return $_SESSION['ai_chat_session_id'];
    }
    
    /**
     * 古い会話履歴をクリーンアップ
     */
    private function cleanup_old_conversations() {
        // セッションデータのクリーンアップ
        $now = time();
        foreach ($_SESSION as $key => $value) {
            if (strpos($key, $this->session_key) === 0) {
                // タイムアウトチェック（簡易的な実装）
                if (isset($value['last_activity']) && ($now - $value['last_activity']) > $this->conversation_timeout) {
                    unset($_SESSION[$key]);
                }
            }
        }
        
        // 古いユーザーメタデータのクリーンアップ（オプション）
        // これは定期的なメンテナンスで実行されることを推奨
    }
    
    /**
     * プライバシーに基づいてデータを削除
     */
    public function delete_user_data($user_id) {
        delete_user_meta($user_id, 'ai_chat_history');
        
        // GDPR対応：削除ログを記録
        error_log("User {$user_id} chat data deleted for privacy compliance");
        
        return true;
    }
    
    /**
     * チャット履歴が存在するかチェック
     */
    public function has_history($user_id = null) {
        $history = $this->get_history($user_id);
        return !empty($history);
    }
    
    /**
     * 最新のメッセージを取得
     */
    public function get_latest_message($user_id = null, $type = null) {
        $history = $this->get_history($user_id);
        
        if (empty($history)) {
            return null;
        }
        
        if ($type === null) {
            return end($history);
        }
        
        // 指定されたタイプの最新メッセージを取得
        for ($i = count($history) - 1; $i >= 0; $i--) {
            if ($history[$i]['type'] === $type) {
                return $history[$i];
            }
        }
        
        return null;
    }
}