<?php
/**
 * Grant Insight Perfect - 2. Post Types & Taxonomies File
 *
 * サイトで使用するカスタム投稿タイプとカスタムタクソノミーを登録します。
 *
 * @package Grant_Insight_Perfect
 */

// セキュリティチェック
if (!defined('ABSPATH')) {
    exit;
}

/**
 * カスタム投稿タイプ登録（完全版）
 */
function gi_register_post_types() {
    // 助成金投稿タイプ
    register_post_type('grant', array(
        'labels' => array(
            'name' => '助成金・補助金',
            'singular_name' => '助成金・補助金',
            'add_new' => '新規追加',
            'add_new_item' => '新しい助成金・補助金を追加',
            'edit_item' => '助成金・補助金を編集',
            'new_item' => '新しい助成金・補助金',
            'view_item' => '助成金・補助金を表示',
            'search_items' => '助成金・補助金を検索',
            'not_found' => '助成金・補助金が見つかりませんでした',
            'not_found_in_trash' => 'ゴミ箱に助成金・補助金はありません',
            'all_items' => 'すべての助成金・補助金',
            'menu_name' => '助成金・補助金'
        ),
        'description' => '助成金・補助金情報を管理します',
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'grants',
            'with_front' => false
        ),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-money-alt',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions'),
        'show_in_rest' => true
    ));
    
    // ツール投稿タイプ
    register_post_type('tool', array(
        'labels' => array(
            'name' => 'ビジネスツール',
            'singular_name' => 'ビジネスツール',
            'add_new' => '新規追加',
            'add_new_item' => '新しいツールを追加',
            'edit_item' => 'ツールを編集',
            'new_item' => '新しいツール',
            'view_item' => 'ツールを表示',
            'search_items' => 'ツールを検索',
            'not_found' => 'ツールが見つかりませんでした',
            'not_found_in_trash' => 'ゴミ箱にツールはありません',
            'all_items' => 'すべてのツール',
            'menu_name' => 'ビジネスツール'
        ),
        'description' => 'ビジネスツール情報を管理します',
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'tools',
            'with_front' => false
        ),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 6,
        'menu_icon' => 'dashicons-admin-tools',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions'),
        'show_in_rest' => true
    ));
    
    // 成功事例投稿タイプ
    register_post_type('case_study', array(
        'labels' => array(
            'name' => '成功事例',
            'singular_name' => '成功事例',
            'add_new' => '新規追加',
            'add_new_item' => '新しい成功事例を追加',
            'edit_item' => '成功事例を編集',
            'new_item' => '新しい成功事例',
            'view_item' => '成功事例を表示',
            'search_items' => '成功事例を検索',
            'not_found' => '成功事例が見つかりませんでした',
            'not_found_in_trash' => 'ゴミ箱に成功事例はありません',
            'all_items' => 'すべての成功事例',
            'menu_name' => '成功事例'
        ),
        'description' => '成功事例情報を管理します',
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'case-studies',
            'with_front' => false
        ),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 7,
        'menu_icon' => 'dashicons-chart-line',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions'),
        'show_in_rest' => true
    ));
    
    // ガイド投稿タイプ
    register_post_type('guide', array(
        'labels' => array(
            'name' => 'ガイド・解説',
            'singular_name' => 'ガイド・解説',
            'add_new' => '新規追加',
            'add_new_item' => '新しいガイドを追加',
            'edit_item' => 'ガイドを編集',
            'new_item' => '新しいガイド',
            'view_item' => 'ガイドを表示',
            'search_items' => 'ガイドを検索',
            'not_found' => 'ガイドが見つかりませんでした',
            'not_found_in_trash' => 'ゴミ箱にガイドはありません',
            'all_items' => 'すべてのガイド',
            'menu_name' => 'ガイド・解説'
        ),
        'description' => 'ガイド・解説情報を管理します',
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'guides',
            'with_front' => false
        ),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 8,
        'menu_icon' => 'dashicons-book-alt',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions'),
        'show_in_rest' => true
    ));
    
    // 申請のコツ投稿タイプ
    register_post_type('grant_tip', array(
        'labels' => array(
            'name' => '申請のコツ',
            'singular_name' => '申請のコツ',
            'add_new' => '新規追加',
            'add_new_item' => '新しいコツを追加',
            'edit_item' => 'コツを編集',
            'new_item' => '新しいコツ',
            'view_item' => 'コツを表示',
            'search_items' => 'コツを検索',
            'not_found' => 'コツが見つかりませんでした',
            'not_found_in_trash' => 'ゴミ箱にコツはありません',
            'all_items' => 'すべてのコツ',
            'menu_name' => '申請のコツ'
        ),
        'description' => '申請のコツ情報を管理します',
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'grant-tips',
            'with_front' => false
        ),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 9,
        'menu_icon' => 'dashicons-lightbulb',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions'),
        'show_in_rest' => true
    ));
}
add_action('init', 'gi_register_post_types');


/**
 * カスタムタクソノミー登録（完全版・都道府県対応・修正版）
 */
function gi_register_taxonomies() {
    // 助成金カテゴリー
    register_taxonomy('grant_category', 'grant', array(
        'labels' => array(
            'name' => '助成金カテゴリー',
            'singular_name' => '助成金カテゴリー',
            'search_items' => 'カテゴリーを検索',
            'all_items' => 'すべてのカテゴリー',
            'parent_item' => '親カテゴリー',
            'parent_item_colon' => '親カテゴリー:',
            'edit_item' => 'カテゴリーを編集',
            'update_item' => 'カテゴリーを更新',
            'add_new_item' => '新しいカテゴリーを追加',
            'new_item_name' => '新しいカテゴリー名'
        ),
        'description' => '助成金・補助金をカテゴリー別に分類します',
        'public' => true,
        'publicly_queryable' => true,
        'hierarchical' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_rest' => true,
        'show_tagcloud' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'grant-category',
            'with_front' => false,
            'hierarchical' => true
        )
    ));
    
    // 都道府県タクソノミー
    register_taxonomy('grant_prefecture', 'grant', array(
        'labels' => array(
            'name' => '対象都道府県',
            'singular_name' => '都道府県',
            'search_items' => '都道府県を検索',
            'all_items' => 'すべての都道府県',
            'edit_item' => '都道府県を編集',
            'update_item' => '都道府県を更新',
            'add_new_item' => '新しい都道府県を追加',
            'new_item_name' => '新しい都道府県名'
        ),
        'description' => '助成金・補助金の対象都道府県を管理します',
        'public' => true,
        'publicly_queryable' => true,
        'hierarchical' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_rest' => true,
        'show_tagcloud' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'prefecture',
            'with_front' => false
        )
    ));
    
    // 助成金タグ
    register_taxonomy('grant_tag', 'grant', array(
        'labels' => array(
            'name' => '助成金タグ',
            'singular_name' => '助成金タグ',
            'search_items' => 'タグを検索',
            'all_items' => 'すべてのタグ',
            'edit_item' => 'タグを編集',
            'update_item' => 'タグを更新',
            'add_new_item' => '新しいタグを追加',
            'new_item_name' => '新しいタグ名'
        ),
        'description' => '助成金・補助金をタグで分類します',
        'public' => true,
        'publicly_queryable' => true,
        'hierarchical' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_rest' => true,
        'show_tagcloud' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'grant-tag',
            'with_front' => false
        )
    ));
    
    // ツールカテゴリー
    register_taxonomy('tool_category', 'tool', array(
        'labels' => array(
            'name' => 'ツールカテゴリー',
            'singular_name' => 'ツールカテゴリー',
            'search_items' => 'カテゴリーを検索',
            'all_items' => 'すべてのカテゴリー',
            'parent_item' => '親カテゴリー',
            'parent_item_colon' => '親カテゴリー:',
            'edit_item' => 'カテゴリーを編集',
            'update_item' => 'カテゴリーを更新',
            'add_new_item' => '新しいカテゴリーを追加',
            'new_item_name' => '新しいカテゴリー名'
        ),
        'description' => 'ビジネスツールをカテゴリー別に分類します',
        'public' => true,
        'publicly_queryable' => true,
        'hierarchical' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_rest' => true,
        'show_tagcloud' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'tool-category',
            'with_front' => false,
            'hierarchical' => true
        )
    ));
    
    // 成功事例カテゴリー
    register_taxonomy('case_study_category', 'case_study', array(
        'labels' => array(
            'name' => '成功事例カテゴリー',
            'singular_name' => '成功事例カテゴリー',
            'search_items' => 'カテゴリーを検索',
            'all_items' => 'すべてのカテゴリー',
            'parent_item' => '親カテゴリー',
            'parent_item_colon' => '親カテゴリー:',
            'edit_item' => 'カテゴリーを編集',
            'update_item' => 'カテゴリーを更新',
            'add_new_item' => '新しいカテゴリーを追加',
            'new_item_name' => '新しいカテゴリー名'
        ),
        'description' => '成功事例をカテゴリー別に分類します',
        'public' => true,
        'publicly_queryable' => true,
        'hierarchical' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_rest' => true,
        'show_tagcloud' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'case-category',
            'with_front' => false,
            'hierarchical' => true
        )
    ));

    // 【修正】申請のコツカテゴリー（不足していたタクソノミー）
    register_taxonomy('grant_tip_category', 'grant_tip', array(
        'labels' => array(
            'name' => '申請のコツカテゴリー',
            'singular_name' => '申請のコツカテゴリー',
            'search_items' => 'カテゴリーを検索',
            'all_items' => 'すべてのカテゴリー',
            'parent_item' => '親カテゴリー',
            'parent_item_colon' => '親カテゴリー:',
            'edit_item' => 'カテゴリーを編集',
            'update_item' => 'カテゴリーを更新',
            'add_new_item' => '新しいカテゴリーを追加',
            'new_item_name' => '新しいカテゴリー名'
        ),
        'description' => '申請のコツをカテゴリー別に分類します',
        'public' => true,
        'publicly_queryable' => true,
        'hierarchical' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_rest' => true,
        'show_tagcloud' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'grant-tip-category',
            'with_front' => false,
            'hierarchical' => true
        )
    ));
}
add_action('init', 'gi_register_taxonomies');