<?php
if (!function_exists('hexa_page_header')) {
    function hexa_page_header()
    {
        $pheader = '';
        if (function_exists('rwmb_meta')) {
            $pheader = rwmb_meta('pheader_switch');
            if (is_home() || is_archive() || is_search() || is_singular('post')) {
                $pheader = rwmb_meta('pheader_switch', "type=switch", get_option('page_for_posts'));
            }
            if (class_exists('WooCommerce')) {
                if (is_shop() || is_product_category() || is_product_tag() || is_product()) {
                    $pheader = rwmb_meta('pheader_switch', "type=switch", get_option('woocommerce_shop_page_id'));
                }
            }
            // if (!$pheader) {
            //     // return;
            // }
        }
        if (!get_theme_mod('pheader_switch') && !$pheader) {
            return;
        } else {
            $bg     = '';
            $title  = '';
            $output = array();

            if (is_front_page() && is_home()) {
                $title = esc_html__('Blog', 'hexa-theme');
            } elseif (is_front_page()) {
                $title = esc_html__('Home', 'hexa-theme');
            } elseif (is_home()) {
                $title = get_the_title(get_option('page_for_posts'));
            } elseif (is_search()) {
                $title = esc_html__('Search Results for: ', 'hexa-theme') . get_search_query();
            } elseif (is_404()) {
                $title = esc_html__('Page Not Found', 'hexa-theme');
            } elseif (is_archive()) {
                $title = get_the_archive_title();
            } elseif (is_singular('post')) {
                $title = get_theme_mod('ptitle_post') ? get_theme_mod('ptitle_post') : get_the_title();
            } else {
                $title = get_the_title();
            }

            if (!function_exists('rwmb_meta')) {
                $bg = get_theme_mod('pheader_img');
            } else {
                if (is_home()) {
                    $images = rwmb_meta('pheader_bg_image', "type=image", get_option('page_for_posts'));
                } elseif (class_exists('woocommerce') && is_shop()) {
                    $images = rwmb_meta('pheader_bg_image', "type=image", get_option('woocommerce_shop_page_id'));
                } else {
                    $images = rwmb_meta('pheader_bg_image', "type=image");
                }
                if (!$images) {
                    $bg = get_theme_mod('pheader_img');
                } else {
                    foreach ($images as $image) {
                        $bg = $image['full_url'];
                        break;
                    }
                }
            }

            if ($title) {
                $output[] = sprintf('%s', $title);
            }

            $htmltag = (!empty(get_theme_mod('pheader_htmltag')) ? get_theme_mod('pheader_htmltag') : 'h1');
            $pheader_align = (!empty(get_theme_mod('pheader_align')) ? get_theme_mod('pheader_align') : 'text-center');
?>
            <!-- Page Title Area Start  -->
            <div class="page-header tr-breadcurmb-area tr-breadcurmb-bg" <?php if ($bg) { ?> data-background="<?php echo esc_url($bg); ?>" <?php } ?>>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-sm-12">
                            <div class="page-header-inner <?php echo esc_attr($pheader_align); ?>">
                                <?php if (class_exists('woocommerce') && is_woocommerce()) { ?>
                                    <?php if (!is_product()) { ?>
                                        <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
                                            <<?php echo $htmltag; ?> class="woocommerce-page-title page-title">
                                                <?php woocommerce_page_title(); ?>
                                            </<?php echo $htmltag; ?>>
                                        <?php endif; ?>
                                    <?php } else { ?>
                                        <<?php echo $htmltag; ?> class="page-title tr-breadcurmb-title">
                                            <?php echo esc_html(get_theme_mod('page_title_product')); ?>
                                        </<?php echo $htmltag; ?>>
                                    <?php } ?>
                                    <?php do_action('hexa_woocommerce_breadcrumb'); ?>
                                <?php } else { ?>
                                    <<?php echo $htmltag; ?> class="page-title tr-breadcurmb-title">
                                        <?php echo implode('', $output); ?>
                                    </<?php echo $htmltag; ?>>
                                <?php
                                    if (function_exists('hexa_breadcrumbs') && get_theme_mod('breadcrumbs')) :
                                        echo hexa_breadcrumbs();
                                    endif;
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page Title Area End  -->
<?php
        }
    }
}
