<?php
function page_header_customize_settings()
{
    /**
     * Customizer configuration
     */

    $settings = array(
        'theme' => TRAVEXIA_THEME_SLUG,
    );

    $sections = array(
        'page_header'     => array(
            'title'       => esc_html__('Page Header', 'travexia'),
            'description' => '',
            'priority'    => 9,
            'capability'  => 'edit_theme_options',
        ),
    );

    $fields = array(
        /*page header */
        'pheader_switch'  => array(
            'type'        => 'toggle',
            'label'       => esc_html__('Page Header On/Off', 'travexia'),
            'section'     => 'page_header',
            'default'     => 1,
            'priority'    => 10,
        ),
        'breadcrumbs'     => array(
            'type'        => 'toggle',
            'label'       => esc_html__('Breadcrumbs On/Off', 'travexia'),
            'section'     => 'page_header',
            'default'     => 1,
            'priority'    => 10,
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'pheader_htmltag'   => array(
            'type'          => 'select',
            'label'         => esc_html__('Page Title HTML Tag', 'travexia'),
            'section'       => 'page_header',
            'default'       => 'h1',
            'priority'      => 10,
            'placeholder'   => esc_html__('Choose an html tag', 'travexia'),
            'choices'       => array(
                'h1'        => esc_html__('H1', 'travexia'),
                'h2'        => esc_html__('H2', 'travexia'),
                'h3'        => esc_html__('H3', 'travexia'),
                'h4'        => esc_html__('H4', 'travexia'),
                'h5'        => esc_html__('H5', 'travexia'),
                'h6'        => esc_html__('H6', 'travexia'),
                'span'      => esc_html__('SPAN', 'travexia'),
                'p'         => esc_html__('P', 'travexia'),
                'div'       => esc_html__('DIV', 'travexia'),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'pheader_align'    => array(
            'type'     => 'radio',
            'label'    => esc_html__('Text Align', 'travexia'),
            'section'  => 'page_header',
            'default'  => 'text-start',
            'priority' => 10,
            'choices'     => array(
                'text-start'     => esc_html__('Left', 'travexia'),
                'text-center'   => esc_html__('Center', 'travexia'),
                'text-end'    => esc_html__('Right', 'travexia'),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'pheader_img'  => array(
            'type'     => 'image',
            'label'    => esc_html__('Background Image', 'travexia'),
            'section'  => 'page_header',
            'default'  => get_template_directory_uri() . '/assets/img/breadcurmb/breadcurmb.jpg',
            'priority' => 10,
            'output'    => array(
                array(
                    'element'  => '.page-header',
                    'property' => 'background-image'
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'pheader_color'    => array(
            'type'     => 'color',
            'label'    => esc_html__('Background Color', 'travexia'),
            'section'  => 'page_header',
            'default'  => '#222',
            'priority' => 10,
            'output'    => array(
                array(
                    'element'  => '.page-header',
                    'property' => 'background-color'
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'ptitle_color'    => array(
            'type'     => 'color',
            'label'    => esc_html__('Title Color', 'travexia'),
            'section'  => 'page_header',
            'priority' => 10,
            'output'    => array(
                array(
                    'element'  => '.page-header .page-title',
                    'property' => 'color'
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'bread_color'    => array(
            'type'     => 'color',
            'label'    => esc_html__('Breadcrumbs Color', 'travexia'),
            'section'  => 'page_header',
            'priority' => 10,
            'output'    => array(
                array(
                    'element'  => '.page-header .breadcrumbs li, .page-header .breadcrumbs li a, .page-header .breadcrumbs li:after',
                    'property' => 'color'
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
                array(
                    'setting'  => 'breadcrumbs',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'bread_acolor'    => array(
            'type'     => 'color',
            'label'    => esc_html__('Breadcrumbs Hover Color', 'travexia'),
            'section'  => 'page_header',
            'priority' => 10,
            'output'    => array(
                array(
                    'element'  => '.page-header .breadcrumbs li.active, .page-header .breadcrumbs li a:hover,',
                    'property' => 'color'
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
                array(
                    'setting'  => 'breadcrumbs',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'pheader_height'  => array(
            'type'     => 'dimensions',
            'label'    => esc_html__('Page Header Padding (Ex: 100px)', 'travexia'),
            'section'  => 'page_header',
            'transport' => 'auto',
            'priority' => 10,
            'choices'   => array(
                'desktop' => esc_attr__('Desktop', 'travexia'),
                'tablet'  => esc_attr__('Tablet', 'travexia'),
                'mobile'  => esc_attr__('Mobile', 'travexia'),
            ),
            'output'   => array(
                array(
                    'choice'      => 'mobile',
                    'element'     => '.page-header',
                    'property'    => 'padding-top',
                    'media_query' => '@media (max-width: 767px)',
                ),
                array(
                    'choice'      => 'mobile',
                    'element'     => '.page-header',
                    'property'    => 'padding-bottom',
                    'media_query' => '@media (max-width: 767px)',
                ),
                array(
                    'choice'      => 'tablet',
                    'element'     => '.page-header',
                    'property'    => 'padding-top',
                    'media_query' => '@media (min-width: 768px) and (max-width: 1024px)',
                ),
                array(
                    'choice'      => 'tablet',
                    'element'     => '.page-header',
                    'property'    => 'padding-bottom',
                    'media_query' => '@media (min-width: 768px) and (max-width: 1024px)',
                ),
                array(
                    'choice'      => 'desktop',
                    'element'     => '.page-header',
                    'property'    => 'padding-top',
                    'media_query' => '@media (min-width: 1024px)',
                ),
                array(
                    'choice'      => 'desktop',
                    'element'     => '.page-header',
                    'property'    => 'padding-bottom',
                    'media_query' => '@media (min-width: 1024px)',
                ),
            ),
            'default' => array(
                'desktop' => '',
                'tablet'  => '',
                'mobile'  => '',
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'head_size'  => array(
            'type'     => 'dimensions',
            'label'    => esc_html__('Page Title Size (Ex: 30px)', 'travexia'),
            'section'  => 'page_header',
            'transport' => 'auto',
            'priority' => 10,
            'choices'   => array(
                'desktop' => esc_attr__('Desktop', 'travexia'),
                'tablet'  => esc_attr__('Tablet', 'travexia'),
                'mobile'  => esc_attr__('Mobile', 'travexia'),
            ),
            'output'   => array(
                array(
                    'choice'      => 'mobile',
                    'element'     => '.page-header .page-title',
                    'property'    => 'font-size',
                    'media_query' => '@media (max-width: 767px)',
                ),
                array(
                    'choice'      => 'tablet',
                    'element'     => '.page-header .page-title',
                    'property'    => 'font-size',
                    'media_query' => '@media (min-width: 768px) and (max-width: 1024px)',
                ),
                array(
                    'choice'      => 'desktop',
                    'element'     => '.page-header .page-title',
                    'property'    => 'font-size',
                    'media_query' => '@media (min-width: 1024px)',
                ),
            ),
            'default' => array(
                'desktop' => '',
                'tablet'  => '',
                'mobile'  => '',
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
    );

    $settings['sections'] = apply_filters('travexia_customize_sections', $sections);
    $settings['fields']   = apply_filters('travexia_customize_fields', $fields);

    return $settings;
}

$travexia_customize = new Travexia_Customize(page_header_customize_settings());
