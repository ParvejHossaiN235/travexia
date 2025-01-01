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
class Hexa_Text_Slider extends Widget_Base
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
        return 'hf-text-slider';
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

        return __('Text Slider', 'hexacore');
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

        // Review group
        $this->start_controls_section(
            'review_list',
            [
                'label' => esc_html__('Content', 'hexacore'),
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
                    //'style_2' => __('Style 2', 'hexacore'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'tcontent',
            [
                'label' => __('Content', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => '10',
                'default' => __('This text slider content', 'hexacore'),
            ]
        );

        $repeater->add_control(
            'tcontent2',
            [
                'label' => __('Content', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => '10',
                'default' => __('This text slider content', 'hexacore'),
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
                        'tcontent' => __('This text slider content', 'hexacore'),
                    ],
                    [
                        'tcontent' => __('This text slider content', 'hexacore'),
                    ],
                    [
                        'tcontent' => __('This text slider content', 'hexacore'),
                    ]
                ],
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{tcontent}}}',
            ]
        );

        $this->end_controls_section();         

    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->hexa_section_style_controls('testi_section', 'Section - Style', '.hf-el-section');
        $this->hexa_basic_style_controls('testi_title', 'Title', '.hf-el-title');
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

        <!--	testimonial style 2 -->
        <?php if ($settings['hexa_design_layout']  == 'layout_2') : ?>


        <?php else : ?>

            <div class="tr-text-slider-area fix">
                <div class="container-fluid p-0">
                    <div class="tr-text-slider-top">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="swiper-container tr-text-slider-active">
                                    <div class="swiper-wrapper slider-transtion">
                                    <?php foreach ($settings['testi_slider'] as $key => $item) : ?>
                                        <div class="swiper-slide">
                                            <?php if (!empty($item['tcontent'])) : ?>
                                                <div class="tr-text-slider-item">
                                                    <?php echo hexa_kses($item['tcontent']); ?>
                                                </div>
                                            <?php endif; ?>                           
                                        </div> 
                                    <?php endforeach; ?>                                   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="tr-text-slider-bottom">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="swiper-container tr-text-slider-active" dir="rtl">
                                    <div class="swiper-wrapper slider-transtion">
                                        <?php foreach ($settings['testi_slider'] as $key => $item) : ?>
                                            <div class="swiper-slide">
                                                
                                                <?php if (!empty($item['tcontent2'])) : ?>
                                                    <div class="tr-text-slider-item">
                                                        <?php echo hexa_kses($item['tcontent2']); ?>
                                                    </div>
                                                <?php endif; ?>                           
                                            </div> 
                                        <?php endforeach; ?>                                   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>      
            </div>

        <?php endif;
    }
}

$widgets_manager->register(new Hexa_Text_Slider());
