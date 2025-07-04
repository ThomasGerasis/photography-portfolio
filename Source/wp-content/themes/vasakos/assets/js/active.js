import $ from "jquery";

import "magnific-popup";
import "owl.carousel";

(function ($) {
  "use strict";

  var alime_window = $(window);

  // ****************************
  // :: 1.0 Preloader Active Code
  // ****************************

  alime_window.on("load", function () {
    $("#preloader").fadeOut("1000", function () {
      $(this).remove();
    });
  });

  // ****************************
  // :: 2.0 ClassyNav Active Code
  // ****************************

  // if ($.fn.classyNav) {
  //   $("#alimeNav").classyNav();
  // }

  // *********************************
  // :: 3.0 Welcome Slides Active Code
  // *********************************

  let welcomeSlider = $(".welcome-slides");
  if (welcomeSlider.length) {
    welcomeSlider.owlCarousel({
      items: 1,
      loop: true,
      autoplay: true,
      smartSpeed: 1000,
      autoplayTimeout: 10000,
      nav: true,
      dots: false,
      navText: [
        '<i class="fas fa-arrow-left"></i>',
        '<i class="fas fa-arrow-right"></i>',
      ],
    });

    welcomeSlider.on("translate.owl.carousel", function () {
      var layer = $("[data-animation]");
      layer.each(function () {
        var anim_name = $(this).data("animation");
        $(this)
          .removeClass("animated " + anim_name)
          .css("opacity", "0");
      });
    });

    $("[data-delay]").each(function () {
      var anim_del = $(this).data("delay");
      $(this).css("animation-delay", anim_del);
    });

    $("[data-duration]").each(function () {
      var anim_dur = $(this).data("duration");
      $(this).css("animation-duration", anim_dur);
    });

    welcomeSlider.on("translated.owl.carousel", function () {
      var layer = welcomeSlider
        .find(".owl-item.active")
        .find("[data-animation]");
      layer.each(function () {
        var anim_name = $(this).data("animation");
        $(this)
          .addClass("animated " + anim_name)
          .css("opacity", "1");
      });
    });
  }

  // ************************************
  // :: 4.0 Instragram Slides Active Code
  // ************************************

  let instagramFeedSlider = $(".instragram-feed-area");
  if (instagramFeedSlider.length) {
    instagramFeedSlider.owlCarousel({
      items: 6,
      loop: true,
      autoplay: true,
      smartSpeed: 1000,
      autoplayTimeout: 3000,
      dots: false,
      responsive: {
        0: {
          items: 2,
        },
        576: {
          items: 3,
        },
        768: {
          items: 4,
        },
        992: {
          items: 5,
        },
        1200: {
          items: 6,
        },
      },
    });
  
  }

  let testimonials = $(".testimonials__area");
  if (testimonials.length) {
      testimonials.owlCarousel({
        items: 2,
        loop: true,
        margin: 20,
        autoplay: true,
        smartSpeed: 5000,
        autoplayTimeout: 7000,
        dots: false,
        responsive: {
          0: {
            items: 1,
          },
          576: {
            items: 1,
          },
          768: {
            items: 2,
          },
          992: {
            items: 2,
          },
          1200: {
            items: 2,
          },
        },
      });
    }

  // // *********************************
  // // :: 5.0 Masonary Gallery Active Code
  // // *********************************

  // if ($.fn.imagesLoaded) {
  //   $(".alime-portfolio").imagesLoaded(function () {
  //     // filter items on button click
  //     $(".portfolio-menu").on("click", "button", function () {
  //       var filterValue = $(this).attr("data-filter");
  //       $grid.isotope({
  //         filter: filterValue,
  //       });
  //     });
  //     // init Isotope
  //     var $grid = $(".alime-portfolio").isotope({
  //       itemSelector: ".single_gallery_item",
  //       percentPosition: true,
  //       masonry: {
  //         columnWidth: ".single_gallery_item",
  //       },
  //     });
  //   });
  // }

  // ***********************************
  // :: 6.0 Portfolio Button Active Code
  // ***********************************

  $(".portfolio-menu button.btn").on("click", function () {
    $(".portfolio-menu button.btn").removeClass("active");
    $(this).addClass("active");
  });

  // ************************
  // :: 8.0 Stick Active Code
  // ************************

  // alime_window.on("scroll", function () {
  //   if (alime_window.scrollTop() > 0) {
  //     $(".main-header-area").addClass("sticky");
  //   } else {
  //     $(".main-header-area").removeClass("sticky");
  //   }
  // });

  // *********************************
  // :: 9.0 Magnific Popup Active Code
  // *********************************
  if ($.fn.magnificPopup) {
    $(".video-play-btn").magnificPopup({
      type: "iframe",
    });
    $(".portfolio-img").magnificPopup({
      type: "image",
      gallery: {
        enabled: true,
        preload: [0, 2],
        navigateByImgClick: true,
        tPrev: "Previous",
        tNext: "Next",
      },
    });
  }

  // **************************
  // :: 10.0 Tooltip Active Code
  // **************************
  if ($.fn.tooltip) {
    $('[data-toggle="tooltip"]').tooltip();
  }

  // ***********************
  // :: 11.0 WOW Active Code
  // ***********************
  // if (alime_window.width() > 767) {
  //     new WOW().init();
  // }

  // *********************************
  // :: 14.0 Prevent Default 'a' Click
  // *********************************
  $('a[href="#"]').on("click", function ($) {
    $.preventDefault();
  });
})(jQuery);
