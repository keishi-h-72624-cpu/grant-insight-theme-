<?php
/*
Template Name: 当サイトについて（Tailwind CSS Play CDN対応版）
*/

get_header(); ?>

<!-- Tailwind CSS Play CDNの読み込み（ページのhead部分に配置） -->
<?php if (!wp_script_is('tailwind-cdn', 'enqueued')): ?>
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                animation: {
                    'fade-in': 'fadeIn 0.8s ease-in-out',
                    'fade-in-up': 'fadeInUp 0.6s ease-out',
                    'slide-in-left': 'slideInLeft 0.6s ease-out',
                    'slide-in-right': 'slideInRight 0.6s ease-out',
                    'scale-in': 'scaleIn 0.5s ease-out',
                    'bounce-gentle': 'bounceGentle 2s ease-in-out infinite',
                    'pulse-gentle': 'pulseGentle 2s ease-in-out infinite',
                    'float': 'float 4s ease-in-out infinite',
                    'shimmer': 'shimmer 2s linear infinite'
                },
                keyframes: {
                    fadeIn: {
                        '0%': { opacity: '0' },
                        '100%': { opacity: '1' }
                    },
                    fadeInUp: {
                        '0%': {
                            opacity: '0',
                            transform: 'translateY(30px)'
                        },
                        '100%': {
                            opacity: '1',
                            transform: 'translateY(0)'
                        }
                    },
                    slideInLeft: {
                        '0%': {
                            opacity: '0',
                            transform: 'translateX(-50px)'
                        },
                        '100%': {
                            opacity: '1',
                            transform: 'translateX(0)'
                        }
                    },
                    slideInRight: {
                        '0%': {
                            opacity: '0',
                            transform: 'translateX(50px)'
                        },
                        '100%': {
                            opacity: '1',
                            transform: 'translateX(0)'
                        }
                    },
                    scaleIn: {
                        '0%': {
                            opacity: '0',
                            transform: 'scale(0.8)'
                        },
                        '100%': {
                            opacity: '1',
                            transform: 'scale(1)'
                        }
                    },
                    bounceGentle: {
                        '0%, 100%': {
                            transform: 'translateY(0)',
                            animationTimingFunction: 'cubic-bezier(0.8, 0, 1, 1)'
                        },
                        '50%': {
                            transform: 'translateY(-8px)',
                            animationTimingFunction: 'cubic-bezier(0, 0, 0.2, 1)'
                        }
                    },
                    pulseGentle: {
                        '0%, 100%': {
                            transform: 'scale(1)',
                            opacity: '1'
                        },
                        '50%': {
                            transform: 'scale(1.05)',
                            opacity: '0.9'
                        }
                    },
                    float: {
                        '0%, 100%': {
                            transform: 'translateY(0px)'
                        },
                        '50%': {
                            transform: 'translateY(-15px)'
                        }
                    },
                    shimmer: {
                        '0%': {
                            backgroundPosition: '-200px 0'
                        },
                        '100%': {
                            backgroundPosition: '200px 0'
                        }
                    }
                },
                backgroundImage: {
                    'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
                    'mesh-gradient': 'radial-gradient(at 40% 20%, hsla(28,100%,74%,1) 0px, transparent 50%), radial-gradient(at 80% 0%, hsla(189,100%,56%,1) 0px, transparent 50%), radial-gradient(at 0% 50%, hsla(355,100%,93%,1) 0px, transparent 50%)'
                }
            }
        }
    }
</script>
<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<?php endif; ?>

<div class="about-page-container min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50">
    <!-- ヒーローセクション -->
    <section class="hero-section relative bg-gradient-to-br from-blue-600 via-indigo-700 to-purple-800 text-white py-20 overflow-hidden">
        <!-- 背景エフェクト -->
        <div class="absolute inset-0 opacity-20">
            <div class="absolute w-96 h-96 bg-white rounded-full -top-48 -left-48 animate-float"></div>
            <div class="absolute w-80 h-80 bg-blue-300 rounded-full -bottom-40 -right-40 animate-pulse-gentle" style="animation-delay: 1s;"></div>
            <div class="absolute w-64 h-64 bg-purple-300 rounded-full top-1/2 left-1/4 animate-float" style="animation-delay: 2s;"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <!-- パンくずリスト -->
            <nav class="mb-8 animate-fade-in-up" aria-label="パンくず">
                <ol class="flex items-center space-x-2 text-sm text-blue-100">
                    <li><a href="<?php echo home_url(); ?>" class="hover:text-white transition-colors">ホーム</a></li>
                    <li><i class="fas fa-chevron-right text-xs"></i></li>
                    <li class="text-white font-medium">当サイトについて</li>
                </ol>
            </nav>

            <!-- ページヘッダー -->
            <div class="page-header text-center animate-fade-in-up" style="animation-delay: 0.2s;">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl mb-6">
                    <i class="fas fa-info-circle text-3xl text-white animate-bounce-gentle"></i>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                    <span class="bg-gradient-to-r from-yellow-300 via-orange-300 to-red-300 bg-clip-text text-transparent">
                        当サイトについて
                    </span>
                </h1>
                <p class="text-lg md:text-xl text-blue-100 max-w-4xl mx-auto leading-relaxed">
                    助成金インサイトは、事業者の皆様が最適な助成金を見つけ、成功に導くための<br>
                    <span class="text-yellow-300 font-semibold">総合情報プラットフォーム</span>です。
                </p>
            </div>
        </div>
    </section>

    <div class="container mx-auto px-4 py-16">
        <!-- ミッション・ビジョンセクション -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-20">
            <!-- ミッション -->
            <div class="mission-section animate-slide-in-left">
                <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 h-full">
                    <div class="text-center mb-8">
                        <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                            <i class="fas fa-bullseye text-3xl text-white animate-pulse-gentle"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-4">
                            <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                                私たちのミッション
                            </span>
                        </h2>
                    </div>
                    <div class="space-y-4 text-gray-700 leading-relaxed">
                        <p>
                            日本には<strong class="text-blue-600">数多くの助成金制度</strong>がありますが、情報が分散しており、事業者が最適な制度を見つけることは困難です。
                        </p>
                        <p>
                            私たちは、<strong class="text-indigo-600">AI技術と専門家の知見</strong>を組み合わせ、誰もが簡単に最適な助成金を見つけられる環境を提供します。
                        </p>
                        <div class="bg-blue-50 rounded-xl p-4 mt-6">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>
                                <span class="font-semibold text-blue-900">私たちの約束</span>
                            </div>
                            <p class="text-blue-800 text-sm">
                                複雑な助成金情報をシンプルに、誰でも理解できる形でお届けします。
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ビジョン -->
            <div class="vision-section animate-slide-in-right" style="animation-delay: 0.2s;">
                <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 h-full">
                    <div class="text-center mb-8">
                        <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                            <i class="fas fa-eye text-3xl text-white animate-pulse-gentle"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-4">
                            <span class="bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">
                                私たちのビジョン
                            </span>
                        </h2>
                    </div>
                    <div class="space-y-4 text-gray-700 leading-relaxed">
                        <p>
                            <strong class="text-green-600">すべての事業者</strong>が助成金を活用して事業成長を実現できる社会を目指します。
                        </p>
                        <p>
                            情報格差をなくし、<strong class="text-emerald-600">中小企業からスタートアップ</strong>まで、あらゆる規模の事業者が平等に支援を受けられる環境を構築します。
                        </p>
                        <div class="bg-green-50 rounded-xl p-4 mt-6">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-rocket text-orange-500 mr-2"></i>
                                <span class="font-semibold text-green-900">目指す未来</span>
                            </div>
                            <p class="text-green-800 text-sm">
                                助成金を通じて日本の事業者の成長と革新をサポートし続けます。
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- サービス特徴セクション -->
        <section class="features-section mb-20">
            <div class="text-center mb-16 animate-fade-in-up">
                <h2 class="text-4xl font-bold text-gray-900 mb-6">
                    サービスの<span class="bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">特徴</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    最新技術と専門知識を組み合わせた、革新的な助成金情報サービス
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- 特徴1: AI診断システム -->
                <div class="feature-card bg-white rounded-2xl shadow-xl p-8 text-center hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 0.1s;">
                    <div class="relative mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto shadow-lg">
                            <i class="fas fa-brain text-3xl text-white animate-bounce-gentle"></i>
                        </div>
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center">
                            <i class="fas fa-star text-white text-sm"></i>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">AI診断システム</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        最新のAI技術を活用し、あなたの事業に最適な助成金を<strong class="text-blue-600">瞬時に診断</strong>します。
                    </p>
                    <div class="bg-blue-50 rounded-xl p-4">
                        <div class="flex items-center justify-center mb-2">
                            <i class="fas fa-chart-line text-blue-600 mr-2"></i>
                            <span class="text-blue-900 font-semibold text-sm">診断精度</span>
                        </div>
                        <div class="text-2xl font-bold text-blue-600">95%</div>
                    </div>
                </div>

                <!-- 特徴2: 実践的ノウハウ -->
                <div class="feature-card bg-white rounded-2xl shadow-xl p-8 text-center hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 0.2s;">
                    <div class="relative mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto shadow-lg">
                            <i class="fas fa-lightbulb text-3xl text-white animate-bounce-gentle"></i>
                        </div>
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-orange-400 rounded-full flex items-center justify-center">
                            <i class="fas fa-fire text-white text-sm"></i>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">実践的ノウハウ</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        助成金申請を成功に導くための<strong class="text-green-600">実践的なノウハウ</strong>やコツを専門家が提供します。
                    </p>
                    <div class="bg-green-50 rounded-xl p-4">
                        <div class="flex items-center justify-center mb-2">
                            <i class="fas fa-trophy text-green-600 mr-2"></i>
                            <span class="text-green-900 font-semibold text-sm">成功率</span>
                        </div>
                        <div class="text-2xl font-bold text-green-600">85%</div>
                    </div>
                </div>

                <!-- 特徴3: 成功事例共有 -->
                <div class="feature-card bg-white rounded-2xl shadow-xl p-8 text-center hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 0.3s;">
                    <div class="relative mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center mx-auto shadow-lg">
                            <i class="fas fa-chart-line text-3xl text-white animate-bounce-gentle"></i>
                        </div>
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-green-400 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-white text-sm"></i>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">成功事例共有</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        実際の<strong class="text-purple-600">成功事例</strong>を通じて、効果的な申請方法を学ぶことができます。
                    </p>
                    <div class="bg-purple-50 rounded-xl p-4">
                        <div class="flex items-center justify-center mb-2">
                            <i class="fas fa-users text-purple-600 mr-2"></i>
                            <span class="text-purple-900 font-semibold text-sm">事例数</span>
                        </div>
                        <div class="text-2xl font-bold text-purple-600">500+</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 運営方針セクション -->
        <section class="policy-section mb-20">
            <div class="bg-gradient-to-br from-gray-50 to-blue-50 rounded-3xl p-8 md:p-12 border border-gray-100">
                <div class="text-center mb-12 animate-fade-in-up">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">
                        <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                            運営方針
                        </span>
                    </h2>
                    <p class="text-xl text-gray-600">
                        信頼性とユーザー第一主義を基本とした運営を心がけています
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- 方針1: 信頼性の確保 -->
                    <div class="policy-item bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 animate-slide-in-left">
                        <div class="flex items-start mb-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="fas fa-shield-alt text-blue-600 text-xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">信頼性の確保</h3>
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            掲載する助成金情報は、<strong class="text-blue-600">公式サイトから直接取得</strong>し、定期的に更新しています。
                            正確で最新の情報をお届けします。
                        </p>
                        <div class="mt-4 flex items-center text-sm text-blue-600">
                            <i class="fas fa-clock mr-2"></i>
                            <span>毎日自動更新</span>
                        </div>
                    </div>

                    <!-- 方針2: プライバシー保護 -->
                    <div class="policy-item bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 animate-slide-in-right" style="animation-delay: 0.1s;">
                        <div class="flex items-start mb-4">
                            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="fas fa-user-shield text-green-600 text-xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">プライバシー保護</h3>
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            ユーザーの個人情報は<strong class="text-green-600">厳重に管理</strong>し、第三者への提供は行いません。
                            SSL暗号化通信により、安全な情報交換を保証します。
                        </p>
                        <div class="mt-4 flex items-center text-sm text-green-600">
                            <i class="fas fa-lock mr-2"></i>
                            <span>SSL 256bit暗号化</span>
                        </div>
                    </div>

                    <!-- 方針3: 中立性の維持 -->
                    <div class="policy-item bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 animate-slide-in-left" style="animation-delay: 0.2s;">
                        <div class="flex items-start mb-4">
                            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="fas fa-balance-scale text-purple-600 text-xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">中立性の維持</h3>
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            特定の企業や団体に偏らない、<strong class="text-purple-600">公正で中立的な情報提供</strong>を心がけています。
                            ユーザーの利益を最優先に考えたサービス運営を行います。
                        </p>
                        <div class="mt-4 flex items-center text-sm text-purple-600">
                            <i class="fas fa-handshake mr-2"></i>
                            <span>公正な情報提供</span>
                        </div>
                    </div>

                    <!-- 方針4: 継続的改善 -->
                    <div class="policy-item bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 animate-slide-in-right" style="animation-delay: 0.3s;">
                        <div class="flex items-start mb-4">
                            <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="fas fa-sync-alt text-orange-600 text-xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">継続的改善</h3>
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            ユーザーフィードバックを積極的に収集し、<strong class="text-orange-600">サービスの継続的な改善</strong>に努めています。
                            新しい技術や制度変更にも迅速に対応します。
                        </p>
                        <div class="mt-4 flex items-center text-sm text-orange-600">
                            <i class="fas fa-chart-line mr-2"></i>
                            <span>毎月機能追加</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 免責事項セクション -->
        <section class="disclaimer-section mb-20">
            <div class="bg-gradient-to-r from-yellow-50 to-orange-50 border border-yellow-200 rounded-2xl p-8 animate-fade-in-up">
                <div class="flex items-start mb-6">
                    <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-yellow-600 text-xl animate-bounce-gentle"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">免責事項</h2>
                </div>
                
                <div class="text-gray-700 space-y-4 leading-relaxed">
                    <div class="bg-white rounded-xl p-4 border-l-4 border-yellow-400">
                        <h3 class="font-semibold text-gray-900 mb-2">情報の正確性について</h3>
                        <p>
                            当サイトに掲載されている情報は、作成時点での情報に基づいており、最新の情報と異なる場合があります。
                            助成金の申請前には、<strong class="text-orange-600">必ず公式サイトで最新情報をご確認</strong>ください。
                        </p>
                    </div>
                    
                    <div class="bg-white rounded-xl p-4 border-l-4 border-red-400">
                        <h3 class="font-semibold text-gray-900 mb-2">利用者責任について</h3>
                        <p>
                            当サイトの情報を利用した結果生じた損害について、運営者は一切の責任を負いません。
                            <strong class="text-red-600">助成金の申請は自己責任</strong>で行ってください。
                        </p>
                    </div>
                    
                    <div class="bg-white rounded-xl p-4 border-l-4 border-blue-400">
                        <h3 class="font-semibold text-gray-900 mb-2">アフィリエイトについて</h3>
                        <p>
                            当サイトはアフィリエイトプログラムに参加しており、紹介した商品やサービスの購入により、
                            運営者が報酬を受け取る場合があります。ただし、<strong class="text-blue-600">これが情報の公正性に影響することはありません</strong>。
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- お問い合わせCTAセクション -->
        <section class="contact-cta text-center animate-fade-in-up" style="animation-delay: 0.4s;">
            <div class="relative bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-700 text-white rounded-3xl p-8 md:p-12 shadow-2xl overflow-hidden">
                <!-- 背景エフェクト -->
                <div class="absolute inset-0 opacity-20">
                    <div class="absolute w-64 h-64 bg-white rounded-full -top-32 -left-32 animate-float"></div>
                    <div class="absolute w-48 h-48 bg-yellow-300 rounded-full -bottom-24 -right-24 animate-pulse-gentle"></div>
                </div>
                
                <div class="relative z-10">
                    <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-envelope text-3xl text-white animate-bounce-gentle"></i>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">
                        ご質問・ご相談は<br class="md:hidden">
                        <span class="text-yellow-300">お気軽に</span>
                    </h2>
                    <p class="text-xl mb-8 opacity-90 max-w-2xl mx-auto">
                        助成金に関するご質問や、サイトに関するお問い合わせを<br>
                        <span class="text-yellow-300 font-semibold">24時間受付中</span>です。
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="<?php echo home_url('/contact/'); ?>" 
                           class="inline-flex items-center justify-center px-8 py-4 bg-white text-blue-600 font-bold text-lg rounded-2xl hover:bg-gray-100 transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 shadow-lg group">
                            <i class="fas fa-envelope mr-3 group-hover:animate-bounce-gentle"></i>
                            お問い合わせ
                        </a>
                        <a href="<?php echo home_url('/ai-diagnosis/'); ?>" 
                           class="inline-flex items-center justify-center px-8 py-4 bg-transparent border-2 border-white text-white font-bold text-lg rounded-2xl hover:bg-white hover:text-blue-600 transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 group">
                            <i class="fas fa-brain mr-3 group-hover:animate-bounce-gentle"></i>
                            AI診断を試す
                        </a>
                    </div>

                    <!-- 追加情報 -->
                    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 border border-white/20">
                            <i class="fas fa-clock text-2xl mb-2 text-yellow-300"></i>
                            <div class="font-semibold">迅速対応</div>
                            <div class="text-sm opacity-90">24時間以内に返信</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 border border-white/20">
                            <i class="fas fa-user-tie text-2xl mb-2 text-yellow-300"></i>
                            <div class="font-semibold">専門家対応</div>
                            <div class="text-sm opacity-90">助成金のプロが回答</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 border border-white/20">
                            <i class="fas fa-gift text-2xl mb-2 text-yellow-300"></i>
                            <div class="font-semibold">完全無料</div>
                            <div class="text-sm opacity-90">相談料は一切不要</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // アニメーション遅延の設定
    const animatedElements = document.querySelectorAll('[class*="animate-"]');
    animatedElements.forEach((el, index) => {
        if (!el.style.animationDelay && el.classList.contains('animate-fade-in-up')) {
            el.style.animationDelay = `${index * 0.1}s`;
        }
    });

    // Intersection Observer でスクロールアニメーション
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
                entry.target.classList.add('animate-fade-in');
            }
        });
    }, observerOptions);
    
    // 要素を監視対象に追加
    document.querySelectorAll('.feature-card, .policy-item, .mission-section, .vision-section').forEach(el => {
        el.style.animationFillMode = 'both';
        el.style.animationPlayState = 'paused';
        observer.observe(el);
    });

    // カードのホバー効果強化
    const cards = document.querySelectorAll('.feature-card, .policy-item');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // スムーズスクロール
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

    // 統計数値のカウントアップ効果
    function countUp(element, target, duration = 2000) {
        let start = 0;
        const increment = target / (duration / 16);
        
        function updateCount() {
            start += increment;
            if (start < target) {
                element.textContent = Math.floor(start) + (target.toString().includes('%') ? '%' : '+');
                requestAnimationFrame(updateCount);
            } else {
                element.textContent = target + (target.toString().includes('%') ? '%' : target.toString().includes('+') ? '+' : '');
            }
        }
        updateCount();
    }

    // 統計表示のトリガー
    const statsObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const statElement = entry.target;
                const targetText = statElement.textContent;
                const targetNumber = parseInt(targetText.replace(/[^\d]/g, ''));
                
                if (targetNumber) {
                    countUp(statElement, targetNumber);
                }
                statsObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('.text-2xl.font-bold').forEach(el => {
        if (el.textContent.match(/\d+/)) {
            statsObserver.observe(el);
        }
    });
});
</script>

<?php get_footer(); ?>
