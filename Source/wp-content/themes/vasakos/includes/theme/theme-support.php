<?php
function bh_theme_setup()
{

    add_theme_support('html5', array('search-form', 'gallery', 'caption'));

    add_theme_support('post-formats', array('video', 'gallery'));

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('dark-editor-style');
}
add_action('after_setup_theme', 'bh_theme_setup');



function getUserDevice()
{
    $GLOBALS['is_mobile'] = (isset($_GET["isMobile"]) && $_GET["isMobile"] === 'true') || wp_is_mobile();
}
add_action('init', 'getUserDevice');



// Disable support for comments and trackbacks in post types
function disable_comments_post_types_support()
{
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}
add_action('admin_init', 'disable_comments_post_types_support');

// Close comments on the front-end
function disable_comments_status()
{
    return false;
}
add_filter('comments_open', 'disable_comments_status', 20, 2);
add_filter('pings_open', 'disable_comments_status', 20, 2);

// Hide existing comments
function disable_comments_hide_existing($comments)
{
    return [];
}
add_filter('comments_array', 'disable_comments_hide_existing', 10, 2);

// Remove comments page in menu
function disable_comments_admin_menu()
{
    remove_menu_page('edit-comments.php');
    remove_menu_page('edit.php');
}
add_action('admin_menu', 'disable_comments_admin_menu');

// Redirect any user trying to access comments page
function disable_comments_admin_menu_redirect()
{
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url());
        exit;
    }
}
add_action('admin_init', 'disable_comments_admin_menu_redirect');
