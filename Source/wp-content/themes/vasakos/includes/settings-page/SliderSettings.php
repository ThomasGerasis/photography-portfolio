<?php

namespace SettingsPages;

class SliderSettings
{
    public $postTypeName;

    /**
     * Start up
     * @param $postTypeName
     */
    public function __construct($postTypeName)
    {
        add_action( 'admin_enqueue_scripts', [ $this, 'registerAssets' ] );
        add_action( 'admin_init', [ $this, 'registerSettings' ] );
        $this->postTypeName = $postTypeName;
    }

    public function registerAssets(): void
    {
        wp_register_script( 'settingsScripts', get_template_directory_uri() . '/includes/settings-page/assets/settings-scripts.js', [], 1.1, false );
        wp_register_style( 'adminStyles', get_template_directory_uri() . '/includes/settings-page/assets/adminStyles.css', [], false, 'all' );
    }

    public function add_settings(): void
    {
        add_menu_page(
            __( 'Slider Instagram', 'textdomain' ),
            'Slider Instagram',
            'manage_options',
            'slider_footer_instagram',
            array( $this, 'render_settings' ),
            'dashicons-format-gallery',
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
                settings_fields( 'slider_settings_group' );
                do_settings_sections( 'slider_settings' );
                submit_button('Save Settings');
                ?>
            </form>
            <div id="results-screen"></div>
        </div>
        <?php
    }
    public function registerSettings(): void{

        register_setting(
            'slider_settings_group', // Option group
            'slider_settings', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );
        add_settings_section(
            'slider_settings', // ID
            '', // Title
            array( $this, 'print_section_info' ), // Callback
            'slider_settings' // Page
        );
        add_settings_field(
            'slider_repeater',
            'Slider Settings',
            array( $this, 'render_slider_repeater' ),
            'slider_settings',
            'slider_settings',
            array('label_for' => 'slider_settings','settings_name' => 'slider_settings')
        );
    }
    /**
     * Print the Section text
     */
    public function print_section_info(): void
    {
        //        print 'Enter your settings below:';
    }

    public function render_slider_repeater($args) {

        $option = get_option('slider_settings');
        ob_start();
            ?>
            <div class="repeater-content-links" data-group="slider_settings">
                <div class="">
                    <button class="bg-filters btn-sm text-fff d-block repeater-add-btn mb-1" style="min-width: 110px; text-align: center;">Add</button>
                </div>
                <div class="repeater-rows-links sortable" id="#sortable2">
                <?php
                if (!empty($option)){
                    foreach ($option as $key=>$value){
                        $number = (int) filter_var($key, FILTER_SANITIZE_NUMBER_INT);
                        ?>
                        <div class="items d-flex mb-1 align-items-center" data-id="<?php echo $number;?>">
                            <div class="slider_order" style="cursor:pointer;margin-right:5px;">
                                <span class="dashicons dashicons-sort"></span>
                            </div>
                            <button type="button"
                                class="button button-primary custom-media-btn"
                                data-key="<?php echo $number;?>">
                                Upload Icon
                            </button>
                            <img class="custom_media_image_<?php echo $number;?>"
                                src="<?php echo $value['image'] ?? '';?>"
                                style="max-width:100px;margin:0 10px;<?php echo empty($value['image']) ? 'display:none;' : '';?>">
                            <input class="media_image_<?php echo $number;?> form-control form-control-sm col-2 ml-2"
                                data-name="repeat" type="text"
                                name="slider_settings[<?php echo $number;?>][image]"
                                value="<?php echo $value['image'] ?? '';?>"
                                placeholder="Image"/>
                            <textarea class="form-control form-control-sm col-2 ml-2"
                                data-name="repeat"
                                name="slider_settings[<?php echo $number;?>][title]"
                                placeholder="Title"><?php echo $value['title'] ?? '';?></textarea>
                            <textarea class="form-control form-control-sm col-2 ml-2"
                                data-name="repeat"
                                name="slider_settings[<?php echo $number;?>][text]"
                                placeholder="Text"><?php echo $value['text'] ?? '';?></textarea>
                            <button class="remove-btn btn btn-danger ml-3">Remove</button>
                        </div>
                        <?php
                    }
                }else{
                    ?>
                    <div class="items d-flex mb-1 align-items-center" data-id="0">
                        <div class="slider_order" style="cursor:pointer;margin-right:5px;">
                            <span class="dashicons dashicons-sort"></span>
                        </div>
                        <button type="button" class="button button-primary custom-media-btn" data-key="0">Upload Icon</button>
                        <img class="custom_media_image_0" src="" style="display:none;max-width:100px;margin:0 10px;">
                        <input class="media_image_0 form-control form-control-sm col-3 ml-2" data-name="repeat" type="text" name="slider_settings[0][image]" value="" placeholder="Image"/>
                        <textarea class="form-control form-control-sm col-2 ml-2" data-name="repeat" name="slider_settings[0][title]" placeholder="Title"></textarea>
                        <textarea class="form-control form-control-sm col-2 ml-2" data-name="repeat" name="slider_settings[0][text]" placeholder="Text"></textarea>
                        <button class="remove-btn btn btn-danger ml-3">Remove</button>
                    </div>
                    <?php
                }
                ?>
                </div>
            </div>
            <?php
        echo ob_get_clean();
    }


}