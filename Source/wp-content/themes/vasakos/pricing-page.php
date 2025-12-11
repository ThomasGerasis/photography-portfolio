<?php /* Template Name: Pricing Page */ ?>

<?php get_header();
$settings = get_option('basic_settings');

?>

<div id="preloader">
    <div class="loader"></div>
</div>


<!-- Breadcrumb Area Start -->
<section class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url('<?php echo get_the_post_thumbnail_url($post->ID) ?>')">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="breadcrumb-content text-center">
                    <h2 class="page-title">Pricing</h1>

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>"><i class="fas fa-home"></i> Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Pricing</li>
                            </ol>
                        </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Area End -->

<div class="container container_pages mt-20p mb-20p d-block mx-auto align-items-center">
    <section class="pricing-section mt-2 mb-5">
        <h1 class="section-title w-100 d-block text-dark text-center">Pricing - Packages in Edinburgh</h1>
        <h3 class="heading_title w-100 d-block text-dark text-center mb-5">Photoshooting couples, families, and solo travelers in the Old Town of Edinburgh.</h3>

        <div class="pricing-cards mt-5 mb-5">
            <?php $packages = get_post_meta($post->ID, 'pricing', true);
            if (!empty($packages)) {
                foreach ($packages as $id => $package) { ?>
                    <div class="card h-100 d-flex flex-column">
                        <div class="card-img-wrapper">
                            <img src="<?= $package['image'] ?? '' ?>" alt="<?= $package['title'] ?? '' ?>" class="card-img-top" />
                        </div>
                        <div class="card-body d-flex flex-column flex-grow-1">
                            <h5 class="card-title"><?= $package['title'] ?? '' ?></h5>
                            <div class="meta mb-2">
                                <span><i class="fas fa-pound-sign"></i><?= $package['price'] ?></span>
                                <span><i class="fas fa-clock"></i><?= $package['hours'] ?? '1' ?></span>
                            </div>
                            <p class="card-text"><?= $package['description'] ?? '' ?></p>
                            <div class="mt-auto mx-auto">
                                <a href="#contactForm" class="package-btn alime-btn bg-secondary" data-service="<?= $id ?? '' ?>">Book This Package</a>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>

        </div>
    </section>
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
            <span class="text-white ml-20p w-100 text-center pt-2 pt-lg-0 align-self-center parallax-text">Need something <span class="banner_italic text-secondary">custom ? </span> We create tailored packages for unique<span class="banner_italic text-secondary"> needs</span> </span>
            <div class="btn_container_borders ml-20p ml-sm-0 w-100">
                <a href="#contactForm" class="border-btn text-white" target="_self" aria-label="Get a Custom Quote!">Get a Custom Quote!</a>
            </div>
        </div>

    </div>
</div>

<div class="container container_pages mt-40p mb-20p d-block mx-auto align-items-center p-0">
    <?php get_template_part('templates/content-faq'); ?>

    <a href="<?= $settings['airbnb'] ?? ''; ?>" target="_blank" class="pr-10p pl-10p">
        <?= do_shortcode('[trustindex no-registration=airbnb]'); ?>
    </a>

    <?php get_template_part('templates/contact-us', null, ['packages' => $packages, 'settings' => $settings]); ?>
</div>




<?php get_footer(); ?>