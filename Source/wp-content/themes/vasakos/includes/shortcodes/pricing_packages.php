<?php

/**
 * Pricing Packages Shortcode
 * Usage:
 *   [pricing_packages]                         — all packages
 *   [pricing_packages ids="12,34,56"]          — specific packages by post ID
 *   [pricing_packages title="..." subtitle="..." show_book_button="yes"]
 */

function pricing_packages_shortcode($atts)
{
    $atts = shortcode_atts(
        array(
            'ids'              => '',    // comma-separated pricing_package post IDs; empty = all
            'title'            => '',
            'subtitle'         => 'Choose the perfect package for you',
            'show_book_button' => 'yes',
            'title_tag'        => 'h2', // h1 | h2 | h3 | h4 | p | none
        ),
        $atts,
        'pricing_packages'
    );

    $query_args = array(
        'post_type'      => 'pricing_package',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    );

    $ids = array_filter(array_map('intval', explode(',', $atts['ids'])));
    if (!empty($ids)) {
        $query_args['post__in']  = $ids;
        $query_args['orderby']   = 'post__in';
    }

    $packages = get_posts($query_args);

    if (empty($packages)) {
        return '<p>No pricing packages found.</p>';
    }

    $allowed_tags = ['h1', 'h2', 'h3', 'h4', 'p'];
    $title_tag    = in_array($atts['title_tag'], $allowed_tags) ? $atts['title_tag'] : 'none';

    ob_start();
?>
    <section class="pricing-section mt-2 mb-5">
        <?php if (!empty($atts['title']) && $title_tag !== 'none') { ?>
            <<?= $title_tag; ?> class="section-title w-100 d-block text-dark text-center"><?= esc_html($atts['title']); ?></<?= $title_tag; ?>>
        <?php } ?>
        <?php if (!empty($atts['subtitle'])) { ?>
            <h3 class="heading_title w-100 d-block text-dark text-center mb-5"><?= esc_html($atts['subtitle']); ?></h3>
        <?php } ?>

        <div class="pricing-cards mt-5 mb-5">
            <?php foreach ($packages as $package) {
                $id          = $package->ID;
                $location    = get_post_meta($id, '_pkg_location', true);
                $price       = get_post_meta($id, '_pkg_price', true);
                $duration    = get_post_meta($id, '_pkg_duration', true);
                $ideal_for   = get_post_meta($id, '_pkg_ideal_for', true);
                $description = get_post_meta($id, '_pkg_description', true);
                $more_info   = get_post_meta($id, '_pkg_more_info', true);
                $image       = get_the_post_thumbnail_url($id, 'large');
            ?>
                <div class="card h-100 d-flex flex-column">
                    <?php if ($image) { ?>
                        <div class="card-img-wrapper">
                            <img src="<?= esc_url($image); ?>" alt="<?= esc_attr($package->post_title); ?>" class="card-img-top" />
                        </div>
                    <?php } ?>
                    <div class="card-body d-flex flex-column flex-grow-1">
                        <h5 class="card-title">
                            <?= esc_html($package->post_title); ?>
                            <?php if ($more_info) { ?>
                                <span class="pkg-info-tooltip">
                                    <i class="fas fa-info-circle" aria-hidden="true"></i>
                                    <span class="pkg-info-tooltip__box" role="tooltip"><?= esc_html($more_info); ?></span>
                                </span>
                            <?php } ?>
                        </h5>
                        <div class="meta mb-2">
                            <?php if ($price) { ?>
                                <span><i class="fas fa-pound-sign"></i><?= esc_html($price); ?></span>
                            <?php } ?>
                            <?php if ($duration) { ?>
                                <span><i class="fas fa-clock"></i><?= esc_html($duration); ?></span>
                            <?php } ?>
                        </div>

                        <?php if ($location) { ?>
                            <p class="card-text mb-5p"><i class="fas fa-map-marker-alt text-secondary me-1"></i><?= esc_html($location); ?></p>
                        <?php } ?>

                        <?php if ($ideal_for) { ?>
                            <p class="card-text"><strong>Ideal for:</strong> <?= esc_html($ideal_for); ?></p>
                        <?php } ?>

                        <?php if ($description) { ?>
                            <p class="card-text"><?= esc_html($description); ?></p>
                        <?php } ?>
                        <?php if ($atts['show_book_button'] === 'yes') { ?>
                            <div class="mt-auto mx-auto">
                                <a href="#contactForm" class="package-btn alime-btn bg-secondary"
                                    data-service="<?= esc_attr($id); ?>">
                                    Book This Package
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="alert alert-info d-flex align-items-center gap-3 mt-4 mx-auto" style="max-width:680px;" role="alert">
            <i class="fas fa-info-circle fs-4 flex-shrink-0"></i>
            <div>
                <strong>Good to know</strong> &mdash; all prices and timelines shown are a guide.
                Every package can be fully tailored to your needs, so don't hesitate to get in touch.
            </div>
        </div>
    </section>
    <?php

    // Output the toggle JS once per page regardless of how many shortcodes are on the page
    static $pkg_tooltip_js_done = false;
    if (!$pkg_tooltip_js_done) {
        $pkg_tooltip_js_done = true;
    ?>
        <script>
            (function() {
                document.addEventListener('click', function(e) {
                    var icon = e.target.closest('.pkg-info-tooltip');
                    // Close all open tooltips
                    document.querySelectorAll('.pkg-info-tooltip.is-open').forEach(function(el) {
                        if (el !== icon) el.classList.remove('is-open');
                    });
                    // Toggle the clicked one
                    if (icon) {
                        e.stopPropagation();
                        icon.classList.toggle('is-open');
                    }
                });
            })();
        </script>
<?php
    }

    return ob_get_clean() . pricingSchema();
}
add_shortcode('pricing_packages', 'pricing_packages_shortcode');
