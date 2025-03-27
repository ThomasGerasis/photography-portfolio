<?php
$faqs = @get_post_meta($post->ID,'faqs',true) ?? false;
if ($faqs ) {
    $faqColor = get_post_meta($post->ID, 'faqs_color',true)? get_post_meta($post->ID, 'faqs_color',true) : '#fff';
    ?>
    <div class="d-flex flex-wrap justify-content-start pl-20p mt-20p">
        <h3 class="w-100 text-center">Frequently Asked Questions</h3>
        <span class="w-100 d-block text-center heading_title">What people ask</span>
    </div>
    <div class="accordion d-flex flex-wrap align-items-start" id="faqs">
        <?php $i = 0;
        foreach ($faqs as $value) {
            ?>
            <div class="faq__item">
                <h5 class="title d-flex justify-content-between align-items-center text-dark w-100 collapse<?php echo $i; ?>" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="<?php echo $i; ?>">
                <?php echo $value['question']; ?> <i class="fas fa-chevron-down"></i>
                </h5>
                <div id="collapse<?php echo $i; ?>" class="collapse aheto-contents__panel js-accordion-text" aria-labelledby="heading<?php echo $i; ?>" data-parent="#faqs">
                    <span class="text-13 text-dark"><?php echo $value['answer']; ?></span>
                </div>
            </div>
            <?php
            $i++;
    }
        ?>
    </div>
<?php } ?>