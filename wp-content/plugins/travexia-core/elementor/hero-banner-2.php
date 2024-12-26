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
class Hexa_Hero_Banner_2 extends Widget_Base
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
        return 'hf-hero-banner-2';
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
        return __('Hero Banner 2', 'hexacore');
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

        // hero slider
        $this->start_controls_section(
            'section_hero_banner_2',
            [
                'label' => __('Banner Content', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'subtitle',
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
                'default' => 'h3',
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
            'btn_text',
            [
                'label' => __('Button', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Click here', 'hexacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'btn_link',
            [
                'label' => esc_html__('Link', 'hexacore'),
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
            'sm_title',
            [
                'label' => __('Small Title', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Small Title', 'hexacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'sm_title2',
            [
                'label' => __('Small Title 2', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Small Title', 'hexacore'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_hero_images',
            [
                'label' => __('Banner Images', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'image',
            [
                'label' => __('Image', 'hexacore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'shape_image',
            [
                'label' => __('Shape Image', 'hexacore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'shape_image2',
            [
                'label' => __('Shape Imag 2', 'hexacore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'sm_image',
            [
                'label' => __('Small Image', 'hexacore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'sm_image2',
            [
                'label' => __('Small Image 2', 'hexacore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'simage_size',
                'exclude' => ['1536x1536', '2048x2048'],
                'include' => [],
                'default' => 'full',
            ]
        );

        $this->end_controls_section();
    }

    // style_tab_content
    protected function style_tab_content()
    {

        $this->hexa_section_style_controls('banner_section', 'Section Style', '.hexa-section');
        $this->hexa_basic_style_controls('section_subtitle', 'Section - Subtitle', '.hexa-el-subtitle');
        $this->hexa_basic_style_controls('section_title', 'Section - Title', '.hexa-el-title');
        $this->hexa_basic_style_controls('section_desc', 'Section - Description', '.hexa-el-desc');
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
        $html_tag = $settings['title_tag'];
        $title = $settings['title'];

        //bg image
        $shape_image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src($settings['shape_image']['id'], 'simage_size', $settings);
        if (empty($shape_image_url)) {
            $shape_image_url = \Elementor\Utils::get_placeholder_image_src();
        }
        $image_html2 = '<img src="' . esc_attr($shape_image_url) . '" alt="' . esc_attr($settings['title']) . '">';

        $shape_image_url2 = \Elementor\Group_Control_Image_Size::get_attachment_image_src($settings['shape_image2']['id'], 'simage_size', $settings);
        if (empty($shape_image_url2)) {
            $shape_image_url2 = \Elementor\Utils::get_placeholder_image_src();
        }
        $image_html3 = '<img src="' . esc_attr($shape_image_url2) . '" alt="' . esc_attr($settings['title']) . '">';

        $sm_image = \Elementor\Group_Control_Image_Size::get_attachment_image_src($settings['sm_image']['id'], 'simage_size', $settings);
        if (empty($sm_image)) {
            $sm_image = \Elementor\Utils::get_placeholder_image_src();
        }
        $image_html4 = '<img src="' . esc_attr($sm_image) . '" alt="' . esc_attr($settings['title']) . '">';

        $sm_image2 = \Elementor\Group_Control_Image_Size::get_attachment_image_src($settings['sm_image2']['id'], 'simage_size', $settings);
        if (empty($sm_image2)) {
            $sm_image2 = \Elementor\Utils::get_placeholder_image_src();
        }
        $image_html5 = '<img src="' . esc_attr($sm_image2) . '" alt="' . esc_attr($settings['title']) . '">';

        // normal image
        $image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src($settings['image']['id'], 'simage_size', $settings);
        if (empty($image_url)) {
            $image_url = \Elementor\Utils::get_placeholder_image_src();
        }
        $image_html = '<img src="' . esc_attr($image_url) . '" alt="' . esc_attr($settings['title']) . '">';

        // button one
        if (!empty($settings['btn_link']['url'])) {
            $this->add_link_attributes('button', $settings['btn_link']);
        }
        $this->add_render_attribute('button', 'class', 'tr-btn-green light-green hexa-el-btn');


        //title
        $this->add_render_attribute('title', 'class', 'tr-section-title-2 mb-25 hexa-el-title wow itfadeUp');
        $this->add_render_attribute('title', 'data-wow-delay', '0.9s');
        $this->add_render_attribute('title', 'data-wow-duration', '0.5s');
        $title_html = sprintf('<%1$s %2$s>%3$s</%1$s>', $html_tag, $this->get_render_attribute_string('title'), $title);

?>

        <!-- hero-area-start -->
        <div class="tr-hero-2-area tr-hero-2-pt p-relative theme-bg hexa-section z-index-1">
            <?php if (!empty($settings['shape_image']['url'])) { ?>
                <div class="tr-hero-2-shape-1">
                    <?php echo wp_kses_post($image_html2); ?>
                </div>
            <?php }; ?>
            <div class="container">
                <div class="row align-items-end">
                    <div class="col-xl-5 col-lg-6">
                        <div class="tr-hero-2-content">

                            <?php if (!empty($settings['subtitle'])) : ?>
                                <span class="tr-section-subtitle text-white mb-25 wow itfadeUp hexa-el-subtitle" data-wow-delay=".9s" data-wow-duration=".3s">
                                    <?php echo wp_kses_post($settings['subtitle']); ?>
                                </span>
                            <?php endif; ?>

                            <?php if (!empty($settings['title'])) {
                                echo $title_html;
                            } ?>

                            <?php if (!empty($settings['desc'])) : ?>
                                <p class="wow itfadeUp hexa-el-desc" data-wow-delay=".9s" data-wow-duration=".7s">
                                    <?php echo wp_kses_post($settings['desc']); ?>
                                </p>
                            <?php endif; ?>
                            <?php if (!empty($settings['btn_text'])) : ?>
                                <div class="tr-hero-2-btn wow itfadeUp" data-wow-duration=".9s" data-wow-delay=".9s">
                                    <a <?php echo $this->get_render_attribute_string('button'); ?>>
                                        <?php echo wp_kses_post($settings['btn_text']); ?>
                                        <i class="fa-sharp fa-regular fa-arrow-right-long"></i>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-6">
                        <div class="tr-hero-2-thumb-wrapper p-relative">
                            <?php if (!empty($settings['image']['url'])) { ?>
                                <div class="tr-hero-2-thumb">
                                    <?php echo wp_kses_post($image_html); ?>
                                </div>
                            <?php } ?>
                            <?php if (!empty($settings['shape_image2']['url'])) { ?>
                                <div class="tr-hero-2-thumb-shape">
                                    <?php echo wp_kses_post($image_html3); ?>
                                </div>
                            <?php } ?>
                            <div class="tr-hero-2-tour-box item-1 d-none d-md-flex d-flex justify-content-between align-items-center">
                                <?php if (!empty($settings['sm_title'])) { ?>
                                    <h5 class="tr-hero-2-tour-title">
                                        <?php echo wp_kses_post($settings['sm_title']); ?>
                                    </h5>
                                <?php } ?>
                                <?php if (!empty($settings['sm_image']['url'])) { ?>
                                    <?php echo wp_kses_post($image_html4); ?>
                                <?php } ?>
                            </div>
                            <div class="tr-hero-2-tour-box item-2 d-none d-md-flex d-flex justify-content-between align-items-center">
                                <?php if (!empty($settings['sm_title2'])) { ?>
                                    <h5 class="tr-hero-2-tour-title">
                                        <?php echo wp_kses_post($settings['sm_title2']); ?>
                                    </h5>
                                <?php } ?>
                                <?php if (!empty($settings['sm_image2']['url'])) { ?>
                                    <?php echo wp_kses_post($image_html5); ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- hero-area-end -->
<?php
    }
}

$widgets_manager->register(new Hexa_Hero_Banner_2());
