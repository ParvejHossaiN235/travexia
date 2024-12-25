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
class Hexa_Main_Brand extends Widget_Base
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
        return 'hf-brand';
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
        return __('Brand', 'hexacore');
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
                    //'layout_2' => esc_html__('Layout 2', 'hexacore'),
                ],
                'default' => 'layout_1',
            ]
        );

        $this->end_controls_section();

        // brand section
        $this->start_controls_section(
            'hexa_brand_section',
            [
                'label' => __('Brand Logo', 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'title',
            [
                'label' => __('Name', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Client', 'hexacore'),
            ]
        );

        $repeater->add_control(
            'image_client',
            [
                'label' => __('Image', 'hexacore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_control(
            'clients_slider',
            [
                'label'       => '',
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'show_label'  => false,
                'default'     => [
                    [
                        'title'       => __('Client 1', 'hexacore'),
                        'image_client'      => [
                            'url'     => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                        'client_link' => ['url' => '#'],
                    ],
                    [
                        'title'       => __('Client 2', 'hexacore'),
                        'image_client'      => [
                            'url'     => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                        'client_link' => ['url' => '#'],
                    ],
                    [
                        'title'       => __('Client 3', 'hexacore'),
                        'image_client'      => [
                            'url'     => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                        'client_link' => ['url' => '#'],
                    ]
                ],
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{title}}}',
            ]
        );

        $this->end_controls_section();

        /* Option Slider */
        $this->start_controls_section(
            'slider_option_section',
            [
                'label' => __('Slider Option', 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'hexa_design_layout' => 'layout_10',
                ]
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
            'navigation',
            [
                'label' => __('Navigation', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'both' => __('Arrows and Dots', 'hexacore'),
                    'arrows' => __('Arrows', 'hexacore'),
                    'dots' => __('Dots', 'hexacore'),
                    'none' => __('None', 'hexacore'),
                ],
            ]
        );

        $this->end_controls_section();
    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->hexa_icon_style_controls('client', 'Brand - Style', '.hexa-el-brand');
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

        if (empty($settings['clients_slider'])) {
            return;
        }
?>

        <?php if ($settings['hexa_design_layout']  == 'layout_3') : ?>

            <div <?php echo $this->get_render_attribute_string('slides'); ?>>
                <div class="owl-carousel owl-theme">
                    <?php
                    foreach ($settings['clients_slider'] as $key => $item) {
                        $title = $item['title'];
                        $slide_html = '';

                        $image_html = wp_get_attachment_image($item['image_client']['id'], 'full');

                        if (empty($image_html) && isset($item['image_client']['url'])) {
                            $image_html = '<img src="' . esc_attr($item['image_client']['url']) . '" alt="' . esc_attr(\Elementor\Control_Media::get_image_alt($item)) . '" />';
                        }
                        $slide_html = '<span class="client-logo">' . $image_html . '</span>';

                        if (!empty($item['client_link']['url'])) {
                            $this->add_render_attribute('link' . $key, 'class', 'client_link');
                            $this->add_link_attributes('link' . $key, $item['client_link']);
                            $slide_html = '<a ' . $this->get_render_attribute_string('link' . $key) . '>' . $slide_html . '</a>';
                        }
                        echo wp_kses_post($slide_html);
                    }
                    ?>
                </div>
            </div>

        <?php elseif ($settings['hexa_design_layout']  == 'layout_2') : ?>

            <div class="brand__wrapper style-two">
                <div class="swiper brand-activation">
                    <div class="swiper-wrapper">
                        <?php foreach ($settings['clients_slider'] as $key => $item) :
                            $title = $item['title'];
                            $slide_html = '';
                            $image_html = wp_get_attachment_image($item['image_client']['id'], 'full');
                            if (empty($image_html) && isset($item['image_client']['url'])) {
                                $image_html = '<img src="' . esc_attr($item['image_client']['url']) . '" alt="' . esc_attr(\Elementor\Control_Media::get_image_alt($item)) . '" />';
                            }
                            if (!empty($item['client_link']['url'])) {
                                $this->add_render_attribute('link' . $key, 'class', 'client_link');
                                $this->add_link_attributes('link' . $key, $item['client_link']);
                                $slide_html = '<a ' . $this->get_render_attribute_string('link' . $key) . '>' . $image_html . '</a>';
                            }
                        ?>
                            <div class="swiper-slide">
                                <div class="brand__item text-center">
                                    <div class="brand__thumb hexa-el-brand">
                                        <?php echo wp_kses_post($slide_html); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>

        <?php else : ?>
            <div class="tr-brand-wrpper">
                <div class="swiper-container tr-brand-active">
                    <div class="swiper-wrapper">
                        <?php foreach ($settings['clients_slider'] as $key => $item) :
                            $image_html = wp_get_attachment_image($item['image_client']['id'], 'full');
                            if (empty($image_html) && isset($item['image_client']['url'])) {
                                $image_html = '<img src="' . esc_attr($item['image_client']['url']) . '" alt="' . esc_attr(\Elementor\Control_Media::get_image_alt($item)) . '" />';
                            }

                        ?>
                            <div class="swiper-slide">
                                <div class="tr-brand-item text-center">
                                    <?php echo wp_kses_post($image_html); ?>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>

<?php endif;
    }
}

$widgets_manager->register(new Hexa_Main_Brand());
