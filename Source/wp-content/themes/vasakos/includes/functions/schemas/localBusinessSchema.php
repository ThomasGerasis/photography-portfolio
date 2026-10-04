<?php

/**
 * Parse a line like "Mo-Fr 09:00-18:00" or "Sa 10:00-16:00" into an
 * OpeningHoursSpecification array. Returns null if format doesn't match.
 */
function parseOpeningHoursLine($line)
{
    $days = [
        'Mo' => 'Monday',
        'Tu' => 'Tuesday',
        'We' => 'Wednesday',
        'Th' => 'Thursday',
        'Fr' => 'Friday',
        'Sa' => 'Saturday',
        'Su' => 'Sunday',
    ];

    if (!preg_match('/^(Mo|Tu|We|Th|Fr|Sa|Su)(?:-(Mo|Tu|We|Th|Fr|Sa|Su))?\s+(\d{1,2}:\d{2})-(\d{1,2}:\d{2})$/i', trim($line), $m)) {
        return null;
    }

    $order = array_keys($days);
    $startIdx = array_search(ucfirst(strtolower($m[1])), $order);
    $endIdx = !empty($m[2]) ? array_search(ucfirst(strtolower($m[2])), $order) : $startIdx;

    if ($startIdx === false || $endIdx === false) {
        return null;
    }

    $dayOfWeek = [];
    $i = $startIdx;
    while (true) {
        $dayOfWeek[] = $days[$order[$i]];
        if ($i === $endIdx) {
            break;
        }
        $i = ($i + 1) % count($order);
    }

    return [
        "@type"     => "OpeningHoursSpecification",
        "dayOfWeek" => $dayOfWeek,
        "opens"     => $m[3],
        "closes"    => $m[4],
    ];
}

function localBusinessSchema()
{
    $settings = get_option('basic_settings');

    $serviceArea = array_filter(array_map('trim', explode(',', $settings['service_area'] ?? '')));
    $openingHours = array_filter(array_map('trim', explode("\n", $settings['opening_hours'] ?? '')));

    $schema = [
        "@context"    => "https://schema.org",
        "@type"       => "ProfessionalService",
        "name"        => $settings['name'] ?? get_bloginfo('name'),
        "image"       => esc_url(get_stylesheet_directory_uri() . '/assets/images/logo.jpg'),
        "url"         => get_site_url(),
        "telephone"   => $settings['phone'] ?? '',
        "email"       => $settings['email'] ?? '',
        "priceRange"  => $settings['price_range'] ?? '',
        "address"     => [
            "@type"           => "PostalAddress",
            "streetAddress"   => $settings['street_address'] ?? '',
            "addressLocality" => $settings['city'] ?? 'Edinburgh',
            "addressRegion"   => $settings['region'] ?? 'Scotland',
            "postalCode"      => $settings['postal_code'] ?? '',
            "addressCountry"  => $settings['country'] ?? 'GB',
        ],
        "geo"         => [
            "@type"     => "GeoCoordinates",
            "latitude"  => $settings['latitude'] ?? '',
            "longitude" => $settings['longitude'] ?? '',
        ],
        "areaServed"  => array_map(function ($area) {
            return ["@type" => "City", "name" => $area];
        }, $serviceArea),
        "openingHoursSpecification" => array_filter(array_map('parseOpeningHoursLine', $openingHours)),
        "sameAs"      => array_filter([
            $settings['instagram'] ?? '',
            $settings['facebook'] ?? '',
        ]),
    ];

    return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>';
}
