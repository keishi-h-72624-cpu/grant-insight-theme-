<?php
/**
 * Template for displaying grant archive (Optimized)
 * Grant Insight Perfect - パフォーマンス最適化版アーカイブページ
 * 
 * 最適化内容:
 * - 統計情報のキャッシュ化
 * - N+1クエリの解消
 * - 最適化されたカードテンプレートの使用
 * - 不要なJavaScriptの削除
 */

// セキュリティチェック
if (!defined('ABSPATH')) {
    exit;
}

get_header(); ?>

<div class="min-h-screen bg-gray-50">
    <!-- ヒーローセクション -->
    <section class="bg-gradient-emerald text-white py-16">
        <div class="container">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white bg-opacity-20 rounded-full mb-6">
                    <span class="text-2xl">💰</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold mb-4">
                    助成金・補助金一覧
                </h1>
                <p class="text-xl text-white text-opacity-90 mb-8">
                    全国の助成金・補助金情報を都道府県別に検索
                </p>
                
                <!-- 統計情報（キャッシュ化） -->
                <div class="flex flex-wrap justify-center gap-6 md:gap-12">
                    <?php
                    // キャッシュされた統計情報を取得
                    $stats = gi_get_cached_stats();
                    ?>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-yellow-300">
                            <?php echo number_format($stats['total_grants']); ?>
                        </div>
                        <div class="text-sm md:text-base">件</div>
                        <div class="text-xs text-white text-opacity-75">助成金総数</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-green-300">
                            <?php echo number_format($stats['active_grants']); ?>
                        </div>
                        <div class="text-sm md:text-base">募集中</div>
                        <div class="text-xs text-white text-opacity-75">現在応募可能</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-orange-300">
                            <?php echo number_format($stats['prefecture_count']); ?>
                        </div>
                        <div class="text-sm md:text-base">都道府県</div>
                        <div class="text-xs text-white text-opacity-75">対応地域</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-blue-300">
                            <?php echo $stats['avg_success_rate']; ?>%
                        </div>
                        <div class="text-sm md:text-base">平均採択率</div>
                        <div class="text-xs text-white text-opacity-75">成功の目安</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- フィルターセクション -->
    <section class="py-8 bg-white shadow-sm">
        <div class="container">
            <div class="bg-gray-50 rounded-xl p-6">
                <h2 class="text-lg font-semibold mb-4">助成金を絞り込む</h2>
                
                <form id="grant-filter-form" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- 検索キーワード -->
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">
                            キーワード検索
                        </label>
                        <input type="text" 
                               id="search" 
                               name="search" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                               placeholder="助成金名や内容で検索">
                    </div>
                    
                    <!-- カテゴリ -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                            カテゴリ
                        </label>
                        <select id="category" name="category" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                            <option value="">すべてのカテゴリ</option>
                            <?php
                            $categories = get_terms(array(
                                'taxonomy' => 'grant_category',
                                'hide_empty' => true,
                            ));
                            foreach ($categories as $category) {
                                echo '<option value="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    
                    <!-- 都道府県 -->
                    <div>
                        <label for="prefecture" class="block text-sm font-medium text-gray-700 mb-2">
                            都道府県
                        </label>
                        <select id="prefecture" name="prefecture" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                            <option value="">すべての都道府県</option>
                            <?php
                            $prefectures = get_terms(array(
                                'taxonomy' => 'grant_prefecture',
                                'hide_empty' => true,
                            ));
                            foreach ($prefectures as $prefecture) {
                                echo '<option value="' . esc_attr($prefecture->slug) . '">' . esc_html($prefecture->name) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    
                    <!-- 募集状況 -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            募集状況
                        </label>
                        <select id="status" name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                            <option value="">すべて</option>
                            <option value="open">募集中</option>
                            <option value="closed">募集終了</option>
                            <option value="upcoming">募集予定</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- 助成金一覧 -->
    <section class="py-12">
        <div class="container">
            <div id="grants-container">
                <?php if (have_posts()) : ?>
                    <?php
                    // 投稿IDを収集してデータをプリフェッチ（N+1クエリ解消）
                    $post_ids = array();
                    while (have_posts()) {
                        the_post();
                        $post_ids[] = get_the_ID();
                    }
                    
                    // データをプリフェッチ
                    gi_prefetch_post_data($post_ids);
                    
                    // ループをリセット
                    rewind_posts();
                    ?>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        <?php while (have_posts()) : the_post(); ?>
                            <?php get_template_part('template-parts/cards/grant-card-optimized'); ?>
                        <?php endwhile; ?>
                    </div>
                    
                    <!-- ページネーション -->
                    <div class="flex justify-center">
                        <?php
                        the_posts_pagination(array(
                            'mid_size' => 2,
                            'prev_text' => '← 前のページ',
                            'next_text' => '次のページ →',
                            'class' => 'pagination'
                        ));
                        ?>
                    </div>
                    
                <?php else : ?>
                    <div class="text-center py-12">
                        <div class="text-6xl mb-4">🔍</div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">助成金が見つかりませんでした</h2>
                        <p class="text-gray-600 mb-6">検索条件を変更して再度お試しください。</p>
                        <a href="<?php echo get_post_type_archive_link('grant'); ?>" class="btn btn-primary">
                            すべての助成金を見る
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- ローディング表示 -->
            <div id="loading-indicator" class="hidden text-center py-8">
                <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-emerald-600"></div>
                <p class="mt-2 text-gray-600">読み込み中...</p>
            </div>
        </div>
    </section>
</div>

<!-- 最適化されたJavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.getElementById('grant-filter-form');
    const grantsContainer = document.getElementById('grants-container');
    const loadingIndicator = document.getElementById('loading-indicator');
    
    // デバウンス関数
    function debounce(func, wait) {
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
    
    // フィルター処理
    function filterGrants() {
        const formData = new FormData(filterForm);
        const params = new URLSearchParams();
        
        for (let [key, value] of formData.entries()) {
            if (value.trim() !== '') {
                params.append(key, value);
            }
        }
        
        // ローディング表示
        grantsContainer.classList.add('loading');
        loadingIndicator.classList.remove('hidden');
        
        // AJAX リクエスト
        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=gi_filter_grants&' + params.toString() + '&nonce=<?php echo wp_create_nonce('gi_ajax_nonce'); ?>'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                grantsContainer.innerHTML = data.data.html;
            } else {
                console.error('Filter error:', data.data);
            }
        })
        .catch(error => {
            console.error('Network error:', error);
        })
        .finally(() => {
            grantsContainer.classList.remove('loading');
            loadingIndicator.classList.add('hidden');
        });
    }
    
    // デバウンス付きフィルター実行
    const debouncedFilter = debounce(filterGrants, 500);
    
    // フォーム要素にイベントリスナーを追加
    filterForm.addEventListener('input', debouncedFilter);
    filterForm.addEventListener('change', debouncedFilter);
    
    // お気に入り機能
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('favorite-btn')) {
            e.preventDefault();
            const grantId = e.target.dataset.grantId;
            const isActive = e.target.classList.contains('active');
            
            fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `action=gi_toggle_favorite&grant_id=${grantId}&nonce=<?php echo wp_create_nonce('gi_ajax_nonce'); ?>`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    e.target.classList.toggle('active');
                }
            })
            .catch(error => {
                console.error('Favorite error:', error);
            });
        }
    });
});
</script>

<style>
.pagination {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    margin-top: 2rem;
}

.pagination a,
.pagination span {
    display: inline-block;
    padding: 0.5rem 1rem;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    text-decoration: none;
    color: #374151;
    transition: all 0.2s ease;
}

.pagination a:hover {
    background-color: #f3f4f6;
    border-color: #9ca3af;
}

.pagination .current {
    background-color: #059669;
    border-color: #059669;
    color: white;
}

.loading {
    opacity: 0.6;
    pointer-events: none;
}

@media (max-width: 768px) {
    .grid-cols-1.md\\:grid-cols-2.lg\\:grid-cols-3 {
        grid-template-columns: 1fr;
    }
    
    .grid-cols-1.md\\:grid-cols-2.lg\\:grid-cols-4 {
        grid-template-columns: 1fr;
    }
}
</style>

<?php get_footer(); ?>

