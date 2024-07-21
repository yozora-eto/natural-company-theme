<?php
/**
 * Custom Post Service item article list template.
 *
 * @package Natural_Company
 */
if ( !defined( 'ABSPATH' ) ) exit;

$get_customs = get_option('top_custom');
$custom_servicetitle = esc_html($get_customs['servicetitle']);
$custom_servicesubtext = esc_html($get_customs['servicesubtext']);
$custom_service = nl2br(esc_html($get_customs['service']));
?>
<section class="l-pageheadline">
    <div class="l-pageheadline__container">
        <div class="l-pageheadline__subtext"><?php echo $custom_servicesubtext; ?></div>
        <h1 class="l-pageheadline__title"><?php echo $custom_servicetitle; ?></h1>
    </div>
</section>
<div class="p-servicearchive">
    <div class="p-servicearchive__beforecontainer">
        <?php echo $custom_service; ?>
    </div>
    <div class="p-service__maincontainer">
        <?php if (have_posts()) : ?>
            <ul class="p-service__loopbox">
                <?php while (have_posts()) : the_post(); ?>
                    <li class="p-service__item">
                        <div class="p-service__imgbox">
                            <?php if (has_post_thumbnail()) :
                                $thumbID_work = get_post_thumbnail_id($post->ID);
                                $thumbAlt_work = get_post_meta($thumbID_work, '_wp_attachment_image_alt', true); ?>
                                <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php echo $thumbAlt_work; ?>" class="p-service__img" loading="lazy">
                            <?php else : ?>
                                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/noimage.png" alt="no image" class="p-service__img" loading="lazy">
                            <?php endif; ?>
                        </div>
                        <div class="p-service__itembox">
                            <div class="p-service__datebox">
                                <h2 class="p-service__title"><?php the_title(); ?></h2>
                                <?php $service_description = mb_substr(esc_html(get_post_meta($post->ID, 'service-description', true)), 0, 500); ?>
                                <div class="p-service__description"> <?php echo nl2br($service_description); ?></div>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="p-service__link c-button">詳細を見る</a>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else : ?>
            <div class="p-service__noitem">現在利用できるサービスはございません。</div>
        <?php endif;
        if (function_exists('pagination_post')) :
            pagination_post($wp_query->max_num_pages, get_query_var('paged'));
        endif;
        ?>
    </div>
</div>
<?php
get_template_part('template-parts/breadcrumb');
get_template_part('template-parts/footer-contact');
?>