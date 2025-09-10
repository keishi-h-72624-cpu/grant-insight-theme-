<?php
/*
Template Name: 助成金申請のコツ - Tailwind CSS Play CDN対応版
*/

get_header(); ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|', true, 'right'); ?></title>
    
    <!-- Tailwind CSS Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.8s ease-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'bounce-gentle': 'bounceGentle 2s infinite',
                        'pulse-soft': 'pulseSoft 3s infinite',
                        'float': 'float 3s ease-in-out infinite',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(40px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        bounceGentle: {
                            '0%, 20%, 50%, 80%, 100%': { transform: 'translateY(0)' },
                            '40%': { transform: 'translateY(-10px)' },
                            '60%': { transform: 'translateY(-5px)' }
                        },
                        pulseSoft: {
                            '0%, 100%': { opacity: '1' },
                            '50%': { opacity: '0.7' }
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' }
                        },
                        glow: {
                            '0%': { boxShadow: '0 0 20px rgba(99, 102, 241, 0.3)' },
                            '100%': { boxShadow: '0 0 30px rgba(99, 102, 241, 0.6)' }
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class('antialiased'); ?>>

<div class="grant-tips-page bg-gradient-to-br from-gray-50 via-blue-50 to-indigo-50 min-h-screen">
    
    <!-- Hero Section -->
    <section class="hero-section bg-gradient-to-br from-indigo-900 via-purple-900 to-blue-900 text-white py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="absolute top-10 left-10 w-20 h-20 bg-cyan-300/10 rounded-full animate-float"></div>
        <div class="absolute bottom-10 right-10 w-16 h-16 bg-purple-400/10 rounded-full animate-bounce-gentle"></div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16 animate-fade-in">
                <div class="inline-flex items-center gap-3 bg-white/10 backdrop-blur-sm rounded-full px-6 py-3 mb-6 border border-white/20">
                    <i class="fas fa-lightbulb text-yellow-300 text-2xl animate-pulse"></i>
                    <span class="text-lg font-bold tracking-wider">SUCCESS TIPS</span>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black mb-6 leading-tight">
                    <span class="bg-gradient-to-r from-yellow-300 to-orange-300 bg-clip-text text-transparent">助成金申請</span><br>
                    <span class="bg-gradient-to-r from-white to-blue-200 bg-clip-text text-transparent">成功のコツ</span>
                </h1>
                <p class="text-xl md:text-2xl text-indigo-200 max-w-4xl mx-auto leading-relaxed">
                    助成金申請を成功に導くための実践的なノウハウと<br class="hidden md:block">
                    おすすめツールをご紹介します
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-16 lg:py-20 -mt-16 relative z-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">
                    
                    <!-- Main Content -->
                    <div class="lg:col-span-2 space-y-12">
                        
                        <!-- 申請前の準備 -->
                        <section class="bg-white rounded-3xl shadow-2xl p-8 lg:p-12 border border-gray-100 animate-slide-up">
                            <h2 class="text-3xl font-black text-gray-900 mb-8 flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center mr-4">
                                    <i class="fas fa-clipboard-list text-white text-xl"></i>
                                </div>
                                申請前の準備
                            </h2>
                            
                            <div class="space-y-8">
                                <div class="border-l-4 border-blue-500 pl-8 relative">
                                    <div class="absolute -left-2 top-0 w-4 h-4 bg-blue-500 rounded-full"></div>
                                    <h3 class="text-2xl font-bold mb-4 text-gray-900">事業計画の明確化</h3>
                                    <p class="text-gray-700 leading-relaxed mb-6 text-lg">
                                        助成金申請の成功には、明確で具体的な事業計画が不可欠です。目的、手段、期待される効果を詳細に記載しましょう。
                                    </p>
                                    
                                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-2xl border border-blue-200">
                                        <h4 class="font-bold text-blue-800 mb-4 flex items-center text-lg">
                                            <i class="fas fa-star text-yellow-500 mr-2"></i>
                                            おすすめツール
                                        </h4>
                                        <div class="bg-white rounded-2xl p-6 shadow-lg border border-blue-100 hover:shadow-xl transition-all duration-300">
                                            <div class="flex items-start gap-4">
                                                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                                                    <i class="fas fa-chart-line text-white text-2xl"></i>
                                                </div>
                                                <div class="flex-1">
                                                    <h5 class="text-xl font-bold text-gray-900 mb-2">事業計画書作成ツール「Bizplan」</h5>
                                                    <p class="text-gray-600 mb-4 leading-relaxed">プロ仕様の事業計画書を簡単に作成できるクラウドツール。テンプレートが豊富で初心者でも安心。</p>
                                                    <a href="#" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 transform hover:-translate-y-1" target="_blank" rel="nofollow sponsored">
                                                        詳細を見る
                                                        <i class="fas fa-external-link-alt"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="border-l-4 border-green-500 pl-8 relative">
                                    <div class="absolute -left-2 top-0 w-4 h-4 bg-green-500 rounded-full"></div>
                                    <h3 class="text-2xl font-bold mb-4 text-gray-900">必要書類の準備</h3>
                                    <p class="text-gray-700 leading-relaxed mb-6 text-lg">
                                        申請に必要な書類を事前に整理し、不備のないよう準備することが重要です。
                                    </p>
                                    
                                    <div class="grid md:grid-cols-2 gap-4">
                                        <div class="bg-white border-2 border-green-200 rounded-2xl p-4 hover:shadow-lg transition-all duration-300">
                                            <div class="flex items-center gap-3 mb-3">
                                                <i class="fas fa-file-alt text-green-500 text-xl"></i>
                                                <span class="font-bold text-gray-900">登記簿謄本</span>
                                            </div>
                                            <p class="text-sm text-gray-600">3ヶ月以内に取得</p>
                                        </div>
                                        <div class="bg-white border-2 border-green-200 rounded-2xl p-4 hover:shadow-lg transition-all duration-300">
                                            <div class="flex items-center gap-3 mb-3">
                                                <i class="fas fa-calculator text-green-500 text-xl"></i>
                                                <span class="font-bold text-gray-900">決算書</span>
                                            </div>
                                            <p class="text-sm text-gray-600">直近2期分</p>
                                        </div>
                                        <div class="bg-white border-2 border-green-200 rounded-2xl p-4 hover:shadow-lg transition-all duration-300">
                                            <div class="flex items-center gap-3 mb-3">
                                                <i class="fas fa-clipboard text-green-500 text-xl"></i>
                                                <span class="font-bold text-gray-900">事業計画書</span>
                                            </div>
                                            <p class="text-sm text-gray-600">詳細な計画書</p>
                                        </div>
                                        <div class="bg-white border-2 border-green-200 rounded-2xl p-4 hover:shadow-lg transition-all duration-300">
                                            <div class="flex items-center gap-3 mb-3">
                                                <i class="fas fa-receipt text-green-500 text-xl"></i>
                                                <span class="font-bold text-gray-900">見積書・カタログ</span>
                                            </div>
                                            <p class="text-sm text-gray-600">設備等の詳細</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- 申請書作成のポイント -->
                        <section class="bg-white rounded-3xl shadow-2xl p-8 lg:p-12 border border-gray-100 animate-slide-up">
                            <h2 class="text-3xl font-black text-gray-900 mb-8 flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mr-4">
                                    <i class="fas fa-edit text-white text-xl"></i>
                                </div>
                                申請書作成のポイント
                            </h2>
                            
                            <div class="space-y-8">
                                <div class="border-l-4 border-purple-500 pl-8 relative">
                                    <div class="absolute -left-2 top-0 w-4 h-4 bg-purple-500 rounded-full"></div>
                                    <h3 class="text-2xl font-bold mb-4 text-gray-900">効果的な文章作成</h3>
                                    <p class="text-gray-700 leading-relaxed mb-6 text-lg">
                                        審査員に伝わりやすい文章を心がけ、数値や具体例を用いて説得力を高めましょう。
                                    </p>
                                    
                                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-6 rounded-2xl border border-purple-200">
                                        <h4 class="font-bold text-purple-800 mb-4 flex items-center text-lg">
                                            <i class="fas fa-magic text-purple-600 mr-2"></i>
                                            おすすめツール
                                        </h4>
                                        <div class="bg-white rounded-2xl p-6 shadow-lg border border-purple-100 hover:shadow-xl transition-all duration-300">
                                            <div class="flex items-start gap-4">
                                                <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                                                    <i class="fas fa-spell-check text-white text-2xl"></i>
                                                </div>
                                                <div class="flex-1">
                                                    <h5 class="text-xl font-bold text-gray-900 mb-2">文章校正ツール「Grammarly」</h5>
                                                    <p class="text-gray-600 mb-4 leading-relaxed">AI搭載の高精度文章校正・改善ツール。文法チェックから表現の改善まで総合サポート。</p>
                                                    <a href="#" class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-500 to-pink-600 hover:from-purple-600 hover:to-pink-700 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 transform hover:-translate-y-1" target="_blank" rel="nofollow sponsored">
                                                        詳細を見る
                                                        <i class="fas fa-external-link-alt"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="border-l-4 border-yellow-500 pl-8 relative">
                                    <div class="absolute -left-2 top-0 w-4 h-4 bg-yellow-500 rounded-full"></div>
                                    <h3 class="text-2xl font-bold mb-4 text-gray-900">図表・資料の活用</h3>
                                    <p class="text-gray-700 leading-relaxed mb-6 text-lg">
                                        文字だけでなく、図表やグラフを効果的に使用することで、申請内容をより分かりやすく伝えることができます。
                                    </p>
                                    
                                    <div class="grid md:grid-cols-3 gap-4">
                                        <div class="bg-gradient-to-br from-yellow-50 to-orange-50 border-2 border-yellow-200 rounded-2xl p-6 text-center hover:shadow-lg transition-all duration-300">
                                            <i class="fas fa-chart-bar text-yellow-600 text-3xl mb-4"></i>
                                            <h4 class="font-bold text-gray-900 mb-2">グラフ</h4>
                                            <p class="text-gray-600 text-sm">数値データを視覚的に表現</p>
                                        </div>
                                        <div class="bg-gradient-to-br from-yellow-50 to-orange-50 border-2 border-yellow-200 rounded-2xl p-6 text-center hover:shadow-lg transition-all duration-300">
                                            <i class="fas fa-table text-yellow-600 text-3xl mb-4"></i>
                                            <h4 class="font-bold text-gray-900 mb-2">表</h4>
                                            <p class="text-gray-600 text-sm">情報を整理して一覧化</p>
                                        </div>
                                        <div class="bg-gradient-to-br from-yellow-50 to-orange-50 border-2 border-yellow-200 rounded-2xl p-6 text-center hover:shadow-lg transition-all duration-300">
                                            <i class="fas fa-images text-yellow-600 text-3xl mb-4"></i>
                                            <h4 class="font-bold text-gray-900 mb-2">図・写真</h4>
                                            <p class="text-gray-600 text-sm">具体的なイメージを提供</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- 申請後のフォロー -->
                        <section class="bg-white rounded-3xl shadow-2xl p-8 lg:p-12 border border-gray-100 animate-slide-up">
                            <h2 class="text-3xl font-black text-gray-900 mb-8 flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-600 rounded-2xl flex items-center justify-center mr-4">
                                    <i class="fas fa-tasks text-white text-xl"></i>
                                </div>
                                申請後のフォロー
                            </h2>
                            
                            <p class="text-gray-700 leading-relaxed mb-8 text-lg">
                                申請後も適切なフォローアップが重要です。進捗確認や追加資料の提出に迅速に対応しましょう。
                            </p>
                            
                            <div class="bg-gradient-to-r from-orange-50 to-red-50 p-6 rounded-2xl border border-orange-200">
                                <h4 class="font-bold text-orange-800 mb-4 flex items-center text-lg">
                                    <i class="fas fa-rocket text-orange-600 mr-2"></i>
                                    おすすめツール
                                </h4>
                                <div class="bg-white rounded-2xl p-6 shadow-lg border border-orange-100 hover:shadow-xl transition-all duration-300">
                                    <div class="flex items-start gap-4">
                                        <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-red-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-project-diagram text-white text-2xl"></i>
                                        </div>
                                        <div class="flex-1">
                                            <h5 class="text-xl font-bold text-gray-900 mb-2">プロジェクト管理ツール「Notion」</h5>
                                            <p class="text-gray-600 mb-4 leading-relaxed">申請進捗や必要書類を一元管理できるオールインワンツール。チームでの情報共有も簡単。</p>
                                            <a href="#" class="inline-flex items-center gap-2 bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 transform hover:-translate-y-1" target="_blank" rel="nofollow sponsored">
                                                詳細を見る
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-8 lg:sticky lg:top-24">
                        <!-- AI診断CTA -->
                        <div class="bg-gradient-to-br from-blue-500 via-purple-600 to-pink-600 text-white rounded-3xl p-8 shadow-2xl animate-glow">
                            <div class="text-center">
                                <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-6">
                                    <i class="fas fa-robot text-white text-3xl animate-bounce-gentle"></i>
                                </div>
                                <h3 class="text-2xl font-black mb-4">AI診断で最適な助成金を発見</h3>
                                <p class="text-lg mb-6 opacity-90">
                                    あなたの事業に最適な助成金をAIが瞬時に診断します
                                </p>
                                <a href="<?php echo home_url('/ai/diagnosis/'); ?>" class="inline-flex items-center gap-3 bg-white hover:bg-gray-100 text-purple-600 font-bold py-4 px-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 w-full justify-center">
                                    <i class="fas fa-robot text-2xl"></i>
                                    無料診断を開始
                                </a>
                            </div>
                        </div>

                        <!-- 関連記事 -->
                        <div class="bg-white rounded-3xl shadow-2xl p-8 border border-gray-100">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                <i class="fas fa-bookmark text-indigo-500 mr-3"></i>
                                関連記事
                            </h3>
                            <div class="space-y-6">
                                <?php
                                $related_posts = get_posts([
                                    'post_type' => ['guide', 'case_study'],
                                    'posts_per_page' => 3,
                                    'orderby' => 'date',
                                    'order' => 'DESC'
                                ]);
                                
                                if($related_posts):
                                    foreach ($related_posts as $post):
                                        setup_postdata($post);
                                ?>
                                <div class="border-2 border-gray-100 hover:border-indigo-300 rounded-2xl p-4 transition-all duration-300 hover:shadow-lg">
                                    <h4 class="font-bold text-gray-900 mb-2 hover:text-indigo-600 transition-colors">
                                        <a href="<?php the_permalink(); ?>" class="block">
                                            <?php the_title(); ?>
                                        </a>
                                    </h4>
                                    <p class="text-gray-600 text-sm leading-relaxed">
                                        <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                                    </p>
                                    <div class="mt-3">
                                        <a href="<?php the_permalink(); ?>" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                            続きを読む →
                                        </a>
                                    </div>
                                </div>
                                <?php 
                                    endforeach; 
                                    wp_reset_postdata(); 
                                else:
                                ?>
                                <div class="text-center py-8">
                                    <i class="fas fa-book text-gray-300 text-4xl mb-4"></i>
                                    <p class="text-gray-500">関連記事はありません</p>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- ツール一覧CTA -->
                        <div class="bg-gray-50 hover:bg-gray-100 rounded-3xl p-8 border-2 border-gray-200 hover:border-indigo-300 transition-all duration-300 hover:shadow-lg">
                            <div class="text-center">
                                <div class="w-16 h-16 bg-gradient-to-r from-gray-500 to-gray-700 rounded-2xl flex items-center justify-center mx-auto mb-6">
                                    <i class="fas fa-tools text-white text-2xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-4">おすすめツール一覧</h3>
                                <p class="text-gray-600 mb-6 leading-relaxed">
                                    申請に役立つツールをまとめてご紹介
                                </p>
                                <a href="<?php echo home_url('/tools/'); ?>" class="inline-flex items-center gap-3 bg-gray-700 hover:bg-gray-800 text-white font-bold py-3 px-6 rounded-2xl transition-all duration-300 transform hover:-translate-y-1 w-full justify-center">
                                    <i class="fas fa-tools"></i>
                                    ツール一覧を見る
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
/* Custom Animations */
@keyframes glow {
    0% { box-shadow: 0 0 20px rgba(99, 102, 241, 0.3); }
    100% { box-shadow: 0 0 30px rgba(99, 102, 241, 0.6); }
}

/* Enhanced hover effects */
.hover\:shadow-3xl:hover {
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .container { padding-left: 1rem; padding-right: 1rem; }
    .text-4xl { font-size: 2.5rem; }
    .text-6xl { font-size: 3.5rem; }
}
</style>

<?php wp_footer(); ?>
</body>
</html>

<?php get_footer(); ?>
