<?php
function blog_customize_settings()
{
	/**
	 * Customizer configuration
	 */

	$settings = array(
		'theme' => TRAVEXIA_THEME_SLUG,
	);

	$panels = array(
		'blog'        => array(
			'title'      => esc_html__('Blog', 'travexia'),
			'priority'   => 10,
			'capability' => 'edit_theme_options',
		),
	);

	$sections = array(
		'blog_page'           => array(
			'title'       => esc_html__('Blog Page', 'travexia'),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'blog',
		),
		'single_post'           => array(
			'title'       => esc_html__('Single Post', 'travexia'),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'blog',
		),
	);

	$fields = array(
		/* blog settings */
		'blog_layout'     => array(
			'type'        => 'select',
			'label'       => esc_html__('Sidebar Layout', 'travexia'),
			'section'     => 'blog_page',
			'default'     => 'right-sidebar',
			'priority'    => 7,
			'description' => esc_html__('Select default sidebar for the blog page.', 'travexia'),
			'choices'     => array(
				'right-sidebar' => esc_attr__('Right Sidebar', 'travexia'),
				'flex-row-reverse' => esc_attr__('Left Sidebar', 'travexia'),
			)
		),
		'blog_style'      => array(
			'type'        => 'select',
			'label'       => esc_html__('Post Style', 'travexia'),
			'section'     => 'blog_page',
			'default'     => 'list',
			'priority'    => 8,
			'description' => esc_html__('Select style default for the blog page.', 'travexia'),
			'choices'     => array(
				'list' => esc_attr__('Post List', 'travexia'),
				'grid' => esc_attr__('Post Grid', 'travexia'),
			),
		),
		'blog_columns'           => array(
			'type'        => 'select',
			'label'       => esc_html__('Post Columns', 'travexia'),
			'section'     => 'blog_page',
			'default'     => 'grid_2_cols',
			'priority'    => 8,
			'description' => esc_html__('Select columns default for the blog page.', 'travexia'),
			'choices'     => array(
				'grid_2_cols' => esc_attr__('2 Columns', 'travexia'),
				'grid_3_cols' => esc_attr__('3 Columns', 'travexia'),
				'grid_4_cols' => esc_attr__('4 Columns', 'travexia'),
			),
			'active_callback' => array(
				array(
					'setting'  => 'blog_style',
					'operator' => '==',
					'value'    => 'grid',
				),
			),
		),
		'page_separator1'     => array(
			'type'        => 'custom',
			'label'       => esc_html__('Post Meta', 'travexia'),
			'section'     => 'blog_page',
			'default'     => '<hr>',
			'priority'    => 10,
		),
		'blog_author'    => array(
			'type'        => 'checkbox',
			'label'       => esc_attr__('Author', 'travexia'),
			'section'     => 'blog_page',
			'default'     => true,
			'priority'    => 10,
		),
		'blog_date'    => array(
			'type'        => 'checkbox',
			'label'       => esc_attr__('Date', 'travexia'),
			'section'     => 'blog_page',
			'default'     => true,
			'priority'    => 10,
		),
		'blog_comments'    => array(
			'type'        => 'checkbox',
			'label'       => esc_attr__('Comments', 'travexia'),
			'section'     => 'blog_page',
			'default'     => true,
			'priority'    => 10,
		),
		'blog_cat'    => array(
			'type'        => 'checkbox',
			'label'       => esc_attr__('Category', 'travexia'),
			'section'     => 'blog_page',
			'default'     => false,
			'priority'    => 10,
		),
		'excerpt_length'  => array(
			'type'        => 'number',
			'label'       => esc_html__('Excerpt Length', 'travexia'),
			'section'     => 'blog_page',
			'default'     => 30,
			'priority'    => 10,
		),
		'post_read_more'  => array(
			'type'        => 'text',
			'label'       => esc_html__('Post Button', 'travexia'),
			'section'     => 'blog_page',
			'default'     => esc_html__('Read More', 'travexia'),
			'priority'    => 10,
		),
		'post_btn_show'     => array(
			'type'        => 'checkbox',
			'label'       => esc_attr__('Button On/Off', 'travexia'),
			'section'     => 'blog_page',
			'default'     => true,
			'priority'    => 10,
		),
		'single_post_layout' => array(
			'type'        => 'select',
			'label'       => esc_html__('Sidebar Layout', 'travexia'),
			'section'     => 'single_post',
			'default'     => 'right-sidebar',
			'description' => esc_html__('Select default sidebar for the single post.', 'travexia'),
			'priority'    => 10,
			'choices'     => array(
				'right-sidebar' => esc_attr__('Right Sidebar', 'travexia'),
				'flex-row-reverse' => esc_attr__('Left Sidebar', 'travexia'),
			)
		),
		'single_separator2'     => array(
			'type'        => 'custom',
			'label'       => esc_html__('Social Share', 'travexia'),
			'section'     => 'single_post',
			'default'     => '<hr>',
			'priority'    => 10,
		),
		'post_socials'              => array(
			'type'     => 'multicheck',
			'section'  => 'single_post',
			'default'  => array(),
			'choices'  => array(
				'twit'  	=> esc_html__('Twitter', 'travexia'),
				'face'    	=> esc_html__('Facebook', 'travexia'),
				'link'     	=> esc_html__('Linkedin', 'travexia'),
				'google'  	=> esc_html__('Google Plus', 'travexia'),
				'tumblr'    => esc_html__('Tumblr', 'travexia'),
				'reddit'    => esc_html__('Reddit', 'travexia'),
				'vk'     	=> esc_html__('VK', 'travexia'),
			),
			'priority' => 10,
		),
		'single_separator3'     => array(
			'type'        => 'custom',
			'label'       => esc_html__('Entry Footer', 'travexia'),
			'section'     => 'single_post',
			'default'     => '<hr>',
			'priority'    => 10,
		),
		'author_box'      => array(
			'type'        => 'checkbox',
			'label'       => esc_attr__('Author Info Box', 'travexia'),
			'section'     => 'single_post',
			'default'     => false,
			'priority'    => 10,
		),
		'post_nav'     => array(
			'type'        => 'checkbox',
			'label'       => esc_attr__('Post Navigation', 'travexia'),
			'section'     => 'single_post',
			'default'     => false,
			'priority'    => 10,
		),
		'related_post'    => array(
			'type'        => 'checkbox',
			'label'       => esc_attr__('Related Posts', 'travexia'),
			'section'     => 'single_post',
			'default'     => false,
			'priority'    => 10,
		),

	);

	$settings['panels']   = apply_filters('travexia_customize_panels', $panels);
	$settings['sections'] = apply_filters('travexia_customize_sections', $sections);
	$settings['fields']   = apply_filters('travexia_customize_fields', $fields);

	return $settings;
}

$travexia_customize = new Travexia_Customize(blog_customize_settings());
