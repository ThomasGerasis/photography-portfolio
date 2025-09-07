<?php global $wpalchemy_media_access; ?>

<style>
    .sliders_table {
        width: 100%;
        margin-top: 10px;
        margin-bottom: 20px;
        border-collapse: collapse;
    }

    .sliders_table th,
    .sliders_table td {
        padding: 8px;
        border: 1px solid #ddd;
        text-align: center;
    }

    .slider_td:hover {
        cursor: move;
    }

    .gallery-preview img {
        max-width: 140px;
        height: auto;
        display: block;
    }
</style>

<div class="my_meta_control metabox">
    <p><a href="#" class="docopy-sliders button">+ Add New Photo</a></p>

    <table class="sliders_table">
        <thead>
            <tr>
                <th>Order</th>
                <th>Select Image</th>
                <th>Preview</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php $counter = 0; ?>
            <?php while ($metabox->have_fields_and_multi('sliders', ['length' => 1, 'limit' => 10])): ?>
                <?php $metabox->the_group_open('tr'); ?>

                <!-- Order -->
                <td class="slider_td">
                    <span class="slider_order"><?= ($counter + 1); ?></span>
                    <input type="hidden" class="faqs_sort_order" name="<?php $metabox->the_name('order'); ?>" value="<?= $metabox->get_the_value('order'); ?>" />
                </td>

                <!-- Upload Button -->
                <td>
                    <button data-dest-selector="<?php $metabox->the_name(); ?>" class="btn btn-primary btn-sm add-image-button">Add Image</button>
                    <button data-dest-selector="<?php $metabox->the_name(); ?>" class="button select-media-button">Select Image</button>
                    <input type="hidden" class="image-id" name="<?php $metabox->the_name(); ?>" value="" />
                </td>

                <!-- Image Preview -->
                <?php $metabox->the_field('image_id'); ?>
                <td class="gallery-preview">
                    <?php
                    $image_id = $metabox->get_the_value();
                    $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'thumbnail') : '';
                    ?>
                    <img id="<?php $metabox->the_name(); ?>" src="<?= esc_url($image_url); ?>">
                </td>
                <!-- Delete -->
                <td>
                    <a href="#" class="dodelete button">
                        <span class="dashicons dashicons-trash"></span>
                    </a>
                </td>

                <?php $counter++; ?>
                <?php $metabox->the_group_close(); ?>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>


<script>
    jQuery(document).ready(function($) {
        // Fix: Enable inputs properly on clone
        $('.docopy-sliders').click(function() {
            setTimeout(() => {
                $('.wpa_group').each(function() {
                    $(this).find('input, select').prop('disabled', false);
                });
            }, 100);
        });

        // Fix: Sortable feature with updated ordering
        $(".sliders_table tbody").sortable({
            cursor: "move",
            handle: ".slider_td",
            update: function(event, ui) {
                $(this).children().each(function(index) {
                    $(this).find('.slider_order').text(index + 1);
                    $(this).find('input.faqs_sort_order').val(index + 1);
                });
            }
        });

        // Media Uploader for Selecting Images
        var media_window;

        $('.my_meta_control').on('click', '.add-image-button', function(e) {
            e.preventDefault();

            var button = $(this);

            // Get the target input field data dest-selector attribute
            var targetInput = $('input[name="' + button.data('dest-selector') + '"]');
            var previewImg = $(this).closest('tr').find('.gallery-preview img');

            if (media_window) {
                media_window.open();
                return;
            }

            media_window = wp.media({
                title: 'Select Image',
                library: {
                    type: 'image'
                },
                multiple: false,
                button: {
                    text: 'Use this image'
                }
            });

            media_window.on('select', function() {
                var attachment = media_window.state().get('selection').first().toJSON();
                targetInput.val(attachment.url);
                previewImg.attr('src', attachment.url); // Update preview instantly
            });

            media_window.open();
        });

        $('.my_meta_control').on('click', '.select-media-button', function(e) {
            e.preventDefault();

            var button = $(this);

            if (media_window) {
                media_window.open();
                return;
            }

            media_window = wp.media({
                title: 'Select Image',
                library: {
                    type: 'image'
                },
                multiple: false,
                button: {
                    text: 'Use this image'
                }
            });

            media_window.on('select', function() {
                var attachment = media_window.state().get('selection').first().toJSON();
                targetInput.val(attachment.id); // Store attachment ID
                previewImg.attr('src', attachment.sizes.thumbnail.url); // Update preview instantly
            });

            media_window.open();
        });
    });
</script>