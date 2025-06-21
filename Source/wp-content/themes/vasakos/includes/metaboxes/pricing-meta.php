<?php global $wpalchemy_media_access; ?>

<div class="my_meta_control">

    <p>Define pricing tiers below. Include an image, price, number of hours, and a description.</p>

    <p style="margin-bottom:15px; padding-top:5px;"><a href="#" class="docopy-pricing button">Add Package</a></p>

    <?php while ($mb->have_fields_and_multi('pricing')): ?>
        <?php $mb->the_group_open('div'); ?>
        <div class="card col-12">
            <div class="card-body row">
                <?php $metabox->the_field('image'); ?>
                <div class="col-md-4">
                    <label class="form-label">Image</label>
                    <div class="input-group">
                        <input style="width: 60%;" type="text" id="<?php $metabox->the_name(); ?>" name="<?php $metabox->the_name(); ?>" value="<?= $metabox->get_the_value() ?>" class="mr-1 stop" />
                        <button data-dest-selector="#<?php $metabox->the_name(); ?>" class="btn btn-outline-secondary add-pricing-image-button">Add Image</button>
                        <img src="<?= $metabox->get_the_value() ?>" width="80" class="mr-1">
                    </div>

                </div>

                <?php $metabox->the_field('title'); ?>
                <div class="col-md-2">
                    <label class="form-label">Title</label>
                    <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" class="form-control" />
                </div>

                <?php $metabox->the_field('price'); ?>
                <div class="col-md-2">
                    <label class="form-label">Price</label>
                    <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" class="form-control" />
                </div>

                <?php $metabox->the_field('hours'); ?>
                <div class="col-md-2">
                    <label class="form-label">Hours</label>
                    <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" class="form-control" />
                </div>


                <div class="col-md-2">
                    <label class="form-label d-block">&nbsp;</label>
                    <a href="#" class="dodelete btn btn-danger">Remove</a>
                </div>


                <?php $metabox->the_field('description'); ?>
                <div class="mb-3 col-12">
                    <label class="form-label">Description</label>
                    <textarea name="<?php $metabox->the_name(); ?>" rows="3" class="form-control"><?php $metabox->the_value(); ?></textarea>
                </div>

            </div>
        </div>

        <?php $mb->the_group_close(); ?>
    <?php endwhile; ?>


</div>


<script type="text/javascript">
    jQuery(document).ready(function($) {

        let dest_selector = null;

        // Create reusable media frame
        const media_window = wp.media({
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
            const selected = media_window.state().get('selection').first().toJSON();
            if (dest_selector) {
                $(dest_selector).val(selected.url);
                // If an <img> follows the input, update its src
                const previewImg = $(dest_selector).siblings('img');
                if (previewImg.length) {
                    previewImg.attr('src', selected.url);
                }
                dest_selector = null;
            }
        });

        // Escaping CSS selector
        function esc_selector(selector) {
            return selector.replace(/(:|\.|\[|\]|,)/g, "\\$1");
        }

        // Handle image button click
        $('.my_meta_control').on('click', '.add-pricing-image-button', function(e) {
            e.preventDefault();
            dest_selector = esc_selector($(this).data('dest-selector'));
            media_window.open();
        });


    });
</script>