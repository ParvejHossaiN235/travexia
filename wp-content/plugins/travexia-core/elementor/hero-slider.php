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
class Hexa_Hero_Slider extends Widget_Base
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
        return 'hf-hero-slider';
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
        return __('Hero Slider', 'hexacore');
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
                    // 'layout-3' => esc_html__('Layout 3', 'hexacore'),
                    // 'layout-4' => esc_html__('Layout 4', 'hexacore'),
                    // 'layout-5' => esc_html__('Layout 5', 'hexacore'),
                ],
                'default' => 'layout_1',
            ]
        );

        $this->end_controls_section();

        // hero slider
        $this->start_controls_section(
            'section_hero_banner_2',
            [
                'label' => __('Banner Content', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TAB_CONTENT,
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
                'default' => __('A travel agency is a private retailer or public service <br> that provides Traveling opens up a world', 'hexacore'),
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
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // hero slider
        $this->start_controls_section(
            'section_hero_slider',
            [
                'label' => __('Slider Image', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => __('Image', 'hexacore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => __('Title', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Banner title', 'hexacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'hero_slider',
            [
                'label'       => '',
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'show_label'  => false,
                'default'     => [
                    [
                        'title'      => __('Image 1', 'hexacore'),
                    ],
                    [
                        'title'      => __('Image 2', 'hexacore'),
                    ],
                    [
                        'title'      => __('Image 3', 'hexacore'),
                    ]
                ],
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{title}}}',
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

        $this->start_controls_section(
            'section_hero_slider2 ',
            [
                'label' => __('Slider Image 2', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater2 = new \Elementor\Repeater();

        $repeater2->add_control(
            'image2',
            [
                'label' => __('Image', 'hexacore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater2->add_control(
            'title',
            [
                'label' => __('Title', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Banner title', 'hexacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'hero_slider2',
            [
                'label'       => '',
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'show_label'  => false,
                'default'     => [
                    [
                        'title2'      => __('Image 1', 'hexacore'),
                    ],
                    [
                        'title2'      => __('Image 2', 'hexacore'),
                    ],
                    [
                        'title2'      => __('Image 3', 'hexacore'),
                    ]
                ],
                'fields'      => $repeater2->get_controls(),
                'title_field' => '{{{title2}}}',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'simage_size2',
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

        $this->hexa_section_style_controls('banner_section', 'Section Style', '.ele-section');
        $this->hexa_basic_style_controls('section_subtitle', 'Section - Subtitle', '.hf-el-subtitle');
        $this->hexa_basic_style_controls('section_title', 'Section - Title', '.hf-el-title');
        $this->hexa_basic_style_controls('section_desc', 'Section - Description', '.hf-el-content');
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
        extract($settings);

?>

        <?php if ($settings['hexa_design_layout']  == 'layout_2') : ?>

        <?php else :

            $html_tag = $settings['title_tag'];
            $title = $settings['title'];
            if (!empty($settings['btn_link']['url'])) {
                $this->add_link_attributes('button', $settings['btn_link']);
            }
            $this->add_render_attribute('button', 'class', 'tr-btn-green hexa-el-btn');

            //title
            $this->add_render_attribute('title', 'class', 'tr-hero-3-title mb-25 hexa-el-title wow itfadeUp');
            $this->add_render_attribute('title', 'data-wow-delay', '0.9s');
            $this->add_render_attribute('title', 'data-wow-duration', '0.3s');
            $title_html = sprintf('<%1$s %2$s>%3$s</%1$s>', $html_tag, $this->get_render_attribute_string('title'), $title);

        ?>

            <!-- hero-area-start -->
            <div class="tr-hero-3-area grey-bg z-index-1">
                <div class="tr-hero-3-bg fix">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-6 col-lg-6">
                                <div class="tr-hero-3-content">
                                    <?php if (!empty($settings['title'])) {
                                        echo $title_html;
                                    } ?>
                                    <?php if (!empty($settings['desc'])) : ?>
                                        <p class="wow itfadeUp hexa-el-desc" data-wow-delay=".9s" data-wow-duration=".5s">
                                            <?php echo wp_kses_post($settings['desc']); ?>
                                        </p>
                                    <?php endif; ?>
                                    <?php if (!empty($settings['btn_text'])) : ?>
                                        <div class="tr-hero-2-btn wow itfadeUp" data-wow-duration=".9s" data-wow-delay=".7s">
                                            <a <?php echo $this->get_render_attribute_string('button'); ?>>
                                                <?php echo wp_kses_post($settings['btn_text']); ?>
                                                <i class="fa-sharp fa-regular fa-arrow-right-long"></i>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <div class="tr-hero-3-slider-main">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-6">
                                            <div class="tr-hero-slider-wrap tr-hero-3-active-1">
                                                <?php
                                                foreach ($settings['hero_slider'] as $key => $item) :

                                                    //image
                                                    $image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src($item['image']['id'], 'simage_size', $settings);
                                                    if (empty($image_url)) {
                                                        $image_url = \Elementor\Utils::get_placeholder_image_src();
                                                    }
                                                    $image_html = '<img src="' . esc_attr($image_url) . '" alt="' . esc_attr($item['title']) . '">';

                                                ?>
                                                    <?php if (!empty($item['image']['url'])) { ?>
                                                        <div class="tr-hero-3-slider-item mb-40">
                                                            <?php echo wp_kses_post($image_html); ?>
                                                        </div>
                                                    <?php } ?>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-6">
                                            <div class="tr-hero-slider-wrap tr-hero-3-active-2">
                                                <?php
                                                foreach ($settings['hero_slider2'] as $key => $item) :
                                                    //image
                                                    $image_url2 = \Elementor\Group_Control_Image_Size::get_attachment_image_src($item['image2']['id'], 'simage_size2', $settings);
                                                    if (empty($image_url2)) {
                                                        $image_url2 = \Elementor\Utils::get_placeholder_image_src();
                                                    }
                                                    $image_html2 = '<img src="' . esc_attr($image_url2) . '" alt="' . esc_attr($item['title2']) . '">';

                                                ?>
                                                    <?php if (!empty($item['image2']['url'])) { ?>
                                                        <div class="tr-hero-3-slider-item mb-40">
                                                            <?php echo wp_kses_post($image_html2); ?>
                                                        </div>
                                                    <?php } ?>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- hero-area-end -->

<?php endif;
    }
}

$widgets_manager->register(new Hexa_Hero_Slider());
