<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=5.0, minimum-scale=1">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="author" content="vasakoshots.me" />
    <meta name="MSSmartTagsPreventParsing" content="true" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-MVKX68QZ');</script>
    <!-- End Google Tag Manager -->
    <?php wp_head(); ?>
    <link rel="preload" href="/fonts/Muli.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="https://use.fontawesome.com/releases/v5.8.1/webfonts/fa-solid-900.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preconnect" href="https://use.fontawesome.com" crossorigin>
    <link rel="stylesheet" href="<?= get_stylesheet_directory_uri() . '/dist/css/bootstrap.min.css?v=3.5' ?>">
    <link rel="stylesheet" href="<?= get_stylesheet_directory_uri() . '/dist/css/main.min.css?v=3.7' ?>">

    <?php if (is_page_template('about.php')) { ?>
        <link rel="stylesheet" href="<?= get_stylesheet_directory_uri() . '/dist/css/about.min.css?v=3.5' ?>">
    <?php } ?>

    <script type="text/javascript">
        (function() {
            let css = document.createElement('link');
            css.href = 'https://use.fontawesome.com/releases/v5.8.1/css/all.css';
            css.rel = 'stylesheet';
            css.type = 'text/css';
            document.getElementsByTagName('head')[0].appendChild(css);
        })();
    </script>
    <script>
        window.FontAwesomeConfig = {
            searchPseudoElements: true
        }
    </script>
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="https://code.jquery.com">
    <link rel="preconnect" href='https://www.google-analytics.com' />
    <?php
    $faqs = get_post_meta(get_the_ID(), 'faqs', true) ?? false;
    if (!empty($faqs)) {
        echo faqSchema($faqs);
    }

    echo personSchema();
    // echo localBusinessSchema();
    echo breadcrumbSchema();
    ?>
</head>

<body <?php body_class(); ?>>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MVKX68QZ"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div class="container w-100 p-0">
        <?php get_template_part('templates/menus/header-menu'); ?>
    </div>