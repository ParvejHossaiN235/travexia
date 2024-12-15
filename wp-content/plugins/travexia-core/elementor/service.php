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
class Hexa_Service extends Widget_Base
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
        return 'hf-service';
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
        return __('Service', 'hexacore');
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
            'service_content',
            [
                'label' => esc_html__('Service', 'hexacore'),
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
            'title',
            [
                'label' => esc_html__('Title', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'hexacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
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

        $this->add_control(
            'desc',
            [
                'label' => esc_html__('Description', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'hexacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'show_btn',
            [
                'label' => esc_html__('Show Button', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'hexacore'),
                'label_off' => esc_html__('Hide', 'hexacore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'hexa_design_layout' => ['layout_1']
                ]
            ]
        );

        $this->add_control(
            'btn_text',
            [
                'label' => esc_html__('Button Text', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Click Here', 'hexacore'),
                'title' => esc_html__('Enter button text', 'hexacore'),
                'label_block' => true,
                'condition' => [
                    'show_btn' => 'yes',
                    'hexa_design_layout' => ['layout_1']
                ]
            ]
        );

        $this->add_control(
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
                    'hexa_design_layout' => ['layout_1']
                ]
            ]
        );

        $this->add_control(
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
                    'hexa_design_layout' => ['layout_1']
                ]
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

        $migrated = isset($settings['__fa4_migrated']['btn_selected_icon']);
        $is_new = empty($settings['icon']) && \Elementor\Icons_Manager::is_migration_allowed();
?>

        <?php if ($settings['hexa_design_layout']  == 'layout_2') :

            $title = $settings['title'];
            if (!empty($settings['link']['url'])) {
                $this->add_link_attributes('t_link', $settings['link']);
                $title = '<a ' . $this->get_render_attribute_string('t_link') . '>' . $title . '</a>';
            }

        ?>

            <div class="service__wrapper service__item style-three bordered-style text-center">
                <?php if ($settings['icon_type'] == 'icon') : ?>
                    <?php if (!empty($settings['selected_icon']['value'])) : ?>
                        <div class="service__icon-wrap hf-el-rep-icon">
                            <?php \Elementor\Icons_Manager::render_icon($settings['selected_icon'], ['aria-hidden' => 'true']); ?>
                        </div>
                    <?php endif; ?>
                <?php elseif ($settings['icon_type'] == 'image') : ?>
                    <?php if (!empty($settings['icon_image']['url'])) : ?>
                        <div class="service__icon-wrap hf-el-rep-icon">
                            <img src="<?php echo $settings['icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                        </div>
                    <?php endif; ?>
                <?php else : ?>
                    <?php if (!empty($settings['icon_svg'])) : ?>
                        <div class="service__icon-wrap hf-el-rep-icon">
                            <?php echo $settings['icon_svg']; ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <div class="service__content">
                    <h5 class="service__title">
                        <?php echo wp_kses_post($title); ?>
                    </h5>
                    <p><?php $this->print_unescaped_setting('desc') ?></p>
                </div>
            </div>

        <?php else :

            $title = $settings['title'];
            if (!empty($settings['link']['url'])) {
                $this->add_link_attributes('t_link', $settings['link']);
                $title = '<a ' . $this->get_render_attribute_string('t_link') . '>' . $title . '</a>';
            }
            // button content
            if (!empty($settings['btn_link']['url'])) {
                $this->add_link_attributes('button', $settings['btn_link']);
            }
            $this->add_render_attribute('button', 'class', 'circle-btn is-hover hexa-el-btn');

        ?>

            <div class="service__wrapper service__item style-three bordered-style text-center">
                <?php if ($settings['icon_type'] == 'icon') : ?>
                    <?php if (!empty($settings['selected_icon']['value'])) : ?>
                        <div class="service__icon-wrap hf-el-rep-icon">
                            <?php \Elementor\Icons_Manager::render_icon($settings['selected_icon'], ['aria-hidden' => 'true']); ?>
                        </div>
                    <?php endif; ?>
                <?php elseif ($settings['icon_type'] == 'image') : ?>
                    <?php if (!empty($settings['icon_image']['url'])) : ?>
                        <div class="service__icon-wrap hf-el-rep-icon">
                            <img src="<?php echo $settings['icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                        </div>
                    <?php endif; ?>
                <?php else : ?>
                    <?php if (!empty($settings['icon_svg'])) : ?>
                        <div class="service__icon-wrap hf-el-rep-icon">
                            <?php echo $settings['icon_svg']; ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <div class="service__content">
                    <h5 class="service__title">
                        <?php echo wp_kses_post($title); ?>
                    </h5>
                    <p><?php $this->print_unescaped_setting('desc') ?></p>
                    <?php if (!empty($settings['show_btn'])) : ?>
                        <div class="service__more">
                            <a <?php echo $this->get_render_attribute_string('button'); ?>>
                                <?php $this->print_unescaped_setting('btn_text'); ?>
                                <span class="icon__box">
                                    <?php if (!empty($settings['icon']) || !empty($settings['btn_selected_icon']['value'])) : ?>
                                        <?php if ($is_new || $migrated) :
                                            \Elementor\Icons_Manager::render_icon($settings['btn_selected_icon'], ['aria-hidden' => 'true']);
                                        else : ?>
                                            <i class="<?php echo esc_attr($settings['icon']); ?>" aria-hidden="true"></i>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>


<?php endif;
    }
}

$widgets_manager->register(new Hexa_Service());
