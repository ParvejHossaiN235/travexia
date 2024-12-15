<?php
class HexaServicesPost
{
	function __construct()
	{
		add_action('init', array($this, 'register_custom_post_type'));
		add_action('init', array($this, 'create_cat'));
		add_filter('template_include', array($this, 'services_template_include'));
	}

	public function services_template_include($template)
	{
		if (is_singular('hexa_service')) {
			return $this->get_template('single-hexa_service.php');
		}
		return $template;
	}

	public function get_template($template)
	{
		if ($theme_file = locate_template(array($template))) {
			$file = $theme_file;
		} else {
			$file = HEXACORE_ADDONS_DIR . '/template/' . $template;
		}
		return apply_filters(__FUNCTION__, $file, $template);
	}


	public function register_custom_post_type()
	{
		$hexa_services_slug = get_theme_mod('hexa_service_slug', __('services', 'hexacore'));
		$labels = array(
			'name'                  => esc_html_x('Services', 'Post Type General Name', 'hexacore'),
			'singular_name'         => esc_html_x('Service', 'Post Type Singular Name', 'hexacore'),
			'menu_name'             => esc_html__('Services', 'hexacore'),
			'name_admin_bar'        => esc_html__('Services', 'hexacore'),
			'archives'              => esc_html__('Item Archives', 'hexacore'),
			'parent_item_colon'     => esc_html__('Parent Item:', 'hexacore'),
			'all_items'             => esc_html__('All Service', 'hexacore'),
			'add_new_item'          => esc_html__('Add New Service', 'hexacore'),
			'add_new'               => esc_html__('Add New', 'hexacore'),
			'new_item'              => esc_html__('New Item', 'hexacore'),
			'edit_item'             => esc_html__('Edit Item', 'hexacore'),
			'update_item'           => esc_html__('Update Item', 'hexacore'),
			'view_item'             => esc_html__('View Item', 'hexacore'),
			'search_items'          => esc_html__('Search Item', 'hexacore'),
			'not_found'             => esc_html__('Not found', 'hexacore'),
			'not_found_in_trash'    => esc_html__('Not found in Trash', 'hexacore'),
			'featured_image'        => esc_html__('Featured Image', 'hexacore'),
			'set_featured_image'    => esc_html__('Set featured image', 'hexacore'),
			'remove_featured_image' => esc_html__('Remove featured image', 'hexacore'),
			'use_featured_image'    => esc_html__('Use as featured image', 'hexacore'),
			'inserbt_into_item'     => esc_html__('Insert into item', 'hexacore'),
			'uploaded_to_this_item' => esc_html__('Uploaded to this item', 'hexacore'),
			'items_list'            => esc_html__('Items list', 'hexacore'),
			'items_list_navigation' => esc_html__('Items list navigation', 'hexacore'),
			'filter_items_list'     => esc_html__('Filter items list', 'hexacore'),
		);

		$args   = array(
			'label'                 => esc_html__('Service', 'hexacore'),
			'labels'                => $labels,
			'supports'              => ['title', 'editor', 'thumbnail', 'elementor'],
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 7,
			'menu_icon'   			=> 'dashicons-shield',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
			'rewrite' => array(
				'slug' => $hexa_services_slug,
				'with_front' => false
			),
		);

		register_post_type('hexa_service', $args);
	}

	public function create_cat()
	{
		$labels = array(
			'name'                       => esc_html_x('Service Categories', 'Taxonomy General Name', 'hexacore'),
			'singular_name'              => esc_html_x('Service Categories', 'Taxonomy Singular Name', 'hexacore'),
			'menu_name'                  => esc_html__('Service Categories', 'hexacore'),
			'all_items'                  => esc_html__('All Service Category', 'hexacore'),
			'parent_item'                => esc_html__('Parent Item', 'hexacore'),
			'parent_item_colon'          => esc_html__('Parent Item:', 'hexacore'),
			'new_item_name'              => esc_html__('New Service Category Name', 'hexacore'),
			'add_new_item'               => esc_html__('Add New Service Category', 'hexacore'),
			'edit_item'                  => esc_html__('Edit Service Category', 'hexacore'),
			'update_item'                => esc_html__('Update Service Category', 'hexacore'),
			'view_item'                  => esc_html__('View Service Category', 'hexacore'),
			'separate_items_with_commas' => esc_html__('Separate items with commas', 'hexacore'),
			'add_or_remove_items'        => esc_html__('Add or remove items', 'hexacore'),
			'choose_from_most_used'      => esc_html__('Choose from the most used', 'hexacore'),
			'popular_items'              => esc_html__('Popular Service Category', 'hexacore'),
			'search_items'               => esc_html__('Search Service Category', 'hexacore'),
			'not_found'                  => esc_html__('Not Found', 'hexacore'),
			'no_terms'                   => esc_html__('No Service Category', 'hexacore'),
			'items_list'                 => esc_html__('Service Category list', 'hexacore'),
			'items_list_navigation'      => esc_html__('Service Category list navigation', 'hexacore'),
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);

		register_taxonomy('service_cat', 'hexa_service', $args);
	}
}

new HexaServicesPost();
