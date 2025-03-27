<?php
function faqSchema($faqs){
    ob_start();
    $i = 0;
    $len = count($faqs);
    ?>
<script type="application/ld+json">
{
    "@context": "https:\/\/schema.org",
    "@type": "FAQPage",
    "mainEntity": [ <?php
        $to_be_replaced = array("\r\n", "\n", "\r");
        $replacement = array(" ", " ", " ");
        foreach ($faqs as $value) {
            $stripped = str_replace('"', '', $value['answer']);
            if ($i === $len - 1) {
                ?> {
                                "@type": "Question",
                                "name": "<?= str_replace('"', '', $value['question']) ?>",
                                "acceptedAnswer": {
                                    "@type": "Answer",
                                    "text": "<?= str_replace($to_be_replaced, $replacement, strip_tags($stripped)) ?>"
                                }
                            }
                        <?php
            } else {
                ?> {
                                "@type": "Question",
                                "name": "<?= str_replace('"', '', $value['question']) ?>",
                                "acceptedAnswer": {
                                    "@type": "Answer",
                                    "text": "<?= str_replace($to_be_replaced, $replacement, strip_tags($stripped)) ?>"
                                }
                            },
                    <?php
            }
            $i++;
        }
        ?>
    ]
 }
</script>
    <?php
    return ob_get_clean();
}