<?php
/**
 * Template part for displaying the news section on the front page
 * Tailwind CSS Play CDN完全対応版
 */
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
                    orange: {
                        50: '#fff7ed',
                        100: '#ffedd5',
                        500: '#f97316',
                        600: '#ea580c',
                        700: '#c2410c'
                    },
                    red: {
                        50: '#fef2f2',
                        100: '#fee2e2',
                        600: '#dc2626',
                        700: '#b91c1c'
                    }
                },
                animation: {
                    'fade-in': 'fadeIn 0.6s ease-out',
                    'slide-up': 'slideUp 0.8s ease-out',
                    'pulse-gentle': 'pulseGentle 2s ease-in-out infinite',
                    'bounce-gentle': 'bounceGentle 1s ease-out',
                    'scale-in': 'scaleIn 0.5s ease-out'
                },
                keyframes: {
                    fadeIn: {
                        '0%': { opacity: '0' },
                        '100%': { opacity: '1' }
                    },
                    slideUp: {
                        '0%': { opacity: '0', transform: 'translateY(30px)' },
                        '100%': { opacity: '1', transform: 'translateY(0)' }
                    },
                    pulseGentle: {
                        '0%, 100%': { opacity: '1' },
                        '50%': { opacity: '0.8' }
                    },
                    bounceGentle: {
                        '0%': { transform: 'scale(0.95)' },
                        '50%': { transform: 'scale(1.02)' },
                        '100%': { transform: 'scale(1)' }
                    },
                    scaleIn: {
                        '0%': { opacity: '0', transform: 'scale(0.9)' },
                        '100%': { opacity: '1', transform: 'scale(1)' }
                    }
                }
            }
        }
    }
</script>

<section class="relative py-20 bg-gradient-to-br from-gray-50 via-slate-50 to-gray-100 overflow-hidden">
    <!-- 背景装飾 -->
    <div class="absolute inset-0 opacity-5">
        <svg width="100%" height="100%" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="news-pattern" width="40" height="40" patternUnits="userSpaceOnUse">
                    <circle cx="20" cy="20" r="2" fill="rgba(249, 115, 22, 0.3)"/>
                    <circle cx="10" cy="10" r="1" fill="rgba(249, 115, 22, 0.2)"/>
                    <circle cx="30" cy="30" r="1" fill="rgba(249, 115, 22, 0.2)"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#news-pattern)"/>
        </svg>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- セクションヘッダー -->
        <div class="text-center mb-16 animate-fade-in">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-orange-500 to-red-600 
                      rounded-2xl text-white text-2xl mb-6 shadow-lg animate-bounce-gentle">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd"/>
                    <path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V9a1 1 0 00-1-1h-1v3a2 2 0 01-2 2H9.5a1.5 1.5 0 010-3H11V7a2 2 0 012-2h2z"/>
                </svg>
            </div>
            <h2 class="text-4xl font-black text-slate-800 mb-4 animate-slide-up" style="animation-delay: 0.2s;">
                📰 最新ニュース・お知らせ
            </h2>
            <p class="text-lg text-slate-600 max-w-2xl mx-auto leading-relaxed animate-slide-up" style="animation-delay: 0.4s;">
                助成金・補助金に関する最新情報、制度変更、申請期限などの重要なお知らせをお届けします。
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- メインニュース -->
            <div class="lg:col-span-2 animate-scale-in" style="animation-delay: 0.6s;">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden 
                          hover:shadow-2xl transition-all duration-300">
                    <!-- ヘッダー -->
                    <div class="bg-gradient-to-r from-orange-500 to-red-600 text-white p-8 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full transform translate-x-16 -translate-y-16"></div>
                        <div class="relative z-10">
                            <h3 class="text-2xl font-bold mb-3 flex items-center gap-3">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                重要なお知らせ
                            </h3>
                            <p class="text-orange-100">最新の制度変更や申請期限情報</p>
                        </div>
                    </div>
                    
                    <!-- ニュースリスト -->
                    <div class="p-8">
                        <?php
                        $latest_news_query = new WP_Query([
                            'post_type'      => 'post',
                            'posts_per_page' => 5,
                            'category_name'  => 'news',
                            'orderby'        => 'date',
                            'order'          => 'DESC'
                        ]);

                        if ($latest_news_query->have_posts()) :
                            $post_index = 0;
                            while ($latest_news_query->have_posts()) : 
                                $latest_news_query->the_post();
                                $animation_delay = 0.8 + ($post_index * 0.1);
                        ?>
                                <article class="group border-b border-gray-200 pb-6 mb-6 last:border-b-0 last:pb-0 last:mb-0
                                              hover:bg-gray-50 rounded-xl p-4 transition-all duration-300 animate-slide-up"
                                         style="animation-delay: <?php echo $animation_delay; ?>s;">
                                    <div class="flex items-start gap-6">
                                        <!-- 日付カード -->
                                        <div class="flex-shrink-0 text-center bg-gradient-to-br from-orange-100 to-red-100 
                                                  rounded-xl p-4 shadow-sm group-hover:shadow-md transition-all duration-300">
                                            <div class="text-orange-700 font-semibold text-sm mb-1">
                                                <?php echo get_the_date('n月'); ?>
                                            </div>
                                            <div class="text-2xl font-black text-orange-600">
                                                <?php echo get_the_date('j'); ?>
                                            </div>
                                            <div class="text-xs text-orange-600">
                                                <?php echo get_the_date('Y'); ?>
                                            </div>
                                        </div>
                                        
                                        <!-- ニュース内容 -->
                                        <div class="flex-1">
                                            <h4 class="text-lg font-semibold text-slate-800 mb-3 leading-tight
                                                     group-hover:text-orange-600 transition-colors duration-200">
                                                <a href="<?php echo esc_url(get_permalink()); ?>" class="hover:underline">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h4>
                                            <p class="text-sm text-slate-600 line-clamp-2 leading-relaxed mb-4">
                                                <?php echo get_the_excerpt(); ?>
                                            </p>
                                            <div class="flex items-center gap-4 text-xs text-slate-500">
                                                <span class="flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                                                    </svg>
                                                    <?php 
                                                    $categories = get_the_category();
                                                    if (!empty($categories)) {
                                                        echo esc_html($categories[0]->name);
                                                    }
                                                    ?>
                                                </span>
                                                <span class="flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                                    </svg>
                                                    <?php echo get_the_time('H:i'); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                        <?php
                                $post_index++;
                            endwhile;
                            wp_reset_postdata();
                        else :
                        ?>
                            <div class="text-center py-12 animate-fade-in">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">ニュースを準備中</h3>
                                <p class="text-gray-600">現在、新しいお知らせはありません。</p>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- フッター -->
                    <div class="px-8 py-6 bg-gray-50 border-t border-gray-200">
                        <a href="<?php echo esc_url(get_category_link(get_cat_ID('news'))); ?>" 
                           class="group inline-flex items-center gap-2 text-orange-600 hover:text-orange-700 
                                font-semibold transition-all duration-200 hover:bg-orange-50 px-4 py-2 rounded-lg">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                            </svg>
                            すべてのニュースを見る
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-200" 
                                 fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- サイドバー -->
            <div class="space-y-8">
                <!-- 申請期限間近 -->
                <div class="bg-gradient-to-br from-red-50 to-pink-50 border-2 border-red-200 rounded-2xl p-6 
                          animate-scale-in shadow-lg hover:shadow-xl transition-all duration-300" 
                     style="animation-delay: 1.2s;">
                    <h3 class="text-lg font-bold text-red-800 mb-6 flex items-center gap-3">
                        <svg class="w-6 h-6 text-red-600 animate-pulse-gentle" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        ⚠️ 申請期限間近
                    </h3>
                    <div class="space-y-4">
                        <?php
                        $deadline_field = 'deadline_date';
                        $status_field = 'application_status';
                        $post_type_name = 'grant';
                        $number_of_posts = 3;
                        $today_date = current_time('Ymd');

                        $args = array(
                            'post_type'      => $post_type_name,
                            'posts_per_page' => $number_of_posts,
                            'meta_key'       => $deadline_field,
                            'orderby'        => 'meta_value_num',
                            'order'          => 'ASC',
                            'meta_query'     => array(
                                'relation' => 'AND',
                                array('key' => $deadline_field, 'value' => $today_date, 'compare' => '>=', 'type' => 'NUMERIC'),
                                array('key' => $status_field, 'value' => 'open', 'compare' => '=')
                            )
                        );
                        $deadline_query = new WP_Query($args);

                        if ($deadline_query->have_posts()) :
                            while ($deadline_query->have_posts()) : $deadline_query->the_post();
                                $deadline_str = get_field($deadline_field);
                                $days_left_text = '日付エラー';
                                if ($deadline_str) {
                                    $today_obj = new DateTime(current_time('Y-m-d'));
                                    $deadline_obj = DateTime::createFromFormat('Ymd', $deadline_str);
                                    if ($deadline_obj) {
                                        if ($today_obj > $deadline_obj) continue;
                                        $interval = $today_obj->diff($deadline_obj);
                                        $days_left = $interval->days;
                                        $days_left_text = ($days_left === 0) ? '本日まで' : '残り ' . $days_left . '日';
                                    }
                                }
                        ?>
                            <div class="bg-white/70 backdrop-blur-sm p-4 rounded-xl border border-red-200 
                                      hover:bg-white transition-all duration-200">
                                <div class="text-sm font-semibold text-red-700 mb-2">
                                    <a href="<?php the_permalink(); ?>" class="hover:underline">
                                        <?php the_title(); ?>
                                    </a>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="text-xs text-red-600 font-bold">
                                        <?php echo esc_html($days_left_text); ?>
                                    </div>
                                    <div class="text-xs text-red-500">
                                        <?php echo $deadline_obj ? $deadline_obj->format('m/d') : '未定'; ?>
                                    </div>
                                </div>
                            </div>
                        <?php 
                            endwhile;
                            wp_reset_postdata();
                        else : 
                        ?>
                            <div class="bg-white/70 backdrop-blur-sm p-4 rounded-xl border border-red-200">
                                <p class="text-sm text-slate-600 text-center">現在、期限間近の助成金はありません。</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- 人気記事 -->
                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-lg hover:shadow-xl 
                          transition-all duration-300 animate-scale-in" style="animation-delay: 1.4s;">
                    <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-3">
                        <svg class="w-6 h-6 text-orange-500 animate-bounce-gentle" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/>
                        </svg>
                        🔥 人気記事
                    </h3>
                    <div class="space-y-4">
                        <?php
                        if (function_exists('wpp_get_most_viewed')) {
                            $wpp_args = array(
                                'range'       => 'all',
                                'limit'       => 3,
                                'post_type'   => 'post, guide',
                                'order_by'    => 'views',
                                'post_html' => '
                                    <div class="group p-3 rounded-lg hover:bg-gray-50 transition-all duration-200">
                                        <h4 class="text-sm font-semibold text-slate-700 mb-2 leading-tight group-hover:text-primary-600 transition-colors">
                                            <a href="{url}" class="hover:underline">{text_title}</a>
                                        </h4>
                                        <div class="flex items-center justify-between text-xs text-slate-500">
                                            <span class="flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                                </svg>
                                                {views}
                                            </span>
                                        </div>
                                    </div>'
                            );
                            wpp_get_most_viewed($wpp_args);
                        } else {
                            echo '<p class="text-sm text-slate-600 text-center py-4">人気記事を表示する準備中です。</p>';
                        }
                        ?>
                    </div>
                </div>

                <!-- ニュースレター登録 -->
                <div class="bg-gradient-to-br from-primary-600 to-indigo-700 text-white rounded-2xl p-6 
                          shadow-lg hover:shadow-xl transition-all duration-300 animate-scale-in relative overflow-hidden" 
                     style="animation-delay: 1.6s;">
                    <!-- 背景装飾 -->
                    <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full transform translate-x-8 -translate-y-8"></div>
                    
                    <div class="relative z-10">
                        <h3 class="text-lg font-bold mb-4 flex items-center gap-3">
                            <svg class="w-6 h-6 animate-bounce-gentle" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                            📧 最新情報をお届け
                        </h3>
                        <p class="text-sm text-blue-100 mb-6 leading-relaxed">
                            助成金・補助金の最新情報を週1回メールでお届けします。無料登録で見逃しを防げます！
                        </p>
                        <form class="space-y-4" onsubmit="return false;">
                            <div>
                                <input type="email" 
                                       placeholder="メールアドレス" 
                                       class="w-full px-4 py-3 rounded-lg text-slate-800 text-sm placeholder-gray-500
                                            focus:outline-none focus:ring-2 focus:ring-white/50 transition-all duration-200">
                            </div>
                            <button type="submit" 
                                    class="w-full bg-white text-primary-600 px-4 py-3 rounded-lg font-semibold text-sm 
                                         hover:bg-blue-50 hover:shadow-lg transition-all duration-200 
                                         transform hover:scale-105">
                                無料で登録する
                            </button>
                        </form>
                        <div class="text-xs text-blue-100 mt-3 text-center">
                            いつでも配信停止可能です
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ニュースレター登録フォーム
    const newsletterForm = document.querySelector('form[onsubmit="return false;"]');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            
            if (email) {
                // 成功メッセージ表示
                const button = this.querySelector('button');
                const originalText = button.textContent;
                button.textContent = '登録完了！';
                button.classList.add('bg-green-500', 'text-white');
                
                setTimeout(() => {
                    button.textContent = originalText;
                    button.classList.remove('bg-green-500', 'text-white');
                    this.reset();
                }, 2000);
            }
        });
    }

    // ニュース項目のホバーエフェクト
    const newsItems = document.querySelectorAll('article.group');
    newsItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // 期限切れ警告のカウントダウン
    const deadlineItems = document.querySelectorAll('[class*="text-red-600"]');
    deadlineItems.forEach(item => {
        if (item.textContent.includes('残り')) {
            item.classList.add('animate-pulse-gentle');
        }
    });
});
</script>


