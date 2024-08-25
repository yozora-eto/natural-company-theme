<?php
/**
 * Template part for the loop part of the post.
 *
 * @package Natural_Company
 */
if ( !defined( 'ABSPATH' ) ) exit;
?>
<div class="c-postloop">
    <div class="c-postloop__item">
        <a href="<?php the_permalink(); ?>" class="c-postloop__imglink">
            <?php $term = get_the_terms($post->ID, (get_post_type() == 'post' ? 'category' : 'works-cat'));
            if (!empty($term)) {
                $terms = $term[0];
                $categoryname = $terms->name;
            }
            ?>
            <?php if (!empty($term)) { ?>
                <p class="c-postloop__category"><?php echo $categoryname; ?></p>
            <?php } ?>
            <?php if (has_post_thumbnail()) :
                $thumbID = get_post_thumbnail_id($post->ID);
                $thumbAlt = get_post_meta($thumbID, '_wp_attachment_image_alt', true); ?>
                <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php echo $thumbAlt ?>" class="c-postloop__img" loading="lazy">
            <?php else : ?>
                <img src="<?php echo esc_url(get_theme_file_uri()); ?>/assets/img/noimage.png" alt="no image" class="c-postloop__img" loading="lazy">
            <?php endif; ?>
        </a>
        <div class="c-postloop__contentbox">
            <div class="c-postloop__databox">
                <p class="c-postloop__postmetatime"><?php the_time('Y/m/d'); ?></p>
                <div class="c-postloop__posttitle"><?php the_title(); ?></div>
                <div class="c-postloop__excerpt">
                    <?php
                    if (!empty(get_the_content())) {
                        $content  = get_the_content();
                        echo mb_substr(strip_tags(strip_shortcodes($content)), 0, 50);
                    } ?>
                </div>
            </div>
            <div class="c-postloop__morebtn">
                <a href="<?php the_permalink(); ?>" class="c-button">詳細を読む</a>
            </div>
        </div>
    </div>
</div>