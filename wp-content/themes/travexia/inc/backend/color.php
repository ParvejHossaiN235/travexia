<?php
//Custom Style Frontend
if (!function_exists('travexia_color_scheme')) {
    function travexia_color_scheme()
    {
        $color_scheme = '';

        //Main Color
        if (!empty(get_theme_mod('main_color')) && get_theme_mod('main_color') != '#3f78e0') {
            $color_scheme =
                '
            :root {
                --hexa-color-primary: ' . get_theme_mod('main_color') . ';
            }
            .octf-btn{
                --hexa-btn-bg: ' . get_theme_mod('main_color') . ';
            }

			';
        }

        if (!empty($color_scheme)) {
            echo '<style type="text/css">' . $color_scheme . '</style>';
        }
    }
}
add_action('wp_head', 'travexia_color_scheme');
