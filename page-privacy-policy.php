<?php
/*
Template Name: プライバシーポリシー - Tailwind CSS Play CDN対応版
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

<div class="privacy-policy-container bg-gradient-to-br from-gray-50 via-blue-50 to-indigo-50 min-h-screen">
    
    <!-- Hero Section -->
    <section class="hero-section bg-gradient-to-br from-slate-900 via-gray-900 to-zinc-900 text-white py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="absolute top-10 left-10 w-20 h-20 bg-blue-300/10 rounded-full animate-float"></div>
        <div class="absolute bottom-10 right-10 w-16 h-16 bg-purple-400/10 rounded-full animate-bounce-gentle"></div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16 animate-fade-in">
                <div class="inline-flex items-center gap-3 bg-white/10 backdrop-blur-sm rounded-full px-6 py-3 mb-6 border border-white/20">
                    <i class="fas fa-shield-alt text-blue-300 text-2xl animate-pulse"></i>
                    <span class="text-lg font-bold tracking-wider">PRIVACY POLICY</span>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black mb-6 leading-tight">
                    <span class="bg-gradient-to-r from-blue-300 to-cyan-300 bg-clip-text text-transparent">プライバシー</span><br>
                    <span class="bg-gradient-to-r from-white to-gray-200 bg-clip-text text-transparent">ポリシー</span>
                </h1>
                <p class="text-xl md:text-2xl text-gray-200 max-w-4xl mx-auto leading-relaxed">
                    当サイトは、お客様の個人情報保護の重要性を認識し、<br class="hidden md:block">
                    適切に取り扱います。
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-16 lg:py-20 -mt-16 relative z-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-5xl mx-auto">
                
                <!-- Privacy Policy Content -->
                <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 animate-slide-up overflow-hidden">
                    
                    <!-- Header -->
                    <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 p-8 lg:p-12">
                        <div class="text-center text-white">
                            <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-user-shield text-white text-3xl"></i>
                            </div>
                            <h2 class="text-2xl lg:text-3xl font-black mb-4">個人情報保護方針</h2>
                            <p class="text-blue-100 text-lg">お客様の大切な個人情報を安全に保護いたします</p>
                        </div>
                    </div>
                    
                    <!-- Content Body -->
                    <div class="p-8 lg:p-12">
                        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed space-y-12">
                            
                            <!-- Section 1 -->
                            <div class="border-l-4 border-blue-500 pl-8 relative">
                                <div class="absolute -left-3 top-0 w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">1</span>
                                </div>
                                <h3 class="text-2xl font-black text-gray-900 mb-6 flex items-center">
                                    <i class="fas fa-download text-blue-500 mr-3"></i>
                                    個人情報の取得について
                                </h3>
                                <div class="bg-blue-50 rounded-2xl p-6 border border-blue-200">
                                    <p class="mb-4">
                                        当サイトでは、お問い合わせフォームやAI診断機能を通じて、お客様の<strong class="text-blue-700">氏名、メールアドレス、事業内容</strong>などの個人情報を取得する場合があります。
                                    </p>
                                    <p>
                                        これらの情報は、<strong class="text-blue-700">サービス提供、お問い合わせへの対応、およびサービス改善</strong>のために利用されます。
                                    </p>
                                </div>
                            </div>

                            <!-- Section 2 -->
                            <div class="border-l-4 border-green-500 pl-8 relative">
                                <div class="absolute -left-3 top-0 w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">2</span>
                                </div>
                                <h3 class="text-2xl font-black text-gray-900 mb-6 flex items-center">
                                    <i class="fas fa-bullseye text-green-500 mr-3"></i>
                                    個人情報の利用目的
                                </h3>
                                <p class="mb-6">取得した個人情報は、以下の目的のために利用いたします。</p>
                                <div class="grid md:grid-cols-2 gap-4">
                                    <div class="bg-white border-2 border-green-200 rounded-2xl p-6 hover:shadow-lg transition-all duration-300">
                                        <div class="flex items-center gap-3 mb-3">
                                            <i class="fas fa-reply text-green-500 text-xl"></i>
                                            <span class="font-bold text-gray-900">お問い合わせ対応</span>
                                        </div>
                                        <p class="text-gray-600 text-sm">回答および資料送付</p>
                                    </div>
                                    <div class="bg-white border-2 border-green-200 rounded-2xl p-6 hover:shadow-lg transition-all duration-300">
                                        <div class="flex items-center gap-3 mb-3">
                                            <i class="fas fa-robot text-green-500 text-xl"></i>
                                            <span class="font-bold text-gray-900">AI診断サービス</span>
                                        </div>
                                        <p class="text-gray-600 text-sm">結果提供と関連情報案内</p>
                                    </div>
                                    <div class="bg-white border-2 border-green-200 rounded-2xl p-6 hover:shadow-lg transition-all duration-300">
                                        <div class="flex items-center gap-3 mb-3">
                                            <i class="fas fa-cogs text-green-500 text-xl"></i>
                                            <span class="font-bold text-gray-900">サービス改善</span>
                                        </div>
                                        <p class="text-gray-600 text-sm">新サービスの開発</p>
                                    </div>
                                    <div class="bg-white border-2 border-green-200 rounded-2xl p-6 hover:shadow-lg transition-all duration-300">
                                        <div class="flex items-center gap-3 mb-3">
                                            <i class="fas fa-chart-bar text-green-500 text-xl"></i>
                                            <span class="font-bold text-gray-900">統計データ作成</span>
                                        </div>
                                        <p class="text-gray-600 text-sm">個人特定不可形式での分析</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Section 3 -->
                            <div class="border-l-4 border-red-500 pl-8 relative">
                                <div class="absolute -left-3 top-0 w-6 h-6 bg-red-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">3</span>
                                </div>
                                <h3 class="text-2xl font-black text-gray-900 mb-6 flex items-center">
                                    <i class="fas fa-user-slash text-red-500 mr-3"></i>
                                    個人情報の第三者提供について
                                </h3>
                                <div class="bg-red-50 rounded-2xl p-6 border border-red-200">
                                    <p class="text-lg">
                                        当サイトは、<strong class="text-red-700">法令に基づく場合を除き、お客様の同意なく個人情報を第三者に提供することはありません。</strong>
                                    </p>
                                </div>
                            </div>

                            <!-- Section 4 -->
                            <div class="border-l-4 border-purple-500 pl-8 relative">
                                <div class="absolute -left-3 top-0 w-6 h-6 bg-purple-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">4</span>
                                </div>
                                <h3 class="text-2xl font-black text-gray-900 mb-6 flex items-center">
                                    <i class="fas fa-lock text-purple-500 mr-3"></i>
                                    個人情報の安全管理
                                </h3>
                                <div class="bg-purple-50 rounded-2xl p-6 border border-purple-200">
                                    <p>
                                        お客様からお預かりした個人情報は、<strong class="text-purple-700">不正アクセス、紛失、破壊、改ざん、漏洩などを防止するため、厳重なセキュリティ対策</strong>を講じ、適切に管理いたします。
                                    </p>
                                </div>
                            </div>

                            <!-- Section 5 -->
                            <div class="border-l-4 border-yellow-500 pl-8 relative">
                                <div class="absolute -left-3 top-0 w-6 h-6 bg-yellow-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">5</span>
                                </div>
                                <h3 class="text-2xl font-black text-gray-900 mb-6 flex items-center">
                                    <i class="fas fa-cookie-bite text-yellow-500 mr-3"></i>
                                    クッキー（Cookie）について
                                </h3>
                                <div class="space-y-4">
                                    <p>
                                        当サイトでは、サイトの利便性向上やアクセス解析のためにクッキーを使用しています。
                                        クッキーにより個人を特定することはありません。
                                    </p>
                                    <div class="bg-yellow-50 rounded-2xl p-6 border border-yellow-200">
                                        <p class="text-yellow-800">
                                            <i class="fas fa-info-circle mr-2"></i>
                                            ブラウザの設定によりクッキーの利用を拒否することも可能ですが、その場合、一部サービスが利用できなくなる場合があります。
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Section 6 -->
                            <div class="border-l-4 border-indigo-500 pl-8 relative">
                                <div class="absolute -left-3 top-0 w-6 h-6 bg-indigo-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">6</span>
                                </div>
                                <h3 class="text-2xl font-black text-gray-900 mb-6 flex items-center">
                                    <i class="fas fa-chart-line text-indigo-500 mr-3"></i>
                                    アクセス解析ツールについて
                                </h3>
                                <div class="bg-indigo-50 rounded-2xl p-6 border border-indigo-200">
                                    <p class="mb-4">
                                        当サイトでは、<strong class="text-indigo-700">Google Analytics</strong>などのアクセス解析ツールを利用しています。
                                    </p>
                                    <p>
                                        これらのツールは、トラフィックデータの収集のためにクッキーを使用しますが、<strong class="text-indigo-700">匿名で収集されており、個人を特定するものではありません。</strong>
                                    </p>
                                </div>
                            </div>

                            <!-- Section 7 -->
                            <div class="border-l-4 border-orange-500 pl-8 relative">
                                <div class="absolute -left-3 top-0 w-6 h-6 bg-orange-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">7</span>
                                </div>
                                <h3 class="text-2xl font-black text-gray-900 mb-6 flex items-center">
                                    <i class="fas fa-exclamation-triangle text-orange-500 mr-3"></i>
                                    免責事項
                                </h3>
                                <div class="bg-orange-50 rounded-2xl p-6 border border-orange-200">
                                    <p>
                                        当サイトからリンクされている他のウェブサイトにおける個人情報の保護については、<strong class="text-orange-700">一切の責任を負いません。</strong><br>
                                        リンク先のプライバシーポリシーをご確認ください。
                                    </p>
                                </div>
                            </div>

                            <!-- Section 8 -->
                            <div class="border-l-4 border-teal-500 pl-8 relative">
                                <div class="absolute -left-3 top-0 w-6 h-6 bg-teal-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">8</span>
                                </div>
                                <h3 class="text-2xl font-black text-gray-900 mb-6 flex items-center">
                                    <i class="fas fa-edit text-teal-500 mr-3"></i>
                                    プライバシーポリシーの変更
                                </h3>
                                <div class="bg-teal-50 rounded-2xl p-6 border border-teal-200">
                                    <p>
                                        当サイトは、必要に応じて本プライバシーポリシーを改定することがあります。<br>
                                        <strong class="text-teal-700">改定されたプライバシーポリシーは、当サイトに掲載された時点から効力を生じる</strong>ものとします。
                                    </p>
                                </div>
                            </div>

                            <!-- Section 9 -->
                            <div class="border-l-4 border-pink-500 pl-8 relative">
                                <div class="absolute -left-3 top-0 w-6 h-6 bg-pink-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">9</span>
                                </div>
                                <h3 class="text-2xl font-black text-gray-900 mb-6 flex items-center">
                                    <i class="fas fa-envelope text-pink-500 mr-3"></i>
                                    お問い合わせ
                                </h3>
                                <div class="bg-gradient-to-r from-pink-50 to-purple-50 rounded-2xl p-6 border border-pink-200">
                                    <p class="mb-4">
                                        当サイトの個人情報の取り扱いに関するお問い合わせは、下記よりご連絡ください。
                                    </p>
                                    <a href="<?php echo home_url("/contact/"); ?>" class="inline-flex items-center gap-3 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 transform hover:-translate-y-1">
                                        <i class="fas fa-paper-plane"></i>
                                        お問い合わせフォーム
                                    </a>
                                </div>
                            </div>

                            <!-- Footer Info -->
                            <div class="bg-gradient-to-r from-gray-100 to-gray-200 rounded-2xl p-8 text-center border border-gray-300">
                                <div class="space-y-2 text-gray-700">
                                    <p class="font-semibold text-lg">制定・改定日</p>
                                    <div class="flex flex-col sm:flex-row justify-center gap-4 text-sm">
                                        <div class="flex items-center justify-center gap-2">
                                            <i class="fas fa-calendar-plus text-blue-500"></i>
                                            <span><strong>制定日:</strong> 2023年10月26日</span>
                                        </div>
                                        <div class="flex items-center justify-center gap-2">
                                            <i class="fas fa-calendar-check text-green-500"></i>
                                            <span><strong>最終改定日:</strong> 2025年8月22日</span>
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
</div>

<style>
/* Custom Styles */
.prose h3 { margin-top: 0; }
.prose p { margin-bottom: 1rem; }
.prose ul { margin: 1rem 0; }
.prose li { margin-bottom: 0.5rem; }

/* Responsive adjustments */
@media (max-width: 768px) {
    .container { padding-left: 1rem; padding-right: 1rem; }
    .text-4xl { font-size: 2.5rem; }
    .text-6xl { font-size: 3.5rem; }
}
</style>

<?php wp_footer(); ?>
</body>
</html>

<?php get_footer(); ?>
