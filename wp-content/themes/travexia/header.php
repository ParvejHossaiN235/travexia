<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hexa
 */

$protocol = is_ssl() ? 'https' : 'http';

?>

<!doctype html>
<html <?php language_attributes(); ?> class="no-js">

<head>
   <meta charset="<?php bloginfo('charset'); ?>">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="profile" href="<?php echo esc_attr($protocol) ?>://gmpg.org/xfn/11">
   <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
   <?php wp_body_open(); ?>

   <div id="page" class="site">
      <?php if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('header')) {
         get_template_part('template-parts/content', 'header');
      } ?>
      <!-- #site-content-open -->
      <div id="content" class="site-content">
         <?php hexa_page_header(); ?>