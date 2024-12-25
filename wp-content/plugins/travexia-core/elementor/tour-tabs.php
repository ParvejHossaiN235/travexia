<?php

namespace HexaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;


if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Hexa Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Hexa_Tour_Tabs extends Widget_Base
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
        return 'hf-tour-tabs';
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
        return __('Tour Tabs', 'hexacore');
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


        // About Tab group
        $this->start_controls_section(
            'hexa_abtab',
            [
                'label' => esc_html__('Tour Tab', 'hexacore'),
                'description' => esc_html__('Control all the style settings from Style tab', 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tab_active',
            [
                'label' => esc_html__('Active This', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'hexacore'),
                'label_off' => esc_html__('No', 'hexacore'),
                'return_value' => 'yes',
                'default' => '',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'hexacore'),
                'description' => hexa_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('About Tab Title', 'hexacore'),
                'label_block' => true,
            ]
        );

        // img
        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Upload Image', 'hexacore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'image_size',
                'exclude' => ['1536x1536', '2048x2048'],
                'include' => [],
                'default' => 'full',
            ]
        );

        $this->add_control(
            'tour_list',
            [
                'label' => esc_html__('Tour - List', 'hexacore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => esc_html__('Business Stratagy', 'hexacore'),
                    ],
                    [
                        'title' => esc_html__('Website Development', 'hexacore')
                    ],
                    [
                        'title' => esc_html__('Marketing & Reporting', 'hexacore')
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
        $this->hexa_section_style_controls('abtab_section', 'Section - Style', '.hf-el-section');
        $this->hexa_basic_style_controls('section_subtitle', 'Section - Subtitle', '.hf-el-subtitle', 'layout-1');
        $this->hexa_basic_style_controls('section_title', 'Section - Title', '.hf-el-title', 'layout-1');
        $this->hexa_basic_style_controls('section_desc', 'Section - Description', '.hf-el-content', 'layout-1');
        $this->hexa_basic_style_controls('rep_title', 'Repeater Title', '.hf-el-rep-title', 'layout-1');
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

        <?php if ($settings['hexa_design_layout']  == 'layout-2') : ?>


        <?php else :

            $this->add_render_attribute('title_args', 'class', 'section-title-4 fs-54 hf-el-title');

        ?>

            <!-- destination-area-start -->
            <div class="tr-destination-area">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-6">
                        <div class="tr-destination-left">
                            <ul class="nav nav-tab" id="myTab" role="tablist">
                                <?php foreach ($settings['tour_list'] as $key => $item) : ?>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link <?php echo $item['tab_active'] ? 'active' : NULL; ?>" id="home-<?php echo esc_attr($key + 1); ?>" data-bs-toggle="tab" data-bs-target="#home-tab-<?php echo esc_attr($key + 1); ?>" type="button" role="tab" aria-controls="home-tab-<?php echo esc_attr($key + 1); ?>" aria-selected="<?php echo $item['tab_active'] ? 'true' : 'false'; ?>">
                                            <?php echo hexa_kses($item['title']); ?>
                                        </button>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="tr-destination-right">
                            <div class="tab-content" id="myTabContent">
                                <?php foreach ($settings['tour_list'] as $key => $item) :

                                    $image_html = \Elementor\Group_Control_Image_Size::get_attachment_image_html($item, 'image_size', 'image');

                                ?>
                                    <div class="tab-pane fade <?php echo $item['tab_active'] ? 'show active' : NULL; ?>" id="home-tab-<?php echo esc_attr($key + 1); ?>" role="tabpanel" aria-labelledby="home-tab-<?php echo esc_attr($key + 1); ?>">
                                        <?php if (!empty($item['image']['url'])) : ?>
                                            <div class="hexa-el-image tr-destination-thumb-main">
                                                <?php echo wp_kses_post($image_html); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- destination-area-end -->


<?php endif;
    }
}

$widgets_manager->register(new Hexa_Tour_Tabs());
