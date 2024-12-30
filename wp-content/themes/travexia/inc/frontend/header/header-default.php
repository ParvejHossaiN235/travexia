<?php

/**
 * The template for default header
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hexa
 */

$logo_space = has_nav_menu('main-menu') ? '' : 'pt-25 pb-25';

?>

<div class="hexa-desktop-header hexa-defaults-headers">
   <header class="tr-header-height">
      <!-- header-area-start -->
      <div id="header-sticky" class="tr-header-area tr-header-ptb">
         <div class="container container-1790">
            <div class="header-area d-flex align-items-center justify-content-between">
               <div class="tr-header-logo <?php echo esc_attr($logo_space); ?>">
                  <?php hexa_header_logo(); ?>
               </div>
               <div class="tr-header-menu tr-dropdown-menu text-end d-none d-xl-block">
                  <nav class="it-menu-content">
                     <?php hexa_header_menu(); ?>
                  </nav>
               </div>
               <div class="tr-header-bar d-xl-none ml-30">
                  <button class="tr-menu-bar">
                     <i class="fa-sharp fa-light fa-bars-staggered"></i>
                  </button>
               </div>
            </div>
         </div>
      </div>
      <!-- header-area-end -->

   </header>
</div>



<!-- it-offcanvus-area-start -->
<div class="it-offcanvas-area">
   <div class="it-offcanvas">
      <div class="it-offcanvas__close-btn">
         <button class="close-btn"><i class="fal fa-times"></i></button>
      </div>
      <div class="it-offcanvas__logo">
         <?php hexa_header_logo(); ?>
      </div>
      <div class="it-menu-mobile"></div>
   </div>
</div>
<div class="body-overlay"></div>
<!-- it-offcanvus-area-end -->