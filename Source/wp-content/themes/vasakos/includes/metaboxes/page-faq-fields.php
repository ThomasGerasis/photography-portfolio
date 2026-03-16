<?php
class Page_FAQ_Fields
{
    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'add_meta_box'));
        add_action('save_post_page', array($this, 'save_page_faq_fields'));
        add_action('save_post_post', array($this, 'save_page_faq_fields'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
    }

    public function enqueue_scripts($hook)
    {
        if ($hook !== 'post.php' && $hook !== 'post-new.php') {
            return;
        }

        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');
        wp_enqueue_editor();
    }

    public function add_meta_box()
    {
        add_meta_box(
            'page_faq_fields',
            'FAQ Settings',
            array($this, 'render_meta_box'),
            ['page', 'post'],
            'normal',
            'default'
        );
    }

    public function render_meta_box($post)
    {
        $faqs = get_post_meta($post->ID, 'faqs', true);
        $faqs_title = get_post_meta($post->ID, 'faqs_intro_heading', true);
        $faqs_text = get_post_meta($post->ID, 'faqs_intro_text', true);
        $faqs_color = get_post_meta($post->ID, 'faqs_color', true);

        if (!is_array($faqs)) {
            $faqs = array();
        }

        wp_nonce_field('save_page_faqs', 'page_faq_nonce');
?>

        <div style="margin-bottom: 15px;">
            <label><strong>FAQ Main Title</strong></label><br>
            <input type="text" name="faqs_intro_heading" value="<?php echo esc_attr($faqs_title); ?>" style="width:100%; max-width:500px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label><strong>FAQ Subtext</strong></label><br>
            <textarea name="faqs_intro_text" rows="3" style="width:100%; max-width:500px;"><?php echo esc_textarea($faqs_text); ?></textarea>
        </div>

        <div style="margin-bottom: 15px;">
            <label><strong>FAQ Color</strong></label><br>
            <input type="text" name="faqs_color" value="<?php echo esc_attr($faqs_color); ?>" class="faq-color-picker">
        </div>

        <hr>

        <p><a href="#" class="button add-faq-item">Add FAQ</a></p>
        <div id="page-faq-items"></div>

        <script>
            jQuery(document).ready(function($) {

                let faqCounter = 0;
                const existingFaqs = <?php echo json_encode($faqs); ?>;

                $('.faq-color-picker').wpColorPicker();

                function addFaqItem(question, answer) {
                    question = question || '';
                    answer = answer || '';

                    const itemHtml = `
                <div class="faq-item" style="background:#f9f9f9;padding:15px;margin:10px 0;border-left:3px solid #2271b1;">
                    <div style="margin-bottom:10px;">
                        <strong>Question #${faqCounter + 1}</strong>
                        <button type="button" class="button remove-faq-item" style="float:right;">Remove</button>
                    </div>
                    <input type="text" name="page_faqs[${faqCounter}][question]" value="${question}" style="width:100%;margin-bottom:10px;">
                    <textarea name="page_faqs[${faqCounter}][answer]" rows="4" style="width:100%;">${answer}</textarea>
                </div>
                `;

                    $('#page-faq-items').append(itemHtml);
                    faqCounter++;
                }

                if (existingFaqs && existingFaqs.length) {
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
                    $(this).closest('.faq-item').remove();
                });

            });
        </script>

<?php
    }

    public function save_page_faq_fields($post_id)
    {
        if (!isset($_POST['page_faq_nonce']) || !wp_verify_nonce($_POST['page_faq_nonce'], 'save_page_faqs')) {
            return;
        }

        update_post_meta($post_id, 'faqs_intro_heading', sanitize_text_field($_POST['faqs_intro_heading'] ?? ''));
        update_post_meta($post_id, 'faqs_intro_text', sanitize_textarea_field($_POST['faqs_intro_text'] ?? ''));
        update_post_meta($post_id, 'faqs_color', sanitize_hex_color($_POST['faqs_color'] ?? ''));

        if (isset($_POST['page_faqs']) && is_array($_POST['page_faqs'])) {
            $faqs = array();
            foreach ($_POST['page_faqs'] as $faq) {
                if (!empty($faq['question'])) {
                    $faqs[] = array(
                        'question' => sanitize_text_field($faq['question']),
                        'answer' => wp_kses_post($faq['answer'])
                    );
                }
            }
            update_post_meta($post_id, 'faqs', $faqs);
        } else {
            delete_post_meta($post_id, 'faqs');
        }
    }
}

new Page_FAQ_Fields();
