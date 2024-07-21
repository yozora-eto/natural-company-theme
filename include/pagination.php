<?php

/**
 * Pagination output function.
 * 
 * Pagination output is controlled here.
 * ページネーションの出力はこちらで制御しています。
 * 
 * $paged : 現在のページ
 * $pages : 全ページ数
 * $range : 左右に何ページ表示するか
 * $show_only : 1ページしかない時に表示するかどうか
 * 
 * @package Natural_Company 
 */
if (!defined('ABSPATH')) exit;

function pagination_post($pages, $paged, $range = 2, $show_only = false)
{

    $pages = (int) $pages;    //float型で渡ってくるので明示的に int型 へ
    $paged = $paged ?: 1;       //get_query_var('paged')をそのまま投げても大丈夫なように

    //表示テキスト
    $text_first   = "« 最初へ";
    $text_before  = "‹ 前へ";
    $text_next    = "次へ ›";
    $text_last    = "最後へ »";

    if ($show_only && $pages === 1) {
        // １ページのみで表示設定が true の時
        echo '<div class="c-pagination"><span class="current c-pagination__pager c-pagination__pager--current">1</span></div>;';
        return;
    }

    if ($pages === 1) return;    // １ページのみで表示設定もない場合

    if (1 !== $pages) {
        echo '<div class="c-pagination">';
        //２ページ以上の時
        if ($paged > $range + 1) {
            // 「最初へ」 の表示
            echo '<a href="', get_pagenum_link(1), '" class="c-pagination__first">', $text_first, '</a>';
        }
        if ($paged > 1) {
            // 「前へ」 の表示
            echo '<a href="', get_pagenum_link($paged - 1), '" class="c-pagination__prev">', $text_before, '</a>';
        }
        for ($i = 1; $i <= $pages; $i++) {

            if ($i <= $paged + $range && $i >= $paged - $range) {
                // $paged +- $range 以内であればページ番号を出力
                if ($paged === $i) {
                    echo '<span class="current c-pagination__pager c-pagination__pager--current">', $i, '</span>';
                } else {
                    echo '<a href="', get_pagenum_link($i), '" class="c-pagination__pager c-pagination__pager--link">', $i, '</a>';
                }
            }
        }
        if ($paged < $pages) {
            // 「次へ」 の表示
            echo '<a href="', get_pagenum_link($paged + 1), '" class="c-pagination__next">', $text_next, '</a>';
        }
        if ($paged + $range < $pages) {
            // 「最後へ」 の表示
            echo '<a href="', get_pagenum_link($pages), '" class="c-pagination__last">', $text_last, '</a>';
        }
        echo '</div>';
    }
}
