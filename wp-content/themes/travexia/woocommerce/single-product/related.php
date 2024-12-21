<?php

/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.9.0
 */

if (! defined('ABSPATH')) exit; // Exit if accessed directly

global $product;
$posts_per_page = 6;
$related = wc_get_related_products($product->get_id(), $posts_per_page);

if (sizeof($related) == 0) return;

$args = apply_filters('woocommerce_related_products_args', array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'no_found_rows' 		=> 1,
	'posts_per_page' 		=> $posts_per_page,
	'post__in' 				=> $related,
	'post__not_in'			=> array($product->get_id())
));
$show = 3;
$products = new WP_Query($args);

if ($products->have_posts()) : ?>

	<div class="widget related products">

		<h2 class="widget-title"><?php echo esc_html(get_theme_mod('related_heading_text', 'Related Products')) ?></h2>

		<div class="swiper-slider-wrapper">
			<div class="swiper-content-inner products carousel-view count-row-1">
				<div class="sw-product-carousel swiper-container">
					<div class="swiper-wrapper">
						<?php while ($products->have_posts()) : $products->the_post(); ?>
							<?php
							echo '<div class="swiper-slide">';
							wc_get_template_part('content', 'product');
							echo '</div>';
							?>
						<?php endwhile; // end of the loop. 
						?>
					</div>
				</div>
				<div class="swiper-nav-next"></div>
				<div class="swiper-nav-prev"></div>
			</div>
		</div>

	</div>

<?php endif;

wp_reset_postdata();
