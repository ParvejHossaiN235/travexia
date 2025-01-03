(function ($) {
  "use strict";

  /* --------------------------------------------------
   * sticky header
   * --------------------------------------------------*/

  $(".wp-menu nav > ul > li").slice(-4).addClass("menu-last");

  /* --------------------------------------------------
   * side panel
   * --------------------------------------------------*/
  var sidePanel = function () {
    var element = $(".panel-toggle-btn"),
      sidebar = $(".side-panel"),
      sideOverlay = $(".body-nl-overlay");

    function panel_handler() {
      var isActive = !element.hasClass("active");

      element.toggleClass("active", isActive);
      sidebar.toggleClass("panel-open", isActive);
      sideOverlay.toggleClass("open", isActive);
      $("body").toggleClass("side-panel-active", isActive);
      return false;
    }

    $(".panel-toggle-btn, .panel-close-btn, .body-nl-overlay").on("click", panel_handler);
  };

  /* --------------------------------------------------
   * toggle search
   * --------------------------------------------------*/

  /* --------------------------------------------------
   * mobile menu
   * --------------------------------------------------*/
  var mmenuPanel = function () {
    var element = $(".mmenu-toggle-btn"),
      mmenu = $(".mmenu-panel"),
      menuOverlay = $(".body-el-overlay");

    function mmenu_handler() {
      var isActive = !element.hasClass("active");
      element.toggleClass("active", isActive);
      mmenu.toggleClass("panel-open", isActive);
      menuOverlay.toggleClass("open", isActive);
      $("body").toggleClass("mmenu-active", isActive);
      return false;
    }

    $(".mmenu-toggle-btn, .mmenu-close-btn, .body-el-overlay").on("click", mmenu_handler);

    $(".mmenu-panel .mobile-menu ul li:has(ul)").prepend('<span class="arrow"><i class="hicon-plus"></i></span>');
    $(".mmenu-panel .mobile-menu ul > li span.arrow").on("click", function () {
      $(this).parent().find("> ul").stop(true, true).slideToggle();
      $(this).toggleClass("active");
    });
  };

  /* --------------------------------------------------
   * gallery post active
   * --------------------------------------------------*/
  if ($(".postbox-slider-active").length > 0) {
    var postSlider = new Swiper(".postbox-slider-active", {
      slidesPerView: 1,
      spaceBetween: 30,
      loop: true,
      // Navigation arrows
      navigation: {
        nextEl: ".postbox-slider-button-next",
        prevEl: ".postbox-slider-button-prev",
      },
    });
  }

  // product single slider
  if (jQuery(".sw-product-carousel").length > 0) {
    let relatedProducts = new Swiper(".sw-product-carousel", {
      slidesPerView: 1,
      spaceBetween: 30,
      loop: true,
      autoplay: {
        delay: 5000,
      },
      // If we need navigation
      navigation: {
        nextEl: ".swiper-nav-next",
        prevEl: ".swiper-nav-prev",
      },
      breakpoints: {
        550: {
          slidesPerView: 2,
        },
        768: {
          slidesPerView: 3,
        },
        1200: {
          slidesPerView: 3,
        },
      },
    });
  }

  var productDetails = new Swiper(".wc-gallery-nav", {
    slidesPerView: "auto",
    spaceBetween: 10,
    navigation: {
      nextEl: ".wc-gallery-btn-next",
      prevEl: ".wc-gallery-btn-prev",
    },
    breakpoints: {
      0: {
        slidesPerView: 2,
      },
      390: {
        slidesPerView: 2,
      },
      640: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 4,
      },
      1024: {
        slidesPerView: 4,
      },
      1400: {
        slidesPerView: 4,
      },
    },
  });
  var productDetailsActive = new Swiper(".wc-gallery-carousel", {
    spaceBetween: 0,
    thumbs: {
      swiper: productDetails,
    },
    navigation: {
      nextEl: ".wc-gallery-btn-next",
      prevEl: ".wc-gallery-btn-prev",
    },
  });

  /**
   * Elementor JS Hooks
   */
  $(window).on("elementor/frontend/init", function () {
    /*mmenu*/
    elementorFrontend.hooks.addAction("frontend/element_ready/hf-menu-mobile.default", mmenuPanel);
    /*sidepanel*/
    elementorFrontend.hooks.addAction("frontend/element_ready/hf-side-panel.default", sidePanel);
    /*cart*/
    //elementorFrontend.hooks.addAction("frontend/element_ready/icart.default", hCart);
  });
})(jQuery);
