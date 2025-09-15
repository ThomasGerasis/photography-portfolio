<?php /* Template Name: Contact Page */ ?>

<?php
get_header();
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
                    <h1 class="page-title">Contact</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>"><i class="fas fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contact</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Area End -->

<div class="container container_pages mt-20p mb-20p d-block mx-auto align-items-center">
    <?php get_template_part('templates/contact-us'); ?>
</div>
<?php
get_footer();
?>