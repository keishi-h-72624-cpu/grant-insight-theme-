<?php
/**
 * Front Page Template Part - News Section
 * 最新ニュース・お知らせセクション（Tailwind CSS対応）
 * 
 * @package Grant_Insight_Perfect
 * @version 1.0
 */

// ニュース投稿を取得
$news_args = array(
    'post_type' => 'post',
    'posts_per_page' => 6,
    'orderby' => 'date',
    'order' => 'DESC',
    'meta_query' => array(
        'relation' => 'OR',
        array(
            'key' => 'is_important_news',
            'value' => '1',
            'compare' => '='
        ),
        array(
            'key' => 'is_important_news',
            'compare' => 'NOT EXISTS'
        )
    )
);

// 重要なお知らせを優先的に表示
$important_news = get_posts(array(
    'post_type' => 'post',
    'posts_per_page' => 2,
    'meta_key' => 'is_important_news',
    'meta_value' => '1',
    'orderby' => 'date',
    'order' => 'DESC'
));

$regular_news = get_posts(array(
    'post_type' => 'post',
    'posts_per_page' => 4,
    'meta_query' => array(
        array(
            'key' => 'is_important_news',
            'compare' => 'NOT EXISTS'
        )
    ),
    'orderby' => 'date',
    'order' => 'DESC'
));

$all_news = array_merge($important_news, $regular_news);
?>

<!-- News Section -->
<section id="news-section" class="news-section py-20 bg-gradient-to-br from-white via-gray-50 to-indigo-50 relative overflow-hidden">
    <!-- 背景装飾 -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-400 rounded-full filter blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-emerald-400 rounded-full filter blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-12 animate-fade-in-up">
            <span class="inline-block px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-semibold rounded-full mb-4">
                <i class="fas fa-newspaper mr-2"></i>最新情報
            </span>
            <h2 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-gray-800 via-blue-700 to-indigo-700 bg-clip-text text-transparent mb-4">
                最新ニュース・お知らせ
            </h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                助成金・補助金に関する最新情報や重要なお知らせをチェック
            </p>
        </div>

        <?php if (!empty($all_news)) : ?>
        <!-- News Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            <?php 
            $news_count = 0;
            foreach ($all_news as $news) : 
                $news_count++;
                $is_important = get_post_meta($news->ID, 'is_important_news', true);
                $categories = get_the_category($news->ID);
                $category = !empty($categories) ? $categories[0] : null;
            ?>
            <article class="news-card group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:-translate-y-1 <?php echo $is_important ? 'ring-2 ring-red-500 ring-opacity-50' : ''; ?>">
                <?php if ($is_important) : ?>
                <div class="bg-gradient-to-r from-red-500 to-pink-500 text-white text-xs font-bold py-2 px-4 text-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>重要なお知らせ
                </div>
                <?php endif; ?>

                <div class="p-6">
                    <!-- Meta Info -->
                    <div class="flex items-center justify-between mb-3">
                        <time datetime="<?php echo get_the_date('Y-m-d', $news); ?>" class="text-sm text-gray-500">
                            <i class="far fa-calendar-alt mr-1"></i>
                            <?php echo get_the_date('Y年m月d日', $news); ?>
                        </time>
                        <?php if ($category) : ?>
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">
                            <?php echo esc_html($category->name); ?>
                        </span>
                        <?php endif; ?>
                    </div>

                    <!-- Title -->
                    <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors duration-200">
                        <?php echo esc_html($news->post_title); ?>
                    </h3>

                    <!-- Excerpt -->
                    <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                        <?php 
                        $excerpt = has_excerpt($news->ID) ? get_the_excerpt($news->ID) : wp_trim_words($news->post_content, 60, '...');
                        echo esc_html($excerpt);
                        ?>
                    </p>

                    <!-- Read More Link -->
                    <a href="<?php echo get_permalink($news->ID); ?>" class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-700 transition-colors duration-200">
                        続きを読む
                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </article>
            <?php 
                if ($news_count >= 6) break;
            endforeach; 
            ?>
        </div>

        <!-- View All News Button -->
        <div class="text-center">
            <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-full hover:from-blue-700 hover:to-indigo-700 transform hover:scale-105 transition-all duration-300 shadow-lg">
                <i class="fas fa-newspaper mr-2"></i>
                すべてのニュースを見る
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>

        <?php else : ?>
        <!-- No News Message -->
        <div class="text-center py-12">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-4">
                <i class="fas fa-newspaper text-4xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">現在お知らせはありません</h3>
            <p class="text-gray-500">新しいニュースが投稿されると、こちらに表示されます。</p>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Custom Styles for Line Clamp -->
<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fade-in-up {
    animation: fade-in-up 0.6s ease-out forwards;
}
</style>