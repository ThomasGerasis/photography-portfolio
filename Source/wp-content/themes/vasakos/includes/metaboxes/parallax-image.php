<?php
global $wpalchemy_media_access;
?>
<div class="my_meta_control">
    <table>
        <tbody>
            <tr>
                <th>
                    Image Collaborate Banner
                </th>
            </tr>
            <tr>
                <?php $metabox->the_field('parralax_image') ?>
                <td>
                    <input type="text" id="<?php $metabox->the_name(); ?>" name="<?php $metabox->the_name(); ?>" value="<?= $metabox->get_the_value() ?>" class="mr-1" />
                </td>
            </tr>
            <tr>
                <td>
                    <img src="<?= $metabox->get_the_value() ?? '' ?>" width="150" height="150" class="mr-1">
                </td>
            </tr>
            <tr>
                <td><button data-dest-selector="#<?php $metabox->the_name(); ?>" class="btn btn-primary btn-sm add-image-button">Add Image</button></td>
            </tr>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        var dest_selector;
        var media_window = wp.media({
            title: 'Add Media',
            library: {
                type: 'image'
            },
            multiple: false,
            button: {
                text: 'Add'
            }
        });
        media_window.on('select', function() {
            let first = media_window.state().get('selection').first().toJSON();
            jQuery(dest_selector).val(first.url);
            dest_selector = null; // reset
        });

        function esc_selector(selector) {
            return selector.replace(/(:|\.|\[|\]|,)/g, "\\$1");
        }

        $('.my_meta_control').on('click', '.add-image-button', function(e) {
            e.preventDefault();
            dest_selector = esc_selector($(this).data('dest-selector')); // set
            media_window.open();
        });


    });
</script>