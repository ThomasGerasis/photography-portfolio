<?php $settings = get_option('basic_settings');  ?>
<footer class="footer-area bg-black pt-10p">
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
                </div>

                <!-- Social Info -->
                <div class="footer-content d-flex align-items-center justify-content-center">
                    <!-- Copywrite Text -->
                    <div class="copywrite-text text-white">
                        <p class="text-white text-center copyright" style="font-size: 15px;">
                            Copyright &copy;<script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved Vasileios Vasakos | Made with <i class="fa fa-heart pulse"></i> by Thomas Gerasis
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Area End -->

<span id="scrollUp" style="display: none;">
    <i class="fas fa-angle-up"></i>
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
<script defer type="text/javascript" src="<?php echo get_template_directory_uri() . '/dist/slider.min.js'; ?>"></script>
<script defer type="text/javascript" src="<?php echo get_template_directory_uri() . '/dist/infinite-scroll.min.js'; ?>"></script>

<?php if (!is_category()) { ?>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl=en" async defer></script>
    <script type="text/javascript">
        var onloadCallback = function() {
            grecaptcha.render('recaptcha', {
                'sitekey': '6LfORqslAAAAAO_VAaiMqqHSSV_Mi22qaNt7D1w7'
            });
        };
    </script>
<?php } ?>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-WP6KF2ZDH2"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-WP6KF2ZDH2');
</script>

</body>

</html>