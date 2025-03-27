<?php global $wpalchemy_media_access; ?>

<style type="text/css">
    td.sort_td:hover{cursor: move;}


    .faqs_table tr{
        display: flex;
        flex-flow: wrap;
        margin-top: 20px;
    }
    .faqs_table td label{
        display: block;
        font-weight: bold;
        font-size: 15px;
    }
    .w-100{
        width: 100%;
    }
    .w-50{
        width: 50%;
    }
    .w-25{
        width: 25%;
    }
</style>

<?php global $post;?>

<div class="my_meta_control metabox">
    <label>FAQ's Main Title</label>
    <?php $mb->the_field('faqs_intro_heading'); ?>
    <p>
        <input type="text" name="<?php $metabox->the_name('faqs_intro_heading'); ?>" value="<?php $metabox->the_value('faqs_intro_heading'); ?>"/>
    </p>
    <label>FAQ's Subtext</label>
    <p>
        <?php $mb->the_field('faqs_intro_text'); ?>
        <?php wp_editor(html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8'), 'faqs_intro_text', array('wpautop'=>false, 'textarea_name'=>$mb->get_the_name()) );?>
    </p>
    <label>FAQ's Color</label>
    <?php $mb->the_field('faqs_color'); ?>
    <p>
        <input type="text"  class="faqcolor" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
    </p>
    <p><a href="#" class="docopy-faqs button">New faq</a></p>

    <table  cellspacing="0" cellpadding="3" class="faqs_table" style="width: 100%; margin-top: 10px; margin-bottom: 20px;">
        <tbody>
        <?php $my_counter = 0;?>
        <?php while($metabox->have_fields_and_multi('faqs',array('length' => 1, 'limit' => 10000))): ?>
            <?php $metabox->the_group_open('tr'); ?>
            <?php $metabox->the_field('order'); ?>
            <td class="sort_td w-100">
                <div class="shown_order" style="text-align: center;background-color: #a0a5aa; font-size: 16px; padding: 7px; font-weight: bold;">Question #<?php echo ($my_counter + 1);?></div>
                <input type="text" class="section_game_meta_sort_order" style="display: none;" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
            </td>

            <td class="w-100">
                <label>Question</label>
                <?php $metabox->the_field('question'); ?>
                <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/><br/>
            </td>
            <?php $metabox->the_field('answer'); ?>
            <td class="w-100">
                <label>Answer</label>
                <?php wp_editor(html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8'), 'answer_'.$my_counter, array('wpautop'=>false, 'textarea_name'=>$mb->get_the_name()));?>
            </td>
            <td style="text-align: right; float: right;" class="w-100"><a href="#" class="dodelete button"><span class="dashicons dashicons-trash" style="pointer-events: none;"></span></a></td>
            <?php $my_counter++;?>
            <?php $metabox->the_group_close(); ?>
        <?php endwhile; ?>
        </tbody>
    </table>
    <hr/>
</div>

<script type="text/javascript">

    jQuery(function () {
        jQuery('.faqcolor').wpColorPicker();
    });
    jQuery( ".faqs_table" ).find('tbody').sortable( {
        dropOnEmpty: false,
        cursor: "move",
        handle: ".sort_td",
        update: function( event, ui ) {
            jQuery(this).children().each(function(index) {
                jQuery(this).find('.shown_order').html('Question #'+(index + 1));
                jQuery(this).find('input.faqs_sort_order').val(index + 1);
            });
            $(".wp-editor-area").removeAttr("style");
            $('.wp-editor-area').css('display','block');
        }
    });
</script>

