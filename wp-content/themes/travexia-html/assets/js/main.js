(function ($) {
	"use strict";

	var windowOn = $(window)
	///////////////////////////////////////////////////
	// 01. PreLoader Js
	windowOn.on('load',function () {
		$('#loading').fadeOut(500);
	});

    ///////////////////////////////////////////////////
	// 03. scroll-to-target 
	windowOn.on('scroll', function () {
		var scroll = windowOn.scrollTop();
		if (scroll < 500) {
			$('.scroll-to-target').removeClass('open');

		} else {
			$('.scroll-to-target').addClass('open');
		}
	});
	
	///////////////////////////////////////////////////
	// 04. Scroll Up Js
	if ($('.scroll-to-target').length) {
		$(".scroll-to-target").on('click', function () {
		var target = $(this).attr('data-target');
		// animate
		$('html, body').animate({
			scrollTop: $(target).offset().top
		}, 1000);
	
		});
	}
	
    ///////////////////////////////////////////////////
	// 05. wow animation
	var wow = new WOW(
		{
		  mobile: true,
		}
	  );
	  wow.init();
	var windowOn = $(window);

	///////////////////////////////////////////////////
	// 06. PreLoader Js
	windowOn.on('load',function() {
		$("#loading").fadeOut(500);

	});

		///////////////////////////////////////////////////
	// 07. Sticky Header Js
	windowOn.on('scroll', function () {
		var scroll = windowOn.scrollTop();
		if (scroll < 400) {
			$("#header-sticky").removeClass("header-sticky");
		} else {
			$("#header-sticky").addClass("header-sticky");
		}
	});

	$(window).on('load', function () {

		$('#preloader').delay(350).fadeOut('slow');

		$('body').delay(350).css({ 'overflow': 'visible' });

	})


	if ($('.tr-header-height').length > 0) {
		var headerHeight = document.querySelector(".tr-header-height");
		var setHeaderHeight = headerHeight.offsetHeight;
		$(".tr-header-height").each(function () {
			$(this).css({
				'height': setHeaderHeight + 'px'
			});
		});

		$(".tr-header-height.header-sticky").each(function () {
			$(this).css({
				'height': inherit,
			});
		});
	}

	// 09. Sidebar Js
	$(".tr-menu-bar").on("click", function () {
		$(".it-offcanvas").addClass("opened");
		$(".body-overlay").addClass("apply");
	});
	$(".close-btn").on("click", function () {
		$(".it-offcanvas").removeClass("opened");
		$(".body-overlay").removeClass("apply");
	});
	$(".body-overlay").on("click", function () {
		$(".it-offcanvas").removeClass("opened");
		$(".body-overlay").removeClass("apply");
	});

	////////////////////////////////////////////////////
	// 13. Swiper Js
	const tripswiper = new Swiper('.tr-trip-active', {
		// Optional parameters
		speed:1500,
		loop: true,
		slidesPerView: 4,
        spaceBetween: 30,
		autoplay: false,
		roundLengths: true,
		breakpoints: {
			'1400': {
				slidesPerView: 4,
			},
			'1200': {
				slidesPerView: 3,
			},
			'992': {
				slidesPerView: 2,
			},
			'768': {
				slidesPerView: 2,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
		navigation: {
			prevEl: '.slider-prev',
			nextEl: '.slider-next',
		},
		
	  });

	////////////////////////////////////////////////////
	// 13. Swiper Js
	const testimonialswiper = new Swiper('.tr-testimonial-2-active', {
		// Optional parameters
		speed:1500,
		loop: true,
		slidesPerView: 5,
        spaceBetween: 30,
		autoplay: false,
		centeredSlides: true,
		roundLengths: true,
		breakpoints: {
			'1800': {
				slidesPerView: 5,
			},
			'1600': {
				slidesPerView: 4,
			},
			'1400': {
				slidesPerView: 4,
			},
			'1200': {
				slidesPerView: 3,
			},
			'992': {
				slidesPerView: 3,
			},
			'768': {
				slidesPerView: 2,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
		pagination: {
			el: ".tr-slider-dots",
			clickable:true,
		  },
		
	  });

	// 18. Swiper Js
	const postBoxswiper = new Swiper('.postbox-thumb-slider-active', {
	// Optional parameters
		speed:1000,
		loop: true,
		slidesPerView: 1,
        spaceBetween: 0,
		autoplay: true,
		effect:'fade',
		breakpoints: {
			'1400': {
				slidesPerView: 1,
			},
			'1200': {
				slidesPerView: 1,
			},
			'992': {
				slidesPerView: 1,
			},
			'768': {
				slidesPerView: 1,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
		navigation: {
			prevEl: '.postbox-arrow-prev',
			nextEl: '.postbox-arrow-next',
		},
		
	  });

	////////////////////////////////////////////////////
	// 13. Swiper Js
	const brandswiper = new Swiper('.tr-brand-active', {
		// Optional parameters
		speed:1000,
		loop: true,
		slidesPerView: 5,
        spaceBetween: 30,
		autoplay: true,
		roundLengths: true,
		breakpoints: {
			'1400': {
				slidesPerView: 5,
			},
			'1200': {
				slidesPerView: 4,
			},
			'992': {
				slidesPerView: 3,
			},
			'768': {
				slidesPerView: 3,
			},
			'576': {
				slidesPerView: 2,
			},
			'0': {
				slidesPerView: 1,
			},
		},
		
	  });

	////////////////////////////////////////////////////
	// 13. Swiper Js
	var tr_text_slider = new Swiper(".tr-text-slider-active", {
		loop: true,
		freemode: true,
		slidesPerView: 'auto',
		spaceBetween: 40,
		centeredSlides: true,
		allowTouchMove: false,
		speed: 4000,
		autoplay: {
		  delay: 1,
		  disableOnInteraction: true,
		},
	  });


	////////////////////////////////////////////////////
	// 13. slick Js
	$('.tr-slider-for').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		fade: false,
		asNavFor: '.tr-slider-nav'
	});

	$('.tr-slider-nav').slick({
		slidesToShow: 3,
		slidesToScroll: 1,
		arrows: false,
		vertical:true,
		asNavFor: '.tr-slider-for',
		dots: false,
		focusOnSelect: true,
		verticalSwiping:true,
		centerPadding: '0',
		centerMode: true,
		responsive: [
			{
				breakpoint: 992,
				settings: {
				vertical: false,
				slidesToShow: 2,
				}
			},
			{
			breakpoint: 768,
			settings: {
				vertical: false,
				slidesToShow: 1,
			}
			},
			{
			breakpoint: 580,
			settings: {
				vertical: false,
				slidesToShow: 1,
			}
			},
			{
			breakpoint: 380,
			settings: {
				vertical: false,
				slidesToShow: 1,
			}
			}
		]
	});


	// 09. Home-1-Slider js
	$('.tr-hero-3-active-1').slick({
		speed: 8000,
		autoplay: true,
		autoplaySpeed: 0,
		cssEase: 'linear',
		slidesPerRow: 1,
		slidesToShow: 2,
		arrows: false,
		buttons: false,
		vertical: true,
		verticalSwiping: true,
		responsive: [
			{
				breakpoint: 1200,
				settings: {
				}
			},
			{
				breakpoint: 992,
				settings: {
				}
			},
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 1,
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
				}
			}
		]
	});

	// 09. Home-1-Slider js
	$('.tr-hero-3-active-2').slick({
		speed: 8000,
		autoplay: true,
		autoplaySpeed: 0,
		cssEase: 'linear',
		slidesPerRow: 1,
		slidesToShow: 2,
		arrows: false,
		buttons: false,
		vertical: true,
		verticalSwiping: true,
		responsive: [
			{
				breakpoint: 1200,
				settings: {
				}
			},
			{
				breakpoint: 992,
				settings: {
				}
			},
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 1,
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
				}
			}
		]
	});


	if($('.it-menu-content').length && $('.it-menu-mobile').length){
		let navContent = document.querySelector(".it-menu-content").outerHTML;
		let mobileNavContainer = document.querySelector(".it-menu-mobile");
		mobileNavContainer.innerHTML = navContent;
	
		let arrow = $(".it-menu-mobile .has-dropdown > a");
	
		arrow.each(function () {
			let self = $(this);
			let arrowBtn = document.createElement("BUTTON");
			arrowBtn.classList.add("dropdown-toggle-btn");
			arrowBtn.innerHTML = "<i class='fal fa-angle-right'></i>";
			self.append(function () {
			  return arrowBtn;
			});
	
			self.find("button").on("click", function (e) {
			  e.preventDefault();
			  let self = $(this);
			  self.toggleClass("dropdown-opened");
			  self.parent().toggleClass("expanded");
			  self.parent().parent().addClass("dropdown-opened").siblings().removeClass("dropdown-opened");
			  self.parent().parent().children(".it-submenu").slideToggle();
			});
	
		});
	}

	///////////////////////////////////////////////////
	// 10. Magnific Js
	$(".popup-video").magnificPopup({
		type: "iframe",
	});
	
	////////////////////////////////////////////////////
	// 14. magnificPopup Js
	$('.popup-image').magnificPopup({
		type: 'image',
		gallery: {
			enabled: true
		}
	});


	////////////////////////////////////////////////////
	// 11. Data CSS Js
	$("[data-background").each(function () {
		$(this).css("background-image", "url( " + $(this).attr("data-background") + "  )");
	});

	$("[data-width]").each(function () {
		$(this).css("width", $(this).attr("data-width"));
	});

	$("[data-bg-color]").each(function () {
		$(this).css("background-color", $(this).attr("data-bg-color"));
	});

	////////////////////////////////////////////////////
	// 12. Counter Js
	if ($(".purecounter").length) {
		new PureCounter({
			filesizing: true,
			selector: ".filesizecount",
			pulse: 2,
		});
		new PureCounter();
	}

    // 08. Nice Select Js
	$('select').niceSelect();

	////////////////////////////////////////////////////
	// 14. magnificPopup Js
	$('.popup-image').magnificPopup({
		type: 'image',
		gallery: {
			enabled: true
		}
	});


	////////////////////////////////////////////////////
	// 15. MagnificPopup video view Js
	$(".popup-video").magnificPopup({
	   type: "iframe",
    });


	////////////////////////////////////////////////////
	//26.isotope
	$('.grid').imagesLoaded(function () {
		// init Isotope
		var $grid = $('.grid').isotope({
			itemSelector: '.grid-item',
			percentPosition: true,
			masonry: {
				columnWidth: '.grid-item',
			},
			
		});
		// filter items on button click
		$('.masonary-menu').on('click', 'button', function () {
			var filterValue = $(this).attr('data-filter');
			$grid.isotope({ 
				filter: filterValue,
				animationOptions: {
					duration: 100,
					easing: "linear",
					queue: true
				}
			});
			
		});
		
		//for menu active class
		$('.masonary-menu button').on('click', function (event) {
			$(this).siblings('.active').removeClass('active');
			$(this).addClass('active');
			event.preventDefault();
		});

	});	


	// Date Range Picker
	$(function () {
		$('input[name="daterange"]').daterangepicker(
			{
			opens: 'center',
			},
			function (start, end, label) {
			console.log(
				'A new date selection was made: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD')
			)
			}
		)
	})


})(jQuery);