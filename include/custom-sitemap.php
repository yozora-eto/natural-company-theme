<?php

/**
 * customサイトマップ
 *
 * @package Natural_Company 
 */
if (!defined('ABSPATH')) exit;

function update_custom_sitemap()
{

  //トップページ 新着記事も更新されるので現在時刻にする
  $url = esc_url(home_url());
  $lastmod = date('Y-m-d\TH:i:s\Z');
  $xml = "<url><loc>{$url}</loc><lastmod>{$lastmod}</lastmod></url>";

  //固定ページを取得 固定ページを先に表示させるために取得分離
  $page_array = get_posts(array(
    'post_type' => array("page"),
    'posts_per_page' => -1,
    'meta_query' => array(
      array(
        'key' => 'noindex',
        'compare' => 'NOT EXISTS',
      )
    )
  ));

  if ($page_array) {
    foreach ($page_array as $page) {
      setup_postdata($page);
      $url_page = get_the_permalink($page->ID);
      $lastmod_page = date('Y-m-d\TH:i:s\Z', get_post_timestamp($page, "modified"));
      $xml .= "<url><loc>{$url_page}</loc><lastmod>{$lastmod_page}</lastmod></url>";
    }
    wp_reset_postdata();
  }

  //カテゴリ
  $cat_ids = get_terms(array("category", "works-cat"), array("fields" => "ids"));
  foreach ($cat_ids as $cat_id) {
    if (is_category($cat_id)) {
      $xml .= "<url><loc>" . get_category_link($cat_id) . "</loc></url>";
    } else {
      $xml .= "<url><loc>" . get_term_link($cat_id) . "</loc></url>";
    }
  }

  //記事ページを取得
  $posts_array = get_posts(array(
    'post_type' => array("works", "post"),
    'posts_per_page' => -1,
    'meta_query' => array(
      array(
        'key' => 'noindex',
        'compare' => 'NOT EXISTS',
      )
    )
  ));

  if ($posts_array) {
    foreach ($posts_array as $post) {
      setup_postdata($post);
      $url_post = get_the_permalink($post->ID);
      $lastmod_post = date('Y-m-d\TH:i:s\Z', get_post_timestamp($post, "modified"));
      $xml .= "<url><loc>{$url_post}</loc><lastmod>{$lastmod_post}</lastmod></url>";
    }
    wp_reset_postdata();
  }

  //xmlデータの整形
  $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\" >{$xml}</urlset>";

  //ファイルを書き出し
  file_put_contents(get_theme_file_path("sitemap.xml"), $xml, LOCK_EX);
}
add_action('save_post', 'update_custom_sitemap');
