<?php
function pricingSchema($packages)
{
    $offers = [];
    $settings = get_option('basic_settings');
    foreach ($packages as $package) {
        $offers[] = [
            "@type" => "Offer",
            "name" => $package['title'], // e.g., "Wedding Photoshoot Package"
            "priceCurrency" => 'GBP', // e.g., "USD"
            "price" => intval($package['price']), // 125, // e.g., "499"
            "description" => $package['description'], // e.g., "Includes 4 hours of coverage and 100 edited photos"
            "url" =>  get_site_url() . "/pricing/", // link to package detail page,
            "availability" => "https://schema.org/PreOrder",
            "image" => $package['image'] ?? '', // required!
            "additionalProperty" => [
                "@type" => "PropertyValue",
                "name" => "Duration",
                "value" => $package['hours'] ?? '1' // e.g., "1 hour", "3 hours"
            ]
        ];
    }

    $schema = [
        "@context" => "https://schema.org",
        "@type" => "Product",
        "name" => "Professional Photoshoot Packages",
        "description" => "Various photoshoot packages including basic, premium, and wedding.",
        "image" => [
            "@type" => "ImageObject",
            "url" => esc_url(get_stylesheet_directory_uri() . '/assets/images/logo.jpg'),
            "height" => 1144,
            "width" => 916

        ],
        "brand" => [
            "@type" => "Organization",
            "name" => "VasakosShots",
            "url" => get_site_url(),
            "email" => $settings['email'] ?? ''
        ],
        "offers" => $offers
    ];

    return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>';
}
