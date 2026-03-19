<?php
/**
 * Target Audience / "Who This Is For" Shortcode
 *
 * Usage:
 * [target_audience
 *   heading="Who this is for"
 *   subheading="Perfect for couples at any stage"
 *   intro="My couples photography in Edinburgh is ideal for:"
 *   items="Couples wanting romantic photos together, Engagement photoshoots, Anniversary or milestone celebrations"
 *   icon="check"
 *   image="https://..."
 * ]
 *
 * icon options: check | arrow | dot
 */

function target_audience_shortcode($atts)
{
    $atts = shortcode_atts(
        array(
            'heading'    => 'Who this is for',
            'subheading' => '',
            'intro'      => '',
            'items'      => '',
            'icon'       => 'check', // check | arrow | dot
            'image'      => '',
        ),
        $atts,
        'target_audience'
    );

    $items = array_filter(array_map('trim', explode(',', $atts['items'])));

    $icon_map = [
        'check' => 'fas fa-check',
        'arrow' => 'fas fa-chevron-right',
        'dot'   => 'fas fa-circle',
    ];
    $icon_class = $icon_map[$atts['icon']] ?? $icon_map['check'];

    ob_start();
?>
    <div class="target-audience-block<?= !empty($atts['image']) ? ' target-audience-block--has-image' : ''; ?>">

        <div class="target-audience-block__content">

            <?php if (!empty($atts['heading'])) : ?>
                <h2 class="target-audience__heading"><?= esc_html($atts['heading']); ?></h2>
            <?php endif; ?>

            <?php if (!empty($atts['subheading'])) : ?>
                <h3 class="target-audience__subheading"><?= esc_html($atts['subheading']); ?></h3>
            <?php endif; ?>

            <?php if (!empty($atts['intro'])) : ?>
                <p class="target-audience__intro"><?= esc_html($atts['intro']); ?></p>
            <?php endif; ?>

            <?php if (!empty($items)) : ?>
                <ul class="target-audience__list">
                    <?php foreach ($items as $item) : ?>
                        <li class="target-audience__item">
                            <i class="<?= esc_attr($icon_class); ?>" aria-hidden="true"></i>
                            <span><?= esc_html($item); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

        </div>

        <?php if (!empty($atts['image'])) : ?>
            <div class="target-audience-block__image-col">
                <div class="target-audience-block__polaroid">
                    <img src="<?= esc_url($atts['image']); ?>" alt="<?= esc_attr($atts['subheading'] ?: $atts['heading']); ?>" loading="lazy">
                </div>
            </div>
        <?php endif; ?>

    </div>
<?php
    return ob_get_clean();
}
add_shortcode('target_audience', 'target_audience_shortcode');
