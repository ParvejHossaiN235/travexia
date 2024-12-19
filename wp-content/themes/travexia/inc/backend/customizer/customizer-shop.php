<?php

function hexa_shop_customize_settings()
{
    /**
     * Customizer configuration
     */

    $settings = array(
        'theme' => HEXA_THEME_SLUG,
    );

    $panels = array();

    $sections = array(
        'single_product'  => array(
            'title'       => esc_html__('Single Product', 'hexa-theme'),
            'description' => '',
            'priority'    => 16,
            'capability'  => 'edit_theme_options',
            'panel'       => 'woocommerce',
        ),
    );

    $fields = array(
        // Shop Page
        'shop_layout'     => array(
            'type'        => 'select',
            'label'       => esc_html__('Shop Layout', 'hexa-theme'),
            'section'     => 'woocommerce_product_catalog',
            'default'     => 'left-sidebar',
            'priority'    => 7,
            'description' => esc_html__('Select default sidebar for the shop page.', 'hexa-theme'),
            'choices'     => array(
                'left-sidebar' => esc_attr__('Left Sidebar', 'hexa-theme'),
                'flex-row-reverse' => esc_attr__('Right Sidebar', 'hexa-theme'),
            )
        ),

        // Single Product Page
        'page_title_product'    => array(
            'type'     => 'text',
            'label'    => esc_html__('Title Page Header', 'hexa-theme'),
            'section'  => 'single_product',
            'default'  => esc_html__('Shop Single', 'hexa-theme'),
            'priority' => 1,
        ),
    );

    $settings['panels']   = apply_filters('hexa_customize_panels', $panels);
    $settings['sections'] = apply_filters('hexa_customize_sections', $sections);
    $settings['fields']   = apply_filters('hexa_customize_fields', $fields);

    return $settings;
}

$hexa_customize = new Hexa_Customize(hexa_shop_customize_settings());
