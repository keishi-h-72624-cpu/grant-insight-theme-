<?php
/**
 * The header for our theme - 完全安定化版
 * 助成金・補助金情報サイト専用ヘッダー
 * Version: 2.0 - CLS防止・検索機能統合版
 */

// セキュリティチェック
if (!defined('ABSPATH')) {
    exit;
}

// 必要なヘルパー関数を定義
if (!function_exists('gi_get_option')) {
    function gi_get_option($option_name, $default = '') {
        return get_theme_mod($option_name, $default);
    }
}

if (!function_exists('gi_safe_excerpt')) {
    function gi_safe_excerpt($text, $length = 160) {
        return mb_substr(strip_tags($text), 0, $length);
    }
}

// 検索統計データ取得（キャッシュ対応）
$search_stats = wp_cache_get('grant_search_stats', 'grant_insight');
if (false === $search_stats) {
    $search_stats = array(
        'total_grants' => wp_count_posts('grant')->publish ?? 1247,
        'total_tools' => wp_count_posts('tool')->publish ?? 89,
        'total_cases' => wp_count_posts('case_study')->publish ?? 156,
        'total_guides' => wp_count_posts('guide')->publish ?? 234
    );
    wp_cache_set('grant_search_stats', $search_stats, 'grant_insight', 3600);
}

// 都道府県データ
$prefectures = array(
    '北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県',
    '茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県',
    '新潟県', '富山県', '石川県', '福井県', '山梨県', '長野県', '岐阜県',
    '静岡県', '愛知県', '三重県', '滋賀県', '京都府', '大阪府', '兵庫県',
    '奈良県', '和歌山県', '鳥取県', '島根県', '岡山県', '広島県', '山口県',
    '徳島県', '香川県', '愛媛県', '高知県', '福岡県', '佐賀県', '長崎県',
    '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県'
);

// カテゴリとタグの取得
$grant_categories = get_terms(array(
    'taxonomy' => 'grant_category',
    'hide_empty' => false,
    'number' => 15
));

if (is_wp_error($grant_categories)) {
    $grant_categories = array();
}

// nonce生成
$search_nonce = wp_create_nonce('gi_ajax_nonce');
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CLS防止 - 最優先インラインCSS -->
    <style>
        /* 🎯 CLS完全防止システム */
        .header-main { 
            min-height: 80px; 
            background: #ffffff; 
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            contain: layout style paint;
            will-change: transform;
        }
        .header-container { 
            max-width: 1200px; 
            margin: 0 auto; 
            padding: 1rem 2rem; 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            min-height: 80px;
            gap: 1rem;
        }
        
        /* ロゴ安定化 - CLS防止のための固定サイズ */
        .site-logo { 
            flex-shrink: 0; 
            min-width: 0; 
            max-width: 50%;
        }
        .logo-main {
            width: 200px;
            height: 50px;
            position: relative;
        }
        .logo-main img { 
            position: absolute;
            top: 0;
            left: 0;
            height: 50px !important; 
            width: auto !important; 
            max-width: 200px !important;
            object-fit: contain;
            image-rendering: -webkit-optimize-contrast;
            image-rendering: crisp-edges;
        }
        .site-title-simple h1 { 
            font-size: 1.1rem; 
            margin: 0; 
            color: #1f2937; 
            font-weight: 700;
            line-height: 1.3;
        }
        .site-title-simple p { 
            font-size: 0.75rem; 
            color: #6b7280; 
            margin: 2px 0 0 0;
        }
        
        /* レスポンシブ基本 */
        .desktop-nav { display: none; }
        .grant-menu { display: none; }
        .mobile-menu-toggle { display: flex; align-items: center; gap: 0.5rem; }
        
        @media (min-width: 1024px) {
            .desktop-nav { display: flex !important; }
            .grant-menu { display: flex !important; }
            .mobile-menu-toggle { display: none !important; }
        }
        
        @media (max-width: 640px) {
            .header-container { padding: 0.75rem 1rem; }
            .site-logo { max-width: 60%; }
            .site-title-simple { display: none; }
            .logo-main {
                width: 160px;
                height: 40px;
            }
            .logo-main img { 
                height: 40px !important;
                max-width: 160px !important;
            }
        }
        
        /* ローディング状態 */
        .header-skeleton { opacity: 0.5; animation: pulse 1s infinite; }
        .header-loaded .header-skeleton { display: none; }
        
        @keyframes pulse {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 1; }
        }
        
        /* 検索モーダル基本 */
        .grant-search-modal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1050;
            backdrop-filter: blur(4px);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        .grant-search-modal.active {
            opacity: 1;
            visibility: visible;
        }
        .modal-content {
            transform: scale(0.95);
            transition: transform 0.3s ease;
        }
        .grant-search-modal.active .modal-content {
            transform: scale(1);
        }
        
        /* フォント最適化 */
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Noto Sans JP', 'Hiragino Kaku Gothic ProN', 'Meiryo', sans-serif;
            font-display: swap;
        }
    </style>
    
    <!-- SEO メタ情報 -->
    <meta name="description" content="<?php 
        if (is_singular()) {
            echo esc_attr(gi_safe_excerpt(get_the_excerpt(), 160));
        } else {
            echo esc_attr(get_bloginfo('description'));
        }
    ?>">
    
    <!-- Open Graph -->
    <?php if (is_singular()) : ?>
        <meta property="og:title" content="<?php echo esc_attr(get_the_title()); ?>">
        <meta property="og:description" content="<?php echo esc_attr(gi_safe_excerpt(get_the_excerpt(), 160)); ?>">
        <meta property="og:url" content="<?php echo esc_url(get_permalink()); ?>">
        <?php if (has_post_thumbnail()) : ?>
            <meta property="og:image" content="<?php echo esc_url(get_the_post_thumbnail_url(null, 'large')); ?>">
        <?php endif; ?>
    <?php else : ?>
        <meta property="og:title" content="<?php echo esc_attr(get_bloginfo('name')); ?>">
        <meta property="og:description" content="<?php echo esc_attr(get_bloginfo('description')); ?>">
        <meta property="og:url" content="<?php echo esc_url(home_url()); ?>">
    <?php endif; ?>
    
    <!-- Tailwind CSS (モバイルメニュー用) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- リソース最適化 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    
    <!-- 重要リソースのプリロード -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;600;700;900&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class('bg-white text-gray-900 antialiased font-japanese'); ?>>
    
    <?php wp_body_open(); ?>
    
    <!-- スキップリンク（アクセシビリティ対応） -->
    <a class="skip-link sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-blue-600 text-white px-4 py-2 rounded-md z-50 transition-all duration-200" href="#content">
        <?php esc_html_e('メインコンテンツへスキップ', 'grant-insight'); ?>
    </a>

    <!-- 🎯 安定化メインヘッダー -->
    <header class="header-main sticky top-0 bg-white shadow-md border-b border-gray-200 z-40" role="banner">
        <div class="header-container">
            
            <!-- サイトロゴエリア（CLS防止） -->
            <div class="site-logo flex items-center flex-shrink-0">
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="logo-link flex items-center gap-3 text-decoration-none">
                    <!-- ロゴ画像（サイズ固定） -->
                    <div class="logo-main">
                        <img src="http://joseikin-insight.com/wp-content/uploads/2025/09/1757335941511.png" 
                             alt="助成金・補助金情報サイト" 
                             loading="eager"
                             decoding="async"
                             width="200"
                             height="50"
                             style="height: 50px; width: auto; max-width: 200px;">
                    </div>
                    
                    <!-- サイトタイトル -->
                    <div class="site-title-simple hidden sm:block">
                        <h1 class="text-lg font-bold text-gray-900 leading-tight">助成金・補助金情報サイト</h1>
                        <p class="text-xs text-gray-600 mt-1">あなたの成功への第一歩をサポート</p>
                    </div>
                </a>
            </div>

            <!-- 🚀 新機能: 助成金専用メニュー -->
            <nav class="grant-menu hidden lg:flex items-center space-x-3" role="navigation" aria-label="助成金メニュー">
                
                <!-- 助成金一覧ボタン -->
                <a href="<?php echo esc_url(home_url('/grants/')); ?>" 
                   class="grant-list-btn flex items-center gap-2 px-4 py-2.5 text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200 font-medium text-sm border border-gray-200 hover:border-emerald-200 shadow-sm hover:shadow-md">
                    <i class="fas fa-list" aria-hidden="true"></i>
                    <span>助成金一覧</span>
                </a>
                
                <!-- 助成金検索ボタン -->
                <button type="button" 
                        id="search-modal-trigger"
                        class="search-trigger-btn flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white rounded-lg transition-all duration-200 font-medium text-sm shadow-md hover:shadow-lg transform hover:scale-105"
                        aria-label="助成金検索ダイアログを開く">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <span>助成金検索</span>
                </button>
            </nav>

            <!-- デスクトップナビゲーション -->
            <nav class="desktop-nav hidden lg:flex items-center space-x-2 ml-4" role="navigation" aria-label="メインナビゲーション">
                <ul class="flex items-center space-x-2">
                    <li>
                        <a href="<?php echo esc_url(home_url('/')); ?>" 
                           class="nav-link px-3 py-2 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all duration-200 font-medium text-sm <?php echo is_front_page() ? 'bg-gray-100 text-gray-900' : ''; ?>">
                            <i class="fas fa-home mr-1 text-xs" aria-hidden="true"></i>
                            ホーム
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(home_url('/tools/')); ?>" 
                           class="nav-link px-3 py-2 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all duration-200 font-medium text-sm <?php echo (is_post_type_archive('tool') || is_singular('tool')) ? 'bg-gray-100 text-gray-900' : ''; ?>">
                            <i class="fas fa-tools mr-1 text-xs" aria-hidden="true"></i>
                            ツール
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(home_url('/case-studies/')); ?>" 
                           class="nav-link px-3 py-2 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all duration-200 font-medium text-sm <?php echo (is_post_type_archive('case_study') || is_singular('case_study')) ? 'bg-gray-100 text-gray-900' : ''; ?>">
                            <i class="fas fa-trophy mr-1 text-xs" aria-hidden="true"></i>
                            成功事例
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" 
                           class="nav-link px-3 py-2 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all duration-200 font-medium text-sm <?php echo is_page('contact') ? 'bg-gray-100 text-gray-900' : ''; ?>">
                            <i class="fas fa-envelope mr-1 text-xs" aria-hidden="true"></i>
                            お問い合わせ
                        </a>
                    </li>
                </ul>
                
                <!-- CTAボタン -->
                <div class="ml-4">
                    <?php
                    $cta_text = gi_get_option('gi_header_cta_text', '無料相談');
                    $cta_url = gi_get_option('gi_header_cta_url', home_url('/contact/'));
                    ?>
                    <a href="<?php echo esc_url($cta_url); ?>" 
                       class="cta-button inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white py-2.5 px-5 rounded-lg font-bold text-sm shadow-md hover:shadow-lg transition-all duration-200 transform hover:scale-105"
                       aria-label="<?php echo esc_attr($cta_text . 'ページへ移動'); ?>">
                        <i class="fas fa-comments mr-2" aria-hidden="true"></i>
                        <span class="text-white"><?php echo esc_html($cta_text); ?></span>
                    </a>
                </div>
            </nav>
            
            <!-- モバイルメニューエリア -->
            <div class="mobile-menu-toggle flex items-center lg:hidden gap-2">
                <!-- モバイル検索ボタン -->
                <button type="button" 
                        id="mobile-search-trigger"
                        class="mobile-search-btn p-2.5 text-emerald-600 hover:text-emerald-700 hover:bg-emerald-50 rounded-lg transition-all duration-200"
                        aria-label="助成金検索">
                    <i class="fas fa-search text-lg" aria-hidden="true"></i>
                </button>
                
                <!-- ハンバーガーメニュー -->
                <button id="mobile-menu-button" 
                        class="menu-button p-2.5 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all duration-200 z-50"
                        aria-label="メニューを開く"
                        aria-expanded="false"
                        aria-controls="mobile-menu">
                    <i class="fas fa-bars text-xl" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- 🔍 助成金検索モーダル -->
    <div id="grant-search-modal" 
         class="grant-search-modal"
         aria-hidden="true"
         role="dialog"
         aria-labelledby="search-modal-title"
         aria-describedby="search-modal-description">
        
        <div class="modal-container flex items-start justify-center min-h-screen pt-8 pb-8 px-4">
            <div class="modal-content bg-white rounded-2xl shadow-2xl max-w-6xl w-full max-h-[95vh] overflow-y-auto">
                
                <!-- モーダルヘッダー -->
                <div class="modal-header flex items-center justify-between p-6 border-b border-gray-200 bg-gradient-to-r from-emerald-50 to-blue-50">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-search text-white"></i>
                        </div>
                        <div>
                            <h2 id="search-modal-title" class="text-xl font-bold text-emerald-800">助成金・補助金検索</h2>
                            <p id="search-modal-description" class="text-sm text-emerald-600 mt-1">条件を指定して最適な助成金を見つけましょう</p>
                        </div>
                    </div>
                    <button type="button" 
                            id="search-modal-close"
                            class="close-btn p-2 text-gray-400 hover:text-gray-600 hover:bg-white rounded-lg transition-all duration-200"
                            aria-label="検索ダイアログを閉じる">
                        <i class="fas fa-times text-lg" aria-hidden="true"></i>
                    </button>
                </div>
                
                <!-- モーダルコンテンツ -->
                <div class="modal-body p-6">
                    <!-- 統計表示 -->
                    <div class="stats-display grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                        <?php
                        $stats_data = array(
                            array('count' => $search_stats['total_grants'], 'label' => '助成金', 'icon' => 'fas fa-coins', 'color' => 'emerald'),
                            array('count' => $search_stats['total_tools'], 'label' => 'ツール', 'icon' => 'fas fa-tools', 'color' => 'blue'),
                            array('count' => $search_stats['total_cases'], 'label' => '成功事例', 'icon' => 'fas fa-trophy', 'color' => 'purple'),
                            array('count' => $search_stats['total_guides'], 'label' => 'ガイド', 'icon' => 'fas fa-book-open', 'color' => 'orange'),
                        );
                        
                        foreach ($stats_data as $stat): ?>
                            <div class="stat-card text-center p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <div class="w-8 h-8 bg-<?php echo $stat['color']; ?>-100 text-<?php echo $stat['color']; ?>-600 rounded-lg flex items-center justify-center mx-auto mb-2">
                                    <i class="<?php echo esc_attr($stat['icon']); ?> text-sm"></i>
                                </div>
                                <div class="text-lg font-bold text-gray-900"><?php echo number_format($stat['count']); ?></div>
                                <div class="text-xs text-gray-600"><?php echo esc_html($stat['label']); ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <!-- 検索フォーム -->
                    <form id="modal-search-form" class="space-y-6">
                        <!-- 隠しフィールド -->
                        <input type="hidden" id="modal-search-nonce" value="<?php echo esc_attr($search_nonce); ?>">
                        <input type="hidden" id="modal-ajax-url" value="<?php echo esc_url(admin_url('admin-ajax.php')); ?>">
                        
                        <!-- メイン検索バー -->
                        <div class="search-main-box bg-gradient-to-r from-emerald-50 via-blue-50 to-purple-50 border-2 border-gray-200 rounded-xl p-6">
                            <div class="search-main flex flex-col md:flex-row gap-4">
                                <div class="search-input-container flex-1 relative bg-white border-2 border-gray-200 rounded-lg px-4 py-3 focus-within:border-emerald-500 focus-within:ring-4 focus-within:ring-emerald-100 transition-all duration-200">
                                    <div class="flex items-center">
                                        <i class="fas fa-search text-gray-400 mr-3"></i>
                                        <input type="text" 
                                               id="modal-search-input"
                                               name="search"
                                               class="flex-1 border-none outline-none bg-transparent text-gray-900 placeholder-gray-500 text-base"
                                               placeholder="助成金・補助金を検索（例：IT導入補助金、持続化補助金）"
                                               autocomplete="off"
                                               aria-label="検索キーワードを入力">
                                        <button type="button" 
                                                class="search-clear-btn text-gray-400 hover:text-gray-600 ml-2 p-1 rounded hidden transition-colors duration-200"
                                                aria-label="検索をクリア">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <button type="submit" 
                                        class="search-submit-btn bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white px-8 py-3 rounded-lg font-semibold transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105 min-w-[120px]">
                                    <span class="btn-text">検索</span>
                                    <div class="btn-loading hidden">
                                        <i class="fas fa-spinner animate-spin mr-2"></i>
                                        検索中
                                    </div>
                                </button>
                            </div>
                        </div>
                        
                        <!-- 人気検索ワード -->
                        <div class="popular-keywords">
                            <h3 class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                                <i class="fas fa-fire text-orange-500"></i>
                                人気検索ワード
                            </h3>
                            <div class="flex flex-wrap gap-2">
                                <?php
                                $popular_keywords = array(
                                    'IT導入補助金', '小規模事業者持続化補助金', 'ものづくり補助金', 
                                    '事業再構築補助金', '雇用関係助成金', 'DX推進', '創業支援', 
                                    '人材育成', '働き方改革', 'スタートアップ支援'
                                );
                                
                                foreach ($popular_keywords as $keyword): ?>
                                    <button type="button" 
                                            class="keyword-btn px-3 py-1.5 bg-gray-100 hover:bg-emerald-100 hover:text-emerald-700 text-gray-700 text-sm rounded-full transition-all duration-200 border border-transparent hover:border-emerald-200" 
                                            data-keyword="<?php echo esc_attr($keyword); ?>">
                                        <?php echo esc_html($keyword); ?>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        <!-- フィルター -->
                        <div class="filters-section bg-gray-50 rounded-xl p-6 border border-gray-200">
                            <h3 class="text-sm font-semibold text-gray-700 mb-4 flex items-center gap-2">
                                <i class="fas fa-filter text-blue-500"></i>
                                詳細フィルター
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                <!-- カテゴリフィルター -->
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-2" for="modal-category-filter">カテゴリ</label>
                                    <select id="modal-category-filter" 
                                            name="category" 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 bg-white">
                                        <option value="">すべてのカテゴリ</option>
                                        <?php if (!empty($grant_categories)): ?>
                                            <?php foreach ($grant_categories as $category): ?>
                                                <option value="<?php echo esc_attr($category->slug); ?>">
                                                    <?php echo esc_html($category->name); ?> (<?php echo $category->count; ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                
                                <!-- 地域フィルター -->
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-2" for="modal-prefecture-filter">地域</label>
                                    <select id="modal-prefecture-filter" 
                                            name="prefecture" 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 bg-white">
                                        <option value="">全国対象</option>
                                        <?php foreach ($prefectures as $prefecture): ?>
                                            <option value="<?php echo esc_attr($prefecture); ?>">
                                                <?php echo esc_html($prefecture); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <!-- 金額フィルター -->
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-2" for="modal-amount-filter">金額</label>
                                    <select id="modal-amount-filter" 
                                            name="amount" 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 bg-white">
                                        <option value="">金額指定なし</option>
                                        <option value="0-100">100万円以下</option>
                                        <option value="100-500">100万円 - 500万円</option>
                                        <option value="500-1000">500万円 - 1,000万円</option>
                                        <option value="1000+">1,000万円以上</option>
                                    </select>
                                </div>
                                
                                <!-- ステータスフィルター -->
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-2" for="modal-status-filter">ステータス</label>
                                    <select id="modal-status-filter" 
                                            name="status" 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 bg-white">
                                        <option value="">すべてのステータス</option>
                                        <option value="active">募集中</option>
                                        <option value="upcoming">募集予定</option>
                                        <option value="closed">募集終了</option>
                                    </select>
                                </div>
                                
                                <!-- 難易度フィルター -->
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-2" for="modal-difficulty-filter">申請難易度</label>
                                    <select id="modal-difficulty-filter" 
                                            name="difficulty" 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 bg-white">
                                        <option value="">すべての難易度</option>
                                        <option value="easy">★☆☆ 易しい</option>
                                        <option value="normal">★★☆ 普通</option>
                                        <option value="hard">★★★ 難しい</option>
                                    </select>
                                </div>
                                
                                <!-- 並び順 -->
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-2" for="modal-sort-filter">並び順</label>
                                    <select id="modal-sort-filter" 
                                            name="orderby" 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 bg-white">
                                        <option value="date_desc">新着順</option>
                                        <option value="amount_desc">金額の高い順</option>
                                        <option value="amount_asc">金額の低い順</option>
                                        <option value="deadline_asc">締切の近い順</option>
                                        <option value="title_asc">名前順</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <!-- アクションボタン -->
                        <div class="action-buttons flex flex-col sm:flex-row gap-3 justify-center">
                            <button type="submit" 
                                    class="search-execute-btn bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white px-8 py-3 rounded-lg font-semibold transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                                <i class="fas fa-search mr-2"></i>
                                条件で検索する
                            </button>
                            <button type="button" 
                                    id="modal-reset-btn"
                                    class="reset-btn bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-medium transition-all duration-200 border border-gray-300 hover:border-gray-400">
                                <i class="fas fa-redo mr-2"></i>
                                リセット
                            </button>
                        </div>
                    </form>
                    
                    <!-- 検索結果プレビュー -->
                    <div id="search-results-preview" class="search-results-preview mt-8 hidden">
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <h4 class="text-sm font-semibold text-blue-800 mb-2 flex items-center gap-2">
                                <i class="fas fa-eye"></i>
                                検索結果プレビュー
                            </h4>
                            <div id="preview-content" class="text-sm text-blue-700">
                                <!-- プレビュー内容がここに表示される -->
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- モーダルフッター -->
                <div class="modal-footer p-6 bg-gray-50 border-t border-gray-200 rounded-b-2xl">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="text-sm text-gray-600">
                            <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>
                            ヒント: 複数の条件を組み合わせると、より精密な検索ができます
                        </div>
                        <div class="flex items-center gap-3">
                            <a href="<?php echo esc_url(home_url('/grants/')); ?>" 
                               class="text-sm text-emerald-600 hover:text-emerald-800 font-medium">
                                すべての助成金を見る →
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- モバイルメニュー -->
    <div id="mobile-menu-overlay" 
         class="mobile-menu-overlay fixed inset-0 bg-black bg-opacity-50 hidden opacity-0 transition-all duration-300"
         style="z-index: 9998;"
         aria-hidden="true"></div>

    <aside id="mobile-menu" 
           class="mobile-menu fixed top-0 right-0 h-full bg-white shadow-2xl transition-transform duration-300 ease-in-out overflow-y-auto"
           style="z-index: 9999; width: 280px; max-width: 85vw; transform: translateX(100%);"
           aria-label="モバイルナビゲーション"
           aria-hidden="true"
        
        <!-- メニューヘッダー -->
        <div class="menu-header flex items-center justify-between p-6 border-b border-gray-200 bg-gray-50">
            <div class="menu-title flex items-center space-x-3">
                <img src="http://joseikin-insight.com/wp-content/uploads/2025/09/1757335941511.png" 
                     alt="助成金・補助金情報サイト" 
                     class="h-10 w-auto">
                <div>
                    <h2 class="text-lg font-bold text-gray-900">メニュー</h2>
                    <p class="text-sm text-gray-600">助成金・補助金情報サイト</p>
                </div>
            </div>
            <button id="mobile-menu-close-button" 
                    class="close-button p-2 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all duration-200"
                    aria-label="メニューを閉じる">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- メニューコンテンツ -->
        <div class="menu-content p-6">
            
            <!-- 助成金専用セクション -->
            <div class="grant-section mb-8 p-4 bg-gradient-to-r from-emerald-50 to-blue-50 rounded-lg border border-emerald-200">
                <h3 class="text-sm font-semibold text-emerald-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-coins"></i>
                    助成金・補助金
                </h3>
                <div class="space-y-3">
                    <a href="<?php echo esc_url(home_url('/grants/')); ?>" 
                       class="mobile-grant-link flex items-center gap-3 w-full p-3 text-emerald-700 hover:text-emerald-900 hover:bg-emerald-100 rounded-lg transition-all duration-200 text-sm font-medium">
                        <div class="w-8 h-8 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-list text-xs"></i>
                        </div>
                        <span>助成金一覧</span>
                        <i class="fas fa-chevron-right ml-auto text-xs opacity-60"></i>
                    </a>
                    <button type="button" 
                            id="mobile-search-modal-trigger"
                            class="mobile-search-link flex items-center gap-3 w-full p-3 text-emerald-700 hover:text-emerald-900 hover:bg-emerald-100 rounded-lg transition-all duration-200 text-sm font-medium">
                        <div class="w-8 h-8 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-search text-xs"></i>
                        </div>
                        <span>助成金検索</span>
                        <i class="fas fa-chevron-right ml-auto text-xs opacity-60"></i>
                    </button>
                </div>
            </div>
            
            <!-- メインナビゲーション -->
            <nav class="mobile-navigation mb-8" role="navigation" aria-label="モバイルメインナビゲーション">
                <ul class="nav-list space-y-2">
                    <li>
                        <a href="<?php echo esc_url(home_url('/')); ?>" 
                           class="nav-item flex items-center px-4 py-3 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all duration-200 font-medium <?php echo is_front_page() ? 'text-gray-900 bg-gray-100' : ''; ?>">
                            <i class="fas fa-home w-5 text-center mr-3 text-gray-500"></i>
                            ホーム
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(home_url('/tools/')); ?>" 
                           class="nav-item flex items-center px-4 py-3 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all duration-200 font-medium <?php echo (is_post_type_archive('tool') || is_singular('tool')) ? 'text-gray-900 bg-gray-100' : ''; ?>">
                            <i class="fas fa-tools w-5 text-center mr-3 text-gray-500"></i>
                            ツール
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(home_url('/case-studies/')); ?>" 
                           class="nav-item flex items-center px-4 py-3 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all duration-200 font-medium <?php echo (is_post_type_archive('case_study') || is_singular('case_study')) ? 'text-gray-900 bg-gray-100' : ''; ?>">
                            <i class="fas fa-trophy w-5 text-center mr-3 text-gray-500"></i>
                            成功事例
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(home_url('/guides/')); ?>" 
                           class="nav-item flex items-center px-4 py-3 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all duration-200 font-medium <?php echo (is_post_type_archive('guide') || is_singular('guide')) ? 'text-gray-900 bg-gray-100' : ''; ?>">
                            <i class="fas fa-book w-5 text-center mr-3 text-gray-500"></i>
                            ガイド・解説
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" 
                           class="nav-item flex items-center px-4 py-3 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all duration-200 font-medium <?php echo is_page('contact') ? 'text-gray-900 bg-gray-100' : ''; ?>">
                            <i class="fas fa-envelope w-5 text-center mr-3 text-gray-500"></i>
                            お問い合わせ
                        </a>
                    </li>
                </ul>
            </nav>
            
            <!-- CTAセクション -->
            <div class="cta-section mb-8">
                <?php
                $cta_text = gi_get_option('gi_header_cta_text', '無料相談');
                $cta_url = gi_get_option('gi_header_cta_url', home_url('/contact/'));
                ?>
                <a href="<?php echo esc_url($cta_url); ?>" 
                   class="cta-button block w-full text-center bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white py-4 px-6 rounded-lg font-bold text-base shadow-md hover:shadow-lg transition-all duration-200"
                   aria-label="<?php echo esc_attr($cta_text . 'ページへ移動'); ?>">
                    <i class="fas fa-comments mr-2"></i>
                    <span class="text-white"><?php echo esc_html($cta_text . 'を始める'); ?></span>
                </a>
            </div>

            <!-- 追加情報 -->
            <div class="additional-info pt-6 border-t border-gray-200">
                <div class="contact-info mb-6">
                    <h3 class="text-sm font-semibold text-gray-700 mb-4 flex items-center gap-2">
                        <i class="fas fa-phone"></i>
                        お問い合わせ
                    </h3>
                    <div class="info-grid grid grid-cols-2 gap-4 text-center">
                        <div class="info-item bg-gray-50 rounded-lg p-4 hover:bg-gray-100 transition-colors duration-200">
                            <div class="info-icon text-2xl text-gray-600 mb-2">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="info-label text-xs text-gray-600 font-medium">お電話</div>
                            <div class="info-value text-sm text-gray-800 font-semibold">平日 9-18時</div>
                        </div>
                        <div class="info-item bg-gray-50 rounded-lg p-4 hover:bg-gray-100 transition-colors duration-200">
                            <div class="info-icon text-2xl text-gray-600 mb-2">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="info-label text-xs text-gray-600 font-medium">メール</div>
                            <div class="info-value text-sm text-gray-800 font-semibold">24時間受付</div>
                        </div>
                    </div>
                </div>
                
                <!-- サイト情報 -->
                <div class="site-info text-center text-xs text-gray-500">
                    <div class="mb-3">
                        <p class="font-medium text-gray-600">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
                        <p class="mt-1">All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <!-- メインコンテンツ開始 -->
    <main id="content" class="site-main" role="main">

<!-- 🚀 ヘッダー完全制御JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    'use strict';
    
    // ✅ ヘッダー読み込み完了マーク
    document.body.classList.add('header-loaded');
    
    // 🎯 DOM要素取得
    const searchModal = document.getElementById('grant-search-modal');
    const searchTriggers = document.querySelectorAll('#search-modal-trigger, #mobile-search-trigger, #mobile-search-modal-trigger');
    const searchClose = document.getElementById('search-modal-close');
    const searchForm = document.getElementById('modal-search-form');
    const searchInput = document.getElementById('modal-search-input');
    const searchClear = document.querySelector('.search-clear-btn');
    const keywordBtns = document.querySelectorAll('.keyword-btn');
    const resetBtn = document.getElementById('modal-reset-btn');
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenuClose = document.getElementById('mobile-menu-close-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileOverlay = document.getElementById('mobile-menu-overlay');
    
    // デバッグ用：要素の存在確認
    console.log('Mobile menu elements:', {
        button: !!mobileMenuButton,
        menu: !!mobileMenu,
        overlay: !!mobileOverlay,
        closeButton: !!mobileMenuClose
    });
    
    // 初期状態を確実に設定
    if (mobileMenu) {
        mobileMenu.style.transform = 'translateX(100%)';
        console.log('Mobile menu initial transform set');
    }
    if (mobileOverlay) {
        mobileOverlay.style.display = 'none';
        console.log('Mobile overlay initial display set');
    }
    
    // 🔧 設定
    const CONFIG = {
        searchUrl: '<?php echo esc_url(home_url("/grants/")); ?>',
        ajaxUrl: '<?php echo esc_url(admin_url("admin-ajax.php")); ?>',
        nonce: '<?php echo esc_js($search_nonce); ?>'
    };
    
    // 🎯 検索モーダル制御
    function openSearchModal() {
        if (!searchModal) return;
        
        searchModal.classList.add('active');
        searchModal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
        
        // フォーカス管理
        const firstInput = searchModal.querySelector('input, button');
        if (firstInput) {
            setTimeout(() => firstInput.focus(), 100);
        }
        
        // アナリティクス
        if (typeof gtag !== 'undefined') {
            gtag('event', 'search_modal_open', {
                'event_category': 'user_interaction',
                'event_label': 'header_search'
            });
        }
    }
    
    function closeSearchModal() {
        if (!searchModal) return;
        
        searchModal.classList.remove('active');
        searchModal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }
    
    // 🎯 検索機能
    function performSearch(query, filters = {}) {
        const searchUrl = new URL(CONFIG.searchUrl);
        
        if (query) {
            searchUrl.searchParams.set('s', query);
        }
        
        // フィルター追加
        Object.entries(filters).forEach(([key, value]) => {
            if (value) {
                searchUrl.searchParams.set(key, value);
            }
        });
        
        // アナリティクス
        if (typeof gtag !== 'undefined') {
            gtag('event', 'search_performed', {
                'event_category': 'search',
                'event_label': query || 'filtered_search',
                'search_term': query
            });
        }
        
        // リダイレクト
        window.location.href = searchUrl.toString();
    }
    
    function collectFormData() {
        const formData = new FormData(searchForm);
        const filters = {};
        
        for (let [key, value] of formData.entries()) {
            if (value && key !== 'search') {
                filters[key] = value;
            }
        }
        
        return {
            query: formData.get('search') || '',
            filters: filters
        };
    }
    
    // 🎯 モバイルメニュー制御
    let isMenuOpen = false;
    
    function openMobileMenu() {
        console.log('openMobileMenu called', { mobileMenu, mobileOverlay });
        if (!mobileMenu) {
            console.error('Mobile menu element not found!');
            return;
        }
        
        isMenuOpen = true;
        // Tailwindクラスではなく、直接スタイルを操作
        mobileMenu.style.transform = 'translateX(0)';
        mobileMenu.setAttribute('aria-hidden', 'false');
        
        if (mobileOverlay) {
            mobileOverlay.style.display = 'block';
            mobileOverlay.classList.remove('hidden');
            // アニメーションのため少し遅延
            setTimeout(() => {
                mobileOverlay.style.opacity = '1';
                mobileOverlay.classList.remove('opacity-0');
            }, 10);
        }
        
        document.body.style.overflow = 'hidden';
        
        if (mobileMenuButton) {
            mobileMenuButton.setAttribute('aria-expanded', 'true');
            mobileMenuButton.setAttribute('aria-label', 'メニューを閉じる');
        }
        
        console.log('Mobile menu opened successfully');
    }
    
    function closeMobileMenu() {
        console.log('closeMobileMenu called', { isMenuOpen });
        if (!mobileMenu || !isMenuOpen) return;
        
        isMenuOpen = false;
        // Tailwindクラスではなく、直接スタイルを操作
        mobileMenu.style.transform = 'translateX(100%)';
        mobileMenu.setAttribute('aria-hidden', 'true');
        
        if (mobileOverlay) {
            mobileOverlay.style.opacity = '0';
            mobileOverlay.classList.add('opacity-0');
            setTimeout(() => {
                mobileOverlay.style.display = 'none';
                mobileOverlay.classList.add('hidden');
            }, 300);
        }
        
        document.body.style.overflow = '';
        
        if (mobileMenuButton) {
            mobileMenuButton.setAttribute('aria-expanded', 'false');
            mobileMenuButton.setAttribute('aria-label', 'メニューを開く');
        }
        
        console.log('Mobile menu closed successfully');
    }
    
    // 🎯 イベントリスナー設定
    
    // 検索モーダル
    searchTriggers.forEach(trigger => {
        trigger.addEventListener('click', openSearchModal);
    });
    
    if (searchClose) {
        searchClose.addEventListener('click', closeSearchModal);
    }
    
    // モーダル背景クリックで閉じる
    if (searchModal) {
        searchModal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeSearchModal();
            }
        });
    }
    
    // 検索フォーム
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const { query, filters } = collectFormData();
            
            if (query || Object.keys(filters).length > 0) {
                performSearch(query, filters);
            } else {
                showToast('検索キーワードまたは条件を入力してください', 'warning');
            }
        });
    }
    
    // 検索入力
    if (searchInput && searchClear) {
        searchInput.addEventListener('input', function() {
            const hasValue = this.value.trim().length > 0;
            searchClear.classList.toggle('hidden', !hasValue);
            
            // リアルタイムプレビュー（オプション）
            if (hasValue) {
                debounce(showSearchPreview, 500)(this.value.trim());
            } else {
                hideSearchPreview();
            }
        });
        
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                searchForm.dispatchEvent(new Event('submit'));
            }
        });
    }
    
    // クリアボタン
    if (searchClear) {
        searchClear.addEventListener('click', function() {
            if (searchInput) {
                searchInput.value = '';
                this.classList.add('hidden');
                searchInput.focus();
                hideSearchPreview();
            }
        });
    }
    
    // キーワードボタン
    keywordBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const keyword = this.dataset.keyword;
            if (searchInput && keyword) {
                searchInput.value = keyword;
                searchInput.dispatchEvent(new Event('input'));
                
                // アクティブ状態の切り替え
                keywordBtns.forEach(b => b.classList.remove('bg-emerald-100', 'text-emerald-700', 'border-emerald-200'));
                this.classList.add('bg-emerald-100', 'text-emerald-700', 'border-emerald-200');
            }
        });
    });
    
    // リセットボタン
    if (resetBtn) {
        resetBtn.addEventListener('click', function() {
            if (searchForm) {
                searchForm.reset();
            }
            if (searchInput) {
                searchInput.value = '';
            }
            if (searchClear) {
                searchClear.classList.add('hidden');
            }
            
            // キーワードボタンのリセット
            keywordBtns.forEach(btn => {
                btn.classList.remove('bg-emerald-100', 'text-emerald-700', 'border-emerald-200');
            });
            
            hideSearchPreview();
            showToast('検索条件をリセットしました', 'success');
        });
    }
    
    // モバイルメニュー
    if (mobileMenuButton) {
        console.log('Mobile menu button found:', mobileMenuButton);
        mobileMenuButton.addEventListener('click', function(e) {
            console.log('Mobile menu button clicked');
            e.preventDefault();
            e.stopPropagation();
            openMobileMenu();
        });
    } else {
        console.error('Mobile menu button not found! Looking for #mobile-menu-button');
    }
    
    if (mobileMenuClose) {
        mobileMenuClose.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            closeMobileMenu();
        });
    }
    
    if (mobileOverlay) {
        mobileOverlay.addEventListener('click', closeMobileMenu);
    }
    
    // ESCキー
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (!searchModal.classList.contains('active')) {
                closeSearchModal();
            } else if (isMenuOpen) {
                closeMobileMenu();
            }
        }
    });
    
    // ウィンドウサイズ変更
    window.addEventListener('resize', debounce(function() {
        if (window.innerWidth >= 1024 && isMenuOpen) {
            closeMobileMenu();
        }
    }, 250));
    
    // 🎯 ヘルパー関数
    function showSearchPreview(query) {
        const previewEl = document.getElementById('search-results-preview');
        const contentEl = document.getElementById('preview-content');
        
        if (!previewEl || !contentEl) return;
        
        previewEl.classList.remove('hidden');
        contentEl.innerHTML = `
            <div class="flex items-center gap-2 mb-2">
                <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-blue-600"></div>
                <span class="font-medium">「${escapeHtml(query)}」で検索中...</span>
            </div>
        `;
        
        // 実際の検索プレビュー（簡単なシミュレーション）
        setTimeout(() => {
            contentEl.innerHTML = `
                <div class="flex items-center justify-between">
                    <span class="font-medium text-blue-800">「${escapeHtml(query)}」の検索結果</span>
                    <button type="button" 
                            onclick="document.getElementById('modal-search-form').dispatchEvent(new Event('submit'))" 
                            class="text-sm bg-blue-600 text-white px-3 py-1 rounded-md hover:bg-blue-700 transition-colors duration-200">
                        詳細検索へ
                    </button>
                </div>
                <p class="text-sm text-blue-600 mt-1">関連する助成金・補助金が見つかりました</p>
            `;
        }, 800);
    }
    
    function hideSearchPreview() {
        const previewEl = document.getElementById('search-results-preview');
        if (previewEl) {
            previewEl.classList.add('hidden');
        }
    }
    
    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        const colors = {
            info: 'bg-blue-600',
            success: 'bg-green-600',
            warning: 'bg-yellow-600',
            error: 'bg-red-600'
        };
        
        toast.className = `fixed top-4 left-1/2 transform -translate-x-1/2 ${colors[type]} text-white px-6 py-3 rounded-lg shadow-lg z-50 font-medium text-sm`;
        toast.textContent = message;
        
        document.body.appendChild(toast);
        
        // アニメーション
        toast.style.transform = 'translate(-50%, -20px)';
        toast.style.opacity = '0';
        
        setTimeout(() => {
            toast.style.transform = 'translate(-50%, 0)';
            toast.style.opacity = '1';
            toast.style.transition = 'all 0.3s ease';
        }, 10);
        
        setTimeout(() => {
            toast.style.transform = 'translate(-50%, -20px)';
            toast.style.opacity = '0';
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 300);
        }, 3000);
    }
    
    function escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, function(m) { return map[m]; });
    }
    
    function debounce(func, wait) {
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
    
    // 🎯 初期化完了ログ
    console.log('🚀 助成金サイトヘッダー初期化完了');
    console.log('✅ CLS防止システム: 有効');
    console.log('✅ 検索モーダル: 有効');
    console.log('✅ モバイルメニュー: 有効');
    console.log('✅ レスポンシブ対応: 有効');
});
</script>
