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
class Hexa_Hero_Slider extends Widget_Base
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
        return 'hf-hero-slider';
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
        return __('Hero Slider', 'hexacore');
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
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'layout_1' => esc_html__('Layout 1', 'hexacore'),
                    'layout_2' => esc_html__('Layout 2', 'hexacore'),
                    // 'layout-3' => esc_html__('Layout 3', 'hexacore'),
                    // 'layout-4' => esc_html__('Layout 4', 'hexacore'),
                    // 'layout-5' => esc_html__('Layout 5', 'hexacore'),
                ],
                'default' => 'layout_1',
            ]
        );

        $this->end_controls_section();

        // hero slider
        $this->start_controls_section(
            'section_hero_slider',
            [
                'label' => __('Slider Content', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => __('Image', 'hexacore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'subtitle',
            [
                'label' => __('Subtitle', 'hexacore'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Funden subtitle', 'hexacore'),
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => __('Title', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Funden title', 'hexacore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
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

        $repeater->add_control(
            'desc',
            [
                'label' => __('Description', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => '10',
                'label_block' => true,
                'default' => __('Cum sociis natoque penatibus et magnis dis parturient montes.', 'hexacore'),
            ]
        );

        $repeater->add_control(
            'btn_text',
            [
                'label' => __('Button One', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Click here', 'hexacore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
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

        $repeater->add_control(
            'btn_text2',
            [
                'label' => __('Button Two', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Click here', 'hexacore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'btn_link2',
            [
                'label' => esc_html__('Link Two', 'hexacore'),
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
            'hero_slider',
            [
                'label'       => '',
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'show_label'  => false,
                'default'     => [
                    [
                        'subtitle'      => __('Financial Analyst', 'hexacore'),
                        'title'      => __('Coriss Ambady', 'hexacore'),
                        'desc' => __('“Cum sociis natoque penatibus et magnis dis parturient montes.”', 'hexacore'),
                    ],
                    [
                        'subtitle'      => __('Financial Analyst', 'hexacore'),
                        'title'      => __('Coriss Ambady', 'hexacore'),
                        'desc' => __('“Cum sociis natoque penatibus et magnis dis parturient montes.”', 'hexacore'),
                    ],
                    [
                        'subtitle'      => __('Financial Analyst', 'hexacore'),
                        'title'      => __('Coriss Ambady', 'hexacore'),
                        'desc' => __('“Cum sociis natoque penatibus et magnis dis parturient montes.”', 'hexacore'),
                    ]
                ],
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{title}}}',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'simage_size',
                'exclude' => ['1536x1536', '2048x2048'],
                'include' => [],
                'default' => 'full',
            ]
        );

        $this->end_controls_section();
        /* Option Slider */
        $this->start_controls_section(
            'slider_option_section',
            [
                'label' => __('Slider Option', 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $slides_show = range(1, 10);
        $slides_show = array_combine($slides_show, $slides_show);

        $this->add_responsive_control(
            'tshow',
            [
                'label' => __('Slides To Show', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => __('Default', 'hexacore'),
                ] + $slides_show,
                'default' => ''
            ]
        );

        $this->add_control(
            'loop',
            [
                'label'   => esc_html__('Loop', 'hexacore'),
                'type'    => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'autoplay',
            [
                'label'   => esc_html__('Autoplay', 'hexacore'),
                'type'    => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'timeout',
            [
                'label' => __('Autoplay Timeout', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min'  => 1000,
                        'max'  => 20000,
                        'step' => 1000,
                    ],
                ],
                'default' => [
                    'size' => 7000,
                ],
                'condition' => [
                    'autoplay' => 'yes',
                ]
            ]
        );
        $this->add_responsive_control(
            'slider_spacing',
            [
                'label' => __('Slider Spacing', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
            ]
        );

        $this->add_control(
            'nav_show',
            [
                'label' => esc_html__('Show Navigation', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'hexacore'),
                'label_off' => esc_html__('Hide', 'hexacore'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    // style_tab_content
    protected function style_tab_content()
    {

        $this->hexa_section_style_controls('banner_section', 'Section Style', '.ele-section');
        $this->hexa_basic_style_controls('section_subtitle', 'Section - Subtitle', '.hf-el-subtitle');
        $this->hexa_basic_style_controls('section_title', 'Section - Title', '.hf-el-title');
        $this->hexa_basic_style_controls('section_desc', 'Section - Description', '.hf-el-content');
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

        if (empty($settings['hero_slider'])) {
            return;
        }


        $showXxl   = !empty($settings['tshow']) ? $settings['tshow'] : 3;
        $showXl    = !empty($settings['tshow_laptop']) ? $settings['tshow_laptop'] : $showXxl;
        $showLg    = !empty($settings['tshow_tablet_extra']) ? $settings['tshow_tablet_extra'] : $showXl;
        $showMd    = !empty($settings['tshow_tablet']) ? $settings['tshow_tablet'] : $showLg;
        $showSm    = !empty($settings['tshow_mobile_extra']) ? $settings['tshow_mobile_extra'] : $showMd;
        $showXs    = !empty($settings['tshow_mobile']) ? $settings['tshow_mobile'] : $showSm;

        $gapXxl  = isset($settings['slider_spacing']['size']) && is_numeric($settings['slider_spacing']['size']) ? $settings['slider_spacing']['size'] : 30;
        $gapXl  = isset($settings['slider_spacing_laptop']['size']) && is_numeric($settings['slider_spacing_laptop']['size']) ? $settings['slider_spacing_laptop']['size'] : $gapXxl;
        $gapLg  = isset($settings['slider_spacing_tablet_extra']['size']) && is_numeric($settings['slider_spacing_tablet_extra']['size']) ? $settings['slider_spacing_tablet_extra']['size'] : $gapXl;
        $gapMd  = isset($settings['slider_spacing_tablet']['size']) && is_numeric($settings['slider_spacing_tablet']['size']) ? $settings['slider_spacing_tablet']['size'] : $gapLg;
        $gapSm  = isset($settings['slider_spacing_mobile_extra']['size']) && is_numeric($settings['slider_spacing_mobile_extra']['size']) ? $settings['slider_spacing_mobile_extra']['size'] : $gapMd;
        $gapXs  = isset($settings['slider_spacing_mobile']['size']) && is_numeric($settings['slider_spacing_mobile']['size']) ? $settings['slider_spacing_mobile']['size'] : $gapSm;
        $timeout  = isset($settings['timeout']['size']) ? $settings['timeout']['size'] : 5000;

        $owl_options = [
            'slides_show_desktop'        => absint($showXxl),
            'slides_show_laptop'         => absint($showXl),
            'slides_show_tablet_extra'   => absint($showLg),
            'slides_show_tablet'         => absint($showMd),
            'slides_show_mobile_extra'   => absint($showSm),
            'slides_show_mobile'         => absint($showXs),
            'margin_desktop'             => absint($gapXxl),
            'margin_laptop'              => absint($gapXl),
            'margin_tablet_extra'        => absint($gapLg),
            'margin_tablet'              => absint($gapMd),
            'margin_mobile_extra'        => absint($gapSm),
            'margin_mobile'              => absint($gapXs),
            'autoplay'                   => $settings['autoplay'] ? $settings['autoplay'] : 'no',
            'autoplay_time_out'          => absint($timeout),
            'loop'                       => $settings['loop'] ? $settings['loop'] : 'no',
        ];

        $this->add_render_attribute(
            'slides',
            [
                'class'               => 'hf-carousel ot-clients-carousel',
                'data-slider_options' => wp_json_encode($owl_options),
            ]
        );

?>

        <?php if ($settings['hexa_design_layout']  == 'layout-2') :

            // thumbnail
            if (!empty($settings['hexa_image']['url'])) {
                $hexa_image = !empty($settings['hexa_image']['id']) ? wp_get_attachment_image_url($settings['hexa_image']['id'], $settings['hexa_image_size_size']) : $settings['hexa_image']['url'];
                $hexa_image_alt = get_post_meta($settings["hexa_image"]["id"], "_wp_attachment_image_alt", true);
            }

        ?>

        <?php else : ?>

            <!-- banner area start -->
            <section class="banner__area banner-height style-seven p-relative fix">
                <!-- when slide active remove this class -->
                <div class="swiper slider__active">
                    <div class="swiper-wrapper">
                        <?php
                        foreach ($settings['hero_slider'] as $key => $item) :

                            $html_tag = $item['title_tag'];
                            $title = $item['title'];
                            //image
                            $image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src($item['image']['id'], 'simage_size', $settings);
                            if (empty($image_url)) {
                                $image_url = \Elementor\Utils::get_placeholder_image_src();
                            }
                            $image_html = '<img src="' . esc_attr($image_url) . '" alt="' . esc_attr($item['title']) . '">';

                            // button one
                            if (!empty($item['btn_link']['url'])) {
                                $this->add_link_attributes('button' . $key, $item['btn_link']);
                            }
                            $this->add_render_attribute('button' . $key, 'class', 'bd-btn is-btn-anim hexa-el-btn');

                            // button two
                            if (!empty($item['btn_link2']['url'])) {
                                $this->add_link_attributes('button2' . $key, $item['btn_link2']);
                            }
                            $this->add_render_attribute('button2' . $key, 'class', 'bd-btn is-btn-anim hexa-el-btn2');

                            //title
                            $this->add_render_attribute('title', 'class', 'banner__title xlarge hexa-el-title');
                            $this->add_render_attribute('title', 'data-animation', 'fadeInUp');
                            $this->add_render_attribute('title', 'data-delay', '0.3s');
                            $title_html = sprintf('<%1$s %2$s>%3$s</%1$s>', $html_tag, $this->get_render_attribute_string('title'), $title);

                        ?>
                            <div class="swiper-slide banner_more_item">
                                <div class="banner__single-slide">
                                    <?php if (!empty($item['image']['url'])) : ?>
                                        <div class="bg__thumb-position include-bg is-overlay" data-background="<?php echo esc_attr($image_url); ?>"></div>
                                    <?php endif; ?>

                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col-xl-8 col-lg-9 ">
                                                <div class="banner__content text-center">

                                                    <?php if (!empty($item['title'])) {
                                                        echo $title_html;
                                                    } ?>

                                                    <?php if (!empty($item['desc'])) : ?>
                                                        <p class="banner__text" data-animation="fadeInUp" data-delay=".5s">
                                                            <?php echo wp_kses_post($item['desc']); ?>
                                                        </p>
                                                    <?php endif; ?>

                                                    <div class="banner__btn-wrap justify-content-center" data-animation="fadeInUp" data-delay=".7s">

                                                        <a <?php echo $this->get_render_attribute_string('button' . $key); ?>>
                                                            <span class="bd-btn-inner">
                                                                <span class="bd-btn-normal">
                                                                    <?php echo wp_kses_post($item['btn_text']); ?>
                                                                </span>
                                                                <span class="bd-btn-hover">
                                                                    <?php echo wp_kses_post($item['btn_text']); ?>
                                                                </span>
                                                            </span>
                                                        </a>
                                                        <a <?php echo $this->get_render_attribute_string('button2' . $key); ?>>
                                                            <span class="bd-btn-inner">
                                                                <span class="bd-btn-normal">
                                                                    <?php echo wp_kses_post($item['btn_text2']); ?>
                                                                </span>
                                                                <span class="bd-btn-hover">
                                                                    <?php echo wp_kses_post($item['btn_text2']); ?>
                                                                </span>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php if (!empty($settings['nav_show'])) : ?>
                    <!-- If we need navigation buttons -->
                    <div class="banner__navigation d-none d-md-block">
                        <button class="slider__button-prev circle-btn slider__nav-btn is-btn-large"><i class="fa-regular fa-arrow-left-long"></i></button>
                        <button class="slider__button-next circle-btn slider__nav-btn is-btn-large"><i class="fa-regular fa-arrow-right-long"></i></button>
                    </div>
                <?php endif; ?>
            </section>
            <!-- banner area end -->

<?php endif;
    }
}

$widgets_manager->register(new Hexa_Hero_Slider());
