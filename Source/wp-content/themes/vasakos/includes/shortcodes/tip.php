<?php
/**
 * Tip Shortcode
 * Usage: [tip title="Photographer's tip" icon="💡"]Wear solid colours.[/tip]
 */

function vasakos_tip_shortcode($atts, $content = '')
{
    $atts = shortcode_atts(
        array(
            'title' => __("Photographer's tip", 'vasakos'),
            'icon'  => '💡',
        ),
        $atts,
        'tip'
    );

    if (trim($content) === '') {
        return '';
    }

    return '<aside class="vasakos-tip">'
        . '<span class="vasakos-tip__icon" aria-hidden="true">' . esc_html($atts['icon']) . '</span>'
        . '<div class="vasakos-tip__body">'
        . '<strong class="vasakos-tip__title">' . esc_html($atts['title']) . '</strong>'
        . '<div class="vasakos-tip__text">' . wp_kses_post(do_shortcode(wpautop(trim($content)))) . '</div>'
        . '</div></aside>';
}
add_shortcode('tip', 'vasakos_tip_shortcode');
