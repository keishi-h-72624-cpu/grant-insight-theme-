<?php
/**
 * Grant Insight Perfect - 1. Theme Setup File
 *
 * テーマの基本設定、スクリプト読込、ウィジェット、カスタマイザー、
 * パフォーマンス・セキュリティ最適化などを担当します。
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
 * スクリプト・スタイルの読み込み（完全一元管理）
 */
function gi_enqueue_scripts() {
    // 最適化されたCSSファイル（外部CDN依存を削除）
    wp_enqueue_style('gi-optimized-css', get_template_directory_uri() . '/assets/css/optimized.css', array(), GI_THEME_VERSION);
    
    // Tailwind設定（完全版）
    $tailwind_config = "
    tailwind.config = {
        darkMode: 'class',
        theme: {
            extend: {
                colors: {
                    'emerald-custom': {
                        50: '#ecfdf5',
                        100: '#d1fae5',
                        200: '#bbf7d0',
                        300: '#86efac',
                        400: '#4ade80',
                        500: '#10b981',
                        600: '#059669',
                        700: '#047857',
                        800: '#065f46',
                        900: '#064e3b',
                    },
                    'teal-custom': {
                        50: '#f0fdfa',
                        100: '#ccfbf1',
                        200: '#99f6e4',
                        300: '#5eead4',
                        400: '#2dd4bf',
                        500: '#14b8a6',
                        600: '#0d9488',
                        700: '#0f766e',
                        800: '#115e59',
                        900: '#134e4a',
                    },
                    'primary': {
                        50: '#f0f9ff',
                        100: '#e0f2fe',
                        200: '#bae6fd',
                        300: '#7dd3fc',
                        400: '#38bdf8',
                        500: '#0ea5e9',
                        600: '#0284c7',
                        700: '#0369a1',
                        800: '#075985',
                        900: '#0c4a6e',
                    }
                },
                animation: {
                    'fade-in': 'fadeIn 0.6s ease-out',
                    'fade-in-up': 'fadeInUp 0.6s ease-out',
                    'fade-in-down': 'fadeInDown 0.6s ease-out',
                    'fade-in-left': 'fadeInLeft 0.6s ease-out',
                    'fade-in-right': 'fadeInRight 0.6s ease-out',
                    'slide-up': 'slideUp 0.4s ease-out',
                    'slide-down': 'slideDown 0.4s ease-out',
                    'slide-in': 'slideIn 0.3s ease-out',
                    'bounce-gentle': 'bounceGentle 1s ease-out',
                    'pulse-gentle': 'pulseGentle 2s ease-in-out infinite',
                    'float': 'float 3s ease-in-out infinite',
                    'spin-slow': 'spin 20s linear infinite',
                    'wiggle': 'wiggle 0.5s ease-in-out',
                    'scale-in': 'scaleIn 0.5s ease-out',
                    'glow': 'glow 2s ease-in-out infinite alternate'
                },
                keyframes: {
                    fadeIn: {
                        '0%': { opacity: '0' },
                        '100%': { opacity: '1' }
                    },
                    fadeInUp: {
                        '0%': { opacity: '0', transform: 'translateY(20px)' },
                        '100%': { opacity: '1', transform: 'translateY(0)' }
                    },
                    fadeInDown: {
                        '0%': { opacity: '0', transform: 'translateY(-20px)' },
                        '100%': { opacity: '1', transform: 'translateY(0)' }
                    },
                    fadeInLeft: {
                        '0%': { opacity: '0', transform: 'translateX(-20px)' },
                        '100%': { opacity: '1', transform: 'translateX(0)' }
                    },
                    fadeInRight: {
                        '0%': { opacity: '0', transform: 'translateX(20px)' },
                        '100%': { opacity: '1', transform: 'translateX(0)' }
                    },
                    slideUp: {
                        '0%': { opacity: '0', transform: 'translateY(40px)' },
                        '100%': { opacity: '1', transform: 'translateY(0)' }
                    },
                    slideDown: {
                        '0%': { opacity: '0', transform: 'translateY(-40px)' },
                        '100%': { opacity: '1', transform: 'translateY(0)' }
                    },
                    slideIn: {
                        '0%': { opacity: '0', transform: 'translateX(-10px)' },
                        '100%': { opacity: '1', transform: 'translateX(0)' }
                    },
                    bounceGentle: {
                        '0%': { transform: 'scale(0.95)' },
                        '50%': { transform: 'scale(1.02)' },
                        '100%': { transform: 'scale(1)' }
                    },
                    pulseGentle: {
                        '0%, 100%': { opacity: '1' },
                        '50%': { opacity: '0.8' }
                    },
                    float: {
                        '0%, 100%': { transform: 'translateY(0px)' },
                        '50%': { transform: 'translateY(-10px)' }
                    },
                    wiggle: {
                        '0%, 100%': { transform: 'rotate(-2deg)' },
                        '50%': { transform: 'rotate(2deg)' }
                    },
                    scaleIn: {
                        '0%': { opacity: '0', transform: 'scale(0.9)' },
                        '100%': { opacity: '1', transform: 'scale(1)' }
                    },
                    glow: {
                        '0%': { boxShadow: '0 0 5px rgba(16, 185, 129, 0.2)' },
                        '100%': { boxShadow: '0 0 20px rgba(16, 185, 129, 0.4)' }
                    }
                },
                fontFamily: {
                    'noto': ['Noto Sans JP', 'sans-serif'],
                    'heading': ['Noto Sans JP', 'system-ui', 'sans-serif']
                },
                fontSize: {
                    'xs': ['0.75rem', { lineHeight: '1rem' }],
                    'sm': ['0.875rem', { lineHeight: '1.25rem' }],
                    'base': ['1rem', { lineHeight: '1.5rem' }],
                    'lg': ['1.125rem', { lineHeight: '1.75rem' }],
                    'xl': ['1.25rem', { lineHeight: '1.75rem' }],
                    '2xl': ['1.5rem', { lineHeight: '2rem' }],
                    '3xl': ['1.875rem', { lineHeight: '2.25rem' }],
                    '4xl': ['2.25rem', { lineHeight: '2.5rem' }],
                    '5xl': ['3rem', { lineHeight: '1' }],
                    '6xl': ['3.75rem', { lineHeight: '1' }],
                    '7xl': ['4.5rem', { lineHeight: '1' }],
                    '8xl': ['6rem', { lineHeight: '1' }],
                    '9xl': ['8rem', { lineHeight: '1' }]
                },
                spacing: {
                    '18': '4.5rem',
                    '88': '22rem',
                    '128': '32rem',
                    '144': '36rem'
                },
                boxShadow: {
                    'glow': '0 0 20px rgba(16, 185, 129, 0.3)',
                    'glow-lg': '0 0 30px rgba(16, 185, 129, 0.4)',
                    'card': '0 10px 25px -5px rgba(0, 0, 0, 0.1)',
                    'card-hover': '0 25px 50px -12px rgba(0, 0, 0, 0.25)'
                },
                backdropBlur: {
                    'xs': '2px'
                },
                screens: {
                    'xs': '475px'
                }
            }
        },
        plugins: []
    }";
    wp_add_inline_script('tailwind-cdn', $tailwind_config);
    
    // Font Awesome CDN（一元管理）
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
    
    // Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;600;700;800;900&display=swap', array(), null);
    
    // テーマスタイル
    wp_enqueue_style('gi-style', get_stylesheet_uri(), array(), GI_THEME_VERSION);
    
    // メインJavaScript
    wp_enqueue_script('gi-main-js', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), GI_THEME_VERSION, true);
    
    // AJAX設定（強化版）
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
    // Back-compat shim for legacy inline scripts expecting giAjax
    wp_add_inline_script('gi-main-js', 'window.giAjax = window.giAjax || { ajaxurl: gi_ajax.ajax_url, nonce: gi_ajax.nonce };');
    
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
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-8">',
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
        'before_title'  => '<h4 class="widget-title text-base font-semibold mb-3 text-white">',
        'after_title'   => '</h4>',
    ));
    
    register_sidebar(array(
        'name'          => 'フッターエリア2',
        'id'            => 'footer-2',
        'description'   => 'フッター中央エリア',
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-6">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title text-base font-semibold mb-3 text-white">',
        'after_title'   => '</h4>',
    ));
    
    register_sidebar(array(
        'name'          => 'フッターエリア3',
        'id'            => 'footer-3',
        'description'   => 'フッター右側エリア',
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-6">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title text-base font-semibold mb-3 text-white">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'gi_widgets_init');

/**
 * カスタマイザー設定（強化版）
 */
function gi_customize_register($wp_customize) {
    // ヒーローセクション設定
    $wp_customize->add_section('gi_hero_section', array(
        'title' => 'ヒーローセクション',
        'priority' => 30,
        'description' => 'フロントページのヒーローセクションを設定します'
    ));
    
    // ヒーロータイトル
    $wp_customize->add_setting('gi_hero_title', array(
        'default' => 'AI が提案する助成金・補助金情報サイト',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('gi_hero_title', array(
        'label' => 'メインタイトル',
        'section' => 'gi_hero_section',
        'type' => 'text'
    ));
    
    // ヒーローサブタイトル
    $wp_customize->add_setting('gi_hero_subtitle', array(
        'default' => '最先端のAI技術で、あなたのビジネスに最適な助成金・補助金を瞬時に発見。',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('gi_hero_subtitle', array(
        'label' => 'サブタイトル',
        'section' => 'gi_hero_section',
        'type' => 'textarea'
    ));
    
    // ヒーロー動画
    $wp_customize->add_setting('gi_hero_video', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'gi_hero_video', array(
        'label' => 'ヒーロー動画',
        'section' => 'gi_hero_section',
        'mime_type' => 'video'
    )));
    
    // ヒーローロゴ
    $wp_customize->add_setting('gi_hero_logo', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'gi_hero_logo', array(
        'label' => 'ヒーロー用ロゴ画像',
        'section' => 'gi_hero_section'
    )));
    
    // CTAボタン設定
    $wp_customize->add_setting('gi_hero_cta_primary_text', array(
        'default' => '今すぐ検索開始',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control('gi_hero_cta_primary_text', array(
        'label' => 'プライマリCTAテキスト',
        'section' => 'gi_hero_section',
        'type' => 'text'
    ));
    
    $wp_customize->add_setting('gi_hero_cta_primary_url', array(
        'default' => '#search-section',
        'sanitize_callback' => 'esc_url_raw'
    ));
    
    $wp_customize->add_control('gi_hero_cta_primary_url', array(
        'label' => 'プライマリCTA URL',
        'section' => 'gi_hero_section',
        'type' => 'url'
    ));
    
    // サイト基本設定
    $wp_customize->add_section('gi_site_settings', array(
        'title' => 'サイト基本設定',
        'priority' => 25
    ));
    
    // プライマリカラー
    $wp_customize->add_setting('gi_primary_color', array(
        'default' => '#10b981',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'gi_primary_color', array(
        'label' => 'プライマリカラー',
        'section' => 'gi_site_settings'
    )));
}
add_action('customize_register', 'gi_customize_register');


/**
 * パフォーマンス最適化
 */
function gi_performance_optimizations() {
    // 画像の遅延読み込み
    add_filter('wp_lazy_loading_enabled', '__return_true');
    
    // 不要なスクリプトの削除
    add_action('wp_enqueue_scripts', 'gi_dequeue_unnecessary_scripts', 100);
}
add_action('init', 'gi_performance_optimizations');

function gi_dequeue_unnecessary_scripts() {
    if (!is_admin()) {
        // 絵文字スクリプトの削除
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
        
        // 未使用のスクリプトの削除
        if (!is_singular() || !comments_open()) {
            wp_dequeue_script('comment-reply');
        }
    }
}

/**
 * セキュリティ強化（テーマエディター有効版）
 */
function gi_security_enhancements() {
    // WordPressバージョンの隠蔽
    remove_action('wp_head', 'wp_generator');
    
    // 不要なヘッダー情報の削除
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    
    // XMLRPCの無効化
    add_filter('xmlrpc_enabled', '__return_false');
    
    // ログイン試行回数の制限
    add_action('wp_login_failed', 'gi_login_failed');
    add_filter('authenticate', 'gi_check_login_attempts', 30, 3);
}
add_action('init', 'gi_security_enhancements');

/**
 * ログイン失敗の記録
 */
function gi_login_failed($username) {
    $ip = $_SERVER['REMOTE_ADDR'] ?? '';
    $attempts = get_option('gi_login_attempts', []);
    
    if (!isset($attempts[$ip])) {
        $attempts[$ip] = [];
    }
    
    $attempts[$ip][] = time();
    
    // 1時間以上前の試行を削除
    $attempts[$ip] = array_filter($attempts[$ip], function($time) {
        return $time > (time() - 3600);
    });
    
    update_option('gi_login_attempts', $attempts);
}

/**
 * ログイン試行チェック
 */
function gi_check_login_attempts($user, $username, $password) {
    $ip = $_SERVER['REMOTE_ADDR'] ?? '';
    $attempts = get_option('gi_login_attempts', []);
    
    if (isset($attempts[$ip]) && count($attempts[$ip]) >= 5) {
        return new WP_Error('too_many_attempts',  
            __('Too many login attempts. Please try again later.', 'grant-insight'));
    }
    
    return $user;
}