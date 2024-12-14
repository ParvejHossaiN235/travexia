<?php

//Admin Style
if (!function_exists('hexa_custom_wp_admin_style')) :
  function hexa_custom_wp_admin_style()
  {
    wp_register_style('hexa_custom_wp_admin_css', get_template_directory_uri() . '/inc/assets/css/admin-style.css', false, '1.0.0');
    wp_enqueue_style('hexa_custom_wp_admin_css');

    wp_enqueue_script('hexa_custom_wp_admin_js', get_template_directory_uri() . "/inc/assets/js/admin-script.js", array('jquery'), '1.0.0', true);
    wp_enqueue_script('hexa_custom_wp_admin_js');
  }
  add_action('admin_enqueue_scripts', 'hexa_custom_wp_admin_style');
endif;
