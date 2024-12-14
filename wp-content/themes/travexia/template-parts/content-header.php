<!-- #site-header-open -->
<header id="site-header" class="site-header">

    <!-- #header-desktop-open -->
    <?php hexa_header_builder(); ?>
    <!-- #header-desktop-close -->

    <!-- #header-mobile-open -->
    <?php hexa_mobile_builder(); ?>
    <!-- #header-mobile-close -->

</header>
<!-- #site-header-close -->
<!-- #side-panel-open -->
<?php if (!empty(get_theme_mod('is_sidepanel')) && get_theme_mod('sidepanel_layout') != '') { ?>
    <div id="side-panel" class="side-panel side-nl-panel <?php if (get_theme_mod('panel_left')) echo 'on-left'; ?>">
        <div class="side-panel-content">
            <div class="side-panel-content-top d-flex align-items-center justify-content-between mb-50">
                <div class="side-panel-logo" id="site-logo">
                    <?php hexa_sidepanel_logo(); ?>
                </div>
                <div class="side-panel-close">
                    <button class="panel-close-btn panel-nl-close">
                        <i class="hicon-cancel"></i>
                    </button>
                </div>
            </div>
            <div class="side-panel-block">
                <?php if (did_action('elementor/loaded')) hexa_sidepanel_builder(); ?>
            </div>
        </div>
    </div>
    <div class="site-overlay body-nl-overlay"></div>
<?php } ?>
<!-- #side-panel-close -->