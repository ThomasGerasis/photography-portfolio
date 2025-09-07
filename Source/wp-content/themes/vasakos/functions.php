<?php


$files = glob(get_template_directory() . '/includes/theme/*.php');

foreach ($files as $file) {
    include $file;
}

$files = glob(get_template_directory() . '/includes/functions/schemas/*.php');

foreach ($files as $file) {
    include $file;
}


$files = glob(get_template_directory() . '/includes/settings-page/*.php');

foreach ($files as $file) {
    include $file;
}

$files = glob(get_template_directory() . '/includes/shortcodes/*.php');

foreach ($files as $file) {
    include $file;
}


$files = glob(get_template_directory() . '/includes/functions/*.php');

foreach ($files as $file) {
    include $file;
}


require_once(get_template_directory() . '/includes/ajax-helper.php');
require_once(get_template_directory() . '/includes/plugins/wpalchemy/setup.php');
require_once(get_template_directory() . '/includes/plugins/wpalchemy/set_metaboxes.php');
require_once(get_template_directory() . '/includes/settings-page/SliderSettings.php');
require_once(get_template_directory() . '/includes/settings-page/SliderSettingsCarousel.php');

use SettingsPages\SliderSettings;
use SettingsPages\SliderSettingsCarousel;
use SettingsPages\BasicSettings;

new SliderSettings('photos');
new SliderSettingsCarousel('photos');
new BasicSettings('photos');
