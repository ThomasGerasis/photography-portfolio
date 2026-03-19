<?php
/**
 * Airbnb Reviews Shortcode
 * Usage: [airbnb_reviews]
 */

function airbnb_reviews_shortcode($atts)
{
    $settings = get_option('basic_settings');
    
    ob_start();
?>
    <a href="<?= $settings['airbnb'] ?? ''; ?>" target="_blank" class="pr-10p pl-10p">
        <?= do_shortcode('[trustindex no-registration=airbnb]'); ?>
    </a>
<?php

    return ob_get_clean();
}
add_shortcode('airbnb_reviews', 'airbnb_reviews_shortcode');
