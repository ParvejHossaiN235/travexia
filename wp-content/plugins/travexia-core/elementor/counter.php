<?php

namespace HexaCore\Widgets;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;



if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Hexa Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Hexa_Counter extends Widget_Base
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
        return 'hf-counter';
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
        return __('Counter', 'hexacore');
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
            'hexa_counter',
            [
                'label' => esc_html__('Counter', 'hexacore'),
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
            'number',
            [
                'label' => esc_html__('Number', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('17', 'hexacore'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'suffix',
            [
                'label' => esc_html__('Suffix', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('+', 'hexacore'),
                'label_block' => true,
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

        $this->end_controls_section();
    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->hexa_section_style_controls('fact_section', 'Section - Style', '.hf-el-section');
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


        <?php else : ?>

            <div class="counter-item wow fadeIn" data-wow-delay=".3s" data-wow-duration="1s">
                <?php if ($settings['icon_type'] == 'icon') : ?>
                    <?php if (!empty($settings['selected_icon']['value'])) : ?>
                        <div class="counter-icon hf-el-rep-icon">
                            <?php \Elementor\Icons_Manager::render_icon($settings['selected_icon'], ['aria-hidden' => 'true']); ?>
                        </div>
                    <?php endif; ?>
                <?php elseif ($settings['icon_type'] == 'image') : ?>
                    <?php if (!empty($settings['icon_image']['url'])) : ?>
                        <div class="counter-icon hf-el-rep-icon">
                            <img src="<?php echo $settings['icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                        </div>
                    <?php endif; ?>
                <?php else : ?>
                    <?php if (!empty($settings['icon_svg'])) : ?>
                        <div class="counter-icon hf-el-rep-icon">
                            <?php echo $settings['icon_svg']; ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <div class="counter-content">
                    <?php if (!empty($settings['number'])) : ?>
                        <h2 class="counter-title">
                            <span class="counter"><?php echo hexa_kses($settings['number']); ?></span>
                            <?php echo hexa_kses($settings['suffix']); ?>
                        </h2>
                    <?php endif; ?>
                    <?php if (!empty($settings['title'])) : ?>
                        <h5> <?php echo hexa_kses($settings['title']); ?></h5>
                    <?php endif; ?>
                    <?php if (!empty($settings['desc'])) : ?>
                        <p> <?php echo hexa_kses($settings['desc']); ?></p>
                    <?php endif; ?>
                </div>
            </div>

<?php endif;
    }
}

$widgets_manager->register(new Hexa_Counter());
