<?php
/**
 * Video Embed Shortcode
 * Usage: [video_embed url="https://youtu.be/ID" title="My Video" ratio="16x9" caption="A beautiful day"]
 * Supports YouTube and Vimeo URLs.
 * ratio options: 16x9 (default) | 4x3 | 1x1
 */

function video_embed_shortcode($atts)
{
    $atts = shortcode_atts(
        array(
            'url'       => '',
            'title'     => '',
            'title_tag' => 'h3',   // h1 | h2 | h3 | h4 | p | none
            'caption'   => '',
            'ratio'     => '16x9', // 16x9 | 4x3 | 1x1
        ),
        $atts,
        'video_embed'
    );

    if (empty($atts['url'])) {
        return '';
    }

    $embed_url = vasakos_parse_video_url($atts['url']);
    if (!$embed_url) {
        return '<p class="text-danger">Invalid video URL.</p>';
    }

    $allowed_tags  = ['h1', 'h2', 'h3', 'h4', 'p'];
    $title_tag     = in_array($atts['title_tag'], $allowed_tags) ? $atts['title_tag'] : 'none';
    $ratio_map     = ['16x9' => '56.25%', '4x3' => '75%', '1x1' => '100%'];
    $padding_top   = $ratio_map[$atts['ratio']] ?? '56.25%';

    ob_start();
?>
    <div class="vasakos-video-embed">
        <?php if (!empty($atts['title']) && $title_tag !== 'none') : ?>
            <<?= $title_tag; ?> class="vasakos-video-embed__title"><?= esc_html($atts['title']); ?></<?= $title_tag; ?>>
        <?php endif; ?>

        <div class="vasakos-video-embed__wrapper" style="padding-top:<?= esc_attr($padding_top); ?>">
            <iframe
                src="<?= esc_url($embed_url); ?>"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen
                loading="lazy"
                title="<?= esc_attr($atts['title'] ?: 'Video'); ?>">
            </iframe>
        </div>

        <?php if (!empty($atts['caption'])) : ?>
            <p class="vasakos-video-embed__caption"><?= esc_html($atts['caption']); ?></p>
        <?php endif; ?>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('video_embed', 'video_embed_shortcode');

/**
 * Convert a YouTube or Vimeo watch URL to an embed URL.
 */
function vasakos_parse_video_url($url)
{
    // YouTube: youtu.be/ID or ?v=ID or /embed/ID
    if (preg_match('/(?:youtube\.com\/(?:watch\?(?:.*&)?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $m)) {
        return 'https://www.youtube.com/embed/' . $m[1] . '?rel=0';
    }

    // Vimeo: vimeo.com/ID or player.vimeo.com/video/ID
    if (preg_match('/(?:vimeo\.com\/(?:video\/)?|player\.vimeo\.com\/video\/)(\d+)/', $url, $m)) {
        return 'https://player.vimeo.com/video/' . $m[1];
    }

    return null;
}
