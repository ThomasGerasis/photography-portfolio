<?php global $wpalchemy_media_access; ?>
<div class="counter_meta_meta my_meta_control metabox">
    <h1>Counter Details</h1>
    <table border="0" cellspacing="0" class="counter_meta_table w-100">
        <tr style="background: gainsboro;text-align: center;height: 43px;">
            <th>Order</th>
            <th>Icon</th>
            <th>Number</th>
            <th>Title</th>
            <th></th>
        </tr>
        <tbody>
            <?php $my_counter = 0;
            $counter = 0; ?>
            <?php while ($metabox->have_fields_and_multi('counter_meta', array('length' => 1, 'limit' => 30))): ?>
                <?php $metabox->the_group_open('tr'); ?>

                <?php $metabox->the_field('order'); ?>
                <td class="counter_meta_td">
                    <div class="counter_meta_order" style="text-align: center;background-color: #a0a5aa; font-size: 16px; padding:7px; font-weight: bold;"><?php echo ($my_counter + 1); ?>ο</div>
                    <input type="text" class="counter_meta_sort_order" style="display: none;" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" />
                </td>

                <?php $metabox->the_field('icon') ?>
                <td id="tab-image<?= $my_counter + 1 ?>" class="">
                    <button data-dest-selector="#<?php $metabox->the_name(); ?>" class="btn btn-primary btn-sm add-counter-image-button">Add Icon</button>
                    <input style="width: 100%;" type="text" id="<?php $metabox->the_name(); ?>" name="<?php $metabox->the_name(); ?>" value="<?= $metabox->get_the_value() ?>" class="mr-1 stop" />
                    <img src="<?= $metabox->get_the_value() ?>" width="80" class="mr-1">
                </td>

                <?php $metabox->the_field('number'); ?>
                <td id="tab-head-<?= $my_counter + 1 ?>" class="">
                    <input style="width: 100%;" type="text" class="" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>" />
                </td>

                <?php $metabox->the_field('title'); ?>
                <td id="tab-des-<?= $my_counter + 1 ?>" class="">
                    <textarea class="w-100 repeblock" type="text" rows="3" name="<?php $metabox->the_name(); ?>" placeholder=""><?php $metabox->the_value(); ?></textarea>
                </td>

                <td class="">
                    <a href="#" class="dodelete button"><span class="dashicons dashicons-trash" style="pointer-events: none;"></span></a>
                </td>

                <?php $my_counter++; ?>
                <?php $metabox->the_group_close(); ?>
            <?php endwhile; ?>
            <p><a href="#" class="docopy-counter_meta button">Add Counter</a></p>
        </tbody>
    </table>

    <hr />
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

        $('.my_meta_control').on('click', '.add-counter-image-button', function(e) {
            e.preventDefault();
            dest_selector = esc_selector($(this).data('dest-selector')); // set
            media_window.open();
        });

        // $(".last.tocopy input.fun_facts_meta_table_sort_order").prop("disabled", true);
        // $(".last.tocopy textarea.repeblock").prop("disabled", true);
        // $(".last.tocopy input.repeblock").prop("disabled", true);
        //
        // $('.docopy-section_frontpage_meta').click(function(){
        //     $(".wpa_group").not(".last.tocopy").each(function () {
        //         $(this).find('input.section_frontpage_meta_sort_order').prop('disabled',false);
        //         $(this).find('textarea.repeblock').prop('disabled',false);
        //         $(this).find('input.repeblock').prop('disabled',false);
        //     });
        // });


        $(".counter_meta_table").find('tbody').sortable({
            dropOnEmpty: false,
            cursor: "move",
            handle: ".fun_facts_meta_td",
            update: function(event, ui) {
                $(this).children().each(function(index) {
                    $(this).find('.counter_meta_order').html(index + 1);
                    $(this).find('input.counter_meta_sort_order').val(index + 1);
                });
            }
        });

    });
</script>