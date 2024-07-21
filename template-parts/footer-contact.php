<?php
/**
 * Template part for footer contact in all page.
 *
 * @package Natural_Company
 */
if ( !defined( 'ABSPATH' ) ) exit;

$get_mycustoms = get_option('my_custom');
$my_custom_contacttext = nl2br(esc_html($get_mycustoms['contacttext']));
?>

<section class="l-contact">
    <div class="l-contact__contents">
        <div class="l-contact__headline">
            <span class="l-contact__subtext">Contact</span>
            <h2 class="l-contact__h2">お問い合わせ</h2>
        </div>
        <?php if (!empty($my_custom_contacttext)) { ?>
            <p class="l-contact__description"><?php echo $my_custom_contacttext; ?></p>
        <?php } ?>
    </div>
    <a href="<?php echo esc_url(home_url()); ?>/contact/" class="l-contact__link c-button">CONTACT</a>
</section>