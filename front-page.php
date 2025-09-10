<?php
/**
 * Grant Insight Perfect Theme - Front Page Template (Tailwind CSS Play CDN対応版)
 * 完全統合版: Hero, Search, Problems, Categories, News, Tools + AI Chatbot
 *
 * @package Grant_Insight_Perfect
 * @version 5.0-tailwind-perfect-complete
 */

get_header(); ?>

<!-- Tailwind is globally enqueued and configured in functions.php. Removed duplicate CDN/config to avoid conflicts. -->

<main id="main" class="site-main bg-gradient-to-b from-gray-50 to-white" role="main">

    <?php
    /**
     * 1. Hero Section
     * Tailwind CSS対応のメインビジュアルとキャッチコピーでユーザーを惹きつけます。
     */
    get_template_part('template-parts/front-page/section-hero');

    /**
     * 2. Search Section  
     * Tailwind CSS対応の助成金検索システムで、サイトの核となる機能へユーザーを誘導します。
     */
    get_template_part('template-parts/front-page/section-search');

    /**
     * 3. Problems Section
     * Tailwind CSS対応のユーザー課題提示で「自分ごと」として共感を促します。
     */
    get_template_part('template-parts/front-page/section-problems');

    /**
     * 4. Categories Section
     * Tailwind CSS対応のカテゴリ別ナビゲーションでサイト内回遊を促進します。
     */
    get_template_part('template-parts/front-page/section-categories');

    /**
     * 5. News Section
     * Tailwind CSS対応の最新ニュース・お知らせセクションで情報提供します。
     */
    get_template_part('template-parts/front-page/section-news');

    /**
     * 6. Recommended Tools Section
     * Tailwind CSS対応の関連ツール紹介で付加価値を提供します。
     */
    get_template_part('template-parts/front-page/section-recommended-tools');
    ?>

</main>

<!-- フローティングCTA -->
<div class="floating-cta fixed bottom-6 right-6 z-40 hidden lg:block transform translate-y-full opacity-0 transition-all duration-300">
    <a href="#grant-search" 
       class="flex items-center bg-gradient-to-r from-emerald-600 to-teal-600 text-white px-6 py-3 rounded-full shadow-2xl hover:shadow-emerald-500/50 transform transition-all duration-300 hover:scale-105">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
        助成金を検索
    </a>
</div>

<!-- AI Chatbot Integration - 完全対応版 -->
<div class="ai-chatbot">
    <!-- チャットボットトグルボタン -->
    <div class="chatbot-toggle" role="button" tabindex="0" aria-label="AI助成金相談を開く">
        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"/>
        </svg>
        <div class="chatbot-notification">1</div>
    </div>
    
    <!-- チャットボットモーダル -->
    <div class="chatbot-modal">
        <div class="chatbot-container">
            <!-- ヘッダー -->
            <div class="chatbot-header">
                <h3 class="chatbot-title">助成金AI相談</h3>
                <button class="chatbot-close" aria-label="チャットボットを閉じる">&times;</button>
            </div>
            
            <!-- メッセージエリア -->
            <div class="chatbot-messages">
                <div class="message bot">
                    こんにちは！助成金に関するご質問があれば、お気軽にお聞かせください。
                </div>
            </div>
            
            <!-- 入力エリア -->
            <div class="chatbot-input-area">
                <div class="chatbot-input-container">
                    <input type="text" 
                           class="chatbot-input" 
                           placeholder="助成金について質問してください..."
                           aria-label="メッセージを入力">
                    <button class="chatbot-send" aria-label="メッセージを送信">送信</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- プログレスバー（スクロール進捗） -->
<div id="scroll-progress" class="fixed top-0 left-0 h-1 bg-gradient-to-r from-emerald-500 to-teal-600 z-50 transition-all duration-100" style="width: 0%"></div>

<!-- トップに戻るボタン -->
<button id="back-to-top" 
        class="fixed bottom-6 right-20 z-40 w-12 h-12 bg-gradient-to-r from-gray-600 to-gray-700 text-white rounded-full shadow-lg hover:shadow-xl transform transition-all duration-300 hover:scale-110 opacity-0 invisible">
    <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
    </svg>
</button>

<!-- Cookie同意バナー（GDPR対応） -->
<div id="cookie-banner" class="fixed bottom-0 left-0 right-0 bg-gray-800 text-white p-4 z-50 transform translate-y-full transition-transform duration-300">
    <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex-1">
            <p class="text-sm">
                このサイトでは、より良いサービス提供のためにCookieを使用しています。
                <a href="/privacy-policy" class="text-emerald-400 hover:text-emerald-300 underline">プライバシーポリシー</a>
            </p>
        </div>
        <div class="flex gap-3">
            <button id="cookie-accept" 
                    class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                同意する
            </button>
            <button id="cookie-decline" 
                    class="bg-gray-600 hover:bg-gray-500 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                拒否
            </button>
        </div>
    </div>
</div>

<script>
// フロントページ専用JavaScript
document.addEventListener('DOMContentLoaded', function() {
    
    // スクロール進捗バー
    const progressBar = document.getElementById('scroll-progress');
    if (progressBar) {
        window.addEventListener('scroll', function() {
            const scrollPercent = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
            progressBar.style.width = Math.min(scrollPercent, 100) + '%';
        });
    }

    // トップに戻るボタン
    const backToTopBtn = document.getElementById('back-to-top');
    if (backToTopBtn) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 500) {
                backToTopBtn.classList.remove('opacity-0', 'invisible');
                backToTopBtn.classList.add('opacity-100', 'visible');
            } else {
                backToTopBtn.classList.add('opacity-0', 'invisible');
                backToTopBtn.classList.remove('opacity-100', 'visible');
            }
        });

        backToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // Cookieバナー管理
    const cookieBanner = document.getElementById('cookie-banner');
    const cookieAccept = document.getElementById('cookie-accept');
    const cookieDecline = document.getElementById('cookie-decline');

    // Cookie同意状態をチェック
    if (!localStorage.getItem('cookie-consent') && cookieBanner) {
        setTimeout(() => {
            cookieBanner.classList.remove('translate-y-full');
        }, 2000);
    }

    if (cookieAccept) {
        cookieAccept.addEventListener('click', function() {
            localStorage.setItem('cookie-consent', 'accepted');
            cookieBanner.classList.add('translate-y-full');
            
            // Google Analytics初期化（同意後）
            if (typeof gtag !== 'undefined') {
                gtag('consent', 'update', {
                    'analytics_storage': 'granted'
                });
            }
        });
    }

    if (cookieDecline) {
        cookieDecline.addEventListener('click', function() {
            localStorage.setItem('cookie-consent', 'declined');
            cookieBanner.classList.add('translate-y-full');
        });
    }

    // ページ内アンカーリンクのスムーススクロール
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                const offsetTop = target.offsetTop - 80; // ヘッダー高さ調整
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });

    // セクション要素のフェードインアニメーション
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const fadeInObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in');
                fadeInObserver.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // フェードイン対象要素を監視
    document.querySelectorAll('section, .fade-target').forEach(el => {
        el.style.opacity = '0';
        fadeInObserver.observe(el);
    });

    // パフォーマンス監視
    if ('PerformanceObserver' in window) {
        const perfObserver = new PerformanceObserver((list) => {
            list.getEntries().forEach((entry) => {
                if (entry.entryType === 'largest-contentful-paint') {
                    console.log('LCP:', entry.startTime);
                }
            });
        });
        
        try {
            perfObserver.observe({entryTypes: ['largest-contentful-paint']});
        } catch (e) {
            console.warn('Performance monitoring not supported');
        }
    }

    // エラーハンドリング
    window.addEventListener('error', function(e) {
        console.error('JavaScript Error:', e.error);
        
        // エラー報告（本番環境では外部サービスに送信）
        if (typeof gtag !== 'undefined') {
            gtag('event', 'exception', {
                'description': e.error.toString(),
                'fatal': false
            });
        }
    });

    console.log('Grant Insight Perfect - フロントページ初期化完了');
});

// CSS追加アニメーション
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-fade-in {
        opacity: 1 !important;
        animation: fadeIn 0.6s ease-out;
    }
    
    /* フローティングCTA表示制御 */
    .floating-cta.show {
        transform: translateY(0) !important;
        opacity: 1 !important;
    }
    
    /* スムーズスクロール */
    html {
        scroll-behavior: smooth;
    }
    
    /* AI Chatbot追加スタイル */
    .ai-chatbot .chatbot-toggle:focus {
        outline: 2px solid #10b981;
        outline-offset: 2px;
    }
    
    .ai-chatbot .chatbot-input:focus {
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }
`;
document.head.appendChild(style);
</script>

<?php get_footer(); ?>
