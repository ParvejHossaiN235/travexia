<?php

namespace HexaCore\Widgets;

use \Tourfic\Classes\Helper;
use \Tourfic\App\TF_Review;
use \Tourfic\Classes\Tour\Pricing as Tour_Price;
use \Elementor\Widget_Base;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Hexa Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Hexa_Tour_Search_Form extends Widget_Base
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
        return 'hf-tour-search-form';
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
        return __('Tour Search Form', 'hexacore');
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
        $this->register_content_controls();
        $this->register_style_controls();
    }

    // TAB_CONTENT
    protected function register_content_controls()
    {
        $this->design_layout();
        $this->search_content();
        $this->search_setting();
    }

    protected function design_layout()
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
                    //'layout_3' => esc_html__('Layout 3', 'hexacore'),
                ],
                'default' => 'layout_1',
            ]
        );

        $this->end_controls_section();
    }
    public function search_content()
    {
        // Button 01
        $this->start_controls_section(
            '_section_button',
            [
                'label' => __('Search Content', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'btn_link',
            [
                'label' => esc_html__('Search Page link', 'hexacore'),
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
            'loc_label',
            [
                'label' => __('Destination Label', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Your Destination', 'bdevs-elementor'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'type_label',
            [
                'label' => __('Tour Type Label', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Tour Type', 'bdevs-elementor'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'activity_label',
            [
                'label' => __('Activity Label', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Tour Activities', 'bdevs-elementor'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'time_label',
            [
                'label' => __('Duration Label', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Duration', 'bdevs-elementor'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'btn_text',
            [
                'label' => __('Button Label', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Search', 'bdevs-elementor'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->end_controls_section();
    }

    public function search_setting()
    {
        $this->start_controls_section(
            'section_search_setting',
            [
                'label' => __('Search Settings', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_location',
            [
                'label' => esc_html__('Show Location', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'bdevs-elementor'),
                'label_off' => esc_html__('Hide', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_type',
            [
                'label' => esc_html__('Show Tour Type', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'bdevs-elementor'),
                'label_off' => esc_html__('Hide', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'show_activity',
            [
                'label' => esc_html__('Show Tour Activity', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'bdevs-elementor'),
                'label_off' => esc_html__('Hide', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_date',
            [
                'label' => esc_html__('Show Tour Date', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'bdevs-elementor'),
                'label_off' => esc_html__('Hide', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }
    // style_tab_content
    protected function register_style_controls()
    {
        $this->hexa_section_style_controls('blog_section', 'Section Style', '.hf-el-section');
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

        $term_args = array(
            'taxonomy' => 'tour_destination',
            'hide_empty' => false
        );
        $locations = get_terms($term_args);

        $term_args2 = array(
            'taxonomy' => 'tour_type',
            'hide_empty' => false
        );
        $tour_types = get_terms($term_args2);

        $term_args3 = array(
            'taxonomy' => 'tour_activities',
            'hide_empty' => false
        );
        $tour_activities = get_terms($term_args3);

?>

        <?php if ($settings['hexa_design_layout']  == 'layout_2') : ?>


        <?php else :

            $s_checkin = !empty($_GET['checkin']) ? strtotime($_GET['checkin']) : '';
            $s_loc = !empty($_GET['loc']) ? sanitize_text_field($_GET['loc']) : '';
            $s_tour = !empty($_GET['tour']) ? sanitize_text_field($_GET['tour']) : '';
            $s_activity = !empty($_GET['activity']) ? sanitize_text_field($_GET['activity']) : '';

        ?>

            <!-- search-area-start -->
            <div class="tr-search-area">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tr-hero-search-box">
                            <form action="<?php echo esc_url($settings['btn_link']['url']); ?>" method="get">
                                <div class="row align-items-center gx-0">
                                    <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                        <div class="tr-hero-widget-item widget-style-1 d-flex align-items-center">
                                            <div class="tr-hero-widget-icon">
                                                <span>
                                                    <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_7876_1998)">
                                                            <path d="M12 0.5C5.38317 0.5 0 5.88317 0 12.5C0 19.1168 5.38317 24.5 12 24.5C18.6168 24.5 24 19.1168 24 12.5C24 5.88317 18.6168 0.5 12 0.5ZM12 23.375C6.00352 23.375 1.125 18.4965 1.125 12.5C1.125 6.50352 6.00352 1.625 12 1.625C17.9965 1.625 22.875 6.50352 22.875 12.5C22.875 18.4965 17.9965 23.375 12 23.375ZM12 5.25781C8.9843 5.25781 6.53081 7.71125 6.53081 10.727C6.53081 12.9733 9.21919 16.6123 11.5612 19.5317C11.6139 19.5974 11.6807 19.6504 11.7567 19.6869C11.8326 19.7233 11.9158 19.7422 12 19.7422C12.0842 19.7422 12.1674 19.7233 12.2433 19.6869C12.3193 19.6504 12.3861 19.5974 12.4387 19.5317L12.5113 19.4412C14.963 16.3867 17.4692 12.9627 17.4692 10.727C17.4692 7.71125 15.0157 5.25781 12 5.25781ZM12.0005 18.2791C10.5493 16.4497 7.65581 12.6446 7.65581 10.727C7.65581 8.33159 9.60459 6.38281 12 6.38281C14.3954 6.38281 16.3442 8.33159 16.3442 10.727C16.3442 12.6885 13.473 16.4306 12.0005 18.2791ZM12 7.39241C10.1613 7.39241 8.66541 8.88828 8.66541 10.727C8.66541 12.5657 10.1613 14.0616 12 14.0616C13.8387 14.0616 15.3346 12.5657 15.3346 10.727C15.3346 8.88828 13.8387 7.39241 12 7.39241ZM12 12.9365C10.7816 12.9365 9.79041 11.9453 9.79041 10.727C9.79041 9.50858 10.7816 8.51736 12 8.51736C13.2184 8.51736 14.2096 9.50858 14.2096 10.727C14.2096 11.9453 13.2184 12.9365 12 12.9365Z" fill="currentcolor" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_7876_199">
                                                                <rect width="24" height="24" fill="white" transform="translate(0 0.5)" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="tr-hero-widget-select">
                                                <span class="tr-hero-widget-title">
                                                    <?php echo esc_html($settings['loc_label']); ?>
                                                </span>
                                                <select name="loc" class="banner-search-select">
                                                    <option value=""><?php echo esc_html__('Select Locations', 'bdevs-elementor'); ?></option>
                                                    <?php if (!empty($locations)) :
                                                        foreach ($locations as $loc) : ?>
                                                            <option <?php echo ($s_loc == $loc->name) ? 'selected="selected"' : ''; ?> value="<?php echo esc_attr($loc->name); ?>"><?php echo esc_html($loc->name); ?></option>
                                                    <?php endforeach;
                                                    endif;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                        <div class="tr-hero-widget-item widget-style-2 d-flex align-items-center">
                                            <div class="tr-hero-widget-icon">
                                                <span>
                                                    <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_7876_209)">
                                                            <path d="M5.625 0.4375V4.1875M15 0.4375V4.1875M8.28295 21.0625H3.75C1.67897 21.0625 0 19.3835 0 17.3125V6.0625C0 3.99133 1.67897 2.3125 3.75 2.3125H16.875C18.946 2.3125 20.625 3.99133 20.625 6.0625V7.9375H0" stroke="currentcolor" stroke-width="1.875" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M16.5 22.5625C19.6066 22.5625 22.125 20.0441 22.125 16.9375C22.125 13.8309 19.6066 11.3125 16.5 11.3125C13.3934 11.3125 10.875 13.8309 10.875 16.9375C10.875 20.0441 13.3934 22.5625 16.5 22.5625Z" stroke="currentcolor" stroke-width="1.875" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M16.5 15.0625V16.9375H18.375" stroke="currentcolor" stroke-width="1.875" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_7876_209">
                                                                <rect width="22.125" height="22.125" fill="white" transform="translate(0 0.4375)" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="tr-hero-widget-input">
                                                <span class="tr-hero-widget-title">
                                                    <?php echo esc_html($settings['time_label']); ?>
                                                </span>
                                                <input name="checkin" type="text" name="daterange" value="<?php echo !empty($s_checkin) ? date('m/d/Y', $s_checkin) : ''; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-xl-2 col-lg-4 col-md-6 col-sm-6">
                                        <div class="tr-hero-widget-item widget-style-3 d-flex align-items-center">
                                            <div class="tr-hero-widget-icon">
                                                <span>
                                                    <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_7876_1992)">
                                                            <path d="M12 0.5C5.38317 0.5 0 5.88317 0 12.5C0 19.1168 5.38317 24.5 12 24.5C18.6168 24.5 24 19.1168 24 12.5C24 5.88317 18.6168 0.5 12 0.5ZM12 23.375C6.00352 23.375 1.125 18.4965 1.125 12.5C1.125 6.50352 6.00352 1.625 12 1.625C17.9965 1.625 22.875 6.50352 22.875 12.5C22.875 18.4965 17.9965 23.375 12 23.375ZM12 5.25781C8.9843 5.25781 6.53081 7.71125 6.53081 10.727C6.53081 12.9733 9.21919 16.6123 11.5612 19.5317C11.6139 19.5974 11.6807 19.6504 11.7567 19.6869C11.8326 19.7233 11.9158 19.7422 12 19.7422C12.0842 19.7422 12.1674 19.7233 12.2433 19.6869C12.3193 19.6504 12.3861 19.5974 12.4387 19.5317L12.5113 19.4412C14.963 16.3867 17.4692 12.9627 17.4692 10.727C17.4692 7.71125 15.0157 5.25781 12 5.25781ZM12.0005 18.2791C10.5493 16.4497 7.65581 12.6446 7.65581 10.727C7.65581 8.33159 9.60459 6.38281 12 6.38281C14.3954 6.38281 16.3442 8.33159 16.3442 10.727C16.3442 12.6885 13.473 16.4306 12.0005 18.2791ZM12 7.39241C10.1613 7.39241 8.66541 8.88828 8.66541 10.727C8.66541 12.5657 10.1613 14.0616 12 14.0616C13.8387 14.0616 15.3346 12.5657 15.3346 10.727C15.3346 8.88828 13.8387 7.39241 12 7.39241ZM12 12.9365C10.7816 12.9365 9.79041 11.9453 9.79041 10.727C9.79041 9.50858 10.7816 8.51736 12 8.51736C13.2184 8.51736 14.2096 9.50858 14.2096 10.727C14.2096 11.9453 13.2184 12.9365 12 12.9365Z" fill="currentcolor" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_7876_1994">
                                                                <rect width="24" height="24" fill="white" transform="translate(0 0.5)" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="tr-hero-widget-select">
                                                <span class="tr-hero-widget-title">
                                                    <?php echo esc_html($settings['activity_label']); ?>
                                                </span>
                                                <select name="activity" class="banner-search-select">
                                                    <option value=""><?php echo esc_html__('Select Activity', 'bdevs-elementor'); ?></option>
                                                    <?php if (!empty($tour_activities)) :
                                                        foreach ($tour_activities as $activities) : ?>
                                                            <option <?php echo ($s_activity == $activities->name) ? 'selected="selected"' : ''; ?> value="<?php echo esc_attr($activities->name); ?>"><?php echo esc_html($activities->name); ?></option>
                                                    <?php endforeach;
                                                    endif;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                        <div class="tr-hero-widget-btn">
                                            <button type="submit" class="tr-btn-green w-100 text-center">Search Plan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- search-area-end -->

<?php endif;
    }
}

$widgets_manager->register(new Hexa_Tour_Search_Result());
