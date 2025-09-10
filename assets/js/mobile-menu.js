/**
 * Mobile Menu Handler - Simplified and Error-Safe Version
 * CDN依存なし、エラーハンドリング付き
 */

(function() {
    'use strict';
    
    // デバッグモード
    const DEBUG = true;
    
    function log(message, data = null) {
        if (DEBUG) {
            if (data) {
                console.log('[Mobile Menu] ' + message, data);
            } else {
                console.log('[Mobile Menu] ' + message);
            }
        }
    }
    
    // エラーセーフな要素取得
    function safeGetElement(id) {
        try {
            const element = document.getElementById(id);
            if (!element) {
                log('Warning: Element not found: ' + id);
            }
            return element;
        } catch (e) {
            log('Error getting element: ' + id, e);
            return null;
        }
    }
    
    // メインの初期化関数
    function initMobileMenu() {
        log('Initializing mobile menu...');
        
        // 必要な要素を取得
        const menuButton = safeGetElement('mobile-menu-button');
        const closeButton = safeGetElement('mobile-menu-close-button');
        const mobileMenu = safeGetElement('mobile-menu');
        const menuOverlay = safeGetElement('mobile-menu-overlay');
        
        // 要素の存在確認
        if (!menuButton || !mobileMenu) {
            log('Critical elements missing. Menu button:', !!menuButton, 'Menu:', !!mobileMenu);
            // フォールバック: CSSのみのメニューに切り替え
            initCSSOnlyFallback();
            return;
        }
        
        log('Elements found successfully');
        
        // メニューの状態管理
        let isMenuOpen = false;
        
        // メニューを開く関数
        function openMenu() {
            try {
                log('Opening menu...');
                isMenuOpen = true;
                
                // メニューを表示
                mobileMenu.style.display = 'block';
                mobileMenu.style.transform = 'translateX(0)';
                mobileMenu.style.right = '0';
                mobileMenu.classList.add('menu-open');
                
                // オーバーレイを表示
                if (menuOverlay) {
                    menuOverlay.style.display = 'block';
                    menuOverlay.style.opacity = '1';
                    menuOverlay.classList.add('overlay-visible');
                }
                
                // body のスクロールを無効化
                document.body.style.overflow = 'hidden';
                
                // aria属性を更新
                menuButton.setAttribute('aria-expanded', 'true');
                mobileMenu.setAttribute('aria-hidden', 'false');
                
                log('Menu opened successfully');
            } catch (e) {
                log('Error opening menu:', e);
            }
        }
        
        // メニューを閉じる関数
        function closeMenu() {
            try {
                log('Closing menu...');
                isMenuOpen = false;
                
                // メニューを非表示
                mobileMenu.style.transform = 'translateX(100%)';
                mobileMenu.classList.remove('menu-open');
                
                // アニメーション後に完全非表示
                setTimeout(function() {
                    if (!isMenuOpen) {
                        mobileMenu.style.display = 'none';
                    }
                }, 300);
                
                // オーバーレイを非表示
                if (menuOverlay) {
                    menuOverlay.style.opacity = '0';
                    menuOverlay.classList.remove('overlay-visible');
                    setTimeout(function() {
                        if (!isMenuOpen) {
                            menuOverlay.style.display = 'none';
                        }
                    }, 300);
                }
                
                // body のスクロールを復元
                document.body.style.overflow = '';
                
                // aria属性を更新
                menuButton.setAttribute('aria-expanded', 'false');
                mobileMenu.setAttribute('aria-hidden', 'true');
                
                log('Menu closed successfully');
            } catch (e) {
                log('Error closing menu:', e);
            }
        }
        
        // イベントリスナーの設定（エラーセーフ）
        try {
            // メニューボタンのクリックイベント
            menuButton.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                log('Menu button clicked');
                
                if (isMenuOpen) {
                    closeMenu();
                } else {
                    openMenu();
                }
            });
            
            // 閉じるボタンのクリックイベント
            if (closeButton) {
                closeButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    log('Close button clicked');
                    closeMenu();
                });
            }
            
            // オーバーレイのクリックイベント
            if (menuOverlay) {
                menuOverlay.addEventListener('click', function() {
                    log('Overlay clicked');
                    closeMenu();
                });
            }
            
            // ESCキーで閉じる
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && isMenuOpen) {
                    log('ESC key pressed');
                    closeMenu();
                }
            });
            
            log('Event listeners attached successfully');
        } catch (e) {
            log('Error attaching event listeners:', e);
        }
        
        // 初期状態を設定
        try {
            mobileMenu.style.display = 'none';
            mobileMenu.style.transform = 'translateX(100%)';
            
            if (menuOverlay) {
                menuOverlay.style.display = 'none';
                menuOverlay.style.opacity = '0';
            }
            
            log('Initial state set successfully');
        } catch (e) {
            log('Error setting initial state:', e);
        }
    }
    
    // CSSのみのフォールバック
    function initCSSOnlyFallback() {
        log('Initializing CSS-only fallback menu');
        
        // CSSでハンバーガーメニューを制御
        const style = document.createElement('style');
        style.textContent = `
            #mobile-menu-toggle:checked ~ #mobile-menu {
                transform: translateX(0) !important;
                display: block !important;
            }
            #mobile-menu-toggle:checked ~ #mobile-menu-overlay {
                display: block !important;
                opacity: 1 !important;
            }
        `;
        document.head.appendChild(style);
        
        log('CSS-only fallback initialized');
    }
    
    // DOMContentLoaded イベント
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initMobileMenu);
    } else {
        // すでに読み込み済みの場合
        initMobileMenu();
    }
    
    // グローバルに公開（デバッグ用）
    window.MobileMenu = {
        init: initMobileMenu,
        version: '1.0.0'
    };
    
})();