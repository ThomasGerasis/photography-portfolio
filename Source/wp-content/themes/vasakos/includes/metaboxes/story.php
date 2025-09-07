<?php
global $wpalchemy_media_access;
$prefix = 'about_';

$mb->the_field($prefix . 'heading_story'); ?>
<p><strong>Title</strong>: <input style="width: 90%" type="text" name="<?php $mb->the_name(); ?>" value="<?php $metabox->the_value(); ?>" /> </p>

<h3>Text</h3>
<?php

$mb->the_field($prefix . 'story');
wp_editor(html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8'), 'story', array('wpautop' => false, 'textarea_name' => $mb->get_the_name()));

?>
<h3>Read More Text</h3>
<?php
$mb->the_field($prefix . 'story_more');
wp_editor(html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8'), 'story_more', array('wpautop' => false, 'textarea_name' => $mb->get_the_name()));
