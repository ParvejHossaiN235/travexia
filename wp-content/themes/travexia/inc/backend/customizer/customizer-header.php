<?php
function header_customize_settings()
{
	/**
	 * Customizer configuration
	 */

	$settings = array(
		'theme' => HEXA_THEME_SLUG,
	);

	$sections = array(
		'main_header'     => array(
			'title'       => esc_html__('Header', 'hexa-theme'),
			'description' => '',
			'priority'    => 8,
			'capability'  => 'edit_theme_options',
		),
	);

	$fields = array(
		/* header settings */
		'header_layout'   => array(
			'type'        => 'select',
			'label'       => esc_attr__('Select Header Desktop', 'hexa-theme'),
			'description' => esc_attr__('Choose the header on desktop.', 'hexa-theme'),
			'section'     => 'main_header',
			'default'     => '',
			'priority'    => 3,
			'placeholder' => esc_attr__('Select a header', 'hexa-theme'),
			'choices'     => (class_exists('Kirki_Helper')) ? Kirki_Helper::get_posts(array('post_type' => 'hexa_header', 'posts_per_page' => -1)) : array(),
		),
		'header_fixed'    => array(
			'type'        => 'toggle',
			'label'       => esc_html__('Header Transparent?', 'hexa-theme'),
			'description' => esc_attr__('Enable when your header is transparent.', 'hexa-theme'),
			'section'     => 'main_header',
			'default'     => '1',
			'priority'    => 4,
		),
		'header_mobile'   => array(
			'type'        => 'select',
			'label'       => esc_attr__('Select Header Mobile', 'hexa-theme'),
			'description' => esc_attr__('Choose the header on mobile.', 'hexa-theme'),
			'section'     => 'main_header',
			'default'     => '',
			'priority'    => 5,
			'placeholder' => esc_attr__('Select a header', 'hexa-theme'),
			'choices'     => (class_exists('Kirki_Helper')) ? Kirki_Helper::get_posts(array('post_type' => 'hexa_header', 'posts_per_page' => -1)) : array(),
		),
		'is_sidepanel'    => array(
			'type'        => 'toggle',
			'label'       => esc_html__('Side Panel for all site?', 'hexa-theme'),
			'section'     => 'main_header',
			'default'     => false,
			'priority'    => 6,
			'active_callback' => array(
				array(
					'setting'  => 'header_builder',
					'operator' => '=',
					'value'    => '1',
				),
			),
		),
		'side_logo'    => array(
			'type'        => 'image',
			'label'       => esc_html__('Side Panel Logo', 'hexa-theme'),
			'section'     => 'main_header',
			'default'     => '',
			'priority'    => 7,
			'active_callback' => array(
				array(
					'setting'  => 'is_sidepanel',
					'operator' => '!=',
					'value'    => '',
				),
			),
		),
		'side_logo_link'    => array(
			'type'        => 'url',
			'label'       => esc_html__('Side Logo link', 'hexa-theme'),
			'section'     => 'main_header',
			'default'     => '#',
			'priority'    => 8,
			'active_callback' => array(
				array(
					'setting'  => 'side_logo',
					'operator' => '!=',
					'value'    => '',
				),
			),
		),
		'sidepanel_layout'     => array(
			'type'        => 'select',
			'label'       => esc_attr__('Select Side Panel', 'hexa-theme'),
			'description' => esc_attr__('Choose the side panel on header.', 'hexa-theme'),
			'section'     => 'main_header',
			'default'     => '',
			'priority'    => 9,
			'placeholder' => esc_attr__('Select a panel', 'hexa-theme'),
			'choices'     => (class_exists('Kirki_Helper')) ? Kirki_Helper::get_posts(array('post_type' => 'hexa_header', 'posts_per_page' => -1)) : array(),
			'active_callback' => array(
				array(
					'setting'  => 'is_sidepanel',
					'operator' => '!=',
					'value'    => '',
				),
			),
		),
		'panel_left'     => array(
			'type'        => 'toggle',
			'label'       => esc_html__('Side Panel On Left', 'hexa-theme'),
			'section'     => 'main_header',
			'default'     => '0',
			'priority'    => 10,
			'active_callback' => array(
				array(
					'setting'  => 'is_sidepanel',
					'operator' => '!=',
					'value'    => '',
				),
				array(
					'setting'  => 'sidepanel_layout',
					'operator' => '!=',
					'value'    => '',
				),
			),
		),

	);

	$settings['sections'] = apply_filters('hexa_customize_sections', $sections);
	$settings['fields']   = apply_filters('hexa_customize_fields', $fields);

	return $settings;
}

$hexa_customize = new Hexa_Customize(header_customize_settings());
