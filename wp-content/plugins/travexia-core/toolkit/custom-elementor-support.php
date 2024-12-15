<?php

function hexa_add_cpt_support()
{
    //if exists, assign to $cpt_support var
    $cpt_support = get_option('elementor_cpt_support');

    //check if option DOESN'T exist in db
    if (!$cpt_support) {
        $cpt_support = ['page', 'post', 'hexa_header', 'hexa_footer', 'hexa_portfolio', 'hexa_service', 'hexa_megamenu']; //create array of our default supported post types
        update_option('elementor_cpt_support', $cpt_support); //write it to the database
    } else {
        $hexa_portfolio = in_array('hexa_portfolio', $cpt_support);
        $hexa_megamenu = in_array('hexa_megamenu', $cpt_support);
        $hexa_service = in_array('hexa_service', $cpt_support);
        $hexa_header = in_array('hexa_header', $cpt_support);
        $hexa_footer = in_array('hexa_footer', $cpt_support);
        if (!$hexa_portfolio) {
            $cpt_support[] = 'hexa_portfolio'; //append to array
        }
        if (!$hexa_megamenu) {
            $cpt_support[] = 'hexa_megamenu'; //append to array
        }
        if (!$hexa_service) {
            $cpt_support[] = 'hexa_service'; //append to array
        }
        if (!$hexa_header) {
            $cpt_support[] = 'hexa_header'; //append to array
        }
        if (!$hexa_footer) {
            $cpt_support[] = 'hexa_footer'; //append to array
        }
        update_option('elementor_cpt_support', $cpt_support); //update database
    }

    //otherwise do nothing, portfolio already exists in elementor_cpt_support option
}
add_action('elementor/init', 'hexa_add_cpt_support');

// Upload SVG for Elementor
function hexa_unfiltered_files_upload()
{

    //if exists, assign to $cpt_support var
    $cpt_support = get_option('elementor_unfiltered_files_upload');

    //check if option DOESN'T exist in db
    if (!$cpt_support) {
        $cpt_support = '1'; //create string value default to enable upload svg
        update_option('elementor_unfiltered_files_upload', $cpt_support); //write it to the database
    }
}
add_action('elementor/init', 'hexa_unfiltered_files_upload');

function hexa_elementor_updated_option()
{
    // Elementor color
    $color_schemes = get_option('elementor_disable_color_schemes');
    if (!$color_schemes) {
        update_option('elementor_disable_color_schemes', 'yes');
    }
    // Elementor typography
    $typo_schemes = get_option('elementor_disable_typography_schemes');
    if (!$typo_schemes) {
        update_option('elementor_disable_typography_schemes', 'yes');
    }
    // Elementor inline icons
    $inline_icons = get_option('elementor_experiment-e_font_icon_svg');
    if (!$inline_icons) {
        update_option('elementor_experiment-e_font_icon_svg', 'inactive');
    }
}
add_action('elementor/init', 'hexa_elementor_updated_option');
