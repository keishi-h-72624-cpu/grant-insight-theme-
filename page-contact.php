<?php
/**
 * Template Name: 最強AI相談ページ - Tailwind CSS Play CDN対応版
 * Description: jgrants_ai_chatショートコードを統合した高機能AIチャットページ
 */

get_header(); ?>

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
                        'bounce-gentle': 'bounceGentle 2s infinite',
                        'pulse-soft': 'pulseSoft 3s infinite',
                        'gradient-shift': 'gradientShift 8s ease-in-out infinite',
                        'typing': 'typing 1.5s infinite',
                        'float': 'float 3s ease-in-out infinite',
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
                        bounceGentle: {
                            '0%, 20%, 50%, 80%, 100%': { transform: 'translateY(0)' },
                            '40%': { transform: 'translateY(-10px)' },
                            '60%': { transform: 'translateY(-5px)' }
                        },
                        pulseSoft: {
                            '0%, 100%': { opacity: '1' },
                            '50%': { opacity: '0.7' }
                        },
                        gradientShift: {
                            '0%, 100%': { backgroundPosition: '0% 50%' },
                            '50%': { backgroundPosition: '100% 50%' }
                        },
                        typing: {
                            '0%, 60%, 100%': { opacity: '1' },
                            '30%': { opacity: '0' }
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' }
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

<div class="super-ai-chat-page bg-gradient-to-br from-gray-50 via-blue-50 to-indigo-50 min-h-screen overflow-x-hidden">
    
    <!-- Hero Section -->
    <section class="ai-chat-hero relative min-h-[60vh] bg-gradient-to-br from-blue-900 via-indigo-900 to-purple-900 text-white py-20 overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="absolute top-10 left-10 w-32 h-32 bg-cyan-400/10 rounded-full animate-float"></div>
        <div class="absolute bottom-10 right-10 w-24 h-24 bg-purple-400/10 rounded-full animate-bounce-gentle"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-blue-400/10 rounded-full animate-pulse-soft"></div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <!-- Badge -->
            <div class="inline-flex items-center gap-3 bg-white/10 backdrop-blur-sm rounded-full px-6 py-3 mb-6 animate-fade-in border border-white/20 hover:bg-white/15 transition-all duration-300">
                <i class="fas fa-robot text-cyan-300 text-xl animate-pulse"></i>
                <span class="text-lg font-bold tracking-wider bg-gradient-to-r from-cyan-300 to-blue-300 bg-clip-text text-transparent">
                    AI助成金コンシェルジュ
                </span>
            </div>
            
            <!-- Main Title -->
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black leading-tight mb-6 animate-slide-up">
                <span class="bg-gradient-to-r from-white via-blue-100 to-cyan-200 bg-clip-text text-transparent">
                    24時間いつでも
                </span>
                <br>
                <span class="bg-gradient-to-r from-cyan-200 via-blue-200 to-white bg-clip-text text-transparent">
                    助成金相談
                </span>
            </h1>
            
            <!-- Description -->
            <p class="text-lg sm:text-xl text-blue-100 leading-relaxed max-w-4xl mx-auto animate-slide-up opacity-90">
                専門知識を持つAIが、あなたの質問にリアルタイムで回答。<br class="hidden sm:block">
                申請の疑問から最適な制度の提案まで、いつでもお気軽にご相談ください。
            </p>
            
            <!-- Scroll Indicator -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
                <i class="fas fa-chevron-down text-white/70 text-2xl"></i>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="py-12 sm:py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-8 lg:gap-12 items-start">
                
                <!-- AI Chat Section -->
                <div class="lg:col-span-2 animate-fade-in">
                    <div class="bg-white rounded-2xl sm:rounded-3xl shadow-2xl border border-gray-100 overflow-hidden hover:shadow-3xl transition-all duration-500 group">
                        <!-- Chat Header -->
                        <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 p-4 sm:p-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                                        <i class="fas fa-robot text-white text-lg animate-pulse-soft"></i>
                                    </div>
                                    <div>
                                        <h2 class="text-xl font-bold text-white">AI助成金アシスタント</h2>
                                        <p class="text-white/80 text-sm">オンライン - 即座に回答します</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                    <span class="text-white/90 text-xs font-medium">LIVE</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Chat Content -->
                        <div class="p-4 sm:p-6 lg:p-8">
                            <?php
                            // プラグインのAIチャットショートコードを呼び出し
                            echo do_shortcode('[jgrants_ai_chat]'); 
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <aside class="lg:col-span-1 space-y-6 lg:space-y-8 lg:sticky lg:top-24 animate-slide-up">
                    
                    <!-- AI Capabilities Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300 group">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center group-hover:text-indigo-600 transition-colors">
                            <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition-transform">
                                <i class="fas fa-magic text-white text-sm"></i>
                            </div>
                            AIでできること
                        </h3>
                        
                        <div class="space-y-4">
                            <div class="flex items-start gap-4 p-4 bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl hover:from-indigo-100 hover:to-purple-100 transition-all duration-300 group/item cursor-pointer">
                                <div class="w-8 h-8 bg-indigo-500 rounded-lg flex items-center justify-center flex-shrink-0 group-hover/item:scale-110 transition-transform">
                                    <i class="fas fa-search text-white text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="font-semibold text-gray-800 group-hover/item:text-indigo-700 transition-colors">制度検索</div>
                                    <div class="text-gray-600 text-sm mt-1">事業内容に合った助成金を瞬時に検索</div>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-4 p-4 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl hover:from-emerald-100 hover:to-teal-100 transition-all duration-300 group/item cursor-pointer">
                                <div class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center flex-shrink-0 group-hover/item:scale-110 transition-transform">
                                    <i class="fas fa-check-circle text-white text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="font-semibold text-gray-800 group-hover/item:text-emerald-700 transition-colors">申請条件の確認</div>
                                    <div class="text-gray-600 text-sm mt-1">対象者や詳細条件について質問可能</div>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-4 p-4 bg-gradient-to-r from-amber-50 to-orange-50 rounded-xl hover:from-amber-100 hover:to-orange-100 transition-all duration-300 group/item cursor-pointer">
                                <div class="w-8 h-8 bg-amber-500 rounded-lg flex items-center justify-center flex-shrink-0 group-hover/item:scale-110 transition-transform">
                                    <i class="fas fa-lightbulb text-white text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="font-semibold text-gray-800 group-hover/item:text-amber-700 transition-colors">申請のコツ</div>
                                    <div class="text-gray-600 text-sm mt-1">採択率を上げる実践的なポイントを学習</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Related Links Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300 group">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center group-hover:text-gray-700 transition-colors">
                            <div class="w-8 h-8 bg-gradient-to-br from-gray-500 to-gray-700 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition-transform">
                                <i class="fas fa-link text-white text-sm"></i>
                            </div>
                            関連リンク
                        </h3>
                        
                        <div class="space-y-3">
                            <a href="<?php echo esc_url(home_url('/grants/')); ?>" 
                               class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl font-medium text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 hover:text-blue-700 transition-all duration-300 group/link">
                                <div class="w-8 h-8 bg-gray-400 group-hover/link:bg-blue-500 rounded-lg flex items-center justify-center transition-colors">
                                    <i class="fas fa-list-ul text-white text-sm"></i>
                                </div>
                                <span class="flex-1">助成金・補助金一覧</span>
                                <i class="fas fa-arrow-right text-gray-400 group-hover/link:text-blue-500 group-hover/link:translate-x-1 transition-all"></i>
                            </a>
                            
                            <a href="<?php echo esc_url(home_url('/ai-diagnosis/')); ?>" 
                               class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl font-medium text-gray-700 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 hover:text-emerald-700 transition-all duration-300 group/link">
                                <div class="w-8 h-8 bg-gray-400 group-hover/link:bg-emerald-500 rounded-lg flex items-center justify-center transition-colors">
                                    <i class="fas fa-tasks text-white text-sm"></i>
                                </div>
                                <span class="flex-1">AI事業診断</span>
                                <i class="fas fa-arrow-right text-gray-400 group-hover/link:text-emerald-500 group-hover/link:translate-x-1 transition-all"></i>
                            </a>
                            
                            <a href="<?php echo esc_url(home_url('/case-studies/')); ?>" 
                               class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl font-medium text-gray-700 hover:bg-gradient-to-r hover:from-amber-50 hover:to-orange-50 hover:text-amber-700 transition-all duration-300 group/link">
                                <div class="w-8 h-8 bg-gray-400 group-hover/link:bg-amber-500 rounded-lg flex items-center justify-center transition-colors">
                                    <i class="fas fa-trophy text-white text-sm"></i>
                                </div>
                                <span class="flex-1">成功事例</span>
                                <i class="fas fa-arrow-right text-gray-400 group-hover/link:text-amber-500 group-hover/link:translate-x-1 transition-all"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Usage Stats Card -->
                    <div class="bg-gradient-to-br from-indigo-500 via-purple-600 to-pink-600 rounded-2xl shadow-lg p-6 text-white overflow-hidden relative">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-16 translate-x-16"></div>
                        <div class="relative z-10">
                            <h3 class="text-lg font-bold mb-4 flex items-center">
                                <i class="fas fa-chart-line mr-3"></i>
                                リアルタイム統計
                            </h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="text-center">
                                    <div class="text-2xl font-black">1,247</div>
                                    <div class="text-xs opacity-90">今日の相談数</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-black">98.5%</div>
                                    <div class="text-xs opacity-90">満足度</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </aside>
            </div>
        </div>
    </main>

    <!-- FAQ Section -->
    <section class="faq-section py-16 lg:py-20 bg-white relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-gray-50/50 to-white"></div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12 lg:mb-16">
                <div class="inline-flex items-center gap-2 bg-indigo-100 text-indigo-700 px-4 py-2 rounded-full text-sm font-medium mb-4">
                    <i class="fas fa-question-circle"></i>
                    よくあるご質問
                </div>
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                    疑問を解決します
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    AIチャットに関する、よくお寄せいただくご質問をまとめました
                </p>
            </div>
            
            <div class="max-w-4xl mx-auto space-y-4">
                <details class="bg-white border border-gray-200 p-6 rounded-2xl group hover:shadow-lg transition-all duration-300 animate-fade-in">
                    <summary class="font-semibold cursor-pointer flex justify-between items-center text-gray-800 group-hover:text-indigo-600 transition-colors">
                        <span class="flex items-center gap-3">
                            <i class="fas fa-brain text-indigo-500"></i>
                            AIの回答はどのくらい正確ですか？
                        </span>
                        <i class="fas fa-chevron-down text-gray-400 group-open:rotate-180 group-hover:text-indigo-500 transition-all duration-300"></i>
                    </summary>
                    <div class="mt-6 pt-6 border-t border-gray-100 text-gray-700 leading-relaxed">
                        <p class="mb-4">AIは常に最新の公募要領と過去の採択事例を学習しており、<strong class="text-indigo-600">95%以上の精度</strong>で回答いたします。</p>
                        <p>ただし、最終的な判断は必ず公式情報をご確認ください。あくまで申請のサポートとしてご活用いただくことを目的としています。</p>
                    </div>
                </details>
                
                <details class="bg-white border border-gray-200 p-6 rounded-2xl group hover:shadow-lg transition-all duration-300 animate-fade-in">
                    <summary class="font-semibold cursor-pointer flex justify-between items-center text-gray-800 group-hover:text-indigo-600 transition-colors">
                        <span class="flex items-center gap-3">
                            <i class="fas fa-shield-alt text-emerald-500"></i>
                            相談した内容は保存されますか？
                        </span>
                        <i class="fas fa-chevron-down text-gray-400 group-open:rotate-180 group-hover:text-indigo-500 transition-all duration-300"></i>
                    </summary>
                    <div class="mt-6 pt-6 border-t border-gray-100 text-gray-700 leading-relaxed">
                        <p class="mb-4">相談内容は、<strong class="text-emerald-600">個人を特定できない形</strong>でAIの学習データとして活用させていただく場合があります。</p>
                        <p class="mb-4">個人情報や機密情報の入力はお控えください。詳細は<a href="<?php echo esc_url(home_url('/privacy/')); ?>" class="text-indigo-600 hover:text-indigo-800 underline">プライバシーポリシー</a>をご覧ください。</p>
                    </div>
                </details>
                
                <details class="bg-white border border-gray-200 p-6 rounded-2xl group hover:shadow-lg transition-all duration-300 animate-fade-in">
                    <summary class="font-semibold cursor-pointer flex justify-between items-center text-gray-800 group-hover:text-indigo-600 transition-colors">
                        <span class="flex items-center gap-3">
                            <i class="fas fa-clock text-amber-500"></i>
                            24時間いつでも利用できますか？
                        </span>
                        <i class="fas fa-chevron-down text-gray-400 group-open:rotate-180 group-hover:text-indigo-500 transition-all duration-300"></i>
                    </summary>
                    <div class="mt-6 pt-6 border-t border-gray-100 text-gray-700 leading-relaxed">
                        <p class="mb-4">はい、<strong class="text-amber-600">24時間365日</strong>いつでもご利用いただけます。</p>
                        <p>深夜や早朝でも、AIが即座に回答いたします。メンテナンス時間を除き、常時サービスをご提供しています。</p>
                    </div>
                </details>
            </div>
        </div>
    </section>

</div>

<!-- Custom Scripts -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // FAQ accordion animation
    document.querySelectorAll('details').forEach(detail => {
        detail.addEventListener('toggle', function() {
            if (this.open) {
                this.style.animation = 'slideUp 0.3s ease-out';
            }
        });
    });

    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = entry.target.dataset.animation || 'fade-in 0.8s ease-out forwards';
                entry.target.style.opacity = '1';
            }
        });
    }, observerOptions);

    // Observe elements for animation
    document.querySelectorAll('.animate-fade-in, .animate-slide-up').forEach(el => {
        el.style.opacity = '0';
        observer.observe(el);
    });
});
</script>

<style>
/* Custom Styles for Enhanced UX */
.group-open\:rotate-180[open] summary i {
    transform: rotate(180deg);
}

summary::-webkit-details-marker {
    display: none;
}

/* Smooth transitions for all interactive elements */
* {
    transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 150ms;
}

/* Enhanced focus states for accessibility */
button:focus-visible,
a:focus-visible,
details:focus-visible {
    outline: 2px solid #6366f1;
    outline-offset: 2px;
}

/* Loading animation for chat messages */
@keyframes messageSlide {
    0% { 
        opacity: 0; 
        transform: translateY(20px) scale(0.95); 
    }
    100% { 
        opacity: 1; 
        transform: translateY(0) scale(1); 
    }
}

.chat-message {
    animation: messageSlide 0.4s ease-out;
}

/* Gradient text animations */
@keyframes gradientFlow {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

.gradient-text {
    background: linear-gradient(45deg, #6366f1, #8b5cf6, #ec4899, #06b6d4);
    background-size: 300% 300%;
    animation: gradientFlow 3s ease-in-out infinite;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Responsive improvements */
@media (max-width: 640px) {
    .container {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    .text-4xl {
        font-size: 2.5rem;
        line-height: 1.1;
    }
}
</style>

<?php wp_footer(); ?>
</body>
</html>

<?php get_footer(); ?>