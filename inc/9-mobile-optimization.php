<?php
/**
 * Grant Insight Perfect - Mobile Optimization Functions
 * モバイル最適化機能
 * 
 * @package Grant_Insight_Perfect
 * @version 6.2.1
 */

// セキュリティチェック
if (!defined('ABSPATH')) {
    exit;
}

/**
 * より精密なモバイル判定関数
 */
if (!function_exists('gi_is_mobile_device')) {
    function gi_is_mobile_device() {
        // ユーザーエージェントベースの判定
        $mobile_agents = array(
            'Mobile', 'Android', 'Silk/', 'Kindle', 'BlackBerry', 'Opera Mini', 'Opera Mobi', 'iPhone', 'iPad'
        );
        
        $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        
        foreach ($mobile_agents as $agent) {
            if (strpos($user_agent, $agent) !== false) {
                return true;
            }
        }
        
        // 画面サイズベースの判定（JavaScript経由）
        if (isset($_COOKIE['gi_is_mobile'])) {
            return $_COOKIE['gi_is_mobile'] === '1';
        }
        
        return wp_is_mobile();
    }
}

/**
 * レスポンシブグリッドクラス生成（モバイルファースト）
 * 既存関数をオーバーライドしないよう条件分岐
 */
if (!function_exists('gi_get_responsive_grid_classes')) {
    function gi_get_responsive_grid_classes($desktop_cols = 3, $gap = 6) {
        $mobile_class = 'grid grid-cols-1';
        $tablet_class = 'md:grid-cols-2';
        $desktop_class = "lg:grid-cols-{$desktop_cols}";
        $gap_class = "gap-{$gap}";
        
        return "{$mobile_class} {$tablet_class} {$desktop_class} {$gap_class}";
    }
}

/**
 * 既存のグリッドクラス関数の拡張版
 */
function gi_get_responsive_grid_classes_enhanced($desktop_cols = 3, $gap = 6, $mobile_cols = 1, $tablet_cols = 2) {
    $mobile_class = "grid grid-cols-{$mobile_cols}";
    $tablet_class = "md:grid-cols-{$tablet_cols}";
    $desktop_class = "lg:grid-cols-{$desktop_cols}";
    $gap_class = "gap-{$gap}";
    
    return "{$mobile_class} {$tablet_class} {$desktop_class} {$gap_class}";
}

/**
 * カード統計情報のレンダリング
 */
if (!function_exists('gi_render_card_statistics')) {
    function gi_render_card_statistics($stats) {
        if (empty($stats)) return '';
        
        ob_start();
        ?>
        <div class="text-center">
            <h5 class="font-medium text-gray-900 mb-3 text-sm">📊 統計情報</h5>
            
            <div class="grid grid-cols-2 gap-3 text-xs">
                <div class="bg-emerald-50 rounded-lg p-2">
                    <div class="text-lg font-bold text-emerald-600">
                        <?php echo gi_safe_number_format($stats['total_grants'] ?? 0); ?>
                    </div>
                    <div class="text-emerald-700">総件数</div>
                </div>
                
                <div class="bg-green-50 rounded-lg p-2">
                    <div class="text-lg font-bold text-green-600">
                        <?php echo gi_safe_number_format($stats['active_grants'] ?? 0); ?>
                    </div>
                    <div class="text-green-700">募集中</div>
                </div>
                
                <div class="bg-yellow-50 rounded-lg p-2">
                    <div class="text-lg font-bold text-yellow-600">
                        <?php echo gi_format_amount($stats['average_amount'] ?? 0); ?>
                    </div>
                    <div class="text-yellow-700">平均金額</div>
                </div>
                
                <div class="bg-blue-50 rounded-lg p-2">
                    <div class="text-lg font-bold text-blue-600">
                        <?php echo intval($stats['success_rate'] ?? 0); ?>%
                    </div>
                    <div class="text-blue-700">平均採択率</div>
                </div>
            </div>
            
            <div class="mt-3 text-xs text-gray-500">
                最終更新: <?php echo date('Y/m/d H:i'); ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}

/**
 * モバイル専用カードコンテナクラス生成
 */
function gi_get_mobile_card_container_classes() {
    return 'mobile-grant-grid space-y-3 md:space-y-0 md:grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 md:gap-4 lg:gap-6';
}

/**
 * モバイル専用スタイルエンキュー
 */
function gi_enqueue_mobile_styles() {
    if (gi_is_mobile_device()) {
        wp_enqueue_style(
            'gi-mobile-optimization',
            get_template_directory_uri() . '/assets/css/mobile-optimization.css',
            array(),
            GI_THEME_VERSION
        );
    }
}
add_action('wp_enqueue_scripts', 'gi_enqueue_mobile_styles', 15);

/**
 * モバイル検出用JavaScript
 */
function gi_mobile_detection_script() {
    ?>
    <script>
    (function() {
        const isMobile = window.innerWidth <= 768 || /Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        document.cookie = 'gi_is_mobile=' + (isMobile ? '1' : '0') + '; path=/; max-age=3600';
        
        // CSS クラス追加
        if (isMobile) {
            document.documentElement.classList.add('gi-mobile');
        } else {
            document.documentElement.classList.add('gi-desktop');
        }
        
        // リサイズ時の再検出
        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                const newIsMobile = window.innerWidth <= 768;
                if (newIsMobile !== isMobile) {
                    location.reload(); // 表示が切り替わったらリロード
                }
            }, 250);
        });
    })();
    </script>
    <?php
}
add_action('wp_head', 'gi_mobile_detection_script', 1);

/**
 * モバイル用ボディクラス追加
 */
function gi_add_mobile_body_class($classes) {
    if (gi_is_mobile_device()) {
        $classes[] = 'gi-is-mobile';
    } else {
        $classes[] = 'gi-is-desktop';
    }
    return $classes;
}
add_filter('body_class', 'gi_add_mobile_body_class');

/**
 * モバイル用画像サイズ最適化
 */
function gi_mobile_image_sizes() {
    // モバイル用サムネイルサイズ
    add_image_size('mobile-card-thumb', 300, 200, true);
    add_image_size('mobile-hero', 400, 250, true);
}
add_action('after_setup_theme', 'gi_mobile_image_sizes');

/**
 * モバイルでのページネーション最適化
 */
function gi_mobile_pagination_args($args) {
    if (gi_is_mobile_device()) {
        $args['prev_text'] = '<i class="fas fa-chevron-left"></i>';
        $args['next_text'] = '<i class="fas fa-chevron-right"></i>';
        $args['end_size'] = 1;
        $args['mid_size'] = 1;
    }
    return $args;
}
add_filter('gi_pagination_args', 'gi_mobile_pagination_args');

/**
 * モバイル表示時のメニュー項目数制限
 */
function gi_mobile_menu_limit($items, $args) {
    if (gi_is_mobile_device() && isset($args->theme_location) && $args->theme_location === 'primary') {
        // モバイルでは最初の5項目のみ表示
        return array_slice($items, 0, 5);
    }
    return $items;
}
add_filter('wp_nav_menu_objects', 'gi_mobile_menu_limit', 10, 2);