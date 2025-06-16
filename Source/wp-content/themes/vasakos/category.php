<?php

/**
 * The template for displaying Category pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
get_header();
?>
<div id="preloader">
    <div class="loader"></div>
</div>
<?php
$category = get_queried_object();
$image =  get_field('category_image', 'category_' . $category->term_id);
$orderBy = $category->term_id === 4 ? 'DESC' : 'ASC';
$postsPerPage = get_option('posts_per_page');
?>

<div class="container_pages mt-20p mb-20p d-block mx-auto align-items-center">

    <div class="container mb-20p text-center w-60 w-sm-100 d-block mx-auto align-items-center p-0">
        <h1><?= $category->name ?></h1>
        <p class="text-dark"><?= $category->description ?></p>
        <h2 class="text-dark text-center heading_title">Photos</h2>
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
            <div class="masonry-layout-container img-gallery-magnific" data-category-id="<?= $category->term_id ?>" data-max-pages="<?php echo $query->max_num_pages; ?>">
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
        <div id="infinite-loader" class="loader-spinner" style="display: none;"></div>
    </div>
</div>

<?php
get_footer();
