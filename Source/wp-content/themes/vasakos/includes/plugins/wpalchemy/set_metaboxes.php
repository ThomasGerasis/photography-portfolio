<?php
$simple_mb = new WPAlchemy_MetaBox(array
(
    'id' => '_testimonial_author',
    'title' => 'Testimonial author',
    'mode' => WPALCHEMY_MODE_EXTRACT,
    'template' => get_stylesheet_directory() . '/includes/metaboxes/testimonial-meta.php',
    'types' => array('testimonials')
));

$simple_mb = new WPAlchemy_MetaBox(array
(
    'id' => '_photos',
    'title' => 'Photos',
    'mode' => WPALCHEMY_MODE_EXTRACT,
    'template' => get_stylesheet_directory() . '/includes/metaboxes/photos-meta.php',
    'types' => array('photos')
));

$simple_mb = new WPAlchemy_MetaBox(array(
    'id' => '_homepage_meta',
    'title' => 'HomePage Fields',
    'context' => 'normal', // same as above, defaults to "normal"
    'priority' => 'high', // same as above, defaults to "high"
    'autosave' => TRUE,
    'types' => array('page'),
    'mode' => WPALCHEMY_MODE_EXTRACT,
    'template' => get_stylesheet_directory() . '/includes/metaboxes/homepage-meta.php',
));



$simple_mb = new WPAlchemy_MetaBox(array(
    'id' => '_faq_info',
    'title' => 'FAQ',
    'context' => 'normal', // same as above, defaults to "normal"
    'priority' => 'high', // same as above, defaults to "high"
    'autosave' => TRUE,
    'types' => array('page'),
    'mode' => WPALCHEMY_MODE_EXTRACT,
    'template' => get_stylesheet_directory() . '/includes/metaboxes/faq-meta.php',
));




$simple_mb = new WPAlchemy_MetaBox(array(
    'id' => '_basic',
    'title' => 'Set up Main Content',
    'context' => 'normal', // same as above, defaults to "normal"
    'priority' => 'high', // same as above, defaults to "high"
    'autosave' => TRUE,
    'include_template' => 'about.php',
    'mode' => WPALCHEMY_MODE_EXTRACT,
    'template' => get_stylesheet_directory() . '/includes/metaboxes/setup.php',
));


$simple_mb = new WPAlchemy_MetaBox(array(
    'id' => '_quote',
    'title' => 'Dream',
    'context' => 'normal', // same as above, defaults to "normal"
    'priority' => 'high', // same as above, defaults to "high"
    'autosave' => TRUE,
    'include_template' => 'about.php',
    'mode' => WPALCHEMY_MODE_EXTRACT,
    'template' => get_stylesheet_directory() . '/includes/metaboxes/quote.php',
));



$simple_mb = new WPAlchemy_MetaBox(array(
    'id' => '_mini_bio',
    'title' => 'Mini Bio',
    'context' => 'normal', // same as above, defaults to "normal"
    'priority' => 'high', // same as above, defaults to "high"
    'autosave' => TRUE,
    'include_template' => 'about.php',
    'mode' => WPALCHEMY_MODE_EXTRACT,
    'template' => get_stylesheet_directory() . '/includes/metaboxes/mini-bio.php',
));


$simple_mb = new WPAlchemy_MetaBox(array(
    'id' => '_story',
    'title' => 'Story Behind the man',
    'context' => 'normal', // same as above, defaults to "normal"
    'priority' => 'high', // same as above, defaults to "high"
    'autosave' => TRUE,
    'include_template' => 'about.php',
    'mode' => WPALCHEMY_MODE_EXTRACT,
    'template' => get_stylesheet_directory() . '/includes/metaboxes/story.php',
));


$simple_mb = new WPAlchemy_MetaBox(array(
    'id' => '_counter_details',
    'title' => 'Counter Details',
    'context' => 'normal', // same as above, defaults to "normal"
    'priority' => 'high', // same as above, defaults to "high"
    'autosave' => TRUE,
    'include_template' => 'about.php',
    'mode' => WPALCHEMY_MODE_EXTRACT,
    'template' => get_stylesheet_directory() . '/includes/metaboxes/counter-meta.php',
));

$simple_mb = new WPAlchemy_MetaBox(array(
    'id' => '_fun_facts',
    'title' => 'Fun Facts',
    'context' => 'normal', // same as above, defaults to "normal"
    'priority' => 'high', // same as above, defaults to "high"
    'autosave' => TRUE,
    'include_template' => 'about.php',
    'mode' => WPALCHEMY_MODE_EXTRACT,
    'template' => get_stylesheet_directory() . '/includes/metaboxes/fun_facts.php',
));


