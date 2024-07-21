<?php
/**
 * Default template.
 *
 * @package Natural_Company
 */
if ( !defined( 'ABSPATH' ) ) exit;

if (is_single() || is_page()) { ?>
	<?php if (have_posts()) :
		while (have_posts()) : the_post(); ?>
			<section class="l-pageheadline">
				<div class="l-pageheadline__container">
					<?php $subtext = esc_html(get_post_meta($post->ID, 'h_subtext', true)); ?>
					<div class="l-pageheadline__subtext"><?php echo $subtext; ?></div>
					<h1 class="l-pageheadline__title"><?php the_title(); ?></h1>
				</div>
			</section>
			<div class="p-page">
				<article class="p-page__article article-block-onarea">
					<?php the_content(); ?>
				</article>
			</div>
	<?php endwhile;
	get_template_part('template-parts/breadcrumb');
	endif;
} elseif (is_archive()) { ?>
	<section class="l-headline">
		<div class="l-headline__container">
			<div class="l-headline__subtext">Archive</div>
			<h1 class="l-headline__title">アーカイブ</h1>
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
 } ?>