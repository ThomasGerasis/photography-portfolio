<?php

/**
 * Generic Button Shortcode
 * Usage: [button text="Click Here" link="#" style="primary" align="center" target="_self"]
 */

function button_shortcode($atts)
{
    $atts = shortcode_atts(
        array(
            'text'   => 'Click Here',
            'link'   => '#',
            'style'  => 'primary',   // primary | secondary | outline-primary | outline-secondary
            'align'  => 'left',      // left | center | right
            'target' => '_self',
        ),
        $atts,
        'button'
    );

    $align = in_array($atts['align'], ['left', 'center', 'right']) ? $atts['align'] : 'left';
    $target = $atts['target'] === '_blank' ? '_blank' : '_self';

    $btn_class = 'btn btn-' . sanitize_html_class($atts['style']);
    $wrapper_class = 'vasakos-button-wrapper text-' . $align;

    ob_start();
    ?>
    <div class="<?= esc_attr($wrapper_class); ?>">
        <a href="<?= esc_url($atts['link']); ?>"
           class="<?= esc_attr($btn_class); ?>"
           target="<?= esc_attr($target); ?>"
           <?= $target === '_blank' ? 'rel="noopener noreferrer"' : ''; ?>>
            <?= esc_html($atts['text']); ?>
        </a>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('button', 'button_shortcode');
