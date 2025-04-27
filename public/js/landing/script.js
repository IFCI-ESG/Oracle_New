(function ($) {
    "use strict";

    //1.Hide Loading Box (Preloader)
    function handlePreloader() {
        if ($('.preloader').length) {
            $('.preloader').delay(200).fadeOut(500);
        }
    }


    //Elements Animation
    if ($('.wow').length) {
        var wow = new WOW({
            boxClass: 'wow', // animated element css class (default is wow)
            animateClass: 'animated', // animation css class (default is animated)
            offset: 0, // distance to the element when triggering the animation (default is 0)
            mobile: false, // trigger animations on mobile devices (default is true)
            live: true // act on asynchronously loaded content (default is true)
        });
        wow.init();
    }

    // Hero Slider
    $('.main-slider').slick({
        slidesToShow: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        infinite: true,
        speed: 300,
        dots: true,
        arrows: false,
        fade: true,
        responsive: [{
            breakpoint: 600,
            settings: {
                arrows: false
            }
        }]
    });


    // FancyBox Video
    $('[data-fancybox]').fancybox({
        youtube: {
            controls: 0,
            showinfo: 0
        },
        vimeo: {
            color: 'f00'
        }
    });

    function datepicker() {
        if ($('#datepicker').length) {
            $('#datepicker').datepicker();
        };
    }

    /* ========================When document is loaded, do===================== */
    $(window).on('load', function () {
        // add your functions
        (function ($) {
            handlePreloader();
            datepicker();
        })(jQuery);
    });

    $('.navbar .dmenu').hover(function () {
        $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
    }, function () {
        $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
    });


})(window.jQuery);
