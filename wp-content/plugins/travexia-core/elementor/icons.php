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
class Hexa_Icons extends Widget_Base
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
        return 'hf-icons';
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
        return __('Icon', 'hexacore');
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
                ],
                'default' => 'layout_1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_icon_content',
            [
                'label' => esc_html__('Icon', 'hexacore'),
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
                    'icon' => esc_html__('Icon', 'hexacore'),
                    'image' => esc_html__('Image', 'hexacore'),
                    'svg' => esc_html__('SVG', 'hexacore'),
                    'class' => esc_html__('Class', 'hexacore'),
                ],
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
            'icon_class',
            [
                'label' => __('Custom Class', 'hexacore'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('flaticon-world-globe', 'hexacore'),
                'condition' => [
                    'icon_type' => 'class',
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
            'link',
            [
                'label' => __('Link', 'hexacore'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'hexacore'),
                'default'    => [],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
    }

    protected function style_tab_content()
    {

        $this->hexa_icon_style_controls('icon_icon', 'Icon - Style', '.hexa-el-icon');
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

        <?php else :


            $icon_tag = 'div';
            if (!empty($settings['link']['url'])) {
                $this->add_link_attributes('link', $settings['link']);
                $icon_tag = 'a';
            }

        ?>


            <div class="hexa-icon-wrapper">
                <<?php \Elementor\Utils::print_unescaped_internal_string($icon_tag . ' ' . $this->get_render_attribute_string('link')); ?>>
                    <?php if ($settings['icon_type'] == 'icon') : ?>
                        <?php if (!empty($settings['selected_icon']['value'])) : ?>
                            <span class="hexa-el-icon hexa-icon">
                                <?php \Elementor\Icons_Manager::render_icon($settings['selected_icon'], ['aria-hidden' => 'true']); ?>
                            </span>
                        <?php endif; ?>
                    <?php elseif ($settings['icon_type'] == 'class') : ?>
                        <?php if (!empty($settings['icon_class'])) : ?>
                            <span class="hexa-el-icon hexa-icon">
                                <i class="<?php echo esc_attr($settings['icon_class']); ?>"></i>
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
                            <span class="hexa-el-icon hexa-icon">
                                <?php echo $settings['icon_svg']; ?>
                            </span>
                        <?php endif; ?>
                    <?php endif; ?>
                </<?php \Elementor\Utils::print_unescaped_internal_string($icon_tag); ?>>
            </div>

<?php endif;
    }
}

$widgets_manager->register(new Hexa_Icons());
