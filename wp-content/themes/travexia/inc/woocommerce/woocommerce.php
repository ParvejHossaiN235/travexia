<?php

/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package hexa
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function hexa_woocommerce_setup()
{
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-slider');
    add_theme_support('wc-product-gallery-lightbox');
    // Remove woocommerce defauly styles
    add_filter('woocommerce_enqueue_styles', '__return_false');
}
add_action('after_setup_theme', 'hexa_woocommerce_setup');

/**
 * Register widget area for shop page.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hexa_woocommerce_widgets_init()
{
    register_sidebar(array(
        'name'          => __('Shop Sidebar', 'hexa-theme'),
        'id'            => 'shop-sidebar',
        'before_widget' => '<div id="%1$s" class="product-widget %2$s mb-45">',
        'after_widget' => '</div>',
        'before_title'  => '<h4 class="product-widget-title mb-30">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'hexa_woocommerce_widgets_init');

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function hexa_woocommerce_active_body_class($classes)
{
    $classes[] = 'woocommerce-active';

    return $classes;
}
add_filter('body_class', 'hexa_woocommerce_active_body_class');


// shop page hooks
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
//remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

//single hook remove
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);


// compare_false
add_filter('woosc_button_position_archive', '__return_false');
add_filter('woosc_button_position_single', '__return_false');

// wishlist false
add_filter('woosw_button_position_archive', '__return_false');
add_filter('woosw_button_position_single', '__return_false');

/**
 * Remove the breadcrumbs 
 */
add_action('init', 'hexa_wc_breadcrumbs');
function hexa_wc_breadcrumbs()
{
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
    add_action('hexa_woocommerce_breadcrumb', 'woocommerce_breadcrumb');
}

/**
 * Change several of the breadcrumb defaults
 */
add_filter('woocommerce_breadcrumb_defaults', 'hexa_woocommerce_breadcrumbs');
function hexa_woocommerce_breadcrumbs()
{
    return array(
        'delimiter'   => '',
        'wrap_before' => '<ul id="breadcrumbs" class="breadcrumbs none-style" itemprop="breadcrumb">',
        'wrap_after'  => '</ul>',
        'before'      => '<li>',
        'after'       => '</li>',
        'home'        => _x('Home', 'breadcrumb', 'hexa-theme'),
    );
}


// product-content single
if (!function_exists('hexa_content_single_details')) {
    function hexa_content_single_details()
    {
        global $product;
        global $post;
        global $woocommerce;
        $rating = wc_get_rating_html($product->get_average_rating());
        $ratingcount = $product->get_review_count();
        $regularPrice = $product->get_regular_price();

        $attachment_ids = $product->get_gallery_image_ids();

        foreach ($attachment_ids as $attachment_id) {
            $image_link = wp_get_attachment_url($attachment_id);
        }

        $categories = get_the_terms($post->ID, 'product_cat');
        $stock = $product->is_in_stock();
        $stock_quantify = $product->get_stock_quantity();

?>

        <div class="product-details-wrapper">

            <!-- inventory details -->
            <div class="product-details-inventory d-flex align-items-center mb-10">

                <?php if ($stock) : ?>
                    <div class="product-details-stock mb-10">
                        <span class="in-stock"><?php echo esc_html__('In Stock', 'hexa-theme'); ?></span>
                    </div>
                <?php else : ?>
                    <div class="product-details-stock mb-10">
                        <span class="out-stock"><?php echo esc_html__('Out Of Stock', 'hexa-theme'); ?></span>
                    </div>
                <?php endif; ?>


                <div class="product-details-rating-wrapper d-flex align-items-center mb-10">
                    <?php if (!empty($rating)) : ?>
                        <?php echo wp_kses_post($rating); ?>

                        <div class="product-details-reviews">
                            <span>( <?php echo esc_html($ratingcount); ?> <?php echo esc_html__('customer ', 'hexa-theme');
                                                                            echo esc_html($ratingcount) <= 1 ? 'review' : 'reviews'; ?> )</span>
                        </div>
                    <?php else : ?>
                        <div class="product-details-rating ">
                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                                echo '<span><i class="fal fa-star"></i></span>';
                            }
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <h3 class="product-details-title"><?php the_title(); ?></h3>

            <!-- price -->
            <div class="product-details-price-wrapper mb-20">
                <?php woocommerce_template_single_price(); ?>
            </div>

            <?php if (!empty(woocommerce_template_single_excerpt())) : ?>
                <p><?php woocommerce_template_single_excerpt(); ?></p>
            <?php endif; ?>

            <!-- variations -->
            <div class="product-details-variation">
                <!-- single item -->
            </div>

            <!-- actions -->
            <div class="product-details-action-wrapper">
                <?php woocommerce_template_single_add_to_cart(); ?>
            </div>

            <div class="product-details-query">
                <?php woocommerce_template_single_meta(); ?>
            </div>
        </div>


    <?php
    }
}
add_action('woocommerce_single_product_summary', 'hexa_content_single_details', 4);



/*************************************************
## Free shipping progress bar.
 *************************************************/
function hexa_shipping_progress_bar()
{

    $total           = WC()->cart->get_displayed_subtotal();
    $limit           = get_theme_mod('shipping_progress_bar_amount');
    $percent         = 100;


    if ($total < $limit) {
        $percent = floor(($total / $limit) * 100);
        $message = str_replace('[remainder]', wc_price($limit - $total), get_theme_mod('shipping_progress_bar_message_initial'));
    } else {
        $message = get_theme_mod('shipping_progress_bar_message_success');
    }

    ?>

    <div class="free-progress-bar">
        <div class="free-shipping-notice">
            <?php echo wp_kses($message, 'post'); ?>
        </div>
        <div class="progress-bar">
            <span class="progress progress-bar progress-bar-striped progress-bar-animated" data-width="<?php echo esc_attr($percent); ?>%"></span>
        </div>
    </div>

<?php
}

if (get_theme_mod('shipping_progress_bar_location_card_page', 0) == '1') {
    add_action('woocommerce_before_cart_table',  'hexa_shipping_progress_bar');
}

if (get_theme_mod('shipping_progress_bar_location_mini_cart', 0) == '1') {
    add_action('woocommerce_before_mini_cart_contents', 'hexa_shipping_progress_bar');
}

if (get_theme_mod('shipping_progress_bar_location_checkout', 0) == '1') {
    add_action('woocommerce_checkout_before_customer_details', 'hexa_shipping_progress_bar');
}


/*************************************************
## sale percentage
 *************************************************/

function hexa_sale_percentage()
{
    global $product;
    $output = '';

    if ($product->is_on_sale() && $product->is_type('variable')) {
        $percentage = ceil(100 - ($product->get_variation_sale_price() / $product->get_variation_regular_price('min')) * 100);
        $output .= '<span class="product__details-offer">-' . $percentage . '%</span>';
    } elseif ($product->is_on_sale() && $product->get_regular_price()  && !$product->is_type('grouped')) {
        $percentage = ceil(100 - ($product->get_sale_price() / $product->get_regular_price()) * 100);
        $output .= '<span class="product__details-offer">-' . $percentage . '%</span>';
    }
    return $output;
}


// woocommerce mini cart content
add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {
    ob_start();
?>
    <div class="mini_shopping_cart_box">
        <?php woocommerce_mini_cart(); ?>
    </div>
    <?php $fragments['.mini_shopping_cart_box'] = ob_get_clean();
    return $fragments;
});

// woocommerce mini cart count icon
if (!function_exists('hexa_header_add_to_cart_fragment')) {
    function hexa_header_add_to_cart_fragment($fragments)
    {
        ob_start();
    ?>
        <span class="cart__count cart-item">
            <?php echo esc_html(WC()->cart->cart_contents_count); ?>
        </span>
    <?php
        $fragments['.cart-item'] = ob_get_clean();

        return $fragments;
    }
}
add_filter('woocommerce_add_to_cart_fragments', 'hexa_header_add_to_cart_fragment');


// product-content archive
if (!function_exists('hexa_content_product_grid')) {
    function hexa_content_product_grid()
    {
        global $product;
        global $post;
        global $woocommerce;
        $rating = wc_get_rating_html($product->get_average_rating());
        $ratingcount = $product->get_review_count();
        $terms = get_the_terms(get_the_ID(), 'product_cat');
        $attachment_ids = $product->get_gallery_image_ids();

        foreach ($attachment_ids as $key => $attachment_id) {
            $image_link =  wp_get_attachment_url($attachment_id);
            $arr[] = $image_link;
        }

    ?>

        <div class="col">
            <div class="product-item mb-40">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="product-thumb p-relative z-index-1 fix w-img">
                        <?php the_post_thumbnail(); ?>

                        <?php if ($product->is_on_sale()) : ?>
                            <div class="product-badge product-on-sale">
                                <?php woocommerce_show_product_loop_sale_flash($post->ID); ?>
                            </div>
                        <?php endif; ?>

                        <!-- product action -->
                        <div class="product-action">
                            <div class="product-action-item d-flex flex-row">

                                <div class="product-action-btn product-add-to-cart-btn">
                                    <?php woocommerce_template_loop_add_to_cart(); ?>
                                </div>

                                <?php if (function_exists('woosw_init')) : ?>
                                    <div class="product-action-btn product-add-wishlist-btn">
                                        <?php echo do_shortcode('[woosw]'); ?>
                                        <span class="product-action-tooltip"><?php echo esc_html__('Add To Wishlist', 'hexa-theme'); ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if (class_exists('WPCleverWoosq')) : ?>
                                    <div class="product-action-btn">
                                        <?php echo do_shortcode('[woosq]'); ?>
                                        <span class="product-action-tooltip"><?php echo esc_html__('Quick view', 'hexa-theme'); ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if (function_exists('woosc_init')) : ?>
                                    <div class="product-action-btn">
                                        <?php echo do_shortcode('[woosc]'); ?>
                                        <span class="product-action-tooltip"> <?php echo esc_html__('Add To Compare', 'hexa-theme'); ?></span>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="product-content pt-20">
                    <div class="product-tag d-none">
                        <?php foreach ($terms as $key => $term) :
                            $count = count($terms) - 1;
                            $name = ($count > $key) ? $term->name . ', ' : $term->name;
                        ?>
                            <a href="<?php echo get_term_link($term->slug, 'product_cat'); ?> "> <?php echo esc_html($name); ?></a>
                        <?php endforeach; ?>
                    </div>
                    <h3 class="product-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>

                    <div class="product-price-wrapper">
                        <?php echo woocommerce_template_loop_price(); ?>
                    </div>

                    <?php if (!empty($rating)) : ?>
                        <div class="product-rating">
                            <?php echo wp_kses_post($rating); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    <?php
    }
}
add_action('woocommerce_before_shop_loop_item', 'hexa_content_product_grid', 10);


// smart quickview
add_filter('woosq_button_html', 'hexa_woosq_button_html', 10, 2);
function hexa_woosq_button_html($output, $prodid)
{
    return $output = '<a href="#" class="icon-btn woosq-btn woosq-btn-' . esc_attr($prodid) . ' ' . get_option('woosq_button_class') . '" data-id="' . esc_attr($prodid) . '" data-effect="mfp-3d-unfold"><i class="fal fa-eye"></i></a>';
}


// product add to cart button
function woocommerce_template_loop_add_to_cart($args = array())
{
    global $product;

    $stock = $product->is_in_stock();

    $stock_class = $stock ? 'stock-available' : 'stock-out';

    $price = $product->get_regular_price();

    $price_class = $price ? NULL : 'price-empty';

    if ($product) {
        $defaults = array(
            'quantity'   => 1,
            'class'      => implode(
                ' ',
                array_filter(
                    array(
                        'cart-button icon-btn button product-action product-action-1 ' . $stock_class . ' ' . $price_class,
                        'product_type_' . $product->get_type(),
                        $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                        $product->supports('ajax_add_to_cart') && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
                    )
                )
            ),
            'attributes' => array(
                'data-product_id'  => $product->get_id(),
                'data-product_sku' => $product->get_sku(),
                'aria-label'       => $product->add_to_cart_description(),
                'rel'              => 'nofollow',
            ),
        );

        $args = wp_parse_args($args, $defaults);

        if (isset($args['attributes']['aria-label'])) {
            $args['attributes']['aria-label'] = wp_strip_all_tags($args['attributes']['aria-label']);
        }
    }


    // check product type 
    if ($product->is_type('simple')) {
        $btntext = esc_html__("Add to Cart", 'hexa-theme');
    } elseif ($product->is_type('variable')) {
        $btntext = esc_html__("Select Options", 'hexa-theme');
    } elseif ($product->is_type('external')) {
        $btntext = esc_html__("Buy Now", 'hexa-theme');
    } elseif ($product->is_type('grouped')) {
        $btntext = esc_html__("View Products", 'hexa-theme');
    } else {
        $btntext = "Add to Cart";
    }

    echo sprintf(
        '<a href="%s" data-quantity="%s" class="%s product-add-cart-btn" %s>%s</a>',
        esc_url($product->add_to_cart_url()),
        esc_attr(isset($args['quantity']) ? $args['quantity'] : 1),
        esc_attr(isset($args['class']) ? $args['class'] : 'cart-button icon-btn button product-action product-action-1 ' . $stock_class),
        isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : '',
        '<i class="fal fa-shopping-cart"></i><span class="product-action-tooltip">' . $btntext . '</span>'
    );
}


add_action('wp_footer', 'custom_quantity_fields_script');

// custom_quantity_fields_script
function custom_quantity_fields_script()
{
    ?>
    <script type='text/javascript'>
        jQuery(function($) {
            if (!String.prototype.getDecimals) {
                String.prototype.getDecimals = function() {
                    var num = this,
                        match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
                    if (!match) {
                        return 0;
                    }
                    return Math.max(0, (match[1] ? match[1].length : 0) - (match[2] ? +match[2] : 0));
                }
            }
            // Quantity "plus" and "minus" buttons
            $(document.body).on('click', '.plus, .minus', function() {
                var $qty = $(this).closest('.quantity').find('.qty'),
                    currentVal = parseFloat($qty.val()),
                    max = parseFloat($qty.attr('max')),
                    min = parseFloat($qty.attr('min')),
                    step = $qty.attr('step');

                // Format values
                if (!currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 0;
                if (max === '' || max === 'NaN') max = '';
                if (min === '' || min === 'NaN') min = 0;
                if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') step = 1;

                // Change the value
                if ($(this).is('.plus')) {
                    if (max && (currentVal >= max)) {
                        $qty.val(max);
                    } else {
                        $qty.val((currentVal + parseFloat(step)).toFixed(step.getDecimals()));
                    }
                } else {
                    if (min && (currentVal <= min)) {
                        $qty.val(min);
                    } else if (currentVal > 0) {
                        $qty.val((currentVal - parseFloat(step)).toFixed(step.getDecimals()));
                    }
                }

                // Trigger change event
                $qty.trigger('change');
            });
        });
    </script>
<?php
}

/*************************************************
## hexa Woo Search Form
 *************************************************/

add_filter('get_product_search_form', 'hexa_custom_product_searchform');

function hexa_custom_product_searchform($form)
{

    $form = '<div class="search-form p-relative">
                <form action="' . esc_url(home_url('/shop')) . '" role="search" method="get" id="searchform">
                <input type="search" value="' . get_search_query() . '" name="s" placeholder="' . esc_attr__('Search Product', 'hexa-theme') . '" autocomplete="off">
                <button type="submit"><i class="fa-regular fa-arrow-right-long"></i></button> 
                </form>
            </div>';

    return $form;
}
