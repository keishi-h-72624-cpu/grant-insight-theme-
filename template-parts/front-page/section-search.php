<?php
/**
 * Mobile & Desktop Optimized Search Section Template
 * Grant Insight Perfect - 適切な文字サイズ調整版
 * 
 * 既存のWordPress関数と完全連携した検索セクション
 * template-parts/grant-card-v4-enhanced.php を使用
 */

// セキュリティチェック
if (!defined('ABSPATH')) {
    exit;
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

// 必要なデータを取得
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

// カテゴリとタグの取得
$grant_categories = get_terms(array(
    'taxonomy' => 'grant_category',
    'hide_empty' => false,
    'number' => 15
));

$popular_tags = get_terms(array(
    'taxonomy' => 'post_tag',
    'hide_empty' => true,
    'orderby' => 'count',
    'order' => 'DESC',
    'number' => 8
));

// エラーハンドリング
if (is_wp_error($grant_categories)) {
    $grant_categories = array();
}
if (is_wp_error($popular_tags)) {
    $popular_tags = array();
}

// nonce生成
$search_nonce = wp_create_nonce('gi_ajax_nonce');
?>

<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- 検索セクション -->
<section id="search-section" class="search-section" role="search" aria-label="助成金検索">
    
    <!-- ヒーローエリア（文字部分のみ背景画像） -->
    <div class="hero-area">
        <!-- 文字部分のみ背景画像適用 -->
        <div class="hero-text-background">
            <!-- 背景画像レイヤー（文字部分のみ） -->
            <div class="hero-background-layers">
                <!-- メイン背景（画像1：テクノロジーネットワーク） -->
                <div class="bg-layer bg-main" style="background-image: url('https://page.gensparksite.com/v1/base64_upload/fe6a66ba8fcaee5ac836877d3e1106a8')"></div>
                
                <!-- 右上装飾（画像2：ビジネス成長チャート） -->
                <div class="bg-layer bg-decoration-top" style="background-image: url('https://page.gensparksite.com/v1/base64_upload/2cfbd4a6540d4cb7c01cab8f934e3353')"></div>
                
                <!-- 左下装飾（画像3：3Dネットワーク） -->
                <div class="bg-layer bg-decoration-bottom" style="background-image: url('https://page.gensparksite.com/v1/base64_upload/a8e205a3540754684e88dd0914a3f93e')"></div>
                
                <!-- グラデーションオーバーレイ -->
                <div class="gradient-overlay"></div>
                
                <!-- アニメーション要素 -->
                <div class="floating-elements">
                    <div class="floating-circle circle-1"></div>
                    <div class="floating-circle circle-2"></div>
                    <div class="floating-circle circle-3"></div>
                    <div class="floating-circle circle-4"></div>
                    <div class="floating-circle circle-5"></div>
                </div>
            </div>
            
            <div class="container">
                <div class="hero-content">
                    <div class="hero-badge">
                        <i class="fas fa-search pulse"></i>
                        <span>AI搭載検索システム</span>
                    </div>
                    
                    <h1 class="hero-title">
                        業種・目的別 助成金検索
                    </h1>
                    
                    <p class="hero-subtitle">
                        あなたの事業分野に最適な助成金・補助金を効率的に見つけましょう
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- 統計カードセクション（背景画像なし） -->
    <div class="stats-section">
        <div class="container">
            <div class="stats-container">
                <?php
                $stats_data = array(
                    array(
                        'count' => $search_stats['total_grants'],
                        'label' => '助成金',
                        'icon' => 'fas fa-coins',
                        'gradient' => 'linear-gradient(145deg, #2c5f2d 0%, #4ade80 100%)',
                        'description' => '全国の助成金'
                    ),
                    array(
                        'count' => $search_stats['total_tools'],
                        'label' => 'ツール',
                        'icon' => 'fas fa-tools',
                        'gradient' => 'linear-gradient(145deg, #1e3a8a 0%, #3b82f6 100%)',
                        'description' => '便利なツール'
                    ),
                    array(
                        'count' => $search_stats['total_cases'],
                        'label' => '成功事例',
                        'icon' => 'fas fa-trophy',
                        'gradient' => 'linear-gradient(145deg, #581c87 0%, #a855f7 100%)',
                        'description' => '実績のある事例'
                    ),
                    array(
                        'count' => $search_stats['total_guides'],
                        'label' => 'ガイド',
                        'icon' => 'fas fa-book-open',
                        'gradient' => 'linear-gradient(145deg, #b45309 0%, #f59e0b 100%)',
                        'description' => '詳細なガイド'
                    )
                );
                
                foreach ($stats_data as $index => $stat): ?>
                    <div class="stat-card" data-aos="fade-up" data-aos-delay="<?php echo $index * 150; ?>">
                        <div class="stat-icon" style="background: <?php echo esc_attr($stat['gradient']); ?>">
                            <i class="<?php echo esc_attr($stat['icon']); ?>"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-number counter" data-target="<?php echo esc_attr($stat['count']); ?>">0</div>
                            <div class="stat-label"><?php echo esc_html($stat['label']); ?></div>
                            <div class="stat-description"><?php echo esc_html($stat['description']); ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- 検索インターフェース -->
    <div class="search-interface">
        <div class="container">
            <form id="search-form" class="search-form" role="search">
                <!-- 隠しフィールド -->
                <input type="hidden" id="search-nonce" value="<?php echo esc_attr($search_nonce); ?>">
                <input type="hidden" id="ajax-url" value="<?php echo esc_url(admin_url('admin-ajax.php')); ?>">
                
                <!-- メイン検索バー -->
                <div class="search-main-box">
                    <div class="search-main">
                        <div class="search-input-container">
                            <div class="search-icon">
                                <i class="fas fa-search"></i>
                            </div>
                            <input 
                                type="text" 
                                id="main-search-input"
                                name="keyword"
                                class="search-input"
                                placeholder="助成金・補助金を検索..."
                                autocomplete="off"
                                aria-label="検索キーワードを入力"
                            >
                            <div class="search-clear" id="search-clear" style="display: none;">
                                <i class="fas fa-times"></i>
                            </div>
                        </div>
                        
                        <!-- 音声検索ボタン -->
                        <button type="button" class="voice-search-btn" id="voice-search" aria-label="音声で検索">
                            <i class="fas fa-microphone"></i>
                        </button>
                    </div>
                </div>

                <!-- 人気検索ワードボックス -->
                <div class="popular-searches-box">
                    <div class="section-title">
                        <i class="fas fa-fire"></i>
                        人気検索ワード
                    </div>
                    <div class="popular-keywords-grid">
                        <div class="keyword-box">
                            <div class="keyword-category">IT・デジタル</div>
                            <div class="keyword-items">
                                <button type="button" class="keyword-tag" data-tag="IT導入補助金">IT導入補助金</button>
                                <button type="button" class="keyword-tag" data-tag="DX推進">DX推進</button>
                                <button type="button" class="keyword-tag" data-tag="デジタル化">デジタル化</button>
                            </div>
                        </div>

                        <div class="keyword-box">
                            <div class="keyword-category">事業拡大</div>
                            <div class="keyword-items">
                                <button type="button" class="keyword-tag" data-tag="小規模事業者持続化補助金">持続化補助金</button>
                                <button type="button" class="keyword-tag" data-tag="ものづくり補助金">ものづくり補助金</button>
                                <button type="button" class="keyword-tag" data-tag="事業再構築補助金">事業再構築</button>
                            </div>
                        </div>

                        <div class="keyword-box">
                            <div class="keyword-category">雇用・人材</div>
                            <div class="keyword-items">
                                <button type="button" class="keyword-tag" data-tag="雇用関係助成金">雇用助成金</button>
                                <button type="button" class="keyword-tag" data-tag="人材育成">人材育成</button>
                                <button type="button" class="keyword-tag" data-tag="働き方改革">働き方改革</button>
                            </div>
                        </div>

                        <div class="keyword-box">
                            <div class="keyword-category">創業・スタートアップ</div>
                            <div class="keyword-items">
                                <button type="button" class="keyword-tag" data-tag="創業支援">創業支援</button>
                                <button type="button" class="keyword-tag" data-tag="スタートアップ">スタートアップ</button>
                                <button type="button" class="keyword-tag" data-tag="新規事業">新規事業</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- フィルターボックス -->
                <div class="filters-box">
                    <div class="section-title">
                        <i class="fas fa-filter"></i>
                        詳細検索フィルター
                    </div>
                    <div class="filters-grid">
                        <!-- カテゴリフィルター -->
                        <div class="filter-group">
                            <label class="filter-label">
                                <i class="fas fa-folder"></i>
                                カテゴリ
                            </label>
                            <div class="custom-select">
                                <select id="category-filter" name="category" aria-label="カテゴリを選択">
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
                        </div>

                        <!-- 都道府県フィルター -->
                        <div class="filter-group">
                            <label class="filter-label">
                                <i class="fas fa-map-marker-alt"></i>
                                地域
                            </label>
                            <div class="custom-select">
                                <select id="prefecture-filter" name="prefecture" aria-label="都道府県を選択">
                                    <option value="">全国対象</option>
                                    <?php foreach ($prefectures as $prefecture): ?>
                                        <option value="<?php echo esc_attr($prefecture); ?>">
                                            <?php echo esc_html($prefecture); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- 金額フィルター -->
                        <div class="filter-group">
                            <label class="filter-label">
                                <i class="fas fa-yen-sign"></i>
                                金額
                            </label>
                            <div class="custom-select">
                                <select id="amount-filter" name="amount" aria-label="金額範囲を選択">
                                    <option value="">金額指定なし</option>
                                    <option value="0-100">100万円以下</option>
                                    <option value="100-500">100-500万円</option>
                                    <option value="500-1000">500-1000万円</option>
                                    <option value="1000+">1000万円以上</option>
                                </select>
                            </div>
                        </div>

                        <!-- ステータスフィルター -->
                        <div class="filter-group">
                            <label class="filter-label">
                                <i class="fas fa-circle"></i>
                                ステータス
                            </label>
                            <div class="custom-select">
                                <select id="status-filter" name="status" aria-label="ステータスを選択">
                                    <option value="">すべてのステータス</option>
                                    <option value="active">募集中</option>
                                    <option value="upcoming">募集予定</option>
                                    <option value="closed">募集終了</option>
                                </select>
                            </div>
                        </div>

                        <!-- 難易度フィルター -->
                        <div class="filter-group">
                            <label class="filter-label">
                                <i class="fas fa-star"></i>
                                申請難易度
                            </label>
                            <div class="custom-select">
                                <select id="difficulty-filter" name="difficulty" aria-label="申請難易度を選択">
                                    <option value="">すべての難易度</option>
                                    <option value="easy">易しい</option>
                                    <option value="normal">普通</option>
                                    <option value="hard">難しい</option>
                                    <option value="expert">専門的</option>
                                </select>
                            </div>
                        </div>

                        <!-- 並び順フィルター -->
                        <div class="filter-group">
                            <label class="filter-label">
                                <i class="fas fa-sort"></i>
                                並び順
                            </label>
                            <div class="custom-select">
                                <select id="sort-filter" name="orderby" aria-label="並び順を選択">
                                    <option value="date_desc">新着順</option>
                                    <option value="amount_desc">金額の高い順</option>
                                    <option value="amount_asc">金額の安い順</option>
                                    <option value="success_rate_desc">採択率の高い順</option>
                                    <option value="deadline_asc">締切の近い順</option>
                                    <option value="title_asc">タイトル順</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 検索ボタンエリア -->
                <div class="search-actions">
                    <button type="submit" class="search-submit-btn" id="search-submit">
                        <span class="btn-content">
                            <i class="fas fa-search"></i>
                            <span class="btn-text">検索する</span>
                        </span>
                        <div class="btn-loading" style="display: none;">
                            <div class="spinner"></div>
                            <span>検索中...</span>
                        </div>
                    </button>
                    
                    <button type="button" class="reset-btn" id="reset-search">
                        <i class="fas fa-redo"></i>
                        <span class="mobile-hidden">リセット</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- 検索結果エリア（常時表示） -->
    <div class="search-results-section" id="search-results">
        <div class="container">
            <!-- 結果ヘッダー -->
            <div class="results-header">
                <div class="results-info" id="results-info">
                    <span style="color: #3b82f6; font-weight: 600;">全ての助成金</span>を表示しています
                </div>
                <div class="results-actions">
                    <div class="view-toggle">
                        <button class="view-btn active" data-view="grid" id="grid-view" aria-label="グリッド表示">
                            <i class="fas fa-th"></i>
                        </button>
                        <button class="view-btn" data-view="list" id="list-view" aria-label="リスト表示">
                            <i class="fas fa-list"></i>
                        </button>
                    </div>
                    <button class="export-btn" id="export-results" aria-label="結果をエクスポート">
                        <i class="fas fa-download"></i>
                        <span class="desktop-only">エクスポート</span>
                    </button>
                </div>
            </div>

            <!-- 結果一覧 -->
            <div class="results-container" id="results-container">
                <!-- 初期状態では人気の助成金を表示 -->
                <div class="initial-results">
                    <div class="results-placeholder">
                        <div class="placeholder-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3>助成金を見つけよう</h3>
                        <p>上記の検索ボックスまたは人気検索ワードから検索を始めてください。</p>
                    </div>
                </div>
            </div>

            <!-- ページネーション -->
            <div class="pagination-container" id="pagination-container">
                <!-- ページネーションがここに表示される -->
            </div>
        </div>
    </div>

    <!-- ローディング表示 -->
    <div class="loading-overlay" id="search-loading" style="display: none;">
        <div class="loading-content">
            <div class="loading-spinner">
                <div class="spinner-circle"></div>
                <div class="spinner-circle"></div>
                <div class="spinner-circle"></div>
            </div>
            <p class="loading-text">検索中...</p>
        </div>
    </div>

    <!-- エラー表示 -->
    <div class="error-overlay" id="search-error" style="display: none;">
        <div class="error-content">
            <div class="error-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h3 class="error-title">検索エラー</h3>
            <p class="error-message" id="error-message">
                検索中にエラーが発生しました。
            </p>
            <button class="error-retry-btn" id="retry-search">
                <i class="fas fa-redo"></i>
                再試行
            </button>
        </div>
    </div>
</section>

<!-- CSS スタイル -->
<style>
/* ベーススタイル */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

.search-section {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Noto Sans JP', 'Hiragino Kaku Gothic ProN', 'Meiryo', sans-serif;
    background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
    position: relative;
    overflow: hidden;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

/* ヒーローエリア - 文字部分のみに背景適用 */
.hero-area {
    position: relative;
    padding: 0;
    color: white;
    text-align: center;
}

.hero-text-background {
    position: relative;
    padding: 3rem 0 2.5rem;
    background: #1e293b;
    overflow: hidden;
}

.hero-background-layers {
    position: absolute;
    inset: 0;
    z-index: 1;
}

.bg-layer {
    position: absolute;
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
}

/* メイン背景 - テクノロジーネットワーク（画像1） */
.bg-main {
    inset: 0;
    opacity: 0.4;
    filter: brightness(0.7);
}

/* 右上装飾 - ビジネス成長チャート（画像2） */
.bg-decoration-top {
    top: -20%;
    right: -10%;
    width: 50%;
    height: 50%;
    opacity: 0.15;
    background-size: contain;
    transform: rotate(-10deg);
}

/* 左下装飾 - 3Dネットワーク（画像3） */
.bg-decoration-bottom {
    bottom: -25%;
    left: -15%;
    width: 60%;
    height: 60%;
    opacity: 0.12;
    background-size: contain;
    transform: rotate(15deg);
    filter: blur(0.5px);
}

/* グラデーションオーバーレイ */
.gradient-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        135deg,
        rgba(30, 41, 59, 0.85) 0%,
        rgba(51, 65, 85, 0.65) 50%,
        rgba(71, 85, 105, 0.75) 100%
    );
    z-index: 2;
}

/* フローティングアニメーション要素 */
.floating-elements {
    position: absolute;
    inset: 0;
    z-index: 3;
    pointer-events: none;
}

.floating-circle {
    position: absolute;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.08), rgba(255, 255, 255, 0.02));
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    animation: float-elegant 12s ease-in-out infinite;
}

.circle-1 {
    width: 60px;
    height: 60px;
    top: 20%;
    left: 15%;
    animation-delay: 0s;
}

.circle-2 {
    width: 40px;
    height: 40px;
    top: 35%;
    right: 20%;
    animation-delay: 4s;
}

.circle-3 {
    width: 80px;
    height: 80px;
    bottom: 30%;
    left: 10%;
    animation-delay: 8s;
}

.circle-4 {
    width: 30px;
    height: 30px;
    bottom: 50%;
    right: 15%;
    animation-delay: 2s;
}

.circle-5 {
    width: 50px;
    height: 50px;
    top: 50%;
    left: 45%;
    animation-delay: 6s;
}

@keyframes float-elegant {
    0%, 100% {
        transform: translateY(0px) rotate(0deg) scale(1);
        opacity: 0.2;
    }
    25% {
        transform: translateY(-10px) rotate(45deg) scale(1.05);
        opacity: 0.4;
    }
    50% {
        transform: translateY(-20px) rotate(90deg) scale(0.95);
        opacity: 0.25;
    }
    75% {
        transform: translateY(-8px) rotate(135deg) scale(1.02);
        opacity: 0.35;
    }
}

.hero-content {
    position: relative;
    z-index: 10;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.12), rgba(255, 255, 255, 0.08));
    backdrop-filter: blur(20px);
    padding: 0.5rem 1.25rem;
    border-radius: 30px;
    margin-bottom: 1rem;
    font-weight: 600;
    border: 1px solid rgba(255, 255, 255, 0.15);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    font-size: 0.8rem;
    letter-spacing: 0.3px;
}

.pulse {
    animation: pulse-refined 3s infinite;
}

@keyframes pulse-refined {
    0%, 100% {
        transform: scale(1);
        filter: brightness(1);
    }
    50% {
        transform: scale(1.05);
        filter: brightness(1.2);
    }
}

.hero-title {
    font-size: 2rem;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 0.75rem;
    letter-spacing: -0.01em;
    color: #ffffff;
}

.hero-subtitle {
    font-size: 1rem;
    opacity: 0.9;
    margin-bottom: 0;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.6;
    font-weight: 400;
    color: #e2e8f0;
}

/* 統計セクション（背景画像なし） */
.stats-section {
    padding: 2.5rem 0 1.5rem;
    background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
    position: relative;
}

.stats-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(148, 163, 184, 0.3), transparent);
}

.stats-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    max-width: 800px;
    margin: 0 auto;
}

.stat-card {
    background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
    border-radius: 16px;
    padding: 1.5rem 1.25rem;
    text-align: center;
    border: 1px solid rgba(148, 163, 184, 0.1);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    box-shadow: 
        0 2px 12px rgba(0, 0, 0, 0.04),
        0 1px 3px rgba(0, 0, 0, 0.08);
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: var(--card-gradient, linear-gradient(90deg, #3b82f6, #1d4ed8));
    transform: translateX(-100%);
    transition: transform 0.4s ease;
}

.stat-card:hover::before {
    transform: translateX(0);
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 
        0 8px 25px rgba(0, 0, 0, 0.08),
        0 4px 12px rgba(0, 0, 0, 0.06);
    border-color: rgba(148, 163, 184, 0.2);
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    color: white;
    font-size: 1.25rem;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.stat-icon::before {
    content: '';
    position: absolute;
    inset: 0;
    background: inherit;
    filter: blur(8px);
    opacity: 0.3;
}

.stat-icon i {
    position: relative;
    z-index: 2;
    filter: drop-shadow(0 1px 2px rgba(0, 0, 0, 0.2));
}

.stat-number {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: #1e293b;
    line-height: 1;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.8;
    font-weight: 600;
    margin-bottom: 0.25rem;
    color: #475569;
}

.stat-description {
    font-size: 0.75rem;
    opacity: 0.6;
    font-weight: 500;
    color: #64748b;
    line-height: 1.3;
}

/* 検索インターフェース */
.search-interface {
    padding: 2.5rem 0;
    background: #ffffff;
    position: relative;
}

.search-interface::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(148, 163, 184, 0.2), transparent);
}

.search-form {
    max-width: 1000px;
    margin: 0 auto;
}

/* メイン検索バーボックス */
.search-main-box {
    background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
    border: 2px solid #e2e8f0;
    border-radius: 16px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    position: relative;
}

.search-main-box::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, #3b82f6, #10b981, #8b5cf6);
    border-radius: 16px 16px 0 0;
}

/* メイン検索バー */
.search-main {
    display: flex;
    gap: 1rem;
}

.search-input-container {
    flex: 1;
    position: relative;
    background: linear-gradient(145deg, #f8fafc 0%, #f1f5f9 100%);
    border-radius: 12px;
    padding: 0 1.25rem;
    display: flex;
    align-items: center;
    border: 2px solid transparent;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}

.search-input-container:focus-within {
    background: #ffffff;
    border-color: #3b82f6;
    box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
    transform: translateY(-1px);
}

.search-icon {
    color: #64748b;
    margin-right: 0.75rem;
    font-size: 1rem;
    transition: color 0.3s ease;
}

.search-input-container:focus-within .search-icon {
    color: #3b82f6;
}

.search-input {
    flex: 1;
    border: none;
    background: transparent;
    padding: 1rem 0;
    font-size: 0.95rem;
    color: #1e293b;
    outline: none;
    font-weight: 500;
}

.search-input::placeholder {
    color: #94a3b8;
    font-weight: 400;
}

.search-clear {
    color: #94a3b8;
    cursor: pointer;
    padding: 0.5rem;
    border-radius: 50%;
    transition: all 0.3s ease;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.search-clear:hover {
    background: #e2e8f0;
    color: #475569;
    transform: rotate(90deg);
}

.voice-search-btn {
    width: 50px;
    height: 50px;
    background: linear-gradient(145deg, #3b82f6 0%, #1d4ed8 100%);
    border: none;
    border-radius: 12px;
    color: white;
    font-size: 1.1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
}

.voice-search-btn::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.15), transparent);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.voice-search-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(59, 130, 246, 0.3);
}

.voice-search-btn:hover::before {
    opacity: 1;
}

.voice-search-btn.listening {
    animation: pulse-voice 1.5s infinite;
}

@keyframes pulse-voice {
    0%, 100% {
        box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.7);
    }
    50% {
        box-shadow: 0 0 0 15px rgba(59, 130, 246, 0);
    }
}

/* 人気検索ワードボックス */
.popular-searches-box {
    background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
    border: 2px solid #e2e8f0;
    border-radius: 16px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    position: relative;
}

.popular-searches-box::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, #f59e0b, #ef4444, #ec4899);
    border-radius: 16px 16px 0 0;
}

.section-title {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 1.25rem;
    letter-spacing: 0.2px;
}

.section-title i {
    color: #f59e0b;
    font-size: 0.9rem;
}

/* 人気検索ワードグリッド */
.popular-keywords-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.25rem;
}

.keyword-box {
    background: linear-gradient(145deg, #f8fafc 0%, #f1f5f9 100%);
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 1.25rem;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.keyword-box:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    border-color: #d1d5db;
}

.keyword-category {
    font-size: 0.85rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 1rem;
    text-align: center;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid #e2e8f0;
    position: relative;
}

.keyword-category::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 50%;
    transform: translateX(-50%);
    width: 30px;
    height: 1px;
    background: linear-gradient(90deg, #3b82f6, #10b981);
    border-radius: 1px;
}

.keyword-items {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.keyword-tag {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0.6rem 1rem;
    background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    font-weight: 500;
    color: #374151;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 0.8rem;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
    position: relative;
    overflow: hidden;
}

.keyword-tag::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(45deg, transparent, rgba(59, 130, 246, 0.05), transparent);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.keyword-tag:hover {
    border-color: #3b82f6;
    color: #3b82f6;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
    background: linear-gradient(145deg, #ffffff 0%, #f0f9ff 100%);
}

.keyword-tag:hover::before {
    opacity: 1;
}

.keyword-tag.active {
    background: linear-gradient(145deg, #3b82f6 0%, #1d4ed8 100%);
    color: white;
    border-color: transparent;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.25);
}

/* フィルターボックス */
.filters-box {
    background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
    border: 2px solid #e2e8f0;
    border-radius: 16px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    position: relative;
}

.filters-box::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, #8b5cf6, #3b82f6, #10b981);
    border-radius: 16px 16px 0 0;
}

/* フィルターグリッド */
.filters-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.25rem;
}

.filter-group {
    display: flex;
    flex-direction: column;
}

.filter-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.75rem;
    font-size: 0.8rem;
}

.filter-label i {
    width: 14px;
    color: #6b7280;
    text-align: center;
    font-size: 0.75rem;
}

.custom-select {
    position: relative;
}

.custom-select select {
    width: 100%;
    padding: 0.8rem 1rem;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
    color: #374151;
    font-size: 0.85rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 0.75rem center;
    background-repeat: no-repeat;
    background-size: 12px 8px;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
}

.custom-select select:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
    background: #ffffff;
}

.custom-select select:hover {
    border-color: #d1d5db;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
}

/* 検索アクション */
.search-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    align-items: center;
}

.search-submit-btn {
    flex: 1;
    max-width: 300px;
    background: linear-gradient(145deg, #10b981 0%, #059669 100%);
    border: none;
    border-radius: 12px;
    padding: 1rem 2rem;
    color: white;
    font-size: 0.95rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
    letter-spacing: 0.3px;
}

.search-submit-btn::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.15), transparent);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.search-submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.3);
}

.search-submit-btn:hover::before {
    opacity: 1;
}

.search-submit-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

.btn-content {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.btn-loading {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.spinner {
    width: 16px;
    height: 16px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

.reset-btn {
    padding: 1rem 1.5rem;
    background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    color: #6b7280;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    min-width: 100px;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
    font-size: 0.9rem;
}

.reset-btn:hover {
    border-color: #d1d5db;
    color: #374151;
    background: linear-gradient(145deg, #f9fafb 0%, #f1f5f9 100%);
    transform: translateY(-1px);
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
}

/* 検索結果エリア（常時表示） */
.search-results-section {
    padding: 2.5rem 0;
    background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
    min-height: 40vh;
}

.results-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding: 1.25rem 1.5rem;
    background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    border: 1px solid rgba(148, 163, 184, 0.1);
}

.results-info {
    font-size: 0.95rem;
    color: #374151;
    font-weight: 500;
}

.results-actions {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.view-toggle {
    display: flex;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    overflow: hidden;
    background: #ffffff;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
}

.view-btn {
    padding: 0.6rem 0.8rem;
    border: none;
    background: transparent;
    color: #6b7280;
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 0.9rem;
}

.view-btn.active {
    background: linear-gradient(145deg, #3b82f6 0%, #1d4ed8 100%);
    color: white;
    box-shadow: 0 1px 4px rgba(59, 130, 246, 0.2);
}

.export-btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.6rem 1rem;
    background: linear-gradient(145deg, #059669 0%, #047857 100%);
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(5, 150, 105, 0.2);
    font-size: 0.85rem;
}

.export-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
}

.results-container {
    display: grid;
    gap: 1.5rem;
}

.results-container.grid-view {
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
}

.results-container.list-view {
    grid-template-columns: 1fr;
}

/* 初期表示用プレースホルダー */
.initial-results {
    grid-column: 1 / -1;
}

.results-placeholder {
    text-align: center;
    padding: 3rem 1.5rem;
    background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
    border: 1px dashed #e2e8f0;
    border-radius: 16px;
    color: #6b7280;
}

.placeholder-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(145deg, #f1f5f9 0%, #e2e8f0 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 1.5rem;
    color: #94a3b8;
}

.results-placeholder h3 {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
    color: #374151;
}

.results-placeholder p {
    font-size: 0.9rem;
    line-height: 1.5;
}

/* ページネーション */
.pagination-container {
    margin-top: 2rem;
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.pagination-btn {
    min-width: 40px;
    height: 40px;
    border: 1px solid #e5e7eb;
    background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
    border-radius: 8px;
    color: #6b7280;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 500;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
    font-size: 0.85rem;
}

.pagination-btn:hover {
    border-color: #3b82f6;
    color: #3b82f6;
    transform: translateY(-1px);
    box-shadow: 0 2px 6px rgba(59, 130, 246, 0.1);
}

.pagination-btn.active {
    background: linear-gradient(145deg, #3b82f6 0%, #1d4ed8 100%);
    color: white;
    border-color: #3b82f6;
    box-shadow: 0 2px 8px rgba(59, 130, 246, 0.2);
}

/* ローディング */
.loading-overlay {
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.7);
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(4px);
}

.loading-content {
    background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
    padding: 2rem;
    border-radius: 16px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    max-width: 250px;
}

.loading-spinner {
    display: flex;
    gap: 0.5rem;
    justify-content: center;
    margin-bottom: 1.25rem;
}

.spinner-circle {
    width: 10px;
    height: 10px;
    background: #3b82f6;
    border-radius: 50%;
    animation: loading-bounce 1.4s ease-in-out infinite both;
}

.spinner-circle:nth-child(1) {
    animation-delay: -0.32s;
}

.spinner-circle:nth-child(2) {
    animation-delay: -0.16s;
}

@keyframes loading-bounce {
    0%, 80%, 100% {
        transform: scale(0);
    }
    40% {
        transform: scale(1);
    }
}

.loading-text {
    color: #374151;
    font-weight: 500;
    font-size: 0.95rem;
}

/* エラー表示 */
.error-overlay {
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.7);
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    backdrop-filter: blur(4px);
}

.error-content {
    background: linear-gradient(145deg, #ffffff 0%, #fef2f2 100%);
    padding: 2.5rem;
    border-radius: 16px;
    text-align: center;
    max-width: 350px;
    width: 100%;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(254, 226, 226, 0.5);
}

.error-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(145deg, #fef2f2 0%, #fee2e2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: #ef4444;
    font-size: 1.5rem;
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.1);
}

.error-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 1rem;
}

.error-message {
    color: #6b7280;
    margin-bottom: 2rem;
    line-height: 1.5;
    font-size: 0.9rem;
}

.error-retry-btn {
    background: linear-gradient(145deg, #ef4444 0%, #dc2626 100%);
    color: white;
    border: none;
    padding: 0.8rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin: 0 auto;
    box-shadow: 0 2px 8px rgba(239, 68, 68, 0.2);
    font-size: 0.9rem;
}

.error-retry-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
}

/* レスポンシブ対応 */

/* タブレット (768px以下) */
@media (max-width: 768px) {
    .container {
        padding: 0 1rem;
    }

    .hero-text-background {
        padding: 2.5rem 0 2rem;
    }

    .hero-title {
        font-size: 1.5rem;
    }

    .hero-subtitle {
        font-size: 0.9rem;
    }

    .stats-section {
        padding: 2rem 0 1rem;
    }

    /* 統計カード 2×2レイアウト */
    .stats-container {
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        max-width: 400px;
    }

    .stat-card {
        padding: 1.25rem 1rem;
    }

    .stat-icon {
        width: 40px;
        height: 40px;
        font-size: 1rem;
        margin-bottom: 0.75rem;
    }

    .stat-number {
        font-size: 1.5rem;
    }

    .stat-label {
        font-size: 0.8rem;
        margin-bottom: 0.25rem;
    }

    .stat-description {
        font-size: 0.7rem;
        display: none; /* モバイルでは非表示 */
    }

    .search-interface {
        padding: 2rem 0;
    }

    .search-main-box,
    .popular-searches-box,
    .filters-box {
        padding: 1.25rem;
        margin-bottom: 1.5rem;
    }

    .search-main {
        flex-direction: column;
    }

    .voice-search-btn {
        width: 100%;
        height: 45px;
    }

    /* 人気検索ワード 2列レイアウト */
    .popular-keywords-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    .keyword-box {
        padding: 1rem;
    }

    .keyword-items {
        gap: 0.5rem;
    }

    .keyword-tag {
        padding: 0.5rem 0.8rem;
        font-size: 0.75rem;
    }

    /* フィルター 2列レイアウト */
    .filters-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    .filter-group {
        min-width: 0;
    }

    .custom-select select {
        padding: 0.7rem 0.8rem;
        font-size: 0.8rem;
    }

    .search-actions {
        flex-direction: column;
    }

    .search-submit-btn {
        max-width: none;
        padding: 0.9rem 1.5rem;
        font-size: 0.9rem;
    }

    .reset-btn {
        padding: 0.9rem 1.25rem;
    }

    .results-header {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
        padding: 1rem;
    }

    .results-actions {
        justify-content: space-between;
    }

    .results-container.grid-view {
        grid-template-columns: 1fr;
    }

    .results-placeholder {
        padding: 2.5rem 1rem;
    }

    .placeholder-icon {
        width: 50px;
        height: 50px;
        font-size: 1.25rem;
    }

    .desktop-only {
        display: none;
    }

    .mobile-hidden {
        display: none;
    }
}

/* スマートフォン (480px以下) */
@media (max-width: 480px) {
    .container {
        padding: 0 0.75rem;
    }

    .hero-text-background {
        padding: 2rem 0 1.5rem;
    }

    .hero-badge {
        padding: 0.4rem 1rem;
        font-size: 0.75rem;
    }

    .hero-title {
        font-size: 1.25rem;
    }

    .hero-subtitle {
        font-size: 0.85rem;
    }

    /* 統計カード モバイル最適化 */
    .stats-container {
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
        max-width: 100%;
    }

    .stat-card {
        padding: 1rem 0.75rem;
        border-radius: 12px;
    }

    .stat-icon {
        width: 35px;
        height: 35px;
        font-size: 0.9rem;
        margin-bottom: 0.6rem;
    }

    .stat-number {
        font-size: 1.25rem;
    }

    .stat-label {
        font-size: 0.75rem;
        line-height: 1.2;
    }

    .search-main-box,
    .popular-searches-box,
    .filters-box {
        padding: 1rem;
        border-radius: 12px;
    }

    .search-input-container,
    .voice-search-btn,
    .search-submit-btn,
    .reset-btn {
        border-radius: 10px;
    }

    /* 人気検索ワード スマホ最適化 */
    .popular-keywords-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    .keyword-box {
        padding: 0.9rem;
    }

    .keyword-category {
        font-size: 0.8rem;
        margin-bottom: 0.9rem;
    }

    .keyword-tag {
        font-size: 0.7rem;
        padding: 0.5rem 0.7rem;
    }

    /* フィルター スマホ最適化 */
    .filters-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    .filter-label {
        font-size: 0.75rem;
        margin-bottom: 0.6rem;
    }

    .custom-select select {
        padding: 0.65rem 0.7rem;
        font-size: 0.75rem;
    }

    .section-title {
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .pagination-container {
        gap: 0.4rem;
    }

    .pagination-btn {
        min-width: 35px;
        height: 35px;
        font-size: 0.8rem;
    }

    .loading-content,
    .error-content {
        padding: 1.5rem;
        margin: 0 0.75rem;
    }

    .results-placeholder {
        padding: 2rem 0.75rem;
    }

    .placeholder-icon {
        width: 40px;
        height: 40px;
        font-size: 1rem;
        margin-bottom: 1rem;
    }

    .results-placeholder h3 {
        font-size: 1rem;
    }

    .results-placeholder p {
        font-size: 0.85rem;
    }
}

/* 極小画面 (360px以下) */
@media (max-width: 360px) {
    .container {
        padding: 0 0.5rem;
    }

    .stats-container {
        gap: 0.5rem;
    }

    .stat-card {
        padding: 0.8rem 0.5rem;
    }

    .stat-number {
        font-size: 1.1rem;
    }

    .stat-label {
        font-size: 0.7rem;
    }

    .search-interface {
        padding: 1.5rem 0;
    }

    .search-main-box,
    .popular-searches-box,
    .filters-box {
        padding: 0.8rem;
    }

    .search-input-container {
        padding: 0 1rem;
    }

    .search-input {
        padding: 0.8rem 0;
        font-size: 0.9rem;
    }

    .search-submit-btn {
        padding: 0.8rem 1.25rem;
        font-size: 0.85rem;
    }

    .keyword-box {
        padding: 0.75rem;
    }

    .keyword-tag {
        padding: 0.45rem 0.6rem;
        font-size: 0.65rem;
    }
}

/* 大画面対応 (1200px以上) */
@media (min-width: 1200px) {
    .container {
        max-width: 1400px;
        padding: 0 2.5rem;
    }

    .hero-title {
        font-size: 2.5rem;
    }

    .hero-subtitle {
        font-size: 1.1rem;
    }

    .stats-container {
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
        max-width: 1000px;
    }

    .popular-keywords-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .filters-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }

    .results-container.grid-view {
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    }
}

/* 超大画面対応 (1600px以上) */
@media (min-width: 1600px) {
    .container {
        max-width: 1600px;
    }

    .stats-container {
        max-width: 1200px;
        gap: 2.5rem;
    }

    .popular-keywords-grid {
        grid-template-columns: repeat(4, 1fr);
    }

    .results-container.grid-view {
        grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
    }
}

/* プリント対応 */
@media print {
    .hero-background-layers,
    .floating-elements,
    .voice-search-btn,
    .loading-overlay,
    .error-overlay {
        display: none !important;
    }

    .search-section {
        background: white !important;
        color: black !important;
    }

    .hero-text-background {
        background: white !important;
    }

    .hero-content * {
        color: black !important;
    }
}

/* アクセシビリティ対応 */
@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}


</style>

<!-- JavaScript -->
<script>
// 既存のJavaScriptコードをそのまま使用（変更なし）
document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    // DOM要素の取得
    const searchForm = document.getElementById('search-form');
    const mainSearchInput = document.getElementById('main-search-input');
    const searchClear = document.getElementById('search-clear');
    const voiceSearchBtn = document.getElementById('voice-search');
    const searchSubmitBtn = document.getElementById('search-submit');
    const resetBtn = document.getElementById('reset-search');
    const searchLoading = document.getElementById('search-loading');
    const searchError = document.getElementById('search-error');
    const searchResults = document.getElementById('search-results');
    const resultsContainer = document.getElementById('results-container');
    const resultsInfo = document.getElementById('results-info');
    const paginationContainer = document.getElementById('pagination-container');
    const keywordTags = document.querySelectorAll('.keyword-tag');
    const gridViewBtn = document.getElementById('grid-view');
    const listViewBtn = document.getElementById('list-view');
    const exportBtn = document.getElementById('export-results');
    
    // フィルター要素
    const categoryFilter = document.getElementById('category-filter');
    const prefectureFilter = document.getElementById('prefecture-filter');
    const amountFilter = document.getElementById('amount-filter');
    const statusFilter = document.getElementById('status-filter');
    const difficultyFilter = document.getElementById('difficulty-filter');
    const sortFilter = document.getElementById('sort-filter');
    
    // 設定値
    const CONFIG = {
        debounceDelay: 300,
        apiUrl: document.getElementById('ajax-url')?.value || '/wp-admin/admin-ajax.php',
        nonce: document.getElementById('search-nonce')?.value || '',
        resultsPerPage: 12
    };

    // 状態管理
    let currentSearchParams = {};
    let currentPage = 1;
    let currentView = 'grid';
    let searchHistory = JSON.parse(localStorage.getItem('search_history') || '[]');
    let isVoiceListening = false;
    let debounceTimer = null;
    let abortController = null;

    // 初期化
    init();

    function init() {
        // 統計カウンター初期化
        initCounters();
        
        // イベントリスナー設定
        setupEventListeners();
        
        console.log('🚀 検索システム初期化完了');
    }

    // 統計カウンター
    function initCounters() {
        const counters = document.querySelectorAll('.counter');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(counter => {
            if (counter) observer.observe(counter);
        });
    }

    function animateCounter(element) {
        const target = parseInt(element.dataset.target) || 0;
        const duration = 2000;
        const stepTime = 50;
        const steps = duration / stepTime;
        const increment = target / steps;
        let current = 0;

        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = target.toLocaleString('ja-JP');
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current).toLocaleString('ja-JP');
            }
        }, stepTime);
    }

    // イベントリスナー設定
    function setupEventListeners() {
        // フォーム送信
        if (searchForm) {
            searchForm.addEventListener('submit', handleFormSubmit);
        }
        
        // 検索入力
        if (mainSearchInput) {
            mainSearchInput.addEventListener('input', handleSearchInput);
        }
        
        // クリアボタン
        if (searchClear) {
            searchClear.addEventListener('click', clearSearch);
        }
        
        // 音声検索
        if (voiceSearchBtn) {
            voiceSearchBtn.addEventListener('click', handleVoiceSearch);
        }
        
        // リセットボタン
        if (resetBtn) {
            resetBtn.addEventListener('click', resetSearch);
        }
        
        // キーワードタグ
        keywordTags.forEach(tag => {
            tag.addEventListener('click', handleTagClick);
        });
        
        // フィルター変更
        const filters = [categoryFilter, prefectureFilter, amountFilter, statusFilter, difficultyFilter, sortFilter];
        filters.forEach(filter => {
            if (filter) {
                filter.addEventListener('change', handleFilterChange);
            }
        });
        
        // ビュー切り替え
        if (gridViewBtn) gridViewBtn.addEventListener('click', () => switchView('grid'));
        if (listViewBtn) listViewBtn.addEventListener('click', () => switchView('list'));
        
        // エクスポート
        if (exportBtn) exportBtn.addEventListener('click', exportResults);
        
        // エラー再試行
        const retryBtn = document.getElementById('retry-search');
        if (retryBtn) retryBtn.addEventListener('click', retrySearch);
    }

    // フォーム送信処理
    async function handleFormSubmit(event) {
        event.preventDefault();
        
        if (searchSubmitBtn && searchSubmitBtn.disabled) return;
        
        const searchData = collectFormData();
        
        if (!validateSearchData(searchData)) return;
        
        try {
            await performSearch(searchData, 1);
            addToSearchHistory(searchData);
        } catch (error) {
            console.error('検索エラー:', error);
            showError('検索中にエラーが発生しました。');
        }
    }

    // 検索データ収集
    function collectFormData() {
        return {
            search: mainSearchInput ? mainSearchInput.value.trim() : '',
            categories: categoryFilter ? [categoryFilter.value].filter(Boolean) : [],
            prefectures: prefectureFilter ? [prefectureFilter.value].filter(Boolean) : [],
            amount: amountFilter ? amountFilter.value : '',
            status: statusFilter ? [statusFilter.value].filter(Boolean) : [],
            difficulty: difficultyFilter ? [difficultyFilter.value].filter(Boolean) : [],
            sort: sortFilter ? sortFilter.value : 'date_desc',
            nonce: CONFIG.nonce
        };
    }

    // 検索データ検証
    function validateSearchData(data) {
        if (!data.search && !data.categories.length && !data.prefectures.length && 
            !data.amount && !data.status.length && !data.difficulty.length) {
            showToast('検索キーワードまたはフィルター条件を指定してください', 'warning');
            return false;
        }
        return true;
    }

    // 検索実行（既存AJAX function対応）
    async function performSearch(searchData, page = 1) {
        if (abortController) {
            abortController.abort();
        }

        abortController = new AbortController();
        setLoadingState(true);
        currentPage = page;
        currentSearchParams = { ...searchData, page };

        try {
            const formData = new FormData();
            formData.append('action', 'gi_load_grants');
            formData.append('search', searchData.search);
            formData.append('categories', JSON.stringify(searchData.categories));
            formData.append('prefectures', JSON.stringify(searchData.prefectures));
            formData.append('amount', searchData.amount);
            formData.append('status', JSON.stringify(searchData.status));
            formData.append('difficulty', JSON.stringify(searchData.difficulty));
            formData.append('sort', searchData.sort);
            formData.append('view', currentView);
            formData.append('page', page);
            formData.append('nonce', CONFIG.nonce);

            const response = await fetch(CONFIG.apiUrl, {
                method: 'POST',
                body: formData,
                signal: abortController.signal
            });

            const data = await response.json();
            
            if (data.success) {
                displayResults(data.data);
            } else {
                throw new Error(data.data || '検索に失敗しました');
            }
            
        } catch (error) {
            if (error.name === 'AbortError') {
                return;
            }
            
            console.error('検索エラー:', error);
            showError(error.message || '検索中にエラーが発生しました。');
        } finally {
            setLoadingState(false);
        }
    }

    // 結果表示（template-parts/grant-card-v4-enhanced.php使用）
    function displayResults(data) {
        if (!data || !data.grants) {
            showError('検索結果の取得に失敗しました。');
            return;
        }
        
        // 結果情報更新
        updateResultsInfo(data);
        
        // 結果一覧表示
        renderResults(data.grants);
        
        // ページネーション表示
        renderPagination(data.pagination);
        
        // 結果エリアへスムーズスクロール
        if (searchResults) {
            searchResults.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }

    // 結果情報更新
    function updateResultsInfo(data) {
        if (!resultsInfo) return;
        
        const total = data.found_posts || 0;
        const start = ((currentPage - 1) * CONFIG.resultsPerPage) + 1;
        const end = Math.min(start + CONFIG.resultsPerPage - 1, total);
        
        resultsInfo.innerHTML = `
            <span style="color: #3b82f6; font-weight: 600;">${total.toLocaleString('ja-JP')}</span>件中 
            <span style="color: #6b7280;">${start.toLocaleString('ja-JP')}-${end.toLocaleString('ja-JP')}</span>件を表示
        `;
    }

    // 結果一覧レンダリング（grant-card-v4-enhanced.php を使用）
    function renderResults(grants) {
        if (!resultsContainer) return;
        
        if (!grants || grants.length === 0) {
            resultsContainer.innerHTML = `
                <div class="initial-results">
                    <div class="results-placeholder">
                        <div class="placeholder-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3>該当する助成金が見つかりませんでした</h3>
                        <p>検索条件を変更して再度お試しください。</p>
                        <button onclick="document.getElementById('reset-search')?.click()" 
                                style="margin-top: 1.5rem; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 8px; font-weight: 500; cursor: pointer; transition: all 0.3s ease; font-size: 0.85rem;">
                            検索条件をリセット
                        </button>
                    </div>
                </div>
            `;
            return;
        }

        resultsContainer.className = `results-container ${currentView}-view`;
        
        // grant-card-v4-enhanced.php で生成されたHTMLを使用
        let html = '';
        grants.forEach(grant => {
            if (grant.html) {
                html += grant.html;
            }
        });
        
        resultsContainer.innerHTML = html;
        
        // カードアニメーション
        animateCards();
        
        // 新しいカードのイベントリスナーを初期化
        initializeCardEvents();
    }

    // カードイベント初期化
    function initializeCardEvents() {
        // お気に入りボタン
        const favoriteButtons = document.querySelectorAll('.favorite-btn:not([data-initialized])');
        favoriteButtons.forEach(button => {
            button.dataset.initialized = 'true';
            button.addEventListener('click', function(e) {
                e.preventDefault();
                handleFavoriteToggle(this);
            });
        });
        
        // 共有ボタン
        const shareButtons = document.querySelectorAll('.share-btn:not([data-initialized])');
        shareButtons.forEach(button => {
            button.dataset.initialized = 'true';
            button.addEventListener('click', function(e) {
                e.preventDefault();
                handleShare(this);
            });
        });
    }

    // お気に入り切り替え処理
    async function handleFavoriteToggle(button) {
        const postId = button.dataset.postId;
        
        if (!postId) return;
        
        // アニメーション
        button.style.transform = 'scale(1.2)';
        setTimeout(() => {
            button.style.transform = 'scale(1)';
        }, 200);
        
        try {
            const formData = new FormData();
            formData.append('action', 'gi_toggle_favorite');
            formData.append('post_id', postId);
            formData.append('nonce', CONFIG.nonce);
            
            const response = await fetch(CONFIG.apiUrl, {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            
            if (data.success) {
                // ハートアイコンの更新
                const heartIcon = button.querySelector('i');
                if (heartIcon) {
                    heartIcon.className = data.data.is_favorite ? 'fas fa-heart' : 'far fa-heart';
                    button.style.color = data.data.is_favorite ? '#ef4444' : '#6b7280';
                }
                
                showToast(data.data.message, 'success');
            } else {
                throw new Error(data.data || 'お気に入りの切り替えに失敗しました');
            }
        } catch (error) {
            console.error('お気に入りエラー:', error);
            showToast('お気に入りの切り替えに失敗しました', 'error');
        }
    }

    // 共有処理
    function handleShare(button) {
        const url = button.dataset.url;
        const title = button.dataset.title;
        
        if (!url) return;
        
        if (navigator.share) {
            navigator.share({
                title: title,
                url: url
            }).catch(err => console.log('共有エラー:', err));
        } else {
            navigator.clipboard.writeText(url).then(() => {
                showToast('URLをコピーしました', 'success');
            }).catch(err => {
                showToast('コピーに失敗しました', 'error');
                console.log('コピーエラー:', err);
            });
        }
    }

    // ページネーションレンダリング
    function renderPagination(pagination) {
        if (!paginationContainer || !pagination || pagination.total_pages <= 1) {
            if (paginationContainer) {
                paginationContainer.innerHTML = '';
            }
            return;
        }

        const { current_page, total_pages } = pagination;
        let html = '<div style="display: flex; justify-content: center; gap: 0.5rem; flex-wrap: wrap;">';

        // 前ページ
        if (current_page > 1) {
            html += `
                <button class="pagination-btn" data-page="${current_page - 1}">
                    <i class="fas fa-chevron-left"></i>
                </button>
            `;
        }

        // ページ番号
        const startPage = Math.max(1, current_page - 2);
        const endPage = Math.min(total_pages, current_page + 2);

        for (let i = startPage; i <= endPage; i++) {
            const isActive = i === current_page;
            html += `
                <button class="pagination-btn ${isActive ? 'active' : ''}" data-page="${i}">
                    ${i}
                </button>
            `;
        }

        // 次ページ
        if (current_page < total_pages) {
            html += `
                <button class="pagination-btn" data-page="${current_page + 1}">
                    <i class="fas fa-chevron-right"></i>
                </button>
            `;
        }

        html += '</div>';
        paginationContainer.innerHTML = html;

        // ページネーションイベント
        paginationContainer.querySelectorAll('.pagination-btn').forEach(btn => {
            btn.addEventListener('click', async (e) => {
                const page = parseInt(e.target.closest('.pagination-btn').dataset.page);
                if (page && page !== currentPage) {
                    await performSearch(currentSearchParams, page);
                }
            });
        });
    }

    // その他の関数
    function handleSearchInput() {
        if (!mainSearchInput || !searchClear) return;
        
        const value = mainSearchInput.value.trim();
        searchClear.style.display = value ? 'block' : 'none';
    }

    function clearSearch() {
        if (!mainSearchInput || !searchClear) return;
        
        mainSearchInput.value = '';
        searchClear.style.display = 'none';
        mainSearchInput.focus();
    }

    function handleVoiceSearch() {
        if (!('webkitSpeechRecognition' in window) && !('SpeechRecognition' in window)) {
            showToast('音声認識がサポートされていません', 'error');
            return;
        }

        if (isVoiceListening) {
            stopVoiceRecognition();
            return;
        }

        startVoiceRecognition();
    }

    function startVoiceRecognition() {
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        const recognition = new SpeechRecognition();
        
        recognition.lang = 'ja-JP';
        recognition.continuous = false;
        recognition.interimResults = false;

        recognition.onstart = () => {
            isVoiceListening = true;
            if (voiceSearchBtn) {
                voiceSearchBtn.classList.add('listening');
            }
            showToast('音声を聞き取り中...', 'info');
        };

        recognition.onresult = (event) => {
            const transcript = event.results[0][0].transcript;
            if (mainSearchInput) {
                mainSearchInput.value = transcript;
                handleSearchInput();
            }
            showToast(`「${transcript}」と認識しました`, 'success');
        };

        recognition.onerror = (event) => {
            showToast('音声認識エラーが発生しました', 'error');
            stopVoiceRecognition();
        };

        recognition.onend = () => {
            stopVoiceRecognition();
        };

        recognition.start();
    }

    function stopVoiceRecognition() {
        isVoiceListening = false;
        if (voiceSearchBtn) {
            voiceSearchBtn.classList.remove('listening');
        }
    }

    function resetSearch() {
        if (searchForm) {
            searchForm.reset();
        }
        if (mainSearchInput) {
            mainSearchInput.value = '';
        }
        if (searchClear) {
            searchClear.style.display = 'none';
        }
        
        // キーワードタグのアクティブ状態をリセット
        keywordTags.forEach(tag => tag.classList.remove('active'));
        
        // プレースホルダーを表示
        if (resultsContainer) {
            resultsContainer.innerHTML = `
                <div class="initial-results">
                    <div class="results-placeholder">
                        <div class="placeholder-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3>助成金を見つけよう</h3>
                        <p>上記の検索ボックスまたは人気検索ワードから検索を始めてください。</p>
                    </div>
                </div>
            `;
        }
        
        // 結果情報をリセット
        if (resultsInfo) {
            resultsInfo.innerHTML = '<span style="color: #3b82f6; font-weight: 600;">全ての助成金</span>を表示しています';
        }
        
        if (mainSearchInput) {
            mainSearchInput.focus();
        }
        showToast('検索条件をリセットしました', 'success');
    }

    function handleTagClick(event) {
        const tag = event.target.closest('.keyword-tag');
        if (!tag) return;
        
        const tagValue = tag.dataset.tag;
        
        // 同じカテゴリ内のタグをリセット
        const parentBox = tag.closest('.keyword-box');
        if (parentBox) {
            parentBox.querySelectorAll('.keyword-tag').forEach(t => t.classList.remove('active'));
        }
        
        // クリックされたタグをアクティブ化
        tag.classList.add('active');
        
        // 検索入力に設定
        if (mainSearchInput) {
            mainSearchInput.value = tagValue;
            handleSearchInput();
        }
        
        // 検索実行
        const searchData = collectFormData();
        if (validateSearchData(searchData)) {
            performSearch(searchData, 1);
        }
    }

    function handleFilterChange() {
        // フィルター変更時の自動検索
        if ((mainSearchInput && mainSearchInput.value.trim()) || hasActiveFilters()) {
            const searchData = collectFormData();
            if (validateSearchData(searchData)) {
                performSearch(searchData, 1);
            }
        }
    }

    function hasActiveFilters() {
        const filters = [categoryFilter, prefectureFilter, amountFilter, statusFilter, difficultyFilter];
        return filters.some(filter => filter && filter.value);
    }

    function switchView(viewType) {
        if (currentView === viewType) return;
        
        currentView = viewType;
        
        // ボタン更新
        if (gridViewBtn) {
            gridViewBtn.classList.toggle('active', viewType === 'grid');
        }
        if (listViewBtn) {
            listViewBtn.classList.toggle('active', viewType === 'list');
        }
        
        // 結果再レンダリング
        if (resultsContainer && resultsContainer.children.length > 0) {
            resultsContainer.className = `results-container ${viewType}-view`;
            
            // 検索を再実行してビューを切り替え
            if (currentSearchParams && Object.keys(currentSearchParams).length > 0) {
                performSearch(currentSearchParams, currentPage);
            }
        }
    }

    function exportResults() {
        if (!currentSearchParams || Object.keys(currentSearchParams).length === 0) {
            showToast('エクスポートする検索結果がありません', 'warning');
            return;
        }

        showToast('エクスポート機能は開発中です', 'info');
    }

    function retrySearch() {
        if (searchError) {
            searchError.style.display = 'none';
        }
        if (currentSearchParams && Object.keys(currentSearchParams).length > 0) {
            performSearch(currentSearchParams, currentPage);
        }
    }

    function setLoadingState(isLoading) {
        if (!searchSubmitBtn) return;
        
        if (isLoading) {
            searchSubmitBtn.disabled = true;
            const btnContent = searchSubmitBtn.querySelector('.btn-content');
            const btnLoading = searchSubmitBtn.querySelector('.btn-loading');
            
            if (btnContent) btnContent.style.display = 'none';
            if (btnLoading) btnLoading.style.display = 'flex';
            if (searchLoading) searchLoading.style.display = 'flex';
        } else {
            searchSubmitBtn.disabled = false;
            const btnContent = searchSubmitBtn.querySelector('.btn-content');
            const btnLoading = searchSubmitBtn.querySelector('.btn-loading');
            
            if (btnContent) btnContent.style.display = 'flex';
            if (btnLoading) btnLoading.style.display = 'none';
            if (searchLoading) searchLoading.style.display = 'none';
        }
    }

    function showError(message) {
        const errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            errorMessage.textContent = message;
        }
        if (searchError) {
            searchError.style.display = 'flex';
        }
    }

    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.textContent = message;
        
        const colors = {
            info: '#3b82f6',
            success: '#10b981',
            warning: '#f59e0b',
            error: '#ef4444'
        };
        
        toast.style.cssText = `
            position: fixed;
            top: 2rem;
            left: 50%;
            transform: translateX(-50%);
            background: ${colors[type] || colors.info};
            color: white;
            padding: 1rem 2rem;
            border-radius: 12px;
            font-weight: 600;
            z-index: 1000;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            animation: slideInDown 0.3s ease;
            max-width: 90vw;
            text-align: center;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Noto Sans JP', sans-serif;
        `;
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.style.animation = 'slideOutUp 0.3s ease';
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 300);
        }, 3000);
    }

    function animateCards() {
        const cards = document.querySelectorAll('.grant-card-enhanced, .grant-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 60);
        });
    }

    function addToSearchHistory(searchData) {
        const historyItem = {
            keyword: searchData.search,
            categories: searchData.categories,
            prefectures: searchData.prefectures,
            timestamp: Date.now()
        };
        
        searchHistory = searchHistory.filter(item => 
            item.keyword !== historyItem.keyword || 
            JSON.stringify(item.categories) !== JSON.stringify(historyItem.categories)
        );
        
        searchHistory.unshift(historyItem);
        searchHistory = searchHistory.slice(0, 10);
        
        localStorage.setItem('search_history', JSON.stringify(searchHistory));
    }
});

// CSS アニメーション追加
const animationStyle = document.createElement('style');
animationStyle.textContent = `
    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translate(-50%, -20px);
        }
        to {
            opacity: 1;
            transform: translate(-50%, 0);
        }
    }
    
    @keyframes slideOutUp {
        from {
            opacity: 1;
            transform: translate(-50%, 0);
        }
        to {
            opacity: 0;
            transform: translate(-50%, -20px);
        }
    }
`;
document.head.appendChild(animationStyle);
</script>