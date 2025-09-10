<?php
/**
 * Grant Insight Perfect Theme - Front Page Template (Optimized)
 * パフォーマンス最適化版フロントページ
 * 
 * 最適化内容:
 * - 不要なJavaScriptの削除
 * - 最適化されたCSSクラスの使用
 * - 画像の遅延読み込み
 * - 軽量化されたアニメーション
 *
 * @package Grant_Insight_Perfect
 * @version 1.0-optimized
 */

get_header(); ?>

<main id="main" class="site-main bg-gray-50" role="main">

    <!-- Hero Section -->
    <section class="hero-section bg-gradient-emerald text-white py-16 md:py-24">
        <div class="container">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white bg-opacity-20 rounded-full mb-6">
                    <span class="text-2xl">🎯</span>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 fade-in">
                    助成金・補助金を<br>簡単に見つけよう
                </h1>
                <p class="text-xl md:text-2xl text-white text-opacity-90 mb-8 slide-up">
                    あなたのビジネスに最適な助成金を AI が診断します
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#grant-search" class="btn btn-primary bg-white text-emerald-600 hover:bg-gray-100">
                        助成金を検索する
                    </a>
                    <a href="/ai-diagnosis" class="btn btn-secondary border-white text-white hover:bg-white hover:text-emerald-600">
                        AI診断を受ける
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Search Section -->
    <section id="grant-search" class="py-16 bg-white">
        <div class="container">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                    助成金検索
                </h2>
                <p class="text-lg text-gray-600">
                    条件を指定して、あなたにぴったりの助成金を見つけましょう
                </p>
            </div>
            
            <div class="max-w-4xl mx-auto">
                <form id="hero-search-form" class="bg-gray-50 rounded-2xl p-6 md:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                        <!-- キーワード検索 -->
                        <div>
                            <label for="hero-search" class="block text-sm font-medium text-gray-700 mb-2">
                                キーワード
                            </label>
                            <input type="text" 
                                   id="hero-search" 
                                   name="search" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                                   placeholder="例：IT導入、設備投資">
                        </div>
                        
                        <!-- 業種 -->
                        <div>
                            <label for="hero-category" class="block text-sm font-medium text-gray-700 mb-2">
                                業種・分野
                            </label>
                            <select id="hero-category" name="category" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                <option value="">選択してください</option>
                                <?php
                                $categories = get_terms(array(
                                    'taxonomy' => 'grant_category',
                                    'hide_empty' => true,
                                    'number' => 20
                                ));
                                foreach ($categories as $category) {
                                    echo '<option value="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        
                        <!-- 地域 -->
                        <div>
                            <label for="hero-prefecture" class="block text-sm font-medium text-gray-700 mb-2">
                                都道府県
                            </label>
                            <select id="hero-prefecture" name="prefecture" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                <option value="">選択してください</option>
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
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary bg-emerald-600 text-white hover:bg-emerald-700 px-8 py-3">
                            🔍 助成金を検索
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Problems Section -->
    <section class="py-16 bg-gray-100">
        <div class="container">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                    こんなお悩みありませんか？
                </h2>
                <p class="text-lg text-gray-600">
                    助成金に関するよくある課題を解決します
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="card text-center">
                    <div class="text-4xl mb-4">😰</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">
                        どの助成金が使えるかわからない
                    </h3>
                    <p class="text-gray-600">
                        数多くある助成金の中から、自社に適用できるものを見つけるのは困難です。
                    </p>
                </div>
                
                <div class="card text-center">
                    <div class="text-4xl mb-4">📋</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">
                        申請書類の作成が複雑
                    </h3>
                    <p class="text-gray-600">
                        申請に必要な書類が多く、記入方法も複雑で時間がかかってしまいます。
                    </p>
                </div>
                
                <div class="card text-center">
                    <div class="text-4xl mb-4">⏰</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">
                        締切を見逃してしまう
                    </h3>
                    <p class="text-gray-600">
                        気づいた時には既に申請期限が過ぎていることがよくあります。
                    </p>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <p class="text-lg text-gray-700 mb-6">
                    <strong>Grant Insight</strong> なら、これらの問題をすべて解決できます！
                </p>
                <a href="/about" class="btn btn-primary">
                    詳しく見る
                </a>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-16 bg-white">
        <div class="container">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                    カテゴリから探す
                </h2>
                <p class="text-lg text-gray-600">
                    業種や目的別に助成金を探すことができます
                </p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php
                $featured_categories = get_terms(array(
                    'taxonomy' => 'grant_category',
                    'hide_empty' => true,
                    'number' => 8,
                    'orderby' => 'count',
                    'order' => 'DESC'
                ));
                
                $category_icons = array(
                    'IT・デジタル' => '💻',
                    '製造業' => '🏭',
                    '小売業' => '🛍️',
                    '飲食業' => '🍽️',
                    '建設業' => '🏗️',
                    'サービス業' => '🤝',
                    '農業' => '🌾',
                    '観光業' => '🏖️'
                );
                
                foreach ($featured_categories as $category) :
                    $icon = $category_icons[$category->name] ?? '📋';
                    $category_link = get_term_link($category);
                ?>
                <a href="<?php echo esc_url($category_link); ?>" class="card text-center hover:shadow-xl transition-all duration-300">
                    <div class="text-3xl mb-3"><?php echo $icon; ?></div>
                    <h3 class="font-semibold text-gray-800 mb-2"><?php echo esc_html($category->name); ?></h3>
                    <p class="text-sm text-gray-600"><?php echo $category->count; ?>件の助成金</p>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="py-16 bg-gray-50">
        <div class="container">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                    最新情報
                </h2>
                <p class="text-lg text-gray-600">
                    助成金に関する最新のニュースやお知らせ
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                $recent_posts = get_posts(array(
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'post_status' => 'publish'
                ));
                
                foreach ($recent_posts as $post) :
                    setup_postdata($post);
                ?>
                <article class="card">
                    <?php if (has_post_thumbnail()) : ?>
                    <div class="mb-4">
                        <?php the_post_thumbnail('medium', array('class' => 'w-full h-48 object-cover rounded-lg', 'loading' => 'lazy')); ?>
                    </div>
                    <?php endif; ?>
                    
                    <div class="text-sm text-gray-500 mb-2">
                        <?php echo get_the_date(); ?>
                    </div>
                    
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">
                        <a href="<?php the_permalink(); ?>" class="hover:text-emerald-600">
                            <?php the_title(); ?>
                        </a>
                    </h3>
                    
                    <p class="text-gray-600 mb-4">
                        <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                    </p>
                    
                    <a href="<?php the_permalink(); ?>" class="text-emerald-600 hover:text-emerald-700 font-medium">
                        続きを読む →
                    </a>
                </article>
                <?php endforeach; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>

</main>

<!-- 最適化されたJavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 検索フォームの処理
    const searchForm = document.getElementById('hero-search-form');
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(searchForm);
            const params = new URLSearchParams();
            
            for (let [key, value] of formData.entries()) {
                if (value.trim() !== '') {
                    params.append(key, value);
                }
            }
            
            // 検索結果ページに遷移
            window.location.href = '/grants/?' + params.toString();
        });
    }
    
    // スムーススクロール
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // シンプルなフェードインアニメーション
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    // アニメーション対象要素を監視
    document.querySelectorAll('.fade-in, .slide-up, .card').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
});
</script>

<?php get_footer(); ?>

