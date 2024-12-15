<?php

namespace HexaCore\Widgets;

use Elementor\Widget_Base;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Hexa Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Hexa_Newsletter extends Widget_Base
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
        return 'hf-newsletter';
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
        return __('Newsletter', 'hexacore');
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
                ],
                'default' => 'layout_1',
            ]
        );

        $this->end_controls_section();

        // subscriber form
        $this->start_controls_section(
            'cta_section',
            [
                'label' => esc_html__('Content', 'hexacore'),
                'type'        => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label'   => esc_html__('Sub Title', 'hexacore'),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Subcribe', 'hexacore'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'title',
            [
                'label'   => esc_html__('Title', 'hexacore'),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Stay Informed with the Latest News', 'hexacore'),
                'label_block' => true,
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
                'default' => 'h2',
            ]
        );
        $this->add_control(
            'form_shortcode',
            [
                'label'   => esc_html__('Form Shortcode', 'hexacore'),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'cta_setting',
            [
                'label' => esc_html__('Settings', 'hexacore'),
                'type'        => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_title',
            [
                'label' => esc_html__('Show Section Title', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'hexacore'),
                'label_off' => esc_html__('Hide', 'hexacore'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_shape',
            [
                'label' => esc_html__('Show Shape Image', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'hexacore'),
                'label_off' => esc_html__('Hide', 'hexacore'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->hexa_section_style_controls('cat_sectin', 'Section - Style', '.hexa-el-section');
        $this->hexa_basic_style_controls('section_title', 'Title - Style', '.hexa-el-title');
        $this->hexa_basic_style_controls('section_subtitle', 'Subtitle - Style', '.hexa-el-subtitle');
        $this->hexa_input_style_controls('cta_form', 'Form - Style', '.hexa-input', '.hexa-textarea');
        $this->hexa_button_style_controls('cta_button', 'Button - Style', '.hexa-el-btn');
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
        $html_tag = $settings['title_tag'];
        $title = $settings['title'];

?>

        <?php if ($settings['hexa_design_layout']  == 'layout_2') : ?>


        <?php else :

            $this->add_render_attribute('title', 'class', 'section__title mb-30 hexa-el-title');
            $title_html = sprintf('<%1$s %2$s>%3$s</%1$s>', $html_tag, $this->get_render_attribute_string('title'), $title);

            $this->add_render_attribute('subtitle', 'class', 'hexa-el-subtitle section__subtitle bg-field');
            $subtitle_html = sprintf('<span %1$s>%2$s</span>', $this->get_render_attribute_string('subtitle'), $settings['subtitle']);
        ?>

            <!-- cta area start -->
            <div class="cta__area fix">
                <div class="cta__wrapper cta__item is-sec-space hexa-el-section">
                    <div class="cta__bg"></div>
                    <?php if (!empty($settings['show_shape'])) : ?>
                        <div class="cta__shape-wrap d-none d-md-block ">
                            <div class="cta__shape-one scene">
                                <img class="layer" data-depth="5" src="assets/imgs/shape/circle-shape-02.png" alt="image">
                            </div>
                            <div class="cta__shape-two scene">
                                <img class="layer" data-depth="6" src="assets/imgs/shape/circle-shape-03.png" alt="image">
                            </div>
                            <div class="cta__shape-three scene">
                                <img class="layer" data-depth="7" src="assets/imgs/shape/circle-shape-03.png" alt="image">
                            </div>
                            <div class="cta__shape-four scene">
                                <img class="layer" data-depth="8" src="assets/imgs/shape/circle-shape-02.png" alt="image">
                            </div>
                            <div class="cta__shape-five scene">
                                <img class="layer" data-depth="9" src="assets/imgs/shape/circle-shape-03.png" alt="image">
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row align-items-center justify-content-center">
                        <div class="col-xl-6 col-lg-7 col-md-10">
                            <div class="cta__content-wrap">
                                <?php if (!empty($settings['show_title'])) : ?>
                                    <div class="cta__content">
                                        <div class="section__title-wrapper text-center ">
                                            <div class="section__title-wrapper text-center">
                                                <?php if (!empty($settings['subtitle'])) {
                                                    echo $subtitle_html;
                                                } ?>
                                                <?php if (!empty($settings['title'])) {
                                                    echo $title_html;
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="cta__form hexa-el-form">
                                    <?php if (!empty($settings['form_shortcode'])) : ?>
                                        <?php echo do_shortcode($settings['form_shortcode']); ?>
                                    <?php else : ?>
                                        <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'hexacore') . '</p></div>'; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- cta area end -->

<?php endif;
    }
}

$widgets_manager->register(new Hexa_Newsletter());
