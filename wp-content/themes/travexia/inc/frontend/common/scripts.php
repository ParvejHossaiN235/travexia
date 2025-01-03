<?php

/**
 * travexia scripts description
 * @return [type] [description]
 */
function travexia_main_scripts()
{

    /**
     * all css files
     */
    wp_enqueue_style('travexia-fonts', travexia_fonts_url(), array(), '1.0.0');
    if (is_rtl()) {
        wp_enqueue_style('hf-bootstrap-rtl', TRAVEXIA_THEME_CSS_DIR . 'bootstrap.rtl.min.css', array());
    } else {
        wp_enqueue_style('hf-bootstrap', TRAVEXIA_THEME_CSS_DIR . 'bootstrap.min.css', array());
    }

    wp_enqueue_style('hf-animate-min', TRAVEXIA_THEME_CSS_DIR . 'animate.css', []);
    wp_enqueue_style('hf-slick', TRAVEXIA_THEME_CSS_DIR . 'slick.css', []);
    wp_enqueue_style('hf-daterangepicker-min', TRAVEXIA_THEME_CSS_DIR . 'daterangepicker.min.css', []);
    wp_enqueue_style('hf-nice-select', TRAVEXIA_THEME_CSS_DIR . 'nice-select.css', []);
    wp_enqueue_style('hf-swiper-bundle', TRAVEXIA_THEME_CSS_DIR . 'swiper-bundle.css', []);
    wp_enqueue_style('hf-font-awesome-pro', TRAVEXIA_THEME_CSS_DIR . 'font-awesome-pro.css', []);
    wp_enqueue_style('hf-magnific-popup', TRAVEXIA_THEME_CSS_DIR . 'magnific-popup.css', []);
    wp_enqueue_style('hf-spacing', TRAVEXIA_THEME_CSS_DIR . 'spacing.css', []);
    wp_enqueue_style('hf-hexaflow', TRAVEXIA_THEME_CSS_DIR . 'hexaflow-font.css', []);
    wp_enqueue_style('hf-linearicons', TRAVEXIA_THEME_CSS_DIR . 'linearicons.css', []);
    wp_enqueue_style('hf-travexia-elementor', TRAVEXIA_THEME_CSS_DIR . 'travexia-elementor.css', []);
    wp_enqueue_style('hf-travexia-unit', TRAVEXIA_THEME_CSS_DIR . 'travexia-unit.css', [], time());
    wp_enqueue_style('hf-travexia-core', TRAVEXIA_THEME_CSS_DIR . 'travexia-core.css', [], time());
    wp_enqueue_style('hf-travexia-tour', TRAVEXIA_THEME_CSS_DIR . 'travexia-tour.css', [], time());
    wp_enqueue_style('travexia-style', get_stylesheet_uri());

    // all js
    wp_enqueue_script('hf-bootstrap-bundle', TRAVEXIA_THEME_JS_DIR . 'bootstrap.bundle.min.js', ['jquery'], '', true);
    wp_enqueue_script('hf-slick-min', TRAVEXIA_THEME_JS_DIR . 'slick.min.js', ['jquery'], '', true);
    wp_enqueue_script('hf-magnific-popup', TRAVEXIA_THEME_JS_DIR . 'magnific-popup.js', ['jquery'], '', true);
    wp_enqueue_script('hf-purecounter', TRAVEXIA_THEME_JS_DIR . 'purecounter.js', ['jquery'], '', true);
    wp_enqueue_script('hf-wow', TRAVEXIA_THEME_JS_DIR . 'wow.js', ['jquery'], '', true);
    wp_enqueue_script('hf-moment-min', TRAVEXIA_THEME_JS_DIR . 'moment.min.js', ['jquery'], '', true);
    wp_enqueue_script('hf-daterangepicker-min', TRAVEXIA_THEME_JS_DIR . 'daterangepicker.min.js', ['jquery'], '', true);
    wp_enqueue_script('hf-nice-select', TRAVEXIA_THEME_JS_DIR . 'nice-select.js', ['jquery'], '', true);
    wp_enqueue_script('isotope-pkgd', TRAVEXIA_THEME_JS_DIR . 'isotope-pkgd.js', ['imagesloaded'], false, true);
    wp_enqueue_script('hf-swiper-bundle', TRAVEXIA_THEME_JS_DIR . 'swiper-bundle.js', ['jquery'], '', true);
    wp_enqueue_script('hf-travexia-elementor', TRAVEXIA_THEME_JS_DIR . 'travexia-elementor.js', ['jquery'], false, true);
    wp_enqueue_script('hf-travexia-main', TRAVEXIA_THEME_JS_DIR . 'travexia-main.js', ['jquery'], false, true);


    //Woocommerce
    if (class_exists('WooCommerce')) {
        wp_enqueue_style('hf-woocoomerce', TRAVEXIA_THEME_CSS_DIR . 'woocommerce.css', array(), time());
        wp_enqueue_style('hf-product-grid', TRAVEXIA_THEME_CSS_DIR . 'woo-product-grid.css', array(), time());
        wp_dequeue_script('wc-add-to-cart');
        wp_enqueue_script('wc-add-to-cart', TRAVEXIA_THEME_JS_DIR . 'add-to-cart.js', array('jquery'));
    }

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'travexia_main_scripts');

/*
 * Register Fonts
 */
function travexia_fonts_url()
{
    $font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ('off' !== _x('on', 'Google font: on or off', 'travexia')) {
        $font_url = 'https://fonts.googleapis.com/css2?' . urlencode('family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    }
    return $font_url;
}
