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
class Hexa_Portfolio_Slider extends Widget_Base
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
        return 'hf-portfolio-slider';
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
        return __('Portfolio Slider', 'hexacore');
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
                ],
                'default' => 'layout_1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'portfolio_section_slide',
            [
                'label' => esc_html__('Portfolio Slider', 'hexacore'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'pimage',
            [
                'label' => esc_html__('Upload Image', 'hexacore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ]
            ]
        );
        $repeater->add_control(
            'pcat',
            [
                'label'   => esc_html__('Category', 'hexacore'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Brand', 'hexacore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'ptitle',
            [
                'label'   => esc_html__('Title', 'hexacore'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => esc_html__('Portfolio Title', 'hexacore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'link',
            [
                'label' => __('Link To Details', 'hexacore'),
                'type' => \Elementor\Controls_Manager::URL,

                'placeholder' => __('https://', 'hexacore'),
            ]
        );
        $repeater->add_control(
            'pdesc',
            [
                'label'   => esc_html__('Description', 'hexacore'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => esc_html__('', 'hexacore'),
                'placeholder'     => esc_html__('Type your content description', 'hexacore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
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
        $repeater->add_control(
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

        $this->add_control(
            'portfolio_list',
            [
                'label'       => esc_html__('Portfolio List', 'hexacore'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'ptitle' => esc_html__('Business Stratagy', 'hexacore'),
                    ],
                    [
                        'ptitle' => esc_html__('Website Development', 'hexacore')
                    ],
                    [
                        'ptitle' => esc_html__('Marketing & Reporting', 'hexacore')
                    ],
                ],
                'title_field' => '{{{ ptitle }}}',
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
        $this->end_controls_section();
    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->hexa_section_style_controls('portfolio_section', 'Section Style', '.ele-section');
        $this->hexa_basic_style_controls('section_subtitle', 'Section - Subtitle', '.hf-el-subtitle');
        $this->hexa_basic_style_controls('section_title', 'Section - Title', '.hf-el-title');
        $this->hexa_basic_style_controls('section_desc', 'Section - Description', '.hf-el-content');

        # repeater 
        $this->hexa_basic_style_controls('rep_subtitle_style', 'Repeater Subtitle', '.hf-el-rep-subtitle');
        $this->hexa_basic_style_controls('rep_title_style', 'Repeater Title', '.hf-el-rep-title');
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

        <?php if ($settings['hexa_design_layout']  == 'layout_2') :
            $this->add_render_attribute('title_args', 'class', 'hf-section__title ele-heading');
        ?>

        <?php else : ?>

            <div class="portfolio__wrapper style-six wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                <div class="swiper portfolio__active">
                    <div class="swiper-wrapper">
                        <?php
                        foreach ($settings['portfolio_list'] as $key => $item) :
                            $image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src($item['pimage']['id'], 'pimage_size', $settings);
                            if (empty($image_url)) {
                                $image_url = \Elementor\Utils::get_placeholder_image_src();
                            }
                            $image_html = '<img src="' . esc_attr($image_url) . '" alt="' . esc_attr($item['ptitle']) . '">';
                            $ptitle = $item['ptitle'];

                            if (!empty($item['link']['url'])) {
                                $this->add_link_attributes('plink' . $key, $item['link']);
                                $ptitle = '<a ' . $this->get_render_attribute_string('plink' . $key) . '>' . $ptitle . '</a>';
                            }
                        ?>
                            <div class="swiper-slide">
                                <div class=" portfolio__item style-six">
                                    <div class="portfolio__item-thumb" data-background="<?php echo esc_url($image_url); ?>">
                                        <div class="portfolio__item-btn">
                                            <a href="<?php echo $this->get_render_attribute_string('plink' . $key); ?>" class="circle-btn is-bg-white is-btn-large">
                                                <?php if ($item['icon_type'] == 'icon') : ?>
                                                    <?php if (!empty($item['selected_icon']['value'])) : ?>
                                                        <span class="hexa-el-icon hexa-icon icon__box">
                                                            <?php \Elementor\Icons_Manager::render_icon($item['selected_icon'], ['aria-hidden' => 'true']); ?>
                                                        </span>
                                                    <?php endif; ?>
                                                <?php else : ?>
                                                    <?php if (!empty($item['icon_class'])) : ?>
                                                        <span class="hexa-el-icon hexa-icon icon__box">
                                                            <i class="<?php echo esc_attr($item['icon_class']); ?>"></i>
                                                        </span>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="portfolio__item-content">
                                        <div class="portfolio__item-info">
                                            <?php if (!empty($item['pcat'])) : ?>
                                                <div class="portfolio__tag">
                                                    <a <?php echo $this->get_render_attribute_string('plink' . $key); ?>>
                                                        <?php echo wp_kses_post($item['pcat']); ?>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($item['ptitle'])) : ?>
                                                <h5 class="portfolio__item-title underline">
                                                    <?php echo wp_kses_post($ptitle); ?>
                                                </h5>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- If we need navigation buttons -->
                    <div class="portfolio__navigation d-none d-sm-block">
                        <button class="portfolio__button-prev circle-btn is-bg-white slider__nav-btn is-hover-blue"><i class="fa-regular fa-arrow-left-long"></i></button>
                        <button class="portfolio__button-next circle-btn is-bg-white slider__nav-btn is-hover-blue"><i class="fa-regular fa-arrow-right-long"></i></button>
                    </div>
                </div>
            </div>
<?php endif;
    }
}

$widgets_manager->register(new Hexa_Portfolio_Slider());
