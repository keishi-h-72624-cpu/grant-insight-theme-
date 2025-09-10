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
        
        // 初期化時に灰色オーバーレイを除去
        removeGrayOverlay();
        
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
                
                // まず灰色オーバーレイを除去
                removeGrayOverlay();
                
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
        
        // メニュー内のリンクを強制的にクリック可能にする
        try {
            // すべてのリンクとボタンのpointer-eventsを有効化
            const menuItems = mobileMenu.querySelectorAll('a, button, .nav-item, .menu-item');
            menuItems.forEach(function(item) {
                item.style.pointerEvents = 'auto';
                item.style.cursor = 'pointer';
                item.style.position = 'relative';
                item.style.zIndex = '10001';
                
                // タッチイベントも追加（モバイル対応）
                item.addEventListener('touchstart', function(e) {
                    // タッチイベントが正常に動作することを確認
                    log('Touch event on menu item:', this.textContent);
                }, { passive: true });
                
                // クリックイベントの強制追加
                if (item.tagName === 'A' && item.href) {
                    item.addEventListener('click', function(e) {
                        log('Menu link clicked:', this.href);
                        // デフォルトの動作を一旦停止して、確実にページ遷移
                        if (this.href && !this.href.includes('#')) {
                            e.preventDefault();
                            setTimeout(function() {
                                window.location.href = item.href;
                            }, 100);
                        }
                    });
                }
            });
            
            log('Menu items pointer-events enabled:', menuItems.length);
        } catch (e) {
            log('Error enabling menu items:', e);
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
    
    // 薄い灰色オーバーレイを強制除去
    function removeGrayOverlay() {
        log('Removing gray overlay...');
        
        // オーバーレイ系の要素を全て取得
        const overlaySelectors = [
            '.overlay',
            '.loading-overlay',
            '.modal-backdrop',
            '.menu-overlay',
            '.disabled-overlay',
            '.loading',
            '.loader-overlay',
            '[class*="overlay"]'
        ];
        
        overlaySelectors.forEach(function(selector) {
            try {
                document.querySelectorAll(selector).forEach(function(element) {
                    // mobile-menu-overlayは除外
                    if (element.id !== 'mobile-menu-overlay') {
                        // 完全に除去
                        element.style.display = 'none';
                        element.style.opacity = '0';
                        element.style.pointerEvents = 'none';
                        element.style.visibility = 'hidden';
                        element.style.zIndex = '-1';
                        
                        // クラスも削除
                        element.classList.remove('active', 'show', 'visible', 'open');
                        
                        log('Removed overlay:', selector);
                    }
                });
            } catch (e) {
                log('Error removing overlay:', e);
            }
        });
        
        // opacity が設定されている要素を復活
        document.querySelectorAll('[style*="opacity"]').forEach(function(element) {
            if (element.id === 'mobile-menu' || 
                element.closest('#mobile-menu') || 
                element.classList.contains('menu-item') ||
                element.classList.contains('nav-item')) {
                element.style.opacity = '1';
                element.style.filter = 'none';
            }
        });
        
        log('Gray overlay removal completed');
    }
    
    // グローバルな修正関数
    function fixAllPointerEvents() {
        log('Fixing all pointer-events...');
        
        // まず灰色オーバーレイを除去
        removeGrayOverlay();
        
        // すべてのナビゲーションリンクを強制的にクリック可能に
        const selectors = [
            'nav a',
            '.nav-link',
            '.nav-item',
            '#mobile-menu a',
            '#mobile-menu button',
            '.mobile-grant-link',
            '.mobile-search-link',
            'a[href]',
            'button'
        ];
        
        selectors.forEach(function(selector) {
            try {
                document.querySelectorAll(selector).forEach(function(element) {
                    element.style.pointerEvents = 'auto';
                    element.style.cursor = 'pointer';
                    element.style.userSelect = 'auto';
                });
            } catch (e) {
                log('Error fixing pointer-events for:', selector);
            }
        });
        
        // 邪魔になる可能性のあるオーバーレイを無効化
        const overlaySelectors = ['.overlay', '.loading-overlay', '.modal-backdrop'];
        overlaySelectors.forEach(function(selector) {
            try {
                document.querySelectorAll(selector).forEach(function(element) {
                    if (!element.id || element.id !== 'mobile-menu-overlay') {
                        element.style.pointerEvents = 'none';
                    }
                });
            } catch (e) {
                log('Error disabling overlay:', selector);
            }
        });
        
        log('Pointer-events fix completed');
    }
    
    // ページ読み込み後に自動実行
    setTimeout(fixAllPointerEvents, 500);
    
    // グローバルに公開（デバッグ用）
    window.MobileMenu = {
        init: initMobileMenu,
        fixPointerEvents: fixAllPointerEvents,
        removeGrayOverlay: removeGrayOverlay,
        version: '1.2.0'
    };
    
    // コンソールから手動実行可能
    window.fixMenu = function() {
        removeGrayOverlay();
        fixAllPointerEvents();
        console.log('Menu fixed! Gray overlay removed.');
    };
    
})();