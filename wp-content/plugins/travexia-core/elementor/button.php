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
class Hexa_Button extends Widget_Base
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
        return 'hf-button';
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
        return __('Button', 'hexacore');
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

    public static function get_button_sizes()
    {
        return [
            ''   => esc_html__('Default', 'hexacore'),
            'sm' => esc_html__('Small', 'hexacore'),
            'lg' => esc_html__('Large', 'hexacore'),
        ];
    }

    protected function register_controls()
    {
        $this->register_controls_section();
        $this->style_tab_content();
    }

    protected function register_controls_section()
    {
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
                    'layout_3' => esc_html__('Layout 3', 'hexacore'),
                ],
                'default' => 'layout_1',
            ]
        );

        $this->end_controls_section();

        // hexa_btn_button_group
        $this->start_controls_section(
            'hexa_button_section',
            [
                'label' => esc_html__('Button', 'hexacore'),
            ]
        );

        $this->add_control(
            'btn_text',
            [
                'label' => esc_html__('Label', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Click Here', 'hexacore'),
                'title' => esc_html__('Enter button text', 'hexacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'btn_link',
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

        $this->add_responsive_control(
            'btn_align',
            [
                'label' => __('Alignment', 'hexacore'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start'    => [
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
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
                'default' => '',
            ]
        );

        $this->add_control(
            'btn_size',
            [
                'label' => esc_html__('Size', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => self::get_button_sizes(),
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'btn_selected_icon',
            [
                'label' => esc_html__('Icon', 'hexacore'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'label_block' => true,
                'default' => [
                    'value' => 'fa-sharp fa-regular fa-arrow-right-long',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function style_tab_content()
    {
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('General', 'hexacore'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'hexa_btn_display',
            [
                'label' => __('Display', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'inline' => __('Inline', 'hexacore'),
                    'block' => __('Block', 'hexacore'),
                    'inline-block' => __('Inline Block', 'hexacore'),
                    'flex' => __('Flex', 'hexacore'),
                    'inline-flex' => __('Inline Flex', 'hexacore')
                ],
                'selectors' => [
                    '{{WRAPPER}} .hexa-el-btn' => 'display: {{VALUE}};',
                ],
                'default' => 'inline-block',
            ]
        );

        $this->add_control(
            'btn_text_align',
            [
                'label' => __('Text Align', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'start' => __('Left', 'hexacore'),
                    'center' => __('center', 'hexacore'),
                    'right' => __('Right', 'hexacore')

                ],
                'selectors' => [
                    '{{WRAPPER}} .hexa-el-btn' => 'text-align: {{VALUE}};',
                ],
                'default' => 'center',
            ]
        );

        $this->add_responsive_control(
            'width',
            [
                'label' => __('Width', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vw'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hexa-el-btn' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->hexa_button_style_controls('default_hexabtn', 'Button - Style', '.hexa-el-btn');
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
        <?php if ($settings['hexa_design_layout']  == 'layout_3') :

            if (!empty($settings['btn_link']['url'])) {
                $this->add_link_attributes('button', $settings['btn_link']);
            }
            $this->add_render_attribute('button', 'class', 'tr-btn-green hexa-el-btn');
            if (!empty($settings['btn_size'])) {
                $this->add_render_attribute('button', 'class', 'hexa-btn-' . $settings['btn_size']);
            }

            $migrated = isset($settings['__fa4_migrated']['btn_selected_icon']);
            $is_new = empty($settings['icon']) && \Elementor\Icons_Manager::is_migration_allowed();

        ?>

            <div class="tr-fill-btn">
                <a <?php echo $this->get_render_attribute_string('button'); ?>>
                    <?php $this->print_unescaped_setting('btn_text'); ?>
                    <?php if (!empty($settings['icon']) || !empty($settings['btn_selected_icon']['value'])) : ?>
                        <?php if ($is_new || $migrated) :
                            \Elementor\Icons_Manager::render_icon($settings['btn_selected_icon'], ['aria-hidden' => 'true']);
                        else : ?>
                            <i class="<?php echo esc_attr($settings['icon']); ?>" aria-hidden="true"></i>
                        <?php endif; ?>
                    <?php endif; ?>
                </a>
            </div>

        <?php elseif ($settings['hexa_design_layout']  == 'layout_2') :


            if (!empty($settings['btn_link']['url'])) {
                $this->add_link_attributes('button', $settings['btn_link']);
            }
            $this->add_render_attribute('button', 'class', 'tr-btn hexa-el-btn');
            if (!empty($settings['btn_size'])) {
                $this->add_render_attribute('button', 'class', 'hexa-btn-' . $settings['btn_size']);
            }

            $migrated = isset($settings['__fa4_migrated']['btn_selected_icon']);
            $is_new = empty($settings['icon']) && \Elementor\Icons_Manager::is_migration_allowed();
        ?>

            <div class="tr-trip-btn">
                <a <?php echo $this->get_render_attribute_string('button'); ?>>
                    <?php $this->print_unescaped_setting('btn_text'); ?>
                    <?php if (!empty($settings['icon']) || !empty($settings['btn_selected_icon']['value'])) : ?>
                        <?php if ($is_new || $migrated) :
                            \Elementor\Icons_Manager::render_icon($settings['btn_selected_icon'], ['aria-hidden' => 'true']);
                        else : ?>
                            <i class="<?php echo esc_attr($settings['icon']); ?>" aria-hidden="true"></i>
                        <?php endif; ?>
                    <?php endif; ?>
                </a>
            </div>

        <?php else :

            $this->add_render_attribute('button-wrapper', 'class', 'hexa-btn-wrapper');

            if (!empty($settings['btn_link']['url'])) {
                $this->add_link_attributes('button', $settings['btn_link']);
            }
            $this->add_render_attribute('button', 'class', 'hexa-el-btn');
            if (!empty($settings['btn_size'])) {
                $this->add_render_attribute('button', 'class', 'hexa-btn-' . $settings['btn_size']);
            }

            $migrated = isset($settings['__fa4_migrated']['btn_selected_icon']);
            $is_new = empty($settings['icon']) && \Elementor\Icons_Manager::is_migration_allowed();


        ?>
            <div <?php echo $this->get_render_attribute_string('button-wrapper'); ?>>
                <a <?php echo $this->get_render_attribute_string('button'); ?>>
                    <?php $this->print_unescaped_setting('btn_text'); ?>
                    <?php if (!empty($settings['icon']) || !empty($settings['btn_selected_icon']['value'])) : ?>
                        <?php if ($is_new || $migrated) :
                            \Elementor\Icons_Manager::render_icon($settings['btn_selected_icon'], ['aria-hidden' => 'true']);
                        else : ?>
                            <i class="<?php echo esc_attr($settings['icon']); ?>" aria-hidden="true"></i>
                        <?php endif; ?>
                    <?php endif; ?>
                </a>
            </div>
        <?php endif; ?>
<?php
    }
}

$widgets_manager->register(new Hexa_Button());
