<?php

namespace HexaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use HexaCore\Elementor\Controls\Group_Control_HexaBGGradient;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Hexa Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Hexa_Testimonial extends Widget_Base
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
        return 'hf-testimonial';
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
        return __('Testimonial', 'hexacore');
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
                    'layout-2' => esc_html__('Layout 2', 'hexacore'),
                    'layout-3' => esc_html__('Layout 3', 'hexacore'),
                    'layout-4' => esc_html__('Layout 4', 'hexacore'),
                    'layout-5' => esc_html__('Layout 5', 'hexacore'),
                    'layout-6' => esc_html__('Layout 6', 'hexacore'),
                    'layout-7' => esc_html__('Layout 7', 'hexacore'),

                ],
                'default' => 'layout-1',
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
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'hexacore'),
                    'style_2' => __('Style 2', 'hexacore'),
                    'style_3' => __('Style 3', 'hexacore'),
                    'style_4' => __('Style 4', 'hexacore'),
                    'style_5' => __('Style 5', 'hexacore'),
                    'style_6' => __('Style 6', 'hexacore'),
                    'style_7' => __('Style 7', 'hexacore'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        // rating
        $repeater->add_control(
            'hexa_testi_rating',
            [
                'label' => esc_html__('Select Rating Count', 'hexacore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => esc_html__('Single Star', 'hexacore'),
                    '2' => esc_html__('2 Star', 'hexacore'),
                    '3' => esc_html__('3 Star', 'hexacore'),
                    '4' => esc_html__('4 Star', 'hexacore'),
                    '5' => esc_html__('5 Star', 'hexacore'),
                ],
                'default' => '5',
                'condition' => [
                    'repeater_condition' => ['style_3', 'style_4', 'style_5', 'style_6', 'style_7']
                ]
            ]
        );

        $repeater->add_control(
            'reviewer_image',
            [
                'label' => esc_html__('Reviewer Image', 'hexacore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2', 'style_4', 'style_5', 'style_6']
                ]
            ]
        );
        $repeater->add_control(
            'review_content',
            [
                'label' => esc_html__('Review Content', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => 'Aklima The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections Bonorum et Malorum original.',
                'placeholder' => esc_html__('Type your review content here', 'hexacore'),
            ]
        );
        $repeater->add_control(
            'reviewer_name',
            [
                'label' => esc_html__('Reviewer Name', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Rasalina William', 'hexacore'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2', 'style_3', 'style_5', 'style_7']
                ]
            ]
        );

        $repeater->add_control(
            'reviewer_title',
            [
                'label' => esc_html__('Reviewer Designation', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('CEO at YES Germany', 'hexacore'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2', 'style_3', 'style_5', 'style_7']
                ]
            ]
        );

        $this->add_control(
            'reviews_list',
            [
                'label' => esc_html__('Review List', 'hexacore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' =>  $repeater->get_controls(),
                'default' => [
                    [
                        'reviewer_name' => esc_html__('Rasalina William', 'hexacore'),
                        'reviewer_title' => esc_html__('CEO at YES Germany', 'hexacore'),
                        'review_content' => esc_html__('Construction can be defined as the art of building something. These construction quotes will put into perspective the fact that construction can be', 'hexacore'),
                    ],
                    [
                        'reviewer_name' => esc_html__('Rasalina William', 'hexacore'),
                        'reviewer_title' => esc_html__('CEO at YES Germany', 'hexacore'),
                        'review_content' => esc_html__('Construction can be defined as the art of building something. These construction quotes will put into perspective the fact that construction can be', 'hexacore'),
                    ],
                    [
                        'reviewer_name' => esc_html__('Rasalina William', 'hexacore'),
                        'reviewer_title' => esc_html__('CEO at YES Germany', 'hexacore'),
                        'review_content' => esc_html__('Construction can be defined as the art of building something. These construction quotes will put into perspective the fact that construction can be', 'hexacore'),
                    ],

                ],
                'title_field' => '{{{ reviewer_name }}}',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_size',
                'default' => 'thumbnail',
                'exclude' => ['custom'],
                'separator' => 'none',
                'condition' => [
                    'hexa_design_layout' => ['layout-1', 'layout-2']
                ]
            ]
        );


        $this->add_control(
            'hexa_border_switch',
            [
                'label'        => esc_html__('Border On/Off', 'hexacore'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'hexacore'),
                'label_off'    => esc_html__('Hide', 'hexacore'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'hexa_design_layout' => 'layout-6'
                ]
            ]
        );


        $this->end_controls_section();


        // _hexa_image
        $this->start_controls_section(
            '_hexa_image',
            [
                'label' => esc_html__('Thumbnail', 'hexacore'),
                'condition' => [
                    'hexa_design_layout' => 'layout-7'
                ]
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


        // shape
        $this->start_controls_section(
            'hexa_shape',
            [
                'label' => esc_html__('Shape Section', 'hexacore'),
                'condition' => [
                    'hexa_design_layout' => ['layout-4', 'layout-5', 'layout-7']
                ]
            ]
        );

        $this->add_control(
            'hexa_shape_switch',
            [
                'label'        => esc_html__('Shape On/Off', 'hexacore'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'hexacore'),
                'label_off'    => esc_html__('Hide', 'hexacore'),
                'return_value' => 'yes',
                'default'      => '0',
            ]
        );

        $this->add_control(
            'hexa_shape_image_1',
            [
                'label' => esc_html__('Choose Shape Image 1', 'hexacore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'hexa_shape_switch' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'hexa_shape_image_2',
            [
                'label' => esc_html__('Choose Shape Image 2', 'hexacore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'hexa_shape_switch' => 'yes',
                    'hexa_design_layout' => ['layout-5', 'layout-7']
                ]
            ]
        );

        $this->add_control(
            'hexa_shape_image_3',
            [
                'label' => esc_html__('Choose Shape Image 3', 'hexacore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'hexa_shape_switch' => 'yes',
                    'hexa_design_layout' => 'layout-5'
                ]
            ]
        );

        $this->add_control(
            'hexa_shape_image_4',
            [
                'label' => esc_html__('Choose Shape Image 4', 'hexacore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'hexa_shape_switch' => 'yes',
                    'hexa_design_layout' => 'layout-5'
                ]
            ]
        );

        $this->add_control(
            'hexa_shape_image_5',
            [
                'label' => esc_html__('Choose Shape Image 5', 'hexacore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'hexa_shape_switch' => 'yes',
                    'hexa_design_layout' => 'layout-5'
                ]
            ]
        );

        $this->add_control(
            'hexa_shape_image_6',
            [
                'label' => esc_html__('Choose Shape Image 6', 'hexacore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'hexa_shape_switch' => 'yes',
                    'hexa_design_layout' => 'layout-5'
                ]
            ]
        );

        $this->add_control(
            'hexa_shape_image_7',
            [
                'label' => esc_html__('Choose Shape Image 7', 'hexacore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'hexa_shape_switch' => 'yes',
                    'hexa_design_layout' => 'layout-5'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'shape_image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                'condition' => [
                    'hexa_shape_switch' => 'yes',
                ]
            ]
        );

        $this->end_controls_section();
    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->hexa_section_style_controls('testi_section', 'Section - Style', '.hf-el-section');
        $this->hexa_basic_style_controls('section_subtitle', 'Section - Subtitle', '.hf-el-subtitle', ['layout-4', 'layout-5', 'layout-7']);
        $this->hexa_basic_style_controls('section_title', 'Section - Title', '.hf-el-title', ['layout-4', 'layout-5', 'layout-7']);
        $this->hexa_basic_style_controls('section_desc', 'Section - Description', '.hf-el-content', ['layout-4', 'layout-5', 'layout-7']);
        $this->start_controls_section(
            'hexa_additional_styling',
            [
                'label' => esc_html__('Additional Style', 'hexacore'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'hexa_design_layout' => 'layout-2'
                ]
            ]
        );
        $this->add_control(
            'dot_color',
            [
                'label' => esc_html__('Dot Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tptestimonial-active-two .slick-dots li.slick-active button' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .tptestimonial-two-nav button:hover' => 'background: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );
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

        <!--	testimonial style 2 -->
        <?php if ($settings['hexa_design_layout']  == 'layout-2') :
            $this->add_render_attribute('title_args', 'class', 'hf-section__title-2 mb-10 hf-el-title');
        ?>

            <section class="testimonial-area pt-85 hf-el-section">
                <div class="container">
                    <div class="hftestimonial-two-bg hf-el-section">
                        <div class="row justify-content-center">
                            <div class="col-xxl-8 col-lg-10 col-md-9">
                                <div class="hftestimonial-area-two p-relative">
                                    <div class="hftestimonial-active-two">

                                        <?php foreach ($settings['reviews_list'] as $index => $item) :
                                            if (!empty($item['reviewer_image']['url'])) {
                                                $hexa_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url($item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                                                $hexa_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                                            }
                                        ?>
                                            <div class="hftestimonial-two-item">
                                                <div class="hftestimonial-two">
                                                    <?php if (!empty($hexa_reviewer_image)) : ?>
                                                        <div class="hftestimonial-two-avatar hf-el-rep-icon">
                                                            <img src="<?php echo esc_url($hexa_reviewer_image); ?>" alt="<?php echo esc_attr($hexa_reviewer_image_alt); ?>">
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="hftestimonial-two-content">
                                                        <i>
                                                            <svg width="32" height="20" viewBox="0 0 32 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M10.3376 2.213C9.04053 2.94247 8.04356 3.73741 7.34664 4.59782C6.63037 5.45823 6.13672 6.47762 5.8657 7.656C6.13672 7.58119 6.4271 7.51572 6.73684 7.45961C7.04658 7.40349 7.42408 7.37544 7.86933 7.37544C8.87598 7.37544 9.79552 7.51572 10.628 7.79629C11.441 8.07686 12.1476 8.479 12.7477 9.00273C13.3285 9.54516 13.7834 10.2092 14.1125 10.9948C14.4223 11.7803 14.5771 12.6782 14.5771 13.6882C14.5771 14.5673 14.4223 15.3903 14.1125 16.1572C13.7834 16.9241 13.3188 17.5881 12.7187 18.1492C12.0992 18.7291 11.3442 19.178 10.4537 19.496C9.54386 19.8326 8.51785 20.001 7.37568 20.001C6.38839 20.001 5.44949 19.8139 4.55898 19.4398C3.64912 19.0845 2.8651 18.5701 2.2069 17.8967C1.52934 17.2234 0.996977 16.4097 0.6098 15.4558C0.203268 14.5206 0 13.4731 0 12.3134C0 10.7984 0.212948 9.42358 0.63884 8.18908C1.06473 6.97329 1.65517 5.86973 2.41016 4.87839C3.1458 3.90575 4.02662 3.0547 5.05263 2.32522C6.07865 1.59575 7.19177 0.969145 8.39202 0.445419L10.3376 2.213ZM27.7604 2.213C26.4634 2.94247 25.4664 3.73741 24.7695 4.59782C24.0532 5.45823 23.5596 6.47762 23.2886 7.656C23.5596 7.58119 23.85 7.51572 24.1597 7.45961C24.4694 7.40349 24.8469 7.37544 25.2922 7.37544C26.2989 7.37544 27.2184 7.51572 28.0508 7.79629C28.8639 8.07686 29.5705 8.479 30.1706 9.00273C30.7514 9.54516 31.2063 10.2092 31.5354 10.9948C31.8451 11.7803 32 12.6782 32 13.6882C32 14.5673 31.8451 15.3903 31.5354 16.1572C31.2063 16.9241 30.7417 17.5881 30.1416 18.1492C29.5221 18.7291 28.7671 19.178 27.8766 19.496C26.9667 19.8326 25.9407 20.001 24.7985 20.001C23.8113 20.001 22.8724 19.8139 21.9819 19.4398C21.072 19.0845 20.288 18.5701 19.6298 17.8967C18.9522 17.2234 18.4198 16.4097 18.0327 15.4558C17.6261 14.5206 17.4229 13.4731 17.4229 12.3134C17.4229 10.7984 17.6358 9.42358 18.0617 8.18908C18.4876 6.97329 19.078 5.86973 19.833 4.87839C20.5687 3.90575 21.4495 3.0547 22.4755 2.32522C23.5015 1.59575 24.6146 0.969145 25.8149 0.445419L27.7604 2.213Z" fill="#C0BBB5" />
                                                            </svg>
                                                        </i>
                                                        <?php if (!empty($item['review_content'])) : ?>
                                                            <p class="hf-el-rep-content"><?php echo hexa_kses($item['review_content']); ?></p>
                                                        <?php endif; ?>
                                                        <div class="hftestimonial-two-avatar-info">
                                                            <?php if (!empty($item['reviewer_name'])) : ?>
                                                                <h5 class="title hf-el-rep-name"><?php echo hexa_kses($item['reviewer_name']); ?></h5>
                                                            <?php endif; ?>
                                                            <?php if (!empty($item['reviewer_title'])) : ?>
                                                                <span class="hf-el-rep-desi"><?php echo hexa_kses($item['reviewer_title']); ?></span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                    </div>
                                    <div class="hftestimonial-two-nav"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif ($settings['hexa_design_layout']  == 'layout-3') :
            $this->add_render_attribute('title_args', 'class', 'hf-section__title-2 mb-10 hf-el-title');
        ?>

            <div class="hftestimonial-3-active hf-el-section">

                <?php foreach ($settings['reviews_list'] as $index => $item) : ?>
                    <div class="hftestimonial-content-3">
                        <?php if (!empty($item['hexa_testi_rating'])) : ?>
                            <div class="hftestimonial-star mb-10">
                                <?php
                                $hexa_rating = $item['hexa_testi_rating'];
                                $hexa_rating_minus = 5 - $item['hexa_testi_rating'];
                                for ($i = 1; $i <= $hexa_rating; $i++) :
                                ?>
                                    <i class="fa-sharp fa-solid fa-star-sharp"></i>
                                <?php endfor; ?>
                                <?php
                                for ($i = 1; $i <= $hexa_rating_minus; $i++) :
                                ?>
                                    <i class="fa-light fa-star-sharp"></i>
                                <?php endfor; ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($item['review_content'])) : ?>
                            <p class="hf-el-rep-content"><?php echo hexa_kses($item['review_content']); ?></p>
                        <?php endif; ?>
                        <div class="author-info">
                            <?php if (!empty($item['reviewer_name'])) : ?>
                                <h5 class="author-title hf-el-rep-name"><?php echo hexa_kses($item['reviewer_name']); ?></h5>
                            <?php endif; ?>
                            <?php if (!empty($item['reviewer_title'])) : ?>
                                <span class="hf-el-rep-desi"><?php echo hexa_kses($item['reviewer_title']); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>

        <?php elseif ($settings['hexa_design_layout']  == 'layout-4') :
            // shape image
            if (!empty($settings['hexa_shape_image_1']['url'])) {
                $hexa_shape_image = !empty($settings['hexa_shape_image_1']['id']) ? wp_get_attachment_image_url($settings['hexa_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['hexa_shape_image_1']['url'];
                $hexa_shape_image_alt = get_post_meta($settings["hexa_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->add_render_attribute('title_args', 'class', 'review-title mb-55 hf-el-title');
        ?>

            <section class="review-area p-relative theme-bg-4 pt-90 pb-120 hf-el-section">
                <div class="container">
                    <?php if (!empty($hexa_shape_image)) : ?>
                        <div class="hfreview-shape">
                            <img src="<?php echo esc_url($hexa_shape_image); ?>" alt="<?php echo esc_attr($hexa_shape_image_alt); ?>">
                        </div>
                    <?php endif; ?>
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="review-section text-center">
                                <?php if (!empty($settings['hexa_testimonial_sub_title'])) : ?>
                                    <p class="text-white hf-el-subtitle"><?php echo hexa_kses($settings['hexa_testimonial_sub_title']); ?></p>
                                <?php endif; ?>
                                <?php
                                if (!empty($settings['hexa_testimonial_title'])) :
                                    printf(
                                        '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape($settings['hexa_testimonial_title_tag']),
                                        $this->get_render_attribute_string('title_args'),
                                        hexa_kses($settings['hexa_testimonial_title'])
                                    );
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php foreach ($settings['reviews_list'] as $index => $item) :
                            if (!empty($item['reviewer_image']['url'])) {
                                $hexa_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url($item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                                $hexa_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                            }
                        ?>
                            <div class="col-lg-4 col-md-6">
                                <div class="review-item text-center mb-45">
                                    <?php if (!empty($hexa_reviewer_image)) : ?>
                                        <div class="review-icon mb-10 hf-el-rep-icon">
                                            <img src="<?php echo esc_url($hexa_reviewer_image); ?>" alt="<?php echo esc_attr($hexa_reviewer_image_alt); ?>">
                                        </div>
                                    <?php endif; ?>
                                    <div class="review-content">
                                        <?php if (!empty($item['review_content'])) : ?>
                                            <span class="hf-el-rep-content"><?php echo hexa_kses($item['review_content']); ?></span>
                                        <?php endif; ?>
                                        <?php if (!empty($item['hexa_testi_rating'])) : ?>
                                            <div class="review-star hf-el-rep-star">
                                                <?php
                                                $hexa_rating = $item['hexa_testi_rating'];
                                                $hexa_rating_minus = 5 - $item['hexa_testi_rating'];
                                                for ($i = 1; $i <= $hexa_rating; $i++) :
                                                ?>
                                                    <i class="fa-sharp fa-solid fa-star-sharp"></i>
                                                <?php endfor; ?>
                                                <?php
                                                for ($i = 1; $i <= $hexa_rating_minus; $i++) :
                                                ?>
                                                    <i class="fa-light fa-star-sharp"></i>
                                                <?php endfor; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="review-date text-center">
                                <?php if (!empty($settings['hexa_testimonial_description'])) : ?>
                                    <span class="hf-el-content"><?php echo hexa_kses($settings['hexa_testimonial_description']); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif ($settings['hexa_design_layout']  == 'layout-5') :
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
            if (!empty($settings['hexa_shape_image_5']['url'])) {
                $hexa_shape_image5 = !empty($settings['hexa_shape_image_5']['id']) ? wp_get_attachment_image_url($settings['hexa_shape_image_5']['id'], $settings['shape_image_size_size']) : $settings['hexa_shape_image_5']['url'];
                $hexa_shape_image_alt5 = get_post_meta($settings["hexa_shape_image_5"]["id"], "_wp_attachment_image_alt", true);
            }
            if (!empty($settings['hexa_shape_image_6']['url'])) {
                $hexa_shape_image6 = !empty($settings['hexa_shape_image_6']['id']) ? wp_get_attachment_image_url($settings['hexa_shape_image_6']['id'], $settings['shape_image_size_size']) : $settings['hexa_shape_image_6']['url'];
                $hexa_shape_image_alt6 = get_post_meta($settings["hexa_shape_image_6"]["id"], "_wp_attachment_image_alt", true);
            }
            if (!empty($settings['hexa_shape_image_7']['url'])) {
                $hexa_shape_image7 = !empty($settings['hexa_shape_image_7']['id']) ? wp_get_attachment_image_url($settings['hexa_shape_image_7']['id'], $settings['shape_image_size_size']) : $settings['hexa_shape_image_7']['url'];
                $hexa_shape_image_alt7 = get_post_meta($settings["hexa_shape_image_7"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->add_render_attribute('title_args', 'class', 'section-title-4 section-title-4-2 hf-el-title');
        ?>

            <section class="testimonial-area pb-60 scene fix hf-el-section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="testimonial-4-thumb p-relative pb-60">
                                <div class="testimonial-4-main-thumb p-relative">
                                    <?php if (!empty($hexa_shape_image)) : ?>
                                        <img src="<?php echo esc_url($hexa_shape_image); ?>" alt="<?php echo esc_attr($hexa_shape_image_alt); ?>">
                                    <?php endif; ?>
                                    <div class="testimonial-4-main-anim">
                                        <div class="hf-tooltip-circle">
                                            <div class="hf-tooltip-effect-1"></div>
                                            <div class="hf-tooltip-effect-2"></div>
                                            <div class="hf-tooltip-effect-3"></div>
                                        </div>
                                    </div>
                                </div>

                                <?php if (!empty($hexa_shape_image2)) : ?>
                                    <div class="testimonial-4-shape-1">
                                        <img class="layer" data-depth="0.3" src="<?php echo esc_url($hexa_shape_image2); ?>" alt="<?php echo esc_attr($hexa_shape_image_alt2); ?>">
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($hexa_shape_image3)) : ?>
                                    <div class="testimonial-4-shape-2">
                                        <img class="layer" data-depth="0.2" src="<?php echo esc_url($hexa_shape_image3); ?>" alt="<?php echo esc_attr($hexa_shape_image_alt3); ?>">
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($hexa_shape_image4)) : ?>
                                    <div class="testimonial-4-shape-3">
                                        <img class="layer" data-depth="0.1" src="<?php echo esc_url($hexa_shape_image4); ?>" alt="<?php echo esc_attr($hexa_shape_image_alt4); ?>">
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($hexa_shape_image5)) : ?>
                                    <div class="testimonial-4-shape-4 d-sm-block">
                                        <img class="layer" data-depth="0.2" src="<?php echo esc_url($hexa_shape_image5); ?>" alt="<?php echo esc_attr($hexa_shape_image_alt5); ?>">
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($hexa_shape_image6)) : ?>
                                    <div class="testimonial-4-shape-5 d-sm-block">
                                        <img class="layer" data-depth="0.1" src="<?php echo esc_url($hexa_shape_image6); ?>" alt="<?php echo esc_attr($hexa_shape_image_alt6); ?>">
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($hexa_shape_image7)) : ?>
                                    <div class="testimonial-4-shape-6">
                                        <img class="layer" data-depth="0.1" src="<?php echo esc_url($hexa_shape_image7); ?>" alt="<?php echo esc_attr($hexa_shape_image_alt7); ?>">
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="hf-testimonial-4 pb-60">
                                <div class="testimonial-4-wrap mb-40 pl-70">
                                    <div class="section-wrapper mb-50">
                                        <?php if (!empty($settings['hexa_testimonial_sub_title'])) : ?>
                                            <span class="hf-el-subtitle"><?php echo hexa_kses($settings['hexa_testimonial_sub_title']); ?></span>
                                        <?php endif; ?>
                                        <?php
                                        if (!empty($settings['hexa_testimonial_title'])) :
                                            printf(
                                                '<%1$s %2$s>%3$s</%1$s>',
                                                tag_escape($settings['hexa_testimonial_title_tag']),
                                                $this->get_render_attribute_string('title_args'),
                                                hexa_kses($settings['hexa_testimonial_title'])
                                            );
                                        endif;
                                        ?>
                                        <?php if (!empty($settings['hexa_testimonial_description'])) : ?>
                                            <p class="hf-el-content"><?php echo hexa_kses($settings['hexa_testimonial_description']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="testimonial-4-wrapper tptestimonial-4-active">

                                        <?php foreach ($settings['reviews_list'] as $index => $item) :
                                            if (!empty($item['reviewer_image']['url'])) {
                                                $hexa_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url($item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                                                $hexa_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                                            }
                                        ?>
                                            <div class="hftestimonial-4-item">
                                                <div class="hftestimonial-4-rating d-flex align-items-center mb-25">
                                                    <?php if (!empty($hexa_reviewer_image)) : ?>
                                                        <div class="hftestimonial-4-rating-img mr-30 hf-el-rep-icon">
                                                            <img src="<?php echo esc_url($hexa_reviewer_image); ?>" alt="<?php echo esc_attr($hexa_reviewer_image_alt); ?>">
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if (!empty($item['hexa_testi_rating'])) : ?>
                                                        <div class="review-star hf-el-rep-star">
                                                            <?php
                                                            $hexa_rating = $item['hexa_testi_rating'];
                                                            $hexa_rating_minus = 5 - $item['hexa_testi_rating'];
                                                            for ($i = 1; $i <= $hexa_rating; $i++) :
                                                            ?>
                                                                <i class="fa-sharp fa-solid fa-star-sharp"></i>
                                                            <?php endfor; ?>
                                                            <?php
                                                            for ($i = 1; $i <= $hexa_rating_minus; $i++) :
                                                            ?>
                                                                <i class="fa-light fa-star-sharp"></i>
                                                            <?php endfor; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="hftestimonial-4-content d-flex">
                                                    <div class="hftestimonial-4-icon mr-20">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/quation-4.png" alt="">
                                                    </div>
                                                    <div class="hftestimonial-4-text">

                                                        <?php if (!empty($item['review_content'])) : ?>
                                                            <p class="hf-el-rep-content"><?php echo hexa_kses($item['review_content']); ?></p>
                                                        <?php endif; ?>

                                                        <div class="hftestimonial-4-author">
                                                            <?php if (!empty($item['reviewer_name'])) : ?>
                                                                <h4 class="title hf-el-rep-name"><?php echo hexa_kses($item['reviewer_name']); ?></h4>
                                                            <?php endif; ?>
                                                            <?php if (!empty($item['reviewer_title'])) : ?>
                                                                <span class="hf-el-rep-desi"><?php echo hexa_kses($item['reviewer_title']); ?></span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                    </div>
                                </div>
                                <div class="testimonial-arrow-4 pl-110">
                                    <div class="hftestimonal-4-nav p-relative">
                                        <button class="prv-testi-case">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" fill="none" viewBox="0 0 8 14">
                                                    <path fill-rule="evenodd" d="M7.707.293a1 1 0 0 1 0 1.414L2.414 7l5.293 5.293a1 1 0 0 1-1.414 1.414l-6-6a1 1 0 0 1 0-1.414l6-6a1 1 0 0 1 1.414 0z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </button>
                                        <button class="next-testi-case">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" fill="none" viewBox="0 0 8 14">
                                                    <path fill-rule="evenodd" d="M.293 13.707a1 1 0 0 1 0-1.414L5.586 7 .293 1.707A1 1 0 1 1 1.707.293l6 6a1 1 0 0 1 0 1.414l-6 6a1 1 0 0 1-1.414 0z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif ($settings['hexa_design_layout']  == 'layout-6') : ?>

            <div class="review-area tpreview-4 pb-105 hf-el-section">
                <div class="container">
                    <div class="<?php echo $settings['hexa_border_switch'] ? "hfreview-4-wrapper " : NULL; ?> pb-30 mb-30 pt-55">
                        <div class="row">

                            <?php foreach ($settings['reviews_list'] as $index => $item) :
                                if (!empty($item['reviewer_image']['url'])) {
                                    $hexa_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url($item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                                    $hexa_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                                }
                            ?>
                                <div class="col-lg-4 col-md-6">
                                    <div class="hfreview-4 text-center mb-30 <?php echo $index == 1 ? 'review-side-border' : NULL; ?>">
                                        <?php if (!empty($hexa_reviewer_image)) : ?>
                                            <div class="hfreview-4-icon mb-15 hf-el-rep-icon">
                                                <img src="<?php echo esc_url($hexa_reviewer_image); ?>" alt="<?php echo esc_attr($hexa_reviewer_image_alt); ?>">
                                            </div>
                                        <?php endif; ?>
                                        <div class="hfreview-4-content">
                                            <?php if (!empty($item['review_content'])) : ?>
                                                <p class="hf-el-rep-content"><?php echo hexa_kses($item['review_content']); ?></p>
                                            <?php endif; ?>
                                            <?php if (!empty($item['hexa_testi_rating'])) : ?>
                                                <div class="review-star hf-el-rep-star">
                                                    <?php
                                                    $hexa_rating = $item['hexa_testi_rating'];
                                                    $hexa_rating_minus = 5 - $item['hexa_testi_rating'];
                                                    for ($i = 1; $i <= $hexa_rating; $i++) :
                                                    ?>
                                                        <i class="fa-sharp fa-solid fa-star-sharp"></i>
                                                    <?php endfor; ?>
                                                    <?php
                                                    for ($i = 1; $i <= $hexa_rating_minus; $i++) :
                                                    ?>
                                                        <i class="fa-light fa-star-sharp"></i>
                                                    <?php endfor; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
            </div>

        <?php elseif ($settings['hexa_design_layout']  == 'layout-7') :
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
            $this->add_render_attribute('title_args', 'class', 'testimnial-5-title hf-el-title');
        ?>

            <section class="testimonial-area p-relative pb-100 hf-el-section">
                <div class="container">
                    <div class="testimonial-5-bg">
                        <?php if (!empty($hexa_shape_image)) : ?>
                            <div class="testimonial-5-bg-shape">
                                <img src="<?php echo esc_url($hexa_shape_image); ?>" alt="<?php echo esc_attr($hexa_shape_image_alt); ?>">
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($hexa_shape_image2)) : ?>
                            <div class="testimonial-5-bg-shape-two wow bounceIn" data-wow-duration=".6s" data-wow-delay=".6s">
                                <img src="<?php echo esc_url($hexa_shape_image2); ?>" alt="<?php echo esc_attr($hexa_shape_image_alt2); ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="testimonial-5-head text-center mb-60">

                                <?php if (!empty($settings['hexa_testimonial_sub_title'])) : ?>
                                    <div class="about-5-section">
                                        <span class="sub-title hf-el-subtitle"><?php echo hexa_kses($settings['hexa_testimonial_sub_title']); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php
                                if (!empty($settings['hexa_testimonial_title'])) :
                                    printf(
                                        '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape($settings['hexa_testimonial_title_tag']),
                                        $this->get_render_attribute_string('title_args'),
                                        hexa_kses($settings['hexa_testimonial_title'])
                                    );
                                endif;
                                ?>
                                <?php if (!empty($settings['hexa_testimonial_description'])) : ?>
                                    <p class="hf-el-content"><?php echo hexa_kses($settings['hexa_testimonial_description']); ?></p>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="testimonial-5 p-relative" data-background="<?php echo get_template_directory_uri(); ?>/assets/img/shape/testimonial-5shape-1.png">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 order-2 order-md-1">
                                        <div class="testimonial-5-shape">
                                            <?php if (!empty($hexa_image)) : ?>
                                                <div class="testimonial-5-shape-one">
                                                    <img src="<?php echo esc_url($hexa_image); ?>" alt="<?php echo esc_attr($hexa_image_alt); ?>">
                                                </div>
                                            <?php endif; ?>
                                            <div class="testimonial-5-shape-two d-none d-md-block">
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/testimonial-5-shape-3.png" alt="">
                                            </div>
                                            <div class="testimonial-5-shape-three d-none d-md-block">
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/testimonial-5-shape-4.png" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-7 order-1 order-md-2">
                                        <div class="testimonial-5-content testi-5-active">

                                            <?php foreach ($settings['reviews_list'] as $index => $item) : ?>
                                                <div class="testimonial-5-content-wrap">
                                                    <?php if (!empty($item['hexa_testi_rating'])) : ?>
                                                        <div class="hftestimonial-star mb-15 hf-el-rep-star">
                                                            <?php
                                                            $hexa_rating = $item['hexa_testi_rating'];
                                                            $hexa_rating_minus = 5 - $item['hexa_testi_rating'];
                                                            for ($i = 1; $i <= $hexa_rating; $i++) :
                                                            ?>
                                                                <i class="fa-sharp fa-solid fa-star-sharp"></i>
                                                            <?php endfor; ?>
                                                            <?php
                                                            for ($i = 1; $i <= $hexa_rating_minus; $i++) :
                                                            ?>
                                                                <i class="fa-light fa-star-sharp"></i>
                                                            <?php endfor; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if (!empty($item['review_content'])) : ?>
                                                        <p class="hf-el-rep-content"><?php echo hexa_kses($item['review_content']); ?></p>
                                                    <?php endif; ?>
                                                    <div class="author-info-5">

                                                        <?php if (!empty($item['reviewer_name'])) : ?>
                                                            <h5 class="author-title-5 hf-el-rep-name"><?php echo hexa_kses($item['reviewer_name']); ?></h5>
                                                        <?php endif; ?>
                                                        <?php if (!empty($item['reviewer_title'])) : ?>
                                                            <span class="hf-el-rep-desi"><?php echo hexa_kses($item['reviewer_title']); ?></span>
                                                        <?php endif; ?>

                                                    </div>
                                                </div>
                                            <?php endforeach; ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php else :
            $this->add_render_attribute('title_args', 'class', 'hf-section-title hf-el-title');
        ?>

            <section class="textimonial-area fix hf-el-section">
                <div class="container-fluid">
                    <div class="hftestimonial-wrap p-relative">
                        <div class="hftestimonial-wrapper tptestimonial-active">
                            <?php foreach ($settings['reviews_list'] as $index => $item) :
                                if (!empty($item['reviewer_image']['url'])) {
                                    $hexa_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url($item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                                    $hexa_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                                }
                            ?>
                                <div class="hftestimonial p-relative d-flex align-items-center">
                                    <?php if (!empty($hexa_reviewer_image)) : ?>
                                        <div class="hftestimonial-thumb mr-40 hf-el-rep-icon">
                                            <img src="<?php echo esc_url($hexa_reviewer_image); ?>" alt="<?php echo esc_attr($hexa_reviewer_image_alt); ?>">
                                        </div>
                                    <?php endif; ?>
                                    <div class="hftestimonial-content">
                                        <div class="hftestimonial-shape mb-20">
                                            <i><svg width="40" height="30" viewBox="0 0 40 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M24.2289 29.0379C24.7654 29.0379 25.8383 28.0753 27.4476 26.1502C29.0569 24.332 30.559 22.2465 31.9537 19.8935C33.2412 17.5406 33.8849 15.455 33.8849 13.6368C33.8849 13.1021 33.7776 12.5139 33.563 11.8721C33.3485 12.6208 32.8657 13.2625 32.1147 13.7973C31.2563 14.439 30.0762 14.7598 28.5741 14.7598C26.3211 14.7598 24.6581 14.1181 23.5852 12.8347C22.405 11.6582 21.8149 10.1609 21.8149 8.34273C21.8149 6.20369 22.6732 4.27856 24.3899 2.56734C25.9992 0.856103 28.1986 0.000488217 30.9881 0.000488217C33.4558 0.000488217 35.4942 0.695676 37.1036 2.08605C38.6056 3.47643 39.5176 5.13418 39.8394 7.05931C39.9467 7.59407 40.0004 8.44969 40.0004 9.62616C40.0004 13.6903 38.6593 17.5406 35.977 21.177C33.2948 24.9203 29.7007 27.8614 25.1945 30.0005L24.2289 29.0379ZM2.98579 29.0379C3.52223 29.0379 4.59512 28.0753 6.20445 26.1502C7.81377 24.332 9.31581 22.2465 10.7106 19.8935C11.998 17.5406 12.6418 15.455 12.6418 13.6368C12.6418 13.1021 12.5345 12.5139 12.3199 11.8721C12.1053 12.6208 11.6225 13.2625 10.8715 13.7973C10.0132 14.439 8.83301 14.7598 7.33097 14.7598C5.07791 14.7598 3.41494 14.1181 2.34205 12.8347C1.16188 11.6582 0.571791 10.1609 0.571791 8.34273C0.571791 6.20369 1.4301 4.27856 3.14672 2.56734C4.75605 0.856103 6.95546 0.000488217 9.74497 0.000488217C12.2126 0.000488217 14.2511 0.695676 15.8604 2.08605C17.3625 3.47643 18.2744 5.13418 18.5963 7.05931C18.7036 7.59407 18.7572 8.44969 18.7572 9.62616C18.7572 13.6903 17.4161 17.5406 14.7339 21.177C12.0517 24.9203 8.4575 27.8614 3.95138 30.0005L2.98579 29.0379Z" fill="white" stroke="currentColor" fill-opacity="0.2" />
                                                </svg>
                                            </i>
                                        </div>
                                        <?php if (!empty($item['review_content'])) : ?>
                                            <p class="hf-el-rep-content"><?php echo hexa_kses($item['review_content']); ?></p>
                                        <?php endif; ?>
                                        <div class="hftestimonial-avatar-info">
                                            <?php if (!empty($item['reviewer_name'])) : ?>
                                                <h5 class="hftestimonial-avatar-title hf-el-rep-name"><?php echo hexa_kses($item['reviewer_name']); ?></h5>
                                            <?php endif; ?>
                                            <?php if (!empty($item['reviewer_title'])) : ?>
                                                <span class="hf-el-rep-desi"><?php echo hexa_kses($item['reviewer_title']); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>


                        </div>
                        <div class="testimonial-fixed-bg fix"></div>
                        <div class="hftestimonial-arrow">
                            <div class="testimonial-arrows p-relative">
                                <button class="prev-testimonial">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" fill="none" viewBox="0 0 8 14">
                                            <path fill-rule="evenodd" d="M7.707.293a1 1 0 0 1 0 1.414L2.414 7l5.293 5.293a1 1 0 0 1-1.414 1.414l-6-6a1 1 0 0 1 0-1.414l6-6a1 1 0 0 1 1.414 0z" fill="#9f9fa9">
                                            </path>
                                        </svg>
                                    </span>
                                </button>
                                <button class="next-testimonial">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" fill="none" viewBox="0 0 8 14">
                                            <path fill-rule="evenodd" d="M.293 13.707a1 1 0 0 1 0-1.414L5.586 7 .293 1.707A1 1 0 1 1 1.707.293l6 6a1 1 0 0 1 0 1.414l-6 6a1 1 0 0 1-1.414 0z" fill="#9f9fa9">
                                            </path>
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

<?php endif;
    }
}

$widgets_manager->register(new Hexa_Testimonial());
