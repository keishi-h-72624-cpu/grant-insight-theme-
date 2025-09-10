<?php
/**
 * Template Part for displaying the breadcrumb navigation
 * Tailwind CSS Play CDN完全対応版
 */

if ( ! function_exists( 'gi_the_breadcrumb' ) ) {
    function gi_the_breadcrumb() {
        if ( is_front_page() ) {
            return;
        }
        ?>
        <script src="https://cdn.tailwindcss.com/3.4.0"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            primary: {
                                50: '#f0f9ff',
                                100: '#e0f2fe',
                                500: '#0ea5e9',
                                600: '#0284c7',
                                700: '#0369a1'
                            },
                            emerald: {
                                50: '#ecfdf5',
                                100: '#d1fae5',
                                500: '#10b981',
                                600: '#059669',
                                700: '#047857'
                            }
                        },
                        animation: {
                            'fade-in': 'fadeIn 0.5s ease-out',
                            'slide-in': 'slideIn 0.3s ease-out'
                        },
                        keyframes: {
                            fadeIn: {
                                '0%': { opacity: '0' },
                                '100%': { opacity: '1' }
                            },
                            slideIn: {
                                '0%': { opacity: '0', transform: 'translateX(-10px)' },
                                '100%': { opacity: '1', transform: 'translateX(0)' }
                            }
                        }
                    }
                }
            }
        </script>

        <nav class="bg-white/80 backdrop-blur-sm border-b border-gray-200 py-4 animate-fade-in" 
             aria-label="パンくずリスト" role="navigation">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <ol class="flex items-center space-x-2 text-sm">
                    <!-- ホームリンク -->
                    <li class="animate-slide-in" style="animation-delay: 0.1s;">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" 
                           class="group inline-flex items-center gap-2 text-gray-600 hover:text-emerald-600 
                                  transition-all duration-200 hover:bg-emerald-50 px-3 py-2 rounded-lg">
                            <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-200" 
                                 fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-9 9a1 1 0 001.414 1.414L8 5.414V17a1 1 0 102 0V5.414l6.293 6.293a1 1 0 001.414-1.414l-9-9z"/>
                            </svg>
                            <span class="font-medium">ホーム</span>
                        </a>
                    </li>

                    <?php
                    $separator_delay = 0.2;
                    $item_delay = 0.3;

                    // セパレータ関数
                    function render_separator($delay) {
                        ?>
                        <li class="animate-slide-in" style="animation-delay: <?php echo $delay; ?>s;">
                            <div class="flex items-center px-1">
                                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </li>
                        <?php
                    }

                    // 投稿タイプのアーカイブページ
                    if ( is_post_type_archive() ) {
                        render_separator($separator_delay);
                        ?>
                        <li class="animate-slide-in" style="animation-delay: <?php echo $item_delay; ?>s;">
                            <div class="flex items-center">
                                <div class="bg-gradient-to-r from-primary-100 to-emerald-100 text-primary-700 
                                          px-4 py-2 rounded-lg font-semibold text-sm border border-primary-200">
                                    <?php echo esc_html( post_type_archive_title( '', false ) ); ?>
                                </div>
                            </div>
                        </li>
                        <?php
                    
                    // カテゴリーやタグなどのタクソノミーアーカイブページ
                    } elseif ( is_tax() || is_category() || is_tag() ) {
                        render_separator($separator_delay);
                        ?>
                        <li class="animate-slide-in" style="animation-delay: <?php echo $item_delay; ?>s;">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                                </svg>
                                <div class="bg-gradient-to-r from-emerald-100 to-teal-100 text-emerald-700 
                                          px-4 py-2 rounded-lg font-semibold text-sm border border-emerald-200">
                                    <?php echo esc_html( single_term_title( '', false ) ); ?>
                                </div>
                            </div>
                        </li>
                        <?php

                    // 個別投稿ページ
                    } elseif ( is_singular() ) {
                        global $post;
                        $post_type = get_post_type_object( get_post_type( $post ) );

                        // 投稿タイプのアーカイブへのリンク
                        if ( $post_type && $post_type->has_archive ) {
                            render_separator($separator_delay);
                            ?>
                            <li class="animate-slide-in" style="animation-delay: <?php echo $item_delay; ?>s;">
                                <a href="<?php echo esc_url( get_post_type_archive_link( $post_type->name ) ); ?>" 
                                   class="group inline-flex items-center gap-2 text-gray-600 hover:text-primary-600 
                                          transition-all duration-200 hover:bg-primary-50 px-3 py-2 rounded-lg">
                                    <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-200" 
                                         fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="font-medium"><?php echo esc_html( $post_type->label ); ?></span>
                                </a>
                            </li>
                            <?php
                            $separator_delay += 0.1;
                            $item_delay += 0.1;
                        }
                        
                        // 現在のページのタイトル
                        render_separator($separator_delay);
                        ?>
                        <li class="animate-slide-in" style="animation-delay: <?php echo $item_delay; ?>s;">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                                </svg>
                                <div class="bg-gradient-to-r from-gray-100 to-slate-100 text-gray-800 
                                          px-4 py-2 rounded-lg font-semibold text-sm border border-gray-300
                                          max-w-md truncate">
                                    <?php echo esc_html( get_the_title() ); ?>
                                </div>
                            </div>
                        </li>
                        <?php
                    
                    // 検索結果ページ
                    } elseif ( is_search() ) {
                        render_separator($separator_delay);
                        ?>
                        <li class="animate-slide-in" style="animation-delay: <?php echo $item_delay; ?>s;">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
                                </svg>
                                <div class="bg-gradient-to-r from-blue-100 to-sky-100 text-blue-700 
                                          px-4 py-2 rounded-lg font-semibold text-sm border border-blue-200">
                                    「<?php echo esc_html( get_search_query() ); ?>」の検索結果
                                </div>
                            </div>
                        </li>
                        <?php
                    
                    // 404ページ
                    } elseif ( is_404() ) {
                        render_separator($separator_delay);
                        ?>
                        <li class="animate-slide-in" style="animation-delay: <?php echo $item_delay; ?>s;">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <div class="bg-gradient-to-r from-red-100 to-pink-100 text-red-700 
                                          px-4 py-2 rounded-lg font-semibold text-sm border border-red-200">
                                    404 - ページが見つかりません
                                </div>
                            </div>
                        </li>
                        <?php
                    }
                    ?>
                </ol>
            </div>
        </nav>
        <?php
    }
}

gi_the_breadcrumb();
?>
