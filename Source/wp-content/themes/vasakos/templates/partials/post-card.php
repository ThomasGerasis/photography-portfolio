<?php

/**
 * Reusable post card component.
 * Must be called inside a WordPress loop (have_posts / the_post).
 */

$thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
$categories    = get_the_category();
?>

<a href="<?php the_permalink(); ?>"
    class="single-post-area d-block text-decoration-none"
    aria-label="<?php the_title_attribute(); ?>">
    <div class="post-thumbnail">
        <?php if ($thumbnail_url) : ?>
            <img
                src="<?php echo esc_url($thumbnail_url); ?>"
                alt="<?php the_title_attribute(); ?>"
                loading="lazy"
                width="600"
                height="400">
        <?php else : ?>
            <img
                src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/logo.jpg'); ?>"
                alt="<?php the_title_attribute(); ?>"
                loading="lazy"
                width="600"
                height="400">
        <?php endif; ?>
    </div>

    <?php if (!empty($categories)) : ?>
        <span class="post-catagory"><?php echo esc_html($categories[0]->name); ?></span>
    <?php endif; ?>

    <div class="post-content">
        <div class="post-meta text-white">
            <div class="date d-flex align-items-center">
                <i class="far fa-calendar-alt pb-3p pr-2p"></i>
                <span><?php echo esc_html(get_the_date()); ?></span>
            </div>
        </div>
        <span class="post-title"><?php the_title(); ?></span>
    </div>
</a>