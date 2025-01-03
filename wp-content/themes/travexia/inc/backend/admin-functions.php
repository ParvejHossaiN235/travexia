<?php

//Admin Style
if (!function_exists('travexia_custom_wp_admin_style')) :
  function travexia_custom_wp_admin_style()
  {
    wp_register_style('travexia_custom_wp_admin_css', get_template_directory_uri() . '/inc/assets/css/admin-style.css', false, '1.0.0');
    wp_enqueue_style('travexia_custom_wp_admin_css');

    wp_enqueue_script('travexia_custom_wp_admin_js', get_template_directory_uri() . "/inc/assets/js/admin-script.js", array('jquery'), '1.0.0', true);
    wp_enqueue_script('travexia_custom_wp_admin_js');
  }
  add_action('admin_enqueue_scripts', 'travexia_custom_wp_admin_style');
endif;
