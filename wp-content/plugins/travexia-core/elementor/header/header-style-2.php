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
class Hexa_Header_Style_2 extends Widget_Base
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
        return 'hf-header-style-two';
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
        return __('Header Style Two', 'hexacore');
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
            'content_logo_section',
            [
                'label' => __('Logo', 'hexacore'),
            ]
        );

        $this->add_responsive_control(
            'Logo_align',
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
                'selectors' => [
                    '{{WRAPPER}} .hexa-el-logo' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'logo_image',
            [
                'label' => esc_html__('Image', 'hexacore'),
                'type'  => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'logo_link',
            [
                'label' => esc_html__('Link', 'hexacore'),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'label_block' => true,
            ]
        );

        $this->add_responsive_control(
            'logo_width',
            [
                'label' => __('Width', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hexa-el-logo img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


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

        $this->start_controls_section(
            'content_hcontact_section',
            [
                'label' => __('Contact Info', 'hexacore'),
            ]
        );

        $this->add_control(
            'phone_label',
            [
                'label' => esc_html__('Phone Label', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Need help?', 'hexacore'),
                'title' => esc_html__('Enter text', 'hexacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'phone_text',
            [
                'label' => esc_html__('Phone Number', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('(307) 555-0133', 'hexacore'),
                'title' => esc_html__('Enter number', 'hexacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'phone_link',
            [
                'label' => esc_html__('Phone link', 'hexacore'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'hexacore'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'login_text',
            [
                'label' => esc_html__('Login Text', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Login', 'hexacore'),
                'title' => esc_html__('Enter text', 'hexacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'login_link',
            [
                'label' => esc_html__('Login link', 'hexacore'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'hexacore'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                ],
                'label_block' => true,
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

        if (!empty($settings['logo_link']['url'])) {
            $this->add_link_attributes('logo_link', $settings['logo_link']);
        }

        $this->add_render_attribute('phone', 'class', 'border-line-black');
        if (!empty($settings['phone_link']['url'])) {
            $this->add_link_attributes('phone', $settings['phone_link']);
        }

        $this->add_render_attribute('login', 'class', 'hexa-login tr-btn');
        if (!empty($settings['login_link']['url'])) {
            $this->add_link_attributes('login', $settings['login_link']);
        }
?>

        <div class="tr-header-height">
            <div id="header-sticky" class="tr-header-area tr-header-ptb">
                <div class="container container-1790">
                    <div class="header-inner d-flex align-items-center justify-content-between">
                        <?php if (!empty($settings['logo_image']['url'])) : ?>
                            <div class="tr-header-logo">
                                <a <?php echo $this->get_render_attribute_string('logo_link'); ?>>
                                    <img src="<?php echo esc_attr($settings['logo_image']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="tr-header-menu tr-dropdown-menu">
                            <nav class="it-menu-content">
                                <?php echo $menu_html; ?>
                            </nav>
                        </div>

                        <div class="tr-header-right-action d-flex justify-content-end align-items-center">
                            <?php if (!empty($settings['phone_text'])) : ?>
                                <div class="tr-header-right-tel d-none d-xxl-flex align-items-center">
                                    <div class="tr-header-right-tel-icon">
                                        <span>
                                            <svg width="55" height="55" viewBox="0 0 55 55" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M31.8535 30.2461H42.8705" stroke="currentcolor" stroke-width="2.57908" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M31.8535 35.3555H42.8705" stroke="currentcolor" stroke-width="2.57908" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M31.8535 40.4648H42.8705" stroke="currentcolor" stroke-width="2.57908" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M12.041 12.0547H23.058" stroke="currentcolor" stroke-width="2.57908" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M12.041 17.1641H23.058" stroke="currentcolor" stroke-width="2.57908" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M12.041 22.2773H17.5495" stroke="currentcolor" stroke-width="2.57908" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                <mask id="mask0_7810_514" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="55" height="55">
                                                    <path d="M0 7.62939e-06H55V55H0V7.62939e-06Z" fill="white" />
                                                </mask>
                                                <g mask="url(#mask0_7810_514)">
                                                    <path d="M37.3613 47.2486H42.27H44.6512C44.9039 47.2486 44.8766 47.2394 45.1019 47.3581L49.8704 49.8037C50.1292 49.898 50.251 49.8281 50.2388 49.5694L49.9618 44.4805C49.9557 44.441 49.9465 44.435 49.9739 44.4106C52.5501 42.2205 54.1943 38.9628 54.1943 35.34V34.8229C54.1943 28.2708 48.829 22.9112 42.27 22.9112H32.1939C25.6349 22.9112 20.2695 28.2708 20.2695 34.8229V35.34C20.2695 41.889 25.6349 47.2486 32.1939 47.2486H33.6403" stroke="currentcolor" stroke-width="2.57908" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M18.3959 5.15734H22.8021C29.3611 5.15734 34.7264 10.517 34.7264 17.069V17.583C34.7264 19.4963 34.2697 21.3063 33.4596 22.9124M21.5384 29.4947H12.7291H10.3478C10.0921 29.4947 10.1195 29.4856 9.89408 29.6012L5.12562 32.0499C4.86985 32.1442 4.74503 32.0741 4.76018 31.8126L5.03432 26.7267C5.04033 26.6841 5.04946 26.678 5.02207 26.6568C2.44599 24.4666 0.804688 21.2089 0.804688 17.583V17.069C0.804688 10.517 6.17009 5.15734 12.7291 5.15734H14.6749" stroke="currentcolor" stroke-width="2.57908" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                </g>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="tr-header-right-tel-content">
                                        <span><?php $this->print_unescaped_setting('phone_label'); ?></span>
                                        <a <?php echo $this->get_render_attribute_string('phone'); ?>>
                                            <?php $this->print_unescaped_setting('phone_text'); ?>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($settings['login_text'])) : ?>
                                <div class="tr-header-right-loging ml-40 d-none d-lg-block">
                                    <i class="fa-solid fa-user"></i>
                                    <a <?php echo $this->get_render_attribute_string('login'); ?>>
                                        <?php $this->print_unescaped_setting('login_text'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="tr-header-bar d-xl-none ml-30">
                                <button class="tr-menu-bar">
                                    <i class="fa-sharp fa-light fa-bars-staggered"></i>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
    }
}

$widgets_manager->register(new Hexa_Header_Style_2());
