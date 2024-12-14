<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package hexa
 */

get_header();

$single_post_style = get_theme_mod('single_post_style', '1');
$single_post_template = function_exists('rwmb_meta') ? rwmb_meta('single_post_template') : false;

if (!empty($single_post_template)) :
    if ($single_post_template == 'style_3') :
        get_template_part('template-parts/post-single/style-3');
    elseif ($single_post_template == 'style_2') :
        get_template_part('template-parts/post-single/style-2');
    elseif ($single_post_template == 'style_1') :
        get_template_part('template-parts/post-single/style-1');
    endif;
else :
    if ($single_post_style == 'style_3') :
        get_template_part('template-parts/post-single/style-3');
    elseif ($single_post_style == 'style_2') :
        get_template_part('template-parts/post-single/style-2');
    else :
        get_template_part('template-parts/post-single/style-1');
    endif;
endif;

get_footer();
