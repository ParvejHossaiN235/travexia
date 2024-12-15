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
class Hexa_Skill_Bar extends Widget_Base
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
        return 'hf-skill-bar';
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
        return __('Skill Bar', 'hexacore');
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

    // register_content_controls
    protected function register_content_controls()
    {
        $this->design_layout();
        $this->skill_content_controls();
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
                    //'layout_2' => esc_html__('Layout 2', 'hexacore'),
                ],
                'default' => 'layout_1',
            ]
        );
        $this->end_controls_section();
    }

    // skill_content_controls
    protected function skill_content_controls()
    {
        $this->start_controls_section(
            'section_skill_list',
            [
                'label' => esc_html__('Skill List', 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'number',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => esc_html__('Skill Number', 'hexacore'),
                'default' => esc_html__('70%', 'hexacore'),
                'placeholder' => esc_html__('Type Number here', 'hexacore'),
            ]
        );

        $repeater->add_control(
            'title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => esc_html__('Skill Title', 'hexacore'),
                'default' => esc_html__('Web Design', 'hexacore'),
                'placeholder' => esc_html__('Type your title here', 'hexacore'),
            ]
        );

        // Progress
        $repeater->add_control(
            'single_progress_color',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Progress Color', 'hexacore'),
                'separator' => 'before'
            ]
        );

        $repeater->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'single-progress-color',
                'label' => esc_html__('Progress Color', 'hexacore'),
                'types' => ['classic', 'gradient'],
                'exclude' =>  ['image', 'video'],
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .progress.hexa-progress .progress-bar',
            ]
        );

        // Progress Base
        $repeater->add_control(
            'single_progress_base_color',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Progress Base Color', 'hexacore'),
                'separator' => 'before'
            ]
        );

        $repeater->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'progress-base-color',
                'label' => esc_html__('Progress Base Color', 'hexacore'),
                'types' => ['classic', 'gradient'],
                'exclude' =>  ['image', 'video'],
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .progress.hexa-progress',
            ]
        );

        $this->add_control(
            'skill_list',
            [
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{title}}}',
                'default' => [
                    [
                        'title' => __('Web Design', 'hexacore'),
                    ],
                    [
                        'title' => __('Graphic Design', 'hexacore'),
                    ],
                    [
                        'title' => __('Digital Marketing', 'hexacore'),
                    ],
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

    // register_style_controls
    protected function register_style_controls()
    {
        $this->skill_bars_style_controls();
        $this->skill_content_style_controls();
    }

    // skill_bars_style_controls
    protected function skill_bars_style_controls()
    {
        $this->start_controls_section(
            '_section_style_bars',
            [
                'label' => esc_html__('Skill Bars', 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'height',
            [
                'label' => esc_html__('Height', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 250,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .progress.hexa-progress-bar' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .progress.hexa-progress' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'spacing',
            [
                'label' => esc_html__('Spacing Between', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 250,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hexa-skill-wrapper .hexa-skill-single:not(:first-child)' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => esc_html__('Border Radius', 'hexacore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .progress.hexa-progress, {{WRAPPER}} .progress-bar.hexa-progress-bar ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'progress-bar-background',
                'label' => esc_html__('Background', 'hexacore'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .hexa-skill-wrapper .progress .progress-bar',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'progress-base-background',
                'label' => esc_html__('Background', 'hexacore'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .hexa-skill-wrapper .progress',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .hexa-skill-wrapper .progress'
            ]
        );

        $this->end_controls_section();
    }

    // skill_content_style_controls
    protected function skill_content_style_controls()
    {
        $this->start_controls_section(
            'section_content_style',
            [
                'label' => esc_html__('Content', 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'label_color',
            [
                'label' => esc_html__('Label Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hexa-skill-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'label_typography',
                'selector' => '{{WRAPPER}} .hexa-skill-title',
            ]
        );
        $this->add_control(
            'color',
            [
                'label' => esc_html__('Percent Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hexa-skill-content span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'percent_typography',
                'selector' => '{{WRAPPER}} .hexa-skill-content span',
            ]
        );
        $this->add_responsive_control(
            'label_bottom_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .hexa-skill-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
        extract($settings);
?>

        <?php if ($settings['hexa_design_layout'] === 'layout_2') : ?>


        <?php else : ?>
            <div class="hexa-skill-area">
                <div class="hexa-skill-wrapper">
                    <?php foreach ($settings['skill_list'] as $item) : ?>
                        <div class="hexa-skill-single elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
                            <div class="hexa-skill-content">
                                <?php if (!empty($item['title'])) : ?>
                                    <<?php echo $title_tag; ?> class="hexa-skill-title">
                                        <?php echo wp_kses_post($item['title']); ?>
                                    </<?php echo $title_tag; ?>>
                                <?php endif; ?>

                                <span data-left="<?php echo esc_html($item['number']); ?>"><?php echo wp_kses_post($item['number']); ?></span>

                            </div>
                            <div class="progress hexa-progress">
                                <div class="progress-bar hexa-progress-bar wow slideInLeft" data-wow-duration="0.8s" data-wow-delay="0.5s" role="progressbar" data-width="<?php echo esc_html($item['number']); ?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
<?php endif;
    }
}

$widgets_manager->register(new Hexa_Skill_Bar());
