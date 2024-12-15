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
class Hexa_Post_Slider extends Widget_Base
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
        return 'hf-post-slider';
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
        return __('Post Slider', 'hexacore');
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
                    'layout-1' => esc_html__('Layout 1', 'hexacore'),
                    'layout-2' => esc_html__('Layout 2', 'hexacore'),
                ],
                'default' => 'layout_1',
            ]
        );

        $this->end_controls_section();
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
                'label' => __('Title On/Off', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-elementor'),
                'label_off' => __('Hide', 'bdevs-elementor'),
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
                'label' => __('Content On/Off', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-elementor'),
                'label_off' => __('Hide', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'content_limit',
            [
                'label' => __('Content Limit', 'bdevs-elementor'),
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
            'date_show',
            [
                'label' => __('Date On/Off', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-elementor'),
                'label_off' => __('Hide', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'category_show',
            [
                'label' => __('Category On/Off', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-elementor'),
                'label_off' => __('Hide', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'admin_show',
            [
                'label' => __('Admin On/Off', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-elementor'),
                'label_off' => __('Hide', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
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

    // style_tab_content
    protected function style_tab_content()
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
        $desktop_col = $settings['hexa_col_for_desktop'];
        $laptop_col = $settings['hexa_col_for_laptop'];
        $tablet_col = $settings['hexa_col_for_tablet'];
        $mobile_col = $settings['hexa_col_for_mobile'];
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

        <?php if ($settings['hexa_design_layout']  == 'layout_2') : ?>

            <div class="row">
                <?php if ($the_query->have_posts()) :
                    $i = 0.0;
                    while ($the_query->have_posts()) :
                        $the_query->the_post();
                        global $post;
                        $categories = get_the_category($post->ID);
                        $author_id = get_the_author_meta('ID');
                        $author_avatar_url = get_avatar_url($author_id);
                        $i += 0.3;
                ?>
                        <div class="col-xl-<?php echo esc_attr($settings['hexa_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['hexa_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['hexa_col_for_tablet']); ?> col-<?php echo esc_attr($settings['hexa_col_for_mobile']); ?>">
                            <div class="hfblog mb-30 hf-el-section">
                                <?php if (!empty(has_post_thumbnail())) : ?>
                                    <div class="hfblog-thumb mb-25 fix">
                                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                                    </div>
                                <?php endif; ?>

                                <div class="hfblog-content">
                                    <div class="hfblog-tag">
                                        <?php if (!empty($categories[0]->name)) : ?>
                                            <a class="hf-el-rep-cat" href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                                        <?php endif; ?>
                                        <?php if (!empty($categories[1]->name)) : ?>
                                            <a class="hf-el-rep-cat" href="<?php echo esc_url(get_category_link($categories[1]->term_id)); ?>"><?php echo esc_html($categories[1]->name); ?></a>
                                        <?php endif; ?>
                                    </div>
                                    <h3 class="hfblog-title hf-el-rep-title"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['hexa_blog_title_word'], ''); ?></a>
                                    </h3>
                                    <?php if (!empty($settings['hexa_post_content'])) :
                                        $hexa_post_content_limit = (!empty($settings['hexa_post_content_limit'])) ? $settings['hexa_post_content_limit'] : '';
                                    ?>
                                        <p class="hf-el-rep-des"><?php print wp_trim_words(get_the_excerpt(get_the_ID()), $hexa_post_content_limit, ''); ?></p>
                                    <?php endif; ?>
                                    <?php if (!empty($settings['hexa_post_button'])) : ?>
                                        <a class="hf-header-btn mb-20 hf-el-rep-des" href="<?php the_permalink(); ?>"><?php echo hexa_kses($settings['hexa_post_button']); ?></a>
                                    <?php endif; ?>
                                    <div class="hfblog-avatar d-flex align-items-center">
                                        <?php if (!empty($author_avatar_url)) : ?>
                                            <div class="hfblog-avatar-thub mr-10 hf-el-rep-avatar">
                                                <img src="<?php echo esc_url($author_avatar_url); ?>" alt="<?php echo esc_attr__('Avatar', 'hexacore'); ?>">
                                            </div>
                                        <?php endif; ?>
                                        <div class="hfblog-avatar-info">
                                            <h5 class="hfblog-avatar-title hf-el-rep-ava-name"><?php echo ucwords(get_the_author()); ?></h5>
                                            <span class="hf-el-rep-date"><?php the_time('F d, Y'); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php endwhile;
                    wp_reset_query();
                endif; ?>

                <?php if (!empty($settings['show_pagination'])) : ?>
                    <div class="basic-pagination mt-30">
                        <?php
                        $big = 999999999;

                        if (get_query_var('paged')) {
                            $paged = get_query_var('paged');
                        } else if (get_query_var('page')) {
                            $paged = get_query_var('page');
                        } else {
                            $paged = 1;
                        }

                        echo paginate_links(array(
                            'base'       => str_replace($big, '%#%', get_pagenum_link($big)),
                            'format'     => '?paged=%#%',
                            'current'    => $paged,
                            'total'      => $the_query->max_num_pages,
                            'type'       => 'list',
                            'prev_text'  => '<i>
                                          <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M11 6H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                             <path d="M6 11L1 6L6 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                          </svg>
                                       </i> Prev Page',
                            'next_text'  => 'Next page <i>
                                          <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M1 6H11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                             <path d="M6 11L11 6L6 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                          </svg>
                                       </i>',
                            'show_all'   => false,
                            'end_size'   => 1,
                            'mid_size'   => 4,
                        ));
                        ?>
                    </div>
                <?php endif; ?>
            </div>

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

$widgets_manager->register(new Hexa_Post_Slider());
