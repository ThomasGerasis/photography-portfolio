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
        add_action( 'admin_enqueue_scripts', [ $this, 'registerAssets' ] );
        add_action( 'admin_init', [ $this, 'registerSettings' ] );
        $this->postTypeName = $postTypeName;
    }

    public function registerAssets(): void
    {
        wp_register_script( 'settingsScripts', get_template_directory_uri() . '/includes/settings-page/assets/settings-scripts.js', [], false, false );
        wp_register_style( 'adminStyles', get_template_directory_uri() . '/includes/settings-page/assets/adminStyles.css', [], false, 'all' );
    }

    public function add_settings(): void
    {
        add_menu_page(
            __( 'Social Accounts', 'textdomain' ),
            'Social Accounts',
            'manage_options',
            'Social Accounts',
            array( $this, 'render_settings' ),
            'dashicons-facebook',
            25
        );

    }
    public function render_settings(): void
    {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }
        wp_enqueue_script( 'settingsScripts' );
        wp_enqueue_style('adminStyles');
        ?>
        <style>
            .w-100{width: 100%;}
        </style>
        <div class="wrap">
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
            <form action='options.php' class="form-table" method='post'>
                <?php
                // This prints out all hidden setting fields
                settings_fields( 'basic_settings_group' );
                do_settings_sections( 'basic_settings' );
                submit_button('Save Settings');
                ?>
            </form>
            <div id="results-screen"></div>
        </div>
        <?php
    }
    public function registerSettings(): void{

        register_setting(
            'basic_settings_group', // Option group
            'basic_settings', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );
        add_settings_section(
            'basic_settings', // ID
            '', // Title
            array( $this, 'print_section_info' ), // Callback
            'basic_settings' // Page
        );
        add_settings_field(
            'slider_repeater',
            'Basic Settings',
            array( $this, 'render_basic_settings' ),
            'basic_settings',
            'basic_settings',
            array('label_for' => 'basic_settings','settings_name' => 'basic_settings')
        );
    }
    /**
     * Print the Section text
     */
    public function print_section_info(): void
    {
        //        print 'Enter your settings below:';
    }

    public function render_basic_settings($args) {

        $option = get_option('basic_settings');
        ob_start();
            ?>
                <div class="basic-settings wrapper" id="">

                <?php if (!empty($option)){ ?>
                        <div class="d-flex flex-wrap col-6 mt-4 p-0">
                            <label style="margin-top: auto;margin-bottom: auto;" class="col-2 p-0" for="basic_settings[facebook]">Facebook Url</label>
                            <input type="text" class="form-control col-9 form-control-sm main-text" name="basic_settings[facebook]" id="basic_settings[facebook]" value="<?=$option['facebook'] ?? '';?>" placeholder="<?= 'Facebook Url' ?>">
                        </div>

                        <div class="d-flex flex-wrap col-6 mt-4 p-0">
                            <label style="margin-top: auto;margin-bottom: auto;" class="col-2 p-0" for="basic_settings[instagram]">Instagram Url</label>
                            <input type="text" class="form-control col-9 form-control-sm main-text" name="basic_settings[instagram]" id="basic_settings[instagram]" value="<?=$option['instagram'] ?? '';?>" placeholder="<?= 'Instagram Url' ?>">
                        </div>

                        <div class="d-flex flex-wrap col-6 mt-4 p-0">
                            <label style="margin-top: auto;margin-bottom: auto;" class="col-2 p-0" for="basic_settings[email]">Email</label>
                            <input type="text" class="form-control col-9 form-control-sm main-text" name="basic_settings[email]" id="basic_settings[email]" value="<?=$option['email'] ?? '';?>" placeholder="<?= 'Email' ?>">
                        </div>

                        <?php
                }else{
                    ?>
                    <div class="items d-flex mb-1" data-id="0" style="display: flex;align-items: center;">
                        <input type="button" class="button button-primary custom_media_button custom_media_0" id="custom_media_button" name="0" value="Upload Icon" style="margin-top:5px;" />
                        <img class="custom_media_image_0" src="" style="margin:10px;padding:0;max-width:100px;float:left;display:inline-block" />
                        <input class="media_image_0 form-control form-control-sm col-3" data-name="repeat" type="text" name="basic_settings[image]" value="" placeholder="Image"/>
                    </div>

                    <div class="d-flex flex-wrap col-6 mt-4 p-0">
                        <label style="margin-top: auto;margin-bottom: auto;" class="col-2 p-0" for="basic_settings[facebook]">Facebook Url</label>
                        <input type="text" class="form-control col-9 form-control-sm main-text" name="basic_settings[facebook]" id="basic_settings[facebook]" placeholder="<?= 'Facebook Url' ?>">
                    </div>

                    <div class="d-flex flex-wrap col-6 mt-4 p-0">
                        <label style="margin-top: auto;margin-bottom: auto;" class="col-2 p-0" for="basic_settings[instagram]">Instagram Url</label>
                        <input type="text" class="form-control col-9 form-control-sm main-text" name="basic_settings[instagram]" id="basic_settings[instagram]" placeholder="<?= 'Instagram Url' ?>">
                    </div>
                    <?php
                }
                ?>
                </div>
            <?php
        echo ob_get_clean();
    }


}