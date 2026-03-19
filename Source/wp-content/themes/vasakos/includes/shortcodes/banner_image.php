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
            'title_tag'    => 'h2', // h1 | h2 | h3 | h4 | p | none
        ),
        $atts,
        'banner_image'
    );

    $has_button  = $atts['show_button'] === 'yes' && !empty($atts['button_link']);
    $has_overlay = $atts['overlay'] === 'yes';
    $allowed_tags = ['h1', 'h2', 'h3', 'h4', 'p'];
    $title_tag    = in_array($atts['title_tag'], $allowed_tags) ? $atts['title_tag'] : 'none';

    ob_start();
?>
    <div class="vasakos-banner d-flex position-relative w-100 rounded-10 align-items-center justify-content-center text-center"
        style="
        background-image: url('<?= esc_url($atts['image']); ?>'); 
        min-height: <?= esc_attr($atts['min_height']); ?>; 
        background-size: cover; 
        background-position: center; ">

        <?php if ($has_overlay) : ?>
            <div class="vasakos-banner-overlay rounded-10" style="position:absolute;inset:0;background:rgba(0,0,0,0.45);"></div>
        <?php endif; ?>

        <div class="vasakos-banner-content" style="position:relative;z-index:1;padding:2rem;">
            <?php if (!empty($atts['title']) && $title_tag !== 'none') : ?>
                <<?= $title_tag; ?> class="vasakos-banner-title text-white w-100 text-center pt-2 pt-lg-0 align-self-center"><?= esc_html($atts['title']); ?></<?= $title_tag; ?>>
            <?php endif; ?>

            <?php if (!empty($atts['subtitle'])) : ?>
                <p class="vasakos-banner-subtitle text-white w-100 text-center pt-10p pt-lg-0 align-self-center"><?= esc_html($atts['subtitle']); ?></p>
            <?php endif; ?>

            <?php if ($has_button) : ?>
                <div class="btn_container_borders w-100">
                    <a href="<?= esc_url($atts['button_link']); ?>"
                        class="border-btn text-white"
                        target="_self" aria-label="<?= esc_html($atts['button_text']); ?>">
                        <?= esc_html($atts['button_text']); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('banner_image', 'banner_image_shortcode');
