<?php
/**
 * Template part for after area in single page.
 *
 * @package Natural_Company
 */
if ( !defined( 'ABSPATH' ) ) exit;

if ( ! is_active_sidebar( 'postafter-1' ) ) {
	return;
}
?>

<section id="postafter" class="l-postafter widget-area">
	<?php dynamic_sidebar( 'postafter-1' ); ?>
</section><!-- #secondary -->