<?php
/**
 * Template part for footer section in all page.
 *
 * @package Natural_Company
 */
if ( !defined( 'ABSPATH' ) ) exit;

$get_mycustoms = get_option('my_custom');
if (empty($get_mycustoms['bottomlogo'])) {
    $my_custom_bottomlogo = esc_url(get_template_directory_uri()) . '/assets/img/sample-logo-white.png';
} else {
    $my_custom_bottomlogo = esc_html($get_mycustoms['bottomlogo']);
}
$my_custom_copyright = esc_html($get_mycustoms['copyright']);
?>
</main>
<footer class="l-footer">
    <div class="l-footer__contents">
        <a href="<?php echo esc_url(home_url()); ?>" class="l-footer__toplink">
            <img src="<?php echo $my_custom_bottomlogo; ?>" class="l-footer__logo">
        </a>
        <?php
        wp_nav_menu(array(
            'theme_location' => 'footer-menu',
            'container_id' => 'l-footer__container',
            'container_class' => 'l-footer__container',
            'menu_id' => 'l-footer__menu',
            'menu_class' => 'l-footer__menu',
        ));
        ?>
    </div>
    <div class="l-footer__copyarea">
    <a href="<?php echo esc_url(home_url()); ?>/privacy-policy/" class="l-footer__policy">プライバシーポリシー</a>
        <?php if (!empty($my_custom_copyright)) { ?>
            <span class="l-footer__separate">|</span>
            <p class="l-footer__copyright"><?php echo $my_custom_copyright; ?></p>
        <?php } ?>
    </div>
    <div class="l-footer__topscroll"><a href="#header" class="l-footer__junplink"><span class="material-symbols-outlined">
keyboard_arrow_up
</span></a></div>
</footer>