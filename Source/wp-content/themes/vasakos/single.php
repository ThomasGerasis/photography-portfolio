<?php get_header(); ?>

<div id="preloader">
    <div class="loader"></div>
</div>

<?php while (have_posts()) : the_post(); ?>

    <div class="container mx-auto">
        <?php get_template_part('templates/breadcrumb'); ?>

        <?php
        $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
        if ($thumbnail_url) :
            echo do_shortcode(
                '[banner_image'
                    . ' image="'     . esc_url($thumbnail_url)      . '"'
                    . ' title="'     . esc_attr(get_the_title())    . '"'
                    . ' title_tag="h1"'
                    . ' min_height="420px"'
                    . ' overlay="yes"]'
            );
        else :
        ?>
            <div class="container mx-auto mt-20p">
                <h1><?php the_title(); ?></h1>
            </div>
        <?php endif; ?>

    </div>


    <div class="container mt-20p mb-20p mx-auto">
        <?php get_template_part('templates/content-single', get_post_type()); ?>
    </div>

<?php endwhile; ?>

<?php get_footer(); ?>