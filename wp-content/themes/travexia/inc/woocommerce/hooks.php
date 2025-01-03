<?php
add_filter('woocommerce_enqueue_styles', '__return_false');
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
add_action('woocommerce_after_single_product_summary', 'travexia_woocommerce_output_product_data', 10);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
add_filter('loop_shop_per_page', 'travexia_woocommerce_shop_pre_page', 20);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action('woocommerce_before_shop_loop_item_title',  'travexia_swap_images', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
add_action('woocommerce_before_shop_loop_item_title', 'travexia_woocommerce_custom_sales_price', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);



add_theme_support('wc-product-gallery-lightbox');
add_theme_support('wc-product-gallery-slider');

function travexia_woocommerce_custom_sales_price()
{
	global $product;
	if ($product->get_sale_price()) {
		$percentage = round((($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price()) * 100);
		echo ('<span class="onsale">-' . $percentage . '%</span>');
	}
}

function travexia_woocommerce_shop_pre_page()
{
	return get_theme_mod('products_per_page', 9);
}

function travexia_woocommerce_output_product_data_accordions()
{
	wc_get_template('single-product/tabs/accordions.php');
}

function travexia_woocommerce_output_product_data()
{
	global $post;
	$tab_style = get_post_meta($post->ID, 'travexia_product_tab_style', true);
	$tab_style = 'tabs';
	if ($tab_style == 'accordion') {
		travexia_woocommerce_output_product_data_accordions();
	} else {
		woocommerce_output_product_data_tabs();
	}
}

function travexia_swap_images()
{
	global $post, $product, $woocommerce;
	$image_size = wc_get_image_size('woocommerce_thumbnail');
	$_width = isset($image_size['width']) ? $image_size['width'] : 'auto';
	$_height = isset($image_size['height']) ? $image_size['height'] : 'auto';
	$output = '';
	$class = 'image';
	$output .= '<a class="link-overlay" href="' . get_the_permalink() . '"></a>';
	if (has_post_thumbnail()) {
		$output .= '<span class="attachment-shop_catalog">' . get_the_post_thumbnail($post->ID, 'shop_catalog', array('class' => '')) . '</span>';
	} else {
		$output .= '<img src="' . wc_placeholder_img_src() . '" alt="' . $post->title . '" class="' . $class . '" width="' . $_width . '" height="' . $_height . '" />';
	}
	echo trim($output);
}

function travexia_woo_widgets_init()
{
	if (class_exists('WooCommerce')) {
		register_sidebar(array(
			'name' 		     => esc_html__('WooCommerce Shop Sidebar', 'travexia'),
			'id' 		     => 'woocommerce_sidebar',
			'description'    => esc_html__('Appears in the Plugin WooCommerce section of the site.', 'travexia'),
			'before_widget'  => '<aside id="%1$s" class="widget sidebar-widget mb-40 clearfix %2$s">',
			'after_widget'	 => '</aside>',
			'before_title' 	 => '<h3 class="widget-title sidebar-widget-title mb-30"><span>',
			'after_title'    => '</span></h3>',
		));
	}
}
add_action('widgets_init', 'travexia_woo_widgets_init');
