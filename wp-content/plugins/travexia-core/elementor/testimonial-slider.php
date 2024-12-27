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
class Hexa_Testimonial_Slider extends Widget_Base
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
        return 'hf-testimonial-slider';
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
        return __('Testimonial Slider', 'hexacore');
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
                    // 'layout-6' => esc_html__('Layout 6', 'hexacore'),
                    // 'layout-7' => esc_html__('Layout 7', 'hexacore'),

                ],
                'default' => 'layout_1',
            ]
        );

        $this->end_controls_section();

        // Review group
        $this->start_controls_section(
            'review_list',
            [
                'label' => esc_html__('Review List', 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __('Field condition', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'hexacore'),
                    'style_2' => __('Style 2', 'hexacore'),
                    // 'style_3' => __('Style 3', 'hexacore'),
                    // 'style_4' => __('Style 4', 'hexacore'),
                    // 'style_5' => __('Style 5', 'hexacore'),
                    // 'style_6' => __('Style 6', 'hexacore'),
                    // 'style_7' => __('Style 7', 'hexacore'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );


        $repeater->add_control(
            'timage',
            [
                'label' => __('Avatar', 'hexacore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'tcontent',
            [
                'label' => __('Content', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => '10',
                'default' => __('“Cum sociis natoque penatibus et magnis dis parturient montes.”', 'hexacore'),
            ]
        );

        $repeater->add_control(
            'tname',
            [
                'label' => __('Name', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Coriss Ambady', 'hexacore'),
            ]
        );

        $repeater->add_control(
            'tjob',
            [
                'label' => __('Job', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Financial Analyst', 'hexacore'),
            ]
        );
        $repeater->add_control(
            'is_rating',
            [
                'label' => esc_html__('Is Rating', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_off' => esc_html__('No', 'hexacore'),
                'label_on' => esc_html__('Yes', 'hexacore'),
            ]
        );
        $repeater->add_control(
            'rating',
            [
                'label' => __('Rating <span class="elementor-control-field-description">( 0-5 )</span>', 'hexacore'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 5,
                'step' => 1,
                'default' => 5,
                'condition' => [
                    'is_rating' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'is_quote',
            [
                'label' => esc_html__('Show quote icon', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_off' => esc_html__('No', 'hexacore'),
                'label_on' => esc_html__('Yes', 'hexacore'),
            ]
        );
        $repeater->add_control(
            'icon_type',
            [
                'label' => esc_html__('Quote Icon Type', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'hexacore'),
                    'icon' => esc_html__('Icon', 'hexacore'),
                    'svg' => esc_html__('SVG', 'hexacore'),
                ],
                'condition' => [
                    'is_quote' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'icon_svg',
            [
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'hexacore'),
                'condition' => [
                    'icon_type' => 'svg',
                    'is_quote' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'hexacore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'icon_type' => 'image',
                    'is_quote' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'selected_icon',
            [
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'label_block' => true,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
                'condition' => [
                    'icon_type' => 'icon',
                    'is_quote' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'testi_slider',
            [
                'label'       => '',
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'show_label'  => false,
                'default'     => [
                    [
                        'tcontent' => __('“Cum sociis natoque penatibus et magnis dis parturient montes.”', 'hexacore'),
                        'tname'      => __('Coriss Ambady', 'hexacore'),
                        'tjob'      => __('Financial Analyst', 'hexacore'),
                    ],
                    [
                        'tcontent' => __('“Cum sociis natoque penatibus et magnis dis parturient montes.”', 'hexacore'),
                        'tname'      => __('Cory Zamora', 'hexacore'),
                        'tjob'      => __('Marketing Specialist', 'hexacore'),
                    ],
                    [
                        'tcontent' => __('“Cum sociis natoque penatibus et magnis dis parturient montes.”', 'hexacore'),
                        'tname'      => __('Barclay Widerski', 'hexacore'),
                        'tjob'      => __('Sales Specialist', 'hexacore'),
                    ]
                ],
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{tname}}}',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'timage_size',
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
                'condition' => [
                    'hexa_design_layout' => 'layout-5'
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
        $this->hexa_section_style_controls('testi_section', 'Section - Style', '.hf-el-section');
        $this->hexa_basic_style_controls('testi_title', 'Title', '.hf-el-title');
        $this->hexa_icon_style_controls('icon_icon', 'Icon - Style', '.hf-el-icon');
        $this->hexa_basic_style_controls('testi_desc', 'Content', '.hf-el-desc');
        $this->hexa_basic_style_controls('testi_name', 'Name', '.hf-el-name');
        $this->hexa_basic_style_controls('testi_job', 'Degination', '.hf-el-job');
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

    protected function get_class_rating($rating)
    {
        $number_rating = [
            '1' => 'one',
            '2' => 'two',
            '3' => 'three',
            '4' => 'four',
            '5' => 'five',
        ];

        return isset($number_rating[$rating]) ? $number_rating[$rating] : 'empty';
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>

        <!--	testimonial style 2 -->
        <?php if ($settings['hexa_design_layout']  == 'layout_2') : ?>

            <div class="row">
                <div class="col-12">
                    <div class="tr-testimonial-2-slider-wrapper">
                        <div class="swiper-container tr-testimonial-2-active">
                            <div class="swiper-wrapper"> 
                                <?php foreach ($settings['testi_slider'] as $key => $item) :
                                $image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src($item['timage']['id'], 'timage_size', $settings);
                                if (empty($image_url)) {
                                    $image_url = \Elementor\Utils::get_placeholder_image_src();
                                }
                                $image_html = '<img src="' . esc_attr($image_url) . '" alt="' . esc_attr($item['tname']) . '">';
                                ?>                           
                                    <div class="swiper-slide">
                                        <div class="tr-testimonial-2-item text-center p-relative">
                                            <?php if (!empty($item['is_quote'])) { ?>
                                                <span class="tr-testimonial-quote">
                                                    <?php if ($item['icon_type'] == 'icon') : ?>
                                                        <?php if (!empty($item['selected_icon']['value'])) : ?>
                                                            <div class="hf-el-rep-icon hf-el-icon">
                                                                <?php \Elementor\Icons_Manager::render_icon($item['selected_icon'], ['aria-hidden' => 'true']); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php elseif ($item['icon_type'] == 'image') : ?>
                                                        <?php if (!empty($item['icon_image']['url'])) : ?>
                                                            <div class="hf-el-rep-icon hf-el-icon">
                                                                <img src="<?php echo $item['icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php else : ?>
                                                        <?php if (!empty($item['icon_svg'])) : ?>
                                                            <div class="hf-el-rep-icon hf-el-icon">
                                                                <?php echo $item['icon_svg']; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </span>
                                            <?php } ?>

                                            <div class="tr-testimonial-content">
                                                <p>
                                                    <?php $this->print_unescaped_setting('tcontent', 'testi_slider', $key); ?>
                                                </p>
                                            </div>

                                            <div class="tr-testimonial-author-wrap d-flex align-items-center">
                                                <div class="tr-testimonial-author-thumb">
                                                    <?php if (!empty($item['timage']['url'])) {
                                                        echo wp_kses_post($image_html);
                                                    } ?>
                                                </div>
                                                <div class="tr-testimonial-author-info text-start">
                                                    
                                                    <?php if (!empty($item['tname'])) { ?>
                                                        <h5 class="tr-testimonial-author-title hf-el-name">
                                                            <?php $this->print_unescaped_setting('tname', 'testi_slider', $key); ?>
                                                        </h5>
                                                    <?php } ?>
                                                    <span class="testimonial__avatar-designation hf-el-job">
                                                        <?php if (!empty($item['tjob'])) { ?>
                                                            <?php $this->print_unescaped_setting('tjob', 'testi_slider', $key); ?>
                                                        <?php } ?>
                                                    </span>

                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                <?php endforeach; ?>                           
                            </div>
                        </div>
                        <div class="tr-slider-dots text-center mt-55"></div>
                    </div>
                </div>
            </div>


        <?php else : ?>

            <div class="row align-items-center">
                <div class="col-xl-4 col-lg-4">
                    <div class="tr-testimonial-left tr-slider-nav fix">
                        <?php foreach ($settings['testi_slider'] as $key => $item) :
                            $image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src($item['timage']['id'], 'timage_size', $settings);
                            if (empty($image_url)) {
                                $image_url = \Elementor\Utils::get_placeholder_image_src();
                            }
                            $image_html = '<img src="' . esc_attr($image_url) . '" alt="' . esc_attr($item['tname']) . '">';
                            ?>
                            <div class="tr-testimonial-author-wrap d-flex align-items-center mb-20">
                                <div class="tr-testimonial-author-thumb">
                                    <?php if (!empty($item['timage']['url'])) {
                                        echo wp_kses_post($image_html);
                                    } ?>
                                </div>
                                <div class="tr-testimonial-author-info">
                                    <?php if (!empty($item['tname'])) { ?>
                                        <h5 class="tr-testimonial-author-title hf-el-name">
                                            <?php $this->print_unescaped_setting('tname', 'testi_slider', $key); ?>
                                        </h5>
                                    <?php } ?>
                                    <span class="testimonial__avatar-designation hf-el-job">
                                        <?php if (!empty($item['tjob'])) { ?>
                                            <?php $this->print_unescaped_setting('tjob', 'testi_slider', $key); ?>
                                        <?php } ?>
                                    </span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8">
                    <div class="tr-testimonial-content-wrap tr-slider-for">
                        <?php foreach ($settings['testi_slider'] as $key => $item) : ?>
                            <div class="tr-testimonial-content">
                                <?php if (!empty($item['is_quote'])) { ?>
                                    <div class="tr-testimonial-quote">
                                        <?php if ($item['icon_type'] == 'icon') : ?>
                                            <?php if (!empty($item['selected_icon']['value'])) : ?>
                                                <div class="hf-el-rep-icon hf-el-icon">
                                                    <?php \Elementor\Icons_Manager::render_icon($item['selected_icon'], ['aria-hidden' => 'true']); ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php elseif ($item['icon_type'] == 'image') : ?>
                                            <?php if (!empty($item['icon_image']['url'])) : ?>
                                                <div class="hf-el-rep-icon hf-el-icon">
                                                    <img src="<?php echo $item['icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                </div>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <?php if (!empty($item['icon_svg'])) : ?>
                                                <div class="hf-el-rep-icon hf-el-icon">
                                                    <?php echo $item['icon_svg']; ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                <?php } ?>

                                <p>
                                    <?php $this->print_unescaped_setting('tcontent', 'testi_slider', $key); ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        <?php endif;
    }
}

$widgets_manager->register(new Hexa_Testimonial_Slider());
