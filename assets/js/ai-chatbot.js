/**
 * AIチャットボット用JavaScript
 * 
 * @package WordPress_AI_Chatbot
 * @version 1.0.0
 * @author 中澤圭志
 */

(function($) {
    'use strict';

    // グローバル変数
    window.AIChatbot = {
        isProcessing: false,
        chatHistory: [],
        currentSession: null,
        
        /**
         * 初期化
         */
        init: function() {
            this.bindEvents();
            this.loadChatHistory();
            this.setupKeyboardShortcuts();
            console.log('AI Chatbot initialized');
        },
        
        /**
         * イベントバインド
         */
        bindEvents: function() {
            const self = this;
            
            // フォーム送信
            $(document).on('submit', '#chatForm', function(e) {
                e.preventDefault();
                self.sendMessage();
            });
            
            // クイックアクション
            $(document).on('click', '.quick-action', function() {
                const prompt = $(this).data('prompt');
                if (prompt) {
                    self.setInputValue(prompt);
                }
            });
            
            // 履歴クリア
            $(document).on('click', '#clearHistoryBtn', function() {
                self.clearHistory();
            });
            
            // 文字数カウンター
            $(document).on('input', '#messageInput', function() {
                self.updateCharCounter();
                self.autoResizeTextarea();
            });
            
            // 音声入力
            if ('webkitSpeechRecognition' in window) {
                this.setupVoiceInput();
            }
        },
        
        /**
         * メッセージ送信
         */
        sendMessage: function() {
            if (this.isProcessing) {
                return;
            }
            
            const message = $('#messageInput').val().trim();
            if (!message) {
                return;
            }
            
            // メッセージ長さの検証
            if (message.length > 1000) {
                this.showError('メッセージが長すぎます。1000文字以内で入力してください。');
                return;
            }
            
            // UI状態を更新
            this.setProcessingState(true);
            this.addMessageToChat(message, 'user');
            this.clearInput();
            this.showTypingIndicator();
            
            // AJAXリクエスト
            $.ajax({
                url: ai_chat_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'ai_chat_send_message',
                    message: message,
                    nonce: ai_chat_ajax.nonce
                },
                success: (response) => {
                    this.hideTypingIndicator();
                    
                    if (response.success) {
                        this.addMessageToChat(response.data.response, 'ai');
                        this.updateChatStats(response.data.stats);
                    } else {
                        this.addMessageToChat('エラー: ' + (response.data || 'AI応答の生成に失敗しました'), 'ai', true);
                    }
                },
                error: (xhr, status, error) => {
                    this.hideTypingIndicator();
                    console.error('Chat error:', error);
                    this.addMessageToChat('接続エラーが発生しました。インターネット接続をご確認の上、再度お試しください。', 'ai', true);
                },
                complete: () => {
                    this.setProcessingState(false);
                }
            });
        },
        
        /**
         * メッセージをチャットに追加
         */
        addMessageToChat: function(message, type, isError = false) {
            const messageHtml = this.createMessageHtml(message, type, isError);
            $('#chatHistory').append(messageHtml);
            this.scrollToBottom();
            this.saveMessageToHistory(message, type);
        },
        
        /**
         * メッセージHTMLを作成
         */
        createMessageHtml: function(message, type, isError = false) {
            const iconBg = type === 'user' 
                ? 'bg-gradient-to-br from-accent to-primary' 
                : (isError ? 'bg-gradient-to-br from-error to-red-600' : 'bg-gradient-to-br from-primary to-secondary');
            
            const messageBg = type === 'user' 
                ? 'bg-gradient-to-r from-accent to-primary text-white' 
                : (isError ? 'bg-gradient-to-r from-red-100 to-red-200 text-red-800' : 'bg-gradient-to-r from-slate-100 to-slate-200 text-slate-800');
            
            const roundedClass = type === 'user' ? 'rounded-tr-lg' : 'rounded-tl-lg';
            const icon = type === 'user' ? 'fa-user' : (isError ? 'fa-exclamation-triangle' : 'fa-robot');
            
            if (type === 'user') {
                return `
                    <div class="flex items-start justify-end space-x-3 animate-message-in">
                        <div class="${messageBg} p-4 rounded-2xl ${roundedClass} max-w-md message-shadow">
                            <p>${this.escapeHtml(message)}</p>
                        </div>
                        <div class="w-10 h-10 ${iconBg} rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas ${icon} text-white text-sm"></i>
                        </div>
                    </div>
                `;
            } else {
                return `
                    <div class="flex items-start space-x-3 animate-message-in">
                        <div class="w-10 h-10 ${iconBg} rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas ${icon} text-white text-sm"></i>
                        </div>
                        <div class="${messageBg} p-4 rounded-2xl ${roundedClass} max-w-md message-shadow">
                            <p>${message}</p>
                        </div>
                    </div>
                `;
            }
        },
        
        /**
         * タイピングインジケーター
         */
        showTypingIndicator: function() {
            const indicatorHtml = `
                <div id="typingIndicator" class="flex items-start space-x-3">
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
            `;
            $('#chatHistory').append(indicatorHtml);
            this.scrollToBottom();
        },
        
        /**
         * タイピングインジケーターを非表示
         */
        hideTypingIndicator: function() {
            $('#typingIndicator').remove();
        },
        
        /**
         * 処理状態を設定
         */
        setProcessingState: function(isProcessing) {
            this.isProcessing = isProcessing;
            $('#sendBtn').prop('disabled', isProcessing);
            $('#messageInput').prop('disabled', isProcessing);
            
            if (isProcessing) {
                $('#sendBtn').html('<i class="fas fa-spinner fa-spin"></i> 送信中...');
            } else {
                $('#sendBtn').html('<i class="fas fa-paper-plane"></i> 送信');
            }
        },
        
        /**
         * 入力値を設定
         */
        setInputValue: function(value) {
            $('#messageInput').val(value).focus();
            this.updateCharCounter();
        },
        
        /**
         * 入力をクリア
         */
        clearInput: function() {
            $('#messageInput').val('').height('auto');
            this.updateCharCounter();
        },
        
        /**
         * 文字数カウンターを更新
         */
        updateCharCounter: function() {
            const length = $('#messageInput').val().length;
            $('#charCount').text(length);
        },
        
        /**
         * テキストエリアの自動リサイズ
         */
        autoResizeTextarea: function() {
            const textarea = $('#messageInput')[0];
            textarea.style.height = 'auto';
            textarea.style.height = Math.min(textarea.scrollHeight, 120) + 'px';
        },
        
        /**
         * チャット履歴を読み込む
         */
        loadChatHistory: function() {
            $.ajax({
                url: ai_chat_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'ai_chat_get_history',
                    nonce: ai_chat_ajax.nonce
                },
                success: (response) => {
                    if (response.success && response.data.history) {
                        this.chatHistory = response.data.history;
                        this.renderChatHistory();
                    }
                },
                error: (xhr, status, error) => {
                    console.error('Failed to load chat history:', error);
                }
            });
        },
        
        /**
         * チャット履歴を表示
         */
        renderChatHistory: function() {
            if (!this.chatHistory || this.chatHistory.length === 0) {
                return;
            }
            
            $('#chatHistory').empty();
            this.chatHistory.forEach(chat => {
                this.addMessageToChat(chat.message, chat.type);
            });
        },
        
        /**
         * メッセージを履歴に保存
         */
        saveMessageToHistory: function(message, type) {
            this.chatHistory.push({
                message: message,
                type: type,
                timestamp: new Date().toISOString()
            });
            
            // 履歴の長さを制限
            if (this.chatHistory.length > 50) {
                this.chatHistory = this.chatHistory.slice(-50);
            }
        },
        
        /**
         * チャット履歴をクリア
         */
        clearHistory: function() {
            if (!confirm(ai_chat_ajax.strings.clear_confirm)) {
                return;
            }
            
            $.ajax({
                url: ai_chat_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'ai_chat_clear_history',
                    nonce: ai_chat_ajax.nonce
                },
                success: (response) => {
                    if (response.success) {
                        this.chatHistory = [];
                        $('#chatHistory').empty();
                        this.loadChatHistory(); // 初期状態を再読み込み
                    } else {
                        alert('履歴のクリアに失敗しました。');
                    }
                },
                error: (xhr, status, error) => {
                    console.error('Failed to clear history:', error);
                    alert('エラーが発生しました。');
                }
            });
        },
        
        /**
         * チャット統計を更新
         */
        updateChatStats: function(stats) {
            console.log('Chat stats updated:', stats);
        },
        
        /**
         * スクロールを最下部に移動
         */
        scrollToBottom: function() {
            const chatHistory = $('#chatHistory')[0];
            chatHistory.scrollTop = chatHistory.scrollHeight;
        },
        
        /**
         * キーボードショートカットを設定
         */
        setupKeyboardShortcuts: function() {
            $(document).on('keydown', '#messageInput', (e) => {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    if (!this.isProcessing) {
                        this.sendMessage();
                    }
                }
            });
        },
        
        /**
         * 音声入力を設定
         */
        setupVoiceInput: function() {
            const self = this;
            const recognition = new webkitSpeechRecognition();
            recognition.lang = 'ja-JP';
            recognition.continuous = false;
            recognition.interimResults = false;
            
            $('#voiceBtn').on('click', function() {
                if (self.isProcessing) return;
                
                recognition.start();
                $(this).html('<i class="fas fa-microphone-slash animate-pulse"></i>');
            });
            
            recognition.onresult = function(event) {
                const transcript = event.results[0][0].transcript;
                self.setInputValue(transcript);
                $('#voiceBtn').html('<i class="fas fa-microphone"></i>');
            };
            
            recognition.onerror = function() {
                $('#voiceBtn').html('<i class="fas fa-microphone"></i>');
            };
            
            recognition.onend = function() {
                $('#voiceBtn').html('<i class="fas fa-microphone"></i>');
            };
        },
        
        /**
         * エラーメッセージを表示
         */
        showError: function(message) {
            alert('エラー: ' + message);
        },
        
        /**
         * HTMLエスケープ
         */
        escapeHtml: function(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        },
        
        /**
         * ユーティリティ関数
         */
        utils: {
            formatTime: function(date) {
                return new Date(date).toLocaleString('ja-JP');
            },
            
            truncateText: function(text, maxLength) {
                if (text.length <= maxLength) return text;
                return text.substring(0, maxLength) + '...';
            },
            
            debounce: function(func, wait) {
                let timeout;
                return function executedFunction(...args) {
                    const later = () => {
                        clearTimeout(timeout);
                        func(...args);
                    };
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                };
            }
        }
    };
    
    // DOM読み込み完了後に初期化
    $(document).ready(function() {
        AIChatbot.init();
    });
    
})(jQuery);