import imagesLoaded from 'imagesloaded';
import Masonry from 'masonry-layout';

jQuery(function ($) {

    $(".masonry-layout-container").each(function () {
        initGallery($(this));
    });

    function initGallery($container) {
        const maxPage  = parseInt($container.attr("data-max-pages"))  || 1;
        const category = parseInt($container.attr("data-category-id")) || 0;
        const perPage  = parseInt($container.attr("data-per-page"))   || 0;

        $container.attr('data-current-page', 1);

        const msnry = new Masonry($container[0], {
            itemSelector: '.media-slice',
            percentPosition: true
        });

        // Re-layout once initial images are loaded
        imagesLoaded($container[0], () => msnry.layout());
             console.log('here');
        if (maxPage <= 1) return;

        // Scope the button to this specific gallery — supports multiple galleries per page
        const buttonWrap = $container.closest('.alime-portfolio-area');
        const loadMorebtn  = buttonWrap.find('.gallery-load-more-btn');

        loadMorebtn.on('click', function () {
            console.log('test');
            const currentPage = parseInt($container.attr('data-current-page'));
            if (currentPage >= maxPage) return;

            loadMorebtn.prop('disabled', true);
            loadNextPage($container, category, perPage, msnry, function () {
                const updatedPage = parseInt($container.attr('data-current-page'));
                if (updatedPage >= maxPage) {
                    loadMorebtn.hide();
                } else {
                    loadMorebtn.prop('disabled', false);
                }
            });
        });
    }

    function loadNextPage($container, category, perPage, msnry, onComplete) {
        const nextPage = parseInt($container.attr('data-current-page')) + 1;

        const $wrapper = $container.closest('.alime-portfolio-area');
        const $loader  = $wrapper.find('.infinite-loader');
        $loader.show();

        $.ajax({
            url: window.location.origin + "/wp-admin/admin-ajax.php",
            type: "POST",
            data: {
                action:   "load_more_gallery",
                page:     nextPage,
                category: category,
                per_page: perPage
            },
            success: function (data) {
                const $newItems = $(data).css("opacity", 0);
                $container.append($newItems);

                imagesLoaded($newItems.get(), () => {
                    msnry.appended($newItems.get());
                    msnry.layout();
                    $newItems.css("opacity", 1);
                    $loader.hide();
                    $container.attr('data-current-page', nextPage);
                    if (onComplete) onComplete();
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
