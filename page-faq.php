<?php
/*
Template Name: よくある質問 - Tailwind CSS Play CDN対応版
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
                        'float': 'float 3s ease-in-out infinite',
                        'scale-up': 'scaleUp 0.3s ease-out',
                        'accordion-open': 'accordionOpen 0.3s ease-out',
                        'shimmer': 'shimmer 2s infinite',
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
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' }
                        },
                        scaleUp: {
                            '0%': { transform: 'scale(0.95)', opacity: '0' },
                            '100%': { transform: 'scale(1)', opacity: '1' }
                        },
                        accordionOpen: {
                            '0%': { opacity: '0', maxHeight: '0', transform: 'translateY(-10px)' },
                            '100%': { opacity: '1', maxHeight: '200px', transform: 'translateY(0)' }
                        },
                        shimmer: {
                            '0%': { transform: 'translateX(-100%)' },
                            '100%': { transform: 'translateX(100%)' }
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

<div class="faq-page-container bg-gradient-to-br from-gray-50 via-blue-50 to-indigo-50 min-h-screen overflow-x-hidden">
    
    <!-- Hero Section -->
    <section class="faq-hero relative bg-gradient-to-br from-indigo-900 via-blue-900 to-purple-900 text-white py-20 overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="absolute top-10 left-10 w-32 h-32 bg-cyan-400/10 rounded-full animate-float"></div>
        <div class="absolute bottom-10 right-10 w-24 h-24 bg-purple-400/10 rounded-full animate-bounce-gentle"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-blue-400/10 rounded-full animate-pulse-soft"></div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Badge -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center gap-3 bg-white/10 backdrop-blur-sm rounded-full px-6 py-3 mb-6 animate-fade-in border border-white/20">
                    <i class="fas fa-question-circle text-cyan-300 text-xl animate-pulse"></i>
                    <span class="text-lg font-bold tracking-wider bg-gradient-to-r from-cyan-300 to-blue-300 bg-clip-text text-transparent">
                        FAQ
                    </span>
                </div>
                
                <!-- Page Header -->
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black leading-tight mb-6 animate-slide-up">
                    <span class="bg-gradient-to-r from-white via-blue-100 to-cyan-200 bg-clip-text text-transparent">
                        よくある質問
                    </span>
                </h1>
                
                <p class="text-lg sm:text-xl text-blue-100 leading-relaxed max-w-4xl mx-auto animate-slide-up opacity-90">
                    助成金に関する疑問や、当サイトの利用方法について、<br class="hidden sm:block">
                    よくある質問をまとめました。解決しない場合はお気軽にお問い合わせください。
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="py-12 sm:py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Search Box -->
            <div class="max-w-2xl mx-auto mb-12 animate-fade-in">
                <div class="relative">
                    <input type="text" 
                           id="faqSearch" 
                           placeholder="質問を検索..." 
                           class="w-full px-6 py-4 pr-12 text-lg bg-white border-2 border-gray-200 rounded-2xl shadow-lg focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 focus:outline-none transition-all duration-300">
                    <div class="absolute right-4 top-1/2 transform -translate-y-1/2">
                        <i class="fas fa-search text-gray-400 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- FAQ Categories -->
            <div class="max-w-6xl mx-auto mb-12">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                    <button class="faq-category-btn active px-4 py-3 rounded-xl bg-indigo-500 text-white font-medium hover:bg-indigo-600 transition-all duration-300" data-category="all">
                        <i class="fas fa-th-large mr-2"></i>すべて
                    </button>
                    <button class="faq-category-btn px-4 py-3 rounded-xl bg-white text-gray-700 font-medium hover:bg-indigo-50 hover:text-indigo-600 border border-gray-200 transition-all duration-300" data-category="basic">
                        <i class="fas fa-info-circle mr-2"></i>基本情報
                    </button>
                    <button class="faq-category-btn px-4 py-3 rounded-xl bg-white text-gray-700 font-medium hover:bg-indigo-50 hover:text-indigo-600 border border-gray-200 transition-all duration-300" data-category="ai">
                        <i class="fas fa-robot mr-2"></i>AI機能
                    </button>
                    <button class="faq-category-btn px-4 py-3 rounded-xl bg-white text-gray-700 font-medium hover:bg-indigo-50 hover:text-indigo-600 border border-gray-200 transition-all duration-300" data-category="service">
                        <i class="fas fa-cogs mr-2"></i>サービス
                    </button>
                </div>
            </div>

            <!-- FAQセクション -->
            <div class="max-w-5xl mx-auto">
                <div id="faqContainer" class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
                    
                    <!-- FAQ Item 1 -->
                    <details class="faq-item border-b border-gray-200 group" data-category="basic">
                        <summary class="p-6 sm:p-8 cursor-pointer font-semibold hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 flex items-center justify-between transition-all duration-300 group-hover:text-indigo-700">
                            <span class="flex items-center gap-4 text-lg text-gray-800 group-hover:text-indigo-700">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center flex-shrink-0">
                                    <span class="text-white font-bold text-sm">Q1</span>
                                </div>
                                助成金とは何ですか？
                            </span>
                            <i class="fas fa-chevron-down text-gray-400 group-hover:text-indigo-500 group-open:rotate-180 transition-all duration-300 text-xl"></i>
                        </summary>
                        <div class="px-6 sm:px-8 pb-6 sm:pb-8 text-gray-700 leading-relaxed animate-accordion-open">
                            <div class="ml-14 bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-2xl">
                                <p class="mb-4 text-lg">助成金とは、<strong class="text-indigo-600">国や地方公共団体が、特定の政策目標を達成するために、事業者や個人に対して支給する返済不要のお金</strong>です。</p>
                                <div class="grid md:grid-cols-2 gap-4 mt-4">
                                    <div class="bg-white p-4 rounded-xl shadow-sm">
                                        <h4 class="font-semibold text-indigo-700 mb-2"><i class="fas fa-users mr-2"></i>雇用促進</h4>
                                        <p class="text-sm text-gray-600">従業員の雇用や職場環境の改善</p>
                                    </div>
                                    <div class="bg-white p-4 rounded-xl shadow-sm">
                                        <h4 class="font-semibold text-emerald-700 mb-2"><i class="fas fa-flask mr-2"></i>研究開発</h4>
                                        <p class="text-sm text-gray-600">新技術や製品の研究開発</p>
                                    </div>
                                    <div class="bg-white p-4 rounded-xl shadow-sm">
                                        <h4 class="font-semibold text-amber-700 mb-2"><i class="fas fa-industry mr-2"></i>設備投資</h4>
                                        <p class="text-sm text-gray-600">生産設備やIT機器の導入</p>
                                    </div>
                                    <div class="bg-white p-4 rounded-xl shadow-sm">
                                        <h4 class="font-semibold text-purple-700 mb-2"><i class="fas fa-rocket mr-2"></i>事業再構築</h4>
                                        <p class="text-sm text-gray-600">新分野への展開や業態転換</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </details>

                    <!-- FAQ Item 2 -->
                    <details class="faq-item border-b border-gray-200 group" data-category="basic">
                        <summary class="p-6 sm:p-8 cursor-pointer font-semibold hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 flex items-center justify-between transition-all duration-300">
                            <span class="flex items-center gap-4 text-lg text-gray-800 group-hover:text-emerald-700">
                                <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center flex-shrink-0">
                                    <span class="text-white font-bold text-sm">Q2</span>
                                </div>
                                助成金と補助金の違いは何ですか？
                            </span>
                            <i class="fas fa-chevron-down text-gray-400 group-hover:text-emerald-500 group-open:rotate-180 transition-all duration-300 text-xl"></i>
                        </summary>
                        <div class="px-6 sm:px-8 pb-6 sm:pb-8 text-gray-700 leading-relaxed">
                            <div class="ml-14 bg-gradient-to-r from-emerald-50 to-teal-50 p-6 rounded-2xl">
                                <p class="mb-6">助成金と補助金はどちらも<strong class="text-emerald-600">返済不要な資金</strong>ですが、一般的に以下のような違いがあります。</p>
                                
                                <div class="grid md:grid-cols-2 gap-6">
                                    <!-- 助成金 -->
                                    <div class="bg-white rounded-2xl p-6 shadow-lg border-l-4 border-emerald-500">
                                        <h4 class="text-xl font-bold text-emerald-700 mb-4 flex items-center">
                                            <i class="fas fa-hands-helping mr-3"></i>助成金
                                        </h4>
                                        <ul class="space-y-2 text-sm">
                                            <li class="flex items-start gap-2">
                                                <i class="fas fa-check text-emerald-500 mt-1 flex-shrink-0"></i>
                                                <span><strong>厚生労働省</strong>が主管轄</span>
                                            </li>
                                            <li class="flex items-start gap-2">
                                                <i class="fas fa-check text-emerald-500 mt-1 flex-shrink-0"></i>
                                                <span><strong>雇用・人材育成</strong>に関するものが多い</span>
                                            </li>
                                            <li class="flex items-start gap-2">
                                                <i class="fas fa-check text-emerald-500 mt-1 flex-shrink-0"></i>
                                                <span>要件を満たせば<strong>比較的受給しやすい</strong></span>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                    <!-- 補助金 -->
                                    <div class="bg-white rounded-2xl p-6 shadow-lg border-l-4 border-blue-500">
                                        <h4 class="text-xl font-bold text-blue-700 mb-4 flex items-center">
                                            <i class="fas fa-medal mr-3"></i>補助金
                                        </h4>
                                        <ul class="space-y-2 text-sm">
                                            <li class="flex items-start gap-2">
                                                <i class="fas fa-check text-blue-500 mt-1 flex-shrink-0"></i>
                                                <span><strong>経済産業省</strong>が主管轄</span>
                                            </li>
                                            <li class="flex items-start gap-2">
                                                <i class="fas fa-check text-blue-500 mt-1 flex-shrink-0"></i>
                                                <span><strong>新規性・革新性</strong>が重視される</span>
                                            </li>
                                            <li class="flex items-start gap-2">
                                                <i class="fas fa-check text-blue-500 mt-1 flex-shrink-0"></i>
                                                <span>採択件数に上限があり<strong>競争率が高い</strong></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </details>

                    <!-- FAQ Item 3 -->
                    <details class="faq-item border-b border-gray-200 group" data-category="ai">
                        <summary class="p-6 sm:p-8 cursor-pointer font-semibold hover:bg-gradient-to-r hover:from-purple-50 hover:to-pink-50 flex items-center justify-between transition-all duration-300">
                            <span class="flex items-center gap-4 text-lg text-gray-800 group-hover:text-purple-700">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center flex-shrink-0">
                                    <span class="text-white font-bold text-sm">Q3</span>
                                </div>
                                AI診断の精度はどの程度ですか？
                            </span>
                            <i class="fas fa-chevron-down text-gray-400 group-hover:text-purple-500 group-open:rotate-180 transition-all duration-300 text-xl"></i>
                        </summary>
                        <div class="px-6 sm:px-8 pb-6 sm:pb-8 text-gray-700 leading-relaxed">
                            <div class="ml-14 bg-gradient-to-r from-purple-50 to-pink-50 p-6 rounded-2xl">
                                <div class="mb-6">
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center">
                                            <i class="fas fa-brain text-white text-2xl"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-xl font-bold text-purple-700">高精度AIマッチング</h4>
                                            <p class="text-purple-600 font-medium">95%以上の精度で最適な助成金を提案</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="bg-white rounded-2xl p-6 shadow-lg mb-6">
                                    <h5 class="font-bold text-gray-800 mb-4 flex items-center">
                                        <i class="fas fa-database text-purple-500 mr-2"></i>
                                        学習データベース
                                    </h5>
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                                        <div class="p-3 bg-purple-50 rounded-lg">
                                            <div class="text-2xl font-black text-purple-600">500+</div>
                                            <div class="text-xs text-gray-600">助成金制度</div>
                                        </div>
                                        <div class="p-3 bg-purple-50 rounded-lg">
                                            <div class="text-2xl font-black text-purple-600">10万+</div>
                                            <div class="text-xs text-gray-600">採択事例</div>
                                        </div>
                                        <div class="p-3 bg-purple-50 rounded-lg">
                                            <div class="text-2xl font-black text-purple-600">リアルタイム</div>
                                            <div class="text-xs text-gray-600">情報更新</div>
                                        </div>
                                        <div class="p-3 bg-purple-50 rounded-lg">
                                            <div class="text-2xl font-black text-purple-600">24/7</div>
                                            <div class="text-xs text-gray-600">稼働状況</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="bg-amber-50 border-l-4 border-amber-400 p-4 rounded-r-xl">
                                    <div class="flex items-center gap-2 mb-2">
                                        <i class="fas fa-exclamation-triangle text-amber-500"></i>
                                        <span class="font-semibold text-amber-800">重要なお知らせ</span>
                                    </div>
                                    <p class="text-amber-700 text-sm">
                                        最終的な申請可否は、各助成金の詳細な要件や審査によって決定されます。必ずご自身で公式情報をご確認ください。
                                    </p>
                                </div>
                            </div>
                        </div>
                    </details>

                    <!-- FAQ Item 4 -->
                    <details class="faq-item border-b border-gray-200 group" data-category="service">
                        <summary class="p-6 sm:p-8 cursor-pointer font-semibold hover:bg-gradient-to-r hover:from-amber-50 hover:to-orange-50 flex items-center justify-between transition-all duration-300">
                            <span class="flex items-center gap-4 text-lg text-gray-800 group-hover:text-amber-700">
                                <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-orange-600 rounded-full flex items-center justify-center flex-shrink-0">
                                    <span class="text-white font-bold text-sm">Q4</span>
                                </div>
                                助成金申請のサポートはしてもらえますか？
                            </span>
                            <i class="fas fa-chevron-down text-gray-400 group-hover:text-amber-500 group-open:rotate-180 transition-all duration-300 text-xl"></i>
                        </summary>
                        <div class="px-6 sm:px-8 pb-6 sm:pb-8 text-gray-700 leading-relaxed">
                            <div class="ml-14 bg-gradient-to-r from-amber-50 to-orange-50 p-6 rounded-2xl">
                                <p class="mb-6">当サイトでは、助成金申請に関する<strong class="text-amber-600">一般的な情報提供やAI診断</strong>を行っています。</p>
                                
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div class="bg-white rounded-xl p-6 shadow-lg">
                                        <h5 class="font-bold text-amber-700 mb-4 flex items-center">
                                            <i class="fas fa-info-circle mr-2"></i>
                                            無料サービス
                                        </h5>
                                        <ul class="space-y-2 text-sm">
                                            <li class="flex items-start gap-2">
                                                <i class="fas fa-check text-green-500 mt-1"></i>
                                                <span>AI診断による制度マッチング</span>
                                            </li>
                                            <li class="flex items-start gap-2">
                                                <i class="fas fa-check text-green-500 mt-1"></i>
                                                <span>一般的な申請情報の提供</span>
                                            </li>
                                            <li class="flex items-start gap-2">
                                                <i class="fas fa-check text-green-500 mt-1"></i>
                                                <span>AIチャットでの質問対応</span>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                    <div class="bg-white rounded-xl p-6 shadow-lg">
                                        <h5 class="font-bold text-indigo-700 mb-4 flex items-center">
                                            <i class="fas fa-handshake mr-2"></i>
                                            個別サポート
                                        </h5>
                                        <p class="text-sm mb-4">個別の申請サポートをご希望の場合は、お問い合わせフォームよりご相談ください。</p>
                                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="inline-flex items-center gap-2 bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                            <i class="fas fa-envelope"></i>
                                            お問い合わせ
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </details>

                    <!-- FAQ Item 5 -->
                    <details class="faq-item border-b border-gray-200 group" data-category="service">
                        <summary class="p-6 sm:p-8 cursor-pointer font-semibold hover:bg-gradient-to-r hover:from-green-50 hover:to-emerald-50 flex items-center justify-between transition-all duration-300">
                            <span class="flex items-center gap-4 text-lg text-gray-800 group-hover:text-green-700">
                                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center flex-shrink-0">
                                    <span class="text-white font-bold text-sm">Q5</span>
                                </div>
                                サイトの利用は無料ですか？
                            </span>
                            <i class="fas fa-chevron-down text-gray-400 group-hover:text-green-500 group-open:rotate-180 transition-all duration-300 text-xl"></i>
                        </summary>
                        <div class="px-6 sm:px-8 pb-6 sm:pb-8 text-gray-700 leading-relaxed">
                            <div class="ml-14 bg-gradient-to-r from-green-50 to-emerald-50 p-6 rounded-2xl">
                                <div class="mb-6">
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center">
                                            <i class="fas fa-gift text-white text-2xl"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-xl font-bold text-green-700">完全無料でご利用可能</h4>
                                            <p class="text-green-600 font-medium">基本機能はすべて無料でお使いいただけます</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="bg-white rounded-xl p-6 shadow-lg mb-4">
                                    <h5 class="font-bold text-green-700 mb-4 flex items-center">
                                        <i class="fas fa-star mr-2"></i>
                                        無料サービス一覧
                                    </h5>
                                    <div class="grid md:grid-cols-2 gap-4">
                                        <div class="flex items-center gap-3 p-3 bg-green-50 rounded-lg">
                                            <i class="fas fa-search text-green-500"></i>
                                            <span class="text-sm font-medium">助成金情報の閲覧</span>
                                        </div>
                                        <div class="flex items-center gap-3 p-3 bg-green-50 rounded-lg">
                                            <i class="fas fa-robot text-green-500"></i>
                                            <span class="text-sm font-medium">AI診断サービス</span>
                                        </div>
                                        <div class="flex items-center gap-3 p-3 bg-green-50 rounded-lg">
                                            <i class="fas fa-comments text-green-500"></i>
                                            <span class="text-sm font-medium">AIチャット相談</span>
                                        </div>
                                        <div class="flex items-center gap-3 p-3 bg-green-50 rounded-lg">
                                            <i class="fas fa-download text-green-500"></i>
                                            <span class="text-sm font-medium">資料ダウンロード</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-r-xl">
                                    <p class="text-blue-700 text-sm">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        一部、アフィリエイト形式で紹介している外部サービスやツールについては、別途費用が発生する場合があります。
                                    </p>
                                </div>
                            </div>
                        </div>
                    </details>

                    <!-- FAQ Item 6 -->
                    <details class="faq-item group" data-category="service">
                        <summary class="p-6 sm:p-8 cursor-pointer font-semibold hover:bg-gradient-to-r hover:from-indigo-50 hover:to-blue-50 flex items-center justify-between transition-all duration-300">
                            <span class="flex items-center gap-4 text-lg text-gray-800 group-hover:text-indigo-700">
                                <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                                    <span class="text-white font-bold text-sm">Q6</span>
                                </div>
                                掲載されている情報は最新ですか？
                            </span>
                            <i class="fas fa-chevron-down text-gray-400 group-hover:text-indigo-500 group-open:rotate-180 transition-all duration-300 text-xl"></i>
                        </summary>
                        <div class="px-6 sm:px-8 pb-6 sm:pb-8 text-gray-700 leading-relaxed">
                            <div class="ml-14 bg-gradient-to-r from-indigo-50 to-blue-50 p-6 rounded-2xl">
                                <div class="mb-6">
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-2xl flex items-center justify-center">
                                            <i class="fas fa-sync-alt text-white text-2xl animate-spin"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-xl font-bold text-indigo-700">リアルタイム情報更新</h4>
                                            <p class="text-indigo-600 font-medium">常に最新の状態を保つよう努めています</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="bg-white rounded-xl p-6 shadow-lg mb-4">
                                    <h5 class="font-bold text-indigo-700 mb-4 flex items-center">
                                        <i class="fas fa-clock mr-2"></i>
                                        更新スケジュール
                                    </h5>
                                    <div class="space-y-3">
                                        <div class="flex items-center justify-between p-3 bg-indigo-50 rounded-lg">
                                            <span class="font-medium text-indigo-800">助成金制度情報</span>
                                            <span class="text-sm text-indigo-600 bg-indigo-100 px-3 py-1 rounded-full">毎日更新</span>
                                        </div>
                                        <div class="flex items-center justify-between p-3 bg-indigo-50 rounded-lg">
                                            <span class="font-medium text-indigo-800">募集期間・締切情報</span>
                                            <span class="text-sm text-indigo-600 bg-indigo-100 px-3 py-1 rounded-full">リアルタイム</span>
                                        </div>
                                        <div class="flex items-center justify-between p-3 bg-indigo-50 rounded-lg">
                                            <span class="font-medium text-indigo-800">AI学習データ</span>
                                            <span class="text-sm text-indigo-600 bg-indigo-100 px-3 py-1 rounded-full">週次更新</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-r-xl">
                                    <p class="text-yellow-700 text-sm">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        制度の変更や募集期間の終了などにより、情報が古くなる可能性があります。必ず各助成金の公式サイトで最新情報をご確認ください。
                                    </p>
                                </div>
                            </div>
                        </div>
                    </details>
                    
                </div>
            </div>

            <!-- Contact CTA Section -->
            <section class="contact-cta text-center mt-12 lg:mt-16 animate-fade-in">
                <div class="relative bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 text-white rounded-3xl p-8 lg:p-12 overflow-hidden shadow-2xl">
                    <!-- Background Elements -->
                    <div class="absolute top-0 left-0 w-32 h-32 bg-white/10 rounded-full -translate-x-16 -translate-y-16"></div>
                    <div class="absolute bottom-0 right-0 w-24 h-24 bg-white/10 rounded-full translate-x-12 translate-y-12"></div>
                    
                    <div class="relative z-10">
                        <div class="mb-6">
                            <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-headset text-white text-3xl"></i>
                            </div>
                            <h2 class="text-3xl lg:text-4xl font-black mb-4">
                                解決しない場合は<br class="sm:hidden">お問い合わせください
                            </h2>
                            <p class="text-xl lg:text-2xl mb-8 opacity-90 max-w-3xl mx-auto leading-relaxed">
                                上記で解決しないご質問や、個別の相談については、<br class="hidden lg:block">
                                お気軽にお問い合わせください。専門スタッフが丁寧にサポートいたします。
                            </p>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                            <a href="<?php echo esc_url(home_url('/contact/')); ?>" 
                               class="inline-flex items-center gap-3 bg-white text-indigo-600 hover:text-indigo-700 px-8 py-4 rounded-2xl text-lg font-bold shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300 group">
                                <i class="fas fa-envelope text-xl group-hover:animate-bounce"></i>
                                お問い合わせフォーム
                                <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                            </a>
                            
                            <a href="<?php echo esc_url(home_url('/ai-chat/')); ?>" 
                               class="inline-flex items-center gap-3 bg-white/20 backdrop-blur-sm text-white hover:bg-white/30 px-8 py-4 rounded-2xl text-lg font-bold border border-white/20 hover:border-white/40 transition-all duration-300 group">
                                <i class="fas fa-robot text-xl group-hover:animate-pulse"></i>
                                AI相談を試す
                                <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                        
                        <!-- Stats -->
                        <div class="grid grid-cols-3 gap-6 mt-8 pt-8 border-t border-white/20">
                            <div class="text-center">
                                <div class="text-2xl lg:text-3xl font-black mb-1">24h</div>
                                <div class="text-sm opacity-90">回答時間</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl lg:text-3xl font-black mb-1">98%</div>
                                <div class="text-sm opacity-90">解決率</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl lg:text-3xl font-black mb-1">無料</div>
                                <div class="text-sm opacity-90">相談料金</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</div>

<!-- Custom Scripts -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // FAQ Search Functionality
    const searchInput = document.getElementById('faqSearch');
    const faqItems = document.querySelectorAll('.faq-item');
    const categoryBtns = document.querySelectorAll('.faq-category-btn');
    const faqContainer = document.getElementById('faqContainer');
    
    // Search Function
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        let hasResults = false;
        
        faqItems.forEach(item => {
            const text = item.textContent.toLowerCase();
            const matchesSearch = searchTerm === '' || text.includes(searchTerm);
            const currentCategory = document.querySelector('.faq-category-btn.active').dataset.category;
            const matchesCategory = currentCategory === 'all' || item.dataset.category === currentCategory;
            
            if (matchesSearch && matchesCategory) {
                item.style.display = 'block';
                hasResults = true;
            } else {
                item.style.display = 'none';
            }
        });
        
        // Show no results message
        showNoResultsMessage(!hasResults && searchTerm !== '');
    });
    
    // Category Filter
    categoryBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Update active button
            categoryBtns.forEach(b => b.classList.remove('active', 'bg-indigo-500', 'text-white'));
            categoryBtns.forEach(b => b.classList.add('bg-white', 'text-gray-700', 'border', 'border-gray-200'));
            
            this.classList.add('active', 'bg-indigo-500', 'text-white');
            this.classList.remove('bg-white', 'text-gray-700', 'border', 'border-gray-200');
            
            // Filter items
            const category = this.dataset.category;
            const searchTerm = searchInput.value.toLowerCase().trim();
            let hasResults = false;
            
            faqItems.forEach(item => {
                const text = item.textContent.toLowerCase();
                const matchesSearch = searchTerm === '' || text.includes(searchTerm);
                const matchesCategory = category === 'all' || item.dataset.category === category;
                
                if (matchesSearch && matchesCategory) {
                    item.style.display = 'block';
                    hasResults = true;
                } else {
                    item.style.display = 'none';
                }
            });
            
            showNoResultsMessage(!hasResults);
        });
    });
    
    // Show/Hide No Results Message
    function showNoResultsMessage(show) {
        let noResultsMsg = document.getElementById('noResultsMessage');
        
        if (show && !noResultsMsg) {
            noResultsMsg = document.createElement('div');
            noResultsMsg.id = 'noResultsMessage';
            noResultsMsg.className = 'text-center py-12 animate-fade-in';
            noResultsMsg.innerHTML = `
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-search text-gray-400 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-700 mb-2">該当する質問が見つかりませんでした</h3>
                <p class="text-gray-500 mb-6">別のキーワードで検索するか、直接お問い合わせください。</p>
                <a href="${window.location.origin}/contact/" class="inline-flex items-center gap-2 bg-indigo-500 hover:bg-indigo-600 text-white px-6 py-3 rounded-xl font-medium transition-colors">
                    <i class="fas fa-envelope"></i>
                    お問い合わせ
                </a>
            `;
            faqContainer.appendChild(noResultsMsg);
        } else if (!show && noResultsMsg) {
            noResultsMsg.remove();
        }
    }
    
    // Smooth Accordion Animation
    document.querySelectorAll('details').forEach(detail => {
        detail.addEventListener('toggle', function() {
            if (this.open) {
                // Close other details
                document.querySelectorAll('details[open]').forEach(other => {
                    if (other !== this) {
                        other.open = false;
                    }
                });
            }
        });
    });
    
    // Intersection Observer for Animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Observe FAQ items for staggered animation
    faqItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(20px)';
        item.style.transition = `opacity 0.6s ease-out ${index * 0.1}s, transform 0.6s ease-out ${index * 0.1}s`;
        observer.observe(item);
    });
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
</script>

<style>
/* Enhanced Accordion Styles */
.group-open\:rotate-180[open] summary i {
    transform: rotate(180deg);
}

summary::-webkit-details-marker {
    display: none;
}

/* Smooth transitions */
details[open] > summary ~ * {
    animation: accordionOpen 0.3s ease-out;
}

/* Search highlight */
.search-highlight {
    background: linear-gradient(120deg, #fbbf24 0%, #f59e0b 100%);
    color: #1f2937;
    padding: 2px 4px;
    border-radius: 4px;
    font-weight: 600;
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #4f46e5, #7c3aed);
}

/* Enhanced focus states */
button:focus-visible,
a:focus-visible,
details:focus-visible,
input:focus-visible {
    outline: 2px solid #6366f1;
    outline-offset: 2px;
}

/* Loading shimmer effect */
@keyframes shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

.shimmer {
    position: relative;
    overflow: hidden;
}

.shimmer::after {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.6), transparent);
    transform: translateX(-100%);
    animation: shimmer 1.5s infinite;
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
    
    details summary {
        padding: 1rem;
    }
    
    details > div {
        padding: 0 1rem 1rem 1rem;
    }
}

/* Print styles */
@media print {
    .faq-hero,
    .contact-cta,
    button,
    .faq-category-btn {
        display: none;
    }
    
    details {
        break-inside: avoid;
    }
    
    details[open] summary {
        page-break-after: avoid;
    }
}
</style>

<?php wp_footer(); ?>
</body>
</html>

<?php get_footer(); ?>
