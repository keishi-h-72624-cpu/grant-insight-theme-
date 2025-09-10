<?php
/**
 * Grant Card Optimized - N+1クエリ解消版
 * パフォーマンス最適化されたカードテンプレート
 * 
 * @package Grant_Insight_Perfect
 * @version 1.0-optimized
 */

// 投稿IDを取得
$grant_id = get_the_ID();
if (!$grant_id) {
    return;
}

// ----------------------------------------------------------------
// § 1. データの取得と整形（最適化版）
// メタデータとタームデータは事前にプリフェッチされている前提
// ----------------------------------------------------------------

// メタデータを一括取得（N+1クエリ解消）
$meta_data = get_post_meta($grant_id);

// ヘルパー関数で安全にメタデータを取得
function get_optimized_meta($meta_data, $key, $default = '') {
    return isset($meta_data[$key][0]) ? $meta_data[$key][0] : $default;
}

// 金額
$grant_amount = intval(get_optimized_meta($meta_data, 'max_amount_numeric', 0));

// 締切日
$deadline_timestamp = get_optimized_meta($meta_data, 'deadline_date', '');
$grant_deadline = $deadline_timestamp ? date('Y-m-d', (int)$deadline_timestamp) : null;

// 補助率
$grant_rate = get_optimized_meta($meta_data, 'subsidy_rate', '2/3');

// 対象事業者
$grant_target = get_optimized_meta($meta_data, 'grant_target', '中小企業');

// 申請難易度
$grant_difficulty = get_optimized_meta($meta_data, 'grant_difficulty', 'normal');

// 採択率
$grant_success_rate = intval(get_optimized_meta($meta_data, 'grant_success_rate', 65));

// 注目助成金フラグ
$is_featured = (bool)get_optimized_meta($meta_data, 'is_featured', false);

// 閲覧数
$views_count = intval(get_optimized_meta($meta_data, 'views_count', mt_rand(100, 500)));

// タームデータ（事前にプリフェッチされている前提）
global $gi_prefetched_terms;
$prefectures = isset($gi_prefetched_terms[$grant_id]['grant_prefecture']) ? 
    $gi_prefetched_terms[$grant_id]['grant_prefecture'] : array();
$categories = isset($gi_prefetched_terms[$grant_id]['grant_category']) ? 
    $gi_prefetched_terms[$grant_id]['grant_category'] : array();

// 締切までの残り日数を計算
$days_remaining = 0;
if ($deadline_timestamp) {
    $days_remaining = ceil(((int)$deadline_timestamp - time()) / (60 * 60 * 24));
}

// 難易度表示用の設定
$difficulty_config = array(
    'easy'   => array('label' => '易しい', 'color' => 'bg-green-100 text-green-700', 'stars' => 1),
    'normal' => array('label' => '普通',   'color' => 'bg-blue-100 text-blue-700', 'stars' => 2),
    'hard'   => array('label' => '難しい', 'color' => 'bg-orange-100 text-orange-700', 'stars' => 3),
    'expert' => array('label' => '専門的', 'color' => 'bg-red-100 text-red-700', 'stars' => 4)
);
$difficulty_info = $difficulty_config[$grant_difficulty] ?? $difficulty_config['normal'];

// お気に入り状態（キャッシュ化可能）
$user_favorites = function_exists('gi_get_user_favorites_cached') ? gi_get_user_favorites_cached() : gi_get_user_favorites();
$is_favorite = in_array($grant_id, $user_favorites);

?>

<article class="card grant-card-optimized" data-grant-id="<?php echo esc_attr($grant_id); ?>">
    
    <?php if ($is_featured): ?>
    <div class="featured-badge">
        <span class="badge bg-gradient-emerald text-white">
            ⭐ 注目
        </span>
    </div>
    <?php endif; ?>
    
    <div class="card-header">
        <div class="flex justify-between items-start mb-4">
            <div class="flex flex-wrap gap-2">
                <?php if (!empty($categories)): ?>
                <span class="badge bg-blue-100 text-blue-700">
                    📁 <?php echo esc_html($categories[0]); ?>
                </span>
                <?php endif; ?>
                
                <?php if (!empty($prefectures)): ?>
                <span class="badge bg-green-100 text-green-700">
                    📍 <?php echo esc_html($prefectures[0]); ?>
                </span>
                <?php endif; ?>
            </div>
            
            <button class="favorite-btn <?php echo $is_favorite ? 'active' : ''; ?>" 
                    data-grant-id="<?php echo esc_attr($grant_id); ?>"
                    aria-label="お気に入りに追加">
                ❤️
            </button>
        </div>
        
        <h3 class="card-title">
            <a href="<?php the_permalink(); ?>" class="text-gray-800 hover:text-blue-600">
                <?php the_title(); ?>
            </a>
        </h3>
    </div>
    
    <div class="card-body">
        <div class="grant-info grid grid-cols-2 gap-4 mb-4">
            <div class="info-item">
                <span class="label">最大金額</span>
                <span class="value text-emerald-600 font-bold">
                    <?php echo $grant_amount ? number_format($grant_amount) . '万円' : '要確認'; ?>
                </span>
            </div>
            
            <div class="info-item">
                <span class="label">補助率</span>
                <span class="value"><?php echo esc_html($grant_rate); ?></span>
            </div>
            
            <div class="info-item">
                <span class="label">難易度</span>
                <span class="badge <?php echo esc_attr($difficulty_info['color']); ?>">
                    <?php echo esc_html($difficulty_info['label']); ?>
                </span>
            </div>
            
            <div class="info-item">
                <span class="label">採択率</span>
                <span class="value"><?php echo esc_html($grant_success_rate); ?>%</span>
            </div>
        </div>
        
        <?php if ($grant_deadline): ?>
        <div class="deadline-info mb-4">
            <span class="label">締切日</span>
            <span class="value <?php echo $days_remaining <= 30 ? 'text-red-600' : 'text-gray-600'; ?>">
                <?php echo esc_html($grant_deadline); ?>
                <?php if ($days_remaining > 0): ?>
                    （残り<?php echo $days_remaining; ?>日）
                <?php endif; ?>
            </span>
        </div>
        <?php endif; ?>
        
        <div class="card-excerpt">
            <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
        </div>
    </div>
    
    <div class="card-footer">
        <div class="flex justify-between items-center">
            <span class="views-count text-gray-500 text-sm">
                👁️ <?php echo number_format($views_count); ?> 回閲覧
            </span>
            
            <a href="<?php the_permalink(); ?>" class="btn btn-primary">
                詳細を見る
            </a>
        </div>
    </div>
</article>

<style>
.grant-card-optimized {
    position: relative;
}

.featured-badge {
    position: absolute;
    top: -8px;
    right: -8px;
    z-index: 10;
}

.badge {
    display: inline-block;
    padding: 0.25rem 0.5rem;
    border-radius: 0.375rem;
    font-size: 0.75rem;
    font-weight: 600;
}

.card-title {
    font-size: 1.125rem;
    font-weight: 700;
    line-height: 1.4;
    margin-bottom: 1rem;
}

.card-title a {
    text-decoration: none;
    transition: color 0.2s ease;
}

.grant-info {
    background: #f9fafb;
    padding: 1rem;
    border-radius: 0.5rem;
}

.info-item {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.info-item .label {
    font-size: 0.75rem;
    color: #6b7280;
    font-weight: 500;
}

.info-item .value {
    font-weight: 600;
    color: #1f2937;
}

.deadline-info {
    padding: 0.75rem;
    background: #fef3c7;
    border-radius: 0.5rem;
    border-left: 4px solid #f59e0b;
}

.deadline-info .label {
    font-size: 0.875rem;
    color: #92400e;
    font-weight: 500;
    margin-right: 0.5rem;
}

.card-excerpt {
    color: #6b7280;
    line-height: 1.5;
}

.card-footer {
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid #e5e7eb;
}

.favorite-btn {
    background: none;
    border: none;
    font-size: 1.25rem;
    cursor: pointer;
    transition: transform 0.2s ease;
}

.favorite-btn:hover {
    transform: scale(1.1);
}

.favorite-btn.active {
    color: #ef4444;
}

.views-count {
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

@media (max-width: 640px) {
    .grant-info {
        grid-template-columns: 1fr;
    }
    
    .card-footer {
        flex-direction: column;
        gap: 0.75rem;
        align-items: stretch;
    }
}
</style>

