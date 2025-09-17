<?php /* Template Name: About Me Page */ ?>

<?php
get_header();
?>

<div id="preloader">
    <div class="loader"></div>
</div>

<?php
$settings  = get_option('basic_settings');
$prefix = 'about_';

$mainHeading = get_post_meta($post->ID, $prefix . 'heading', true);
$mainText = get_post_meta($post->ID, $prefix . 'welcome_text', true);


$mainImage = get_post_meta($post->ID, $prefix . 'bg_image', true);
$mainBgImage = get_post_meta($post->ID, $prefix . 'image', true);

$quote = get_post_meta($post->ID, $prefix . 'quote', true);
$miniBio = get_post_meta($post->ID, $prefix . 'mini_bio', true);
$miniBioReadMore = get_post_meta($post->ID, $prefix . 'mini_bio_more', true);

$miniBioImages = get_post_meta($post->ID, 'sliders', true);
$storyHeading = get_post_meta($post->ID, $prefix . 'heading_story', true);
$storyText = get_post_meta($post->ID, $prefix . 'story', true);
$storyTextMore = get_post_meta($post->ID, $prefix . 'story_more', true);

?>


<section class="container-fluid w-100 bg-img bg-overlay about-wrapper jarallax" style="height:750px;background-image: url('<?php echo $mainBgImage; ?>')">
    <div class="container p-0 container_pages d-flex flex-lg-row flex-column  align-items-center all-starups-area justify-content-center">
        <?php if ($GLOBALS['is_mobile']) { ?>
            <div class="w-100 pt-20p d-block">
                <p class="w-100 d-block text-center heading_title" style="color: #D1862B;">Vasileios Vasakos</p>
                <h1 class="w-100 d-block text-white text-center mb-4"><?= $mainHeading ?? ''; ?></h1>
                <div class="about_top_img" style="background-image: url('<?php echo $mainImage;  ?>');"></div>
                <div class="w-100 d-block text-white text-center p-10p"><?= $mainText ?? ''; ?></div>
            </div>
        <?php } else { ?>
            <div class="about_top_img" style="background-image: url('<?php echo $mainImage;  ?>');"></div>
            <div class="w-50 d-block">
                <p class="w-100 d-block text-center heading_title" style="color: #D1862B;">Vasileios Vasakos</p>
                <h1 class="w-100 d-block text-white text-center"><?= $mainHeading ?? ''; ?></h1>
                <div class="w-100 d-block text-white text-center p-10p"><?= $mainText ?? ''; ?></div>
            </div>
        <?php } ?>
    </div>
</section>

<div class="container">
    <blockquote class="wow fadeInUp text-center" data-wow-duration="1s" data-wow-delay=".3s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.4s; animation-name: fadeInUp;">
        <div class="line"></div>
        <?php echo $quote; ?>
        <div class="line"></div>
    </blockquote>

    <div class="all-starups-area d-flex flex-wrap mb-50p fix align-items-center justify-content-center">
        <div class="starups pr-lg-5 p-0">
            <div class="starups-details text-lg-left text-center">
                <div class="pt-10p text-dark">
                    <?= $miniBio ?>
                </div>
                <a data-target="read_more_2" class="border-btn text-dark border-btn-dark read-more-btn">Read More</a>
                <div id="read_more_2" class="read_more_text pt-10p text-dark">
                    <?= $miniBioReadMore ?>
                </div>
            </div>
        </div>
        <div class="gallery mt-3 mt-lg-0">
            <?php foreach ($miniBioImages as $image) { ?>
                <img loading="lazy" width="200" height="200" src="<?= $image['icon'] ?? '' ?>" alt="">
            <?php } ?>
        </div>
    </div>
</div>


<div class="mt-5 mb-5 counter-section-about">
    <?php
    get_template_part('templates/counter');
    ?>
</div>

<div class="w-100 d-flex container flex-wrap position-relative text-center mb-5 mt-5">
    <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/lensdivider.svg' ?>" alt="lens" width="150" height="70" class="d-block img-fluid m-auto" loading="lazy">
    <h2 class="w-100 d-block text-center"><?= $storyHeading ?></h2>
    <div class="w-100 d-block text-dark text-center p-10p">
        <?= $storyText ?>
    </div>
    <a data-target="read_more_3" class="border-btn text-dark border-btn-dark read-more-btn">Read More</a>
    <div id="read_more_3" class="read_more_text text-dark">
        <?= $storyTextMore ?>
    </div>
</div>


<?php get_template_part('templates/fun-facts'); ?>


<div class="container container_pages mt-40p mb-20p d-block mx-auto align-items-center p-0">
    <?php get_template_part('templates/testimonials'); ?>


    <div class="pr-10p pl-10p">
        <?= do_shortcode('[trustindex no-registration=airbnb]'); ?>
    </div>

    <?php get_template_part('templates/content-faq'); ?>
</div>


<?php
get_footer();
?>