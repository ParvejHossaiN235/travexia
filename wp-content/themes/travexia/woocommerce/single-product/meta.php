<?php

/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

global $product;

$tag = get_the_terms($product->get_id(), 'product_tag');
?>


<?php do_action('woocommerce_product_meta_start'); ?>

<?php if (wc_product_sku_enabled() && ($product->get_sku() || $product->is_type('variable'))) : ?>
    <div class="hexa-product-details-query-item d-flex align-items-center">
        <span><?php esc_html_e('SKU:', 'hexa-theme'); ?></span>
        <p><?php echo esc_html(($sku = $product->get_sku()), 'hexa-theme') ? $sku : esc_html__('N/A', 'hexa-theme'); ?></p>
    </div>
<?php endif; ?>
<div class="hexa-product-details-query-item d-flex align-items-center">
    <?php echo wc_get_product_category_list($product->get_id(), ', ', '<span>' . _n('Category: ', 'Categories: ', count($product->get_category_ids()), 'hexa-theme')  . '</span> '); ?>
</div>
<?php if (!empty($tag)) : ?>
    <div class="hexa-product-details-query-item d-flex align-items-center">
        <?php echo wc_get_product_tag_list($product->get_id(), ', ', '<span>' . _n('Tag:', 'Tags:', count($product->get_tag_ids()), 'hexa-theme') . '</span> '); ?>
    </div>
<?php endif; ?>

<?php do_action('woocommerce_product_meta_end'); ?>


<?php if (function_exists('hexa_product_social_share')) : ?>
    <?php echo hexa_product_social_share(); ?>
<?php endif; ?>