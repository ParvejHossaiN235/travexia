<?php

namespace HexaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;
use \Elementor\Utils;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Hexa Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Hexa_Portfolio extends Widget_Base
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
        return 'hf-portfolio';
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
        return __('Portfolio', 'hexacore');
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
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout_1' => esc_html__('Layout 1', 'hexacore'),
                    'layout_2' => esc_html__('Layout 2', 'hexacore'),
                ],
                'default' => 'layout_1',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_portfolio',
            [
                'label' => esc_html__('Portfolio Content', 'hexacore'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'pimage',
            [
                'label' => esc_html__('Upload Image', 'hexacore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'pimage_size',
                'exclude' => ['1536x1536', '2048x2048'],
                'include' => [],
                'default' => 'full',
            ]
        );
        $this->add_control(
            'pcat',
            [
                'label'   => esc_html__('Category', 'hexacore'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Brand', 'hexacore'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'ptitle',
            [
                'label'   => esc_html__('Title', 'hexacore'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => esc_html__('Portfolio Title', 'hexacore'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'link',
            [
                'label' => __('Link To Details', 'hexacore'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://', 'hexacore'),
            ]
        );
        $this->add_control(
            'pdesc',
            [
                'label'   => esc_html__('Description', 'hexacore'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => esc_html__('', 'hexacore'),
                'placeholder'     => esc_html__('Type your content description', 'hexacore'),
                'label_block' => true,
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
                    'class' => esc_html__('Class', 'hexacore'),
                ],
            ]
        );
        $this->add_control(
            'icon_class',
            [
                'label' => __('Custom Class', 'hexacore'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('fa-solid fa-globe', 'hexacore'),
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
        $this->end_controls_section();
    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->hexa_section_style_controls('services_section', 'Section Style', '.ele-section');
        $this->hexa_basic_style_controls('section_subtitle', 'Section - Subtitle', '.hf-el-subtitle', ['layout-1', 'layout-2']);
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

        ?>


        <?php else :

            $image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src($settings['pimage']['id'], 'pimage_size', $settings);
            if (empty($image_url)) {
                $image_url = \Elementor\Utils::get_placeholder_image_src();
            }
            $image_html = '<img src="' . esc_attr($image_url) . '" alt="' . esc_attr($ptitle) . '">';

            if (!empty($settings['link']['url'])) {
                $this->add_link_attributes('plink', $settings['link']);
                $ptitle = '<a ' . $this->get_render_attribute_string('plink') . '>' . $ptitle . '</a>';
            }

        ?>

            <div class=" portfolio__item style-two">
                <div class="portfolio__item-thumb">
                    <?php if (!empty($settings['pimage']['url'])) {
                        echo wp_kses_post($image_html);
                    } ?>
                </div>
                <div class="portfolio__item-content">
                    <div class="portfolio__item-info">
                        <?php if (!empty($pcat)) : ?>
                            <div class="portfolio__tag">
                                <a <?php echo $this->get_render_attribute_string('plink'); ?>>
                                    <?php echo wp_kses_post($pcat); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($ptitle)) : ?>
                            <h5 class="portfolio__item-title underline">
                                <?php echo wp_kses_post($ptitle); ?>
                            </h5>
                        <?php endif; ?>
                    </div>
                    <div class="portfolio__item-btn">
                        <a <?php echo $this->get_render_attribute_string('plink'); ?> class="circle-btn is-bg-white">
                            <?php if ($settings['icon_type'] == 'icon') : ?>
                                <?php if (!empty($settings['selected_icon']['value'])) : ?>
                                    <span class="hexa-el-icon hexa-icon icon__box">
                                        <?php \Elementor\Icons_Manager::render_icon($settings['selected_icon'], ['aria-hidden' => 'true']); ?>
                                    </span>
                                <?php endif; ?>
                            <?php else : ?>
                                <?php if (!empty($settings['icon_class'])) : ?>
                                    <span class="hexa-el-icon hexa-icon icon__box">
                                        <i class="<?php echo esc_attr($settings['icon_class']); ?>"></i>
                                    </span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </a>
                    </div>
                </div>
            </div>


<?php endif;
    }
}

$widgets_manager->register(new Hexa_Portfolio());
