<?php

namespace HexaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Hexa Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Hexa_Pricing_Tab extends Widget_Base
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
        return 'hf-pricing-tab';
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
        return __('Pricing Tab', 'hexacore');
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

        // pricing group 1
        $this->start_controls_section(
            'hexa_pricing',
            [
                'label' => esc_html__('Pricing Tab', 'hexacore'),
                'description' => esc_html__('Control all the style settings from Style tab', 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'tab_btn',
            [
                'label' => esc_html__('Tab Button', 'hexacore'),
                'description' => hexa_get_allowed_html_desc('intermediate'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Monthly', 'hexacore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'active_tab',
            [
                'label' => __('Active Tab Button', 'wellconcept-addon'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'wellconcept-addon'),
                'label_off' => __('No', 'wellconcept-addon'),
                'return_value' => 'yes',
                'default' => 'yes',
                'frontend_available' => true,
            ]
        );

        $repeater->add_control(
            'template',
            [
                'label' => __('Section Template', 'hexacore'),
                'placeholder' => __('Select a section template for as tab content', 'hexacore'),

                'type' => Controls_Manager::SELECT2,
                'options' => get_elementor_templates()
            ]
        );

        $this->add_control(
            'pricing_tabs',
            [
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ tab_btn }}}',
                'default' => [
                    [
                        'tab_btn' => 'Monthly',
                    ],
                    [
                        'tab_btn' => 'Yearly',
                    ]
                ]
            ]
        );

        $this->end_controls_section();
    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->hexa_section_style_controls('advanced_tab_section', 'Section Style', '.ele-section');
        $this->hexa_basic_style_controls('section_subtitle', 'Section - Subtitle', '.hf-el-subtitle', ['layout-1', 'layout-3']);
        $this->hexa_basic_style_controls('section_title', 'Section - Title', '.hf-el-title', ['layout-1', 'layout-3']);
        $this->hexa_basic_style_controls('section_desc', 'Section - Description', '.hf-el-content', ['layout-1', 'layout-3']);
        $this->hexa_basic_style_controls('tab_btn_title', 'Tab Button Title', '.hf-el-tab-btn', ['layout-1', 'layout-2', 'layout-3']);
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


        <?php else : ?>

            <div class="faq__tab-wrapper bd-tab">
                <nav>
                    <div class="nav nav-tabs faq-tab-slide justify-content-center" id="nav-tab" role=tablist>
                        <label for="faq-tab-check" class="nav faq-separate">
                            <?php foreach ($settings['pricing_tabs'] as $key => $tab) :
                                if ($key == 0) {
                                    $tab['active_tab'] = 'yes';
                                } else {
                                    $tab['active_tab'] = 'no';
                                }
                                if (!empty($tab['template'])) :
                                    $tab_btn = str_replace(' ', '_', $tab['tab_btn']);
                            ?>
                                    <span class="nav-link well-el-tbtn <?php echo ($tab['active_tab'] == 'yes') ? 'active' : ''; ?> " id="nav-<?php echo $tab_btn; ?>-tab" data-bs-toggle="tab" data-bs-target="#nav-<?php echo $tab_btn; ?>" role="tab" aria-controls="nav-<?php echo $tab_btn; ?>" aria-selected="true">
                                        <?php echo wp_kses_post($tab['tab_btn']); ?>
                                    </span>
                            <?php endif;
                            endforeach; ?>
                        </label>
                    </div>
                </nav>
            </div>

            <div class="faq-tab-inner mt-30">
                <div class="tab-content wow fadeInUp" id="nav-tabContent" data-wow-delay=".3s" data-wow-duration="1s">
                    <?php foreach ($settings['tabs'] as $key => $tab) :
                        if ($key == 0) {
                            $tab['active_tab'] = 'yes';
                        } else {
                            $tab['active_tab'] = 'no';
                        }
                        if (!empty($tab['template'])) :
                            $tab_btn = str_replace(' ', '_', $tab['tab_btn']);
                    ?>
                            <div class="tab-pane fade <?php echo ($tab['active_tab'] == 'yes') ? 'show active' : ''; ?>" id="nav-<?php echo $tab_btn; ?>" role="tabpanel" aria-labelledby="nav-<?php echo $tab_btn; ?>-tab" tabindex="0">
                                <?php echo \Elementor\plugin::instance()->frontend->get_builder_content($tab['template'], true); ?>
                            </div>
                    <?php endif;
                    endforeach; ?>
                </div>
            </div>

<?php endif;
    }
}
$widgets_manager->register(new Hexa_Pricing_Tab());
