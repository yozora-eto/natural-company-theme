<?php

/**
 * Main functions and definitions
 *
 * @package Natural_Company
 */

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

/**----------------------------------------
 * 分割functionの読み込み
 * ----------------------------------------*/
$function_files = [
  '/include/pagination.php',
  '/include/customize.php',
  '/include/template-function.php',
  '/include/custom-sitemap.php'
];

foreach ($function_files as $file) {
  if ((file_exists(__DIR__ . $file))) { // ファイルが存在する場合
    // ファイルを読み込む
    locate_template($file, true, true);
  } else { // ファイルが見つからない場合
    // エラーメッセージを表示
    trigger_error("`$file`ファイルが見つかりません", E_USER_ERROR);
  }
}

/**----------------------------------------
 * 更新通知初期化
 * ----------------------------------------*/
add_action('init', function () {
  require_once get_template_directory() . '/plugin-update-checker/plugin-update-checker.php';
  $myUpdateChecker = PucFactory::buildUpdateChecker(
    'https://demo.yozora-eto.com/theme/update/natural-company-theme-update.json',
    get_template_directory() . '/functions.php',
    'natural-company-theme'
  );
});


/**----------------------------------------
 * 初期設定
 * ----------------------------------------*/
function original_setup()
{
  //サムネイルを有効化
  add_theme_support('post-thumbnails');
  //ウィジェットの再読み込み
  add_theme_support('customize-selective-refresh-widgets');
  //フィード出力
  add_theme_support('automatic-feed-links');
  //フォーマットのHTML5化
  add_theme_support(
    'html5',
    array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
      'style',
      'script',
    )
  );
  //メニュー有効化
  add_theme_support('menus');
  register_nav_menus(array(
    'header-menu' => 'Header',
    'footer-menu'  => 'Footer',
  ));
  //カスタムロゴ有効化
  add_theme_support(
    'custom-logo',
    array(
      'height'      => 250,
      'width'       => 250,
      'flex-width'  => true,
      'flex-height' => true,
    )
  );
  //固定ページの抜粋有効化
  add_post_type_support('page', 'excerpt');
}
add_action('after_setup_theme', 'original_setup');

//ウィジェット　サイドバー作成
function original_widgets_init()
{
  register_sidebar(
    array(
      'name'          => esc_html__('Sidebar', 'original'),
      'id'            => 'sidebar-1',
      'description'   => esc_html__('Add widgets here.', 'original'),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
    )
  );

  register_sidebar(
    array(
      'name'          => esc_html__('Postafter', 'original'),
      'id'            => 'postafter-1',
      'description'   => esc_html__('Add widgets here.', 'original'),
      'before_widget' => '<div class="widget l-postafter__box">',
      'after_widget'  => '</div>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
    )
  );
}
add_action('widgets_init', 'original_widgets_init');

//stylesheet読み込み
function my_enqueue_scripts()
{
  wp_enqueue_style('default-style', get_theme_file_uri('/assets/css/style.css'), array(), filemtime(get_theme_file_path('/assets/css/style.css')));
}
add_action('wp_enqueue_scripts', 'my_enqueue_scripts');

// jsの読み込み
add_action('wp_enqueue_scripts', 'add_scripts');
function add_scripts()
{
  // デフォルトのjQueryを削除
  wp_deregister_script('jquery');

  // jQueryを読み込む
  wp_register_script(
    'jquery_script',
    'https://code.jquery.com/jquery-3.7.1.min.js',
    array(),
    '1.0',
    'true'
  );

  // メインのスクリプトを読み込む
  wp_enqueue_script(
    'main_script',
    get_template_directory_uri() . '/assets/js/main.js',
    array('jquery_script'),
    '1.0',
    'true'
  );
}

function my_admin_style()
{
  wp_enqueue_style('admin_style', get_theme_file_uri('/assets/css/my_admin.css'), array(), filemtime(get_theme_file_path('/assets/css/my_admin.css')));
}
add_action('admin_enqueue_scripts', 'my_admin_style');

/* main.js にdefer属性を付与 */
add_filter('script_loader_tag', 'add_defer', 10, 2);
function add_defer($tag, $handle)
{
  // 識別名がmain_script以外はそのまま返却
  if ($handle !== 'main_script') {
    return $tag;
  }

  // deferを追加して返却する
  return str_replace(' src=', ' defer src=', $tag);
}
