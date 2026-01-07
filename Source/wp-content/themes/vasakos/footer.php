<?php $settings = get_option('basic_settings');  ?>
<footer class="footer-area bg-dark pt-10p">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-center flex-wrap">
                <!-- Footer Logo -->
                <div class="footer-logo d-flex justify-content-center mt-15">
                    <a href="#">
                        <img class="img img-fluid rounded-5" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.jpg" loading="lazy" width="70" height="70" alt="logo">
                    </a>
                </div>

                <div class="social-info d-flex justify-content-center col-12">
                    <a class="socials_button" target="_blank" href="<?= $settings['instagram'] ?? ''; ?>">
                        <div class="icon">
                            <i class="fab fa-instagram"></i>
                        </div>
                        <span>Vasakos_3vh</span>
                    </a>
                    <a class="socials_button" target="_blank" href="<?= $settings['facebook'] ?? ''; ?>">
                        <div class="icon">
                            <i class="fab fa-facebook-f"></i>
                        </div>
                        <span>VasakosShots</span>
                    </a>
                    <?php if (!empty($settings['whatsapp']) && $settings['whatsapp']) { ?>
                        <a class="socials_button" target="_blank" href="<?= $settings['whatsapp'] ?? ''; ?>">
                            <div class="icon">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            <span><?= $settings['whatsapp'] ?? ''; ?></span>
                        </a>
                    <?php } ?>
                    <a class="socials_button" target="_blank" href="<?= $settings['airbnb'] ?? ''; ?>">
                        <div class="icon">
                            <i class="fab fa-airbnb"></i>
                        </div>
                        <span>Airbnb Services</span>
                    </a>
                </div>

                <!-- Social Info -->
                <div class="footer-content d-flex align-items-center justify-content-center">
                    <!-- Copywrite Text -->
                    <div class="copywrite-text text-white">
                        <p class="text-white text-center copyright" style="font-size: 15px;">
                            Copyright &copy;<script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved Vasileios Vasakos | Made with
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#e90606" viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                                <path d="M305 151.1L320 171.8L335 151.1C360 116.5 400.2 96 442.9 96C516.4 96 576 155.6 576 229.1L576 231.7C576 343.9 436.1 474.2 363.1 529.9C350.7 539.3 335.5 544 320 544C304.5 544 289.2 539.4 276.9 529.9C203.9 474.2 64 343.9 64 231.7L64 229.1C64 155.6 123.6 96 197.1 96C239.8 96 280 116.5 305 151.1z" />
                            </svg> by Thomas Gerasis
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Area End -->

<span id="scrollUp" style="display: none;">
    <svg xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 320 512"
        width="25" height="25"
        aria-hidden="true" focusable="false">
        <path d="M168.5 164.6c-9.4-9.4-24.6-9.4-33.9 0l-136 136c-9.4 9.4-9.4 24.6 
             0 33.9s24.6 9.4 33.9 0L160 231.9l127.5 127.6c9.4 9.4 24.6 9.4 
             33.9 0s9.4-24.6 0-33.9l-136-136z" />
    </svg>
</span>

<div id="deferred-styles">
    <link rel="stylesheet" href="<?= get_stylesheet_directory_uri() . '/assets/css/default/magnific-popup.css' ?>">
</div>

<script>
    var loadDeferredStyles = function() {
        var addStylesNode = document.getElementById("deferred-styles");
        var replacement = document.createElement("div");
        replacement.innerHTML = addStylesNode.textContent;
        document.body.appendChild(replacement);
        addStylesNode.parentElement.removeChild(addStylesNode);
    };
    var raf = window.requestAnimationFrame || window.mozRequestAnimationFrame ||
        window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
    if (raf) raf(function() {
        window.setTimeout(loadDeferredStyles, 0);
    });
    else window.addEventListener('load', loadDeferredStyles);
    document.addEventListener("DOMContentLoaded", function() {
        var lazyVideos = [].slice.call(document.querySelectorAll("video.lazy"));

        if ("IntersectionObserver" in window) {
            var lazyVideoObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(video) {
                    if (video.isIntersecting) {
                        for (var source in video.target.children) {
                            var videoSource = video.target.children[source];
                            if (typeof videoSource.tagName === "string" && videoSource.tagName === "SOURCE") {
                                videoSource.src = videoSource.dataset.src;
                            }
                        }

                        video.target.load();
                        video.target.classList.remove("lazy");
                        lazyVideoObserver.unobserve(video.target);
                    }
                });
            });

            lazyVideos.forEach(function(lazyVideo) {
                lazyVideoObserver.observe(lazyVideo);
            });
        }
    });
    document.addEventListener("DOMContentLoaded", function() {
        const lazyLoadBackground = function() {
            var lazyBackgrounds = [].slice.call(document.querySelectorAll(".lazy-background"));

            if ("IntersectionObserver" in window) {
                let lazyBackgroundObserver = new IntersectionObserver(function(entries, observer) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.add("visible");
                            lazyBackgroundObserver.unobserve(entry.target);
                        }
                    });
                });

                lazyBackgrounds.forEach(function(lazyBackground) {
                    lazyBackgroundObserver.observe(lazyBackground);
                });
            }
        }
        lazyLoadBackground();
        document.addEventListener("scroll", lazyLoadBackground);
        window.addEventListener("resize", lazyLoadBackground);
        window.addEventListener("orientationchange", lazyLoadBackground);
    });
    document.addEventListener("DOMContentLoaded", function() {
        const lazyLoad = function() {
            let lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));
            let active = false;

            if (active === false) {
                active = true;

                setTimeout(function() {
                    lazyImages.forEach(function(lazyImage) {
                        if ((lazyImage.getBoundingClientRect().top <= window.innerHeight && lazyImage.getBoundingClientRect().bottom >= 0) && getComputedStyle(lazyImage).display !== "none") {
                            lazyImage.src = lazyImage.dataset.src;
                            // lazyImage.srcset = lazyImage.dataset.srcset;
                            lazyImage.classList.remove("lazy");

                            lazyImages = lazyImages.filter(function(image) {
                                return image !== lazyImage;
                            });

                            if (lazyImages.length === 0) {
                                document.removeEventListener("scroll", lazyLoad);
                                window.removeEventListener("resize", lazyLoad);
                                window.removeEventListener("orientationchange", lazyLoad);
                            }
                        }
                    });

                    active = false;
                }, 100);
            }
        };
        lazyLoad();
        document.addEventListener("scroll", lazyLoad);
        window.addEventListener("resize", lazyLoad);
        window.addEventListener("orientationchange", lazyLoad);
    });
</script>

<?php wp_footer(); ?>

<script defer type="text/javascript" src="<?php echo get_template_directory_uri() . '/dist/bootstrap.min.js'; ?>"></script>
<script defer type="text/javascript" src="<?php echo get_template_directory_uri() . '/dist/main.min.js'; ?>"></script>
<script defer type="text/javascript" src="<?php echo get_template_directory_uri() . '/dist/active.min.js'; ?>"></script>

<?php if (is_front_page()) { ?>
    <script defer type="text/javascript" src="<?php echo get_template_directory_uri() . '/dist/slider.min.js'; ?>"></script>
<?php } ?>

<?php if (is_category()) { ?>
    <script defer type="text/javascript" src="<?php echo get_template_directory_uri() . '/dist/infinite-scroll.min.js'; ?>"></script>
<?php } ?>

<?php if (!is_category()) { ?>

    <script>
        function loadRecaptcha() {
            var script = document.createElement("script");
            script.src = "https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl=en";
            script.async = true;
            script.defer = true;
            document.body.appendChild(script);
        }

        var onloadCallback = function() {
            grecaptcha.render('recaptcha', {
                'sitekey': '6LfORqslAAAAAO_VAaiMqqHSSV_Mi22qaNt7D1w7'
            });
        };

        setTimeout(loadRecaptcha, 3000);
    </script>
<?php } ?>

<script>
    function loadGtag() {
        // Load the gtag.js script
        var script = document.createElement("script");
        script.src = "https://www.googletagmanager.com/gtag/js?id=G-WP6KF2ZDH2";
        script.async = true;
        document.head.appendChild(script);

        // Initialize gtag after the script loads
        script.onload = function() {
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());
            gtag('config', 'G-WP6KF2ZDH2');
        };
    }
    setTimeout(loadGtag, 2000);
</script>

</body>

</html>