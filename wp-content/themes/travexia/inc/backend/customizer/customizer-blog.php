<?php
function blog_customize_settings()
{
	/**
	 * Customizer configuration
	 */

	$settings = array(
		'theme' => HEXA_THEME_SLUG,
	);

	$panels = array(
		'blog'        => array(
			'title'      => esc_html__('Blog', 'hexa-theme'),
			'priority'   => 10,
			'capability' => 'edit_theme_options',
		),
	);

	$sections = array(
		'blog_page'           => array(
			'title'       => esc_html__('Blog Page', 'hexa-theme'),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'blog',
		),
		'single_post'           => array(
			'title'       => esc_html__('Single Post', 'hexa-theme'),
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
			'label'       => esc_html__('Sidebar Layout', 'hexa-theme'),
			'section'     => 'blog_page',
			'default'     => 'right-sidebar',
			'priority'    => 7,
			'description' => esc_html__('Select default sidebar for the blog page.', 'hexa-theme'),
			'choices'     => array(
				'right-sidebar' => esc_attr__('Right Sidebar', 'hexa-theme'),
				'flex-row-reverse' => esc_attr__('Left Sidebar', 'hexa-theme'),
			)
		),
		'blog_style'      => array(
			'type'        => 'select',
			'label'       => esc_html__('Post Style', 'hexa-theme'),
			'section'     => 'blog_page',
			'default'     => 'list',
			'priority'    => 8,
			'description' => esc_html__('Select style default for the blog page.', 'hexa-theme'),
			'choices'     => array(
				'list' => esc_attr__('Post List', 'hexa-theme'),
				'grid' => esc_attr__('Post Grid', 'hexa-theme'),
			),
		),
		'blog_columns'           => array(
			'type'        => 'select',
			'label'       => esc_html__('Post Columns', 'hexa-theme'),
			'section'     => 'blog_page',
			'default'     => 'grid_2_cols',
			'priority'    => 8,
			'description' => esc_html__('Select columns default for the blog page.', 'hexa-theme'),
			'choices'     => array(
				'grid_2_cols' => esc_attr__('2 Columns', 'hexa-theme'),
				'grid_3_cols' => esc_attr__('3 Columns', 'hexa-theme'),
				'grid_4_cols' => esc_attr__('4 Columns', 'hexa-theme'),
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
			'label'       => esc_html__('Post Meta', 'hexa-theme'),
			'section'     => 'blog_page',
			'default'     => '<hr>',
			'priority'    => 10,
		),
		'blog_author'    => array(
			'type'        => 'checkbox',
			'label'       => esc_attr__('Author', 'hexa-theme'),
			'section'     => 'blog_page',
			'default'     => true,
			'priority'    => 10,
		),
		'blog_date'    => array(
			'type'        => 'checkbox',
			'label'       => esc_attr__('Date', 'hexa-theme'),
			'section'     => 'blog_page',
			'default'     => true,
			'priority'    => 10,
		),
		'blog_comments'    => array(
			'type'        => 'checkbox',
			'label'       => esc_attr__('Comments', 'hexa-theme'),
			'section'     => 'blog_page',
			'default'     => true,
			'priority'    => 10,
		),
		'blog_cat'    => array(
			'type'        => 'checkbox',
			'label'       => esc_attr__('Category', 'hexa-theme'),
			'section'     => 'blog_page',
			'default'     => false,
			'priority'    => 10,
		),
		'excerpt_length'  => array(
			'type'        => 'number',
			'label'       => esc_html__('Excerpt Length', 'hexa-theme'),
			'section'     => 'blog_page',
			'default'     => 30,
			'priority'    => 10,
		),
		'post_read_more'  => array(
			'type'        => 'text',
			'label'       => esc_html__('Post Button', 'hexa-theme'),
			'section'     => 'blog_page',
			'default'     => esc_html__('Read More', 'hexa-theme'),
			'priority'    => 10,
		),
		'post_btn_show'     => array(
			'type'        => 'checkbox',
			'label'       => esc_attr__('Button On/Off', 'hexa-theme'),
			'section'     => 'blog_page',
			'default'     => true,
			'priority'    => 10,
		),
		'single_post_layout' => array(
			'type'        => 'select',
			'label'       => esc_html__('Sidebar Layout', 'hexa-theme'),
			'section'     => 'single_post',
			'default'     => 'right-sidebar',
			'description' => esc_html__('Select default sidebar for the single post.', 'hexa-theme'),
			'priority'    => 10,
			'choices'     => array(
				'right-sidebar' => esc_attr__('Right Sidebar', 'hexa-theme'),
				'flex-row-reverse' => esc_attr__('Left Sidebar', 'hexa-theme'),
			)
		),
		'single_post_style' => array(
			'type'        => 'select',
			'label'       => esc_html__('Single Post Style', 'hexa-theme'),
			'section'     => 'single_post',
			'default'     => 'style_1',
			'priority'    => 10,
			'choices'     => array(
				'style_1' => esc_attr__('Style 1', 'hexa-theme'),
				'style_2' => esc_attr__('Style 2', 'hexa-theme'),
				'style_3' => esc_attr__('Style 3', 'hexa-theme'),
			)
		),
		'single_separator2'     => array(
			'type'        => 'custom',
			'label'       => esc_html__('Social Share', 'hexa-theme'),
			'section'     => 'single_post',
			'default'     => '<hr>',
			'priority'    => 10,
		),
		'post_socials'              => array(
			'type'     => 'multicheck',
			'section'  => 'single_post',
			'default'  => array(),
			'choices'  => array(
				'twit'  	=> esc_html__('Twitter', 'hexa-theme'),
				'face'    	=> esc_html__('Facebook', 'hexa-theme'),
				'link'     	=> esc_html__('Linkedin', 'hexa-theme'),
				'google'  	=> esc_html__('Google Plus', 'hexa-theme'),
				'tumblr'    => esc_html__('Tumblr', 'hexa-theme'),
				'reddit'    => esc_html__('Reddit', 'hexa-theme'),
				'vk'     	=> esc_html__('VK', 'hexa-theme'),
			),
			'priority' => 10,
		),
		'single_separator3'     => array(
			'type'        => 'custom',
			'label'       => esc_html__('Entry Footer', 'hexa-theme'),
			'section'     => 'single_post',
			'default'     => '<hr>',
			'priority'    => 10,
		),
		'author_box'      => array(
			'type'        => 'checkbox',
			'label'       => esc_attr__('Author Info Box', 'hexa-theme'),
			'section'     => 'single_post',
			'default'     => false,
			'priority'    => 10,
		),
		'post_nav'     => array(
			'type'        => 'checkbox',
			'label'       => esc_attr__('Post Navigation', 'hexa-theme'),
			'section'     => 'single_post',
			'default'     => false,
			'priority'    => 10,
		),
		'related_post'    => array(
			'type'        => 'checkbox',
			'label'       => esc_attr__('Related Posts', 'hexa-theme'),
			'section'     => 'single_post',
			'default'     => false,
			'priority'    => 10,
		),

	);

	$settings['panels']   = apply_filters('hexa_customize_panels', $panels);
	$settings['sections'] = apply_filters('hexa_customize_sections', $sections);
	$settings['fields']   = apply_filters('hexa_customize_fields', $fields);

	return $settings;
}

$hexa_customize = new Hexa_Customize(blog_customize_settings());
