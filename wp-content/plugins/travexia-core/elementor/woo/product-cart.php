<?php

namespace HexaCore\Widgets;

use \Elementor\Widget_Base;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Hexa Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Hexa_Product_Cart extends Widget_Base
{

    use \HexaCore\Widgets\HexaCoreElementFunctions;


    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'hf-product-cart';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Product Cart', 'hexacore');
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'hf-icon';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['hexacore_woocommerce'];
    }

    /**
     * Retrieve the list of scripts the widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends()
    {
        return ['hexacore'];
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */

    protected function register_controls()
    {
        $this->register_styles_section();
    }

    protected function register_styles_section()
    {
        $this->hexa_icon_style_controls('woo_cart', 'Cart Icon - Style', '.hexa-el-carticon');
        $this->hexa_icon_style_controls('woo_close', 'Close Icon - Style', '.hexa-el-closeicon');
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    public static function wooproduct_render_menu_cart()
    {
        if (null === WC()->cart) {
            return;
        }
        $product_count = sprintf(_n('%d', '%d', WC()->cart->get_cart_contents_count()), WC()->cart->get_cart_contents_count());
        $cart_url = esc_url(wc_get_cart_url());

        $widget_cart_is_hidden = apply_filters('woocommerce_widget_cart_is_hidden', false);
?>
        <?php if (!$widget_cart_is_hidden) : ?>
            <div class="octf-cart">
                <a class="cart-content ot-minicart hexa-el-carticon" href="<?php echo $cart_url; ?>" title="<?php esc_attr_e('View your shopping cart', 'hexacore'); ?>"><i class="uil uil-shopping-cart"></i> <span class="cart-count"><?php echo $product_count; ?></span>
                </a>
            </div>
            <?php if (!is_cart() && !is_checkout()) { ?>
                <div class="site-overlay cart-overlay"></div>
                <div class="site-header-cart">
                    <div class="heading-cart">
                        <h3><?php echo esc_html__('Your Cart', 'hexacore'); ?></h3>
                        <a class="cart-close otbtn-close hexa-el-closeicon" href="#"><i class="uil uil-times"></i></a>
                    </div>
                    <?php the_widget('WC_Widget_Cart', array('title' => '')); ?>
                </div>
            <?php } ?>
        <?php endif; ?>
<?php
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        self::wooproduct_render_menu_cart();
    }
}

$widgets_manager->register(new Hexa_Product_Cart());
