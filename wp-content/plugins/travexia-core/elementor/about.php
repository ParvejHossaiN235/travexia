<?php

namespace HexaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
use HexaCore\Elementor\Controls\Group_Control_HexaBGGradient;
use HexaCore\Elementor\Controls\Group_Control_HexaGradient;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Hexa Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Hexa_About extends Widget_Base
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
        return 'about';
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
        return __('About', 'hexacore');
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
                    // 'layout-4' => esc_html__('Layout 4', 'hexacore'),
                    // 'layout-5' => esc_html__('Layout 5', 'hexacore'),
                    // 'layout-6' => esc_html__('Layout 6', 'hexacore'),
                    // 'layout-7' => esc_html__('Layout 7', 'hexacore'),
                    // 'layout-8' => esc_html__('Layout 8', 'hexacore'),
                    // 'layout-9' => esc_html__('Layout 9', 'hexacore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // about content
        $this->start_controls_section(
            'section_about_content',
            [
                'label' => __('About Content', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'about_subtitle',
            [
                'label' => __('Subtitle', 'hexacore'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Banner subtitle', 'hexacore'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Banner title', 'hexacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
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

        $this->add_control(
            'desc',
            [
                'label' => __('Description', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => '10',
                'label_block' => true,
                'default' => __('Cum sociis natoque penatibus et magnis dis parturient montes.', 'hexacore'),
            ]
        );


        $this->add_control(
            'client_content_number',
            [
                'label' => __('Number', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('20', 'hexacore'),
            ]
        );

        $this->add_control(
            'client_content_title',
            [
                'label' => __('Title', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Our Happy Clients', 'hexacore'),
            ]
        );

        $this->end_controls_section();

        // button
        $this->start_controls_section(
            'hexa_button_section',
            [
                'label' => esc_html__('Button', 'hexacore'),
            ]
        );
        $this->add_control(
            'btn_text',
            [
                'label' => __('Button One', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Click here', 'hexacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
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

        $this->add_control(
            'button_icon',
            [
                'label' => esc_html__('Icon', 'hexacore'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-smile',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->end_controls_section();

        // Features Sections
        $this->start_controls_section(
            'about_features_list_sec',
            [
                'label' => esc_html__('Features List', 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'hexa_design_layout' => ['layout-1', 'layout-2', 'layout-3', 'layout-4', 'layout-5']
                ]
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
                    // 'style_4' => __('Style 4', 'hexacore'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'hexa_box_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'hexacore'),
                    'icon' => esc_html__('Icon', 'hexacore'),
                    'svg' => esc_html__('SVG', 'hexacore'),
                ],
            ]
        );
        $repeater->add_control(
            'hexa_box_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'hexacore'),
                'condition' => [
                    'hexa_box_icon_type' => 'svg',
                ]
            ]
        );

        $repeater->add_control(
            'hexa_box_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'hexacore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'hexa_box_icon_type' => 'image',
                ]
            ]
        );

        if (hexa_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'hexa_box_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'hexa_box_icon_type' => 'icon',
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'hexa_box_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'hexa_box_icon_type' => 'icon',
                    ]
                ]
            );
        }

        $repeater->add_control(
            'about_features_title',
            [
                'label' => esc_html__('About List Title', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('See the action in live', 'hexacore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'about_features_des',
            [
                'label' => esc_html__('Description', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Understand how your keyword/group is ranking specific cases.', 'hexacore'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_3', 'style_5', 'style_6', 'style_8', 'style_9']
                ]
            ]
        );

        $this->add_control(
            'about_features_list',
            [
                'label' => esc_html__('About List', 'hexacore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'about_features_title' => esc_html__('See the action in live', 'hexacore'),
                    ],
                    [
                        'about_features_title' => esc_html__('Intuitive dashboard', 'hexacore'),
                    ],
                ],
                'title_field' => '{{{ about_features_title }}}',
            ]
        );

        $this->end_controls_section();


        // _hexa_image
        $this->start_controls_section(
            '_hexa_image',
            [
                'label' => esc_html__('Image', 'hexacore'),
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

        $this->add_control(
            'hexa_image2',
            [
                'label' => esc_html__('Choose Image 2', 'hexacore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'hexa_design_layout' => ['layout-1', 'layout-2', 'layout-6', 'layout-7', 'layout-8']
                ]
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

    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->hexa_section_style_controls('about_section', 'Section - Style', '.hf-el-section');
        $this->hexa_basic_style_controls('section_subtitle', 'Section - Subtitle', '.hf-el-subtitle', ['layout-1', 'layout-2', 'layout-3', 'layout-4', 'layout-5', 'layout-6', 'layout-7', 'layout-8']);
        $this->hexa_basic_style_controls('section_title', 'Section - Title', '.hf-el-title', ['layout-1', 'layout-2', 'layout-3', 'layout-4', 'layout-5', 'layout-6', 'layout-7', 'layout-8']);
        $this->hexa_basic_style_controls('section_desc', 'Section - Description', '.hf-el-content', ['layout-1', 'layout-2', 'layout-3', 'layout-4', 'layout-5', 'layout-6', 'layout-7', 'layout-8']);
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
            <?php if ($settings['hexa_design_layout'] == 'layout-2'):

               
                // thumbnail
                if (!empty($settings['hexa_image']['url'])) {
                    $hexa_image = !empty($settings['hexa_image']['id']) ? wp_get_attachment_image_url($settings['hexa_image']['id'], $settings['hexa_image_size_size']) : $settings['hexa_image']['url'];
                    $hexa_image_alt = get_post_meta($settings["hexa_image"]["id"], "_wp_attachment_image_alt", true);
                }

                if (!empty($settings['hexa_image2']['url'])) {
                    $hexa_image2 = !empty($settings['hexa_image2']['id']) ? wp_get_attachment_image_url($settings['hexa_image2']['id'], $settings['hexa_image_size_size']) : $settings['hexa_image2']['url'];
                    $hexa_image_alt2 = get_post_meta($settings["hexa_image2"]["id"], "_wp_attachment_image_alt", true);
                }

                $this->add_render_attribute('title_args', 'class', 'tr-section-title mb-20 hf-el-title');


                // button one
                if (!empty($settings['btn_link']['url'])) {
                    $this->add_link_attributes('button', $settings['btn_link']);
                }
                $this->add_render_attribute('button', 'class', 'tr-btn-green hexa-el-btn');
            ?>

            <!-- about-area-start -->
            <div class="tr-about-2-area fix hf-el-section">
                <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-6 col-lg-6 wow itfadeLeft" data-wow-duration=".9s" data-wow-delay=".3s">
                                <div class="tr-about-2-thumb-wrap p-relative text-center text-lg-end">
                                    <?php if (!empty($hexa_image)): ?>
                                        <div class="tr-about-2-thumb-1">
                                            <img src="<?php echo esc_url($hexa_image); ?>"
                                                alt="<?php echo esc_attr($hexa_image_alt); ?>">
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($hexa_image2)): ?>
                                        <div class="tr-about-2-thumb-2 d-none d-md-block">
                                            <img src="<?php echo esc_url($hexa_image2); ?>"
                                            alt="<?php echo esc_attr($hexa_image_alt2); ?>">
                                        </div>
                                    <?php endif; ?>

                                    <div class="tr-about-client d-none d-md-block">
                                        
                                        <div class="tr-about-client-content mt-25">
                                            <?php if (!empty($settings['client_content_number'])): ?>
                                                <h4>
                                                    <span data-purecounter-duration="1"
                                                        data-purecounter-end="<?php echo esc_attr($settings['client_content_number']); ?>"
                                                        class="purecounter">0</span>
                                                    +
                                                </h4>
                                                <?php endif; ?>

                                                <?php if (!empty($settings['client_content_title'])): ?>
                                                <span>
                                                    <?php echo hexa_kses($settings['client_content_title']); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 wow itfadeRight" data-wow-duration=".9s" data-wow-delay=".5s">
                                <div class="tr-about-left">
                                    <div class="tr-about-title-box">

                                        <?php if (!empty($settings['about_subtitle'])): ?>
                                            <span class="tr-section-subtitle mb-10 hf-el-subtitle">
                                                <?php echo hexa_kses($settings['about_subtitle']); ?>
                                            </span>
                                        <?php endif; ?>
                                        
                                        <?php
                                            if (!empty($settings['title'])):
                                                printf(
                                                    '<%1$s %2$s>%3$s</%1$s>',
                                                    tag_escape($settings['title_tag']),
                                                    $this->get_render_attribute_string('title_args'),
                                                    hexa_kses($settings['title'])
                                                );
                                            endif;
                                        ?>
                                    </div>

                                    <?php if (!empty($settings['desc'])): ?>
                                        <div class="tr-about-text">
                                            <p class="hf-el-content">
                                                <?php echo hexa_kses($settings['desc']); ?>
                                            </p>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="tr-about-list p-relative mb-45">
                                        <ul>
                                            <?php foreach ($settings['about_features_list'] as $key => $item): ?>
                                                <li class="hexa-el-about-list">
                                                    <div class="hfchoose-icon">
                                                        <?php if ($item['hexa_box_icon_type'] == 'icon'): ?>
                                                            <?php if (!empty($item['hexa_box_icon']) || !empty($item['hexa_box_selected_icon']['value'])): ?>
                                                                <?php hexa_render_icon($item, 'hexa_box_icon', 'hexa_box_selected_icon'); ?>
                                                        <?php endif; ?>

                                                        <?php elseif ($item['hexa_box_icon_type'] == 'image'): ?>
                                                            <?php if (!empty($item['hexa_box_icon_image']['url'])): ?>
                                                                <div class="hf-el-rep-icon">
                                                                    <img src="<?php echo $item['hexa_box_icon_image']['url']; ?>"
                                                                        alt="<?php echo get_post_meta(attachment_url_to_postid($item['hexa_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php else: ?>

                                                        <?php if (!empty($item['hexa_box_icon_svg'])): ?>
                                                            <div class="hf-el-rep-icon">
                                                                <?php echo $item['hexa_box_icon_svg']; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>

                                                    <?php if (!empty($item['about_features_title'])): ?>
                                                        <span class="hf-el-rep-title">
                                                            <?php echo hexa_kses($item['about_features_title']); ?>
                                                        </span>
                                                    <?php endif; ?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <?php if (!empty($settings['btn_text'])): ?>
                                        <div class="tr-about-btn">
                                            <a <?php echo $this->get_render_attribute_string('button'); ?>>
                                                <?php echo hexa_kses($settings['btn_text']); ?>
                                                <i class="<?php echo esc_attr($settings['button_icon']['value']); ?>"></i>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>       
                        </div>
                </div>
            </div>
            <!-- about-area-end -->


            <?php elseif ($settings['hexa_design_layout'] == 'layout-3'): 
                
                // thumbnail
                if (!empty($settings['hexa_image']['url'])) {
                    $hexa_image = !empty($settings['hexa_image']['id']) ? wp_get_attachment_image_url($settings['hexa_image']['id'], $settings['hexa_image_size_size']) : $settings['hexa_image']['url'];
                    $hexa_image_alt = get_post_meta($settings["hexa_image"]["id"], "_wp_attachment_image_alt", true);
                }

                $this->add_render_attribute('title_args', 'class', 'tr-section-title mb-20 hf-el-title');

                // button one
                if (!empty($settings['btn_link']['url'])) {
                    $this->add_link_attributes('button', $settings['btn_link']);
                }
                $this->add_render_attribute('button', 'class', 'tr-btn hexa-el-btn');
                
                ?>

                <div class="tr-about-3-area fix">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-6 col-lg-6">
                                <div class="tr-about-3-thumb-wrap p-relative">

                                    <?php if (!empty($hexa_image)): ?>
                                        <div class="tr-about-3-thumb-main">
                                            <img src="<?php echo esc_url($hexa_image); ?>"
                                                alt="<?php echo esc_attr($hexa_image_alt); ?>">
                                        </div>
                                    <?php endif; ?>

                                    <div class="tr-about-client">
                                        <div class="tr-about-client-content">
                                            <?php if (!empty($settings['client_content_number'])): ?>
                                                
                                                <h4>
                                                    <span data-purecounter-duration="1"
                                                        data-purecounter-end="<?php echo esc_attr($settings['client_content_number']); ?>"
                                                        class="purecounter">0</span>
                                                    +
                                                </h4>
                                                <?php endif; ?>

                                                <?php if (!empty($settings['client_content_title'])): ?>
                                                <span>
                                                    <?php echo hexa_kses($settings['client_content_title']); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <div class="tr-about-left">
                                    <div class="tr-about-title-box">

                                        <?php if (!empty($settings['about_subtitle'])): ?>
                                            <span class="tr-section-subtitle mb-10 hf-el-subtitle">
                                                <?php echo hexa_kses($settings['about_subtitle']); ?>
                                            </span>
                                        <?php endif; ?>
                                        
                                        <?php
                                            if (!empty($settings['title'])):
                                                printf(
                                                    '<%1$s %2$s>%3$s</%1$s>',
                                                    tag_escape($settings['title_tag']),
                                                    $this->get_render_attribute_string('title_args'),
                                                    hexa_kses($settings['title'])
                                                );
                                            endif;
                                        ?>

                                    </div>

                                    <?php if (!empty($settings['desc'])): ?>
                                        <div class="tr-about-text">
                                            <p class="hf-el-content">
                                                <?php echo hexa_kses($settings['desc']); ?>
                                            </p>
                                        </div>
                                    <?php endif; ?>

                                    <div class="tr-about-list p-relative mb-40">
                                        <ul>
                                            <?php foreach ($settings['about_features_list'] as $key => $item): ?>
                                                <li class="hexa-el-about-list">
                                                    <div class="hfchoose-icon">
                                                        <?php if ($item['hexa_box_icon_type'] == 'icon'): ?>
                                                        <?php if (!empty($item['hexa_box_icon']) || !empty($item['hexa_box_selected_icon']['value'])): ?>
                                                            <span class="tr-about-list-icon">
                                                                <?php hexa_render_icon($item, 'hexa_box_icon', 'hexa_box_selected_icon'); ?>
                                                            </span>
                                                        <?php endif; ?>

                                                        <?php elseif ($item['hexa_box_icon_type'] == 'image'): ?>
                                                        <?php if (!empty($item['hexa_box_icon_image']['url'])): ?>
                                                        <div class="hf-el-rep-icon">
                                                            <img src="<?php echo $item['hexa_box_icon_image']['url']; ?>"
                                                                alt="<?php echo get_post_meta(attachment_url_to_postid($item['hexa_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                        </div>
                                                        <?php endif; ?>
                                                        <?php else: ?>

                                                        <?php if (!empty($item['hexa_box_icon_svg'])): ?>
                                                        <div class="hf-el-rep-icon">
                                                            <?php echo $item['hexa_box_icon_svg']; ?>
                                                        </div>
                                                        <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="about-features-contents tr-about-list-content">
                                                        <?php if (!empty($item['about_features_title'])): ?>
                                                        <span class="hf-el-rep-title">
                                                            <?php echo hexa_kses($item['about_features_title']); ?>
                                                        </span>
                                                        <?php endif; ?>

                                                        <?php if (!empty($item['about_features_des'])): ?>
                                                            <p class="hf-el-rep-des">
                                                            <?php echo hexa_kses($item['about_features_des']); ?>
                                                            </p>
                                                        <?php endif; ?>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>

                                    </div>

                                    <?php if (!empty($settings['btn_text'])): ?>
                                        <div class="tr-about-btn">
                                            <a <?php echo $this->get_render_attribute_string('button'); ?>>
                                                <?php echo hexa_kses($settings['btn_text']); ?>
                                                <i class="<?php echo esc_attr($settings['button_icon']['value']); ?>"></i>
                                            </a>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            <?php else:

                // thumbnail
                if (!empty($settings['hexa_image']['url'])) {
                    $hexa_image = !empty($settings['hexa_image']['id']) ? wp_get_attachment_image_url($settings['hexa_image']['id'], $settings['hexa_image_size_size']) : $settings['hexa_image']['url'];
                    $hexa_image_alt = get_post_meta($settings["hexa_image"]["id"], "_wp_attachment_image_alt", true);
                }

                if (!empty($settings['hexa_image2']['url'])) {
                    $hexa_image2 = !empty($settings['hexa_image2']['id']) ? wp_get_attachment_image_url($settings['hexa_image2']['id'], $settings['hexa_image_size_size']) : $settings['hexa_image2']['url'];
                    $hexa_image_alt2 = get_post_meta($settings["hexa_image2"]["id"], "_wp_attachment_image_alt", true);
                }

                $this->add_render_attribute('title_args', 'class', 'tr-section-title mb-20 hf-el-title');


                // button one
                if (!empty($settings['btn_link']['url'])) {
                    $this->add_link_attributes('button', $settings['btn_link']);
                }
                $this->add_render_attribute('button', 'class', 'tr-btn-green hexa-el-btn');
            ?>
            <!-- about-area-start -->
            <div class="tr-about-area fix hf-el-section">
                <div class="container">
                    <div class="row align-items-end">
                        <div class="col-xl-6 col-lg-6">
                            <div class="tr-about-left">
                                <div class="tr-about-title-box">
                                    <?php if (!empty($settings['about_subtitle'])): ?>
                                    <span class="tr-section-subtitle mb-10 hf-el-subtitle">
                                        <?php echo hexa_kses($settings['about_subtitle']); ?>
                                    </span>
                                    <?php endif; ?>

                                    <?php
                                        if (!empty($settings['title'])):
                                            printf(
                                                '<%1$s %2$s>%3$s</%1$s>',
                                                tag_escape($settings['title_tag']),
                                                $this->get_render_attribute_string('title_args'),
                                                hexa_kses($settings['title'])
                                            );
                                        endif;
                                    ?>
                                </div>

                                <?php if (!empty($settings['desc'])): ?>
                                <div class="tr-about-text">
                                    <p class="hf-el-content">
                                        <?php echo hexa_kses($settings['desc']); ?>
                                    </p>
                                </div>
                                <?php endif; ?>

                                <?php foreach ($settings['about_features_list'] as $key => $item): ?>
                                    <div class="tr-about-content hexa-el-about-list p-relative">

                                        <div class="hfchoose-icon">
                                            <?php if ($item['hexa_box_icon_type'] == 'icon'): ?>
                                            <?php if (!empty($item['hexa_box_icon']) || !empty($item['hexa_box_selected_icon']['value'])): ?>
                                            <span class="hf-el-rep-icon">
                                                <?php hexa_render_icon($item, 'hexa_box_icon', 'hexa_box_selected_icon'); ?>
                                            </span>
                                            <?php endif; ?>
                                            <?php elseif ($item['hexa_box_icon_type'] == 'image'): ?>
                                            <?php if (!empty($item['hexa_box_icon_image']['url'])): ?>
                                            <span class="hf-el-rep-icon">
                                                <img src="<?php echo $item['hexa_box_icon_image']['url']; ?>"
                                                    alt="<?php echo get_post_meta(attachment_url_to_postid($item['hexa_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                            </span>
                                            <?php endif; ?>
                                            <?php else: ?>
                                            <?php if (!empty($item['hexa_box_icon_svg'])): ?>
                                            <span class="hf-el-rep-icon">
                                                <?php echo $item['hexa_box_icon_svg']; ?>
                                            </span>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                        </div>

                                        <div class="about-features-contents tr-about-list-content">
                                            <?php if (!empty($item['about_features_title'])): ?>
                                            <span class="hf-el-rep-title">
                                                <?php echo hexa_kses($item['about_features_title']); ?>
                                            </span>
                                            <?php endif; ?>

                                            <?php if (!empty($item['about_features_des'])): ?>
                                            <p class="hf-el-rep-des">
                                                <?php echo hexa_kses($item['about_features_des']); ?>
                                            </p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                                <?php if (!empty($settings['btn_text'])): ?>
                                <div class="tr-about-btn">
                                    <a <?php echo $this->get_render_attribute_string('button'); ?>>
                                        <?php echo hexa_kses($settings['btn_text']); ?>
                                        <i class="<?php echo esc_attr($settings['button_icon']['value']); ?>"></i>
                                    </a>
                                </div>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <div class="tr-about-thumb-wrap">
                                <div class="row gx-20 align-items-end">
                                    <div class="col-xl-6 col-lg-6 col-md-6">

                                        <?php if (!empty($hexa_image)): ?>
                                        <div class="tr-about-thumb-1 p-relative">
                                            <span class="tr-about-circle-shape"></span>
                                            <img class="w-100" src="<?php echo esc_url($hexa_image); ?>"
                                                alt="<?php echo esc_attr($hexa_image_alt); ?>">
                                        </div>
                                        <?php endif; ?>

                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="tr-about-thumb-2">
                                            <?php if (!empty($hexa_image2)): ?>
                                            <img class="w-100" src="<?php echo esc_url($hexa_image2); ?>"
                                                alt="<?php echo esc_attr($hexa_image_alt2); ?>">
                                            <?php endif; ?>
                                            <div class="tr-about-client d-flex align-items-center">
                                                <div class="tr-about-client-content">
                                                    <?php if (!empty($settings['client_content_number'])): ?>
                                                    <h4>
                                                        <span data-purecounter-duration="1"
                                                            data-purecounter-end="<?php echo esc_attr($settings['client_content_number']); ?>"
                                                            class="purecounter">0</span>
                                                        +
                                                    </h4>
                                                    <?php endif; ?>

                                                    <?php if (!empty($settings['client_content_title'])): ?>
                                                    <span>
                                                        <?php echo hexa_kses($settings['client_content_title']); ?>
                                                    </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- about-area-end -->

        <?php endif;
    }
}

$widgets_manager->register(new Hexa_About());