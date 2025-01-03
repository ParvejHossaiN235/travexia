<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package travexia
 */

/**
 * Adds custom classes to the array of body classes.
 * @param array $classes Classes for the body element.
 * @return array
 */
function travexia_body_classes($classes)
{
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }
    // Adds a class of no-sidebar when there is no sidebar present.
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }
    if (!empty($get_user)) {
        $classes[] = 'profile-breadcrumb';
    }
    return $classes;
}
add_filter('body_class', 'travexia_body_classes');

/**
 * Get tags.
 */
function travexia_get_tag()
{
    $html = '';
    if (has_tag()) {
        $html .= '<div class="tagcloud">';
        $html .= get_the_tag_list('', ' ', '');
        $html .= '</div>';
    }
    return $html;
}

/**
 * Get categories.
 */
function travexia_get_category()
{
    $categories = get_the_category(get_the_ID());
    $x = 0;
    foreach ($categories as $category) {

        if ($x == 2) {
            break;
        }
        $x++;
        print '<a class="post-tag" href="' . get_category_link($category->term_id) . '">' . $category->cat_name . '</a>';
    }
}

/** img alt-text **/
function travexia_img_alt_text($img_er_id = null)
{
    $image_id = $img_er_id;
    $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', false);
    $image_title = get_the_title($image_id);

    if (!empty($image_id)) {
        if ($image_alt) {
            $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', false);
        } else {
            $alt_text = get_the_title($image_id);
        }
    } else {
        $alt_text = esc_html__('Image Alt Text', 'travexia');
    }
    return $alt_text;
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function travexia_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'travexia_pingback_header');

/* Select blog style */
if (!function_exists('travexia_blog_style')) :
    function travexia_blog_style()
    {
        $blog_style = array();
        // Check if layout is one column.
        if (get_theme_mod('blog_style') === 'grid' && get_theme_mod('blog_columns') === 'grid_2_cols') {
            $blog_style[] = 'blog-grid-2 col-lg-6 col-md-6 col-sm-12 col-xs-12';
        } elseif (get_theme_mod('blog_style') === 'grid' && get_theme_mod('blog_columns') === 'grid_3_cols') {
            $blog_style[] = 'blog-grid-3 col-lg-4 col-md-4 col-sm-12 col-xs-12';
        } elseif (get_theme_mod('blog_style') === 'grid' && get_theme_mod('blog_columns') === 'grid_4_cols') {
            $blog_style[] = 'blog-grid-4 col-lg-3 col-md-4 col-sm-12 col-xs-12';
        } else {
            $blog_style[] = 'blog-list col-lg-12 col-md-12 col-sm-12 col-xs-12';
        }
        // return the $classes array
        echo implode(' ', $blog_style);
    }
endif;

/**
 * Travexia preloader function
 */
if (!function_exists('travexia_preloader')) {
    function travexia_preloader()
    {
        if (get_theme_mod('preload') != false) {
            echo '<div id="preloader">';
            echo '<div class="preloader">';
            echo '<span></span>';
            echo '<span></span>';
            echo '</div></div>';
        }
    }
}
add_action('wp_body_open', 'travexia_preloader');

/**
 * Travexia back to top function
 */
if (!function_exists('travexia_custom_back_to_top')) {
    function travexia_custom_back_to_top()
    {
        if (get_theme_mod('back_to_top') != false) {
            echo '<button class="scroll-top scroll-to-target" data-target="html"><i class="far fa-angle-double-up"></i></button>';
        }
    }
}
add_action('wp_footer', 'travexia_custom_back_to_top');


/**
 * Change textarea position in comment form
 */
function travexia_move_comment_textarea_to_bottom($fields)
{
    $comment_field       = $fields['comment'];
    unset($fields['comment']);
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter('comment_form_fields', 'travexia_move_comment_textarea_to_bottom');

/**
 * shortcode supports for removing extra p, spance etc
 */
function travexia_shortcode_extra_content_remove($content)
{
    $array = [
        '<p>['    => '[',
        ']</p>'   => ']',
        ']<br />' => ']',
    ];
    return strtr($content, $array);
}
add_filter('the_content', 'travexia_shortcode_extra_content_remove');

/**
 * Change the default color to transparent
 */
function custom_woosc_bar_bg_color_default($default_color)
{
    return 'transparent';
}
add_filter('woosc_bar_bg_color_default', 'custom_woosc_bar_bg_color_default');

/**
 * This code filters the Archive widget to include the post count inside the link 
 */
function travexia_archive_count_span($links)
{
    $links = str_replace('</a>&nbsp;(', '<span >(', $links);
    $links = str_replace(')', ')</span></a> ', $links);
    return $links;
}
add_filter('get_archives_link', 'travexia_archive_count_span');

/**
 * This code filters the Category widget to include the post count inside the link 
 */
function travexia_cat_count_span($links)
{
    $links = str_replace('</a> (', '<span>', $links);
    $links = str_replace(')', '</span></a>', $links);
    return $links;
}
add_filter('wp_list_categories', 'travexia_cat_count_span');

/**
 * Travexia service sidebar
 */
function travexia_service_sidebar_func()
{
    if (is_active_sidebar('services-sidebar')) {
        dynamic_sidebar('services-sidebar');
    }
}
add_action('travexia_service_sidebar', 'travexia_service_sidebar_func', 20);

/**
 * Travexia portfolio sidebar
 */
function travexia_portfolio_sidebar_func()
{
    if (is_active_sidebar('portfolio-sidebar')) {
        dynamic_sidebar('portfolio-sidebar');
    }
}
add_action('travexia_portfolio_sidebar', 'travexia_portfolio_sidebar_func', 20);

function travexia_archive_title_modifier($title)
{
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif (is_tax()) { //for custom post types
        $title = sprintf(__('%1$s', 'travexia'), single_term_title('', false));
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    }
    return $title;
}
add_filter('get_the_archive_title', 'travexia_archive_title_modifier');


// related portfolios post
class RelatedPosts
{
    private $current_post_id;
    private $post_type;
    private $cat_texonomy;

    public function __construct($current_post_id, $post_type, $cat_texonomy)
    {
        $this->current_post_id = $current_post_id;
        $this->post_type = $post_type;
        $this->cat_texonomy = $cat_texonomy;
    }

    public function get_related_posts()
    {
        $args = array(
            'post_type' => $this->post_type,
            'posts_per_page' => 3,
            'post__not_in' => array($this->current_post_id),
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => $this->cat_texonomy,
                    'field' => 'term_id',
                    'terms' => wp_get_post_terms($this->current_post_id, $this->cat_texonomy, array("fields" => "ids")),
                ),
                array(
                    'taxonomy' => 'post_format',
                    'field' => 'slug',
                    'terms' => array('post-format-quote'), // Exclude the 'quote' post format
                    'operator' => 'NOT IN',
                ),
            ),
        );

        $related_posts_query = new WP_Query($args);
        return $related_posts_query->get_posts();
    }
}
