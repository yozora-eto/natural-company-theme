<?php
/**
 * Original page template: Blog.
 * 
 * This template is a regular list of posts.
 *
 * @package Natural_Company
 */
if ( !defined( 'ABSPATH' ) ) exit;

$paged = get_query_var('paged') ?: 1;
$arg = array(
    'posts_per_page' => 5, // 表示する件数
    'paged' => $paged,
    'orderby' => 'date', // 日付でソート
    'order' => 'DESC', // DESCで最新から表示、ASCで最古から表示
    'post_type' => 'post'
);
$posts = new WP_Query($arg);;
?>
<section class="l-headline">
    <div class="l-headline__container">
    <?php $subtext = esc_html(get_post_meta($post->ID, 'h_subtext', true)); ?>
        <div class="l-headline__subtext"><?php echo $subtext; ?></div>
        <h1 class="l-headline__title"><?php the_title(); ?></h1>
    </div>
</section>
<div class="p-blog l-maincontents">
    <div class="p-blog__maincontainer">
        <?php if ($posts->have_posts()) : ?>
            <div class="p-blog__loopbox">
                <?php while ($posts->have_posts()) : $posts->the_post(); ?>
                    <?php get_template_part('template-parts/post_loop'); ?>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <div class="p-blog__no-item">記事が投稿されていません。</div>
        <?php endif;
        if (function_exists('pagination_post')) :
            pagination_post($posts->max_num_pages, $paged);
        endif;
        ?>
        <?php wp_reset_postdata(); ?>
        <?php get_template_part('template-parts/postafter'); ?>
    </div>
    <div class="p-blog__sidebar l-sidebar">
        <?php get_sidebar(); ?>
    </div>
</div>
<?php
get_template_part('template-parts/breadcrumb');