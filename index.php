<?php

/**
 * The main template file
 * 
 * @package natural-company-theme
 */
if (!defined('ABSPATH')) exit;

$folder = 'template/default/';
$mainclass = '';
$parent = 'template/';

if (is_home() || is_front_page()) {
	$folder = $parent . 'page/';
	$slug = 'front-page';
	$mainclass = 'top_main';
} elseif (is_search()) {
	$folder .= $parent . 'page/';
	$slug = 'search';
	$mainclass = 'sub_main search';
} elseif (is_page()) {
	$folder = $parent . 'page/';
	$slug = $post->post_name;
	$mainclass = 'sub_main ' . $slug . '_main';
} elseif (is_single()) {
	$folder = $parent . 'single/';
	$slug = get_post_type();
	$mainclass = 'sub_main ' . $slug . '_main';
} elseif (is_tax()) {
	$folder = $parent . 'archive/';
	$slug = get_query_var('taxonomy');
	$mainclass = 'sub_main ' . $slug . '_main';
} elseif (is_archive()) {
	$folder = $parent . 'archive/';
	$slug = get_query_var('post_type');
	$mainclass = 'sub_main ' . $slug . '_main';
	if (is_category()) {
		$cat = get_the_category();
		$cat = $cat[0];
		//親カテゴリがあるか判別
		if ($cat->category_parent) {
			//親カテゴリIDを取得
			$parent_cat = get_category($cat->parent);
			//親カテゴリ名を取得
			$parent_name = $parent_cat->slug;
			$folder = $parent . 'archive/';
			$slug = $parent_name;
			$mainclass = 'sub_main ' . $slug . '_main';
		} else {
			$folder = $parent . 'archive/';
			$slug = get_query_var('category_name');
			$mainclass = 'sub_main ' . $slug . '_main';
		}
	} elseif (is_tag()) {
		$folder = $parent . 'archive/';
		$slug = get_query_var('tag');
		$mainclass = 'sub_main ' . $slug . '_main';
	}
}

$file = $folder . $slug;

if (locate_template($file . '.php') == '') {
	$folder = 'template/default/';
	if (is_page()) {
		$file = $folder . 'page';
	} elseif (is_single()) {
		$file = $folder . 'single';
	} elseif (is_search()) {
		$file = $folder . 'search';
	} elseif (is_archive()) {
		$file = $folder . 'archive';
		if (is_category()) {
			$file = $folder . 'category';
		} elseif (is_tag()) {
			$file = $folder . 'tag';
		}
	} else {
		$file = $folder . 'default';
	}
}

get_header();
get_template_part('template-parts/site-header');
?>
<div id="<?= $mainclass; ?>" class="l-maincontainer <?= $mainclass; ?>">
	<?php get_template_part($file); ?>
</div>
<?php
get_template_part('template-parts/site-footer');
get_footer(); ?>