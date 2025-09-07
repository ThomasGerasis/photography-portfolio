<?php
function reviewSchema($postID)
{
    ob_start();
    $votesData = userVotes::getUsersVotes($postID);
    $totalratingusers = $votesData['rating'];
    $totalvotesUsers = $votesData['totalVotes'];

    if ($totalvotesUsers > 0) { ?>
        <script type="application/ld+json">
            {
                "@context": "https://schema.org/",
                "@type": "AggregateRating",
                "itemReviewed": {
                    "@type": "CreativeWorkSeries",
                    "name": "<?= get_the_title($postID) ?>",
                    "author": "Bet-on-arme.com",
                    "image": "<?= get_the_post_thumbnail_url($postID) ?>",
                    "url": "<?= wp_get_canonical_url($postID) ?>"
                },
                "ratingValue": "<?= round(($totalratingusers * 10), 1) ?>",
                "bestRating": "100",
                "ratingCount": "<?= $totalvotesUsers ?>"
            }
        </script>
<?php }

    return ob_get_clean();
}
