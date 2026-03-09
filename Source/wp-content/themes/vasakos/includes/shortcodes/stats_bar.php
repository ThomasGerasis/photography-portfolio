<?php
/**
 * Stats Bar Shortcode
 * Usage: [stats_bar items="200+:Weddings, 8:Years experience, 5★:Average rating" background="light"]
 * Items format: "Value:Label, Value:Label"
 * background options: light | dark | transparent
 */

function stats_bar_shortcode($atts)
{
    $atts = shortcode_atts(
        array(
            'items'      => '',
            'background' => 'light', // light | dark | transparent
        ),
        $atts,
        'stats_bar'
    );

    $raw_stats = array_filter(array_map('trim', explode(',', $atts['items'])));
    $stats = [];
    foreach ($raw_stats as $raw) {
        $parts   = explode(':', $raw, 2);
        $stats[] = [
            'value' => trim($parts[0]),
            'label' => isset($parts[1]) ? trim($parts[1]) : '',
        ];
    }

    if (empty($stats)) {
        return '';
    }

    $bg_class = 'vasakos-stats--' . sanitize_html_class($atts['background']);

    ob_start();
?>
    <div class="vasakos-stats <?= esc_attr($bg_class); ?>">
        <?php foreach ($stats as $stat) : ?>
            <div class="vasakos-stats__item">
                <span class="vasakos-stats__value"><?= esc_html($stat['value']); ?></span>
                <?php if (!empty($stat['label'])) : ?>
                    <span class="vasakos-stats__label"><?= esc_html($stat['label']); ?></span>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('stats_bar', 'stats_bar_shortcode');
