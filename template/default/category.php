<?php
/**
 * Default category template.
 *
 * @package Natural_Company
 */
if ( !defined( 'ABSPATH' ) ) exit;

$category = '';

if (is_category()) { // カテゴリーページ
	$category = single_cat_title('', false);
} elseif (is_tax()) { // タクソノミーページ
	$category = single_term_title('', false);
} elseif (is_post_type_archive()) { //カスタム投稿タイプアーカイブページ
	$category = post_type_archive_title('', false);
}
?>
<section class="l-headline">
	<div class="l-headline__container">
		<div class="l-headline__subtext">Category</div>
		<h1 class="l-headline__title">ブログカテゴリー</h1>
	</div>
	<div class="c-categoryhead">
		CATEGORY：<?php echo $category; ?>
	</div>
</section>
<div class="p-archive l-maincontents">
	<div class="p-archive__maincontainer">
		<?php if (have_posts()) : ?>
			<div class="c-loop__box">
				<?php while (have_posts()) : the_post(); ?>
					<?php get_template_part('template-parts/post_loop'); ?>
				<?php endwhile; ?>
			</div>
		<?php else : ?>
			<div class="no-item">記事が投稿されていません。</div>
		<?php endif;
		if (function_exists('pagination_post')) :
			pagination_post($wp_query->max_num_pages, get_query_var('paged'));
		endif;
		?>
		<?php get_template_part('template-parts/postafter'); ?>
	</div>
	<div class="p-archive__sidebar l-sidebar">
		<?php get_sidebar(); ?>
	</div>
</div>
<?php
get_template_part('template-parts/breadcrumb');
?>