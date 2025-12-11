<?php
get_header();
$settings = get_option('basic_settings');
?>

<div id="preloader">
    <div class="loader"></div>
</div>

<?php get_template_part('templates/slider-homepage'); ?>

<div class="container container_pages mb-20p d-block mx-auto align-items-center p-0">

    <div class="section_categories d-flex flex-wrap mt-50p w-100">
        <img alt="camera lens" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/lensdivider.svg' ?>" width="150" height="70" class="d-block img-fluid m-auto" loading="lazy">
        <h1 class="w-100 d-block text-dark text-center"><?= get_the_title($post->ID) ?? ''; ?></h2>
            <div class="w-100 d-block text-dark text-center p-10p"><?= get_the_content($post->ID) ?? ''; ?></div>

            <div class="position-relative w-100">
                <?php if (!$GLOBALS['is_mobile']) { ?>
                    <div class="position-absolute divider w-100 text-center" style="background: #E1E1E1;height: 220px;top:120px;"></div>
                <?php } ?>
                <div style="z-index: 2">
                    <?php echo do_shortcode('[popular_categories]') ?>
                </div>
            </div>
    </div>

    <div class="w-70 w-sm-100 d-block mx-auto text-dark text-center p-10p">
        <?= get_post_meta($post->ID, 'homepage_mini_bio_more', true) ?? ''; ?>
    </div>

    <?php get_template_part('templates/testimonials'); ?>

    <a href="<?= $settings['airbnb'] ?? ''; ?>" target="_blank" class="pr-10p pl-10p">
        <?= do_shortcode('[trustindex no-registration=airbnb]'); ?>
    </a>
</div>

<style>
    [class="bg-fixed w-100 lazy-background <?= $GLOBALS['is_mobile'] ? 'mt-50p mb-20p' : 'mt-70p mb-50p' ?> visible"] {
        background: url('<?php echo get_post_meta($post->ID, 'parralax_image', true); ?>') no-repeat center center;
        background-attachment: <?= $GLOBALS['is_mobile'] ? 'scroll' : 'fixed' ?>;
        <?= $GLOBALS['is_mobile'] ? 'background-size:cover;' : '' ?>
    }
</style>
<div class="bg-fixed w-100 lazy-background <?= $GLOBALS['is_mobile'] ? 'mt-50p mb-20p' : 'mt-70p mb-50p' ?>" style="<?= $GLOBALS['is_mobile'] ? 'min-height: 250px' : 'min-height: 300px' ?>;">
    <div class="d-flex flex-wrap w-100  justify-content-center slider-title bg-trans" style="<?= $GLOBALS['is_mobile'] ? 'min-height: 250px' : 'min-height: 300px' ?>;">
        <div class="d-flex flex-wrap container__main m-auto">
            <span class="text-white ml-20p w-100 text-center pt-2 pt-lg-0 align-self-center parallax-text">Need a <span class="banner_italic text-secondary">Photographer</span> ? Someone With Experience to <span class="banner_italic text-secondary">Collaborate</span> With?</span>
            <div class="btn_container_borders ml-20p ml-sm-0 w-100">
                <a href="/contact-us/" class="border-btn text-white" target="_self" aria-label="LET'S WORK TOGETHER!">LET'S WORK TOGETHER!</a>
            </div>
        </div>

    </div>
</div>

<?php get_template_part('templates/contact-us'); ?>

<?php get_template_part('templates/follow-instagram'); ?>

<?php get_footer(); ?>