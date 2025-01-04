<?php

/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme madison for publication on ThemeForest
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

add_action('tgmpa_register', 'travexia_register_required_plugins');

function travexia_register_required_plugins()
{
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */

    $url = 'https://travexia.sapwp.com/source/';

    $plugins = [
        [
            'name'         => 'Elementor Page Builder',
            'slug'         => 'elementor',
            'required'     => true,
        ],
        [
            'name'         => TRAVEXIA_THEME_NAME . ' Core ',
            'slug'         => TRAVEXIA_THEME_SLUG . '-core',
            'source'       => 'travexia-core.zip',
            'required'     => true,
        ],
        [
            'name'         => 'Kirki Customizer Framework',
            'slug'         => 'kirki',
            'required'     => true,
        ],
        [
            'name'         => 'Tourfic',
            'slug'         => 'tourfic',
            'required'     => true,
        ],
        [
            'name'         => 'Meta Box',
            'slug'         => 'meta-box',
            'required'     => true,
        ],
        [
            'name'         => 'WooCommerce',
            'slug'         => 'woocommerce',
            'required'     => true,
        ],
        [
            'name'         => 'WP Classic Editor',
            'slug'         => 'classic-editor',
            'required'     => false,
        ],
        [
            'name'         => 'Contact Form 7',
            'slug'         => 'contact-form-7',
            'required'     => false,
        ],
        [
            'name'         => 'One Click Demo Import',
            'slug'         => 'one-click-demo-import',
            'required'     => false,
        ]
    ];
    $config = [
        'id'           => TRAVEXIA_THEME_SLUG,
        'default_path' => $url,
        'menu'         => 'travexia-install-plugins',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'message'      => '',

        'strings'      => [
            'page_title'                      => esc_html__('Install Required Plugins', 'travexia'),
            'menu_title'                      => esc_html__('Install Plugins', 'travexia'),
            'installing'                      => esc_html__('Installing Plugin: %s', 'travexia'),
            'updating'                        => esc_html__('Updating Plugin: %s', 'travexia'),
            'oops'                            => esc_html__('Something went wrong with the plugin API.', 'travexia'),
            'notice_can_install_required'     => _n_noop(
                'This theme requires the following plugin: %1$s.',
                'This theme requires the following plugins: %1$s.',
                'travexia'
            ),
            'notice_can_install_recommended'  => _n_noop(
                'This theme recommends the following plugin: %1$s.',
                'This theme recommends the following plugins: %1$s.',
                'travexia'
            ),
            'notice_ask_to_update'            => _n_noop(
                'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
                'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
                'travexia'
            ),
            'notice_ask_to_update_maybe'      => _n_noop(
                'There is an update available for: %1$s.',
                'There are updates available for the following plugins: %1$s.',
                'travexia'
            ),
            'notice_can_activate_required'    => _n_noop(
                'The following required plugin is currently inactive: %1$s.',
                'The following required plugins are currently inactive: %1$s.',
                'travexia'
            ),
            'notice_can_activate_recommended' => _n_noop(
                'The following recommended plugin is currently inactive: %1$s.',
                'The following recommended plugins are currently inactive: %1$s.',
                'travexia'
            ),
            'install_link'                    => _n_noop(
                'Begin installing plugin',
                'Begin installing plugins',
                'travexia'
            ),
            'update_link'                     => _n_noop(
                'Begin updating plugin',
                'Begin updating plugins',
                'travexia'
            ),
            'activate_link'                   => _n_noop(
                'Begin activating plugin',
                'Begin activating plugins',
                'travexia'
            ),
            'return'                          => esc_html__('Return to Required Plugins Installer', 'travexia'),
            'plugin_activated'                => esc_html__('Plugin activated successfully.', 'travexia'),
            'activated_successfully'          => esc_html__('The following plugin was activated successfully:', 'travexia'),
            'plugin_already_active'           => esc_html__('No action taken. Plugin %1$s was already active.', 'travexia'),
            'plugin_needs_higher_version'     => esc_html__('Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'travexia'),
            'complete'                        => esc_html__('All plugins installed and activated successfully. %1$s', 'travexia'),
            'dismiss'                         => esc_html__('Dismiss this notice', 'travexia'),
            'notice_cannot_install_activate'  => esc_html__('There are one or more required or recommended plugins to install, update or activate.', 'travexia'),
            'contact_admin'                   => esc_html__('Please contact the administrator of this site for help.', 'travexia'),
            'nag_type'                        => '',
        ],
    ];
    tgmpa($plugins, $config);
}
