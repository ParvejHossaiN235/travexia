<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package travexia
 */

get_header();

if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('single')) {
    travexia_404_builder();
}

get_footer();
