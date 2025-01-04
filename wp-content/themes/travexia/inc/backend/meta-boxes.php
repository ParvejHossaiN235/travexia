<?php

/**
 * Registering meta boxes
 *
 * Using Meta Box plugin: http://www.deluxeblogtips.com/meta-box/
 *
 * @see https://docs.metabox.io/
 *
 * @param array $meta_boxes Default meta boxes. By default, there are no meta boxes.
 *
 * @return array All registered meta boxes
 */
function travexia_register_meta_boxes($meta_boxes)
{
	// Page Settings
	$meta_boxes[] = array(
		'id'       => 'page-settings',
		'title'    => esc_html__('Page Settings', 'travexia'),
		'pages'    => array('page', 'post'),
		'context'  => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields'   => array(
			array(
				'name'             => esc_html__('Page Header On/Off', 'travexia'),
				'id'               => 'pheader_switch',
				'type'             => 'switch',
				'style'            => 'rounded',
				'on_label'         => 'On',
				'off_label'        => 'Off',
				'std'              => 'on'
			),
			array(
				'name'             => esc_html__('Background Page Header', 'travexia'),
				'id'               => 'pheader_bg_image',
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			)
		),
	);

	$meta_boxes[] = array(
		'id'       => 'extra-settings',
		'title'    => esc_html__('Extra Settings', 'travexia'),
		'pages'    => array('hexa_portfolio', 'hexa_service', 'tf_tours'),
		'context'  => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields'   => array(
			array(
				'name'             => esc_html__('Page Header On/Off', 'travexia'),
				'id'               => 'pheader_switch',
				'type'             => 'switch',
				'style'            => 'rounded',
				'on_label'         => 'On',
				'off_label'        => 'Off',
				'std'              => 'on'
			),
			array(
				'name'             => esc_html__('Background Page Header', 'travexia'),
				'id'               => 'pheader_bg_image',
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			)
		),
	);
	$meta_boxes[] = array(
		'id' => 'select-header-footer',
		'title' => 'Header/Footer Settings',
		'pages' =>   array('page'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => false,
		'fields' =>   array(
			array(
				'name' 	=> 'Header Layout',
				'id' 	=> 'select_header',
				'type'  => 'post',
				'post_type'   => 'hexa_header',
				'field_type'  => 'select_advanced',
				'placeholder' => 'Select a header',
				'query_args'  => array(
					'post_status'    => 'publish',
					'posts_per_page' => -1,
					'orderby' 		 => 'date',
					'order' 		 => 'ASC',
				),
			),
			array(
				'name' => 'Footer Layout',
				'id' => 'select_footer',
				'type'        => 'post',
				'post_type'   => 'hexa_footer',
				'field_type'  => 'select_advanced',
				'placeholder' => 'Select a footer',
				'query_args'  => array(
					'post_status'    => 'publish',
					'posts_per_page' => -1,
					'orderby' => 'date',
					'order' => 'ASC',
				),
			),
		),
	);

	// Post format's meta box
	$meta_boxes[] = array(
		'id'       => 'format_detail',
		'title'    => esc_html__('Format Details', 'travexia'),
		'pages'    => array('post'),
		'context'  => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields'   => array(
			array(
				'name'             => esc_html__('Image', 'travexia'),
				'id'               => 'post_image',
				'type'             => 'image_advanced',
				'class'            => 'image',
				'max_file_uploads' => 1,
				// Image size that displays in the edit page. Possible sizes small,medium,large,original
				'image_size'       => 'thumbnail',
				'desc'  => 'You should upload only one image.',
			),
			array(
				'name'  => esc_html__('Gallery', 'travexia'),
				'id'    => 'post_gallery',
				'type'  => 'image_advanced',
				'class' => 'gallery',
				// Image size that displays in the edit page. Possible sizes small,medium,large,original
				'image_size'       => 'thumbnail',
			),
			array(
				'name'  => esc_html__('Audio', 'travexia'),
				'id'    => 'post_audio',
				'type'  => 'text',
				'class' => 'audio',
				'desc'  => 'Example: https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/139083759',
			),
			array(
				'name'  => esc_html__('Video', 'travexia'),
				'id'    => 'post_video',
				'type'  => 'text',
				'class' => 'video',
				'desc'  => 'Example: https://vimeo.com/87959439',
			),
			array(
				'name'  => esc_html__('Background Image', 'travexia'),
				'id'    => 'bg_video',
				'type'  => 'image_advanced',
				'class' => 'video',
				'desc'  => 'This image is only for the video background.',
				'max_file_uploads' => 1,
			),
			array(
				'name'  => esc_html__('Quote', 'travexia'),
				'id'    => 'post_quote',
				'type'  => 'textarea',
				'class' => 'quote',
			),
			array(
				'name'  => esc_html__('Quote Name', 'travexia'),
				'id'    => 'quote_name',
				'type'  => 'text',
				'class' => 'quote',
			)
		),
	);

	return $meta_boxes;
}

add_filter('rwmb_meta_boxes', 'travexia_register_meta_boxes');
