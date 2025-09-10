<?php
/**
 * Enhanced Single Post Template with TOC and Reading Progress
 * 読みやすさ向上版 - 目次、読了進捗、関連記事推奨機能付き
 * 
 * @package Grant_Insight_Perfect
 * @version 1.0-enhanced
 */

get_header(); ?>

<!-- Reading Progress Bar -->
<div id="reading-progress" class="fixed top-0 left-0 w-full h-1 bg-gray-200 z-50">
    <div id="reading-progress-bar" class="h-full bg-gradient-to-r from-blue-500 to-purple-500 transition-all duration-100" style="width: 0%"></div>
</div>

<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('animate-fade-in'); ?>>
                
                <!-- Hero Section with Enhanced Meta Info -->
                <header class="relative bg-gradient-to-r from-primary-600 to-accent-600 text-white overflow-hidden">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="absolute inset-0">
                            <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" 
                                 alt="<?php the_title_attribute(); ?>"
                                 class="w-full h-full object-cover opacity-30">
                        </div>
                    <?php endif; ?>

                    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32">
                        <div class="animate-slide-up">
                            <!-- Category and Meta -->
                            <div class="flex flex-wrap items-center gap-4 mb-6">
                                <?php 
                                $categories = get_the_category();
                                if (!empty($categories)) : ?>
                                    <span class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-semibold">
                                        <i class="fas fa-folder mr-2"></i>
                                        <?php echo esc_html($categories[0]->name); ?>
                                    </span>
                                <?php endif; ?>
                                
                                <span class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm">
                                    <i class="far fa-calendar mr-2"></i>
                                    <?php echo get_the_date(); ?>
                                </span>
                                
                                <!-- Reading Time Estimate -->
                                <?php 
                                $content = get_the_content();
                                $word_count = str_word_count(strip_tags($content));
                                $reading_time = ceil($word_count / 200); // Average 200 words per minute
                                ?>
                                <span class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm">
                                    <i class="far fa-clock mr-2"></i>
                                    読了時間: 約<?php echo $reading_time; ?>分
                                </span>
                            </div>

                            <!-- Title -->
                            <h1 class="text-3xl md:text-5xl font-bold mb-6"><?php the_title(); ?></h1>

                            <!-- Excerpt -->
                            <?php if (has_excerpt()) : ?>
                                <p class="text-xl text-white/90 leading-relaxed max-w-3xl">
                                    <?php echo get_the_excerpt(); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </header>

                <!-- Main Content Container -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                    <div class="lg:flex lg:gap-8">
                        
                        <!-- Sticky Sidebar with TOC -->
                        <aside class="lg:w-1/4 mb-8 lg:mb-0">
                            <div class="sticky top-8">
                                <!-- Table of Contents Card -->
                                <div id="table-of-contents" class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                                        <i class="fas fa-list-ul mr-2 text-blue-500"></i>
                                        目次
                                    </h3>
                                    <nav id="toc-nav" class="space-y-2">
                                        <!-- TOC items will be dynamically inserted here -->
                                    </nav>
                                </div>

                                <!-- Quick Actions -->
                                <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                                    <h3 class="text-lg font-bold text-gray-800 mb-4">クイックアクション</h3>
                                    <div class="space-y-3">
                                        <button id="share-btn" class="w-full py-2 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                                            <i class="fas fa-share-alt mr-2"></i>共有する
                                        </button>
                                        <button id="bookmark-btn" class="w-full py-2 px-4 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                                            <i class="far fa-bookmark mr-2"></i>保存する
                                        </button>
                                        <button id="print-btn" class="w-full py-2 px-4 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                                            <i class="fas fa-print mr-2"></i>印刷する
                                        </button>
                                    </div>
                                </div>

                                <!-- Reading Stats -->
                                <div class="bg-gradient-to-r from-purple-100 to-pink-100 rounded-2xl p-6">
                                    <h3 class="text-lg font-bold text-gray-800 mb-4">読了状況</h3>
                                    <div class="space-y-3">
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-600">進捗</span>
                                            <span id="reading-percentage" class="font-bold text-purple-600">0%</span>
                                        </div>
                                        <div class="w-full bg-white rounded-full h-2">
                                            <div id="sidebar-progress" class="bg-gradient-to-r from-purple-500 to-pink-500 h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-600">残り時間</span>
                                            <span id="time-remaining" class="font-bold text-purple-600">約<?php echo $reading_time; ?>分</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </aside>

                        <!-- Main Content -->
                        <main class="lg:w-3/4">
                            <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12">
                                <!-- Content Body -->
                                <div id="article-content" class="prose prose-lg max-w-none prose-emerald">
                                    <?php the_content(); ?>
                                </div>

                                <!-- Post Footer -->
                                <footer class="mt-12 pt-8 border-t border-gray-200">
                                    <!-- Tags -->
                                    <?php 
                                    $tags = get_the_tags();
                                    if ($tags) : ?>
                                        <div class="mb-6">
                                            <h3 class="text-sm font-semibold text-gray-600 mb-3">タグ:</h3>
                                            <div class="flex flex-wrap gap-2">
                                                <?php foreach ($tags as $tag) : ?>
                                                    <a href="<?php echo get_tag_link($tag->term_id); ?>" 
                                                       class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-gray-200 transition-colors">
                                                        <i class="fas fa-hashtag mr-1 text-xs"></i>
                                                        <?php echo esc_html($tag->name); ?>
                                                    </a>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Author Bio -->
                                    <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl p-6">
                                        <div class="flex items-start space-x-4">
                                            <?php echo get_avatar(get_the_author_meta('ID'), 64, '', '', array('class' => 'rounded-full')); ?>
                                            <div>
                                                <h3 class="font-bold text-gray-800">
                                                    <?php the_author(); ?>
                                                </h3>
                                                <p class="text-sm text-gray-600 mt-1">
                                                    <?php echo get_the_author_meta('description'); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </footer>
                            </div>

                            <!-- Related Posts -->
                            <?php
                            $related_posts = get_posts(array(
                                'category__in' => wp_get_post_categories($post->ID),
                                'numberposts' => 3,
                                'post__not_in' => array($post->ID)
                            ));
                            
                            if ($related_posts) : ?>
                                <div class="mt-12">
                                    <h2 class="text-2xl font-bold text-gray-800 mb-6">関連記事</h2>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        <?php foreach ($related_posts as $related) : ?>
                                            <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                                                <?php if (has_post_thumbnail($related->ID)) : ?>
                                                    <img src="<?php echo get_the_post_thumbnail_url($related->ID, 'medium'); ?>" 
                                                         alt="<?php echo esc_attr($related->post_title); ?>"
                                                         class="w-full h-48 object-cover">
                                                <?php endif; ?>
                                                <div class="p-6">
                                                    <h3 class="font-bold text-gray-800 mb-2 line-clamp-2">
                                                        <a href="<?php echo get_permalink($related->ID); ?>" class="hover:text-blue-600">
                                                            <?php echo esc_html($related->post_title); ?>
                                                        </a>
                                                    </h3>
                                                    <p class="text-sm text-gray-600 line-clamp-3">
                                                        <?php echo wp_trim_words($related->post_content, 30); ?>
                                                    </p>
                                                </div>
                                            </article>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Comments Section -->
                            <?php if (comments_open() || get_comments_number()) : ?>
                                <div class="mt-12 bg-white rounded-2xl shadow-lg p-8">
                                    <?php comments_template(); ?>
                                </div>
                            <?php endif; ?>
                        </main>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="fixed bottom-8 right-8 space-y-3 z-40">
                    <!-- Back to Top -->
                    <button id="back-to-top" class="hidden p-3 bg-blue-500 text-white rounded-full shadow-lg hover:bg-blue-600 transition-all">
                        <i class="fas fa-arrow-up"></i>
                    </button>
                </div>
            </article>
        <?php endwhile; ?>
    <?php endif; ?>
</div>

<!-- Enhanced Reading Experience JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Generate Table of Contents
    const articleContent = document.getElementById('article-content');
    const tocNav = document.getElementById('toc-nav');
    const headings = articleContent ? articleContent.querySelectorAll('h2, h3') : [];
    
    if (headings.length > 0 && tocNav) {
        headings.forEach((heading, index) => {
            // Add ID to heading for anchor links
            const headingId = 'heading-' + index;
            heading.setAttribute('id', headingId);
            
            // Create TOC item
            const tocItem = document.createElement('a');
            tocItem.href = '#' + headingId;
            tocItem.className = 'block py-2 px-3 text-sm text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors toc-item';
            
            if (heading.tagName === 'H3') {
                tocItem.className += ' pl-6';
                tocItem.innerHTML = '<i class="fas fa-chevron-right text-xs mr-2"></i>' + heading.textContent;
            } else {
                tocItem.innerHTML = heading.textContent;
            }
            
            tocNav.appendChild(tocItem);
            
            // Smooth scroll on click
            tocItem.addEventListener('click', function(e) {
                e.preventDefault();
                heading.scrollIntoView({ behavior: 'smooth', block: 'start' });
                
                // Update active state
                document.querySelectorAll('.toc-item').forEach(item => item.classList.remove('bg-blue-50', 'text-blue-600'));
                this.classList.add('bg-blue-50', 'text-blue-600');
            });
        });
    }
    
    // Reading Progress Tracking
    function updateReadingProgress() {
        const windowHeight = window.innerHeight;
        const documentHeight = document.documentElement.scrollHeight - windowHeight;
        const scrolled = window.scrollY;
        const progress = documentHeight > 0 ? (scrolled / documentHeight) * 100 : 0;
        
        // Update progress bars
        document.getElementById('reading-progress-bar').style.width = progress + '%';
        document.getElementById('sidebar-progress').style.width = progress + '%';
        document.getElementById('reading-percentage').textContent = Math.round(progress) + '%';
        
        // Update time remaining
        const wordsRemaining = Math.max(0, <?php echo $word_count; ?> * (1 - progress / 100));
        const timeRemaining = Math.ceil(wordsRemaining / 200);
        document.getElementById('time-remaining').textContent = '約' + timeRemaining + '分';
        
        // Show/hide back to top button
        const backToTop = document.getElementById('back-to-top');
        if (scrolled > 300) {
            backToTop.classList.remove('hidden');
        } else {
            backToTop.classList.add('hidden');
        }
        
        // Highlight current section in TOC
        let currentSection = null;
        headings.forEach((heading, index) => {
            const rect = heading.getBoundingClientRect();
            if (rect.top <= 100 && rect.bottom > 0) {
                currentSection = index;
            }
        });
        
        if (currentSection !== null) {
            const tocItems = document.querySelectorAll('.toc-item');
            tocItems.forEach((item, index) => {
                if (index === currentSection) {
                    item.classList.add('bg-blue-50', 'text-blue-600');
                } else {
                    item.classList.remove('bg-blue-50', 'text-blue-600');
                }
            });
        }
    }
    
    // Update on scroll
    window.addEventListener('scroll', updateReadingProgress);
    updateReadingProgress();
    
    // Back to top
    document.getElementById('back-to-top')?.addEventListener('click', function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
    
    // Share functionality
    document.getElementById('share-btn')?.addEventListener('click', function() {
        if (navigator.share) {
            navigator.share({
                title: document.title,
                url: window.location.href
            });
        } else {
            // Fallback: copy to clipboard
            navigator.clipboard.writeText(window.location.href);
            alert('URLをコピーしました！');
        }
    });
    
    // Bookmark functionality
    document.getElementById('bookmark-btn')?.addEventListener('click', function() {
        // Save to localStorage or send to server
        const bookmarks = JSON.parse(localStorage.getItem('bookmarks') || '[]');
        const currentBookmark = {
            url: window.location.href,
            title: document.title,
            date: new Date().toISOString()
        };
        
        if (!bookmarks.find(b => b.url === currentBookmark.url)) {
            bookmarks.push(currentBookmark);
            localStorage.setItem('bookmarks', JSON.stringify(bookmarks));
            this.innerHTML = '<i class="fas fa-bookmark mr-2"></i>保存済み';
            this.classList.add('bg-green-500', 'text-white');
        }
    });
    
    // Print functionality
    document.getElementById('print-btn')?.addEventListener('click', function() {
        window.print();
    });
});
</script>

<!-- Print Styles -->
<style>
@media print {
    #reading-progress,
    #table-of-contents,
    #back-to-top,
    aside,
    .no-print {
        display: none !important;
    }
    
    main {
        width: 100% !important;
    }
}

/* Line clamp utilities */
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
</style>

<?php get_footer(); ?>