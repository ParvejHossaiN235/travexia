<?php

function travexia_shop_customize_settings()
{
    /**
     * Customizer configuration
     */

    $settings = array(
        'theme' => TRAVEXIA_THEME_SLUG,
    );

    $panels = array();

    $sections = array(
        'product_options'  => array(
            'title'       => esc_html__('Product Options', 'travexia'),
            'description' => '',
            'priority'    => 16,
            'capability'  => 'edit_theme_options',
            'panel'       => 'woocommerce',
        ),
    );

    $fields = array(
        // Product options
        'products_per_page'    => array(
            'type'     => 'number',
            'label'    => esc_html__('Products Per Page', 'travexia'),
            'section'  => 'product_options',
            'default'  => esc_html__('24', 'travexia'),
            'priority' => 10,
        ),
        'product_columns_lg'   => array(
            'type'          => 'select',
            'label'         => esc_html__('Product Columns for Large Screen', 'travexia'),
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
            'label'         => esc_html__('Product Columns for Medium Screen', 'travexia'),
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
            'label'         => esc_html__('Product Columns for Small Screen', 'travexia'),
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
            'label'         => esc_html__('Product Columns for Extra Small Screen', 'travexia'),
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

    $settings['panels']   = apply_filters('travexia_customize_panels', $panels);
    $settings['sections'] = apply_filters('travexia_customize_sections', $sections);
    $settings['fields']   = apply_filters('travexia_customize_fields', $fields);

    return $settings;
}

$travexia_customize = new Travexia_Customize(travexia_shop_customize_settings());
