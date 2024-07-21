<?php

/**
 * Theme original additional functions.
 *
 * @package Natural_Company 
 */
if (!defined('ABSPATH')) exit;

/**----------------------------------------
 * Contact Form 7
 * Contact Form 7で自動挿入されるPタグ、brタグを削除
 * ----------------------------------------*/
add_filter('wpcf7_autop_or_not', 'wpcf7_autop_return_false');
function wpcf7_autop_return_false()
{
  return false;
}

/**----------------------------------------
 * ID,classを付与するコード
 * ----------------------------------------*/

//id付与
function sub_body_id()
{
  $post_obj =  $GLOBALS['wp_the_query']->get_queried_object();
  $slug = '';
  if (is_front_page()) {
    $slug = 'top';
    if (is_page() && get_post(get_the_ID())->post_name) {
      $slug = $post_obj->post_name;
    }
  } elseif (is_category()) {
    $slug = $post_obj->category_nicename;
  } elseif (is_tag()) {
    $slug = $post_obj->slug;
  } elseif (is_singular()) {
    $slug = $post_obj->post_name;
  } elseif (is_search()) {
    $slug  = $GLOBALS['wp_the_query']->posts ? 'search-results' : 'search-no-results';
  } elseif (is_404()) {
    $slug = 'error404';
  }
  $body_id = esc_attr($slug);
  echo ($body_id) ? 'id="' . $body_id . '"' : '';
}

//class付与
function sub_class()
{
  $post_obj =  $GLOBALS['wp_the_query']->get_queried_object();
  $slug = '';
  if (is_front_page()) {
    $slug = 'top';
    if (is_page() && get_post(get_the_ID())->post_name) {
      $slug = $post_obj->post_name;
    }
  } elseif (is_category()) {
    $slug = 'cat ' . $post_obj->category_nicename;
  } elseif (is_tag()) {
    $slug = 'tag ' . $post_obj->slug;
  } elseif (is_singular()) {
    $slug = $post_obj->post_type . ' ' . $post_obj->post_name;
  } elseif (is_search()) {
    $slug  = $GLOBALS['wp_the_query']->posts ? 'search-results' : 'search-no-results';
  } elseif (is_404()) {
    $slug = 'error404';
  }
  $my_classes = esc_attr($slug);
  echo ($my_classes) ? ' class="' . $my_classes . '"' : '';
}

/**----------------------------------------
 * OGPの出力設定
 * 基本設定はサイトにあわせて変更
 * ----------------------------------------*/
function original_mata_ogp()
{
  if (is_front_page() || is_home() || is_singular()) {

    global $post;

    $get_setting = get_option('my_custom');

    if (empty($get_setting['siteimg'])) {
      $custom_siteimg = esc_url(get_template_directory_uri()) . '/assets/img/noimage.png';
    } else {
      $custom_siteimg =  esc_url($get_setting['siteimg']);
    }
    $custom_account = esc_html($get_setting['twaccount']);
    $custom_cardsize = esc_html($get_setting['twcardsize']);
    $custom_appid = esc_html($get_setting['fbappid']);

    //------------ここから基本設定
    // 画像
    $ogp_image =  $custom_siteimg;
    // X(旧Twitter)のアカウント名 (@xxx)
    $twitter_site = $custom_account;
    // X(旧Twitter)カードの種類（summary_large_image または summary を指定）
    $twitter_card = $custom_cardsize;
    // Facebook APP ID
    $facebook_app_id = $custom_appid;
    //------------ここまで基本設定    

    $ogp_title = '';
    $ogp_description = '';
    $ogp_url = '';
    $html = '';

    if (is_singular()) {
      // 記事＆固定ページ
      setup_postdata($post);
      $ogp_title = $post->post_title;
      $ogp_description = mb_substr(get_the_excerpt(), 0, 100);
      $ogp_url = get_permalink();
      wp_reset_postdata();
    } elseif (is_front_page() || is_home()) {
      // トップページ
      $ogp_title = get_bloginfo('name');
      $ogp_description = get_bloginfo('description');
      $ogp_url = home_url();
    }

    // og:type
    $ogp_type = (is_front_page() || is_home()) ? 'website' : 'article';

    // og:image
    if (is_singular() && has_post_thumbnail()) {
      $ps_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
      $ogp_image = $ps_thumb[0];
    }

    // 出力するOGPタグをまとめる
    $html = "\n";
    $html .= '<meta property="og:title" content="' . esc_attr($ogp_title) . '">' . "\n";
    $html .= '<meta property="og:description" content="' . esc_attr($ogp_description) . '">' . "\n";
    $html .= '<meta property="og:type" content="' . $ogp_type . '">' . "\n";
    $html .= '<meta property="og:url" content="' . esc_url($ogp_url) . '">' . "\n";
    $html .= '<meta property="og:image" content="' . esc_url($ogp_image) . '">' . "\n";
    $html .= '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '">' . "\n";
    $html .= '<meta name="twitter:card" content="' . $twitter_card . '">' . "\n";
    $html .= '<meta name="twitter:site" content="' . $twitter_site . '">' . "\n";
    $html .= '<meta property="og:locale" content="ja_JP">' . "\n";
    if ($facebook_app_id != "") {
      $html .= '<meta property="fb:app_id" content="' . $facebook_app_id . '">' . "\n";
    }
    echo $html;
  }
}

/**
 *  コメント入力順序変更
 */
function comment_field_order($fields)
{
  $original_fields = array(
    'author'  => $fields['author'],
    'email'   => $fields['email'],
    'url'     => $fields['url'],
    'comment' => $fields['comment'],
    'cookies' => $fields['cookies'],
  );

  return $original_fields;
}
add_filter('comment_form_fields', 'comment_field_order');
