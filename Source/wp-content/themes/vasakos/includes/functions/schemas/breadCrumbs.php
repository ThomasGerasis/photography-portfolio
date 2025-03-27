<?php

function breadCrumbs($postID){
    ob_start();
    ?>
    <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "BreadcrumbList",
                "@id": "<?= get_site_metadata('canonical') ?>#breadcrumb",
                "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "item": {
                            "@id": "https://www.bet-on-arme.com",
                            "name": "Προγνωστικά Στοιχήματος"
                        }
                    },
                    <?php
        ?>
         {
                    "@type": "ListItem",
                    "position": 2,
                    "name": "<?= str_replace(array("'", "\"", "&quot;", "\n"), '', get_site_metadata()) ?>",
                    "item": "<?= get_site_metadata('canonical') ?>"
                }]
            }
        </script>
    <?php
    return ob_get_clean();
}