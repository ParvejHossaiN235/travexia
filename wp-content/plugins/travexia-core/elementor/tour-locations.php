<?php

namespace HexaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Hexa Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Hexa_Tour_Locations extends Widget_Base
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
        return 'hf-tour-locations';
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
        return __('Tour Locations', 'hexacore');
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
        return ['hexacore'];
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

        // List
        $this->start_controls_section(
            'section_desig_list',
            [
                'label' => esc_html__('Destination Option', 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'limit',
            [
                'label'       => esc_html__('Number of Destinations', 'hexacore'),
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'step'        => 1,
                'min'         => 1,
                'default'     => 6,
                'description' => esc_html__('Number of destinations to show. Default to 6', 'hexacore'),
            ]
        );

        $this->add_control(
            'order',
            [
                'label'   => esc_html__('Order', 'hexacore'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'ASC',
                'options' => [
                    'ASC'  => esc_html__('Ascending', 'hexacore'),
                    'DESC' => esc_html__('Descending', 'hexacore'),
                ],
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'   => esc_html__('Order By', 'hexacore'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'name',
                'options' => [
                    'none'       => esc_html__('None', 'hexacore'),
                    'type'       => esc_html__('Type', 'hexacore'),
                    'title'      => esc_html__('Title', 'hexacore'),
                    'name'       => esc_html__('Name', 'hexacore'),
                    'date'       => esc_html__('Date', 'hexacore'),
                    'ID'         => esc_html__('ID', 'hexacore'),
                    'menu_order' => esc_html__('Menu Order', 'hexacore'),
                ],
            ]
        );

        $this->add_control(
            'hide_empty',
            [
                'label'        => esc_html__('Hide Empty', 'hexacore'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'hexacore'),
                'label_off'    => esc_html__('No', 'hexacore'),
                'return_value' => 1,
                'default'      => 0,
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_column_settings',
            [
                'label' => esc_html__('Column Settings', 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'desktop_column',
            [
                'label' => esc_html__('Columns for Desktop', 'hexacore'),
                'description' => esc_html__('Screen width equal to or greater than 1200px', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__('1 Columns', 'hexacore'),
                    6 => esc_html__('2 Columns', 'hexacore'),
                    4 => esc_html__('3 Columns', 'hexacore'),
                    3 => esc_html__('4 Columns', 'hexacore'),
                    2 => esc_html__('6 Columns', 'hexacore'),
                ],
                'separator' => 'before',
                'default' => '2',
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'laptop_column',
            [
                'label' => esc_html__('Columns for Laptop', 'hexacore'),
                'description' => esc_html__('Screen width equal to or greater than 992px', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__('1 Columns', 'hexacore'),
                    6 => esc_html__('2 Columns', 'hexacore'),
                    4 => esc_html__('3 Columns', 'hexacore'),
                    3 => esc_html__('4 Columns', 'hexacore'),
                    2 => esc_html__('6 Columns', 'hexacore'),
                ],
                'separator' => 'before',
                'default' => '3',
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'tablet_column',
            [
                'label' => esc_html__('Columns for Tablet', 'hexacore'),
                'description' => esc_html__('Screen width equal to or greater than 768px', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__('1 Columns', 'hexacore'),
                    6 => esc_html__('2 Columns', 'hexacore'),
                    4 => esc_html__('3 Columns', 'hexacore'),
                    3 => esc_html__('4 Columns', 'hexacore'),
                    2 => esc_html__('6 Columns', 'hexacore'),
                ],
                'separator' => 'before',
                'default' => '4',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'mobile_column',
            [
                'label' => esc_html__('Columns for Mobile', 'hexacore'),
                'description' => esc_html__('Screen width less than 768px', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__('1 Columns', 'hexacore'),
                    6 => esc_html__('2 Columns', 'hexacore'),
                    4 => esc_html__('3 Columns', 'hexacore'),
                    3 => esc_html__('4 Columns', 'hexacore'),
                    2 => esc_html__('6 Columns', 'hexacore'),
                ],
                'separator' => 'before',
                'default' => '6',
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();
    }


    // style_tab_content
    protected function style_tab_content()
    {
        $this->hexa_section_style_controls('video_section', 'Section - Style', '.hf-el-section');
        $this->hexa_basic_style_controls('section_title', 'Section - Title', '.hf-el-title', 'layout-2');
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
        extract($settings);
        $term_args = array(
            'taxonomy'     => 'tour_destination',
            'orderby'      => $orderby,
            'order'        => $order,
            'hide_empty'   => $hide_empty,
            'hierarchical' => 0,
            'search'       => '',
            'number'       => $limit == -1 ? false : $limit,
        );

        $destinations = get_terms($term_args);

?>

        <?php if ($settings['hexa_design_layout']  == 'layout-2') : ?>

            <!-- destination-area-start -->
            <div class="tr-destination-2-area z-index-1">
                <div class="row row-gap-30 justify-content-center">
                    <?php foreach ($destinations as $term) {
                        $meta      = get_term_meta($term->term_id, 'tf_tour_destination', true);
                        $image_url = !empty($meta['image']) ? $meta['image'] : esc_url(get_bloginfo('stylesheet_directory') . '/assets/img/thumbnail-default.png');
                        $term_count = !empty($term->count) ? $term->count : '';
                        $term_name = !empty($term->name) ? $term->name : '';
                        $term_link = !empty(get_term_link($term)) ? get_term_link($term) : '#';

                        if (is_wp_error($term_link)) {
                            continue;
                        } ?>
                        <div class="col-xl-<?php echo esc_attr($desktop_column); ?> col-lg-<?php echo esc_attr($laptop_column); ?> col-md-<?php echo esc_attr($tablet_column); ?> col-sm-<?php echo esc_attr($mobile_column); ?> wow itfadeUp" data-wow-duration=".9s" data-wow-delay=".3s">
                            <div class="tr-destination-2-item">
                                <?php if (!empty($image_url)) : ?>
                                    <div class="tr-destination-2-thumb fix">
                                        <a href="<?php echo esc_url($term_link); ?>">
                                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_html($term_name); ?>">
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <div class="tr-destination-content text-center">
                                    <?php if (!empty($term_name)) : ?>
                                        <h4 class="tr-destination-title">
                                            <a class="border-line-black" href="<?php echo esc_url($term_link); ?>">
                                                <?php echo esc_html($term_name); ?>
                                            </a>
                                        </h4>
                                    <?php endif; ?>
                                    <?php if (!empty($term_count)) : ?>
                                        <span>
                                            <?php printf(esc_html(_n('%s Destination', '%s Destinations', $term_count, 'hexacore')), esc_html($term_count)); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <!-- destination-area-end -->

        <?php else : ?>

            <!-- place-area-start -->
            <div class="tr-place-area">
                <div class="row row-gap-30">
                    <?php foreach ($destinations as $term) {
                        $meta      = get_term_meta($term->term_id, 'tf_tour_destination', true);
                        $image_url = !empty($meta['image']) ? $meta['image'] : esc_url(get_bloginfo('stylesheet_directory') . '/assets/img/thumbnail-default.png');
                        $term_count = !empty($term->count) ? $term->count : '';
                        $term_name = !empty($term->name) ? $term->name : '';
                        $term_link = !empty(get_term_link($term)) ? get_term_link($term) : '#';

                        if (is_wp_error($term_link)) {
                            continue;
                        } ?>
                        <div class="col-xl-<?php echo esc_attr($desktop_column); ?> col-lg-<?php echo esc_attr($laptop_column); ?> col-md-<?php echo esc_attr($tablet_column); ?> col-sm-<?php echo esc_attr($mobile_column); ?> wow itfadeUp" data-wow-duration=".9s" data-wow-delay=".3s">
                            <div class="tr-place-item">
                                <?php if (!empty($image_url)) : ?>
                                    <div class="tr-place-thumb fix">
                                        <a href="<?php echo esc_url($term_link); ?>">
                                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_html($term_name); ?>">
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <div class="tr-place-content">
                                    <?php if (!empty($term_name)) : ?>
                                        <h4 class="tr-place-title">
                                            <a class="border-line-black" href="<?php echo esc_url($term_link); ?>">
                                                <?php echo esc_html($term_name); ?>
                                            </a>
                                        </h4>
                                    <?php endif; ?>
                                    <?php if (!empty($term_count)) : ?>
                                        <span>
                                            <?php printf(esc_html(_n('%s Destination', '%s Destinations', $term_count, 'hexacore')), esc_html($term_count)); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <!-- place-area-end -->

<?php endif;
    }
}

$widgets_manager->register(new Hexa_Tour_Locations());
