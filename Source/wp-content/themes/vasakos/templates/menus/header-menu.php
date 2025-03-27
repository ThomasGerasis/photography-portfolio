<header class="site-header">
    <?php
    $height = $GLOBALS['is_mobile'] ? '50' : '75';
    $width = $GLOBALS['is_mobile'] ? '50' : '75';

    if ($GLOBALS['is_mobile']){
        ?>
        <div class="site-mobile-menu site-navbar-target ">
            <div class="site-mobile-menu-header position-relative">
                <div class="site-mobile-menu-close mt-3 position-absolute ">
                    <i class="fas fa-times text-white text-16 js-menu-toggle"></i>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>

        <nav class="navbar navbar-expand-sm  pt-0p pb-0p header mobilenav bg-white">
            <div class="container-fluid pl-0p pr-10p pt-0p pb-0p w-100">
                <a href="<?php echo home_url(); ?>" class="f-top__home logo_wrap bg-white d-flex align-items-center navbar-brand logo js-router-link">
                    <img title="logo" alt="Logo" class="pb-1 pb-lg-0 pb-xl-0" width="60" height="50"  src='<?php echo get_stylesheet_directory_uri(); ?>/assets/images/lensdivider.svg'>
                    <p class="w-100 d-block text-center heading_title" style="margin: auto;">Vasileios  Vasakos</p>
                </a>
                <section class="header__col">
                    <a href="#" class="text-black site-menu-toggle pt-10p js-menu-toggle">
                        <img class="img-fluid pb-1 pb-lg-0 pb-xl-0" width="30" height="30" style="filter: invert(1)" alt="hamburger icon" src='<?php echo get_stylesheet_directory_uri(); ?>/assets/images/hamburger.svg'>
                    </a>
                </section>
            </div>
        </nav>

        <ul class="f-top-menu js-clone-nav d-none">
            <?php
            $name = wp_get_nav_menu_name('main-menu');
            $menumobile = wp_get_nav_menu_items($name); // all the "upper" menu items array
            if ($menumobile){
                foreach($menumobile as $item){
                    ?>
                    <li class="f-top-menu__item">
                        <a href="<?php echo $item->url;?>" class="f-top-menu__link text-decoration-none">
                            <span class="pt-4p font-weight-bold"><?php echo $item->title;?></span>
                        </a>
                    </li>
                    <?php
                }
                wp_reset_postdata();
            }
            ?>
        </ul>
        <?php
    }else{
        ?>
        <div class="site-title d-flex align-self-center position-relative">
            <a href="<?php echo home_url();?>" class="custom-logo-link d-flex" rel="home" aria-current="page">
                <img class="img img-fluid p-5p" src="<?php echo get_stylesheet_directory_uri().'/assets/images/lensdivider.svg'; ?>" width="<?php echo $width;?>" height="<?php echo $height;?>" alt="Logo">
                <span class="w-100 d-block text-center heading_title" style="margin: auto;">Vasileios Vasakos</h1>
            </a>
        </div>
        <div class="menu ml-auto d-flex align-items-center">
            <?php
            $args = array(
                'menu_class'        =>  "d-flex main-menu navbar-nav", // (string) CSS class to use for the ul element which forms the menu. Default 'menu'.
                'container_class'   =>  "navbar navbar-expand-sm pl -lg-0 pl-xl-0 pr-xl-0 pr-lg-0" ,
                'depth'             => 4,
                'container_id'      =>  "",
                'theme_location'    =>  "main-menu", // (string) Theme location to be used. Must be registered with register_nav_menu() in order to be selectable by the user.
                'walker'            => new Walker_Nav_Menu(),
            );
            wp_nav_menu($args);
            ?>
        </div>
        <?php
    }
    ?>

</header>




