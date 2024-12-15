<?php

namespace HexaCore\Widgets;

use Elementor\Widget_Base;


if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Hexa Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Hexa_TeamSlider extends Widget_Base
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
        return 'hf-team-slider';
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
        return __('Team Slider', 'hexacore');
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
                ],
                'default' => 'layout_1',
            ]
        );
        $this->end_controls_section();

        // member list
        $this->start_controls_section(
            'team_content_section',
            [
                'label' => __('Team Member', 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'member_image',
            [
                'label' => esc_html__('Photo', 'hexacore'),
                'type'  => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $repeater->add_control(
            'member_name',
            [
                'label' => esc_html__('Name', 'hexacore'),
                'type'  => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Coriss Ambady', 'hexacore'),
            ]
        );

        $repeater->add_control(
            'member_extra',
            [
                'label' => esc_html__('Extra/Job', 'hexacore'),
                'type'  => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Financial Analyst', 'hexacore'),
            ]
        );

        $repeater->add_control(
            'member_desc',
            [
                'label' => esc_html__('Description', 'hexacore'),
                'type'  => \Elementor\Controls_Manager::TEXTAREA,
                'default' => '',
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => __('Link To Details', 'hexacore'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://', 'hexacore'),
            ]
        );


        $repeater->add_control(
            'social_share',
            [
                'label' => __('Socials', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'hexacore'),
                'label_off' => __('Hide', 'hexacore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $default_social1_icon = [
            'value' => 'fab fa-facebook-f',
            'library' => 'fa-brand',
        ];
        $default_social2_icon = [
            'value' => 'fab fa-linkedin',
            'library' => 'fa-brand',
        ];
        $default_social3_icon = [
            'value' => 'fab fa-twitter',
            'library' => 'fa-brand',
        ];
        $default_social4_icon = [
            'value' => 'fab fa-youtube',
            'library' => 'fa-brand',
        ];

        $repeater->add_control(
            'social1',
            [
                'label' => esc_html__('Icon Social 1', 'hexacore'),
                'type'  => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => $default_social1_icon,
                'condition' => [
                    'social_share' => 'yes',
                ],
            ]
        );
        $repeater->add_control(
            'social1_link',
            [
                'label' => __('Link Social 1', 'hexacore'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://facebook.com/', 'hexacore'),
                'condition' => [
                    'social_share' => 'yes',
                ],
            ]
        );
        $repeater->add_control(
            'social1_color',
            [
                'label' => esc_html__('Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'social_share' => 'yes',
                ],
            ]
        );
        $repeater->add_control(
            'social1_bgcolor',
            [
                'label' => esc_html__('Background Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'social_share' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'social2',
            [
                'label' => esc_html__('Icon Social 2', 'hexacore'),
                'type'  => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => $default_social2_icon,
                'separator' => 'before',
                'condition' => [
                    'social_share' => 'yes',
                ],
            ]
        );
        $repeater->add_control(
            'social2_link',
            [
                'label' => __('Link Social 2', 'hexacore'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://linkedin.com/', 'hexacore'),
                'condition' => [
                    'social_share' => 'yes',
                ],
            ]
        );
        $repeater->add_control(
            'social2_color',
            [
                'label' => esc_html__('Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'social_share' => 'yes',
                ],
            ]
        );
        $repeater->add_control(
            'social2_bgcolor',
            [
                'label' => esc_html__('Background Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'social_share' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'social3',
            [
                'label' => esc_html__('Icon Social 3', 'hexacore'),
                'type'  => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => $default_social3_icon,
                'separator' => 'before',
                'condition' => [
                    'social_share' => 'yes',
                ],
            ]
        );
        $repeater->add_control(
            'social3_link',
            [
                'label' => __('Link Social 3', 'hexacore'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://twitter.com/', 'hexacore'),
                'condition' => [
                    'social_share' => 'yes',
                ],
            ]
        );
        $repeater->add_control(
            'social3_color',
            [
                'label' => esc_html__('Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'social_share' => 'yes',
                ],
            ]
        );
        $repeater->add_control(
            'social3_bgcolor',
            [
                'label' => esc_html__('Background Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'social_share' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'social4',
            [
                'label' => esc_html__('Icon Social 4', 'hexacore'),
                'type'  => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => $default_social4_icon,
                'separator' => 'before',
                'condition' => [
                    'social_share' => 'yes',
                ],
            ]
        );
        $repeater->add_control(
            'social4_link',
            [
                'label' => __('Link Social 4', 'hexacore'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://youtube.com/', 'hexacore'),
                'condition' => [
                    'social_share' => 'yes',
                ],
            ]
        );
        $repeater->add_control(
            'social4_color',
            [
                'label' => esc_html__('Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'social_share' => 'yes',
                ],
            ]
        );
        $repeater->add_control(
            'social4_bgcolor',
            [
                'label' => esc_html__('Background Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'social_share' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'team_slider',
            [
                'label'       => esc_html__('Teams', 'hexacore'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'show_label'  => true,
                'default'     => [
                    [
                        'member_name'      => __('Coriss Ambady', 'hexacore'),
                        'member_extra'      => __('Financial Analyst', 'hexacore'),
                        'social1'           => $default_social1_icon,
                        'social1_link'      => [
                            'url'     => '#'
                        ],
                        'social2'           => $default_social2_icon,
                        'social2_link'      => [
                            'url'     => '#'
                        ],
                        'social3'           => $default_social3_icon,
                        'social3_link'      => [
                            'url'     => '#'
                        ],
                        'social4'           => $default_social4_icon,
                        'social4_link'      => [
                            'url'     => '#'
                        ],
                    ],
                    [
                        'member_name'      => __('Cory Zamora', 'hexacore'),
                        'member_extra'      => __('Marketing Specialist', 'hexacore'),
                        'social1'           => $default_social1_icon,
                        'social1_link'      => [
                            'url'     => '#'
                        ],
                        'social2'           => $default_social2_icon,
                        'social2_link'      => [
                            'url'     => '#'
                        ],
                        'social3'           => $default_social3_icon,
                        'social3_link'      => [
                            'url'     => '#'
                        ],
                        'social4'           => $default_social4_icon,
                        'social4_link'      => [
                            'url'     => '#'
                        ],
                    ],
                    [
                        'member_name'      => __('Barclay Widerski', 'hexacore'),
                        'member_extra'      => __('Sales Specialist', 'hexacore'),
                        'social1'           => $default_social1_icon,
                        'social1_link'      => [
                            'url'     => '#'
                        ],
                        'social2'           => $default_social2_icon,
                        'social2_link'      => [
                            'url'     => '#'
                        ],
                        'social3'           => $default_social3_icon,
                        'social3_link'      => [
                            'url'     => '#'
                        ],
                        'social4'           => $default_social4_icon,
                        'social4_link'      => [
                            'url'     => '#'
                        ],
                    ]
                ],
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{member_name}}}',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'member_image_size',
                'exclude' => ['1536x1536', '2048x2048'],
                'include' => [],
                'default' => 'full',
            ]
        );

        $this->end_controls_section();

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

        $dots      = (in_array($settings['navigation'], ['dots', 'both']));
        $arrows    = (in_array($settings['navigation'], ['arrows', 'both']));
        $showXxl   = !empty($settings['tshow']) ? $settings['tshow'] : 3;
        $showXl    = !empty($settings['tshow_laptop']) ? $settings['tshow_laptop'] : $showXxl;
        $showLg    = !empty($settings['tshow_tablet_extra']) ? $settings['tshow_tablet_extra'] : $showXl;
        $showMd    = !empty($settings['tshow_tablet']) ? $settings['tshow_tablet'] : $showLg;
        $showSm    = !empty($settings['tshow_mobile_extra']) ? $settings['tshow_mobile_extra'] : $showMd;
        $showXs    = !empty($settings['tshow_mobile']) ? $settings['tshow_mobile'] : $showSm;

        $gapXxl      = isset($settings['slider_spacing']['size']) && is_numeric($settings['slider_spacing']['size']) ? ($settings['slider_spacing']['size'] - 30) : 0;
        $gapXl  = isset($settings['slider_spacing_laptop']['size']) && is_numeric($settings['slider_spacing_laptop']['size']) ? ($settings['slider_spacing_laptop']['size'] - 30) : $gapXxl;
        $gapLg  = isset($settings['slider_spacing_tablet_extra']['size']) && is_numeric($settings['slider_spacing_tablet_extra']['size']) ? ($settings['slider_spacing_tablet_extra']['size'] - 30) : $gapXl;
        $gapMd  = isset($settings['slider_spacing_tablet']['size']) && is_numeric($settings['slider_spacing_tablet']['size']) ? ($settings['slider_spacing_tablet']['size'] - 30) : $gapLg;
        $gapSm  = isset($settings['slider_spacing_mobile_extra']['size']) && is_numeric($settings['slider_spacing_mobile_extra']['size']) ? ($settings['slider_spacing_mobile_extra']['size'] - 30) : $gapMd;
        $gapXs  = isset($settings['slider_spacing_mobile']['size']) && is_numeric($settings['slider_spacing_mobile']['size']) ? ($settings['slider_spacing_mobile']['size'] - 30) : $gapSm;
        $timeout  = isset($settings['timeout']['size']) ? $settings['timeout']['size'] : 5000;

        $swiper_options = [
            'slides_show_desktop'           => absint($showXxl),
            'slides_show_laptop'           => absint($showXl),
            'slides_show_tablet_extra'   => absint($showLg),
            'slides_show_tablet'            => absint($showMd),
            'slides_show_mobile_extra'   => absint($showSm),
            'slides_show_mobile'            => absint($showXs),
            'margin_desktop'                   => absint($gapXxl),
            'margin_laptop'                   => absint($gapXl),
            'margin_tablet_extra'           => absint($gapLg),
            'margin_tablet'                   => absint($gapMd),
            'margin_mobile_extra'        => absint($gapSm),
            'margin_mobile'                   => absint($gapXs),
            'autoplay'                      => $settings['autoplay'] ? $settings['autoplay'] : 'no',
            'autoplay_time_out'             => absint($timeout),
            'loop'                          => $settings['loop'] ? $settings['loop'] : 'no',
            'arrows'                        => $arrows,
            'dots'                          => $dots,
        ];

        $this->add_render_attribute(
            'slides',
            [
                'class'               => 'hf-carousel ot-team-carousel',
                'data-slider_options' => wp_json_encode($swiper_options),
            ]
        );
?>

        <?php if ($settings['hexa_design_layout'] === 'layout_2') :

            $this->add_render_attribute(
                'slides2',
                [
                    'class'               => 'swiper team__active-two',
                    'data-slider_options' => wp_json_encode($swiper_options),
                ]
            );
        ?>

            <div <?php $this->print_render_attribute_string('slides2'); ?>>
                <div class="swiper-wrapper">
                    <?php
                    foreach ($settings['team_slider'] as $key => $mem) :
                        $image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src($mem['member_image']['id'], 'member_image_size', $settings);
                        if (empty($image_url)) {
                            $image_url = \Elementor\Utils::get_placeholder_image_src();
                        }
                        $image_html = '<img src="' . esc_attr($image_url) . '" alt="' . esc_attr($mem['member_name']) . '">';
                        $tname = $mem['member_name'];

                        if (!empty($mem['link']['url'])) {
                            $this->add_link_attributes('m_link' . $key, $mem['link']);
                            $tname = '<a ' . $this->get_render_attribute_string('m_link' . $key) . '>' . $tname . '</a>';
                        }
                    ?>
                        <div class="swiper-slide">
                            <div class="team__wrap team__item text-center style-two">

                                <?php if (!empty($mem['member_image']['url'])) { ?>
                                    <div class="team__thumb bg-solid">
                                        <a href="<?php echo $this->get_render_attribute_string('m_link' . $key); ?>">
                                            <?php echo wp_kses_post($image_html); ?>
                                        </a>
                                    </div>
                                <?php } ?>

                                <div class="team__content">
                                    <h6 class="team__title">
                                        <?php echo wp_kses_post($tname); ?>
                                    </h6>
                                    <span class="team__designation">
                                        <?php $this->print_unescaped_setting('member_extra', 'team_slider', $key); ?>
                                    </span>
                                    <?php if ($mem['social_share'] == 'yes') : ?>
                                        <div class="team__social">
                                            <ul>
                                                <?php if (!empty($mem['social1']['value'])) :
                                                    $this->add_link_attributes('social_1' . $key, $mem['social1_link']);
                                                    if (!empty($mem['social1_color']) || !empty($mem['social1_bgcolor'])) {
                                                        $this->add_render_attribute('social_1' . $key, 'style', [
                                                            'color: ' . $mem['social1_color'] . ';', 'background: ' . $mem['social1_bgcolor']
                                                        ]);
                                                    }
                                                ?>
                                                    <li>
                                                        <a <?php $this->print_render_attribute_string('social_1' . $key); ?>>
                                                            <?php \Elementor\Icons_Manager::render_icon($mem['social1'], ['aria-hidden' => 'true']); ?>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!empty($mem['social2']['value'])) :
                                                    $this->add_link_attributes('social_2' . $key, $mem['social2_link']);
                                                    if (!empty($mem['social2_color']) || !empty($mem['social2_bgcolor'])) {
                                                        $this->add_render_attribute('social_2' . $key, 'style', [
                                                            'color: ' . $mem['social2_color'] . ';', 'background: ' . $mem['social2_bgcolor']
                                                        ]);
                                                    }
                                                ?>
                                                    <li>
                                                        <a <?php $this->print_render_attribute_string('social_2' . $key); ?>>
                                                            <?php \Elementor\Icons_Manager::render_icon($mem['social2'], ['aria-hidden' => 'true']); ?>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!empty($mem['social3']['value'])) :
                                                    $this->add_link_attributes('social_3' . $key, $mem['social3_link']);
                                                    if (!empty($mem['social3_color']) || !empty($mem['social3_bgcolor'])) {
                                                        $this->add_render_attribute('social_3' . $key, 'style', [
                                                            'color: ' . $mem['social3_color'] . ';', 'background: ' . $mem['social3_bgcolor']
                                                        ]);
                                                    }
                                                ?>
                                                    <li>
                                                        <a <?php $this->print_render_attribute_string('social_3' . $key); ?>>
                                                            <?php \Elementor\Icons_Manager::render_icon($mem['social3'], ['aria-hidden' => 'true']); ?>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!empty($mem['social4']['value'])) :
                                                    $this->add_link_attributes('social_4' . $key, $mem['social4_link']);
                                                    if (!empty($mem['social4_color']) || !empty($mem['social4_bgcolor'])) {
                                                        $this->add_render_attribute('social_4' . $key, 'style', [
                                                            'color: ' . $mem['social4_color'] . ';', 'background: ' . $mem['social4_bgcolor']
                                                        ]);
                                                    }
                                                ?>
                                                    <li>
                                                        <a <?php $this->print_render_attribute_string('social_4' . $key); ?>>
                                                            <?php \Elementor\Icons_Manager::render_icon($mem['social4'], ['aria-hidden' => 'true']); ?>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- If we need pagination -->
                <div class="pagination__wrapper">
                    <div class="bd-swiper-dot text-center"></div>
                </div>
            </div>


        <?php else : ?>

            <div class="swiper team__active">
                <div class="swiper-wrapper">
                    <?php
                    foreach ($settings['team_slider'] as $key => $mem) :
                        $image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src($mem['member_image']['id'], 'member_image_size', $settings);
                        if (empty($image_url)) {
                            $image_url = \Elementor\Utils::get_placeholder_image_src();
                        }
                        $image_html = '<img src="' . esc_attr($image_url) . '" alt="' . esc_attr($mem['member_name']) . '">';
                        $tname = $mem['member_name'];

                        if (!empty($mem['link']['url'])) {
                            $this->add_link_attributes('m_link' . $key, $mem['link']);
                            $tname = '<a ' . $this->get_render_attribute_string('m_link' . $key) . '>' . $tname . '</a>';
                        }
                    ?>
                        <div class="swiper-slide wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                            <div class="team__wrap team__item text-center">

                                <?php if (!empty($mem['member_image']['url'])) { ?>
                                    <div class="team__thumb bg-solid">
                                        <a <?php echo $this->get_render_attribute_string('m_link' . $key); ?>>
                                            <?php echo wp_kses_post($image_html); ?>
                                        </a>
                                    </div>
                                <?php } ?>


                                <div class="team__content">
                                    <h6 class="team__title">
                                        <?php echo wp_kses_post($tname); ?>
                                    </h6>
                                    <span class="team__designation">
                                        <?php $this->print_unescaped_setting('member_extra', 'team_slider', $key); ?>
                                    </span>
                                    <?php if ($mem['social_share'] == 'yes') : ?>
                                        <div class="team__social">
                                            <ul>
                                                <?php if (!empty($mem['social1']['value'])) :
                                                    $this->add_link_attributes('social_1' . $key, $mem['social1_link']);
                                                    if (!empty($mem['social1_color']) || !empty($mem['social1_bgcolor'])) {
                                                        $this->add_render_attribute('social_1' . $key, 'style', [
                                                            'color: ' . $mem['social1_color'] . ';', 'background: ' . $mem['social1_bgcolor']
                                                        ]);
                                                    }
                                                ?>
                                                    <li>
                                                        <a <?php $this->print_render_attribute_string('social_1' . $key); ?>>
                                                            <?php \Elementor\Icons_Manager::render_icon($mem['social1'], ['aria-hidden' => 'true']); ?>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!empty($mem['social2']['value'])) :
                                                    $this->add_link_attributes('social_2' . $key, $mem['social2_link']);
                                                    if (!empty($mem['social2_color']) || !empty($mem['social2_bgcolor'])) {
                                                        $this->add_render_attribute('social_2' . $key, 'style', [
                                                            'color: ' . $mem['social2_color'] . ';', 'background: ' . $mem['social2_bgcolor']
                                                        ]);
                                                    }
                                                ?>
                                                    <li>
                                                        <a <?php $this->print_render_attribute_string('social_2' . $key); ?>>
                                                            <?php \Elementor\Icons_Manager::render_icon($mem['social2'], ['aria-hidden' => 'true']); ?>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!empty($mem['social3']['value'])) :
                                                    $this->add_link_attributes('social_3' . $key, $mem['social3_link']);
                                                    if (!empty($mem['social3_color']) || !empty($mem['social3_bgcolor'])) {
                                                        $this->add_render_attribute('social_3' . $key, 'style', [
                                                            'color: ' . $mem['social3_color'] . ';', 'background: ' . $mem['social3_bgcolor']
                                                        ]);
                                                    }
                                                ?>
                                                    <li>
                                                        <a <?php $this->print_render_attribute_string('social_3' . $key); ?>>
                                                            <?php \Elementor\Icons_Manager::render_icon($mem['social3'], ['aria-hidden' => 'true']); ?>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!empty($mem['social4']['value'])) :
                                                    $this->add_link_attributes('social_4' . $key, $mem['social4_link']);
                                                    if (!empty($mem['social4_color']) || !empty($mem['social4_bgcolor'])) {
                                                        $this->add_render_attribute('social_4' . $key, 'style', [
                                                            'color: ' . $mem['social4_color'] . ';', 'background: ' . $mem['social4_bgcolor']
                                                        ]);
                                                    }
                                                ?>
                                                    <li>
                                                        <a <?php $this->print_render_attribute_string('social_4' . $key); ?>>
                                                            <?php \Elementor\Icons_Manager::render_icon($mem['social4'], ['aria-hidden' => 'true']); ?>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- If we need pagination -->
                <div class="pagination__wrapper">
                    <div class="bd-swiper-dot text-center"></div>
                </div>
            </div>

<?php endif;
    }
}

$widgets_manager->register(new Hexa_TeamSlider());
