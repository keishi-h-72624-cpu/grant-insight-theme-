<?php
/**
 * AIチャットボット設定ページ
 * 
 * @package WordPress_AI_Chatbot
 * @version 1.0.0
 * @author 中澤圭志
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * 設定ページを追加
 */
function ai_chatbot_add_admin_menu() {
    add_menu_page(
        'AIチャットボット設定',
        'AIチャットボット',
        'manage_options',
        'ai-chatbot-settings',
        'ai_chatbot_settings_page',
        'dashicons-robotics',
        80
    );
}
add_action('admin_menu', 'ai_chatbot_add_admin_menu');

/**
 * 設定を初期化
 */
function ai_chatbot_settings_init() {
    register_setting('ai_chatbot_settings_group', 'gemini_api_key', [
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => ''
    ]);
    
    register_setting('ai_chatbot_settings_group', 'gemini_model', [
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => 'gemini-pro'
    ]);
    
    register_setting('ai_chatbot_settings_group', 'ai_chatbot_max_history', [
        'type' => 'integer',
        'sanitize_callback' => 'intval',
        'default' => 50
    ]);
    
    register_setting('ai_chatbot_settings_group', 'ai_chatbot_conversation_timeout', [
        'type' => 'integer',
        'sanitize_callback' => 'intval',
        'default' => 3600
    ]);
    
    // 設定セクション
    add_settings_section(
        'ai_chatbot_api_section',
        'Gemini API設定',
        'ai_chatbot_api_section_callback',
        'ai-chatbot-settings'
    );
    
    add_settings_section(
        'ai_chatbot_general_section',
        '一般設定',
        'ai_chatbot_general_section_callback',
        'ai-chatbot-settings'
    );
    
    add_settings_section(
        'ai_chatbot_advanced_section',
        '詳細設定',
        'ai_chatbot_advanced_section_callback',
        'ai-chatbot-settings'
    );
    
    // API設定フィールド
    add_settings_field(
        'gemini_api_key',
        'Gemini APIキー',
        'gemini_api_key_render',
        'ai-chatbot-settings',
        'ai_chatbot_api_section'
    );
    
    add_settings_field(
        'gemini_model',
        'AIモデル',
        'gemini_model_render',
        'ai-chatbot-settings',
        'ai_chatbot_api_section'
    );
    
    // 一般設定フィールド
    add_settings_field(
        'ai_chatbot_max_history',
        '最大履歴数',
        'ai_chatbot_max_history_render',
        'ai-chatbot-settings',
        'ai_chatbot_general_section'
    );
    
    add_settings_field(
        'ai_chatbot_conversation_timeout',
        '会話タイムアウト（秒）',
        'ai_chatbot_conversation_timeout_render',
        'ai-chatbot-settings',
        'ai_chatbot_general_section'
    );
}
add_action('admin_init', 'ai_chatbot_settings_init');

/**
 * APIセクションコールバック
 */
function ai_chatbot_api_section_callback() {
    echo '<p class="description">Gemini AI APIの設定を行います。APIキーは<a href="https://makersuite.google.com/app/apikey" target="_blank">Google AI Studio</a>から取得できます。</p>';
}

/**
 * 一般セクションコールバック
 */
function ai_chatbot_general_section_callback() {
    echo '<p class="description">チャットボットの動作に関する一般設定を行います。</p>';
}

/**
 * 詳細セクションコールバック
 */
function ai_chatbot_advanced_section_callback() {
    echo '<p class="description">高度な設定オプションです。通常はデフォルト値のままで問題ありません。</p>';
}

/**
 * APIキーフィールドレンダリング
 */
function gemini_api_key_render() {
    $api_key = get_option('gemini_api_key', '');
    ?>
    <input type="password" 
           name="gemini_api_key" 
           value="<?php echo esc_attr($api_key); ?>" 
           class="regular-text"
           placeholder="AIza..."
           id="gemini_api_key">
    <button type="button" id="toggle_api_key" class="button button-secondary ml-2">表示</button>
    <button type="button" id="test_api_key" class="button button-secondary ml-2">テスト</button>
    <p class="description">Google AI Studioから取得したAPIキーを入力してください。</p>
    <div id="api_test_result" class="mt-2" style="display: none;"></div>
    <script>
    jQuery(document).ready(function($) {
        // APIキー表示切替
        $('#toggle_api_key').click(function() {
            const apiKeyField = $('#gemini_api_key');
            const isPassword = apiKeyField.attr('type') === 'password';
            apiKeyField.attr('type', isPassword ? 'text' : 'password');
            $(this).text(isPassword ? '非表示' : '表示');
        });
        
        // APIキーテスト
        $('#test_api_key').click(function() {
            const apiKey = $('#gemini_api_key').val();
            const model = $('#gemini_model').val();
            
            if (!apiKey) {
                alert('APIキーを入力してください。');
                return;
            }
            
            const $button = $(this);
            const $result = $('#api_test_result');
            const originalText = $button.text();
            
            $button.text('テスト中...').prop('disabled', true);
            
            // AJAXでテスト
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'ai_chat_validate_settings',
                    nonce: '<?php echo wp_create_nonce("ai_chat_action"); ?>',
                    api_key: apiKey,
                    model: model
                },
                success: function(response) {
                    if (response.success) {
                        if (response.data.valid) {
                            $result.html('<div class="notice notice-success"><p>✅ APIキーは有効です。AIチャットボットを使用できます。</p></div>');
                        } else {
                            $result.html('<div class="notice notice-error"><p>❌ ' + response.data.message + '</p></div>');
                        }
                    } else {
                        $result.html('<div class="notice notice-error"><p>❌ テストに失敗しました。</p></div>');
                    }
                    $result.show();
                },
                error: function() {
                    $result.html('<div class="notice notice-error"><p>❌ テスト中にエラーが発生しました。</p></div>');
                    $result.show();
                },
                complete: function() {
                    $button.text(originalText).prop('disabled', false);
                }
            });
        });
    });
    </script>
    <?php
}

/**
 * モデルフィールドレンダリング
 */
function gemini_model_render() {
    $model = get_option('gemini_model', 'gemini-pro');
    $models = [
        'gemini-pro' => 'Gemini Pro（推奨）',
        'gemini-pro-vision' => 'Gemini Pro Vision',
        'gemini-ultra' => 'Gemini Ultra（実験的）'
    ];
    ?>
    <select name="gemini_model" id="gemini_model" class="regular-text">
        <?php foreach ($models as $value => $label): ?>
            <option value="<?php echo esc_attr($value); ?>" <?php selected($model, $value); ?>>
                <?php echo esc_html($label); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <p class="description">使用するAIモデルを選択してください。通常はGemini Proを推奨します。</p>
    <?php
}

/**
 * 最大履歴数フィールドレンダリング
 */
function ai_chatbot_max_history_render() {
    $max_history = get_option('ai_chatbot_max_history', 50);
    ?>
    <input type="number" 
           name="ai_chatbot_max_history" 
           value="<?php echo intval($max_history); ?>" 
           min="10" 
           max="200" 
           class="small-text">
    <p class="description">会話履歴の最大保持数を設定します。（10-200）</p>
    <?php
}

/**
 * 会話タイムアウトフィールドレンダリング
 */
function ai_chatbot_conversation_timeout_render() {
    $timeout = get_option('ai_chatbot_conversation_timeout', 3600);
    ?>
    <input type="number" 
           name="ai_chatbot_conversation_timeout" 
           value="<?php echo intval($timeout); ?>" 
           min="300" 
           max="86400" 
           class="small-text">
    <p class="description">会話のタイムアウト時間（秒）。デフォルトは1時間（3600秒）です。</p>
    <?php
}

/**
 * 設定ページレンダリング
 */
function ai_chatbot_settings_page() {
    ?>
    <div class="wrap">
        <h1>AIチャットボット設定</h1>
        <form action="options.php" method="post">
            <?php
            settings_fields('ai_chatbot_settings_group');
            do_settings_sections('ai-chatbot-settings');
            submit_button('設定を保存');
            ?>
        </form>
        
        <div class="card mt-4">
            <h2>設定ステータス</h2>
            <?php
            $api_key = get_option('gemini_api_key', '');
            $is_configured = !empty($api_key);
            $validation_result = $is_configured ? Gemini_AI::validate_api_key($api_key) : null;
            $is_valid = $is_configured && !is_wp_error($validation_result);
            ?>
            <div class="notice notice-<?php echo $is_valid ? 'success' : 'warning'; ?> inline">
                <p>
                    <strong>ステータス: <?php echo $is_valid ? '✅ 正常' : '⚠️ 要設定'; ?></strong><br>
                    <?php echo $is_valid ? 'AIチャットボットは正常に動作しています。' : 'Gemini APIキーを設定してください。'; ?>
                </p>
            </div>
        </div>
        
        <div class="card mt-4">
            <h2>使用方法</h2>
            <ol>
                <li><a href="https://makersuite.google.com/app/apikey" target="_blank">Google AI Studio</a>でAPIキーを取得します。</li>
                <li>上記の「Gemini APIキー」フィールドにAPIキーを入力します。</li>
                <li>「設定を保存」をクリックします。</li>
                <li>「テスト」ボタンでAPIキーの有効性を確認できます。</li>
                <li>「AIチャットボット」ページを作成して、サイトに表示されます。</li>
            </ol>
        </div>
    </div>
    <?php
}

/**
 * 設定リンクをプラグイン一覧に追加
 */
function ai_chatbot_settings_link($links) {
    $settings_link = '<a href="admin.php?page=ai-chatbot-settings">設定</a>';
    array_unshift($links, $settings_link);
    return $links;
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'ai_chatbot_settings_link');