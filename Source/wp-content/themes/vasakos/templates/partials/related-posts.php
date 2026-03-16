<?php
/**
 * Related articles section — flat grid, no tabs.
 * Must be called inside the WordPress main loop (after the_post()).
 */

$post_id     = get_the_ID();
$category_ids = wp_list_pluck(get_the_category($post_id), 'term_id');

if (empty($category_ids)) {
    return;
}

$related = new WP_Query([
    'category__in'   => $category_ids,
    'post__not_in'   => [$post_id],
    'posts_per_page' => 3,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
    'no_found_rows'  => true,
]);

if (!$related->have_posts()) {
    return;
}
?>

<section class="related-posts-section container mt-20p mb-20p mx-auto">

    <h3 class="related-posts__title"><?php esc_html_e('Related Articles'); ?></h3>

    <div class="row">
        <?php while ($related->have_posts()) : $related->the_post(); ?>
            <div class="col-12 col-md-4">
                <?php get_template_part('templates/partials/post-card'); ?>
            </div>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>

</section>
