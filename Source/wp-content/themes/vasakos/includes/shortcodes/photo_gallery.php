<?php

/**
 * Photo Gallery by Category Shortcode
 * Usage: [photo_gallery category="weddings" limit="12" load_more="no"]
 * Uses the 'photoshoots' taxonomy and 'photos' post type.
 */

function photo_gallery_shortcode($atts)
{
    $atts = shortcode_atts(
        array(
            'category'  => '',
            'limit'     => get_option('posts_per_page'),
            'load_more' => 'no',
        ),
        $atts,
        'photo_gallery'
    );

    $load_more = $atts['load_more'] === 'yes';
    $per_page  = max(1, (int) $atts['limit']);

    // Resolve category slug → term_id
    $term_id = 0;
    if (!empty($atts['category'])) {
        $term = get_term_by('slug', sanitize_text_field($atts['category']), 'photoshoots');
        if ($term && !is_wp_error($term)) {
            $term_id = $term->term_id;
        }
    }

    $query_args = array(
        'post_type'      => 'photos',
        'posts_per_page' => $per_page,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    );

    if ($term_id) {
        $query_args['tax_query'] = array(
            array(
                'taxonomy' => 'photoshoots',
                'field'    => 'term_id',
                'terms'    => $term_id,
            ),
        );
    }

    // When not loading more, skip found_rows count for performance
    if (!$load_more) {
        $query_args['no_found_rows'] = true;
    }

    $photos = new WP_Query($query_args);

    if (!$photos->have_posts()) {
        return '<p class="vasakos-gallery-empty">No photos found.</p>';
    }

    // data-max-pages=1 tells the JS to skip the scroll handler (masonry+magnific still init)
    $max_pages = $load_more ? (int) $photos->max_num_pages : 1;

    // Enqueue once — wp_enqueue_script deduplicates by handle automatically
    wp_enqueue_script(
        'vasakos-infinite-scroll',
        get_template_directory_uri() . '/dist/infinite-scroll.min.js',
        [],
        filemtime(get_template_directory() . '/dist/infinite-scroll.min.js'),
        true
    );

    ob_start();
    ?>
    <div class="alime-portfolio-area clearfix">
        <div class="container-fluid">
            <div class="masonry-layout-container img-gallery-magnific"
                 data-category-id="<?= esc_attr($term_id); ?>"
                 data-max-pages="<?= esc_attr($max_pages); ?>"
                 data-per-page="<?= esc_attr($per_page); ?>">

                <?php while ($photos->have_posts()) : $photos->the_post();
                    if (!has_post_thumbnail()) continue;
                    $full = get_the_post_thumbnail_url(get_the_ID(), 'full');
                ?>
                    <div class="magnific-img single_gallery_item media-slice nature mb-30 wow fadeInUp" data-wow-delay="100ms">
                        <a class="image-popup-vertical-fit" href="<?= esc_url($full); ?>">
                            <img src="<?= esc_url($full); ?>" alt="<?= esc_attr(get_the_title()); ?>" loading="lazy">
                        </a>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>

            </div>
        </div>
        <?php if ($load_more) : ?>
            <div class="infinite-loader loader-spinner" style="display:none;"></div>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('photo_gallery', 'photo_gallery_shortcode');
