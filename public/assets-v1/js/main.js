
// menu js

(function($) { "use strict";

	$(function() {
		var header = $(".start-style");
		$(window).scroll(function() {    
			var scroll = $(window).scrollTop();
		
			if (scroll >= 10) {
				header.removeClass('start-style').addClass("scroll-on");
			} else {
				header.removeClass("scroll-on").addClass('start-style');
			}
		});
	});		
		
	//Animation
	
	$(document).ready(function() {
		$('body.hero-anime').removeClass('hero-anime');
	});

	//Menu On Hover
		
	$('body').on('mouseenter mouseleave','.nav-item',function(e){
			if ($(window).width() > 750) {
				var _d=$(e.target).closest('.nav-item');_d.addClass('show');
				setTimeout(function(){
				_d[_d.is(':hover')?'addClass':'removeClass']('show');
				},1);
			}
	});	
	
	//Switch light/dark
	
	$("#switch").on('click', function () {
		if ($("body").hasClass("dark")) {
			$("body").removeClass("dark");
			$("#switch").removeClass("switched");
		}
		else {
			$("body").addClass("dark");
			$("#switch").addClass("switched");
		}
	});  
	
  })(jQuery); 

//   menu js end




// hero slider js
window.onload=function(){
    $('.slider').slick({
    autoplay:true,
    autoplaySpeed:11000,
    arrows:true,
    prevArrow:'<button type="button" class="slick-prev"></button>',
    nextArrow:'<button type="button" class="slick-next"></button>',
    centerMode:true,
    slidesToShow:1,
    slidesToScroll:1
    });
  };
// hero slider js end



// testimonials js
$('.testi.owl-carousel').owlCarousel({
    items: 2,
    margin:10,
    lazyLoad: true,
    dots:true,
    autoPlay: true,
    autoPlayTimeout: 3000,
    responsive:{
      0:{
        items:1,
      },
      600:{
        items:2,
      },
      1000:{
        items:2,
      }
    }
  });
// testimonials js end