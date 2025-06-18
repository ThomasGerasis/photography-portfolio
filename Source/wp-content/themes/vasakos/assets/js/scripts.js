import "../css/core.scss";

import $ from "jquery";

import 'magnific-popup';

jQuery(document).ready(function() {

    jQuery('#loader').show();

    // jQuery('.select2-trigger').select2();
    /**** SCROLL TO TOP ****/
    let backToTop = document.getElementById("scrollUp");

    function fadeOut(el){
        el.style.opacity = 1;

        (function fade() {
            if ((el.style.opacity -= .1) < 0) {
                el.style.display = "none";
            } else {
                requestAnimationFrame(fade);
            }
        })();
    }

    function fadeIn(el, display){
        el.style.opacity = 0;
        el.style.display = display || "block";

        (function fade() {
            var val = parseFloat(el.style.opacity);
            if (!((val += .1) > 1)) {
                el.style.opacity = val;
                requestAnimationFrame(fade);
            }
        })();
    }

    jQuery(window).scroll(function() {
        if ($(this).scrollTop() > 150 ) {
            fadeIn(backToTop);
        } else {
            fadeOut(backToTop);
        }
    });

    backToTop.addEventListener("click", function() {
        window.scroll({top: 0, left: 0, behavior: 'smooth'});
    });


    jQuery('.image-popup-vertical-fit').magnificPopup({
        type: 'image',
        mainClass: 'mfp-with-zoom',
        gallery:{
            enabled:true
        },
        zoom: {
            enabled: true,
            duration: 300, // duration of the effect, in milliseconds
            easing: 'ease-in-out', // CSS transition easing function
            opener: function (openerElement) {
                return openerElement.is('img') ? openerElement : openerElement.find('img');
            }
        }
    });


    $(".collapse")
        .on("show.bs.collapse", function () {
            $(this)
                .prev(".title")
                .find(".fas")
                .removeClass("fa-chevron-down")
                .addClass("fa-chevron-up");
        })
        .on("hide.bs.collapse", function () {
            $(this)
                .prev(".title")
                .find(".fas")
                .removeClass("fa-chevron-up")
                .addClass("fa-chevron-down");
        });

    $('.counter').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            duration: 4000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });


    let readMoreButtons = document.querySelectorAll('.read-more-btn');
    readMoreButtons.forEach((button) => {
        button.addEventListener('click', () => {
           let readMoreTextDiv = button.dataset.target;
            let readMoreText = button.textContent;
            if (readMoreText === "Read More") {
                //Stuff to do when btn is in the read more state
                button.textContent = "Read Less";
                $('#'+readMoreTextDiv).slideDown('slow');
            } else {
                //Stuff to do when btn is in the read less state
                button.textContent = "Read More";
                $('#'+readMoreTextDiv).slideUp();
            }
        });
    });

    // const swiper = new Swiper('.swiper', {
    //     // Optional parameters
    //     direction: 'horizontal',
    //     loop: true,
    //
    //     // If we need pagination
    //     pagination: {
    //         el: '.swiper-pagination',
    //     },
    //
    //     // Navigation arrows
    //     navigation: {
    //         nextEl: '.swiper-button-next',
    //         prevEl: '.swiper-button-prev',
    //     },
    //
    //     // And if we need scrollbar
    //     scrollbar: {
    //         el: '.swiper-scrollbar',
    //     },
    // });

});



function emailIsValid(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
}

let contactForm = document.querySelector("#contactForm");

if (contactForm) {

    contactForm.addEventListener("submit", function (e) {
        e.preventDefault();
        let ajax = {"ajax_url": window.location.origin + "/wp-admin/admin-ajax.php"};
        let formEl = document.forms.contactForm;
        let formData = new FormData(formEl);
        let name = formData.get('name');
        let message = formData.get('message');
        let email = formData.get('email');
        let captchaResponse = formData.get('g-recaptcha-response');
        let loader = document.querySelector(".loader");
        loader.style.display = 'block';

        let formErrors = document.getElementById('form-message-success');
        if (captchaResponse === '' || captchaResponse === 0){
            loader.style.display = 'none';
            formErrors.classList.add('text-danger');
            formErrors.classList.remove('text-success');
            formErrors.innerHTML ='Please verify your are a human!';
            return;
        }

        if (emailIsValid(email) === true ) {
            $.ajax({
                type: 'POST',
                url: ajax.ajax_url,
                data: {
                    action: "send_email",
                    name: name,
                    userEmail: email,
                    message: message,
                },
                dataType: 'html',
                success: function (data) {
                    loader.style.display = 'none';
                    formErrors.classList.add('text-success');
                    formErrors.classList.remove('text-danger');
                    formErrors.innerHTML = data;
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                },
                complete: function () {
                }

            });
        } else {
            loader.style.display = 'none';
            formErrors.classList.add('text-danger');
            formErrors.classList.remove('text-success');
            formErrors.innerHTML ='Please fill in a valid email !';
        }
    });
}


jQuery(function() {

    let siteMenuClone = function() {
        const wrapper = $('body');
        $('.js-clone-nav').each(function() {
            let $this = $(this);
            $this.clone().attr('class', 'site-nav-wrap').appendTo('.site-mobile-menu-body');
        });

        setTimeout(function() {

            let counter = 0;
            $('.site-mobile-menu .has-children').each(function(){
                var $this = $(this);

                $this.prepend('<span class="arrow-collapse collapsed">');

                $this.find('.arrow-collapse').attr({
                    'data-toggle' : 'collapse',
                    'data-target' : '#collapseItem' + counter,
                });

                $this.find('> ul').attr({
                    'class' : 'collapse',
                    'id' : 'collapseItem' + counter,
                });
                counter++;
            });
        }, 1000);

        wrapper.on('click', '.arrow-collapse', function(e) {
            var $this = $(this);
            if ( $this.closest('li').find('.collapse').hasClass('show') ) {
                $this.removeClass('active');
            } else {
                $this.addClass('active');
            }
            e.preventDefault();

        });

        $(window).resize(function() {
            let $this = $(this),
                w = $this.width();

            if ( w > 768 ) {
                if (wrapper.hasClass('offcanvas-menu') ) {
                    wrapper.removeClass('offcanvas-menu');
                }
            }
        })

        wrapper.on('click', '.js-menu-toggle', function(e) {
            let $this = $(this);
            e.preventDefault();

            if ( wrapper.hasClass('offcanvas-menu') ) {
                wrapper.removeClass('offcanvas-menu');
                $this.removeClass('active');
            } else {
                wrapper.addClass('offcanvas-menu');
                $this.addClass('active');
            }
        })

        // click outisde offcanvas
        $(document).mouseup(function(e) {
            let container = $(".site-mobile-menu");
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                if ( wrapper.hasClass('offcanvas-menu') ) {
                    wrapper.removeClass('offcanvas-menu');
                }
            }
        });
    };
    siteMenuClone();

});