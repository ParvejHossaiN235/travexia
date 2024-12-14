<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header('shop');

$row_swipe = (!empty(get_theme_mod('shop_layout')) ? get_theme_mod('shop_layout') : 'left-sidebar');
$product_column = is_active_sidebar('shop-sidebar') ? 'col-xl-8 col-lg-8 col-md-12' : 'col-xl-12 col-lg-12 col-md-12';

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');

?>
<div class="row <?php echo $row_swipe; ?>">
   <?php if (is_active_sidebar('shop-sidebar')) : ?>
      <div class="col-xl-4 col-lg-4 col-md-4">
         <div class="hexa-shop-left-box">
            <?php dynamic_sidebar('shop-sidebar'); ?>
         </div>
      </div>
   <?php endif; ?>
   <div class="<?php echo $product_column; ?>">


      <?php
      if (woocommerce_product_loop()) {
      ?>

         <div class="hexa-shop-listing d-flex flex-wrap align-items-center mb-40 justify-content-between">
            <?php
            /**
             * Hook: woocommerce_before_shop_loop.
             *
             * @hooked woocommerce_output_all_notices - 10
             * @hooked woocommerce_result_count - 20
             * @hooked woocommerce_catalog_ordering - 30
             */
            do_action('woocommerce_before_shop_loop');
            ?>
            <div class="hexa-shop-listing-popup">
               <div class="hexa-shop-from">
                  <?php woocommerce_catalog_ordering(); ?>
               </div>
            </div>
         </div>

         <?php ?>

         <div class="hexa-shop-item-wrapper">
            <?php woocommerce_product_loop_start();
            if (wc_get_loop_prop('total')) {
               while (have_posts()) {
                  the_post(); ?>

            <?php

                  /**
                   * Hook: woocommerce_shop_loop.
                   */
                  do_action('woocommerce_shop_loop');

                  wc_get_template_part('content', 'product');
               }
            }

            woocommerce_product_loop_end();
            ?>

            <?php
            /**
             * Hook: woocommerce_after_shop_loop.
             *
             * @hooked woocommerce_pagination - 10
             */
            do_action('woocommerce_after_shop_loop');
            ?>
         </div>

      <?php
      } else {
         /**
          * Hook: woocommerce_no_products_found.
          *
          * @hooked wc_no_products_found - 10
          */
         do_action('woocommerce_no_products_found');
      }
      ?>
   </div>


   <?php
   /**
    * Hook: woocommerce_after_main_content.
    *
    * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
    */
   do_action('woocommerce_after_main_content');


   ?>
</div>
<?php
get_footer('shop');
