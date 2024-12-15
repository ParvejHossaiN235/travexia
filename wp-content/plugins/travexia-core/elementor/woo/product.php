<?php

namespace HexaCore\Widgets;

use \Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Utils;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Hexa_Product extends Widget_Base
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
        return 'hf-product';
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
        return __('Product', 'hexacore');
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
        $this->register_controls_section();
        $this->style_tab_content();
    }

    protected function register_controls_section()
    {

        // layout Panel
        $this->start_controls_section(
            'hexa_layout',
            [
                'label' => esc_html__('Design Layout', 'hexacore'),
            ]
        );
        $this->add_control(
            'hexa_design_layout',
            [
                'label' => esc_html__('Select Layout', 'hexacore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'hexacore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // Product Query
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Product Content', 'hexacore'),
            ]
        );
        $this->add_control(
            'product_category',
            [
                'label' => __('Select Categories', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_product_categories(),
                'multiple' => true,
                'label_block' => true,
                'placeholder' => __('All Categories', 'hexacore'),
            ]
        );
        $this->add_control(
            'number_show',
            [
                'label' => __('Show Number Posts', 'hexacore'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => '3',
            ]
        );

        $this->end_controls_section();
    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->hexa_section_style_controls('product_section', 'Section Style', '.hf-el-section');
        // rep
        $this->start_controls_section(
            'pro_img_sec',
            [
                'label' => esc_html__('Product List Image', 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'proImg_width',
            [
                'label' => esc_html__('Width', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],

                'selectors' => [
                    '{{WRAPPER}} .hf-pro-img img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'proImg_height',
            [
                'label' => esc_html__('Height', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],

                'selectors' => [
                    '{{WRAPPER}} .hf-pro-img img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // rating
        $this->start_controls_section(
            'rating_sec',
            [
                'label' => esc_html__('Product List Rating', 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'retIcon_color',
            [
                'label' => esc_html__('Rating Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .star-rating span::before, {{WRAPPER}} .hf-fea-product__star i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
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

    protected function get_product_categories()
    {
        $args = array('orderby=name&order=ASC&hide_empty=0');
        $terms = get_terms('product_cat', $args);
        $cat = array();
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $cat[$term->slug] = $term->name;
            }
        }
        return $cat;
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        /**
         * Setup the post arguments.
         */
        $number_show = (!empty($settings['number_show']) ? $settings['number_show'] : 9);

        if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } elseif (get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }

        if ($settings['product_category']) {
            $args = array(
                'paged' => $paged,
                'post_type' => 'product',
                'post_status' => 'publish',
                'posts_per_page' => $number_show,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field'    => 'slug',
                        'terms'    => $settings['product_category']
                    ),
                ),
            );
        } else {
            $args = array(
                'paged' => $paged,
                'post_type' => 'product',
                'post_status' => 'publish',
                'posts_per_page' => $number_show,
            );
        }

        // The Query
        $query = new \WP_Query($args);

        $filter_list = $settings['product_category'];

?>

        <?php if ($settings['hexa_design_layout']  == 'layout-2') :
            $this->add_render_attribute('title_args', 'class', 'hf-section-title');
        ?>

        <?php else :
            $this->add_render_attribute('title_args', 'class', 'hf-section-title');
        ?>

            <div class="hf-product-2__area hf-product-2__space hf-el-section">
                <div class="container">
                    <div class="row">
                        <div class="hf-product-2__wrapper p-relative">
                            <div class="swiper-container hf-product-2__active">
                                <div class="swiper-wrapper">

                                    <?php if ($query->have_posts()) :
                                        $i = 0.1;
                                        while ($query->have_posts()) :
                                            $query->the_post();
                                            global $post;
                                            $categories = get_the_category($post->ID);
                                            $i += 0.2;
                                            global $product;
                                            global $post;
                                            global $woocommerce;
                                            $rating = wc_get_rating_html($product->get_average_rating());
                                            $ratingcount = $product->get_review_count();
                                            $regularPrice = $product->get_regular_price();
                                            $post_id = $product->get_id();
                                    ?>
                                            <div class="swiper-slide">
                                                <div class="hf-product-2__item hf-pro-img">
                                                    <?php if (has_post_thumbnail()) : ?>
                                                        <div class="hf-product-2__thumb p-relative">
                                                            <?php the_post_thumbnail(); ?>
                                                            <?php if ($product->is_on_sale()) : ?>
                                                                <div class="hf-product-2__thumb-text">
                                                                    <?php woocommerce_show_product_loop_sale_flash($post->ID); ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="hf-product-2__content">

                                                        <?php if (!empty($rating)) : ?>
                                                            <div class="hf-fea-product__star">
                                                                <?php echo wp_kses_post($rating); ?>
                                                            </div>
                                                        <?php else : ?>
                                                            <div class="hf-fea-product__star">
                                                                <?php
                                                                for ($i = 1; $i < 6; $i++) {
                                                                    echo '<i class="fa-light fa-star"></i>';
                                                                }
                                                                ?>
                                                            </div>
                                                        <?php endif; ?>

                                                        <h4 class="hf-product-2__title-sm hf-el-rep-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

                                                        <div class="hf-product-2__price-box d-flex align-items-start justify-content-between">

                                                            <div class="hf-product-content-price">
                                                                <span class="product-item-3-price"><?php echo woocommerce_template_loop_price(); ?></span>
                                                            </div>

                                                            <div class="hf-product-2__icon hf-product-action">

                                                                <?php if (class_exists('WPCleverWoosq')) : ?>
                                                                    <div class="product-action-btn">
                                                                        <?php echo do_shortcode('[woosq]'); ?>
                                                                    </div>
                                                                <?php endif; ?>

                                                                <?php if (function_exists('woosw_init')) : ?>
                                                                    <div class="product-action-btn product-add-wishlist-btn">
                                                                        <?php echo do_shortcode('[woosw]'); ?>
                                                                    </div>
                                                                <?php endif; ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="hf-product-2__button-box">
                                                        <?php echo \HexaCore\Hexa_El_Woocommerce::hexa_woo_add_to_cart($post_id);  ?>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php endwhile;
                                        wp_reset_query();
                                    endif; ?>

                                </div>
                            </div>
                            <div class="hf-product-2__arrow-box d-none d-xxl-block">
                                <div class="slider-next">
                                    <button>
                                        <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.44804 1.71661e-05C1.24988 -0.00113773 1.05588 0.0568676 0.890755 0.166636C0.72563 0.276405 0.596866 0.432964 0.520881 0.616354C0.444896 0.799745 0.425131 1.00166 0.464108 1.19635C0.503084 1.39104 0.599036 1.56968 0.739729 1.70951L6.02709 6.99796L0.739729 12.2864C0.551874 12.4747 0.446338 12.73 0.446338 12.9962C0.446338 13.128 0.472248 13.2586 0.522588 13.3803C0.572928 13.5021 0.646712 13.6128 0.739729 13.706C0.832745 13.7992 0.943171 13.8731 1.0647 13.9236C1.18623 13.974 1.31649 14 1.44804 14C1.7137 14 1.96849 13.8942 2.15634 13.706L8.14204 7.70775C8.32784 7.52045 8.43214 7.26707 8.43214 7.00296C8.43214 6.73885 8.32784 6.48548 8.14204 6.29817L2.15634 0.299929C2.06395 0.205468 1.95377 0.130322 1.83218 0.0788403C1.7106 0.0273581 1.58003 0.000566483 1.44804 1.71661e-05Z" fill="black" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<?php endif;
    }
}

$widgets_manager->register(new Hexa_Product());
