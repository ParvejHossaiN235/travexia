<?php

namespace HexaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Hexa Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Hexa_Advanced_Tab extends Widget_Base
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
        return 'hf-advanced-tabs';
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
        return __('Advanced Tabs', 'hexacore');
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

        $this->start_controls_section(
            '_section_price_tabs',
            [
                'label' => __('Advanced Tabs', 'hexacore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __('Field condition', 'hexacore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'hexacore'),
                    'style_2' => __('Style 2', 'hexacore'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );


        $repeater->add_control(
            'hexa_box_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'hexacore'),
                    'icon' => esc_html__('Icon', 'hexacore'),
                    'svg' => esc_html__('SVG', 'hexacore'),
                ],
                'condition' => [
                    'repeater_condition' => 'style_2'
                ]
            ]
        );

        $repeater->add_control(
            'hexa_box_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'hexacore'),
                'condition' => [
                    'hexa_box_icon_type' => 'svg',
                    'repeater_condition' => 'style_2'
                ]
            ]
        );

        $repeater->add_control(
            'hexa_box_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'hexacore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'hexa_box_icon_type' => 'image',
                    'repeater_condition' => 'style_2'
                ]
            ]
        );

        if (hexa_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'hexa_box_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'hexa_box_icon_type' => 'icon',
                        'repeater_condition' => 'style_2'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'hexa_box_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'hexa_box_icon_type' => 'icon',
                        'repeater_condition' => 'style_2'
                    ]
                ]
            );
        }


        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Title', 'hexacore'),
                'default' => __('Tab Title', 'hexacore'),
                'placeholder' => __('Type Tab Title', 'hexacore'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'template',
            [
                'label' => __('Section Template', 'hexacore'),
                'placeholder' => __('Select a section template for as tab content', 'hexacore'),

                'type' => Controls_Manager::SELECT2,
                'options' => get_elementor_templates()
            ]
        );

        $repeater->add_control(
            'hexa_active_switcher',
            [
                'label' => esc_html__('Active', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'hexacore'),
                'label_off' => esc_html__('No', 'hexacore'),
                'return_value' => 'yes',
                'default' => 0,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'tabs',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{title}}',
                'default' => [
                    [
                        'title' => 'Tab 1',
                    ],
                    [
                        'title' => 'Tab 2',
                    ]
                ]
            ]
        );

        $this->end_controls_section();

        // shape
        $this->start_controls_section(
            'hexa_shape',
            [
                'label' => esc_html__('Shape Section', 'hexacore'),
                'condition' => [
                    'hexa_design_layout' => 'layout-1'
                ]
            ]
        );

        $this->add_control(
            'hexa_shape_switch',
            [
                'label'        => esc_html__('Shape On/Off', 'hexacore'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'hexacore'),
                'label_off'    => esc_html__('Hide', 'hexacore'),
                'return_value' => 'yes',
                'default'      => '0',
            ]
        );

        $this->add_control(
            'hexa_shape_image_1',
            [
                'label' => esc_html__('Choose Shape Image 1', 'hexacore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'hexa_shape_switch' => 'yes',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'shape_image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                'condition' => [
                    'hexa_shape_switch' => 'yes',
                ]
            ]
        );

        $this->end_controls_section();
    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->hexa_section_style_controls('advanced_tab_section', 'Section Style', '.ele-section');
        $this->hexa_basic_style_controls('section_subtitle', 'Section - Subtitle', '.hf-el-subtitle', ['layout-1', 'layout-2']);
        $this->hexa_basic_style_controls('section_title', 'Section - Title', '.hf-el-title', ['layout-1', 'layout-2']);
        $this->hexa_basic_style_controls('section_desc', 'Section - Description', '.hf-el-content', ['layout-1', 'layout-2']);
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


        <?php if ($settings['hexa_design_layout']  == 'layout-2') : ?>

        <?php else :
            // shape image
            if (!empty($settings['hexa_shape_image_1']['url'])) {
                $hexa_shape_image = !empty($settings['hexa_shape_image_1']['id']) ? wp_get_attachment_image_url($settings['hexa_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['hexa_shape_image_1']['url'];
                $hexa_shape_image_alt = get_post_meta($settings["hexa_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->add_render_attribute('title_args', 'class', 'section-title-4 section-title-4-2 hf-el-title');
        ?>

            <section class="portfolio-area portfolio-4-bg pb-140 mb-115 fix p-relative ele-section">
                <?php if (!empty($hexa_shape_image)) : ?>
                    <div class="portfolio-4-main-bg-shape">
                        <img src="<?php echo esc_url($hexa_shape_image); ?>" alt="<?php echo esc_attr($hexa_shape_image_alt); ?>">
                    </div>
                <?php endif; ?>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="portfolio-4-wrapper">
                                <div class="portfolio-4 mt-20">
                                    <div class="section-wrapper mb-20">
                                        <?php if (!empty($settings['hexa_section_sub_title'])) : ?>
                                            <span class="hf-el-subtitle"><?php echo hexa_kses($settings['hexa_section_sub_title']); ?></span>
                                        <?php endif; ?>
                                        <?php
                                        if (!empty($settings['hexa_section_title'])) :
                                            printf(
                                                '<%1$s %2$s>%3$s</%1$s>',
                                                tag_escape($settings['hexa_section_title_tag']),
                                                $this->get_render_attribute_string('title_args'),
                                                hexa_kses($settings['hexa_section_title'])
                                            );
                                        endif;
                                        ?>
                                        <?php if (!empty($settings['hexa_section_description'])) : ?>
                                            <p class="hf-el-content"><?php echo hexa_kses($settings['hexa_section_description']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="portfolio-tab-4 mb-35">
                                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <?php foreach ($settings['tabs'] as $key => $item) : ?>
                                            <button class="nav-link hf-el-tab-title <?php echo $item['hexa_active_switcher'] ? 'active' : NULL; ?>" id="v-pills-<?php echo esc_attr($key + 1); ?>-tab" data-bs-toggle="pill" data-bs-target="#v-pills-<?php echo esc_attr($key + 1); ?>" type="button" role="tab" aria-controls="v-pills-<?php echo esc_attr($key + 1); ?>" aria-selected="<?php echo $item['hexa_active_switcher'] ? 'true' : 'false'; ?>"><?php echo hexa_kses($item['title']); ?></button>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="nav-tab-slider-4">
                                    <div class="hfnav-tab-4 p-relative d-none">
                                        <button class="prv-nav-tab">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" fill="none" viewBox="0 0 8 14">
                                                    <path fill-rule="evenodd" d="M7.707.293a1 1 0 0 1 0 1.414L2.414 7l5.293 5.293a1 1 0 0 1-1.414 1.414l-6-6a1 1 0 0 1 0-1.414l6-6a1 1 0 0 1 1.414 0z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </button>
                                        <button class="next-nav-tab">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" fill="none" viewBox="0 0 8 14">
                                                    <path fill-rule="evenodd" d="M.293 13.707a1 1 0 0 1 0-1.414L5.586 7 .293 1.707A1 1 0 1 1 1.707.293l6 6a1 1 0 0 1 0 1.414l-6 6a1 1 0 0 1-1.414 0z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="tab-content-4">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <?php foreach ($settings['tabs'] as $key => $item) : ?>
                                        <div class="tab-pane fade <?php echo $item['hexa_active_switcher'] ? 'show active' : NULL; ?>" id="v-pills-<?php echo esc_attr($key + 1); ?>" role="tabpanel" aria-labelledby="v-pills-<?php echo esc_attr($key + 1); ?>-tab">
                                            <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content($item['template'], true); ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

<?php endif;
    }
}
$widgets_manager->register(new Hexa_Advanced_Tab());
