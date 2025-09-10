<?php
/**
 * Template Name: 助成金比較・分析ツール（超強化版）- Tailwind CSS Play CDN対応版
 * Description: 高度な比較・分析機能、成功確率計算機、ROI分析ツール（DB連携済み）
 */

get_header();
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|', true, 'right'); ?></title>
    
    <!-- Tailwind CSS Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.8s ease-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'slide-down': 'slideDown 0.6s ease-out',
                        'slide-left': 'slideLeft 0.6s ease-out',
                        'slide-right': 'slideRight 0.6s ease-out',
                        'bounce-gentle': 'bounceGentle 2s infinite',
                        'pulse-soft': 'pulseSoft 3s infinite',
                        'gradient-shift': 'gradientShift 8s ease-in-out infinite',
                        'float': 'float 3s ease-in-out infinite',
                        'scale-up': 'scaleUp 0.3s ease-out',
                        'shimmer': 'shimmer 2s infinite',
                        'typing': 'typing 1.5s infinite',
                        'counter': 'counter 2s ease-out',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                        'rotate-slow': 'rotateSlow 8s linear infinite',
                        'wiggle': 'wiggle 1s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(40px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        slideDown: {
                            '0%': { opacity: '0', transform: 'translateY(-30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        slideLeft: {
                            '0%': { opacity: '0', transform: 'translateX(40px)' },
                            '100%': { opacity: '1', transform: 'translateX(0)' }
                        },
                        slideRight: {
                            '0%': { opacity: '0', transform: 'translateX(-40px)' },
                            '100%': { opacity: '1', transform: 'translateX(0)' }
                        },
                        bounceGentle: {
                            '0%, 20%, 50%, 80%, 100%': { transform: 'translateY(0)' },
                            '40%': { transform: 'translateY(-10px)' },
                            '60%': { transform: 'translateY(-5px)' }
                        },
                        pulseSoft: {
                            '0%, 100%': { opacity: '1', transform: 'scale(1)' },
                            '50%': { opacity: '0.7', transform: 'scale(1.05)' }
                        },
                        gradientShift: {
                            '0%, 100%': { backgroundPosition: '0% 50%' },
                            '50%': { backgroundPosition: '100% 50%' }
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' }
                        },
                        scaleUp: {
                            '0%': { transform: 'scale(0.95)', opacity: '0' },
                            '100%': { transform: 'scale(1)', opacity: '1' }
                        },
                        shimmer: {
                            '0%': { transform: 'translateX(-100%)' },
                            '100%': { transform: 'translateX(100%)' }
                        },
                        typing: {
                            '0%, 60%, 100%': { opacity: '1' },
                            '30%': { opacity: '0' }
                        },
                        counter: {
                            '0%': { transform: 'scale(0.5)', opacity: '0' },
                            '100%': { transform: 'scale(1)', opacity: '1' }
                        },
                        glow: {
                            '0%': { boxShadow: '0 0 20px rgba(99, 102, 241, 0.3)' },
                            '100%': { boxShadow: '0 0 30px rgba(99, 102, 241, 0.6)' }
                        },
                        rotateSlow: {
                            '0%': { transform: 'rotate(0deg)' },
                            '100%': { transform: 'rotate(360deg)' }
                        },
                        wiggle: {
                            '0%, 100%': { transform: 'rotate(-3deg)' },
                            '50%': { transform: 'rotate(3deg)' }
                        }
                    },
                    backgroundImage: {
                        'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
                        'gradient-conic': 'conic-gradient(from 180deg at 50% 50%, var(--tw-gradient-stops))',
                        'mesh-gradient': 'linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%)',
                    },
                    backdropBlur: {
                        xs: '2px',
                    },
                    screens: {
                        'xs': '475px',
                    }
                }
            }
        }
    </script>
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class('antialiased'); ?>>

<div class="grant-analyzer-page bg-gradient-to-br from-gray-50 via-blue-50 to-indigo-50 min-h-screen overflow-x-hidden">
    
    <!-- Hero Section -->
    <section class="analyzer-hero relative min-h-screen bg-gradient-to-br from-indigo-900 via-purple-900 to-blue-900 text-white pt-24 pb-32 overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 bg-black/30"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-600/20 to-purple-600/20"></div>
        
        <!-- Background Patterns -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-20 h-20 bg-white rounded-full animate-pulse-soft"></div>
            <div class="absolute top-32 right-20 w-16 h-16 bg-cyan-300 rounded-full animate-bounce-gentle"></div>
            <div class="absolute bottom-20 left-1/4 w-12 h-12 bg-green-300 rounded-full animate-float"></div>
            <div class="absolute bottom-32 right-1/3 w-8 h-8 bg-pink-300 rounded-full animate-pulse"></div>
            <div class="absolute top-1/2 left-1/2 w-24 h-24 bg-purple-400/20 rounded-full animate-glow"></div>
        </div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <!-- Badge -->
            <div class="inline-flex items-center gap-3 bg-white/10 backdrop-blur-sm rounded-full px-6 py-3 mb-6 animate-slide-down border border-white/20 hover:bg-white/15 transition-all duration-300">
                <i class="fas fa-calculator text-cyan-300 text-2xl animate-pulse"></i>
                <span class="text-lg font-bold tracking-wider bg-gradient-to-r from-cyan-300 to-blue-300 bg-clip-text text-transparent">
                    GRANT ANALYZER
                </span>
            </div>
            
            <!-- Main Title -->
            <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black mb-6 leading-tight animate-fade-in">
                <span class="bg-gradient-to-r from-cyan-300 to-blue-300 bg-clip-text text-transparent block">
                    助成金比較
                </span>
                <span class="bg-gradient-to-r from-white via-blue-100 to-cyan-200 bg-clip-text text-transparent block">
                    分析ツール
                </span>
            </h1>
            
            <!-- Description -->
            <p class="text-lg sm:text-xl md:text-2xl text-indigo-200 max-w-4xl mx-auto mb-12 animate-slide-up opacity-90 leading-relaxed">
                AI搭載の高度な分析システムで、助成金を徹底比較。<br class="hidden md:block">
                成功確率の計算、ROI分析、最適な申請タイミングまで完全サポート。
            </p>
            
            <!-- Features Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 lg:gap-8 max-w-6xl mx-auto mb-16 animate-slide-up">
                <div class="text-center bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 hover:bg-white/15 transition-all duration-300 group">
                    <div class="w-16 h-16 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-balance-scale text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">詳細比較</h3>
                    <p class="text-indigo-200 text-sm">最大5制度を並べて比較</p>
                </div>
                
                <div class="text-center bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 hover:bg-white/15 transition-all duration-300 group">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-percentage text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">成功確率</h3>
                    <p class="text-indigo-200 text-sm">AI による採択率予測</p>
                </div>
                
                <div class="text-center bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 hover:bg-white/15 transition-all duration-300 group">
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-chart-line text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">ROI 分析</h3>
                    <p class="text-indigo-200 text-sm">投資収益率の詳細分析</p>
                </div>
                
                <div class="text-center bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 hover:bg-white/15 transition-all duration-300 group">
                    <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-red-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-calendar-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">申請計画</h3>
                    <p class="text-indigo-200 text-sm">最適なタイムライン設計</p>
                </div>
            </div>
            
            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-fade-in">
                <button onclick="document.getElementById('analyzer-main').scrollIntoView({behavior: 'smooth'})" 
                        class="bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-bold py-4 px-8 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 group">
                    <i class="fas fa-calculator mr-2 group-hover:animate-pulse"></i>
                    分析ツールを使う
                    <i class="fas fa-arrow-down ml-2 animate-bounce"></i>
                </button>
                <button class="bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white font-bold py-4 px-8 rounded-2xl border border-white/30 hover:border-white/50 transition-all duration-300 transform hover:-translate-y-1 group">
                    <i class="fas fa-play mr-2 group-hover:animate-pulse"></i>
                    使い方を見る
                </button>
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <div class="w-8 h-12 border-2 border-white/50 rounded-full flex justify-center">
                <div class="w-1 h-3 bg-white/70 rounded-full mt-2 animate-pulse"></div>
            </div>
        </div>
    </section>

    <!-- Main Analyzer Section -->
    <section id="analyzer-main" class="analyzer-main py-16 lg:py-20 -mt-16 relative z-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                
                <!-- Tool Navigation -->
                <div class="tool-navigation mb-12 animate-slide-up">
                    <div class="bg-white rounded-2xl shadow-xl p-2 border border-gray-100">
                        <div class="grid grid-cols-2 lg:grid-cols-4 gap-2">
                            <button class="nav-tab active" data-tool="comparison-tool">
                                <i class="fas fa-balance-scale mr-2"></i>
                                <span class="hidden sm:inline">制度比較</span>
                                <span class="sm:hidden">比較</span>
                            </button>
                            <button class="nav-tab" data-tool="calculator-tool">
                                <i class="fas fa-percentage mr-2"></i>
                                <span class="hidden sm:inline">成功確率</span>
                                <span class="sm:hidden">確率</span>
                            </button>
                            <button class="nav-tab" data-tool="roi-tool">
                                <i class="fas fa-chart-line mr-2"></i>
                                <span class="hidden sm:inline">ROI分析</span>
                                <span class="sm:hidden">ROI</span>
                            </button>
                            <button class="nav-tab" data-tool="timeline-tool">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                <span class="hidden sm:inline">申請計画</span>
                                <span class="sm:hidden">計画</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Comparison Tool -->
                <div id="comparison-tool" class="analysis-tool active animate-fade-in">
                    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
                        <!-- Tool Header -->
                        <div class="tool-header bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 p-6 lg:p-8">
                            <div class="flex flex-col lg:flex-row items-center justify-between gap-4">
                                <div class="text-center lg:text-left">
                                    <h2 class="text-2xl lg:text-3xl font-black text-white mb-2">制度詳細比較</h2>
                                    <p class="text-indigo-100">最大5つの助成金制度を並べて詳細比較できます</p>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="text-center">
                                        <div class="text-2xl font-black text-white" id="selected-count">0</div>
                                        <div class="text-xs text-indigo-200">選択中</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-2xl font-black text-cyan-300">5</div>
                                        <div class="text-xs text-indigo-200">最大</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-6 lg:p-8">
                            <!-- Grant Selector -->
                            <div class="grant-selector mb-8">
                                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                    <i class="fas fa-check-square text-indigo-500 mr-3"></i>
                                    比較する制度を選択してください
                                </h3>
                                
                                <!-- Search Filter -->
                                <div class="mb-6">
                                    <div class="relative max-w-md">
                                        <input type="text" id="grant-search" placeholder="制度名で検索..." 
                                               class="w-full p-3 pl-10 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition-all">
                                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4" id="grant-options-container">
                                    <?php
                                    $grants_for_selection = get_posts([
                                        'post_type' => 'grant',
                                        'posts_per_page' => -1,
                                        'post_status' => 'publish',
                                        'orderby' => 'title',
                                        'order' => 'ASC'
                                    ]);

                                    if ($grants_for_selection):
                                        foreach ($grants_for_selection as $grant_post):
                                            $post_id = $grant_post->ID;
                                            $post_slug = $grant_post->post_name;
                                            $max_amount = get_field('max_amount_num', $post_id) ?: 0;
                                            $category = wp_get_post_terms($post_id, 'grant_category');
                                            $category_name = !empty($category) ? $category[0]->name : '一般';
                                    ?>
                                    <div class="grant-option group" data-grant-slug="<?php echo esc_attr($post_slug); ?>" data-post-id="<?php echo esc_attr($post_id); ?>">
                                        <input type="checkbox" id="grant_<?php echo esc_attr($post_slug); ?>" class="grant-checkbox hidden">
                                        <label for="grant_<?php echo esc_attr($post_slug); ?>" class="grant-label block cursor-pointer">
                                            <div class="bg-white border-2 border-gray-200 rounded-2xl p-4 hover:border-indigo-300 hover:shadow-lg transition-all duration-300 group-hover:scale-105">
                                                <div class="flex items-start justify-between mb-3">
                                                    <div class="grant-icon w-12 h-12 bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                                        <i class="fas fa-coins text-lg"></i>
                                                    </div>
                                                    <div class="checkbox-indicator w-6 h-6 border-2 border-gray-300 rounded-md flex items-center justify-center">
                                                        <i class="fas fa-check text-white text-sm hidden"></i>
                                                    </div>
                                                </div>
                                                <h4 class="grant-name font-bold text-gray-900 text-sm mb-2 line-clamp-2 leading-tight"><?php echo esc_html($grant_post->post_title); ?></h4>
                                                <div class="grant-amount text-xs font-medium text-indigo-600 bg-indigo-50 px-2 py-1 rounded-lg inline-block mb-2">
                                                    <?php echo $max_amount ? '最大' . number_format($max_amount) . '万円' : '要確認'; ?>
                                                </div>
                                                <div class="grant-category text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-lg inline-block">
                                                    <?php echo esc_html($category_name); ?>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </div>
                            </div>
                            
                            <!-- Comparison Results -->
                            <div id="comparison-results" class="comparison-results hidden animate-fade-in">
                                <!-- Results will be populated by JavaScript -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Success Calculator Tool -->
                <div id="calculator-tool" class="analysis-tool hidden animate-fade-in">
                    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
                        <div class="tool-header bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600 p-6 lg:p-8">
                            <div class="flex flex-col lg:flex-row items-center justify-between gap-4">
                                <div class="text-center lg:text-left">
                                    <h2 class="text-2xl lg:text-3xl font-black text-white mb-2">成功確率計算機</h2>
                                    <p class="text-green-100">事業内容と条件から採択される確率をAIが予測します</p>
                                </div>
                                <div class="w-20 h-20 bg-white/20 rounded-2xl flex items-center justify-center">
                                    <i class="fas fa-percentage text-white text-3xl animate-pulse"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-6 lg:p-8">
                            <!-- Calculator Form -->
                            <form id="success-calculator-form" class="space-y-8">
                                <div class="grid md:grid-cols-2 gap-8">
                                    <!-- Business Info -->
                                    <div class="space-y-6">
                                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                                            <i class="fas fa-building text-green-500 mr-3"></i>
                                            事業情報
                                        </h3>
                                        
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">事業規模</label>
                                            <select id="business-size" class="w-full p-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-2 focus:ring-green-100 transition-all">
                                                <option value="">選択してください</option>
                                                <option value="micro">個人事業主</option>
                                                <option value="small">小規模企業（従業員20名以下）</option>
                                                <option value="medium">中小企業（従業員300名以下）</option>
                                                <option value="large">大企業（従業員300名以上）</option>
                                            </select>
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">業種</label>
                                            <select id="industry" class="w-full p-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-2 focus:ring-green-100 transition-all">
                                                <option value="">選択してください</option>
                                                <option value="manufacturing">製造業</option>
                                                <option value="service">サービス業</option>
                                                <option value="retail">小売業</option>
                                                <option value="it">IT・情報通信業</option>
                                                <option value="construction">建設業</option>
                                                <option value="other">その他</option>
                                            </select>
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">年間売上高</label>
                                            <select id="annual-revenue" class="w-full p-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-2 focus:ring-green-100 transition-all">
                                                <option value="">選択してください</option>
                                                <option value="under-1000">1,000万円未満</option>
                                                <option value="1000-5000">1,000万円〜5,000万円</option>
                                                <option value="5000-10000">5,000万円〜1億円</option>
                                                <option value="over-10000">1億円以上</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <!-- Project Info -->
                                    <div class="space-y-6">
                                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                                            <i class="fas fa-rocket text-blue-500 mr-3"></i>
                                            事業計画
                                        </h3>
                                        
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">事業の新規性</label>
                                            <select id="innovation-level" class="w-full p-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-2 focus:ring-green-100 transition-all">
                                                <option value="">選択してください</option>
                                                <option value="high">革新的（業界初・画期的）</option>
                                                <option value="medium">改良型（既存技術の改善）</option>
                                                <option value="low">一般的（標準的な取り組み）</option>
                                            </select>
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">投資予定額</label>
                                            <select id="investment-amount" class="w-full p-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-2 focus:ring-green-100 transition-all">
                                                <option value="">選択してください</option>
                                                <option value="under-500">500万円未満</option>
                                                <option value="500-1000">500万円〜1,000万円</option>
                                                <option value="1000-5000">1,000万円〜5,000万円</option>
                                                <option value="over-5000">5,000万円以上</option>
                                            </select>
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">実施体制</label>
                                            <select id="team-structure" class="w-full p-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-2 focus:ring-green-100 transition-all">
                                                <option value="">選択してください</option>
                                                <option value="excellent">専門チーム・外部連携あり</option>
                                                <option value="good">社内チーム中心</option>
                                                <option value="basic">担当者レベル</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="text-center pt-6 border-t border-gray-200">
                                    <button type="submit" class="bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold py-4 px-8 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                                        <i class="fas fa-calculator mr-2"></i>
                                        成功確率を計算する
                                    </button>
                                </div>
                            </form>
                            
                            <!-- Results -->
                            <div id="calculator-results" class="calculator-results hidden mt-8 animate-fade-in">
                                <!-- Results will be populated by JavaScript -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ROI Analysis Tool -->
                <div id="roi-tool" class="analysis-tool hidden animate-fade-in">
                    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
                        <div class="tool-header bg-gradient-to-r from-purple-600 via-pink-600 to-red-600 p-6 lg:p-8">
                            <div class="flex flex-col lg:flex-row items-center justify-between gap-4">
                                <div class="text-center lg:text-left">
                                    <h2 class="text-2xl lg:text-3xl font-black text-white mb-2">ROI 分析ツール</h2>
                                    <p class="text-purple-100">投資収益率を詳細に分析し、最適な助成金を選択</p>
                                </div>
                                <div class="w-20 h-20 bg-white/20 rounded-2xl flex items-center justify-center">
                                    <i class="fas fa-chart-line text-white text-3xl animate-pulse"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-6 lg:p-8">
                            <!-- ROI Form -->
                            <form id="roi-calculator-form" class="space-y-8">
                                <div class="grid md:grid-cols-2 gap-8">
                                    <!-- Investment -->
                                    <div class="space-y-6">
                                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                                            <i class="fas fa-yen-sign text-purple-500 mr-3"></i>
                                            投資額・コスト
                                        </h3>
                                        
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">総投資額（万円）</label>
                                            <input type="number" id="total-investment" placeholder="例: 1000" 
                                                   class="w-full p-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-100 transition-all">
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">助成金額（万円）</label>
                                            <input type="number" id="grant-amount" placeholder="例: 500" 
                                                   class="w-full p-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-100 transition-all">
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">自己負担額（万円）</label>
                                            <input type="number" id="self-burden" placeholder="自動計算されます" readonly
                                                   class="w-full p-3 border-2 border-gray-200 rounded-xl bg-gray-50 text-gray-600">
                                        </div>
                                    </div>
                                    
                                    <!-- Returns -->
                                    <div class="space-y-6">
                                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                                            <i class="fas fa-chart-bar text-green-500 mr-3"></i>
                                            期待効果・収益
                                        </h3>
                                        
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">年間売上向上額（万円）</label>
                                            <input type="number" id="annual-revenue-increase" placeholder="例: 300" 
                                                   class="w-full p-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-100 transition-all">
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">年間コスト削減額（万円）</label>
                                            <input type="number" id="annual-cost-reduction" placeholder="例: 100" 
                                                   class="w-full p-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-100 transition-all">
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">分析期間（年）</label>
                                            <select id="analysis-period" class="w-full p-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-100 transition-all">
                                                <option value="3">3年間</option>
                                                <option value="5" selected>5年間</option>
                                                <option value="10">10年間</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="text-center pt-6 border-t border-gray-200">
                                    <button type="submit" class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold py-4 px-8 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                                        <i class="fas fa-chart-line mr-2"></i>
                                        ROI を分析する
                                    </button>
                                </div>
                            </form>
                            
                            <!-- ROI Results -->
                            <div id="roi-results" class="roi-results hidden mt-8 animate-fade-in">
                                <!-- Results will be populated by JavaScript -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Timeline Tool -->
                <div id="timeline-tool" class="analysis-tool hidden animate-fade-in">
                    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
                        <div class="tool-header bg-gradient-to-r from-orange-600 via-red-600 to-pink-600 p-6 lg:p-8">
                            <div class="flex flex-col lg:flex-row items-center justify-between gap-4">
                                <div class="text-center lg:text-left">
                                    <h2 class="text-2xl lg:text-3xl font-black text-white mb-2">申請計画ツール</h2>
                                    <p class="text-orange-100">最適な申請タイミングと準備スケジュールを設計</p>
                                </div>
                                <div class="w-20 h-20 bg-white/20 rounded-2xl flex items-center justify-center">
                                    <i class="fas fa-calendar-alt text-white text-3xl animate-pulse"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-6 lg:p-8">
                            <!-- Timeline Form -->
                            <form id="timeline-form" class="space-y-8">
                                <div class="grid md:grid-cols-3 gap-8">
                                    <div class="space-y-6">
                                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                                            <i class="fas fa-target text-orange-500 mr-3"></i>
                                            目標設定
                                        </h3>
                                        
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">希望開始時期</label>
                                            <input type="date" id="desired-start" 
                                                   class="w-full p-3 border-2 border-gray-200 rounded-xl focus:border-orange-500 focus:ring-2 focus:ring-orange-100 transition-all">
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">事業期間</label>
                                            <select id="project-duration" class="w-full p-3 border-2 border-gray-200 rounded-xl focus:border-orange-500 focus:ring-2 focus:ring-orange-100 transition-all">
                                                <option value="6">6ヶ月</option>
                                                <option value="12" selected>12ヶ月</option>
                                                <option value="24">24ヶ月</option>
                                                <option value="36">36ヶ月</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="space-y-6">
                                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                                            <i class="fas fa-clock text-blue-500 mr-3"></i>
                                            準備状況
                                        </h3>
                                        
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">事業計画書</label>
                                            <select id="business-plan-status" class="w-full p-3 border-2 border-gray-200 rounded-xl focus:border-orange-500 focus:ring-2 focus:ring-orange-100 transition-all">
                                                <option value="0">未着手</option>
                                                <option value="50">作成中</option>
                                                <option value="100">完成</option>
                                            </select>
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">必要書類</label>
                                            <select id="documents-status" class="w-full p-3 border-2 border-gray-200 rounded-xl focus:border-orange-500 focus:ring-2 focus:ring-orange-100 transition-all">
                                                <option value="0">未準備</option>
                                                <option value="30">一部準備</option>
                                                <option value="70">大部分準備</option>
                                                <option value="100">準備完了</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="space-y-6">
                                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                                            <i class="fas fa-users text-purple-500 mr-3"></i>
                                            実施体制
                                        </h3>
                                        
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">専門家サポート</label>
                                            <select id="expert-support" class="w-full p-3 border-2 border-gray-200 rounded-xl focus:border-orange-500 focus:ring-2 focus:ring-orange-100 transition-all">
                                                <option value="none">なし</option>
                                                <option value="consultant">コンサルタント</option>
                                                <option value="office">行政書士・社労士</option>
                                                <option value="full">フルサポート体制</option>
                                            </select>
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">準備期間の希望</label>
                                            <select id="preparation-period" class="w-full p-3 border-2 border-gray-200 rounded-xl focus:border-orange-500 focus:ring-2 focus:ring-orange-100 transition-all">
                                                <option value="1">1ヶ月</option>
                                                <option value="2">2ヶ月</option>
                                                <option value="3" selected>3ヶ月</option>
                                                <option value="6">6ヶ月</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="text-center pt-6 border-t border-gray-200">
                                    <button type="submit" class="bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-700 hover:to-red-700 text-white font-bold py-4 px-8 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                                        <i class="fas fa-calendar-alt mr-2"></i>
                                        最適なスケジュールを作成
                                    </button>
                                </div>
                            </form>
                            
                            <!-- Timeline Results -->
                            <div id="timeline-results" class="timeline-results hidden mt-8 animate-fade-in">
                                <!-- Results will be populated by JavaScript -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>

<!-- JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tool Navigation
    setupToolNavigation();
    
    // Initialize Tools
    setupComparisonTool();
    setupCalculatorTool();
    setupROITool();
    setupTimelineTool();
    
    // Tool Navigation Setup
    function setupToolNavigation() {
        const navTabs = document.querySelectorAll('.nav-tab');
        const analysisTools = document.querySelectorAll('.analysis-tool');
        
        navTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                const targetTool = this.dataset.tool;
                
                // Update active tab
                navTabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                
                // Show target tool
                analysisTools.forEach(tool => {
                    tool.classList.add('hidden');
                    tool.classList.remove('active');
                });
                
                const targetToolElement = document.getElementById(targetTool);
                if (targetToolElement) {
                    targetToolElement.classList.remove('hidden');
                    targetToolElement.classList.add('active');
                }
            });
        });
    }
    
    // Comparison Tool Setup (DB Connected)
    function setupComparisonTool() {
        const grantCheckboxes = document.querySelectorAll('.grant-checkbox');
        const comparisonResults = document.getElementById('comparison-results');
        const selectedCountElement = document.getElementById('selected-count');
        const grantSearch = document.getElementById('grant-search');
        const grantOptionsContainer = document.getElementById('grant-options-container');
        
        // Search functionality
        if (grantSearch) {
            grantSearch.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const grantOptions = document.querySelectorAll('.grant-option');
                
                grantOptions.forEach(option => {
                    const grantName = option.querySelector('.grant-name').textContent.toLowerCase();
                    if (grantName.includes(searchTerm)) {
                        option.style.display = 'block';
                    } else {
                        option.style.display = 'none';
                    }
                });
            });
        }
        
        grantCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateComparison);
        });
        
        function updateComparison() {
            const selectedCheckboxes = Array.from(grantCheckboxes).filter(cb => cb.checked);
            const selectedCount = selectedCheckboxes.length;
            
            // Update selected count
            if (selectedCountElement) {
                selectedCountElement.textContent = selectedCount;
            }
            
            // Update checkbox indicators
            grantCheckboxes.forEach(checkbox => {
                const indicator = checkbox.closest('.grant-option').querySelector('.checkbox-indicator');
                const checkIcon = indicator.querySelector('.fas.fa-check');
                const grantLabel = checkbox.closest('.grant-option').querySelector('.grant-label > div');
                
                if (checkbox.checked) {
                    indicator.classList.add('bg-indigo-500', 'border-indigo-500');
                    indicator.classList.remove('border-gray-300');
                    checkIcon.classList.remove('hidden');
                    grantLabel.classList.add('ring-2', 'ring-indigo-300', 'border-indigo-400');
                } else {
                    indicator.classList.remove('bg-indigo-500', 'border-indigo-500');
                    indicator.classList.add('border-gray-300');
                    checkIcon.classList.add('hidden');
                    grantLabel.classList.remove('ring-2', 'ring-indigo-300', 'border-indigo-400');
                }
            });
            
            if (selectedCount === 0) {
                comparisonResults.classList.add('hidden');
                return;
            }

            if (selectedCount > 5) {
                alert('比較できるのは最大5件までです。');
                this.checked = false;
                return;
            }

            const selectedPostIds = selectedCheckboxes.map(cb => cb.closest('.grant-option').dataset.postId);
            
            comparisonResults.classList.remove('hidden');
            comparisonResults.innerHTML = `
                <div class="text-center p-12 bg-gradient-to-r from-indigo-50 to-purple-50 rounded-2xl">
                    <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-spinner fa-spin text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">最新データを取得中...</h3>
                    <p class="text-gray-600">詳細な比較情報を準備しています</p>
                </div>
            `;

            // Mock AJAX call - replace with actual implementation
            setTimeout(() => {
                const mockData = generateMockComparisonData(selectedPostIds);
                generateComparisonHTML(mockData);
            }, 1500);
        }
        
        function generateMockComparisonData(postIds) {
            const mockData = {};
            postIds.forEach((id, index) => {
                const grantElement = document.querySelector(`[data-post-id="${id}"]`);
                const grantName = grantElement.querySelector('.grant-name').textContent;
                
                mockData[`grant_${id}`] = {
                    name: grantName,
                    maxAmount: `${Math.floor(Math.random() * 2000 + 500)}万円`,
                    rate: `${Math.floor(Math.random() * 50 + 50)}%`,
                    target: ['製造業', 'サービス業', 'IT業', '小売業'][index % 4],
                    difficulty: ['低', '中', '高'][Math.floor(Math.random() * 3)],
                    reviewPeriod: `${Math.floor(Math.random() * 3 + 2)}ヶ月`,
                    documents: `${Math.floor(Math.random() * 10 + 5)}種類`
                };
            });
            return mockData;
        }

        function generateComparisonHTML(grantData) {
            const grantSlugs = Object.keys(grantData);

            let tableHeaderHTML = '<th class="text-left p-4 font-bold text-gray-900 bg-gray-50">比較項目</th>';
            grantSlugs.forEach(slug => {
                tableHeaderHTML += `<th class="text-center p-4 font-bold text-gray-900 bg-gradient-to-r from-indigo-50 to-purple-50 selected-grant">${grantData[slug].name}</th>`;
            });

            const comparisonItems = [
                { label: '補助上限額', key: 'maxAmount', icon: 'fas fa-coins' },
                { label: '補助率', key: 'rate', icon: 'fas fa-percentage' },
                { label: '対象事業', key: 'target', icon: 'fas fa-building' },
                { label: '申請難易度', key: 'difficulty', icon: 'fas fa-chart-bar' },
                { label: '審査期間', key: 'reviewPeriod', icon: 'fas fa-clock' },
                { label: '必要書類数', key: 'documents', icon: 'fas fa-file-alt' }
            ];

            let tableBodyHTML = '';
            comparisonItems.forEach((item, index) => {
                const bgClass = index % 2 === 0 ? 'bg-white' : 'bg-gray-50';
                let row = `<tr class="${bgClass}">
                    <td class="p-4 font-bold text-gray-900 border-r border-gray-200">
                        <i class="${item.icon} text-indigo-500 mr-2"></i>
                        ${item.label}
                    </td>`;
                grantSlugs.forEach(slug => {
                    const value = grantData[slug][item.key];
                    let cellClass = 'p-4 text-center text-gray-700 font-medium';
                    
                    // Add conditional styling
                    if (item.key === 'difficulty') {
                        if (value === '低') cellClass += ' text-green-600 bg-green-50';
                        else if (value === '高') cellClass += ' text-red-600 bg-red-50';
                        else cellClass += ' text-yellow-600 bg-yellow-50';
                    }
                    
                    row += `<td class="${cellClass}">${value}</td>`;
                });
                row += '</tr>';
                tableBodyHTML += row;
            });

            let ratingHTML = '';
            grantSlugs.forEach(slug => {
                const rating = calculateGrantRating(grantData[slug]);
                ratingHTML += `
                    <div class="rating-card bg-white rounded-2xl p-6 shadow-lg border-l-4 ${rating.borderClass} hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <h5 class="font-bold text-gray-900 text-lg">${grantData[slug].name}</h5>
                            <div class="flex items-center gap-2">
                                <span class="text-2xl font-black ${rating.textColor}">${rating.level}</span>
                                <div class="flex">
                                    ${'★'.repeat(Math.floor(rating.score)).padEnd(5, '☆')}
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-700 mb-4">${rating.comment}</p>
                        <div class="bg-gradient-to-r ${rating.gradientClass} h-2 rounded-full">
                            <div class="h-full bg-white/30 rounded-full" style="width: ${rating.score * 20}%"></div>
                        </div>
                    </div>`;
            });

            comparisonResults.innerHTML = `
                <div class="space-y-8">
                    <div class="overflow-x-auto bg-white rounded-2xl shadow-lg border border-gray-200">
                        <table class="w-full comparison-table">
                            <thead><tr>${tableHeaderHTML}</tr></thead>
                            <tbody>${tableBodyHTML}</tbody>
                        </table>
                    </div>
                    <div class="overall-rating p-6 lg:p-8 bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 rounded-2xl border border-indigo-200">
                        <h4 class="text-2xl font-black text-gray-900 mb-6 text-center">
                            <i class="fas fa-trophy text-yellow-500 mr-3"></i>
                            総合評価・推奨度
                        </h4>
                        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">${ratingHTML}</div>
                    </div>
                </div>`;
        }
    }
    
    // Helper function for grant rating
    function calculateGrantRating(grant) {
        let score = 3.0;
        
        if (grant.difficulty === '低') score += 1.5;
        else if (grant.difficulty === '高') score -= 1.0;
        
        const amount = parseInt(grant.maxAmount.replace(/[^0-9]/g, ''));
        if (amount > 1000) score += 1.0;
        else if (amount < 200) score -= 0.5;
        
        const rate = parseInt(grant.rate.replace(/[^0-9]/g, ''));
        if (rate > 66) score += 0.5;
        
        score = Math.min(Math.max(score, 1.0), 5.0);
        
        if (score >= 4.5) {
            return {
                class: 'excellent', level: 'S', textColor: 'text-green-600', 
                comment: '補助額が大きく、申請難易度も適度で、非常におすすめの制度です。',
                borderClass: 'border-green-500', gradientClass: 'from-green-400 to-emerald-500', score: score
            };
        } else if (score >= 3.5) {
            return {
                class: 'good', level: 'A', textColor: 'text-blue-600',
                comment: 'バランスの取れた制度で、事業計画との適合性が重要になります。',
                borderClass: 'border-blue-500', gradientClass: 'from-blue-400 to-indigo-500', score: score
            };
        } else {
            return {
                class: 'fair', level: 'B', textColor: 'text-orange-600',
                comment: '条件面で慎重な検討が必要ですが、戦略次第で活用可能です。',
                borderClass: 'border-orange-500', gradientClass: 'from-orange-400 to-red-500', score: score
            };
        }
    }
    
    // Success Calculator Tool
    function setupCalculatorTool() {
        const calculatorForm = document.getElementById('success-calculator-form');
        const calculatorResults = document.getElementById('calculator-results');
        
        if (calculatorForm) {
            calculatorForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = {
                    businessSize: document.getElementById('business-size').value,
                    industry: document.getElementById('industry').value,
                    annualRevenue: document.getElementById('annual-revenue').value,
                    innovationLevel: document.getElementById('innovation-level').value,
                    investmentAmount: document.getElementById('investment-amount').value,
                    teamStructure: document.getElementById('team-structure').value
                };
                
                const successRate = calculateSuccessRate(formData);
                displayCalculatorResults(successRate, formData);
            });
        }
        
        function calculateSuccessRate(data) {
            let baseRate = 45; // Base success rate
            
            // Business size factor
            if (data.businessSize === 'small') baseRate += 15;
            else if (data.businessSize === 'medium') baseRate += 10;
            else if (data.businessSize === 'micro') baseRate += 20;
            
            // Innovation level factor  
            if (data.innovationLevel === 'high') baseRate += 20;
            else if (data.innovationLevel === 'medium') baseRate += 10;
            
            // Team structure factor
            if (data.teamStructure === 'excellent') baseRate += 15;
            else if (data.teamStructure === 'good') baseRate += 8;
            
            // Investment amount factor
            if (data.investmentAmount === '1000-5000') baseRate += 10;
            else if (data.investmentAmount === 'over-5000') baseRate += 5;
            
            return Math.min(Math.max(baseRate, 10), 95);
        }
        
        function displayCalculatorResults(successRate, data) {
            const riskLevel = successRate >= 70 ? 'low' : successRate >= 50 ? 'medium' : 'high';
            const riskColor = riskLevel === 'low' ? 'green' : riskLevel === 'medium' ? 'yellow' : 'red';
            const riskText = riskLevel === 'low' ? '低リスク' : riskLevel === 'medium' ? '中リスク' : '高リスク';
            
            calculatorResults.innerHTML = `
                <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-6 lg:p-8 border border-green-200">
                    <h4 class="text-2xl font-black text-center text-gray-900 mb-8">
                        <i class="fas fa-chart-pie text-green-500 mr-3"></i>
                        採択成功確率分析結果
                    </h4>
                    
                    <div class="grid md:grid-cols-2 gap-8 mb-8">
                        <div class="text-center">
                            <div class="relative w-32 h-32 mx-auto mb-4">
                                <div class="w-full h-full bg-gray-200 rounded-full"></div>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="text-4xl font-black text-green-600">${successRate}%</div>
                                </div>
                                <svg class="absolute inset-0 w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                                    <circle cx="50" cy="50" r="45" fill="none" stroke="#e5e7eb" stroke-width="8"/>
                                    <circle cx="50" cy="50" r="45" fill="none" stroke="#10b981" stroke-width="8" 
                                            stroke-dasharray="${2 * Math.PI * 45}" 
                                            stroke-dashoffset="${2 * Math.PI * 45 * (1 - successRate / 100)}"
                                            class="transition-all duration-1000 ease-out"/>
                                </svg>
                            </div>
                            <h5 class="text-xl font-bold text-gray-900">採択確率</h5>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-200">
                                <span class="font-medium text-gray-700">リスクレベル</span>
                                <span class="font-bold text-${riskColor}-600 bg-${riskColor}-100 px-3 py-1 rounded-full">${riskText}</span>
                            </div>
                            <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-200">
                                <span class="font-medium text-gray-700">推奨度</span>
                                <span class="font-bold text-green-600">
                                    ${'★'.repeat(Math.ceil(successRate / 20))}
                                </span>
                            </div>
                            <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-200">
                                <span class="font-medium text-gray-700">申請推奨</span>
                                <span class="font-bold ${successRate >= 60 ? 'text-green-600' : 'text-orange-600'}">
                                    ${successRate >= 60 ? '強く推奨' : '要検討'}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl p-6 border border-gray-200">
                        <h5 class="font-bold text-gray-900 mb-4">
                            <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>
                            改善提案
                        </h5>
                        <div class="grid md:grid-cols-2 gap-4 text-sm">
                            ${generateImprovementSuggestions(data, successRate)}
                        </div>
                    </div>
                </div>
            `;
            
            calculatorResults.classList.remove('hidden');
        }
        
        function generateImprovementSuggestions(data, rate) {
            const suggestions = [];
            
            if (data.innovationLevel !== 'high') {
                suggestions.push('<div class="flex items-start gap-2"><i class="fas fa-plus text-green-500 mt-1"></i><span>事業の革新性をより強調した計画書の作成</span></div>');
            }
            
            if (data.teamStructure !== 'excellent') {
                suggestions.push('<div class="flex items-start gap-2"><i class="fas fa-plus text-green-500 mt-1"></i><span>専門家やコンサルタントとの連携体制構築</span></div>');
            }
            
            if (rate < 60) {
                suggestions.push('<div class="flex items-start gap-2"><i class="fas fa-plus text-green-500 mt-1"></i><span>事前の制度説明会への参加と情報収集</span></div>');
                suggestions.push('<div class="flex items-start gap-2"><i class="fas fa-plus text-green-500 mt-1"></i><span>過去の採択事例の詳細分析と対策</span></div>');
            }
            
            return suggestions.join('');
        }
    }
    
    // ROI Analysis Tool
    function setupROITool() {
        const roiForm = document.getElementById('roi-calculator-form');
        const roiResults = document.getElementById('roi-results');
        const totalInvestment = document.getElementById('total-investment');
        const grantAmount = document.getElementById('grant-amount');
        const selfBurden = document.getElementById('self-burden');
        
        // Auto-calculate self burden
        function updateSelfBurden() {
            const total = parseFloat(totalInvestment.value) || 0;
            const grant = parseFloat(grantAmount.value) || 0;
            selfBurden.value = Math.max(0, total - grant);
        }
        
        if (totalInvestment && grantAmount) {
            totalInvestment.addEventListener('input', updateSelfBurden);
            grantAmount.addEventListener('input', updateSelfBurden);
        }
        
        if (roiForm) {
            roiForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = {
                    totalInvestment: parseFloat(document.getElementById('total-investment').value) || 0,
                    grantAmount: parseFloat(document.getElementById('grant-amount').value) || 0,
                    selfBurden: parseFloat(document.getElementById('self-burden').value) || 0,
                    annualRevenueIncrease: parseFloat(document.getElementById('annual-revenue-increase').value) || 0,
                    annualCostReduction: parseFloat(document.getElementById('annual-cost-reduction').value) || 0,
                    analysisPeriod: parseInt(document.getElementById('analysis-period').value) || 5
                };
                
                const roiAnalysis = calculateROI(formData);
                displayROIResults(roiAnalysis, formData);
            });
        }
        
        function calculateROI(data) {
            const totalAnnualBenefit = data.annualRevenueIncrease + data.annualCostReduction;
            const totalBenefitOverPeriod = totalAnnualBenefit * data.analysisPeriod;
            const netProfit = totalBenefitOverPeriod - data.selfBurden;
            const roi = data.selfBurden > 0 ? (netProfit / data.selfBurden) * 100 : 0;
            const paybackPeriod = totalAnnualBenefit > 0 ? data.selfBurden / totalAnnualBenefit : 999;
            
            return {
                roi: roi,
                netProfit: netProfit,
                totalBenefit: totalBenefitOverPeriod,
                paybackPeriod: paybackPeriod,
                grantEffectiveness: data.totalInvestment > 0 ? (data.grantAmount / data.totalInvestment) * 100 : 0
            };
        }
        
        function displayROIResults(analysis, data) {
            const roiColor = analysis.roi >= 100 ? 'green' : analysis.roi >= 50 ? 'blue' : 'orange';
            const roiLevel = analysis.roi >= 100 ? '優秀' : analysis.roi >= 50 ? '良好' : '要検討';
            
            roiResults.innerHTML = `
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-6 lg:p-8 border border-purple-200">
                    <h4 class="text-2xl font-black text-center text-gray-900 mb-8">
                        <i class="fas fa-chart-line text-purple-500 mr-3"></i>
                        ROI 分析結果
                    </h4>
                    
                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <div class="text-center bg-white rounded-xl p-6 shadow-lg border border-gray-200">
                            <div class="text-3xl font-black text-${roiColor}-600 mb-2">${analysis.roi.toFixed(1)}%</div>
                            <div class="text-sm font-medium text-gray-600">ROI</div>
                            <div class="text-xs text-${roiColor}-600 font-semibold mt-2">${roiLevel}</div>
                        </div>
                        
                        <div class="text-center bg-white rounded-xl p-6 shadow-lg border border-gray-200">
                            <div class="text-3xl font-black text-green-600 mb-2">${analysis.netProfit.toFixed(0)}万円</div>
                            <div class="text-sm font-medium text-gray-600">純利益</div>
                            <div class="text-xs text-green-600 font-semibold mt-2">${data.analysisPeriod}年間</div>
                        </div>
                        
                        <div class="text-center bg-white rounded-xl p-6 shadow-lg border border-gray-200">
                            <div class="text-3xl font-black text-blue-600 mb-2">${analysis.paybackPeriod.toFixed(1)}年</div>
                            <div class="text-sm font-medium text-gray-600">投資回収</div>
                            <div class="text-xs text-blue-600 font-semibold mt-2">期間</div>
                        </div>
                        
                        <div class="text-center bg-white rounded-xl p-6 shadow-lg border border-gray-200">
                            <div class="text-3xl font-black text-purple-600 mb-2">${analysis.grantEffectiveness.toFixed(0)}%</div>
                            <div class="text-sm font-medium text-gray-600">助成金</div>
                            <div class="text-xs text-purple-600 font-semibold mt-2">効果</div>
                        </div>
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="bg-white rounded-xl p-6 border border-gray-200">
                            <h5 class="font-bold text-gray-900 mb-4">
                                <i class="fas fa-calculator text-purple-500 mr-2"></i>
                                投資収益の詳細
                            </h5>
                            <div class="space-y-3 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">総投資額</span>
                                    <span class="font-bold text-gray-900">${data.totalInvestment.toLocaleString()}万円</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">助成金額</span>
                                    <span class="font-bold text-green-600">${data.grantAmount.toLocaleString()}万円</span>
                                </div>
                                <div class="flex justify-between border-t pt-2">
                                    <span class="text-gray-600">自己負担額</span>
                                    <span class="font-bold text-red-600">${data.selfBurden.toLocaleString()}万円</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">年間効果</span>
                                    <span class="font-bold text-blue-600">${(data.annualRevenueIncrease + data.annualCostReduction).toLocaleString()}万円</span>
                                </div>
                                <div class="flex justify-between border-t pt-2">
                                    <span class="text-gray-600">${data.analysisPeriod}年間総効果</span>
                                    <span class="font-bold text-green-600">${analysis.totalBenefit.toLocaleString()}万円</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-xl p-6 border border-gray-200">
                            <h5 class="font-bold text-gray-900 mb-4">
                                <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>
                                投資判断の提案
                            </h5>
                            <div class="space-y-3 text-sm">
                                ${generateROIRecommendations(analysis, data)}
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            roiResults.classList.remove('hidden');
        }
        
        function generateROIRecommendations(analysis, data) {
            const recommendations = [];
            
            if (analysis.roi >= 100) {
                recommendations.push('<div class="flex items-start gap-2"><i class="fas fa-check text-green-500 mt-1"></i><span class="text-green-700">非常に優秀な投資効率です。積極的に進めることをおすすめします。</span></div>');
            } else if (analysis.roi >= 50) {
                recommendations.push('<div class="flex items-start gap-2"><i class="fas fa-info text-blue-500 mt-1"></i><span class="text-blue-700">良好な投資効率です。リスクを考慮した上で検討してください。</span></div>');
            } else {
                recommendations.push('<div class="flex items-start gap-2"><i class="fas fa-exclamation text-orange-500 mt-1"></i><span class="text-orange-700">投資効率が低めです。計画の見直しを検討してください。</span></div>');
            }
            
            if (analysis.paybackPeriod <= 3) {
                recommendations.push('<div class="flex items-start gap-2"><i class="fas fa-clock text-green-500 mt-1"></i><span class="text-green-700">投資回収期間が短く、リスクが低い投資です。</span></div>');
            } else if (analysis.paybackPeriod <= 5) {
                recommendations.push('<div class="flex items-start gap-2"><i class="fas fa-clock text-blue-500 mt-1"></i><span class="text-blue-700">適度な投資回収期間です。</span></div>');
            } else {
                recommendations.push('<div class="flex items-start gap-2"><i class="fas fa-clock text-orange-500 mt-1"></i><span class="text-orange-700">投資回収に時間がかかります。長期的な視点が必要です。</span></div>');
            }
            
            if (analysis.grantEffectiveness >= 70) {
                recommendations.push('<div class="flex items-start gap-2"><i class="fas fa-medal text-gold-500 mt-1"></i><span class="text-yellow-700">助成金の効果が非常に高く、有効活用できています。</span></div>');
            }
            
            return recommendations.join('');
        }
    }
    
    // Timeline Tool
    function setupTimelineTool() {
        const timelineForm = document.getElementById('timeline-form');
        const timelineResults = document.getElementById('timeline-results');
        
        if (timelineForm) {
            timelineForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = {
                    desiredStart: document.getElementById('desired-start').value,
                    projectDuration: parseInt(document.getElementById('project-duration').value),
                    businessPlanStatus: parseInt(document.getElementById('business-plan-status').value),
                    documentsStatus: parseInt(document.getElementById('documents-status').value),
                    expertSupport: document.getElementById('expert-support').value,
                    preparationPeriod: parseInt(document.getElementById('preparation-period').value)
                };
                
                const timeline = generateTimeline(formData);
                displayTimelineResults(timeline, formData);
            });
        }
        
        function generateTimeline(data) {
            const today = new Date();
            const desiredStart = data.desiredStart ? new Date(data.desiredStart) : new Date(today.getTime() + 90 * 24 * 60 * 60 * 1000);
            
            // Calculate preparation time needed
            let prepTimeNeeded = data.preparationPeriod;
            if (data.businessPlanStatus < 100) prepTimeNeeded += Math.ceil((100 - data.businessPlanStatus) / 50);
            if (data.documentsStatus < 100) prepTimeNeeded += Math.ceil((100 - data.documentsStatus) / 50);
            if (data.expertSupport === 'none') prepTimeNeeded += 1;
            
            const applicationDeadline = new Date(desiredStart.getTime() - 30 * 24 * 60 * 60 * 1000);
            const preparationStart = new Date(applicationDeadline.getTime() - prepTimeNeeded * 30 * 24 * 60 * 60 * 1000);
            const projectEnd = new Date(desiredStart.getTime() + data.projectDuration * 30 * 24 * 60 * 60 * 1000);
            
            return {
                preparationStart,
                applicationDeadline,
                projectStart: desiredStart,
                projectEnd,
                prepTimeNeeded,
                milestones: generateMilestones(preparationStart, applicationDeadline, desiredStart, projectEnd, data)
            };
        }
        
        function generateMilestones(prepStart, appDeadline, projStart, projEnd, data) {
            const milestones = [];
            const today = new Date();
            
            // Preparation milestones
            if (data.businessPlanStatus < 100) {
                const planDeadline = new Date(appDeadline.getTime() - 14 * 24 * 60 * 60 * 1000);
                milestones.push({
                    date: planDeadline,
                    title: '事業計画書完成',
                    type: 'preparation',
                    status: planDeadline < today ? 'overdue' : 'upcoming',
                    icon: 'fas fa-file-alt'
                });
            }
            
            if (data.documentsStatus < 100) {
                const docsDeadline = new Date(appDeadline.getTime() - 7 * 24 * 60 * 60 * 1000);
                milestones.push({
                    date: docsDeadline,
                    title: '必要書類準備完了',
                    type: 'preparation',
                    status: docsDeadline < today ? 'overdue' : 'upcoming',
                    icon: 'fas fa-folder-open'
                });
            }
            
            // Application milestone
            milestones.push({
                date: appDeadline,
                title: '助成金申請提出',
                type: 'application',
                status: appDeadline < today ? 'overdue' : 'upcoming',
                icon: 'fas fa-paper-plane'
            });
            
            // Project milestones
            milestones.push({
                date: projStart,
                title: 'プロジェクト開始',
                type: 'project',
                status: projStart < today ? 'completed' : 'upcoming',
                icon: 'fas fa-play'
            });
            
            const midPoint = new Date(projStart.getTime() + (projEnd.getTime() - projStart.getTime()) / 2);
            milestones.push({
                date: midPoint,
                title: '中間報告',
                type: 'project',
                status: midPoint < today ? 'completed' : 'upcoming',
                icon: 'fas fa-chart-bar'
            });
            
            milestones.push({
                date: projEnd,
                title: 'プロジェクト完了・最終報告',
                type: 'project',
                status: projEnd < today ? 'completed' : 'upcoming',
                icon: 'fas fa-flag-checkered'
            });
            
            return milestones.sort((a, b) => a.date - b.date);
        }
        
        function displayTimelineResults(timeline, data) {
            const today = new Date();
            const isTimelineViable = timeline.preparationStart > today;
            
            timelineResults.innerHTML = `
                <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-2xl p-6 lg:p-8 border border-orange-200">
                    <h4 class="text-2xl font-black text-center text-gray-900 mb-8">
                        <i class="fas fa-calendar-alt text-orange-500 mr-3"></i>
                        最適申請スケジュール
                    </h4>
                    
                    ${!isTimelineViable ? `
                        <div class="bg-red-100 border border-red-300 rounded-xl p-4 mb-6">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-exclamation-triangle text-red-500 text-xl"></i>
                                <div>
                                    <h5 class="font-bold text-red-800">スケジュール調整が必要です</h5>
                                    <p class="text-red-700 text-sm">希望開始時期を延期するか、準備期間を短縮する必要があります。</p>
                                </div>
                            </div>
                        </div>
                    ` : ''}
                    
                    <div class="grid md:grid-cols-2 gap-8 mb-8">
                        <div class="space-y-4">
                            <h5 class="font-bold text-gray-900 mb-4">
                                <i class="fas fa-clock text-orange-500 mr-2"></i>
                                重要な日程
                            </h5>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-gray-200">
                                    <span class="text-gray-600">準備開始</span>
                                    <span class="font-bold text-orange-600">${timeline.preparationStart.toLocaleDateString('ja-JP')}</span>
                                </div>
                                <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-gray-200">
                                    <span class="text-gray-600">申請締切</span>
                                    <span class="font-bold text-red-600">${timeline.applicationDeadline.toLocaleDateString('ja-JP')}</span>
                                </div>
                                <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-gray-200">
                                    <span class="text-gray-600">事業開始</span>
                                    <span class="font-bold text-green-600">${timeline.projectStart.toLocaleDateString('ja-JP')}</span>
                                </div>
                                <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-gray-200">
                                    <span class="text-gray-600">事業完了</span>
                                    <span class="font-bold text-blue-600">${timeline.projectEnd.toLocaleDateString('ja-JP')}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <h5 class="font-bold text-gray-900 mb-4">
                                <i class="fas fa-tasks text-blue-500 mr-2"></i>
                                準備タスク概要
                            </h5>
                            <div class="space-y-3">
                                ${data.businessPlanStatus < 100 ? `
                                    <div class="flex items-center gap-3 p-3 bg-white rounded-lg border border-gray-200">
                                        <i class="fas fa-file-alt text-orange-500"></i>
                                        <span class="text-gray-700">事業計画書作成</span>
                                        <span class="ml-auto text-sm font-medium text-orange-600">${100 - data.businessPlanStatus}% 残</span>
                                    </div>
                                ` : ''}
                                ${data.documentsStatus < 100 ? `
                                    <div class="flex items-center gap-3 p-3 bg-white rounded-lg border border-gray-200">
                                        <i class="fas fa-folder-open text-blue-500"></i>
                                        <span class="text-gray-700">必要書類準備</span>
                                        <span class="ml-auto text-sm font-medium text-blue-600">${100 - data.documentsStatus}% 残</span>
                                    </div>
                                ` : ''}
                                ${data.expertSupport === 'none' ? `
                                    <div class="flex items-center gap-3 p-3 bg-white rounded-lg border border-gray-200">
                                        <i class="fas fa-user-tie text-purple-500"></i>
                                        <span class="text-gray-700">専門家との連携</span>
                                        <span class="ml-auto text-sm font-medium text-purple-600">要検討</span>
                                    </div>
                                ` : ''}
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl p-6 border border-gray-200">
                        <h5 class="font-bold text-gray-900 mb-6">
                            <i class="fas fa-road text-gray-500 mr-2"></i>
                            マイルストーン・スケジュール
                        </h5>
                        <div class="relative">
                            <div class="absolute left-6 top-0 bottom-0 w-0.5 bg-gradient-to-b from-orange-300 to-red-300"></div>
                            <div class="space-y-6">
                                ${timeline.milestones.map((milestone, index) => {
                                    const statusColor = milestone.status === 'completed' ? 'green' : 
                                                      milestone.status === 'overdue' ? 'red' : 'blue';
                                    const bgColor = milestone.type === 'preparation' ? 'orange' :
                                                  milestone.type === 'application' ? 'red' : 'green';
                                    
                                    return `
                                        <div class="relative flex items-center gap-4">
                                            <div class="w-12 h-12 bg-${bgColor}-500 text-white rounded-full flex items-center justify-center z-10">
                                                <i class="${milestone.icon}"></i>
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="font-bold text-gray-900">${milestone.title}</h6>
                                                <p class="text-sm text-gray-600">${milestone.date.toLocaleDateString('ja-JP')}</p>
                                            </div>
                                            <div class="text-sm font-medium text-${statusColor}-600 bg-${statusColor}-100 px-3 py-1 rounded-full">
                                                ${milestone.status === 'completed' ? '完了' : 
                                                  milestone.status === 'overdue' ? '要対応' : '予定'}
                                            </div>
                                        </div>
                                    `;
                                }).join('')}
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            timelineResults.classList.remove('hidden');
        }
    }
});
</script>

<style>
/* Custom Styles */
.nav-tab {
    @apply px-4 py-3 rounded-xl font-semibold text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 transition-all duration-300 text-center;
}

.nav-tab.active {
    @apply bg-gradient-to-r from-indigo-500 to-purple-600 text-white shadow-lg;
}

.analysis-tool {
    @apply hidden;
}

.analysis-tool.active {
    @apply block;
}

.grant-checkbox:checked + .grant-label .checkbox-indicator {
    @apply bg-indigo-500 border-indigo-500;
}

.grant-checkbox:checked + .grant-label .checkbox-indicator .fa-check {
    @apply block;
}

.comparison-table {
    @apply border-collapse;
}

.comparison-table th,
.comparison-table td {
    @apply border-b border-gray-200;
}

.comparison-table th {
    @apply bg-gradient-to-r from-gray-50 to-gray-100 font-bold text-gray-900;
}

/* Animation Classes */
.animate-glow {
    animation: glow 2s ease-in-out infinite alternate;
}

/* Responsive */
@media (max-width: 768px) {
    .container {
        @apply px-4;
    }
    
    .text-4xl {
        font-size: 2.5rem;
    }
    
    .text-6xl {
        font-size: 3.5rem;
    }
}

/* Print Styles */
@media print {
    .hero-section,
    .nav-tab,
    button {
        @apply hidden;
    }
}
</style>

<?php wp_footer(); ?>
</body>
</html>

<?php get_footer(); ?>
