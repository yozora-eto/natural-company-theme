<?php
/**
 * Custom Post Category template for works.
 *
 * @package Natural_Company
 */
if ( !defined( 'ABSPATH' ) ) exit;
$get_customs = get_option('top_custom');
$custom_worktitle = esc_html($get_customs['worktitle']);
$custom_worksubtext = esc_html($get_customs['worksubtext']);
$custom_workpostlink = esc_html($get_customs['workpostlink']);
?>
<section class="l-pageheadline">
    <div class="l-pageheadline__container">
        <div class="l-pageheadline__subtext"><?php echo $custom_worksubtext; ?></div>
        <h1 class="l-pageheadline__title"><?php echo $custom_worktitle; ?></h1>
    </div>
    <div class="c-categoryhead">
        CATEGORY：<?php echo single_term_title('', false); ?>
    </div>
</section>
<div class="p-workarchive">
    <div class="p-workarchive__maincontainer">
        <?php if (have_posts()) : ?>
            <ul class="p-workarchive__list">
                <?php while (have_posts()) : the_post(); ?>
                    <li class="p-workarchive__item">
                        <div class="p-workarchive__itembox">
                            <div class="p-workarchive__datebox">
                                <span class="p-workarchive__date"><?php the_time('Y.m.d'); ?></span>
                                <p class="p-workarchive__title"><?php the_title(); ?></p>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="p-workarchive__link c-button"><?php echo $custom_workpostlink; ?></a>
                        </div>
                        <div class="p-workarchive__imgbox">
                            <?php $term = get_the_terms($post->ID, (get_post_type() == 'post' ? 'category' : 'works-cat'));
                            if (!empty($term)) {
                                $terms = $term[0];
                                $categoryname = $terms->name;
                            }
                            ?>
                            <?php if (!empty($term)) { ?>
                                <p class="p-workarchive__category"><?php echo $categoryname; ?></p>
                            <?php } ?>
                            <?php if (has_post_thumbnail()) :
                                $thumbID_work = get_post_thumbnail_id($post->ID);
                                $thumbAlt_work = get_post_meta($thumbID_work, '_wp_attachment_image_alt', true); ?>
                                <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php echo $thumbAlt_work; ?>" class="p-workarchive__img" loading="lazy">
                            <?php else : ?>
                                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/noimage.png" alt="no image" class="p-workarchive__img" loading="lazy">
                            <?php endif; ?>
                        </div>
                    </li>
                <?php endwhile; ?>
            <?php else : ?>
                <li class="p-workarchive__item">
                    <p class="p-workarchive__noitem">まだ投稿がありません。</p>
                </li>
            <?php endif; ?>
            </ul>
            <?php
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