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
class Hexa_Menu_Mobile extends Widget_Base
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
        return 'hf-menu-mobile';
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
        return __('Mobile Menu', 'hexacore');
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
                'label' => __('Menu Mobile', 'hexacore'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'pos_menu',
            [
                'label' => __('Position', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'on-right',
                'options' => [
                    'on-left'     => __('On Left', 'hexacore'),
                    'on-right'  => __('On Right', 'hexacore'),
                ]
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

        $this->add_control(
            'mlogo_image',
            [
                'label' => esc_html__('Side Logo', 'hexacore'),
                'type'  => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_responsive_control(
            'mlogo_width',
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
                    '{{WRAPPER}} .mmenu-panel-logo img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'mlogo_link',
            [
                'label' => esc_html__('Link', 'hexacore'),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                    // 'custom_attributes' => '',
                ],
                'label_block' => true,
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'mconact_section',
            [
                'label' => __('Contact Info', 'hexacore'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'ctitle',
            [
                'label' => __('Title', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __('Type your title', 'hexacore'),
                'default' => __('Contact Info', 'hexacore'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'icon_type',
            [
                'label' => __('Icon Type', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'font',
                'options' => [
                    'font'     => __('Font Icon', 'hexacore'),
                    'image' => __('Image Icon', 'hexacore'),
                    'class' => __('Custom Icon', 'hexacore'),
                ]
            ]
        );

        $repeater->add_control(
            'icon_font',
            [
                'label' => __('Icon', 'hexacore'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'label_block' => true,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'icon_type' => 'font',
                ]
            ]
        );
        $repeater->add_control(
            'icon_image',
            [
                'label' => esc_html__('Photo', 'hexacore'),
                'type'  => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
                'condition' => [
                    'icon_type' => 'image',
                ]
            ]
        );
        $repeater->add_control(
            'icon_class',
            [
                'label' => __('Custom Class', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('flaticon-world-globe', 'hexacore'),
                'condition' => [
                    'icon_type' => 'class',
                ]
            ]
        );

        $repeater->add_control(
            'clabel',
            [
                'label' => __('Lable', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __('Email us', 'hexacore'),
                'default' => __('Email us', 'hexacore'),
            ]
        );

        $repeater->add_control(
            'text',
            [
                'label' => __('Text', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __('info@email.com', 'hexacore'),
                'default' => __('info@email.com', 'hexacore'),
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => __('Link', 'hexacore'),
                'type' => \Elementor\Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => __('https://your-link.com', 'hexacore'),
            ]
        );

        $this->add_control(
            'info_list',
            [
                'label' => 'Contact Info',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'text' => __('info@email.com', 'hexacore'),
                    ],
                    [
                        'text' => __('00 (123) 456 78 90', 'hexacore'),
                    ],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'msocial_section',
            [
                'label' => __('Social Profiles', 'hexacore'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'stitle',
            [
                'label' => __('Title', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __('Type your title', 'hexacore'),
                'default' => __('Follow Us', 'hexacore'),
            ]
        );

        $repeater2 = new \Elementor\Repeater();

        $repeater2->add_control(
            'icon_type2',
            [
                'label' => __('Icon Type', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'font',
                'options' => [
                    'font'     => __('Font Icon', 'hexacore'),
                    'image' => __('Image Icon', 'hexacore'),
                    'class' => __('Custom Icon', 'hexacore'),
                ]
            ]
        );

        $repeater2->add_control(
            'icon_font2',
            [
                'label' => __('Icon', 'hexacore'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'label_block' => true,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'icon_type2' => 'font',
                ]
            ]
        );

        $repeater2->add_control(
            'icon_image2',
            [
                'label' => esc_html__('Photo', 'hexacore'),
                'type'  => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
                'condition' => [
                    'icon_type2' => 'image',
                ]
            ]
        );

        $repeater2->add_control(
            'icon_class2',
            [
                'label' => __('Custom Class', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('fas fa-star', 'hexacore'),
                'condition' => [
                    'icon_type2' => 'class',
                ]
            ]
        );

        $repeater2->add_control(
            'social_link',
            [
                'label' => __('Link', 'hexacore'),
                'type' => \Elementor\Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => __('https://your-link.com', 'hexacore'),
            ]
        );

        $this->add_control(
            'social_list',
            [
                'label' => 'Socials',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater2->get_controls(),
                'default' => [
                    [
                        'icon_font2' => [
                            'value' => 'fa fa-smile',
                        ],
                    ],
                ],
                'title_field' => '<# var migrated = "undefined" !== typeof __fa4_migrated, social = ( "undefined" === typeof social ) ? false : social; #>{{{ icon_font2.value }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function register_styles_section()
    {
        $this->toggle_menu_btn();
        $this->mobile_mmenu_panel();
        $this->main_mobile_menu();
        $this->msubmenu_toggle();
        $this->contact_info_mobile();
        $this->social_info_mobile();
    }
    // toggle btn
    protected function toggle_menu_btn()
    {
        /*** Style ***/
        $this->start_controls_section(
            'style_icon_section',
            [
                'label' => __('Menu Toggle Style', 'hexacore'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => __('Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .panel-el-btn' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .panel-el-btn:hover' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .panel-el-btn' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }
    //mmenu panel
    protected function mobile_mmenu_panel()
    {
        $this->start_controls_section(
            'style_panel_section',
            [
                'label' => __('Mobile Menu Panel Style', 'hexacore'),
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
                    '{{WRAPPER}} .mmenu-el-panel' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .mmenu-el-panel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .mmenu-el-panel' => 'background: {{VALUE}};',
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
                    '{{WRAPPER}} .body-el-overlay' => 'background: {{VALUE}};',
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
                    '{{WRAPPER}} .panel-el-close' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .panel-el-close' => 'background: {{VALUE}};',
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
                    '{{WRAPPER}} .panel-el-close' => 'border-color: {{VALUE}};',
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
                    '{{WRAPPER}} .panel-el-close:is(:hover,:focus)' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .panel-el-close:is(:hover,:focus)' => 'background: {{VALUE}};',
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
                    '{{WRAPPER}} .panel-el-close:is(:hover,:focus)' => 'border-color: {{VALUE}};',
                ]
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }
    // mobile menu
    protected function main_mobile_menu()
    {
        /*** Style ***/
        $this->start_controls_section(
            'style_menu_section',
            [
                'label' => __('Mobile Menu Style', 'hexacore'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'menu_typography',
                'selector' => '{{WRAPPER}} .main-navigation ul li a',
            ]
        );
        $this->add_control(
            'mmenu_text_color',
            [
                'label' => __('Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mobile-nav .mobile-menu ul li a' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control(
            'mmenu_thover_color',
            [
                'label' => __('Hover Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mobile-nav .mobile-menu ul li a:is(:hover, :focus)' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control(
            'mmenu_border_color',
            [
                'label' => __('Border Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mobile-nav .mobile-menu ul li:not(:last-child)' => 'border-color: {{VALUE}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'mmenu_item',
            [
                'label' => esc_html__('Padding', 'hexacore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .mobile-nav .mobile-menu ul li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    // submenu toggle 
    protected function msubmenu_toggle()
    {
        $this->hexa_icon_style_controls('msmenu_toogle', 'Sub Menu Toggle - Style', '.mobile-nav .mobile-menu ul > li.menu-item-has-children .arrow');
    }
    // contact info
    protected function contact_info_mobile()
    {
        $this->hexa_basic_style_controls('contact_title', 'Contact Title - Style', '.hexa-ct-title');
        $this->hexa_icon_style_controls('contact_icon', 'Contact Icon - Style', '.hexa-ct-icon');
    }
    // social info
    protected function social_info_mobile()
    {
        $this->hexa_basic_style_controls('social_title', 'Social Title - Style', '.hexa-sl-title');
        $this->hexa_icon_style_controls('social_icon', 'Social Icon - Style', '.hexa-sl-icon');
    }

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

        if (!empty($settings['mlogo_image']['url'])) {
            $this->add_render_attribute('mlogo_image', 'src', $settings['mlogo_image']['url']);
            $this->add_render_attribute('mlogo_image', 'alt', \Elementor\Control_Media::get_image_alt($settings['mlogo_image']));
            $this->add_render_attribute('mlogo_image', 'title', \Elementor\Control_Media::get_image_title($settings['mlogo_image']));
        }
        if (!empty($settings['mlogo_link']['url'])) {
            $this->add_link_attributes('mlogo_link', $settings['mlogo_link']);
        }
?>

        <!-- mmenu panel toggle btn -->
        <div class="mmenu-panel-toggle">
            <div class="mmenu-toggle-btn panel-el-btn">
                <i class="hicon-menu"></i>
            </div>
        </div>
        <!-- Sidebar Area Start Here  -->
        <div id="mmenu-panel" class="mmenu-panel mmenu-el-panel <?php echo $settings['pos_menu']; ?>">
            <div class="mmenu-panel-content">
                <div class="mmenu-panel-content-top d-flex align-items-center justify-content-between mb-50">
                    <div class="mmenu-panel-logo" id="site-logo">
                        <a <?php echo $this->get_render_attribute_string('mlogo_link'); ?>>
                            <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings, 'full', 'mlogo_image'); ?>
                        </a>
                    </div>
                    <div class="mmenu-panel-close">
                        <button class="mmenu-close-btn panel-el-close">
                            <i class="hicon-cancel"></i>
                        </button>
                    </div>
                </div>
                <!-- mobile menu -->
                <div class="mobile-nav mb-40">
                    <nav class="mobile-menu">
                        <?php echo $menu_html; ?>
                    </nav>
                </div>
                <!-- mobile contact info-->

                <div class="mmenu-panel-contact mb-40">
                    <?php if (!empty($settings['ctitle'])) : ?>
                        <h3 class="contact-title hexa-ct-title"><?php echo wp_kses_post($settings['ctitle']); ?></h3>
                    <?php endif; ?>
                    <ul>
                        <?php foreach ($settings['info_list'] as $key => $item) : ?>
                            <li>
                                <?php if (!empty($item['text'])) : ?>
                                    <div class="contact-info d-flex align-items-center">
                                        <div class="contact-icon hexa-icon hexa-ct-icon">
                                            <?php if ($item['icon_type'] == 'font') {
                                                \Elementor\Icons_Manager::render_icon($item['icon_font'], ['aria-hidden' => 'true']);
                                            } ?>
                                            <?php if ($item['icon_type'] == 'image') { ?>
                                                <img src="<?php echo esc_attr($item['icon_image']['url']); ?>" alt="<?php echo esc_attr($item['title']); ?>">
                                            <?php } ?>
                                            <?php if ($item['icon_type'] == 'class') { ?>
                                                <i class="<?php echo esc_attr($item['icon_class']); ?>"></i>
                                            <?php } ?>
                                        </div>
                                        <div class="contact-content">
                                            <?php if (!empty($item['clabel'])) : ?>
                                                <span class="label"><?php echo esc_html($item['clabel']); ?></span>
                                            <?php endif; ?>
                                            <a href="<?php echo esc_url($item['link']['url']); ?>">
                                                <?php echo esc_html($item['text']); ?>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- social info -->
                <div class="mmenu-panel-social">
                    <?php if (!empty($settings['stitle'])) : ?>
                        <h3 class="social-title hexa-sl-title"><?php echo wp_kses_post($settings['stitle']); ?></h3>
                    <?php endif; ?>
                    <div class="contact-social">
                        <?php foreach ($settings['social_list'] as $key => $item) :
                            if (!empty($item['icon_type2'] == 'font') || !empty($item['icon_type2'] == 'image') || !empty($item['icon_type2'] == 'class')) :
                                echo '<a class="hexa-icon hexa-sl-icon" href="' . $item['social_link']['url'] . '">'; ?>
                                <?php if ($item['icon_type2'] == 'font') {
                                    \Elementor\Icons_Manager::render_icon($item['icon_font2'], ['aria-hidden' => 'true']);
                                } ?>
                                <?php if ($item['icon_type2'] == 'image') { ?>
                                    <img src="<?php echo esc_attr($item['icon_image2']['url']); ?>" alt="<?php echo esc_attr($item['title']); ?>">
                                <?php } ?>
                                <?php if ($item['icon_type2'] == 'class') { ?>
                                    <i class="<?php echo esc_attr($item['icon_class2']); ?>"></i>
                                <?php }
                                echo '</a>'; ?>
                        <?php endif;
                        endforeach; ?>
                    </div>
                </div>

            </div>
        </div>
        <!-- Sidebar Area Start Here  -->
        <div class="site-overlay body-el-overlay"></div>
<?php
    }
}

$widgets_manager->register(new Hexa_Menu_Mobile());
