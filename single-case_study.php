<?php
/**
 * Template for displaying single grant tip posts
 * Tailwind CSS Play CDN完全対応版
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
                        100: '#fef3c7',
                        500: '#f59e0b',
                        600: '#d97706'
                    },
                    success: {
                        50: '#f0fdf4',
                        100: '#dcfce7',
                        500: '#22c55e',
                        600: '#16a34a'
                    },
                    warning: {
                        50: '#fefce8',
                        100: '#fef9c3',
                        500: '#eab308',
                        600: '#ca8a04'
                    }
                },
                animation: {
                    'fade-in': 'fadeIn 0.6s ease-out',
                    'slide-up': 'slideUp 0.8s ease-out',
                    'bounce-gentle': 'bounceGentle 1s ease-out',
                    'scale-in': 'scaleIn 0.5s ease-out',
                    'pulse-gentle': 'pulseGentle 2s ease-in-out infinite',
                    'float': 'float 3s ease-in-out infinite'
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
                    },
                    float: {
                        '0%, 100%': { transform: 'translateY(0px)' },
                        '50%': { transform: 'translateY(-10px)' }
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
                <header class="relative bg-gradient-to-br from-accent-600 via-accent-500 to-primary-700 text-white overflow-hidden">
                    <!-- 背景装飾 -->
                    <div class="absolute inset-0 bg-black/20"></div>
                    <div class="absolute inset-0 opacity-10">
                        <svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                            <defs>
                                <pattern id="hero-pattern" width="20" height="20" patternUnits="userSpaceOnUse">
                                    <circle cx="10" cy="10" r="2" fill="rgba(255,255,255,0.3)"/>
                                    <circle cx="5" cy="5" r="1" fill="rgba(255,255,255,0.2)"/>
                                    <circle cx="15" cy="15" r="1" fill="rgba(255,255,255,0.2)"/>
                                </pattern>
                            </defs>
                            <rect width="100%" height="100%" fill="url(#hero-pattern)"/>
                        </svg>
                    </div>
                    
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="absolute inset-0">
                            <?php 
                            $thumbnail_id = get_post_thumbnail_id();
                            $thumbnail_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true) ?: get_the_title();
                            ?>
                            <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" 
                                 alt="<?php echo esc_attr($thumbnail_alt); ?>"
                                 class="w-full h-full object-cover opacity-20"
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
                                               border border-white/30 hover:bg-white/30 transition-all duration-200">
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
                                               bg-accent-500/20 backdrop-blur-sm text-white text-xs font-medium
                                               border border-accent-400/30 hover:bg-accent-500/30 transition-all duration-200">
                                        #<?php echo esc_html($tag->name); ?>
                                    </span>
                                <?php 
                                    endforeach;
                                endif;
                                ?>
                            </div>

                            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight animate-float">
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
                                        <div class="text-center bg-white/10 backdrop-blur-sm rounded-2xl p-6 
                                                  border border-white/20 hover:bg-white/20 transition-all duration-300">
                                            <div class="text-sm text-white/80 mb-3 font-semibold uppercase tracking-wide">実施難易度</div>
                                            <div class="flex justify-center gap-2 mb-2">
                                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                    <div class="w-4 h-4 rounded-full transition-all duration-300 
                                                              <?php echo $i <= $difficulty_level ? 'bg-accent-400 shadow-lg' : 'bg-white/30'; ?>"></div>
                                                <?php endfor; ?>
                                            </div>
                                            <div class="text-xs text-white/70">難易度 <?php echo $difficulty_level; ?>/5</div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($importance_level) : ?>
                                        <div class="text-center bg-white/10 backdrop-blur-sm rounded-2xl p-6 
                                                  border border-white/20 hover:bg-white/20 transition-all duration-300">
                                            <div class="text-sm text-white/80 mb-3 font-semibold uppercase tracking-wide">重要度</div>
                                            <div class="flex justify-center gap-1 mb-2">
                                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                    <svg class="w-5 h-5 transition-all duration-300 
                                                              <?php echo $i <= $importance_level ? 'text-yellow-400 animate-pulse' : 'text-white/30'; ?>" 
                                                         fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                <?php endfor; ?>
                                            </div>
                                            <div class="text-xs text-white/70">重要度 <?php echo $importance_level; ?>/5</div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($success_rate) : ?>
                                        <div class="text-center bg-white/10 backdrop-blur-sm rounded-2xl p-6 
                                                  border border-white/20 hover:bg-white/20 transition-all duration-300">
                                            <div class="text-sm text-white/80 mb-3 font-semibold uppercase tracking-wide">成功率</div>
                                            <div class="text-4xl font-bold text-success-300 mb-2 animate-pulse-gentle">
                                                <?php echo esc_html($success_rate); ?>%
                                            </div>
                                            <div class="w-full bg-white/20 rounded-full h-2">
                                                <div class="bg-gradient-to-r from-success-400 to-success-300 h-2 rounded-full transition-all duration-1000" 
                                                     style="width: <?php echo $success_rate; ?>%"></div>
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
                        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8 mb-12 animate-scale-in 
                                  hover:shadow-2xl transition-all duration-300">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl 
                                          flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                このコツについて
                            </h2>
                            
                            <div class="grid gap-8 lg:grid-cols-3">
                                <?php if ($overview) : ?>
                                    <div class="lg:col-span-2">
                                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                            <div class="w-6 h-6 bg-accent-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-4 h-4 text-accent-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            概要
                                        </h3>
                                        <div class="text-gray-700 leading-relaxed prose prose-sm max-w-none">
                                            <?php echo wp_kses_post($overview); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="space-y-6">
                                    <?php if ($target_grants) : ?>
                                        <div class="bg-gradient-to-br from-primary-50 to-primary-100 rounded-2xl p-6 
                                                  border border-primary-200 hover:shadow-lg transition-all duration-300">
                                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-3">
                                                <div class="w-8 h-8 bg-primary-600 rounded-lg flex items-center justify-center shadow-md">
                                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                対象助成金
                                            </h3>
                                            <div class="text-gray-700 leading-relaxed">
                                                <?php echo wp_kses_post($target_grants); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($estimated_time) : ?>
                                        <div class="bg-gradient-to-br from-accent-50 to-accent-100 rounded-2xl p-6 
                                                  border border-accent-200 hover:shadow-lg transition-all duration-300">
                                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-3">
                                                <div class="w-8 h-8 bg-accent-600 rounded-lg flex items-center justify-center shadow-md">
                                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                実施時間目安
                                            </h3>
                                            <div class="text-3xl font-bold text-accent-600 mb-2">
                                                <?php echo esc_html($estimated_time); ?>
                                            </div>
                                            <div class="text-sm text-accent-700">
                                                効率的な申請のための推奨時間
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
                        <div class="bg-gradient-to-br from-accent-50 via-warning-50 to-accent-100 rounded-2xl 
                                  shadow-xl border border-accent-200 p-8 mb-12 animate-slide-up
                                  hover:shadow-2xl transition-all duration-300">
                            <h2 class="text-2xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-accent-500 to-accent-600 rounded-xl 
                                          flex items-center justify-center animate-pulse-gentle shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                重要ポイント
                                <div class="flex-1 h-px bg-gradient-to-r from-accent-300 to-transparent ml-4"></div>
                            </h2>
                            
                            <div class="grid gap-6 lg:grid-cols-2">
                                <?php foreach ($key_points as $index => $point) : ?>
                                    <div class="group flex items-start gap-6 bg-white/70 backdrop-blur-sm rounded-2xl p-6 
                                              hover:bg-white/90 hover:shadow-lg transition-all duration-300 
                                              border border-white/50 hover:border-accent-200">
                                        <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-accent-500 to-accent-600 
                                                  text-white rounded-xl flex items-center justify-center font-bold text-lg
                                                  group-hover:scale-110 group-hover:rotate-3 transition-all duration-300 shadow-lg">
                                            <?php echo $index + 1; ?>
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="font-bold text-gray-900 mb-3 text-lg group-hover:text-accent-700 
                                                     transition-colors duration-200">
                                                <?php echo esc_html($point['title']); ?>
                                            </h3>
                                            <p class="text-gray-700 leading-relaxed">
                                                <?php echo wp_kses_post($point['description']); ?>
                                            </p>
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
                        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8 mb-12 animate-slide-up
                                  hover:shadow-2xl transition-all duration-300">
                            <h2 class="text-2xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-success-500 to-success-600 rounded-xl 
                                          flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                実施手順
                                <div class="flex-1 h-px bg-gradient-to-r from-success-300 to-transparent ml-4"></div>
                            </h2>
                            
                            <div class="space-y-8">
                                <?php foreach ($step_by_step as $index => $step) : ?>
                                    <div class="group flex gap-8">
                                        <!-- ステップライン -->
                                        <div class="flex flex-col items-center">
                                            <div class="w-14 h-14 bg-gradient-to-br from-success-400 via-success-500 to-success-600 
                                                      rounded-2xl flex items-center justify-center text-white font-bold text-xl
                                                      group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 
                                                      shadow-lg border-4 border-white">
                                                <?php echo $index + 1; ?>
                                            </div>
                                            <?php if ($index < count($step_by_step) - 1) : ?>
                                                <div class="w-1 h-20 bg-gradient-to-b from-success-300 via-success-200 to-gray-200 mt-6 rounded-full"></div>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <!-- コンテンツ -->
                                        <div class="flex-1 pb-8">
                                            <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-8 
                                                      group-hover:from-success-50 group-hover:to-success-100 
                                                      group-hover:shadow-lg transition-all duration-300 
                                                      border border-gray-200 group-hover:border-success-200">
                                                <h3 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-success-800 
                                                         transition-colors duration-200">
                                                    <?php echo esc_html($step['title']); ?>
                                                </h3>
                                                
                                                <div class="text-gray-700 mb-6 leading-relaxed">
                                                    <?php echo wp_kses_post($step['description']); ?>
                                                </div>
                                                
                                                <?php if (!empty($step['tips'])) : ?>
                                                    <div class="bg-gradient-to-r from-primary-50 to-primary-100 border-l-4 border-primary-400 
                                                              p-6 rounded-r-xl mb-4 hover:shadow-md transition-all duration-200">
                                                        <h4 class="font-semibold text-primary-800 mb-3 flex items-center gap-2">
                                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                                            </svg>
                                                            💡 実践のコツ
                                                        </h4>
                                                        <p class="text-primary-700 leading-relaxed">
                                                            <?php echo wp_kses_post($step['tips']); ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($step['required_time'])) : ?>
                                                    <div class="flex items-center gap-3 text-sm text-gray-600 bg-white/60 
                                                              rounded-lg px-4 py-2 border border-gray-200">
                                                        <svg class="w-4 h-4 text-accent-500" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                                        </svg>
                                                        <span class="font-medium">所要時間: <?php echo esc_html($step['required_time']); ?></span>
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
                        <div class="bg-gradient-to-br from-red-50 via-orange-50 to-red-100 rounded-2xl 
                                  shadow-xl border border-red-200 p-8 mb-12 animate-slide-up
                                  hover:shadow-2xl transition-all duration-300">
                            <h2 class="text-2xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-red-600 rounded-xl 
                                          flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                ⚠️ 注意点・よくある失敗
                                <div class="flex-1 h-px bg-gradient-to-r from-red-300 to-transparent ml-4"></div>
                            </h2>
                            
                            <div class="space-y-6">
                                <?php foreach ($common_mistakes as $mistake) : ?>
                                    <div class="bg-white/80 backdrop-blur-sm border-l-4 border-red-400 rounded-r-2xl p-8
                                              hover:bg-white/95 hover:shadow-lg transition-all duration-300 group">
                                        <h3 class="font-bold text-red-800 mb-4 flex items-center gap-3 text-lg">
                                            <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                            <?php echo esc_html($mistake['title']); ?>
                                        </h3>
                                        <p class="text-red-700 mb-4 leading-relaxed text-base">
                                            <?php echo wp_kses_post($mistake['description']); ?>
                                        </p>
                                        <?php if (!empty($mistake['solution'])) : ?>
                                            <div class="bg-gradient-to-r from-success-50 to-success-100 border border-success-200 
                                                      rounded-xl p-6 hover:shadow-md transition-all duration-200">
                                                <h4 class="font-semibold text-success-800 mb-3 flex items-center gap-2">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                    </svg>
                                                    ✅ 解決策・対策
                                                </h4>
                                                <p class="text-success-700 leading-relaxed">
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
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8 md:p-12 mb-12 animate-slide-up
                              hover:shadow-2xl transition-all duration-300">
                        <div class="prose prose-lg max-w-none 
                                  prose-headings:text-gray-900 prose-headings:font-bold
                                  prose-h2:text-2xl prose-h2:mt-8 prose-h2:mb-6 prose-h2:border-b prose-h2:border-gray-200 prose-h2:pb-4
                                  prose-h3:text-xl prose-h3:mt-6 prose-h3:mb-4
                                  prose-p:text-gray-700 prose-p:leading-relaxed prose-p:mb-6
                                  prose-a:text-primary-600 prose-a:no-underline hover:prose-a:underline prose-a:font-medium
                                  prose-strong:text-gray-900 prose-strong:font-semibold
                                  prose-ul:text-gray-700 prose-ol:text-gray-700
                                  prose-li:mb-2 prose-li:leading-relaxed
                                  prose-blockquote:border-l-4 prose-blockquote:border-primary-500 
                                  prose-blockquote:bg-gradient-to-r prose-blockquote:from-primary-50 prose-blockquote:to-primary-100
                                  prose-blockquote:rounded-r-xl prose-blockquote:p-6 prose-blockquote:not-italic prose-blockquote:shadow-sm
                                  prose-code:bg-gray-100 prose-code:rounded prose-code:px-2 prose-code:py-1 prose-code:text-red-600
                                  prose-pre:bg-gray-900 prose-pre:rounded-xl prose-pre:p-6 prose-pre:shadow-lg
                                  prose-img:rounded-xl prose-img:shadow-lg prose-img:border prose-img:border-gray-200
                                  prose-table:w-full prose-th:bg-gray-50 prose-th:font-semibold prose-th:p-4
                                  prose-td:border-gray-200 prose-th:border-gray-200 prose-td:p-4">
                            <?php
                            the_content();
                            wp_link_pages(array(
                                'before' => '<div class="flex flex-wrap gap-3 mt-12 pt-8 border-t border-gray-200">',
                                'after'  => '</div>',
                                'link_before' => '<span class="inline-flex items-center px-4 py-3 rounded-xl bg-primary-100 text-primary-700 hover:bg-primary-200 hover:shadow-md transition-all duration-200 font-medium">',
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
                        <div class="mt-20 pt-12 border-t-2 border-gradient-to-r from-gray-200 to-transparent">
                            <h2 class="text-3xl font-bold text-gray-900 mb-12 text-center flex items-center justify-center gap-4">
                                <div class="w-8 h-8 bg-gradient-to-br from-accent-500 to-accent-600 rounded-lg 
                                          flex items-center justify-center shadow-lg">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                関連する申請のコツ
                            </h2>
                            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                                <?php foreach ($related_posts as $post) : setup_postdata($post); ?>
                                    <a href="<?php the_permalink(); ?>" 
                                       class="group block bg-white border border-gray-200 rounded-2xl overflow-hidden 
                                              hover:shadow-xl hover:border-accent-300 transform hover:-translate-y-3 
                                              transition-all duration-300 hover:rotate-1">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <div class="aspect-video overflow-hidden bg-gradient-to-br from-accent-100 to-primary-100">
                                                <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium')); ?>" 
                                                     alt="<?php echo esc_attr(get_the_title()); ?>"
                                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                                     loading="lazy">
                                            </div>
                                        <?php endif; ?>
                                        
                                        <div class="p-6">
                                            <?php 
                                            $difficulty = get_field('difficulty_level');
                                            if ($difficulty) :
                                            ?>
                                                <div class="flex items-center gap-3 mb-4">
                                                    <span class="text-xs text-gray-600 font-medium">難易度:</span>
                                                    <div class="flex gap-1">
                                                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                            <div class="w-3 h-3 rounded-full transition-all duration-300
                                                                      <?php echo $i <= $difficulty ? 'bg-accent-400 shadow-sm' : 'bg-gray-200'; ?>"></div>
                                                        <?php endfor; ?>
                                                    </div>
                                                    <span class="text-xs text-gray-500"><?php echo $difficulty; ?>/5</span>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <h3 class="font-bold text-gray-900 group-hover:text-accent-600 
                                                     transition-colors duration-300 mb-3 line-clamp-2 text-lg leading-tight">
                                                <?php the_title(); ?>
                                            </h3>
                                            
                                            <?php if (has_excerpt()) : ?>
                                                <p class="text-gray-600 text-sm mb-4 line-clamp-3 leading-relaxed">
                                                    <?php the_excerpt(); ?>
                                                </p>
                                            <?php endif; ?>
                                            
                                            <div class="flex items-center text-accent-600 text-sm font-semibold group-hover:text-accent-700">
                                                <span>詳しく見る</span>
                                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-2 transition-transform duration-300" 
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
                    <div class="mt-20 text-center">
                        <div class="bg-gradient-to-br from-accent-600 via-accent-500 to-primary-600 rounded-3xl p-12 text-white
                                  shadow-2xl border border-accent-400/20 relative overflow-hidden">
                            <!-- 背景装飾 -->
                            <div class="absolute inset-0 opacity-10">
                                <svg width="100%" height="100%" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                    <defs>
                                        <pattern id="cta-pattern" width="20" height="20" patternUnits="userSpaceOnUse">
                                            <circle cx="10" cy="10" r="3" fill="rgba(255,255,255,0.3)"/>
                                            <circle cx="5" cy="15" r="1" fill="rgba(255,255,255,0.2)"/>
                                            <circle cx="15" cy="5" r="1" fill="rgba(255,255,255,0.2)"/>
                                        </pattern>
                                    </defs>
                                    <rect width="100%" height="100%" fill="url(#cta-pattern)"/>
                                </svg>
                            </div>

                            <div class="relative z-10">
                                <h2 class="text-4xl font-bold mb-4 animate-float">🎯 助成金申請をサポートします</h2>
                                <p class="text-xl mb-8 opacity-90 max-w-2xl mx-auto leading-relaxed">
                                    専門家がお手伝いいたします。成功への第一歩を踏み出しましょう！
                                </p>
                                <div class="flex flex-col sm:flex-row gap-6 justify-center">
                                    <a href="/grants" 
                                       class="group inline-flex items-center justify-center px-8 py-4 bg-white text-accent-600 
                                              font-bold rounded-xl hover:bg-gray-50 transform hover:scale-105 hover:shadow-xl
                                              transition-all duration-300 border-2 border-transparent hover:border-white">
                                        <svg class="w-6 h-6 mr-3 group-hover:animate-spin" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                        </svg>
                                        助成金を探す
                                    </a>
                                    <a href="/contact" 
                                       class="group inline-flex items-center justify-center px-8 py-4 bg-transparent border-2 border-white 
                                              text-white font-bold rounded-xl hover:bg-white hover:text-accent-600 
                                              transform hover:scale-105 hover:shadow-xl transition-all duration-300">
                                        <svg class="w-6 h-6 mr-3 group-hover:animate-bounce" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd" />
                                        </svg>
                                        専門家に相談
                                    </a>
                                </div>
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
    // 動的目次生成（フローティング表示）
    const sections = document.querySelectorAll('h2, h3');
    
    if (sections.length > 3) {
        const toc = document.createElement('div');
        toc.className = `
            fixed right-8 top-1/2 transform -translate-y-1/2 
            bg-white/95 backdrop-blur-lg rounded-2xl shadow-xl border border-gray-200 
            p-6 max-h-96 overflow-y-auto z-50 hidden lg:block
            hover:bg-white transition-all duration-300 hover:shadow-2xl
        `;
        toc.innerHTML = `
            <h4 class="font-bold text-gray-900 mb-4 text-sm uppercase tracking-wide flex items-center gap-2">
                <svg class="w-4 h-4 text-accent-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                </svg>
                目次
            </h4>
        `;
        
        const tocList = document.createElement('ul');
        tocList.className = 'space-y-3';
        
        sections.forEach((section, index) => {
            if (section.tagName === 'H2') {
                section.id = `section-${index}`;
                const li = document.createElement('li');
                li.innerHTML = `
                    <a href="#section-${index}" 
                       class="block text-sm text-gray-600 hover:text-accent-600 hover:bg-accent-50 
                              transition-all duration-200 py-2 px-3 rounded-lg border-l-2 border-transparent 
                              hover:border-accent-600">
                        ${section.textContent}
                    </a>
                `;
                tocList.appendChild(li);
            }
        });
        
        toc.appendChild(tocList);
        document.body.appendChild(toc);

        // 現在のセクションをハイライト
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                const id = entry.target.getAttribute('id');
                const tocLink = toc.querySelector(`a[href="#${id}"]`);
                if (tocLink) {
                    if (entry.isIntersecting) {
                        tocLink.classList.add('text-accent-600', 'bg-accent-50', 'border-accent-600');
                        tocLink.classList.remove('text-gray-600', 'border-transparent');
                    } else {
                        tocLink.classList.remove('text-accent-600', 'bg-accent-50', 'border-accent-600');
                        tocLink.classList.add('text-gray-600', 'border-transparent');
                    }
                }
            });
        }, { threshold: 0.5 });

        sections.forEach(section => {
            if (section.id) observer.observe(section);
        });
    }

    // スムーズスクロール（改良版）
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ 
                    behavior: 'smooth', 
                    block: 'start',
                    inline: 'nearest'
                });
                
                // アニメーション効果
                target.style.transform = 'scale(1.02)';
                target.style.transition = 'transform 0.3s ease-out';
                setTimeout(() => {
                    target.style.transform = 'scale(1)';
                }, 300);
            }
        });
    });

    // 読み進み状況インジケータ（改良版）
    window.addEventListener('scroll', function() {
        const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (winScroll / height) * 100;
        
        let progressBar = document.getElementById('reading-progress');
        if (!progressBar) {
            progressBar = document.createElement('div');
            progressBar.id = 'reading-progress';
            progressBar.className = `
                fixed top-0 left-0 h-1 bg-gradient-to-r from-accent-500 via-accent-600 to-primary-600 
                z-50 transition-all duration-300 shadow-lg
            `;
            document.body.appendChild(progressBar);
        }
        progressBar.style.width = scrolled + '%';
        
        // プログレス表示
        if (scrolled > 10) {
            progressBar.style.opacity = '1';
        } else {
            progressBar.style.opacity = '0';
        }
    });

    // 成功率のアニメーション
    const successRates = document.querySelectorAll('[style*="width"]');
    const rateObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const element = entry.target;
                const width = element.style.width;
                element.style.width = '0%';
                setTimeout(() => {
                    element.style.width = width;
                    element.style.transition = 'width 2s ease-out';
                }, 500);
                rateObserver.unobserve(element);
            }
        });
    });

    successRates.forEach(rate => rateObserver.observe(rate));

    // インタラクティブ要素の強化
    const interactiveCards = document.querySelectorAll('.group');
    interactiveCards.forEach((card, index) => {
        // マウスエンター効果
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-6px) scale(1.02)';
            this.style.boxShadow = '0 25px 50px -12px rgba(0, 0, 0, 0.25)';
            this.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = '';
        });

        // 順次表示アニメーション
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });

    // パーティクル効果（ヒーローセクション）
    const hero = document.querySelector('header');
    if (hero) {
        for (let i = 0; i < 20; i++) {
            setTimeout(() => {
                const particle = document.createElement('div');
                particle.className = `
                    absolute w-2 h-2 bg-white/20 rounded-full animate-ping
                    pointer-events-none
                `;
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 2 + 's';
                particle.style.animationDuration = (Math.random() * 3 + 2) + 's';
                hero.appendChild(particle);
                
                setTimeout(() => {
                    particle.remove();
                }, 5000);
            }, i * 200);
        }
    }

    // パフォーマンス最適化
    let ticking = false;
    function updateOnScroll() {
        // スクロールに応じた処理をここに追加
        ticking = false;
    }
    
    window.addEventListener('scroll', function() {
        if (!ticking) {
            requestAnimationFrame(updateOnScroll);
            ticking = true;
        }
    });
});
</script>

<?php get_footer(); ?>
