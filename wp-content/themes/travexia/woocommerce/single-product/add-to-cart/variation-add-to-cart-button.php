<?php

/**
 * Single variation cart button
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

global $product;
?>
<div class="woocommerce-variation-add-to-cart variations_button product__details-action">
	<?php do_action('woocommerce_before_add_to_cart_button'); ?>

	<div class="hexa-product-details-action-wrapper">
		<h3 class="hexa-product-details-action-title"><?php echo esc_html__('Quantity', 'hexa-theme'); ?></h3>
		<div class="hexa-product-details-action-item-wrapper d-flex align-items-center">
			<div class="hexa-product-details-quantity">
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

	<?php do_action('woocommerce_after_add_to_cart_button'); ?>

	<input type="hidden" name="add-to-cart" value="<?php echo absint($product->get_id()); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint($product->get_id()); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
</div>