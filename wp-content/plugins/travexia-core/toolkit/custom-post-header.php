<?php
class HexaHeaderPost
{

    private $type = 'hexa_header';
    private $slug;
    private $name;
    private $plural_name;

    public function __construct()
    {
        $this->name = __('Header Builder', 'hexacore');
        $this->slug = 'hexa_header';
        $this->plural_name = __('Header Builder', 'hexacore');

        add_action('init', array($this, 'register_custom_post_type'));
        add_filter('template_include', array($this, 'header_template_include'));
    }


    public function header_template_include($template)
    {
        if (is_singular('hexa_header')) {
            return $this->get_template('single-hexa_header.php');
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
        // $medidove_mem_slug = get_theme_mod('medidove_mem_slug','member'); 
        $labels = array(
            'name' => $this->name,
            'singular_name' => $this->name,
            'add_new' => sprintf(__('Add New Template', 'hexacore'), $this->name),
            'add_new_item' => sprintf(__('Add New %s', 'hexacore'), $this->name),
            'edit_item' => sprintf(__('Edit %s', 'hexacore'), $this->name),
            'new_item' => sprintf(__('New %s', 'hexacore'), $this->name),
            'all_items' => sprintf(__('All Templates', 'hexacore'), $this->plural_name),
            'view_item' => sprintf(__('View %s', 'hexacore'), $this->name),
            'search_items' => sprintf(__('Search %s', 'hexacore'), $this->name),
            'not_found' => sprintf(__('No %s found', 'hexacore'), strtolower($this->name)),
            'not_found_in_trash' => sprintf(__('No %s found in Trash', 'hexacore'), strtolower($this->name)),
            'parent_item_colon' => '',
            'menu_name' => $this->name,
        );

        $args   = array(
            'labels' => $labels,
            'public' => true,
            'exclude_from_search' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'rewrite' => ['slug' => $this->slug],
            'menu_position' => 8,
            'supports' => ['title', 'editor', 'thumbnail', 'page-attributes', 'elementor'],
            'menu_icon' => 'dashicons-editor-kitchensink'
        );

        register_post_type($this->type, $args);
    }
}

new HexaHeaderPost();
