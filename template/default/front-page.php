<?php
/**
 * Sub template fot front page.
 *
 * @package natural-company-theme 
 */
if ( !defined( 'ABSPATH' ) ) exit;

$get_customs = get_option('top_custom');

if (empty($get_customs['mvimg'])) {
    $top_custom_mvimg = esc_url(get_theme_file_uri()) . '/assets/img/sample-large.png';
} else {
    $top_custom_mvimg = esc_html($get_customs['mvimg']);
}
$top_custom_catch = nl2br(esc_html($get_customs['catch']));
$top_custom_subtitle = esc_html($get_customs['subtitle']);
if (empty($get_customs['aboutimg'])) {
    $top_custom_aboutimg = esc_url(get_theme_file_uri()) . '/assets/img/sample-medium.png';
} else {
    $top_custom_aboutimg = esc_url($get_customs['aboutimg']);
}
$top_custom_abouttitle = esc_html($get_customs['abouttitle']);
$top_custom_aboutsubtext = esc_html($get_customs['aboutsubtext']);
$top_custom_about = nl2br(esc_html($get_customs['about']));
$top_custom_aboutlink = esc_html($get_customs['aboutlink']);
$top_custom_servicetitle = esc_html($get_customs['servicetitle']);
$top_custom_service = nl2br(esc_html($get_customs['service']));
$top_custom_servicelink = esc_html($get_customs['servicelink']);
$top_custom_worktitle = esc_html($get_customs['worktitle']);
$top_custom_worksubtext = esc_html($get_customs['worksubtext']);
$top_custom_work = nl2br(esc_html($get_customs['work']));
$top_custom_worklink = esc_html($get_customs['worklink']);
$top_custom_workpostlink = esc_html($get_customs['workpostlink']);
$top_custom_map = esc_html($get_customs['map']);
$top_custom_companyname = esc_html($get_customs['companyname']);
$top_custom_address = esc_html($get_customs['address']);
$top_custom_tel = esc_html($get_customs['tel']);
$top_custom_mail = esc_html($get_customs['mail']);

get_header();
get_template_part('template-parts/site-header');
?>
<div id="top" class="p-top l-maincontainer">
    <section class="p-top-mv">
        <img src="<?php echo $top_custom_mvimg; ?>" alt="" class="p-top-mv__img">
        <?php if (!empty($top_custom_catch) && !empty($top_custom_subtitle)) { ?>
            <div class="p-top-mv__box">
                <div class="p-top-mv__contents">
                    <?php if (!empty($top_custom_subtitle)) { ?>
                        <span class="p-top-mv__subtext"><?php echo $top_custom_subtitle; ?></span>
                    <?php } ?>
                    <h2 class="p-top-mv__h2"><?php echo $top_custom_catch; ?></h2>
                </div>
            </div>
        <?php } ?>
    </section>
    <section class="p-top-about">
        <img src="<?php echo $top_custom_aboutimg; ?>" alt="about" class="p-top-about__img js-fadeintrigger" loading="lazy">
        <div class="p-top-about__contents">
            <div class="p-top-about__textbox">
                <div class="p-top-about__headline">
                    <span class="p-top-about__subtext"><?php echo $top_custom_aboutsubtext; ?></span>
                    <h2 class="p-top-about__h2"><?php echo $top_custom_abouttitle; ?></h2>
                </div>
                <p class="p-top-about__text">
                    <?php echo $top_custom_about; ?>
                </p>
            </div>
            <a href="<?php echo esc_url(home_url()); ?>/about/" class="p-top-about__link c-button"><?php echo $top_custom_aboutlink; ?></a>
        </div>
    </section>
    <section class="p-top-service">
        <div class="p-top-service__headline">
            <h2 class="p-top-service__h2"><?php echo $top_custom_servicetitle; ?></h2>
            <p class="p-top-service__description"><?php echo $top_custom_service; ?></p>
        </div>
        <div class="p-top-service__contents">
            <?php
            $args_service = array(
                'post_type' => 'serviceitem',
                'posts_per_page' => 6,
            );
            $the_query_service = new WP_Query($args_service); ?>
            <?php if ($the_query_service->have_posts()) : ?>
                <?php while ($the_query_service->have_posts()) : $the_query_service->the_post(); ?>
                    <a href="<?php the_permalink(); ?>" class="p-top-service__item js-fadeintrigger">
                        <?php if (has_post_thumbnail()) :
                            $thumbID_service = get_post_thumbnail_id($post->ID);
                            $thumbAlt_service = get_post_meta($thumbID_service, '_wp_attachment_image_alt', true); ?>
                            <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php echo $thumbAlt_service; ?>" class="p-top-service__itemimg" loading="lazy">
                        <?php else : ?>
                            <img src="<?php echo esc_url(get_theme_file_uri()); ?>/assets/img/noimage.png" alt="no image" class="p-top-service__itemimg" loading="lazy">
                        <?php endif; ?>
                        <h3 class="p-top-service__h3"><?php the_title(); ?></h3>
                    </a>
                <?php endwhile; ?>
            <?php else : ?>
                <p>まだ投稿がありません。</p>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </div>
        <div class="p-top-service__linkarea">
            <a href="<?php echo esc_url(home_url()); ?>/service/" class="p-top-service__link c-button"><?php echo $top_custom_servicelink; ?></a>
        </div>
    </section>
    <section class="p-top-work">
        <div class="p-top-work__left">
            <div class="p-top-work__headline">
                <span class="p-top-work__subtext"><?php echo $top_custom_worksubtext; ?></span>
                <h2 class="p-top-work__h2"><?php echo $top_custom_worktitle; ?></h2>
            </div>
            <p class="p-top-work__description"><?php echo $top_custom_work; ?></p>
            <a href="<?php echo esc_url(home_url()); ?>/works/" class="p-top-work__link c-button"><?php echo $top_custom_worklink; ?></a>
        </div>
        <?php
        $args_work = array(
            'post_type' => 'works',
            'posts_per_page' => 3,
            'order' => 'DESC'
        );
        $the_query_work = new WP_Query($args_work); ?>
        <ul class="p-top-work__list">
            <?php if ($the_query_work->have_posts()) : ?>
                <?php while ($the_query_work->have_posts()) : $the_query_work->the_post(); ?>
                    <li class="p-top-work__item">
                        <div class="p-top-work__itembox">
                            <div class="p-top-work__datebox">
                                <span class="p-top-work__date"><?php the_time('Y.m.d'); ?></span>
                                <p class="p-top-work__title"><?php the_title(); ?></p>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="p-top-work__link c-button"><?php echo $top_custom_workpostlink; ?></a>
                        </div>
                        <div class="p-top-work__imgbox js-fadeintrigger">
                        <?php $term = get_the_terms($post->ID, (get_post_type() == 'post' ? 'category' : 'works-cat'));
                        if (!empty($term)) {
                            $terms = $term[0];
                            $categoryname = $terms->name;
                        }
                        ?>
                        <?php if (!empty($term)) { ?>
                            <p class="p-top-work__category"><?php echo $categoryname; ?></p>
                        <?php } ?>
                        <?php if (has_post_thumbnail()) :
                            $thumbID_work = get_post_thumbnail_id($post->ID);
                            $thumbAlt_work = get_post_meta($thumbID_work, '_wp_attachment_image_alt', true); ?>
                            <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php echo $thumbAlt_work; ?>" class="p-top-work__img" loading="lazy">
                        <?php else : ?>
                            <img src="<?php echo esc_url(get_theme_file_uri()); ?>/assets/img/noimage.png" alt="no image" class="p-top-work__img" loading="lazy">
                        <?php endif; ?>
                        </div>
                    </li>
                <?php endwhile; ?>
            <?php else : ?>
                <li class="p-top-work__item">
                    <p>まだ投稿がありません。</p>
                </li>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </ul>
    </section>
    <section class="p-top-company">
        <div class="p-top-company__map">
            <?php if (!empty($top_custom_map)) { ?>
                <iframe src="<?php echo $top_custom_map; ?>" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <?php } ?>
        </div>
        <div itemscope itemtype="https://schema.org/Organization" class="p-top-company__contents">
            <h2 class="p-top-company__h2">会社概要</h2>
            <?php if (!empty($top_custom_companyname)) { ?>
                <p itemprop="name" class="p-top-company__text"><?php echo $top_custom_companyname; ?></p>
            <?php } ?>
            <?php if (!empty($top_custom_address)) { ?>
                <p  itemprop="address" itemscope itemtype="https://schema.org/PostalAddress" class="p-top-company__text"><span itemprop="name"><?php echo $top_custom_address; ?></span></p>
            <?php } ?>
            <?php if (!empty($top_custom_tel)) { ?>
                <p class="p-top-company__text">TEL：<span itemprop="telephone"><?php echo $top_custom_tel; ?></span></p>
            <?php } ?>
            <?php if (!empty($top_custom_mail)) { ?>
                <p class="p-top-company__text">MAIL：<span  itemprop="email"><?php echo $top_custom_mail; ?></span></p>
            <?php } ?>
        </div>
    </section>
    <?php
    get_template_part('template-parts/footer-contact');
    ?>
</div>
<?php
get_template_part('template-parts/site-footer');
get_footer(); ?>