<?php

/**
 * Default article template.
 *
 * @package Natural_Company
 */
if (!defined('ABSPATH')) exit;

if (have_posts()) : ?>
    <div class="p-post l-maincontents l-post">
        <?php
        while (have_posts()) : the_post();
            // カテゴリーのデータを取得
            $term = get_the_terms($post->ID, (get_post_type() == 'post' ? 'category' : 'works-cat'));
            if (empty($term)) {
                $cat = '';
            } else {
                $terms = $term[0];
                $cat = $terms->slug;
            }
        ?>
            <div class="p-post__main">
                <div class="p-post__header">
                    <div class="p-post__headlines">
                        <div class="p-post__subtext"><?php echo $cat; ?></div>
                        <h1 class="p-post__title"><?php the_title(); ?></h1>
                    </div>
                    <div class="p-post__metabox">
                        <?php if (!empty($term)) { ?>
                            <p class="p-post__category"><a href="<?php echo esc_url(get_category_link($terms->term_id)); ?>" class="p-post__categorylink"><?php echo $terms->name; ?></a></p>
                        <?php } ?>
                        <p class="p-post__time"><?php the_time('Y.m.d'); ?></p>
                    </div>
                </div>
                <article class="p-post__article article-block-onarea">
                    <?php if (has_post_thumbnail()) :
                        $thumbID = get_post_thumbnail_id($post->ID);
                        $thumbAlt = get_post_meta($thumbID, '_wp_attachment_image_alt', true); ?>
                        <div class="p-post__thumbnailbox">
                            <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php echo $thumbAlt ?>" class="p-post__thumbnail" loading="lazy">
                        </div>
                    <?php endif; ?>
                    <?php the_content(); ?>
                </article>
                <div class="p-post__tagarea">
                    <?php the_tags(' tags：', '', ''); ?>
                </div>
                <div class="p-post__snsarea">
                    <div class="p-post__snscontainer">
                        <div class="p-post__snssub">Share</div>
                        <div class="p-post__snstext">記事をシェアする</div>
                    </div>
                    <div class="p-post__snsbtn">
                        <a href="https://www.facebook.com/share.php?u=<?php echo get_the_permalink(); ?>" rel="nofollow noopener" target="_blank" class="p-post__snslink u-facebook"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/facebook-brands.svg" alt="Facebookシェアボタン" class="p-post__snsimg" loading="lazy"></a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo get_the_permalink(); ?>&text=<?php the_title(); ?>" rel="nofollow noopener" target="_blank" class="p-post__snslink u-twitter"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/x-twitter-brands.svg" alt="Xシェアボタン" class="p-post__snsimg" loading="lazy"></i></a>
                        <a href="https://b.hatena.ne.jp/add?mode=confirm&url=<?php echo get_the_permalink(); ?>&title=<?php the_title(); ?>" rel="nofollow noopener" target="_blank" class="p-post__snslink u-hatena"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/hatena.png" alt="hatenaシェアボタン" class="p-post__snsimg" loading="lazy"></a>
                        <a href="https://social-plugins.line.me/lineit/share?url=<?php echo get_the_permalink(); ?>" target="_blank" rel="nofollow noopener" class="p-post__snslink u-line"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/line-brands.svg" alt="LINEシェアボタン" class="p-post__snsimg" loading="lazy"></a>
                        <a href="https://yozora-eto.com/feed/" target="blank" rel="nofollow noopener" class="p-post__snslink u-feed"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/rss_feed.svg" alt="RSS Feed" class="p-post__snsimg" loading="lazy"></a>
                    </div>
                </div>
                <?php
                if (comments_open()) {
                    comments_template();
                }
                get_template_part('template-parts/postafter'); ?>
                <div class="p-post__btn">
                    <?php // 現在の投稿に隣接している前後の投稿を取得する
                    $prev_post = get_previous_post();  // 前の投稿を取得
                    $next_post = get_next_post();  // 次の投稿を取得
                    if ($prev_post || $next_post) {  // どちらか一方があれば表示
                    ?>
                        <?php if ($prev_post) { ?><p class="c-pagination__onprev"><?php previous_post_link('%link', '前の記事', false, ''); ?></p><?php } else { ?><p class="c-pagination__noprev">記事がありません。</p><?php } ?>
                        <p class="c-pagination__returnblog"><a href="<?php echo esc_url(home_url()); ?>/blog/">ブログ一覧へ戻る</a></p>
                        <?php if ($next_post) { ?><p class="c-pagination__onnext"><?php next_post_link('%link', '次の記事', false, ''); ?></p><?php } else { ?><p class="c-pagination__nonext">記事がありません。</p><?php } ?>
                    <?php } ?>
                </div>
            </div>
        <?php endwhile; ?>
        <div class="p-post__sidebar l-sidebar">
            <?php get_sidebar(); ?>
        </div>
    </div>
<?php
    get_template_part('template-parts/breadcrumb');
endif;
?>