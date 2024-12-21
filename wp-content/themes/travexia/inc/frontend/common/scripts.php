<?php

/**
 * hexa scripts description
 * @return [type] [description]
 */
function hexa_main_scripts()
{

    /**
     * all css files
     */
    wp_enqueue_style('hexa-fonts', hexa_fonts_url(), array(), '1.0.0');
    if (is_rtl()) {
        wp_enqueue_style('hf-bootstrap-rtl', HEXA_THEME_CSS_DIR . 'bootstrap.rtl.min.css', array());
    } else {
        wp_enqueue_style('hf-bootstrap', HEXA_THEME_CSS_DIR . 'bootstrap.min.css', array());
    }

    wp_enqueue_style('hf-animate-min', HEXA_THEME_CSS_DIR . 'animate.css', []);
    wp_enqueue_style('hf-slick', HEXA_THEME_CSS_DIR . 'slick.css', []);
    wp_enqueue_style('hf-daterangepicker-min', HEXA_THEME_CSS_DIR . 'daterangepicker.min.css', []);
    wp_enqueue_style('hf-nice-select', HEXA_THEME_CSS_DIR . 'nice-select.css', []);
    wp_enqueue_style('hf-swiper-bundle', HEXA_THEME_CSS_DIR . 'swiper-bundle.css', []);
    wp_enqueue_style('hf-font-awesome-pro', HEXA_THEME_CSS_DIR . 'font-awesome-pro.css', []);
    wp_enqueue_style('hf-magnific-popup', HEXA_THEME_CSS_DIR . 'magnific-popup.css', []);
    wp_enqueue_style('hf-spacing', HEXA_THEME_CSS_DIR . 'spacing.css', []);
    wp_enqueue_style('hf-hexaflow', HEXA_THEME_CSS_DIR . 'hexaflow-font.css', []);
    wp_enqueue_style('hf-hexa-elementor', HEXA_THEME_CSS_DIR . 'hexa-elementor.css', []);
    wp_enqueue_style('hf-hexa-unit', HEXA_THEME_CSS_DIR . 'hexa-unit.css', [], time());
    wp_enqueue_style('hf-hexa-core', HEXA_THEME_CSS_DIR . 'hexa-core.css', [], time());
    wp_enqueue_style('hf-hexa-tour', HEXA_THEME_CSS_DIR . 'travexia-tour.css', [], time());
    wp_enqueue_style('hf-hexa-style', get_stylesheet_uri());

    // all js
    wp_enqueue_script('hf-bootstrap-bundle', HEXA_THEME_JS_DIR . 'bootstrap.bundle.min.js', ['jquery'], '', true);
    wp_enqueue_script('hf-slick-min', HEXA_THEME_JS_DIR . 'slick.min.js', ['jquery'], '', true);
    wp_enqueue_script('hf-magnific-popup', HEXA_THEME_JS_DIR . 'magnific-popup.js', ['jquery'], '', true);
    wp_enqueue_script('hf-purecounter', HEXA_THEME_JS_DIR . 'purecounter.js', ['jquery'], '', true);
    wp_enqueue_script('hf-wow', HEXA_THEME_JS_DIR . 'wow.js', ['jquery'], '', true);
    wp_enqueue_script('hf-moment-min', HEXA_THEME_JS_DIR . 'moment.min.js', ['jquery'], '', true);
    wp_enqueue_script('hf-daterangepicker-min', HEXA_THEME_JS_DIR . 'daterangepicker.min.js', ['jquery'], '', true);
    wp_enqueue_script('hf-nice-select', HEXA_THEME_JS_DIR . 'nice-select.js', ['jquery'], '', true);
    wp_enqueue_script('isotope-pkgd', HEXA_THEME_JS_DIR . 'isotope-pkgd.js', ['imagesloaded'], false, true);
    wp_enqueue_script('hf-swiper-bundle', HEXA_THEME_JS_DIR . 'swiper-bundle.js', ['jquery'], '', true);
    wp_enqueue_script('hf-hexa-elementor', HEXA_THEME_JS_DIR . 'hexa-elementor.js', ['jquery'], false, true);
    wp_enqueue_script('hf-hexa-main', HEXA_THEME_JS_DIR . 'hexa-main.js', ['jquery'], false, true);


    //Woocommerce
    if (class_exists('WooCommerce')) {
        wp_enqueue_style('hf-hexa-woocoomerce', HEXA_THEME_CSS_DIR . 'woocommerce.css', array(), time());
        wp_enqueue_style('hf-hexa-product-grid', HEXA_THEME_CSS_DIR . 'woo-product-grid.css', array(), time());
        wp_dequeue_script('wc-add-to-cart');
        wp_enqueue_script('wc-add-to-cart', HEXA_THEME_JS_DIR . 'add-to-cart.js', array('jquery'));
    }

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'hexa_main_scripts');

/*
 * Register Fonts
 */
function hexa_fonts_url()
{
    $font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ('off' !== _x('on', 'Google font: on or off', 'hexa-theme')) {
        $font_url = 'https://fonts.googleapis.com/css2?' . urlencode('family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    }
    return $font_url;
}
