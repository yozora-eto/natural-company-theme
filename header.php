<?php

/**
 * Header template.
 *
 * @package Natural_Company
 */
if (!defined('ABSPATH')) exit;

$title = get_the_title();
$description = mb_substr(str_replace("\r\n", '', get_the_excerpt()), 0, 120);
$icon_url = get_site_icon_url(512, esc_url(get_theme_file_uri()) . '/assets/img/favicon.png');

if (is_category()) { // カテゴリーページ
  $title = single_cat_title('', false);
  $description = 'Category：' . $title . 'の記事一覧ページです。';
} elseif (is_tag()) { // タグページ
  $title = single_tag_title('', false);
  $description =  'Tag：' . $title . 'の記事一覧ページです。';
} elseif (is_tax()) { // タクソノミーページ
  $title = single_term_title('', false);
  $description = $title . 'の記事一覧ページです。';
} elseif (is_post_type_archive()) { //カスタム投稿タイプアーカイブページ
  $title = post_type_archive_title('', false);
  $description = $title . 'の記事一覧ページです。';
} elseif (is_search()) { //検索
  if (isset($_GET['s'])) {
    $title = 'キーワード：' . $_GET['s'] . 'の検索結果';
    $description = $title . 'ページです。';
  } else {
    $title = '記事検索結果';
    $description = '記事の検索結果ページです。';
  }
} elseif (is_404()) { //404
  $title = '404 Not Found';
  $description = '404 Not Found';
}

?>
<!DOCTYPE html>
<html lang="ja">

<head prefix="og: https://ogp.me/ns#">
  <meta charset="UTF-8">
  <?php if (is_home() || is_front_page()) { ?>
    <title><?php echo get_bloginfo('name'); ?></title>
    <meta name="description" content="<?php echo get_bloginfo('description'); ?>">
  <?php } else { ?>
    <title><?php echo $title; ?>｜<?php echo get_bloginfo('name'); ?></title>
    <meta name="description" content="<?php echo $description; ?>">
  <?php } ?>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <?php wp_head();
  if (function_exists('original_mata_ogp')) {
  original_mata_ogp();
  } ?>
  <link rel="shortcut icon" href="<?php echo $icon_url; ?>">
</head>

<body <?php body_class(); ?>>
  <div class="c-animation-bg"></div>
  <div <?php   if (function_exists('sub_body_id')) {
    sub_body_id();
    } ?> class="l-container">