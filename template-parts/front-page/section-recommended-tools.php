<?php
/**
 * Template part for displaying recommended tools section on front page - Tailwind CSS Play CDN Version
 *
 * @package Grant_Insight
 */

// カスタマイザーから設定を取得
$tools_section_enabled = get_theme_mod('gi_tools_section_enabled', true);
$tools_title = get_theme_mod('gi_tools_title', 'おすすめツール');
$tools_subtitle = get_theme_mod('gi_tools_subtitle', '助成金申請を効率化する厳選ツールをご紹介');

// 表示設定がOFFの場合は表示しない
if (!$tools_section_enabled) {
    return;
}

// おすすめツールを取得（is_recommendedメタキーがtrueのもの）
$recommended_tools_args = array(
    'post_type' => 'tool',
    'posts_per_page' => 6,
    'meta_query' => array(
        array(
            'key' => 'is_recommended',
            'value' => '1',
            'compare' => '='
        )
    ),
    'orderby' => 'menu_order',
    'order' => 'ASC'
);

$recommended_tools_query = new WP_Query($recommended_tools_args);

// Tailwind CSS Play CDN対応のスタイル・スクリプト読み込み
if (!wp_script_is('tailwind-cdn', 'enqueued')) {
    wp_enqueue_script('tailwind-cdn', 'https://cdn.tailwindcss.com', array(), null, false);
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
}

// Tailwind CSS設定とカスタムスタイル
add_action('wp_footer', function() {
    ?>
    <script>
    if (typeof tailwind !== 'undefined') {
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-out',
                        'slide-up': 'slideUp 0.4s ease-out',
                        'float': 'float 3s ease-in-out infinite',
                        'pulse-glow': 'pulseGlow 2s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'bounce-soft': 'bounceSoft 1.5s ease-in-out infinite',
                        'wiggle': 'wiggle 0.5s ease-in-out',
                        'scale-pulse': 'scalePulse 1s ease-in-out infinite',
                        'gradient-shift': 'gradientShift 3s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(100px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' }
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' }
                        },
                        pulseGlow: {
                            '0%, 100%': { boxShadow: '0 0 20px rgba(59, 130, 246, 0.5)' },
                            '50%': { boxShadow: '0 0 40px rgba(59, 130, 246, 0.8)' }
                        },
                        bounceSoft: {
                            '0%, 20%, 53%, 80%, 100%': { transform: 'translate3d(0,0,0)' },
                            '40%, 43%': { transform: 'translate3d(0, -5px, 0)' },
                            '70%': { transform: 'translate3d(0, -2px, 0)' },
                            '90%': { transform: 'translate3d(0, -1px, 0)' }
                        },
                        wiggle: {
                            '0%, 100%': { transform: 'rotate(-2deg)' },
                            '50%': { transform: 'rotate(2deg)' }
                        },
                        scalePulse: {
                            '0%, 100%': { transform: 'scale(1)' },
                            '50%': { transform: 'scale(1.05)' }
                        },
                        gradientShift: {
                            '0%': { backgroundPosition: '0% 50%' },
                            '50%': { backgroundPosition: '100% 50%' },
                            '100%': { backgroundPosition: '0% 50%' }
                        }
                    },
                    colors: {
                        'brand': {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        },
                        'accent': {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        }
                    },
                    boxShadow: {
                        'glow': '0 0 30px rgba(59, 130, 246, 0.3)',
                        'glow-lg': '0 0 50px rgba(34, 197, 94, 0.4)',
                        'card': '0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)',
                        'card-hover': '0 25px 50px -12px rgba(0, 0, 0, 0.25)',
                    },
                    backgroundImage: {
                        'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
                        'gradient-conic': 'conic-gradient(from 180deg at 50% 50%, var(--tw-gradient-stops))',
                        'mesh-pattern': 'radial-gradient(circle at 25% 25%, #3b82f6 0%, transparent 50%), radial-gradient(circle at 75% 75%, #22c55e 0%, transparent 50%)',
                    }
                }
            }
        }
    }
    </script>
    
    <style>
    /* カスタムスタイル */
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .tool-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    
    .tool-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        transition: left 0.6s;
    }
    
    .tool-card:hover::before {
        left: 100%;
    }
    
    .tool-card:hover {
        transform: translateY(-12px) scale(1.02);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    
    .tool-logo {
        transition: transform 0.3s ease-in-out;
    }
    
    .tool-card:hover .tool-logo {
        transform: scale(1.1) rotate(5deg);
    }
    
    .gradient-text {
        background: linear-gradient(135deg, #3b82f6, #22c55e);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .animated-border {
        background: linear-gradient(45deg, #3b82f6, #22c55e, #3b82f6);
        background-size: 200% 200%;
        animation: gradientShift 3s ease-in-out infinite;
    }
    
    .star-rating {
        filter: drop-shadow(0 1px 2px rgba(0, 0, 0, 0.1));
    }
    
    .floating-decoration {
        animation: float 4s ease-in-out infinite;
    }
    
    .pulse-ring {
        animation: pulse-ring 1.25s cubic-bezier(0.215, 0.61, 0.355, 1) infinite;
    }
    
    @keyframes pulse-ring {
        0% {
            transform: scale(0.33);
        }
        40%,
        50% {
            opacity: 1;
        }
        100% {
            opacity: 0;
            transform: scale(1.33);
        }
    }
    
    .mesh-gradient {
        background: radial-gradient(circle at 25% 25%, rgba(59, 130, 246, 0.1) 0%, transparent 50%), 
                    radial-gradient(circle at 75% 75%, rgba(34, 197, 94, 0.1) 0%, transparent 50%);
    }
    
    .glassmorphism {
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.18);
    }
    
    /* 交差観察アニメーション */
    .animate-on-scroll {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .animate-on-scroll.in-view {
        opacity: 1;
        transform: translateY(0);
    }
    </style>
    <?php
});
?>

<!-- Recommended Tools Section - Tailwind CSS Play CDN Version -->
<section class="recommended-tools-section py-20 bg-gradient-to-br from-gray-50 via-blue-50/30 to-green-50/30 relative overflow-hidden">
    <!-- 背景装飾エフェクト -->
    <div class="absolute inset-0 mesh-gradient"></div>
    
    <!-- アニメーション装飾要素 -->
    <div class="absolute inset-0 opacity-20">
        <div class="floating-decoration absolute top-20 left-10 w-32 h-32 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full blur-2xl"></div>
        <div class="floating-decoration absolute bottom-20 right-10 w-40 h-40 bg-gradient-to-br from-green-400 to-green-600 rounded-full blur-2xl" style="animation-delay: 1s;"></div>
        <div class="floating-decoration absolute top-1/2 left-1/3 w-24 h-24 bg-gradient-to-br from-purple-400 to-pink-500 rounded-full blur-2xl" style="animation-delay: 2s;"></div>
        <div class="floating-decoration absolute top-10 right-1/4 w-28 h-28 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full blur-2xl" style="animation-delay: 0.5s;"></div>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <!-- セクションヘッダー -->
        <div class="text-center mb-16 animate-on-scroll">
            <div class="inline-flex items-center gap-3 glassmorphism rounded-full px-8 py-4 shadow-lg mb-8 animate-bounce-soft">
                <div class="relative">
                    <i class="fas fa-tools text-2xl text-blue-600"></i>
                    <div class="absolute -inset-2 bg-blue-200 rounded-full opacity-30 pulse-ring"></div>
                </div>
                <span class="text-lg font-bold gradient-text">TOOLS</span>
                <span class="text-sm font-semibold text-gray-700 bg-white/50 px-3 py-1 rounded-full">効率化</span>
            </div>
            
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-black text-gray-900 mb-6 leading-tight">
                <span class="gradient-text"><?php echo gi_safe_escape($tools_title); ?></span>
            </h2>
            <p class="text-xl md:text-2xl text-gray-600 max-w-3xl mx-auto leading-relaxed font-medium">
                <?php echo gi_safe_escape($tools_subtitle); ?>
            </p>
            
            <!-- 統計情報 -->
            <div class="flex flex-wrap justify-center gap-8 mt-10">
                <div class="text-center animate-on-scroll" style="animation-delay: 0.2s;">
                    <div class="text-3xl font-black text-blue-600">100+</div>
                    <div class="text-sm text-gray-600 font-semibold">厳選ツール</div>
                </div>
                <div class="text-center animate-on-scroll" style="animation-delay: 0.4s;">
                    <div class="text-3xl font-black text-green-600">95%</div>
                    <div class="text-sm text-gray-600 font-semibold">満足度</div>
                </div>
                <div class="text-center animate-on-scroll" style="animation-delay: 0.6s;">
                    <div class="text-3xl font-black text-purple-600">60%</div>
                    <div class="text-sm text-gray-600 font-semibold">時短効果</div>
                </div>
            </div>
        </div>

        <?php if ($recommended_tools_query->have_posts()) : ?>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 lg:gap-10 mb-16">
            <?php 
            $card_index = 0;
            while ($recommended_tools_query->have_posts()) : $recommended_tools_query->the_post(); 
                // カスタムフィールドから情報を取得
                $tool_price = get_field('tool_price') ?: '要確認';
                $tool_category = get_field('tool_category') ?: 'その他';
                $tool_rating = get_field('tool_rating') ?: 4.0;
                $tool_reviews_count = get_field('tool_reviews_count') ?: 0;
                $tool_url = get_field('tool_url') ?: '#';
                $tool_features = get_field('tool_features') ?: array();
                $tool_discount = get_field('tool_discount') ?: '';
                $tool_logo = get_field('tool_logo');
                $is_affiliate = get_field('is_affiliate') ?: false;
                
                // 星評価の表示用
                $full_stars = floor($tool_rating);
                $half_star = ($tool_rating - $full_stars) >= 0.5;
                $empty_stars = 5 - $full_stars - ($half_star ? 1 : 0);
                
                // カード用カラー（循環）
                $card_colors = ['blue', 'green', 'purple', 'orange', 'pink', 'indigo'];
                $card_color = $card_colors[$card_index % count($card_colors)];
                $card_index++;
            ?>
            
            <div class="tool-card bg-white rounded-3xl shadow-card hover:shadow-card-hover transition-all duration-500 transform hover:-translate-y-3 overflow-hidden group animate-on-scroll relative" 
                 style="animation-delay: <?php echo ($card_index * 0.1); ?>s;">
                
                <!-- 人気バッジ -->
                <?php if ($tool_reviews_count > 100) : ?>
                <div class="absolute top-4 left-4 z-20 bg-gradient-to-r from-orange-500 to-red-500 text-white text-xs font-bold px-4 py-2 rounded-full shadow-lg animate-pulse-glow">
                    <i class="fas fa-fire mr-1 animate-wiggle"></i>
                    人気NO.1
                </div>
                <?php endif; ?>
                
                <!-- 割引バッジ -->
                <?php if ($tool_discount) : ?>
                <div class="absolute top-4 right-4 z-20 bg-gradient-to-r from-red-500 to-pink-500 text-white text-sm font-bold px-4 py-2 rounded-full shadow-lg animate-bounce-soft">
                    <?php echo gi_safe_escape($tool_discount); ?>
                </div>
                <?php endif; ?>
                
                <!-- ツールヘッダー -->
                <div class="relative p-8 bg-gradient-to-br from-<?php echo $card_color; ?>-50 via-white to-<?php echo $card_color; ?>-50/50">
                    <!-- グラデーション装飾 -->
                    <div class="absolute inset-0 bg-gradient-to-br from-<?php echo $card_color; ?>-100/20 to-transparent opacity-50"></div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center gap-5 mb-6">
                            <?php if ($tool_logo) : ?>
                            <div class="tool-logo w-20 h-20 bg-white rounded-2xl shadow-lg flex items-center justify-center overflow-hidden border-4 border-<?php echo $card_color; ?>-100">
                                <img src="<?php echo esc_url($tool_logo); ?>" 
                                     alt="<?php the_title(); ?>" 
                                     class="w-14 h-14 object-contain filter drop-shadow-sm">
                            </div>
                            <?php else : ?>
                            <div class="tool-logo w-20 h-20 bg-gradient-to-br from-<?php echo $card_color; ?>-100 to-<?php echo $card_color; ?>-200 rounded-2xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-cog text-3xl text-<?php echo $card_color; ?>-600"></i>
                            </div>
                            <?php endif; ?>
                            
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="inline-block bg-gradient-to-r from-<?php echo $card_color; ?>-500 to-<?php echo $card_color; ?>-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                                        <?php echo gi_safe_escape($tool_category); ?>
                                    </span>
                                    <?php if ($is_affiliate) : ?>
                                    <span class="inline-block bg-gradient-to-r from-orange-400 to-orange-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-sm animate-pulse">
                                        特典
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <h3 class="text-xl font-black text-gray-900 group-hover:text-<?php echo $card_color; ?>-600 transition-colors leading-tight">
                                    <?php the_title(); ?>
                                </h3>
                            </div>
                        </div>
                        
                        <!-- 評価セクション -->
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-3">
                                <div class="flex items-center gap-1 star-rating">
                                    <?php for ($i = 0; $i < $full_stars; $i++) : ?>
                                        <i class="fas fa-star text-yellow-500 text-lg drop-shadow-sm"></i>
                                    <?php endfor; ?>
                                    <?php if ($half_star) : ?>
                                        <i class="fas fa-star-half-alt text-yellow-500 text-lg drop-shadow-sm"></i>
                                    <?php endif; ?>
                                    <?php for ($i = 0; $i < $empty_stars; $i++) : ?>
                                        <i class="far fa-star text-gray-300 text-lg"></i>
                                    <?php endfor; ?>
                                </div>
                                <div class="flex items-center gap-1">
                                    <span class="text-lg font-bold text-gray-800"><?php echo gi_safe_number_format($tool_rating, 1); ?></span>
                                    <span class="text-sm text-gray-500 font-medium">(<?php echo gi_safe_number_format($tool_reviews_count); ?>)</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- 価格セクション -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-baseline gap-2">
                                <span class="text-3xl font-black text-<?php echo $card_color; ?>-600">
                                    <?php echo gi_safe_escape($tool_price); ?>
                                </span>
                                <?php if (strpos($tool_price, '無料') === false && $tool_price !== '要確認') : ?>
                                    <span class="text-lg text-gray-500 font-semibold">/月</span>
                                <?php endif; ?>
                            </div>
                            
                            <?php if (strpos($tool_price, '無料') !== false) : ?>
                            <div class="bg-gradient-to-r from-green-500 to-emerald-500 text-white text-sm font-bold px-4 py-2 rounded-full shadow-md animate-pulse-glow">
                                <i class="fas fa-gift mr-1"></i>FREE
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <!-- ツール詳細 -->
                <div class="p-8 pt-6">
                    <p class="text-gray-700 text-lg leading-relaxed mb-6 line-clamp-3 font-medium">
                        <?php echo wp_trim_words(get_the_excerpt(), 25, '...'); ?>
                    </p>
                    
                    <!-- 主要機能 -->
                    <?php if (!empty($tool_features) && is_array($tool_features)) : ?>
                    <div class="mb-8">
                        <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <i class="fas fa-star text-<?php echo $card_color; ?>-500"></i>
                            主要機能
                        </h4>
                        <div class="space-y-3">
                            <?php foreach (array_slice($tool_features, 0, 3) as $index => $feature) : ?>
                            <div class="flex items-center gap-3 text-gray-700 animate-on-scroll" style="animation-delay: <?php echo (0.1 * $index); ?>s;">
                                <div class="w-6 h-6 bg-gradient-to-r from-<?php echo $card_color; ?>-400 to-<?php echo $card_color; ?>-500 rounded-full flex items-center justify-center shadow-sm">
                                    <i class="fas fa-check text-white text-xs"></i>
                                </div>
                                <span class="font-medium"><?php echo gi_safe_escape($feature['feature']); ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <!-- アクションボタン -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="<?php the_permalink(); ?>" 
                           class="flex-1 bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 text-gray-800 text-center py-4 px-6 rounded-xl font-bold transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105 flex items-center justify-center gap-2">
                            <i class="fas fa-info-circle"></i>
                            詳細を見る
                        </a>
                        <a href="<?php echo esc_url($tool_url); ?>" 
                           target="_blank" 
                           rel="noopener<?php echo $is_affiliate ? ' sponsored' : ''; ?>"
                           class="flex-1 bg-gradient-to-r from-<?php echo $card_color; ?>-500 to-<?php echo $card_color; ?>-600 hover:from-<?php echo $card_color; ?>-600 hover:to-<?php echo $card_color; ?>-700 text-white text-center py-4 px-6 rounded-xl font-bold transition-all duration-300 shadow-lg hover:shadow-glow transform hover:scale-105 flex items-center justify-center gap-2">
                            <?php if ($is_affiliate) : ?>
                                <i class="fas fa-gift"></i>
                                特典付きで試す
                            <?php else : ?>
                                <i class="fas fa-external-link-alt"></i>
                                公式サイト
                            <?php endif; ?>
                        </a>
                    </div>
                </div>
                
                <!-- ホバー時のグロー効果 -->
                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 bg-gradient-to-r from-<?php echo $card_color; ?>-500/5 to-<?php echo $card_color; ?>-600/5 rounded-3xl transition-opacity duration-500 pointer-events-none"></div>
            </div>
            
            <?php endwhile; ?>
        </div>
        <?php wp_reset_postdata(); ?>
        
        <!-- すべてのツールを見るボタン -->
        <div class="text-center mb-16 animate-on-scroll">
            <a href="<?php echo home_url('/tools/'); ?>" 
               class="inline-flex items-center gap-4 bg-white hover:bg-gray-50 text-gray-900 font-black py-5 px-10 rounded-2xl shadow-card hover:shadow-card-hover transition-all duration-400 transform hover:-translate-y-2 border-4 border-blue-100 hover:border-blue-200 group">
                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-tools text-white text-xl"></i>
                </div>
                <div class="text-left">
                    <div class="text-xl font-black text-gray-900">すべてのツールを見る</div>
                    <div class="text-sm text-gray-600 font-semibold">100以上の厳選ツールをご紹介</div>
                </div>
                <i class="fas fa-arrow-right text-2xl text-blue-600 group-hover:translate-x-2 transition-transform duration-300"></i>
            </a>
        </div>
        
        <?php else : ?>
        <!-- おすすめツールがない場合のフォールバック -->
        <div class="text-center py-16 animate-on-scroll">
            <div class="glassmorphism rounded-3xl shadow-card p-12 max-w-lg mx-auto">
                <div class="relative inline-block mb-6">
                    <i class="fas fa-tools text-6xl text-gray-400 animate-float"></i>
                    <div class="absolute -inset-4 bg-gray-200 rounded-full opacity-20 pulse-ring"></div>
                </div>
                <h3 class="text-2xl font-black text-gray-900 mb-4">おすすめツールを準備中</h3>
                <p class="text-gray-600 mb-8 text-lg font-medium">現在、厳選ツール情報を更新中です。</p>
                <a href="<?php echo home_url('/tools/'); ?>" 
                   class="inline-flex items-center gap-3 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 shadow-lg hover:shadow-glow transform hover:scale-105">
                    <i class="fas fa-list"></i>
                    ツール一覧を見る
                </a>
            </div>
        </div>
        <?php endif; ?>

        <!-- ツール提案セクション -->
        <div class="animated-border p-1 rounded-3xl shadow-glow-lg animate-on-scroll">
            <div class="bg-gradient-to-br from-green-600 via-blue-600 to-purple-600 rounded-3xl shadow-2xl p-10 text-white relative overflow-hidden">
                <!-- 装飾エフェクト -->
                <div class="absolute inset-0 bg-mesh-pattern opacity-20"></div>
                <div class="absolute top-4 right-4 w-32 h-32 bg-white/10 rounded-full blur-2xl animate-pulse"></div>
                <div class="absolute bottom-4 left-4 w-24 h-24 bg-white/10 rounded-full blur-xl animate-float"></div>
                
                <div class="relative z-10">
                    <div class="grid grid-cols-1 lg:grid-cols-5 gap-10 items-center">
                        <div class="lg:col-span-3">
                            <h3 class="text-3xl md:text-4xl lg:text-5xl font-black mb-6 leading-tight">
                                あなたに最適なツールを<br>
                                <span class="bg-gradient-to-r from-yellow-300 to-orange-300 bg-clip-text text-transparent">AI</span>がご提案
                            </h3>
                            <p class="text-xl text-green-100 mb-8 leading-relaxed font-medium">
                                事業規模、業種、予算に応じて最適なツールをAIが分析・提案。<br>
                                実際の利用者レビューと専門家の評価で、失敗しないツール選びを実現します。
                            </p>
                            
                            <div class="flex flex-col sm:flex-row gap-4">
                                <a href="<?php echo home_url('/tools/recommendation/'); ?>" 
                                   class="inline-flex items-center justify-center gap-3 bg-white text-blue-600 font-black py-4 px-8 rounded-xl hover:bg-gray-50 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 group">
                                    <i class="fas fa-magic text-xl group-hover:animate-wiggle"></i>
                                    <span class="text-lg">AI診断を開始</span>
                                </a>
                                
                                <a href="<?php echo home_url('/tools/'); ?>" 
                                   class="inline-flex items-center justify-center gap-3 bg-transparent border-3 border-white text-white font-bold py-4 px-8 rounded-xl hover:bg-white hover:text-blue-600 transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105 group">
                                    <i class="fas fa-search group-hover:animate-pulse"></i>
                                    <span class="text-lg">ツール一覧</span>
                                </a>
                            </div>
                        </div>
                        
                        <div class="lg:col-span-2 text-center">
                            <div class="inline-block glassmorphism rounded-3xl p-8 animate-float">
                                <div class="relative">
                                    <i class="fas fa-chart-line text-8xl text-white/90 mb-6 animate-pulse-glow"></i>
                                    <div class="absolute -inset-6 bg-white/20 rounded-full pulse-ring"></div>
                                </div>
                                <div class="text-4xl font-black mb-3">効率化</div>
                                <div class="text-xl text-green-100 font-semibold">作業時間を60%短縮</div>
                                
                                <!-- 統計アイコン -->
                                <div class="flex justify-center gap-4 mt-6">
                                    <div class="text-center">
                                        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-2">
                                            <i class="fas fa-clock text-white text-lg"></i>
                                        </div>
                                        <div class="text-xs font-semibold">時短</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-2">
                                            <i class="fas fa-rocket text-white text-lg"></i>
                                        </div>
                                        <div class="text-xs font-semibold">効率UP</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-2">
                                            <i class="fas fa-trophy text-white text-lg"></i>
                                        </div>
                                        <div class="text-xs font-semibold">成功</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Intersection Observer for animations -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Intersection Observer for scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('in-view');
            }
        });
    }, observerOptions);
    
    // Observe all elements with animate-on-scroll class
    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        observer.observe(el);
    });
    
    // Tool card hover effects
    document.querySelectorAll('.tool-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-12px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
    
    // Add loading animation for images
    document.querySelectorAll('.tool-card img').forEach(img => {
        img.addEventListener('load', function() {
            this.style.opacity = '1';
        });
        
        img.addEventListener('error', function() {
            this.parentElement.innerHTML = '<i class="fas fa-image text-2xl text-gray-400"></i>';
        });
    });
});
</script>
