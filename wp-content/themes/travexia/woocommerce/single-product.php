<?php

/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if (! defined('ABSPATH')) exit; // Exit if accessed directly

get_header();

$related_product_show = get_theme_mod('related_product_show', true);

?>

<section id="wp-main-content" class="clearfix main-page product-single-page">

	<?php do_action('woocommerce_before_main_content'); ?>

	<?php while (have_posts()) : ?>
		<?php the_post(); ?>
		<?php wc_get_template_part('content', 'single-product'); ?>
	<?php endwhile; ?>

	<?php if (!empty($related_product_show)) {
		do_action('woocommerce_after_main_content');
	?>
		<div class="related-section">
			<div class="container">
				<?php woocommerce_output_related_products(); ?>
			</div>
		</div>
	<?php } ?>

</section>

<?php get_footer(); ?>