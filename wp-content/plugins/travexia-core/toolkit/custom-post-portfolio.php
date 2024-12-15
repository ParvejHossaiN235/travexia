<?php
class HexaPortfoliosPost
{
	function __construct()
	{
		add_action('init', array($this, 'register_custom_post_type'));
		add_action('init', array($this, 'create_cat'));
		add_filter('template_include', array($this, 'portfolios_template_include'));
	}

	public function portfolios_template_include($template)
	{
		if (is_singular('hexa_portfolio')) {
			return $this->get_template('single-hexa_portfolio.php');
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
		$hexa_portfolios_slug = get_theme_mod('hexa_portfolios_slug', __('portfolios', 'hexacore'));
		$labels = array(
			'name'                  => esc_html_x('Portfolios', 'Post Type General Name', 'hexacore'),
			'singular_name'         => esc_html_x('Portfolio', 'Post Type Singular Name', 'hexacore'),
			'menu_name'             => esc_html__('Portfolios', 'hexacore'),
			'name_admin_bar'        => esc_html__('Portfolios', 'hexacore'),
			'archives'              => esc_html__('Item Archives', 'hexacore'),
			'parent_item_colon'     => esc_html__('Parent Item:', 'hexacore'),
			'all_items'             => esc_html__('All Portfolio', 'hexacore'),
			'add_new_item'          => esc_html__('Add New Portfolio', 'hexacore'),
			'add_new'               => esc_html__('Add New', 'hexacore'),
			'new_item'              => esc_html__('New Portfolio', 'hexacore'),
			'edit_item'             => esc_html__('Edit Portfolio', 'hexacore'),
			'update_item'           => esc_html__('Update Portfolio', 'hexacore'),
			'view_item'             => esc_html__('View Portfolio', 'hexacore'),
			'search_items'          => esc_html__('Search Portfolio', 'hexacore'),
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
			'label'                 => esc_html__('Portfolio', 'hexacore'),
			'labels'                => $labels,
			'supports'              => ['title', 'editor', 'thumbnail', 'elementor'],
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 6,
			'menu_icon'   			=> 'dashicons-portfolio',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
			'rewrite' => array(
				'slug' => $hexa_portfolios_slug,
				'with_front' => false
			),
		);

		register_post_type('hexa_portfolio', $args);
	}

	public function create_cat()
	{
		$labels = array(
			'name'                       => esc_html_x('Portfolio Categories', 'Taxonomy General Name', 'hexacore'),
			'singular_name'              => esc_html_x('Portfolio Categories', 'Taxonomy Singular Name', 'hexacore'),
			'menu_name'                  => esc_html__('Portfolio Categories', 'hexacore'),
			'all_items'                  => esc_html__('All Portfolio Category', 'hexacore'),
			'parent_item'                => esc_html__('Parent Item', 'hexacore'),
			'parent_item_colon'          => esc_html__('Parent Item:', 'hexacore'),
			'new_item_name'              => esc_html__('New Portfolio Category Name', 'hexacore'),
			'add_new_item'               => esc_html__('Add New Portfolio Category', 'hexacore'),
			'edit_item'                  => esc_html__('Edit Portfolio Category', 'hexacore'),
			'update_item'                => esc_html__('Update Portfolio Category', 'hexacore'),
			'view_item'                  => esc_html__('View Portfolio Category', 'hexacore'),
			'separate_items_with_commas' => esc_html__('Separate items with commas', 'hexacore'),
			'add_or_remove_items'        => esc_html__('Add or remove items', 'hexacore'),
			'choose_from_most_used'      => esc_html__('Choose from the most used', 'hexacore'),
			'popular_items'              => esc_html__('Popular Portfolio Category', 'hexacore'),
			'search_items'               => esc_html__('Search Portfolio Category', 'hexacore'),
			'not_found'                  => esc_html__('Not Found', 'hexacore'),
			'no_terms'                   => esc_html__('No Portfolio Category', 'hexacore'),
			'items_list'                 => esc_html__('Portfolio Category list', 'hexacore'),
			'items_list_navigation'      => esc_html__('Portfolio Category list navigation', 'hexacore'),
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

		register_taxonomy('portfolio_cat', 'hexa_portfolio', $args);
	}
}

new HexaPortfoliosPost();
