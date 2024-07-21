<?php
/**
 * Custom Post Service item article template.
 *
 * @package Natural_Company
 */
if ( !defined( 'ABSPATH' ) ) exit;

if (have_posts()) :
    $get_customs = get_option('top_custom');
    $custom_servicesubtext = esc_html($get_customs['servicesubtext']);
    while (have_posts()) : the_post();
?>
        <section class="l-pageheadline">
            <div class="l-pageheadline__container">
                <div class="l-pageheadline__subtext"><?php echo $custom_servicesubtext; ?></div>
                <h1 class="l-pageheadline__title"><?php the_title(); ?></h1>
            </div>
        </section>
        <div class="p-serviceingle">
            <article class="p-serviceingle__article article-block-onarea">
                <?php the_content(); ?>
            </article>
            <div class="p-serviceingle__btn">
                <p class="p-serviceingle__return"><a href="<?php echo esc_url(home_url()); ?>/service/">戻る</a></p>
            </div>
        </div>
        <?php
        get_template_part('template-parts/breadcrumb');
        get_template_part('template-parts/footer-contact');
        ?>
<?php endwhile;
endif;
?>