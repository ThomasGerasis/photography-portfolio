<?php
function remove_json_api () {
    add_filter( 'show_admin_bar', '__return_false' );
    add_filter('wpseo_debug_markers', '__return_false');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
    remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
    remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
    remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
    remove_action('wp_head', 'index_rel_link'); // index link
    remove_action('wp_head', '_wp_render_title_tag', 1);
    remove_action('wp_head', 'parent_post_rel_link', 10); // prev link
    remove_action('wp_head', 'start_post_rel_link', 10); // start link
    remove_action('wp_head', 'adjacent_posts_rel_link', 10); // Display relational links for the posts adjacent to the current post.
    remove_action( 'wp_head', 'rel_canonical' );
    remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
    remove_action('wp_head', 'wp_resource_hints', 2);
    remove_action( 'wp_head', '_wp_render_title_tag', 1 );
}
add_action( 'after_setup_theme', 'remove_json_api' );



function core_wp_remove_scripts() {

    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-blocks-style'); // Remove WooCommerce block CSS

    wp_dequeue_style('cdp-css-global'); // Remove WooCommerce block CSS
    wp_dequeue_style('cdp-css'); // Remove WooCommerce block CSS
    wp_dequeue_style('cdp-css-user'); // Remove WooCommerce block CSS
    wp_dequeue_style('cdp-tooltips-css'); // Remove WooCommerce block CSS
    wp_dequeue_style('cdp-css-select'); // Remove WooCommerce block CSS
    wp_dequeue_style('classic-theme-styles'); // Remove WooCommerce block CSS
    wp_dequeue_script('cdp-tooltips');
    wp_dequeue_script('cdp-js-user');
    wp_dequeue_script('dp-js-select');


    wp_dequeue_script('jquery-core');
    wp_deregister_script('jquery-core');

    wp_dequeue_script('jquery-migrate');
    wp_deregister_script('jquery-migrate');

    wp_dequeue_style('elusive');
    wp_deregister_style('elusive');

    wp_dequeue_style('foundation-icons'); // Μικρά σπασίματα
    wp_deregister_style('foundation-icons');

    wp_dequeue_style('genericons'); // Μικρά σπασίματα
    wp_deregister_style('genericons');

    wp_dequeue_style('font-awesome'); // Μικρά σπασίματα
    wp_deregister_style('font-awesome');

    wp_dequeue_style('menu-icons-extra'); // Μικρά σπασίματα
    wp_deregister_style('menu-icons-extra');

    wp_dequeue_style('dashicons');
    wp_deregister_style('dashicons');

    wp_dequeue_style('global-styles-inline'); // Μικρά σπασίματα
    wp_deregister_style('global-styles-inline');

    wp_dequeue_style('global-styles');
    wp_deregister_style('global-styles');

    // Now register your styles and scripts here
}
add_action( 'wp_enqueue_scripts', 'core_wp_remove_scripts', 10);
