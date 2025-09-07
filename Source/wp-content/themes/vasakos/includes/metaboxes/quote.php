<?php global $wpalchemy_media_access;
$prefix = 'about_';
$mb->the_field($prefix . 'quote');
wp_editor(html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8'), 'quote', array('wpautop' => false, 'textarea_name' => $mb->get_the_name()));
