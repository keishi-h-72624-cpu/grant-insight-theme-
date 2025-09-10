<?php
/**
 * Template for displaying grant archive with enhanced mobile-first design
 * Grant Insight Perfect - Mobile Optimized Archive Page (Fixed Version)
 * 
 * Features:
 * - Mobile-first responsive design
 * - Compact mobile card layout
 * - Enhanced desktop card integration
 * - Complete prefecture filter with toggle button
 * - Perfect AJAX integration
 * - Mobile touch optimization
 * - Fixed view switching issues
 * - Removed floating buttons
 * - Removed dark mode CSS
 */

// セキュリティチェック
if (!defined('ABSPATH')) {
    exit;
}

get_header(); ?>

<!-- モバイル最適化カードデザイン用のスタイル読み込み -->
<?php 
if (function_exists('gi_generate_card_hover_styles')) {
    echo gi_generate_card_hover_styles();
}
?>

<div class="min-h-screen bg-gradient-to-br from-emerald-50 to-teal-50">
    <!-- ヒーローセクション -->
    <section class="relative bg-gradient-to-r from-emerald-600 via-teal-600 to-emerald-700 text-white py-12 md:py-16 lg:py-24">
        <div class="absolute inset-0 bg-black bg-opacity-20"></div>
        <div class="relative container mx-auto px-3 md:px-4">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-12 h-12 md:w-16 md:h-16 bg-yellow-500 rounded-full mb-4 md:mb-6 animate-bounce-gentle">
                    <i class="fas fa-coins text-lg md:text-2xl text-white"></i>
                </div>
                <h1 class="text-2xl md:text-4xl lg:text-5xl xl:text-6xl font-bold mb-3 md:mb-4 animate-fade-in-up">
                    助成金・補助金一覧
                </h1>
                <p class="text-base md:text-xl lg:text-2xl text-emerald-100 mb-6 md:mb-8 animate-fade-in-up animation-delay-200">
                    全国の助成金・補助金情報を都道府県別に検索
                </p>
                
                <!-- 統計情報（モバイル最適化） -->
                <div class="grid grid-cols-2 md:flex md:flex-wrap justify-center gap-3 md:gap-6 lg:gap-12 animate-fade-in-up animation-delay-400">
                    <?php
                    $total_grants = wp_count_posts('grant')->publish;
                    $active_grants = get_posts(array(
                        'post_type' => 'grant',
                        'meta_query' => array(
                            array(
                                'key' => 'application_status',
                                'value' => 'open',
                                'compare' => '='
                            )
                        ),
                        'fields' => 'ids'
                    ));
                    $prefecture_count = wp_count_terms(array('taxonomy' => 'grant_prefecture', 'hide_empty' => false));
                    
                    // 平均採択率を計算
                    $success_rates = get_posts(array(
                        'post_type' => 'grant',
                        'posts_per_page' => -1,
                        'fields' => 'ids',
                        'meta_query' => array(
                            array(
                                'key' => 'grant_success_rate',
                                'value' => 0,
                                'compare' => '>'
                            )
                        )
                    ));
                    $avg_success_rate = 0;
                    if (!empty($success_rates)) {
                        $total_rate = 0;
                        foreach ($success_rates as $grant_id) {
                            $total_rate += intval(gi_safe_get_meta($grant_id, 'grant_success_rate', 0));
                        }
                        $avg_success_rate = round($total_rate / count($success_rates));
                    }
                    ?>
                    <div class="text-center">
                        <div class="text-xl md:text-3xl lg:text-4xl font-bold text-yellow-300">
                            <?php echo gi_safe_number_format($total_grants); ?>
                        </div>
                        <div class="text-xs md:text-sm lg:text-base text-emerald-100">件</div>
                        <div class="text-xs text-emerald-200 hidden md:block">助成金総数</div>
                    </div>
                    <div class="text-center">
                        <div class="text-xl md:text-3xl lg:text-4xl font-bold text-green-300">
                            <?php echo gi_safe_number_format(count($active_grants)); ?>
                        </div>
                        <div class="text-xs md:text-sm lg:text-base text-emerald-100">募集中</div>
                        <div class="text-xs text-emerald-200 hidden md:block">現在応募可能</div>
                    </div>
                    <div class="text-center">
                        <div class="text-xl md:text-3xl lg:text-4xl font-bold text-orange-300">
                            <?php echo gi_safe_number_format($prefecture_count); ?>
                        </div>
                        <div class="text-xs md:text-sm lg:text-base text-emerald-100">都道府県</div>
                        <div class="text-xs text-emerald-200 hidden md:block">全国対応</div>
                    </div>
                    <div class="text-center">
                        <div class="text-xl md:text-3xl lg:text-4xl font-bold text-blue-300">
                            <?php echo $avg_success_rate; ?>%
                        </div>
                        <div class="text-xs md:text-sm lg:text-base text-emerald-100">平均採択率</div>
                        <div class="text-xs text-emerald-200 hidden md:block">成功の目安</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- 背景アニメーション -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-white opacity-5 rounded-full animate-pulse"></div>
            <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-white opacity-3 rounded-full animate-pulse animation-delay-1000"></div>
        </div>
    </section>

    <!-- 検索・フィルターセクション -->
    <section class="py-4 md:py-8 bg-white shadow-sm border-b">
        <div class="container mx-auto px-3 md:px-4">
            <!-- 検索バー -->
            <div class="mb-4 md:mb-6">
                <div class="relative max-w-2xl mx-auto">
                    <input type="text" 
                           id="grant-search" 
                           class="w-full px-4 md:px-6 py-3 md:py-4 text-base md:text-lg border-2 border-gray-200 rounded-full focus:border-emerald-500 focus:ring-4 focus:ring-emerald-200 transition-all duration-300 pr-12 md:pr-14"
                           placeholder="キーワードを入力（例：IT導入補助金、設備投資支援など）">
                    <button type="button" 
                            id="search-btn"
                            class="absolute right-1 top-1 md:right-2 md:top-2 w-10 h-10 md:w-12 md:h-12 bg-emerald-600 hover:bg-emerald-700 text-white rounded-full flex items-center justify-center transition-colors duration-200">
                        <i class="fas fa-search text-sm md:text-base"></i>
                    </button>
                </div>
            </div>

            <!-- モバイル用クイックフィルター -->
            <div class="block md:hidden mb-4">
                <div class="flex gap-2 overflow-x-auto pb-2 scrollbar-hide">
                    <button class="quick-filter active px-3 py-2 rounded-full text-xs font-medium bg-emerald-600 text-white hover:bg-emerald-700 transition-colors whitespace-nowrap" data-filter="all">すべて</button>
                    <button class="quick-filter px-3 py-2 rounded-full text-xs font-medium bg-gray-200 text-gray-700 hover:bg-gray-300 transition-colors whitespace-nowrap" data-filter="active">募集中</button>
                    <button class="quick-filter px-3 py-2 rounded-full text-xs font-medium bg-gray-200 text-gray-700 hover:bg-gray-300 transition-colors whitespace-nowrap" data-filter="upcoming">募集予定</button>
                    <button class="quick-filter px-3 py-2 rounded-full text-xs font-medium bg-gray-200 text-gray-700 hover:bg-gray-300 transition-colors whitespace-nowrap" data-filter="national">全国対応</button>
                    <button class="quick-filter px-3 py-2 rounded-full text-xs font-medium bg-gray-200 text-gray-700 hover:bg-gray-300 transition-colors whitespace-nowrap" data-filter="high-rate">高採択率</button>
                </div>
            </div>

            <!-- デスクトップ用表示切り替え・並び順 -->
            <div class="hidden md:flex flex-wrap items-center justify-between gap-4 mb-6">
                <div class="flex items-center gap-4">
                    <!-- クイックフィルター -->
                    <div class="flex gap-2 flex-wrap">
                        <button class="quick-filter active px-4 py-2 rounded-full text-sm font-medium bg-emerald-600 text-white hover:bg-emerald-700 transition-colors" data-filter="all">すべて</button>
                        <button class="quick-filter px-4 py-2 rounded-full text-sm font-medium bg-gray-200 text-gray-700 hover:bg-gray-300 transition-colors" data-filter="active">募集中</button>
                        <button class="quick-filter px-4 py-2 rounded-full text-sm font-medium bg-gray-200 text-gray-700 hover:bg-gray-300 transition-colors" data-filter="upcoming">募集予定</button>
                        <button class="quick-filter px-4 py-2 rounded-full text-sm font-medium bg-gray-200 text-gray-700 hover:bg-gray-300 transition-colors" data-filter="national">全国対応</button>
                        <button class="quick-filter px-4 py-2 rounded-full text-sm font-medium bg-gray-200 text-gray-700 hover:bg-gray-300 transition-colors" data-filter="high-rate">高採択率</button>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <!-- 並び順 -->
                    <select id="sort-order" class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        <option value="date_desc">新着順</option>
                        <option value="date_asc">古い順</option>
                        <option value="amount_desc">金額が高い順</option>
                        <option value="amount_asc">金額が安い順</option>
                        <option value="deadline_asc">締切が近い順</option>
                        <option value="success_rate_desc">採択率が高い順</option>
                        <option value="title_asc">タイトル順</option>
                    </select>

                    <!-- 表示切り替え（デスクトップのみ） -->
                    <div class="flex bg-gray-100 rounded-lg p-1">
                        <button id="grid-view" class="view-toggle active flex items-center gap-2 px-3 py-2 rounded-md text-sm font-medium transition-all duration-200 bg-white text-emerald-600 shadow-sm">
                            <i class="fas fa-th-large"></i>
                            <span class="hidden sm:inline">グリッド</span>
                        </button>
                        <button id="list-view" class="view-toggle flex items-center gap-2 px-3 py-2 rounded-md text-sm font-medium transition-all duration-200 text-gray-600 hover:text-gray-900">
                            <i class="fas fa-list"></i>
                            <span class="hidden sm:inline">リスト</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- モバイル用並び順・フィルターボタン -->
            <div class="flex md:hidden items-center justify-between gap-3 mb-4">
                <select id="sort-order-mobile" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="date_desc">新着順</option>
                    <option value="date_asc">古い順</option>
                    <option value="amount_desc">金額が高い順</option>
                    <option value="amount_asc">金額が安い順</option>
                    <option value="deadline_asc">締切が近い順</option>
                    <option value="success_rate_desc">採択率が高い順</option>
                    <option value="title_asc">タイトル順</option>
                </select>
                
                <button id="mobile-filter-toggle" class="px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg text-sm flex items-center gap-2">
                    <i class="fas fa-filter"></i>
                    <span>フィルター</span>
                </button>
            </div>
        </div>
    </section>

    <!-- メインコンテンツ -->
    <div class="container mx-auto px-3 md:px-4 py-6 md:py-8">
        <div class="flex flex-col lg:flex-row gap-6 md:gap-8">
            <!-- サイドバー（フィルター）- モバイルで折りたたみ可能 -->
            <aside class="lg:w-80 shrink-0">
                <div id="filter-sidebar" class="fixed md:relative inset-0 md:inset-auto z-50 md:z-auto bg-black bg-opacity-50 md:bg-transparent hidden md:block transform md:transform-none">
                    <div class="bg-white md:bg-white rounded-none md:rounded-xl shadow-none md:shadow-sm border-0 md:border p-4 md:p-6 sticky top-0 md:top-24 h-full md:h-auto overflow-y-auto md:overflow-visible">
                        <!-- モバイル用ヘッダー -->
                        <div class="flex md:hidden items-center justify-between mb-6 pb-4 border-b">
                            <h3 class="text-lg font-semibold text-gray-900">絞り込み検索</h3>
                            <button id="close-filter-sidebar" class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100">
                                <i class="fas fa-times text-gray-600"></i>
                            </button>
                        </div>

                        <!-- フィルターヘッダー（デスクトップ） -->
                        <div class="hidden md:flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                <i class="fas fa-filter text-emerald-600"></i>
                                絞り込み検索
                            </h3>
                            <button id="clear-filters" class="text-sm text-emerald-600 hover:text-emerald-800 font-medium">
                                クリア
                            </button>
                        </div>

                        <!-- 都道府県フィルター -->
                        <div class="mb-6 md:mb-8">
                            <h4 class="font-medium text-gray-900 mb-3 md:mb-4 flex items-center gap-2 text-sm md:text-base">
                                <i class="fas fa-map-marker-alt text-red-600"></i>
                                対象地域
                            </h4>
                            <div id="prefecture-filter">
                                <!-- 人気都道府県（初期表示） -->
                                <div id="popular-prefectures">
                                    <?php
                                    $popular_prefectures = array('全国対応', '東京都', '大阪府', '愛知県', '神奈川県', '福岡県');
                                    foreach ($popular_prefectures as $pref_name) {
                                        $term = get_term_by('name', $pref_name, 'grant_prefecture');
                                        if ($term && !is_wp_error($term)) :
                                    ?>
                                    <label class="flex items-center justify-between py-2 px-2 md:px-3 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors group">
                                        <div class="flex items-center gap-2 md:gap-3">
                                            <input type="checkbox" name="prefecture[]" value="<?php echo gi_safe_attr($term->slug); ?>" class="prefecture-checkbox w-4 h-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
                                            <span class="text-sm text-gray-700 group-hover:text-gray-900"><?php echo gi_safe_escape($term->name); ?></span>
                                        </div>
                                        <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full"><?php echo $term->count; ?></span>
                                    </label>
                                    <?php 
                                        endif;
                                    }
                                    ?>
                                </div>

                                <!-- 全都道府県（折りたたみ） -->
                                <div id="all-prefectures" class="hidden">
                                    <?php
                                    $all_prefectures = get_terms(array(
                                        'taxonomy' => 'grant_prefecture',
                                        'hide_empty' => false,
                                        'orderby' => 'name',
                                        'order' => 'ASC'
                                    ));

                                    if (!empty($all_prefectures) && !is_wp_error($all_prefectures)) {
                                        foreach ($all_prefectures as $prefecture) {
                                            if (!in_array($prefecture->name, $popular_prefectures)) :
                                    ?>
                                    <label class="flex items-center justify-between py-2 px-2 md:px-3 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors group">
                                        <div class="flex items-center gap-2 md:gap-3">
                                            <input type="checkbox" name="prefecture[]" value="<?php echo gi_safe_attr($prefecture->slug); ?>" class="prefecture-checkbox w-4 h-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
                                            <span class="text-sm text-gray-700 group-hover:text-gray-900"><?php echo gi_safe_escape($prefecture->name); ?></span>
                                        </div>
                                        <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full"><?php echo $prefecture->count; ?></span>
                                    </label>
                                    <?php 
                                            endif;
                                        }
                                    }
                                    ?>
                                </div>

                                <!-- 都道府県展開ボタン -->
                                <?php if (!empty($all_prefectures) && count($all_prefectures) > 6) : ?>
                                <button id="toggle-prefectures" class="w-full mt-3 py-2 px-3 md:px-4 text-xs md:text-sm text-emerald-600 hover:text-emerald-800 border border-emerald-200 hover:border-emerald-300 rounded-lg transition-colors flex items-center justify-center gap-2">
                                    <span class="toggle-text">その他の都道府県を表示</span>
                                    <i class="fas fa-chevron-down toggle-icon transition-transform duration-200 text-xs"></i>
                                </button>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- カテゴリフィルター -->
                        <div class="mb-6 md:mb-8">
                            <h4 class="font-medium text-gray-900 mb-3 md:mb-4 flex items-center gap-2 text-sm md:text-base">
                                <i class="fas fa-tags text-green-600"></i>
                                カテゴリ
                            </h4>
                            <div id="category-filter">
                                <?php
                                $categories = get_terms(array(
                                    'taxonomy' => 'grant_category',
                                    'hide_empty' => false,
                                    'orderby' => 'count',
                                    'order' => 'DESC',
                                    'number' => 6
                                ));

                                $all_categories = get_terms(array(
                                    'taxonomy' => 'grant_category',
                                    'hide_empty' => false,
                                    'orderby' => 'name',
                                    'order' => 'ASC'
                                ));

                                if (!empty($categories) && !is_wp_error($categories)) :
                                    foreach (array_slice($categories, 0, 5) as $category) :
                                ?>
                                <label class="flex items-center justify-between py-2 px-2 md:px-3 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors group">
                                    <div class="flex items-center gap-2 md:gap-3">
                                        <input type="checkbox" name="category[]" value="<?php echo gi_safe_attr($category->slug); ?>" class="category-checkbox w-4 h-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
                                        <span class="text-sm text-gray-700 group-hover:text-gray-900"><?php echo gi_safe_escape($category->name); ?></span>
                                    </div>
                                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full"><?php echo $category->count; ?></span>
                                </label>
                                <?php endforeach; ?>

                                <?php if (!empty($all_categories) && !is_wp_error($all_categories) && count($all_categories) > 5) : ?>
                                <div id="more-categories" class="hidden">
                                    <?php foreach (array_slice($all_categories, 5) as $category) : ?>
                                    <label class="flex items-center justify-between py-2 px-2 md:px-3 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors group">
                                        <div class="flex items-center gap-2 md:gap-3">
                                            <input type="checkbox" name="category[]" value="<?php echo gi_safe_attr($category->slug); ?>" class="category-checkbox w-4 h-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
                                            <span class="text-sm text-gray-700 group-hover:text-gray-900"><?php echo gi_safe_escape($category->name); ?></span>
                                        </div>
                                        <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full"><?php echo $category->count; ?></span>
                                    </label>
                                    <?php endforeach; ?>
                                </div>

                                <button id="toggle-categories" class="w-full mt-3 py-2 px-3 md:px-4 text-xs md:text-sm text-emerald-600 hover:text-emerald-800 border border-emerald-200 hover:border-emerald-300 rounded-lg transition-colors flex items-center justify-center gap-2">
                                    <span class="toggle-text">その他のカテゴリを表示</span>
                                    <i class="fas fa-chevron-down toggle-icon transition-transform duration-200 text-xs"></i>
                                </button>
                                <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- 難易度フィルター -->
                        <div class="mb-6 md:mb-8">
                            <h4 class="font-medium text-gray-900 mb-3 md:mb-4 flex items-center gap-2 text-sm md:text-base">
                                <i class="fas fa-star text-orange-600"></i>
                                申請難易度
                            </h4>
                            <div class="space-y-1 md:space-y-2">
                                <label class="flex items-center gap-2 md:gap-3 py-1.5 md:py-2 px-2 md:px-3 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                                    <input type="checkbox" name="difficulty[]" value="easy" class="w-4 h-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
                                    <div class="flex items-center gap-2">
                                        <div class="flex text-green-400">
                                            <i class="fas fa-star text-xs"></i>
                                        </div>
                                        <span class="text-sm text-gray-700">易しい</span>
                                    </div>
                                </label>
                                <label class="flex items-center gap-2 md:gap-3 py-1.5 md:py-2 px-2 md:px-3 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                                    <input type="checkbox" name="difficulty[]" value="normal" class="w-4 h-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
                                    <div class="flex items-center gap-2">
                                        <div class="flex text-blue-400">
                                            <i class="fas fa-star text-xs"></i>
                                            <i class="fas fa-star text-xs"></i>
                                        </div>
                                        <span class="text-sm text-gray-700">普通</span>
                                    </div>
                                </label>
                                <label class="flex items-center gap-2 md:gap-3 py-1.5 md:py-2 px-2 md:px-3 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                                    <input type="checkbox" name="difficulty[]" value="hard" class="w-4 h-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
                                    <div class="flex items-center gap-2">
                                        <div class="flex text-orange-400">
                                            <i class="fas fa-star text-xs"></i>
                                            <i class="fas fa-star text-xs"></i>
                                            <i class="fas fa-star text-xs"></i>
                                        </div>
                                        <span class="text-sm text-gray-700">難しい</span>
                                    </div>
                                </label>
                                <label class="flex items-center gap-2 md:gap-3 py-1.5 md:py-2 px-2 md:px-3 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                                    <input type="checkbox" name="difficulty[]" value="expert" class="w-4 h-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
                                    <div class="flex items-center gap-2">
                                        <div class="flex text-red-400">
                                            <i class="fas fa-star text-xs"></i>
                                            <i class="fas fa-star text-xs"></i>
                                            <i class="fas fa-star text-xs"></i>
                                            <i class="fas fa-star text-xs"></i>
                                        </div>
                                        <span class="text-sm text-gray-700">専門的</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- 金額フィルター -->
                        <div class="mb-6 md:mb-8">
                            <h4 class="font-medium text-gray-900 mb-3 md:mb-4 flex items-center gap-2 text-sm md:text-base">
                                <i class="fas fa-yen-sign text-yellow-600"></i>
                                助成金額
                            </h4>
                            <div class="space-y-1 md:space-y-2">
                                <label class="flex items-center gap-2 md:gap-3 py-1.5 md:py-2 px-2 md:px-3 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                                    <input type="radio" name="amount" value="" checked class="w-4 h-4 text-emerald-600 border-gray-300 focus:ring-emerald-500">
                                    <span class="text-sm text-gray-700">すべて</span>
                                </label>
                                <label class="flex items-center gap-2 md:gap-3 py-1.5 md:py-2 px-2 md:px-3 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                                    <input type="radio" name="amount" value="0-100" class="w-4 h-4 text-emerald-600 border-gray-300 focus:ring-emerald-500">
                                    <span class="text-sm text-gray-700">100万円以下</span>
                                </label>
                                <label class="flex items-center gap-2 md:gap-3 py-1.5 md:py-2 px-2 md:px-3 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                                    <input type="radio" name="amount" value="100-500" class="w-4 h-4 text-emerald-600 border-gray-300 focus:ring-emerald-500">
                                    <span class="text-sm text-gray-700">100万円〜500万円</span>
                                </label>
                                <label class="flex items-center gap-2 md:gap-3 py-1.5 md:py-2 px-2 md:px-3 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                                    <input type="radio" name="amount" value="500-1000" class="w-4 h-4 text-emerald-600 border-gray-300 focus:ring-emerald-500">
                                    <span class="text-sm text-gray-700">500万円〜1000万円</span>
                                </label>
                                <label class="flex items-center gap-2 md:gap-3 py-1.5 md:py-2 px-2 md:px-3 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                                    <input type="radio" name="amount" value="1000+" class="w-4 h-4 text-emerald-600 border-gray-300 focus:ring-emerald-500">
                                    <span class="text-sm text-gray-700">1000万円以上</span>
                                </label>
                            </div>
                        </div>

                        <!-- 採択率フィルター -->
                        <div class="mb-6 md:mb-8">
                            <h4 class="font-medium text-gray-900 mb-3 md:mb-4 flex items-center gap-2 text-sm md:text-base">
                                <i class="fas fa-chart-line text-green-600"></i>
                                採択率
                            </h4>
                            <div class="space-y-1 md:space-y-2">
                                <label class="flex items-center gap-2 md:gap-3 py-1.5 md:py-2 px-2 md:px-3 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                                    <input type="checkbox" name="success_rate[]" value="high" class="w-4 h-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
                                    <span class="text-sm text-gray-700">高い（70%以上）</span>
                                    <span class="ml-auto w-2 h-2 md:w-3 md:h-3 bg-green-500 rounded-full"></span>
                                </label>
                                <label class="flex items-center gap-2 md:gap-3 py-1.5 md:py-2 px-2 md:px-3 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                                    <input type="checkbox" name="success_rate[]" value="medium" class="w-4 h-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
                                    <span class="text-sm text-gray-700">普通（50-69%）</span>
                                    <span class="ml-auto w-2 h-2 md:w-3 md:h-3 bg-yellow-500 rounded-full"></span>
                                </label>
                                <label class="flex items-center gap-2 md:gap-3 py-1.5 md:py-2 px-2 md:px-3 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                                    <input type="checkbox" name="success_rate[]" value="low" class="w-4 h-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
                                    <span class="text-sm text-gray-700">低い（50%未満）</span>
                                    <span class="ml-auto w-2 h-2 md:w-3 md:h-3 bg-red-500 rounded-full"></span>
                                </label>
                            </div>
                        </div>

                        <!-- ステータスフィルター -->
                        <div class="mb-6">
                            <h4 class="font-medium text-gray-900 mb-3 md:mb-4 flex items-center gap-2 text-sm md:text-base">
                                <i class="fas fa-clock text-orange-600"></i>
                                募集状況
                            </h4>
                            <div class="space-y-1 md:space-y-2">
                                <label class="flex items-center gap-2 md:gap-3 py-1.5 md:py-2 px-2 md:px-3 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                                    <input type="checkbox" name="status[]" value="active" class="w-4 h-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
                                    <span class="text-sm text-gray-700">募集中</span>
                                    <span class="ml-auto w-2 h-2 md:w-3 md:h-3 bg-green-500 rounded-full animate-pulse"></span>
                                </label>
                                <label class="flex items-center gap-2 md:gap-3 py-1.5 md:py-2 px-2 md:px-3 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                                    <input type="checkbox" name="status[]" value="upcoming" class="w-4 h-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
                                    <span class="text-sm text-gray-700">募集予定</span>
                                    <span class="ml-auto w-2 h-2 md:w-3 md:h-3 bg-yellow-500 rounded-full"></span>
                                </label>
                            </div>
                        </div>

                        <!-- モバイル用アクションボタン -->
                        <div class="flex md:hidden gap-3 pt-4 border-t">
                            <button id="clear-filters-mobile" class="flex-1 py-3 px-4 text-sm text-emerald-600 border border-emerald-600 rounded-lg hover:bg-emerald-50 transition-colors">
                                クリア
                            </button>
                            <button id="apply-filters-mobile" class="flex-1 py-3 px-4 text-sm bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors">
                                適用
                            </button>
                        </div>

                        <!-- フィルター統計表示（デスクトップのみ） -->
                        <div class="hidden md:block bg-gradient-to-r from-emerald-50 to-teal-50 rounded-lg p-4 text-center border border-emerald-200">
                            <div class="text-2xl font-bold text-emerald-600" id="filter-stats-count">-</div>
                            <div class="text-sm text-emerald-700">該当する助成金</div>
                            <div class="text-xs text-emerald-600 mt-1" id="filter-stats-detail">条件を設定してください</div>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- メインコンテンツエリア -->
            <main class="flex-1">
                <!-- 検索結果ヘッダー -->
                <div id="results-header" class="mb-4 md:mb-6 p-3 md:p-4 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-lg border border-emerald-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <span id="results-count" class="text-base md:text-lg font-semibold text-emerald-900">検索中...</span>
                            <span id="results-query" class="text-xs md:text-sm text-emerald-700 ml-2 block md:inline mt-1 md:mt-0"></span>
                        </div>
                        <div id="loading-spinner" class="hidden">
                            <div class="flex items-center gap-2">
                                <div class="animate-spin rounded-full h-3 w-3 md:h-4 md:w-4 border-b-2 border-emerald-600"></div>
                                <span class="text-xs md:text-sm text-emerald-600 hidden md:inline">検索中</span>
                            </div>
                        </div>
                    </div>
                    <!-- 選択中のフィルター表示 -->
                    <div id="active-filters" class="mt-2 md:mt-3 flex flex-wrap gap-1 md:gap-2"></div>
                </div>

                <!-- 助成金カード表示エリア -->
                <div id="grants-container">
                    <!-- グリッド表示（完全に排他的な制御） -->
                    <div id="grid-container" class="grants-view-grid mobile-grant-grid">
                        <?php
                        // 初期表示用：デバイス別カードテンプレートで最新助成金を表示
                        $initial_grants = get_posts(array(
                            'post_type' => 'grant',
                            'posts_per_page' => 6,
                            'post_status' => 'publish',
                            'orderby' => 'date',
                            'order' => 'DESC'
                        ));
                        
                        if (!empty($initial_grants)) {
                            foreach ($initial_grants as $post) {
                                setup_postdata($post);
                                
                                // デバイス判定による条件分岐
                                if (wp_is_mobile()) {
                                    $card_template_path = get_template_directory() . '/template-parts/front-page/grant-card-mobile-compact.php';
                                } else {
                                    $card_template_path = get_template_directory() . '/template-parts/grant-card-v4-enhanced.php';
                                }
                                
                                if (file_exists($card_template_path)) {
                                    include $card_template_path;
                                } else {
                                    // フォールバック：基本カード
                                    ?>
                                    <div class="grant-card bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-all duration-200 p-4">
                                        <h3 class="text-lg font-semibold mb-2">
                                            <a href="<?php echo esc_url(get_permalink()); ?>" class="text-gray-900 hover:text-emerald-600">
                                                <?php echo esc_html(get_the_title()); ?>
                                            </a>
                                        </h3>
                                        <div class="text-sm text-gray-600 mb-3">
                                            📍 <?php echo esc_html(gi_get_prefecture_name($post->ID)); ?>
                                            🏷️ <?php echo esc_html(gi_get_category_name($post->ID)); ?>
                                        </div>
                                        <div class="text-lg font-bold text-emerald-600 mb-3">
                                            💰 <?php echo gi_format_amount(gi_safe_get_meta($post->ID, 'grant_amount')); ?>
                                        </div>
                                        <a href="<?php echo esc_url(get_permalink()); ?>" 
                                           class="inline-block w-full py-2 px-4 bg-emerald-600 text-white text-center rounded-lg hover:bg-emerald-700 transition-colors text-sm">
                                            詳細を見る
                                        </a>
                                    </div>
                                    <?php
                                }
                            }
                            wp_reset_postdata();
                        } else {
                            ?>
                            <div class="col-span-full text-center py-12 md:py-16">
                                <div class="w-16 h-16 md:w-24 md:h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-coins text-gray-400 text-xl md:text-2xl"></i>
                                </div>
                                <h3 class="text-lg md:text-xl font-semibold text-gray-600 mb-2">助成金データがありません</h3>
                                <p class="text-sm md:text-base text-gray-500">管理画面から助成金を追加してください。</p>
                            </div>
                            <?php
                        }
                        ?>
                    </div>

                    <!-- リスト表示（完全に排他的な制御） -->
                    <div id="list-container" class="grants-view-list hidden space-y-4 md:space-y-6">
                        <!-- リストカードがここに動的に読み込まれます -->
                    </div>
                </div>

                <!-- ページネーション -->
                <div id="pagination-container" class="mt-8 md:mt-12 flex justify-center">
                    <!-- ページネーションがここに表示されます -->
                </div>

                <!-- ローディング表示 -->
                <div id="main-loading" class="hidden text-center py-8 md:py-12">
                    <div class="inline-flex items-center px-6 md:px-8 py-3 md:py-4 bg-white rounded-xl md:rounded-2xl shadow-lg border border-gray-100">
                        <div class="animate-spin rounded-full h-6 w-6 md:h-8 md:w-8 border-b-2 border-emerald-600 mr-3 md:mr-4"></div>
                        <div>
                            <p class="text-base md:text-lg font-medium text-gray-800 mb-1">助成金情報を読み込んでいます...</p>
                            <p class="text-xs md:text-sm text-gray-600">最適なデザインで表示されます</p>
                        </div>
                    </div>
                </div>

                <!-- 結果なし表示 -->
                <div id="no-results" class="hidden text-center py-12 md:py-16">
                    <div class="w-24 h-24 md:w-32 md:h-32 bg-gradient-to-r from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6 md:mb-8">
                        <i class="fas fa-search text-2xl md:text-4xl text-gray-400"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-semibold text-gray-900 mb-3 md:mb-4">該当する助成金が見つかりませんでした</h3>
                    <p class="text-sm md:text-base text-gray-600 mb-6 md:mb-8 max-w-lg mx-auto">検索条件を変更して再度お試しください。または、より広い条件で検索してみてください。</p>
                    <div class="flex flex-col md:flex-row justify-center gap-3 md:gap-4">
                        <button id="reset-search" class="py-2 md:py-3 px-4 md:px-6 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors shadow-md hover:shadow-lg transform hover:-translate-y-0.5 text-sm md:text-base">
                            <i class="fas fa-refresh mr-2"></i>検索条件をリセット
                        </button>
                        <a href="<?php echo home_url('/'); ?>" class="py-2 md:py-3 px-4 md:px-6 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-sm md:text-base">
                            <i class="fas fa-home mr-2"></i>トップページに戻る
                        </a>
                    </div>
                </div>

                <!-- エラー表示 -->
                <div id="error-display" class="hidden text-center py-12 md:py-16">
                    <div class="w-24 h-24 md:w-32 md:h-32 bg-gradient-to-r from-red-100 to-red-200 rounded-full flex items-center justify-center mx-auto mb-6 md:mb-8">
                        <i class="fas fa-exclamation-triangle text-2xl md:text-4xl text-red-500"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-semibold text-gray-900 mb-3 md:mb-4">エラーが発生しました</h3>
                    <p class="text-sm md:text-base text-gray-600 mb-6 md:mb-8 max-w-lg mx-auto" id="error-message">通信エラーが発生しました。しばらく時間をおいて再度お試しください。</p>
                    <button id="retry-loading" class="py-2 md:py-3 px-4 md:px-6 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors shadow-md hover:shadow-lg transform hover:-translate-y-0.5 text-sm md:text-base">
                        <i class="fas fa-redo mr-2"></i>再試行
                    </button>
                </div>
            </main>
        </div>
    </div>
</div>

<script>
// Grant Archive JavaScript - Complete Fixed Version
document.addEventListener('DOMContentLoaded', function() {
    const GrantArchive = {
        currentView: 'grid',
        currentPage: 1,
        isLoading: false,
        isMobile: window.innerWidth <= 768,
        ajaxUrl: '<?php echo admin_url('admin-ajax.php'); ?>',
        nonce: '<?php echo wp_create_nonce('gi_ajax_nonce'); ?>',
        filters: {
            search: '',
            categories: [],
            categorySlugs: [],
            prefectures: [],
            prefectureSlugs: [],
            amount: '',
            status: [],
            difficulty: [],
            success_rate: [],
            sort: 'date_desc'
        },

        init() {
            this.bindEvents();
            this.updateResultsHeader(<?php echo $total_grants; ?>, {});
            this.updateFilterStats(<?php echo $total_grants; ?>);
            this.initializeHelpers();
            this.initializeCardEvents();
            this.handleResize();
        },

        bindEvents() {
            // 検索
            const searchInput = document.getElementById('grant-search');
            if (searchInput) {
                searchInput.addEventListener('input', (e) => {
                    this.filters.search = e.target.value;
                    this.debounce(() => this.loadGrants(), 500)();
                });
            }

            const searchBtn = document.getElementById('search-btn');
            if (searchBtn) {
                searchBtn.addEventListener('click', () => {
                    this.loadGrants();
                });
            }

            // 表示切り替え（デスクトップのみ）
            const gridView = document.getElementById('grid-view');
            if (gridView) {
                gridView.addEventListener('click', () => {
                    this.switchView('grid');
                });
            }

            const listView = document.getElementById('list-view');
            if (listView) {
                listView.addEventListener('click', () => {
                    this.switchView('list');
                });
            }

            // 並び順（デスクトップ・モバイル共通）
            ['sort-order', 'sort-order-mobile'].forEach(id => {
                const sortOrder = document.getElementById(id);
                if (sortOrder) {
                    sortOrder.addEventListener('change', (e) => {
                        this.filters.sort = e.target.value;
                        // 他の並び順セレクトボックスを同期
                        document.querySelectorAll('#sort-order, #sort-order-mobile').forEach(select => {
                            if (select !== e.target) select.value = e.target.value;
                        });
                        this.loadGrants();
                    });
                }
            });

            // モバイル用フィルタートグル
            const mobileFilterToggle = document.getElementById('mobile-filter-toggle');
            if (mobileFilterToggle) {
                mobileFilterToggle.addEventListener('click', () => {
                    this.toggleMobileFilters();
                });
            }

            const closeSidebar = document.getElementById('close-filter-sidebar');
            if (closeSidebar) {
                closeSidebar.addEventListener('click', () => {
                    this.closeMobileFilters();
                });
            }

            // モバイル用フィルターアクション
            const applyFiltersMobile = document.getElementById('apply-filters-mobile');
            if (applyFiltersMobile) {
                applyFiltersMobile.addEventListener('click', () => {
                    this.closeMobileFilters();
                    this.loadGrants();
                });
            }

            const clearFiltersMobile = document.getElementById('clear-filters-mobile');
            if (clearFiltersMobile) {
                clearFiltersMobile.addEventListener('click', () => {
                    this.clearFilters();
                });
            }

            // クイックフィルター
            document.querySelectorAll('.quick-filter').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    document.querySelectorAll('.quick-filter').forEach(b => {
                        b.classList.remove('active', 'bg-emerald-600', 'text-white');
                        b.classList.add('bg-gray-200', 'text-gray-700');
                    });
                    
                    e.target.classList.add('active', 'bg-emerald-600', 'text-white');
                    e.target.classList.remove('bg-gray-200', 'text-gray-700');

                    const filter = e.target.dataset.filter;
                    this.applyQuickFilter(filter);
                });
            });

            // 都道府県・カテゴリ展開
            const togglePrefectures = document.getElementById('toggle-prefectures');
            if (togglePrefectures) {
                togglePrefectures.addEventListener('click', () => {
                    this.togglePrefectures();
                });
            }

            const toggleCategories = document.getElementById('toggle-categories');
            if (toggleCategories) {
                toggleCategories.addEventListener('click', () => {
                    this.toggleCategories();
                });
            }

            // フィルターイベント
            document.addEventListener('change', (e) => {
                if (e.target.classList.contains('prefecture-checkbox')) {
                    this.updatePrefectureFilters();
                } else if (e.target.classList.contains('category-checkbox')) {
                    this.updateCategoryFilters();
                } else if (e.target.name === 'amount') {
                    this.filters.amount = e.target.value;
                    this.updateFilterDisplay();
                    if (!this.isMobile) this.loadGrants();
                } else if (e.target.name === 'status[]') {
                    this.updateStatusFilters();
                } else if (e.target.name === 'difficulty[]') {
                    this.updateDifficultyFilters();
                } else if (e.target.name === 'success_rate[]') {
                    this.updateSuccessRateFilters();
                }
            });

            // ページネーション（イベント委譲）
            document.addEventListener('click', (e) => {
                if (e.target.classList.contains('pagination-btn')) {
                    e.preventDefault();
                    const page = parseInt(e.target.dataset.page);
                    if (page && page !== this.currentPage) {
                        this.currentPage = page;
                        this.loadGrants();
                        // モバイルでページ上部にスクロール
                        if (this.isMobile) {
                            document.querySelector('#grants-container').scrollIntoView({ behavior: 'smooth' });
                        }
                    }
                }
            });

            // フィルタークリア
            const clearFilters = document.getElementById('clear-filters');
            if (clearFilters) {
                clearFilters.addEventListener('click', () => {
                    this.clearFilters();
                });
            }

            // 検索リセット
            const resetSearch = document.getElementById('reset-search');
            if (resetSearch) {
                resetSearch.addEventListener('click', () => {
                    this.resetSearch();
                });
            }

            // 再試行
            const retryLoading = document.getElementById('retry-loading');
            if (retryLoading) {
                retryLoading.addEventListener('click', () => {
                    this.hideError();
                    this.loadGrants();
                });
            }

            // モバイルフィルターサイドバー外クリック
            document.addEventListener('click', (e) => {
                const isFilterSidebarClick = document.getElementById('filter-sidebar') && document.getElementById('filter-sidebar').contains(e.target);
                const isFilterToggleClick = document.getElementById('mobile-filter-toggle') && document.getElementById('mobile-filter-toggle').contains(e.target);

                if (!isFilterSidebarClick && !isFilterToggleClick && this.isMobile) {
                    this.closeMobileFilters();
                }
            });

            // リサイズイベント
            window.addEventListener('resize', () => {
                this.handleResize();
            });

            // タッチイベント（モバイル最適化）
            if ('ontouchstart' in window) {
                this.initTouchEvents();
            }
        },

        handleResize() {
            this.isMobile = window.innerWidth <= 768;
            
            // モバイル・デスクトップ切り替え時の処理
            if (this.isMobile) {
                this.closeMobileFilters();
            }
        },

        initTouchEvents() {
            // カードのタッチ最適化
            document.addEventListener('touchstart', (e) => {
                if (e.target.closest('.grant-card-enhanced, .grant-card')) {
                    e.target.closest('.grant-card-enhanced, .grant-card').style.transform = 'scale(0.98)';
                }
            });

            document.addEventListener('touchend', (e) => {
                if (e.target.closest('.grant-card-enhanced, .grant-card')) {
                    setTimeout(() => {
                        const card = e.target.closest('.grant-card-enhanced, .grant-card');
                        if (card) card.style.transform = '';
                    }, 150);
                }
            });
        },

        toggleMobileFilters() {
            const sidebar = document.getElementById('filter-sidebar');
            if (sidebar) {
                sidebar.classList.remove('hidden');
                sidebar.classList.add('flex');
                document.body.style.overflow = 'hidden';
            }
        },

        closeMobileFilters() {
            const sidebar = document.getElementById('filter-sidebar');
            if (sidebar) {
                sidebar.classList.add('hidden');
                sidebar.classList.remove('flex');
                document.body.style.overflow = '';
            }
        },

        applyQuickFilter(filter) {
            this.resetFiltersToDefault();

            switch (filter) {
                case 'all':
                    break;
                case 'national':
                    let nationalSlug = '';
                    document.querySelectorAll('.prefecture-checkbox').forEach(cb => {
                        const label = cb.closest('label');
                        if (label && label.textContent.includes('全国対応')) {
                            nationalSlug = cb.value;
                            cb.checked = true;
                        } else {
                            cb.checked = false;
                        }
                    });
                    this.filters.prefectures = ['全国対応'];
                    this.filters.prefectureSlugs = nationalSlug ? [nationalSlug] : [];
                    break;
                case 'high-rate':
                    this.filters.success_rate = ['high'];
                    document.querySelectorAll('input[name="success_rate[]"]').forEach(cb => {
                        cb.checked = cb.value === 'high';
                    });
                    break;
                default:
                    this.filters.status = [filter];
                    document.querySelectorAll('input[name="status[]"]').forEach(cb => {
                        cb.checked = cb.value === filter;
                    });
                    break;
            }
            this.updateFilterDisplay();
            this.loadGrants();
        },

        resetFiltersToDefault() {
            this.filters = {
                search: this.filters.search,
                categories: [],
                categorySlugs: [],
                prefectures: [],
                prefectureSlugs: [],
                amount: '',
                status: [],
                difficulty: [],
                success_rate: [],
                sort: this.filters.sort
            };

            document.querySelectorAll('input[type="checkbox"]').forEach(cb => {
                if (!cb.classList.contains('prefecture-checkbox') || !cb.name.includes('search')) {
                    cb.checked = false;
                }
            });
            document.querySelectorAll('input[type="radio"]').forEach(rb => {
                rb.checked = rb.value === '';
            });
        },

        // 【修正】表示切り替えの完全な排他制御
        switchView(view) {
            if (this.isMobile) return; // モバイルでは表示切り替えを無効

            this.currentView = view;
            
            // ボタンのスタイル切り替え
            document.querySelectorAll('.view-toggle').forEach(btn => {
                btn.classList.remove('active', 'bg-white', 'text-emerald-600', 'shadow-sm');
                btn.classList.add('text-gray-600');
            });
            
            const activeBtn = document.getElementById(view + '-view');
            if (activeBtn) {
                activeBtn.classList.add('active', 'bg-white', 'text-emerald-600', 'shadow-sm');
                activeBtn.classList.remove('text-gray-600');
            }

            // コンテナの完全排他的切り替え - 強制的に片方のみ表示
            const gridContainer = document.getElementById('grid-container');
            const listContainer = document.getElementById('list-container');
            
            // すべてのコンテナを一旦非表示
            if (gridContainer) {
                gridContainer.style.display = 'none';
                gridContainer.classList.add('hidden');
                gridContainer.classList.remove('grants-view-grid');
            }
            if (listContainer) {
                listContainer.style.display = 'none';
                listContainer.classList.add('hidden');
                listContainer.classList.remove('grants-view-list');
            }
            
            // 指定されたビューのみ表示
            setTimeout(() => {
                if (view === 'grid' && gridContainer) {
                    gridContainer.style.display = '';
                    gridContainer.classList.remove('hidden');
                    gridContainer.classList.add('grants-view-grid', 'mobile-grant-grid');
                } else if (view === 'list' && listContainer) {
                    listContainer.style.display = '';
                    listContainer.classList.remove('hidden');
                    listContainer.classList.add('grants-view-list');
                }
            }, 10);

            this.loadGrants();
        },

        togglePrefectures() {
            const allPrefectures = document.getElementById('all-prefectures');
            const toggleBtn = document.getElementById('toggle-prefectures');
            const toggleText = toggleBtn.querySelector('.toggle-text');
            const toggleIcon = toggleBtn.querySelector('.toggle-icon');

            if (allPrefectures && allPrefectures.classList.contains('hidden')) {
                allPrefectures.classList.remove('hidden');
                if (toggleText) toggleText.textContent = '都道府県を閉じる';
                if (toggleIcon) toggleIcon.style.transform = 'rotate(180deg)';
            } else if (allPrefectures) {
                allPrefectures.classList.add('hidden');
                if (toggleText) toggleText.textContent = 'その他の都道府県を表示';
                if (toggleIcon) toggleIcon.style.transform = 'rotate(0deg)';
            }
        },

        toggleCategories() {
            const moreCategories = document.getElementById('more-categories');
            const toggleBtn = document.getElementById('toggle-categories');
            const toggleText = toggleBtn.querySelector('.toggle-text');
            const toggleIcon = toggleBtn.querySelector('.toggle-icon');

            if (moreCategories && moreCategories.classList.contains('hidden')) {
                moreCategories.classList.remove('hidden');
                if (toggleText) toggleText.textContent = 'カテゴリを閉じる';
                if (toggleIcon) toggleIcon.style.transform = 'rotate(180deg)';
            } else if (moreCategories) {
                moreCategories.classList.add('hidden');
                if (toggleText) toggleText.textContent = 'その他のカテゴリを表示';
                if (toggleIcon) toggleIcon.style.transform = 'rotate(0deg)';
            }
        },

        updatePrefectureFilters() {
            const checkboxes = document.querySelectorAll('.prefecture-checkbox:checked');
            const names = [];
            const slugs = [];
            Array.from(checkboxes).forEach(cb => {
                const label = cb.closest('label');
                const nameSpan = label ? label.querySelector('span') : null;
                names.push(nameSpan ? nameSpan.textContent.trim() : cb.value);
                slugs.push(cb.value);
            });
            this.filters.prefectures = names;
            this.filters.prefectureSlugs = slugs;
            this.updateFilterDisplay();
            if (!this.isMobile) this.loadGrants();
        },

        updateCategoryFilters() {
            const checkboxes = document.querySelectorAll('.category-checkbox:checked');
            const names = [];
            const slugs = [];
            Array.from(checkboxes).forEach(cb => {
                const label = cb.closest('label');
                const nameSpan = label ? label.querySelector('span') : null;
                names.push(nameSpan ? nameSpan.textContent.trim() : cb.value);
                slugs.push(cb.value);
            });
            this.filters.categories = names;
            this.filters.categorySlugs = slugs;
            this.updateFilterDisplay();
            if (!this.isMobile) this.loadGrants();
        },

        updateStatusFilters() {
            const checkboxes = document.querySelectorAll('input[name="status[]"]:checked');
            this.filters.status = Array.from(checkboxes).map(cb => cb.value);
            this.updateFilterDisplay();
            if (!this.isMobile) this.loadGrants();
        },

        updateDifficultyFilters() {
            const checkboxes = document.querySelectorAll('input[name="difficulty[]"]:checked');
            this.filters.difficulty = Array.from(checkboxes).map(cb => cb.value);
            this.updateFilterDisplay();
            if (!this.isMobile) this.loadGrants();
        },

        updateSuccessRateFilters() {
            const checkboxes = document.querySelectorAll('input[name="success_rate[]"]:checked');
            this.filters.success_rate = Array.from(checkboxes).map(cb => cb.value);
            this.updateFilterDisplay();
            if (!this.isMobile) this.loadGrants();
        },

        updateFilterDisplay() {
            const container = document.getElementById('active-filters');
            if (!container) return;
            
            container.innerHTML = '';

            // モバイルではより簡潔な表示
            const maxDisplayItems = this.isMobile ? 3 : 10;
            let itemCount = 0;

            // 都道府県バッジ
            if (itemCount < maxDisplayItems) {
                this.filters.prefectures.slice(0, maxDisplayItems - itemCount).forEach(pref => {
                    const badge = this.createFilterBadge(pref, 'prefecture', '📍');
                    container.appendChild(badge);
                    itemCount++;
                });
            }

            // カテゴリバッジ
            if (itemCount < maxDisplayItems) {
                this.filters.categories.slice(0, maxDisplayItems - itemCount).forEach(cat => {
                    const badge = this.createFilterBadge(cat, 'category', '🏷️');
                    container.appendChild(badge);
                    itemCount++;
                });
            }

            // その他のフィルター
            if (itemCount < maxDisplayItems && this.filters.amount) {
                const amountLabels = {
                    '0-100': '100万円以下',
                    '100-500': '100万円〜500万円',
                    '500-1000': '500万円〜1000万円',
                    '1000+': '1000万円以上'
                };
                const badge = this.createFilterBadge(amountLabels[this.filters.amount], 'amount', '💰');
                container.appendChild(badge);
                itemCount++;
            }

            // 残りの件数を表示（モバイルのみ）
            const totalFilters = this.filters.prefectures.length + this.filters.categories.length + 
                               (this.filters.amount ? 1 : 0) + this.filters.difficulty.length + 
                               this.filters.success_rate.length + this.filters.status.length;
            
            if (this.isMobile && totalFilters > maxDisplayItems) {
                const moreSpan = document.createElement('span');
                moreSpan.className = 'inline-flex items-center px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-full';
                moreSpan.textContent = `+${totalFilters - maxDisplayItems}個`;
                container.appendChild(moreSpan);
            }
        },

        createFilterBadge(text, type, icon) {
            const badge = document.createElement('span');
            badge.className = 'inline-flex items-center gap-1 px-2 md:px-3 py-1 bg-emerald-100 text-emerald-800 text-xs md:text-sm rounded-full animate-fade-in';
            badge.innerHTML = `
                <span class="text-xs">${icon}</span>
                <span class="max-w-20 md:max-w-none truncate">${this.escapeHtml(text)}</span>
                <button class="ml-1 hover:bg-emerald-200 rounded-full w-3 h-3 md:w-4 md:h-4 flex items-center justify-center transition-colors" onclick="GrantArchive.removeFilter('${type}', '${this.escapeHtml(text)}')">
                    <i class="fas fa-times text-xs"></i>
                </button>
            `;
            return badge;
        },

        removeFilter(type, value) {
            if (type === 'prefecture') {
                this.filters.prefectures = this.filters.prefectures.filter(p => p !== value);
                document.querySelectorAll('.prefecture-checkbox').forEach(cb => {
                    const label = cb.closest('label');
                    const nameSpan = label.querySelector('span');
                    const prefName = nameSpan ? nameSpan.textContent.trim() : cb.value;
                    if (prefName === value) cb.checked = false;
                });
            } else if (type === 'category') {
                this.filters.categories = this.filters.categories.filter(c => c !== value);
                document.querySelectorAll('.category-checkbox').forEach(cb => {
                    const label = cb.closest('label');
                    const nameSpan = label.querySelector('span');
                    const catName = nameSpan ? nameSpan.textContent.trim() : cb.value;
                    if (catName === value) cb.checked = false;
                });
            } else if (type === 'amount') {
                this.filters.amount = '';
                document.querySelectorAll('input[name="amount"]').forEach(rb => {
                    rb.checked = rb.value === '';
                });
            }

            this.updateFilterDisplay();
            this.loadGrants();
        },

        clearFilters() {
            const searchInput = document.getElementById('grant-search');
            if (searchInput) searchInput.value = '';
            
            document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
            document.querySelectorAll('input[type="radio"]').forEach(rb => {
                rb.checked = rb.value === '';
            });

            this.filters = {
                search: '',
                categories: [],
                categorySlugs: [],
                prefectures: [],
                prefectureSlugs: [],
                amount: '',
                status: [],
                difficulty: [],
                success_rate: [],
                sort: 'date_desc'
            };

            document.querySelectorAll('.quick-filter').forEach(btn => {
                btn.classList.remove('active', 'bg-emerald-600', 'text-white');
                btn.classList.add('bg-gray-200', 'text-gray-700');
            });
            
            const allFilter = document.querySelector('.quick-filter[data-filter="all"]');
            if (allFilter) {
                allFilter.classList.add('active', 'bg-emerald-600', 'text-white');
                allFilter.classList.remove('bg-gray-200', 'text-gray-700');
            }

            this.updateFilterDisplay();
            this.loadGrants();
        },

        resetSearch() {
            this.clearFilters();
            this.hideNoResults();
            this.hideError();
        },

        async loadGrants() {
            if (this.isLoading) return;
            
            this.isLoading = true;
            this.showLoading();
            this.hideNoResults();
            this.hideError();

            try {
                const response = await fetch(this.ajaxUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        action: 'gi_load_grants',
                        nonce: this.nonce,
                        search: this.filters.search,
                        amount: this.filters.amount,
                        sort: this.filters.sort,
                        view: this.isMobile ? 'grid' : this.currentView, // モバイルは常にグリッド
                        page: this.currentPage,
                        is_mobile: this.isMobile ? '1' : '0', // モバイル判定を送信
                        categories: JSON.stringify(this.filters.categorySlugs || []),
                        prefectures: JSON.stringify(this.filters.prefectureSlugs || []),
                        status: JSON.stringify(this.filters.status),
                        difficulty: JSON.stringify(this.filters.difficulty || []),
                        success_rate: JSON.stringify(this.filters.success_rate || [])
                    })
                });

                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                }

                const data = await response.json();
                
                if (data.success) {
                    this.renderGrants(data.data);
                } else {
                    throw new Error(data.data?.message || '検索中にエラーが発生しました');
                }
            } catch (error) {
                console.error('Load grants error:', error);
                this.showError(error.message || '通信エラーが発生しました');
            } finally {
                this.isLoading = false;
                this.hideLoading();
            }
        },

        renderGrants(data) {
            const { grants, found_posts, pagination, query_info } = data;
            
            this.updateResultsHeader(found_posts, query_info);
            this.updateFilterStats(found_posts);

            if (!grants || grants.length === 0) {
                this.showNoResults();
                return;
            }

            this.showGrantsContainer();

            // 【修正】表示の完全排他制御 - 強制的に片方のみレンダリング
            const gridContainer = document.getElementById('grid-container');
            const listContainer = document.getElementById('list-container');
            
            // すべてのコンテナを一旦クリア
            if (gridContainer) {
                gridContainer.style.display = 'none';
                gridContainer.classList.add('hidden');
            }
            if (listContainer) {
                listContainer.style.display = 'none';
                listContainer.classList.add('hidden');
                listContainer.innerHTML = '';
            }
            
            // モバイルまたはグリッドビューの場合
            if (this.isMobile || this.currentView === 'grid') {
                this.renderGridView(grants);
                if (gridContainer) {
                    setTimeout(() => {
                        gridContainer.style.display = '';
                        gridContainer.classList.remove('hidden');
                    }, 10);
                }
            } else {
                // リストビューの場合
                this.renderListView(grants);
                if (listContainer) {
                    setTimeout(() => {
                        listContainer.style.display = '';
                        listContainer.classList.remove('hidden');
                    }, 10);
                }
            }

            // ページネーション表示
            const paginationContainer = document.getElementById('pagination-container');
            if (paginationContainer && pagination.html) {
                paginationContainer.innerHTML = pagination.html;
            }

            this.initializeCardEvents();
            
            // モバイルでのスクロール最適化
            if (this.isMobile && this.currentPage > 1) {
                setTimeout(() => {
                    const firstCard = document.querySelector('.grant-card-enhanced, .grant-card');
                    if (firstCard) {
                        firstCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                }, 100);
            }
        },

        renderGridView(grants) {
            const container = document.getElementById('grid-container');
            if (!container) return;
            
            // 強制的に表示状態を設定
            container.style.display = '';
            container.classList.remove('hidden');
            container.classList.add('grants-view-grid', 'mobile-grant-grid');
            container.innerHTML = grants.map(grant => grant.html).join('');
            this.animateCards();
        },

        renderListView(grants) {
            if (this.isMobile) return; // モバイルではリスト表示を無効
            
            const container = document.getElementById('list-container');
            if (!container) return;
            
            // 強制的に表示状態を設定
            container.style.display = '';
            container.classList.remove('hidden');
            container.classList.add('grants-view-list');
            container.innerHTML = grants.map(grant => grant.html).join('');
            this.animateCards();
        },

        initializeCardEvents() {
            // お気に入りボタン
            document.querySelectorAll('.favorite-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.toggleFavorite(btn);
                });
            });

            // シェアボタン
            document.querySelectorAll('.share-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.shareGrant(btn);
                });
            });
        },

        updateResultsHeader(count, queryInfo) {
            const header = document.getElementById('results-count');
            const query = document.getElementById('results-query');
            
            if (header) {
                header.textContent = `${count || 0}件の助成金が見つかりました`;
            }
            
            if (query) {
                let queryText = [];
                if (this.filters.search) queryText.push(`「${this.filters.search}」`);
                if ((this.filters.prefectures || []).length > 0) queryText.push(`${this.filters.prefectures.slice(0, 2).join('、')}${this.filters.prefectures.length > 2 ? '他' : ''}`);
                if ((this.filters.categories || []).length > 0) queryText.push(`${this.filters.categories.slice(0, 2).join('、')}${this.filters.categories.length > 2 ? '他' : ''}`);
                
                query.textContent = queryText.length > 0 ? `${queryText.join(' / ')}の検索結果` : '';
            }
        },

        updateFilterStats(count) {
            const statsCount = document.getElementById('filter-stats-count');
            const statsDetail = document.getElementById('filter-stats-detail');
            
            if (statsCount) {
                statsCount.textContent = count || 0;
            }
            
            if (statsDetail) {
                const activeFilters = [];
                if (this.filters.prefectures.length > 0) activeFilters.push(`地域: ${this.filters.prefectures.length}`);
                if (this.filters.categories.length > 0) activeFilters.push(`カテゴリ: ${this.filters.categories.length}`);
                if (this.filters.difficulty.length > 0) activeFilters.push(`難易度: ${this.filters.difficulty.length}`);
                if (this.filters.success_rate.length > 0) activeFilters.push(`採択率: ${this.filters.success_rate.length}`);
                
                statsDetail.textContent = activeFilters.length > 0 ? activeFilters.join(', ') : '条件を設定してください';
            }
        },

        showLoading() {
            const spinner = document.getElementById('loading-spinner');
            const mainLoading = document.getElementById('main-loading');
            
            if (spinner) spinner.classList.remove('hidden');
            if (mainLoading) mainLoading.classList.remove('hidden');
        },

        hideLoading() {
            const spinner = document.getElementById('loading-spinner');
            const mainLoading = document.getElementById('main-loading');
            
            if (spinner) spinner.classList.add('hidden');
            if (mainLoading) mainLoading.classList.add('hidden');
        },

        showNoResults() {
            const grantsContainer = document.getElementById('grants-container');
            const noResults = document.getElementById('no-results');
            
            if (grantsContainer) grantsContainer.classList.add('hidden');
            if (noResults) noResults.classList.remove('hidden');
        },

        hideNoResults() {
            const grantsContainer = document.getElementById('grants-container');
            const noResults = document.getElementById('no-results');
            
            if (grantsContainer) grantsContainer.classList.remove('hidden');
            if (noResults) noResults.classList.add('hidden');
        },

        showGrantsContainer() {
            const grantsContainer = document.getElementById('grants-container');
            const noResults = document.getElementById('no-results');
            const errorDisplay = document.getElementById('error-display');
            
            if (grantsContainer) grantsContainer.classList.remove('hidden');
            if (noResults) noResults.classList.add('hidden');
            if (errorDisplay) errorDisplay.classList.add('hidden');
        },

        showError(message) {
            console.error('Grant Archive Error:', message);
            
            const grantsContainer = document.getElementById('grants-container');
            const noResults = document.getElementById('no-results');
            const errorDisplay = document.getElementById('error-display');
            const errorMsg = document.getElementById('error-message');
            
            if (grantsContainer) grantsContainer.classList.add('hidden');
            if (noResults) noResults.classList.add('hidden');
            if (errorDisplay) errorDisplay.classList.remove('hidden');
            if (errorMsg) errorMsg.textContent = message;
            
            this.updateResultsHeader(0, {});
            this.updateFilterStats(0);
        },

        hideError() {
            const errorDisplay = document.getElementById('error-display');
            if (errorDisplay) errorDisplay.classList.add('hidden');
        },

        animateCards() {
            const cards = document.querySelectorAll('.grant-card-enhanced, .grant-list-item-enhanced, .grant-card');
            cards.forEach((card, index) => {
                if (!this.isMobile) {
                    card.style.animationDelay = `${index * 0.1}s`;
                }
            });
        },

        async toggleFavorite(btn) {
            const postId = btn.dataset.postId;
            
            try {
                const response = await fetch(this.ajaxUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        action: 'gi_toggle_favorite',
                        nonce: this.nonce,
                        post_id: postId
                    })
                });

                const data = await response.json();
                
                if (data.success) {
                    const icon = btn.querySelector('i');
                    if (data.data.action === 'added') {
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                        btn.title = 'お気に入りから削除';
                    } else {
                        icon.classList.remove('fas');
                        icon.classList.add('far');
                        btn.title = 'お気に入りに追加';
                    }
                    
                    btn.style.transform = 'scale(1.2)';
                    setTimeout(() => {
                        btn.style.transform = 'scale(1)';
                    }, 200);

                    this.showToast(data.data.message, 'success');
                } else {
                    throw new Error(data.data?.message || 'お気に入りの更新に失敗しました');
                }
            } catch (error) {
                console.error('Favorite toggle error:', error);
                this.showToast('お気に入りの更新中にエラーが発生しました', 'error');
            }
        },

        shareGrant(btn) {
            const url = btn.dataset.url;
            const title = btn.dataset.title;
            
            if (navigator.share && this.isMobile) {
                navigator.share({
                    title: title,
                    url: url
                }).catch(console.error);
            } else {
                navigator.clipboard.writeText(url).then(() => {
                    this.showToast('URLをクリップボードにコピーしました', 'success');
                }).catch(() => {
                    window.open(`https://twitter.com/intent/tweet?text=${encodeURIComponent(title)}&url=${encodeURIComponent(url)}`, '_blank');
                });
            }
        },

        showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `fixed top-4 right-4 z-50 px-4 md:px-6 py-2 md:py-3 rounded-lg shadow-lg text-white font-medium transition-all duration-300 transform translate-x-full text-sm md:text-base ${
                type === 'error' ? 'bg-red-600' : 
                type === 'success' ? 'bg-green-600' : 'bg-emerald-600'
            }`;
            toast.textContent = message;
            
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.style.transform = 'translateX(0)';
            }, 100);
            
            setTimeout(() => {
                toast.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    if (document.body.contains(toast)) {
                        document.body.removeChild(toast);
                    }
                }, 300);
            }, 3000);
        },

        initializeHelpers() {
            const searchInput = document.getElementById('grant-search');
            if (searchInput) {
                searchInput.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') {
                        this.loadGrants();
                    }
                });
            }

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    if (this.isMobile) {
                        this.closeMobileFilters();
                    }
                }
            });
        },

        escapeHtml(text) {
            if (!text) return '';
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        },

        debounce(func, wait) {
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
    };

    // グローバルに公開
    window.GrantArchive = GrantArchive;

    // 初期化
    GrantArchive.init();
});
</script>

<!-- 完全修正版CSS（ダークモード削除・フローティングボタン削除・排他制御強化） -->
<style>
/* Grant Archive Mobile Optimized Styles - Complete Fixed Version with Exclusive Control */

/* 重要: Tailwind CDNとの競合を防ぐためのリセット */
.grants-view-grid,
.grants-view-list,
.mobile-grant-grid {
    all: revert;
    box-sizing: border-box;
}

/* 基本レスポンシブ設定 - より具体的なセレクタで優先度を上げる */
#grants-container .mobile-grant-grid {
    display: grid !important;
    grid-template-columns: 1fr;
    gap: 0.75rem;
    padding: 0;
}

@media (min-width: 768px) {
    #grants-container .mobile-grant-grid {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 1rem;
    }
}

@media (min-width: 1024px) {
    #grants-container .mobile-grant-grid {
        grid-template-columns: repeat(3, 1fr) !important;
        gap: 1.5rem;
    }
}

@media (min-width: 1280px) {
    #grants-container .mobile-grant-grid {
        grid-template-columns: repeat(4, 1fr) !important;
    }
}

/* 表示切り替えの完全排他制御 - 強制優先度設定 */
#grants-container .grants-view-grid {
    display: grid !important;
}

#grants-container .grants-view-list {
    display: block !important;
}

#grants-container .grants-view-grid.hidden,
#grants-container .grants-view-list.hidden,
#grid-container.hidden,
#list-container.hidden {
    display: none !important;
    visibility: hidden !important;
    opacity: 0 !important;
    pointer-events: none !important;
}

/* スクロールバー非表示 */
.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}

/* テキスト省略 */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* アニメーション */
.animate-fade-in {
    animation: fadeIn 0.5s ease-out;
}

.animate-fade-in-up {
    animation: fadeInUp 0.6s ease-out;
}

.animate-bounce-gentle {
    animation: bounceGentle 2s ease-in-out infinite;
}

.animation-delay-200 {
    animation-delay: 0.2s;
}

.animation-delay-400 {
    animation-delay: 0.4s;
}

.animation-delay-1000 {
    animation-delay: 1s;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes bounceGentle {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

/* カードスタイル（モバイル最適化） */
.grant-card-enhanced {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.grant-card-enhanced:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

@media (min-width: 768px) {
    .grant-card-enhanced:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
}

.grant-list-item-enhanced {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.grant-list-item-enhanced:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

@media (min-width: 768px) {
    .grant-list-item-enhanced:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.15);
    }
}

/* モバイル専用スタイル */
@media (max-width: 767px) {
    /* コンテナパディング調整 */
    .container {
        padding-left: 0.75rem;
        padding-right: 0.75rem;
    }
    
    /* フォントサイズ調整 */
    .text-4xl { font-size: 1.875rem; }
    .text-5xl { font-size: 2.25rem; }
    .text-6xl { font-size: 2.75rem; }
    
    /* サイドバーが全画面表示 */
    #filter-sidebar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 9999;
    }
    
    #filter-sidebar > div {
        height: 100vh;
        overflow-y: auto;
    }
    
    /* カードの余白調整 */
    .grant-card-enhanced {
        margin-bottom: 0.75rem;
    }
    
    /* タッチターゲットサイズ確保 */
    button,
    .grant-card-enhanced a,
    input[type="checkbox"],
    input[type="radio"] {
        min-height: 44px;
        min-width: 44px;
    }
    
    /* チェックボックス・ラジオボタンのクリックエリア拡大 */
    label {
        min-height: 44px;
        display: flex;
        align-items: center;
    }
}

/* タブレット用調整 */
@media (min-width: 768px) and (max-width: 1023px) {
    .lg\:w-80 {
        width: 280px;
    }
    
    .mobile-grant-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
}

/* プリント対応 */
@media print {
    .fixed, .sticky {
        position: static;
    }
    
    .shadow-lg, .shadow-xl, .shadow-2xl {
        box-shadow: none;
        border: 1px solid #e5e7eb;
    }
    
    .hidden {
        display: none !important;
    }
    
    .animate-bounce-gentle,
    .animate-fade-in,
    .animate-fade-in-up {
        animation: none;
    }
    
    #filter-sidebar {
        position: static !important;
        background: transparent !important;
    }
    
    .mobile-grant-grid {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 1rem !important;
    }
}

/* アクセシビリティ対応 */
@media (prefers-reduced-motion: reduce) {
    .grant-card-enhanced,
    .grant-list-item-enhanced,
    .animate-bounce-gentle,
    .animate-fade-in,
    .animate-fade-in-up {
        animation: none;
        transition: none;
    }
}

/* ハイコントラスト対応 */
@media (prefers-contrast: high) {
    .grant-card-enhanced,
    .grant-list-item-enhanced {
        border: 2px solid #000;
    }
    
    .bg-emerald-600 {
        background-color: #000;
    }
    
    .text-emerald-600 {
        color: #000;
    }
}

/* フォーカス表示の改善 */
*:focus {
    outline: 2px solid #10b981;
    outline-offset: 2px;
}

.grant-card-enhanced:focus-within {
    ring: 2px;
    ring-color: #10b981;
}

/* ローディング表示の改善 */
@keyframes spin {
    to { transform: rotate(360deg); }
}

.animate-spin {
    animation: spin 1s linear infinite;
}

/* モバイルでのスムーズスクロール */
@media (max-width: 767px) {
    html {
        scroll-behavior: smooth;
    }
    
    body {
        -webkit-overflow-scrolling: touch;
    }
}

/* セーフエリア対応（iPhone X以降） */
@supports (padding: max(0px)) {
    @media (max-width: 767px) {
        .container {
            padding-left: max(0.75rem, env(safe-area-inset-left));
            padding-right: max(0.75rem, env(safe-area-inset-right));
        }
    }
}
</style>

<?php get_footer(); ?>