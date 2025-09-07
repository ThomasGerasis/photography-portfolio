<?php
$settings  = get_option('basic_settings');
?>

<div class="w-100 d-flex flex-wrap position-relative">
    <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/lensdivider.svg' ?>" width="150" height="70" class="d-block img-fluid m-auto" loading="lazy">
    <p class="w-100 d-block text-center heading_title">Vasileios Vasakos</p>
    <h2 class="w-100 d-block text-center"><?= $settings['title'] ?? ''; ?></h2>
    <p class="w-100 d-block text-center p-10p"><?= $settings['text'] ?? ''; ?></p>
</div>