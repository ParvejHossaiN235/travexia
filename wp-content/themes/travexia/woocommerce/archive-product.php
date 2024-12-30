<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     8.6.0
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly
get_header();
?>

<section id="wp-main-content" class="clearfix main-page">
	<?php do_action('hexa_before_page_content'); ?>
	<div class="main-page-content">
		<div class="content-page">
			<div id="wp-content" class="wp-content clearfix">
				<div class="container shop-without-layout">
					<div class="row">
						<div class="col-12">
							<?php wc_get_template_part('archive', 'content'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php do_action('hexa_after_page_content'); ?>
</section>

<?php get_footer(); ?>