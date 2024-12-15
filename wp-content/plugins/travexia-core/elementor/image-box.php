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
class Hexa_Image_Box extends Widget_Base
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
        return 'hf-image-box';
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
        return __('Image Box', 'hexacore');
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

        $this->start_controls_section(
            'section_image',
            [
                'label' => esc_html__('Content', 'hexacore'),
                'description' => esc_html__('Control all the style settings from Style tab', 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__('Upload Image', 'hexacore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'image_size',
                'exclude' => ['1536x1536', '2048x2048'],
                'include' => [],
                'default' => 'full',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Food', 'hexacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'desc',
            [
                'label' => esc_html__('Description', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Food', 'hexacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __('Link', 'hexacore'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'hexacore'),
                'default'    => [],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'btn_text',
            [
                'label' => __('Button Text', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Learn More', 'hexacore'),
                'label_block' => 'true',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'blink',
            [
                'label' => __('Button Link', 'hexacore'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'hexacore'),
                'default'    => [],
                'condition' => [
                    'btn_text!' => '',
                ]
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

        $this->end_controls_section();
    }

    protected function style_tab_content()
    {
        $this->start_controls_section(
            'section_general_style',
            [
                'label' => __('General', 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'hexa_design_layout' => ['layout_1']
                ]
            ]
        );
        $this->add_control(
            'display',
            [
                'label' => __('Display', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'd-block',
                'options' => [
                    'd-block' => [
                        'title' => __('Block', 'hexacore'),
                    ],
                    'd-flex' => [
                        'title' => __('Flex', 'hexacore'),
                    ]
                ],
                'render_type' => 'template', /*Live load*/
            ]
        );
        $this->add_responsive_control(
            'text_align',
            [
                'label' => __('Alginment', 'hexacore'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
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
                'default' => '',
                'selectors'    => [
                    '{{WRAPPER}} .hexa-el-card' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'display' => ['d-block']
                ]
            ]
        );
        $this->add_responsive_control(
            'content-justify',
            [
                'label' => __('Horigontal Align', 'hexacore'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __('Left', 'hexacore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'hexacore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => __('Right', 'hexacore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors'    => [
                    '{{WRAPPER}} .hexa-el-card' => 'justify-content: {{VALUE}};',
                ],
                'condition' => [
                    'display' => ['d-flex']
                ]
            ]
        );
        $this->add_responsive_control(
            'items-align',
            [
                'label' => __('Vertical Align', 'hexacore'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __('Left', 'hexacore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'hexacore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => __('Right', 'hexacore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors'    => [
                    '{{WRAPPER}} .hexa-el-card' => 'align-items: {{VALUE}};',
                ],
                'condition' => [
                    'display' => ['d-flex']
                ]
            ]
        );
        $this->end_controls_section();
        $this->hexa_card_style_controls('image_card', 'Wrpper - Style', '.hexa-el-card');
        $this->hexa_icon_style_controls('image_image', 'Image - Style', '.hexa-el-image');
        $this->hexa_basic_style_controls('image_title', 'Title - Style', '.hexa-el-title');
        $this->hexa_basic_style_controls('image_desc', 'Description - Style', '.hexa-el-desc');
        $this->hexa_button_style_controls('image_btn', 'Button - Style', '.hexa-el-btn');
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

            $image_html = \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings, 'image_size', 'image');

            $this->add_render_attribute('title', 'class', 'hexa-image-title hexa-el-title');
            $title_html = sprintf('<%1$s %2$s>%3$s</%1$s>', $title_tag, $this->get_render_attribute_string('title'), $title);
            if (!empty($settings['link']['url'])) {
                $this->add_link_attributes('link', $settings['link']);
                $title_html = sprintf('<%1$s %2$s><a ' . $this->get_render_attribute_string('link') . '>%3$s</a></%1$s>', $title_tag, $this->get_render_attribute_string('title'), $title);
            }

            if (!empty($settings['blink']['url'])) {
                $this->add_link_attributes('blink', $settings['blink']);
            }
            $this->add_render_attribute('blink', 'class', 'hexa-el-btn');
        ?>


            <div class="hexa-image-card hexa-el-card <?php echo esc_attr($display); ?>">
                <div class="hexa-image-thumb">
                    <?php if (!empty($settings['image']['url'])) : ?>
                        <div class="hexa-el-image">
                            <?php echo wp_kses_post($image_html); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="hexa-image-content">
                    <?php if (!empty($settings['title'])) {
                        echo $title_html;
                    } ?>
                    <?php if (!empty($settings['content'])) {
                        echo '<p class="hexa-image-desc hexa-el-desc">' . $settings['desc'] . '</p>';
                    } ?>
                    <?php if (!empty($settings['btn_text'])) { ?>
                        <div class="hexa-btn-wrapper">
                            <a <?php $this->print_render_attribute_string('blink'); ?>>
                                <?php $this->print_unescaped_setting('btn_text'); ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>


<?php endif;
    }
}

$widgets_manager->register(new Hexa_Image_Box());
