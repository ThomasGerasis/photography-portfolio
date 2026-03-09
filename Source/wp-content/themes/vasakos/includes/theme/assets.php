<?php
add_action('admin_enqueue_scripts', 'cstm_css_and_js');

function cstm_css_and_js($hook)
{
    wp_enqueue_media();
    // wp_enqueue_script('admin_script', 'https://code.jquery.com/jquery-3.4.1.min.js', array(), '1.0');
    // wp_enqueue_script('admin_ui_script', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', array(), '1.0');
    wp_enqueue_style('boot_css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css', array(), null, 'all');
    wp_enqueue_script('boot_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array('jquery'), null, true);

    // Fix WordPress admin CSS overriding Bootstrap's checkbox layout inside the shortcode modal
    wp_add_inline_style('boot_css', '
        #vasakos-sc-modal .form-check { display: flex; align-items: center; gap: .5rem; padding-left: 0; }
        #vasakos-sc-modal .form-check-input { position: static; margin: 0; float: none; flex-shrink: 0; width: 1rem; height: 1rem; }
        #vasakos-sc-modal .form-check-label { display: inline; margin: 0; font-weight: normal; }
    ');
}
