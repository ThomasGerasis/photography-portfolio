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
$image =  get_field('category_image','category_'.$category->term_id);
$orderBy = $category->term_id === 4 ? 'DESC' : 'ASC';
?>

<div class="container_pages mt-20p mb-20p d-block mx-auto align-items-center">

        <div class="container mb-20p text-center w-100 d-block mx-auto align-items-center p-0">
            <h1><?=$category->name?></h1>
            <p class="text-dark">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>

           
            <span class="text-dark heading_title">Photos</span>
            <img alt="camera" src="<?php echo get_stylesheet_directory_uri().'/assets/images/camera.svg'?>" style="filter: invert(1);" width="30" height="30" class="d-block img-fluid m-auto" loading="lazy">
        </div>

        <?php
        global $wp_query;
        $query = new WP_Query(array_merge(
            $wp_query->query,
            array(
                'post_type' => 'photos',
                'orderby' => 'publish_date',
                'order' => $orderBy
            )
        ));
        ?>
        <div class="alime-portfolio-area clearfix">
        <div class="container-fluid">
            <div class="masonry-layout-container img-gallery-magnific">
                <?php
                    while($query->have_posts()) : $query->the_post();
                        if(!has_post_thumbnail()){ continue; }
                        ?>
                            <div class="magnific-img single_gallery_item media-slice nature mb-30 wow fadeInUp" data-wow-delay="100ms">
                                <a class="image-popup-vertical-fit" href="<?php echo get_the_post_thumbnail_url($post->ID); ?>">
                                    <img src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" loading="lazy" alt="">
                                </a>
                            </div>
                        <?php
                        endwhile;
                        wp_reset_query();
                 ?>
                </div>
            </div>
        </div>
    </div>

<?php
get_footer();