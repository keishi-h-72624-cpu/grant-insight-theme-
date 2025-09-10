<?php
/**
 * Front Page Categories Section - Mobile Optimized Edition
 * カテゴリー別助成金検索セクション - モバイル最適化版
 * 
 * @package Grant_Insight_Perfect
 * @version 6.0-mobile-perfect
 */
?>

<section class="py-12 lg:py-20 bg-gradient-to-b from-white to-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto">
            <!-- セクションヘッダー -->
            <div class="text-center mb-12 lg:mb-16 animate-on-scroll opacity-0 translate-y-8 transition-all duration-700" data-animation="fadeInUp">
                <div class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-500/10 to-teal-500/10 text-emerald-700 px-4 py-2 rounded-full text-sm font-bold mb-4 lg:mb-6 backdrop-blur-sm border border-emerald-200">
                    <i class="fas fa-th-large text-emerald-500 text-sm"></i>
                    <span class="bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent font-black">カテゴリー別検索</span>
                </div>
                
                <h2 class="text-2xl lg:text-4xl font-bold text-gray-800 mb-3 lg:mb-4">
                    業種・目的別
                    <span class="text-gradient bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">
                        助成金検索
                    </span>
                </h2>
                <p class="text-base lg:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed px-4">
                    あなたの事業分野に最適な助成金・補助金を効率的に見つけましょう
                </p>
            </div>

            <!-- メインカテゴリーグリッド - スマホ2×2、タブレット2×3、PC3×2 -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-4 md:gap-6 lg:gap-8 mb-12 lg:mb-16">
                
                <!-- IT・デジタル化 -->
                <div class="category-card group bg-gradient-to-br from-blue-50 to-indigo-100 rounded-xl lg:rounded-2xl p-4 lg:p-8 hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-500 border border-blue-200 animate-on-scroll opacity-0 translate-y-8 transition-all duration-700 cursor-pointer" data-animation="fadeInUp" style="animation-delay: 0.1s;">
                    <div class="text-center">
                        <div class="w-12 h-12 lg:w-20 lg:h-20 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl lg:rounded-2xl flex items-center justify-center mx-auto mb-3 lg:mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-laptop-code text-white text-xl lg:text-3xl"></i>
                        </div>
                        <h3 class="text-sm lg:text-xl font-bold text-gray-800 mb-2 lg:mb-4 group-hover:text-blue-700 transition-colors duration-300">IT・デジタル化</h3>
                        <p class="text-xs lg:text-base text-gray-600 mb-3 lg:mb-6 leading-relaxed hidden md:block">
                            システム導入、DX推進、Web制作、AI・IoT活用など
                        </p>
                        <div class="space-y-1 lg:space-y-2 mb-3 lg:mb-6 hidden lg:block">
                            <div class="text-xs lg:text-sm text-gray-500">
                                <span class="font-medium text-blue-600">主な制度:</span> IT導入補助金、DX推進補助金
                            </div>
                            <div class="text-xs lg:text-sm text-gray-500">
                                <span class="font-medium text-blue-600">掲載件数:</span> 
                                <span class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-bold">125件</span>
                            </div>
                        </div>
                        <!-- モバイル用簡易情報表示 -->
                        <div class="mb-3 lg:hidden">
                            <span class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-bold">125件</span>
                        </div>
                        <a href="<?php echo esc_url(add_query_arg('category', 'it', get_post_type_archive_link('grant'))); ?>" 
                           class="inline-flex items-center justify-center w-full px-3 lg:px-6 py-2 lg:py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-medium text-xs lg:text-base rounded-lg hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 group-hover:shadow-lg">
                            <i class="fas fa-search mr-1 lg:mr-2 text-xs lg:text-base"></i>
                            <span class="hidden sm:inline">詳細を見る</span>
                            <span class="sm:hidden">検索</span>
                            <i class="fas fa-arrow-right ml-1 lg:ml-2 group-hover:translate-x-1 transition-transform duration-300 text-xs lg:text-base"></i>
                        </a>
                    </div>
                </div>

                <!-- ものづくり -->
                <div class="category-card group bg-gradient-to-br from-orange-50 to-red-100 rounded-xl lg:rounded-2xl p-4 lg:p-8 hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-500 border border-orange-200 animate-on-scroll opacity-0 translate-y-8 transition-all duration-700 cursor-pointer" data-animation="fadeInUp" style="animation-delay: 0.2s;">
                    <div class="text-center">
                        <div class="w-12 h-12 lg:w-20 lg:h-20 bg-gradient-to-r from-orange-500 to-red-600 rounded-xl lg:rounded-2xl flex items-center justify-center mx-auto mb-3 lg:mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-cogs text-white text-xl lg:text-3xl"></i>
                        </div>
                        <h3 class="text-sm lg:text-xl font-bold text-gray-800 mb-2 lg:mb-4 group-hover:text-orange-700 transition-colors duration-300">ものづくり</h3>
                        <p class="text-xs lg:text-base text-gray-600 mb-3 lg:mb-6 leading-relaxed hidden md:block">
                            設備導入、技術開発、生産性向上、品質改善など
                        </p>
                        <div class="space-y-1 lg:space-y-2 mb-3 lg:mb-6 hidden lg:block">
                            <div class="text-xs lg:text-sm text-gray-500">
                                <span class="font-medium text-orange-600">主な制度:</span> ものづくり補助金、設備導入補助金
                            </div>
                            <div class="text-xs lg:text-sm text-gray-500">
                                <span class="font-medium text-orange-600">掲載件数:</span> 
                                <span class="inline-block bg-orange-100 text-orange-800 px-2 py-1 rounded-full text-xs font-bold">98件</span>
                            </div>
                        </div>
                        <!-- モバイル用簡易情報表示 -->
                        <div class="mb-3 lg:hidden">
                            <span class="inline-block bg-orange-100 text-orange-800 px-2 py-1 rounded-full text-xs font-bold">98件</span>
                        </div>
                        <a href="<?php echo esc_url(add_query_arg('category', 'manufacturing', get_post_type_archive_link('grant'))); ?>" 
                           class="inline-flex items-center justify-center w-full px-3 lg:px-6 py-2 lg:py-3 bg-gradient-to-r from-orange-500 to-red-600 text-white font-medium text-xs lg:text-base rounded-lg hover:from-orange-600 hover:to-red-700 transition-all duration-300 transform hover:scale-105 group-hover:shadow-lg">
                            <i class="fas fa-search mr-1 lg:mr-2 text-xs lg:text-base"></i>
                            <span class="hidden sm:inline">詳細を見る</span>
                            <span class="sm:hidden">検索</span>
                            <i class="fas fa-arrow-right ml-1 lg:ml-2 group-hover:translate-x-1 transition-transform duration-300 text-xs lg:text-base"></i>
                        </a>
                    </div>
                </div>

                <!-- 創業・起業 -->
                <div class="category-card group bg-gradient-to-br from-green-50 to-emerald-100 rounded-xl lg:rounded-2xl p-4 lg:p-8 hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-500 border border-green-200 animate-on-scroll opacity-0 translate-y-8 transition-all duration-700 cursor-pointer" data-animation="fadeInUp" style="animation-delay: 0.3s;">
                    <div class="text-center">
                        <div class="w-12 h-12 lg:w-20 lg:h-20 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl lg:rounded-2xl flex items-center justify-center mx-auto mb-3 lg:mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-rocket text-white text-xl lg:text-3xl"></i>
                        </div>
                        <h3 class="text-sm lg:text-xl font-bold text-gray-800 mb-2 lg:mb-4 group-hover:text-green-700 transition-colors duration-300">創業・起業</h3>
                        <p class="text-xs lg:text-base text-gray-600 mb-3 lg:mb-6 leading-relaxed hidden md:block">
                            新規事業立ち上げ、スタートアップ支援、事業承継など
                        </p>
                        <div class="space-y-1 lg:space-y-2 mb-3 lg:mb-6 hidden lg:block">
                            <div class="text-xs lg:text-sm text-gray-500">
                                <span class="font-medium text-green-600">主な制度:</span> 創業補助金、起業家支援金
                            </div>
                            <div class="text-xs lg:text-sm text-gray-500">
                                <span class="font-medium text-green-600">掲載件数:</span> 
                                <span class="inline-block bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-bold">87件</span>
                            </div>
                        </div>
                        <!-- モバイル用簡易情報表示 -->
                        <div class="mb-3 lg:hidden">
                            <span class="inline-block bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-bold">87件</span>
                        </div>
                        <a href="<?php echo esc_url(add_query_arg('category', 'startup', get_post_type_archive_link('grant'))); ?>" 
                           class="inline-flex items-center justify-center w-full px-3 lg:px-6 py-2 lg:py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-medium text-xs lg:text-base rounded-lg hover:from-green-600 hover:to-emerald-700 transition-all duration-300 transform hover:scale-105 group-hover:shadow-lg">
                            <i class="fas fa-search mr-1 lg:mr-2 text-xs lg:text-base"></i>
                            <span class="hidden sm:inline">詳細を見る</span>
                            <span class="sm:hidden">検索</span>
                            <i class="fas fa-arrow-right ml-1 lg:ml-2 group-hover:translate-x-1 transition-transform duration-300 text-xs lg:text-base"></i>
                        </a>
                    </div>
                </div>

                <!-- 小規模事業者 -->
                <div class="category-card group bg-gradient-to-br from-purple-50 to-pink-100 rounded-xl lg:rounded-2xl p-4 lg:p-8 hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-500 border border-purple-200 animate-on-scroll opacity-0 translate-y-8 transition-all duration-700 cursor-pointer" data-animation="fadeInUp" style="animation-delay: 0.4s;">
                    <div class="text-center">
                        <div class="w-12 h-12 lg:w-20 lg:h-20 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl lg:rounded-2xl flex items-center justify-center mx-auto mb-3 lg:mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-store text-white text-xl lg:text-3xl"></i>
                        </div>
                        <h3 class="text-sm lg:text-xl font-bold text-gray-800 mb-2 lg:mb-4 group-hover:text-purple-700 transition-colors duration-300">小規模事業者</h3>
                        <p class="text-xs lg:text-base text-gray-600 mb-3 lg:mb-6 leading-relaxed hidden md:block">
                            販路開拓、集客力向上、事業継続、働き方改革など
                        </p>
                        <div class="space-y-1 lg:space-y-2 mb-3 lg:mb-6 hidden lg:block">
                            <div class="text-xs lg:text-sm text-gray-500">
                                <span class="font-medium text-purple-600">主な制度:</span> 持続化補助金、販路開拓支援金
                            </div>
                            <div class="text-xs lg:text-sm text-gray-500">
                                <span class="font-medium text-purple-600">掲載件数:</span> 
                                <span class="inline-block bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-xs font-bold">156件</span>
                            </div>
                        </div>
                        <!-- モバイル用簡易情報表示 -->
                        <div class="mb-3 lg:hidden">
                            <span class="inline-block bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-xs font-bold">156件</span>
                        </div>
                        <a href="<?php echo esc_url(add_query_arg('category', 'small-business', get_post_type_archive_link('grant'))); ?>" 
                           class="inline-flex items-center justify-center w-full px-3 lg:px-6 py-2 lg:py-3 bg-gradient-to-r from-purple-500 to-pink-600 text-white font-medium text-xs lg:text-base rounded-lg hover:from-purple-600 hover:to-pink-700 transition-all duration-300 transform hover:scale-105 group-hover:shadow-lg">
                            <i class="fas fa-search mr-1 lg:mr-2 text-xs lg:text-base"></i>
                            <span class="hidden sm:inline">詳細を見る</span>
                            <span class="sm:hidden">検索</span>
                            <i class="fas fa-arrow-right ml-1 lg:ml-2 group-hover:translate-x-1 transition-transform duration-300 text-xs lg:text-base"></i>
                        </a>
                    </div>
                </div>

                <!-- 環境・省エネ -->
                <div class="category-card group bg-gradient-to-br from-teal-50 to-cyan-100 rounded-xl lg:rounded-2xl p-4 lg:p-8 hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-500 border border-teal-200 animate-on-scroll opacity-0 translate-y-8 transition-all duration-700 cursor-pointer" data-animation="fadeInUp" style="animation-delay: 0.5s;">
                    <div class="text-center">
                        <div class="w-12 h-12 lg:w-20 lg:h-20 bg-gradient-to-r from-teal-500 to-cyan-600 rounded-xl lg:rounded-2xl flex items-center justify-center mx-auto mb-3 lg:mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-leaf text-white text-xl lg:text-3xl"></i>
                        </div>
                        <h3 class="text-sm lg:text-xl font-bold text-gray-800 mb-2 lg:mb-4 group-hover:text-teal-700 transition-colors duration-300">環境・省エネ</h3>
                        <p class="text-xs lg:text-base text-gray-600 mb-3 lg:mb-6 leading-relaxed hidden md:block">
                            省エネ設備導入、環境対策、再生可能エネルギーなど
                        </p>
                        <div class="space-y-1 lg:space-y-2 mb-3 lg:mb-6 hidden lg:block">
                            <div class="text-xs lg:text-sm text-gray-500">
                                <span class="font-medium text-teal-600">主な制度:</span> 省エネ補助金、グリーン投資減税
                            </div>
                            <div class="text-xs lg:text-sm text-gray-500">
                                <span class="font-medium text-teal-600">掲載件数:</span> 
                                <span class="inline-block bg-teal-100 text-teal-800 px-2 py-1 rounded-full text-xs font-bold">73件</span>
                            </div>
                        </div>
                        <!-- モバイル用簡易情報表示 -->
                        <div class="mb-3 lg:hidden">
                            <span class="inline-block bg-teal-100 text-teal-800 px-2 py-1 rounded-full text-xs font-bold">73件</span>
                        </div>
                        <a href="<?php echo esc_url(add_query_arg('category', 'environment', get_post_type_archive_link('grant'))); ?>" 
                           class="inline-flex items-center justify-center w-full px-3 lg:px-6 py-2 lg:py-3 bg-gradient-to-r from-teal-500 to-cyan-600 text-white font-medium text-xs lg:text-base rounded-lg hover:from-teal-600 hover:to-cyan-700 transition-all duration-300 transform hover:scale-105 group-hover:shadow-lg">
                            <i class="fas fa-search mr-1 lg:mr-2 text-xs lg:text-base"></i>
                            <span class="hidden sm:inline">詳細を見る</span>
                            <span class="sm:hidden">検索</span>
                            <i class="fas fa-arrow-right ml-1 lg:ml-2 group-hover:translate-x-1 transition-transform duration-300 text-xs lg:text-base"></i>
                        </a>
                    </div>
                </div>

                <!-- 雇用・人材 -->
                <div class="category-card group bg-gradient-to-br from-yellow-50 to-amber-100 rounded-xl lg:rounded-2xl p-4 lg:p-8 hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-500 border border-yellow-200 animate-on-scroll opacity-0 translate-y-8 transition-all duration-700 cursor-pointer" data-animation="fadeInUp" style="animation-delay: 0.6s;">
                    <div class="text-center">
                        <div class="w-12 h-12 lg:w-20 lg:h-20 bg-gradient-to-r from-yellow-500 to-amber-600 rounded-xl lg:rounded-2xl flex items-center justify-center mx-auto mb-3 lg:mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-users text-white text-xl lg:text-3xl"></i>
                        </div>
                        <h3 class="text-sm lg:text-xl font-bold text-gray-800 mb-2 lg:mb-4 group-hover:text-yellow-700 transition-colors duration-300">雇用・人材</h3>
                        <p class="text-xs lg:text-base text-gray-600 mb-3 lg:mb-6 leading-relaxed hidden md:block">
                            人材育成、雇用創出、働き方改革、研修支援など
                        </p>
                        <div class="space-y-1 lg:space-y-2 mb-3 lg:mb-6 hidden lg:block">
                            <div class="text-xs lg:text-sm text-gray-500">
                                <span class="font-medium text-yellow-600">主な制度:</span> 雇用調整助成金、人材開発支援助成金
                            </div>
                            <div class="text-xs lg:text-sm text-gray-500">
                                <span class="font-medium text-yellow-600">掲載件数:</span> 
                                <span class="inline-block bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-bold">94件</span>
                            </div>
                        </div>
                        <!-- モバイル用簡易情報表示 -->
                        <div class="mb-3 lg:hidden">
                            <span class="inline-block bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-bold">94件</span>
                        </div>
                        <a href="<?php echo esc_url(add_query_arg('category', 'employment', get_post_type_archive_link('grant'))); ?>" 
                           class="inline-flex items-center justify-center w-full px-3 lg:px-6 py-2 lg:py-3 bg-gradient-to-r from-yellow-500 to-amber-600 text-white font-medium text-xs lg:text-base rounded-lg hover:from-yellow-600 hover:to-amber-700 transition-all duration-300 transform hover:scale-105 group-hover:shadow-lg">
                            <i class="fas fa-search mr-1 lg:mr-2 text-xs lg:text-base"></i>
                            <span class="hidden sm:inline">詳細を見る</span>
                            <span class="sm:hidden">検索</span>
                            <i class="fas fa-arrow-right ml-1 lg:ml-2 group-hover:translate-x-1 transition-transform duration-300 text-xs lg:text-base"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- 地域別検索セクション - モバイル最適化 -->
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl lg:rounded-2xl p-6 lg:p-12 mb-12 lg:mb-16 animate-on-scroll opacity-0 translate-y-8 transition-all duration-700" data-animation="fadeInUp" style="animation-delay: 0.7s;">
                <div class="text-center mb-6 lg:mb-8">
                    <div class="inline-flex items-center gap-2 bg-gradient-to-r from-gray-500/10 to-slate-500/10 text-gray-700 px-4 py-2 rounded-full text-sm font-bold mb-3 lg:mb-4">
                        <i class="fas fa-map-marker-alt text-gray-600 text-sm"></i>
                        <span class="font-black">地域別検索</span>
                    </div>
                    <h3 class="text-xl lg:text-2xl font-bold text-gray-800 mb-2 lg:mb-4">都道府県別助成金検索</h3>
                    <p class="text-sm lg:text-base text-gray-600 px-4">
                        お住まいの地域特有の助成金・補助金もご確認いただけます
                    </p>
                </div>

                <!-- レスポンシブ地域グリッド -->
                <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-2 lg:gap-4">
                    <?php
                    $popular_regions = array(
                        'tokyo' => array('name' => '東京都', 'count' => '156'),
                        'osaka' => array('name' => '大阪府', 'count' => '98'), 
                        'kanagawa' => array('name' => '神奈川', 'count' => '87'),
                        'aichi' => array('name' => '愛知県', 'count' => '76'),
                        'fukuoka' => array('name' => '福岡県', 'count' => '65'),
                        'hokkaido' => array('name' => '北海道', 'count' => '54'),
                        'sendai' => array('name' => '宮城県', 'count' => '43'),
                        'hiroshima' => array('name' => '広島県', 'count' => '38'),
                        'shizuoka' => array('name' => '静岡県', 'count' => '32'),
                        'kyoto' => array('name' => '京都府', 'count' => '29'),
                        'hyogo' => array('name' => '兵庫県', 'count' => '41'),
                        'chiba' => array('name' => '千葉県', 'count' => '37')
                    );
                    
                    foreach ($popular_regions as $region_code => $region_data) :
                    ?>
                        <a href="<?php echo esc_url(add_query_arg('region', $region_code, get_post_type_archive_link('grant'))); ?>" 
                           class="region-link group bg-white hover:bg-emerald-50 border border-gray-200 hover:border-emerald-300 rounded-lg p-3 lg:p-4 text-center transition-all duration-300 transform hover:scale-105 hover:shadow-md">
                            <div class="text-xs lg:text-sm font-medium text-gray-700 group-hover:text-emerald-600 mb-1 truncate">
                                <?php echo esc_html($region_data['name']); ?>
                            </div>
                            <div class="text-xs text-gray-500">
                                <span class="inline-block bg-gray-100 group-hover:bg-emerald-100 text-gray-600 group-hover:text-emerald-700 px-1.5 py-0.5 lg:px-2 lg:py-1 rounded-full font-bold text-xs">
                                    <?php echo esc_html($region_data['count']); ?>
                                </span>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>

                <div class="text-center mt-6 lg:mt-8">
                    <a href="<?php echo esc_url(get_post_type_archive_link('grant')); ?>" 
                       class="inline-flex items-center px-4 lg:px-6 py-2 lg:py-3 bg-gradient-to-r from-gray-600 to-slate-700 text-white font-medium text-sm lg:text-base rounded-lg hover:from-gray-700 hover:to-slate-800 transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-map-marker-alt mr-2 text-sm"></i>
                        すべての地域を見る
                        <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </a>
                </div>
            </div>

            <!-- 統計セクション - モバイル最適化 -->
            <div class="bg-white rounded-xl lg:rounded-2xl shadow-lg p-6 lg:p-8 border border-gray-100 animate-on-scroll opacity-0 translate-y-8 transition-all duration-700" data-animation="fadeInUp" style="animation-delay: 0.8s;">
                <div class="text-center mb-6 lg:mb-8">
                    <h3 class="text-xl lg:text-2xl font-bold text-gray-800 mb-2 lg:mb-4">実績・統計情報</h3>
                    <p class="text-sm lg:text-base text-gray-600">数字が証明する信頼と実績</p>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-6">
                    <div class="text-center p-3 lg:p-4 bg-emerald-50 rounded-xl statistics-card">
                        <div class="text-2xl lg:text-3xl font-bold text-emerald-600 mb-1 lg:mb-2">633件</div>
                        <div class="text-xs lg:text-sm text-gray-600">総掲載件数</div>
                    </div>
                    <div class="text-center p-3 lg:p-4 bg-blue-50 rounded-xl statistics-card">
                        <div class="text-2xl lg:text-3xl font-bold text-blue-600 mb-1 lg:mb-2">47</div>
                        <div class="text-xs lg:text-sm text-gray-600">都道府県</div>
                    </div>
                    <div class="text-center p-3 lg:p-4 bg-orange-50 rounded-xl statistics-card">
                        <div class="text-xl lg:text-3xl font-bold text-orange-600 mb-1 lg:mb-2">毎日</div>
                        <div class="text-xs lg:text-sm text-gray-600">情報更新</div>
                    </div>
                    <div class="text-center p-3 lg:p-4 bg-purple-50 rounded-xl statistics-card">
                        <div class="text-2xl lg:text-3xl font-bold text-purple-600 mb-1 lg:mb-2">95%</div>
                        <div class="text-xs lg:text-sm text-gray-600">採択実績</div>
                    </div>
                </div>

                <!-- CTA -->
                <div class="text-center mt-6 lg:mt-8">
                    <a href="#grant-search" 
                       class="inline-flex items-center px-6 lg:px-8 py-3 lg:py-4 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold text-sm lg:text-lg rounded-xl hover:from-emerald-700 hover:to-teal-700 transform transition-all duration-300 hover:scale-105 shadow-xl hover:shadow-2xl">
                        <i class="fas fa-rocket mr-2 lg:mr-3 text-sm lg:text-base"></i>
                        <span class="hidden sm:inline">今すぐカテゴリー検索を始める</span>
                        <span class="sm:hidden">検索開始</span>
                        <i class="fas fa-arrow-right ml-2 lg:ml-3 text-sm lg:text-base"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mobile Optimized Custom Styles -->
<style>
/* モバイル優先のレスポンシブ設計 */
.category-card {
    position: relative;
    overflow: hidden;
    min-height: 200px; /* モバイルでの最小高さを確保 */
}

.category-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.5s;
}

.category-card:hover::before {
    left: 100%;
}

/* モバイルでのカード高さ統一 */
@media (max-width: 768px) {
    .category-card {
        min-height: 180px;
        padding: 1rem;
    }
    
    .category-card .w-12.h-12 {
        width: 3rem;
        height: 3rem;
    }
    
    .category-card h3 {
        font-size: 0.875rem;
        line-height: 1.25rem;
    }
    
    /* スマホでの2×3グリッド調整 */
    .grid.grid-cols-2 {
        gap: 0.75rem;
    }
    
    /* 地域リンクのモバイル最適化 */
    .region-link {
        min-height: 60px;
        padding: 0.5rem;
    }
    
    /* 統計セクションのモバイル調整 */
    .statistics-card {
        padding: 0.75rem;
        min-height: 80px;
    }
    
    .statistics-card .text-2xl {
        font-size: 1.5rem;
    }
}

/* タブレット表示の調整 */
@media (min-width: 768px) and (max-width: 1024px) {
    .category-card {
        min-height: 220px;
    }
    
    .category-card p {
        font-size: 0.875rem;
        line-height: 1.25rem;
    }
}

/* PC表示での最適化 */
@media (min-width: 1024px) {
    .category-card {
        min-height: 400px;
    }
}

/* Region link hover animation enhancement */
.region-link {
    position: relative;
    overflow: hidden;
}

.region-link::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: rgba(16, 185, 129, 0.1);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: all 0.3s ease;
}

.region-link:hover::after {
    width: 100%;
    height: 100%;
}

/* Statistics animation */
.statistics-card {
    transition: all 0.3s ease;
}

.statistics-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

/* スクロールアニメーションのパフォーマンス最適化 */
.animate-on-scroll {
    will-change: transform, opacity;
}

/* タッチデバイス用のホバー効果無効化 */
@media (hover: none) {
    .category-card:hover::before {
        left: -100%;
    }
    
    .category-card:hover {
        transform: none;
    }
    
    .statistics-card:hover {
        transform: none;
    }
}

/* フォーカス状態のアクセシビリティ向上 */
.category-card a:focus,
.region-link:focus {
    outline: 2px solid #10b981;
    outline-offset: 2px;
    border-radius: 8px;
}

/* 高コントラストモード対応 */
@media (prefers-contrast: high) {
    .category-card {
        border-width: 2px;
    }
    
    .region-link {
        border-width: 2px;
    }
}

/* 動きを減らしたい設定の尊重 */
@media (prefers-reduced-motion: reduce) {
    .category-card,
    .region-link,
    .statistics-card {
        transition: none;
    }
    
    .animate-on-scroll {
        opacity: 1;
        transform: none;
    }
}
</style>

<!-- Mobile Optimized JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Touch device detection
    const isTouchDevice = ('ontouchstart' in window) || (navigator.maxTouchPoints > 0);
    
    // Mobile-first animation system
    const initMobileOptimizedAnimations = () => {
        const animatedElements = document.querySelectorAll('.animate-on-scroll');
        
        if ('IntersectionObserver' in window && animatedElements.length > 0) {
            const animationObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const element = entry.target;
                        
                        // モバイルでは軽量なアニメーション
                        if (window.innerWidth < 768) {
                            element.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                        }
                        
                        element.classList.remove('opacity-0', 'translate-y-8');
                        element.classList.add('opacity-100', 'translate-y-0');
                        
                        animationObserver.unobserve(element);
                    }
                });
            }, {
                threshold: window.innerWidth < 768 ? 0.05 : 0.1,
                rootMargin: '0px 0px -30px 0px'
            });

            animatedElements.forEach(el => {
                animationObserver.observe(el);
            });
        } else {
            // Fallback for older browsers
            animatedElements.forEach(el => {
                el.classList.remove('opacity-0', 'translate-y-8');
                el.classList.add('opacity-100', 'translate-y-0');
            });
        }
    };

    // Enhanced mobile category interactions
    const initMobileCategoryInteractions = () => {
        const categoryCards = document.querySelectorAll('.category-card');
        
        categoryCards.forEach(card => {
            // タッチデバイスでは即座にリンク実行
            if (isTouchDevice) {
                card.addEventListener('touchend', function(e) {
                    // 長押しやスクロールを除外
                    if (e.timeStamp - (this.touchStartTime || 0) < 500) {
                        const link = this.querySelector('a');
                        if (link && !e.defaultPrevented) {
                            e.preventDefault();
                            link.click();
                        }
                    }
                });
                
                card.addEventListener('touchstart', function(e) {
                    this.touchStartTime = e.timeStamp;
                });
            } else {
                // デスクトップでのマウス操作
                card.addEventListener('click', function() {
                    const link = this.querySelector('a');
                    if (link) {
                        link.click();
                    }
                });
            }
        });
    };

    // Mobile-optimized region tracking
    const initMobileRegionTracking = () => {
        const regionLinks = document.querySelectorAll('.region-link');
        
        regionLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const regionName = this.querySelector('div').textContent.trim();
                
                // パフォーマンス考慮：モバイルでは軽量なログのみ
                if (window.innerWidth < 768) {
                    console.log('地域選択(モバイル):', regionName);
                } else {
                    console.log('地域選択(デスクトップ):', regionName);
                    
                    // Analytics tracking (desktop only for performance)
                    if (typeof gtag !== 'undefined') {
                        gtag('event', 'click', {
                            event_category: 'region_search_mobile',
                            event_label: regionName,
                            value: 1
                        });
                    }
                }
            });
        });
    };

    // Lightweight statistics animation for mobile
    const initMobileStatisticsAnimation = () => {
        const statNumbers = document.querySelectorAll('.statistics-card .text-2xl, .statistics-card .text-3xl');
        
        if ('IntersectionObserver' in window && statNumbers.length > 0) {
            const statsObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const element = entry.target;
                        
                        // モバイルでは簡単な表示のみ、アニメーションは軽量化
                        if (window.innerWidth < 768) {
                            element.style.transform = 'scale(1.05)';
                            setTimeout(() => {
                                element.style.transform = 'scale(1)';
                            }, 200);
                        } else {
                            // デスクトップでは数値カウントアニメーション
                            const text = element.textContent;
                            const number = parseInt(text.replace(/[^\d]/g, ''));
                            
                            if (!isNaN(number) && number > 0) {
                                animateStatNumber(element, number, text);
                            }
                        }
                        
                        statsObserver.unobserve(element);
                    }
                });
            }, {
                threshold: 0.5
            });

            statNumbers.forEach(stat => {
                statsObserver.observe(stat);
            });
        }
    };

    // Lightweight stat animation
    const animateStatNumber = (element, target, originalText) => {
        const duration = 1500; // モバイルではより短時間
        const step = target / (duration / 16);
        let current = 0;

        const timer = setInterval(() => {
            current += step;
            if (current >= target) {
                current = target;
                clearInterval(timer);
                element.textContent = originalText;
            } else {
                const currentNumber = Math.floor(current);
                element.textContent = originalText.replace(/\d+/, currentNumber);
            }
        }, 16);
    };

    // Performance monitoring
    const startTime = performance.now();

    // Initialize all components
    initMobileOptimizedAnimations();
    initMobileCategoryInteractions();
    initMobileRegionTracking();
    initMobileStatisticsAnimation();
    
    // Performance log
    const endTime = performance.now();
    console.log(`🚀 Categories Section (Mobile Optimized) loaded in ${(endTime - startTime).toFixed(2)}ms`);
    console.log(`📱 Device: ${isTouchDevice ? 'Touch' : 'Desktop'}, Screen: ${window.innerWidth}px`);
    console.log(`🎯 Features: Mobile 2×3 Grid + Touch Optimization + Performance Tuning`);
});
</script>