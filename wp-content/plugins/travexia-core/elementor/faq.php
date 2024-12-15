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
class Hexa_Faq extends Widget_Base
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
        return 'hf-accordions';
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
        return __('Accordions', 'hexacore');
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
                ],
                'default' => 'layout_1',
            ]
        );
        $this->end_controls_section();

        //Content Service box
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Accordions', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'acc_class',
            [
                'label' => __('Wrapper Class', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('acc-wrapper', 'hexacore'),
                'placeholder' => __('Type your accordion class', 'hexacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'accid',
            [
                'label' => __('Accordion ID', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('accordion_id', 'hexacore'),
                'placeholder' => __('accordion id with no space', 'hexacore'),
                'description' => __('Give a id with no space for accordion.', 'hexacore'),
                'label_block' => true,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'acc_active',
            [
                'label' => esc_html__('Show', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'hexacore'),
                'label_off' => esc_html__('Hide', 'hexacore'),
                'return_value' => 'yes',
                'default' => '0',
            ]
        );

        $repeater->add_control(
            'acc_title',
            [
                'label' => __('Title', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Accordion Title', 'hexacore'),
                'placeholder' => __('Accordion Title', 'hexacore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'acc_content',
            [
                'label' => __('Content', 'hexacore'),
                'default' => __('Accordion Content', 'hexacore'),
                'placeholder' => __('Accordion Content', 'hexacore'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'accordion_list',
            [
                'label' => __('Accordion Items', 'hexacore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'acc_title' => __('Accordion #1', 'hexacore'),
                        'acc_content' => __('We reimburse all expenses of the Client for the payment of fines and penalties that were caused by mistakes made by us in accounting and tax accounting and reporting.', 'hexacore'),
                    ],
                    [
                        'acc_title' => __('Accordion #2', 'hexacore'),
                        'acc_content' => __('We reimburse all expenses of the Client for the payment of fines and penalties that were caused by mistakes made by us in accounting and tax accounting and reporting.', 'hexacore'),
                    ],
                    [
                        'acc_title' => __('Accordion #3', 'hexacore'),
                        'acc_content' => __('We reimburse all expenses of the Client for the payment of fines and penalties that were caused by mistakes made by us in accounting and tax accounting and reporting.', 'hexacore'),
                    ],
                    [
                        'acc_title' => __('Accordion #4', 'hexacore'),
                        'acc_content' => __('We reimburse all expenses of the Client for the payment of fines and penalties that were caused by mistakes made by us in accounting and tax accounting and reporting.', 'hexacore'),
                    ],
                ],
                'title_field' => '{{{ acc_title }}}',
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __('Title Tag', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                ],
                'default' => 'h2',
            ]
        );

        $this->end_controls_section();
    }

    protected function style_tab_content()
    {
        $this->hexa_section_style_controls('faq_section', 'Section - Style', '.hf-el-section');
        $this->hexa_button_style_controls('acc_title', 'Title - Style', '.hexa-el-rep-title.collapsed');
        $this->hexa_basic_style_controls('acc_desc', 'Decription - Style', '.hexa-el-rep-desc');
        // Toggle style
        $this->start_controls_section(
            'style_toggle_icon',
            [
                'label' => __('Toggle Style', 'hexacore'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'accordion_toggle_color',
            [
                'label' => esc_html__('Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-item .hexa-el-rep-title::after' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'accordion_toggle_icon_size',
            [
                'label' => esc_html__('Size', 'elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'vw', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .accordion-item .hexa-el-rep-title::after' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                    //'{{WRAPPER}} ' . $control_selector . ' svg' => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->start_controls_tabs('accordion_toggle_icon_tabs');
        // Normal State Tab
        $this->start_controls_tab('accordion_toggle_icon_normal', ['label' => esc_html__('Normal', 'hexacore')]);
        $this->add_control(
            'accordion_toggle_normal_color',
            [
                'label' => esc_html__('Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-item .hexa-el-rep-title::after' => 'color: {{VALUE}} !important;',
                    //'{{WRAPPER}} ' . $control_selector . ' svg' => 'fill: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'accordion_toggle_icon_normal_bg',
            [
                'label' => esc_html__('Background Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-item .hexa-el-rep-title::after' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'accordion_toggle_icon_normal_border',
                'selector' => '{{WRAPPER}} .accordion-item .hexa-el-rep-title::after',
            ]
        );
        $this->end_controls_tab();
        // Hover State Tab
        $this->start_controls_tab('accordion_toggle_icon_hover', ['label' => esc_html__('Hover', 'hexacore')]);
        $this->add_control(
            'accordion_toggle_hover_color',
            [
                'label' => esc_html__('Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-item .hexa-el-rep-title:is(:hover, :focus)::after' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .accordion-item .hexa-el-rep-title:is(:hover, :focus):not(.collapsed)::after' => 'color: {{VALUE}} !important;',
                ]
            ]
        );
        $this->add_control(
            'accordion_toggle_icon_hover_bg',
            [
                'label' => esc_html__('Background Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-item .hexa-el-rep-title:is(:hover, :focus)::after' => 'background-color: {{VALUE}} !important;',
                    '{{WRAPPER}} .accordion-item .hexa-el-rep-title:is(:hover, :focus):not(.collapsed)::after' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'accordion_toggle_icon_hover_border',
            [
                'label' => esc_html__('Border Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-item .hexa-el-rep-title:is(:hover, :focus)::after' => 'border-color: {{VALUE}} !important;',
                    '{{WRAPPER}} .accordion-item .hexa-el-rep-title:is(:hover, :focus):not(.collapsed)::after' => 'border-color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
            'accordion_toggle_icon_border_radius',
            [
                'label' => esc_html__('Border Radius', 'elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .accordion-item .hexa-el-rep-title::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'accordion_toggle_icon_width',
            [
                'label' => esc_html__('Width', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 600,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .accordion-item .hexa-el-rep-title::after' => 'width: {{SIZE}}{{UNIT}} !important;',
                ]
            ]
        );
        $this->add_responsive_control(
            'accordion_toggle_icon_height',
            [
                'label' => esc_html__('Height', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 600,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .accordion-item .hexa-el-rep-title::after' => 'height: {{SIZE}}{{UNIT}} !important;',
                ]
            ]
        );
        $this->end_controls_section();
        // wrapper style
        $this->start_controls_section(
            'style_wrapper_box',
            [
                'label' => __('Advance Style', 'hexacore'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'hexa_wrapper_background',
                'label' => esc_html__('Background Color', 'hexacore'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image', 'video'],
                'selector' => '{{WRAPPER}} .accordion-item',
            ]
        );
        $this->add_responsive_control(
            'hexa_wrapper_padding',
            [
                'label' => esc_html__('Padding', 'hexacore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .accordion-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'hexa_wrapper_border',
                'selector' => '{{WRAPPER}} .accordion-item',
            ]
        );
        $this->add_responsive_control(
            'hexa_wrapper_border_radius',
            [
                'label' => esc_html__('Border Radius', 'hexacore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .accordion-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_control(
            'button_heading',
            [
                'label' => esc_html__('Title Active Style', 'hexacore'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'accordion_active_text_color',
            [
                'label' => esc_html__('Text Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-item .hexa-el-rep-title:not(.collapsed)' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'accordion_active_background',
                'label' => esc_html__('Background Color', 'hexacore'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image', 'video'],
                'selector' => '{{WRAPPER}} .accordion-item .hexa-el-rep-title:not(.collapsed)',
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
        extract($settings);
?>


        <?php if ($settings['hexa_design_layout']  == 'layout-2') : ?>

        <?php else : ?>

            <div class="hexa-accordion <?php echo $acc_class; ?>">
                <div class="accordion" id="<?php echo $accid; ?>">
                    <?php foreach ($settings['accordion_list'] as $key => $item) :
                        $key_id = $key + 1;
                        $collapsed = $item['acc_active'] ? '' : 'collapsed';
                        $show = $item['acc_active'] ? 'show' : '';
                    ?>
                        <div class="accordion-item">
                            <<?php echo $title_tag; ?> class="accordion-header" id="<?php echo $accid; ?>-heading-<?php echo $key_id; ?>">
                                <button class="accordion-button hexa-el-rep-title <?php echo esc_attr($collapsed); ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $accid; ?>-collapse-<?php echo $key_id; ?>" aria-expanded="true" aria-controls="<?php echo $accid; ?>-collapse-<?php echo $key_id; ?>">
                                    <?php echo wp_kses_post($item['acc_title']); ?>
                                </button>

                            </<?php echo $title_tag; ?>>
                            <div id="<?php echo $accid; ?>-collapse-<?php echo $key_id; ?>" class="accordion-collapse collapse <?php echo esc_attr($show); ?>" aria-labelledby="<?php echo $accid; ?>-heading-<?php echo $key_id; ?>" data-bs-parent="#<?php echo $accid; ?>">
                                <div class="accordion-body hexa-el-rep-desc"><?php echo wp_kses_post($item['acc_content']); ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

<?php endif;
    }
}

$widgets_manager->register(new Hexa_Faq());
