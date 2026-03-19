<?php

function register_pricing_package_cpt()
{
    $labels = array(
        'name'               => 'Pricing Packages',
        'singular_name'      => 'Pricing Package',
        'add_new'            => 'Add New Package',
        'add_new_item'       => 'Add New Pricing Package',
        'edit_item'          => 'Edit Pricing Package',
        'new_item'           => 'New Pricing Package',
        'view_item'          => 'View Pricing Package',
        'search_items'       => 'Search Pricing Packages',
        'not_found'          => 'No pricing packages found',
        'not_found_in_trash' => 'No pricing packages found in trash',
        'menu_name'          => 'Pricing Packages',
    );

    register_post_type('pricing_package', array(
        'labels'              => $labels,
        'public'              => false,
        'publicly_queryable'  => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => false,
        'has_archive'         => false,
        'rewrite'             => false,
        'capability_type'     => 'post',
        'supports'            => array('title', 'thumbnail'),
        'menu_icon'           => 'dashicons-tag',
        'menu_position'       => 25,
    ));
}
add_action('init', 'register_pricing_package_cpt');


// ── Admin columns ────────────────────────────────────────────────────────────

function pricing_package_columns($columns)
{
    return array(
        'cb'          => $columns['cb'],
        'title'       => 'Package',
        'pkg_location'=> 'Location',
        'pkg_price'   => 'Price',
        'pkg_duration'=> 'Duration',
        'date'        => 'Date',
    );
}
add_filter('manage_pricing_package_posts_columns', 'pricing_package_columns');

function pricing_package_column_content($column, $post_id)
{
    $map = array(
        'pkg_location' => '_pkg_location',
        'pkg_price'    => '_pkg_price',
        'pkg_duration' => '_pkg_duration',
    );
    if (isset($map[$column])) {
        echo esc_html(get_post_meta($post_id, $map[$column], true) ?: '—');
    }
}
add_action('manage_pricing_package_posts_custom_column', 'pricing_package_column_content', 10, 2);
