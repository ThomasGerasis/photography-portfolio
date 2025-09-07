<?php
$faqs = @get_post_meta($post->ID, 'faqs', true) ?? false;
if ($faqs) {
    $faqColor = get_post_meta($post->ID, 'faqs_color', true) ?: '#fff';
?>
    <div class="d-flex flex-wrap justify-content-start pl-20p mb-4 mt-20p">
        <h3 class="w-100 text-center">Frequently Asked Questions</h3>
        <span class="w-100 d-block text-center heading_title">What people ask</span>
    </div>

    <div class="d-flex flex-wrap align-items-start justify-content-center" id="faqs">
        <?php $i = 0;
        foreach ($faqs as $value): ?>
            <div class="faq__item mb-3">
                <h5 class="title d-flex justify-content-between align-items-center text-dark w-100" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse<?php echo $i; ?>"
                    aria-expanded="false"
                    aria-controls="collapse<?php echo $i; ?>">
                    <?php echo esc_html($value['question']); ?>
                    <i class="fas fa-chevron-down"></i>
                </h5>
                <div id="collapse<?php echo $i; ?>" class="collapse js-accordion-text">
                    <span class="text-13 text-dark"><?php echo wp_kses_post($value['answer']); ?></span>
                </div>
            </div>
        <?php $i++;
        endforeach; ?>
    </div>
<?php } ?>