<?php
/**
 * Default page template.
 *
 * @package Natural_Company
 */
if ( !defined( 'ABSPATH' ) ) exit;

if (have_posts()) :
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
?>