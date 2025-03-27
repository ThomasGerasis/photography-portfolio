<?php

function organizationSchema()
{
    ob_start();
?>
    <script data-schema="Organization" type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "Betonarme.com",
            "url": "/",
            "logo": {
                "@type": "ImageObject",
                "url": "/wp-content/themes/betonarme/assets/images/schema.png",
                "height": 130,
                "width": 700
            },
            "sameAs": ["https://twitter.com/betonarme"]
        }
    </script>

<?php
    return ob_get_clean();
}
