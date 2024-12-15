<?php

namespace HexaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Hexa Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Hexa_Process extends Widget_Base
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
        return 'process';
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
        return __('Process', 'hexacore');
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
                    'layout-1' => esc_html__('Layout 1', 'hexacore'),
                    'layout-2' => esc_html__('Layout 2', 'hexacore'),
                    'layout-3' => esc_html__('Layout 3', 'hexacore'),
                    'layout-4' => esc_html__('Layout 4', 'hexacore'),
                    'layout-5' => esc_html__('Layout 5', 'hexacore'),
                    'layout-6' => esc_html__('Layout 6', 'hexacore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();


        // hexa_section_title
        $this->hexa_section_title_render_controls('process', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.', ['layout-1', 'layout-2', 'layout-3']);

        // Process group
        $this->start_controls_section(
            'hexa_process',
            [
                'label' => esc_html__('Process List', 'hexacore'),
                'description' => esc_html__('Control all the style settings from Style tab', 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __('Field condition', 'hexacore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'hexacore'),
                    'style_2' => __('Style 2', 'hexacore'),
                    'style_3' => __('Style 3', 'hexacore'),
                    'style_4' => __('Style 4', 'hexacore'),
                    'style_5' => __('Style 5', 'hexacore'),
                    'style_6' => __('Style 6', 'hexacore'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'hexa_box_icon_type',
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
                    'repeater_condition' => ['style_3', 'style_4', 'style_5', 'style_6']
                ]
            ]
        );

        $repeater->add_control(
            'hexa_box_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'hexacore'),
                'condition' => [
                    'hexa_box_icon_type' => 'svg',
                    'repeater_condition' => ['style_3', 'style_4', 'style_5', 'style_6']
                ]
            ]
        );

        $repeater->add_control(
            'hexa_box_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'hexacore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'hexa_box_icon_type' => 'image',
                    'repeater_condition' => ['style_3', 'style_4', 'style_5', 'style_6']
                ]
            ]
        );

        if (hexa_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'hexa_box_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'hexa_box_icon_type' => 'icon',
                        'repeater_condition' => ['style_3', 'style_4', 'style_5', 'style_6']
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'hexa_box_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'hexa_box_icon_type' => 'icon',
                        'repeater_condition' => ['style_3', 'style_4', 'style_5', 'style_6']
                    ]
                ]
            );
        }

        $repeater->add_control(
            'hexa_process_word',
            [
                'label' => esc_html__('Single Word', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('1', 'hexacore'),
                'condition' => [
                    'repeater_condition' => 'style_1'
                ]
            ]
        );

        $repeater->add_control(
            'hexa_process_subtitle',
            [
                'label' => esc_html__('Sub Title', 'hexacore'),
                'description' => hexa_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Sub Title', 'hexacore'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_2', 'style_3']
                ]
            ]
        );

        $repeater->add_control(
            'hexa_process_title',
            [
                'label' => esc_html__('Title', 'hexacore'),
                'description' => hexa_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Process Title', 'hexacore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'hexa_process_add1',
            [
                'label' => esc_html__('Additional Info 1', 'hexacore'),
                'description' => hexa_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Info One', 'hexacore'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => 'style_2'
                ]
            ]
        );

        $repeater->add_control(
            'hexa_process_add2',
            [
                'label' => esc_html__('Additional Info 2', 'hexacore'),
                'description' => hexa_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Info Two', 'hexacore'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => 'style_2'
                ]
            ]
        );

        $repeater->add_control(
            'hexa_process_des',
            [
                'label' => esc_html__('Description', 'hexacore'),
                'description' => hexa_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('This SEO is most reputed firm', 'hexacore'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_4', 'style_5', 'style_6']
                ]
            ]
        );

        $this->add_control(
            'hexa_process_list',
            [
                'label' => esc_html__('Processs - List', 'hexacore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'hexa_process_title' => esc_html__('Discover', 'hexacore'),
                    ],
                    [
                        'hexa_process_title' => esc_html__('Define', 'hexacore')
                    ],
                    [
                        'hexa_process_title' => esc_html__('Develop', 'hexacore')
                    ],
                ],
                'title_field' => '{{{ hexa_process_title }}}',
            ]
        );

        $this->end_controls_section();

        // shape
        $this->start_controls_section(
            'hexa_shape',
            [
                'label' => esc_html__('Shape Section', 'hexacore'),
                'condition' => [
                    'hexa_design_layout' => ['layout-1', 'layout-2', 'layout-3']
                ]
            ]
        );

        $this->add_control(
            'hexa_shape_switch',
            [
                'label'        => esc_html__('Shape On/Off', 'hexacore'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'hexacore'),
                'label_off'    => esc_html__('Hide', 'hexacore'),
                'return_value' => 'yes',
                'default'      => '0',
            ]
        );

        $this->add_control(
            'hexa_shape_image_1',
            [
                'label' => esc_html__('Choose Shape Image 1', 'hexacore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'hexa_shape_switch' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'hexa_shape_image_2',
            [
                'label' => esc_html__('Choose Shape Image 2', 'hexacore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'hexa_shape_switch' => 'yes',
                    'hexa_design_layout' => ['layout-2', 'layout-3']
                ]
            ]
        );

        $this->add_control(
            'hexa_shape_image_3',
            [
                'label' => esc_html__('Choose Shape Image 3', 'hexacore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'hexa_shape_switch' => 'yes',
                    'hexa_design_layout' => 'layout-2'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'shape_image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                'condition' => [
                    'hexa_shape_switch' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        // section column
        $this->hexa_columns('col', 'layout-5');
    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->hexa_section_style_controls('process_section', 'Section - Style', '.hf-el-section');
        $this->hexa_basic_style_controls('section_subtitle', 'Section - Subtitle', '.hf-el-subtitle', ['layout-1', 'layout-2', 'layout-3']);
        $this->hexa_basic_style_controls('section_title', 'Section - Title', '.hf-el-title', ['layout-1', 'layout-2', 'layout-3']);
        $this->hexa_basic_style_controls('section_desc', 'Section - Description', '.hf-el-content', ['layout-1', 'layout-2', 'layout-3']);

        # repeater 
        $this->hexa_icon_style('rep_icon_style', 'Repeater Icon/Image/SVG', '.hf-el-rep-icon', ['layout-3', 'layout-4', 'layout-5', 'layout-6']);
        $this->hexa_link_controls_style('rep_num_style', 'Repeater Number', '.hf-el-rep-num', 'layout-1');
        $this->hexa_basic_style_controls('rep_subtitle_style', 'Repeater Subtitle', '.hf-el-rep-subtitle', ['layout-2', 'layout-3']);
        $this->hexa_basic_style_controls('rep_title_style', 'Repeater Title', '.hf-el-rep-title', ['layout-1', 'layout-2', 'layout-3', 'layout-4', 'layout-5', 'layout-6']);
        $this->hexa_basic_style_controls('rep_des_style', 'Repeater Description', '.hf-el-rep-des', ['layout-4', 'layout-5', 'layout-6']);
        $this->hexa_basic_style_controls('rep_addi_style', 'Repeater Additional Info', '.hf-el-rep-addi', 'layout-2');
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

        <?php if ($settings['hexa_design_layout']  == 'layout-2') :
            // shape image
            if (!empty($settings['hexa_shape_image_1']['url'])) {
                $hexa_shape_image = !empty($settings['hexa_shape_image_1']['id']) ? wp_get_attachment_image_url($settings['hexa_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['hexa_shape_image_1']['url'];
                $hexa_shape_image_alt = get_post_meta($settings["hexa_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
            }
            if (!empty($settings['hexa_shape_image_2']['url'])) {
                $hexa_shape_image2 = !empty($settings['hexa_shape_image_2']['id']) ? wp_get_attachment_image_url($settings['hexa_shape_image_2']['id'], $settings['shape_image_size_size']) : $settings['hexa_shape_image_2']['url'];
                $hexa_shape_image_alt2 = get_post_meta($settings["hexa_shape_image_2"]["id"], "_wp_attachment_image_alt", true);
            }
            if (!empty($settings['hexa_shape_image_3']['url'])) {
                $hexa_shape_image3 = !empty($settings['hexa_shape_image_3']['id']) ? wp_get_attachment_image_url($settings['hexa_shape_image_3']['id'], $settings['shape_image_size_size']) : $settings['hexa_shape_image_3']['url'];
                $hexa_shape_image_alt3 = get_post_meta($settings["hexa_shape_image_3"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->add_render_attribute('title_args', 'class', 'hfsection-title tpsection-title-white mb-15 hf-el-title');
        ?>

            <section class="funfact-area pb-80">
                <div class="container">
                    <div class="hffunfact p-relative">
                        <?php if (!empty($hexa_shape_image)) : ?>
                            <div class="hffunfact-bg theme-bg-2" style="background-image: url(<?php echo esc_url($hexa_shape_image); ?>);">
                            <?php else : ?>
                                <div class="hffunfact-bg theme-bg-2 hf-el-section">
                                <?php endif; ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="hfsection__content feature-white-section text-center">
                                            <?php if (!empty($settings['hexa_process_sub_title'])) : ?>
                                                <div class="hfbanner__sub-title mb-15">
                                                    <span class="hf-el-subtitle"><?php echo hexa_kses($settings['hexa_process_sub_title']); ?></span>
                                                    <i>
                                                        <svg width="150" height="36" viewBox="0 0 150 36" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <rect x="0.00012207" width="150" height="36" fill="url(#pattern5)" fill-opacity="0.1" />
                                                            <defs>
                                                                <pattern id="pattern5" patternContentUnits="objectBoundingBox" width="1" height="1">
                                                                    <use xlink:href="#image0_853_2637" transform="translate(-0.0507936) scale(0.00603175 0.0205405)" />
                                                                </pattern>
                                                                <image id="image0_853_2637" width="180" height="50" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAALQAAAAyCAYAAAD1JPH3AAAAAXNSR0IArs4c6QAAA8JJREFUeF7tnVFO41AMRa9TkIoEIqyA7GA6O2ALs9JZynR2UFZAEB9TCYhHfokhlSrkTqdpXd38pG2cxjk+eXnJjwWJlqcnrTFHfQE0CjSWuthacCuKWgU1FDUEtX33U/v4/atzFbSiaC1EBS2Gzxh+V+CxbANWAqzs8xuwuruS8pnLaRCQ00gDcFlnHRaVoNEK90VSoDFpXeBTyXechwluopv8MOE7PHaKlVRo39ZY3t1JuVC4HJ7ApEKbtJeXaLoZFiapAPcqWLi4hz/dIx1hEN1kd+FVsJR3tNfXsjxSVmd52IMIvSGu4BtMXsXilEfZo1a3n+Isywiv+O3TGk5pdq/K3kI//dFmBjwIxd2dfnAPn9IM60eb6/sI//qKFac0nyDDQvuoiwoPNr8F8GAjb3kI43J0AuN5fBEeKOL7XN6mN68ztOf+EBsS+mWtv6BYHL1qTOC/EfA3NeVh1hZ/m9NPe579QB/b7YcOrT3obkvCL5ivErx8R62z7QOgdqhRbW4rb7B8Gd5k2Vd7a3Uzlx9b84gQevmjGoljDAlMReDmSrYOxrERmkJPVSceJ0iAQgdBMSwHAQqdo07MMkiAQgdBMSwHAQqdo07MMkiAQgdBMSwHAQqdo07MMkiAQgdBMSwHAQqdo07MMkiAQgdBMSwHAQqdo07MMkiAQgdBMSwHAQqdo07MMkiAQgdBMSwHAQqdo07MMkiAQgdBMSwHAQqdo07MMkiAQgdBMSwHAQqdo07MMkiAQgdBMSwHAQqdo07MMkiAQgdBMSwHAQqdo07MMkiAQgdBMSwHAQqdo07MMkiAQgdBMSwHAQqdo07MMkiAQgdBMSwHAQqdo07MMkiAQgdBMSwHAQqdo07MMkiAQgdBMSwHAQqdo07MMkiAQgdBMSwHAQqdo07MMkiAQgdBMSwHgZxCj/pvO+aNPtx7st/ostT38f7surTnf3P3wxKYTOiNdmHjhvCj5u9+quMm8B+nv0Z7Co0kraGo5TRuReatx/xCGFo716VXo6A++xbPh3V0p3/fT+i1/izNHK1/nZSmjqW3nQlp7Xvt87k3dNyFtjUpxRz1BdBsXAQmvjUtVdR2UfCOsAvVIXbom34zl+/b9g61dfuHw3KXIAHv0GsNKU3wSvu1CG6L8FKaUZ59x97xnb10xVU827qzu/wwcEYGTQodFO8Uwmwa5FMgG/krQWNdVcuI7xdAf+vspz/DtslyH08x+460RUY7/lR3dwo9WbWPeyB/JrAsbCq0TzY+zfT/iIyc+xxvl33/AiWjt0Jf7u62AAAAAElFTkSuQmCC" />
                                                            </defs>
                                                        </svg>
                                                    </i>
                                                </div>
                                            <?php endif; ?>
                                            <?php
                                            if (!empty($settings['hexa_process_title'])) :
                                                printf(
                                                    '<%1$s %2$s>%3$s</%1$s>',
                                                    tag_escape($settings['hexa_process_title_tag']),
                                                    $this->get_render_attribute_string('title_args'),
                                                    hexa_kses($settings['hexa_process_title'])
                                                );
                                            endif;
                                            ?>
                                            <?php if (!empty($settings['hexa_process_description'])) : ?>
                                                <p class="text-white hf-el-content"><?php echo hexa_kses($settings['hexa_process_description']); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="hffunfact-shape d-none d-md-block">
                                    <?php if (!empty($hexa_shape_image2)) : ?>
                                        <div class="hffunfact-shape-one"><img src="<?php echo esc_url($hexa_shape_image2); ?>" alt="<?php echo esc_attr($hexa_shape_image_alt2); ?>"></div>
                                    <?php endif; ?>
                                    <?php if (!empty($hexa_shape_image3)) : ?>
                                        <div class="hffunfact-shape-two"><img src="<?php echo esc_url($hexa_shape_image3); ?>" alt="<?php echo esc_attr($hexa_shape_image_alt3); ?>"></div>
                                    <?php endif; ?>
                                </div>
                                </div>
                                <div class="hffunfact-box">
                                    <div class="row justify-content-center">

                                        <?php foreach ($settings['hexa_process_list'] as $key => $item) :
                                            $key = $key + 1;
                                            $keyCount = count($settings['hexa_process_list']);
                                        ?>
                                            <div class="col-lg-5">
                                                <div class="hffunfact-wrapper text-center mb-50">
                                                    <?php if (!empty($item['hexa_process_subtitle'])) : ?>
                                                        <span class="hffunfact-title hf-el-rep-subtitle"><?php echo hexa_kses($item['hexa_process_subtitle']); ?></span>
                                                    <?php endif; ?>
                                                    <?php if (!empty($item['hexa_process_title'])) : ?>
                                                        <h5 class="hffunfact-count mb-15 hf-el-rep-title"><?php echo hexa_kses($item['hexa_process_title']); ?></h5>
                                                    <?php endif; ?>
                                                    <div class="hffunfact-tag">
                                                        <?php if (!empty($item['hexa_process_add1'])) : ?>
                                                            <span class="hf-el-rep-addi"><?php echo hexa_kses($item['hexa_process_add1']); ?></span>
                                                        <?php endif; ?>
                                                        <?php if (!empty($item['hexa_process_add2'])) : ?>
                                                            <span class="hf-el-rep-addi"><?php echo hexa_kses($item['hexa_process_add2']); ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                    </div>
                                </div>
                            </div>
                    </div>
            </section>

        <?php elseif ($settings['hexa_design_layout']  == 'layout-3') :
            // shape image
            if (!empty($settings['hexa_shape_image_1']['url'])) {
                $hexa_shape_image = !empty($settings['hexa_shape_image_1']['id']) ? wp_get_attachment_image_url($settings['hexa_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['hexa_shape_image_1']['url'];
                $hexa_shape_image_alt = get_post_meta($settings["hexa_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
            }
            if (!empty($settings['hexa_shape_image_2']['url'])) {
                $hexa_shape_image2 = !empty($settings['hexa_shape_image_2']['id']) ? wp_get_attachment_image_url($settings['hexa_shape_image_2']['id'], $settings['shape_image_size_size']) : $settings['hexa_shape_image_2']['url'];
                $hexa_shape_image_alt2 = get_post_meta($settings["hexa_shape_image_2"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->add_render_attribute('title_args', 'class', 'hfsection-title-two hf-el-title');

        ?>

            <section class="services-area hf-large-box services-bg-two p-relative fix hf-el-section">
                <div class="services-shape d-none d-xl-block">
                    <?php if (!empty($hexa_shape_image)) : ?>
                        <div class="services-shape-one">
                            <img src="<?php echo esc_url($hexa_shape_image); ?>" alt="<?php echo esc_attr($hexa_shape_image_alt); ?>">
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($hexa_shape_image2)) : ?>
                        <div class="services-shape-two">
                            <img src="<?php echo esc_url($hexa_shape_image2); ?>" alt="<?php echo esc_attr($hexa_shape_image_alt2); ?>">
                        </div>
                    <?php endif; ?>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="hfsection-wrapper text-center mb-60">
                                    <?php if (!empty($settings['hexa_process_sub_title'])) : ?>
                                        <p class="hf-el-subtitle"><?php echo hexa_kses($settings['hexa_process_sub_title']); ?></p>
                                    <?php endif; ?>
                                    <?php
                                    if (!empty($settings['hexa_process_title'])) :
                                        printf(
                                            '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['hexa_process_title_tag']),
                                            $this->get_render_attribute_string('title_args'),
                                            hexa_kses($settings['hexa_process_title'])
                                        );
                                    endif;
                                    ?>
                                    <?php if (!empty($settings['hexa_process_description'])) : ?>
                                        <p class="hf-el-content"><?php echo hexa_kses($settings['hexa_process_description']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <?php foreach ($settings['hexa_process_list'] as $key => $item) : ?>
                            <div class="col-lg-6">
                                <div class="services-two mb-30">
                                    <div class="services-two-bg"></div>
                                    <?php if ($item['hexa_box_icon_type'] == 'icon') : ?>
                                        <?php if (!empty($item['hexa_box_icon']) || !empty($item['hexa_box_selected_icon']['value'])) : ?>
                                            <div class="services-two-icon hf-el-rep-icon">
                                                <?php hexa_render_icon($item, 'hexa_box_icon', 'hexa_box_selected_icon'); ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php elseif ($item['hexa_box_icon_type'] == 'image') : ?>
                                        <?php if (!empty($item['hexa_box_icon_image']['url'])) : ?>
                                            <div class="services-two-icon hf-el-rep-icon">
                                                <img src="<?php echo $item['hexa_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['hexa_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                            </div>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <?php if (!empty($item['hexa_box_icon_svg'])) : ?>
                                            <div class="services-two-icon hf-el-rep-icon">
                                                <?php echo $item['hexa_box_icon_svg']; ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="services-two-content">
                                        <?php if (!empty($item['hexa_process_subtitle'])) : ?>
                                            <span class="hf-el-rep-subtitle"><?php echo hexa_kses($item['hexa_process_subtitle']); ?></span>
                                        <?php endif; ?>
                                        <?php if (!empty($item['hexa_process_title'])) : ?>
                                            <h4 class="services-two-title hf-el-rep-title"><?php echo hexa_kses($item['hexa_process_title']); ?></h4>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </section>

        <?php elseif ($settings['hexa_design_layout']  == 'layout-4') : ?>

            <section class="award-area pb-80 hf-el-section">
                <div class="container">
                    <div class="row">

                        <?php foreach ($settings['hexa_process_list'] as $key => $item) :
                            $key = $key + 1;
                            $keyCount = count($settings['hexa_process_list']);
                        ?>
                            <div class="col-lg-4 col-md-6">
                                <div class="hfaward text-center mb-30 <?php echo $key % 2 == 0 ? 'hfaward-border' : NULL; ?>">

                                    <?php if ($item['hexa_box_icon_type'] == 'icon') : ?>
                                        <?php if (!empty($item['hexa_box_icon']) || !empty($item['hexa_box_selected_icon']['value'])) : ?>
                                            <div class="hfaward-icon mb-15 hf-el-rep-icon">
                                                <?php hexa_render_icon($item, 'hexa_box_icon', 'hexa_box_selected_icon'); ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php elseif ($item['hexa_box_icon_type'] == 'image') : ?>
                                        <?php if (!empty($item['hexa_box_icon_image']['url'])) : ?>
                                            <div class="hfaward-icon mb-15 hf-el-rep-icon">
                                                <img src="<?php echo $item['hexa_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['hexa_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                            </div>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <?php if (!empty($item['hexa_box_icon_svg'])) : ?>
                                            <div class="hfaward-icon mb-15 hf-el-rep-icon">
                                                <?php echo $item['hexa_box_icon_svg']; ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <div class="hfaward-content">
                                        <?php if (!empty($item['hexa_process_title'])) : ?>
                                            <h4 class="title mb-5 hf-el-rep-title"><?php echo hexa_kses($item['hexa_process_title']); ?></h4>
                                        <?php endif; ?>
                                        <?php if (!empty($item['hexa_process_des'])) : ?>
                                            <p class="hf-el-rep-des"><?php echo hexa_kses($item['hexa_process_des']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </section>

        <?php elseif ($settings['hexa_design_layout']  == 'layout-5') : ?>

            <section class="process-5 hf-el-section">
                <div class="container">
                    <div class="row">

                        <?php foreach ($settings['hexa_process_list'] as $key => $item) :
                            $key = $key + 1;
                            $keyCount = count($settings['hexa_process_list']);
                        ?>
                            <div class="col-xl-<?php echo esc_attr($settings['hexa_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['hexa_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['hexa_col_for_tablet']); ?> col-<?php echo esc_attr($settings['hexa_col_for_mobile']); ?>">
                                <div class="services-important-item mb-30">
                                    <div class="services-important-icon">
                                        <?php if ($item['hexa_box_icon_type'] == 'icon') : ?>
                                            <?php if (!empty($item['hexa_box_icon']) || !empty($item['hexa_box_selected_icon']['value'])) : ?>
                                                <span class="hf-el-rep-icon">
                                                    <?php hexa_render_icon($item, 'hexa_box_icon', 'hexa_box_selected_icon'); ?>
                                                </span>
                                            <?php endif; ?>
                                        <?php elseif ($item['hexa_box_icon_type'] == 'image') : ?>
                                            <?php if (!empty($item['hexa_box_icon_image']['url'])) : ?>
                                                <span class="hf-el-rep-icon">
                                                    <img src="<?php echo $item['hexa_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['hexa_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                </span>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <?php if (!empty($item['hexa_box_icon_svg'])) : ?>
                                                <span class="hf-el-rep-icon">
                                                    <?php echo $item['hexa_box_icon_svg']; ?>
                                                </span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="services-important-content">
                                        <?php if (!empty($item['hexa_process_title'])) : ?>
                                            <h4 class="services-important-title hf-el-rep-title"><?php echo hexa_kses($item['hexa_process_title']); ?></h4>
                                        <?php endif; ?>
                                        <?php if (!empty($item['hexa_process_des'])) : ?>
                                            <p class="hf-el-rep-des"><?php echo hexa_kses($item['hexa_process_des']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </section>

        <?php elseif ($settings['hexa_design_layout']  == 'layout-6') : ?>

            <div class="map-wrap hf-el-section">
                <ul>

                    <?php foreach ($settings['hexa_process_list'] as $key => $item) : ?>
                        <li>
                            <div class="location">
                                <div class="location-icon">
                                    <?php if ($item['hexa_box_icon_type'] == 'icon') : ?>
                                        <?php if (!empty($item['hexa_box_icon']) || !empty($item['hexa_box_selected_icon']['value'])) : ?>
                                            <span class="hf-el-rep-icon">
                                                <?php hexa_render_icon($item, 'hexa_box_icon', 'hexa_box_selected_icon'); ?>
                                            </span>
                                        <?php endif; ?>
                                    <?php elseif ($item['hexa_box_icon_type'] == 'image') : ?>
                                        <?php if (!empty($item['hexa_box_icon_image']['url'])) : ?>
                                            <span class="hf-el-rep-icon">
                                                <img src="<?php echo $item['hexa_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['hexa_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                            </span>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <?php if (!empty($item['hexa_box_icon_svg'])) : ?>
                                            <span class="hf-el-rep-icon">
                                                <?php echo $item['hexa_box_icon_svg']; ?>
                                            </span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="location-content">
                                    <?php if (!empty($item['hexa_process_title'])) : ?>
                                        <h4 class="location-title hf-el-rep-title"><?php echo hexa_kses($item['hexa_process_title']); ?></h4>
                                    <?php endif; ?>
                                    <?php if (!empty($item['hexa_process_des'])) : ?>
                                        <p class="hf-el-rep-des"><?php echo hexa_kses($item['hexa_process_des']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>

                </ul>
            </div>

        <?php else :
            // shape image
            if (!empty($settings['hexa_shape_image_1']['url'])) {
                $hexa_shape_image = !empty($settings['hexa_shape_image_1']['id']) ? wp_get_attachment_image_url($settings['hexa_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['hexa_shape_image_1']['url'];
                $hexa_shape_image_alt = get_post_meta($settings["hexa_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->add_render_attribute('title_args', 'class', 'hfsection__title hf-el-title');
        ?>


            <section class="process__area pt-120 pb-120 hf-el-section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="hfsection__wrapper text-center mb-70">
                                <?php if (!empty($settings['hexa_process_sub_title'])) : ?>
                                    <div class="hfbanner__sub-title mb-15">
                                        <span class="hf-el-subtitle"><?php echo hexa_kses($settings['hexa_process_sub_title']); ?></span>
                                        <i>
                                            <svg width="124" height="38" viewBox="0 0 124 38" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <rect width="124" height="38" fill="url(#pattern1)" fill-opacity="0.08" />
                                                <defs>
                                                    <pattern id="pattern1" patternContentUnits="objectBoundingBox" width="1" height="1">
                                                        <use xlink:href="#image0_933_1323" transform="translate(-0.0596774) scale(0.00612903 0.02)" />
                                                    </pattern>
                                                    <image id="image0_933_1323" width="180" height="50" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAALQAAAAyCAYAAAD1JPH3AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDcuMS1jMDAwIDc5LmVkYTJiM2ZhYywgMjAyMS8xMS8xNy0xNzoyMzoxOSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6RUMyMzkwQTczMTM3MTFFRDg3NUZBOUZCRDk1MThFMTMiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6RUMyMzkwQTYzMTM3MTFFRDg3NUZBOUZCRDk1MThFMTMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIDIzLjEgKFdpbmRvd3MpIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6MjFBQkIwMjIzMTA2MTFFREEzRkNBQzVFOTRFRTVERTgiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6MjFBQkIwMjMzMTA2MTFFREEzRkNBQzVFOTRFRTVERTgiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz5lgZ3iAAAB2ElEQVR42uzd7U3CUBiA0Wr4DxvQDWQE4gS6gSO6ibhB2aBMoCG5ja83pVRaSSnnJE2/MII+t7386sPz21dxQ1ZpKdNSpPUynItL/nNd6rSc2t6n/Sot+TYTsJhgrJsU6TqLt7zS779EE3ad1vuwvwuDg5kF3QQao92E47fq3ICrQ/RN8LsQPBMPOob7lEV8j5o7z6Yj+Cbwzyx+U5orB32MdCvcwcFv0/ZLx5SmubrHAVCZ0lwW9CrEu07rcsC8k/GmNPk8vg7hx2P13K/4fYP+6LhdcjvR5wMgrmP0h5bXxdecmjadu1N0ffFuOxc/zzKcP65fhwQt5nkOgGJu08NH/1cEDYIGQYOgETQIGgQNggZBI2gQNAgaBA2CRtAgaBA0CBoEjaBB0CBoEDQIGkGDoEHQIGgQNIIGQYOgQdAgaAQNE7aY+Ptre7JSn6ct9VWe2UfQvx4XFuPbZ+fz1/5HsGPEHh831mw359bhWH6OCQf9Xvw8v67OQmyLcg6GfJ4Yd769Dvviv+yuXQ0N+tXf8aKpUtUz/rJlvWw5Pmf5RfIQ7vJV0fO55wvtTSL+3R+mQasTd4BlyzRpdeWBEKeL+aC+yt1d0PczDSpH/PJbjfi+RvUtwADssXzgKiX3gwAAAABJRU5ErkJggg==" />
                                                </defs>
                                            </svg>
                                        </i>
                                    </div>
                                <?php endif; ?>
                                <?php
                                if (!empty($settings['hexa_process_title'])) :
                                    printf(
                                        '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape($settings['hexa_process_title_tag']),
                                        $this->get_render_attribute_string('title_args'),
                                        hexa_kses($settings['hexa_process_title'])
                                    );
                                endif;
                                ?>
                                <?php if (!empty($settings['hexa_process_description'])) : ?>
                                    <p class="hf-el-content"><?php echo hexa_kses($settings['hexa_process_description']); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="hfprocess__border-bottom p-relative pb-45">
                        <?php if (!empty($hexa_shape_image)) : ?>
                            <div class="hfprocess-shape-four d-none d-md-block">
                                <img src="<?php echo esc_url($hexa_shape_image); ?>" alt="<?php echo esc_attr($hexa_shape_image_alt); ?>">
                            </div>
                        <?php endif; ?>
                        <div class="row">

                            <?php foreach ($settings['hexa_process_list'] as $key => $item) :
                                $key = $key + 1;
                                $keyCount = count($settings['hexa_process_list']);
                            ?>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="hfprocess__item p-relative mb-40 <?php echo $key == 2 ? 'ml-30' : ($key == 3 ? 'ml-55' : ($key == 4 ? "d-flex justify-content-end" : NULL)); ?>">
                                        <div class="hfprocess__wrapper  tpprocess__<?php echo esc_attr($key); ?>">
                                            <?php if (!empty($item['hexa_process_word'])) : ?>
                                                <span class="hfprocess__count mb-25 hf-el-rep-num"><?php echo hexa_kses($item['hexa_process_word']); ?></span>
                                            <?php endif; ?>
                                            <?php if (!empty($item['hexa_process_title'])) : ?>
                                                <h4 class="hfprocess__title hf-el-rep-title"><?php echo hexa_kses($item['hexa_process_title']); ?></h4>
                                            <?php endif; ?>
                                        </div>
                                        <?php if ($key == 1) : ?>
                                            <div class="hfprocess-shape-one d-none d-md-block">
                                                <svg width="112" height="15" viewBox="0 0 112 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path class="line-dash-path" d="M1 8.56464C18.4695 1.84561 64.9267 -6.52437 111 13.7479" stroke="#A6A8B0" stroke-dasharray="4 5"></path>
                                                </svg>
                                            </div>
                                        <?php elseif ($key == 2) : ?>
                                            <div class="hfprocess-shape-two d-none d-lg-block">
                                                <svg width="112" height="15" viewBox="0 0 112 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path class="line-dash-path" d="M1 6.43536C18.4695 13.1544 64.9267 21.5244 111 1.25212" stroke="#A6A8B0" stroke-dasharray="4 5"></path>
                                                </svg>
                                            </div>
                                        <?php elseif ($key == 3) : ?>
                                            <div class="hfprocess-shape-three d-none d-md-block">
                                                <svg width="112" height="15" viewBox="0 0 112 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path class="line-dash-path" d="M1 8.56464C18.4695 1.84561 64.9267 -6.52437 111 13.7479" stroke="#A6A8B0" stroke-dasharray="4 5"></path>
                                                </svg>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>

<?php endif;
    }
}

$widgets_manager->register(new Hexa_Process());
