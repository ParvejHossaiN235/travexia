<?php

namespace HexaCore\Widgets;

use \Elementor\Widget_Base;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Hexa Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Hexa_Post_Grid extends Widget_Base
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
        return 'hf-post-grid';
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
        return __('Post Grid', 'hexacore');
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
        $this->post_content_controls();
        $this->post_settings_option();
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
                    'layout_2' => esc_html__('Layout 2', 'hexacore'),
                ],
                'default' => 'layout_1',
            ]
        );

        $this->end_controls_section();
    }

    protected function post_content_controls()
    {
        //Content 
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Post Content', 'hexacore'),
            ]
        );
        $this->add_control(
            'post_cat',
            [
                'label' => __('Select Categories', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->blog_post_categories(),
                'multiple' => true,
                'label_block' => true,
                'placeholder' => __('All Categories', 'hexacore'),
            ]
        );
        $this->add_control(
            'number_show',
            [
                'label' => __('Show Number Posts', 'hexacore'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => '3',
            ]
        );
        $this->add_control(
            'btn_text',
            [
                'label' => __('Button Label', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Read More', 'hexacore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'post_thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
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
            'admin_show',
            [
                'label' => __('Admin On/Off', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'hexacore'),
                'label_off' => __('Hide', 'hexacore'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'category_show',
            [
                'label' => __('Category On/Off', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'hexacore'),
                'label_off' => __('Hide', 'hexacore'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'date_show',
            [
                'label' => __('Date On/Off', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'hexacore'),
                'label_off' => __('Hide', 'hexacore'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'date_icon',
            [
                'label' => __('Date Icon', 'hexacore'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fa-light fa-calendar',
                    'library' => 'reguler',
                ],
                'condition' => [
                    'date_show' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'comment_show',
            [
                'label' => __('Comment On/Off', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'hexacore'),
                'label_off' => __('Hide', 'hexacore'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'comments_icon',
            [
                'label' => __('Comments Icon', 'hexacore'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fa-light fa-comment',
                    'library' => 'reguler',
                ],
                'condition' => [
                    'comment_show' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'show_pagination',
            [
                'label' => __('Show Pagination', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'hexacore'),
                'label_off' => __('No', 'hexacore'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->end_controls_section();
    }

    protected function post_settings_option()
    {

        $this->start_controls_section(
            'hexa_col_section',
            [
                'label' => __('Post Settings', 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'hexa_design_layout' => ['layout_1', 'layout_2', 'layout_3']
                ]
            ]
        );
        $this->add_control(
            'post_container',
            [
                'label' => esc_html__('Choose Container', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'container' => esc_html__('Boxed', 'hexacore'),
                    'container-fluid' => esc_html__('Full Width', 'hexacore'),
                ],
                'default' => 'container',
            ]
        );
        $this->add_control(
            'show_sidebar',
            [
                'label' => __('Show Sidebar', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'hexacore'),
                'label_off' => __('No', 'hexacore'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'nav_align',
            [
                'label' => esc_html__('Pagination Align', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__('Default', 'hexacore'),
                    'justify-content-start' => esc_html__('Left', 'hexacore'),
                    'justify-content-center' => esc_html__('Center', 'hexacore'),
                    'justify-content-end' => esc_html__('Right', 'hexacore'),
                ],
                'separator' => 'before',
                'default' => '',
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

    protected function blog_post_categories()
    {
        $args = array('orderby=name&order=ASC&hide_empty=0');
        $terms = get_terms('category', $args);
        $cat = array();
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $cat[$term->slug] = $term->name;
            }
        }
        return $cat;
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        extract($settings);

        $number_show = (!empty($settings['number_show']) ? $settings['number_show'] : 9);

        if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } elseif (get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }

        if ($settings['post_cat']) {
            $args = array(
                'paged' => $paged,
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => $number_show,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'slug',
                        'terms'    => $settings['post_cat']
                    ),
                ),
            );
        } else {
            $args = array(
                'paged' => $paged,
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => $number_show,
            );
        }

        $the_query = new \WP_Query($args);

?>


        <?php if ($settings['hexa_design_layout']  == 'layout_3') : ?>

            <!-- Blog area start -->
            <div class="bd-blog__area">
                <div class="row g-5">
                    <?php if ($the_query->have_posts()) :
                        $i = 0.0;
                        while ($the_query->have_posts()) :
                            $the_query->the_post();
                            global $post;
                            $author_bio_avatar_size = 65;
                            $display_name     = get_the_author_meta('display_name', $post->post_author);
                            $display_name     = empty($display_name) ? get_the_author_meta('nickname', $post->post_author) : $display_name;
                            $author_post  = get_the_author_meta('user_post', $post->post_author);
                            $categories = get_the_category($post->ID);
                            $i += 0.3;
                    ?>
                            <div class="col-xl-<?php echo esc_attr($desktop_column); ?> col-lg-<?php echo esc_attr($laptop_column); ?> col-md-<?php echo esc_attr($tablet_column); ?> col-<?php echo esc_attr($mobile_column); ?> wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                                <div class="blog__wrap blog__item style-two wellconcept-el-blog-item">
                                    <div class="blog__thumb">
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
                                            echo wp_kses_post($thumbnail_html);
                                            ?>
                                        </a>

                                        <div class="blog__btn-circle">
                                            <a href="<?php the_permalink($post->ID); ?>" class="circle-btn is-bg-white">
                                                <span class="icon__box">
                                                    <i class="fa-regular fa-arrow-right-long"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="blog__content">
                                        <div class="blog__content-top">
                                            <?php if (!empty($settings['category_show'])) : ?>
                                                <div class="blog__tag is-bg-light wellconcept-el-blog-cat">
                                                    <?php if (!empty($categories[0]->name)) : ?>
                                                        <a class="bdevs-el-cat" href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($settings['date_show'])) : ?>
                                                <div class="blog__meta wellconcept-el-blog-meta">
                                                    <span>
                                                        <?php if ($settings['date_icon']) :
                                                            \Elementor\Icons_Manager::render_icon($settings['date_icon'], ['aria-hidden' => 'true']);
                                                        endif;
                                                        echo the_time('M d, Y', $post->ID); ?>
                                                    </span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <?php if (!empty($settings['title_show'])) : ?>
                                            <h5 class="blog__title wellconcept-el-title">
                                                <a href="<?php the_permalink($post->ID); ?>">
                                                    <?php echo wp_trim_words(get_the_title($post->ID), $settings['title_limit'], ''); ?>
                                                </a>
                                            </h5>
                                        <?php endif; ?>
                                        <?php if (!empty($settings['content_show'])) :
                                            $content_limit = (!empty($settings['content_limit'])) ? $settings['content_limit'] : '';
                                        ?>
                                            <p class="wellconcept-el-desc">
                                                <?php print wp_trim_words(get_the_excerpt($post->ID), $content_limit, ''); ?>
                                            </p>
                                        <?php endif; ?>
                                        <?php if (!empty($settings['admin_show'])) : ?>
                                            <div class="blog__content-bottom">
                                                <div class="blog__author">
                                                    <div class="blog__author-thumb">
                                                        <a href="<?php print esc_url(get_author_posts_url(get_the_author_meta($post->ID))); ?>">
                                                            <?php print get_avatar(get_the_author_meta('user_email'), $author_bio_avatar_size, '', '', ['class' => 'media-object img-circle']); ?>
                                                        </a>
                                                    </div>
                                                    <div class="blog__author-info">
                                                        <span class="blog__author-title">
                                                            <?php echo esc_html(ucfirst($display_name)); ?>
                                                        </span>
                                                        <span class="blog__author-designation"><?php echo esc_html($author_post); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                    <?php endwhile;
                        wp_reset_query();
                    endif; ?>
                </div>
            </div>
            <!-- Blog area end -->


        <?php elseif ($settings['hexa_design_layout']  == 'layout_2') :

            $post_column = !empty($show_sidebar) ? 'col-xxl-8 col-lg-8' : 'col-xxl-12 col-lg-12';

        ?>
            <!-- postbox area start -->
            <div class="postbox__area">
                <div class="<?php echo esc_attr($post_container); ?>">
                    <div class="row g-5">
                        <div class="<?php echo esc_attr($post_column); ?>">
                            <div class="row g-5 wow fadeInUp" data-wow-delay=".3s">
                                <?php if ($the_query->have_posts()) :
                                    $i = 0.0;
                                    while ($the_query->have_posts()) :
                                        $the_query->the_post();
                                        global $post;
                                        $categories = get_the_category($post->ID);
                                        $author_id = get_the_author_meta('ID');
                                        $author_avatar_url = get_author_posts_url($author_id);
                                        $i += 0.3;
                                ?>
                                        <div class="col-xl-<?php echo esc_attr($desktop_col); ?> col-lg-<?php echo esc_attr($laptop_col); ?> col-md-<?php echo esc_attr($tablet_col); ?> col-<?php echo esc_attr($mobile_col); ?>">
                                            <div class="blog__wrap blog__item style-five wellconcept-el-blog-item">
                                                <div class="blog__thumb is-hover">
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
                                                        echo wp_kses_post($thumbnail_html);
                                                        ?>
                                                    </a>
                                                    <?php if (!empty($settings['category_show'])) : ?>
                                                        <div class="blog__tag wellconcept-el-blog-cat">
                                                            <?php if (!empty($categories[0]->name)) : ?>
                                                                <a class="bdevs-el-cat" href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="blog__content bg-solid">
                                                    <?php if (!empty($settings['meta'])) : ?>
                                                        <div class="blog__meta wellconcept-el-blog-meta">
                                                            <?php if (!empty($settings['date_show'])) : ?>
                                                                <span>
                                                                    <?php if ($settings['date_icon']) :
                                                                        \Elementor\Icons_Manager::render_icon($settings['date_icon'], ['aria-hidden' => 'true']);
                                                                    endif;
                                                                    echo the_time('d M, Y', $post->ID); ?>
                                                                </span>
                                                            <?php endif; ?>
                                                            <?php if (!empty($settings['comment_show'])) : ?>
                                                                <span>
                                                                    <?php if ($settings['comments_icon']) :
                                                                        \Elementor\Icons_Manager::render_icon($settings['comments_icon'], ['aria-hidden' => 'true']);
                                                                    endif;
                                                                    echo get_comments_number($post->ID); ?> <?php print esc_html__('Comments', 'hexacore'); ?>
                                                                </span>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if (!empty($settings['title_show'])) : ?>
                                                        <h5 class="blog__title wellconcept-el-title">
                                                            <a href="<?php the_permalink($post->ID); ?>">
                                                                <?php echo wp_trim_words(get_the_title($post->ID), $settings['title_limit'], ''); ?>
                                                            </a>
                                                        </h5>
                                                    <?php endif; ?>
                                                    <?php if (!empty($settings['content_show'])) :
                                                        $content_limit = (!empty($settings['content_limit'])) ? $settings['content_limit'] : '';
                                                    ?>
                                                        <p class="wellconcept-el-desc">
                                                            <?php print wp_trim_words(get_the_excerpt($post->ID), $content_limit, ''); ?>
                                                        </p>
                                                    <?php endif; ?>
                                                    <?php if (!empty($settings['btn_text'])) : ?>
                                                        <div class="blog__btn">
                                                            <a class="bd-btn bordered-light wellconcept-el-btn is-btn-anim" href="<?php echo esc_url(get_the_permalink($post->ID)); ?>">
                                                                <span class="bd-btn-inner">
                                                                    <span class="bd-btn-normal"><?php echo esc_html($btn_text); ?></span>
                                                                    <span class="bd-btn-hover"><?php echo esc_html($btn_text); ?></span>
                                                                </span>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                <?php endwhile;
                                    wp_reset_query();
                                endif; ?>
                            </div>
                        </div>
                        <?php if (!empty($settings['show_sidebar'])) : ?>
                            <div class="col-xxl-4 col-lg-4">
                                <div class="sidebar-wrapper">
                                    <?php dynamic_sidebar('post-sidebar'); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if (!empty($settings['show_pagination'])) : ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="pagination__wrapper <?php echo esc_attr($nav_align); ?>">
                                    <div class="bd-basic__pagination style-2">
                                        <nav>
                                            <?php
                                            $prev = '<i class="fas fa-long-arrow-left"></i>';
                                            $next = '<i class="fas fa-long-arrow-right"></i>';
                                            $pagination = array(
                                                'base'      => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                                                'format'    => '?paged=%#%',
                                                'current'   => max(1, get_query_var('paged')),
                                                'total'     => $the_query->max_num_pages,
                                                'prev_text' => $prev,
                                                'next_text' => $next,
                                                'type'      => 'list',
                                                'end_size'  => 3,
                                                'mid_size'  => 3
                                            );
                                            // Generate pagination links
                                            $return =  paginate_links($pagination);
                                            echo str_replace("<ul class='page-numbers'>", '<ul class="page-pagination mb-0 p-0 ' . esc_attr($nav_align) . '">', $return);
                                            ?>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- postbox area end -->

        <?php else : ?>

            <div class="row">
                <?php if ($the_query->have_posts()) :
                    $i = 0.0;
                    while ($the_query->have_posts()) :
                        $the_query->the_post();
                        global $post;
                        $categories = get_the_category($post->ID);
                        $author_id = get_the_author_meta('ID');
                        $author_avatar_url = get_author_posts_url($author_id);
                        $i += 0.3;
                ?>
                        <div class="col-xl-<?php echo esc_attr($desktop_col); ?> col-lg-<?php echo esc_attr($laptop_col); ?> col-md-<?php echo esc_attr($tablet_col); ?> col-<?php echo esc_attr($mobile_col); ?>">
                            <div class="hf-blog-item mb-30 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                                <div class="hf-blog-thumb">
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
                                        echo wp_kses_post($thumbnail_html);
                                        ?>
                                    </a>
                                    <?php if (!empty($settings['date_show'])) : ?>
                                        <div class="hf-blog-date">
                                            <span><?php the_time('d M, Y', $post->ID); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="hf-blog-content">
                                    <div class="hf-blog-item-info d-flex">
                                        <?php if (!empty($settings['admin_show'])) : ?>
                                            <span><i class="flaticon-user"></i>
                                                <a href="<?php print esc_url($author_avatar_url); ?>">
                                                    <?php echo ucwords(get_the_author()); ?>
                                                </a>
                                            </span>
                                        <?php endif; ?>
                                        <?php if (!empty($settings['category_show'])) : ?>
                                            <span>
                                                <i class="fal fa-user"></i>
                                                <?php if (!empty($categories[0]->name)) : ?>
                                                    <a class="hexa-el-cat" href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                                                <?php endif; ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!empty($settings['title_show'])) : ?>
                                        <h4 class="hf-blog-title">
                                            <a href="<?php the_permalink($post->ID); ?>">
                                                <?php echo wp_trim_words(get_the_title($post->ID), $settings['title_limit'], ''); ?>
                                            </a>
                                        </h4>
                                    <?php endif; ?>
                                    <?php if (!empty($settings['content_show'])) :
                                        $content_limit = (!empty($settings['content_limit'])) ? $settings['content_limit'] : '';
                                    ?>
                                        <p class="hexa-el-desc">
                                            <?php print wp_trim_words(get_the_excerpt($post->ID), $content_limit, ''); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                <?php endwhile;
                    wp_reset_query();
                endif; ?>
                <?php if (!empty($settings['show_pagination'])) : ?>
                    <div class="col-12">
                        <div class="hexa-pagination">
                            <?php
                            $prev = '<i class="fas fa-long-arrow-left"></i>';
                            $next = '<i class="fas fa-long-arrow-right"></i>';
                            $pagination = array(
                                'base'      => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                                'format'    => '?paged=%#%',
                                'current'   => max(1, get_query_var('paged')),
                                'total'     => $the_query->max_num_pages,
                                'prev_text' => $prev,
                                'next_text' => $next,
                                'type'      => 'list',
                                'end_size'  => 3,
                                'mid_size'  => 3
                            );
                            // Generate pagination links
                            $return =  paginate_links($pagination);
                            echo str_replace("<ul class='page-numbers'>", '<ul class="page-pagination mb-0 p-0">', $return);
                            ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
<?php endif;
    }
}

$widgets_manager->register(new Hexa_Post_Grid());