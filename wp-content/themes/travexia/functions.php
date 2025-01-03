<?php

/**
 * travexia functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package travexia
 */

define('TRAVEXIA_THEME_NAME', 'Travexia');
define('TRAVEXIA_THEME_SLUG', 'travexia');
define('TRAVEXIA_THEME_DIR', get_template_directory());
define('TRAVEXIA_THEME_URI', get_template_directory_uri());
define('TRAVEXIA_THEME_CSS_DIR', TRAVEXIA_THEME_URI . '/assets/css/');
define('TRAVEXIA_THEME_JS_DIR', TRAVEXIA_THEME_URI . '/assets/js/');
define('TRAVEXIA_THEME_INC', TRAVEXIA_THEME_DIR . '/inc/');

/**
 * Travexia theme setup function.
 */

if (!function_exists('travexia_theme_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function travexia_theme_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on travexia, use a find and replace
         * to change 'travexia' to the name of your theme in all the template files.
         */
        load_theme_textdomain('travexia', get_template_directory() . '/languages');

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
            'main-menu' => esc_html__('Main Menu', 'travexia'),
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

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

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
add_action('after_setup_theme', 'travexia_theme_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function travexia_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('travexia_content_width', 640);
}
add_action('after_setup_theme', 'travexia_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function travexia_widgets_init()
{
    /**
     * blog sidebar
     * never change sidebar-widget class
     */
    register_sidebar([
        'name'          => esc_html__('Blog Sidebar', 'travexia'),
        'id'            => 'post-sidebar',
        'before_widget' => '<div id="%1$s" class="sidebar-widget widget mb-40 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="sidebar-widget-title mb-30">',
        'after_title'   => '</h4>',
    ]);
}
add_action('widgets_init', 'travexia_widgets_init');

/**
 *  Scripts declaration for this theme.
 */
require TRAVEXIA_THEME_INC . 'frontend/common/scripts.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require TRAVEXIA_THEME_INC . 'frontend/template-functions.php';

/**
 * Custom template tags for this theme..
 */
require TRAVEXIA_THEME_INC . 'frontend/template-tags.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require TRAVEXIA_THEME_INC . 'frontend/jetpack.php';
}

/**
 * Custom Page Header for this theme.
 */
require TRAVEXIA_THEME_INC . 'frontend/page-header/breadcrumbs.php';
require TRAVEXIA_THEME_INC . 'frontend/page-header/page-header.php';
require TRAVEXIA_THEME_INC . 'frontend/class-navwalker.php';
require TRAVEXIA_THEME_INC . 'frontend/builder.php';


/**
 * Register the required plugins for this theme.
 */
require TRAVEXIA_THEME_INC . 'backend/class-tgm-plugin-activation.php';
require TRAVEXIA_THEME_INC . 'backend/plugin-requires.php';

/**
 * Custom metabox for this theme.
 */
if (function_exists('rwmb_meta')) {
    require TRAVEXIA_THEME_INC . 'backend/meta-boxes.php';
}

/**
 * Functions which add more to backend.
 */
require TRAVEXIA_THEME_INC . 'backend/admin-functions.php';

/**
 * initialize customizer.
 */

add_action('after_setup_theme', function () {
    if (class_exists('Kirki')) {
        require TRAVEXIA_THEME_INC . 'backend/customizer/customizer.php';
        require TRAVEXIA_THEME_INC . 'backend/color.php';
    }
});

// Load Woocommerce plugin
if (class_exists('WooCommerce')) {
    add_theme_support('woocommerce');
    require(TRAVEXIA_THEME_INC . 'woocommerce/functions.php');
    require(TRAVEXIA_THEME_INC . 'woocommerce/hooks.php');
}
