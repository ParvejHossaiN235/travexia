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
class Hexa_Counter_List extends Widget_Base
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
        return 'hf-counter-list';
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
        return __('Counter List', 'hexacore');
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
            'counter_list_content',
            [
                'label' => esc_html__('Counter List', 'hexacore'),
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
            'number',
            [
                'label' => esc_html__('Number', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('17', 'hexacore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'suffix',
            [
                'label' => esc_html__('Suffix', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('+', 'hexacore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Food', 'hexacore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'desc',
            [
                'label' => esc_html__('Description', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Food', 'hexacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'counter_list',
            [
                'label' => esc_html__('Counter - List', 'hexacore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'number' => esc_html__('600', 'hexacore'),
                        'title' => esc_html__('Business', 'hexacore'),
                    ],
                    [
                        'number' => esc_html__('700', 'hexacore'),
                        'title' => esc_html__('Website', 'hexacore')
                    ],
                    [
                        'number' => esc_html__('800', 'hexacore'),
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

?>

        <?php if ($settings['hexa_design_layout']  == 'layout_2') : ?>


            <div class="container hf-el-section">
                <div class="row">

                    <?php foreach ($settings['counter_list'] as $key => $item) :
                        $key += 1;

                        $count = count($settings['counter_list']);

                        $lastClass = $key == $count ? 'justify-content-end' : NULL;
                    ?>
                        <div class="col-xl-<?php echo esc_attr($settings['hexa_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['hexa_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['hexa_col_for_tablet']); ?> col-<?php echo esc_attr($settings['hexa_col_for_mobile']); ?>">
                            <div class="funfact d-flex align-items-start mb-30 <?php echo esc_attr($lastClass); ?>">
                                <?php if ($item['icon_type'] == 'icon') : ?>
                                    <?php if (!empty($item['selected_icon']['value'])) : ?>
                                        <div class="funfact-icon hf-el-rep-icon">
                                            <?php hexa_render_icon($item, 'hexa_box_icon', 'selected_icon'); ?>
                                        </div>
                                    <?php endif; ?>
                                <?php elseif ($item['icon_type'] == 'image') : ?>
                                    <?php if (!empty($item['icon_image']['url'])) : ?>
                                        <div class="funfact-icon hf-el-rep-icon">
                                            <img src="<?php echo $item['icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                        </div>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <?php if (!empty($item['icon_svg'])) : ?>
                                        <div class="funfact-icon hf-el-rep-icon">
                                            <?php echo $item['icon_svg']; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <div class="funfact-content">
                                    <h3 class="funfact-count hf-el-rep-num">
                                        <span data-purecounter-duration="1" data-purecounter-end="<?php echo esc_attr($item['number']); ?>" class="purecounter"></span>
                                    </h3>
                                    <?php if (!empty($item['title'])) : ?>
                                        <p class="hf-el-rep-title"><?php echo hexa_kses($item['title']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>

        <?php else : ?>

            <div class="counter-container">
                <div class="row g-5">
                    <?php foreach ($settings['counter_list'] as $key => $item) :
                        $key += 1;
                        $count = count($settings['counter_list']);
                        $lastClass = $key == $count ? 'justify-content-end' : NULL;
                    ?>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                            <div class="counter-item wow fadeIn" data-wow-delay=".3s" data-wow-duration="1s">
                                <?php if ($item['icon_type'] == 'icon') : ?>
                                    <?php if (!empty($item['selected_icon']['value'])) : ?>
                                        <div class="counter-iconhf-el-rep-icon">
                                            <?php \Elementor\Icons_Manager::render_icon($item['selected_icon'], ['aria-hidden' => 'true']); ?>
                                        </div>
                                    <?php endif; ?>
                                <?php elseif ($item['icon_type'] == 'image') : ?>
                                    <?php if (!empty($item['icon_image']['url'])) : ?>
                                        <div class="counter-icon hf-el-rep-icon">
                                            <img src="<?php echo $item['icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                        </div>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <?php if (!empty($item['icon_svg'])) : ?>
                                        <div class="counter-icon hf-el-rep-icon">
                                            <?php echo $item['icon_svg']; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <div class="counter-content">
                                    <?php if (!empty($item['number'])) : ?>
                                        <h2 class="counter-title">
                                            <span class="counter"><?php echo hexa_kses($item['number']); ?></span>
                                            <?php echo hexa_kses($item['suffix']); ?>
                                        </h2>
                                    <?php endif; ?>
                                    <?php if (!empty($item['title'])) : ?>
                                        <h5> <?php echo hexa_kses($item['title']); ?></h5>
                                    <?php endif; ?>
                                    <?php if (!empty($item['desc'])) : ?>
                                        <p> <?php echo hexa_kses($item['desc']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

<?php endif;
    }
}

$widgets_manager->register(new Hexa_Counter_List());
