<?php
/**
 * Sideber template.
 *
 * @package Natural_Company
 */
if ( !defined( 'ABSPATH' ) ) exit;

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="l-widgetarea">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>