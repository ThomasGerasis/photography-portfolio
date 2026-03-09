<?php
/**
 * CTA Section Shortcode
 * Usage: [cta_section heading="Ready to capture your story?" text="Let's chat about your perfect shoot." button_text="Get in Touch" button_link="#contact" background="dark"]
 * background options: light | dark | <image URL>
 * align options: center | left
 */

function cta_section_shortcode($atts)
{
    $atts = shortcode_atts(
        array(
            'heading'        => '',
            'heading_tag'    => 'h2',    // h1 | h2 | h3 | h4 | p | none
            'text'           => '',
            'button_text'    => 'Get in Touch',
            'button_link'    => '#contact',
            'button_style'   => 'light',  // light | dark | outline-light | outline-dark
            'background'     => 'dark',   // light | dark | <image URL>
            'align'          => 'center', // center | left
        ),
        $atts,
        'cta_section'
    );

    $allowed_tags = ['h1', 'h2', 'h3', 'h4', 'p'];
    $heading_tag  = in_array($atts['heading_tag'], $allowed_tags) ? $atts['heading_tag'] : 'none';

    // Determine background style
    $is_image_bg = filter_var($atts['background'], FILTER_VALIDATE_URL);
    $bg_class    = '';
    $inline_style = '';

    if ($is_image_bg) {
        $bg_class    = 'vasakos-cta--image';
        $inline_style = 'background-image:url(' . esc_url($atts['background']) . ');';
    } elseif ($atts['background'] === 'light') {
        $bg_class = 'vasakos-cta--light';
    } else {
        $bg_class = 'vasakos-cta--dark';
    }

    $align_class = $atts['align'] === 'left' ? 'vasakos-cta--left' : 'vasakos-cta--center';

    ob_start();
?>
    <div class="vasakos-cta <?= esc_attr($bg_class . ' ' . $align_class); ?>"
        <?= $inline_style ? 'style="' . $inline_style . '"' : ''; ?>>

        <?php if ($is_image_bg) : ?>
            <div class="vasakos-cta__overlay"></div>
        <?php endif; ?>

        <div class="vasakos-cta__inner">
            <?php if (!empty($atts['heading']) && $heading_tag !== 'none') : ?>
                <<?= $heading_tag; ?> class="vasakos-cta__heading"><?= esc_html($atts['heading']); ?></<?= $heading_tag; ?>>
            <?php endif; ?>

            <?php if (!empty($atts['text'])) : ?>
                <p class="vasakos-cta__text"><?= esc_html($atts['text']); ?></p>
            <?php endif; ?>

            <?php if (!empty($atts['button_text'])) : ?>
                <a href="<?= esc_url($atts['button_link']); ?>"
                    class="vasakos-cta__btn btn btn-<?= esc_attr($atts['button_style']); ?>">
                    <?= esc_html($atts['button_text']); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('cta_section', 'cta_section_shortcode');
