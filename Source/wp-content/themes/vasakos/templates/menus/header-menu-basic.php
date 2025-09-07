<!-- Header Area Start -->
<header class="header-area">
    <!-- Main Header Start -->
    <div class="main-header-area">
        <div class="classy-nav-container breakpoint-off">
            <div class="container">
                <nav class="classy-navbar justify-content-between" id="alimeNav">
                    <!-- Logo -->
                    <?php
                    $height = $GLOBALS['is_mobile'] ? '50' : '65';
                    $width = $GLOBALS['is_mobile'] ? '50' : '65';
                    ?>

                    <a class="nav-brand" href="<?php echo home_url(); ?>">
                        <img class="img img-fluid" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/logo.jpg'; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="Logo">
                    </a>

                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>
                    <!-- Menu -->
                    <div class="classy-menu">
                        <!-- Menu Close Button -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>

                        <!-- Nav Start -->
                        <div class="classynav">
                            <?php
                            $args = array(
                                'menu_class'        =>  "", // (string) CSS class to use for the ul element which forms the menu. Default 'menu'.
                                'container_class'   =>  "",
                                'depth'             => 4,
                                'container_id'      =>  "nav",
                                'theme_location'    =>  "main-menu", // (string) Theme location to be used. Must be registered with register_nav_menu() in order to be selectable by the user.
                                'walker'            => new Walker_Nav_Menu(),
                            );
                            wp_nav_menu($args);
                            ?>
                        </div>

                    </div>
                </nav>

            </div>
        </div>
    </div>
</header>
<!-- Header Area End -->