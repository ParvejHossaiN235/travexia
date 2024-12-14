<?php

/** header desktop **/
if (!function_exists('hexa_header_builder')) {
    function hexa_header_builder()
    {
        $header_builder = '';

        if (is_page() || is_home()) {
            if (function_exists('rwmb_meta')) {
                global $wp_query;
                $metabox_fb = rwmb_meta('select_header', 'field_type=select_advanced', $wp_query->get_queried_object_id());
                if ($metabox_fb != '') {
                    $header_builder = $metabox_fb;
                } else {
                    $header_builder = get_theme_mod('header_layout');
                }
            }
        } else {
            $header_builder = get_theme_mod('header_layout');
        }

        if (!$header_builder) {
            get_template_part('inc/frontend/header/header-default');
        } else {
            echo '<div class="hexa-desktop-header">';
            if (did_action('elementor/loaded')) {
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($header_builder);
            }
            echo '</div>';
        }
    }
}

/** header mobile **/
if (!function_exists('hexa_mobile_builder')) {
    function hexa_mobile_builder()
    {
        $mobile_builder = '';

        if (is_page()) {
            if (function_exists('rwmb_meta')) {
                global $wp_query;
                $metabox_hmb = rwmb_meta('select_header_mobile', 'field_type=select_advanced', $wp_query->get_queried_object_id());
                if ($metabox_hmb != '') {
                    $mobile_builder = $metabox_hmb;
                } else {
                    $mobile_builder = get_theme_mod('header_mobile');
                }
            }
        } else {
            $mobile_builder = get_theme_mod('header_mobile');
        }

        if (!$mobile_builder) {
            get_template_part('inc/frontend/header/header-mobile');
        } else {
            echo '<div class="hexa-mobile-header">';
            if (did_action('elementor/loaded')) {
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($mobile_builder);
            }
            echo '</div>';
        }
    }
}

/** side panel **/
if (!function_exists('hexa_sidepanel_builder')) {
    function hexa_sidepanel_builder()
    {

        $panel_builder = get_theme_mod('sidepanel_layout');

        if (!$panel_builder) {
            return;
        } else {
            if (did_action('elementor/loaded')) {
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($panel_builder);
            }
        }
    }
}

/** 404 template **/
if (!function_exists('hexa_404_builder')) {
    function hexa_404_builder()
    {

        $error_builder = get_theme_mod('page_404');

        if (!$error_builder) { ?>
            <div class="error-area hexa-error pt-100 pb-100">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="error-wrapper text-center">
                                <div class=" error-logo hf-error-thumb">
                                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/error.jpg" alt="404" />
                                </div>
                                <h1 class="error-title hf-error-title"><?php esc_html_e('Oops! Page Not Found', 'hexa-theme'); ?></h1>
                                <div class="error-content">
                                    <p class="mb-30"><?php esc_html_e('The page you are looking for is not available or has been moved. Try a different page or go to homepage with the button below.', 'hexa-theme'); ?></p>
                                    <a class="hexa-btn hf-btn" href="<?php echo esc_url(home_url('/')); ?>">
                                        <?php esc_html_e('Back To Home', 'hexa-theme'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else {
            if (did_action('elementor/loaded')) {
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($error_builder);
            }
        }
    }
}

/** footer **/
if (!function_exists('hexa_footer_builder')) {
    function hexa_footer_builder()
    {
        $footer_builder = '';

        if (is_page()) {
            if (function_exists('rwmb_meta')) {
                global $wp_query;
                $metabox_fb = rwmb_meta('select_footer', 'field_type=select_advanced', $wp_query->get_queried_object_id());
                if ($metabox_fb != '') {
                    $footer_builder = $metabox_fb;
                } else {
                    $footer_builder = get_theme_mod('footer_layout');
                }
            }
        } else {
            $footer_builder = get_theme_mod('footer_layout');
        }

        if (!$footer_builder) { ?>
            <footer id="site-footer" class="site-footer">
                <div class="hexa-main-footer">
                    <div class="copyright-area">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="copyright-wrapper text-center">
                                        <p><?php echo esc_html__('© Copyright ' . date('Y') . ' Hexa. All Rights Reserved', 'hexa-theme'); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
<?php } else {
            echo '<footer id="site-footer" class="site-footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter">';
            echo '<div class="hexa-main-footer">';
            if (did_action('elementor/loaded')) {
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($footer_builder);
            }
            echo '</div>';
            echo '</footer>';
        }
    }
}
