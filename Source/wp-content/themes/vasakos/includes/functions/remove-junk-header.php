<?php

if (defined('WPSEO_VERSION')) {
    global $wpseo_front;
    if (defined($wpseo_front)) {
        remove_action('wp_head', array($wpseo_front, 'head'), 1);
    } else {
        $wp_thing = WPSEO_Frontend::get_instance();
        remove_action('wp_head', array($wp_thing, 'head'), 1);
    }
    add_filter('wpseo_opengraph_url', '__return_false');
    add_filter('wpseo_opengraph_desc', '__return_false');
    add_filter('wpseo_opengraph_title', '__return_false');
    add_filter('wpseo_opengraph_type', '__return_false');
    add_filter('wpseo_opengraph_site_name', '__return_false');
    add_filter('wpseo_opengraph_image', '__return_false');
    add_filter('wpseo_opengraph_author_facebook', '__return_false');
    add_filter('wpseo_output_twitter_card', '__return_false');
    add_filter('wpseo_robots', '__return_false');
    //    add_filter( 'wp_robots', 'wp_robots_no_robots' );
    add_filter('wp_robots', 'wp_robots_no_robots');
    add_filter('wpseo_json_ld_output', '__return_false');
}

add_action('template_redirect', 'remove_wpseo');
/**
 * Removes output from Yoast SEO on the frontend for a specific post, page or custom post type.
 */
function remove_wpseo()
{
    if (is_single(1)) {
        $front_end = YoastSEO()->classes->get(Yoast\WP\SEO\Integrations\Front_End_Integration::class);

        remove_action('wpseo_head', [$front_end, 'present_head'], -9999);
    }
}

function yst_wpseo_change_og_locale($locale)
{
    return 'el_GR';
}

add_filter('wpseo_locale', 'yst_wpseo_change_og_locale');

function wps_deregister_styles()
{
    //    wp_dequeue_style( 'global-styles' );
    //    wp_dequeue_style( 'wp-block-library' );
    //    wp_dequeue_style( 'wp-block-library-theme' );
    //    wp_dequeue_style( 'wc-blocks-style' ); // Remove WooCommerce block CSS
}
add_action('wp_enqueue_scripts', 'wps_deregister_styles', 100);



function wp_robots_remove_noindex($robots)
{

    if (!is_404()) {
        $robots['index'] = true;
        $robots['follow'] = true;
        $robots['noindex'] = false;
    } else {
        $robots['index'] = false;
        $robots['follow'] = false;
        $robots['noindex'] = true;
        $robots['nofollow'] = true;
    }
    return $robots;
}
