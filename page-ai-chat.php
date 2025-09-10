<?php
/**
 * Template Name: AIチャットボット
 * Description: Gemini API統合AIチャットボットページ
 * Version: 1.0
 * Author: 中澤圭志
 */

get_header();

// 必要なクラスを読み込み
if (!class_exists('Gemini_AI')) {
    require_once get_template_directory() . '/inc/class-gemini-ai.php';
}
if (!class_exists('Chat_History')) {
    require_once get_template_directory() . '/inc/class-chat-history.php';
}

// Gemini API設定
$gemini_api_key = get_option('gemini_api_key', '');
$gemini_model = get_option('gemini_model', 'gemini-pro');

// チャット履歴管理
$chat_history = new Chat_History();
$user_id = get_current_user_id();
$conversation_history = $chat_history->get_history($user_id);

// 設定検証
$is_configured = !empty($gemini_api_key);
$validation_message = '';

if ($is_configured) {
    $validation_result = Gemini_AI::validate_api_key($gemini_api_key, $gemini_model);
    $is_valid = !is_wp_error($validation_result);
    $validation_message = $is_valid ? 'AIサービスは正常に動作しています。' : 'APIキーに問題があります。';
} else {
    $is_valid = false;
    $validation_message = 'Gemini APIキーが設定されていません。';
}

?}>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AIチャットボット - WordPress PHP テンプレート</title>
    
    <!-- Tailwind CSS Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#3B82F6',
                        'secondary': '#8B5CF6',
                        'accent': '#06B6D4',
                        'success': '#10B981',
                        'warning': '#F59E0B',
                        'error': '#EF4444'
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.3s ease-out',
                        'slide-down': 'slideDown 0.3s ease-out',
                        'bounce-gentle': 'bounceGentle 0.6s ease-in-out',
                        'pulse-slow': 'pulse 2s infinite',
                        'typing': 'typing 1.5s infinite',
                        'message-in': 'messageIn 0.4s ease-out',
                        'float': 'float 3s ease-in-out infinite'
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(10px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        slideDown: {
                            '0%': { opacity: '0', transform: 'translateY(-20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        bounceGentle: {
                            '0%, 20%, 50%, 80%, 100%': { transform: 'translateY(0)' },
                            '40%': { transform: 'translateY(-5px)' },
                            '60%': { transform: 'translateY(-3px)' }
                        },
                        typing: {
                            '0%, 60%': { opacity: '1' },
                            '30%': { opacity: '0.5' }
                        },
                        messageIn: {
                            '0%': { opacity: '0', transform: 'translateX(-20px) scale(0.95)' },
                            '100%': { opacity: '1', transform: 'translateX(0) scale(1)' }
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' }
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css">
    
    <style>
        /* カスタムスクロールバー */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        
        /* タイピングアニメーション用ドット */
        .typing-dots::after {
            content: '...';
            animation: typing 1.5s infinite;
        }
        
        /* グラデーションアニメーション */
        .gradient-animation {
            background: linear-gradient(-45deg, #3B82F6, #8B5CF6, #06B6D4, #10B981);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* メッセージバブルの影効果 */
        .message-shadow {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        /* PDF出力最適化 */
        @media print {
            body { -webkit-print-color-adjust: exact; }
            .no-print { display: none !important; }
            .chat-container { height: auto !important; max-height: none !important; }
        }
        
        /* エラー状態 */
        .error-state {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            border: 2px solid #ef4444;
        }
        
        /* ローディングアニメーション */
        .loading-spinner {
            border: 3px solid #f3f4f6;
            border-top: 3px solid #3B82F6;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 min-h-screen">

<!-- メインコンテナ -->
<div class="container mx-auto px-4 py-8 max-w-6xl">
    
    <!-- ページヘッダー -->
    <header class="text-center mb-8 animate-fade-in">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-primary to-secondary rounded-full mb-4 animate-float">
            <i class="fas fa-robot text-2xl text-white"></i>
        </div>
        <h1 class="text-4xl md:text-5xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-primary via-secondary to-accent mb-4">
            AI チャットボット
        </h1>
        <p class="text-lg text-slate-600 max-w-2xl mx-auto">
            Gemini AIを活用した高性能チャットボット。ビジネスの課題解決から日常の質問まで、なんでもお気軽にご相談ください。
        </p>
    </header>

    <!-- ステータスバー -->
    <div class="mb-6 p-4 rounded-2xl <?php echo $is_valid ? 'bg-green-100 border border-green-300' : ($is_configured ? 'bg-yellow-100 border border-yellow-300' : 'bg-red-100 border border-red-300'); ?>">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-3 h-3 rounded-full <?php echo $is_valid ? 'bg-green-500' : ($is_configured ? 'bg-yellow-500' : 'bg-red-500'); ?> animate-pulse"></div>
                <span class="text-sm font-medium <?php echo $is_valid ? 'text-green-800' : ($is_configured ? 'text-yellow-800' : 'text-red-800'); ?>">
                    <?php echo $validation_message; ?>
                </span>
            </div>
            <div class="text-xs text-gray-600">
                Model: <?php echo esc_html($gemini_model); ?>
            </div>
        </div>
    </div>

    <!-- チャットコンテナ -->
    <div id="chatContainer" class="bg-white rounded-3xl shadow-2xl overflow-hidden animate-slide-up <?php echo !$is_valid ? 'opacity-50 pointer-events-none' : ''; ?>">
        
        <!-- チャットヘッダー -->
        <div class="gradient-animation p-6 text-white">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-brain text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold">Gemini AI アシスタント</h2>
                        <p class="text-sm opacity-90">オンライン • 24時間対応</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                    <span class="text-sm">アクティブ</span>
                </div>
            </div>
        </div>

        <!-- チャット履歴エリア -->
        <div id="chatHistory" class="h-96 overflow-y-auto p-6 space-y-4 bg-gradient-to-b from-slate-50 to-white custom-scrollbar">
            
            <!-- ウェルカムメッセージ -->
            <div class="flex items-start space-x-3 animate-message-in">
                <div class="w-10 h-10 bg-gradient-to-br from-primary to-secondary rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-robot text-white text-sm"></i>
                </div>
                <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white p-4 rounded-2xl rounded-tl-lg max-w-md message-shadow">
                    <p class="text-sm mb-2">👋 こんにちは！</p>
                    <p>私はGemini AIアシスタントです。ビジネスに関するご質問、技術的なサポート、創作活動のお手伝いなど、何でもお気軽にお聞かせください。</p>
                </div>
            </div>

            <!-- 既存のチャット履歴を表示 -->
            <?php if (!empty($conversation_history)): ?>
                <?php foreach ($conversation_history as $chat): ?>
                    <?php if ($chat['type'] === 'user'): ?>
                        <div class="flex items-start justify-end space-x-3 animate-message-in">
                            <div class="bg-gradient-to-r from-accent to-primary text-white p-4 rounded-2xl rounded-tr-lg max-w-md message-shadow">
                                <p><?php echo esc_html($chat['message']); ?></p>
                            </div>
                            <div class="w-10 h-10 bg-gradient-to-br from-accent to-primary rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="flex items-start space-x-3 animate-message-in">
                            <div class="w-10 h-10 bg-gradient-to-br from-primary to-secondary rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-robot text-white text-sm"></i>
                            </div>
                            <div class="bg-gradient-to-r from-slate-100 to-slate-200 text-slate-800 p-4 rounded-2xl rounded-tl-lg max-w-md message-shadow">
                                <p><?php echo wp_kses_post($chat['message']); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>

        <!-- タイピングインジケーター -->
        <div id="typingIndicator" class="px-6 pb-4 hidden">
            <div class="flex items-start space-x-3">
                <div class="w-10 h-10 bg-gradient-to-br from-primary to-secondary rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-robot text-white text-sm animate-pulse"></i>
                </div>
                <div class="bg-gradient-to-r from-slate-100 to-slate-200 text-slate-800 p-4 rounded-2xl rounded-tl-lg message-shadow">
                    <div class="flex items-center space-x-2">
                        <div class="flex space-x-1">
                            <div class="w-2 h-2 bg-slate-400 rounded-full animate-bounce"></div>
                            <div class="w-2 h-2 bg-slate-400 rounded-full animate-bounce" style="animation-delay: 0.1s;"></div>
                            <div class="w-2 h-2 bg-slate-400 rounded-full animate-bounce" style="animation-delay: 0.2s;"></div>
                        </div>
                        <span class="text-sm text-slate-600">AIが入力中...</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- メッセージ入力エリア -->
        <div class="p-6 bg-gradient-to-r from-slate-50 to-blue-50 border-t border-slate-200">
            <form id="chatForm" class="flex space-x-4">
                <?php wp_nonce_field('ai_chat_action', 'chat_nonce'); ?>
                
                <div class="flex-1 relative">
                    <textarea 
                        id="messageInput" 
                        name="user_message"
                        rows="1"
                        placeholder="メッセージを入力してください..." 
                        class="w-full p-4 pr-12 border border-slate-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent resize-none transition-all duration-300 bg-white/80 backdrop-blur-sm"
                        maxlength="1000"
                        <?php echo !$is_valid ? 'disabled' : ''; ?>
                    ></textarea>
                    
                    <!-- 文字数カウンター -->
                    <div class="absolute bottom-2 right-12 text-xs text-slate-400">
                        <span id="charCount">0</span>/1000
                    </div>
                    
                    <!-- 音声入力ボタン -->
                    <button type="button" id="voiceBtn" class="absolute right-3 top-1/2 transform -translate-y-1/2 p-2 text-slate-400 hover:text-primary transition-colors duration-200 <?php echo !$is_valid ? 'hidden' : ''; ?>">
                        <i class="fas fa-microphone"></i>
                    </button>
                </div>
                
                <button 
                    type="submit" 
                    id="sendBtn"
                    class="px-8 py-4 bg-gradient-to-r from-primary to-secondary text-white rounded-2xl hover:from-primary/90 hover:to-secondary/90 focus:outline-none focus:ring-2 focus:ring-primary/50 transition-all duration-300 transform hover:scale-105 flex items-center space-x-2 shadow-lg <?php echo !$is_valid ? 'opacity-50 cursor-not-allowed' : ''; ?>"
                    <?php echo !$is_valid ? 'disabled' : ''; ?>
                >
                    <i class="fas fa-paper-plane"></i>
                    <span class="hidden sm:inline">送信</span>
                </button>
            </form>
            
            <!-- クイックアクションボタン -->
            <div class="mt-4 flex flex-wrap gap-2">
                <button type="button" class="quick-action px-4 py-2 bg-white/80 backdrop-blur-sm text-slate-600 rounded-full border border-slate-200 hover:bg-primary hover:text-white transition-all duration-200 text-sm <?php echo !$is_valid ? 'opacity-50 cursor-not-allowed' : ''; ?003e" <?php echo !$is_valid ? 'disabled' : ''; ?>
                    data-prompt="ビジネスのアイデアをいくつか提案してください。"
                >
                    <i class="fas fa-lightbulb mr-2"></i>アイデア提案
                </button>
                <button type="button" class="quick-action px-4 py-2 bg-white/80 backdrop-blur-sm text-slate-600 rounded-full border border-slate-200 hover:bg-secondary hover:text-white transition-all duration-200 text-sm <?php echo !$is_valid ? 'opacity-50 cursor-not-allowed' : ''; ?003e" <?php echo !$is_valid ? 'disabled' : ''; ?>
                    data-prompt="ビジネス分析の方法を教えてください。"
                >
                    <i class="fas fa-chart-line mr-2"></i>ビジネス分析
                </button>
                <button type="button" class="quick-action px-4 py-2 bg-white/80 backdrop-blur-sm text-slate-600 rounded-full border border-slate-200 hover:bg-accent hover:text-white transition-all duration-200 text-sm <?php echo !$is_valid ? 'opacity-50 cursor-not-allowed' : ''; ?>" <?php echo !$is_valid ? 'disabled' : ''; ?>
                    data-prompt="技術的な問題の解決方法を教えてください。"
                >
                    <i class="fas fa-code mr-2"></i>技術サポート
                </button>
                <button type="button" class="quick-action px-4 py-2 bg-white/80 backdrop-blur-sm text-slate-600 rounded-full border border-slate-200 hover:bg-success hover:text-white transition-all duration-200 text-sm <?php echo !$is_valid ? 'opacity-50 cursor-not-allowed' : ''; ?>" <?php echo !$is_valid ? 'disabled' : ''; ?>
                    data-prompt="よくある質問について答えてください。"
                >
                    <i class="fas fa-question-circle mr-2"></i>FAQ
                </button>
            </div>
            
            <!-- 履歴クリアボタン -->
            <div class="mt-4 text-center">
                <button type="button" id="clearHistoryBtn" class="text-sm text-slate-500 hover:text-red-600 transition-colors duration-200 <?php echo !$is_valid ? 'hidden' : ''; ?>">
                    <i class="fas fa-trash-alt mr-1"></i>会話履歴をクリア
                </button>
            </div>
        </div>
    </div>

    <!-- 設定エラー表示 -->
    <?php if (!$is_valid): ?>
    <div class="mt-6 p-6 bg-red-100 border border-red-300 rounded-2xl">
        <div class="flex items-center space-x-3">
            <i class="fas fa-exclamation-triangle text-red-500 text-xl"></i>
            <div>
                <h3 class="text-red-800 font-semibold">AIチャットボットの設定が必要です</h3>
                <p class="text-red-700 text-sm mt-1">
                    この機能を使用するには、Gemini APIキーの設定が必要です。WordPress管理画面の設定メニューからAPIキーを設定してください。
                </p>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- 機能説明セクション -->
    <div class="mt-12 grid md:grid-cols-3 gap-8">
        
        <div class="text-center animate-fade-in" style="animation-delay: 0.1s;">
            <div class="w-16 h-16 bg-gradient-to-br from-primary to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 transform hover:scale-110 transition-transform duration-300">
                <i class="fas fa-brain text-2xl text-white"></i>
            </div>
            <h3 class="text-xl font-semibold text-slate-800 mb-3">高度なAI理解力</h3>
            <p class="text-slate-600">Gemini AIの最新技術により、複雑な質問も正確に理解し、的確な回答を提供します。</p>
        </div>
        
        <div class="text-center animate-fade-in" style="animation-delay: 0.2s;">
            <div class="w-16 h-16 bg-gradient-to-br from-secondary to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4 transform hover:scale-110 transition-transform duration-300">
                <i class="fas fa-clock text-2xl text-white"></i>
            </div>
            <h3 class="text-xl font-semibold text-slate-800 mb-3">24時間対応</h3>
            <p class="text-slate-600">いつでもお気軽にご相談いただけます。迅速で正確な回答をお約束します。</p>
        </div>
        
        <div class="text-center animate-fade-in" style="animation-delay: 0.3s;">
            <div class="w-16 h-16 bg-gradient-to-br from-accent to-cyan-600 rounded-2xl flex items-center justify-center mx-auto mb-4 transform hover:scale-110 transition-transform duration-300">
                <i class="fas fa-shield-alt text-2xl text-white"></i>
            </div>
            <h3 class="text-xl font-semibold text-slate-800 mb-3">セキュア</h3>
            <p class="text-slate-600">すべての会話は暗号化され、プライバシーを最優先に保護されています。</p>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const messageInput = document.getElementById('messageInput');
    const sendBtn = document.getElementById('sendBtn');
    const chatForm = document.getElementById('chatForm');
    const chatHistory = document.getElementById('chatHistory');
    const typingIndicator = document.getElementById('typingIndicator');
    const charCount = document.getElementById('charCount');
    const quickActions = document.querySelectorAll('.quick-action');
    const voiceBtn = document.getElementById('voiceBtn');
    const clearHistoryBtn = document.getElementById('clearHistoryBtn');
    const chatContainer = document.getElementById('chatContainer');
    
    let isProcessing = false;
    
    // 設定検証
    function validateSettings() {
        const formData = new FormData();
        formData.append('action', 'ai_chat_validate_settings');
        formData.append('nonce', document.querySelector('input[name="chat_nonce"]')?.value || '');
        
        fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('AI Chat Settings:', data.data);
            }
        })
        .catch(error => {
            console.error('Settings validation error:', error);
        });
    }
    
    // 初期化時に設定を検証
    validateSettings();
    
    // 文字数カウンター
    messageInput.addEventListener('input', function() {
        charCount.textContent = this.value.length;
        
        // 自動高さ調整
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 120) + 'px';
    });
    
    // Enterキーで送信（Shift+Enterで改行）
    messageInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            if (!isProcessing && this.value.trim()) {
                chatForm.dispatchEvent(new Event('submit'));
            }
        }
    });
    
    // フォーム送信処理
    chatForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        if (isProcessing) return;
        
        const message = messageInput.value.trim();
        if (!message) return;
        
        // UI状態を更新
        isProcessing = true;
        messageInput.disabled = true;
        sendBtn.disabled = true;
        
        // ユーザーメッセージを追加
        addMessage(message, 'user');
        messageInput.value = '';
        charCount.textContent = '0';
        messageInput.style.height = 'auto';
        
        // 送信ボタンを無効化
        sendBtn.innerHTML = '<i class="fas fa-spinner animate-spin"></i><span class="hidden sm:inline ml-2">送信中...</span>';
        
        // タイピングインジケーターを表示
        showTypingIndicator();
        
        try {
            // PHP/WordPress AJAX処理
            const formData = new FormData();
            formData.append('action', 'ai_chat_send_message');
            formData.append('message', message);
            formData.append('nonce', document.querySelector('input[name="chat_nonce"]')?.value || '');
            
            const response = await fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            
            // タイピングインジケーターを非表示
            hideTypingIndicator();
            
            if (data.success) {
                // AI応答を追加
                addMessage(data.data.response, 'ai');
                
                // 統計情報を更新（オプション）
                if (data.data.stats) {
                    console.log('Chat stats:', data.data.stats);
                }
            } else {
                // エラーメッセージを表示
                addMessage('申し訳ございません。エラーが発生しました: ' + (data.data || '不明なエラー'), 'ai', true);
            }
        } catch (error) {
            console.error('Chat error:', error);
            hideTypingIndicator();
            addMessage('接続エラーが発生しました。インターネット接続をご確認の上、再度お試しください。', 'ai', true);
        } finally {
            // UI状態を復元
            isProcessing = false;
            messageInput.disabled = false;
            sendBtn.disabled = false;
            sendBtn.innerHTML = '<i class="fas fa-paper-plane"></i><span class="hidden sm:inline ml-2">送信</span>';
        }
    });
    
    // メッセージ追加関数
    function addMessage(text, type, isError = false) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `flex items-start space-x-3 animate-message-in ${type === 'user' ? 'justify-end' : ''}`;
        
        const iconBg = type === 'user' 
            ? 'bg-gradient-to-br from-accent to-primary' 
            : (isError ? 'bg-gradient-to-br from-error to-red-600' : 'bg-gradient-to-br from-primary to-secondary');
        
        const messageBg = type === 'user' 
            ? 'bg-gradient-to-r from-accent to-primary text-white' 
            : (isError ? 'bg-gradient-to-r from-red-100 to-red-200 text-red-800' : 'bg-gradient-to-r from-slate-100 to-slate-200 text-slate-800');
        
        const roundedClass = type === 'user' ? 'rounded-tr-lg' : 'rounded-tl-lg';
        const icon = type === 'user' ? 'fa-user' : (isError ? 'fa-exclamation-triangle' : 'fa-robot');
        
        if (type === 'user') {
            messageDiv.innerHTML = `
                <div class="${messageBg} p-4 rounded-2xl ${roundedClass} max-w-md message-shadow">
                    <p>${escapeHtml(text)}</p>
                </div>
                <div class="w-10 h-10 ${iconBg} rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas ${icon} text-white text-sm"></i>
                </div>
            `;
        } else {
            messageDiv.innerHTML = `
                <div class="w-10 h-10 ${iconBg} rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas ${icon} text-white text-sm"></i>
                </div>
                <div class="${messageBg} p-4 rounded-2xl ${roundedClass} max-w-md message-shadow">
                    <p>${text}</p>
                </div>
            `;
        }
        
        chatHistory.appendChild(messageDiv);
        chatHistory.scrollTop = chatHistory.scrollHeight;
    }
    
    // タイピングインジケーター制御
    function showTypingIndicator() {
        typingIndicator.classList.remove('hidden');
        chatHistory.scrollTop = chatHistory.scrollHeight;
    }
    
    function hideTypingIndicator() {
        typingIndicator.classList.add('hidden');
    }
    
    // クイックアクション
    quickActions.forEach(btn => {
        btn.addEventListener('click', function() {
            if (isProcessing || !isValid) return;
            
            const prompt = this.getAttribute('data-prompt');
            if (prompt) {
                messageInput.value = prompt;
                messageInput.focus();
                charCount.textContent = prompt.length;
            }
        });
    });
    
    // 履歴クリア
    if (clearHistoryBtn) {
        clearHistoryBtn.addEventListener('click', async function() {
            if (!confirm('会話履歴をクリアしてもよろしいですか？')) return;
            
            try {
                const formData = new FormData();
                formData.append('action', 'ai_chat_clear_history');
                formData.append('nonce', document.querySelector('input[name="chat_nonce"]')?.value || '');
                
                const response = await fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // チャット履歴をクリア
                    chatHistory.innerHTML = `
                        <div class="flex items-start space-x-3 animate-message-in">
                            <div class="w-10 h-10 bg-gradient-to-br from-primary to-secondary rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-robot text-white text-sm"></i>
                            </div>
                            <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white p-4 rounded-2xl rounded-tl-lg max-w-md message-shadow">
                                <p class="text-sm mb-2">👋 こんにちは！</p>
                                <p>私はGemini AIアシスタントです。ビジネスに関するご質問、技術的なサポート、創作活動のお手伝いなど、何でもお気軽にお聞かせください。</p>
                            </div>
                        </div>
                    `;
                } else {
                    alert('履歴のクリアに失敗しました。');
                }
            } catch (error) {
                console.error('Clear history error:', error);
                alert('エラーが発生しました。');
            }
        });
    }
    
    // 音声入力（ブラウザ対応の場合）
    if ('webkitSpeechRecognition' in window) {
        const recognition = new webkitSpeechRecognition();
        recognition.lang = 'ja-JP';
        recognition.continuous = false;
        
        voiceBtn.addEventListener('click', function() {
            if (isProcessing || !isValid) return;
            
            recognition.start();
            this.innerHTML = '<i class="fas fa-microphone-slash animate-pulse"></i>';
        });
        
        recognition.onresult = function(event) {
            const transcript = event.results[0][0].transcript;
            messageInput.value = transcript;
            charCount.textContent = transcript.length;
            voiceBtn.innerHTML = '<i class="fas fa-microphone"></i>';
        };
        
        recognition.onerror = function() {
            voiceBtn.innerHTML = '<i class="fas fa-microphone"></i>';
        };
    } else {
        voiceBtn.style.display = 'none';
    }
    
    // HTMLエスケープ関数
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
});
</script>

<?php get_footer(); ?>