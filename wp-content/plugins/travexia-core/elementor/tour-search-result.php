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
class Hexa_Tour_Search_Results extends Widget_Base
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
        return 'hf-tour-search-result';
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
        return __('Tour Search Result', 'hexacore');
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
        $this->tour_content_controls();
        $this->tour_settings_option();
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

    protected function tour_content_controls()
    {
        //Content 
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Tour Content', 'hexacore'),
            ]
        );

        $this->add_control(
            'number_show',
            [
                'label' => __('Show Number Posts', 'hexacore'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => '6',
            ]
        );
        $this->add_control(
            'btn_text',
            [
                'label' => __('Button Label', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('View Details', 'hexacore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $this->add_control(
            'error_text',
            [
                'label' => __('Error Text', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => __('No tour found. Please select the date and search again.', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'post_thumbnail',
                'exclude' => ['1536x1536', '2048x2048'],
                'include' => [],
                'default' => 'full',
            ]
        );
        $this->add_control(
            'title_show',
            [
                'label' => __('Title On/Off', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'hexacore'),
                'label_off' => __('Hide', 'hexacore'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'title_limit',
            [
                'label' => esc_html__('Title Word Count', 'hexacore'),
                'description' => esc_html__('Set how many word you want to display!', 'hexacore'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => '6',
                'condition' => [
                    'title_show' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'content_show',
            [
                'label' => __('Content On/Off', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'hexacore'),
                'label_off' => __('Hide', 'hexacore'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'content_limit',
            [
                'label' => __('Content Limit', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '14',
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'content_show' => 'yes'
                ]
            ]
        );


        $this->add_control(
            'show_location',
            [
                'label' => __('Show Location', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'bdevs-elementor'),
                'label_off' => __('No', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_rating',
            [
                'label' => __('Show Rating', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'bdevs-elementor'),
                'label_off' => __('No', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_price',
            [
                'label' => __('Show Price', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'bdevs-elementor'),
                'label_off' => __('No', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_duration',
            [
                'label' => __('Show Duration', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'bdevs-elementor'),
                'label_off' => __('No', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->end_controls_section();
    }

    protected function tour_settings_option()
    {

        $this->start_controls_section(
            'hexa_col_section',
            [
                'label' => __('Column Settings', 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'desktop_col',
            [
                'label' => esc_html__('Columns for Desktop', 'hexacore'),
                'description' => esc_html__('Screen width equal to or greater than 1200px', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__('1 Columns', 'hexacore'),
                    6 => esc_html__('2 Columns', 'hexacore'),
                    4 => esc_html__('3 Columns', 'hexacore'),
                    3 => esc_html__('4 Columns', 'hexacore'),
                    2 => esc_html__('6 Columns', 'hexacore'),
                    1 => esc_html__('12 Columns', 'hexacore'),
                ],
                'separator' => 'before',
                'default' => '4',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'laptop_col',
            [
                'label' => esc_html__('Columns for Large', 'hexacore'),
                'description' => esc_html__('Screen width equal to or greater than 992px', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__('1 Columns', 'hexacore'),
                    6 => esc_html__('2 Columns', 'hexacore'),
                    4 => esc_html__('3 Columns', 'hexacore'),
                    3 => esc_html__('4 Columns', 'hexacore'),
                    2 => esc_html__('6 Columns', 'hexacore'),
                    1 => esc_html__('12 Columns', 'hexacore'),
                ],
                'separator' => 'before',
                'default' => '4',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'tablet_col',
            [
                'label' => esc_html__('Columns for Tablet', 'hexacore'),
                'description' => esc_html__('Screen width equal to or greater than 768px', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__('1 Columns', 'hexacore'),
                    6 => esc_html__('2 Columns', 'hexacore'),
                    4 => esc_html__('3 Columns', 'hexacore'),
                    3 => esc_html__('4 Columns', 'hexacore'),
                    2 => esc_html__('6 Columns', 'hexacore'),
                    1 => esc_html__('12 Columns', 'hexacore'),
                ],
                'separator' => 'before',
                'default' => '6',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'mobile_col',
            [
                'label' => esc_html__('Columns for Mobile', 'hexacore'),
                'description' => esc_html__('Screen width less than 767px', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__('1 Columns', 'hexacore'),
                    6 => esc_html__('2 Columns', 'hexacore'),
                    4 => esc_html__('3 Columns', 'hexacore'),
                    3 => esc_html__('4 Columns', 'hexacore'),
                    2 => esc_html__('6 Columns', 'hexacore'),
                    1 => esc_html__('12 Columns', 'hexacore'),
                ],
                'separator' => 'before',
                'default' => '12',
                'style_transfer' => true,
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


        $s_loc = !empty($_GET['loc']) ? sanitize_text_field($_GET['loc']) : 0;
        $s_tour = !empty($_GET['tour']) ? sanitize_text_field($_GET['tour']) : 0;
        $s_activity = !empty($_GET['activity']) ? sanitize_text_field($_GET['activity']) : 0;

        $number_show = (!empty($settings['number_show']) ? $settings['number_show'] : -1);
        $args = array(
            'post_type' => 'tf_tours',
            'post_status' => 'publish',
            'posts_per_page' => $number_show,
        );

        if (!empty($s_loc) && !empty($s_activity)) {
            $args['tax_query'] = [
                'relation' => 'AND',
                [
                    'taxonomy' => 'tour_destination',
                    'field' => 'name',
                    'terms' => [$s_loc]
                ],
                [
                    'taxonomy' => 'tour_activities',
                    'field' => 'name',
                    'terms' => [$s_activity]
                ]
            ];
        } elseif (!empty($s_loc) && empty($s_activity)) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'tour_destination',
                    'field' => 'name',
                    'terms' => [$s_loc]
                ]
            ];
        } elseif (empty($s_loc) && !empty($s_activity)) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'tour_activities',
                    'field' => 'name',
                    'terms' => [$s_activity]
                ]
            ];
        }

        $the_query = new \WP_Query($args);
?>

        <div class="row row-gap-30">
            <?php if ($the_query->have_posts()) : ?>
                <?php $i = 0;
                while ($the_query->have_posts()) :
                    $the_query->the_post();
                    global $post;
                    $meta                   = get_post_meta($post->ID, 'tf_tours_opt', true);
                    $destinations           = get_the_terms($post->ID, 'tour_destination');
                    $destination_name = !empty($destinations[0]) ? $destinations[0]->name : '';
                    $destination_slug = !empty($destinations[0]) ? get_term_link($destinations[0]->term_id) : '#';
                    $tour_duration = !empty($meta['duration']) ? $meta['duration'] : '';
                    $duration_time = !empty($meta['duration_time']) ? $meta['duration_time'] : '';
                    $night         = !empty($meta['night']) ? $meta['night'] : false;
                    $night_count   = !empty($meta['night_count']) ? $meta['night_count'] : '';
                    $tour_price             = new Tour_Price($meta);

                    // new function
                    $disable_adult_price  = !empty($meta['disable_adult_price']) ? $meta['disable_adult_price'] : false;
                    $custom_pricing_by_rule = !empty($meta['custom_pricing_by']) ? $meta['custom_pricing_by'] : '';
                    $tour_archive_page_price_settings = !empty(Helper::tfopt('tour_archive_price_minimum_settings')) ? Helper::tfopt('tour_archive_price_minimum_settings') : 'all';

                    $pricing_rule = !empty($meta['pricing']) ? $meta['pricing'] : null;
                    $tour_type = !empty($meta['type']) ? $meta['type'] : null;
                    if ($pricing_rule == 'group') {
                        $price = !empty($meta['group_price']) ? $meta['group_price'] : null;
                    } else {
                        $price = !empty($meta['adult_price']) ? $meta['adult_price'] : null;
                    }
                    $discount_type = !empty($meta['discount_type']) ? $meta['discount_type'] : null;
                    $discounted_price = !empty($meta['discount_price']) ? $meta['discount_price'] : NULL;
                    if ($discount_type == 'percent') {
                        $sale_price = number_format($price - (($price / 100) * $discounted_price), 1);
                    } elseif ($discount_type == 'fixed') {
                        $sale_price = number_format(($price - $discounted_price), 1);
                    }

                    // Tour Starting Price
                    $tour_price = [];
                    if ($pricing_rule  && $pricing_rule == 'group') {
                        if (!empty($check_in_out)) {
                            if (!empty($meta['type']) && $meta['type'] === 'continuous') {
                                $custom_availability = !empty($meta['custom_avail']) ? $meta['custom_avail'] : false;
                                if ($custom_availability) {
                                    foreach ($meta['cont_custom_date'] as $repval) {
                                        //Initial matching date array
                                        $show_tour = [];
                                        $dates = $repval['date'];
                                        // Check if any date range match with search form date range and set them on array
                                        if (!empty($period)) {
                                            foreach ($period as $date) {
                                                $show_tour[] = intval(strtotime($date->format('Y-m-d')) >= strtotime($dates['from']) && strtotime($date->format('Y-m-d')) <= strtotime($dates['to']));
                                            }
                                        }
                                        if (!in_array(0, $show_tour)) {
                                            if ($custom_pricing_by_rule  && $custom_pricing_by_rule == 'group') {
                                                if (!empty($repval['group_price'])) {
                                                    $tour_price[] = $repval['group_price'];
                                                }
                                            }
                                            if ($custom_pricing_by_rule  && $custom_pricing_by_rule == 'person') {
                                                if ($tour_archive_page_price_settings == "all") {
                                                    if (!empty($repval['adult_price']) && !$disable_adult_price) {
                                                        $tour_price[] = $repval['adult_price'];
                                                    }
                                                }
                                                if ($tour_archive_page_price_settings == "adult") {
                                                    if (!empty($repval['adult_price']) && !$disable_adult_price) {
                                                        $tour_price[] = $repval['adult_price'];
                                                    }
                                                }
                                            }
                                        }
                                    }
                                } else {
                                    if (!empty($meta['group_price'])) {
                                        $tour_price[] = $meta['group_price'];
                                    }
                                }
                            } else {
                                if (!empty($meta['group_price'])) {
                                    $tour_price[] = $meta['group_price'];
                                }
                            }
                        } else {
                            if (!empty($meta['group_price'])) {
                                $tour_price[] = $meta['group_price'];
                            }
                        }
                    }
                    if ($pricing_rule  && $pricing_rule == 'person') {
                        if (!empty($check_in_out)) {
                            if (!empty($meta['type']) && $meta['type'] === 'continuous') {
                                $custom_availability = !empty($meta['custom_avail']) ? $meta['custom_avail'] : false;
                                if ($custom_availability) {
                                    foreach ($meta['cont_custom_date'] as $repval) {
                                        //Initial matching date array
                                        $show_tour = [];
                                        $dates = $repval['date'];
                                        // Check if any date range match with search form date range and set them on array
                                        if (!empty($period)) {
                                            foreach ($period as $date) {
                                                $show_tour[] = intval(strtotime($date->format('Y-m-d')) >= strtotime($dates['from']) && strtotime($date->format('Y-m-d')) <= strtotime($dates['to']));
                                            }
                                        }
                                        if (!in_array(0, $show_tour)) {
                                            if ($custom_pricing_by_rule  && $custom_pricing_by_rule == 'group') {
                                                if (!empty($repval['group_price'])) {
                                                    $tour_price[] = $repval['group_price'];
                                                }
                                            }
                                            if ($custom_pricing_by_rule  && $custom_pricing_by_rule == 'person') {
                                                if (!empty($repval['adult_price']) && !$disable_adult_price) {
                                                    if ($tour_archive_page_price_settings == "all") {
                                                        if (!empty($repval['adult_price']) && !$disable_adult_price) {
                                                            $tour_price[] = $repval['adult_price'];
                                                        }
                                                    }
                                                    if ($tour_archive_page_price_settings == "adult") {
                                                        if (!empty($repval['adult_price']) && !$disable_adult_price) {
                                                            $tour_price[] = $repval['adult_price'];
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                } else {
                                    if ($tour_archive_page_price_settings == "all") {
                                        if (!empty($meta['adult_price']) && !$disable_adult_price) {
                                            $tour_price[] = $meta['adult_price'];
                                        }
                                    }

                                    if ($tour_archive_page_price_settings == "adult") {
                                        if (!empty($meta['adult_price']) && !$disable_adult_price) {
                                            $tour_price[] = $meta['adult_price'];
                                        }
                                    }
                                }
                            } else {
                                if ($tour_archive_page_price_settings == "all") {
                                    if (!empty($meta['adult_price']) && !$disable_adult_price) {
                                        $tour_price[] = $meta['adult_price'];
                                    }
                                }

                                if ($tour_archive_page_price_settings == "adult") {
                                    if (!empty($meta['adult_price']) && !$disable_adult_price) {
                                        $tour_price[] = $meta['adult_price'];
                                    }
                                }
                            }
                        } else {
                            if ($tour_archive_page_price_settings == "all") {
                                if (!empty($meta['adult_price']) && !$disable_adult_price) {
                                    $tour_price[] = $meta['adult_price'];
                                }
                            }
                            if ($tour_archive_page_price_settings == "adult") {
                                if (!empty($meta['adult_price']) && !$disable_adult_price) {
                                    $tour_price[] = $meta['adult_price'];
                                }
                            }
                        }
                    }

                    $i++;
                ?>
                    <div class="col-xl-<?php echo esc_attr($desktop_col); ?> col-lg-<?php echo esc_attr($laptop_col); ?> col-md-<?php echo esc_attr($tablet_col); ?> col-<?php echo esc_attr($mobile_col); ?>">
                        <div class="tr-trip-item">
                            <div class="tr-trip-thumb fix">
                                <a href="<?php the_permalink($post->ID); ?>">
                                    <?php
                                    if (has_post_thumbnail()) {
                                        $settings['post_thumbnail'] = [
                                            'id' => get_post_thumbnail_id(),
                                        ];
                                        $thumbnail_html = \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings, 'post_thumbnail');
                                    } else {
                                        $thumbnail_html = '<img src="' . get_bloginfo('stylesheet_directory') . '/assets/img/thumbnail-default.png" />';
                                    }
                                    echo hexa_kses($thumbnail_html);
                                    ?>
                                </a>
                            </div>
                            <div class="tr-trip-content">
                                <?php if (!empty($settings['show_location'])) : ?>
                                    <a href="<?php echo esc_url($destination_slug); ?>" class="tr-trip-location">
                                        <i class="fa-sharp fa-solid fa-location-dot"></i>
                                        <?php echo esc_html($destination_name); ?>
                                    </a>
                                <?php endif; ?>
                                <?php if (!empty($settings['title_show'])) : ?>
                                    <h5 class="tr-trip-title">
                                        <a class="border-line-black" href="<?php the_permalink($post->ID); ?>">
                                            <?php echo wp_trim_words(get_the_title($post->ID), $settings['title_limit'], ''); ?>
                                        </a>
                                    </h5>
                                <?php endif; ?>
                                <?php if (!empty($settings['show_rating'])) : ?>
                                    <div class="tr-trip-ratting">
                                        <span>
                                            <?php TF_Review::tf_archive_single_rating(); ?>
                                        </span>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($settings['content_show'])) :
                                    $content_limit = (!empty($settings['content_limit'])) ? $settings['content_limit'] : '';
                                ?>
                                    <p class="hexa-el-desc">
                                        <?php print wp_trim_words(get_the_excerpt($post->ID), $content_limit, ''); ?>
                                    </p>
                                <?php endif; ?>
                                <?php if (!empty($settings['show_duration'])) : ?>
                                    <div class="tr-trip-duration d-flex align-items-center">
                                        <span>
                                            <i class="fa-sharp fa-light fa-clock"></i>
                                            <?php echo esc_html__('Time period:', 'hexacore'); ?>
                                        </span>
                                        <p><?php echo esc_html($tour_duration); ?>
                                            <?php
                                            if ($tour_duration > 1) {
                                                $dur_string         = 's';
                                                $duration_time_html = $duration_time . $dur_string;
                                            } else {
                                                $duration_time_html = $duration_time;
                                            }
                                            echo " " . esc_html($duration_time_html);
                                            ?>
                                            <?php if ($night) { ?>
                                                <?php echo esc_html($night_count); ?>
                                                <?php
                                                if (!empty($night_count)) {
                                                    if ($night_count > 1) {
                                                        echo esc_html__('Nights', 'bdevs-elementor');
                                                    } else {
                                                        echo esc_html__('Night', 'bdevs-elementor');
                                                    }
                                                }
                                                ?>
                                            <?php } ?>
                                        </p>
                                    </div>
                                <?php endif; ?>
                                <div class="tr-trip-price d-flex align-items-center justify-content-between">
                                    <?php if (!empty($settings['btn_text'])) : ?>
                                        <a class="tr-trip-link" href="<?php echo esc_url(get_the_permalink($post->ID)); ?>">
                                            <?php echo esc_html($btn_text); ?>
                                            <i class="fa-sharp fa-regular fa-arrow-right-long"></i>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (!empty($settings['show_price'])) : ?>
                                        <?php
                                        $hide_price = Helper::tfopt('t-hide-start-price');
                                        if (isset($hide_price) && $hide_price !== '1' && !empty($tour_price)) :
                                        ?>
                                            <span class="tour-price">
                                                <?php echo esc_html__('From', 'hexacore'); ?>
                                                <i>
                                                    <?php
                                                    $tf_tour_min_price      = min($tour_price);
                                                    $tf_tour_full_price     = min($tour_price);
                                                    $tf_tour_discount_type  = !empty($meta['discount_type']) ? $meta['discount_type'] : '';
                                                    $tf_tour_discount_price = !empty($meta['discount_price']) ? $meta['discount_price'] : '';
                                                    if (!empty($tf_tour_discount_type) && !empty($tf_tour_min_price) && !empty($tf_tour_discount_price)) {
                                                        if ($tf_tour_discount_type == "percent") {
                                                            $tf_tour_min_discount = ($tf_tour_min_price * $tf_tour_discount_price) / 100;
                                                            $tf_tour_min_price    = $tf_tour_min_price - $tf_tour_min_discount;
                                                        }
                                                        if ($tf_tour_discount_type == "fixed") {
                                                            $tf_tour_min_discount = $tf_tour_discount_price;
                                                            $tf_tour_min_price    = $tf_tour_min_price - $tf_tour_discount_price;
                                                        }
                                                    }
                                                    $lowest_price = wc_price($tf_tour_min_price);
                                                    if (empty($tf_tour_min_discount)) {
                                                        echo  hexa_kses(wc_price($tf_tour_full_price));
                                                    } else {
                                                        echo  hexa_kses($lowest_price);
                                                    }
                                                    ?>
                                                </i>
                                            </span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <div class="col-12">
                    <div class="alert alert-danger text-center" role="alert">
                        <?php echo hexa_kses($settings['error_text']); ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </div>
<?php
    }
}

$widgets_manager->register(new Hexa_Tour_Search_Results());
