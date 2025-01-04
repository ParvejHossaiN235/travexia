<?php
function footer_customize_settings()
{
	/**
	 * Customizer configuration
	 */

	$settings = array(
		'theme' => TRAVEXIA_THEME_SLUG,
	);

	$sections = array(
		// Footer Customize Panel
		'footer'         => array(
			'title'      => esc_html__('Footer', 'travexia'),
			'priority'   => 10,
			'capability' => 'edit_theme_options',
		),
	);

	$fields = array(
		/* footer settings */
		'footer_layout'     => array(
			'type'        => 'select',
			'label'       => esc_attr__('Select Footer', 'travexia'),
			'description' => esc_attr__('Choose a footer for all site here.', 'travexia'),
			'section'     => 'footer',
			'default'     => '',
			'priority'    => 1,
			'placeholder' => esc_attr__('Select a footer', 'travexia'),
			'choices'     => (class_exists('Kirki_Helper')) ? Kirki_Helper::get_posts(array('post_type' => 'hexa_footer', 'posts_per_page' => -1)) : array(),
		),
		'backtotop_separator'     => array(
			'type'        => 'custom',
			'label'       => '',
			'section'     => 'footer',
			'default'     => '<hr>',
			'priority'    => 2,
		),
		'back_to_top'  => array(
			'type'        => 'toggle',
			'label'       => esc_html__('Back To Top On/Off?', 'travexia'),
			'section'     => 'footer',
			'default'     => false,
			'priority'    => 3,
		),
		'color_backtotop' => array(
			'type'     => 'color',
			'label'    => esc_html__('Color', 'travexia'),
			'section'  => 'footer',
			'priority' => 5,
			'default'     => '',
			'output'    => array(
				array(
					'element'  => '.progress-wrap:after',
					'property' => 'color',
				),
				array(
					'element'  => '.progress-wrap svg.progress-circle path',
					'property' => 'stroke',
				)
			),
			'active_callback' => array(
				array(
					'setting'  => 'backtotop',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'spacing_backtotop' => array(
			'type'     => 'dimensions',
			'label'    => esc_html__('Spacing', 'travexia'),
			'section'  => 'footer',
			'priority' => 6,
			'default'     => array(
				'bottom'  => '',
				'right' => '',
			),
			'choices'     => array(
				'labels' => array(
					'bottom'  => esc_html__('Bottom (Ex: 20px)', 'travexia'),
					'right'   => esc_html__('Right (Ex: 20px)', 'travexia'),
				),
			),
			'output'    => array(
				array(
					'choice'      => 'bottom',
					'element'     => '.progress-wrap',
					'property'    => 'bottom',
				),
				array(
					'choice'      => 'right',
					'element'     => '.progress-wrap',
					'property'    => 'right',
				),
			),
			'active_callback' => array(
				array(
					'setting'  => 'backtotop',
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

$travexia_customize = new Travexia_Customize(footer_customize_settings());
