<?php
function register_gallery()
{

    $labels = array(
        'name' => 'Galleries',
        'singular_name' => 'Gallery',
        'add_new' => 'Add New Gallery',
        'add_new_item' => 'Add New Gallery',
        'edit_item' => 'Edit Galleries',
        'new_item' => 'New Galleries',
        'view_item' => 'View Galleries',
        'search_items' => 'Search Galleries',
        'not_found' => 'No Galleries found',
        'not_found_in_trash' => 'No Galleries found in trash',
        'parent_item_colon' => '',
        'menu_name' => 'Galleries'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_front' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => true,
        'menu_position' => null,
        'taxonomies' => array('category'),
        'supports' => array('title', 'custom-fields'),
        'menu_icon' => get_template_directory_uri() . '/assets/images/camera.png',
    );
    register_post_type('gallery', $args);
}

// add_action( 'init', 'register_gallery' );