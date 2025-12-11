<?php

namespace SettingsPages;

class BasicSettings
{
    public $postTypeName;

    /**
     * Start up
     * @param $postTypeName
     */
    public function __construct($postTypeName)
    {
        add_action('admin_menu', [$this, 'add_settings']);
        add_action('admin_enqueue_scripts', [$this, 'registerAssets']);
        add_action('admin_init', [$this, 'registerSettings']);
        $this->postTypeName = $postTypeName;
    }

    public function registerAssets(): void
    {
        wp_register_script('settingsScripts', get_template_directory_uri() . '/includes/settings-page/assets/settings-scripts.js', [], false, false);
        wp_register_style('adminStyles', get_template_directory_uri() . '/includes/settings-page/assets/adminStyles.css', [], false, 'all');
    }

    public function add_settings(): void
    {
        add_menu_page(
            __('Social Accounts', 'textdomain'),
            'Social Accounts',
            'manage_options',
            'Social Accounts',
            array($this, 'render_settings'),
            'dashicons-facebook',
            25
        );
    }
    /*************  ✨ Windsurf Command ⭐  *************/
    /**
     * Renders the settings page
     *
     * This function is called when the menu page for the plugin is accessed.
     *
     * It enqueues the necessary scripts and styles, and prints out the form for the settings page.
     *
     * @return void
     */
    public function render_settings(): void
    {
        if (! current_user_can('manage_options')) {
            return;
        }
        wp_enqueue_script('settingsScripts');
        wp_enqueue_style('adminStyles');
?>
        <style>
            .w-100 {
                width: 100%;
            }
        </style>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <form action='options.php' class="form-table" method='post'>
                <?php
                // This prints out all hidden setting fields
                settings_fields('basic_settings_group');
                do_settings_sections('basic_settings');
                submit_button('Save Settings');
                ?>
            </form>
            <div id="results-screen"></div>
        </div>
    <?php
    }
    public function registerSettings(): void
    {

        register_setting(
            'basic_settings_group', // Option group
            'basic_settings', // Option name
            array($this, 'sanitize') // Sanitize
        );
        add_settings_section(
            'basic_settings', // ID
            '', // Title
            array($this, 'print_section_info'), // Callback
            'basic_settings' // Page
        );
        add_settings_field(
            'slider_repeater',
            'Basic Settings',
            array($this, 'render_basic_settings'),
            'basic_settings',
            'basic_settings',
            array('label_for' => 'basic_settings', 'settings_name' => 'basic_settings')
        );
    }
    /**
     * Print the Section text
     */
    public function print_section_info(): void
    {
        //        print 'Enter your settings below:';
    }

    public function render_basic_settings($args)
    {

        $option = get_option('basic_settings');
        ob_start();
    ?>
        <div class="basic-settings wrapper" id="">

            <div class="d-flex flex-wrap col-6 mt-4 p-0">
                <label style="margin-top: auto;margin-bottom: auto;" class="col-2 p-0" for="basic_settings[facebook]">Facebook Url</label>
                <input type="text" class="form-control col-9 form-control-sm main-text" name="basic_settings[facebook]" id="basic_settings[facebook]" value="<?= $option['facebook'] ?? ''; ?>" placeholder="<?= 'Facebook Url' ?>">
            </div>

            <div class="d-flex flex-wrap col-6 mt-4 p-0">
                <label style="margin-top: auto;margin-bottom: auto;" class="col-2 p-0" for="basic_settings[instagram]">Instagram Url</label>
                <input type="text" class="form-control col-9 form-control-sm main-text" name="basic_settings[instagram]" id="basic_settings[instagram]" value="<?= $option['instagram'] ?? ''; ?>" placeholder="<?= 'Instagram Url' ?>">
            </div>


            <div class="d-flex flex-wrap col-6 mt-4 p-0">
                <label style="margin-top: auto;margin-bottom: auto;" class="col-2 p-0" for="basic_settings[whatsapp]">Whatsapp</label>
                <input type="text" class="form-control col-9 form-control-sm main-text" name="basic_settings[whatsapp]" id="basic_settings[whatsapp]" value="<?= $option['whatsapp'] ?? ''; ?>" placeholder="<?= 'Whatsapp' ?>">
            </div>

            <div class="d-flex flex-wrap col-6 mt-4 p-0">
                <label style="margin-top: auto;margin-bottom: auto;" class="col-2 p-0" for="basic_settings[airbnb]">Airbnb Url</label>
                <input type="text" class="form-control col-9 form-control-sm main-text" name="basic_settings[airbnb]" id="basic_settings[airbnb]" value="<?= $option['airbnb'] ?? ''; ?>" placeholder="<?= 'Airbnb link' ?>">
            </div>

            <div class="d-flex flex-wrap col-6 mt-4 p-0">
                <label style="margin-top: auto;margin-bottom: auto;" class="col-2 p-0" for="basic_settings[email]">Email</label>
                <input type="text" class="form-control col-9 form-control-sm main-text" name="basic_settings[email]" id="basic_settings[email]" value="<?= $option['email'] ?? ''; ?>" placeholder="<?= 'Email' ?>">
            </div>



        </div>
<?php
        echo ob_get_clean();
    }
}
