<?php
function pricingSchema()
{
    $packages = get_posts([
        'post_type'      => 'pricing_package',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ]);

    if (empty($packages)) {
        return '';
    }

    $settings = get_option('basic_settings');
    $offers   = [];

    foreach ($packages as $package) {
        $id       = $package->ID;
        $price    = get_post_meta($id, '_pkg_price', true);
        $duration = get_post_meta($id, '_pkg_duration', true);
        $image    = get_the_post_thumbnail_url($id, 'large');

        $offers[] = [
            "@type"          => "Offer",
            "name"           => $package->post_title,
            "priceCurrency"  => 'GBP',
            "price"          => intval(preg_replace('/[^0-9]/', '', $price)),
            "description"    => get_post_meta($id, '_pkg_description', true),
            "url"            => get_permalink(get_page_by_path('pricing')),
            "availability"   => "https://schema.org/PreOrder",
            "image"          => $image ?: '',
            "additionalProperty" => [
                "@type" => "PropertyValue",
                "name"  => "Duration",
                "value" => $duration ?: '1 hour'
            ]
        ];
    }

    $schema = [
        "@context"    => "https://schema.org",
        "@type"       => "Product",
        "name"        => "Professional Photoshoot Packages",
        "description" => "Various photoshoot packages including basic, premium, and wedding.",
        "image"       => [
            "@type"  => "ImageObject",
            "url"    => esc_url(get_stylesheet_directory_uri() . '/assets/images/logo.jpg'),
            "height" => 1144,
            "width"  => 916
        ],
        "brand"  => [
            "@type" => "Organization",
            "name"  => "VasakosShots",
            "url"   => get_site_url(),
            "email" => $settings['email'] ?? ''
        ],
        "offers" => $offers
    ];

    return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>';
}
