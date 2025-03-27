<?php
function bh_theme_setup()
{

    add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));

    add_theme_support('post-formats', array('video', 'gallery'));

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('dark-editor-style');

}
add_action( 'after_setup_theme', 'bh_theme_setup' );


function post_remove ()      //creating functions post_remove for removing menu item
{
    remove_menu_page('edit.php');
    remove_menu_page('edit-comments.php');
}

add_action('admin_menu', 'post_remove');   //adding action for triggering function call


function getUserDevice(){
    $GLOBALS['is_mobile'] = (isset($_GET["isMobile"]) && $_GET["isMobile"] === 'true') || wp_is_mobile();
}
add_action('init', 'getUserDevice');

