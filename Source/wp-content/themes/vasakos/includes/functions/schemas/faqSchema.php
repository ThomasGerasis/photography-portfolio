<?php
function faqSchema($faqs)
{
    $mainEntity = [];

    foreach ($faqs as $faq) {
        $question = strip_tags($faq['question']);
        $answer   = strip_tags($faq['answer']);

        $mainEntity[] = [
            "@type" => "Question",
            "name" => $question,
            "acceptedAnswer" => [
                "@type" => "Answer",
                "text"  => $answer
            ]
        ];
    }

    $schema = [
        "@context" => "https://schema.org",
        "@type"    => "FAQPage",
        "mainEntity" => $mainEntity
    ];

    return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>';
}
