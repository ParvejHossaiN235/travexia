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
class Hexa_Product_Cat extends Widget_Base
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
        return 'hf-product-cat';
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
        return __('Product Category', 'hexacore');
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
                    'layout-2' => esc_html__('Layout 2', 'hexacore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // _hexa_image
        $this->start_controls_section(
            '_hexa_image',
            [
                'label' => esc_html__('Thumbnail', 'hexacore'),
                'condition' => [
                    'hexa_design_layout' => 'layout-2'
                ]
            ]
        );

        $this->add_control(
            'hexa_image',
            [
                'label' => esc_html__('Choose Image', 'hexacore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'hexa_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->end_controls_section();

        // Categories
        $this->start_controls_section(
            'hexa_cat_sec',
            [
                'label' => esc_html__('Category', 'hexacore'),
            ]
        );

        // Category Select
        $this->add_control(
            'hexa_category',
            [
                'label'       => 'Select Product Category',
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'options'     => $this->hexa_get_categories(),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // animation
        $this->start_controls_section(
            'hexa_animation',
            [
                'label' => esc_html__('Animation', 'hexacore'),
            ]
        );

        // creative animation
        $this->add_control(
            'hexa_creative_anima_switcher',
            [
                'label' => esc_html__('Active Animation', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'hexacore'),
                'label_off' => esc_html__('No', 'hexacore'),
                'return_value' => 'yes',
                'default' => '0',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'hexa_anima_type',
            [
                'label' => __('Animation Type', 'hexacore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'tpfadeUp' => __('tpfadeUp', 'hexacore'),
                    'tpfadeInDown' => __('tpfadeInDown', 'hexacore'),
                    'tpfadeLeft' => __('tpfadeLeft', 'hexacore'),
                    'tpfadeRight' => __('tpfadeRight', 'hexacore'),
                ],
                'default' => 'tpfadeUp',
                'frontend_available' => true,
                'style_transfer' => true,
                'condition' => [
                    'hexa_creative_anima_switcher' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'hexa_anima_dura',
            [
                'label' => esc_html__('Animation Duration', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('0.3s', 'hexacore'),
                'condition' => [
                    'hexa_creative_anima_switcher' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'hexa_anima_delay',
            [
                'label' => esc_html__('Animation Delay', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('0.6s', 'hexacore'),
                'condition' => [
                    'hexa_creative_anima_switcher' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    // Get Categories Based on Post Type
    public function hexa_get_categories()
    {
        // Set the taxonomy to 'product_cat' for WooCommerce product categories
        $taxonomy = 'product_cat';

        // Set up the query arguments
        $args = array(
            'taxonomy'   => $taxonomy,
            'hide_empty' => false,
        );

        // Get all terms (categories) of the specified taxonomy
        $hexa_terms = get_terms($args);

        // Build and return the associative array of categories
        $options = array();
        foreach ($hexa_terms as $category) {
            $options[$category->slug] = $category->name;
        }

        return $options;
    }

    // style_tab_content
    protected function style_tab_content()
    {
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
    protected function render()
    {
        $settings = $this->get_settings_for_display();

?>

        <?php if ($settings['hexa_design_layout']  == 'layout-2') :
            // thumbnail
            if (!empty($settings['hexa_image']['url'])) {
                $hexa_image = !empty($settings['hexa_image']['id']) ? wp_get_attachment_image_url($settings['hexa_image']['id'], $settings['hexa_image_size_size']) : $settings['hexa_image']['url'];
                $hexa_image_alt = get_post_meta($settings["hexa_image"]["id"], "_wp_attachment_image_alt", true);
            }
            $selected_category = !empty($settings['hexa_category']) ? $settings['hexa_category'] : 0;
            $category = get_term_by('slug', $selected_category, 'product_cat');
        ?>

            <?php
            if ($category) {
                $category_name = $category->name;
                $category_link = get_term_link($category, 'product_cat');

                $pNum = $category->count;

            ?>
                <div class="hf-product-5__item text-center hf-el-section <?php echo $settings['hexa_creative_anima_switcher'] ? "wow " . $settings['hexa_anima_type'] : NULL; ?>" <?php echo $settings['hexa_creative_anima_switcher'] ? "data-wow-duration=" . $settings['hexa_anima_dura'] . " " . "data-wow-delay=" . $settings['hexa_anima_delay'] . " " : NULL; ?>>
                    <?php if (!empty($hexa_image)) : ?>
                        <div class="hf-product-5__thumb">
                            <img src="<?php echo esc_url($hexa_image); ?>" alt="<?php echo esc_attr($hexa_image_alt); ?>">
                        </div>
                    <?php endif; ?>
                    <div class="hf-product-5__content">
                        <?php echo $category_link ? '<a href=' . esc_url($category_link) . '>' : NULL; ?>
                        <h4 class="hf-product-5__title hf-el-catName"><?php echo hexa_kses($category_name); ?></h4>
                        <?php echo $category_link ? ' </a>' : NULL; ?>
                        <span class="hf-el-proCount"><?php echo esc_html($pNum);
                                                        echo 1 < $pNum ? ' Products' : ' Product'; ?></span>
                    </div>
                </div>
            <?php
            } else {
                echo 'Product Category not found.';
            }

            ?>

        <?php else :
            $selected_category = !empty($settings['hexa_category']) ? $settings['hexa_category'] : 0;

            $category = get_term_by('slug', $selected_category, 'product_cat');
        ?>
            <?php
            if ($category) {
                $category_name = $category->name;
                $category_link = get_term_link($category, 'product_cat');

                $pNum = $category->count;

            ?>
                <div class="hf-product-4__item hf-el-section pink-bg <?php echo $settings['hexa_creative_anima_switcher'] ? "wow " . $settings['hexa_anima_type'] : NULL; ?>" <?php echo $settings['hexa_creative_anima_switcher'] ? "data-wow-duration=" . $settings['hexa_anima_dura'] . " " . "data-wow-delay=" . $settings['hexa_anima_delay'] . " " : NULL; ?>>
                    <div class="hf-product-4__content">
                        <h4 class="hf-product-4__title hf-el-catName">
                            <a href="<?php echo esc_url($category_link); ?>"><?php echo hexa_kses($category_name); ?></a>
                        </h4>
                        <span class="hf-el-proCount">(<?php echo esc_html($pNum);
                                                        echo 1 < $pNum ? ' Products' : ' Product'; ?>)</span>
                        <a class="hf-btn-border-sm hf-el-btn" href="<?php echo esc_url($category_link); ?>"><?php echo esc_html__('Shop Now', 'hexacore'); ?></a>
                    </div>
                </div>
            <?php
            } else {
                echo 'Product Category not found.';
            }

            ?>
<?php endif;
    }
}

$widgets_manager->register(new Hexa_Product_Cat());
