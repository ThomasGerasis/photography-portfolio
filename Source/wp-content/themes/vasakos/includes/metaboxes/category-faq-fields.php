<?php

/**
 * Category FAQ Fields
 * Adds FAQ fields to category taxonomy edit screen
 */

class Category_FAQ_Fields
{
    public function __construct()
    {
        add_action('photoshoots_add_form_fields', array($this, 'add_category_faq_fields'), 10, 2);
        add_action('photoshoots_edit_form_fields', array($this, 'edit_category_faq_fields'), 10, 2);
        add_action('created_photoshoots', array($this, 'save_category_faq_fields'), 10, 2);
        add_action('edited_photoshoots', array($this, 'save_category_faq_fields'), 10, 2);
        add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
    }

    public function enqueue_scripts($hook)
    {
        if ('term.php' !== $hook && 'edit-tags.php' !== $hook) {
            return;
        }

        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');
        wp_enqueue_editor();
    }

    public function add_category_faq_fields($taxonomy)
    {
?>
        <div class="form-field term-faq-wrap">
            <label><?php _e('FAQ Section', 'vasakos'); ?></label>
            <p><?php _e('Add FAQ questions and answers for this category page.', 'vasakos'); ?></p>
            <p><a href="#" class="button add-faq-item"><?php _e('Add FAQ', 'vasakos'); ?></a></p>
            <div id="category-faq-items"></div>
        </div>

        <script type="text/javascript">
            jQuery(document).ready(function($) {
                let faqCounter = 0;

                function addFaqItem(question, answer) {
                    question = question || '';
                    answer = answer || '';
                    const itemHtml = `
                    <div class="faq-item" style="background: #f9f9f9; padding: 15px; margin: 10px 0; border-left: 3px solid #2271b1;">
                        <div style="margin-bottom: 10px;">
                            <strong>Question #${faqCounter + 1}</strong>
                            <button type="button" class="button remove-faq-item" style="float: right;">Remove</button>
                        </div>
                        <div style="margin-bottom: 10px;">
                            <label>Question:</label><br>
                            <input type="text" name="category_faqs[${faqCounter}][question]" value="${question}" style="width: 100%;" />
                        </div>
                        <div>
                            <label>Answer:</label><br>
                            <textarea name="category_faqs[${faqCounter}][answer]" rows="4" style="width: 100%;">${answer}</textarea>
                        </div>
                    </div>
                `;
                    $('#category-faq-items').append(itemHtml);
                    faqCounter++;
                }

                $(document).on('click', '.add-faq-item', function(e) {
                    e.preventDefault();
                    addFaqItem();
                });

                $(document).on('click', '.remove-faq-item', function(e) {
                    e.preventDefault();
                    $(this).closest('.faq-item').fadeOut(300, function() {
                        $(this).remove();
                        // Renumber questions
                        $('#category-faq-items .faq-item').each(function(index) {
                            $(this).find('strong').first().text('Question #' + (index + 1));
                        });
                    });
                });
            });
        </script>
    <?php
    }

    public function edit_category_faq_fields($term, $taxonomy)
    {
        $term_id = $term->term_id;
        $faqs = get_term_meta($term_id, 'faqs', true);
        $faqs_title = get_term_meta($term_id, 'faqs_intro_heading', true);
        $faqs_text = get_term_meta($term_id, 'faqs_intro_text', true);
        $faqs_color = get_term_meta($term_id, 'faqs_color', true);

        if (!is_array($faqs)) {
            $faqs = array();
        }
    ?>
        <tr class="form-field term-faq-wrap">
            <th scope="row">
                <label><?php _e('FAQ Settings', 'vasakos'); ?></label>
            </th>
            <td>
                <div style="margin-bottom: 15px;">
                    <label><strong><?php _e('FAQ Main Title', 'vasakos'); ?></strong></label><br>
                    <input type="text" name="faqs_intro_heading" value="<?php echo esc_attr($faqs_title); ?>" style="width: 100%; max-width: 500px;" />
                </div>

                <div style="margin-bottom: 15px;">
                    <label><strong><?php _e('FAQ Subtext', 'vasakos'); ?></strong></label><br>
                    <textarea name="faqs_intro_text" rows="3" style="width: 100%; max-width: 500px;"><?php echo esc_textarea($faqs_text); ?></textarea>
                </div>

                <div style="margin-bottom: 15px;">
                    <label><strong><?php _e('FAQ Color', 'vasakos'); ?></strong></label><br>
                    <input type="text" name="faqs_color" value="<?php echo esc_attr($faqs_color); ?>" class="faq-color-picker" />
                </div>

                <hr>

                <div style="margin-top: 20px;">
                    <label><strong><?php _e('FAQ Items', 'vasakos'); ?></strong></label>
                    <p><a href="#" class="button add-faq-item"><?php _e('Add FAQ', 'vasakos'); ?></a></p>
                    <div id="category-faq-items"></div>
                </div>

                <p class="description"><?php _e('Add frequently asked questions for this category page.', 'vasakos'); ?></p>
            </td>
        </tr>

        <script type="text/javascript">
            jQuery(document).ready(function($) {
                let faqCounter = 0;
                const existingFaqs = <?php echo json_encode($faqs); ?>;

                // Initialize color picker
                $('.faq-color-picker').wpColorPicker();

                function addFaqItem(question, answer) {
                    question = question || '';
                    answer = answer || '';
                    const itemHtml = `
                    <div class="faq-item" style="background: #f9f9f9; padding: 15px; margin: 10px 0; border-left: 3px solid #2271b1;">
                        <div style="margin-bottom: 10px;">
                            <strong>Question #${faqCounter + 1}</strong>
                            <button type="button" class="button remove-faq-item" style="float: right;">Remove</button>
                        </div>
                        <div style="margin-bottom: 10px;">
                            <label>Question:</label><br>
                            <input type="text" name="category_faqs[${faqCounter}][question]" value="${$('<div>').text(question).html()}" style="width: 100%;" />
                        </div>
                        <div>
                            <label>Answer:</label><br>
                            <textarea name="category_faqs[${faqCounter}][answer]" rows="4" style="width: 100%;">${$('<div>').text(answer).html()}</textarea>
                        </div>
                    </div>
                `;
                    $('#category-faq-items').append(itemHtml);
                    faqCounter++;
                }

                // Load existing FAQs
                if (existingFaqs && existingFaqs.length > 0) {
                    existingFaqs.forEach(function(faq) {
                        addFaqItem(faq.question || '', faq.answer || '');
                    });
                }

                $(document).on('click', '.add-faq-item', function(e) {
                    e.preventDefault();
                    addFaqItem();
                });

                $(document).on('click', '.remove-faq-item', function(e) {
                    e.preventDefault();
                    $(this).closest('.faq-item').fadeOut(300, function() {
                        $(this).remove();
                        // Renumber questions
                        $('#category-faq-items .faq-item').each(function(index) {
                            $(this).find('strong').first().text('Question #' + (index + 1));
                        });
                    });
                });
            });
        </script>
<?php
    }

    /**
     * Save category FAQ fields
     */
    public function save_category_faq_fields($term_id)
    {
        // Save FAQ title
        if (isset($_POST['faqs_intro_heading'])) {
            update_term_meta($term_id, 'faqs_intro_heading', sanitize_text_field($_POST['faqs_intro_heading']));
        }

        // Save FAQ subtext
        if (isset($_POST['faqs_intro_text'])) {
            update_term_meta($term_id, 'faqs_intro_text', sanitize_textarea_field($_POST['faqs_intro_text']));
        }

        // Save FAQ color
        if (isset($_POST['faqs_color'])) {
            update_term_meta($term_id, 'faqs_color', sanitize_hex_color($_POST['faqs_color']));
        }

        // Save FAQ items
        if (isset($_POST['category_faqs']) && is_array($_POST['category_faqs'])) {
            $faqs = array();
            foreach ($_POST['category_faqs'] as $faq) {
                if (!empty($faq['question'])) {
                    $faqs[] = array(
                        'question' => sanitize_text_field($faq['question']),
                        'answer' => wp_kses_post($faq['answer'])
                    );
                }
            }
            update_term_meta($term_id, 'faqs', $faqs);
        } else {
            // Clear FAQs if none provided
            delete_term_meta($term_id, 'faqs');
        }
    }
}

// Initialize
new Category_FAQ_Fields();
