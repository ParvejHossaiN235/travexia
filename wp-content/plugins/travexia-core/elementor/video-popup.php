<?php

namespace HexaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Hexa Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Hexa_Video_Popup extends Widget_Base
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
        return 'hf-video-popup';
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
        return __('Video Popup', 'hexacore');
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // _hexa_image
        $this->start_controls_section(
            '_hexa_image',
            [
                'label' => esc_html__('Thumbnail', 'hexacore'),
            ]
        );

        $this->add_control(
            'hexa_image',
            [
                'label' => esc_html__('Choose Image', 'hexacore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'hexa_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->end_controls_section();

        // hexa_video
        $this->start_controls_section(
            'hexa_video',
            [
                'label' => esc_html__('Video', 'hexacore'),
            ]
        );

        $this->add_control(
            'hexa_video_title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Video Title', 'hexacore'),
                'default' => esc_html__('This Title For Video', 'hexacore'),
                'placeholder' => esc_html__('Type Heading Text Here.', 'hexacore'),
                'label_block' => true,
                'condition' => [
                    'hexa_design_layout' => 'layout-2'
                ]
            ]
        );

        $this->add_control(
            'hexa_video_url',
            [
                'label' => esc_html__('Video URL', 'hexacore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'https://www.youtube.com/watch?v=_RpLvsA1SNM',
                'label_block' => true,
                'description' => __("We recommended to put video url form video website such as 'youtube', 'vimeo'.", 'hexacore')
            ]
        );

        $this->end_controls_section();
    }


    // style_tab_content
    protected function style_tab_content()
    {
        $this->hexa_section_style_controls('video_section', 'Section - Style', '.hf-el-section');
        $this->hexa_basic_style_controls('section_title', 'Section - Title', '.hf-el-title', 'layout-2');
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
            if (!empty($settings['hexa_image']['url'])) {
                $hexa_image = !empty($settings['hexa_image']['id']) ? wp_get_attachment_image_url($settings['hexa_image']['id'], $settings['hexa_image_size_size']) : $settings['hexa_image']['url'];
                $hexa_image_alt = get_post_meta($settings["hexa_image"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>

            <section class="video-area pb-70 hf-el-section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="video-inner-wrap">
                                <div class="video-inner-bg">
                                    <?php if (!empty($hexa_image)) : ?>
                                        <img src="<?php echo esc_url($hexa_image); ?>" alt="<?php echo esc_attr($hexa_image_alt); ?>">
                                    <?php endif; ?>
                                    <?php if (!empty($settings['hexa_video_title'])) : ?>
                                        <div class="video-inner-content">
                                            <h4 class="video-inner-title hf-el-title"><?php echo hexa_kses($settings['hexa_video_title']); ?></h4>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($settings['hexa_video_url'])) : ?>
                                        <div class="video-inner-icon">
                                            <a class="popup-video hf-el-play2" href="<?php echo esc_url($settings['hexa_video_url']); ?>">
                                                <span>
                                                    <svg width="13" height="16" viewBox="0 0 13 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M1.58594 1.20044L11.7859 8.00044L1.58594 14.8004V1.20044Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </span>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php else :
            if (!empty($settings['hexa_image']['url'])) {
                $hexa_image = !empty($settings['hexa_image']['id']) ? wp_get_attachment_image_url($settings['hexa_image']['id'], $settings['hexa_image_size_size']) : $settings['hexa_image']['url'];
                $hexa_image_alt = get_post_meta($settings["hexa_image"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>

            <div class="hfvideo">
                <div class="hfvideo-thumb p-relative">
                    <?php if (!empty($hexa_image)) : ?>
                        <img src="<?php echo esc_url($hexa_image); ?>" alt="<?php echo esc_attr($hexa_image_alt); ?>">
                    <?php endif; ?>
                    <?php if (!empty($settings['hexa_video_url'])) : ?>
                        <div class="hfvideo-icon">
                            <div class="hfvideo-icon-anim">
                                <a class="popup-video hf-el-play" href="<?php echo esc_url($settings['hexa_video_url']); ?>"><i class="fa-sharp fa-solid fa-play"></i></a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

<?php endif;
    }
}

$widgets_manager->register(new Hexa_Video_Popup());
