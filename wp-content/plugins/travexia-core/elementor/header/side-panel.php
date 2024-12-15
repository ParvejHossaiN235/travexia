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
class Hexa_Sidepanel extends Widget_Base
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
        return 'hf-side-panel';
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
        return __('Side Panel', 'hexacore');
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
        return ['hexacore_header'];
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

        /*** Style ***/
        $this->start_controls_section(
            'style_icon_section',
            [
                'label' => __('Icon', 'hexacore'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => __('Icon Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .panel-nl-btn' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control(
            'icon_hcolor',
            [
                'label' => __('Hover Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .panel-nl-btn:hover' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control(
            'icon_size',
            [
                'label' => __('Icon Size', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .panel-nl-btn' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_panel_section',
            [
                'label' => __('Side Panel', 'hexacore'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'panel_size',
            [
                'label' => __('Width', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min'  => 100,
                        'max'  => 1000,
                        'step' => 10,
                    ],
                ],
                'selectors' => [
                    '.side-nl-panel' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'panel_padding',
            [
                'label' => esc_html__('Padding', 'hexacore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '.side-nl-panel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'bg_panel',
            [
                'label' => __('Background Panel', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '.side-nl-panel' => 'background: {{VALUE}};',
                ]
            ]
        );
        $this->add_control(
            'bg_overlay_color',
            [
                'label' => __('Background Overlay', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '.body-nl-overlay' => 'background: {{VALUE}};',
                ]
            ]
        );
        $this->add_control(
            'close_icon',
            [
                'label' => __('Close Icon', 'hexacore'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->start_controls_tabs('close_icon_colors');
        $this->start_controls_tab(
            'close_colors_normal',
            [
                'label' => esc_html__('Normal', 'elementor'),
            ]
        );
        $this->add_control(
            'color_close',
            [
                'label' => __('Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '.side-panel .panel-nl-close' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control(
            'bg_close',
            [
                'label' => __('Background Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '.side-panel .panel-nl-close' => 'background: {{VALUE}};',
                ]
            ]
        );
        $this->add_control(
            'color_close_border',
            [
                'label' => __('Border Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '.side-panel .panel-nl-close' => 'border-color: {{VALUE}};',
                ]
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'close_colors_hover',
            [
                'label' => esc_html__('Hover', 'elementor'),
            ]
        );
        $this->add_control(
            'color_close_hover',
            [
                'label' => __('Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '.side-panel .panel-nl-close:is(:hover,:focus)' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control(
            'bg_close_hover',
            [
                'label' => __('Background Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '.side-panel .panel-nl-close:is(:hover,:focus)' => 'background: {{VALUE}};',
                ]
            ]
        );
        $this->add_control(
            'color_close_border_hover',
            [
                'label' => __('Border Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '.side-panel .panel-nl-close:is(:hover,:focus)' => 'border-color: {{VALUE}};',
                ]
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
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
    protected function render()
    {
        $settings = $this->get_settings_for_display();

?>
        <!-- side panel toggle btn -->
        <div class="side-panel-toggle">
            <div class="panel-toggle-btn panel-nl-btn">
                <i class="hicon-menu"></i>
            </div>
        </div>
<?php
    }
}

$widgets_manager->register(new Hexa_Sidepanel());
