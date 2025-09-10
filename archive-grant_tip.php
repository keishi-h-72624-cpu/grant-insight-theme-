<?php get_header(); ?>

<div class="container mx-auto px-4 py-8">
    <!-- ヘッダー部分 -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">申請のコツ</h1>
        <p class="text-xl text-gray-600">助成金・補助金申請を成功に導くための実践的なアドバイス集</p>
    </div>

    <!-- フィルター -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-8">
        <div class="flex flex-wrap gap-4 items-center">
            <div class="flex-1 min-w-[200px]">
                <label for="category-filter" class="block text-sm font-medium text-gray-700 mb-2">カテゴリー</label>
                <select id="category-filter" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">すべてのカテゴリー</option>
                    <?php
                    $categories = get_terms(array(
                        'taxonomy' => 'grant_tip_category',
                        'hide_empty' => false,
                    ));
                    foreach ($categories as $category) {
                        $selected = (isset($_GET['category']) && $_GET['category'] == $category->slug) ? 'selected' : '';
                        echo '<option value="' . esc_attr($category->slug) . '" ' . $selected . '>' . esc_html($category->name) . '</option>';
                    }
                    ?>
                </select>
            </div>
            
            <div class="flex-1 min-w-[200px]">
                <label for="search-tips" class="block text-sm font-medium text-gray-700 mb-2">キーワード検索</label>
                <input type="text" id="search-tips" placeholder="検索したいキーワードを入力..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            
            <div class="flex gap-3 items-end">
                <button id="search-btn" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                    検索
                </button>
                <button id="reset-btn" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors font-medium">
                    リセット
                </button>
            </div>
        </div>
    </div>

    <!-- 結果表示エリア -->
    <div id="tips-container">
        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $posts_per_page = 12;
        
        $args = array(
            'post_type' => 'grant_tip',
            'posts_per_page' => $posts_per_page,
            'paged' => $paged,
            'post_status' => 'publish'
        );

        // カテゴリーフィルター
        if (isset($_GET['category']) && !empty($_GET['category'])) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'grant_tip_category',
                    'field'    => 'slug',
                    'terms'    => sanitize_text_field($_GET['category']),
                ),
            );
        }

        // 検索フィルター
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $args['s'] = sanitize_text_field($_GET['search']);
        }

        $tips_query = new WP_Query($args);
        ?>

        <?php if ($tips_query->have_posts()) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                <?php while ($tips_query->have_posts()) : $tips_query->the_post(); ?>
                    <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg text-gray-900 mb-1">
                                        <a href="<?php the_permalink(); ?>" class="hover:text-blue-600 transition-colors">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    <?php 
                                    $categories = get_the_terms(get_the_ID(), 'grant_tip_category');
                                    if ($categories && !is_wp_error($categories)): 
                                    ?>
                                        <div class="flex flex-wrap gap-2">
                                            <?php foreach ($categories as $category): ?>
                                                <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">
                                                    <?php echo esc_html($category->name); ?>
                                                </span>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="text-gray-600 mb-4 line-clamp-3">
                                <?php echo wp_trim_words(get_the_content(), 30, '...'); ?>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <div class="text-sm text-gray-500">
                                    <time datetime="<?php echo get_the_date('c'); ?>">
                                        <?php echo get_the_date('Y年n月j日'); ?>
                                    </time>
                                </div>
                                <a href="<?php the_permalink(); ?>" 
                                   class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium text-sm transition-colors">
                                    詳しく見る
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <!-- ページネーション -->
            <div id="pagination-container">
                <div class="flex justify-center items-center space-x-2">
                    <?php
                    $big = 999999999;
                    echo paginate_links(array(
                        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                        'format' => '?paged=%#%',
                        'current' => max(1, get_query_var('paged')),
                        'total' => $tips_query->max_num_pages,
                        'prev_text' => '&laquo; 前へ',
                        'next_text' => '次へ &raquo;',
                        'type' => 'plain',
                        'before_page_number' => '<span class="px-3 py-2 mx-1 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">',
                        'after_page_number' => '</span>'
                    ));
                    ?>
                </div>
            </div>
        <?php else : ?>
            <div class="text-center py-12">
                <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.462.632-6.316 1.732C3.484 17.815 2 19.389 2 21.111V4a2 2 0 012-2h16a2 2 0 012 2v17.111c0-1.722-1.484-3.296-3.684-4.379C16.462 15.632 14.34 15 12 15s-4.462.632-6.316 1.732z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">申請のコツが見つかりませんでした</h3>
                <p class="text-gray-600 mb-6">条件を変更して再度検索してください。</p>
                <button id="reset-btn-empty" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                    検索条件をリセット
                </button>
            </div>
        <?php endif; ?>
        
        <?php wp_reset_postdata(); ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const categoryFilter = document.getElementById('category-filter');
    const searchInput = document.getElementById('search-tips');
    const searchBtn = document.getElementById('search-btn');
    const resetBtn = document.getElementById('reset-btn');
    const resetBtnEmpty = document.getElementById('reset-btn-empty');
    const tipsContainer = document.getElementById('tips-container');
    const paginationContainer = document.getElementById('pagination-container');

    let currentPage = 1;

    // 検索とフィルタリング
    function loadTips(page = 1) {
        const category = categoryFilter.value;
        const search = searchInput.value.trim();

        showToast('読み込み中...', 'info');

        const formData = new URLSearchParams({
            action: 'gi_ajax_load_grant_tips',
            nonce: gi_ajax.nonce,
            category: category,
            s: search,
            paged: page
        });

        fetch(gi_ajax.ajax_url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                tipsContainer.innerHTML = data.data.html;
                if (data.data.pagination) {
                    paginationContainer.innerHTML = data.data.pagination;
                }
                window.scrollTo({top: 0, behavior: 'smooth'});
                showToast('検索が完了しました', 'success');
            } else {
                showToast('エラーが発生しました', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('通信エラーが発生しました', 'error');
        });
    }

    // イベントリスナー
    if (searchBtn) {
        searchBtn.addEventListener('click', function() {
            currentPage = 1;
            loadTips(currentPage);
        });
    }

    if (categoryFilter) {
        categoryFilter.addEventListener('change', function() {
            currentPage = 1;
            loadTips(currentPage);
        });
    }

    if (searchInput) {
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                currentPage = 1;
                loadTips(currentPage);
            }
        });

        // デバウンス付きリアルタイム検索
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                if (this.value.trim().length >= 2 || this.value.trim().length === 0) {
                    currentPage = 1;
                    loadTips(currentPage);
                }
            }, 500);
        });
    }

    // リセット機能
    function resetFilters() {
        categoryFilter.value = '';
        searchInput.value = '';
        currentPage = 1;
        loadTips(currentPage);
    }

    if (resetBtn) {
        resetBtn.addEventListener('click', resetFilters);
    }

    if (resetBtnEmpty) {
        resetBtnEmpty.addEventListener('click', resetFilters);
    }

    // ページネーションクリック処理
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('page-numbers')) {
            e.preventDefault();
            const href = e.target.getAttribute('href');
            if (href) {
                const urlParams = new URLSearchParams(href.split('?')[1] || '');
                const page = urlParams.get('paged') || 1;
                currentPage = parseInt(page);
                loadTips(currentPage);
            }
        }
    });
});
</script>

<?php get_footer(); ?>
