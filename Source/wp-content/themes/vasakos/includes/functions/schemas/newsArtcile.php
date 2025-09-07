<?php
function newsArtcileSchema($postId)
{

    ob_start();

    $image_data = wp_get_attachment_image_src(get_post_thumbnail_id($postId),);
    $image_width = $image_data[1];
    $image_height = $image_data[2];

    $term_list = wp_get_post_terms($postId, 'category', ['fields' => 'all']);
    foreach ($term_list as $term) {
        $primary = $term->name;
    }
?>
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "NewsArticle",
            "headline": <?php echo json_encode(get_site_metadata(), JSON_UNESCAPED_UNICODE); ?>,
            "mainEntityOfPage": {
                "@type": "WebPage",
                "url": "<?= get_site_metadata('canonical') ?>"
            },
            "url": "<?= get_site_metadata('canonical') ?>",
            "thumbnailUrl": "<?= get_site_metadata('image') ?>",
            "image": {
                "@type": "ImageObject",
                "url": "<?= get_site_metadata('image') ?>",
                "width": <?= $image_width ?>,
                "height": <?= $image_height ?>
            },
            "dateCreated": "<?= get_the_date('c') ?>",
            "datePublished": "<?= get_the_date('c') ?>",
            "dateModified": "<?= get_the_modified_date('c', $postId) ?>",
            "articleSection": "<?= $primary ?>",
            "creator": {
                "@type": "Person",
                "name": "betonarme team"
            },
            "author": {
                "@type": "Person",
                "name": "betonarme team"
            },
            "publisher": {
                "@type": "Organization",
                "name": "Bet-on-arme.com",
                "logo": {
                    "@type": "ImageObject",
                    "url": "https://www.bet-on-arme.com/wp-content/themes/betonarme/assets/images/logo-beton.png",
                    "width": 1946,
                    "height": 252
                }
            },
            "articleBody": <?php echo json_encode(get_post_field('post_content', $postId), JSON_UNESCAPED_UNICODE); ?>,
            "description": <?php echo json_encode(get_site_metadata('description'), JSON_UNESCAPED_UNICODE); ?>
        }
    </script>

<?php
    return ob_get_clean();
}
