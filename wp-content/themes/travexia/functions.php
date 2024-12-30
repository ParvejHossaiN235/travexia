<?php

/**
 * hexa functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package hexa
 */

define('HEXA_THEME_NAME', 'Travexia');
define('HEXA_THEME_SLUG', 'travexia');
define('HEXA_THEME_DIR', get_template_directory());
define('HEXA_THEME_URI', get_template_directory_uri());
define('HEXA_THEME_CSS_DIR', HEXA_THEME_URI . '/assets/css/');
define('HEXA_THEME_JS_DIR', HEXA_THEME_URI . '/assets/js/');
define('HEXA_THEME_INC', HEXA_THEME_DIR . '/inc/');

/**
 * Hexa theme setup function.
 */

if (!function_exists('hexa_theme_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function hexa_theme_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on hexa, use a find and replace
         * to change 'hexa-theme' to the name of your theme in all the template files.
         */
        load_theme_textdomain('hexa-theme', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus([
            'main-menu' => esc_html__('Main Menu', 'hexa-theme'),
        ]);

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ]);

        // Set up the WordPress core custom background feature.
        // add_theme_support('custom-background', apply_filters('hexa_custom_background_args', [
        //     'default-color' => 'ffffff',
        //     'default-image' => '',
        // ]));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        //Enable custom header
        //add_theme_support('custom-header');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', [
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ]);

        /**
         * Enable suporrt for Post Formats
         * see: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support('post-formats', [
            'image',
            'gallery',
            'audio',
            'video',
            'quote',
        ]);

        // Add support for Block Styles.
        add_theme_support('wp-block-styles');
        remove_theme_support('widgets-block-editor');
        // Add support for full and wide align images.
        add_theme_support('align-wide');
        // Add support for editor styles.
        add_theme_support('editor-styles');
        // Add support for responsive embedded content.
        add_theme_support('responsive-embeds');
    }
endif;
add_action('after_setup_theme', 'hexa_theme_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hexa_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('hexa_content_width', 640);
}
add_action('after_setup_theme', 'hexa_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hexa_widgets_init()
{
    /**
     * blog sidebar
     * never change sidebar-widget class
     */
    register_sidebar([
        'name'          => esc_html__('Blog Sidebar', 'hexa-theme'),
        'id'            => 'post-sidebar',
        'before_widget' => '<div id="%1$s" class="sidebar-widget widget mb-40 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="sidebar-widget-title mb-35">',
        'after_title'   => '</h4>',
    ]);
}
add_action('widgets_init', 'hexa_widgets_init');

/**
 *  Scripts declaration for this theme.
 */
require HEXA_THEME_INC . 'frontend/common/scripts.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require HEXA_THEME_INC . 'frontend/template-functions.php';

/**
 * Custom template tags for this theme..
 */
require HEXA_THEME_INC . 'frontend/template-tags.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require HEXA_THEME_INC . 'frontend/jetpack.php';
}

/**
 * Custom Page Header for this theme.
 */
require HEXA_THEME_INC . 'frontend/page-header/breadcrumbs.php';
require HEXA_THEME_INC . 'frontend/page-header/page-header.php';
require HEXA_THEME_INC . 'frontend/class-navwalker.php';
require HEXA_THEME_INC . 'frontend/builder.php';


/**
 * Register the required plugins for this theme.
 */
require HEXA_THEME_INC . 'backend/class-tgm-plugin-activation.php';
require HEXA_THEME_INC . 'backend/plugin-requires.php';

/**
 * Custom metabox for this theme.
 */
if (function_exists('rwmb_meta')) {
    require HEXA_THEME_INC . 'backend/meta-boxes.php';
}

/**
 * Functions which add more to backend.
 */
require HEXA_THEME_INC . 'backend/admin-functions.php';

/**
 * initialize customizer.
 */

add_action('after_setup_theme', function () {
    if (class_exists('Kirki')) {
        require HEXA_THEME_INC . 'backend/customizer/customizer.php';
        require HEXA_THEME_INC . 'backend/color.php';
    }
});

// Load Woocommerce plugin
if (class_exists('WooCommerce')) {
    add_theme_support('woocommerce');
    require(HEXA_THEME_INC . 'woocommerce/functions.php');
    require(HEXA_THEME_INC . 'woocommerce/hooks.php');
}
