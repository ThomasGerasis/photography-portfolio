<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=5.0, minimum-scale=1">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<meta name="msapplication-TileColor" content="#da532c">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<meta name="author" content="vasakoshots.me" />
<meta name="MSSmartTagsPreventParsing" content="true" />
<meta http-equiv="x-ua-compatible" content="ie=edge">
<?php wp_head();?>
<link rel="stylesheet" href="<?= get_stylesheet_directory_uri().'/assets/css/core.css?v=11.7'?>">
<script type="text/javascript"> (function() { let css = document.createElement('link'); css.href = 'https://use.fontawesome.com/releases/v5.8.1/css/all.css'; css.rel = 'stylesheet'; css.type = 'text/css'; document.getElementsByTagName('head')[0].appendChild(css); })(); </script>
<script>window.FontAwesomeConfig = {searchPseudoElements: true}</script>
<link rel="preconnect" href="https://cdn.jsdelivr.net">
<link rel="dns-prefetch" href="https://code.jquery.com">
<link rel="preconnect" href='https://www.google-analytics.com'/>
<?php
$faqs = get_post_meta(get_the_ID(), 'faqs', true) ?? false;
    if (!empty($faqs)) {
        echo faqSchema($faqs);
    }
?>
</head>
<body <?php body_class(); ?>>
<div class="container w-100 p-0">
    <?php get_template_part('templates/menus/header-menu'); ?>
</div>