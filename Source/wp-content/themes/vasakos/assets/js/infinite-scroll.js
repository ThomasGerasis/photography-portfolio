jQuery(function ($) {
    let page = 1;
    let loading = false;

    const $container = $(".masonry-layout-container");
    const maxPage = parseInt($container.attr("data-max-pages"));
    const category = parseInt($container.attr("data-category-id"));

    // Initial Masonry setup
    if ($.fn.imagesLoaded) {
        $container.imagesLoaded(function () {
            $container.masonry({
                itemSelector: '.media-slice',
                percentPosition: true
            });
        });
    }
   
    // Scroll Throttle
    let throttleTimer;
    $(window).on("scroll", function () {
        clearTimeout(throttleTimer);
        throttleTimer = setTimeout(function () {
            if (loading || page >= maxPage) return;

            let scrollPosition = $(window).scrollTop() + $(window).height();
            let containerBottom = $container.offset().top + $container.height();

            if (scrollPosition >= containerBottom - 100) {
                loadNextPage();
            }
        }, 150);
    });

    function loadNextPage() {
        loading = true;
        page++;

        const $loader = $('#infinite-loader');
        $loader.show();

        $.ajax({
            url: window.location.origin + "/wp-admin/admin-ajax.php",
            type: "POST",
            data: {
                action: "load_more_gallery",
                page: page,
                category: category
            },
            success: function (data) {

                const $newItems = $(data).css("opacity", 0); // hide new items for smooth fade-in
                // Step 1: Append new HTML (hidden)
                $container.append($newItems);

                $newItems.imagesLoaded(function () {
                    // Step 3: Masonry appends and re-layout
                    $container.masonry("appended", $newItems);
                    // $container.masonry("layout");

                    // Step 4: Fade in content
                    $newItems.css("opacity", 1);
                    
                    // Step 5: Keep loader until visual layout is ready
                    setTimeout(() => {

                        $loader.hide(); // instead of .remove()

                        // Re-init plugins
                        $('.image-popup-vertical-fit').magnificPopup({
                            type: 'image',
                            mainClass: 'mfp-with-zoom',
                            gallery: { enabled: true },
                            zoom: {
                                enabled: true,
                                duration: 300,
                                easing: 'ease-in-out',
                                opener: function (openerElement) {
                                    return openerElement.is('img') ? openerElement : openerElement.find('img');
                                }
                            }
                        });

                        // new WOW().init(); // Re-init animations
                        loading = false;
                    }, 400); // give a little breathing room after layout

                });
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
                loading = false;
                $loader.remove();
            }
        });
    }
});
