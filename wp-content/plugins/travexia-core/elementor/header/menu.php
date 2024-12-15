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
class Hexa_Menu extends Widget_Base
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
        return 'hf-nav-menu';
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
        return __('Nav Menu', 'hexacore');
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

    // nav_menu_index
    protected $nav_menu_index = 1;

    // get_nav_menu_index
    protected function get_nav_menu_index()
    {
        return $this->nav_menu_index++;
    }

    protected function get_available_menus()
    {

        $menus = wp_get_nav_menus();

        $options = [];

        foreach ($menus as $menu) {
            $options[$menu->slug] = $menu->name;
        }

        return $options;
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
        $this->register_contents_section();
        $this->register_styles_section();
    }

    protected function register_contents_section()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Menu', 'hexacore'),
            ]
        );

        $menus = $this->get_available_menus();

        if (!empty($menus)) {
            $this->add_control(
                'nav_menu',
                [
                    'label'        => esc_html__('Select Menu', 'hexacore'),
                    'type'         => \Elementor\Controls_Manager::SELECT,
                    'multiple'     => false,
                    'options'      => $menus,
                    'default'      => array_keys($menus)[0],
                    'save_default' => true,
                ]
            );
        } else {
            $this->add_control(
                'nav_menu',
                [
                    'type'            => \Elementor\Controls_Manager::RAW_HTML,
                    'raw'             => sprintf(esc_html__('<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'hexacore'), admin_url('nav-menus.php?action=edit&menu=0')),
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                ]
            );
        }

        $this->add_responsive_control(
            'align',
            [
                'label' => __('Alignment', 'hexacore'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start'    => [
                        'title' => __('Left', 'hexacore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'hexacore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'end' => [
                        'title' => __('Right', 'hexacore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .main-navigation > ul' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_styles_section()
    {
        /*** Style ***/
        $this->start_controls_section(
            'style_menu_section',
            [
                'label' => __('Navigation Menu', 'hexacore'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'space_item',
            [
                'label' => __('Items Spacing', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .main-navigation > ul' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'padding_item',
            [
                'label' => __('Padding Top/Bottom', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .main-navigation > ul > li > a' => 'padding: {{SIZE}}{{UNIT}} 0;',
                ],
            ]
        );
        $this->add_control(
            'text_color',
            [
                'label' => __('Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .main-navigation > ul > li > a, {{WRAPPER}} .main-navigation > ul > li.menu-item-has-children > a:after' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control(
            'text_hover_color',
            [
                'label' => __('Hover Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .main-navigation > ul > li:hover > a, {{WRAPPER}} .main-navigation > ul > li.menu-item-has-children:hover > a:after' => 'color: {{VALUE}};',
                    // '{{WRAPPER}} .main-navigation > ul > li:before, {{WRAPPER}} .main-navigation > ul > li > a.mPS2id-highlight:before' => 'background: {{VALUE}};',
                ]
            ]
        );
        $this->add_control(
            'text_active_color',
            [
                'label' => __('Active Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .main-navigation > ul > li.active > a, {{WRAPPER}} .main-navigation > ul > li.menu-item-has-children.active > a:after' => 'color: {{VALUE}};',
                    // '{{WRAPPER}} .main-navigation > ul > li:before, {{WRAPPER}} .main-navigation > ul > li > a.mPS2id-highlight:before' => 'background: {{VALUE}};',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'menu_typography',
                'selector' => '{{WRAPPER}} .main-navigation ul li a',
            ]
        );

        $this->end_controls_section();

        //menu child
        $this->start_controls_section(
            'style_smenu_section',
            [
                'label' => __('Dropdown Panel', 'hexacore'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'smenu_width',
            [
                'label' => __('Width', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 240,
                        'max' => 700,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul li ul.sub-menu' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'smenu_padding',
            [
                'label' => esc_html__('Padding', 'hexacore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul ul.sub-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'smenu_border',
                'selector' => '{{WRAPPER}} .main-navigation ul ul.sub-menu',
            ]
        );
        $this->add_control(
            'smenu_radius',
            [
                'label' => __('Border Radius', 'hexacore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul ul.sub-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'smenu_shadow',
                'selector' => '{{WRAPPER}} .main-navigation ul ul.sub-menu',
            ]
        );
        $this->add_control(
            'bg_s_color',
            [
                'label' => __('Background Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul ul.sub-menu' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'style_sitem_section',
            [
                'label' => __('Dropdown Menus', 'hexacore'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'stext_typography',
                'selector' => '{{WRAPPER}} .main-navigation ul ul.sub-menu li a',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'sitem_border',
                'selector' => '{{WRAPPER}} .main-navigation ul ul.sub-menu li',
            ]
        );
        $this->add_control(
            'stext_padding',
            [
                'label' => esc_html__('Padding', 'hexacore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul ul.sub-menu li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs('stext_style_tabs');
        $this->start_controls_tab('stext_normal_tab', ['label' => esc_html__('Normal', 'hexacore'),]);
        $this->add_control(
            'stext_normal_color',
            [
                'label' => __('Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul ul.sub-menu li a, {{WRAPPER}} .main-navigation ul ul.sub-menu > li.menu-item-has-children > a:after' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control(
            'sitem_bg_normal_color',
            [
                'label' => __('Hover Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul ul.sub-menu li' => 'background-color: {{VALUE}};',
                ]
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab('stext_hover_tab', ['label' => esc_html__('Hover', 'hexacore'),]);
        $this->add_control(
            'stext_hover_color',
            [
                'label' => __('Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul ul.sub-menu li a:hover, {{WRAPPER}} .main-navigation ul ul.sub-menu li.current-menu-item > a, {{WRAPPER}} .main-navigation ul ul.sub-menu > li.menu-item-has-children > a:hover:after' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control(
            'sitem_bg_hover_color',
            [
                'label' => __('Hover Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul ul.sub-menu > li:hover' => 'color: {{VALUE}};',
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
        $menus = $this->get_available_menus();
        if (empty($menus)) {
            return false;
        }

        $settings = $this->get_settings_for_display();

        if (class_exists('\HexaCore\Widgets\Hexa_Navwalker_Class')) {
            $hexa_nav_walker = new Hexa_Navwalker_Class();
        } else {
            $hexa_nav_walker = '';
        }

        $args = [
            'echo'        => false,
            'menu'        => $settings['nav_menu'],
            'menu_class'  => '',
            'menu_id'     => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
            'container'   => 'ul',
            'fallback_cb' => '__return_empty_string',
            'walker'      => $hexa_nav_walker,
        ];

        $menu_html = wp_nav_menu($args);
?>

        <div class="hexa-menu-wrapper">
            <nav id="hexa-mobile-menu" class="main-navigation">
                <?php echo $menu_html; ?>
            </nav>
        </div>

<?php
    }
}

$widgets_manager->register(new Hexa_Menu());
