<?php

namespace SettingsPages;

/**
 * Combined Site Settings page
 * Merges: Social Accounts, Slider Instagram, Slider Homepage
 * All option keys are unchanged so no data is lost.
 */
class SiteSettings
{
    public function __construct()
    {
        add_action('admin_menu',            [$this, 'addMenuPage']);
        add_action('admin_enqueue_scripts', [$this, 'registerAssets']);
    }

    public function registerAssets(): void
    {
        wp_register_script('settingsScripts', get_template_directory_uri() . '/includes/settings-page/assets/settings-scripts.js', [], '1.1', false);
        wp_register_style('adminStyles',      get_template_directory_uri() . '/includes/settings-page/assets/adminStyles.css',    [], false, 'all');
    }

    public function addMenuPage(): void
    {
        add_menu_page(
            __('Site Settings', 'textdomain'),
            'Site Settings',
            'manage_options',
            'site_settings',
            [$this, 'renderPage'],
            'dashicons-admin-settings',
            25
        );
    }

    public function renderPage(): void
    {
        if (!current_user_can('manage_options')) return;

        wp_enqueue_script('settingsScripts');
        wp_enqueue_style('adminStyles');
        wp_enqueue_media();

        $tabs = [
            'social'            => 'Social Accounts',
            'slider_instagram'  => 'Slider Instagram',
            'slider_homepage'   => 'Slider Homepage',
        ];
        $current = isset($_GET['tab']) && array_key_exists($_GET['tab'], $tabs)
            ? sanitize_key($_GET['tab'])
            : 'social';

        // Map tab → settings group + page slug used in registerSettings below
        $tab_map = [
            'social'           => ['group' => 'basic_settings_group',        'page' => 'basic_settings'],
            'slider_instagram' => ['group' => 'slider_settings_group',       'page' => 'slider_settings'],
            'slider_homepage'  => ['group' => 'slider_home_settings_group',  'page' => 'slider_home_settings'],
        ];
        ?>
        <style>.w-100{width:100%;}</style>
        <div class="wrap">
            <h1>Site Settings</h1>

            <nav class="nav-tab-wrapper wp-clearfix" style="margin-bottom:20px;">
                <?php foreach ($tabs as $slug => $label) :
                    $url    = admin_url('admin.php?page=site_settings&tab=' . $slug);
                    $active = ($current === $slug) ? ' nav-tab-active' : '';
                ?>
                    <a href="<?= esc_url($url) ?>" class="nav-tab<?= $active ?>"><?= esc_html($label) ?></a>
                <?php endforeach; ?>
            </nav>

            <form action="options.php" method="post">
                <?php
                settings_fields($tab_map[$current]['group']);
                do_settings_sections($tab_map[$current]['page']);
                submit_button('Save Settings');
                ?>
            </form>
        </div>
        <?php
    }
}
