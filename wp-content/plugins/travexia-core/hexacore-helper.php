<?php

/**
 * Plugin Name: Travexia Core
 * Description: Travexia core the ultimate elementor addons.
 * Plugin URI:  https://hexaflow.net/
 * Version:     1.0.0
 * Author:      HexaFlow
 * Author URI:  https://hexaflow.net/
 * Text Domain: hexacore
 * Elementor tested up to: 3.19.x
 * Elementor Pro tested up to: 3.19.x
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly


/**
 * Define
 */
define('HEXACORE_ADDONS_URL', plugins_url('/', __FILE__));
define('HEXACORE_ADDONS_DIR', dirname(__FILE__));
define('HEXACORE_ADDONS_PATH', plugin_dir_path(__FILE__));
define('HEXACORE_ELEMENTS_PATH', HEXACORE_ADDONS_DIR . '/elementor/');
define('HEXACORE_TOOLKIT_PATH', HEXACORE_ADDONS_DIR . '/toolkit/');

/**
 * Check if Elementor is activated
 */
function check_elementor_activation()
{
	if (!is_plugin_active('elementor/elementor.php')) {
		// Elementor is not activated, deactivate this plugin
		deactivate_plugins(plugin_basename(__FILE__));
		wp_die('Please install and activate Elementor Page Builder to use Hexa Core plugin.');
	}
}
register_activation_hook(__FILE__, 'check_elementor_activation');

/**
 * Include all files
 */

//include_once(HEXACORE_TOOLKIT_PATH . 'woocommerce.php');
include_once(HEXACORE_TOOLKIT_PATH . 'mega-menu.php');
include_once(HEXACORE_TOOLKIT_PATH . 'common-functions.php');
include_once(HEXACORE_TOOLKIT_PATH . 'custom-post-header.php');
include_once(HEXACORE_TOOLKIT_PATH . 'custom-post-footer.php');
include_once(HEXACORE_TOOLKIT_PATH . 'custom-post-service.php');
include_once(HEXACORE_TOOLKIT_PATH . 'custom-post-megamenu.php');
include_once(HEXACORE_TOOLKIT_PATH . 'custom-post-portfolio.php');
include_once(HEXACORE_TOOLKIT_PATH . 'class-ocdi-importer.php');
include_once(HEXACORE_TOOLKIT_PATH . 'custom-elementor-support.php');

/**
 * Main Hexa Core Class
 *
 * The init class that runs the Hello World plugin.
 * Intended To make sure that the plugin's minimum requirements are met.
 *
 * You should only modify the constants to match your plugin's needs.
 *
 * Any custom code should go inside Plugin Class in the plugin.php file.
 * @since 1.2.0
 */
final class Hexa_Core
{

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.2.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.2.0
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct()
	{

		// Init Plugin
		add_action('plugins_loaded', array($this, 'init'));
		add_action('init', array($this, 'load_textdomain'));
	}

	/**
	 * Load tutor text domain for translation
	 */
	public function load_textdomain()
	{
		load_plugin_textdomain('hexacore', false, dirname(plugin_basename(__FILE__)) . '/languages');
	}

	/**
	 * Initialize the plugin
	 *
	 * Validates that Elementor is already loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed include the plugin class.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function init()
	{

		// Check if Elementor installed and activated
		if (!did_action('elementor/loaded')) {
			add_action('admin_notices', array($this, 'admin_notice_missing_main_plugin'));
			return;
		}

		// Check for required Elementor version
		if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
			add_action('admin_notices', array($this, 'admin_notice_minimum_elementor_version'));
			return;
		}

		// Check for required PHP version
		if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
			add_action('admin_notices', array($this, 'admin_notice_minimum_php_version'));
			return;
		}
		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once('plugin.php');
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin()
	{
		if (isset($_GET['activate'])) {
			unset($_GET['activate']);
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'hexacore'),
			'<strong>' . esc_html__('Hexa Core', 'hexacore') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'hexacore') . '</strong>'
		);

		$activation_url = wp_nonce_url(admin_url('plugins.php?action=activate&plugin=elementor/elementor.php'), 'activate-plugin_elementor/elementor.php');

		$button = sprintf('<a href="%s" class="button button-primary">%s</a>', $activation_url, esc_html__('Activate Elementor', 'hexacore'));

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p><p>%2$s</p></div>', $message, $button);
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version()
	{
		if (isset($_GET['activate'])) {
			unset($_GET['activate']);
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'hexacore'),
			'<strong>' . esc_html__('Hexa Core', 'hexacore') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'hexacore') . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version()
	{
		if (isset($_GET['activate'])) {
			unset($_GET['activate']);
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'hexacore'),
			'<strong>' . esc_html__('Hexa Core', 'hexacore') . '</strong>',
			'<strong>' . esc_html__('PHP', 'hexacore') . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}
}

// Instantiate Hexa_Core.
new Hexa_Core();
