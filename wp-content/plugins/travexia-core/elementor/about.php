<?php

namespace HexaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
use HexaCore\Elementor\Controls\Group_Control_HexaBGGradient;
use HexaCore\Elementor\Controls\Group_Control_HexaGradient;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Hexa Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Hexa_About extends Widget_Base
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
        return 'about';
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
        return __('About', 'hexacore');
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
                    // 'layout-2' => esc_html__('Layout 2', 'hexacore'),
                    // 'layout-3' => esc_html__('Layout 3', 'hexacore'),
                    // 'layout-4' => esc_html__('Layout 4', 'hexacore'),
                    // 'layout-5' => esc_html__('Layout 5', 'hexacore'),
                    // 'layout-6' => esc_html__('Layout 6', 'hexacore'),
                    // 'layout-7' => esc_html__('Layout 7', 'hexacore'),
                    // 'layout-8' => esc_html__('Layout 8', 'hexacore'),
                    // 'layout-9' => esc_html__('Layout 9', 'hexacore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // about content
        $this->start_controls_section(
            'section_about_content',
            [
                'label' => __('About Content', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'about_subtitle',
            [
                'label' => __('Subtitle', 'hexacore'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Banner subtitle', 'hexacore'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Banner title', 'hexacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __('Title HTML Tag', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h1',
            ]
        );

        $this->add_control(
            'desc',
            [
                'label' => __('Description', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => '10',
                'label_block' => true,
                'default' => __('Cum sociis natoque penatibus et magnis dis parturient montes.', 'hexacore'),
            ]
        );


        $this->add_control(
            'client_content_number',
            [
                'label' => __('Number', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('20', 'hexacore'),
            ]
        );

        $this->add_control(
            'client_content_title',
            [
                'label' => __('Title', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Our Happy Clients', 'hexacore'),
            ]
        );

        $this->end_controls_section();


        // button
        $this->start_controls_section(
            'hexa_button_section',
            [
                'label' => esc_html__('Button', 'hexacore'),
            ]
        );
        $this->add_control(
            'btn_text',
            [
                'label' => __('Button One', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Click here', 'hexacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'btn_link',
            [
                'label' => esc_html__('Link One', 'hexacore'),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'button_icon',
            [
                'label' => esc_html__('Icon', 'hexacore'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-smile',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->end_controls_section();


        // Features Sections
        $this->start_controls_section(
            'about_features_list_sec',
            [
                'label' => esc_html__('Features List', 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'hexa_design_layout' => ['layout-1', 'layout-2', 'layout-3', 'layout-4', 'layout-5', 'layout-6', 'layout-8', 'layout-9']
                ]
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __('Field condition', 'hexacore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'hexacore'),
                    // 'style_2' => __('Style 2', 'hexacore'),
                    // 'style_3' => __('Style 3', 'hexacore'),
                    // 'style_4' => __('Style 4', 'hexacore'),
                    // 'style_5' => __('Style 5', 'hexacore'),
                    // 'style_6' => __('Style 6', 'hexacore'),
                    // 'style_7' => __('Style 7', 'hexacore'),
                    // 'style_8' => __('Style 8', 'hexacore'),
                    // 'style_9' => __('Style 9', 'hexacore'),
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
                    ]
                ]
            );
        }

        $repeater->add_control(
            'about_features_title',
            [
                'label' => esc_html__('About List Title', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('See the action in live', 'hexacore'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2', 'style_3', 'style_4', 'style_6', 'style_8', 'style_9']
                ]
            ]
        );

        $repeater->add_control(
            'about_features_des',
            [
                'label' => esc_html__('Description', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Understand how your keyword/group is ranking specific cases.', 'hexacore'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_4', 'style_5', 'style_6', 'style_8', 'style_9']
                ]
            ]
        );

        $this->add_control(
            'about_features_list',
            [
                'label' => esc_html__('About List', 'hexacore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'about_features_title' => esc_html__('See the action in live', 'hexacore'),
                    ],
                    [
                        'about_features_title' => esc_html__('Intuitive dashboard', 'hexacore'),
                    ],
                ],
                'title_field' => '{{{ about_features_title }}}',
            ]
        );

        $this->end_controls_section();


        // _hexa_image
        $this->start_controls_section(
            '_hexa_image',
            [
                'label' => esc_html__('Image', 'hexacore'),
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

        $this->add_control(
            'hexa_image2',
            [
                'label' => esc_html__('Choose Image 2', 'hexacore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'hexa_design_layout' => ['layout-1', 'layout-3', 'layout-6', 'layout-7', 'layout-8']
                ]
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

    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->hexa_section_style_controls('about_section', 'Section - Style', '.hf-el-section');
        $this->hexa_basic_style_controls('section_subtitle', 'Section - Subtitle', '.hf-el-subtitle', ['layout-1', 'layout-2', 'layout-3', 'layout-4', 'layout-5', 'layout-6', 'layout-7', 'layout-8']);
        $this->hexa_basic_style_controls('section_title', 'Section - Title', '.hf-el-title', ['layout-1', 'layout-2', 'layout-3', 'layout-4', 'layout-5', 'layout-6', 'layout-7', 'layout-8']);
        $this->hexa_basic_style_controls('section_desc', 'Section - Description', '.hf-el-content', ['layout-1', 'layout-2', 'layout-3', 'layout-4', 'layout-5', 'layout-6', 'layout-7', 'layout-8']);
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

<?php if ($settings['hexa_design_layout'] == 'layout-2'):

            // thumbnail
            if (!empty($settings['hexa_image']['url'])) {
                $hexa_image = !empty($settings['hexa_image']['id']) ? wp_get_attachment_image_url($settings['hexa_image']['id'], $settings['hexa_image_size_size']) : $settings['hexa_image']['url'];
                $hexa_image_alt = get_post_meta($settings["hexa_image"]["id"], "_wp_attachment_image_alt", true);
            }
            if (!empty($settings['hexa_image2']['url'])) {
                $hexa_image2 = !empty($settings['hexa_image2']['id']) ? wp_get_attachment_image_url($settings['hexa_image2']['id'], $settings['hexa_image_size_size']) : $settings['hexa_image2']['url'];
                $hexa_image_alt2 = get_post_meta($settings["hexa_image2"]["id"], "_wp_attachment_image_alt", true);
            }
            if (!empty($settings['hexa_image3']['url'])) {
                $hexa_image3 = !empty($settings['hexa_image3']['id']) ? wp_get_attachment_image_url($settings['hexa_image3']['id'], $settings['hexa_image_size_size']) : $settings['hexa_image3']['url'];
                $hexa_image_alt3 = get_post_meta($settings["hexa_image3"]["id"], "_wp_attachment_image_alt", true);
            }

            // shape image
            if (!empty($settings['hexa_shape_image_1']['url'])) {
                $hexa_shape_image = !empty($settings['hexa_shape_image_1']['id']) ? wp_get_attachment_image_url($settings['hexa_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['hexa_shape_image_1']['url'];
                $hexa_shape_image_alt = get_post_meta($settings["hexa_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
            }
            if (!empty($settings['hexa_shape_image_2']['url'])) {
                $hexa_shape_image2 = !empty($settings['hexa_shape_image_2']['id']) ? wp_get_attachment_image_url($settings['hexa_shape_image_2']['id'], $settings['shape_image_size_size']) : $settings['hexa_shape_image_2']['url'];
                $hexa_shape_image_alt2 = get_post_meta($settings["hexa_shape_image_2"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->add_render_attribute('title_args', 'class', 'hfsection-title-white-2 mb-50 hf-el-title');
            ?>

<section
    class="need-area hf-el-section <?php echo $settings['hexa_light_switcher'] ? 'need-inner' : 'need-spacing theme-bg-4'; ?>  pb-200">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-lg-6">
                <div class="need-thumb p-relative mb-40">
                    <?php if (!empty($hexa_image3)): ?>
                    <img src="<?php echo esc_url($hexa_image3); ?>" alt="<?php echo esc_attr($hexa_image_alt3); ?>">
                    <?php endif; ?>
                    <div class="need-shape">
                        <?php if (!empty($hexa_image)): ?>
                        <div class="need-shape-one d-none d-sm-block">
                            <img src="<?php echo esc_url($hexa_image); ?>"
                                alt="<?php echo esc_attr($hexa_image_alt); ?>">
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($hexa_image2)): ?>
                        <div class="need-shape-two">
                            <img src="<?php echo esc_url($hexa_image2); ?>"
                                alt="<?php echo esc_attr($hexa_image_alt2); ?>">
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($hexa_shape_image2)): ?>
                        <div class="need-shape-three">
                            <img src="<?php echo esc_url($hexa_shape_image2); ?>"
                                alt="<?php echo esc_attr($hexa_shape_image_alt2); ?>">
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($hexa_shape_image)): ?>
                        <div class="need-shape-four d-none d-md-block">
                            <img src="<?php echo esc_url($hexa_shape_image); ?>"
                                alt="<?php echo esc_attr($hexa_shape_image_alt); ?>">
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="need-wrap pl-70">
                    <div class="hfsection-wrapper">
                        <?php if (!empty($settings['hexa_about_sub_title'])): ?>
                        <div class="hfbanner__sub-title mb-15">
                            <span
                                class="text-white hf-el-subtitle"><?php echo hexa_kses($settings['hexa_about_sub_title']); ?></span>
                            <i>
                                <svg width="130" height="42" viewBox="0 0 130 42" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <rect y="0.941895" width="130" height="40.9551" fill="url(#pattern6)"
                                        fill-opacity="0.08" />
                                    <defs>
                                        <pattern id="pattern6" patternContentUnits="objectBoundingBox" width="1"
                                            height="1">
                                            <use xlink:href="#image0_868_3547"
                                                transform="translate(-0.0587762 0.0123052) scale(0.00611916 0.0198269)" />
                                        </pattern>
                                        <image id="image0_868_3547" width="180" height="50"
                                            xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAALQAAAAyCAYAAAD1JPH3AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDcuMS1jMDAwIDc5LmVkYTJiM2ZhYywgMjAyMS8xMS8xNy0xNzoyMzoxOSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6RUMyMzkwQTczMTM3MTFFRDg3NUZBOUZCRDk1MThFMTMiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6RUMyMzkwQTYzMTM3MTFFRDg3NUZBOUZCRDk1MThFMTMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIDIzLjEgKFdpbmRvd3MpIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6MjFBQkIwMjIzMTA2MTFFREEzRkNBQzVFOTRFRTVERTgiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6MjFBQkIwMjMzMTA2MTFFREEzRkNBQzVFOTRFRTVERTgiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz5lgZ3iAAAB2ElEQVR42uzd7U3CUBiA0Wr4DxvQDWQE4gS6gSO6ibhB2aBMoCG5ja83pVRaSSnnJE2/MII+t7386sPz21dxQ1ZpKdNSpPUynItL/nNd6rSc2t6n/Sot+TYTsJhgrJsU6TqLt7zS779EE3ad1vuwvwuDg5kF3QQao92E47fq3ICrQ/RN8LsQPBMPOob7lEV8j5o7z6Yj+Cbwzyx+U5orB32MdCvcwcFv0/ZLx5SmubrHAVCZ0lwW9CrEu07rcsC8k/GmNPk8vg7hx2P13K/4fYP+6LhdcjvR5wMgrmP0h5bXxdecmjadu1N0ffFuOxc/zzKcP65fhwQt5nkOgGJu08NH/1cEDYIGQYOgETQIGgQNggZBI2gQNAgaBA2CRtAgaBA0CBoEjaBB0CBoEDQIGkGDoEHQIGgQNIIGQYOgQdAgaAQNE7aY+Ptre7JSn6ct9VWe2UfQvx4XFuPbZ+fz1/5HsGPEHh831mw359bhWH6OCQf9Xvw8v67OQmyLcg6GfJ4Yd769Dvviv+yuXQ0N+tXf8aKpUtUz/rJlvWw5Pmf5RfIQ7vJV0fO55wvtTSL+3R+mQasTd4BlyzRpdeWBEKeL+aC+yt1d0PczDSpH/PJbjfi+RvUtwADssXzgKiX3gwAAAABJRU5ErkJggg==" />
                                    </defs>
                                </svg>
                            </i>
                        </div>
                        <?php endif; ?>

                        <?php
                                    if (!empty($settings['hexa_about_title'])):
                                        printf(
                                            '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['hexa_about_title_tag']),
                                            $this->get_render_attribute_string('title_args'),
                                            hexa_kses($settings['hexa_about_title'])
                                        );
                                    endif;
                                    ?>
                        <?php if (!empty($settings['hexa_about_description'])): ?>
                        <p class="text-white hf-el-content">
                            <?php echo hexa_kses($settings['hexa_about_description']); ?>
                        </p>
                        <?php endif; ?>
                    </div>
                    <div class="need-wrapper">


                        <?php foreach ($settings['about_features_list'] as $key => $item):
                                        // Link
                                        if ('2' == $item['hexa_about_link_type']) {
                                            $link = get_permalink($item['hexa_about_page_link']);
                                            $target = '_self';
                                            $rel = 'nofollow';
                                        } else {
                                            $link = !empty($item['hexa_about_link']['url']) ? $item['hexa_about_link']['url'] : '';
                                            $target = !empty($item['hexa_about_link']['is_external']) ? '_blank' : '';
                                            $rel = !empty($item['hexa_about_link']['nofollow']) ? 'nofollow' : '';
                                        }
                                        ?>
                        <div class="need-item d-flex mb-60">
                            <div class="need-icon">

                                <?php if ($item['hexa_box_icon_type'] == 'icon'): ?>
                                <?php if (!empty($item['hexa_box_icon']) || !empty($item['hexa_box_selected_icon']['value'])): ?>
                                <i class="hf-el-rep-icon">
                                    <?php hexa_render_icon($item, 'hexa_box_icon', 'hexa_box_selected_icon'); ?>
                                </i>
                                <?php endif; ?>
                                <?php elseif ($item['hexa_box_icon_type'] == 'image'): ?>
                                <?php if (!empty($item['hexa_box_icon_image']['url'])): ?>
                                <i class="hf-el-rep-icon">
                                    <img src="<?php echo $item['hexa_box_icon_image']['url']; ?>"
                                        alt="<?php echo get_post_meta(attachment_url_to_postid($item['hexa_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                </i>
                                <?php endif; ?>
                                <?php else: ?>
                                <?php if (!empty($item['hexa_box_icon_svg'])): ?>
                                <i class="hf-el-rep-icon">
                                    <?php echo $item['hexa_box_icon_svg']; ?>
                                </i>
                                <?php endif; ?>
                                <?php endif; ?>

                            </div>
                            <div class="need-content">
                                <?php if (!empty($item['about_features_title'])): ?>
                                <h4 class="need-title mb-15 hf-el-rep-title">
                                    <?php echo hexa_kses($item['about_features_title']); ?>
                                </h4>
                                <?php endif; ?>
                                <?php if (!empty($item['about_features_des'])): ?>
                                <p class="hf-el-rep-des"><?php echo hexa_kses($item['about_features_des']); ?></p>
                                <?php endif; ?>
                                <?php if (!empty($item['about_features_btn_text'])): ?>
                                <a class="hf-el-rep-btn"
                                    href="<?php echo esc_url($link); ?>"><?php echo hexa_kses($item['about_features_btn_text']); ?>
                                    <i class="fa-regular fa-angle-right"></i></a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php elseif ($settings['hexa_design_layout'] == 'layout-3'):


            // thumbnail
            if (!empty($settings['hexa_image']['url'])) {
                $hexa_image = !empty($settings['hexa_image']['id']) ? wp_get_attachment_image_url($settings['hexa_image']['id'], $settings['hexa_image_size_size']) : $settings['hexa_image']['url'];
                $hexa_image_alt = get_post_meta($settings["hexa_image"]["id"], "_wp_attachment_image_alt", true);
            }
            if (!empty($settings['hexa_image2']['url'])) {
                $hexa_image2 = !empty($settings['hexa_image2']['id']) ? wp_get_attachment_image_url($settings['hexa_image2']['id'], $settings['hexa_image_size_size']) : $settings['hexa_image2']['url'];
                $hexa_image_alt2 = get_post_meta($settings["hexa_image2"]["id"], "_wp_attachment_image_alt", true);
            }
            if (!empty($settings['hexa_image3']['url'])) {
                $hexa_image3 = !empty($settings['hexa_image3']['id']) ? wp_get_attachment_image_url($settings['hexa_image3']['id'], $settings['hexa_image_size_size']) : $settings['hexa_image3']['url'];
                $hexa_image_alt3 = get_post_meta($settings["hexa_image3"]["id"], "_wp_attachment_image_alt", true);
            }

            // shape image
            if (!empty($settings['hexa_shape_image_1']['url'])) {
                $hexa_shape_image = !empty($settings['hexa_shape_image_1']['id']) ? wp_get_attachment_image_url($settings['hexa_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['hexa_shape_image_1']['url'];
                $hexa_shape_image_alt = get_post_meta($settings["hexa_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
            }
            if (!empty($settings['hexa_shape_image_2']['url'])) {
                $hexa_shape_image2 = !empty($settings['hexa_shape_image_2']['id']) ? wp_get_attachment_image_url($settings['hexa_shape_image_2']['id'], $settings['shape_image_size_size']) : $settings['hexa_shape_image_2']['url'];
                $hexa_shape_image_alt2 = get_post_meta($settings["hexa_shape_image_2"]["id"], "_wp_attachment_image_alt", true);
            }

            // Link
            if ('2' == $settings['hexa_about_btn_link_type']) {
                $this->add_render_attribute('hf-button-arg', 'href', get_permalink($settings['hexa_about_btn_page_link']));
                $this->add_render_attribute('hf-button-arg', 'target', '_self');
                $this->add_render_attribute('hf-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('hf-button-arg', 'class', 'radient-btn hf-el-btn');
            } else {
                if (!empty($settings['hexa_about_btn_link']['url'])) {
                    $this->add_link_attributes('hf-button-arg', $settings['hexa_about_btn_link']);
                    $this->add_render_attribute('hf-button-arg', 'class', 'radient-btn hf-el-btn');
                }
            }

            $this->add_render_attribute('title_args', 'class', 'hfsection-title-white-2 mb-20 hf-el-title');
            ?>

<section class="keyword-area theme-bg-4 pb-40 hf-el-section">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-lg-6">
                <div class="keyword-content pb-100 ">
                    <div class="hfsection-wrapper">
                        <?php if (!empty($settings['hexa_about_sub_title'])): ?>
                        <div class="hfbanner__sub-title mb-15">
                            <span
                                class="text-white hf-el-subtitle"><?php echo hexa_kses($settings['hexa_about_sub_title']); ?></span>
                            <i>
                                <svg width="130" height="42" viewBox="0 0 130 42" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <rect y="0.941895" width="130" height="40.9551" fill="url(#pattern6)"
                                        fill-opacity="0.08" />
                                    <defs>
                                        <pattern id="pattern6" patternContentUnits="objectBoundingBox" width="1"
                                            height="1">
                                            <use xlink:href="#image0_868_3547"
                                                transform="translate(-0.0587762 0.0123052) scale(0.00611916 0.0198269)" />
                                        </pattern>
                                        <image id="image0_868_3547" width="180" height="50"
                                            xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAALQAAAAyCAYAAAD1JPH3AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDcuMS1jMDAwIDc5LmVkYTJiM2ZhYywgMjAyMS8xMS8xNy0xNzoyMzoxOSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6RUMyMzkwQTczMTM3MTFFRDg3NUZBOUZCRDk1MThFMTMiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6RUMyMzkwQTYzMTM3MTFFRDg3NUZBOUZCRDk1MThFMTMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIDIzLjEgKFdpbmRvd3MpIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6MjFBQkIwMjIzMTA2MTFFREEzRkNBQzVFOTRFRTVERTgiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6MjFBQkIwMjMzMTA2MTFFREEzRkNBQzVFOTRFRTVERTgiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz5lgZ3iAAAB2ElEQVR42uzd7U3CUBiA0Wr4DxvQDWQE4gS6gSO6ibhB2aBMoCG5ja83pVRaSSnnJE2/MII+t7386sPz21dxQ1ZpKdNSpPUynItL/nNd6rSc2t6n/Sot+TYTsJhgrJsU6TqLt7zS779EE3ad1vuwvwuDg5kF3QQao92E47fq3ICrQ/RN8LsQPBMPOob7lEV8j5o7z6Yj+Cbwzyx+U5orB32MdCvcwcFv0/ZLx5SmubrHAVCZ0lwW9CrEu07rcsC8k/GmNPk8vg7hx2P13K/4fYP+6LhdcjvR5wMgrmP0h5bXxdecmjadu1N0ffFuOxc/zzKcP65fhwQt5nkOgGJu08NH/1cEDYIGQYOgETQIGgQNggZBI2gQNAgaBA2CRtAgaBA0CBoEjaBB0CBoEDQIGkGDoEHQIGgQNIIGQYOgQdAgaAQNE7aY+Ptre7JSn6ct9VWe2UfQvx4XFuPbZ+fz1/5HsGPEHh831mw359bhWH6OCQf9Xvw8v67OQmyLcg6GfJ4Yd769Dvviv+yuXQ0N+tXf8aKpUtUz/rJlvWw5Pmf5RfIQ7vJV0fO55wvtTSL+3R+mQasTd4BlyzRpdeWBEKeL+aC+yt1d0PczDSpH/PJbjfi+RvUtwADssXzgKiX3gwAAAABJRU5ErkJggg==" />
                                    </defs>
                                </svg>
                            </i>
                        </div>
                        <?php endif; ?>

                        <?php
                                    if (!empty($settings['hexa_about_title'])):
                                        printf(
                                            '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['hexa_about_title_tag']),
                                            $this->get_render_attribute_string('title_args'),
                                            hexa_kses($settings['hexa_about_title'])
                                        );
                                    endif;
                                    ?>
                    </div>
                    <?php if (!empty($settings['hexa_about_description'])): ?>
                    <p class="text-white hf-el-content"><?php echo hexa_kses($settings['hexa_about_description']); ?>
                    </p>
                    <?php endif; ?>
                    <ul class="keyword-list mb-40">

                        <?php foreach ($settings['about_features_list'] as $key => $item): ?>
                        <li class="hf-el-rep-icon"><?php if ($item['hexa_box_icon_type'] == 'icon'): ?>
                            <?php if (!empty($item['hexa_box_icon']) || !empty($item['hexa_box_selected_icon']['value'])): ?>
                            <?php hexa_render_icon($item, 'hexa_box_icon', 'hexa_box_selected_icon'); ?>
                            <?php endif; ?>
                            <?php elseif ($item['hexa_box_icon_type'] == 'image'): ?>
                            <?php if (!empty($item['hexa_box_icon_image']['url'])): ?>
                            <img src="<?php echo $item['hexa_box_icon_image']['url']; ?>"
                                alt="<?php echo get_post_meta(attachment_url_to_postid($item['hexa_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                            <?php endif; ?>
                            <?php else: ?>
                            <?php if (!empty($item['hexa_box_icon_svg'])): ?>
                            <?php echo $item['hexa_box_icon_svg']; ?>
                            <?php endif; ?>
                            <?php endif; ?>
                            <span
                                class="hf-el-rep-title"><?php echo $item['about_features_title'] ? hexa_kses($item['about_features_title']) : NULL; ?></span>
                        </li>
                        <?php endforeach; ?>

                    </ul>
                    <?php if (!empty($settings['hexa_about_btn_text'])): ?>
                    <div class="keyword-btn">
                        <a
                            <?php echo $this->get_render_attribute_string('hf-button-arg'); ?>><?php echo hexa_kses($settings['hexa_about_btn_text']); ?></a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="keyword-thumb p-relative pb-115">
                    <?php if (!empty($hexa_image3)): ?>
                    <img src="<?php echo esc_url($hexa_image3); ?>" alt="<?php echo esc_attr($hexa_image_alt3); ?>">
                    <?php endif; ?>
                    <div class="need-shape">
                        <?php if (!empty($hexa_image)): ?>
                        <div class="keyword-shape-one d-none d-md-block">
                            <img src="<?php echo esc_url($hexa_image); ?>"
                                alt="<?php echo esc_attr($hexa_image_alt); ?>">
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($hexa_shape_image2)): ?>
                        <div class="keyword-shape-two">
                            <img src="<?php echo esc_url($hexa_shape_image2); ?>"
                                alt="<?php echo esc_attr($hexa_shape_image_alt2); ?>">
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($hexa_image2)): ?>
                        <div class="keyword-shape-three">
                            <img src="<?php echo esc_url($hexa_image2); ?>"
                                alt="<?php echo esc_attr($hexa_image_alt2); ?>">
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($hexa_shape_image)): ?>
                        <div class="keyword-shape-four">
                            <img src="<?php echo esc_url($hexa_shape_image); ?>"
                                alt="<?php echo esc_attr($hexa_shape_image_alt); ?>">
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php elseif ($settings['hexa_design_layout'] == 'layout-4'):
            // thumbnail
            if (!empty($settings['hexa_image']['url'])) {
                $hexa_image = !empty($settings['hexa_image']['id']) ? wp_get_attachment_image_url($settings['hexa_image']['id'], $settings['hexa_image_size_size']) : $settings['hexa_image']['url'];
                $hexa_image_alt = get_post_meta($settings["hexa_image"]["id"], "_wp_attachment_image_alt", true);
            }

            // shape image
            if (!empty($settings['hexa_shape_image_1']['url'])) {
                $hexa_shape_image = !empty($settings['hexa_shape_image_1']['id']) ? wp_get_attachment_image_url($settings['hexa_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['hexa_shape_image_1']['url'];
                $hexa_shape_image_alt = get_post_meta($settings["hexa_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
            }
            if (!empty($settings['hexa_shape_image_2']['url'])) {
                $hexa_shape_image2 = !empty($settings['hexa_shape_image_2']['id']) ? wp_get_attachment_image_url($settings['hexa_shape_image_2']['id'], $settings['shape_image_size_size']) : $settings['hexa_shape_image_2']['url'];
                $hexa_shape_image_alt2 = get_post_meta($settings["hexa_shape_image_2"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->add_render_attribute('title_args', 'class', 'section-title-4 section-title-4-2 hf-el-title');
            ?>

<section class="feature-area pt-40 pb-80 hf-el-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="hfchoose-thumb p-relative mb-50">
                    <?php if (!empty($hexa_image)): ?>
                    <img class="hfchoose-border-anim" src="<?php echo esc_url($hexa_image); ?>"
                        alt="<?php echo esc_attr($hexa_image_alt); ?>">
                    <?php endif; ?>
                    <div class="hfchoose-shape d-none d-lg-block">
                        <?php if (!empty($hexa_shape_image)): ?>
                        <div class="hfchoose-shape-one d-none d-md-block">
                            <img src="<?php echo esc_url($hexa_shape_image); ?>"
                                alt="<?php echo esc_attr($hexa_shape_image_alt); ?>">
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($hexa_shape_image2)): ?>
                        <div class="hfchoose-shape-two">
                            <img src="<?php echo esc_url($hexa_shape_image2); ?>"
                                alt="<?php echo esc_attr($hexa_shape_image_alt2); ?>">
                        </div>
                        <?php endif; ?>
                        <div class="hfchoose-shape-three">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/choose-shape-3.png"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="feature-content-4 pl-70">
                    <div class="section-wrapper mb-40">
                        <?php if (!empty($settings['hexa_about_sub_title'])): ?>
                        <span class="hf-el-subtitle"><?php echo hexa_kses($settings['hexa_about_sub_title']); ?></span>
                        <?php endif; ?>
                        <?php
                                    if (!empty($settings['hexa_about_title'])):
                                        printf(
                                            '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['hexa_about_title_tag']),
                                            $this->get_render_attribute_string('title_args'),
                                            hexa_kses($settings['hexa_about_title'])
                                        );
                                    endif;
                                    ?>
                        <?php if (!empty($settings['hexa_about_description'])): ?>
                        <p class="hf-el-content"><?php echo hexa_kses($settings['hexa_about_description']); ?></p>
                        <?php endif; ?>
                    </div>
                    <ul class="feature-list-4">

                        <?php foreach ($settings['about_features_list'] as $key => $item): ?>
                        <li>
                            <div class="feature-list-4-item p-relative d-flex <?php echo $key == 1 ? 'pl-100' : NULL;
                                                echo $key == 2 ? 'pl-30' : NULL; ?>">
                                <div class="feature-list-4-icon ">
                                    <div class="feature-list-bg p-relative">
                                        <?php if ($item['hexa_box_icon_type'] == 'icon'): ?>
                                        <?php if (!empty($item['hexa_box_icon']) || !empty($item['hexa_box_selected_icon']['value'])): ?>
                                        <i class="hf-el-rep-icon">
                                            <?php hexa_render_icon($item, 'hexa_box_icon', 'hexa_box_selected_icon'); ?>
                                        </i>
                                        <?php endif; ?>
                                        <?php elseif ($item['hexa_box_icon_type'] == 'image'): ?>
                                        <?php if (!empty($item['hexa_box_icon_image']['url'])): ?>
                                        <i class="hf-el-rep-icon">
                                            <img src="<?php echo $item['hexa_box_icon_image']['url']; ?>"
                                                alt="<?php echo get_post_meta(attachment_url_to_postid($item['hexa_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                        </i>
                                        <?php endif; ?>
                                        <?php else: ?>
                                        <?php if (!empty($item['hexa_box_icon_svg'])): ?>
                                        <i class="hf-el-rep-icon">
                                            <?php echo $item['hexa_box_icon_svg']; ?>
                                        </i>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <b><?php echo $key < 10 ? '0' . esc_html($key + 1) : $key + 1; ?></b>
                                        <span class="feature-bg-border-1"></span>
                                        <span class="feature-bg-border-2"></span>
                                        <span class="feature-bg-border-3"></span>
                                        <span class="feature-bg-border-4"></span>
                                    </div>
                                </div>
                                <div class="feature-list-4-content">
                                    <?php if (!empty($item['about_features_title'])): ?>
                                    <h4 class="title hf-el-rep-title">
                                        <?php echo hexa_kses($item['about_features_title']); ?>
                                    </h4>
                                    <?php endif; ?>
                                    <?php if (!empty($item['about_features_des'])): ?>
                                    <p class="hf-el-rep-des"><?php echo hexa_kses($item['about_features_des']); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="feature-4-shape-<?php echo esc_attr($key + 1); ?> d-none d-md-block">
                                    <?php if ($key == 0): ?>
                                    <svg class="line-dash-path" width="38" height="122" viewBox="0 0 38 122" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.279297 1C41.9846 20.0005 55.1988 87.9525 2.74393 121.294"
                                            stroke="#A7ACB3" stroke-dasharray="4 4" />
                                    </svg>
                                    <?php elseif ($key == 1): ?>
                                    <svg class="line-dash-path" width="42" height="122" viewBox="0 0 42 122" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M41.3076 1.22192C-1.33493 18.0137 -18.0874 85.181 32.5507 121.222"
                                            stroke="#A7ACB3" stroke-dasharray="4 4"></path>
                                    </svg>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<?php elseif ($settings['hexa_design_layout'] == 'layout-5'):

            // thumbnail
            if (!empty($settings['hexa_image']['url'])) {
                $hexa_image = !empty($settings['hexa_image']['id']) ? wp_get_attachment_image_url($settings['hexa_image']['id'], $settings['hexa_image_size_size']) : $settings['hexa_image']['url'];
                $hexa_image_alt = get_post_meta($settings["hexa_image"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->add_render_attribute('title_args', 'class', 'title hf-el-title');
            ?>

<section class="about-area pb-60 hf-el-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="about-5">
                    <div class="about-5-section mb-70">
                        <?php if (!empty($settings['hexa_about_sub_title'])): ?>
                        <span
                            class="sub-title hf-el-subtitle"><?php echo hexa_kses($settings['hexa_about_sub_title']); ?></span>
                        <?php endif; ?>
                        <?php
                                    if (!empty($settings['hexa_about_title'])):
                                        printf(
                                            '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['hexa_about_title_tag']),
                                            $this->get_render_attribute_string('title_args'),
                                            hexa_kses($settings['hexa_about_title'])
                                        );
                                    endif;
                                    ?>
                        <?php if (!empty($settings['hexa_about_description'])): ?>
                        <p class="hf-el-content"><?php echo hexa_kses($settings['hexa_about_description']); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="about-5-content">
                        <div class="row">
                            <?php foreach ($settings['about_features_list'] as $key => $item): ?>
                            <div class="col-lg-6 col-md-6">
                                <div class="about-5-item">
                                    <div class="about-5-item-title mb-20">
                                        <?php if ($item['hexa_box_icon_type'] == 'icon'): ?>
                                        <?php if (!empty($item['hexa_box_icon']) || !empty($item['hexa_box_selected_icon']['value'])): ?>
                                        <span class="hf-el-rep-icon">
                                            <?php hexa_render_icon($item, 'hexa_box_icon', 'hexa_box_selected_icon'); ?>
                                        </span>
                                        <?php endif; ?>
                                        <?php elseif ($item['hexa_box_icon_type'] == 'image'): ?>
                                        <?php if (!empty($item['hexa_box_icon_image']['url'])): ?>
                                        <span class="hf-el-rep-icon">
                                            <img src="<?php echo $item['hexa_box_icon_image']['url']; ?>"
                                                alt="<?php echo get_post_meta(attachment_url_to_postid($item['hexa_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                        </span>
                                        <?php endif; ?>
                                        <?php else: ?>
                                        <?php if (!empty($item['hexa_box_icon_svg'])): ?>
                                        <span class="hf-el-rep-icon">
                                            <?php echo $item['hexa_box_icon_svg']; ?>
                                        </span>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!empty($item['about_features_des'])): ?>
                                    <div class="about-5-item-text">
                                        <p class="hf-el-rep-des"><?php echo hexa_kses($item['about_features_des']); ?>
                                        </p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <?php if (!empty($hexa_image)): ?>
                <div class="about-5-thumb p-relative">
                    <img class="hfchoose-border-anim" src="<?php echo esc_url($hexa_image); ?>"
                        alt="<?php echo esc_attr($hexa_image_alt); ?>">
                    <?php if (!empty($settings['about_vid_url'])): ?>
                    <a href="<?php echo esc_url($settings['about_vid_url']); ?>" class="popup-video">
                        <div class="about-5-shape">
                            <div class="about-5-shape-one">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/video-blue.png"
                                    alt="">
                            </div>
                            <div class="about-5-shape-two">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/video-white.png"
                                    alt="">
                            </div>
                            <div class="about-5-video-icon hf-el-play">
                                <i class="fa-solid fa-play"></i>
                            </div>
                        </div>
                    </a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php elseif ($settings['hexa_design_layout'] == 'layout-6'):
            // thumbnail
            if (!empty($settings['hexa_image']['url'])) {
                $hexa_image = !empty($settings['hexa_image']['id']) ? wp_get_attachment_image_url($settings['hexa_image']['id'], $settings['hexa_image_size_size']) : $settings['hexa_image']['url'];
                $hexa_image_alt = get_post_meta($settings["hexa_image"]["id"], "_wp_attachment_image_alt", true);
            }
            if (!empty($settings['hexa_image2']['url'])) {
                $hexa_image2 = !empty($settings['hexa_image2']['id']) ? wp_get_attachment_image_url($settings['hexa_image2']['id'], $settings['hexa_image_size_size']) : $settings['hexa_image2']['url'];
                $hexa_image_alt2 = get_post_meta($settings["hexa_image2"]["id"], "_wp_attachment_image_alt", true);
            }

            // shape image
            if (!empty($settings['hexa_shape_image_1']['url'])) {
                $hexa_shape_image = !empty($settings['hexa_shape_image_1']['id']) ? wp_get_attachment_image_url($settings['hexa_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['hexa_shape_image_1']['url'];
                $hexa_shape_image_alt = get_post_meta($settings["hexa_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
            }
            if (!empty($settings['hexa_shape_image_2']['url'])) {
                $hexa_shape_image2 = !empty($settings['hexa_shape_image_2']['id']) ? wp_get_attachment_image_url($settings['hexa_shape_image_2']['id'], $settings['shape_image_size_size']) : $settings['hexa_shape_image_2']['url'];
                $hexa_shape_image_alt2 = get_post_meta($settings["hexa_shape_image_2"]["id"], "_wp_attachment_image_alt", true);
            }

            // Link
            if ('2' == $settings['hexa_about_btn_link_type']) {
                $this->add_render_attribute('hf-button-arg', 'href', get_permalink($settings['hexa_about_btn_page_link']));
                $this->add_render_attribute('hf-button-arg', 'target', '_self');
                $this->add_render_attribute('hf-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('hf-button-arg', 'class', 'light-blue-btn hf-el-btn');
            } else {
                if (!empty($settings['hexa_about_btn_link']['url'])) {
                    $this->add_link_attributes('hf-button-arg', $settings['hexa_about_btn_link']);
                    $this->add_render_attribute('hf-button-arg', 'class', 'light-blue-btn hf-el-btn');
                }
            }


            $this->add_render_attribute('title_args', 'class', 'section-3-title hf-el-title');
            ?>

<div class="feature-5 pb-100 hf-el-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="seo-5-thumb p-relative mb-40">
                    <?php if (!empty($hexa_image)): ?>
                    <div class="seo-5-main-bg">
                        <img src="<?php echo esc_url($hexa_image); ?>" alt="<?php echo esc_attr($hexa_image_alt); ?>">
                    </div>
                    <?php endif; ?>
                    <div class="seo-5-shape d-none d-md-block">
                        <?php if (!empty($hexa_image2)): ?>
                        <div class="seo-5-shape-one" data-parallax='{"x": -100, "smoothness": 20}'>
                            <img src="<?php echo esc_url($hexa_image2); ?>"
                                alt="<?php echo esc_attr($hexa_image_alt2); ?>">
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($hexa_shape_image2)): ?>
                        <div class="seo-5-shape-two" data-parallax='{"y": -80, "smoothness": 20}'>
                            <img src="<?php echo esc_url($hexa_shape_image2); ?>"
                                alt="<?php echo esc_attr($hexa_shape_image_alt2); ?>">
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($settings['hexa_shape_switch'])): ?>
                        <div class="seo-5-shape-three">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/seo-5-shape-3.png"
                                alt="">
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($hexa_shape_image)): ?>
                        <div class="seo-5-shape-four" data-parallax='{"x": -50, "smoothness": 20}'>
                            <img src="<?php echo esc_url($hexa_shape_image); ?>"
                                alt="<?php echo esc_attr($hexa_shape_image_alt); ?>">
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="seo-5 mb-40">
                    <div class="section-3 mb-40">


                        <?php if (!empty($settings['hexa_about_sub_title'])): ?>
                        <span
                            class="section-3-sub-title hf-el-subtitle"><?php echo hexa_kses($settings['hexa_about_sub_title']); ?></span>
                        <?php endif; ?>
                        <?php
                                    if (!empty($settings['hexa_about_title'])):
                                        printf(
                                            '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['hexa_about_title_tag']),
                                            $this->get_render_attribute_string('title_args'),
                                            hexa_kses($settings['hexa_about_title'])
                                        );
                                    endif;
                                    ?>
                        <?php if (!empty($settings['hexa_about_description'])): ?>
                        <p class="hf-el-content"><?php echo hexa_kses($settings['hexa_about_description']); ?></p>
                        <?php endif; ?>

                    </div>
                    <ul class="seo-5-list mb-50">

                        <?php foreach ($settings['about_features_list'] as $key => $item): ?>
                        <li>
                            <div class="seo-5-list-item d-flex">

                                <?php if ($item['hexa_box_icon_type'] == 'icon'): ?>
                                <?php if (!empty($item['hexa_box_icon']) || !empty($item['hexa_box_selected_icon']['value'])): ?>
                                <div class="seo-5-list-icon hf-el-rep-icon">
                                    <?php hexa_render_icon($item, 'hexa_box_icon', 'hexa_box_selected_icon'); ?>
                                </div>
                                <?php endif; ?>
                                <?php elseif ($item['hexa_box_icon_type'] == 'image'): ?>
                                <?php if (!empty($item['hexa_box_icon_image']['url'])): ?>
                                <div class="seo-5-list-icon hf-el-rep-icon">
                                    <img src="<?php echo $item['hexa_box_icon_image']['url']; ?>"
                                        alt="<?php echo get_post_meta(attachment_url_to_postid($item['hexa_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                </div>
                                <?php endif; ?>
                                <?php else: ?>
                                <?php if (!empty($item['hexa_box_icon_svg'])): ?>
                                <div class="seo-5-list-icon hf-el-rep-icon">
                                    <?php echo $item['hexa_box_icon_svg']; ?>
                                </div>
                                <?php endif; ?>
                                <?php endif; ?>

                                <div class="seo-5-list-text">
                                    <?php if (!empty($item['about_features_title'])): ?>
                                    <h4 class="title hf-el-rep-title">
                                        <?php echo hexa_kses($item['about_features_title']); ?>
                                    </h4>
                                    <?php endif; ?>
                                    <?php if (!empty($item['about_features_des'])): ?>
                                    <p class="hf-el-rep-des"><?php echo hexa_kses($item['about_features_des']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; ?>

                    </ul>

                    <?php if (!empty($settings['hexa_about_btn_text'])): ?>
                    <div class="seo-5-btn light-blue-border">
                        <a
                            <?php echo $this->get_render_attribute_string('hf-button-arg'); ?>><?php echo hexa_kses($settings['hexa_about_btn_text']); ?></a>
                    </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php elseif ($settings['hexa_design_layout'] == 'layout-7'):

            // thumbnail
            if (!empty($settings['hexa_image']['url'])) {
                $hexa_image = !empty($settings['hexa_image']['id']) ? wp_get_attachment_image_url($settings['hexa_image']['id'], $settings['hexa_image_size_size']) : $settings['hexa_image']['url'];
                $hexa_image_alt = get_post_meta($settings["hexa_image"]["id"], "_wp_attachment_image_alt", true);
            }
            if (!empty($settings['hexa_image2']['url'])) {
                $hexa_image2 = !empty($settings['hexa_image2']['id']) ? wp_get_attachment_image_url($settings['hexa_image2']['id'], $settings['hexa_image_size_size']) : $settings['hexa_image2']['url'];
                $hexa_image_alt2 = get_post_meta($settings["hexa_image2"]["id"], "_wp_attachment_image_alt", true);
            }

            // shape image
            if (!empty($settings['hexa_shape_image_1']['url'])) {
                $hexa_shape_image = !empty($settings['hexa_shape_image_1']['id']) ? wp_get_attachment_image_url($settings['hexa_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['hexa_shape_image_1']['url'];
                $hexa_shape_image_alt = get_post_meta($settings["hexa_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
            }
            if (!empty($settings['hexa_shape_image_2']['url'])) {
                $hexa_shape_image2 = !empty($settings['hexa_shape_image_2']['id']) ? wp_get_attachment_image_url($settings['hexa_shape_image_2']['id'], $settings['shape_image_size_size']) : $settings['hexa_shape_image_2']['url'];
                $hexa_shape_image_alt2 = get_post_meta($settings["hexa_shape_image_2"]["id"], "_wp_attachment_image_alt", true);
            }

            // Link
            if ('2' == $settings['hexa_about_btn_link_type']) {
                $this->add_render_attribute('hf-button-arg', 'href', get_permalink($settings['hexa_about_btn_page_link']));
                $this->add_render_attribute('hf-button-arg', 'target', '_self');
                $this->add_render_attribute('hf-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('hf-button-arg', 'class', 'hf-btn hf-el-btn');
            } else {
                if (!empty($settings['hexa_about_btn_link']['url'])) {
                    $this->add_link_attributes('hf-button-arg', $settings['hexa_about_btn_link']);
                    $this->add_render_attribute('hf-button-arg', 'class', 'hf-btn hf-el-btn');
                }
            }


            $this->add_render_attribute('title_args', 'class', 'cta-title hf-el-title');
            ?>

<section class="cta-area pt-15 hf-el-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="cta-content mt-40">

                    <?php if (!empty($settings['hexa_about_sub_title'])): ?>
                    <span
                        class="section-3-sub-title hf-el-subtitle"><?php echo hexa_kses($settings['hexa_about_sub_title']); ?></span>
                    <?php endif; ?>
                    <?php
                                if (!empty($settings['hexa_about_title'])):
                                    printf(
                                        '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape($settings['hexa_about_title_tag']),
                                        $this->get_render_attribute_string('title_args'),
                                        hexa_kses($settings['hexa_about_title'])
                                    );
                                endif;
                                ?>
                    <?php if (!empty($settings['hexa_about_description'])): ?>
                    <p class="hf-el-content"><?php echo hexa_kses($settings['hexa_about_description']); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($settings['hexa_about_btn_text'])): ?>
                    <div class="cta-btn">
                        <a
                            <?php echo $this->get_render_attribute_string('hf-button-arg'); ?>><?php echo hexa_kses($settings['hexa_about_btn_text']); ?></a>
                    </div>
                    <?php endif; ?>

                </div>
            </div>
            <div class="col-lg-7 align-self-end">
                <div class="cta-thumb p-relative">
                    <?php if (!empty($hexa_image)): ?>
                    <div class="cta-main-bg d-flex justify-content-end">
                        <img src="<?php echo esc_url($hexa_image); ?>" alt="<?php echo esc_attr($hexa_image_alt); ?>">
                    </div>
                    <?php endif; ?>
                    <div class="cta-shape">
                        <?php if (!empty($hexa_shape_image)): ?>
                        <div class="cta-shape-1 d-none d-lg-block">
                            <img src="<?php echo esc_url($hexa_shape_image); ?>"
                                alt="<?php echo esc_attr($hexa_shape_image_alt); ?>">
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($hexa_image2)): ?>
                        <div class="cta-shape-2">
                            <img src="<?php echo esc_url($hexa_image2); ?>"
                                alt="<?php echo esc_attr($hexa_image_alt2); ?>">
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($hexa_shape_image2)): ?>
                        <div class="cta-shape-3">
                            <img src="<?php echo esc_url($hexa_shape_image2); ?>"
                                alt="<?php echo esc_attr($hexa_shape_image_alt2); ?>">
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php elseif ($settings['hexa_design_layout'] == 'layout-8'):

            // thumbnail
            if (!empty($settings['hexa_image']['url'])) {
                $hexa_image = !empty($settings['hexa_image']['id']) ? wp_get_attachment_image_url($settings['hexa_image']['id'], $settings['hexa_image_size_size']) : $settings['hexa_image']['url'];
                $hexa_image_alt = get_post_meta($settings["hexa_image"]["id"], "_wp_attachment_image_alt", true);
            }
            if (!empty($settings['hexa_image2']['url'])) {
                $hexa_image2 = !empty($settings['hexa_image2']['id']) ? wp_get_attachment_image_url($settings['hexa_image2']['id'], $settings['hexa_image_size_size']) : $settings['hexa_image2']['url'];
                $hexa_image_alt2 = get_post_meta($settings["hexa_image2"]["id"], "_wp_attachment_image_alt", true);
            }
            if (!empty($settings['hexa_image3']['url'])) {
                $hexa_image3 = !empty($settings['hexa_image3']['id']) ? wp_get_attachment_image_url($settings['hexa_image3']['id'], $settings['hexa_image_size_size']) : $settings['hexa_image3']['url'];
                $hexa_image_alt3 = get_post_meta($settings["hexa_image3"]["id"], "_wp_attachment_image_alt", true);
            }

            // shape image
            if (!empty($settings['hexa_shape_image_1']['url'])) {
                $hexa_shape_image = !empty($settings['hexa_shape_image_1']['id']) ? wp_get_attachment_image_url($settings['hexa_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['hexa_shape_image_1']['url'];
                $hexa_shape_image_alt = get_post_meta($settings["hexa_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->add_render_attribute('title_args', 'class', 'hfsection__title hf-el-title');
            ?>

<section class="feature-area pb-60 pt-15 hf-el-section">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-lg-6">
                <div class="feature-inner-wrap mb-60">
                    <div class="hfsection__content mb-40">

                        <?php if (!empty($settings['hexa_about_sub_title'])): ?>
                        <div class="hfbanner__sub-title mb-15">
                            <span
                                class="hf-el-subtitle"><?php echo hexa_kses($settings['hexa_about_sub_title']); ?></span>
                            <i>
                                <svg width="130" height="42" viewBox="0 0 130 42" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <rect y="0.941895" width="130" height="40.9551" fill="url(#pattern6)"
                                        fill-opacity="0.08" />
                                    <defs>
                                        <pattern id="pattern6" patternContentUnits="objectBoundingBox" width="1"
                                            height="1">
                                            <use xlink:href="#image0_868_3547"
                                                transform="translate(-0.0587762 0.0123052) scale(0.00611916 0.0198269)" />
                                        </pattern>
                                        <image id="image0_868_3547" width="180" height="50"
                                            xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAALQAAAAyCAYAAAD1JPH3AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDcuMS1jMDAwIDc5LmVkYTJiM2ZhYywgMjAyMS8xMS8xNy0xNzoyMzoxOSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6RUMyMzkwQTczMTM3MTFFRDg3NUZBOUZCRDk1MThFMTMiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6RUMyMzkwQTYzMTM3MTFFRDg3NUZBOUZCRDk1MThFMTMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIDIzLjEgKFdpbmRvd3MpIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6MjFBQkIwMjIzMTA2MTFFREEzRkNBQzVFOTRFRTVERTgiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6MjFBQkIwMjMzMTA2MTFFREEzRkNBQzVFOTRFRTVERTgiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz5lgZ3iAAAB2ElEQVR42uzd7U3CUBiA0Wr4DxvQDWQE4gS6gSO6ibhB2aBMoCG5ja83pVRaSSnnJE2/MII+t7386sPz21dxQ1ZpKdNSpPUynItL/nNd6rSc2t6n/Sot+TYTsJhgrJsU6TqLt7zS779EE3ad1vuwvwuDg5kF3QQao92E47fq3ICrQ/RN8LsQPBMPOob7lEV8j5o7z6Yj+Cbwzyx+U5orB32MdCvcwcFv0/ZLx5SmubrHAVCZ0lwW9CrEu07rcsC8k/GmNPk8vg7hx2P13K/4fYP+6LhdcjvR5wMgrmP0h5bXxdecmjadu1N0ffFuOxc/zzKcP65fhwQt5nkOgGJu08NH/1cEDYIGQYOgETQIGgQNggZBI2gQNAgaBA2CRtAgaBA0CBoEjaBB0CBoEDQIGkGDoEHQIGgQNIIGQYOgQdAgaAQNE7aY+Ptre7JSn6ct9VWe2UfQvx4XFuPbZ+fz1/5HsGPEHh831mw359bhWH6OCQf9Xvw8v67OQmyLcg6GfJ4Yd769Dvviv+yuXQ0N+tXf8aKpUtUz/rJlvWw5Pmf5RfIQ7vJV0fO55wvtTSL+3R+mQasTd4BlyzRpdeWBEKeL+aC+yt1d0PczDSpH/PJbjfi+RvUtwADssXzgKiX3gwAAAABJRU5ErkJggg==" />
                                    </defs>
                                </svg>
                            </i>
                        </div>
                        <?php endif; ?>

                        <?php
                                    if (!empty($settings['hexa_about_title'])):
                                        printf(
                                            '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['hexa_about_title_tag']),
                                            $this->get_render_attribute_string('title_args'),
                                            hexa_kses($settings['hexa_about_title'])
                                        );
                                    endif;
                                    ?>
                        <?php if (!empty($settings['hexa_about_description'])): ?>
                        <p class="hf-el-content"><?php echo hexa_kses($settings['hexa_about_description']); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="feature-inner-list">

                        <?php foreach ($settings['about_features_list'] as $key => $item):
                                        // Link
                                        if ('2' == $item['hexa_about_link_type']) {
                                            $link = get_permalink($item['hexa_about_page_link']);
                                            $target = '_self';
                                            $rel = 'nofollow';
                                        } else {
                                            $link = !empty($item['hexa_about_link']['url']) ? $item['hexa_about_link']['url'] : '';
                                            $target = !empty($item['hexa_about_link']['is_external']) ? '_blank' : '';
                                            $rel = !empty($item['hexa_about_link']['nofollow']) ? 'nofollow' : '';
                                        }
                                        ?>
                        <div class="feature-inner-item">
                            <div class="feature-inner-icon">
                                <?php if ($item['hexa_box_icon_type'] == 'icon'): ?>
                                <?php if (!empty($item['hexa_box_icon']) || !empty($item['hexa_box_selected_icon']['value'])): ?>
                                <span class="hf-el-rep-icon">
                                    <?php hexa_render_icon($item, 'hexa_box_icon', 'hexa_box_selected_icon'); ?>
                                </span>
                                <?php endif; ?>
                                <?php elseif ($item['hexa_box_icon_type'] == 'image'): ?>
                                <?php if (!empty($item['hexa_box_icon_image']['url'])): ?>
                                <span class="hf-el-rep-icon">
                                    <img src="<?php echo $item['hexa_box_icon_image']['url']; ?>"
                                        alt="<?php echo get_post_meta(attachment_url_to_postid($item['hexa_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                </span>
                                <?php endif; ?>
                                <?php else: ?>
                                <?php if (!empty($item['hexa_box_icon_svg'])): ?>
                                <span class="hf-el-rep-icon">
                                    <?php echo $item['hexa_box_icon_svg']; ?>
                                </span>
                                <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <div class="feature-inner-content">

                                <?php if (!empty($item['about_features_title'])): ?>
                                <h4 class="feature-inner-title hf-el-rep-title">
                                    <?php echo hexa_kses($item['about_features_title']); ?>
                                </h4>
                                <?php endif; ?>
                                <?php if (!empty($item['about_features_des'])): ?>
                                <p class="hf-el-rep-des"><?php echo hexa_kses($item['about_features_des']); ?></p>
                                <?php endif; ?>
                                <?php if (!empty($item['about_features_btn_text'])): ?>
                                <a class="hf-el-rep-btn"
                                    href="<?php echo esc_url($link); ?>"><?php echo hexa_kses($item['about_features_btn_text']); ?>
                                    <i class="fa-regular fa-angle-right"></i></a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="need-thumbs p-relative mb-60">
                    <?php if (!empty($hexa_image)): ?>
                    <img src="<?php echo esc_attr($hexa_image); ?>" alt="<?php echo esc_attr($hexa_image_alt); ?>">
                    <?php endif; ?>
                    <div class="need-shape d-none d-lg-block">
                        <?php if (!empty($hexa_image2)): ?>
                        <div class="need-shape-one">
                            <img src="<?php echo esc_url($hexa_image2); ?>"
                                alt="<?php echo esc_attr($hexa_image_alt2); ?>">
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($hexa_shape_image)): ?>
                        <div class="need-shape-two">
                            <img src="<?php echo esc_url($hexa_shape_image); ?>"
                                alt="<?php echo esc_attr($hexa_shape_image_alt); ?>">
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($hexa_image3)): ?>
                        <div class="need-shape-three">
                            <img src="<?php echo esc_url($hexa_image3); ?>"
                                alt="<?php echo esc_attr($hexa_image_alt3); ?>">
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php elseif ($settings['hexa_design_layout'] == 'layout-9'):

            // thumbnail
            if (!empty($settings['hexa_image']['url'])) {
                $hexa_image = !empty($settings['hexa_image']['id']) ? wp_get_attachment_image_url($settings['hexa_image']['id'], $settings['hexa_image_size_size']) : $settings['hexa_image']['url'];
                $hexa_image_alt = get_post_meta($settings["hexa_image"]["id"], "_wp_attachment_image_alt", true);
            }

            // shape image
            if (!empty($settings['hexa_shape_image_1']['url'])) {
                $hexa_shape_image = !empty($settings['hexa_shape_image_1']['id']) ? wp_get_attachment_image_url($settings['hexa_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['hexa_shape_image_1']['url'];
                $hexa_shape_image_alt = get_post_meta($settings["hexa_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
            }
            if (!empty($settings['hexa_shape_image_2']['url'])) {
                $hexa_shape_image2 = !empty($settings['hexa_shape_image_2']['id']) ? wp_get_attachment_image_url($settings['hexa_shape_image_2']['id'], $settings['shape_image_size_size']) : $settings['hexa_shape_image_2']['url'];
                $hexa_shape_image_alt2 = get_post_meta($settings["hexa_shape_image_2"]["id"], "_wp_attachment_image_alt", true);
            }
            if (!empty($settings['hexa_shape_image_3']['url'])) {
                $hexa_shape_image3 = !empty($settings['hexa_shape_image_3']['id']) ? wp_get_attachment_image_url($settings['hexa_shape_image_3']['id'], $settings['shape_image_size_size']) : $settings['hexa_shape_image_3']['url'];
                $hexa_shape_image_alt3 = get_post_meta($settings["hexa_shape_image_3"]["id"], "_wp_attachment_image_alt", true);
            }
            if (!empty($settings['hexa_shape_image_4']['url'])) {
                $hexa_shape_image4 = !empty($settings['hexa_shape_image_4']['id']) ? wp_get_attachment_image_url($settings['hexa_shape_image_4']['id'], $settings['shape_image_size_size']) : $settings['hexa_shape_image_4']['url'];
                $hexa_shape_image_alt4 = get_post_meta($settings["hexa_shape_image_4"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->add_render_attribute('title_args', 'class', 'title');
            ?>

<section class="feature-area pt-125 pb-55 hf-el-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="feature-social">
                    <ul class="feature-list-4 feature-socia-list">

                        <?php foreach ($settings['about_features_list'] as $key => $item):
                                        $key += 1; ?>
                        <li>
                            <div
                                class="feature-list-4-item p-relative d-flex <?php echo $key == 2 ? 'pl-130' : NULL; ?>">
                                <div class="feature-list-4-icon ">
                                    <div class="feature-list-bg p-relative">

                                        <?php if ($item['hexa_box_icon_type'] == 'icon'): ?>
                                        <?php if (!empty($item['hexa_box_icon']) || !empty($item['hexa_box_selected_icon']['value'])): ?>
                                        <i class="hf-el-rep-icon">
                                            <?php hexa_render_icon($item, 'hexa_box_icon', 'hexa_box_selected_icon'); ?>
                                        </i>
                                        <?php endif; ?>
                                        <?php elseif ($item['hexa_box_icon_type'] == 'image'): ?>
                                        <?php if (!empty($item['hexa_box_icon_image']['url'])): ?>
                                        <i class="hf-el-rep-icon">
                                            <img src="<?php echo $item['hexa_box_icon_image']['url']; ?>"
                                                alt="<?php echo get_post_meta(attachment_url_to_postid($item['hexa_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                        </i>
                                        <?php endif; ?>
                                        <?php else: ?>
                                        <?php if (!empty($item['hexa_box_icon_svg'])): ?>
                                        <i class="hf-el-rep-icon">
                                            <?php echo $item['hexa_box_icon_svg']; ?>
                                        </i>
                                        <?php endif; ?>
                                        <?php endif; ?>

                                        <b><?php echo $key < 10 ? '0' . esc_html($key) : $key; ?></b>
                                        <span class="feature-bg-border-1"></span>
                                        <span class="feature-bg-border-2"></span>
                                        <span class="feature-bg-border-3"></span>
                                        <span class="feature-bg-border-4"></span>
                                    </div>
                                </div>
                                <div class="feature-list-4-content">
                                    <?php if (!empty($item['about_features_title'])): ?>
                                    <h4 class="title hf-el-rep-title">
                                        <?php echo hexa_kses($item['about_features_title']); ?>
                                    </h4>
                                    <?php endif; ?>
                                    <?php if (!empty($item['about_features_des'])): ?>
                                    <p class="hf-el-rep-des"><?php echo hexa_kses($item['about_features_des']); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="feature-4-shape-<?php echo esc_attr($key); ?> d-none d-md-block">

                                    <?php if ($key == 1): ?>
                                    <svg class="line-dash-path" width="38" height="122" viewBox="0 0 38 122" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.279297 1C41.9846 20.0005 55.1988 87.9525 2.74393 121.294"
                                            stroke="#A7ACB3" stroke-dasharray="4 4" />
                                    </svg>
                                    <?php elseif ($key == 2): ?>
                                    <svg class="line-dash-path" width="42" height="122" viewBox="0 0 42 122" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M41.3076 1.22192C-1.33493 18.0137 -18.0874 85.181 32.5507 121.222"
                                            stroke="#A7ACB3" stroke-dasharray="4 4" />
                                    </svg>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; ?>

                    </ul>
                </div>
            </div>
            <div class="col-lg-5 align-self-end">
                <div class="feature-inner-gallery">
                    <?php if (!empty($hexa_image)): ?>
                    <div class="feature-inner-thumb">
                        <img src="<?php echo esc_url($hexa_image); ?>" alt="<?php echo esc_attr($hexa_image_alt); ?>">
                    </div>
                    <?php endif; ?>
                    <div class="feature-inner-shape d-none d-md-block">
                        <?php if (!empty($hexa_shape_image)): ?>
                        <img class="feature-inner-shape-1" src="<?php echo esc_url($hexa_shape_image); ?>"
                            alt="<?php echo esc_attr($hexa_shape_image_alt); ?>">
                        <?php endif; ?>
                        <?php if (!empty($hexa_shape_image2)): ?>
                        <img class="feature-inner-shape-2" src="<?php echo esc_url($hexa_shape_image2); ?>"
                            alt="<?php echo esc_attr($hexa_shape_image_alt2); ?>">
                        <?php endif; ?>
                        <?php if (!empty($hexa_shape_image3)): ?>
                        <img class="feature-inner-shape-3" src="<?php echo esc_url($hexa_shape_image3); ?>"
                            alt="<?php echo esc_attr($hexa_shape_image_alt3); ?>">
                        <?php endif; ?>
                        <?php if (!empty($hexa_shape_image4)): ?>
                        <img class="feature-inner-shape-4" src="<?php echo esc_url($hexa_shape_image4); ?>"
                            alt="<?php echo esc_attr($hexa_shape_image_alt4); ?>">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php else:

    // thumbnail
    if (!empty($settings['hexa_image']['url'])) {
        $hexa_image = !empty($settings['hexa_image']['id']) ? wp_get_attachment_image_url($settings['hexa_image']['id'], $settings['hexa_image_size_size']) : $settings['hexa_image']['url'];
        $hexa_image_alt = get_post_meta($settings["hexa_image"]["id"], "_wp_attachment_image_alt", true);
    }

    if (!empty($settings['hexa_image2']['url'])) {
        $hexa_image2 = !empty($settings['hexa_image2']['id']) ? wp_get_attachment_image_url($settings['hexa_image2']['id'], $settings['hexa_image_size_size']) : $settings['hexa_image2']['url'];
        $hexa_image_alt2 = get_post_meta($settings["hexa_image2"]["id"], "_wp_attachment_image_alt", true);
    }

    $this->add_render_attribute('title_args', 'class', 'tr-section-title mb-20 hf-el-title');


    // button one
    if (!empty($settings['btn_link']['url'])) {
        $this->add_link_attributes('button', $settings['btn_link']);
    }
    $this->add_render_attribute('button', 'class', 'tr-btn-green hexa-el-btn');
?>
<!-- about-area-start -->
<div class="tr-about-area fix pt-120 pb-120">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-xl-6 col-lg-6">
                <div class="tr-about-left">
                    <div class="tr-about-title-box">
                        <?php if (!empty($settings['about_subtitle'])): ?>
                        <span class="tr-section-subtitle mb-10 hf-el-subtitle">
                            <?php echo hexa_kses($settings['about_subtitle']); ?>
                        </span>
                        <?php endif; ?>

                        <?php
                                    if (!empty($settings['title'])):
                                        printf(
                                            '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['title_tag']),
                                            $this->get_render_attribute_string('title_args'),
                                            hexa_kses($settings['title'])
                                        );
                                    endif;
                                    ?>
                    </div>

                    <?php if (!empty($settings['desc'])): ?>
                    <div class="tr-about-text">
                        <p class="hf-el-content">
                            <?php echo hexa_kses($settings['desc']); ?>
                        </p>
                    </div>
                    <?php endif; ?>

                    <?php foreach ($settings['about_features_list'] as $key => $item): ?>

                    <div class="tr-about-content p-relative">

                        <div class="hfchoose-icon">
                            <?php if ($item['hexa_box_icon_type'] == 'icon'): ?>
                            <?php if (!empty($item['hexa_box_icon']) || !empty($item['hexa_box_selected_icon']['value'])): ?>
                            <span class="hf-el-rep-icon">
                                <?php hexa_render_icon($item, 'hexa_box_icon', 'hexa_box_selected_icon'); ?>
                            </span>
                            <?php endif; ?>
                            <?php elseif ($item['hexa_box_icon_type'] == 'image'): ?>
                            <?php if (!empty($item['hexa_box_icon_image']['url'])): ?>
                            <span class="hf-el-rep-icon">
                                <img src="<?php echo $item['hexa_box_icon_image']['url']; ?>"
                                    alt="<?php echo get_post_meta(attachment_url_to_postid($item['hexa_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                            </span>
                            <?php endif; ?>
                            <?php else: ?>
                            <?php if (!empty($item['hexa_box_icon_svg'])): ?>
                            <span class="hf-el-rep-icon">
                                <?php echo $item['hexa_box_icon_svg']; ?>
                            </span>
                            <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($item['about_features_title'])): ?>
                        <span class="hf-el-rep-title">
                            <?php echo hexa_kses($item['about_features_title']); ?>
                        </span>
                        <?php endif; ?>

                        <?php if (!empty($item['about_features_des'])): ?>
                        <p class="hf-el-rep-des">
                            <?php echo hexa_kses($item['about_features_des']); ?>
                        </p>
                        <?php endif; ?>
                    </div>

                    <?php endforeach; ?>

                    <?php if (!empty($settings['btn_text'])): ?>
                    <div class="tr-about-btn">
                        <a <?php echo $this->get_render_attribute_string('button'); ?>>
                            <?php echo hexa_kses($settings['btn_text']); ?>
                            <i class="<?php echo esc_attr($settings['button_icon']['value']); ?>"></i>
                        </a>
                    </div>
                    <?php endif; ?>

                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="tr-about-thumb-wrap">
                    <div class="row gx-20 align-items-end">
                        <div class="col-xl-6 col-lg-6 col-md-6">

                            <?php if (!empty($hexa_image)): ?>
                            <div class="tr-about-thumb-1 p-relative">
                                <span class="tr-about-circle-shape"></span>
                                <img class="w-100" src="<?php echo esc_url($hexa_image); ?>"
                                    alt="<?php echo esc_attr($hexa_image_alt); ?>">
                            </div>
                            <?php endif; ?>

                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="tr-about-thumb-2">
                                <?php if (!empty($hexa_image2)): ?>
                                <img class="w-100" src="<?php echo esc_url($hexa_image2); ?>"
                                    alt="<?php echo esc_attr($hexa_image_alt2); ?>">
                                <?php endif; ?>
                                <div class="tr-about-client d-flex align-items-center">
                                    <div class="tr-about-client-content">
                                        <?php if (!empty($settings['client_content_number'])): ?>
                                        <h4>
                                            <span data-purecounter-duration="1"
                                                data-purecounter-end="<?php echo esc_attr($settings['client_content_number']); ?>"
                                                class="purecounter">0</span>
                                            +
                                        </h4>
                                        <?php endif; ?>

                                        <?php if (!empty($settings['client_content_title'])): ?>
                                        <span>
                                            <?php echo hexa_kses($settings['client_content_title']); ?>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- about-area-end -->

<?php endif;
    }
}

$widgets_manager->register(new Hexa_About());