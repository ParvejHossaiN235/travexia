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
class Hexa_Product_Slider extends Widget_Base
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
        return 'hf-product-slider';
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
        return __('Product Slider', 'hexacore');
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
        $this->hexa_basic_style_controls('heading_subtitle', 'Subtitle', '.hf-el-subtitle', 'layout-1');
        $this->hexa_basic_style_controls('heading_title', 'Title', '.hf-el-title', 'layout-1');
        $this->hexa_basic_style_controls('heading_desc', 'Description', '.hf-el-content', 'layout-1');
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
            // shape image
            if (!empty($settings['hexa_shape_image_1']['url'])) {
                $hexa_shape_image = !empty($settings['hexa_shape_image_1']['id']) ? wp_get_attachment_image_url($settings['hexa_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['hexa_shape_image_1']['url'];
                $hexa_shape_image_alt = get_post_meta($settings["hexa_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
            }
            if (!empty($settings['hexa_shape_image_2']['url'])) {
                $hexa_shape_image2 = !empty($settings['hexa_shape_image_2']['id']) ? wp_get_attachment_image_url($settings['hexa_shape_image_2']['id'], $settings['shape_image_size_size']) : $settings['hexa_shape_image_2']['url'];
                $hexa_shape_image_alt2 = get_post_meta($settings["hexa_shape_image_2"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->add_render_attribute('title_args', 'class', 'hf-section-title-5 hf-el-title');
        ?>


            <div class="hf-new-product-5__area fix d-none p-relative grey-bg-2 pt-120 pb-120 hf-pro-slider-el hf-el-section">
                <?php if (!empty($hexa_shape_image)) : ?>
                    <div class="hf-new-product-5__shape-1 d-none d-xl-block">
                        <img src="<?php echo esc_url($hexa_shape_image); ?>" alt="<?php echo esc_attr($hexa_shape_image_alt); ?>">
                    </div>
                <?php endif; ?>
                <?php if (!empty($hexa_shape_image2)) : ?>
                    <div class="hf-new-product-5__shape-2 d-none d-xl-block">
                        <img src="<?php echo esc_url($hexa_shape_image2); ?>" alt="<?php echo esc_attr($hexa_shape_image_alt2); ?>">
                    </div>
                <?php endif; ?>
                <div class="container-fluid g-0">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hf-new-product-5__section-title mb-50 text-center">
                                <?php if (!empty($settings['hexa_product_sub_title'])) : ?>
                                    <span class="hf-section-subtitle-5 hf-el-subtitle"><?php echo hexa_kses($settings['hexa_product_sub_title']); ?></span>
                                <?php endif; ?>
                                <?php
                                if (!empty($settings['hexa_product_title'])) :
                                    printf(
                                        '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape($settings['hexa_product_title_tag']),
                                        $this->get_render_attribute_string('title_args'),
                                        hexa_kses($settings['hexa_product_title'])
                                    );
                                endif;
                                ?>
                                <?php if (!empty($settings['hexa_product_description'])) : ?>
                                    <p class="hf-el-content"><?php echo hexa_kses($settings['hexa_product_description']); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hf-new-product-5__wrapper">
                                <div class="swiper-container hf-new-product-5__active">
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
                                                    <div class="hf-new-product-5__item-box">
                                                        <div class="hf-new-product-5__item">
                                                            <?php if (has_post_thumbnail()) : ?>
                                                                <div class="hf-new-product-5__thumb fix p-relative hf-pro-img">
                                                                    <?php the_post_thumbnail(); ?>
                                                                    <div class="hf-new-product-5__social-box hf-product-action">

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
                                                                    <?php if ($product->is_on_sale()) : ?>
                                                                        <div class="hf-new-product-5__thumb-text">
                                                                            <span><?php echo esc_html__('sale', 'hexacore'); ?></span>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                            <div class="hf-new-product-5__content text-center">

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

                                                                <div class="hf-new-product-5__title-box">
                                                                    <h4 class="hf-new-product-5__title-sm hf-el-rep-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                                                </div>
                                                                <div class="hf-product-content-price">
                                                                    <span class="product-item-3-price"><?php echo woocommerce_template_loop_price(); ?></span>
                                                                </div>
                                                                <div class="hf-new-product-5__link-box text-center">
                                                                    <?php echo \HexaCore\Hexa_El_Woocommerce::hexa_woo_add_to_cart($post_id);  ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php endwhile;
                                            wp_reset_query();
                                        endif; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<?php endif;
    }
}

$widgets_manager->register(new Hexa_Product_Slider());
