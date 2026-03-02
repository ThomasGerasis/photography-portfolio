<?php
get_header();
?>

<div id="preloader">
    <div class="loader"></div>
</div>

<?php
$category = get_queried_object();
$orderBy = $category->term_id === 4 ? 'DESC' : 'ASC';
$postsPerPage = get_option('posts_per_page');

// Get ACF custom fields
$image =  get_field('category_image', 'category_' . $category->term_id);
$category_heading = get_field('category_heading', 'category_' . $category->term_id);
$category_description = get_field('category_description', 'category_' . $category->term_id);
$category_content = get_field('category_content', 'category_' . $category->term_id);
?>

<!-- Hero Section Start -->
<section class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url('<?php echo esc_url($image); ?>')">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12 pb-20p pt-20p">
                <h1 class="page-title text-white text-center"><?php echo !empty($category_heading) ? esc_html($category_heading) : esc_html($category->name); ?></h1>
                <?php if (!empty($category_description)) : ?>
                    <div class="hero-description text-white align-self-center text-center mt-3">
                        <?php echo do_shortcode($category_description); ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>
</section>
<!-- Hero Section End -->

<div class="container_pages mt-20p mb-20p d-block mx-auto align-items-center">

    <div class="container mb-20p text-center w-60 w-sm-100 d-block mx-auto align-items-center p-0">
        <h2 class="text-dark text-center heading_title"> <?= esc_html($category->name) ?> Portfolio</h2>
        <img alt="camera" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/camera.svg' ?>" style="filter: invert(1);" width="30" height="30" class="d-block img-fluid m-auto" loading="lazy">
    </div>

    <?php
    global $wp_query;
    $query = new WP_Query(array_merge(
        $wp_query->query,
        array(
            'post_type' => 'photos',
            'orderby'   => 'publish_date',
            'order'     => $orderBy,
            'posts_per_page' => $postsPerPage
        )
    ));
    ?>
    <div class="alime-portfolio-area clearfix">
        <div class="container-fluid">
            <div class="masonry-layout-container img-gallery-magnific" data-category-id="<?= $category->term_id ?>" data-max-pages="<?php echo $query->max_num_pages; ?>" data-per-page="<?= esc_attr($postsPerPage); ?>">
                <?php
                while ($query->have_posts()) : $query->the_post();
                    if (!has_post_thumbnail()) {
                        continue;
                    }
                ?>
                    <div class="magnific-img single_gallery_item media-slice nature mb-30 wow fadeInUp" data-wow-delay="100ms">
                        <a class="image-popup-vertical-fit" href="<?php echo get_the_post_thumbnail_url($post->ID); ?>">
                            <img src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" alt="">
                        </a>
                    </div>
                <?php
                endwhile;
                wp_reset_query();
                ?>
            </div>
        </div>
        <div id="infinite-loader" class="infinite-loader loader-spinner" style="display: none;"></div>
    </div>

    <?php if (!empty($category_content)) : ?>
        <div class="category-content-section container mt-50p mb-50p w-80 w-sm-100 d-block mx-auto">
            <div class="category-content text-dark text-justify p-10p">
                <?= do_shortcode($category_content); ?>

            </div>
        </div>
    <?php endif; ?>
</div>

<?php
get_footer();
