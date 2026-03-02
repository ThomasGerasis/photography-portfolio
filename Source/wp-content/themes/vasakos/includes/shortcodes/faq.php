<?php
/**
 * FAQ Shortcode
 * Usage: [faq page_id="123" title="Frequently Asked Questions" subtitle="What people ask"]
 */

function faq_shortcode($atts)
{
    $atts = shortcode_atts(
        array(
            'page_id' => '', // Page ID containing FAQ metabox
            'category_id' => '', // Category ID containing FAQ term meta
            'title' => 'Frequently Asked Questions',
            'subtitle' => 'What people ask',
        ),
        $atts,
        'faq'
    );

    $faqs = array();
    $faqColor = '#fff';

    // Check if we're getting FAQs from a category
    if (!empty($atts['category_id'])) {
        $faqs = get_term_meta($atts['category_id'], 'faqs', true);
        $faqColor = get_term_meta($atts['category_id'], 'faqs_color', true) ?: '#fff';
        
        // Override title/subtitle from category if not explicitly set in shortcode
        $stored_title = get_term_meta($atts['category_id'], 'faqs_intro_heading', true);
        $stored_subtitle = get_term_meta($atts['category_id'], 'faqs_intro_text', true);
        
        if (!empty($stored_title) && $atts['title'] === 'Frequently Asked Questions') {
            $atts['title'] = $stored_title;
        }
        if (!empty($stored_subtitle) && $atts['subtitle'] === 'What people ask') {
            $atts['subtitle'] = $stored_subtitle;
        }
    } 
    // Check if we're on a category archive page (auto-detect)
    elseif (is_category() && empty($atts['page_id'])) {
        $category = get_queried_object();
        if ($category && isset($category->term_id)) {
            $faqs = get_term_meta($category->term_id, 'faqs', true);
            $faqColor = get_term_meta($category->term_id, 'faqs_color', true) ?: '#fff';
            
            $stored_title = get_term_meta($category->term_id, 'faqs_intro_heading', true);
            $stored_subtitle = get_term_meta($category->term_id, 'faqs_intro_text', true);
            
            if (!empty($stored_title) && $atts['title'] === 'Frequently Asked Questions') {
                $atts['title'] = $stored_title;
            }
            if (!empty($stored_subtitle) && $atts['subtitle'] === 'What people ask') {
                $atts['subtitle'] = $stored_subtitle;
            }
        }
    }
    // Otherwise get from page
    else {
        $page_id = !empty($atts['page_id']) ? $atts['page_id'] : get_the_ID();

        if (!empty($page_id)) {
            $faqs = get_post_meta($page_id, 'faqs', true);
            $faqColor = get_post_meta($page_id, 'faqs_color', true) ?: '#fff';
        }
    }

    if (empty($faqs) || !is_array($faqs)) {
        return '<p>No FAQs found.</p>';
    }

    ob_start();
?>
    <div class="faq-section-wrapper">
        <?php if (!empty($atts['title']) || !empty($atts['subtitle'])) { ?>
            <div class="d-flex flex-wrap justify-content-start pl-20p mb-4 mt-20p">
                <?php if (!empty($atts['title'])) { ?>
                    <h3 class="w-100 text-center"><?= esc_html($atts['title']); ?></h3>
                <?php } ?>
                <?php if (!empty($atts['subtitle'])) { ?>
                    <span class="w-100 d-block text-center heading_title"><?= esc_html($atts['subtitle']); ?></span>
                <?php } ?>
            </div>
        <?php } ?>

        <div class="d-flex flex-wrap align-items-start justify-content-center" id="faqs">
            <?php
            $i = 0;
            foreach ($faqs as $value):
                $unique_id = 'faq-collapse-' . uniqid();
            ?>
                <div class="faq__item mb-3">
                    <h5 class="title d-flex justify-content-between align-items-center text-dark w-100" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $unique_id; ?>" aria-expanded="false" aria-controls="<?php echo $unique_id; ?>">
                        <?php echo esc_html($value['question']); ?>
                        <i class="fas fa-chevron-down"></i>
                    </h5>
                    <div id="<?php echo $unique_id; ?>" class="collapse js-accordion-text">
                        <span class="text-13 text-dark"><?php echo wp_kses_post($value['answer']); ?></span>
                    </div>
                </div>
            <?php
                $i++;
            endforeach;
            ?>
        </div>
    </div>
<?php

    return ob_get_clean();
}
add_shortcode('faq', 'faq_shortcode');
