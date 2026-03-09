<?php
/**
 * Timeline Shortcode
 * Usage: [timeline title="Your Session Journey" items="Meet & Chat:We discuss your vision, The Session:Your day in Edinburgh, Gallery Delivery:Edited gallery in 3 weeks"]
 * Items format: "Step Title:Step description, Next Title:Next description"
 */

function timeline_shortcode($atts)
{
    $atts = shortcode_atts(
        array(
            'title'     => '',
            'title_tag' => 'h2', // h1 | h2 | h3 | h4 | p | none
            'items'     => '',
        ),
        $atts,
        'timeline'
    );

    // Parse "Title:Description, Title:Description" — allow colon inside description
    $raw_items = array_filter(array_map('trim', explode(',', $atts['items'])));
    $steps = [];
    foreach ($raw_items as $raw) {
        $parts = explode(':', $raw, 2);
        $steps[] = [
            'title' => trim($parts[0]),
            'desc'  => isset($parts[1]) ? trim($parts[1]) : '',
        ];
    }

    if (empty($steps)) {
        return '';
    }

    $allowed_tags = ['h1', 'h2', 'h3', 'h4', 'p'];
    $title_tag    = in_array($atts['title_tag'], $allowed_tags) ? $atts['title_tag'] : 'none';

    ob_start();
?>
    <div class="vasakos-timeline">
        <?php if (!empty($atts['title']) && $title_tag !== 'none') : ?>
            <<?= $title_tag; ?> class="vasakos-timeline__heading"><?= esc_html($atts['title']); ?></<?= $title_tag; ?>>
        <?php endif; ?>

        <ol class="vasakos-timeline__list">
            <?php foreach ($steps as $i => $step) : ?>
                <li class="vasakos-timeline__item">
                    <div class="vasakos-timeline__marker">
                        <span><?= $i + 1; ?></span>
                    </div>
                    <div class="vasakos-timeline__body">
                        <?php if (!empty($step['title'])) : ?>
                            <h4 class="vasakos-timeline__step-title"><?= esc_html($step['title']); ?></h4>
                        <?php endif; ?>
                        <?php if (!empty($step['desc'])) : ?>
                            <p class="vasakos-timeline__step-desc"><?= esc_html($step['desc']); ?></p>
                        <?php endif; ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ol>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('timeline', 'timeline_shortcode');
