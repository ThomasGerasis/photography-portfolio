jQuery(document).ready(function() {
    let r;
    function fireSliders() {
        jQuery(".aheto-banner-slider--snapster-modern").length &&
        jQuery(".aheto-banner-slider--snapster-modern").each(function () {
            let e = 0,
                n = 0;
            jQuery(this)
                .find(".aheto-banner-slider__bgimg > div:first-of-type span")
                .each(function () {
                    (e = jQuery(this).find("div").innerHeight() > e ? jQuery(this).find("div").innerHeight() : e), (n = jQuery(this).find("div").outerWidth() > n ? jQuery(this).find("div").outerWidth () : n);
                }),
                jQuery(this).find(".snapster-full-min-height-js").css("height", e);
        });
    }
    
    function labelsSlider(e, n) {
        e.find("label").removeClass("active"), n.addClass("active");
        let t = n.prev().data("count"),
            i = e.find(".aheto-banner-slider__bgimg div div:nth-child(" + t + ")").attr("style");
        e.find(".aheto-banner-slider__bgimg").attr("style", i),
            setTimeout(function () {
                e.find(".aheto-banner-slider__text").removeClass("active"),
                    e.find(".aheto-banner-slider__text:nth-child(" + t + ")").addClass("active"),
                    e.find(".aheto-banner-slider__bgimg div div").removeClass("active"),
                    e.find(".aheto-banner-slider__bgimg div div:nth-child(" + t + ")").addClass("active");
            }, 100);
    }
    
    function loopHandler() {
        jQuery(".aheto-banner-slider--snapster-modern").each(function () {
            let e,
                n = jQuery(this),
                t = jQuery(this).find(".aheto-banner-slider__container").data("loop"),
                i = jQuery(this).find(".aheto-banner-slider__container").data("autoplay"),
                a = jQuery(this).find(".aheto-banner-slider__container").data("autoplay-speed");
            n.find(".aheto-banner-slider__buttons-prev").on("click", function () {
                n.find("label.active").prev().prev().length ? (n.find(".aheto-banner-slider__buttons-next").removeClass("disabled"), n.find("label.active").prev().prev().click(), sliderButtons()) : 1 === t && n.find("label:last-of-type").click();
            }),
                n.find(".aheto-banner-slider__buttons-next").on("click", function () {
                    n.find("label.active").next().next().length ? (n.find(".aheto-banner-slider__buttons-prev").removeClass("disabled"), n.find("label.active").next().next().click(), sliderButtons()) : 1 === t && n.find("label:first-of-type").click();
                }),
                n.find("label").on("click", function () {
                    labelsSlider(n, jQuery(this));
                });
            var s = n.find("label:first-of-type");
            1 === i &&
            "" !== a &&
            0 !== a &&
            ((a *= 1e3),
                (r = setInterval(function () {
                    n.find("label.active").next().next().length ? (n.find(".aheto-banner-slider__buttons-prev").removeClass("disabled"), (e = n.find("label.active").next().next()), labelsSlider(n, e), sliderButtons()) : 1 === t ? labelsSlider(n, s) : clearInterval(r);
                }, a)));
        });
    }

    function sliderButtons() {
        jQuery(".aheto-banner-slider--snapster-modern").each(function () {
            let e = jQuery(this),
                n = jQuery(this).find(".aheto-banner-slider__container").data("loop");
            e.find("label:first-of-type").hasClass("active") && 0 === n && e.find(".aheto-banner-slider__buttons-prev").addClass("disabled"),
            e.find("label:last-of-type").hasClass("active") && 0 === n && e.find(".aheto-banner-slider__buttons-next").addClass("disabled");
        });
    }

    jQuery(window).on("load resize orientationchange", function () {
        setTimeout(fireSliders, 100);
    });

    jQuery(window).on("load", function () {
        clearInterval(r), loopHandler() , sliderButtons();
        setTimeout(fireSliders, 100), loopHandler() , sliderButtons();
    });

});