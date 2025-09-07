<?php
function websiteSchema()
{
    ob_start();
?>
    <script data-schema="WebSite" type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "name": "Betonarme.com",
            "alternateName": "Betonarme.com>",
            "potentialAction": [{
                "@type": "SearchAction",
                "target": "/?s={search_term_string}",
                "query-input": {
                    "@type": "PropertyValueSpecification",
                    "valueName": "search_term_string",
                    "valueRequired": true
                }
            }],
            "url": "<?php echo get_bloginfo('url'); ?>"
        }
    </script>
    <script data-schema="WebPage" type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebPage",
            "name": "<?php echo get_site_metadata() ?>",
            "description": "<?php echo get_site_metadata('description') ?>"
        }
    </script>
<?php
    return ob_get_clean();
}
