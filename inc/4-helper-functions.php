<?php
/**
 * Grant Insight Perfect - 4. Helper Functions File
 *
 * サイト全体で再利用可能な、汎用的なヘルパー関数やユーティリティ関数を
 * ここにまとめます。
 *
 * @package Grant_Insight_Perfect
 */

// セキュリティチェック
if (!defined('ABSPATH')) {
    exit;
}

/**
 * 【修正】未定義関数の追加
 */

// 締切日のフォーマット関数
function gi_get_formatted_deadline($post_id) {
    $deadline = gi_safe_get_meta($post_id, 'deadline_date');
    if (!$deadline) {
        // 旧フィールドも確認
        $deadline = gi_safe_get_meta($post_id, 'deadline');
    }
    
    if (!$deadline) {
        return '';
    }
    
    // 数値の場合（UNIXタイムスタンプ）
    if (is_numeric($deadline)) {
        return date('Y年m月d日', intval($deadline));
    }
    
    // 文字列の場合
    $timestamp = strtotime($deadline);
    if ($timestamp !== false) {
        return date('Y年m月d日', $timestamp);
    }
    
    return $deadline;
}

/**
 * 【修正】メタフィールドの同期処理（ACF対応）
 */
function gi_sync_grant_meta_on_save($post_id, $post, $update) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if ($post->post_type !== 'grant') return;
    if (!current_user_can('edit_post', $post_id)) return;

    // 金額の数値版を作成
    $amount_text = get_post_meta($post_id, 'max_amount', true);
    if (!$amount_text) {
        // ACFフィールドも確認
        $amount_text = get_field('max_amount', $post_id);
    }
    
    if ($amount_text) {
        // 数値のみを抽出
        $amount_numeric = preg_replace('/[^0-9]/', '', $amount_text);
        if ($amount_numeric) {
            update_post_meta($post_id, 'max_amount_numeric', intval($amount_numeric));
        }
    }

    // 日付の数値版を作成
    $deadline = get_post_meta($post_id, 'deadline', true);
    if (!$deadline) {
        // ACFフィールドも確認
        $deadline = get_field('deadline', $post_id);
    }
    
    if ($deadline) {
        if (is_numeric($deadline)) {
            update_post_meta($post_id, 'deadline_date', intval($deadline));
        } else {
            $deadline_numeric = strtotime($deadline);
            if ($deadline_numeric !== false) {
                update_post_meta($post_id, 'deadline_date', $deadline_numeric);
            }
        }
    }

    // ステータスの同期
    $status = get_post_meta($post_id, 'status', true);
    if (!$status) {
        $status = get_field('application_status', $post_id);
    }
    
    if ($status) {
        update_post_meta($post_id, 'application_status', $status);
    } else {
        // デフォルトステータス
        update_post_meta($post_id, 'application_status', 'open');
    }

    // 組織名の同期
    $organization = get_field('organization', $post_id);
    if ($organization) {
        update_post_meta($post_id, 'organization', $organization);
    }
}
add_action('save_post', 'gi_sync_grant_meta_on_save', 20, 3);

/**
 * セキュリティ・ヘルパー関数群（強化版）
 */

// 安全なメタ取得
function gi_safe_get_meta($post_id, $key, $default = '') {
    if (!$post_id || !is_numeric($post_id)) {
        return $default;
    }
    
    $value = get_post_meta($post_id, $key, true);
    
    // ACFフィールドも確認
    if (is_null($value) || $value === false || $value === '') {
        if (function_exists('get_field')) {
            $value = get_field($key, $post_id);
        }
    }
    
    if (is_null($value) || $value === false || $value === '') {
        return $default;
    }
    
    return $value;
}

// 安全な属性出力
function gi_safe_attr($value) {
    if (is_array($value)) {
        $value = implode(' ', $value);
    }
    return esc_attr($value);
}

// 安全なHTML出力
function gi_safe_escape($value) {
    if (is_array($value)) {
        return array_map('esc_html', $value);
    }
    return esc_html($value);
}

// 安全な数値フォーマット
function gi_safe_number_format($value, $decimals = 0) {
    if (!is_numeric($value)) {
        return '0';
    }
    $num = floatval($value);
    return number_format($num, $decimals);
}

// 安全な日付フォーマット
function gi_safe_date_format($date, $format = 'Y-m-d') {
    if (empty($date)) {
        return '';
    }
    
    if (is_numeric($date)) {
        return date($format, $date);
    }
    
    $timestamp = strtotime($date);
    if ($timestamp === false) {
        return $date;
    }
    
    return date($format, $timestamp);
}

// 安全なパーセント表示
function gi_safe_percent_format($value, $decimals = 1) {
    if (!is_numeric($value)) {
        return '0%';
    }
    $num = floatval($value);
    return number_format($num, $decimals) . '%';
}

// 安全なURL出力
function gi_safe_url($url) {
    if (empty($url)) {
        return '';
    }
    return esc_url($url);
}

// 安全なJSON出力
function gi_safe_json($data) {
    return wp_json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
}

// 安全なテキスト切り取り
function gi_safe_excerpt($text, $length = 100, $more = '...') {
    if (mb_strlen($text) <= $length) {
        return esc_html($text);
    }
    
    $excerpt = mb_substr($text, 0, $length);
    $last_space = mb_strrpos($excerpt, ' ');
    
    if ($last_space !== false) {
        $excerpt = mb_substr($excerpt, 0, $last_space);
    }
    
    return esc_html($excerpt . $more);
}

/**
 * 動的パス取得関数（完全版）
 */

// アセットURL取得
function gi_get_asset_url($path) {
    $path = ltrim($path, '/');
    return get_template_directory_uri() . '/' . $path;
}

// アップロードURL取得
function gi_get_upload_url($filename) {
    $upload_dir = wp_upload_dir();
    $filename = ltrim($filename, '/');
    return $upload_dir['baseurl'] . '/' . $filename;
}

// メディアURL取得（自動検出機能付き）
function gi_get_media_url($filename, $fallback = true) {
    if (empty($filename)) {
        return $fallback ? gi_get_asset_url('assets/images/placeholder.jpg') : '';
    }
    
    if (filter_var($filename, FILTER_VALIDATE_URL)) {
        return $filename;
    }
    
    $filename = str_replace([
        'http://keishi0804.xsrv.jp/wp-content/uploads/',
        'https://keishi0804.xsrv.jp/wp-content/uploads/',
        '/wp-content/uploads/'
    ], '', $filename);
    
    $filename = ltrim($filename, '/');
    
    $upload_dir = wp_upload_dir();
    $file_path = $upload_dir['basedir'] . '/' . $filename;
    
    if (file_exists($file_path)) {
        return $upload_dir['baseurl'] . '/' . $filename;
    }
    
    $current_year = date('Y');
    $current_month = date('m');
    
    $possible_paths = [
        $current_year . '/' . $current_month . '/' . $filename,
        $current_year . '/' . $filename,
        'uploads/' . $filename,
        'media/' . $filename
    ];
    
    foreach ($possible_paths as $path) {
        $full_path = $upload_dir['basedir'] . '/' . $path;
        if (file_exists($full_path)) {
            return $upload_dir['baseurl'] . '/' . $path;
        }
    }
    
    if ($fallback) {
        return gi_get_asset_url('assets/images/placeholder.jpg');
    }
    
    return '';
}

// 動画URL取得
function gi_get_video_url($filename, $fallback = true) {
    $url = gi_get_media_url($filename, false);
    
    if (!empty($url)) {
        return $url;
    }
    
    if ($fallback) {
        return gi_get_asset_url('assets/videos/placeholder.mp4');
    }
    
    return '';
}

// ロゴURL取得
function gi_get_logo_url($fallback = true) {
    $custom_logo_id = get_theme_mod('custom_logo');
    if ($custom_logo_id) {
        return wp_get_attachment_image_url($custom_logo_id, 'full');
    }
    
    $hero_logo = get_theme_mod('gi_hero_logo');
    if ($hero_logo) {
        return gi_get_media_url($hero_logo, false);
    }
    
    if ($fallback) {
        return gi_get_asset_url('assets/images/logo.png');
    }
    
    return '';
}

/**
 * 補助ヘルパー: 金額（円）を万円表示用に整形
 */
function gi_format_amount_man($amount_yen, $amount_text = '') {
    $yen = is_numeric($amount_yen) ? intval($amount_yen) : 0;
    if ($yen > 0) {
        return gi_safe_number_format(intval($yen / 10000));
    }
    if (!empty($amount_text)) {
        if (preg_match('/([0-9,]+)\s*万円/u', $amount_text, $m)) {
            return gi_safe_number_format(intval(str_replace(',', '', $m[1])));
        }
        if (preg_match('/([0-9,]+)/u', $amount_text, $m)) {
            return gi_safe_number_format(intval(str_replace(',', '', $m[1])));
        }
    }
    return '0';
}

/**
 * 補助ヘルパー: ACFのapplication_statusをUI用にマッピング
 */
function gi_map_application_status_ui($app_status) {
    switch ($app_status) {
        case 'open':
            return 'active';
        case 'upcoming':
            return 'upcoming';
        case 'closed':
            return 'closed';
        default:
            return 'active';
    }
}

/**
 * お気に入り一覧取得
 */
function gi_get_user_favorites($user_id = null) {
    if (!$user_id) {
        $user_id = get_current_user_id();
    }
    
    if (!$user_id) {
        $cookie_name = 'gi_favorites';
        $favorites = isset($_COOKIE[$cookie_name]) ? array_filter(explode(',', $_COOKIE[$cookie_name])) : array();
    } else {
        $favorites = get_user_meta($user_id, 'gi_favorites', true);
        if (!is_array($favorites)) $favorites = array();
    }
    
    return array_map('intval', $favorites);
}

/**
 * 投稿カテゴリー取得
 */
function gi_get_post_categories($post_id) {
    $post_type = get_post_type($post_id);
    $taxonomy = $post_type . '_category';
    
    if (!taxonomy_exists($taxonomy)) {
        return array();
    }
    
    $terms = get_the_terms($post_id, $taxonomy);
    if (!$terms || is_wp_error($terms)) {
        return array();
    }
    
    return array_map(function($term) {
        return array(
            'name' => $term->name,
            'slug' => $term->slug,
            'link' => get_term_link($term)
        );
    }, $terms);
}

// 既存のコードの最後に追加

/**
 * 都道府県名取得
 */
function gi_get_prefecture_name($prefecture_id) {
    $prefectures = array(
        1 => '北海道', 2 => '青森県', 3 => '岩手県', 4 => '宮城県', 5 => '秋田県',
        6 => '山形県', 7 => '福島県', 8 => '茨城県', 9 => '栃木県', 10 => '群馬県',
        11 => '埼玉県', 12 => '千葉県', 13 => '東京都', 14 => '神奈川県', 15 => '新潟県',
        16 => '富山県', 17 => '石川県', 18 => '福井県', 19 => '山梨県', 20 => '長野県',
        21 => '岐阜県', 22 => '静岡県', 23 => '愛知県', 24 => '三重県', 25 => '滋賀県',
        26 => '京都府', 27 => '大阪府', 28 => '兵庫県', 29 => '奈良県', 30 => '和歌山県',
        31 => '鳥取県', 32 => '島根県', 33 => '岡山県', 34 => '広島県', 35 => '山口県',
        36 => '徳島県', 37 => '香川県', 38 => '愛媛県', 39 => '高知県', 40 => '福岡県',
        41 => '佐賀県', 42 => '長崎県', 43 => '熊本県', 44 => '大分県', 45 => '宮崎県',
        46 => '鹿児島県', 47 => '沖縄県'
    );
    
    return isset($prefectures[$prefecture_id]) ? $prefectures[$prefecture_id] : '';
}

/**
 * 助成金カテゴリ名取得
 */
function gi_get_category_name($category_id) {
    $categories = array(
        'startup' => '起業・創業支援',
        'research' => '研究開発',
        'employment' => '雇用促進',
        'training' => '人材育成',
        'export' => '輸出促進',
        'digital' => 'デジタル化',
        'environment' => '環境・エネルギー',
        'regional' => '地域活性化'
    );
    
    return isset($categories[$category_id]) ? $categories[$category_id] : '';
}

/**
 * 助成金ステータス名取得
 */
function gi_get_status_name($status) {
    $statuses = array(
        'active' => '募集中',
        'upcoming' => '募集予定',
        'closed' => '募集終了',
        'suspended' => '一時停止'
    );
    
    return isset($statuses[$status]) ? $statuses[$status] : '';
}

/**
 * 🚀 検索統計データ更新・キャッシュ機能
 */
function gi_update_search_stats_cache() {
    // キャッシュから取得を試行
    $stats = wp_cache_get('grant_search_stats', 'grant_insight');
    
    if (false === $stats) {
        // キャッシュがない場合は新しく生成
        $stats = array(
            'total_grants' => wp_count_posts('grant')->publish ?? 1247,
            'total_tools' => wp_count_posts('tool')->publish ?? 89,
            'total_cases' => wp_count_posts('case_study')->publish ?? 156,
            'total_guides' => wp_count_posts('guide')->publish ?? 234,
            'last_updated' => current_time('timestamp')
        );
        
        // キャッシュに保存（1時間）
        wp_cache_set('grant_search_stats', $stats, 'grant_insight', 3600);
        
        // オプションにもバックアップ保存
        update_option('gi_search_stats_backup', $stats);
    }
    
    return $stats;
}

/**
 * 🚀 検索統計データ取得（フォールバック機能付き）
 */
function gi_get_search_stats() {
    $stats = gi_update_search_stats_cache();
    
    // フォールバック用のデフォルト値
    $defaults = array(
        'total_grants' => 1247,
        'total_tools' => 89,
        'total_cases' => 156,
        'total_guides' => 234,
        'last_updated' => current_time('timestamp')
    );
    
    return wp_parse_args($stats, $defaults);
}
