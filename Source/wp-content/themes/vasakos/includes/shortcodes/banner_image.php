<?php

/**
 * Banner Image Shortcode
 * Usage: [banner_image image="https://..." title="Hello" subtitle="Subtitle" show_button="yes" button_text="Book Now" button_link="#contact" button_style="primary" overlay="yes"]
 */

function banner_image_shortcode($atts)
{
    $atts = shortcode_atts(
        array(
            'image'        => '',
            'title'        => '',
            'subtitle'     => '',
            'show_button'  => 'no',
            'button_text'  => 'Learn More',
            'button_link'  => '#',
            'button_style' => 'primary',
            'overlay'      => 'yes',
            'min_height'   => '400px',
        ),
        $atts,
        'banner_image'
    );

    $has_button = $atts['show_button'] === 'yes' && !empty($atts['button_link']);
    $has_overlay = $atts['overlay'] === 'yes';

    ob_start();
    ?>
    <div class="vasakos-banner"
         style="background-image: url('<?= esc_url($atts['image']); ?>'); min-height: <?= esc_attr($atts['min_height']); ?>; background-size: cover; background-position: center; position: relative; display: flex; align-items: center; justify-content: center; text-align: center;">

        <?php if ($has_overlay) : ?>
            <div class="vasakos-banner-overlay" style="position:absolute;inset:0;background:rgba(0,0,0,0.45);"></div>
        <?php endif; ?>

        <div class="vasakos-banner-content" style="position:relative;z-index:1;padding:2rem;">
            <?php if (!empty($atts['title'])) : ?>
                <h2 class="vasakos-banner-title text-white"><?= esc_html($atts['title']); ?></h2>
            <?php endif; ?>

            <?php if (!empty($atts['subtitle'])) : ?>
                <p class="vasakos-banner-subtitle text-white"><?= esc_html($atts['subtitle']); ?></p>
            <?php endif; ?>

            <?php if ($has_button) : ?>
                <a href="<?= esc_url($atts['button_link']); ?>"
                   class="btn btn-<?= esc_attr($atts['button_style']); ?> mt-3">
                    <?= esc_html($atts['button_text']); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('banner_image', 'banner_image_shortcode');
