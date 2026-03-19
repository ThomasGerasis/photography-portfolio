<?php

/**
 * TinyMCE Shortcode Button
 * Adds a dynamic shortcode dropdown to the WordPress Classic Editor
 */

class TinyMCE_Shortcode_Button
{
    public function __construct()
    {
        add_action('admin_head', array($this, 'add_tinymce_button'));
        add_action('admin_enqueue_scripts', array($this, 'load_tinymce_assets'));
        $this->register_ajax_handler();
    }
    public function load_tinymce_assets($hook)
    {
        // Register a virtual script (no src) to carry the localized data.
        // The actual tinymce-shortcodes.js is loaded by TinyMCE itself via
        // mce_external_plugins — enqueueing it here would cause it to run as a
        // plain <script> tag before tinymce is defined, triggering a JS error.
        wp_register_script('vasakos-tinymce-data', false, ['jquery'], null, true);
        wp_enqueue_script('vasakos-tinymce-data');
        wp_localize_script('vasakos-tinymce-data', 'VasakosTinyMCE', [
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('vasakos_shortcode_modal'),
        ]);
    }

    public function register_ajax_handler()
    {
        add_action('wp_ajax_vasakos_shortcode_modal', array($this, 'render_modal'));
    }

    public function render_modal()
    {
        check_ajax_referer('vasakos_shortcode_modal', 'nonce');

        if (!current_user_can('edit_posts')) {
            wp_die('Unauthorized', 403);
        }

        $shortcode = sanitize_key($_GET['shortcode'] ?? '');
        $template  = get_template_directory() . '/includes/plugins/tinymce/shortcodes/' . $shortcode . '/modal.php';

        if (!$shortcode || !file_exists($template)) {
            wp_die('Unknown shortcode', 400);
        }

        include $template;
        wp_die();
    }

    public function add_tinymce_button()
    {
        // Check permissions
        if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
            return;
        }

        // Only if WYSIWYG is enabled
        if (get_user_option('rich_editing') !== 'true') {
            return;
        }

        // Add button to toolbar
        add_filter('mce_buttons', array($this, 'register_tinymce_button'));

        // Register TinyMCE plugin
        add_filter('mce_external_plugins', array($this, 'add_tinymce_plugin'));
    }

    public function register_tinymce_button($buttons)
    {
        array_push($buttons, 'vasakos_shortcodes');
        return $buttons;
    }

    public function add_tinymce_plugin($plugin_array)
    {
        $plugin_array['vasakos_shortcodes'] = get_template_directory_uri() . '/includes/plugins/tinymce/tinymce-shortcodes.js?v=' . filemtime(get_template_directory() . '/includes/plugins/tinymce/tinymce-shortcodes.js');
        return $plugin_array;
    }
}

new TinyMCE_Shortcode_Button();
