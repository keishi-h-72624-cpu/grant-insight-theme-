<?php
/**
 * Template Name: AI事業診断ページ（超強化版 - Tailwind CSS Play CDN対応）
 * Description: ユーザーがいくつかの質問（アンケート）に答えていくだけで、そのユーザーに合った補助金をAIが診断して結果を表示するページ。
 */

get_header();
?>

<!-- Tailwind CSS Play CDNの読み込み（ページのhead部分に配置） -->
<?php if (!wp_script_is('tailwind-cdn', 'enqueued')): ?>
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                animation: {
                    'fade-in-down': 'fadeInDown 0.6s ease-out forwards',
                    'fade-in-up': 'fadeInUp 0.6s ease-out forwards',
                    'slide-in-left': 'slideInLeft 0.5s ease-out forwards',
                    'slide-in-right': 'slideInRight 0.5s ease-out forwards',
                    'scale-in': 'scaleIn 0.4s ease-out forwards',
                    'bounce-gentle': 'bounceGentle 2s ease-in-out infinite',
                    'pulse-gentle': 'pulseGentle 2s ease-in-out infinite',
                    'float': 'float 3s ease-in-out infinite',
                    'rotate-slow': 'rotateSlow 10s linear infinite',
                    'shimmer': 'shimmer 2s linear infinite',
                    'typewriter': 'typewriter 3s steps(30) infinite',
                    'gradient-x': 'gradientX 3s ease infinite'
                },
                keyframes: {
                    fadeInDown: {
                        '0%': { 
                            opacity: '0', 
                            transform: 'translateY(-30px)' 
                        },
                        '100%': { 
                            opacity: '1', 
                            transform: 'translateY(0)' 
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
                            transform: 'translateY(-5px)',
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
                            transform: 'translateY(-20px)'
                        }
                    },
                    rotateSlow: {
                        '0%': {
                            transform: 'rotate(0deg)'
                        },
                        '100%': {
                            transform: 'rotate(360deg)'
                        }
                    },
                    shimmer: {
                        '0%': {
                            backgroundPosition: '-200px 0'
                        },
                        '100%': {
                            backgroundPosition: '200px 0'
                        }
                    },
                    typewriter: {
                        '0%, 90%, 100%': {
                            width: '0'
                        },
                        '30%, 60%': {
                            width: '100%'
                        }
                    },
                    gradientX: {
                        '0%, 100%': {
                            backgroundPosition: '0% 50%'
                        },
                        '50%': {
                            backgroundPosition: '100% 50%'
                        }
                    }
                },
                backgroundImage: {
                    'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
                    'shimmer-gradient': 'linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent)',
                    'mesh-gradient': 'radial-gradient(at 40% 20%, hsla(28,100%,74%,1) 0px, transparent 50%), radial-gradient(at 80% 0%, hsla(189,100%,56%,1) 0px, transparent 50%), radial-gradient(at 0% 50%, hsla(355,100%,93%,1) 0px, transparent 50%)'
                }
            }
        }
    }
</script>
<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<?php endif; ?>

<div class="ai-diagnosis-page bg-gray-50 min-h-screen">

    <!-- ヒーローセクション -->
    <section class="hero-section relative bg-gradient-to-br from-teal-600 via-green-600 to-lime-600 text-white py-20 overflow-hidden">
        <!-- 背景エフェクト -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute w-96 h-96 bg-white/10 rounded-full -top-48 -left-48 animate-float"></div>
            <div class="absolute w-80 h-80 bg-lime-300/20 rounded-full -bottom-40 -right-40 animate-pulse-gentle" style="animation-delay: 1s;"></div>
            <div class="absolute w-64 h-64 bg-teal-300/20 rounded-full top-1/2 left-1/4 animate-float" style="animation-delay: 2s;"></div>
            <div class="absolute w-72 h-72 bg-green-300/15 rounded-full top-10 right-1/4 animate-pulse-gentle" style="animation-delay: 3s;"></div>
        </div>
        
        <div class="container mx-auto px-4 relative z-10 text-center">
            <!-- AIバッジ -->
            <div class="inline-flex items-center gap-3 bg-white/20 backdrop-blur-sm rounded-full px-6 py-3 mb-8 animate-fade-in-down border border-white/30 shadow-lg">
                <i class="fas fa-robot text-lime-300 text-xl animate-bounce-gentle"></i>
                <span class="text-lg font-bold tracking-wider">AI DIAGNOSIS</span>
                <div class="w-2 h-2 bg-lime-300 rounded-full animate-pulse"></div>
            </div>
            
            <!-- メインタイトル -->
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black mb-8 leading-tight animate-fade-in-down" style="animation-delay: 0.2s;">
                あなたの事業に<br class="md:hidden">
                <span class="relative inline-block">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 via-orange-300 to-red-300 animate-gradient-x">
                        最適な助成金を診断
                    </span>
                    <div class="absolute -bottom-2 left-0 right-0 h-1 bg-gradient-to-r from-yellow-300 to-orange-300 rounded-full animate-shimmer"></div>
                </span>
            </h1>
            
            <!-- サブタイトル -->
            <p class="text-lg md:text-xl text-teal-100 leading-relaxed mb-12 max-w-4xl mx-auto animate-fade-in-up" style="animation-delay: 0.4s;">
                いくつかの質問に答えるだけで、AIがあなたの事業に最適な助成金・補助金を瞬時に診断します。<br>
                <span class="text-lime-200 font-semibold">無料で利用でき、専門的なアドバイスも受けられます。</span>
            </p>

            <!-- 統計情報 -->
            <div class="flex flex-wrap justify-center items-center gap-8 mb-8 animate-fade-in-up" style="animation-delay: 0.6s;">
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl px-6 py-4 border border-white/20">
                    <div class="text-2xl font-bold text-lime-300">10,000+</div>
                    <div class="text-sm text-teal-100">診断実績</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl px-6 py-4 border border-white/20">
                    <div class="text-2xl font-bold text-yellow-300">85%</div>
                    <div class="text-sm text-teal-100">マッチング精度</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl px-6 py-4 border border-white/20">
                    <div class="text-2xl font-bold text-orange-300">30秒</div>
                    <div class="text-sm text-teal-100">診断完了時間</div>
                </div>
            </div>

            <!-- スクロールインジケーター -->
            <div class="animate-fade-in-up" style="animation-delay: 0.8s;">
                <div class="inline-flex flex-col items-center text-teal-200">
                    <span class="text-sm mb-2">診断を開始</span>
                    <i class="fas fa-chevron-down animate-bounce-gentle text-xl"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- 診断セクション -->
    <section class="diagnosis-section py-12 relative -mt-16 z-20">
        <div class="container mx-auto px-4">
            <div class="bg-white shadow-2xl rounded-3xl overflow-hidden max-w-6xl mx-auto border border-gray-100">
                <!-- セクションヘッダー -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-8 border-b border-gray-100">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 text-center flex items-center justify-center animate-fade-in-down">
                        <div class="w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-brain text-teal-600 text-xl"></i>
                        </div>
                        AI事業診断を開始
                    </h2>
                    <p class="text-center text-gray-600 max-w-2xl mx-auto leading-relaxed animate-fade-in-up" style="animation-delay: 0.1s;">
                        以下の項目を入力して、あなたの事業に最適な助成金を見つけましょう。<br>
                        <span class="text-teal-600 font-semibold">すべて無料でご利用いただけます。</span>
                    </p>
                </div>

                <!-- 診断フォーム -->
                <div class="p-8 animate-fade-in-up" style="animation-delay: 0.2s;">
                    <?php 
                    // AI診断ショートコードを呼び出す
                    if (shortcode_exists('ai_diagnosis')) {
                        echo do_shortcode('[ai_diagnosis]');
                    } else {
                        // フォールバック: 基本的な診断フォーム
                        ?>
                        <form id="ai-diagnosis-form" class="space-y-8">
                            <?php wp_nonce_field('ai_diagnosis_nonce', 'diagnosis_nonce'); ?>
                            
                            <!-- 事業情報 -->
                            <div class="form-section bg-blue-50 rounded-2xl p-6">
                                <h3 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                    <i class="fas fa-building text-blue-600 mr-3"></i>
                                    事業情報
                                </h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="form-group">
                                        <label for="company_name" class="block text-sm font-medium text-gray-700 mb-2">
                                            会社・事業者名 *
                                        </label>
                                        <input type="text" 
                                               id="company_name" 
                                               name="company_name" 
                                               required
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-200"
                                               placeholder="例：株式会社○○">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="industry" class="block text-sm font-medium text-gray-700 mb-2">
                                            業種 *
                                        </label>
                                        <select id="industry" 
                                                name="industry" 
                                                required
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-200">
                                            <option value="">業種を選択してください</option>
                                            <option value="manufacturing">製造業</option>
                                            <option value="it">IT・情報通信業</option>
                                            <option value="retail">小売業</option>
                                            <option value="service">サービス業</option>
                                            <option value="construction">建設業</option>
                                            <option value="agriculture">農業</option>
                                            <option value="other">その他</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- 事業規模 -->
                            <div class="form-section bg-green-50 rounded-2xl p-6">
                                <h3 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                    <i class="fas fa-chart-bar text-green-600 mr-3"></i>
                                    事業規模
                                </h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="form-group">
                                        <label for="employees" class="block text-sm font-medium text-gray-700 mb-2">
                                            従業員数 *
                                        </label>
                                        <select id="employees" 
                                                name="employees" 
                                                required
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-200">
                                            <option value="">従業員数を選択してください</option>
                                            <option value="1-5">1-5名</option>
                                            <option value="6-20">6-20名</option>
                                            <option value="21-50">21-50名</option>
                                            <option value="51-100">51-100名</option>
                                            <option value="101-300">101-300名</option>
                                            <option value="301+">301名以上</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="annual_revenue" class="block text-sm font-medium text-gray-700 mb-2">
                                            年間売上高 *
                                        </label>
                                        <select id="annual_revenue" 
                                                name="annual_revenue" 
                                                required
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-200">
                                            <option value="">売上高を選択してください</option>
                                            <option value="under_10m">1,000万円未満</option>
                                            <option value="10m_50m">1,000万円～5,000万円</option>
                                            <option value="50m_100m">5,000万円～1億円</option>
                                            <option value="100m_1b">1億円～10億円</option>
                                            <option value="over_1b">10億円以上</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- 投資・取り組み予定 -->
                            <div class="form-section bg-purple-50 rounded-2xl p-6">
                                <h3 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                    <i class="fas fa-rocket text-purple-600 mr-3"></i>
                                    投資・取り組み予定
                                </h3>
                                
                                <div class="form-group">
                                    <label class="block text-sm font-medium text-gray-700 mb-4">
                                        検討中の投資・取り組み（複数選択可） *
                                    </label>
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                        <?php
                                        $investment_options = [
                                            'it_digitalization' => 'IT・デジタル化',
                                            'equipment' => '設備投資',
                                            'rd' => '研究開発',
                                            'hr_development' => '人材育成',
                                            'environmental' => '環境対策',
                                            'export' => '海外展開',
                                            'startup' => '創業・起業',
                                            'business_succession' => '事業承継',
                                            'other' => 'その他'
                                        ];
                                        foreach ($investment_options as $value => $label) :
                                        ?>
                                        <label class="flex items-center p-3 bg-white rounded-lg border border-gray-200 hover:border-purple-300 hover:bg-purple-50 transition-all duration-200 cursor-pointer">
                                            <input type="checkbox" 
                                                   name="investments[]" 
                                                   value="<?php echo $value; ?>"
                                                   class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-purple-500 focus:ring-2">
                                            <span class="ml-3 text-sm font-medium text-gray-900"><?php echo $label; ?></span>
                                        </label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- 予算・地域 -->
                            <div class="form-section bg-yellow-50 rounded-2xl p-6">
                                <h3 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                    <i class="fas fa-map-marker-alt text-yellow-600 mr-3"></i>
                                    予算・地域情報
                                </h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="form-group">
                                        <label for="budget" class="block text-sm font-medium text-gray-700 mb-2">
                                            投資予算 *
                                        </label>
                                        <select id="budget" 
                                                name="budget" 
                                                required
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-200">
                                            <option value="">予算を選択してください</option>
                                            <option value="under_1m">100万円未満</option>
                                            <option value="1m_5m">100万円～500万円</option>
                                            <option value="5m_10m">500万円～1,000万円</option>
                                            <option value="10m_50m">1,000万円～5,000万円</option>
                                            <option value="over_50m">5,000万円以上</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                                            所在地 *
                                        </label>
                                        <select id="location" 
                                                name="location" 
                                                required
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-200">
                                            <option value="">都道府県を選択してください</option>
                                            <option value="tokyo">東京都</option>
                                            <option value="osaka">大阪府</option>
                                            <option value="kanagawa">神奈川県</option>
                                            <option value="aichi">愛知県</option>
                                            <option value="other">その他</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- 診断ボタン -->
                            <div class="text-center">
                                <button type="submit" 
                                        class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-teal-500 to-green-500 text-white font-bold text-lg rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 group">
                                    <i class="fas fa-brain mr-3 group-hover:animate-pulse"></i>
                                    <span>AI診断を開始する</span>
                                    <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                                </button>
                                <p class="text-sm text-gray-500 mt-3">
                                    <i class="fas fa-lock mr-1"></i>
                                    入力いただいた情報は安全に保護されます
                                </p>
                            </div>
                        </form>
                        <?php
                    }
                    ?>
                </div>

                <!-- 診断結果表示エリア -->
                <div id="ai-diagnosis-result" class="hidden">
                </div>
            </div>
        </div>
    </section>

    <!-- 成功事例セクション -->
    <section class="success-stories-section py-16 bg-gradient-to-br from-blue-50 to-indigo-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-4 animate-fade-in-down">
                <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">AI診断で成功した事例</span>
            </h2>
            <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto animate-fade-in-up" style="animation-delay: 0.1s;">
                実際にAI診断を活用して助成金を獲得された企業様の事例をご紹介します
            </p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- 成功事例1 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 0.2s;">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-laptop-code text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4 text-center">IT導入補助金</h3>
                    <div class="mb-4">
                        <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium mb-2">製造業</span>
                        <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium ml-2">従業員50名</span>
                    </div>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        生産管理システムの導入により、業務効率化を実現。AI診断により最適な補助金を発見し、450万円を獲得。
                    </p>
                    <div class="text-2xl font-bold text-green-600 text-center mb-2">450万円</div>
                    <div class="text-sm text-gray-500 text-center">獲得金額</div>
                </div>

                <!-- 成功事例2 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 0.3s;">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-teal-600 rounded-2xl flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-industry text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4 text-center">ものづくり補助金</h3>
                    <div class="mb-4">
                        <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium mb-2">製造業</span>
                        <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium ml-2">従業員30名</span>
                    </div>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        新製品開発のための設備投資に活用。AI診断のマッチング精度により、申請から採択まで スムーズに進行。
                    </p>
                    <div class="text-2xl font-bold text-green-600 text-center mb-2">750万円</div>
                    <div class="text-sm text-gray-500 text-center">獲得金額</div>
                </div>

                <!-- 成功事例3 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 0.4s;">
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4 text-center">人材開発支援助成金</h3>
                    <div class="mb-4">
                        <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium mb-2">サービス業</span>
                        <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium ml-2">従業員20名</span>
                    </div>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        従業員のスキルアップ研修に活用。AI診断により見落としがちな助成金を発見し、研修費用を大幅削減。
                    </p>
                    <div class="text-2xl font-bold text-green-600 text-center mb-2">200万円</div>
                    <div class="text-sm text-gray-500 text-center">獲得金額</div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ セクション -->
    <section class="faq-section py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-12 animate-fade-in-down">
                よくある質問
            </h2>
            <div class="max-w-4xl mx-auto">
                <div class="space-y-4">
                    <!-- FAQ 1 -->
                    <details class="faq-item bg-gray-50 rounded-2xl shadow-sm overflow-hidden group animate-fade-in-up" style="animation-delay: 0.1s;">
                        <summary class="p-6 cursor-pointer font-semibold text-lg text-gray-800 hover:bg-gray-100 transition-colors flex justify-between items-center">
                            <span class="flex items-center">
                                <i class="fas fa-question-circle text-teal-600 mr-3"></i>
                                AI診断の精度はどの程度ですか？
                            </span>
                            <i class="fas fa-chevron-down group-open:rotate-180 transition-transform text-teal-600"></i>
                        </summary>
                        <div class="px-6 pb-6">
                            <div class="bg-white rounded-xl p-6 border-l-4 border-teal-500">
                                <p class="text-gray-700 leading-relaxed">
                                    当社のAIは過去10,000件以上の採択データを基に学習しており、<strong class="text-teal-600">約85%の精度</strong>でマッチング可能です。
                                    業種、規模、投資内容などの複数の要素を総合的に分析し、最適な助成金を提案します。
                                    ただし最終的な採択を保証するものではありません。
                                </p>
                            </div>
                        </div>
                    </details>

                    <!-- FAQ 2 -->
                    <details class="faq-item bg-gray-50 rounded-2xl shadow-sm overflow-hidden group animate-fade-in-up" style="animation-delay: 0.2s;">
                        <summary class="p-6 cursor-pointer font-semibold text-lg text-gray-800 hover:bg-gray-100 transition-colors flex justify-between items-center">
                            <span class="flex items-center">
                                <i class="fas fa-clock text-blue-600 mr-3"></i>
                                診断にはどのくらいの時間がかかりますか？
                            </span>
                            <i class="fas fa-chevron-down group-open:rotate-180 transition-transform text-blue-600"></i>
                        </summary>
                        <div class="px-6 pb-6">
                            <div class="bg-white rounded-xl p-6 border-l-4 border-blue-500">
                                <p class="text-gray-700 leading-relaxed">
                                    入力は<strong class="text-blue-600">約3-5分</strong>で完了し、診断結果は<strong class="text-blue-600">30秒以内</strong>に表示されます。
                                    複雑な計算や条件照合をAIが瞬時に行うため、従来の手動調査と比べて大幅な時間短縮が可能です。
                                </p>
                            </div>
                        </div>
                    </details>

                    <!-- FAQ 3 -->
                    <details class="faq-item bg-gray-50 rounded-2xl shadow-sm overflow-hidden group animate-fade-in-up" style="animation-delay: 0.3s;">
                        <summary class="p-6 cursor-pointer font-semibold text-lg text-gray-800 hover:bg-gray-100 transition-colors flex justify-between items-center">
                            <span class="flex items-center">
                                <i class="fas fa-shield-alt text-green-600 mr-3"></i>
                                入力した情報のセキュリティは大丈夫ですか？
                            </span>
                            <i class="fas fa-chevron-down group-open:rotate-180 transition-transform text-green-600"></i>
                        </summary>
                        <div class="px-6 pb-6">
                            <div class="bg-white rounded-xl p-6 border-l-4 border-green-500">
                                <p class="text-gray-700 leading-relaxed">
                                    <strong class="text-green-600">SSL暗号化通信</strong>により、すべての情報は安全に保護されます。
                                    入力いただいた情報は診断目的のみに使用し、第三者への提供は一切行いません。
                                    また、診断完了後はデータを適切に処理いたします。
                                </p>
                            </div>
                        </div>
                    </details>

                    <!-- FAQ 4 -->
                    <details class="faq-item bg-gray-50 rounded-2xl shadow-sm overflow-hidden group animate-fade-in-up" style="animation-delay: 0.4s;">
                        <summary class="p-6 cursor-pointer font-semibold text-lg text-gray-800 hover:bg-gray-100 transition-colors flex justify-between items-center">
                            <span class="flex items-center">
                                <i class="fas fa-yen-sign text-purple-600 mr-3"></i>
                                診断は本当に無料ですか？
                            </span>
                            <i class="fas fa-chevron-down group-open:rotate-180 transition-transform text-purple-600"></i>
                        </summary>
                        <div class="px-6 pb-6">
                            <div class="bg-white rounded-xl p-6 border-l-4 border-purple-500">
                                <p class="text-gray-700 leading-relaxed">
                                    はい、<strong class="text-purple-600">完全無料</strong>でご利用いただけます。
                                    診断結果の閲覧、おすすめ助成金の詳細確認まで、すべて無料です。
                                    より詳細なサポートをご希望の場合は、有料の専門家相談サービスもご用意しております。
                                </p>
                            </div>
                        </div>
                    </details>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA セクション -->
    <section class="cta-section py-16 bg-gradient-to-br from-teal-50 to-blue-50">
        <div class="container mx-auto px-4">
            <div class="bg-gradient-to-r from-blue-600 via-purple-600 to-teal-600 rounded-3xl p-8 md:p-12 text-white text-center shadow-2xl relative overflow-hidden animate-fade-in-up">
                <!-- 背景エフェクト -->
                <div class="absolute inset-0 opacity-20">
                    <div class="absolute w-64 h-64 bg-white rounded-full -top-32 -left-32 animate-pulse-gentle"></div>
                    <div class="absolute w-48 h-48 bg-yellow-300 rounded-full -bottom-24 -right-24 animate-float"></div>
                </div>
                
                <div class="relative z-10">
                    <h3 class="text-3xl md:text-4xl font-bold mb-6 animate-fade-in-down">
                        さらに詳しい相談をご希望ですか？
                    </h3>
                    <p class="text-lg md:text-xl mb-8 opacity-90 max-w-3xl mx-auto leading-relaxed animate-fade-in-up" style="animation-delay: 0.1s;">
                        AI診断結果を基に、助成金の専門家が<span class="text-yellow-300 font-semibold">無料で</span>詳細なアドバイスを提供します。<br>
                        申請書作成から採択まで、トータルサポートいたします。
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in-up" style="animation-delay: 0.2s;">
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" 
                           class="inline-flex items-center bg-white text-blue-600 font-bold py-4 px-8 rounded-2xl hover:bg-gray-100 transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 shadow-xl group">
                            <i class="fas fa-envelope mr-3 group-hover:animate-bounce-gentle"></i>
                            無料相談を申し込む
                        </a>
                        
                        <a href="tel:03-1234-5678" 
                           class="inline-flex items-center bg-transparent border-2 border-white text-white font-bold py-4 px-8 rounded-2xl hover:bg-white hover:text-blue-600 transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 group">
                            <i class="fas fa-phone mr-3 group-hover:animate-bounce-gentle"></i>
                            電話で相談する
                        </a>
                    </div>
                    
                    <!-- 追加情報 -->
                    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6 animate-fade-in-up" style="animation-delay: 0.3s;">
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 border border-white/20">
                            <i class="fas fa-user-tie text-2xl mb-2 text-yellow-300"></i>
                            <div class="font-semibold">専門家対応</div>
                            <div class="text-sm opacity-90">助成金のプロが対応</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 border border-white/20">
                            <i class="fas fa-clock text-2xl mb-2 text-yellow-300"></i>
                            <div class="font-semibold">迅速対応</div>
                            <div class="text-sm opacity-90">24時間以内に返信</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 border border-white/20">
                            <i class="fas fa-check-circle text-2xl mb-2 text-yellow-300"></i>
                            <div class="font-semibold">成功実績</div>
                            <div class="text-sm opacity-90">採択率85%以上</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // アニメーション遅延の設定
    const animatedElements = document.querySelectorAll('[class*="animate-"]');
    animatedElements.forEach((el, index) => {
        if (!el.style.animationDelay) {
            el.style.animationDelay = `${index * 0.1}s`;
        }
    });

    // フォームバリデーション
    const form = document.getElementById('ai-diagnosis-form');
    if (form) {
        // 必須項目のチェック
        const requiredFields = form.querySelectorAll('[required]');
        requiredFields.forEach(field => {
            field.addEventListener('blur', function() {
                if (!this.value.trim()) {
                    this.classList.add('border-red-300', 'bg-red-50');
                    this.classList.remove('border-gray-300');
                } else {
                    this.classList.remove('border-red-300', 'bg-red-50');
                    this.classList.add('border-green-300', 'bg-green-50');
                }
            });
        });

        // チェックボックスのバリデーション
        const investmentCheckboxes = form.querySelectorAll('input[name="investments[]"]');
        const validateInvestments = () => {
            const checkedBoxes = form.querySelectorAll('input[name="investments[]"]:checked');
            const investmentSection = form.querySelector('[data-section="investments"]');
            
            if (checkedBoxes.length === 0) {
                investmentCheckboxes.forEach(cb => {
                    cb.closest('label').classList.add('border-red-300', 'bg-red-50');
                });
            } else {
                investmentCheckboxes.forEach(cb => {
                    cb.closest('label').classList.remove('border-red-300', 'bg-red-50');
                });
            }
        };

        investmentCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', validateInvestments);
        });

        // フォーム送信処理
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // バリデーションチェック
            const checkedInvestments = form.querySelectorAll('input[name="investments[]"]:checked');
            if (checkedInvestments.length === 0) {
                showNotification('投資・取り組み予定を1つ以上選択してください', 'error');
                validateInvestments();
                return;
            }
            
            const searchResultsDiv = document.getElementById('ai-diagnosis-result');
            const submitButton = form.querySelector('button[type="submit"]');
            const originalButtonText = submitButton.innerHTML;
            
            // ボタンを無効化
            submitButton.disabled = true;
            submitButton.innerHTML = `
                <i class="fas fa-spinner fa-spin mr-3"></i>
                <span>診断中...</span>
            `;

            // 結果エリアを表示
            searchResultsDiv.classList.remove('hidden');
            searchResultsDiv.innerHTML = `
                <div class="bg-gradient-to-r from-teal-50 to-blue-50 p-8 rounded-t-3xl">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-r from-teal-500 to-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-brain text-white text-2xl animate-pulse"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">AI診断中</h3>
                        <p class="text-gray-600 mb-6">あなたの事業情報を分析しています...</p>
                        <div class="flex justify-center items-center space-x-2">
                            <div class="w-3 h-3 bg-teal-500 rounded-full animate-bounce" style="animation-delay: 0s;"></div>
                            <div class="w-3 h-3 bg-blue-500 rounded-full animate-bounce" style="animation-delay: 0.1s;"></div>
                            <div class="w-3 h-3 bg-purple-500 rounded-full animate-bounce" style="animation-delay: 0.2s;"></div>
                        </div>
                    </div>
                </div>
            `;

            // スクロール
            searchResultsDiv.scrollIntoView({ 
                behavior: 'smooth', 
                block: 'start' 
            });

            // AJAX処理（実際の実装では適切なエンドポイントを使用）
            const formData = new FormData(form);
            formData.append('action', 'ai_diagnosis');
            
            // 3秒後に結果を表示（デモ用）
            setTimeout(() => {
                displayDiagnosisResult(searchResultsDiv, formData);
                
                // ボタンを復旧
                submitButton.disabled = false;
                submitButton.innerHTML = originalButtonText;
            }, 3000);
        });
    }

    // 診断結果表示関数
    function displayDiagnosisResult(container, formData) {
        // デモ用の結果データ
        const mockResult = {
            diagnosis: "あなたの事業に最適な助成金を分析いたしました。製造業で従業員30名規模の企業様には、以下の助成金が特におすすめです。IT導入による業務効率化を検討されている場合、IT導入補助金が最適です。また、設備投資をお考えの場合は、ものづくり補助金もご検討ください。",
            recommended_grants: [
                {
                    title: "IT導入補助金2024",
                    excerpt: "ITツールの導入による業務効率化を支援",
                    max_amount: "450万円",
                    deadline: "2024年3月31日",
                    url: "#"
                },
                {
                    title: "ものづくり・商業・サービス生産性向上促進補助金",
                    excerpt: "中小企業・小規模事業者等の革新的サービス開発・試作品開発・生産プロセス改善を支援",
                    max_amount: "1,000万円",
                    deadline: "2024年4月15日",
                    url: "#"
                },
                {
                    title: "小規模事業者持続化補助金",
                    excerpt: "小規模事業者の販路開拓等の取組を支援",
                    max_amount: "200万円",
                    deadline: "2024年5月10日",
                    url: "#"
                }
            ]
        };

        let diagnosisHtml = `
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-xl mb-8 border-l-4 border-blue-500">
                <h4 class="font-bold text-xl text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-lightbulb text-yellow-500 mr-3"></i>
                    AI診断結果
                </h4>
                <div class="prose max-w-none text-gray-700 leading-relaxed">
                    ${mockResult.diagnosis.replace(/\n/g, '<br>')}
                </div>
            </div>
        `;
        
        let grantsHtml = '';
        if (mockResult.recommended_grants && mockResult.recommended_grants.length > 0) {
            grantsHtml += `
                <h4 class="font-bold text-2xl text-center mb-8 text-gray-900">
                    <i class="fas fa-star text-yellow-500 mr-3"></i>
                    あなたへのおすすめ助成金
                </h4>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            `;
            
            mockResult.recommended_grants.forEach((grant, index) => {
                grantsHtml += `
                    <div class="bg-white border border-gray-200 rounded-2xl p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 animate-fade-in-up" style="animation-delay: ${index * 0.1}s;">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-500 rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-medal text-white text-xl"></i>
                            </div>
                            <div class="text-lg font-bold text-gray-900 flex-1">おすすめ度: 高</div>
                        </div>
                        <h5 class="font-bold text-lg mb-3 text-gray-900 leading-tight">${grant.title}</h5>
                        <p class="text-sm text-gray-600 mb-4 leading-relaxed">${grant.excerpt}</p>
                        <div class="mb-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-gray-500">上限金額</span>
                                <span class="font-bold text-green-600 text-lg">最大 ${grant.max_amount}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">申請締切</span>
                                <span class="font-semibold text-red-600 text-sm">${grant.deadline}</span>
                            </div>
                        </div>
                        <a href="${grant.url}" class="block w-full text-center bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold px-4 py-3 rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all duration-200 transform hover:scale-105">
                            詳細を見る
                        </a>
                    </div>
                `;
            });
            grantsHtml += '</div>';
        }
        
        container.innerHTML = `
            <div class="bg-white rounded-b-3xl shadow-xl overflow-hidden">
                <div class="p-8">
                    <div class="text-center mb-8">
                        <div class="w-20 h-20 bg-gradient-to-r from-green-500 to-teal-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-check text-white text-3xl"></i>
                        </div>
                        <h3 class="text-3xl font-bold bg-gradient-to-r from-green-600 to-teal-600 bg-clip-text text-transparent mb-2">
                            診断完了！
                        </h3>
                        <p class="text-gray-600">あなたの事業に最適な助成金が見つかりました</p>
                    </div>
                    ${diagnosisHtml}
                    ${grantsHtml}
                    <div class="text-center">
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" 
                           class="inline-flex items-center bg-gradient-to-r from-orange-500 to-red-500 text-white font-bold py-4 px-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 group">
                            <i class="fas fa-comments mr-3 group-hover:animate-bounce-gentle"></i>
                            専門家に詳しく相談する
                        </a>
                        <p class="text-sm text-gray-500 mt-3">
                            <i class="fas fa-gift mr-1"></i>
                            初回相談は完全無料です
                        </p>
                    </div>
                </div>
            </div>
        `;
        
        showNotification('診断が完了しました！', 'success');
    }

    // 通知表示関数
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-xl shadow-lg transform translate-x-full transition-all duration-300 ${
            type === 'success' ? 'bg-green-500 text-white' :
            type === 'error' ? 'bg-red-500 text-white' :
            'bg-blue-500 text-white'
        }`;
        notification.innerHTML = `
            <div class="flex items-center">
                <i class="fas ${
                    type === 'success' ? 'fa-check-circle' :
                    type === 'error' ? 'fa-exclamation-circle' :
                    'fa-info-circle'
                } mr-2"></i>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 10);
        
        setTimeout(() => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                if (document.body.contains(notification)) {
                    document.body.removeChild(notification);
                }
            }, 300);
        }, 4000);
    }

    // FAQ アコーディオンの強化
    const detailsElements = document.querySelectorAll('details');
    detailsElements.forEach(details => {
        details.addEventListener('toggle', function() {
            if (this.open) {
                // 他のdetailsを閉じる
                detailsElements.forEach(other => {
                    if (other !== this) {
                        other.open = false;
                    }
                });
            }
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

    // Intersection Observer for scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
            }
        });
    }, observerOptions);
    
    // 要素を監視対象に追加
    document.querySelectorAll('[class*="animate-"]').forEach(el => {
        el.style.animationFillMode = 'both';
        el.style.animationPlayState = 'paused';
        observer.observe(el);
    });
});
</script>

<?php get_footer(); ?>
