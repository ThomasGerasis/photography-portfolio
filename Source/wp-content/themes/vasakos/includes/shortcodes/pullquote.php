<?php
/**
 * Pullquote Shortcode
 * Usage: [pullquote author="Anna, Edinburgh"]Quote text[/pullquote]
 */

function vasakos_pullquote_shortcode($atts, $content = '')
{
    $atts = shortcode_atts(array('author' => ''), $atts, 'pullquote');

    if (trim($content) === '') {
        return '';
    }

    $html  = '<blockquote class="vasakos-pullquote"><p>' . wp_kses_post(trim(strip_tags($content, '<em><strong><br>'))) . '</p>';
    if ($atts['author'] !== '') {
        $html .= '<cite>' . esc_html($atts['author']) . '</cite>';
    }
    return $html . '</blockquote>';
}
add_shortcode('pullquote', 'vasakos_pullquote_shortcode');
