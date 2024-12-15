<?php

namespace HexaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use HexaCore\Elementor\Controls\Group_Control_HexaBGGradient;
use HexaCore\Elementor\Controls\Group_Control_HexaGradient;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Hexa Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Hexa_ServiceSlider extends Widget_Base
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
        return 'hf-service-slider';
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
        return __('Service Slider', 'hexacore');
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
                    // 'layout_3' => esc_html__('Layout 3', 'hexacore'),
                    // 'layout_4' => esc_html__('Layout 4', 'hexacore'),
                    // 'layout_5' => esc_html__('Layout 5', 'hexacore'),
                ],
                'default' => 'layout_1',
            ]
        );

        $this->end_controls_section();

        // fact group
        $this->start_controls_section(
            'service_list_content',
            [
                'label' => esc_html__('Service List', 'hexacore'),
                'description' => esc_html__('Control all the style settings from Style tab', 'hexacore'),
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
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
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
                'condition' => [
                    'repeater_condition!' => ['style_5']
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
                ]
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'hexacore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('link', 'hexacore'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'hexacore'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                ],
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'desc',
            [
                'label' => esc_html__('Description', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'hexacore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'show_btn',
            [
                'label' => esc_html__('Show Button', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'hexacore'),
                'label_off' => esc_html__('Hide', 'hexacore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'repeater_condition' => ['style_1']
                ]
            ]
        );

        $repeater->add_control(
            'btn_text',
            [
                'label' => esc_html__('Button Text', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Click Here', 'hexacore'),
                'title' => esc_html__('Enter button text', 'hexacore'),
                'label_block' => true,
                'condition' => [
                    'show_btn' => 'yes',
                    'repeater_condition' => ['style_1']
                ]
            ]
        );

        $repeater->add_control(
            'btn_selected_icon',
            [
                'label' => esc_html__('Button Icon', 'hexacore'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'label_block' => false,
                'skin' => 'inline',
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'show_btn' => 'yes',
                    'repeater_condition' => ['style_1']
                ]
            ]
        );

        $repeater->add_control(
            'btn_link',
            [
                'label' => esc_html__('Button link', 'hexacore'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'hexacore'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                ],
                'label_block' => true,
                'condition' => [
                    'show_btn' => 'yes',
                    'repeater_condition' => ['style_1']
                ]
            ]
        );

        $this->add_control(
            'service_list',
            [
                'label' => esc_html__('Service - List', 'hexacore'),
                'show_label'  => false,
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => esc_html__('Business', 'hexacore'),
                    ],
                    [
                        'title' => esc_html__('Website', 'hexacore')
                    ],
                    [
                        'title' => esc_html__('Marketing', 'hexacore')
                    ]
                ],
                'title_field' => '{{{ title }}}',
            ]
        );
        $this->end_controls_section();
    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->hexa_section_style_controls('services_section', 'Section - Style', '.hf-el-section');
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

        <?php if ($settings['hexa_design_layout']  == 'layout_2') : ?>

            <div class="swiper service__active">
                <div class="swiper-wrapper">
                    <?php foreach ($settings['service_list'] as $key => $item) :

                        $title = $item['title'];
                        $desc = $item['desc'];
                        if (!empty($item['link']['url'])) {
                            $this->add_link_attributes('t_link' . $key, $item['link']);
                            $title = '<a ' . $this->get_render_attribute_string('t_link' . $key) . '>' . $title . '</a>';
                        }
                    ?>
                        <div class="swiper-slide">
                            <div class="service__wrapper service__item style-two text-center">
                                <?php if ($item['icon_type'] == 'icon') : ?>
                                    <?php if (!empty($item['selected_icon']['value'])) : ?>
                                        <div class="service__icon-wrap bg-primary-opacity hf-el-rep-icon">
                                            <?php \Elementor\Icons_Manager::render_icon($item['selected_icon'], ['aria-hidden' => 'true']); ?>
                                        </div>
                                    <?php endif; ?>
                                <?php elseif ($item['icon_type'] == 'image') : ?>
                                    <?php if (!empty($item['icon_image']['url'])) : ?>
                                        <div class="service__icon-wrap bg-primary-opacity hf-el-rep-icon">
                                            <img src="<?php echo $item['icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                        </div>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <?php if (!empty($item['icon_svg'])) : ?>
                                        <div class="service__icon-wrap bg-primary-opacity hf-el-rep-icon">
                                            <?php echo $item['icon_svg']; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <div class="service__content">
                                    <?php if (!empty($item['title'])) : ?>
                                        <h5 class="service__title">
                                            <?php echo wp_kses_post($title); ?>
                                        </h5>
                                    <?php endif; ?>
                                    <?php if (!empty($item['desc'])) : ?>
                                        <p><?php echo wp_kses_post($desc); ?></p>
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

            <div class="swiper service__active">
                <div class="swiper-wrapper">
                    <?php foreach ($settings['service_list'] as $key => $item) :

                        $title = $item['title'];
                        $desc = $item['desc'];
                        if (!empty($item['link']['url'])) {
                            $this->add_link_attributes('t_link' . $key, $item['link']);
                            $title = '<a ' . $this->get_render_attribute_string('t_link' . $key) . '>' . $title . '</a>';
                        }
                        // button content
                        if (!empty($item['btn_link']['url'])) {
                            $this->add_link_attributes('button' . $key, $item['btn_link']);
                        }
                        $this->add_render_attribute('button' . $key, 'class', 'circle-btn is-hover hexa-el-btn');
                        $migrated = isset($item['__fa4_migrated']['btn_selected_icon']);
                        $is_new = empty($item['icon']) && \Elementor\Icons_Manager::is_migration_allowed();
                    ?>
                        <div class="swiper-slide">
                            <div class="service__wrapper service__item style-two text-center">
                                <?php if ($item['icon_type'] == 'icon') : ?>
                                    <?php if (!empty($item['selected_icon']['value'])) : ?>
                                        <div class="service__icon-wrap bg-primary-opacity hf-el-rep-icon">
                                            <?php \Elementor\Icons_Manager::render_icon($item['selected_icon'], ['aria-hidden' => 'true']); ?>
                                        </div>
                                    <?php endif; ?>
                                <?php elseif ($item['icon_type'] == 'image') : ?>
                                    <?php if (!empty($item['icon_image']['url'])) : ?>
                                        <div class="service__icon-wrap bg-primary-opacity hf-el-rep-icon">
                                            <img src="<?php echo $item['icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                        </div>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <?php if (!empty($item['icon_svg'])) : ?>
                                        <div class="service__icon-wrap bg-primary-opacity hf-el-rep-icon">
                                            <?php echo $item['icon_svg']; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <div class="service__content">
                                    <?php if (!empty($item['title'])) : ?>
                                        <h5 class="service__title">
                                            <?php echo wp_kses_post($title); ?>
                                        </h5>
                                    <?php endif; ?>
                                    <?php if (!empty($item['desc'])) : ?>
                                        <p><?php echo wp_kses_post($desc); ?></p>
                                    <?php endif; ?>
                                    <?php if (!empty($item['show_btn'])) : ?>
                                        <div class="service__more">
                                            <a <?php echo $this->get_render_attribute_string('button' . $key); ?>>
                                                <?php echo wp_kses_post($item['btn_text']); ?>
                                                <span class="icon__box">
                                                    <?php if (!empty($item['icon']) || !empty($item['btn_selected_icon']['value'])) : ?>
                                                        <?php if ($is_new || $migrated) :
                                                            \Elementor\Icons_Manager::render_icon($item['btn_selected_icon'], ['aria-hidden' => 'true']);
                                                        else : ?>
                                                            <i class="<?php echo esc_attr($item['icon']); ?>" aria-hidden="true"></i>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </span>
                                            </a>
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

$widgets_manager->register(new Hexa_ServiceSlider());
