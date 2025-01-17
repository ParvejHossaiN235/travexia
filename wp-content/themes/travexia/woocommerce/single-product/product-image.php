<?php

/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.9.9
 */

defined('ABSPATH') || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if (!function_exists('wc_get_gallery_image_html')) {
	return;
}

global $product;

$columns           	= apply_filters('woocommerce_product_thumbnails_columns', 4);
$post_thumbnail_id 	= $product->get_image_id();
$attachment_ids 	= $product->get_gallery_image_ids();
$wrapper_classes   	= apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ($post_thumbnail_id ? 'with-images' : 'without-images'),
		'woocommerce-product-gallery--columns-' . absint($columns),
		'hexa-product-gallery-' . ($attachment_ids ? 'with-thumbnails' : 'without-thumbnails'),
		'images',
	)
);

$gallery_classes 	= array('single-product-images-wrapper');

if ($attachment_ids) {
	$gallery_classes[] 	= 'single-product-gallery';
}

$single_product_gallery_classes		= apply_filters('single_product_gallery_classes', $gallery_classes);
$single_product_thum_classes	= apply_filters('single_product_thum_classes', array('single-product-thumb'));
?>
<div class="<?php echo esc_attr(implode(' ', array_map('sanitize_html_class', $wrapper_classes))); ?>" data-columns="<?php echo esc_attr($columns); ?>">
	<div class="woocommerce-product-gallery__wrapper">
		<div class="<?php echo esc_attr(implode(' ', array_map('sanitize_html_class', $single_product_gallery_classes))); ?>">
			<div class="swiper-container wc-gallery-carousel p-relative">
				<div class="swiper-wrapper">
					<?php
					if ($post_thumbnail_id) {
						array_unshift($attachment_ids, $post_thumbnail_id);
						$html = travexia_wc_get_gallery_html($attachment_ids, true);
					} else {
						$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
						$html .= sprintf('<img src="%s" alt="%s" class="wp-post-image" />', esc_url(wc_placeholder_img_src('woocommerce_single')), esc_html__('Awaiting product image', 'travexia'));
						$html .= '</div>';
					}
					echo apply_filters('woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
					?>
				</div>
			</div>
		</div>
	</div>
	<?php if ($attachment_ids && count($attachment_ids) > 1) { ?>
		<div class="<?php echo esc_attr(implode(' ', array_map('sanitize_html_class', $single_product_thum_classes))); ?>">
			<div class="wc-gallery-thumb mt-25 text-center">
				<div class="swiper-container wc-gallery-nav">
					<div class="swiper-wrapper">
						<?php do_action('woocommerce_product_thumbnails'); ?>
					</div>
					<div class="wc-gallery-btn">
						<div class="wc-gallery-btn-prev"></div>
						<div class="wc-gallery-btn-next"></div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
</div>