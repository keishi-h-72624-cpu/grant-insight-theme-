<?php
/*
Template Name: サイトマップ - Tailwind CSS Play CDN対応版
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
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' }
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class('antialiased'); ?>>

<div class="sitemap-page-container bg-gradient-to-br from-gray-50 via-indigo-50 to-purple-50 min-h-screen">
    
    <!-- Hero Section -->
    <section class="hero-section bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-900 text-white py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="absolute top-10 left-10 w-20 h-20 bg-purple-300/10 rounded-full animate-float"></div>
        <div class="absolute bottom-10 right-10 w-16 h-16 bg-pink-400/10 rounded-full animate-bounce-gentle"></div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16 animate-fade-in">
                <div class="inline-flex items-center gap-3 bg-white/10 backdrop-blur-sm rounded-full px-6 py-3 mb-6 border border-white/20">
                    <i class="fas fa-sitemap text-purple-300 text-2xl animate-pulse"></i>
                    <span class="text-lg font-bold tracking-wider">SITEMAP</span>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black mb-6 leading-tight">
                    <span class="bg-gradient-to-r from-purple-300 to-pink-300 bg-clip-text text-transparent">サイト</span><br>
                    <span class="bg-gradient-to-r from-white to-indigo-200 bg-clip-text text-transparent">マップ</span>
                </h1>
                <p class="text-xl md:text-2xl text-purple-200 max-w-4xl mx-auto leading-relaxed">
                    当サイトの主要なコンテンツを一覧で<br class="hidden md:block">
                    ご確認いただけます。
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-16 lg:py-20 -mt-16 relative z-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                
                <!-- Sitemap Content -->
                <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 animate-slide-up overflow-hidden">
                    
                    <!-- Header -->
                    <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 p-8 lg:p-12">
                        <div class="text-center text-white">
                            <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-map text-white text-3xl"></i>
                            </div>
                            <h2 class="text-2xl lg:text-3xl font-black mb-4">サイト構成図</h2>
                            <p class="text-purple-100 text-lg">すべてのページへ簡単にアクセスできます</p>
                        </div>
                    </div>
                    
                    <!-- Content Grid -->
                    <div class="p-8 lg:p-12">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                            
                            <!-- 基本ページ -->
                            <div class="sitemap-section">
                                <h3 class="text-2xl font-black text-gray-900 mb-6 flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center mr-3">
                                        <i class="fas fa-home text-white"></i>
                                    </div>
                                    基本ページ
                                </h3>
                                <div class="space-y-3">
                                    <a href="<?php echo home_url(); ?>" class="sitemap-link group flex items-center gap-3 p-4 bg-gray-50 hover:bg-blue-50 hover:border-blue-200 border-2 border-gray-200 rounded-2xl transition-all duration-300">
                                        <i class="fas fa-house text-blue-500 group-hover:scale-110 transition-transform"></i>
                                        <span class="font-medium text-gray-700 group-hover:text-blue-700">ホーム</span>
                                    </a>
                                    <a href="<?php echo home_url("/about/"); ?>" class="sitemap-link group flex items-center gap-3 p-4 bg-gray-50 hover:bg-blue-50 hover:border-blue-200 border-2 border-gray-200 rounded-2xl transition-all duration-300">
                                        <i class="fas fa-info-circle text-blue-500 group-hover:scale-110 transition-transform"></i>
                                        <span class="font-medium text-gray-700 group-hover:text-blue-700">当サイトについて</span>
                                    </a>
                                    <a href="<?php echo home_url("/contact/"); ?>" class="sitemap-link group flex items-center gap-3 p-4 bg-gray-50 hover:bg-blue-50 hover:border-blue-200 border-2 border-gray-200 rounded-2xl transition-all duration-300">
                                        <i class="fas fa-envelope text-blue-500 group-hover:scale-110 transition-transform"></i>
                                        <span class="font-medium text-gray-700 group-hover:text-blue-700">お問い合わせ</span>
                                    </a>
                                    <a href="<?php echo home_url("/faq/"); ?>" class="sitemap-link group flex items-center gap-3 p-4 bg-gray-50 hover:bg-blue-50 hover:border-blue-200 border-2 border-gray-200 rounded-2xl transition-all duration-300">
                                        <i class="fas fa-question-circle text-blue-500 group-hover:scale-110 transition-transform"></i>
                                        <span class="font-medium text-gray-700 group-hover:text-blue-700">よくある質問</span>
                                    </a>
                                    <a href="<?php echo home_url("/privacy/"); ?>" class="sitemap-link group flex items-center gap-3 p-4 bg-gray-50 hover:bg-blue-50 hover:border-blue-200 border-2 border-gray-200 rounded-2xl transition-all duration-300">
                                        <i class="fas fa-shield-alt text-blue-500 group-hover:scale-110 transition-transform"></i>
                                        <span class="font-medium text-gray-700 group-hover:text-blue-700">プライバシーポリシー</span>
                                    </a>
                                    <a href="<?php echo home_url("/terms/"); ?>" class="sitemap-link group flex items-center gap-3 p-4 bg-gray-50 hover:bg-blue-50 hover:border-blue-200 border-2 border-gray-200 rounded-2xl transition-all duration-300">
                                        <i class="fas fa-file-contract text-blue-500 group-hover:scale-110 transition-transform"></i>
                                        <span class="font-medium text-gray-700 group-hover:text-blue-700">利用規約</span>
                                    </a>
                                    <a href="<?php echo home_url("/sitemap/"); ?>" class="sitemap-link group flex items-center gap-3 p-4 bg-blue-100 border-2 border-blue-300 rounded-2xl">
                                        <i class="fas fa-sitemap text-blue-600"></i>
                                        <span class="font-bold text-blue-800">サイトマップ（現在のページ）</span>
                                    </a>
                                </div>
                            </div>

                            <!-- 機能ページ -->
                            <div class="sitemap-section">
                                <h3 class="text-2xl font-black text-gray-900 mb-6 flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mr-3">
                                        <i class="fas fa-cogs text-white"></i>
                                    </div>
                                    機能ページ
                                </h3>
                                <div class="space-y-3">
                                    <a href="<?php echo home_url("/ai/diagnosis/"); ?>" class="sitemap-link group flex items-center gap-3 p-4 bg-gray-50 hover:bg-green-50 hover:border-green-200 border-2 border-gray-200 rounded-2xl transition-all duration-300">
                                        <i class="fas fa-robot text-green-500 group-hover:scale-110 transition-transform"></i>
                                        <span class="font-medium text-gray-700 group-hover:text-green-700">AI診断</span>
                                    </a>
                                    <a href="<?php echo home_url("/ai/chat/"); ?>" class="sitemap-link group flex items-center gap-3 p-4 bg-gray-50 hover:bg-green-50 hover:border-green-200 border-2 border-gray-200 rounded-2xl transition-all duration-300">
                                        <i class="fas fa-comments text-green-500 group-hover:scale-110 transition-transform"></i>
                                        <span class="font-medium text-gray-700 group-hover:text-green-700">AIチャット相談</span>
                                    </a>
                                    <a href="<?php echo home_url("/tools/"); ?>" class="sitemap-link group flex items-center gap-3 p-4 bg-gray-50 hover:bg-green-50 hover:border-green-200 border-2 border-gray-200 rounded-2xl transition-all duration-300">
                                        <i class="fas fa-tools text-green-500 group-hover:scale-110 transition-transform"></i>
                                        <span class="font-medium text-gray-700 group-hover:text-green-700">便利ツール</span>
                                    </a>
                                    <a href="<?php echo home_url("/search/"); ?>" class="sitemap-link group flex items-center gap-3 p-4 bg-gray-50 hover:bg-green-50 hover:border-green-200 border-2 border-gray-200 rounded-2xl transition-all duration-300">
                                        <i class="fas fa-search text-green-500 group-hover:scale-110 transition-transform"></i>
                                        <span class="font-medium text-gray-700 group-hover:text-green-700">高度検索</span>
                                    </a>
                                </div>
                            </div>

                            <!-- コンテンツページ -->
                            <div class="sitemap-section">
                                <h3 class="text-2xl font-black text-gray-900 mb-6 flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center mr-3">
                                        <i class="fas fa-newspaper text-white"></i>
                                    </div>
                                    コンテンツ
                                </h3>
                                <div class="space-y-3">
                                    <a href="<?php echo home_url("/case-studies/"); ?>" class="sitemap-link group flex items-center gap-3 p-4 bg-gray-50 hover:bg-purple-50 hover:border-purple-200 border-2 border-gray-200 rounded-2xl transition-all duration-300">
                                        <i class="fas fa-trophy text-purple-500 group-hover:scale-110 transition-transform"></i>
                                        <span class="font-medium text-gray-700 group-hover:text-purple-700">成功事例</span>
                                    </a>
                                    <a href="<?php echo home_url("/guides/"); ?>" class="sitemap-link group flex items-center gap-3 p-4 bg-gray-50 hover:bg-purple-50 hover:border-purple-200 border-2 border-gray-200 rounded-2xl transition-all duration-300">
                                        <i class="fas fa-book text-purple-500 group-hover:scale-110 transition-transform"></i>
                                        <span class="font-medium text-gray-700 group-hover:text-purple-700">解説ガイド</span>
                                    </a>
                                    <a href="<?php echo home_url("/news/"); ?>" class="sitemap-link group flex items-center gap-3 p-4 bg-gray-50 hover:bg-purple-50 hover:border-purple-200 border-2 border-gray-200 rounded-2xl transition-all duration-300">
                                        <i class="fas fa-newspaper text-purple-500 group-hover:scale-110 transition-transform"></i>
                                        <span class="font-medium text-gray-700 group-hover:text-purple-700">最新ニュース</span>
                                    </a>
                                    <a href="<?php echo home_url("/grant-tips/"); ?>" class="sitemap-link group flex items-center gap-3 p-4 bg-gray-50 hover:bg-purple-50 hover:border-purple-200 border-2 border-gray-200 rounded-2xl transition-all duration-300">
                                        <i class="fas fa-lightbulb text-purple-500 group-hover:scale-110 transition-transform"></i>
                                        <span class="font-medium text-gray-700 group-hover:text-purple-700">助成金申請のコツ</span>
                                    </a>
                                </div>
                            </div>

                            <!-- 助成金・補助金ページ -->
                            <div class="sitemap-section">
                                <h3 class="text-2xl font-black text-gray-900 mb-6 flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-r from-orange-500 to-red-600 rounded-2xl flex items-center justify-center mr-3">
                                        <i class="fas fa-coins text-white"></i>
                                    </div>
                                    助成金・補助金
                                </h3>
                                <div class="space-y-3">
                                    <a href="<?php echo home_url("/grants/"); ?>" class="sitemap-link group flex items-center gap-3 p-4 bg-gray-50 hover:bg-orange-50 hover:border-orange-200 border-2 border-gray-200 rounded-2xl transition-all duration-300">
                                        <i class="fas fa-list text-orange-500 group-hover:scale-110 transition-transform"></i>
                                        <span class="font-medium text-gray-700 group-hover:text-orange-700">助成金・補助金一覧</span>
                                    </a>
                                </div>
                                
                                <!-- Categories Subsection -->
                                <h4 class="text-lg font-bold text-gray-700 mt-6 mb-4 pl-2 border-l-4 border-orange-400">カテゴリ別</h4>
                                <div class="space-y-2 ml-4">
                                    <a href="<?php echo home_url("/grant-category/it-dx/"); ?>" class="sitemap-link group flex items-center gap-3 p-3 bg-gray-50 hover:bg-orange-50 hover:border-orange-200 border border-gray-200 rounded-xl transition-all duration-300 text-sm">
                                        <i class="fas fa-laptop text-orange-500 group-hover:scale-110 transition-transform"></i>
                                        <span class="font-medium text-gray-700 group-hover:text-orange-700">IT・DX化</span>
                                    </a>
                                    <a href="<?php echo home_url("/grant-category/equipment-investment/"); ?>" class="sitemap-link group flex items-center gap-3 p-3 bg-gray-50 hover:bg-orange-50 hover:border-orange-200 border border-gray-200 rounded-xl transition-all duration-300 text-sm">
                                        <i class="fas fa-cogs text-orange-500 group-hover:scale-110 transition-transform"></i>
                                        <span class="font-medium text-gray-700 group-hover:text-orange-700">設備投資</span>
                                    </a>
                                    <a href="<?php echo home_url("/grant-category/human-resource-development/"); ?>" class="sitemap-link group flex items-center gap-3 p-3 bg-gray-50 hover:bg-orange-50 hover:border-orange-200 border border-gray-200 rounded-xl transition-all duration-300 text-sm">
                                        <i class="fas fa-users text-orange-500 group-hover:scale-110 transition-transform"></i>
                                        <span class="font-medium text-gray-700 group-hover:text-orange-700">人材育成</span>
                                    </a>
                                    <a href="<?php echo home_url("/grant-category/environment-energy-saving/"); ?>" class="sitemap-link group flex items-center gap-3 p-3 bg-gray-50 hover:bg-orange-50 hover:border-orange-200 border border-gray-200 rounded-xl transition-all duration-300 text-sm">
                                        <i class="fas fa-leaf text-orange-500 group-hover:scale-110 transition-transform"></i>
                                        <span class="font-medium text-gray-700 group-hover:text-orange-700">環境・省エネ</span>
                                    </a>
                                    <a href="<?php echo home_url("/grant-category/startup-support/"); ?>" class="sitemap-link group flex items-center gap-3 p-3 bg-gray-50 hover:bg-orange-50 hover:border-orange-200 border border-gray-200 rounded-xl transition-all duration-300 text-sm">
                                        <i class="fas fa-rocket text-orange-500 group-hover:scale-110 transition-transform"></i>
                                        <span class="font-medium text-gray-700 group-hover:text-orange-700">創業支援</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Navigation -->
                        <div class="mt-16 p-8 bg-gradient-to-r from-indigo-50 via-purple-50 to-pink-50 rounded-3xl border-2 border-indigo-200">
                            <h3 class="text-2xl font-black text-center text-gray-900 mb-8">
                                <i class="fas fa-rocket text-indigo-500 mr-3"></i>
                                クイックナビゲーション
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                                <a href="<?php echo home_url('/ai/diagnosis/'); ?>" class="quick-nav-card group bg-white hover:bg-indigo-50 p-6 rounded-2xl shadow-lg hover:shadow-xl border-2 border-gray-100 hover:border-indigo-300 transition-all duration-300 text-center">
                                    <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                                        <i class="fas fa-robot text-white text-2xl"></i>
                                    </div>
                                    <h4 class="font-bold text-gray-900 mb-2 group-hover:text-indigo-700">AI診断</h4>
                                    <p class="text-sm text-gray-600 group-hover:text-indigo-600">最適な助成金を診断</p>
                                </a>

                                <a href="<?php echo home_url('/search/'); ?>" class="quick-nav-card group bg-white hover:bg-emerald-50 p-6 rounded-2xl shadow-lg hover:shadow-xl border-2 border-gray-100 hover:border-emerald-300 transition-all duration-300 text-center">
                                    <div class="w-16 h-16 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                                        <i class="fas fa-search text-white text-2xl"></i>
                                    </div>
                                    <h4 class="font-bold text-gray-900 mb-2 group-hover:text-emerald-700">詳細検索</h4>
                                    <p class="text-sm text-gray-600 group-hover:text-emerald-600">条件を絞って検索</p>
                                </a>

                                <a href="<?php echo home_url('/grants/'); ?>" class="quick-nav-card group bg-white hover:bg-orange-50 p-6 rounded-2xl shadow-lg hover:shadow-xl border-2 border-gray-100 hover:border-orange-300 transition-all duration-300 text-center">
                                    <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-red-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                                        <i class="fas fa-coins text-white text-2xl"></i>
                                    </div>
                                    <h4 class="font-bold text-gray-900 mb-2 group-hover:text-orange-700">助成金一覧</h4>
                                    <p class="text-sm text-gray-600 group-hover:text-orange-600">全ての助成金を確認</p>
                                </a>

                                <a href="<?php echo home_url('/ai/chat/'); ?>" class="quick-nav-card group bg-white hover:bg-pink-50 p-6 rounded-2xl shadow-lg hover:shadow-xl border-2 border-gray-100 hover:border-pink-300 transition-all duration-300 text-center">
                                    <div class="w-16 h-16 bg-gradient-to-r from-pink-500 to-rose-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                                        <i class="fas fa-comments text-white text-2xl"></i>
                                    </div>
                                    <h4 class="font-bold text-gray-900 mb-2 group-hover:text-pink-700">AI相談</h4>
                                    <p class="text-sm text-gray-600 group-hover:text-pink-600">24時間いつでも相談</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
/* Custom hover effects */
.sitemap-link:hover {
    transform: translateX(5px);
}

.quick-nav-card:hover {
    transform: translateY(-5px);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .container { padding-left: 1rem; padding-right: 1rem; }
    .text-4xl { font-size: 2.5rem; }
    .text-6xl { font-size: 3.5rem; }
    .grid { gap: 1rem; }
}
</style>

<?php wp_footer(); ?>
</body>
</html>

<?php get_footer(); ?>
