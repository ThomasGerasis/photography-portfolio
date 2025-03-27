<?php
add_action('admin_enqueue_scripts', 'cstm_css_and_js');

function cstm_css_and_js($hook) {
    wp_enqueue_media();
    wp_enqueue_script( 'admin_script', 'https://code.jquery.com/jquery-3.4.1.min.js', array(), '1.0' );
    wp_enqueue_script( 'admin_ui_script', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', array(), '1.0' );
    wp_enqueue_style('boot_css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css', array(), null, 'all');
    wp_enqueue_script( 'boot_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array( 'jquery' ), null, true );
//    wp_enqueue_script('boot_js', plugins_url('inc/bootstrap.js',__FILE__ ));
}