/**
 * Front Page JavaScript (Tailwind CSS Play CDN対応版)
 * トップページ専用のインタラクティブな演出機能
 */
(function($) {
    'use strict';

    // トップページでのみ実行されるかチェック
    if (!document.body.classList.contains('home') && !document.body.classList.contains('front-page')) {
        return; // トップページ以外では実行しない
    }

    $(document).ready(function() {
        // --- Tailwind CSS Play CDN対応 - トップページ専用機能初期化 ---
        initTailwindHeroSection();
        initTailwindGrantCards();
        initTailwindNewsletterSignup();
        initTailwindTestimonials();
        initTailwindFAQSection();
        initTailwindScrollAnimations();
        initTailwindInteractiveElements();
    });

    /**
     * Tailwind対応ヒーローセクション演出
     */
    function initTailwindHeroSection() {
        // ヒーロー動画の制御（Tailwind classes付き）
        const heroVideo = document.querySelector('.hero-video');
        if (heroVideo) {
            heroVideo.classList.add('opacity-0', 'transition-opacity', 'duration-1000');
            
            heroVideo.addEventListener('loadeddata', function() {
                this.classList.remove('opacity-0');
                this.classList.add('opacity-100');
            });

            heroVideo.addEventListener('error', function() {
                const fallbackImage = this.dataset.fallback;
                if (fallbackImage) {
                    const img = document.createElement('img');
                    img.src = fallbackImage;
                    img.className = 'hero-fallback-image w-full h-full object-cover rounded-lg shadow-xl';
                    this.parentNode.replaceChild(img, this);
                }
            });
        }

        // ヒーロー統計カウンター（Tailwind animation付き）
        const statNumbers = document.querySelectorAll('.hero-stat-number');
        if ('IntersectionObserver' in window && statNumbers.length > 0) {
            const statsObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const element = entry.target;
                        element.classList.add('animate-pulse');
                        animateTailwindCounter(element);
                        statsObserver.unobserve(element);
                    }
                });
            }, {
                threshold: 0.5
            });

            statNumbers.forEach(stat => {
                stat.classList.add('opacity-0', 'transform', 'scale-95');
                statsObserver.observe(stat);
            });
        }

        // Tailwind対応タイピングアニメーション
        const heroTitle = document.querySelector('.hero-title[data-typing]');
        if (heroTitle) {
            initTailwindTypingAnimation(heroTitle);
        }

        // ヒーローCTAボタンの演出
        $('.hero-cta-btn').addClass('transform transition-all duration-300 hover:scale-105 hover:shadow-2xl');
        
        $('.hero-cta-btn').on('click', function() {
            $(this).addClass('animate-bounce');
            setTimeout(() => {
                $(this).removeClass('animate-bounce');
            }, 1000);
        });
    }

    /**
     * Tailwind対応カウンターアニメーション
     */
    function animateTailwindCounter(element) {
        const target = parseInt(element.dataset.target || element.textContent.replace(/[^\d]/g, ''));
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;

        element.classList.remove('opacity-0', 'scale-95');
        element.classList.add('opacity-100', 'scale-100', 'transition-all', 'duration-500');

        const timer = setInterval(() => {
            current += step;
            if (current >= target) {
                current = target;
                clearInterval(timer);
                element.classList.remove('animate-pulse');
                element.classList.add('text-emerald-600', 'font-bold');
            }
            element.textContent = Math.floor(current).toLocaleString() + (element.dataset.suffix || '');
        }, 16);
    }

    /**
     * Tailwind対応タイピングアニメーション
     */
    function initTailwindTypingAnimation(element) {
        const text = element.textContent;
        const speed = 100;
        element.textContent = '';
        element.classList.add('border-r-2', 'border-emerald-500', 'animate-pulse');

        let i = 0;
        const typeTimer = setInterval(() => {
            element.textContent += text.charAt(i);
            i++;
            if (i >= text.length) {
                clearInterval(typeTimer);
                setTimeout(() => {
                    element.classList.remove('border-r-2', 'border-emerald-500', 'animate-pulse');
                    element.classList.add('text-gradient');
                }, 500);
            }
        }, speed);
    }

    /**
     * Tailwind対応助成金カード演出
     */
    function initTailwindGrantCards() {
        const grantCards = $('.grant-card, .card');
        
        // Tailwind hover effects
        grantCards.addClass('transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl');
        
        grantCards.on('mouseenter', function() {
            $(this).addClass('card-hover scale-105 shadow-emerald-500/20');
        }).on('mouseleave', function() {
            $(this).removeClass('card-hover scale-105 shadow-emerald-500/20');
        });

        // Tailwind対応お気に入り機能
        $('.favorite-btn').addClass('transition-all duration-200 hover:scale-110');
        $('.favorite-btn').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const btn = $(this);
            const postId = btn.data('post-id');
            const isFavorited = btn.hasClass('favorited');
            
            // Tailwind click animation
            btn.addClass('animate-pulse');
            setTimeout(() => btn.removeClass('animate-pulse'), 600);
            
            toggleTailwindFavorite(postId, !isFavorited, btn);
        });

        // 詳細表示ボタン（Tailwind対応）
        $('.show-details-btn').addClass('transition-all duration-200 hover:bg-emerald-600');
        $('.show-details-btn').on('click', function(e) {
            e.preventDefault();
            const card = $(this).closest('.grant-card, .card');
            const detailsPanel = card.find('.card-details');
            const btn = $(this);
            
            if (detailsPanel.hasClass('hidden')) {
                detailsPanel.removeClass('hidden opacity-0').addClass('block opacity-100');
                detailsPanel.slideDown(300);
                btn.text('詳細を隠す').addClass('bg-emerald-600 text-white');
            } else {
                detailsPanel.slideUp(300, function() {
                    $(this).removeClass('block opacity-100').addClass('hidden opacity-0');
                });
                btn.text('詳細を見る').removeClass('bg-emerald-600 text-white');
            }
        });

        // Tailwind対応シェア機能
        $('.share-btn').addClass('transition-all duration-200 hover:scale-110 hover:bg-blue-500 hover:text-white');
        $('.share-btn').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const btn = $(this);
            const url = btn.data('url');
            const title = btn.data('title');
            
            // Tailwind share animation
            btn.addClass('animate-spin');
            setTimeout(() => btn.removeClass('animate-spin'), 500);
            
            if (navigator.share) {
                navigator.share({
                    title: title,
                    url: url
                }).catch(err => console.log('共有エラー:', err));
            } else {
                navigator.clipboard.writeText(url).then(() => {
                    showTailwindNotification('URLをクリップボードにコピーしました', 'success');
                });
            }
        });
    }

    /**
     * Tailwind対応お気に入り機能
     */
    function toggleTailwindFavorite(postId, isFavorite, btn) {
        if (typeof gi_ajax === 'undefined') return;

        $.ajax({
            url: gi_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'toggle_favorite',
                post_id: postId,
                is_favorite: isFavorite,
                nonce: gi_ajax.nonce
            },
            success: function(response) {
                if (response.success) {
                    if (isFavorite) {
                        btn.addClass('favorited text-red-500').removeClass('text-gray-400');
                        btn.find('i').removeClass('far').addClass('fas');
                        showTailwindNotification('お気に入りに追加しました', 'success');
                    } else {
                        btn.removeClass('favorited text-red-500').addClass('text-gray-400');
                        btn.find('i').removeClass('fas').addClass('far');
                        showTailwindNotification('お気に入りから削除しました', 'info');
                    }
                }
            },
            error: function() {
                showTailwindNotification('お気に入りの更新に失敗しました', 'error');
            }
        });
    }

    /**
     * Tailwind対応ニュースレター登録
     */
    function initTailwindNewsletterSignup() {
        const newsletterForm = $('#newsletter-form, .newsletter-signup-form');
        
        newsletterForm.addClass('space-y-4');
        newsletterForm.find('input[type="email"]').addClass('focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200');
        newsletterForm.find('button[type="submit"]').addClass('transform transition-all duration-200 hover:scale-105 hover:shadow-lg');
        
        newsletterForm.on('submit', function(e) {
            e.preventDefault();
            
            const form = $(this);
            const email = form.find('input[type="email"]').val();
            const btn = form.find('button[type="submit"]');
            
            if (!isValidEmail(email)) {
                form.find('input[type="email"]').addClass('border-red-500 bg-red-50');
                showTailwindNotification('有効なメールアドレスを入力してください', 'error');
                return;
            }
            
            form.find('input[type="email"]').removeClass('border-red-500 bg-red-50').addClass('border-green-500 bg-green-50');
            
            // Tailwind loading state
            btn.prop('disabled', true).addClass('opacity-75 cursor-not-allowed');
            btn.html('<i class="fas fa-spinner fa-spin mr-2"></i>登録中...');
            
            submitTailwindNewsletterSignup(email).finally(() => {
                btn.prop('disabled', false).removeClass('opacity-75 cursor-not-allowed');
                btn.html('<i class="fas fa-paper-plane mr-2"></i>登録する');
            });
        });
    }

    /**
     * Tailwind対応ニュースレター登録送信
     */
    function submitTailwindNewsletterSignup(email) {
        if (typeof gi_ajax === 'undefined') {
            showTailwindNotification('登録機能が利用できません', 'error');
            return Promise.reject();
        }

        return $.ajax({
            url: gi_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'newsletter_signup',
                email: email,
                nonce: gi_ajax.nonce
            },
            success: function(response) {
                if (response.success) {
                    showTailwindNotification('ニュースレターに登録しました！', 'success');
                    $('#newsletter-form, .newsletter-signup-form')[0].reset();
                    $('#newsletter-form, .newsletter-signup-form').find('input[type="email"]').removeClass('border-green-500 bg-green-50');
                } else {
                    showTailwindNotification(response.data || '登録に失敗しました', 'error');
                }
            },
            error: function() {
                showTailwindNotification('登録処理でエラーが発生しました', 'error');
            }
        });
    }

    /**
     * Tailwind対応お客様の声スライダー
     */
    function initTailwindTestimonials() {
        const testimonialSlider = $('.testimonials-slider');
        if (!testimonialSlider.length) return;

        let currentSlide = 0;
        const slides = testimonialSlider.find('.testimonial-slide');
        const totalSlides = slides.length;

        if (totalSlides <= 1) return;

        // Tailwind navigation
        const navHtml = `
            <div class="testimonial-nav flex items-center justify-center mt-8 space-x-4">
                <button class="nav-btn prev-btn bg-white hover:bg-gray-50 border border-gray-300 rounded-full w-10 h-10 flex items-center justify-center transition-all duration-200 hover:scale-110" data-direction="prev">
                    <i class="fas fa-chevron-left text-gray-600"></i>
                </button>
                <div class="nav-dots flex space-x-2"></div>
                <button class="nav-btn next-btn bg-white hover:bg-gray-50 border border-gray-300 rounded-full w-10 h-10 flex items-center justify-center transition-all duration-200 hover:scale-110" data-direction="next">
                    <i class="fas fa-chevron-right text-gray-600"></i>
                </button>
            </div>
        `;
        testimonialSlider.after(navHtml);

        // Tailwind dots
        const dotsContainer = $('.nav-dots');
        for (let i = 0; i < totalSlides; i++) {
            dotsContainer.append(`<button class="nav-dot w-3 h-3 rounded-full bg-gray-300 hover:bg-emerald-500 transition-colors duration-200" data-slide="${i}"></button>`);
        }

        // 初期化
        slides.addClass('opacity-0 transform translate-x-full transition-all duration-500');
        showTailwindSlide(0);

        // ナビゲーション
        $('.nav-btn').on('click', function() {
            const direction = $(this).data('direction');
            if (direction === 'next') {
                currentSlide = (currentSlide + 1) % totalSlides;
            } else {
                currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            }
            showTailwindSlide(currentSlide);
        });

        $('.nav-dot').on('click', function() {
            currentSlide = parseInt($(this).data('slide'));
            showTailwindSlide(currentSlide);
        });

        // 自動スライド
        if (testimonialSlider.data('autoplay')) {
            setInterval(() => {
                currentSlide = (currentSlide + 1) % totalSlides;
                showTailwindSlide(currentSlide);
            }, 5000);
        }

        function showTailwindSlide(index) {
            slides.removeClass('opacity-100 translate-x-0').addClass('opacity-0 translate-x-full');
            slides.eq(index).removeClass('opacity-0 translate-x-full').addClass('opacity-100 translate-x-0');
            $('.nav-dot').removeClass('bg-emerald-500').addClass('bg-gray-300');
            $('.nav-dot').eq(index).removeClass('bg-gray-300').addClass('bg-emerald-500');
        }
    }

    /**
     * Tailwind対応FAQアコーディオン
     */
    function initTailwindFAQSection() {
        $('.faq-item').addClass('border border-gray-200 rounded-lg mb-4 overflow-hidden transition-all duration-300 hover:shadow-md');
        $('.faq-question').addClass('cursor-pointer p-6 hover:bg-gray-50 transition-colors duration-200');
        $('.faq-answer').addClass('px-6 pb-6 text-gray-600 border-t border-gray-200 hidden');
        $('.faq-toggle-icon').addClass('transition-transform duration-300');

        $('.faq-item').on('click', function() {
            const item = $(this);
            const answer = item.find('.faq-answer');
            const icon = item.find('.faq-toggle-icon');
            const isActive = item.hasClass('active');
            
            if (isActive) {
                answer.slideUp(300);
                icon.removeClass('rotate-180');
                item.removeClass('active border-emerald-500 bg-emerald-50');
            } else {
                // 他のFAQを閉じる
                $('.faq-item.active .faq-answer').slideUp(300);
                $('.faq-item.active .faq-toggle-icon').removeClass('rotate-180');
                $('.faq-item').removeClass('active border-emerald-500 bg-emerald-50');
                
                // 選択されたFAQを開く
                answer.slideDown(300);
                icon.addClass('rotate-180');
                item.addClass('active border-emerald-500 bg-emerald-50');
            }
        });
    }

    /**
     * Tailwind対応スクロールアニメーション
     */
    function initTailwindScrollAnimations() {
        const animatedElements = document.querySelectorAll('.animate-on-scroll');
        
        if ('IntersectionObserver' in window && animatedElements.length > 0) {
            const animationObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const element = entry.target;
                        const animationType = element.dataset.animation || 'fadeInUp';
                        
                        // Tailwind animation classes
                        switch(animationType) {
                            case 'fadeInUp':
                                element.classList.remove('opacity-0', 'translate-y-8');
                                element.classList.add('opacity-100', 'translate-y-0');
                                break;
                            case 'fadeInLeft':
                                element.classList.remove('opacity-0', '-translate-x-8');
                                element.classList.add('opacity-100', 'translate-x-0');
                                break;
                            case 'fadeInRight':
                                element.classList.remove('opacity-0', 'translate-x-8');
                                element.classList.add('opacity-100', 'translate-x-0');
                                break;
                            case 'zoomIn':
                                element.classList.remove('opacity-0', 'scale-95');
                                element.classList.add('opacity-100', 'scale-100');
                                break;
                        }
                        
                        animationObserver.unobserve(element);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            animatedElements.forEach(el => {
                // 初期状態設定
                const animationType = el.dataset.animation || 'fadeInUp';
                el.classList.add('transition-all', 'duration-700', 'ease-out');
                
                switch(animationType) {
                    case 'fadeInUp':
                        el.classList.add('opacity-0', 'translate-y-8');
                        break;
                    case 'fadeInLeft':
                        el.classList.add('opacity-0', '-translate-x-8');
                        break;
                    case 'fadeInRight':
                        el.classList.add('opacity-0', 'translate-x-8');
                        break;
                    case 'zoomIn':
                        el.classList.add('opacity-0', 'scale-95');
                        break;
                }
                
                animationObserver.observe(el);
            });
        }

        // Tailwind パララックス効果
        $(window).on('scroll', throttle(updateTailwindParallax, 16));
    }

    /**
     * Tailwind対応パララックス更新
     */
    function updateTailwindParallax() {
        const scrollTop = $(window).scrollTop();
        $('.parallax-element').each(function() {
            const element = $(this);
            const speed = element.data('speed') || 0.5;
            const yPos = -(scrollTop * speed);
            element.css('transform', `translateY(${yPos}px)`);
        });
    }

    /**
     * Tailwind対応インタラクティブ要素
     */
    function initTailwindInteractiveElements() {
        // ボタンホバー効果
        $('.btn, .button').addClass('transform transition-all duration-200 hover:scale-105 active:scale-95');
        
        // リンクホバー効果
        $('a:not(.no-hover)').addClass('transition-colors duration-200');
        
        // 画像ホバー効果
        $('.hover-zoom img, .image-hover').addClass('transform transition-all duration-300 hover:scale-110');
        
        // カード傾き効果
        $('.tilt-card').on('mouseenter', function(e) {
            const card = $(this);
            card.addClass('transform-gpu');
            
            card.on('mousemove', function(e) {
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                const rotateX = (y - centerY) / 10;
                const rotateY = (centerX - x) / 10;
                
                card.css('transform', `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.05, 1.05, 1.05)`);
            });
        }).on('mouseleave', function() {
            $(this).css('transform', 'perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)');
        });

        // プログレスバー
        $('.progress-bar').each(function() {
            const bar = $(this);
            const progress = bar.data('progress') || 0;
            bar.addClass('bg-gray-200 rounded-full h-2 overflow-hidden');
            bar.html(`<div class="bg-gradient-to-r from-emerald-500 to-teal-600 h-full rounded-full transition-all duration-1000 ease-out" style="width: 0%"></div>`);
            
            setTimeout(() => {
                bar.find('div').css('width', progress + '%');
            }, 500);
        });
    }

    /**
     * ユーティリティ関数
     */
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function throttle(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    /**
     * Tailwind対応通知システム
     */
    window.showTailwindNotification = function(message, type = 'info', duration = 5000) {
        if (!$('#tailwind-notification-container').length) {
            $('body').append('<div id="tailwind-notification-container" class="fixed top-4 right-4 z-50 space-y-3"></div>');
        }

        const iconMap = {
            'success': 'fa-check-circle text-green-500',
            'error': 'fa-exclamation-circle text-red-500',
            'warning': 'fa-exclamation-triangle text-yellow-500',
            'info': 'fa-info-circle text-blue-500'
        };

        const bgMap = {
            'success': 'bg-green-50 border-green-200',
            'error': 'bg-red-50 border-red-200',
            'warning': 'bg-yellow-50 border-yellow-200',
            'info': 'bg-blue-50 border-blue-200'
        };

        const notification = $(`
            <div class="tailwind-notification ${bgMap[type]} border rounded-lg shadow-lg p-4 max-w-sm transform translate-x-full opacity-0 transition-all duration-300">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <i class="fas ${iconMap[type]} text-lg"></i>
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-medium text-gray-800">${message}</p>
                    </div>
                    <div class="ml-4">
                        <button class="notification-close text-gray-400 hover:text-gray-600 transition-colors duration-200">
                            <i class="fas fa-times text-sm"></i>
                        </button>
                    </div>
                </div>
            </div>
        `);

        $('#tailwind-notification-container').append(notification);

        setTimeout(() => {
            notification.removeClass('translate-x-full opacity-0');
        }, 100);

        const autoRemoveTimer = setTimeout(() => {
            removeTailwindNotification(notification);
        }, duration);

        notification.find('.notification-close').on('click', () => {
            clearTimeout(autoRemoveTimer);
            removeTailwindNotification(notification);
        });

        function removeTailwindNotification(notification) {
            notification.addClass('translate-x-full opacity-0');
            setTimeout(() => {
                notification.remove();
            }, 300);
        }
    };

    // --- トップページ専用グローバルAPI（Tailwind対応版） ---
    window.FrontPageTailwind = {
        toggleFavorite: toggleTailwindFavorite,
        submitNewsletter: submitTailwindNewsletterSignup,
        showNotification: showTailwindNotification,

        addAnimationElement: function(selector) {
            const elements = document.querySelectorAll(selector);
            elements.forEach(el => {
                el.classList.add('animate-on-scroll', 'transition-all', 'duration-700', 'opacity-0', 'translate-y-8');
                
                if ('IntersectionObserver' in window) {
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                entry.target.classList.remove('opacity-0', 'translate-y-8');
                                entry.target.classList.add('opacity-100', 'translate-y-0');
                                observer.unobserve(entry.target);
                            }
                        });
                    });
                    observer.observe(el);
                }
            });
        },

        debug: function() {
            console.log('Front Page JavaScript (Tailwind CSS Play CDN Edition) Status:');
            console.log('- Tailwind Hero Section: ✅ Initialized');
            console.log('- Tailwind Grant Cards: ✅ Initialized');
            console.log('- Tailwind Newsletter Signup: ✅ Initialized');
            console.log('- Tailwind Testimonials: ✅ Initialized');
            console.log('- Tailwind FAQ Section: ✅ Initialized');
            console.log('- Tailwind Scroll Animations: ✅ Initialized');
            console.log('- Tailwind Interactive Elements: ✅ Initialized');
        }
    };

    // 下位互換性のためのエイリアス
    window.showNotification = showTailwindNotification;

})(jQuery);
