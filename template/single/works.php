<?php
/**
 * Custom Post Works article template.
 *
 * @package Natural_Company
 */
if ( !defined( 'ABSPATH' ) ) exit;

if (have_posts()) :
    $get_customs = get_option('top_custom');
    $custom_worktitle = esc_html($get_customs['worktitle']);
    $custom_worksubtext = esc_html($get_customs['worksubtext']);
    $custom_workpostlink = esc_html($get_customs['workpostlink']);
    
    while (have_posts()) : the_post();
        // カテゴリーのデータを取得
        $term = get_the_terms($post->ID, (get_post_type() == 'post' ? 'category' : 'works-cat'));
        if (!empty($term)) {
            $terms = $term[0];
        }
?>
        <section class="l-pageheadline">
            <div class="l-pageheadline__container">
                <div class="l-pageheadline__subtext"><?php echo $custom_worksubtext; ?></div>
                <div class="l-pageheadline__title"><?php echo $custom_worktitle; ?></div>
            </div>
        </section>
        <div class="p-worksingle">
            <div class="p-worksingle__header">
                <div class="p-worksingle__headlines">
                    <h1 class="p-worksingle__title"><?php the_title(); ?></h1>
                    <div class="p-worksingle__metabox">
                        <?php if (!empty($term)) { ?>
                            <p class="p-worksingle__category"><a href="<?php echo esc_url(get_category_link($terms->term_id)); ?>" class="p-worksingle__categorylink"><?php echo $terms->name; ?></a></p>
                        <?php } ?>
                        <p class="p-worksingle__time"><?php the_time('Y.m.d'); ?></p>
                    </div>
                    <div class="p-worksingle__tagarea">
                        <?php echo get_the_term_list($post->ID, 'works-tag', 'tags：', '');; ?>
                    </div>
                    <div class="p-worksingle__description">
                        <?php $work_description = mb_substr(esc_html(get_post_meta($post->ID, 'work-description', true)), 0, 200); ?>
                        <?php echo nl2br($work_description); ?>
                    </div>
                </div>
                <?php if (has_post_thumbnail()) :
                    $thumbID = get_post_thumbnail_id($post->ID);
                    $thumbAlt = get_post_meta($thumbID, '_wp_attachment_image_alt', true); ?>
                    <div class="p-worksingle__thumbnailbox">
                        <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php echo $thumbAlt ?>" class="p-worksingle__thumbnail" loading="lazy">
                    </div>
                <?php endif; ?>
            </div>
            <article class="p-worksingle__article article-block-onarea">
                <?php the_content(); ?>
            </article>
            <div class="p-worksingle__btn">
                <?php // 現在の投稿に隣接している前後の投稿を取得する
                $prev_post = get_previous_post();  // 前の投稿を取得
                $next_post = get_next_post();  // 次の投稿を取得
                if ($prev_post || $next_post) {  // どちらか一方があれば表示
                ?>
                    <?php if ($prev_post) { ?><p class="c-pagination__onprev"><?php previous_post_link('%link', '前の記事', false, ''); ?></p><?php } else { ?><p class="c-pagination__noprev">記事がありません。</p><?php } ?>
                    <p class="c-pagination__returnblog"><a href="<?php echo esc_url(home_url()); ?>/works/">一覧へ戻る</a></p>
                    <?php if ($next_post) { ?><p class="c-pagination__onnext"><?php next_post_link('%link', '次の記事', false, ''); ?></p><?php } else { ?><p class="c-pagination__nonext">記事がありません。</p><?php } ?>
                <?php } ?>
            </div>
        </div>

        <?php
        get_template_part('template-parts/breadcrumb');
        get_template_part('template-parts/footer-contact');
        ?>
<?php endwhile;
endif;
?>