<?php
/**
 * Original page template: About.
 *
 * @package Natural_Company
 */
if ( !defined( 'ABSPATH' ) ) exit;
?>

<section class="l-pageheadline">
    <div class="l-pageheadline__container">
        <?php $subtext = esc_html(get_post_meta($post->ID, 'h_subtext', true)); ?>
        <div class="l-pageheadline__subtext"><?php echo $subtext; ?></div>
        <h1 class="l-pageheadline__title"><?php the_title(); ?></h1>
    </div>
</section>
<div class="p-about p-pagelayout">
    <article class="p-about__article p-pagelayout__article">
        <section class="p-pagelayout__section p-pagelayout__section--noback">
            <div class="p-pagelayout__innerbox p-pagelayout-centerimage">
                <img src="http://localhost/sample-site/wp-content/uploads/2024/07/about.jpg" alt="メインイメージ" class="p-pagelayout-centerimage__img js-fadeintrigger">
                <div class="p-pagelayout-centerimage__mainbox">
                    <div class="p-pagelayout-centerimage__left">
                        <h2 class="p-pagelayout-centerimage__h2">
                            ITの可能性を、<br>
                            わたしたちの手で広げる
                        </h2>
                    </div>
                    <div class="p-pagelayout-centerimage__right">
                        <div class="p-pagelayout-centerimage__text">
                            わたしたちは、Web業界を盛り上げるため、IT技術を持つ人材の育成に力を入れています。<br>
                            今後の未来を支える技術者たちを、わたしたちの手で育てる。<br>
                            その目標をかかげ、新たな教育の形を作り上げます。わたしたちは、Web業界を盛り上げるため、IT技術を持つ人材の育成に力を入れています。<br>
                            今後の未来を支える技術者たちを、わたしたちの手で育てる。<br>
                            その目標をかかげ、新たな教育の形を作り上げます。
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="p-pagelayout__section p-pagelayout__section--back">
            <div class="p-pagelayout__innerbox p-pagelayout-imgcolumn">
                <div class="p-pagelayout-imgcolumn__columnbox">
                    <img src="http://localhost/sample-site/wp-content/uploads/2024/07/about.jpg" alt="メインイメージ" class="p-pagelayout-imgcolumn__img js-fadeintrigger">
                    <img src="http://localhost/sample-site/wp-content/uploads/2024/07/about.jpg" alt="メインイメージ" class="p-pagelayout-imgcolumn__img js-fadeintrigger">
                    <img src="http://localhost/sample-site/wp-content/uploads/2024/07/about.jpg" alt="メインイメージ" class="p-pagelayout-imgcolumn__img js-fadeintrigger">
                </div>
                <div class="p-pagelayout-imgcolumn__mainbox">
                    <h2 class="p-pagelayout-imgcolumn__h2">
                        ITの可能性を、わたしたちの手で広げる
                    </h2>
                    <div class="p-pagelayout-imgimgcolumn__text">
                        わたしたちは、Web業界を盛り上げるため、IT技術を持つ人材の育成に力を入れています。<br>
                        今後の未来を支える技術者たちを、わたしたちの手で育てる。<br>
                        その目標をかかげ、新たな教育の形を作り上げます。わたしたちは、Web業界を盛り上げるため、IT技術を持つ人材の育成に力を入れています。<br>
                        今後の未来を支える技術者たちを、わたしたちの手で育てる。<br>
                        その目標をかかげ、新たな教育の形を作り上げます。
                    </div>
                </div>
            </div>
        </section>
        <section class="p-pagelayout__section p-pagelayout__section--noback">
            <div class="p-pagelayout__innerbox p-pagelayout-column">
                <div class="p-pagelayout-column__imgbox js-fadeintrigger">
                    <div class="p-pagelayout-column__subtext">About</div>
                    <img src="http://localhost/sample-site/wp-content/uploads/2024/07/about.jpg" alt="メインイメージ" class="p-pagelayout-column__img">
                </div>
                <div class="p-pagelayout-column__mainbox">
                    <h2 class="p-pagelayout-column__h2">
                        ITの可能性を、わたしたちの手で広げる
                    </h2>
                    <div class="p-pagelayout-column__text">
                        わたしたちは、Web業界を盛り上げるため、IT技術を持つ人材の育成に力を入れています。<br>
                        今後の未来を支える技術者たちを、わたしたちの手で育てる。<br>
                        その目標をかかげ、新たな教育の形を作り上げます。わたしたちは、Web業界を盛り上げるため、IT技術を持つ人材の育成に力を入れています。<br>
                        今後の未来を支える技術者たちを、わたしたちの手で育てる。<br>
                        その目標をかかげ、新たな教育の形を作り上げます。
                    </div>
                </div>
            </div>
        </section>
    </article>
</div>
<?php
get_template_part('template-parts/breadcrumb');
get_template_part('template-parts/footer-contact');
