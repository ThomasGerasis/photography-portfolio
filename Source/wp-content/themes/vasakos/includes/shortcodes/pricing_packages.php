<?php
/**
 * Pricing Packages Shortcode
 * Usage: [pricing_packages page_id="123" title="Our Packages" subtitle="Choose the perfect package"]
 */

function pricing_packages_shortcode($atts)
{
    $atts = shortcode_atts(
        array(
            'page_id' => '', // Page ID containing pricing metabox
            'title' => 'Pricing - Packages',
            'subtitle' => 'Choose the perfect package for you',
            'show_book_button' => 'yes',
        ),
        $atts,
        'pricing_packages'
    );

    $packages = array();

    // Get packages from specified page or find pricing page
    if (!empty($atts['page_id'])) {
        $packages = get_post_meta($atts['page_id'], 'pricing', true);
    } else {
        // Try to find pricing page
        $pricing_pages = get_pages(array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'pricing-page.php'
        ));
        if (!empty($pricing_pages)) {
            $packages = get_post_meta($pricing_pages[0]->ID, 'pricing', true);
        }
    }

    if (empty($packages)) {
        return '<p>No pricing packages found.</p>';
    }

    ob_start();
?>
    <section class="pricing-section mt-2 mb-5">
        <?php if (!empty($atts['title'])) { ?>
            <h2 class="section-title w-100 d-block text-dark text-center"><?= esc_html($atts['title']); ?></h2>
        <?php } ?>
        <?php if (!empty($atts['subtitle'])) { ?>
            <h3 class="heading_title w-100 d-block text-dark text-center mb-5"><?= esc_html($atts['subtitle']); ?></h3>
        <?php } ?>

        <div class="pricing-cards mt-5 mb-5">
            <?php foreach ($packages as $id => $package) { ?>
                <div class="card h-100 d-flex flex-column">
                    <?php if (!empty($package['image'])) { ?>
                        <div class="card-img-wrapper">
                            <img src="<?= esc_url($package['image']); ?>" alt="<?= esc_attr($package['title'] ?? ''); ?>" class="card-img-top" />
                        </div>
                    <?php } ?>
                    <div class="card-body d-flex flex-column flex-grow-1">
                        <h5 class="card-title"><?= esc_html($package['title'] ?? ''); ?></h5>
                        <div class="meta mb-2">
                            <?php if (!empty($package['price'])) { ?>
                                <span><i class="fas fa-pound-sign"></i><?= esc_html($package['price']); ?></span>
                            <?php } ?>
                            <?php if (!empty($package['hours'])) { ?>
                                <span><i class="fas fa-clock"></i><?= esc_html($package['hours']); ?></span>
                            <?php } ?>
                        </div>
                        <?php if (!empty($package['description'])) { ?>
                            <p class="card-text"><?= esc_html($package['description']); ?></p>
                        <?php } ?>
                        <?php if ($atts['show_book_button'] === 'yes') { ?>
                            <div class="mt-auto mx-auto">
                                <a href="#contactForm" class="package-btn alime-btn bg-secondary" data-service="<?= esc_attr($id); ?>">Book This Package</a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
<?php

    return ob_get_clean();
}
add_shortcode('pricing_packages', 'pricing_packages_shortcode');
