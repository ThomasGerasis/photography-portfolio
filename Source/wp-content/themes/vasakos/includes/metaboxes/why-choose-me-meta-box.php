<?php

/**
 * Custom Repeater Meta Box for "Why Choose Me" Section
 * Works on Pages and Category Terms
 */

class Why_Choose_Me_Meta_Box
{
    public function __construct()
    {
        // Add meta box for pages
        add_action('add_meta_boxes', array($this, 'add_meta_box'));
        add_action('save_post', array($this, 'save_post_meta'));

        // Add meta box for categories
        add_action('category_edit_form_fields', array($this, 'add_category_fields'), 10, 2);
        add_action('edited_category', array($this, 'save_category_meta'));

        // Enqueue admin scripts
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
    }

    public function enqueue_admin_scripts($hook)
    {
        if ('post.php' === $hook || 'post-new.php' === $hook || 'term.php' === $hook || 'edit-tags.php' === $hook) {
            wp_enqueue_style('why-choose-me-admin', get_template_directory_uri() . '/includes/settings-page/assets/why-choose-me-admin.css', array(), filemtime(get_template_directory() . '/includes/settings-page/assets/why-choose-me-admin.css'));
            wp_enqueue_script('why-choose-me-admin', get_template_directory_uri() . '/includes/settings-page/assets/why-choose-me-admin.js', array('jquery'), filemtime(get_template_directory() . '/includes/settings-page/assets/why-choose-me-admin.js'), true);
        }
    }

    public function add_meta_box()
    {
        $post_types = array('page', 'post');

        foreach ($post_types as $post_type) {
            add_meta_box(
                'why_choose_me_meta_box',
                'Why Choose Me Reasons',
                array($this, 'render_meta_box'),
                $post_type,
                'normal',
                'default'
            );
        }
    }

    public function render_meta_box($post)
    {
        wp_nonce_field('why_choose_me_meta_box', 'why_choose_me_meta_box_nonce');
        $reasons = get_post_meta($post->ID, 'why_choose_reasons', true);

        if (empty($reasons) || !is_array($reasons)) {
            $reasons = array();
        }

        $this->render_repeater_fields($reasons);
    }

    public function add_category_fields($term)
    {
        $reasons = get_term_meta($term->term_id, 'why_choose_reasons', true);

        if (empty($reasons) || !is_array($reasons)) {
            $reasons = array();
        }
?>
        <tr class="form-field">
            <th scope="row" colspan="2">
                <h2>Why Choose Me Reasons</h2>
            </th>
        </tr>
        <tr class="form-field">
            <td colspan="2">
                <?php
                wp_nonce_field('why_choose_me_category', 'why_choose_me_category_nonce');
                $this->render_repeater_fields($reasons, 'category');
                ?>
            </td>
        </tr>
    <?php
    }

    private function render_repeater_fields($reasons, $type = 'post')
    {
    ?>
        <div class="why-choose-me-repeater">
            <div class="repeater-items">
                <?php
                if (!empty($reasons)) {
                    foreach ($reasons as $index => $reason) {
                        $this->render_repeater_row($index, $reason);
                    }
                }
                ?>
            </div>
            <button type="button" class="button add-repeater-row">Add Reason</button>
        </div>

        <script type="text/template" id="why-choose-me-row-template">
            <?php $this->render_repeater_row('{{INDEX}}', array('icon' => '', 'title' => '', 'description' => '')); ?>
        </script>
    <?php
    }

    private function render_repeater_row($index, $reason)
    {
        $icon = isset($reason['icon']) ? esc_attr($reason['icon']) : '';
        $title = isset($reason['title']) ? esc_attr($reason['title']) : '';
        $description = isset($reason['description']) ? esc_textarea($reason['description']) : '';
    ?>
        <div class="repeater-row" data-index="<?php echo $index; ?>">
            <div class="repeater-row-header">
                <span class="repeater-row-title">Reason <?php echo is_numeric($index) ? ($index + 1) : ''; ?></span>
                <button type="button" class="button remove-repeater-row">Remove</button>
            </div>
            <div class="repeater-row-content">
                <p>
                    <label>Icon (FontAwesome class):</label>
                    <input type="text" name="why_choose_reasons[<?php echo $index; ?>][icon]" value="<?php echo $icon; ?>" placeholder="fas fa-camera-retro" class="widefat">
                    <small>Find icons at <a href="https://fontawesome.com/icons" target="_blank">fontawesome.com/icons</a></small>
                </p>
                <p>
                    <label>Title:</label>
                    <input type="text" name="why_choose_reasons[<?php echo $index; ?>][title]" value="<?php echo $title; ?>" placeholder="Professional Quality" class="widefat">
                </p>
                <p>
                    <label>Description:</label>
                    <textarea name="why_choose_reasons[<?php echo $index; ?>][description]" rows="3" class="widefat" placeholder="Brief description..."><?php echo $description; ?></textarea>
                </p>
            </div>
        </div>
<?php
    }

    public function save_post_meta($post_id)
    {
        if (!isset($_POST['why_choose_me_meta_box_nonce'])) {
            return;
        }

        if (!wp_verify_nonce($_POST['why_choose_me_meta_box_nonce'], 'why_choose_me_meta_box')) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        // Check if this is a revision
        if (wp_is_post_revision($post_id)) {
            return;
        }

        // Check post type
        $post_type = get_post_type($post_id);
        if (!in_array($post_type, array('post', 'page'))) {
            return;
        }

        if (isset($_POST['why_choose_reasons']) && is_array($_POST['why_choose_reasons'])) {
            $reasons = array_values($_POST['why_choose_reasons']); // Re-index array
            $sanitized_reasons = array();

            foreach ($reasons as $reason) {
                if (!empty($reason['title'])) { // Only save if title is present
                    $sanitized_reasons[] = array(
                        'icon' => sanitize_text_field($reason['icon']),
                        'title' => sanitize_text_field($reason['title']),
                        'description' => sanitize_textarea_field($reason['description'])
                    );
                }
            }

            update_post_meta($post_id, 'why_choose_reasons', $sanitized_reasons);
        } else {
            delete_post_meta($post_id, 'why_choose_reasons');
        }
    }

    public function save_category_meta($term_id)
    {
        if (!isset($_POST['why_choose_me_category_nonce'])) {
            return;
        }

        if (!wp_verify_nonce($_POST['why_choose_me_category_nonce'], 'why_choose_me_category')) {
            return;
        }

        if (isset($_POST['why_choose_reasons']) && is_array($_POST['why_choose_reasons'])) {
            $reasons = array_values($_POST['why_choose_reasons']); // Re-index array
            $sanitized_reasons = array();

            foreach ($reasons as $reason) {
                if (!empty($reason['title'])) { // Only save if title is present
                    $sanitized_reasons[] = array(
                        'icon' => sanitize_text_field($reason['icon']),
                        'title' => sanitize_text_field($reason['title']),
                        'description' => sanitize_textarea_field($reason['description'])
                    );
                }
            }

            update_term_meta($term_id, 'why_choose_reasons', $sanitized_reasons);
        } else {
            delete_term_meta($term_id, 'why_choose_reasons');
        }
    }
}

new Why_Choose_Me_Meta_Box();
