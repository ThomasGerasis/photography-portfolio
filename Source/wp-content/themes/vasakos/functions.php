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
require_once(get_template_directory() . '/includes/settings-page/BasicSettings.php');
require_once(get_template_directory() . '/includes/settings-page/SiteSettings.php');

require_once(get_template_directory() . '/includes/metaboxes/category-faq-fields.php');
require_once(get_template_directory() . '/includes/metaboxes/page-faq-fields.php');
require_once(get_template_directory() . '/includes/metaboxes/why-choose-me-meta-box.php');
require_once(get_template_directory() . '/includes/metaboxes/pricing-package-meta-box.php');

use SettingsPages\SliderSettings;
use SettingsPages\SliderSettingsCarousel;
use SettingsPages\BasicSettings;
use SettingsPages\SiteSettings;
use SettingsPages\PhotoAlbumsAdminGrid;

new SliderSettings('photos');
new SliderSettingsCarousel('photos');
new BasicSettings('photos');
new SiteSettings();
new PhotoAlbumsAdminGrid();
