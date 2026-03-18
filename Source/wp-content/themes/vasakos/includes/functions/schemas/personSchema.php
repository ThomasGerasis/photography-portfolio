<?php
function personSchema()
{
    $settings = get_option('basic_settings');

    $schema = [
        "@context"   => "https://schema.org",
        "@type"      => "Person",
        "name"       => $settings['name'] ?? get_bloginfo('name'),
        "url"        => get_site_url(),
        "email"      => $settings['email'] ?? '',
        "jobTitle"   => $settings['job_title'] ?? 'Professional Photographer',
        "image"      => [
            "@type"  => "ImageObject",
            "url"    => esc_url(get_stylesheet_directory_uri() . '/assets/images/logo.jpg'),
            "height" => 1144,
            "width"  => 916
        ],
        "sameAs"     => array_filter([
            $settings['instagram'] ?? '',
            $settings['facebook'] ?? '',
            $settings['twitter'] ?? '',
            $settings['linkedin'] ?? '',
        ])
    ];

    return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>';
}
