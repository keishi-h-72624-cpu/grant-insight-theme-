<?php
/**
 * The template for displaying the footer
 * フッターファイル（ゴージャス版 - ロゴ統合・AIアシスタント対応）
 */

// 必要なヘルパー関数を定義
if (!function_exists('gi_get_sns_urls')) {
    function gi_get_sns_urls() {
        return [
            'twitter' => get_theme_mod('sns_twitter_url', ''),
            'facebook' => get_theme_mod('sns_facebook_url', ''),
            'linkedin' => get_theme_mod('sns_linkedin_url', ''),
            'instagram' => get_theme_mod('sns_instagram_url', ''),
            'youtube' => get_theme_mod('sns_youtube_url', '')
        ];
    }
}

if (!function_exists('gi_get_option')) {
    function gi_get_option($option_name, $default = '') {
        return get_theme_mod($option_name, $default);
    }
}
?>

<!-- Tailwind CSS Play CDNの読み込み（ページのhead部分に配置） -->
<?php if (!wp_script_is('tailwind-cdn', 'enqueued')): ?>
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                animation: {
                    'pulse': 'pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    'blob': 'blob 7s infinite',
                    'fade-in-up': 'fadeInUp 0.6s ease-out',
                    'bounce-gentle': 'bounceGentle 2s ease-in-out infinite',
                    'float': 'float 6s ease-in-out infinite',
                    'glow-pulse': 'glowPulse 3s ease-in-out infinite'
                },
                keyframes: {
                    blob: {
                        '0%': {
                            transform: 'translate(0px, 0px) scale(1)'
                        },
                        '33%': {
                            transform: 'translate(30px, -50px) scale(1.1)'
                        },
                        '66%': {
                            transform: 'translate(-20px, 20px) scale(0.9)'
                        },
                        '100%': {
                            transform: 'translate(0px, 0px) scale(1)'
                        }
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
                    bounceGentle: {
                        '0%, 100%': {
                            transform: 'translateY(-5%)',
                            animationTimingFunction: 'cubic-bezier(0.8, 0, 1, 1)'
                        },
                        '50%': {
                            transform: 'translateY(0)',
                            animationTimingFunction: 'cubic-bezier(0, 0, 0.2, 1)'
                        }
                    },
                    float: {
                        '0%, 100%': {
                            transform: 'translateY(0px)'
                        },
                        '50%': {
                            transform: 'translateY(-10px)'
                        }
                    },
                    glowPulse: {
                        '0%, 100%': {
                            opacity: '0.5'
                        },
                        '50%': {
                            opacity: '1'
                        }
                    }
                },
                backgroundImage: {
                    'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
                }
            }
        }
    }
</script>
<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<?php endif; ?>

    </main>

    <!-- ゴージャスフッター -->
    <footer class="site-footer relative overflow-hidden">
        <!-- 背景グラデーション -->
        <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900"></div>
        
        <!-- 装飾的な背景アニメーション -->
        <div class="absolute inset-0 opacity-20">
            <div class="absolute w-96 h-96 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full -bottom-48 -left-48 mix-blend-multiply filter blur-3xl opacity-70 animate-blob"></div>
            <div class="absolute w-80 h-80 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full -bottom-32 -right-32 mix-blend-multiply filter blur-3xl opacity-70 animate-blob" style="animation-delay: 2s;"></div>
            <div class="absolute w-72 h-72 bg-gradient-to-r from-indigo-500 to-blue-500 rounded-full -top-36 left-1/3 mix-blend-multiply filter blur-3xl opacity-70 animate-blob" style="animation-delay: 4s;"></div>
            <div class="absolute w-64 h-64 bg-gradient-to-r from-orange-400 to-yellow-400 rounded-full top-1/2 right-1/4 mix-blend-multiply filter blur-3xl opacity-50 animate-float" style="animation-delay: 1s;"></div>
        </div>

        <!-- パーティクル効果 -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-1/4 left-1/4 w-2 h-2 bg-yellow-400 rounded-full animate-bounce-gentle opacity-60"></div>
            <div class="absolute top-1/2 left-3/4 w-1 h-1 bg-blue-400 rounded-full animate-bounce-gentle opacity-80" style="animation-delay: 0.5s;"></div>
            <div class="absolute bottom-1/3 left-1/2 w-1.5 h-1.5 bg-purple-400 rounded-full animate-bounce-gentle opacity-70" style="animation-delay: 1s;"></div>
            <div class="absolute top-3/4 right-1/3 w-1 h-1 bg-pink-400 rounded-full animate-bounce-gentle opacity-60" style="animation-delay: 1.5s;"></div>
        </div>

        <div class="relative z-10 py-20">
            <div class="container mx-auto px-4">
                <!-- フッター上部 -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-12 mb-16">
                    <!-- サイト情報（ロゴ統合版） -->
                    <div class="lg:col-span-2 animate-fade-in-up">
                        <div class="mb-8">
                            <!-- ロゴとサイト名の組み合わせ -->
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center space-x-4 group mb-6">
                                <!-- フッター用ロゴ -->
                                <div class="logo-container relative">
                                    <div class="logo-main relative z-10">
                                        <img src="http://joseikin-insight.com/wp-content/uploads/2025/09/1757335941511.png" 
                                             alt="助成金・補助金インサイト" 
                                             class="h-12 md:h-14 w-auto drop-shadow-xl group-hover:drop-shadow-2xl transition-all duration-500 group-hover:scale-110 filter brightness-110">
                                    </div>
                                    <!-- ロゴのグロー効果 -->
                                    <div class="absolute inset-0 rounded-full bg-gradient-to-r from-yellow-400/40 via-orange-400/40 to-red-400/40 blur-xl scale-150 opacity-0 group-hover:opacity-100 transition-all duration-700 animate-glow-pulse"></div>
                                </div>
                                
                                <!-- サイト名 -->
                                <div>
                                    <h2 class="text-2xl md:text-3xl font-black bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 bg-clip-text text-transparent group-hover:from-blue-300 group-hover:via-purple-300 group-hover:to-pink-300 transition-all duration-500 leading-tight">
                                        助成金・補助金
                                    </h2>
                                    <div class="flex items-center space-x-2 mt-1">
                                        <span class="text-xl md:text-2xl font-bold text-gray-300 group-hover:text-white transition-colors duration-300">インサイト</span>
                                        <div class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white text-xs font-bold px-2 py-1 rounded-full shadow-lg animate-bounce-gentle">
                                            AI
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <!-- サイト説明 -->
                        <p class="text-gray-300 leading-relaxed mb-8 text-lg">
                            <i class="fas fa-sparkles mr-2 text-yellow-400"></i>
                            AIを活用した次世代の補助金・助成金プラットフォーム。<br>
                            あなたの事業に最適な情報を瞬時に発見し、成長を加速させます。
                        </p>
                        
                        <!-- SNSリンク -->
                        <div class="flex space-x-4">
                            <?php
                            $sns_urls = gi_get_sns_urls();
                            $sns_icons = [
                                'twitter' => ['icon' => 'fab fa-twitter', 'color' => 'hover:text-blue-400'],
                                'facebook' => ['icon' => 'fab fa-facebook-f', 'color' => 'hover:text-blue-500'], 
                                'linkedin' => ['icon' => 'fab fa-linkedin-in', 'color' => 'hover:text-blue-600'],
                                'instagram' => ['icon' => 'fab fa-instagram', 'color' => 'hover:text-pink-400'],
                                'youtube' => ['icon' => 'fab fa-youtube', 'color' => 'hover:text-red-500']
                            ];
                            ?>
                            <?php foreach ($sns_urls as $platform => $url): ?>
                                <?php if (!empty($url)): ?>
                                    <a href="<?php echo esc_url($url); ?>" 
                                       target="_blank" 
                                       rel="noopener noreferrer" 
                                       class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center text-gray-400 <?php echo $sns_icons[$platform]['color']; ?> transition-all duration-300 transform hover:scale-110 hover:-translate-y-1 hover:bg-white/20 hover:shadow-lg group">
                                        <i class="<?php echo $sns_icons[$platform]['icon']; ?> text-lg group-hover:animate-bounce-gentle"></i>
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        
                        <!-- 特徴バッジ -->
                        <div class="flex flex-wrap gap-3 mt-8">
                            <span class="bg-gradient-to-r from-green-500/20 to-emerald-500/20 text-green-300 px-4 py-2 rounded-full text-sm font-medium backdrop-blur-sm border border-green-500/30 hover:scale-105 transition-transform duration-200">
                                <i class="fas fa-check-circle mr-2"></i>無料診断
                            </span>
                            <span class="bg-gradient-to-r from-blue-500/20 to-indigo-500/20 text-blue-300 px-4 py-2 rounded-full text-sm font-medium backdrop-blur-sm border border-blue-500/30 hover:scale-105 transition-transform duration-200">
                                <i class="fas fa-robot mr-2"></i>AI支援
                            </span>
                            <span class="bg-gradient-to-r from-purple-500/20 to-pink-500/20 text-purple-300 px-4 py-2 rounded-full text-sm font-medium backdrop-blur-sm border border-purple-500/30 hover:scale-105 transition-transform duration-200">
                                <i class="fas fa-users mr-2"></i>専門家サポート
                            </span>
                        </div>
                    </div>
                    
                    <!-- 補助金を探す -->
                    <div class="animate-fade-in-up" style="animation-delay: 0.1s;">
                        <h4 class="font-bold text-white mb-6 flex items-center text-lg relative">
                            <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center mr-3 shadow-lg">
                                <i class="fas fa-search text-white text-sm"></i>
                            </div>
                            補助金を探す
                            <div class="absolute -top-1 -right-1 w-2 h-2 bg-yellow-400 rounded-full animate-bounce-gentle"></div>
                        </h4>
                        <ul class="space-y-4 text-gray-300">
                            <li>
                                <a href="<?php echo esc_url(home_url('/grants/')); ?>" 
                                   class="flex items-center group hover:text-white transition-all duration-200 hover:translate-x-2 transform">
                                    <i class="fas fa-chevron-right mr-3 text-indigo-400 group-hover:text-indigo-300 transition-colors text-xs"></i>
                                    <span class="group-hover:text-indigo-300">助成金一覧</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo esc_url(home_url('/grants/?category=it')); ?>" 
                                   class="flex items-center group hover:text-white transition-all duration-200 hover:translate-x-2 transform">
                                    <i class="fas fa-chevron-right mr-3 text-blue-400 group-hover:text-blue-300 transition-colors text-xs"></i>
                                    <span class="group-hover:text-blue-300">IT・デジタル化</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo esc_url(home_url('/grants/?category=manufacturing')); ?>" 
                                   class="flex items-center group hover:text-white transition-all duration-200 hover:translate-x-2 transform">
                                    <i class="fas fa-chevron-right mr-3 text-purple-400 group-hover:text-purple-300 transition-colors text-xs"></i>
                                    <span class="group-hover:text-purple-300">ものづくり・製造業</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo esc_url(home_url('/grants/?category=startup')); ?>" 
                                   class="flex items-center group hover:text-white transition-all duration-200 hover:translate-x-2 transform">
                                    <i class="fas fa-chevron-right mr-3 text-green-400 group-hover:text-green-300 transition-colors text-xs"></i>
                                    <span class="group-hover:text-green-300">創業・起業</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo esc_url(home_url('/grants/?category=employment')); ?>" 
                                   class="flex items-center group hover:text-white transition-all duration-200 hover:translate-x-2 transform">
                                    <i class="fas fa-chevron-right mr-3 text-yellow-400 group-hover:text-yellow-300 transition-colors text-xs"></i>
                                    <span class="group-hover:text-yellow-300">雇用・人材育成</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo esc_url(home_url('/grants/?category=environment')); ?>" 
                                   class="flex items-center group hover:text-white transition-all duration-200 hover:translate-x-2 transform">
                                    <i class="fas fa-chevron-right mr-3 text-emerald-400 group-hover:text-emerald-300 transition-colors text-xs"></i>
                                    <span class="group-hover:text-emerald-300">環境・省エネ</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                    <!-- ツール・サービス -->
                    <div class="animate-fade-in-up" style="animation-delay: 0.2s;">
                        <h4 class="font-bold text-white mb-6 flex items-center text-lg relative">
                            <div class="w-8 h-8 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-lg flex items-center justify-center mr-3 shadow-lg">
                                <i class="fas fa-tools text-white text-sm"></i>
                            </div>
                            ツール・サービス
                            <div class="absolute -top-1 -right-1 w-2 h-2 bg-emerald-400 rounded-full animate-bounce-gentle" style="animation-delay: 0.5s;"></div>
                        </h4>
                        <ul class="space-y-4 text-gray-300">
                            <li>
                                <a href="<?php echo esc_url(home_url('/tools/')); ?>" 
                                   class="flex items-center group hover:text-white transition-all duration-200 hover:translate-x-2 transform">
                                    <i class="fas fa-chevron-right mr-3 text-emerald-400 group-hover:text-emerald-300 transition-colors text-xs"></i>
                                    <span class="group-hover:text-emerald-300">診断ツール</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo esc_url(home_url('/case-studies/')); ?>" 
                                   class="flex items-center group hover:text-white transition-all duration-200 hover:translate-x-2 transform">
                                    <i class="fas fa-chevron-right mr-3 text-teal-400 group-hover:text-teal-300 transition-colors text-xs"></i>
                                    <span class="group-hover:text-teal-300">成功事例</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo esc_url(home_url('/grant-tips/')); ?>" 
                                   class="flex items-center group hover:text-white transition-all duration-200 hover:translate-x-2 transform">
                                    <i class="fas fa-chevron-right mr-3 text-cyan-400 group-hover:text-cyan-300 transition-colors text-xs"></i>
                                    <span class="group-hover:text-cyan-300">申請のコツ</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo esc_url(home_url('/ai/chat/')); ?>" 
                                   class="flex items-center group hover:text-white transition-all duration-200 hover:translate-x-2 transform relative">
                                    <i class="fas fa-chevron-right mr-3 text-purple-400 group-hover:text-purple-300 transition-colors text-xs"></i>
                                    <span class="group-hover:text-purple-300">AIチャット</span>
                                    <div class="ml-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white text-xs px-2 py-0.5 rounded-full animate-pulse">HOT</div>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo esc_url(home_url('/experts/')); ?>" 
                                   class="flex items-center group hover:text-white transition-all duration-200 hover:translate-x-2 transform">
                                    <i class="fas fa-chevron-right mr-3 text-orange-400 group-hover:text-orange-300 transition-colors text-xs"></i>
                                    <span class="group-hover:text-orange-300">専門家相談</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                    <!-- サポート -->
                    <div class="animate-fade-in-up" style="animation-delay: 0.3s;">
                        <h4 class="font-bold text-white mb-6 flex items-center text-lg relative">
                            <div class="w-8 h-8 bg-gradient-to-r from-purple-500 to-pink-600 rounded-lg flex items-center justify-center mr-3 shadow-lg">
                                <i class="fas fa-info-circle text-white text-sm"></i>
                            </div>
                            サポート
                            <div class="absolute -top-1 -right-1 w-2 h-2 bg-pink-400 rounded-full animate-bounce-gentle" style="animation-delay: 1s;"></div>
                        </h4>
                        <ul class="space-y-4 text-gray-300">
                            <li>
                                <a href="<?php echo esc_url(home_url('/about/')); ?>" 
                                   class="flex items-center group hover:text-white transition-all duration-200 hover:translate-x-2 transform">
                                    <i class="fas fa-chevron-right mr-3 text-purple-400 group-hover:text-purple-300 transition-colors text-xs"></i>
                                    <span class="group-hover:text-purple-300">Grant Insightとは</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo esc_url(home_url('/faq/')); ?>" 
                                   class="flex items-center group hover:text-white transition-all duration-200 hover:translate-x-2 transform">
                                    <i class="fas fa-chevron-right mr-3 text-pink-400 group-hover:text-pink-300 transition-colors text-xs"></i>
                                    <span class="group-hover:text-pink-300">よくある質問</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo esc_url(home_url('/contact/')); ?>" 
                                   class="flex items-center group hover:text-white transition-all duration-200 hover:translate-x-2 transform">
                                    <i class="fas fa-chevron-right mr-3 text-rose-400 group-hover:text-rose-300 transition-colors text-xs"></i>
                                    <span class="group-hover:text-rose-300">お問い合わせ</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo esc_url(home_url('/privacy/')); ?>" 
                                   class="flex items-center group hover:text-white transition-all duration-200 hover:translate-x-2 transform">
                                    <i class="fas fa-chevron-right mr-3 text-indigo-400 group-hover:text-indigo-300 transition-colors text-xs"></i>
                                    <span class="group-hover:text-indigo-300">プライバシーポリシー</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo esc_url(home_url('/terms/')); ?>" 
                                   class="flex items-center group hover:text-white transition-all duration-200 hover:translate-x-2 transform">
                                    <i class="fas fa-chevron-right mr-3 text-blue-400 group-hover:text-blue-300 transition-colors text-xs"></i>
                                    <span class="group-hover:text-blue-300">利用規約</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- CTAセクション -->
                <div class="mb-16 animate-fade-in-up" style="animation-delay: 0.4s;">
                    <div class="bg-gradient-to-r from-blue-600/20 via-purple-600/20 to-pink-600/20 backdrop-blur-sm rounded-2xl p-8 border border-white/10 hover:border-white/20 transition-all duration-300 group">
                        <div class="text-center">
                            <h3 class="text-2xl md:text-3xl font-bold text-white mb-4 group-hover:scale-105 transition-transform duration-300">
                                <i class="fas fa-rocket mr-3 text-yellow-400 animate-bounce-gentle"></i>
                                今すぐ助成金診断を始めよう
                            </h3>
                            <p class="text-gray-300 mb-6 text-lg">
                                AIが最適な助成金・補助金を見つけて、あなたの事業成長を支援します
                            </p>
                            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                <a href="<?php echo esc_url(home_url('/tools/diagnosis/')); ?>" 
                                   class="inline-flex items-center bg-gradient-to-r from-blue-500 via-purple-600 to-pink-500 text-white py-4 px-8 rounded-full font-bold text-lg shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 hover:scale-105 group">
                                    <i class="fas fa-search mr-3 group-hover:animate-bounce-gentle"></i>
                                    無料診断スタート
                                    <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                                </a>
                                <a href="<?php echo esc_url(home_url('/contact/')); ?>" 
                                   class="inline-flex items-center bg-white/10 backdrop-blur-sm text-white py-4 px-8 rounded-full font-bold text-lg border border-white/20 hover:bg-white/20 hover:border-white/40 transition-all duration-300 transform hover:-translate-y-1 group">
                                    <i class="fas fa-comments mr-3 group-hover:animate-bounce-gentle"></i>
                                    専門家に相談
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- フッター下部 -->
                <div class="border-t border-white/10 pt-8 animate-fade-in-up" style="animation-delay: 0.5s;">
                    <div class="flex flex-col lg:flex-row justify-between items-center space-y-6 lg:space-y-0">
                        <!-- コピーライト -->
                        <div class="text-center lg:text-left">
                            <p class="text-gray-400 text-sm mb-2">
                                &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
                            </p>
                            <p class="text-gray-500 text-xs">
                                Powered by AI Technology & Expert Knowledge
                            </p>
                        </div>
                        
                        <!-- 信頼バッジ -->
                        <div class="flex flex-wrap justify-center gap-6 text-sm">
                            <span class="flex items-center text-emerald-400 hover:text-emerald-300 transition-colors duration-200 group">
                                <div class="w-8 h-8 bg-emerald-500/20 rounded-full flex items-center justify-center mr-2 group-hover:bg-emerald-500/30 transition-colors">
                                    <i class="fas fa-shield-alt text-emerald-400"></i>
                                </div>
                                SSL暗号化通信
                            </span>
                            <span class="flex items-center text-blue-400 hover:text-blue-300 transition-colors duration-200 group">
                                <div class="w-8 h-8 bg-blue-500/20 rounded-full flex items-center justify-center mr-2 group-hover:bg-blue-500/30 transition-colors">
                                    <i class="fas fa-lock text-blue-400"></i>
                                </div>
                                個人情報保護
                            </span>
                            <span class="flex items-center text-purple-400 hover:text-purple-300 transition-colors duration-200 group">
                                <div class="w-8 h-8 bg-purple-500/20 rounded-full flex items-center justify-center mr-2 group-hover:bg-purple-500/30 transition-colors">
                                    <i class="fas fa-award text-purple-400"></i>
                                </div>
                                専門家監修
                            </span>
                            <span class="flex items-center text-yellow-400 hover:text-yellow-300 transition-colors duration-200 group">
                                <div class="w-8 h-8 bg-yellow-500/20 rounded-full flex items-center justify-center mr-2 group-hover:bg-yellow-500/30 transition-colors">
                                    <i class="fas fa-robot text-yellow-400"></i>
                                </div>
                                AI技術活用
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- トップに戻るボタン -->
    <div id="back-to-top" class="fixed bottom-8 right-8 z-50 opacity-0 pointer-events-none transition-all duration-300">
        <button class="w-14 h-14 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-full shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 hover:scale-110 group" onclick="scrollToTop()">
            <i class="fas fa-arrow-up group-hover:animate-bounce-gentle"></i>
        </button>
    </div>

    <script>
    // トップに戻るボタンの制御
    window.addEventListener('scroll', function() {
        const backToTopButton = document.getElementById('back-to-top');
        if (window.pageYOffset > 300) {
            backToTopButton.classList.remove('opacity-0', 'pointer-events-none');
            backToTopButton.classList.add('opacity-100', 'pointer-events-auto');
        } else {
            backToTopButton.classList.add('opacity-0', 'pointer-events-none');
            backToTopButton.classList.remove('opacity-100', 'pointer-events-auto');
        }
    });

    // スムーズスクロール
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    // フッターアニメーション初期化
    document.addEventListener('DOMContentLoaded', function() {
        // インターセクションオブザーバーでスクロール時のアニメーション
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in-up');
                }
            });
        }, observerOptions);

        // フッター内の要素を監視
        document.querySelectorAll('.site-footer [class*="animate-fade-in-up"]').forEach(el => {
            observer.observe(el);
        });
    });
    </script>

    <?php wp_footer(); ?>

</body>
</html>