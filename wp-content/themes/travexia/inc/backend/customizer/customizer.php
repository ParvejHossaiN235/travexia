<?php

/**
 * Theme customizer
 *
 * @package travexia
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class Travexia_Customize
{
    /**
     * Customize settings
     *
     * @var array
     */
    protected $config = array();

    /**
     * The class constructor
     *
     * @param array $config
     */
    public function __construct($config)
    {
        $this->config = $config;

        if (!class_exists('Kirki')) {
            return;
        }

        $this->register();
    }

    /**
     * Register settings
     */
    public function register()
    {

        /**
         * Add the theme configuration
         */
        if (!empty($this->config['theme'])) {
            Kirki::add_config(
                $this->config['theme'],
                array(
                    'capability'  => 'edit_theme_options',
                    'option_type' => 'theme_mod',
                )
            );
        }

        /**
         * Add panels
         */
        if (!empty($this->config['panels'])) {
            foreach ($this->config['panels'] as $panel => $settings) {
                Kirki::add_panel($panel, $settings);
            }
        }

        /**
         * Add sections
         */
        if (!empty($this->config['sections'])) {
            foreach ($this->config['sections'] as $section => $settings) {
                Kirki::add_section($section, $settings);
            }
        }

        /**
         * Add fields
         */
        if (!empty($this->config['theme']) && !empty($this->config['fields'])) {
            foreach ($this->config['fields'] as $name => $settings) {
                if (!isset($settings['settings'])) {
                    $settings['settings'] = $name;
                }

                Kirki::add_field($this->config['theme'], $settings);
            }
        }
    }

    /**
     * Get config ID
     *
     * @return string
     */
    public function get_theme()
    {
        return $this->config['theme'];
    }

    /**
     * Get customize setting value
     *
     * @param string $name
     *
     * @return bool|string
     */
    public function get_option($name)
    {

        $default = $this->get_option_default($name);

        return get_theme_mod($name, $default);
    }

    /**
     * Get default option values
     *
     * @param $name
     *
     * @return mixed
     */
    public function get_option_default($name)
    {
        if (!isset($this->config['fields'][$name])) {
            return false;
        }

        return isset($this->config['fields'][$name]['default']) ? $this->config['fields'][$name]['default'] : false;
    }
}

/**
 * This is a short hand function for getting setting value from customizer
 *
 * @param string $name
 *
 * @return bool|string
 */
function travexia_get_option($name)
{
    global $travexia_customize;

    $value = false;

    if (class_exists('Kirki')) {
        $value = Kirki::get_option(TRAVEXIA_THEME_SLUG, $name);
    } elseif (!empty($travexia_customize)) {
        $value = $travexia_customize->get_option($name);
    }

    return apply_filters('travexia_get_option', $value, $name);
}

/**
 * Get default option values
 *
 * @param $name
 *
 * @return mixed
 */
function travexia_get_option_default($name)
{
    global $travexia_customize;

    if (empty($travexia_customize)) {
        return false;
    }

    return $travexia_customize->get_option_default($name);
}

/**
 * Move some default sections to `general` panel that registered by theme
 *
 * @param object $wp_customize
 */
function travexia_customize_modify($wp_customize)
{
    $wp_customize->get_section('title_tagline')->panel     = 'general';
    $wp_customize->get_section('static_front_page')->panel = 'general';
}

add_action('customize_register', 'travexia_customize_modify');


/**
 * Get customize settings
 *
 * Priority (Order) WordPress Live Customizer default: 
 * @link https://developer.wordpress.org/themes/customize-api/customizer-objects/
 *
 * @return array
 */
function travexia_customize_settings()
{
    /**
     * Customizer configuration
     */

    $settings = array(
        'theme' => TRAVEXIA_THEME_SLUG,
    );

    $panels = array(
        'general'     => array(
            'priority' => 5,
            'title'    => esc_html__('General', 'travexia'),
        ),
    );

    $sections = array(
        /* preloader */
        'preload_section'     => array(
            'title'       => esc_attr__('Preloader', 'travexia'),
            'description' => '',
            'priority'    => 11,
            'capability'  => 'edit_theme_options',
        ),
        /* typography */
        'typography'           => array(
            'title'       => esc_html__('Typography', 'travexia'),
            'description' => '',
            'priority'    => 12,
            'capability'  => 'edit_theme_options',
        ),
        /* 404 page */
        'error_404'       => array(
            'title'       => esc_html__('404', 'travexia'),
            'description' => '',
            'priority'    => 13,
            'capability'  => 'edit_theme_options',
        ),
        /* post slug */
        'post_slug'       => array(
            'title'       => esc_html__('Post Slug', 'travexia'),
            'description' => '',
            'priority'    => 14,
            'capability'  => 'edit_theme_options',
        ),
        /* color scheme */
        'color_scheme'   => array(
            'title'      => esc_html__('Color Scheme', 'travexia'),
            'priority'   => 200,
            'capability' => 'edit_theme_options',
        ),
    );

    $fields = array(
        /* popup user */
        'logo_width'     => array(
            'type'        => 'number',
            'label'       => esc_attr__('Logo Width(px)', 'travexia'),
            'section'     => 'title_tagline',
            'default'     => 135,
            'description' => esc_html__('Set logo width like 120px, 130px', 'travexia'),
            'priority'    => 8,
            'output'    => array(
                array(
                    'element'  => '#site-logo a img',
                    'property' => 'width',
                    'units'       => 'px'
                ),
            ),
        ),

        /* preload */
        'preload'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__('Preloader', 'travexia'),
            'section'     => 'preload_section',
            'default'     => false,
            'priority'    => 10,
        ),
        'preload_color'    => array(
            'type'     => 'color',
            'label'    => esc_html__('Color', 'travexia'),
            'section'  => 'preload_section',
            'priority' => 14,
            'output'    => array(
                array(
                    'element'  => '.page-loader:before',
                    'property' => 'border-color'
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'preload_bgcolor'    => array(
            'type'     => 'color',
            'label'    => esc_html__('Background Color', 'travexia'),
            'section'  => 'preload_section',
            'output'    => array(
                array(
                    'element'  => '.page-loader',
                    'property' => 'background'
                ),
            ),
            'priority' => 15,
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),

        /* typography */
        'typography_switch'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__('Typography Customize?', 'travexia'),
            'section'     => 'typography',
            'default'     => 0,
            'priority'    => 1,
        ),
        'body_typo'    => array(
            'type'     => 'typography',
            'label'    => esc_html__('Body Font', 'travexia'),
            'section'  => 'typography',
            'priority' => 2,
            'default'  => array(
                'font-family'    => '',
                'variant'        => 'regular',
                'font-size'      => '',
                'line-height'    => '',
                'letter-spacing' => '0',
                'color'          => '',
                'text-transform' => 'none',
            ),
            'output'      => array(
                array(
                    'element' => 'body, p',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'heading1_typo' => array(
            'type'     => 'typography',
            'label'    => esc_html__('Heading 1', 'travexia'),
            'section'  => 'typography',
            'priority' => 3,
            'default'  => array(
                'font-family'    => '',
                'variant'        => '',
                'font-size'      => '',
                'line-height'    => '',
                'letter-spacing' => '0',
                'color'          => '',
                'text-transform' => 'none',
            ),
            'output'      => array(
                array(
                    'element' => 'h1, .h1, .elementor-widget-heading h1.elementor-heading-title',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'heading2_typo' => array(
            'type'     => 'typography',
            'label'    => esc_html__('Heading 2', 'travexia'),
            'section'  => 'typography',
            'priority' => 4,
            'default'  => array(
                'font-family'    => '',
                'variant'        => '',
                'font-size'      => '',
                'line-height'    => '',
                'letter-spacing' => '0',
                'color'          => '',
                'text-transform' => 'none',
            ),
            'output'      => array(
                array(
                    'element' => 'h2, .h2, .elementor-widget-heading h2.elementor-heading-title',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'heading3_typo' => array(
            'type'     => 'typography',
            'label'    => esc_html__('Heading 3', 'travexia'),
            'section'  => 'typography',
            'priority' => 5,
            'default'  => array(
                'font-family'    => '',
                'variant'        => '',
                'font-size'      => '',
                'line-height'    => '',
                'letter-spacing' => '0',
                'color'          => '',
                'text-transform' => 'none',
            ),
            'output'      => array(
                array(
                    'element' => 'h3, .h3, .elementor-widget-heading h3.elementor-heading-title',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'heading4_typo' => array(
            'type'     => 'typography',
            'label'    => esc_html__('Heading 4', 'travexia'),
            'section'  => 'typography',
            'priority' => 6,
            'default'  => array(
                'font-family'    => '',
                'variant'        => '',
                'font-size'      => '',
                'line-height'    => '',
                'letter-spacing' => '0',
                'color'          => '',
                'text-transform' => 'none',
            ),
            'output'      => array(
                array(
                    'element' => 'h4, .h4, .elementor-widget-heading h4.elementor-heading-title',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'heading5_typo' => array(
            'type'     => 'typography',
            'label'    => esc_html__('Heading 5', 'travexia'),
            'section'  => 'typography',
            'priority' => 7,
            'default'  => array(
                'font-family'    => '',
                'variant'        => '',
                'font-size'      => '',
                'line-height'    => '',
                'letter-spacing' => '0',
                'text-transform' => 'none',
            ),
            'output'      => array(
                array(
                    'element' => 'h5, .h5, .elementor-widget-heading h5.elementor-heading-title',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'heading6_typo' => array(
            'type'     => 'typography',
            'label'    => esc_html__('Heading 6', 'travexia'),
            'section'  => 'typography',
            'priority' => 8,
            'default'  => array(
                'font-family'    => '',
                'variant'        => '',
                'font-size'      => '',
                'line-height'    => '',
                'letter-spacing' => '0',
                'color'          => '',
                'text-transform' => 'h6',
            ),
            'output'      => array(
                array(
                    'element' => 'h6, .h6, .elementor-widget-heading h6.elementor-heading-title',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),

        /* 404 */
        'custom_404'      => array(
            'type'        => 'toggle',
            'label'       => esc_html__('Customize?', 'travexia'),
            'section'     => 'error_404',
            'default'     => 0,
            'priority'    => 3,
        ),
        'page_404'         => array(
            'type'        => 'dropdown-pages',
            'label'       => esc_attr__('Select Page', 'travexia'),
            'description' => esc_attr__('Choose a template in pages.', 'travexia'),
            'section'     => 'error_404',
            'default'     => '',
            'priority'    => 3,
            'active_callback' => array(
                array(
                    'setting'  => 'custom_404',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),

        /* post slug */
        'service_slug'  => array(
            'type'        => 'text',
            'label'       => esc_html__('Service Slug', 'travexia'),
            'section'     => 'post_slug',
            'default'     => esc_html__('service', 'travexia'),
            'priority'    => 10,
        ),
        'portfolio_slug'  => array(
            'type'        => 'text',
            'label'       => esc_html__('Portfolio Slug', 'travexia'),
            'section'     => 'post_slug',
            'default'     => esc_html__('portfolio', 'travexia'),
            'priority'    => 10,
        ),

        /*color scheme*/
        'bg_body'      => array(
            'type'     => 'color',
            'label'    => esc_html__('Background Body', 'travexia'),
            'section'  => 'color_scheme',
            'default'  => '',
            'priority' => 10,
            'output'   => array(
                array(
                    'element'  => 'body, .site-content',
                    'property' => 'background-color',
                ),
            ),
        ),
        'main_color'   => array(
            'type'     => 'color',
            'label'    => esc_html__('Primary Color', 'travexia'),
            'section'  => 'color_scheme',
            'default'  => '',
            'priority' => 10,
        ),

    );
    $settings['panels']   = apply_filters('travexia_customize_panels', $panels);
    $settings['sections'] = apply_filters('travexia_customize_sections', $sections);
    $settings['fields']   = apply_filters('travexia_customize_fields', $fields);

    return $settings;
}

$travexia_customize = new Travexia_Customize(travexia_customize_settings());

require get_template_directory() . '/inc/backend/customizer/customizer-header.php';
require get_template_directory() . '/inc/backend/customizer/customizer-page-header.php';
require get_template_directory() . '/inc/backend/customizer/customizer-footer.php';
require get_template_directory() . '/inc/backend/customizer/customizer-blog.php';
require get_template_directory() . '/inc/backend/customizer/customizer-shop.php';
