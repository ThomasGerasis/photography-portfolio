import $ from 'jquery';
import 'magnific-popup';
import imagesLoaded from 'imagesloaded';
import Masonry from 'masonry-layout';

let page = 1;
let loading = false;

jQuery(function ($) {

    const $container = $(".masonry-layout-container");
    const maxPage = parseInt($container.attr("data-max-pages"));
    const category = parseInt($container.attr("data-category-id"));

    let masonryContainer = document.querySelector('.masonry-layout-container');

    if (masonryContainer === null) {
        return;
    }

    // Initialize Masonry and assign to msnryItem
    const msnryItem = new Masonry(masonryContainer, {
        itemSelector: '.media-slice',
        percentPosition: true
    });

    // Make sure Masonry layout is triggered after images load
    imagesLoaded(masonryContainer, () => {
        msnryItem.layout();
    });


    // Throttled scroll handler
    let throttleTimer;
    $(window).on("scroll", function () {
        clearTimeout(throttleTimer);
        throttleTimer = setTimeout(function () {
            if (loading || page >= maxPage) return;

            const scrollPosition = $(window).scrollTop() + $(window).height();
            const containerBottom = $container.offset().top + $container.height();

            if (scrollPosition >= containerBottom - 100) {
                loadNextPage($container, category,msnryItem);
            }
        }, 150);
    });
});


function loadNextPage(container, category,msnryItem) {
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
            const $newItems = $(data).css("opacity", 0);
            container.append($newItems);

            imagesLoaded($newItems.get(), () => {

                // Tell Masonry about new appended items
                msnryItem.appended($newItems.get());

                msnryItem.layout();

                $newItems.css("opacity", 1);

                setTimeout(() => {
                    $loader.hide();

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

                    loading = false;
                }, 400);
            });
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.error(thrownError);
            loading = false;
            $loader.remove();
        }
    });
}
