<?php
/**
 * ヒーローセクション - 最初の状態＋URL更新版
 * Hero Section - Original State with Updated URLs
 * @package Grant_Insight_Perfect
 * @version 15.0-original-with-updated-urls
 * 
 * --- 更新内容 ---
 * 1. PCは最初の状態に戻す
 * 2. ロゴURLを更新
 * 3. 動画URLを更新
 * 4. モバイルは2倍画像サイズを維持
 */

// セキュリティチェック
if (!defined('ABSPATH')) {
    exit;
}

// ヘルパー関数群
if (!function_exists('gip_safe_output')) {
    function gip_safe_output($text, $allow_html = false) {
        return $allow_html ? wp_kses_post($text) : esc_html($text);
    }
}

if (!function_exists('gip_get_option')) {
    function gip_get_option($key, $default = '') {
        $value = get_option('gip_' . $key, $default);
        return !empty($value) ? $value : $default;
    }
}

if (!function_exists('gip_get_media_url')) {
    function gip_get_media_url($filename, $fallback = '') {
        $upload_dir = wp_upload_dir();
        $file_path = $upload_dir['basedir'] . '/' . $filename;
        if (file_exists($file_path)) return $upload_dir['baseurl'] . '/' . $filename;
        $date_path = $upload_dir['basedir'] . '/2025/09/' . $filename;
        if (file_exists($date_path)) return $upload_dir['baseurl'] . '/2025/09/' . $filename;
        return $fallback;
    }
}

// AIの特徴データ（PC専用）
if (!function_exists('gip_get_ai_features')) {
    function gip_get_ai_features() {
        return array(
            array(
                'icon' => 'fas fa-magic',
                'title' => 'AI自動マッチング',
                'description' => 'あなたのビジネスに最適な助成金を瞬時に発見',
                'color' => 'from-purple-500 to-indigo-500'
            ),
            array(
                'icon' => 'fas fa-clock',
                'title' => '24時間対応',
                'description' => 'いつでもどこでも助成金情報にアクセス',
                'color' => 'from-blue-500 to-cyan-500'
            ),
            array(
                'icon' => 'fas fa-shield-alt',
                'title' => '安心・安全',
                'description' => '厳選された信頼できる助成金情報のみを提供',
                'color' => 'from-emerald-500 to-teal-500'
            )
        );
    }
}

// 設定値の取得
$hero_config = array(
    'title' => gip_get_option('hero_title', '助成金・補助金情報サイト'),
    'cta_primary_text' => gip_get_option('hero_cta_primary_text', '今すぐ検索開始'),
    'cta_secondary_text' => gip_get_option('hero_cta_secondary_text', 'AI相談を開始'),
    'video_url' => 'http://joseikin-insight.com/wp-content/uploads/2025/09/video-1756704200376.mp4',
    'main_icon_url' => 'http://joseikin-insight.com/wp-content/uploads/2025/09/1756991386247.png'
);

$ai_features = gip_get_ai_features();
$site_name = get_bloginfo('name');
?>

<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<section id="hero-section" class="hero-section relative overflow-hidden min-h-screen flex items-center bg-white" role="banner" aria-label="ヒーローセクション">
    
    <!-- グラデーション＋幾何学パターン背景 -->
    <div class="gradient-geometric-background absolute inset-0 z-0"></div>
    
    <!-- パーティクル背景 -->
    <div id="hero-particles-background" class="absolute inset-0 z-5"></div>
    
    <!-- メインコンテンツ -->
    <div class="container relative z-20 mx-auto px-4 lg:px-8">
        <!-- デスクトップレイアウト -->
        <div class="hidden lg:grid lg:grid-cols-12 gap-12 items-center min-h-screen py-20">
            
            <!-- 左側コンテンツ -->
            <div class="lg:col-span-7 hero-content">
                <!-- AIバッジ -->
                <div class="inline-flex items-center gap-3 bg-white/95 backdrop-blur-sm text-emerald-700 px-6 py-3 rounded-full text-sm font-bold mb-8 shadow-xl border border-emerald-200/50 hover:shadow-2xl transition-all duration-300 animate-on-scroll opacity-0 translate-y-8" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative">
                        <i class="fas fa-sparkles animate-pulse text-emerald-500" aria-hidden="true"></i>
                        <div class="absolute -inset-2 bg-emerald-200 rounded-full opacity-30 animate-ping"></div>
                    </div>
                    <span class="bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent font-black">AI搭載</span>
                    <span>次世代プラットフォーム</span>
                    <i class="fas fa-rocket text-teal-500 animate-bounce" aria-hidden="true"></i>
                </div>
                
                <!-- メインタイトル -->
                <h1 class="hero-title text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-black leading-tight mb-12 animate-on-scroll opacity-0 translate-y-8" data-aos="fade-up" data-aos-delay="400">
                    <span class="bg-gradient-to-r from-gray-800 via-emerald-700 to-teal-700 bg-clip-text text-transparent drop-shadow-sm">
                        <?php echo gip_safe_output($hero_config['title']); ?>
                    </span>
                </h1>
                
                <!-- CTA ボタン -->
                <div class="hero-cta flex flex-col sm:flex-row gap-4 mb-16 animate-on-scroll opacity-0 translate-y-8" data-aos="fade-up" data-aos-delay="600">
                    <a href="#grant-search" 
                       class="cta-primary group relative inline-flex items-center justify-center gap-3 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white px-8 py-5 rounded-full font-bold text-lg transition-all duration-500 transform hover:scale-105 hover:shadow-2xl shadow-emerald-500/25 overflow-hidden focus:outline-none focus:ring-4 focus:ring-emerald-200/50">
                        <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        <i class="fas fa-search relative z-10 group-hover:animate-pulse" aria-hidden="true"></i>
                        <span class="relative z-10"><?php echo gip_safe_output($hero_config['cta_primary_text']); ?></span>
                        <i class="fas fa-arrow-right relative z-10 group-hover:translate-x-1 transition-transform duration-300" aria-hidden="true"></i>
                    </a>
                    
                    <div class="flex items-center gap-4">
                        <button onclick="gipOpenAIChat()" 
                               class="cta-secondary group inline-flex items-center justify-center gap-3 bg-white/95 hover:bg-white text-emerald-700 hover:text-emerald-800 px-8 py-5 rounded-full font-bold text-lg transition-all duration-300 backdrop-blur-sm border border-emerald-200/50 hover:border-emerald-300 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-emerald-200/50">
                            <i class="fas fa-robot group-hover:animate-bounce text-emerald-600" aria-hidden="true"></i>
                            <span><?php echo gip_safe_output($hero_config['cta_secondary_text']); ?></span>
                        </button>
                        
                        <div class="flex-shrink-0 animate-on-scroll opacity-0 translate-x-4" data-aos="fade-left" data-aos-delay="800">
                            <?php if (!empty($hero_config['logo_url'])): ?>
                            <img src="<?php echo esc_url($hero_config['logo_url']); ?>" 
                                 alt="<?php echo esc_attr($site_name); ?>のロゴ" 
                                 class="h-16 md:h-20 lg:h-24 w-auto object-contain hover:scale-110 transition-transform duration-300 cursor-pointer drop-shadow-lg"
                                 onclick="gipScrollToTop()"
                                 loading="lazy"
                                 decoding="async">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- AI機能の特徴（PC専用） -->
                <div class="max-w-2xl">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
                        <?php foreach ($ai_features as $index => $feature): ?>
                        <div class="feature-card group bg-white/95 backdrop-blur-md rounded-xl p-4 text-center shadow-lg border border-white/70 hover:shadow-xl transition-all duration-300 transform hover:scale-105 animate-on-scroll opacity-0 translate-y-4" data-aos="fade-up" data-aos-delay="<?php echo 1000 + ($index * 100); ?>">
                            <div class="flex items-center justify-center mb-3">
                                <div class="w-12 h-12 bg-gradient-to-r <?php echo gip_safe_output($feature['color']); ?> rounded-xl flex items-center justify-center shadow-md group-hover:rotate-12 transition-transform duration-300">
                                    <i class="<?php echo gip_safe_output($feature['icon']); ?> text-white text-lg" aria-hidden="true"></i>
                                </div>
                            </div>
                            <h4 class="font-bold text-gray-800 mb-2 text-sm"><?php echo gip_safe_output($feature['title']); ?></h4>
                            <p class="text-xs text-gray-600 leading-relaxed"><?php echo gip_safe_output($feature['description']); ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- 価値提案（PC専用） -->
                    <div class="flex flex-wrap items-center gap-6 text-sm text-gray-700 animate-on-scroll opacity-0 translate-y-8" data-aos="fade-up" data-aos-delay="1400">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-green-500"></i>
                            <span>完全無料</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-green-500"></i>
                            <span>登録不要</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-green-500"></i>
                            <span>即座に検索</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-green-500"></i>
                            <span>専門サポート</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 右側ビジュアル（PC専用） -->
            <div class="lg:col-span-5 hero-visual">
                <div class="relative max-w-xl mx-auto animate-on-scroll opacity-0 translate-y-8" data-aos="fade-up" data-aos-delay="1600">
                    <div class="absolute inset-0 flex items-center justify-center" aria-hidden="true">
                        <div class="absolute w-96 h-96 border-2 border-emerald-200/40 rounded-full animate-spin-slow"></div>
                        <div class="absolute w-80 h-80 border border-teal-200/50 rounded-full animate-spin-reverse"></div>
                    </div>
                    
                    <div class="relative z-10 mx-auto w-80 h-80 lg:w-96 lg:h-96 rounded-3xl overflow-hidden shadow-2xl bg-white/20 backdrop-blur-sm border border-white/30">
                         <video id="hero-video-desktop" class="hero-video w-full h-full object-cover rounded-3xl" autoplay muted loop playsinline preload="metadata">
                             <source src="<?php echo esc_url($hero_config['video_url']); ?>" type="video/mp4">
                             <p class="text-center text-gray-500 p-8">お使いのブラウザは動画をサポートしていません。</p>
                         </video>
                    </div>
                </div>
            </div>
        </div>

        <!-- モバイルレイアウト（動画なし） -->
        <div class="lg:hidden min-h-screen flex flex-col justify-center py-6 px-4 relative">
            <!-- メインコンテンツ（コンパクト版） -->
            <div class="flex-1 flex flex-col justify-center max-w-sm mx-auto w-full">
                
                <!-- 超大型メインアイコン（2倍サイズ） -->
                <div class="flex justify-center mb-6">
                    <div class="relative">
                        <img src="<?php echo esc_url($hero_config['main_icon_url']); ?>" 
                             alt="助成金・補助金アイコン" 
                             class="w-64 h-64 sm:w-80 sm:h-80 object-contain drop-shadow-2xl hover:scale-110 transition-transform duration-300 filter brightness-110 contrast-110"
                             loading="lazy"
                             decoding="async">
                        <div class="absolute -inset-8 bg-gradient-to-r from-emerald-200/20 via-teal-200/30 to-blue-200/20 rounded-full animate-pulse"></div>
                        <div class="absolute -inset-12 bg-gradient-to-r from-purple-200/10 via-indigo-200/20 to-emerald-200/10 rounded-full animate-ping"></div>
                    </div>
                </div>

                <!-- AIバッジ -->
                <div class="inline-flex items-center gap-2 bg-white/98 backdrop-blur-sm text-emerald-700 px-4 py-2 rounded-full text-xs font-bold mb-6 shadow-lg border border-emerald-200/50 self-center">
                    <i class="fas fa-sparkles text-emerald-500" aria-hidden="true"></i>
                    <span class="bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent font-black">AI搭載</span>
                </div>
                
                <!-- メインタイトル -->
                <h1 class="hero-title text-2xl sm:text-3xl font-black leading-tight mb-6 text-center">
                    <span class="bg-gradient-to-r from-gray-800 via-emerald-700 to-teal-700 bg-clip-text text-transparent">
                        <?php echo gip_safe_output($hero_config['title']); ?>
                    </span>
                </h1>
                
                <!-- CTA ボタン -->
                <div class="flex flex-col gap-3 mb-8">
                    <a href="#grant-search" 
                       class="cta-primary w-full inline-flex items-center justify-center gap-3 bg-gradient-to-r from-emerald-500 to-teal-600 text-white px-6 py-4 rounded-full font-bold text-base transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-[1.02]">
                        <i class="fas fa-search" aria-hidden="true"></i>
                        <span><?php echo gip_safe_output($hero_config['cta_primary_text']); ?></span>
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                    
                    <button onclick="gipOpenAIChat()" 
                           class="cta-secondary w-full inline-flex items-center justify-center gap-3 bg-white/98 text-emerald-700 px-6 py-4 rounded-full font-bold text-base transition-all duration-300 backdrop-blur-sm border-2 border-emerald-200/50 shadow-lg hover:shadow-xl transform hover:scale-[1.02]">
                        <i class="fas fa-robot text-emerald-600" aria-hidden="true"></i>
                        <span><?php echo gip_safe_output($hero_config['cta_secondary_text']); ?></span>
                    </button>
                </div>

                <!-- モバイル用ロゴ（通常サイズ） -->
                <div class="flex justify-center">
                    <?php if (!empty($hero_config['logo_url'])): ?>
                    <img src="<?php echo esc_url($hero_config['logo_url']); ?>" 
                         alt="<?php echo esc_attr($site_name); ?>のロゴ" 
                         class="h-16 sm:h-20 w-auto object-contain hover:scale-110 transition-transform duration-500 cursor-pointer drop-shadow-xl filter brightness-110 contrast-110"
                         onclick="gipScrollToTop()"
                         loading="lazy"
                         decoding="async">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- スクロールインジケーター -->
    <div class="scroll-indicator absolute bottom-8 left-1/2 transform -translate-x-1/2 z-20 animate-bounce">
        <a href="#grant-search" class="flex flex-col items-center gap-2 text-emerald-600 hover:text-emerald-800 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-emerald-400/50 rounded-lg p-2" aria-label="助成金検索セクションへスクロール">
            <span class="text-xs font-medium">スクロール</span>
            <div class="w-6 h-10 border-2 border-emerald-400 rounded-full flex justify-center">
                <div class="w-1 h-3 bg-emerald-500 rounded-full mt-2 animate-scroll-dot"></div>
            </div>
        </a>
    </div>
</section>

<script>
// 軽量パーティクルエフェクトの初期化処理
function initHeroParticles() {
    if (typeof particlesJS !== 'undefined' && document.getElementById('hero-particles-background')) {
        const isMobile = window.innerWidth < 1024;
        particlesJS('hero-particles-background', {
            "particles": {
                "number": {
                    "value": isMobile ? 15 : 25,
                    "density": {
                        "enable": true,
                        "value_area": 1000
                    }
                },
                "color": {
                    "value": ["#10b981", "#14b8a6", "#3b82f6", "#8b5cf6"]
                },
                "shape": {
                    "type": "circle",
                },
                "opacity": {
                    "value": isMobile ? 0.15 : 0.25,
                    "random": true,
                },
                "size": {
                    "value": isMobile ? 1.5 : 2.5,
                    "random": true,
                },
                "line_linked": {
                    "enable": true,
                    "distance": isMobile ? 50 : 70,
                    "color": "#14b8a6",
                    "opacity": isMobile ? 0.1 : 0.15,
                    "width": 1
                },
                "move": {
                    "enable": true,
                    "speed": isMobile ? 0.3 : 0.5,
                    "direction": "none",
                    "random": true,
                    "straight": false,
                    "out_mode": "out",
                    "bounce": false,
                }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": { 
                        "enable": !isMobile, 
                        "mode": "grab" 
                    },
                    "onclick": { 
                        "enable": false
                    },
                    "resize": true
                },
                "modes": {
                    "grab": { 
                        "distance": 50, 
                        "line_linked": { "opacity": 0.3 } 
                    }
                }
            },
            "retina_detect": true
        });
    }
}

// メインスクリプト
window.GrantInsightPerfect = window.GrantInsightPerfect || {};
(function(GIP) {
    'use strict';
    
    function init() {
        initHeroParticles();

        if (!('IntersectionObserver' in window)) {
            document.querySelectorAll('.animate-on-scroll').forEach(el => {
                el.classList.remove('opacity-0', 'translate-y-8', 'translate-y-4', 'translate-x-4');
            });
            return;
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    setTimeout(() => {
                        el.classList.remove('opacity-0', 'translate-y-8', 'translate-y-4', 'translate-x-4');
                    }, parseInt(el.dataset.aosDelay || 0));
                    observer.unobserve(el);
                }
            });
        }, { 
            threshold: 0.1,
            rootMargin: '30px'
        });

        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });

        // PC動画の処理
        const heroVideo = document.getElementById('hero-video-desktop');
        if (heroVideo) {
            heroVideo.addEventListener('loadeddata', function() {
                this.style.opacity = '1';
            });
        }
    }
    
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})(window.GrantInsightPerfect);

// ユーティリティ関数
function gipScrollToTop() { 
    window.scrollTo({ top: 0, behavior: 'smooth' }); 
}

function gipOpenAIChat() { 
    alert('AI相談チャットを開きます'); 
}

// リサイズ時の再初期化
window.addEventListener('resize', function() {
    if (typeof particlesJS !== 'undefined') {
        setTimeout(initHeroParticles, 300);
    }
});
</script>

<style>
/* ヒーローセクション専用スタイル */
.hero-section {
    font-family: 'Noto Sans JP', sans-serif;
    position: relative;
    overflow: hidden;
}

/* グラデーション＋幾何学パターン背景 */
.gradient-geometric-background {
    background:
        radial-gradient(circle at 20% 80%, rgba(16, 185, 129, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(59, 130, 246, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(139, 92, 246, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 60% 70%, rgba(236, 72, 153, 0.08) 0%, transparent 50%),
        radial-gradient(circle at 90% 10%, rgba(251, 191, 36, 0.08) 0%, transparent 50%),
        linear-gradient(135deg, #ffffff 0%, #f0fdfa 25%, #ecfdf5 50%, #f0f9ff 75%, #ffffff 100%);
    animation: gradient-shift 25s ease-in-out infinite;
}

@keyframes gradient-shift {
    0%, 100% { 
        background-position: 0% 0%, 0% 0%, 0% 0%, 0% 0%, 0% 0%, 0% 0%; 
    }
    25% { 
        background-position: 25% 25%, -25% 25%, 50% -25%, 75% 50%, -50% 75%, 0% 0%; 
    }
    50% { 
        background-position: 50% 50%, -50% 50%, 100% -50%, 150% 100%, -100% 150%, 0% 0%; 
    }
    75% { 
        background-position: 25% 75%, -75% 25%, 75% -75%, 100% 75%, -75% 100%, 0% 0%; 
    }
}

/* パーティクル背景 */
#hero-particles-background {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 5;
    opacity: 0.6;
}

#hero-particles-background canvas {
    display: block;
}

/* 機能カードのスタイル */
.feature-card {
    backdrop-filter: blur(25px);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 
        0 4px 6px rgba(0, 0, 0, 0.05),
        0 1px 3px rgba(0, 0, 0, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.8);
}

.feature-card:hover {
    transform: translateY(-4px) scale(1.03);
    box-shadow: 
        0 25px 50px rgba(0, 0, 0, 0.12),
        0 10px 20px rgba(0, 0, 0, 0.08),
        inset 0 1px 0 rgba(255, 255, 255, 0.9);
}

/* アニメーション定義 */
@keyframes spin-slow { 
    from { transform: rotate(0deg); } 
    to { transform: rotate(360deg); } 
}

@keyframes spin-reverse { 
    from { transform: rotate(360deg); } 
    to { transform: rotate(0deg); } 
}

@keyframes scroll-dot {
    0% { opacity: 1; transform: translateY(0); }
    50% { opacity: 0.3; transform: translateY(8px); }
    100% { opacity: 1; transform: translateY(0); }
}

/* アニメーションクラス */
.animate-spin-slow { animation: spin-slow 20s linear infinite; }
.animate-spin-reverse { animation: spin-reverse 15s linear infinite; }
.animate-scroll-dot { animation: scroll-dot 2s ease-in-out infinite; }

/* 動画スタイル */
.hero-video {
    opacity: 0;
    transition: opacity 0.6s ease-in-out;
}

/* ボタンスタイル改良 */
.cta-primary,
.cta-secondary {
    will-change: transform;
    backface-visibility: hidden;
    box-shadow: 
        0 10px 25px rgba(0, 0, 0, 0.15),
        0 4px 8px rgba(0, 0, 0, 0.1);
}

.cta-primary:hover {
    transform: scale(1.02);
    box-shadow: 
        0 20px 40px rgba(16, 185, 129, 0.3),
        0 8px 16px rgba(16, 185, 129, 0.2);
}

.cta-secondary:hover {
    transform: scale(1.01);
    box-shadow: 
        0 15px 30px rgba(0, 0, 0, 0.2),
        0 6px 12px rgba(0, 0, 0, 0.15);
}

/* ロゴスタイル */
.hero-section img[alt*="ロゴ"] {
    filter: 
        drop-shadow(0 8px 16px rgba(0, 0, 0, 0.15))
        drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
    transform: scale(1);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.hero-section img[alt*="ロゴ"]:hover {
    filter: 
        drop-shadow(0 12px 24px rgba(0, 0, 0, 0.2))
        drop-shadow(0 6px 12px rgba(0, 0, 0, 0.15));
}

/* 超大型メインアイコンスタイル（2倍サイズ） */
.hero-section img[alt="助成金・補助金アイコン"] {
    filter: 
        drop-shadow(0 25px 50px rgba(0, 0, 0, 0.25))
        drop-shadow(0 15px 30px rgba(0, 0, 0, 0.15));
}

/* モバイル最適化 */
@media (max-width: 1023px) {
    .hero-section {
        min-height: 100vh;
    }
    
    .gradient-geometric-background {
        animation-duration: 35s;
    }
    
    #hero-particles-background {
        opacity: 0.4;
    }
    
    .lg\:hidden.min-h-screen {
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
    }
}

/* 小画面スマホ対応 */
@media (max-width: 640px) {
    .hero-title {
        font-size: 1.75rem;
        line-height: 2rem;
        margin-bottom: 1.5rem;
    }
    
    .cta-primary,
    .cta-secondary {
        padding: 1rem 1.5rem;
        font-size: 0.875rem;
    }
    
    .hero-section img[alt="助成金・補助金アイコン"] {
        width: 240px !important; /* 2倍サイズ維持 */
        height: 240px !important;
    }
    
    .hero-section img[alt*="ロゴ"] {
        height: 48px !important;
    }
}

/* 超小画面対応 */
@media (max-width: 480px) {
    .hero-title {
        font-size: 1.5rem;
        line-height: 1.75rem;
    }
    
    .container {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    .hero-section img[alt="助成金・補助金アイコン"] {
        width: 200px !important;
        height: 200px !important;
    }
    
    .hero-section img[alt*="ロゴ"] {
        height: 40px !important;
    }
}

/* アクセシビリティ */
@media (prefers-reduced-motion: reduce) {
    .animate-spin-slow,
    .animate-spin-reverse,
    .animate-bounce,
    .animate-pulse,
    .animate-ping,
    .gradient-geometric-background {
        animation: none;
    }
    
    .cta-primary:hover,
    .cta-secondary:hover,
    .feature-card:hover {
        transform: none;
    }
}

/* パフォーマンス最適化 */
.feature-card,
.cta-primary,
.cta-secondary {
    will-change: transform;
    backface-visibility: hidden;
    transform: translateZ(0);
}

/* 高解像度対応 */
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
    .hero-video,
    .hero-section img {
        image-rendering: -webkit-optimize-contrast;
        image-rendering: crisp-edges;
    }
}

/* フォーカススタイル改良 */
.cta-primary:focus,
.cta-secondary:focus {
    outline: none;
    box-shadow: 
        0 0 0 4px rgba(16, 185, 129, 0.3),
        0 20px 40px rgba(16, 185, 129, 0.3),
        0 8px 16px rgba(16, 185, 129, 0.2);
}

/* 美しいテクスチャオーバーレイ */
.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 10% 10%, rgba(16, 185, 129, 0.03) 0%, transparent 30%),
        radial-gradient(circle at 90% 90%, rgba(59, 130, 246, 0.03) 0%, transparent 30%),
        radial-gradient(circle at 50% 50%, rgba(139, 92, 246, 0.02) 0%, transparent 40%);
    z-index: 2;
    pointer-events: none;
    animation: overlay-shift 30s ease-in-out infinite;
}

@keyframes overlay-shift {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.8; }
}
</style>