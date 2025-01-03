<?php

if (!defined('ABSPATH')) {
  exit;
}

class OCDI_Demo_Importer
{

  public function __construct()
  {
    add_filter('ocdi/import_files', [$this, 'import_files_config']);
    add_filter('ocdi/after_import', [$this, 'ocdi_after_import_setup']);
    add_filter('ocdi/disable_pt_branding', '__return_true');
    add_action('init', [$this, 'hexa_demo_rewrite_flush']);
  }

  public function import_files_config()
  {

    $home_prevs = array(
      'hexa_home_1' => array(
        'title' => __('Home 01', 'hexacore'),
        'page'  => __('home', 'hexacore'),
        'screenshot' => plugins_url('assets/img/demo/home-1.webp', dirname(__FILE__)),
        'preview_link' => 'https://travexia.sapwp.com/',
      ),
      'hexa_home_2' => array(
        'title' => __('Home 02', 'hexacore'),
        'page'  => __('home-02', 'hexacore'),
        'screenshot' => plugins_url('assets/img/demo/home-2.webp', dirname(__FILE__)),
        'preview_link' => 'https://travexia.sapwp.com/home-02/',
      ),
      'hexa_home_3' => array(
        'title' => __('Home 03', 'hexacore'),
        'page'  => __('home-03', 'hexacore'),
        'screenshot' => plugins_url('assets/img/demo/home-3.webp', dirname(__FILE__)),
        'preview_link' => 'https://travexia.sapwp.com/home-03/',
      ),
    );

    $config = [];

    $import_path = trailingslashit(get_template_directory()) . 'sample-data/';

    foreach ($home_prevs as $key => $prev) {

      $contents_demo = $import_path . 'contents-demo.xml';
      $widget_settings = $import_path . 'widget-settings.json';
      $customizer_data = $import_path . 'customizer-data.dat';

      $config[] = [
        'import_file_id'               => $key,
        'import_page_name'             => $prev['page'],
        'import_file_name'             => $prev['title'],
        'local_import_file'            => $contents_demo,
        'local_import_widget_file'     => $widget_settings,
        'local_import_customizer_file' => $customizer_data,
        'import_preview_image_url'     => $prev['screenshot'],
        'preview_url'                  => $prev['preview_link'],
        'import_notice'                => esc_html__('After you import this demo, you will have to setup the slider separately.', 'bdevs-element'),
      ];
    }

    return $config;
  }

  public function ocdi_after_import_setup($selected_file)
  {

    $this->assign_menu_to_location();
    $this->assign_frontpage_id($selected_file);
    $this->update_permalinks();
    update_option('basa_ocdi_importer_flash', true);
  }

  private function assign_menu_to_location()
  {

    $main_menu = get_term_by('name', 'Main Menu', 'nav_menu');

    set_theme_mod('nav_menu_locations', [
      'main-menu' => $main_menu->term_id,
    ]);
  }

  private function assign_frontpage_id($selected_import)
  {
    // Default pages
    $front_page_title = 'Home';
    $blog_page_title = 'Blog';

    // Mapping custom page titles
    switch ($selected_import['import_page_name']) {
      case 'home-03':
        $front_page_title = 'Home 03';
        break;
      case 'home-02':
        $front_page_title = 'Home 02';
        break;
      case 'home':
        $front_page_title = 'Home';
        break;
      // Add more cases as needed
    }

    // Set up the query to retrieve the front page
    $front_page_query = new WP_Query(array(
      'post_type' => 'page',
      'post_status' => 'publish',
      'posts_per_page' => 1,
      'title' => $front_page_title,
    ));

    // Set up the query to retrieve the blog page
    $blog_page_query = new WP_Query(array(
      'post_type' => 'page',
      'post_status' => 'publish',
      'posts_per_page' => 1,
      'title' => $blog_page_title,
    ));

    // Check if the pages are found
    if ($front_page_query->have_posts() && $blog_page_query->have_posts()) {
      // Get the front page and blog page IDs
      $front_page_id = $front_page_query->posts[0]->ID;
      $blog_page_id = $blog_page_query->posts[0]->ID;

      // WooCommerce default settings reset
      if (class_exists('WooCommerce')) {
        update_option('woocommerce_shop_page_id', '454');
        update_option('woocommerce_cart_page_id', '455');
        update_option('woocommerce_checkout_page_id', '456');
        update_option('woocommerce_myaccount_page_id', '457');
      }

      // Set front page and blog page
      update_option('show_on_front', 'page');
      update_option('page_on_front', $front_page_id);
      update_option('page_for_posts', $blog_page_id);
    } else {
      // Handle the case where one or both pages are not found
      // You might want to log an error or display a message
      // For now, let's just echo a message to the error log
      error_log('Front page or blog page not found.');
    }

    // Reset post data
    wp_reset_postdata();
  }

  private function update_permalinks()
  {
    update_option('permalink_structure', '/%postname%/');
  }

  public function hexa_demo_rewrite_flush()
  {

    if (get_option('basa_ocdi_importer_flash') == true) {
      flush_rewrite_rules();
      delete_option('basa_ocdi_importer_flash');
    }
  }
}

new OCDI_Demo_Importer;
