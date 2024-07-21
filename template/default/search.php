<?php
/**
 * Default serach page template.
 *
 * @package Natural_Company
 */
if ( !defined( 'ABSPATH' ) ) exit;
?>

<section class="l-headline">
	<div class="l-headline__container">
		<div class="l-headline__subtext">Search</div>
		<h1 class="l-headline__title">ブログ検索</h1>
	</div>
	<div class="c-categoryhead">
		検索ワード：<?php the_search_query(); ?>
	</div>
</section>
<div class="p-search l-maincontents">
	<div class="p-archive__maincontainer">
		<?php if (have_posts() && get_search_query()) : ?>
			<div class="c-loop__box">
				<?php while (have_posts()) : the_post(); ?>
					<?php get_template_part('template-parts/post_loop'); ?>
				<?php endwhile; ?>
			</div>
		<?php else : ?>
			<div class="no-item">該当する記事が投稿されていません。<br>他を探してみてください。</div>
		<?php endif;
		if (function_exists('pagination_post')) :
			pagination_post($wp_query->max_num_pages, get_query_var('paged'));
		endif;
		?>
	</div>
	<div class="p-archive__sidebar l-sidebar">
		<?php get_sidebar(); ?>
	</div>
</div>
<?php
get_template_part('template-parts/breadcrumb');