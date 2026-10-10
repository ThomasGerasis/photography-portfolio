<?php
/**
 * Location Card Shortcode
 * Usage: [location_card name="Calton Hill" map="https://maps.google.com/..." best_time="Sunset" duration="1 hour" image="https://..."]Short description[/location_card]
 */

function vasakos_location_card_shortcode($atts, $content = '')
{
    $atts = shortcode_atts(
        array(
            'name'      => '',
            'map'       => '',
            'best_time' => '',
            'duration'  => '',
            'image'     => '',
        ),
        $atts,
        'location_card'
    );

    if ($atts['name'] === '') {
        return '';
    }

    $facts = array(
        __('Best time', 'vasakos') => $atts['best_time'],
        __('Duration', 'vasakos')  => $atts['duration'],
    );

    ob_start();
?>
    <div class="vasakos-location" itemscope itemtype="https://schema.org/Place">
        <?php if ($atts['image'] !== '') : ?>
            <img class="vasakos-location__image" src="<?= esc_url($atts['image']); ?>" alt="<?= esc_attr($atts['name']); ?>" loading="lazy" itemprop="image">
        <?php endif; ?>
        <div class="vasakos-location__body">
            <h3 class="vasakos-location__name" itemprop="name"><?= esc_html($atts['name']); ?></h3>
            <?php if (trim($content) !== '') : ?>
                <p class="vasakos-location__text" itemprop="description"><?= wp_kses_post(trim(strip_tags($content, '<em><strong>'))); ?></p>
            <?php endif; ?>
            <ul class="vasakos-location__facts">
                <?php foreach ($facts as $label => $value) : if ($value === '') continue; ?>
                    <li><span><?= esc_html($label); ?></span> <?= esc_html($value); ?></li>
                <?php endforeach; ?>
            </ul>
            <?php if ($atts['map'] !== '') : ?>
                <a class="vasakos-location__map" href="<?= esc_url($atts['map']); ?>" target="_blank" rel="noopener" itemprop="hasMap">
                    <?= esc_html__('View on map', 'vasakos'); ?> ↗
                </a>
            <?php endif; ?>
        </div>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('location_card', 'vasakos_location_card_shortcode');
