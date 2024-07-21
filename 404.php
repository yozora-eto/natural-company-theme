<?php
/**
 * Default 404 page template.
 *
 * @package Natural_Company
 */
if ( !defined( 'ABSPATH' ) ) exit;

get_header();
get_template_part('template-parts/site-header');
?>
<div id="404" class="l-maincontainer 404page" >
<section class="l-pageheadline">
	<div class="l-pageheadline__container">
		<div class="l-pageheadline__subtext">Not Found</div>
		<h1 class="l-pageheadline__title">ページが見つかりません。</h1>
	</div>
</section>
<div class="p-404">
	<div class="p-404__text">お探しのページは見つかりませんでした！<br>他のページをお探しください。</div>
</div>
</div>
<?php
get_template_part('template-parts/breadcrumb');
get_template_part('template-parts/footer-contact');
get_template_part('template-parts/site-footer');
get_footer(); ?>