<?php
/**
 * Grant Insight Perfect - 1. Theme Setup File (Optimized)
 *
 * テーマの基本設定、スクリプト読込、ウィジェット、カスタマイザー、
 * パフォーマンス・セキュリティ最適化などを担当します。
 * 外部CDN依存を削除し、パフォーマンスを最適化しました。
 *
 * @package Grant_Insight_Perfect
 */

// セキュリティチェック
if (!defined('ABSPATH')) {
    exit;
}

/**
 * テーマセットアップ
 */
function gi_setup() {
    // テーマサポート追加
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ));
    add_theme_support('custom-background');
    add_theme_support('custom-logo', array(
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ));
    add_theme_support('menus');
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    add_theme_support('wp-block-styles');
    
    // RSS フィード
    add_theme_support('automatic-feed-links');
    
    // 画像サイズ追加
    add_image_size('gi-card-thumb', 400, 300, true);
    add_image_size('gi-hero-thumb', 800, 600, true);
    add_image_size('gi-tool-logo', 120, 120, true);
    add_image_size('gi-banner', 1200, 400, true);
    
    // 言語ファイル読み込み
    load_theme_textdomain('grant-insight', get_template_directory() . '/languages');
    
    // メニュー登録
    register_nav_menus(array(
        'primary' => 'メインメニュー',
        'footer' => 'フッターメニュー',
        'mobile' => 'モバイルメニュー'
    ));
}
add_action('after_setup_theme', 'gi_setup');

/**
 * コンテンツ幅設定
 */
function gi_content_width() {
    $GLOBALS['content_width'] = apply_filters('gi_content_width', 1200);
}
add_action('after_setup_theme', 'gi_content_width', 0);

/**
 * スクリプト・スタイルの読み込み（最適化版）
 */
function gi_enqueue_scripts() {
    // 最適化されたCSSファイル（外部CDN依存を削除）
    wp_enqueue_style('gi-optimized-css', get_template_directory_uri() . '/assets/css/optimized.css', array(), GI_THEME_VERSION);
    
    // Google Fonts（display=swapでパフォーマンス最適化）
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;600;700&display=swap', array(), null);
    
    // テーマスタイル
    wp_enqueue_style('gi-style', get_stylesheet_uri(), array('gi-optimized-css'), GI_THEME_VERSION);
    
    // メインJavaScript（最適化版）
    wp_enqueue_script('gi-main-js', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), GI_THEME_VERSION, true);
    
    // AIチャットボット用の追加スクリプト
    if (is_page_template('page-ai-chat.php')) {
        wp_enqueue_script('ai-chatbot-js', get_template_directory_uri() . '/assets/js/ai-chatbot.js', array('jquery'), GI_THEME_VERSION, true);
        wp_localize_script('ai-chatbot-js', 'ai_chat_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('ai_chat_action'),
            'strings' => array(
                'sending' => '送信中...',
                'error' => 'エラーが発生しました',
                'clear_confirm' => '会話履歴をクリアしてもよろしいですか？'
            )
        ));
    }
    
    // AJAX設定（最適化版）
    wp_localize_script('gi-main-js', 'gi_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('gi_ajax_nonce'),
        'homeUrl' => home_url('/'),
        'themeUrl' => get_template_directory_uri(),
        'uploadsUrl' => wp_upload_dir()['baseurl'],
        'isAdmin' => current_user_can('administrator'),
        'userId' => get_current_user_id(),
        'version' => GI_THEME_VERSION,
        'debug' => WP_DEBUG,
        'strings' => array(
            'loading' => '読み込み中...',
            'error' => 'エラーが発生しました',
            'noResults' => '結果が見つかりませんでした',
            'confirm' => '実行してもよろしいですか？'
        )
    ));
    
    // 条件付きスクリプト読み込み
    if (is_singular()) {
        wp_enqueue_script('comment-reply');
    }
    
    if (is_front_page()) {
        wp_enqueue_script('gi-frontend-js', get_template_directory_uri() . '/assets/js/front-page.js', array('gi-main-js'), GI_THEME_VERSION, true);
    }
}
add_action('wp_enqueue_scripts', 'gi_enqueue_scripts');

/**
 * ウィジェットエリア登録
 */
function gi_widgets_init() {
    register_sidebar(array(
        'name'          => 'メインサイドバー',
        'id'            => 'sidebar-main',
        'description'   => 'メインサイドバーエリア',
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-6">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title text-lg font-semibold mb-4 pb-2 border-b-2 border-emerald-500">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => 'フッターエリア1',
        'id'            => 'footer-1',
        'description'   => 'フッター左側エリア',
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-6">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title text-white font-semibold mb-4">',
        'after_title'   => '</h4>',
    ));
    
    register_sidebar(array(
        'name'          => 'フッターエリア2',
        'id'            => 'footer-2',
        'description'   => 'フッター中央エリア',
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-6">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title text-white font-semibold mb-4">',
        'after_title'   => '</h4>',
    ));
    
    register_sidebar(array(
        'name'          => 'フッターエリア3',
        'id'            => 'footer-3',
        'description'   => 'フッター右側エリア',
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-6">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title text-white font-semibold mb-4">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'gi_widgets_init');

/**
 * カスタマイザー設定
 */
function gi_customize_register($wp_customize) {
    // サイトカラー設定
    $wp_customize->add_section('gi_colors', array(
        'title' => 'サイトカラー',
        'priority' => 30,
    ));
    
    $wp_customize->add_setting('gi_primary_color', array(
        'default' => '#059669',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'gi_primary_color', array(
        'label' => 'プライマリカラー',
        'section' => 'gi_colors',
    )));
}
add_action('customize_register', 'gi_customize_register');

/**
 * セキュリティ強化
 */
function gi_security_enhancements() {
    // WordPressバージョン情報を隠す
    remove_action('wp_head', 'wp_generator');
    
    // RSDリンクを削除
    remove_action('wp_head', 'rsd_link');
    
    // Windows Live Writerサポートを削除
    remove_action('wp_head', 'wlwmanifest_link');
    
    // 絵文字スクリプトを削除（パフォーマンス向上）
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
    
    // REST APIヘッダーを削除
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
}
add_action('init', 'gi_security_enhancements');

/**
 * パフォーマンス最適化
 */
function gi_performance_optimizations() {
    // 不要なクエリ文字列を削除
    function gi_remove_query_strings($src) {
        $parts = explode('?ver', $src);
        return $parts[0];
    }
    add_filter('script_loader_src', 'gi_remove_query_strings', 15, 1);
    add_filter('style_loader_src', 'gi_remove_query_strings', 15, 1);
    
    // Gravatarプリフェッチを無効化
    add_filter('get_avatar', function($avatar) {
        return str_replace('src=', 'loading="lazy" src=', $avatar);
    });
}
add_action('init', 'gi_performance_optimizations');

