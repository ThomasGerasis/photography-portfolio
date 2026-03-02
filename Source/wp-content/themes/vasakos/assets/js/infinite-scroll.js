import imagesLoaded from 'imagesloaded';
import Masonry from 'masonry-layout';

jQuery(function ($) {

    // Support multiple gallery containers on the same page.
    // magnificPopup is NOT initialised here — scripts.js handles it via delegation
    // on .masonry-layout-container so dynamic items are automatically covered.
    $(".masonry-layout-container").each(function () {
        initGallery($(this));
    });

    function initGallery($container) {
        const maxPage  = parseInt($container.attr("data-max-pages"))  || 1;
        const category = parseInt($container.attr("data-category-id")) || 0;
        const perPage  = parseInt($container.attr("data-per-page"))   || 0;

        $container.attr('data-current-page', 1);

        const msnryItem = new Masonry($container[0], {
            itemSelector: '.media-slice',
            percentPosition: true
        });

        // Attach scroll handler AFTER images load and Masonry has set container height,
        // otherwise container height is 0 and the threshold fires on first tiny scroll.
        imagesLoaded($container[0], () => {
            msnryItem.layout();

            if (maxPage <= 1) return;

            let loading = false;
            let throttleTimer;

            $(window).on('scroll', function () {
                clearTimeout(throttleTimer);
                throttleTimer = setTimeout(function () {
                    const currentPage = parseInt($container.attr('data-current-page'));
                    if (loading || currentPage >= maxPage) return;

                    const scrollPosition = $(window).scrollTop() + $(window).height();
                    const containerBottom = $container.offset().top + $container.height();

                    if (scrollPosition >= containerBottom - 200) {
                        loading = true;
                        loadNextPage($container, category, perPage, msnryItem, function () {
                            loading = false;
                        });
                    }
                }, 150);
            });
        });
    }

    function loadNextPage($container, category, perPage, msnryItem, onComplete) {
        const nextPage = parseInt($container.attr('data-current-page')) + 1;

        const $wrapper = $container.closest('.alime-portfolio-area');
        const $loader  = $wrapper.find('.infinite-loader').length
            ? $wrapper.find('.infinite-loader')
            : $('#infinite-loader');
        $loader.show();

        $.ajax({
            url: window.location.origin + "/wp-admin/admin-ajax.php",
            type: "POST",
            data: {
                action: "load_more_gallery",
                page: nextPage,
                category: category,
                per_page: perPage
            },
            success: function (data) {
                const $newItems = $(data).css("opacity", 0);
                $container.append($newItems);

                imagesLoaded($newItems.get(), () => {
                    msnryItem.appended($newItems.get());
                    msnryItem.layout();
                    $newItems.css("opacity", 1);

                    setTimeout(() => {
                        $loader.hide();
                        $container.attr('data-current-page', nextPage);
                        if (onComplete) onComplete();
                    }, 400);
                });
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.error(thrownError);
                $loader.hide();
                if (onComplete) onComplete();
            }
        });
    }
});
