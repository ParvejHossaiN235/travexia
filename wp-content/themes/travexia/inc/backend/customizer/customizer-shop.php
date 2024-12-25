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
        'product_options'  => array(
            'title'       => esc_html__('Product Options', 'hexa-theme'),
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

        // Product options
        'products_per_page'    => array(
            'type'     => 'number',
            'label'    => esc_html__('Products Per Page', 'hexa-theme'),
            'section'  => 'product_options',
            'default'  => esc_html__('24', 'hexa-theme'),
            'priority' => 10,
        ),
        'product_columns_lg'   => array(
            'type'          => 'select',
            'label'         => esc_html__('Product Columns for Large Screen', 'hexa-theme'),
            'section'       => 'product_options',
            'default'       => '3',
            'priority'      => 10,
            'choices'       => array(
                '1'      => '1',
                '2'      => '2',
                '3'      => '3',
                '4'      => '4',
                '5'      => '5',
                '6'      => '6',
            ),
        ),
        'product_columns_md'   => array(
            'type'          => 'select',
            'label'         => esc_html__('Product Columns for Medium Screen', 'hexa-theme'),
            'section'       => 'product_options',
            'default'       => '3',
            'priority'      => 10,
            'choices'       => array(
                '1'      => '1',
                '2'      => '2',
                '3'      => '3',
                '4'      => '4',
                '5'      => '5',
                '6'      => '6',
            ),
        ),
        'product_columns_sm'   => array(
            'type'          => 'select',
            'label'         => esc_html__('Product Columns for Small Screen', 'hexa-theme'),
            'section'       => 'product_options',
            'default'       => '2',
            'priority'      => 10,
            'choices'       => array(
                '1'      => '1',
                '2'      => '2',
                '3'      => '3',
                '4'      => '4',
                '5'      => '5',
                '6'      => '6',
            ),
        ),
        'product_columns_xs'   => array(
            'type'          => 'select',
            'label'         => esc_html__('Product Columns for Extra Small Screen', 'hexa-theme'),
            'section'       => 'product_options',
            'default'       => '1',
            'priority'      => 10,
            'choices'       => array(
                '1'      => '1',
                '2'      => '2',
                '3'      => '3',
                '4'      => '4',
                '5'      => '5',
                '6'      => '6',
            ),
        ),
    );

    $settings['panels']   = apply_filters('hexa_customize_panels', $panels);
    $settings['sections'] = apply_filters('hexa_customize_sections', $sections);
    $settings['fields']   = apply_filters('hexa_customize_fields', $fields);

    return $settings;
}

$hexa_customize = new Hexa_Customize(hexa_shop_customize_settings());
