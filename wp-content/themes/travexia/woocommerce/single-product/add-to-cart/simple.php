<?php

/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

global $product;

if (!$product->is_purchasable()) {
	return;
}

if ($product->is_in_stock()) : ?>

	<?php do_action('woocommerce_before_add_to_cart_form'); ?>

	<div class="hexa-product-details-action-wrapper">
		<h3 class="hexa-product-details-action-title"><?php echo esc_html__('Quantity', 'hexa-theme') ?></h3>
		<form class="cart" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data'>
			<div class="hexa-product-details-action-item-wrapper d-flex align-items-center">
				<div class="hexa-product-details-quantity">
					<?php do_action('woocommerce_before_add_to_cart_button'); ?>
					<div class="hexa-product-quantity mb-15 mr-15">
						<?php
						do_action('woocommerce_before_add_to_cart_quantity');

						woocommerce_quantity_input(
							array(
								'min_value'   => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
								'max_value'   => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
								'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
							)
						);

						do_action('woocommerce_after_add_to_cart_quantity');
						?>
					</div>
				</div>
				<div class="hexa-product-details-add-to-cart mb-15 w-100">
					<button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" class="single_add_to_cart_button light-blue-btn product-add-cart-btn product-add-cart-btn-3 <?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"><?php echo esc_html__('Add To Cart', 'hexa-theme') ?></button>
				</div>
			</div>

			<?php do_action('woocommerce_after_add_to_cart_button'); ?>
		</form>
	</div>

	<div class="hexa-product-details-action-sm d-flex align-items-center">
		<div class="hexa-product-details-action-sm-btn hexa-product-details-action-compare mr-15 mb-15">
			<?php if (function_exists('woosc_init')) : ?>
				<?php echo do_shortcode('[woosc]'); ?>
			<?php endif; ?>
		</div>

		<div class="hexa-product-details-action-sm-btn hexa-product-details-action-wishlist mr-15 mb-15">
			<?php if (function_exists('woosw_init')) : ?>
				<?php echo do_shortcode('[woosw]'); ?>
			<?php endif; ?>
		</div>
	</div>

	<?php do_action('woocommerce_after_add_to_cart_form'); ?>

<?php endif; ?>