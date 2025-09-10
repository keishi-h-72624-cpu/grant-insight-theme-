<?php
/**
 * Template for displaying single grant tip posts
 * Tailwind CSS Play CDN対応版
 */

get_header(); ?>

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
                        700: '#0369a1',
                        900: '#0c4a6e'
                    },
                    accent: {
                        50: '#fffbeb',
                        500: '#f59e0b',
                        600: '#d97706'
                    },
                    success: {
                        50: '#f0fdf4',
                        500: '#22c55e',
                        600: '#16a34a'
                    },
                    warning: {
                        50: '#fefce8',
                        500: '#eab308',
                        600: '#ca8a04'
                    }
                },
                animation: {
                    'fade-in': 'fadeIn 0.6s ease-out',
                    'slide-up': 'slideUp 0.8s ease-out',
                    'bounce-gentle': 'bounceGentle 1s ease-out',
                    'scale-in': 'scaleIn 0.5s ease-out',
                    'pulse-gentle': 'pulseGentle 2s ease-in-out infinite'
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
                    bounceGentle: {
                        '0%': { transform: 'scale(0.95)' },
                        '50%': { transform: 'scale(1.02)' },
                        '100%': { transform: 'scale(1)' }
                    },
                    scaleIn: {
                        '0%': { opacity: '0', transform: 'scale(0.9)' },
                        '100%': { opacity: '1', transform: 'scale(1)' }
                    },
                    pulseGentle: {
                        '0%, 100%': { opacity: '1' },
                        '50%': { opacity: '0.8' }
                    }
                }
            }
        }
    }
</script>

<div class="min-h-screen bg-gradient-to-br from-slate-50 to-accent-50">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('animate-fade-in'); ?>>
                
                <!-- ヒーローセクション -->
                <header class="relative bg-gradient-to-r from-accent-600 to-primary-700 text-white overflow-hidden">
                    <div class="absolute inset-0 bg-black/20"></div>
                    
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="absolute inset-0">
                            <?php 
                            $thumbnail_id = get_post_thumbnail_id();
                            $thumbnail_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true) ?: get_the_title();
                            ?>
                            <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" 
                                 alt="<?php echo esc_attr($thumbnail_alt); ?>"
                                 class="w-full h-full object-cover opacity-30"
                                 loading="eager">
                        </div>
                    <?php endif; ?>

                    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32">
                        <div class="max-w-4xl animate-slide-up">
                            <!-- カテゴリとタグ -->
                            <div class="flex flex-wrap gap-3 mb-6">
                                <?php
                                $categories = get_the_category();
                                if ($categories) :
                                    foreach ($categories as $category) :
                                ?>
                                    <span class="inline-flex items-center px-4 py-2 rounded-full 
                                               bg-white/20 backdrop-blur-sm text-white text-sm font-medium
                                               border border-white/30">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                        </svg>
                                        <?php echo esc_html($category->name); ?>
                                    </span>
                                <?php 
                                    endforeach;
                                endif;

                                $tags = get_the_tags();
                                if ($tags) :
                                    foreach (array_slice($tags, 0, 3) as $tag) :
                                ?>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full 
                                               bg-accent-500/20 backdrop-blur-sm text-white text-xs font-medium">
                                        #<?php echo esc_html($tag->name); ?>
                                    </span>
                                <?php 
                                    endforeach;
                                endif;
                                ?>
                            </div>

                            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                                <?php the_title(); ?>
                            </h1>

                            <?php if (has_excerpt()) : ?>
                                <p class="text-xl md:text-2xl text-white/90 leading-relaxed mb-8">
                                    <?php the_excerpt(); ?>
                                </p>
                            <?php endif; ?>

                            <!-- 重要度・難易度指標 -->
                            <?php 
                            $difficulty_level = get_field('difficulty_level');
                            $importance_level = get_field('importance_level');
                            $success_rate = get_field('success_rate');
                            if ($difficulty_level || $importance_level || $success_rate) :
                            ?>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
                                    <?php if ($difficulty_level) : ?>
                                        <div class="text-center">
                                            <div class="text-sm text-white/80 mb-2">実施難易度</div>
                                            <div class="flex justify-center gap-1">
                                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                    <div class="w-4 h-4 rounded-full <?php echo $i <= $difficulty_level ? 'bg-accent-400' : 'bg-white/30'; ?>"></div>
                                                <?php endfor; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($importance_level) : ?>
                                        <div class="text-center">
                                            <div class="text-sm text-white/80 mb-2">重要度</div>
                                            <div class="flex justify-center gap-1">
                                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                    <svg class="w-5 h-5 <?php echo $i <= $importance_level ? 'text-yellow-400' : 'text-white/30'; ?>" 
                                                         fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                <?php endfor; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($success_rate) : ?>
                                        <div class="text-center">
                                            <div class="text-sm text-white/80 mb-2">成功率</div>
                                            <div class="text-3xl font-bold text-success-400">
                                                <?php echo esc_html($success_rate); ?>%
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- 装飾的な要素 -->
                    <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-white to-transparent"></div>
                </header>

                <!-- メインコンテンツ -->
                <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                    
                    <!-- 概要カード -->
                    <?php 
                    $overview = get_field('overview');
                    $target_grants = get_field('target_grants');
                    $estimated_time = get_field('estimated_time');
                    if ($overview || $target_grants || $estimated_time) :
                    ?>
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mb-12 animate-scale-in">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                                <div class="w-8 h-8 bg-primary-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                このコツについて
                            </h2>
                            
                            <div class="grid gap-6 md:grid-cols-3">
                                <?php if ($overview) : ?>
                                    <div class="md:col-span-2">
                                        <h3 class="text-lg font-semibold text-gray-900 mb-3">概要</h3>
                                        <div class="text-gray-700 leading-relaxed">
                                            <?php echo wp_kses_post($overview); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="space-y-6">
                                    <?php if ($target_grants) : ?>
                                        <div class="bg-primary-50 rounded-xl p-6">
                                            <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center gap-2">
                                                <svg class="w-5 h-5 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                対象助成金
                                            </h3>
                                            <div class="text-gray-700">
                                                <?php echo wp_kses_post($target_grants); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($estimated_time) : ?>
                                        <div class="bg-accent-50 rounded-xl p-6">
                                            <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center gap-2">
                                                <svg class="w-5 h-5 text-accent-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                                </svg>
                                                実施時間目安
                                            </h3>
                                            <div class="text-2xl font-bold text-accent-600">
                                                <?php echo esc_html($estimated_time); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- 重要ポイントセクション -->
                    <?php 
                    $key_points = get_field('key_points');
                    if ($key_points) :
                    ?>
                        <div class="bg-gradient-to-br from-accent-50 to-warning-50 rounded-2xl shadow-lg border border-accent-200 p-8 mb-12 animate-slide-up">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                                <div class="w-8 h-8 bg-accent-600 rounded-lg flex items-center justify-center animate-pulse-gentle">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                重要ポイント
                            </h2>
                            
                            <div class="grid gap-4 md:grid-cols-2">
                                <?php foreach ($key_points as $index => $point) : ?>
                                    <div class="flex items-start gap-4 bg-white/60 backdrop-blur-sm rounded-xl p-6 
                                              hover:bg-white/80 transition-all duration-300 group">
                                        <div class="flex-shrink-0 w-8 h-8 bg-accent-600 text-white rounded-full 
                                                  flex items-center justify-center font-bold text-sm
                                                  group-hover:scale-110 transition-transform duration-200">
                                            <?php echo $index + 1; ?>
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="font-bold text-gray-900 mb-2"><?php echo esc_html($point['title']); ?></h3>
                                            <p class="text-gray-700 leading-relaxed"><?php echo wp_kses_post($point['description']); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- ステップバイステップガイド -->
                    <?php 
                    $step_by_step = get_field('step_by_step');
                    if ($step_by_step) :
                    ?>
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mb-12 animate-slide-up">
                            <h2 class="text-2xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                                <div class="w-8 h-8 bg-success-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                実施手順
                            </h2>
                            
                            <div class="space-y-8">
                                <?php foreach ($step_by_step as $index => $step) : ?>
                                    <div class="flex gap-6 group">
                                        <!-- ステップライン -->
                                        <div class="flex flex-col items-center">
                                            <div class="w-12 h-12 bg-gradient-to-br from-success-500 to-success-600 
                                                      rounded-full flex items-center justify-center text-white font-bold text-lg
                                                      group-hover:scale-110 transition-transform duration-200 shadow-lg">
                                                <?php echo $index + 1; ?>
                                            </div>
                                            <?php if ($index < count($step_by_step) - 1) : ?>
                                                <div class="w-0.5 h-16 bg-gradient-to-b from-success-300 to-gray-200 mt-4"></div>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <!-- コンテンツ -->
                                        <div class="flex-1 pb-8">
                                            <div class="bg-gray-50 rounded-xl p-6 group-hover:bg-gray-100 
                                                      transition-colors duration-200">
                                                <h3 class="text-xl font-bold text-gray-900 mb-3">
                                                    <?php echo esc_html($step['title']); ?>
                                                </h3>
                                                
                                                <div class="text-gray-700 mb-4 leading-relaxed">
                                                    <?php echo wp_kses_post($step['description']); ?>
                                                </div>
                                                
                                                <?php if (!empty($step['tips'])) : ?>
                                                    <div class="bg-primary-50 border-l-4 border-primary-400 p-4 rounded-r-lg">
                                                        <h4 class="font-semibold text-primary-800 mb-2 flex items-center gap-2">
                                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                                            </svg>
                                                            コツ
                                                        </h4>
                                                        <p class="text-primary-700 text-sm">
                                                            <?php echo wp_kses_post($step['tips']); ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($step['required_time'])) : ?>
                                                    <div class="mt-4 text-sm text-gray-600">
                                                        ⏱️ 所要時間: <?php echo esc_html($step['required_time']); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- 注意点・よくある失敗 -->
                    <?php 
                    $common_mistakes = get_field('common_mistakes');
                    if ($common_mistakes) :
                    ?>
                        <div class="bg-gradient-to-br from-red-50 to-orange-50 rounded-2xl shadow-lg border border-red-200 p-8 mb-12 animate-slide-up">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                                <div class="w-8 h-8 bg-red-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                注意点・よくある失敗
                            </h2>
                            
                            <div class="space-y-4">
                                <?php foreach ($common_mistakes as $mistake) : ?>
                                    <div class="bg-white/70 backdrop-blur-sm border-l-4 border-red-400 p-6 rounded-r-xl
                                              hover:bg-white/90 transition-all duration-300">
                                        <h3 class="font-bold text-red-800 mb-3 flex items-center gap-2">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                            <?php echo esc_html($mistake['title']); ?>
                                        </h3>
                                        <p class="text-red-700 mb-3">
                                            <?php echo wp_kses_post($mistake['description']); ?>
                                        </p>
                                        <?php if (!empty($mistake['solution'])) : ?>
                                            <div class="bg-success-50 border border-success-200 rounded-lg p-4">
                                                <h4 class="font-semibold text-success-800 mb-2 flex items-center gap-2">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                    </svg>
                                                    対策
                                                </h4>
                                                <p class="text-success-700 text-sm">
                                                    <?php echo wp_kses_post($mistake['solution']); ?>
                                                </p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- 主要コンテンツ -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mb-12 animate-slide-up">
                        <div class="prose prose-lg max-w-none prose-headings:text-gray-900 
                                  prose-p:text-gray-700 prose-p:leading-relaxed
                                  prose-a:text-primary-600 prose-a:no-underline hover:prose-a:underline
                                  prose-strong:text-gray-900 prose-ul:text-gray-700 prose-ol:text-gray-700
                                  prose-blockquote:border-primary-500 prose-blockquote:bg-primary-50 
                                  prose-blockquote:rounded-lg prose-blockquote:p-4">
                            <?php
                            the_content();
                            wp_link_pages(array(
                                'before' => '<div class="flex flex-wrap gap-2 mt-8 pt-6 border-t border-gray-200">',
                                'after'  => '</div>',
                                'link_before' => '<span class="inline-flex items-center px-3 py-2 rounded-lg bg-primary-100 text-primary-700 hover:bg-primary-200 transition-colors duration-200">',
                                'link_after' => '</span>',
                            ));
                            ?>
                        </div>
                    </div>

                    <!-- 関連記事 -->
                    <?php
                    $related_posts = get_posts(array(
                        'post_type' => 'grant-tip',
                        'posts_per_page' => 3,
                        'exclude' => array(get_the_ID()),
                        'meta_query' => array(
                            'relation' => 'OR',
                            array(
                                'key' => 'difficulty_level',
                                'value' => get_field('difficulty_level'),
                                'compare' => '='
                            )
                        )
                    ));
                    
                    if ($related_posts) :
                    ?>
                        <div class="mt-16 pt-12 border-t border-gray-200">
                            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">関連する申請のコツ</h2>
                            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                                <?php foreach ($related_posts as $post) : setup_postdata($post); ?>
                                    <a href="<?php the_permalink(); ?>" 
                                       class="group block bg-white border border-gray-200 rounded-xl overflow-hidden 
                                              hover:shadow-lg hover:border-accent-300 transform hover:-translate-y-2 
                                              transition-all duration-300">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <div class="aspect-video overflow-hidden">
                                                <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium')); ?>" 
                                                     alt="<?php echo esc_attr(get_the_title()); ?>"
                                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                                     loading="lazy">
                                            </div>
                                        <?php endif; ?>
                                        
                                        <div class="p-6">
                                            <?php 
                                            $difficulty = get_field('difficulty_level');
                                            if ($difficulty) :
                                            ?>
                                                <div class="flex items-center gap-2 mb-3">
                                                    <span class="text-xs text-gray-600">難易度:</span>
                                                    <div class="flex gap-1">
                                                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                            <div class="w-2 h-2 rounded-full <?php echo $i <= $difficulty ? 'bg-accent-400' : 'bg-gray-200'; ?>"></div>
                                                        <?php endfor; ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <h3 class="font-bold text-gray-900 group-hover:text-accent-600 
                                                     transition-colors duration-200 mb-3 line-clamp-2">
                                                <?php the_title(); ?>
                                            </h3>
                                            
                                            <?php if (has_excerpt()) : ?>
                                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                                    <?php the_excerpt(); ?>
                                                </p>
                                            <?php endif; ?>
                                            
                                            <div class="flex items-center text-accent-600 text-sm font-medium">
                                                <span>詳しく見る</span>
                                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-200" 
                                                     fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                    </a>
                                <?php endforeach; wp_reset_postdata(); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- CTA セクション -->
                    <div class="mt-16 text-center">
                        <div class="bg-gradient-to-r from-accent-600 to-primary-600 rounded-2xl p-12 text-white">
                            <h2 class="text-3xl font-bold mb-4">助成金申請をサポートします</h2>
                            <p class="text-xl mb-8 opacity-90">専門家がお手伝いいたします</p>
                            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                <a href="/grants" 
                                   class="inline-flex items-center px-8 py-4 bg-white text-accent-600 
                                          font-bold rounded-lg hover:bg-gray-100 transform hover:scale-105 
                                          transition-all duration-200 shadow-lg">
                                    助成金を探す
                                    <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                                <a href="/contact" 
                                   class="inline-flex items-center px-8 py-4 bg-transparent border-2 border-white 
                                          text-white font-bold rounded-lg hover:bg-white hover:text-accent-600 
                                          transform hover:scale-105 transition-all duration-200">
                                    専門家に相談
                                    <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </article>
        <?php endwhile; ?>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // 進行状況インジケータ
    const sections = document.querySelectorAll('h2, h3');
    const progressItems = [];
    
    // 目次生成（画面に固定表示）
    if (sections.length > 3) {
        const toc = document.createElement('div');
        toc.className = 'fixed right-8 top-1/2 transform -translate-y-1/2 bg-white/90 backdrop-blur-sm rounded-xl shadow-lg border border-gray-200 p-4 max-h-80 overflow-y-auto z-40 hidden lg:block';
        toc.innerHTML = '<h4 class="font-bold text-gray-900 mb-3 text-sm">目次</h4>';
        
        const tocList = document.createElement('ul');
        tocList.className = 'space-y-2';
        
        sections.forEach((section, index) => {
            if (section.tagName === 'H2') {
                section.id = `section-${index}`;
                const li = document.createElement('li');
                li.innerHTML = `<a href="#section-${index}" class="block text-sm text-gray-600 hover:text-primary-600 transition-colors duration-200 py-1">${section.textContent}</a>`;
                tocList.appendChild(li);
            }
        });
        
        toc.appendChild(tocList);
        document.body.appendChild(toc);
    }

    // スムーズスクロール
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // 読み上げ進行状況
    window.addEventListener('scroll', function() {
        const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (winScroll / height) * 100;
        
        let progressBar = document.getElementById('reading-progress');
        if (!progressBar) {
            progressBar = document.createElement('div');
            progressBar.id = 'reading-progress';
            progressBar.className = 'fixed top-0 left-0 h-1 bg-gradient-to-r from-accent-600 to-primary-600 z-50 transition-all duration-150';
            document.body.appendChild(progressBar);
        }
        progressBar.style.width = scrolled + '%';
    });

    // インタラクティブな要素の強化
    const stepCards = document.querySelectorAll('[class*="group"]');
    stepCards.forEach((card, index) => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-4px) scale(1.02)';
            this.style.boxShadow = '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)';
        });
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
            this.style.boxShadow = '';
        });
    });
});
</script>

<?php get_footer(); ?>
