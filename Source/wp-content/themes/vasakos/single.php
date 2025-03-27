<?php
get_header();
?>

<div id="preloader">
    <div class="loader"></div>
</div>

<div class="container mt-20p mb-20p d-block mx-auto align-items-center">
    <?php
    while ( have_posts() ) :
        the_post();

        get_template_part( 'templates/content-single', get_post_type() );

    endwhile; // End of the loop.
    ?>
</div>
<?php
get_footer();
?>
