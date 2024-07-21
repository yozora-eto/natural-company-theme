<?php
/**
 * Template part for header section in all page.
 *
 * @package Natural_Company
 */
if ( !defined( 'ABSPATH' ) ) exit;

$get_mycustoms = get_option('my_custom');

if (empty($get_mycustoms['toplogo'])) {
  $my_custom_toplogo =  esc_url(get_template_directory_uri()) . '/assets/img/sample-logo-black.png';
} else {
  $my_custom_toplogo = esc_html($get_mycustoms['toplogo']);
}
?>
<header header id="header" class="l-header">
  <h1 class="l-header__h1"><a href="<?php echo esc_url(home_url()); ?>/" class="l-header__toplink"><img src="<?php echo $my_custom_toplogo; ?>" class="l-header__logo" alt="ロゴマーク"></a></h1>
  <?php
  wp_nav_menu(array(
    'theme_location' => 'header-menu',
    'container' => 'nav',
    'container_id' => 'l-header__nav',
    'container_class' => 'l-header__nav',
    'menu_id' => 'l-header__menu',
    'menu_class' => 'l-header__menu-item',
  ));
  ?>
  <div class="l-header__hamburger"><span></span><span></span><span></span></div>
</header>
<main>