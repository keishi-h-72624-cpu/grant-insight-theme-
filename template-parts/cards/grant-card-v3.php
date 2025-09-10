<?php
/**
 * Grant Card v4 Enhanced - 助成金カード強化版（テーマ連携対応版）
 * このファイルはテーマの既存データ構造を読み込み、カードを表示します。
 * 必要なヘルパー関数(gi_safe_get_meta)はテーマ本体のものが使われます。
 * カードの操作(お気に入り等)は、テーマのメインJavaScriptが担当します。
 * 
 * @package Grant_Insight_Perfect
 * @version 4.0-theme-integrated
 */

// 投稿IDを取得
$grant_id = get_the_ID();
if (!$grant_id) {
    return; // IDがなければ何も表示しない
}

// ----------------------------------------------------------------
// § 1. データの取得と整形
// テーマの既存データ構造（カスタムフィールド名）に合わせて読み込みます。
// ----------------------------------------------------------------

// 金額 (既存の数値フィールド 'max_amount_numeric' を使用)
$grant_amount = gi_safe_get_meta($grant_id, 'max_amount_numeric', 0);

// 締切日 (既存のタイムスタンプフィールド 'deadline_date' を使用)
$deadline_timestamp = gi_safe_get_meta($grant_id, 'deadline_date', '');
$grant_deadline = $deadline_timestamp ? date('Y-m-d', (int)$deadline_timestamp) : null;

// 【新規項目】補助率 (カスタムフィールド 'subsidy_rate' を想定)
$grant_rate = gi_safe_get_meta($grant_id, 'subsidy_rate', '2/3');

// 【新規項目】対象事業者 (カスタムフィールド 'grant_target' を想定)
$grant_target = gi_safe_get_meta($grant_id, 'grant_target', '中小企業');

// 【新規項目】申請難易度 (カスタムフィールド 'grant_difficulty' を想定)
$grant_difficulty = gi_safe_get_meta($grant_id, 'grant_difficulty', 'normal');

// 【新規項目】採択率 (カスタムフィールド 'grant_success_rate' を想定)
$grant_success_rate = gi_safe_get_meta($grant_id, 'grant_success_rate', 65);

// 注目助成金かどうかのフラグ
$is_featured = gi_safe_get_meta($grant_id, 'is_featured', false);

// 閲覧数 (ダミーまたは 'views_count' フィールドから取得)
$views_count = gi_safe_get_meta($grant_id, 'views_count', mt_rand(100, 500));

// 分類情報（都道府県とカテゴリ）を取得
$prefectures = wp_get_post_terms($grant_id, 'grant_prefecture', array('fields' => 'names'));
$categories = wp_get_post_terms($grant_id, 'grant_category', array('fields' => 'names'));

// 締切までの残り日数を計算
$days_remaining = 0;
if ($deadline_timestamp) {
    $days_remaining = ceil(((int)$deadline_timestamp - time()) / (60 * 60 * 24));
}

// 難易度表示用の設定
$difficulty_config = array(
    'easy'   => array('label' => '易しい', 'color' => 'green', 'stars' => 1),
    'normal' => array('label' => '普通',   'color' => 'blue', 'stars' => 2),
    'hard'   => array('label' => '難しい', 'color' => 'orange', 'stars' => 3),
    'expert' => array('label' => '専門的', 'color' => 'red', 'stars' => 4)
);
$difficulty_info = $difficulty_config[$grant_difficulty] ?? $difficulty_config['normal'];

// お気に入り状態を取得
$user_favorites = function_exists('gi_get_user_favorites') ? gi_get_user_favorites() : [];
$is_favorite = in_array($grant_id, $user_favorites);

?>

<article class="grant-card-enhanced group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transform transition-all duration-500 hover:-translate-y-1 overflow-hidden" data-grant-id="<?php echo esc_attr($grant_id); ?>">
    
    <?php if ($is_featured): ?>
    <div class="absolute top-0 right-0 z-10">
        <div class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white text-xs font-bold py-2 px-4 rounded-bl-2xl shadow-lg">
            <i class="fas fa-star mr-1"></i>注目
        </div>
    </div>
    <?php endif; ?>
    
    <div class="relative">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 opacity-10 group-hover:opacity-20 transition-opacity duration-500"></div>
        <div class="relative p-6 pb-4">
            <div class="flex flex-wrap gap-2 mb-3">
                <?php if (!is_wp_error($categories) && !empty($categories)): ?>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                    <i class="fas fa-folder mr-1"></i><?php echo esc_html($categories[0]); ?>
                </span>
                <?php endif; ?>
                
                <?php if (!is_wp_error($prefectures) && !empty($prefectures)): ?>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                    <i class="fas fa-map-marker-alt mr-1"></i><?php echo esc_html($prefectures[0]); ?>
                </span>
                <?php endif; ?>
            </div>
            
            <h3 class="text-xl font-bold text-gray-800 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors duration-300">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
            
            <div class="flex items-center justify-between text-sm text-gray-600">
                <div class="flex items-center gap-3">
                    <span class="flex items-center">
                        <i class="fas fa-chart-line text-green-500 mr-1"></i>
                        採択率 <strong class="text-green-600 ml-1"><?php echo esc_html($grant_success_rate); ?>%</strong>
                    </span>
                    <span class="flex items-center">
                        <i class="fas fa-eye text-gray-400 mr-1"></i>
                        <?php echo number_format($views_count); ?>回閲覧
                    </span>
                </div>
            </div>
        </div>
        
        <?php if ($grant_deadline && $days_remaining > 0): ?>
        <div class="px-6 pb-4">
            <?php 
                $progress_percentage = max(0, min(100, (30 - $days_remaining) / 30 * 100));
                $progress_color = $days_remaining <= 7 ? 'red' : ($days_remaining <= 14 ? 'yellow' : 'green');
            ?>
            <div class="flex justify-between items-center mb-1 text-xs">
                <span class="text-gray-600">申請期限</span>
                <span class="font-bold text-<?php echo esc_attr($progress_color); ?>-600">
                    残り<?php echo esc_html($days_remaining); ?>日
                </span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-gradient-to-r from-<?php echo esc_attr($progress_color); ?>-400 to-<?php echo esc_attr($progress_color); ?>-600 h-2 rounded-full transition-all duration-500" 
                     style="width: <?php echo esc_attr($progress_percentage); ?>%"></div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    
    <div class="px-6 pb-4">
        <div class="mb-4 p-4 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl border border-emerald-200">
            <div class="text-sm text-gray-600 mb-1">最大支援額</div>
            <div class="flex items-baseline">
                <span class="text-3xl font-bold text-emerald-600">
                    <?php echo ($grant_amount > 0) ? number_format($grant_amount / 10000) : '-'; ?>
                </span>
                <?php if ($grant_amount > 0): ?>
                <span class="text-lg text-emerald-600 ml-1">万円</span>
                <?php endif; ?>
                <?php if ($grant_rate): ?>
                <span class="ml-3 text-sm text-gray-600">
                    (補助率: <strong><?php echo esc_html($grant_rate); ?></strong>)
                </span>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="mb-4">
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-600">申請難易度</span>
                <div class="flex items-center gap-1">
                    <?php for ($i = 1; $i <= 4; $i++): ?>
                    <i class="fas fa-star text-<?php echo $i <= $difficulty_info['stars'] ? esc_attr($difficulty_info['color']) : 'gray'; ?>-400"></i>
                    <?php endfor; ?>
                    <span class="ml-2 text-sm font-medium text-<?php echo esc_attr($difficulty_info['color']); ?>-600">
                        <?php echo esc_html($difficulty_info['label']); ?>
                    </span>
                </div>
            </div>
        </div>
        
        <div class="mb-4 p-3 bg-gray-50 rounded-lg">
            <div class="text-xs text-gray-600 mb-1">対象事業者</div>
            <div class="text-sm font-medium text-gray-800"><?php echo esc_html($grant_target); ?></div>
        </div>
    </div>
    
    <div class="px-6 pb-6">
        <div class="flex gap-3">
            <a href="<?php the_permalink(); ?>" 
               class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-medium rounded-lg hover:from-blue-700 hover:to-indigo-700 transform hover:scale-105 transition-all duration-300 shadow-md hover:shadow-xl">
                <span>詳細を見る</span>
                <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
            </a>
            
            <button type="button" 
                    class="favorite-btn p-3 bg-gray-100 hover:bg-red-100 rounded-lg transition-all duration-300 group/fav"
                    data-post-id="<?php echo esc_attr($grant_id); ?>">
                <i class="fa-heart text-gray-600 group-hover/fav:text-red-500 transition-colors duration-300 <?php echo $is_favorite ? 'fas' : 'far'; ?>"></i>
            </button>
            
            <button type="button" 
                    class="share-btn p-3 bg-gray-100 hover:bg-blue-100 rounded-lg transition-all duration-300 group/share"
                    data-url="<?php the_permalink(); ?>"
                    data-title="<?php the_title_attribute(); ?>">
                <i class="fas fa-share-alt text-gray-600 group-hover/share:text-blue-500 transition-colors duration-300"></i>
            </button>
        </div>
    </div>
    
    <div class="absolute inset-0 bg-gradient-to-t from-blue-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
</article>