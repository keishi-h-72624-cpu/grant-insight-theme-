<?php
/**
 * Tool Card v3 - ツールカード
 * Tailwind CSS Play CDN完全対応版
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

<script src="https://cdn.tailwindcss.com/3.4.0"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: {
                        50: '#eff6ff',
                        100: '#dbeafe',
                        500: '#3b82f6',
                        600: '#2563eb',
                        700: '#1d4ed8'
                    },
                    success: {
                        50: '#f0fdf4',
                        100: '#dcfce7',
                        500: '#22c55e',
                        600: '#16a34a'
                    },
                    accent: {
                        500: '#f59e0b',
                        600: '#d97706'
                    }
                },
                animation: {
                    'fade-in': 'fadeIn 0.6s ease-out',
                    'slide-up': 'slideUp 0.8s ease-out',
                    'bounce-gentle': 'bounceGentle 1s ease-out',
                    'scale-in': 'scaleIn 0.5s ease-out',
                    'pulse-gentle': 'pulseGentle 2s ease-in-out infinite'
                },
                keyframes: {
                    fadeIn: {
                        '0%': { opacity: '0' },
                        '100%': { opacity: '1' }
                    },
                    slideUp: {
                        '0%': { opacity: '0', transform: 'translateY(30px)' },
                        '100%': { opacity: '1', transform: 'translateY(0)' }
                    },
                    bounceGentle: {
                        '0%': { transform: 'scale(0.95)' },
                        '50%': { transform: 'scale(1.02)' },
                        '100%': { transform: 'scale(1)' }
                    },
                    scaleIn: {
                        '0%': { opacity: '0', transform: 'scale(0.9)' },
                        '100%': { opacity: '1', transform: 'scale(1)' }
                    },
                    pulseGentle: {
                        '0%, 100%': { opacity: '1' },
                        '50%': { opacity: '0.8' }
                    }
                }
            }
        }
    }
</script>

<article class="group relative bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden 
               transition-all duration-300 hover:transform hover:-translate-y-2 
               hover:shadow-xl hover:border-primary-300 animate-scale-in h-full flex flex-col" 
         data-tool-id="<?php echo gi_safe_attr($tool_id); ?>"
         data-price="<?php echo gi_safe_attr($price); ?>"
         data-rating="<?php echo gi_safe_attr($rating); ?>"
         data-type="<?php echo gi_safe_attr($tool_type); ?>"
         itemscope 
         itemtype="https://schema.org/SoftwareApplication">

    <!-- カードヘッダー（ブルーグラデーション背景） -->
    <header class="relative bg-gradient-to-br from-primary-600 to-primary-700 text-white p-5 overflow-hidden">
        <!-- 背景パターン -->
        <div class="absolute inset-0 opacity-10">
            <svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                <defs>
                    <pattern id="tool-grid-pattern" width="20" height="20" patternUnits="userSpaceOnUse">
                        <path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgba(255,255,255,0.2)" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#tool-grid-pattern)"/>
            </svg>
        </div>

        <!-- ツールタイプバッジ -->
        <div class="relative z-10 flex flex-wrap gap-2 mb-4">
            <?php if ($tool_type) : ?>
            <span class="inline-flex items-center gap-1 px-3 py-1 bg-white/20 backdrop-blur-sm 
                       rounded-full text-xs font-semibold border border-white/30">
                <span class="text-sm">⚙️</span>
                <?php echo gi_safe_escape($tool_type); ?>
            </span>
            <?php endif; ?>
            
            <?php if ($trial_available) : ?>
            <span class="inline-flex items-center gap-1 px-3 py-1 bg-success-500/20 backdrop-blur-sm 
                       rounded-full text-xs font-semibold border border-success-400/30 text-success-100">
                <span class="text-sm">✨</span>
                無料体験
            </span>
            <?php endif; ?>
        </div>

        <!-- お気に入りボタン -->
        <button class="absolute top-4 right-4 w-8 h-8 bg-white/20 hover:bg-white/30 backdrop-blur-sm 
                     rounded-full flex items-center justify-center transition-all duration-200 z-10
                     group/fav" 
                onclick="toggleToolFavorite(<?php echo $tool_id; ?>)"
                aria-label="お気に入りに追加">
            <svg class="w-5 h-5 text-white group-hover/fav:scale-110 transition-transform duration-200" 
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
        </button>

        <!-- 価格表示 -->
        <div class="relative z-10 text-center">
            <div class="text-sm opacity-90 mb-1">月額</div>
            <div class="text-2xl md:text-3xl font-bold" 
                 itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                <?php if ($price) : ?>
                    <span itemprop="price">¥<?php echo gi_safe_number_format($price); ?></span>
                    <meta itemprop="priceCurrency" content="JPY">
                <?php else : ?>
                    <span class="text-lg opacity-80">お問い合わせ</span>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- カードボディ -->
    <div class="flex-1 p-5 space-y-4">
        <!-- タイトルと会社 -->
        <div>
            <h3 class="text-lg font-bold text-gray-900 mb-2 leading-tight group-hover:text-primary-600 
                     transition-colors duration-200" itemprop="name">
                <a href="<?php the_permalink(); ?>" class="hover:underline">
                    <?php the_title(); ?>
                </a>
            </h3>
            
            <?php if ($company) : ?>
            <div class="flex items-center gap-2 text-gray-600" 
                 itemprop="author" itemscope itemtype="https://schema.org/Organization">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-6a1 1 0 00-1-1H9a1 1 0 00-1 1v6a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd" />
                </svg>
                <span class="font-medium text-sm" itemprop="name"><?php echo gi_safe_escape($company); ?></span>
            </div>
            <?php endif; ?>
        </div>

        <!-- 評価とレビュー -->
        <?php if ($rating && $review_count) : ?>
        <div class="flex items-center gap-3" 
             itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating">
            <div class="flex gap-1">
                <?php
                $full_stars = floor($rating);
                $half_star = ($rating - $full_stars) >= 0.5;
                
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $full_stars) {
                        echo '<svg class="w-4 h-4 text-accent-500" fill="currentColor" viewBox="0 0 20 20">
                              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>';
                    } elseif ($i == $full_stars + 1 && $half_star) {
                        echo '<svg class="w-4 h-4 text-accent-500" fill="currentColor" viewBox="0 0 20 20">
                              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>';
                    } else {
                        echo '<svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>';
                    }
                }
                ?>
            </div>
            <span class="text-sm text-gray-600">
                <span class="font-bold" itemprop="ratingValue"><?php echo gi_safe_escape($rating); ?></span>
                (<span itemprop="reviewCount"><?php echo gi_safe_number_format($review_count); ?></span>件)
            </span>
        </div>
        <?php endif; ?>

        <!-- 概要 -->
        <div class="text-gray-600 text-sm leading-relaxed line-clamp-4" itemprop="description">
            <?php
            $excerpt = get_the_excerpt();
            if (mb_strlen($excerpt) > 120) {
                $excerpt = mb_substr($excerpt, 0, 120) . '...';
            }
            echo gi_safe_escape($excerpt);
            ?>
        </div>

        <!-- 利用統計 -->
        <div class="grid grid-cols-2 gap-3 bg-gray-50 rounded-xl p-4">
            <?php if ($user_count) : ?>
            <div class="text-center">
                <div class="text-xs text-gray-600 font-semibold mb-1">利用企業数</div>
                <div class="text-sm font-bold text-primary-600"><?php echo gi_safe_number_format($user_count); ?>社+</div>
            </div>
            <?php endif; ?>
            
            <?php if ($integration_count) : ?>
            <div class="text-center">
                <div class="text-xs text-gray-600 font-semibold mb-1">連携数</div>
                <div class="text-sm font-bold text-primary-600"><?php echo gi_safe_number_format($integration_count); ?>+</div>
            </div>
            <?php endif; ?>
        </div>

        <!-- 主要機能 -->
        <?php if ($features && is_array($features)) : ?>
        <div>
            <h4 class="text-xs font-bold text-gray-600 mb-3 uppercase tracking-wide">主要機能</h4>
            <div class="flex flex-wrap gap-2">
                <?php foreach (array_slice($features, 0, 3) as $feature) : ?>
                <span class="inline-flex items-center px-3 py-1 rounded-full bg-primary-100 text-primary-800 
                           text-xs font-medium">
                    <?php echo gi_safe_escape($feature); ?>
                </span>
                <?php endforeach; ?>
                <?php if (count($features) > 3) : ?>
                <span class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-600 
                           text-xs font-medium">
                    +<?php echo count($features) - 3; ?>
                </span>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- カテゴリタグ -->
        <div class="flex flex-wrap gap-2">
            <?php if ($categories && !is_wp_error($categories)) : ?>
                <?php foreach (array_slice($categories, 0, 2) as $category) : ?>
                <span class="inline-flex items-center px-2 py-1 rounded-md bg-accent-100 text-accent-800 
                           text-xs font-medium">
                    #<?php echo gi_safe_escape($category->name); ?>
                </span>
                <?php endforeach; ?>
            <?php endif; ?>
            
            <?php if ($tags && !is_wp_error($tags)) : ?>
                <?php foreach (array_slice($tags, 0, 2) as $tag) : ?>
                <span class="inline-flex items-center px-2 py-1 rounded-md bg-purple-100 text-purple-800 
                           text-xs font-medium">
                    #<?php echo gi_safe_escape($tag->name); ?>
                </span>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- カードフッター -->
    <footer class="px-5 py-4 bg-gray-50 border-t border-gray-100">
        <div class="flex gap-2 mb-3">
            <a href="<?php the_permalink(); ?>" 
               class="flex-1 inline-flex items-center justify-center gap-2 px-3 py-2 
                      bg-primary-600 text-white rounded-lg hover:bg-primary-700 
                      transition-all duration-200 text-sm font-semibold
                      transform hover:scale-105">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                </svg>
                詳細を見る
            </a>
            
            <?php if ($trial_available) : ?>
            <button class="px-3 py-2 bg-success-600 text-white rounded-lg 
                         hover:bg-success-700 transition-all duration-200 text-sm font-semibold
                         transform hover:scale-105" 
                    onclick="startTrial(<?php echo $tool_id; ?>)">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                </svg>
            </button>
            <?php else : ?>
            <button class="px-3 py-2 bg-white border border-gray-200 text-gray-600 rounded-lg 
                         hover:bg-gray-50 hover:border-gray-300 transition-all duration-200 text-sm font-semibold
                         transform hover:scale-105" 
                    onclick="requestDemo(<?php echo $tool_id; ?>)">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                </svg>
            </button>
            <?php endif; ?>
            
            <button class="px-3 py-2 bg-white border border-gray-200 text-gray-600 rounded-lg 
                         hover:bg-gray-50 hover:border-gray-300 transition-all duration-200 text-sm font-semibold
                         transform hover:scale-105" 
                    onclick="shareTool(<?php echo $tool_id; ?>)">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
                </svg>
            </button>
        </div>
        
        <?php if ($trial_available) : ?>
        <div class="flex items-center justify-center gap-2 text-sm">
            <svg class="w-4 h-4 text-success-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            <span class="text-success-600 font-semibold">無料体験可能</span>
        </div>
        <?php endif; ?>
    </footer>

    <!-- ホバー時の追加情報 -->
    <div class="absolute top-full left-0 right-0 bg-white border border-gray-200 border-t-0 
              rounded-b-2xl p-5 opacity-0 transform translate-y-2 group-hover:opacity-100 
              group-hover:translate-y-0 transition-all duration-300 pointer-events-none 
              group-hover:pointer-events-auto z-20 shadow-xl">
        <h4 class="font-bold text-gray-900 mb-3 flex items-center gap-2">
            <svg class="w-5 h-5 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
            </svg>
            詳細情報
        </h4>
        <ul class="space-y-2 text-sm">
            <?php if ($company) : ?>
            <li class="flex justify-between">
                <strong class="text-gray-700">開発会社:</strong> 
                <span class="text-gray-600"><?php echo gi_safe_escape($company); ?></span>
            </li>
            <?php endif; ?>
            
            <?php if ($user_count) : ?>
            <li class="flex justify-between">
                <strong class="text-gray-700">利用企業数:</strong> 
                <span class="text-gray-600"><?php echo gi_safe_number_format($user_count); ?>社以上</span>
            </li>
            <?php endif; ?>
            
            <?php if ($integration_count) : ?>
            <li class="flex justify-between">
                <strong class="text-gray-700">連携サービス:</strong> 
                <span class="text-gray-600"><?php echo gi_safe_number_format($integration_count); ?>以上</span>
            </li>
            <?php endif; ?>
            
            <?php if ($trial_available) : ?>
            <li class="flex justify-between">
                <strong class="text-gray-700">無料体験:</strong> 
                <span class="text-success-600 font-semibold">利用可能</span>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</article>

<script>
function toggleToolFavorite(toolId) {
    console.log('Toggling favorite for tool:', toolId);
    
    const btn = event.target.closest('button');
    const svg = btn.querySelector('svg');
    
    // 現在の状態を切り替え
    if (svg.getAttribute('fill') === 'none') {
        svg.setAttribute('fill', 'currentColor');
        svg.classList.add('text-red-500');
        btn.classList.add('bg-red-100');
        
        // 簡単なアニメーション
        btn.style.transform = 'scale(1.2)';
        setTimeout(() => {
            btn.style.transform = 'scale(1)';
        }, 200);
    } else {
        svg.setAttribute('fill', 'none');
        svg.classList.remove('text-red-500');
        btn.classList.remove('bg-red-100');
    }
}

function startTrial(toolId) {
    console.log('Starting trial for tool:', toolId);
    // 無料体験開始機能の実装
    
    // 成功通知
    const notification = document.createElement('div');
    notification.className = 'fixed bottom-4 right-4 bg-success-600 text-white px-6 py-3 rounded-lg shadow-lg z-50';
    notification.innerHTML = `
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            無料体験を開始しました！
        </div>
    `;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

function requestDemo(toolId) {
    console.log('Requesting demo for tool:', toolId);
    // デモ依頼機能の実装
}

function shareTool(toolId) {
    console.log('Sharing tool:', toolId);
    
    if (navigator.share) {
        const card = document.querySelector(`[data-tool-id="${toolId}"]`);
        const title = card.querySelector('h3').textContent;
        const url = card.querySelector('a').href;
        
        navigator.share({
            title: title,
            url: url
        });
    } else {
        // フォールバック: URLをクリップボードにコピー
        const url = document.querySelector(`[data-tool-id="${toolId}"] a`).href;
        navigator.clipboard.writeText(url).then(() => {
            // 成功通知
            const notification = document.createElement('div');
            notification.className = 'fixed bottom-4 right-4 bg-primary-600 text-white px-6 py-3 rounded-lg shadow-lg z-50';
            notification.textContent = 'URLをコピーしました！';
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        });
    }
}

// インタラクティブ要素の強化
document.addEventListener('DOMContentLoaded', function() {
    // 評価星のアニメーション
    const starContainers = document.querySelectorAll('[itemtype="https://schema.org/AggregateRating"] svg');
    starContainers.forEach((star, index) => {
        star.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.2) rotate(15deg)';
            this.style.transition = 'transform 0.2s ease-out';
        });
        star.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1) rotate(0deg)';
        });
    });

    // カードの3Dエフェクト
    const toolCards = document.querySelectorAll('[data-tool-id]');
    toolCards.forEach(card => {
        card.addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const rotateX = (y - centerY) / 10;
            const rotateY = (centerX - x) / 10;
            
            this.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-8px)`;
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = '';
        });
    });
});
</script>
