<?php

/**
 * Meta box for Pricing Package CPT
 * Fields: location, price, duration, description, more_info
 * (title is handled by the native WordPress post title field)
 */

class Pricing_Package_Meta_Box
{
    private static $fields = array(
        array('key' => '_pkg_location',    'label' => 'Location',     'type' => 'text',     'placeholder' => 'e.g. Studio / Outdoor / Any'),
        array('key' => '_pkg_price',       'label' => 'Price',        'type' => 'text',     'placeholder' => 'e.g. £250 or £350 per group'),
        array('key' => '_pkg_duration',    'label' => 'Duration',     'type' => 'text',     'placeholder' => 'e.g. 2 hours'),
        array('key' => '_pkg_ideal_for',   'label' => 'Ideal For',    'type' => 'text',     'placeholder' => 'e.g. Couples, families, newborns…'),
        array('key' => '_pkg_description', 'label' => 'Description',  'type' => 'textarea', 'placeholder' => 'Short package description'),
        array('key' => '_pkg_more_info',   'label' => 'More Info',    'type' => 'textarea', 'placeholder' => 'Additional details, inclusions, notes…'),
    );

    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'add_meta_box'));
        add_action('save_post_pricing_package', array($this, 'save'));
    }

    public function add_meta_box()
    {
        add_meta_box(
            'pricing_package_details',
            'Package Details',
            array($this, 'render'),
            'pricing_package',
            'normal',
            'high'
        );
    }

    public function render($post)
    {
        wp_nonce_field('pricing_package_save', 'pricing_package_nonce');
        foreach (self::$fields as $field) :
            $value = get_post_meta($post->ID, $field['key'], true);
        ?>
            <p>
                <label for="<?= esc_attr($field['key']) ?>"><strong><?= esc_html($field['label']) ?></strong></label><br>
                <?php if ($field['type'] === 'textarea') : ?>
                    <textarea
                        id="<?= esc_attr($field['key']) ?>"
                        name="<?= esc_attr($field['key']) ?>"
                        rows="3"
                        placeholder="<?= esc_attr($field['placeholder']) ?>"
                        style="width:100%"
                    ><?= esc_textarea($value) ?></textarea>
                <?php else : ?>
                    <input
                        type="text"
                        id="<?= esc_attr($field['key']) ?>"
                        name="<?= esc_attr($field['key']) ?>"
                        value="<?= esc_attr($value) ?>"
                        placeholder="<?= esc_attr($field['placeholder']) ?>"
                        style="width:100%"
                    >
                <?php endif; ?>
            </p>
        <?php
        endforeach;
    }

    public function save($post_id)
    {
        if (!isset($_POST['pricing_package_nonce']) ||
            !wp_verify_nonce($_POST['pricing_package_nonce'], 'pricing_package_save')) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (!current_user_can('edit_post', $post_id)) return;

        foreach (self::$fields as $field) {
            if (isset($_POST[$field['key']])) {
                $sanitized = $field['type'] === 'textarea'
                    ? sanitize_textarea_field($_POST[$field['key']])
                    : sanitize_text_field($_POST[$field['key']]);
                update_post_meta($post_id, $field['key'], $sanitized);
            }
        }
    }
}

new Pricing_Package_Meta_Box();
