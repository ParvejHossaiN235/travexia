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
class Hexa_Contact_Info extends Widget_Base
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
        return 'hf-contact-info';
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
        return __('Contact Info', 'hexacore');
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
        $this->register_content_controls();
        $this->register_style_controls();
    }

    // TAB_CONTENT
    protected function register_content_controls()
    {
        $this->design_layout();
        $this->contact_content_controls();
    }

    protected function design_layout()
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
    }

    protected function contact_content_controls()
    {
        // Contact group

        $this->start_controls_section(
            'section_contact',
            [
                'label' => esc_html__('Contact Info', 'hexacore'),
                'description' => esc_html__('Control all the style settings from Style tab', 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'icon_type',
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

        $this->add_control(
            'icon_svg',
            [
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'hexacore'),
                'condition' => [
                    'icon_type' => 'svg',
                ]
            ]
        );

        $this->add_control(
            'icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'hexacore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'icon_type' => 'image',
                ]
            ]
        );

        $this->add_control(
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
                ]
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Label', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Contact Label', 'hexacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Contact Title', 'hexacore'),
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


    // TAB_STYLE
    protected function register_style_controls()
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

        $this->hexa_card_style_controls('contact_card', 'Wrpper - Style', '.hexa-el-card');
        $this->hexa_icon_style_controls('contact_icon', 'Icon - Style', '.hexa-el-icon');
        $this->hexa_basic_style_controls('contact_title', 'Title - Style', '.hexa-el-title');
        $this->hexa_basic_style_controls('contact_label', 'Label - Style', '.hexa-el-label');
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

        <?php if ($settings['hexa_design_layout']  == 'layout_2') :

            $this->add_render_attribute('title', 'class', 'hexa-contact-title hexa-el-title');
            $title_html = sprintf('<%1$s %2$s>%3$s</%1$s>', $title_tag, $this->get_render_attribute_string('title'), $title);
            if (!empty($settings['link']['url'])) {
                $this->add_link_attributes('link', $settings['link']);
                if (!empty($settings['link'])) {
                    $title_html = sprintf('<%1$s %2$s><a ' . $this->get_render_attribute_string('link') . '>%3$s</a></%1$s>', $title_tag, $this->get_render_attribute_string('title'), $title);
                }
            }

        ?>


        <?php else :

            $this->add_render_attribute('title', 'class', 'hexa-contact-title hexa-el-title');
            $title_html = sprintf('<%1$s %2$s>%3$s</%1$s>', $title_tag, $this->get_render_attribute_string('title'), $title);
            if (!empty($settings['link']['url'])) {
                $this->add_link_attributes('link', $settings['link']);
                if (!empty($settings['link'])) {
                    $title_html = sprintf('<%1$s %2$s><a ' . $this->get_render_attribute_string('link') . '>%3$s</a></%1$s>', $title_tag, $this->get_render_attribute_string('title'), $title);
                }
            }

        ?>

            <div class="hexa-contact-item hexa-el-card <?php echo esc_attr($display); ?>">
                <div class=" hexa-contact-icon">
                    <?php if ($settings['icon_type'] == 'icon') : ?>
                        <?php if (!empty($settings['selected_icon']['value'])) : ?>
                            <span class="hexa-el-icon">
                                <?php \Elementor\Icons_Manager::render_icon($settings['selected_icon'], ['aria-hidden' => 'true']); ?>
                            </span>
                        <?php endif; ?>
                    <?php elseif ($settings['icon_type'] == 'image') : ?>
                        <?php if (!empty($settings['icon_image']['url'])) : ?>
                            <span class="hexa-el-icon">
                                <img src="<?php echo $settings['icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                            </span>
                        <?php endif; ?>
                    <?php else : ?>
                        <?php if (!empty($settings['icon_svg'])) : ?>
                            <span class="hexa-el-icon">
                                <?php echo $settings['icon_svg']; ?>
                            </span>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="hexa-contact-content">
                    <?php if (!empty($settings['subtitle'])) : ?>
                        <span class="hexa-contact-label hexa-el-label"><?php echo hexa_kses($settings['subtitle']); ?></span>
                    <?php endif; ?>
                    <?php if (!empty($settings['title'])) {
                        echo $title_html;
                    } ?>
                </div>
            </div>

<?php endif;
    }
}

$widgets_manager->register(new Hexa_Contact_Info());
