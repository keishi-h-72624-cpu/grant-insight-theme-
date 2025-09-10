<?php
/**
 * Grant Insight Perfect - 8. Initial Setup File (Complete Enhanced Edition)
 *
 * テーマの有効化時に、必要な初期データ（都道府県、カテゴリー、サンプル投稿など）を
 * データベースに投入する処理を担当します。
 * 新しいカードデザインに必要な全てのメタフィールドに対応した完全版です。
 *
 * @package Grant_Insight_Perfect
 */

// セキュリティチェック
if (!defined('ABSPATH')) {
    exit;
}

/**
 * テーマ有効化時に実行されるメインのセットアップ関数
 */
function gi_theme_activation_setup() {
    // 必須データの投入
    gi_insert_default_prefectures();
    gi_insert_default_categories();
    gi_insert_tool_categories();
    gi_insert_grant_tip_categories();

    // サンプル助成金データの投入（不要な場合はこの行をコメントアウトしてください）
    gi_insert_sample_grants_with_prefectures();
    
    // サンプルツールデータの投入
    gi_insert_sample_tools();
    
    // サンプル申請のコツデータの投入
    gi_insert_sample_grant_tips();
    
    // パーマリンク設定を更新して、新しい投稿タイプのURLを正しく機能させる
    flush_rewrite_rules();
    
    // 初期設定完了フラグをセット
    update_option('gi_initial_setup_completed', current_time('timestamp'));
}
add_action('after_switch_theme', 'gi_theme_activation_setup');

/**
 * デフォルト都道府県データの挿入
 * grant_prefecture タクソノミーに日本の都道府県を登録します。
 */
function gi_insert_default_prefectures() {
    $prefectures = array(
        '全国対応', '北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県',
        '茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県',
        '新潟県', '富山県', '石川県', '福井県', '山梨県', '長野県', '岐阜県',
        '静岡県', '愛知県', '三重県', '滋賀県', '京都府', '大阪府', '兵庫県',
        '奈良県', '和歌山県', '鳥取県', '島根県', '岡山県', '広島県', '山口県',
        '徳島県', '香川県', '愛媛県', '高知県', '福岡県', '佐賀県', '長崎県',
        '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県'
    );

    foreach ($prefectures as $prefecture) {
        if (!term_exists($prefecture, 'grant_prefecture')) {
            wp_insert_term($prefecture, 'grant_prefecture');
        }
    }
}

/**
 * デフォルトカテゴリーデータの挿入
 * grant_category に初期カテゴリーを登録します。
 */
function gi_insert_default_categories() {
    // 助成金用デフォルトカテゴリー
    $grant_categories = array(
        'IT・デジタル化支援',
        '設備投資・機械導入',
        '人材育成・教育訓練',
        '研究開発・技術革新',
        '省エネ・環境対策',
        '事業承継・M&A',
        '海外展開・輸出促進',
        '創業・起業支援',
        '販路開拓・マーケティング',
        '働き方改革・労働環境',
        '観光・地域振興',
        '農業・林業・水産業',
        '製造業・ものづくり',
        'サービス業・小売業',
        'コロナ対策・事業継続',
        '女性・若者・シニア支援',
        '障がい者雇用支援',
        '知的財産・特許',
        'BCP・リスク管理',
        'その他・汎用'
    );

    foreach ($grant_categories as $category) {
        if (!term_exists($category, 'grant_category')) {
            wp_insert_term($category, 'grant_category');
        }
    }
}

/**
 * ツール用カテゴリーデータの挿入
 */
function gi_insert_tool_categories() {
    $tool_categories = array(
        'プロジェクト管理',
        'コミュニケーション',
        'マーケティング・CRM',
        '会計・経理',
        '人事・労務',
        'デザイン・クリエイティブ',
        '開発・プログラミング',
        'データ分析・BI',
        'セキュリティ',
        'クラウドストレージ',
        'タスク・時間管理',
        'eコマース・EC',
        '在庫・物流管理',
        '営業・セールス',
        'カスタマーサポート',
        'その他・汎用ツール'
    );

    foreach ($tool_categories as $category) {
        if (!term_exists($category, 'tool_category')) {
            wp_insert_term($category, 'tool_category');
        }
    }
}

/**
 * 申請のコツ用カテゴリーデータの挿入
 */
function gi_insert_grant_tip_categories() {
    $tip_categories = array(
        '申請書作成のコツ',
        '事業計画書の書き方',
        '審査対策・面接準備',
        '必要書類の準備',
        '申請スケジュール管理',
        'よくある失敗例',
        '成功のポイント',
        '補助金の種類・選び方',
        '採択後の手続き',
        '実績報告・検査対応'
    );

    foreach ($tip_categories as $category) {
        if (!term_exists($category, 'grant_tip_category')) {
            wp_insert_term($category, 'grant_tip_category');
        }
    }
}

/**
 * ★修正版 サンプル助成金データの投入（都道府県・新項目付き）
 */
function gi_insert_sample_grants_with_prefectures() {
    $sample_grants = [
        [
            'title' => '【サンプル】IT導入補助金2025',
            'content' => 'ITツールの導入により生産性向上を図る中小企業・小規模事業者等を支援する補助金制度です。業務効率化・売上向上に資するITツール導入費用の一部を補助します。',
            'prefecture' => '全国対応',
            'amount' => 4500000,
            'category' => 'IT・デジタル化支援',
            'difficulty' => 'normal',
            'success_rate' => 75,
            'subsidy_rate' => '1/2以内',
            'target' => '中小企業・小規模事業者',
            'organization' => '独立行政法人中小企業基盤整備機構',
            'deadline_days' => 90, // 90日後
            'is_featured' => true
        ],
        [
            'title' => '【サンプル】東京都中小企業DX推進補助金',
            'content' => '都内中小企業のデジタルトランスフォーメーション（DX）推進を支援する東京都独自の補助金制度です。AI・IoT・クラウド導入等を幅広く対象としています。',
            'prefecture' => '東京都',
            'amount' => 3000000,
            'category' => 'IT・デジタル化支援',
            'difficulty' => 'easy',
            'success_rate' => 85,
            'subsidy_rate' => '2/3以内',
            'target' => '都内に事業所を持つ中小企業',
            'organization' => '東京都産業労働局',
            'deadline_days' => 60,
            'is_featured' => false
        ],
        [
            'title' => '【サンプル】大阪府ものづくり補助金',
            'content' => '大阪府内の製造業者が行う新製品・サービス開発や生産プロセスの改善等に要する設備投資等を支援する補助金制度です。',
            'prefecture' => '大阪府',
            'amount' => 10000000,
            'category' => '製造業・ものづくり',
            'difficulty' => 'hard',
            'success_rate' => 60,
            'subsidy_rate' => '1/2、2/3',
            'target' => '大阪府内の製造業者',
            'organization' => '大阪府商工労働部',
            'deadline_days' => 120,
            'is_featured' => true
        ],
        [
            'title' => '【サンプル】愛知県創業支援補助金',
            'content' => '愛知県内で新たに創業する方や創業間もない事業者を対象とした創業支援補助金です。店舗改装費、設備購入費、広告宣伝費等を支援します。',
            'prefecture' => '愛知県',
            'amount' => 2000000,
            'category' => '創業・起業支援',
            'difficulty' => 'normal',
            'success_rate' => 70,
            'subsidy_rate' => '1/2以内',
            'target' => '愛知県内で創業する個人・法人',
            'organization' => '愛知県産業労働部',
            'deadline_days' => 75,
            'is_featured' => false
        ],
        [
            'title' => '【サンプル】福岡県雇用促進助成金',
            'content' => '福岡県内の事業者が正社員の新規雇用や人材育成・研修を実施する際の費用を支援する助成金制度です。雇用の安定と人材確保を促進します。',
            'prefecture' => '福岡県',
            'amount' => 1500000,
            'category' => '人材育成・教育訓練',
            'difficulty' => 'easy',
            'success_rate' => 80,
            'subsidy_rate' => '2/3以内',
            'target' => '福岡県内の中小企業',
            'organization' => '福岡県商工部',
            'deadline_days' => 45,
            'is_featured' => false
        ],
        [
            'title' => '【サンプル】環境対策設備導入補助金',
            'content' => '省エネルギー設備や再生可能エネルギー設備の導入により、CO2削減に取り組む事業者を支援する全国対象の補助金制度です。',
            'prefecture' => '全国対応',
            'amount' => 8000000,
            'category' => '省エネ・環境対策',
            'difficulty' => 'normal',
            'success_rate' => 65,
            'subsidy_rate' => '1/3以内',
            'target' => '中小企業・個人事業主',
            'organization' => '経済産業省',
            'deadline_days' => 100,
            'is_featured' => true
        ]
    ];
    
    foreach ($sample_grants as $grant_data) {
        // 同じタイトルの投稿がなければ作成
        if (!get_page_by_title($grant_data['title'], OBJECT, 'grant')) {
            
            $deadline_timestamp = strtotime('+' . $grant_data['deadline_days'] . ' days');
            
            $post_id = wp_insert_post([
                'post_title'   => $grant_data['title'],
                'post_content' => $grant_data['content'],
                'post_excerpt' => wp_trim_words($grant_data['content'], 20),
                'post_type'    => 'grant',
                'post_status'  => 'publish',
                'meta_input'   => [
                    // 基本情報
                    'max_amount'         => number_format($grant_data['amount'] / 10000) . '万円',
                    'max_amount_numeric' => $grant_data['amount'],
                    'deadline_date'      => $deadline_timestamp,
                    'organization'       => $grant_data['organization'],
                    'application_status' => 'open',
                    
                    // ★新規項目: 新カードデザイン対応
                    'grant_difficulty'   => $grant_data['difficulty'],
                    'grant_success_rate' => $grant_data['success_rate'],
                    'subsidy_rate'       => $grant_data['subsidy_rate'],
                    'grant_target'       => $grant_data['target'],
                    'is_featured'        => $grant_data['is_featured'],
                    'views_count'        => rand(150, 800),
                    
                    // 追加の詳細情報
                    'application_period' => date('Y年n月j日', $deadline_timestamp - (86400 * $grant_data['deadline_days'])) . ' ～ ' . date('Y年n月j日', $deadline_timestamp),
                    'eligible_expenses'  => '設備費、システム導入費、コンサルティング費等',
                    'application_method' => 'オンライン申請',
                    'contact_info'       => $grant_data['organization'] . ' 補助金担当窓口',
                    'required_documents' => '申請書、事業計画書、見積書、会社概要等'
                ]
            ]);
            
            if ($post_id && !is_wp_error($post_id)) {
                // 都道府県を設定
                wp_set_object_terms($post_id, $grant_data['prefecture'], 'grant_prefecture');
                
                // カテゴリーを設定
                wp_set_object_terms($post_id, $grant_data['category'], 'grant_category');
                
                // アイキャッチ画像を設定（サンプル画像があれば）
                gi_set_sample_thumbnail($post_id, 'grant');
            }
        }
    }
}

/**
 * サンプルツールデータの投入
 */
function gi_insert_sample_tools() {
    $sample_tools = [
        [
            'title' => '【サンプル】Slack - チームコミュニケーションツール',
            'content' => 'チーム内のコミュニケーションを効率化するビジネスチャットツール。プロジェクト管理や外部サービス連携機能も豊富です。',
            'category' => 'コミュニケーション',
            'price_monthly' => 850,
            'price_free' => 1,
            'rating' => 4.7,
            'features' => 'リアルタイムメッセージング、ファイル共有、外部連携',
            'url' => 'https://slack.com',
            'company' => 'Slack Technologies'
        ],
        [
            'title' => '【サンプル】Trello - プロジェクト管理ツール',
            'content' => 'カンバン方式でタスクを視覚的に管理できるプロジェクト管理ツール。直感的な操作でチーム全体の進捗を把握できます。',
            'category' => 'プロジェクト管理',
            'price_monthly' => 0,
            'price_free' => 1,
            'rating' => 4.5,
            'features' => 'カンバンボード、タスク管理、チーム共有',
            'url' => 'https://trello.com',
            'company' => 'Atlassian'
        ],
        [
            'title' => '【サンプル】HubSpot CRM - 顧客管理システム',
            'content' => '営業・マーケティング・カスタマーサービスを統合したCRMプラットフォーム。顧客情報の一元管理が可能です。',
            'category' => 'マーケティング・CRM',
            'price_monthly' => 5400,
            'price_free' => 1,
            'rating' => 4.3,
            'features' => '顧客管理、営業パイプライン、メール配信',
            'url' => 'https://hubspot.com',
            'company' => 'HubSpot'
        ],
        [
            'title' => '【サンプル】freee会計 - クラウド会計ソフト',
            'content' => '中小企業向けのクラウド会計ソフト。簿記知識がなくても簡単に会計業務を行えます。確定申告にも対応。',
            'category' => '会計・経理',
            'price_monthly' => 2680,
            'price_free' => 0,
            'rating' => 4.2,
            'features' => '自動仕訳、確定申告、請求書作成',
            'url' => 'https://freee.co.jp',
            'company' => 'freee株式会社'
        ],
        [
            'title' => '【サンプル】Figma - デザインツール',
            'content' => 'Webブラウザで動作するUIデザインツール。リアルタイム共同編集機能により、チームでのデザイン制作が効率化されます。',
            'category' => 'デザイン・クリエイティブ',
            'price_monthly' => 1500,
            'price_free' => 1,
            'rating' => 4.8,
            'features' => 'UI/UXデザイン、プロトタイピング、リアルタイム共同編集',
            'url' => 'https://figma.com',
            'company' => 'Figma Inc.'
        ]
    ];
    
    foreach ($sample_tools as $tool_data) {
        if (!get_page_by_title($tool_data['title'], OBJECT, 'tool')) {
            $post_id = wp_insert_post([
                'post_title'   => $tool_data['title'],
                'post_content' => $tool_data['content'],
                'post_excerpt' => wp_trim_words($tool_data['content'], 15),
                'post_type'    => 'tool',
                'post_status'  => 'publish',
                'meta_input'   => [
                    'price_monthly' => $tool_data['price_monthly'],
                    'price_free'    => $tool_data['price_free'],
                    'rating'        => $tool_data['rating'],
                    'features'      => $tool_data['features'],
                    'tool_url'      => $tool_data['url'],
                    'company'       => $tool_data['company'],
                    'view_count'    => rand(200, 1000)
                ]
            ]);
            
            if ($post_id && !is_wp_error($post_id)) {
                wp_set_object_terms($post_id, $tool_data['category'], 'tool_category');
                gi_set_sample_thumbnail($post_id, 'tool');
            }
        }
    }
}

/**
 * サンプル申請のコツデータの投入
 */
function gi_insert_sample_grant_tips() {
    $sample_tips = [
        [
            'title' => '【サンプル】採択率を上げる事業計画書の書き方',
            'content' => '助成金の採択率を上げるための事業計画書作成のポイントを解説します。審査員に伝わりやすい構成や表現方法、数値の根拠の示し方など、具体的なテクニックをお教えします。',
            'category' => '事業計画書の書き方',
            'difficulty' => '中級',
            'reading_time' => 8
        ],
        [
            'title' => '【サンプル】申請書作成で絶対に避けるべき5つの失敗',
            'content' => '助成金申請でよくある失敗パターンを5つピックアップしました。これらを避けることで、書類不備による不採択を防げます。実際の失敗事例も交えて解説します。',
            'category' => 'よくある失敗例',
            'difficulty' => '初級',
            'reading_time' => 5
        ],
        [
            'title' => '【サンプル】必要書類を効率よく準備する方法',
            'content' => '助成金申請に必要な書類は多岐にわたります。効率よく準備するためのチェックリストや、書類作成の優先順位、外部専門家に依頼すべき書類の見極め方を説明します。',
            'category' => '必要書類の準備',
            'difficulty' => '初級',
            'reading_time' => 6
        ],
        [
            'title' => '【サンプル】面接・プレゼンテーション対策完全ガイド',
            'content' => '助成金によっては面接やプレゼンテーションが必要な場合があります。審査員への効果的なアピール方法、想定される質問への回答例、当日の服装や持ち物まで詳しく解説します。',
            'category' => '審査対策・面接準備',
            'difficulty' => '上級',
            'reading_time' => 12
        ],
        [
            'title' => '【サンプル】採択後の手続きで注意すべきポイント',
            'content' => '助成金に採択された後も重要な手続きが続きます。交付申請、事業実施、実績報告まで、各段階での注意点や必要書類、スケジュール管理のコツを説明します。',
            'category' => '採択後の手続き',
            'difficulty' => '中級',
            'reading_time' => 10
        ]
    ];
    
    foreach ($sample_tips as $tip_data) {
        if (!get_page_by_title($tip_data['title'], OBJECT, 'grant_tip')) {
            $post_id = wp_insert_post([
                'post_title'   => $tip_data['title'],
                'post_content' => $tip_data['content'] . "\n\n" . gi_generate_sample_tip_content($tip_data['category']),
                'post_excerpt' => wp_trim_words($tip_data['content'], 25),
                'post_type'    => 'grant_tip',
                'post_status'  => 'publish',
                'meta_input'   => [
                    'difficulty'     => $tip_data['difficulty'],
                    'reading_time'   => $tip_data['reading_time'],
                    'view_count'     => rand(100, 600),
                    'usefulness_rating' => rand(40, 50) / 10 // 4.0-5.0の評価
                ]
            ]);
            
            if ($post_id && !is_wp_error($post_id)) {
                wp_set_object_terms($post_id, $tip_data['category'], 'grant_tip_category');
                gi_set_sample_thumbnail($post_id, 'grant_tip');
            }
        }
    }
}

/**
 * サンプルのコンテンツ内容を生成する関数
 */
function gi_generate_sample_tip_content($category) {
    $content_templates = [
        '事業計画書の書き方' => "
## 1. 現状分析を明確に記載する
事業の現状を客観的に分析し、課題を明確に示します。

## 2. 数値目標を具体的に設定する
売上高、利益率、雇用創出数など、具体的な数値目標を設定しましょう。

## 3. 実現可能性を論理的に説明する
目標達成のための具体的な手順とスケジュールを示します。

## 4. 市場調査結果を活用する
業界動向や競合分析の結果を計画書に反映させます。

## 5. 収支計画を詳細に作成する
投資回収計画を含めた詳細な収支予測を作成します。",

        'よくある失敗例' => "
## 失敗例1: 申請締切間際の準備
締切直前では十分な準備ができません。余裕を持ったスケジュールを立てましょう。

## 失敗例2: 書類の不備・記載漏れ
チェックリストを作成し、第三者による確認を行いましょう。

## 失敗例3: 事業計画の根拠不足
数値や計画には必ず根拠を示し、実現可能性を説明しましょう。

## 失敗例4: 助成金制度の理解不足
制度の趣旨や要件を十分理解してから申請しましょう。

## 失敗例5: アフターフォローの軽視
採択後の手続きも重要です。事前に確認しておきましょう。",

        '必要書類の準備' => "
## 基本書類の準備
- 申請書（各助成金指定の様式）
- 事業計画書
- 収支予算書
- 会社概要・パンフレット

## 財務関連書類
- 決算書（直近2～3期分）
- 納税証明書
- 資金調達計画書

## 事業関連書類
- 見積書・カタログ
- 契約書・仕様書
- 市場調査資料

## その他必要に応じて
- 許認可証明書
- 従業員名簿
- 組織図",

        '審査対策・面接準備' => "
## 面接での基本マナー
- 時間厳守で会場に到着
- 適切な服装（ビジネススーツ推奨）
- 明確で簡潔な話し方

## よく聞かれる質問への準備
- 事業の独自性・新規性
- 市場での競争優位性
- 具体的な実施スケジュール
- 投資回収の見通し

## プレゼンテーション資料
- 視覚的で分かりやすいスライド
- 制限時間内での構成
- 想定質問への回答準備

## 当日の持ち物
- 申請書類一式
- 名刺
- 会社案内・パンフレット
- 補足資料",

        '採択後の手続き' => "
## 交付決定後の手続き
1. 交付決定通知書の受領
2. 事業実施計画の詳細化
3. 実施スケジュールの確定

## 事業実施中の注意点
- 計画変更時の事前相談
- 証拠書類の適切な保管
- 定期的な進捗報告

## 実績報告の準備
- 事業完了報告書の作成
- 収支実績書の準備
- 成果物・証拠書類の整理

## 事後管理
- 事業効果の継続測定
- 改善点の把握と対応
- 次回申請への活用"
    ];
    
    return $content_templates[$category] ?? "サンプルコンテンツです。実際の内容に置き換えてご利用ください。";
}

/**
 * サンプル画像を投稿にセットする関数
 */
function gi_set_sample_thumbnail($post_id, $post_type) {
    // プレースホルダー画像のURL（実際の運用では適切な画像に変更）
    $placeholder_images = [
        'grant' => 'https://via.placeholder.com/400x300/3B82F6/FFFFFF?text=Grant',
        'tool' => 'https://via.placeholder.com/400x300/10B981/FFFFFF?text=Tool',
        'grant_tip' => 'https://via.placeholder.com/400x300/F59E0B/FFFFFF?text=Tips'
    ];
    
    $image_url = $placeholder_images[$post_type] ?? $placeholder_images['grant'];
    
    // 実際の運用では、メディアライブラリに画像をアップロードして使用することを推奨
    // この例では簡単のためURLのみを保存
    update_post_meta($post_id, 'sample_thumbnail_url', $image_url);
}

/**
 * 【追加】カスタムフィールドの初期データ作成支援関数
 */
function gi_ensure_grant_meta_fields($post_id) {
    // 必要なメタフィールドが空の場合にデフォルト値を設定
    $required_fields = array(
        'grant_difficulty' => 'normal',
        'grant_success_rate' => rand(45, 85), // 45-85%のランダム値
        'subsidy_rate' => '2/3',
        'grant_target' => '中小企業',
        'is_featured' => false,
        'views_count' => rand(50, 500),
        'application_method' => 'オンライン申請',
        'eligible_expenses' => '設備費、人件費等',
        'contact_info' => '担当窓口まで'
    );
    
    foreach ($required_fields as $field => $default_value) {
        $current_value = get_post_meta($post_id, $field, true);
        if (empty($current_value) && $current_value !== '0' && $current_value !== 0) {
            update_post_meta($post_id, $field, $default_value);
        }
    }
}

/**
 * 【追加】助成金投稿保存時に自動でメタフィールドを補完
 */
function gi_auto_populate_grant_meta($post_id, $post, $update) {
    if ($post->post_type !== 'grant') {
        return;
    }
    
    // 新規投稿または既存投稿の更新時にメタフィールドを確認・補完
    gi_ensure_grant_meta_fields($post_id);
}
add_action('save_post', 'gi_auto_populate_grant_meta', 10, 3);

/**
 * 【追加】既存の助成金投稿に一括でメタフィールドを追加する関数
 */
function gi_bulk_update_grant_meta() {
    if (!current_user_can('manage_options')) {
        return 0;
    }
    
    $grants = get_posts(array(
        'post_type' => 'grant',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    ));
    
    $updated_count = 0;
    foreach ($grants as $grant) {
        gi_ensure_grant_meta_fields($grant->ID);
        $updated_count++;
    }
    
    return $updated_count;
}

/**
 * 【追加】管理画面用：メタフィールド一括更新ボタン
 */
function gi_add_grant_meta_update_button() {
    if (isset($_GET['update_grant_meta']) && $_GET['update_grant_meta'] === '1') {
        if (wp_verify_nonce($_GET['_wpnonce'], 'update_grant_meta')) {
            $count = gi_bulk_update_grant_meta();
            add_action('admin_notices', function() use ($count) {
                echo '<div class="notice notice-success"><p>' . $count . '件の助成金にメタフィールドを追加しました。</p></div>';
            });
        }
    }
}
add_action('admin_init', 'gi_add_grant_meta_update_button');

/**
 * 【追加】セットアップ完了状況を確認する関数
 */
function gi_check_setup_status() {
    $status = array(
        'setup_completed' => get_option('gi_initial_setup_completed', false),
        'grants_count' => wp_count_posts('grant')->publish,
        'tools_count' => wp_count_posts('tool')->publish,
        'tips_count' => wp_count_posts('grant_tip')->publish,
        'prefectures_count' => wp_count_terms('grant_prefecture'),
        'categories_count' => wp_count_terms('grant_category')
    );
    
    return $status;
}

/**
 * 【追加】管理画面にセットアップ状況を表示
 */
function gi_add_setup_status_dashboard() {
    if (current_user_can('manage_options')) {
        $status = gi_check_setup_status();
        
        add_action('admin_notices', function() use ($status) {
            if ($status['setup_completed']) {
                $setup_date = date('Y年n月j日 H:i', $status['setup_completed']);
                echo '<div class="notice notice-success"><p>';
                echo '<strong>Grant Insight Perfect セットアップ完了</strong><br>';
                echo "完了日時: {$setup_date}<br>";
                echo "助成金: {$status['grants_count']}件、ツール: {$status['tools_count']}件、コツ: {$status['tips_count']}件";
                echo '</p></div>';
            }
        });
    }
}
add_action('admin_init', 'gi_add_setup_status_dashboard');

/**
 * ========================================
 * 修正完了・動作確認用のテスト関数
 * ========================================
 */

/**
 * テーマの動作確認用デバッグ関数
 * （WP_DEBUGがtrueの管理者ユーザーのみで動作）
 */
function gi_debug_theme_status() {
    if (!current_user_can('administrator') || !defined('WP_DEBUG') || !WP_DEBUG) {
        return;
    }
    
    $debug_info = array(
        'version' => GI_THEME_VERSION ?? '1.0.0',
        'setup_status' => gi_check_setup_status(),
        'post_types_exist' => array(
            'grant' => post_type_exists('grant'),
            'tool' => post_type_exists('tool'),
            'grant_tip' => post_type_exists('grant_tip')
        ),
        'taxonomies_exist' => array(
            'grant_category' => taxonomy_exists('grant_category'),
            'grant_prefecture' => taxonomy_exists('grant_prefecture'),
            'tool_category' => taxonomy_exists('tool_category'),
            'grant_tip_category' => taxonomy_exists('grant_tip_category')
        ),
        'functions_exist' => array(
            'gi_safe_get_meta' => function_exists('gi_safe_get_meta'),
            'gi_render_grant_card' => function_exists('gi_render_grant_card'),
        ),
        'ajax_actions_exist' => array(
            'gi_load_grants' => has_action('wp_ajax_gi_load_grants'),
            'gi_toggle_favorite' => has_action('wp_ajax_gi_toggle_favorite')
        )
    );
    
    error_log('Grant Insight Debug Status: ' . print_r($debug_info, true));
}
add_action('init', 'gi_debug_theme_status', 999);

/**
 * 【追加】テーマ無効化時のクリーンアップ（オプション）
 */
function gi_theme_deactivation_cleanup() {
    // 注意: この関数を有効にすると、テーマ切り替え時にデータが削除されます
    // 本番環境では慎重に検討してください
    
    if (defined('GI_DELETE_DATA_ON_DEACTIVATION') && GI_DELETE_DATA_ON_DEACTIVATION) {
        // サンプルデータの削除（タイトルに【サンプル】が含まれるもの）
        $sample_posts = get_posts(array(
            'post_type' => array('grant', 'tool', 'grant_tip'),
            'posts_per_page' => -1,
            'post_status' => 'any',
            's' => '【サンプル】'
        ));
        
        foreach ($sample_posts as $post) {
            wp_delete_post($post->ID, true);
        }
        
        // オプション値の削除
        delete_option('gi_initial_setup_completed');
        delete_option('gi_newsletter_list');
        delete_option('gi_affiliate_clicks');
    }
}
// register_deactivation_hook(__FILE__, 'gi_theme_deactivation_cleanup'); // 必要に応じてコメントアウトを解除

/**
 * 【追加】アップグレード処理用の関数
 */
function gi_theme_upgrade_check() {
    $current_version = get_option('gi_theme_version', '0.0.0');
    $theme_version = GI_THEME_VERSION ?? '1.0.0';
    
    if (version_compare($current_version, $theme_version, '<')) {
        // バージョンアップ時の処理
        gi_theme_upgrade_process($current_version, $theme_version);
        update_option('gi_theme_version', $theme_version);
    }
}
add_action('init', 'gi_theme_upgrade_check');

/**
 * アップグレード処理の実装
 */
function gi_theme_upgrade_process($old_version, $new_version) {
    // 既存のカスタム投稿にメタフィールドを追加
    if (version_compare($old_version, '1.0.0', '<')) {
        gi_bulk_update_grant_meta();
    }
    
    // 新しいカテゴリーが追加された場合の処理
    gi_insert_tool_categories();
    gi_insert_grant_tip_categories();
    
    error_log("Grant Insight Theme upgraded from {$old_version} to {$new_version}");
}

/**
 * 【追加】管理画面用のセットアップ再実行ボタン
 */
function gi_add_admin_setup_tools() {
    if (current_user_can('manage_options')) {
        add_action('admin_menu', function() {
            add_management_page(
                'Grant Insight セットアップ',
                'Grant Insight セットアップ',
                'manage_options',
                'gi-setup',
                'gi_admin_setup_page'
            );
        });
    }
}
add_action('admin_init', 'gi_add_admin_setup_tools');

/**
 * 管理画面のセットアップページ
 */
function gi_admin_setup_page() {
    if (isset($_POST['run_setup'])) {
        if (wp_verify_nonce($_POST['_wpnonce'], 'gi_run_setup')) {
            gi_theme_activation_setup();
            echo '<div class="notice notice-success"><p>セットアップを実行しました。</p></div>';
        }
    }
    
    $status = gi_check_setup_status();
    ?>
    <div class="wrap">
        <h1>Grant Insight Perfect セットアップ</h1>
        
        <div class="card">
            <h2>セットアップ状況</h2>
            <table class="widefat">
                <tr><td>セットアップ完了</td><td><?php echo $status['setup_completed'] ? '完了' : '未完了'; ?></td></tr>
                <tr><td>助成金投稿数</td><td><?php echo $status['grants_count']; ?>件</td></tr>
                <tr><td>ツール投稿数</td><td><?php echo $status['tools_count']; ?>件</td></tr>
                <tr><td>コツ投稿数</td><td><?php echo $status['tips_count']; ?>件</td></tr>
                <tr><td>都道府県数</td><td><?php echo $status['prefectures_count']; ?>個</td></tr>
                <tr><td>カテゴリー数</td><td><?php echo $status['categories_count']; ?>個</td></tr>
            </table>
        </div>
        
        <div class="card">
            <h2>セットアップの実行</h2>
            <form method="post">
                <?php wp_nonce_field('gi_run_setup'); ?>
                <p>初期データの投入やサンプル投稿の作成を行います。</p>
                <button type="submit" name="run_setup" class="button button-primary">セットアップを実行</button>
            </form>
        </div>
        
        <div class="card">
            <h2>メタフィールドの一括更新</h2>
            <p>既存の助成金投稿に新しいメタフィールドを追加します。</p>
            <a href="<?php echo wp_nonce_url(admin_url('tools.php?page=gi-setup&update_grant_meta=1'), 'update_grant_meta'); ?>" 
               class="button">メタフィールドを更新</a>
        </div>
    </div>
    <?php
}