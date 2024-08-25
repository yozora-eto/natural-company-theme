<?php
/**
 * Template part for breadcrumb in all page.
 *
 * @package Natural_Company
 */
if ( !defined( 'ABSPATH' ) ) exit;
?>

<div class="l-breadcrumb">
    <ol class="l-breadcrumb__list" itemscope itemtype="https://schema.org/BreadcrumbList">
        <li class="l-breadcrumb__listitem" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>" class="l-breadcrumb__link"><span itemprop="name">HOME</span></a></a>
            <meta itemprop="position" content="1">
        </li>
        <span class="l-breadcrumb__conect"> - </span>
        <?php if (is_home()) {
            $hometitle = 'ブログ';
        ?>
            <li class="l-breadcrumb__listitem" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('post')); ?>" class="l-breadcrumb__link">
                    <span itemprop="name"><?php echo $hometitle; ?></span>
                </a>
                <meta itemprop="position" content="2">
            </li>
        <?php } elseif (is_page() && $post->post_parent) { ?>
            <li class="l-breadcrumb__listitem" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a itemprop="item" href="<?php echo esc_url(get_page_link($post->post_parent)); ?>" class="l-breadcrumb__link">
                    <span itemprop="name"><?php echo get_the_title($post->post_parent); ?></span>
                </a>
                <meta itemprop="position" content="2">
            </li>
            <span class="l-breadcrumb__conect"> - </span>
            <li class="l-breadcrumb__listitem" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a itemprop="item" href="<?php echo esc_url(get_the_permalink()); ?>" class="l-breadcrumb__link">
                    <span itemprop="name"><?php echo get_the_title(); ?></span>
                </a>
                <meta itemprop="position" content="3">
            </li>
        <?php } elseif (is_page()) { ?>
            <li class="l-breadcrumb__listitem" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a itemprop="item" href="<?php echo esc_url(get_the_permalink()); ?>" class="l-breadcrumb__link">
                    <span itemprop="name"><?php echo get_the_title(); ?></span>
                </a>
                <meta itemprop="position" content="2">
            </li>
        <?php } elseif (is_year()) {
            $post_type = get_query_var('post_type');
            if ($post_type == '') {
                $post_type_name = 'ブログ';
                $post_type_link = esc_url(home_url('/')) . 'blog/';
            } else {
                $post_type_name = esc_html(get_post_type_object(get_post_type())->label);
                $post_type_link = esc_url(get_post_type_archive_link(get_post_type()));
            }
        ?>
            <li class="l-breadcrumb__listitem" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a itemprop="item" href="<?php echo $post_type_link; ?>" class="l-breadcrumb__link">
                    <span itemprop="name"><?php echo $post_type_name; ?></span>
                </a>
                <meta itemprop="position" content="2">
            </li>
            <span class="l-breadcrumb__conect"> - </span>
            <li class="l-breadcrumb__listitem" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a itemprop="item" href="<?php echo esc_url(get_year_link(get_query_var("year"))); ?>" class="l-breadcrumb__link">
                    <span itemprop="name"><?php echo get_query_var('year'); ?>年</span>
                </a>
                <meta itemprop="position" content="3">
            </li>
        <?php } elseif (is_month()) {
            $post_type = get_query_var('post_type');
            if ($post_type == '') {
                $post_type_name = 'ブログ';
                $post_type_link = esc_url(home_url('/')) . 'blog/';
            } else {
                $post_type_name = esc_html(get_post_type_object(get_post_type())->label);
                $post_type_link = esc_url(get_post_type_archive_link(get_post_type()));
            }
        ?>
            <li class="l-breadcrumb__listitem" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a itemprop="item" href="<?php echo $post_type_link; ?>" class="l-breadcrumb__link">
                    <span itemprop="name"><?php echo $post_type_name; ?></span>
                </a>
                <meta itemprop="position" content="2">
            </li>
            <span class="l-breadcrumb__conect"> - </span>
            <li class="l-breadcrumb__listitem" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a itemprop="item" href="<?php echo esc_url(get_year_link(get_query_var("year"))); ?>" class="l-breadcrumb__link">
                    <span itemprop="name"><?php echo get_query_var('year'); ?>年</span>
                </a>
                <meta itemprop="position" content="3">
            </li>
            <span class="l-breadcrumb__conect"> - </span>
            <li class="l-breadcrumb__listitem" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a itemprop="item" href="<?php echo esc_url(get_month_link(get_query_var("year"), get_query_var('monthnum'))); ?>" class="l-breadcrumb__link">
                    <span itemprop="name"><?php echo get_query_var('monthnum'); ?>月</span>
                </a>
                <meta itemprop="position" content="4">
            </li>
        <?php } elseif (is_tax()) { ?>
            <li class="l-breadcrumb__listitem" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link(get_post_type())); ?>" class="l-breadcrumb__link">
                    <span itemprop="name"><?php echo esc_html(get_post_type_object(get_post_type())->label); ?></span>
                </a>
                <meta itemprop="position" content="2">
            </li>
            <span class="l-breadcrumb__conect"> - </span>
            <li class="l-breadcrumb__listitem" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a itemprop="item" href="<?php echo esc_url(get_term_link($term, $taxonomy)); ?>" class="l-breadcrumb__link">
                    <span itemprop="name"><?php single_term_title(); ?></span>
                </a>
                <meta itemprop="position" content="3">
            </li>
        <?php } elseif (is_post_type_archive()) { ?>
            <li class="l-breadcrumb__listitem" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link(get_post_type())); ?>" class="l-breadcrumb__link">
                    <span itemprop="name"><?php post_type_archive_title(); ?></span>
                </a>
                <meta itemprop="position" content="2">
            </li>
        <?php } elseif (is_category()) {
            $post_type_name = 'ブログ';
            $post_type_link = esc_url(home_url('/')) . 'blog/'; ?>
            <li class="l-breadcrumb__listitem" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a itemprop="item" href="<?php echo $post_type_link; ?>" class="l-breadcrumb__link">
                    <span itemprop="name">ブログ</span>
                </a>
                <meta itemprop="position" content="2">
            </li>
            <?php
            $args = array(
                'hide_empty' => '0',
            );
            $cat = get_the_category($args);
            if (isset($cat, $cat[0])) {
                $cat = $cat[0];
                $category_id = get_query_var('cat');
                $category_name = single_cat_title('', false);
                $category_link = esc_url(get_category_link($category_id));
                //親カテゴリがあるか判別
                if (cat_is_ancestor_of($cat->category_parent, $category_id)) {
                    //親カテゴリIDを取得
                    $cat_id = get_category($cat->parent);
                    //親カテゴリ名を取得
                    $parent_name = $cat_id->name;
                    $parent_link = esc_url(get_category_link($cat_id)); ?>
                    <span class="l-breadcrumb__conect"> - </span>
                    <li class="l-breadcrumb__listitem" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a itemprop="item" href="<?php echo $parent_link; ?>" class="l-breadcrumb__link">
                            <span itemprop="name"><?php echo $parent_name; ?></span>
                        </a>
                        <meta itemprop="position" content="3">
                    </li>
                    <span class="l-breadcrumb__conect"> - </span>
                    <li class="l-breadcrumb__listitem" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a itemprop="item" href="<?php echo $category_link; ?>" class="l-breadcrumb__link">
                            <span itemprop="name"><?php echo $category_name; ?></span>
                        </a>
                        <meta itemprop="position" content="4">
                    </li>
                <?php   } else { ?>
                    <span class="l-breadcrumb__conect"> - </span>
                    <li class="l-breadcrumb__listitem" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a itemprop="item" href="<?php echo $category_link; ?>" class="l-breadcrumb__link">
                            <span itemprop="name"><?php echo $category_name; ?></span>
                        </a>
                        <meta itemprop="position" content="3">
                    </li>
            <?php }
            }
        } elseif (is_tag()) {
            $post_type_name = 'ブログ';
            $post_type_link = esc_url(home_url('/')) . 'blog/';
            $tag_id = get_query_var('tag');
            $tag_name = single_tag_title('', false);
            $tag_link = esc_url(get_tag_link($tag_id));
            ?>
            <li class="l-breadcrumb__listitem" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a itemprop="item" href="<?php echo $post_type_link; ?>" class="l-breadcrumb__link">
                    <span itemprop="name">ブログ</span>
                </a>
                <meta itemprop="position" content="2">
            </li>
            <span class="l-breadcrumb__conect"> - </span>
            <li class="l-breadcrumb__listitem" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a itemprop="item" href="<?php echo $tag_link; ?>" class="l-breadcrumb__link">
                    <span itemprop="name"><?php echo $tag_name; ?></span>
                </a>
                <meta itemprop="position" content="3">
            </li>
        <?php } elseif (is_archive()) {
            $post_type = get_query_var('post_type');
            if ($post_type == 'post') {
                $post_type_name = 'ブログ';
                $post_type_link = esc_url(home_url('/')) . 'blog/';
            } else {
                $post_type_name = esc_html(post_type_archive_title());
                $post_type_link = esc_url(get_post_type_archive_link(get_post_type()));
            }
        ?>
            <li class="l-breadcrumb__listitem" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a itemprop="item" href="<?php echo $post_type_link; ?>" class="l-breadcrumb__link">
                    <span itemprop="name">ブログ</span>
                </a>
                <meta itemprop="position" content="2">
            </li>
        <?php } elseif (is_single()) {
            $post_type = get_post_type();
            if ($post_type == 'post') {
                $post_type_name = 'ブログ';
                $post_type_link = esc_url(home_url('/')) . 'blog/';
            } else {
                $post_type_name = esc_html(get_post_type_object(get_post_type())->label);
                $post_type_link = esc_url(get_post_type_archive_link(get_post_type()));
            }
        ?>
            <li class="l-breadcrumb__listitem" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a itemprop="item" href="<?php echo $post_type_link; ?>" class="l-breadcrumb__link">
                    <span itemprop="name"><?php echo $post_type_name; ?></span>
                </a>
                <meta itemprop="position" content="2">
            </li>
            <span class="l-breadcrumb__conect"> - </span>
            <li class="l-breadcrumb__listitem" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a itemprop="item" href="<?php echo esc_url(get_the_permalink()); ?>" class="l-breadcrumb__link">
                    <span itemprop="name"><?php single_post_title(); ?></span>
                </a>
                <meta itemprop="position" content="3">
            </li>
        <?php } elseif (is_search()) { ?>
            <li class="l-breadcrumb__listitem" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <span itemprop="name">記事検索結果</span>
                <meta itemprop="position" content="2">
            </li>
        <?php } elseif (is_404()) { ?>
            <li class="l-breadcrumb__listitem" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <span itemprop="name">404 Not Found</span>
                <meta itemprop="position" content="2">
            </li>
        <?php } ?>
    </ol>
</div>