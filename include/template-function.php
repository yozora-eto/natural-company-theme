<?php

/**
 * Original theme registration function.
 * 
 * Manage custom posts, original settings screens, and custom fields here.
 * カスタム投稿、オリジナル設定画面、カスタムフィールドはこちらで管理。
 *
 * @package Natural_Company 
 */
if (!defined('ABSPATH')) exit;

/**----------------------------------------
 * カスタム投稿の追加
 * ----------------------------------------*/

add_action('init', 'create_post_type');
if (!function_exists('create_post_type')) {
    function create_post_type()
    {
        register_post_type('works', array( //カスタム投稿の名前
            'label' => '制作実績', //管理画面に表示される名前
            'public' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'works'),
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_position' => 5,
            'show_in_rest' => true,
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
                'custom-fields',
                'excerpt',
                'trackbacks',
                'comments',
                'revisions',
                'page-attributes'
            ),
            'has_archive' => true
        ));

        register_post_type('serviceitem', array( //カスタム投稿の名前
            'label' => 'サービス', //管理画面に表示される名前
            'public' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'serviceitem'),
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_position' => 5,
            'show_in_rest' => true,
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
                'custom-fields',
                'excerpt',
                'trackbacks',
                'revisions',
                'page-attributes'
            ),
            'has_archive' => true
        ));

        //カテゴリ
        register_taxonomy(
            'works-cat',
            'works',
            array(
                'label' => 'カテゴリー',
                'hierarchical' => true,
                'public' => true,
                'show_in_rest' => true,
            )
        );
        //タグ
        register_taxonomy(
            'works-tag',
            'works',
            array(
                'label' => 'タグ',
                'hierarchical' => false,
                'public' => true,
                'show_in_rest' => true,
                'update_count_callback' => '_update_post_term_count',
            )
        );
    }
}

/**----------------------------------------
 * カスタムメニュー：ページ設定
 * ----------------------------------------*/
add_action('admin_menu', 'original_admin_menu');

if (!function_exists('original_admin_menu')) {
    function original_admin_menu()
    {
        add_menu_page(
            'ページ設定',
            '共通設定',
            'manage_options',
            'my_custom_menu',
            'my_custom_menu_page_contents',
            'dashicons-admin-generic',
            10
        );

        add_submenu_page(
            'my_custom_menu',
            'トップページ設定',
            'トップページ設定',
            'manage_options',
            'top_custom_menu',
            'top_custom_menu_page_contents',
            1
        );
    }
}

add_action('admin_init', 'original_custom_data');
if (!function_exists('original_custom_data')) {
    function original_custom_data()
    {

        $default_my    = array(
            'toplogo' => '',
            'contacttext' => '教育プログラムのご依頼や、サイトに関するお問い合わせ',
            'bottomlogo' => '',
            'copyright' => 'Copyright(C) All Rights Reserved.',
            'siteimg' => '',
            'twaccount' => '',
            'twcardsize' => 'summary_large_image',
            'fbappid' => '',
        );

        if (get_option('my_custom') == false) {
            update_option('my_custom', $default_my);
        }

        register_setting('my_custom_menu-group', 'my_custom', 'item_sanitize_my');

        $default_top    = array(
            'mvimg' => '',
            'catch' => 'サイトキャッチフレーズ',
            'subtitle' => 'Connect the future',
            'aboutimg' => '',
            'abouttitle' => 'わたしたちの取り組み',
            'aboutsubtext' => 'About',
            'about' => 'サンプルテキスト',
            'aboutlink' => 'わたしたちについてもっと知る',
            'servicetitle' => 'わたしたちにできること',
            'servicesubtext' => 'Service',
            'service' => '技術者育成のためにわたしたちが取り組んでいること',
            'servicelink' => 'すべてのサービスを見る',
            'worktitle' => '取り組みCASE',
            'worksubtext' => 'Work',
            'work' => '実際に取り組んだ事例',
            'worklink' => '一覧を見る',
            'workpostlink' => '詳細を見る',
            'map' => '',
            'companyname' => '株式会社サンプル',
            'address' => '〒000-0000　東京都◯◯区◯◯2-55　サンプルビル2階',
            'tel' => '00-0000-0000',
            'mail'    => 'yozora@mail.com',
        );

        if (get_option('top_custom') == false) {
            update_option('top_custom', $default_top);
        }

        register_setting('top_custom_menu-group', 'top_custom', 'item_sanitize_top');
    }
}

if (!function_exists('item_sanitize_my')) {
    function item_sanitize_my($args)
    {
        foreach ($args as $key => $value) {
            switch ($key) {

                case 'toplogo':
                case 'bottomlogo':
                case 'siteimg':
                    $args[$key] = esc_url($value);
                    break;
                case 'contacttext':
                case 'copyright':
                case 'twaccount':
                case 'twcardsize':
                case 'fbappid':
                    $args[$key] = esc_attr($value);
                    break;

                default:
                    echo '<br>no case:' . $key . '<br>';
            }
        }

        return $args;
    }
}

if (!function_exists('item_sanitize_top')) {
    function item_sanitize_top($args)
    {
        foreach ($args as $key => $value) {
            switch ($key) {

                case 'mvimg':
                case 'aboutimg':
                case 'map':
                    $args[$key] = esc_url($value);
                    break;
                case 'catch':
                case 'subtitle':
                case 'abouttitle':
                case 'aboutsubtext':
                case 'about':
                case 'aboutlink':
                case 'servicetitle':
                case 'servicesubtext':
                case 'service':
                case 'servicelink':
                case 'worktitle':
                case 'worksubtext':
                case 'work':
                case 'worklink':
                case 'workpostlink':
                case 'companyname':
                case 'address':
                case 'tel':
                case 'mail':
                    $args[$key] = esc_attr($value);
                    break;

                default:
                    echo '<br>no case:' . $key . '<br>';
            }
        }

        return $args;
    }
}

if (!function_exists('top_custom_settings_notices')) {
    function top_custom_settings_notices()
    {
        global $pagenow;
        if ($pagenow != 'admin.php') {
            return;
        }

        if (isset($_GET['settings-updated']) && true == $_GET['settings-updated']) { ?>
            <div id="settings_updated" class="updated notice is-dismissible">
                <p><strong>テキストを保存・更新しました。</strong></p>
            </div>
        <?php
        }
    }
}
add_action('admin_notices', 'top_custom_settings_notices');


if (!function_exists('my_custom_menu_page_contents')) {
    function my_custom_menu_page_contents()
    {
        if (!current_user_can('manage_options')) {
            wp_die(__('この設定ページのアクセス権限がありません'));
        }
        ?>
        <div class="wrap">
            <h1 class="wp-heading-inline">共通設定</h1>
            <p>サイト全体の共通設定を変更してください。</p>
            <form method="post" action="options.php" enctype="multipart/form-data" encoding="multipart/form-data">
                <?php
                settings_fields('my_custom_menu-group');
                do_settings_sections('my_custom_menu-group');
                ?>
                <p>
                    <?php submit_button('設定する', 'primary'); ?>
                </p>
                <div class="postbox">
                    <div class="postbox-header">
                        <h2 class="hndle">ヘッダー設定</h2>
                    </div>
                    <div class="inside">
                        <div class="main">
                            <div class="admin_mybox">
                                <h3 class="wp-heading-inline">ロゴ画像</h3>
                                <p>※画像をURLで指定してください。</p>
                                <p>
                                    <input type="url" name="my_custom[toplogo]" value="<?php echo esc_attr(get_option('my_custom')['toplogo']); ?>">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="postbox">
                    <div class="postbox-header">
                        <h2 class="hndle">お問い合わせボックス設定</h2>
                    </div>
                    <div class="inside">
                        <div class="main">
                            <div class="admin_mybox">
                                <h3 class="wp-heading-inline">表示テキスト</h3>
                                <p>お問い合わせエリアに表示させるテキストを入力してください。</p>
                                <p>
                                    <textarea name="my_custom[contacttext]" style="height: 150px;"><?php echo esc_attr(get_option('my_custom')['contacttext']); ?></textarea>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="postbox">
                    <div class="postbox-header">
                        <h2 class="hndle">フッター設定</h2>
                    </div>
                    <div class="inside">
                        <div class="main">
                            <div class="admin_mybox">
                                <h3 class="wp-heading-inline">ロゴ画像</h3>
                                <p>※画像をURLで指定してください。</p>
                                <p>
                                    <input type="url" name="my_custom[bottomlogo]" value="<?php echo esc_attr(get_option('my_custom')['bottomlogo']); ?>">
                                </p>
                            </div>
                            <div class="admin_mybox">
                                <h3 class="wp-heading-inline">コピーライト</h3>
                                <p>コピーライトのテキストを入力してください。</p>
                                <p>
                                    <input type="text" name="my_custom[copyright]" value="<?php echo esc_attr(get_option('my_custom')['copyright']); ?>">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="postbox">
                    <div class="postbox-header">
                        <h2 class="hndle">OGPタグ設定</h2>
                    </div>
                    <div class="inside">
                        <div class="main">
                            <p>OGPタグ(SNSシェア用のタグ)についての基本設定を行います。</p>
                            <div class="admin_mybox">
                                <h3 class="wp-heading-inline">サイト画像</h3>
                                <p>トップページや、サムネイルが設定されていないページで表示される画像をURLで指定してください。</p>
                                <p>
                                    <input type="url" name="my_custom[siteimg]" value="<?php echo esc_attr(get_option('my_custom')['siteimg']); ?>">
                                </p>
                            </div>
                            <div class="admin_mybox">
                                <h3 class="wp-heading-inline">X(旧Twitter)のアカウント名</h3>
                                <p>X(旧Twitter)のアカウント名を記入してください。(例：@sample)</p>
                                <p>
                                    <input type="text" name="my_custom[twaccount]" value="<?php echo esc_attr(get_option('my_custom')['twaccount']); ?>">
                                </p>
                            </div>
                            <div class="admin_mybox">
                                <h3 class="wp-heading-inline">X(旧Twitter)で表示されるカードサイズ</h3>
                                <p>X(旧Twitter)で表示させる画像サイズについて、どちらかを選択してください。</p>
                                <?php $twcardvalue = esc_attr(get_option('my_custom')['twcardsize']); ?>
                                <p class="admin_mybox_radio">
                                    <input type="radio" name="my_custom[twcardsize]" value="summary_large_image" <?php checked($twcardvalue, 'summary_large_image'); ?>><label>summary_large_image</label>
                                </p>
                                <p class="admin_mybox_radio">
                                    <input type="radio" name="my_custom[twcardsize]" value="summary" <?php checked($twcardvalue, 'summary'); ?>><label>summary</label>
                                </p>
                            </div>
                            <div class="admin_mybox">
                                <h3 class="wp-heading-inline">Facebook APP ID</h3>
                                <p>Facebook連携をする場合は、APP IDを記入してください。</p>
                                <p>
                                    <input type="text" name="my_custom[fbappid]" value="<?php echo esc_attr(get_option('my_custom')['fbappid']); ?>">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <p>
                    <?php submit_button('設定する', 'primary'); ?>
                </p>
            </form>
        </div>
    <?php
    }
}

if (!function_exists('top_custom_menu_page_contents')) {
    function top_custom_menu_page_contents()
    {
        if (!current_user_can('manage_options')) {
            wp_die(__('この設定ページのアクセス権限がありません'));
        }
    ?>
        <div class="wrap">
            <h1 class="wp-heading-inline">トップページ設定</h1>
            <p>トップページの設定を変更してください。</p>
            <form method="post" action="options.php" enctype="multipart/form-data" encoding="multipart/form-data">
                <?php
                settings_fields('top_custom_menu-group');
                do_settings_sections('top_custom_menu-group');
                ?>
                <p>
                    <?php submit_button('設定する', 'primary'); ?>
                </p>
                <div class="postbox">
                    <div class="postbox-header">
                        <h2 class="hndle">メインビジュアル</h2>
                    </div>
                    <div class="inside">
                        <div class="main">
                            <div class="admin_mybox">
                                <h3 class="wp-heading-inline">画像</h3>
                                <p>ページのトップに表示する画像をURLで指定してください。</p>
                                <p>
                                    <input type="url" name="top_custom[mvimg]" value="<?php echo esc_attr(get_option('top_custom')['mvimg']); ?>">
                                </p>
                            </div>
                            <div class="admin_mybox">
                                <h3 class="wp-heading-inline">キャッチコピー</h3>
                                <p>画像上に表示させるテキストを入力してください。</p>
                                <p>
                                    <textarea name="top_custom[catch]" style="height: 150px;"><?php echo esc_attr(get_option('top_custom')['catch']); ?></textarea>
                                </p>
                                <p>キャッチコピーの装飾テキストを入力してください。空欄で非表示となります。</p>
                                <p>
                                    <input type="text" name="top_custom[subtitle]" value="<?php echo esc_attr(get_option('top_custom')['subtitle']); ?>">
                                </p>
                                <span>※キャッチコピーとキャッチコピーの装飾どちらも空欄にすると、画像のみの表示となります。</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="postbox">
                    <div class="postbox-header">
                        <h2 class="hndle">About</h2>
                    </div>
                    <div class="inside">
                        <div class="main">
                            <div class="admin_mybox">
                                <h3 class="wp-heading-inline">画像</h3>
                                <p>Aboutに表示させる画像をURLで指定してください。</p>
                                <p>
                                    <input type="url" name="top_custom[aboutimg]" value="<?php echo esc_attr(get_option('top_custom')['aboutimg']); ?>">
                                </p>
                            </div>
                            <div class="admin_mybox">
                                <h3 class="wp-heading-inline">タイトル</h3>
                                <p>About部分のタイトルを入力してください。</p>
                                <p>
                                    <input type="text" name="top_custom[abouttitle]" value="<?php echo esc_attr(get_option('top_custom')['abouttitle']); ?>">
                                </p>
                                <p>タイトル上の装飾テキストを入力してください。</p>
                                <p>
                                    <input type="text" name="top_custom[aboutsubtext]" value="<?php echo esc_attr(get_option('top_custom')['aboutsubtext']); ?>">
                                </p>
                            </div>
                            <div class="admin_mybox">
                                <h3 class="wp-heading-inline">紹介文</h3>
                                <p>紹介文で表示させるテキストを入力してください。</p>
                                <p>
                                    <textarea name="top_custom[about]" style="height: 150px;"><?php echo esc_attr(get_option('top_custom')['about']); ?></textarea>
                                </p>
                            </div>
                            <div class="admin_mybox">
                                <h3 class="wp-heading-inline">もっと見るリンク</h3>
                                <p>詳細へ移動するリンクのテキストを入力してください。</p>
                                <p>
                                    <input type="text" name="top_custom[aboutlink]" value="<?php echo esc_attr(get_option('top_custom')['aboutlink']); ?>">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="postbox">
                    <div class="postbox-header">
                        <h2 class="hndle">Service</h2>
                    </div>
                    <div class="inside">
                        <div class="main">
                            <div class="admin_mybox">
                                <h3 class="wp-heading-inline">タイトル</h3>
                                <p>Service部分のタイトルを入力してください。</p>
                                <p>
                                    <input type="text" name="top_custom[servicetitle]" value="<?php echo esc_attr(get_option('top_custom')['servicetitle']); ?>">
                                </p>
                                <p>タイトル上の装飾テキストを入力してください。※トップページではなく、Serviceの一覧を表示させた時に使用します。</p>
                                <p>
                                    <input type="text" name="top_custom[servicesubtext]" value="<?php echo esc_attr(get_option('top_custom')['servicesubtext']); ?>">
                                </p>
                            </div>
                            <div class="admin_mybox">
                                <h3 class="wp-heading-inline">紹介文</h3>
                                <p>タイトル下に表示させるテキストを入力してください。</p>
                                <p>
                                    <textarea name="top_custom[service]" style="height: 150px;"><?php echo esc_attr(get_option('top_custom')['service']); ?></textarea>
                                </p>
                            </div>
                            <div class="admin_mybox">
                                <h3 class="wp-heading-inline">すべてを見るリンク</h3>
                                <p>一覧へ移動するリンクのテキストを入力してください。</p>
                                <p>
                                    <input type="text" name="top_custom[servicelink]" value="<?php echo esc_attr(get_option('top_custom')['servicelink']); ?>">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="postbox">
                    <div class="postbox-header">
                        <h2 class="hndle">Work</h2>
                    </div>
                    <div class="inside">
                        <div class="main">
                            <div class="admin_mybox">
                                <h3 class="wp-heading-inline">タイトル</h3>
                                <p>Work部分のタイトルを入力してください。</p>
                                <p>
                                    <input type="text" name="top_custom[worktitle]" value="<?php echo esc_attr(get_option('top_custom')['worktitle']); ?>">
                                </p>
                                <p>タイトル上の装飾テキストを入力してください。</p>
                                <p>
                                    <input type="text" name="top_custom[worksubtext]" value="<?php echo esc_attr(get_option('top_custom')['worksubtext']); ?>">
                                </p>
                            </div>
                            <div class="admin_mybox">
                                <h3 class="wp-heading-inline">紹介文</h3>
                                <p>タイトル下に表示させるテキストを入力してください。</p>
                                <p>
                                    <textarea name="top_custom[work]" style="height: 150px;"><?php echo esc_attr(get_option('top_custom')['work']); ?></textarea>
                                </p>
                            </div>
                            <div class="admin_mybox">
                                <h3 class="wp-heading-inline">リンク</h3>
                                <p>一覧へ移動するリンクのテキストを入力してください。</p>
                                <p>
                                    <input type="text" name="top_custom[worklink]" value="<?php echo esc_attr(get_option('top_custom')['worklink']); ?>">
                                </p>
                                <p>記事に移動するリンクのテキストを入力してください。</p>
                                <p>
                                    <input type="text" name="top_custom[workpostlink]" value="<?php echo esc_attr(get_option('top_custom')['workpostlink']); ?>">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="postbox">
                    <div class="postbox-header">
                        <h2 class="hndle">会社概要</h2>
                    </div>
                    <div class="inside">
                        <div class="main">
                            <div class="admin_mybox">
                                <h3 class="wp-heading-inline">地図</h3>
                                <p>※Google Mapの埋め込み用URLを入力してください。</p>
                                <p>
                                    <input type="url" name="top_custom[map]" value="<?php echo esc_attr(get_option('top_custom')['map']); ?>">
                                </p>
                            </div>
                            <div class="admin_mybox">
                                <h3 class="wp-heading-inline">会社情報</h3>
                                <p>会社情報を入力してください。空欄で非表示となります。</p>
                                <div class="admin_tr">
                                    <p>会社名</p>
                                    <p>
                                        <input type="text" name="top_custom[companyname]" value="<?php echo esc_attr(get_option('top_custom')['companyname']); ?>">
                                    </p>
                                </div>
                                <div class="admin_tr">
                                    <p>住所</p>
                                    <p>
                                        <input type="text" name="top_custom[address]" value="<?php echo esc_attr(get_option('top_custom')['address']); ?>">
                                    </p>
                                </div>
                                <div class="admin_tr">
                                    <p>電話番号</p>
                                    <p>
                                        <input type="text" name="top_custom[tel]" value="<?php echo esc_attr(get_option('top_custom')['tel']); ?>">
                                    </p>
                                </div>
                                <div class="admin_tr">
                                    <p>メールアドレス</p>
                                    <p>
                                        <input type="text" name="top_custom[mail]" value="<?php echo esc_attr(get_option('top_custom')['mail']); ?>">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p>
                    <?php submit_button('設定する', 'primary'); ?>
                </p>
            </form>
        </div>
<?php
    }
}


/**----------------------------------------
 * カスタムフィールドを登録
 * ----------------------------------------*/
if (!function_exists('my_add_meta_box')) {
    function my_add_meta_box()
    {
        add_meta_box(
            'noindex_box', //id
            'サイトマップ除外', //表示名
            'noindex_callback', //表示させるための関数
            'post', //投稿タイプ名
            'normal', //セクションの表示場所
        );

        add_meta_box(
            'noindex_box', //id
            'サイトマップ除外', //表示名
            'noindex_callback', //表示させるための関数
            'page', //投稿タイプ名
            'normal', //セクションの表示場所
        );

        add_meta_box(
            'headlines_subtext_box', //id
            '見出しの装飾用テキスト', //表示名
            'headlines_subtext_callback', //表示させるための関数
            'page', //投稿タイプ名
            'normal', //セクションの表示場所
        );

        add_meta_box(
            'work_description_box', //id
            '詳細に表示させる概要', //表示名
            'work_description_callback', //表示させるための関数
            'works', //投稿タイプ名
            'normal', //セクションの表示場所
        );

        add_meta_box(
            'service_description_box', //id
            '詳細に表示させる概要', //表示名
            'service_description_callback', //表示させるための関数
            'serviceitem', //投稿タイプ名
            'normal', //セクションの表示場所
        );
    }
}
add_action('admin_menu', 'my_add_meta_box');

if (!function_exists('noindex_callback')) {
    function noindex_callback()
    {

        global $post;

        //登録済の場合、情報を取得
        $noindex_status = get_post_meta(
            $post->ID,
            'noindex',
        );
        wp_nonce_field('action_noindex', 'nonce_noindex');
        $html_noindex = "<input id='noindex' type='checkbox' name='noindex' ";

        if ($noindex_status) {
            $html_noindex .= "checked";
        }

        $html_noindex .= " ><label for='noindex'>サイトマップ除外</label>";

        echo $html_noindex;
    }
}

if (!function_exists('headlines_subtext_callback')) {
    function headlines_subtext_callback()
    {

        global $post;

        wp_nonce_field('action_subtext', 'nonce_subtext');
        $html_subtext = '<input type="text" id="h_subtext" name="h_subtext" value="' . get_post_meta($post->ID, 'h_subtext', true) . '">';

        echo $html_subtext;
    }
}

if (!function_exists('work_description_callback')) {
    function work_description_callback()
    {

        global $post;

        wp_nonce_field('action_wdescription', 'nonce_wdescription');
        $html_w = '<p class="admin_mytext">※改行含めて200文字までしか表示できません。</p>';
        $html_w .= '<textarea id="work-description" name="work-description" style="height: 150px;">' . esc_attr(get_post_meta($post->ID, 'work-description', true)) . '</textarea>';

        echo $html_w;
    }
}

if (!function_exists('service_description_callback')) {
    function service_description_callback()
    {

        global $post;

        wp_nonce_field('action_sdescription', 'nonce_sdescription');
        $html_s = '<p class="admin_mytext">※改行含めて500文字までしか表示できません。</p>';
        $html_s .= '<textarea id="service-description" name="service-description" style="height: 150px;">' . esc_attr(get_post_meta($post->ID, 'service-description', true)) . '</textarea>';

        echo $html_s;
    }
}

//カスタムフィールドを保存するための関数
if (!function_exists('save_meta')) {
    function save_meta($post_id)
    {
        if (!isset($_POST['nonce_noindex'])) {
            return;
        }
        if (!wp_verify_nonce($_POST['nonce_noindex'], 'action_noindex')) {
            return;
        }

        if (isset($_POST['noindex'])) {
            update_post_meta($post_id, 'noindex', true);
        } else {
            delete_post_meta($post_id, 'noindex');
        }
    }
}
add_action('save_post', 'save_meta', 99, 1);

if (!function_exists('save_subtext')) {
    function save_subtext($post_id)
    {
        if (!isset($_POST['nonce_subtext'])) {
            return;
        }
        if (!wp_verify_nonce($_POST['nonce_subtext'], 'action_subtext')) {
            return;
        }
        if (isset($_POST['h_subtext'])) {
            $subtext_value = esc_attr($_POST['h_subtext']);
            update_post_meta($post_id, 'h_subtext', $subtext_value);
        } else {
            delete_post_meta($post_id, 'h_subtext');
        }
    }
}
add_action('save_post', 'save_subtext', 99, 1);

if (!function_exists('save_work_description')) {
    function save_work_description($post_id)
    {
        if (!isset($_POST['nonce_wdescription'])) {
            return;
        }
        if (!wp_verify_nonce($_POST['nonce_wdescription'], 'action_wdescription')) {
            return;
        }
        if (isset($_POST['work-description'])) {
            $workdescription_value = esc_attr($_POST['work-description']);
            update_post_meta($post_id, 'work-description', $workdescription_value);
        } else {
            delete_post_meta($post_id, 'work-description');
        }
    }
}
add_action('save_post', 'save_work_description', 99, 1);

if (!function_exists('save_service_description')) {
    function save_service_description($post_id)
    {
        if (!isset($_POST['nonce_sdescription'])) {
            return;
        }
        if (!wp_verify_nonce($_POST['nonce_sdescription'], 'action_sdescription')) {
            return;
        }
        if (isset($_POST['service-description'])) {
            $servicedescription_value = esc_attr($_POST['service-description']);
            update_post_meta($post_id, 'service-description', $servicedescription_value);
        } else {
            delete_post_meta($post_id, 'service-description');
        }
    }
}
add_action('save_post', 'save_service_description', 99, 1);
