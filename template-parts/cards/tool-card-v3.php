<?php
/**
 * Tool Card v3 - ツールカード
 * 
 * 添付画像を参考にHTML構造をブラッシュアップ
 * モジュール化されたコンポーネント設計で再利用性と拡張性を向上
 */

// 必要なデータを取得
$tool_id = get_the_ID();
$price = gi_safe_get_meta($tool_id, 'price', '');
$company = gi_safe_get_meta($tool_id, 'company', '');
$rating = gi_safe_get_meta($tool_id, 'rating', '');
$review_count = gi_safe_get_meta($tool_id, 'review_count', '');
$user_count = gi_safe_get_meta($tool_id, 'user_count', '');
$integration_count = gi_safe_get_meta($tool_id, 'integration_count', '');
$features = gi_safe_get_meta($tool_id, 'features', '');
$trial_available = gi_safe_get_meta($tool_id, 'trial_available', '');
$tool_type = gi_safe_get_meta($tool_id, 'tool_type', '');

// カテゴリとタグを取得
$categories = get_the_terms($tool_id, 'tool_category');
$tags = get_the_terms($tool_id, 'tool_tag');
?>

<article class="tool-card" 
         data-tool-id="<?php echo gi_safe_attr($tool_id); ?>"
         data-price="<?php echo gi_safe_attr($price); ?>"
         data-rating="<?php echo gi_safe_attr($rating); ?>"
         data-type="<?php echo gi_safe_attr($tool_type); ?>"
         itemscope 
         itemtype="https://schema.org/SoftwareApplication">

    <!-- カードヘッダー（ブルーグラデーション背景） -->
    <header class="tool-card-header">
        <!-- ツールタイプバッジ -->
        <div class="card-type-badges">
            <?php if ($tool_type) : ?>
            <span class="type-badge">
                <span class="badge-icon">⚙️</span>
                <?php echo gi_safe_escape($tool_type); ?>
            </span>
            <?php endif; ?>
            
            <?php if ($trial_available) : ?>
            <span class="trial-badge">
                <span class="badge-icon">✨</span>
                無料体験
            </span>
            <?php endif; ?>
        </div>

        <!-- お気に入りボタン -->
        <button class="favorite-btn" 
                onclick="toggleToolFavorite(<?php echo $tool_id; ?>)"
                aria-label="お気に入りに追加">
            <span class="favorite-icon">♡</span>
        </button>

        <!-- 価格表示 -->
        <div class="price-display">
            <span class="price-label">月額</span>
            <span class="price-value" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                <?php if ($price) : ?>
                    <span itemprop="price">¥<?php echo gi_safe_number_format($price); ?></span>
                    <meta itemprop="priceCurrency" content="JPY">
                <?php else : ?>
                    <span class="price-contact">お問い合わせ</span>
                <?php endif; ?>
            </span>
        </div>
    </header>

    <!-- カードボディ -->
    <div class="tool-card-body">
        <!-- タイトルと会社 -->
        <div class="card-title-section">
            <h3 class="tool-title" itemprop="name">
                <a href="<?php the_permalink(); ?>" class="title-link">
                    <?php the_title(); ?>
                </a>
            </h3>
            
            <?php if ($company) : ?>
            <div class="tool-company" itemprop="author" itemscope itemtype="https://schema.org/Organization">
                <span class="company-icon">🏢</span>
                <span itemprop="name"><?php echo gi_safe_escape($company); ?></span>
            </div>
            <?php endif; ?>
        </div>

        <!-- 評価とレビュー -->
        <?php if ($rating && $review_count) : ?>
        <div class="tool-rating" itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating">
            <div class="rating-stars">
                <?php
                $full_stars = floor($rating);
                $half_star = ($rating - $full_stars) >= 0.5;
                
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $full_stars) {
                        echo '<span class="star star-filled">★</span>';
                    } elseif ($i == $full_stars + 1 && $half_star) {
                        echo '<span class="star star-half">★</span>';
                    } else {
                        echo '<span class="star star-empty">☆</span>';
                    }
                }
                ?>
            </div>
            <span class="rating-text">
                <span itemprop="ratingValue"><?php echo gi_safe_escape($rating); ?></span>
                (<span itemprop="reviewCount"><?php echo gi_safe_number_format($review_count); ?></span>件)
            </span>
        </div>
        <?php endif; ?>

        <!-- 概要 -->
        <div class="tool-excerpt" itemprop="description">
            <?php
            $excerpt = get_the_excerpt();
            if (mb_strlen($excerpt) > 120) {
                $excerpt = mb_substr($excerpt, 0, 120) . '...';
            }
            echo gi_safe_escape($excerpt);
            ?>
        </div>

        <!-- 利用統計 -->
        <div class="tool-stats">
            <?php if ($user_count) : ?>
            <div class="stat-item">
                <span class="stat-label">利用企業数</span>
                <span class="stat-value"><?php echo gi_safe_number_format($user_count); ?>社+</span>
            </div>
            <?php endif; ?>
            
            <?php if ($integration_count) : ?>
            <div class="stat-item">
                <span class="stat-label">連携数</span>
                <span class="stat-value"><?php echo gi_safe_number_format($integration_count); ?>+</span>
            </div>
            <?php endif; ?>
        </div>

        <!-- 主要機能 -->
        <?php if ($features && is_array($features)) : ?>
        <div class="tool-features">
            <h4 class="features-title">主要機能</h4>
            <div class="features-list">
                <?php foreach (array_slice($features, 0, 3) as $feature) : ?>
                <span class="feature-tag">
                    <?php echo gi_safe_escape($feature); ?>
                </span>
                <?php endforeach; ?>
                <?php if (count($features) > 3) : ?>
                <span class="feature-more">+<?php echo count($features) - 3; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- カテゴリタグ -->
        <div class="tool-tags">
            <?php if ($categories && !is_wp_error($categories)) : ?>
                <?php foreach (array_slice($categories, 0, 2) as $category) : ?>
                <span class="tag tag-category">
                    #<?php echo gi_safe_escape($category->name); ?>
                </span>
                <?php endforeach; ?>
            <?php endif; ?>
            
            <?php if ($tags && !is_wp_error($tags)) : ?>
                <?php foreach (array_slice($tags, 0, 2) as $tag) : ?>
                <span class="tag tag-feature">
                    #<?php echo gi_safe_escape($tag->name); ?>
                </span>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- カードフッター -->
    <footer class="tool-card-footer">
        <div class="card-actions">
            <a href="<?php the_permalink(); ?>" 
               class="action-btn primary">
                <span class="btn-icon">👁️</span>
                詳細を見る
            </a>
            
            <?php if ($trial_available) : ?>
            <button class="action-btn secondary" 
                    onclick="startTrial(<?php echo $tool_id; ?>)">
                <span class="btn-icon">▶️</span>
                無料体験
            </button>
            <?php else : ?>
            <button class="action-btn secondary" 
                    onclick="requestDemo(<?php echo $tool_id; ?>)">
                <span class="btn-icon">📞</span>
                デモ依頼
            </button>
            <?php endif; ?>
            
            <button class="action-btn tertiary" 
                    onclick="shareTool(<?php echo $tool_id; ?>)">
                <span class="btn-icon">📤</span>
            </button>
        </div>
        
        <?php if ($trial_available) : ?>
        <div class="trial-notice">
            <span class="trial-icon">✅</span>
            無料体験可能
        </div>
        <?php endif; ?>
    </footer>

    <!-- ホバー時の追加情報 -->
    <div class="card-hover-info">
        <div class="hover-content">
            <h4 class="hover-title">詳細情報</h4>
            <ul class="hover-details">
                <?php if ($company) : ?>
                <li><strong>開発会社:</strong> <?php echo gi_safe_escape($company); ?></li>
                <?php endif; ?>
                
                <?php if ($user_count) : ?>
                <li><strong>利用企業数:</strong> <?php echo gi_safe_number_format($user_count); ?>社以上</li>
                <?php endif; ?>
                
                <?php if ($integration_count) : ?>
                <li><strong>連携サービス:</strong> <?php echo gi_safe_number_format($integration_count); ?>以上</li>
                <?php endif; ?>
                
                <?php if ($trial_available) : ?>
                <li><strong>無料体験:</strong> 利用可能</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</article>

<style>
/* Tool Card v3 Styles */
.tool-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid #E5E7EB;
    position: relative;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.tool-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

/* カードヘッダー（ブルーグラデーション） */
.tool-card-header {
    background: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%);
    color: white;
    padding: 20px;
    position: relative;
    overflow: hidden;
}

.tool-card-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
    pointer-events: none;
}

.card-type-badges {
    display: flex;
    gap: 8px;
    margin-bottom: 16px;
    position: relative;
    z-index: 1;
}

.type-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
    background: rgba(255, 255, 255, 0.2);
    color: white;
}

.trial-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
    background: rgba(16, 185, 129, 0.2);
    color: #10B981;
    border: 1px solid rgba(16, 185, 129, 0.3);
}

.price-display {
    text-align: center;
    position: relative;
    z-index: 1;
}

.price-label {
    display: block;
    font-size: 12px;
    opacity: 0.8;
    margin-bottom: 4px;
}

.price-value {
    display: block;
    font-size: 28px;
    font-weight: 700;
    line-height: 1;
}

.price-contact {
    font-size: 16px;
    opacity: 0.9;
}

/* カードボディ */
.tool-card-body {
    padding: 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.tool-title {
    margin: 0 0 8px 0;
    font-size: 18px;
    font-weight: 700;
    line-height: 1.3;
}

.title-link {
    color: #1F2937;
    text-decoration: none;
    transition: color 0.2s;
}

.title-link:hover {
    color: #3B82F6;
}

.tool-company {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 14px;
    color: #6B7280;
    font-weight: 500;
}

.company-icon {
    font-size: 12px;
}

.tool-rating {
    display: flex;
    align-items: center;
    gap: 8px;
}

.rating-stars {
    display: flex;
    gap: 2px;
}

.star {
    font-size: 16px;
}

.star-filled {
    color: #F59E0B;
}

.star-half {
    color: #F59E0B;
    opacity: 0.5;
}

.star-empty {
    color: #D1D5DB;
}

.rating-text {
    font-size: 14px;
    color: #4B5563;
    font-weight: 500;
}

.tool-excerpt {
    color: #4B5563;
    font-size: 14px;
    line-height: 1.5;
    flex: 1;
}

.tool-stats {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    padding: 12px;
    background: #F9FAFB;
    border-radius: 8px;
}

.stat-item {
    text-align: center;
}

.stat-label {
    display: block;
    font-size: 11px;
    color: #6B7280;
    font-weight: 500;
    margin-bottom: 2px;
}

.stat-value {
    display: block;
    font-size: 14px;
    font-weight: 700;
    color: #3B82F6;
}

.tool-features {
    margin-top: 8px;
}

.features-title {
    font-size: 12px;
    color: #6B7280;
    font-weight: 600;
    margin: 0 0 8px 0;
}

.features-list {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
}

.feature-tag {
    padding: 4px 8px;
    background: #DBEAFE;
    color: #1D4ED8;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 500;
}

.feature-more {
    padding: 4px 8px;
    background: #E5E7EB;
    color: #6B7280;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 500;
}

.tool-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
}

.tag {
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.tag-category {
    background: #FEF3C7;
    color: #D97706;
}

.tag-feature {
    background: #F3E8FF;
    color: #7C3AED;
}

/* カードフッター */
.tool-card-footer {
    padding: 16px 20px;
    border-top: 1px solid #E5E7EB;
    background: #F9FAFB;
}

.card-actions {
    display: flex;
    gap: 8px;
    margin-bottom: 8px;
}

.action-btn {
    flex: 1;
    padding: 8px 12px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 4px;
    border: none;
}

.action-btn.primary {
    background: #3B82F6;
    color: white;
}

.action-btn.primary:hover {
    background: #1D4ED8;
    transform: translateY(-1px);
}

.action-btn.secondary {
    background: white;
    color: #3B82F6;
    border: 1px solid #3B82F6;
}

.action-btn.secondary:hover {
    background: #3B82F6;
    color: white;
}

.action-btn.tertiary {
    background: #E5E7EB;
    color: #6B7280;
    min-width: 40px;
    flex: none;
}

.action-btn.tertiary:hover {
    background: #D1D5DB;
    color: #4B5563;
}

.trial-notice {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    font-size: 12px;
    color: #10B981;
    font-weight: 600;
}

.trial-icon {
    font-size: 10px;
}

/* ホバー情報 */
.card-hover-info {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 1px solid #E5E7EB;
    border-top: none;
    border-radius: 0 0 16px 16px;
    padding: 16px 20px;
    opacity: 0;
    transform: translateY(-10px);
    transition: all 0.3s;
    pointer-events: none;
    z-index: 10;
}

.tool-card:hover .card-hover-info {
    opacity: 1;
    transform: translateY(0);
    pointer-events: auto;
}

.hover-title {
    margin: 0 0 8px 0;
    font-size: 14px;
    font-weight: 600;
    color: #1F2937;
}

.hover-details {
    list-style: none;
    margin: 0;
    padding: 0;
}

.hover-details li {
    font-size: 12px;
    color: #6B7280;
    margin-bottom: 4px;
}

.hover-details strong {
    color: #4B5563;
}

/* レスポンシブ */
@media (max-width: 768px) {
    .tool-card-header {
        padding: 16px;
    }
    
    .tool-card-body {
        padding: 16px;
        gap: 12px;
    }
    
    .tool-title {
        font-size: 16px;
    }
    
    .price-value {
        font-size: 24px;
    }
    
    .card-actions {
        flex-direction: column;
    }
    
    .action-btn.tertiary {
        min-width: auto;
        flex: 1;
    }
    
    .tool-stats {
        grid-template-columns: 1fr;
        gap: 8px;
    }
}
</style>

<script>
function toggleToolFavorite(toolId) {
    // お気に入り機能の実装
    console.log('Toggling favorite for tool:', toolId);
    
    // アイコンの切り替え
    const btn = event.target.closest('.favorite-btn');
    const icon = btn.querySelector('.favorite-icon');
    
    if (icon.textContent === '♡') {
        icon.textContent = '♥';
        btn.style.background = 'rgba(239, 68, 68, 0.2)';
    } else {
        icon.textContent = '♡';
        btn.style.background = 'rgba(255, 255, 255, 0.2)';
    }
}

function startTrial(toolId) {
    // 無料体験開始機能の実装
    console.log('Starting trial for tool:', toolId);
}

function requestDemo(toolId) {
    // デモ依頼機能の実装
    console.log('Requesting demo for tool:', toolId);
}

function shareTool(toolId) {
    // シェア機能の実装
    console.log('Sharing tool:', toolId);
    
    if (navigator.share) {
        navigator.share({
            title: document.querySelector(`[data-tool-id="${toolId}"] .tool-title`).textContent,
            url: document.querySelector(`[data-tool-id="${toolId}"] .title-link`).href
        });
    }
}
</script>

