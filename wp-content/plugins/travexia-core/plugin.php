<?php

namespace HexaCore;

use Elementor\Controls_Manager;


/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Hexa_Core_Plugin
{

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance()
	{
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Add Category
	 */

	public function hexa_core_elementor_category($manager)
	{
		$manager->add_category(
			'hexacore_header',
			array(
				'title' => esc_html__('HF Header Addons', 'hexacore'),
				'icon' => 'eicon-banner',
			),
			1
		);
		$manager->add_category(
			'hexacore',
			array(
				'title' => esc_html__('HF Elementor Addons', 'hexacore'),
				'icon' => 'eicon-banner',
			),
			2
		);
		$manager->add_category(
			'hexacore_woocommerce',
			array(
				'title' => esc_html__('HF WooCommerce Addons', 'hexacore'),
				'icon' => 'eicon-banner',
			),
			3
		);
	}


	/**
	 * Editor scripts
	 *
	 * Enqueue plugin javascripts integrations for Elementor editor.
	 *
	 * @since 1.2.1
	 * @access public
	 */
	public function editor_scripts()
	{
		add_filter('script_loader_tag', [$this, 'editor_scripts_as_a_module'], 10, 2);

		wp_enqueue_script(
			'hexacore-editor',
			plugins_url('/assets/js/editor.js', __FILE__),
			[
				'elementor-editor',
			],
			'1.2.1',
			true
		);
	}

	/**
	 * hexa_enqueue_editor_scripts
	 */
	function hexa_enqueue_editor_scripts()
	{
		wp_enqueue_style('hf-element-addons-editor', HEXACORE_ADDONS_URL . 'assets/css/editor.css', null, '1.0.0');
	}

	/**
	 * hexa_enqueue_frontend_styles
	 */
	function hexa_enqueue_frontend_styles()
	{
		if (is_rtl()) {
			wp_enqueue_style('hexa-rtl-bootstrap', HEXACORE_ADDONS_URL . 'assets/css/bootstrap.rtl.min.css', [], '1.0.0');
		} else {
			wp_enqueue_style('hexa-bootstrap', HEXACORE_ADDONS_URL . 'assets/css/bootstrap.min.css', [], '1.0.0');
		}
		wp_enqueue_style('hexa-hexaflow', HEXACORE_ADDONS_URL . 'assets/css/hexaflow-font.css', [], '1.0.0');
		wp_enqueue_style('hexa-linearicons', HEXACORE_ADDONS_URL . 'assets/css/linearicons.css', [], '1.0.0');
		wp_enqueue_style('hexa-swiper', HEXACORE_ADDONS_URL . 'assets/css/swiper.min.css', [], '1.0.0');
		wp_enqueue_style('hexa-elementor', HEXACORE_ADDONS_URL . 'assets/css/hexa-elementor.css', [], '1.0.0');
	}

	/**
	 * hexa_enqueue_frontend_scripts
	 */
	function hexa_enqueue_frontend_scripts()
	{
		wp_enqueue_script('jquery');
		wp_enqueue_script('hexa-bootstrap-js', HEXACORE_ADDONS_URL . 'assets/js/bootstrap.min.js', [], '1.0.0', true);
		wp_enqueue_script('hexa-siwper-js', HEXACORE_ADDONS_URL . 'assets/js/swiper.min.js', [], '1.0.0', true);
		wp_enqueue_script('hexa-elementor-js', HEXACORE_ADDONS_URL . 'assets/js/hexa-elementor.js', [], '1.0.0', true);
	}

	/**
	 * Force load editor script as a module
	 *
	 * @since 1.2.1
	 *
	 * @param string $tag
	 * @param string $handle
	 *
	 * @return string
	 */
	public function editor_scripts_as_a_module($tag, $handle)
	{
		if ('hexacore-editor' === $handle) {
			$tag = str_replace('<script', '<script type="module"', $tag);
		}

		return $tag;
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @param Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets($widgets_manager)
	{
		// Its is now safe to include Widgets files

		foreach ($this->hexa_header_widget_list() as $widget_file_name) {
			require_once(HEXACORE_ELEMENTS_PATH . "/header/{$widget_file_name}.php");
		}

		foreach ($this->hexa_element_widget_list() as $widget_file_name) {
			require_once(HEXACORE_ELEMENTS_PATH . "{$widget_file_name}.php");
		}

		// WooCommerce
		if (class_exists('WooCommerce')) {
			foreach ($this->hexa_woocommerce_widget_list() as $widget_file_name) {
				require_once(HEXACORE_ELEMENTS_PATH . "/woo/{$widget_file_name}.php");
			}
		}
	}

	// hexacore_widget_list_woo
	public function hexa_header_widget_list()
	{
		return [
			# header widget
			'logo',
			'menu',
			'menu-mobile',
			//'mega-menu',
			'side-panel',
			//'footer-list',
			'copyright',
			'header-style-1',
			'header-style-2',
		];
	}

	public function hexa_element_widget_list()
	{
		return [
			# Element widgets
			'about',
			'heading',
			'button',
			'brand',
			'contact-info',
			'contact-form',
			'counter',
			'counter-list',
			'faq',
			'feature-list',
			'gallery',
			'hero-banner',
			'hero-banner-2',
			'hero-slider',
			'icons',
			'icon-list',
			'icon-box',
			'image-box',
			'newsletter',
			'portfolio',
			'portfolio-slider',
			'portfolio-filter',
			'post-grid',
			'post-slider',
			'pricing',
			'pricing-tab',
			'service',
			'service-slider',
			'skill-bar',
			'social-profile',
			'social-share',
			'tabs',
			'advanced-tabs',
			'team',
			'team-slider',
			'testimonial',
			'testimonial-slider',
			'tour-grid',
			'tour-type',
			'tour-activities',
			'tour-locations',
			'tour-search-form',
			'tour-search-result',
			'video-popup'
		];
	}

	// hexacore_widget_list_woo
	public function hexa_woocommerce_widget_list()
	{
		return [
			'product',
			'product-cat',
			'product-cart',
			'product-tab',
			'product-slider',
		];
	}

	// etn events
	public function hexa_event_widget_list()
	{
		return [
			// 'events',
		];
	}

	// give
	public function hexa_donation_widget_list()
	{
		return [
			// 'donation-give'
		];
	}

	public function hexa_add_custom_icons_tab($tabs = array())
	{

		// Append hexaflow fonts icons
		$hexa_icons = array(

			'hicon-menu',
			'hicon-cancel',
			'hicon-plus',
			'hicon-minus',
			'hicon-user',
			'hicon-people',
			'hicon-user-female',
			'hicon-user-follow',
			'hicon-user-following',
			'hicon-user-unfollow',
			'hicon-emotsmile',
			'hicon-home',
			'hicon-star',
			'hicon-star-golden',
			'hicon-star-gray',
			'hicon-star-half-filled',
			'hicon-heart',
			'hicon-basket',
			'hicon-basket-loaded',
			'hicon-handbag',
			'hicon-bag',
			'hicon-trash',
			'hicon-trash-alt',
			'hicon-magnifier',
			'hicon-magnifier-add',
			'hicon-magnifier-remove',
			'hicon-like',
			'hicon-dislike',
			'hicon-refresh',
			'hicon-reload',
			'hicon-copy',
			'hicon-share',
			'hicon-share-alt',
			'hicon-link',
			'hicon-paper-clip',
			'hicon-paper-plane',
			'hicon-present',
			'hicon-database',
			'hicon-lock',
			'hicon-lock-open',
			'hicon-password',
			'hicon-phone-rotary',
			'hicon-phone-office',
			'hicon-phone',
			'hicon-call-in',
			'hicon-call-out',
			'hicon-call-end',
			'hicon-worldwide',
			'hicon-map',
			'hicon-location-pin',
			'hicon-direction',
			'hicon-directions',
			'hicon-compass',
			'hicon-layers',
			'hicon-clock',
			'hicon-alarm-clock',
			'hicon-watch-analog',
			'hicon-watch-digital',
			'hicon-trophy',
			'hicon-screen-smartphone',
			'hicon-screen-tablet',
			'hicon-screen-desktop',
			'hicon-mouse',
			'hicon-plane',
			'hicon-rocket',
			'hicon-truck',
			'hicon-pin',
			'hicon-notebook',
			'hicon-mustache',
			'hicon-magnet',
			'hicon-energy',
			'hicon-cursor',
			'hicon-chemistry',
			'hicon-crop',
			'hicon-speedometer',
			'hicon-hourglass',
			'hicon-graduation',
			'hicon-ghost',
			'hicon-magic-wand',
			'hicon-eyeglass',
			'hicon-shield',
			'hicon-shield-check',
			'hicon-fire',
			'hicon-game-controller',
			'hicon-badge',
			'hicon-car',
			'hicon-crown',
			'hicon-speech',
			'hicon-bubble',
			'hicon-bubbles',
			'hicon-envelope',
			'hicon-envelope-open',
			'hicon-envelope-letter',
			'hicon-anchor',
			'hicon-puzzle',
			'hicon-vector',
			'hicon-wallet',
			'hicon-printer',
			'hicon-picture',
			'hicon-gallery',
			'hicon-globe',
			'hicon-globe-alt',
			'hicon-folder',
			'hicon-folder-alt',
			'hicon-doc',
			'hicon-docs',
			'hicon-letter',
			'hicon-feed',
			'hicon-drawer',
			'hicon-drop',
			'hicon-cup',
			'hicon-diamond',
			'hicon-cap',
			'hicon-calculator',
			'hicon-calculator-alt',
			'hicon-calendar',
			'hicon-event',
			'hicon-organization',
			'hicon-book-open',
			'hicon-briefcase',
			'hicon-disc',
			'hicon-umbrella',
			'hicon-tag',
			'hicon-earphones',
			'hicon-earphones-alt',
			'hicon-support',
			'hicon-tools',
			'hicon-question',
			'hicon-question-alt',
			'hicon-info',
			'hicon-exclamation',
			'hicon-info-alt',
			'hicon-power',
			'hicon-pie-chart',
			'hicon-bar-chart',
			'hicon-graph',
			'hicon-pencil',
			'hicon-note',
			'hicon-music-tone',
			'hicon-music-tone-alt',
			'hicon-playlist',
			'hicon-volume-1',
			'hicon-volume-2',
			'hicon-volume-off',
			'hicon-camera',
			'hicon-ban',
			'hicon-camrecorder',
			'hicon-cloud-download',
			'hicon-cloud-upload',
			'hicon-eye',
			'hicon-eye-slash',
			'hicon-flag',
			'hicon-key',
			'hicon-paper-clip1',
			'hicon-slider',
			'hicon-credit-card',
			'hicon-paypal',
			'hicon-login',
			'hicon-logout',
			'hicon-offer-tag',
			'hicon-offer',
			'hicon-save-money',
			'hicon-handshake',
			'hicon-smartphone-settings',
			'hicon-qr-code',
			'hicon-bookmark',
			'hicon-browser',
			'hicon-sidebar',
			'hicon-warning',
			'hicon-balance-scale',
			'hicon-bell',
			'hicon-square',
			'hicon-square-alt',
			'hicon-square-full',
			'hicon-circle',
			'hicon-circle-alt',
			'hicon-cube',
			'hicon-ruler',
			'hicon-360-degrees',
			'hicon-bulb',
			'hicon-symble-female',
			'hicon-symbol-male',
			'hicon-target',
			'hicon-code',
			'hicon-quote-right',
			'hicon-quote-left',
			'hicon-quote-right-alt',
			'hicon-quote-left-alt',
			'hicon-align-left',
			'hicon-align-right',
			'hicon-align-center',
			'hicon-sort',
			'hicon-sort-alphabet',
			'hicon-sort-numeric',
			'hicon-sort-ascending',
			'hicon-sort-descending',
			'hicon-wifi',
			'hicon-signal-range',
			'hicon-dashboard',
			'hicon-font',
			'hicon-italic',
			'hicon-underline',
			'hicon-tag-label',
			'hicon-asterisk',
			'hicon-percent',
			'hicon-slash',
			'hicon-two-dots',
			'hicon-two-dots-alt',
			'hicon-at',
			'hicon-dollar',
			'hicon-euro',
			'hicon-rupee',
			'hicon-pound',
			'hicon-yen',
			'hicon-chevron-right',
			'hicon-chevron-left',
			'hicon-chevron-up',
			'hicon-chevron-down',
			'hicon-arrow-left',
			'hicon-arrow-right',
			'hicon-arrow-down',
			'hicon-arrow-up',
			'hicon-chevron-circle-right',
			'hicon-chevron-circle-left',
			'hicon-chevron-circle-up',
			'hicon-chevron-circle-down',
			'hicon-arrow-right1',
			'hicon-arrow-left1',
			'hicon-arrow-up1',
			'hicon-arrow-down1',
			'hicon-arrow-down-circle',
			'hicon-arrow-left-circle',
			'hicon-arrow-right-circle',
			'hicon-arrow-up-circle',
			'hicon-chevron-double-right',
			'hicon-chevron-double-left',
			'hicon-chevron-double-up',
			'hicon-chevron-double-down',
			'hicon-turn-right',
			'hicon-turn-left',
			'hicon-turn-right-alt',
			'hicon-turn-right-alt1',
			'hicon-arrow-dot-right',
			'hicon-arrow-dot-left',
			'hicon-arrow-dot-up',
			'hicon-arrow-dot-down',
			'hicon-step-forword',
			'hicon-step-backward',
			'hicon-sort-alt',
			'hicon-transfer-alt',
			'hicon-resize-h',
			'hicon-resize-v',
			'hicon-forward',
			'hicon-backward',
			'hicon-caret-right',
			'hicon-caret-left',
			'hicon-caret-up',
			'hicon-caret-down',
			'hicon-control-start',
			'hicon-control-rewind',
			'hicon-control-pause',
			'hicon-control-play',
			'hicon-control-forward',
			'hicon-control-end',
			'hicon-download',
			'hicon-check',
			'hicon-check-double',
			'hicon-check-circle',
			'hicon-plus-circle',
			'hicon-minus-circle',
			'hicon-close-circle',
			'hicon-check-square',
			'hicon-close-square',
			'hicon-action-redo',
			'hicon-action-undo',
			'hicon-frame',
			'hicon-size-fullscreen',
			'hicon-size-actual',
			'hicon-arrows',
			'hicon-export',
			'hicon-shuffle',
			'hicon-minimize',
			'hicon-repeat',
			'hicon-loop',
			'hicon-play-alt',
			'hicon-microphone',
			'hicon-upload',
			'hicon-settings',
			'hicon-wrench',
			'hicon-equalizer',
			'hicon-film',
			'hicon-grid',
			'hicon-grid-square',
			'hicon-grid-four-square',
			'hicon-grid-circle',
			'hicon-categories',
			'hicon-options',
			'hicon-options-vertical',
			'hicon-list-circle',
			'hicon-list-square',
			'hicon-list-check',
			'hicon-list-square-alt',
			'hicon-android',
			'hicon-android-alt',
			'hicon-apple',
			'hicon-apple-alt',
			'hicon-chrome',
			'hicon-chrome-alt',
			'hicon-wordpress',
			'hicon-wordpress-alt',
			'hicon-linux',
			'hicon-linux-alt',
			'hicon-html-5',
			'hicon-html-5-alt',
			'hicon-wikipedia',
			'hicon-behance',
			'hicon-behance-alt',
			'hicon-blogger',
			'hicon-blogger-alt',
			'hicon-facebook',
			'hicon-facebook-alt',
			'hicon-twitter',
			'hicon-twitter-alt',
			'hicon-x-twitter',
			'hicon-square-x-twitter',
			'hicon-instagram',
			'hicon-linkedin',
			'hicon-linkedin-alt',
			'hicon-whatsapp',
			'hicon-youtube',
			'hicon-youtube-alt',
			'hicon-youtube-1',
			'hicon-pinterest',
			'hicon-pinterest-1',
			'hicon-pinterest-alt',
			'hicon-tik-tok',
			'hicon-tik-tok-alt',
			'hicon-email',
			'hicon-reddit',
			'hicon-reddit-alt',
			'hicon-github',
			'hicon-github-alt',
			'hicon-google',
			'hicon-google-alt',
			'hicon-snapchat',
			'hicon-snapchat-alt',
			'hicon-telegram',
			'hicon-viber-alt',
			'hicon-viber-alt1',
			'hicon-quora',
			'hicon-quora-alt',
			'hicon-tumblr',
			'hicon-tumblr-alt',
			'hicon-flickr',
			'hicon-flickr-alt',
			'hicon-stumbleupon',
			'hicon-stumbleupon-alt',
			'hicon-pocket',
			'hicon-pocket-alt',
			'hicon-line',
			'hicon-line-alt',
			'hicon-wechat',
			'hicon-wechat-alt',
			'hicon-odnoklassniki',
			'hicon-vk',
			'hicon-vk-alt',
			'hicon-dribbble',
			'hicon-dropbox',
			'hicon-foursqare',
			'hicon-soundcloud',
			'hicon-skype',
			'hicon-spotify',
			'hicon-steam'

		);

		$tabs['hf-hexaflow-icons'] = array(
			'name' => 'hf-hexaflow-icons',
			'label' => esc_html__('Hexa - Hexaflow Icons', 'hexacore'),
			'labelIcon' => 'hf-icon',
			'prefix' => '',
			'displayPrefix' => '',
			'url' => HEXACORE_ADDONS_URL . 'assets/css/hexaflow-font.css',
			'icons' => $hexa_icons,
			'ver' => '1.0.0',
		);

		// linear fonts icons
		$linear_icons = array(

			'lnr lnr-menu',
			'lnr lnr-cross',
			'lnr lnr-chevron-up',
			'lnr lnr-chevron-down',
			'lnr lnr-chevron-left',
			'lnr lnr-chevron-right',
			'lnr lnr-arrow-up',
			'lnr lnr-arrow-down',
			'lnr lnr-arrow-left',
			'lnr lnr-arrow-right',
			'lnr lnr-magnifier',
			'lnr lnr-hand',
			'lnr lnr-pointer-up',
			'lnr lnr-pointer-right',
			'lnr lnr-pointer-down',
			'lnr lnr-pointer-left',
			'lnr lnr-home',
			'lnr lnr-apartment',
			'lnr lnr-pencil',
			'lnr lnr-magic-wand',
			'lnr lnr-drop',
			'lnr lnr-lighter',
			'lnr lnr-poop',
			'lnr lnr-sun',
			'lnr lnr-moon',
			'lnr lnr-cloud',
			'lnr lnr-cloud-upload',
			'lnr lnr-cloud-download',
			'lnr lnr-cloud-sync',
			'lnr lnr-cloud-check',
			'lnr lnr-database',
			'lnr lnr-lock',
			'lnr lnr-cog',
			'lnr lnr-trash',
			'lnr lnr-heart',
			'lnr lnr-star',
			'lnr lnr-star-half',
			'lnr lnr-star-empty',
			'lnr lnr-flag',
			'lnr lnr-envelope',
			'lnr lnr-paperclip',
			'lnr lnr-inbox',
			'lnr lnr-eye',
			'lnr lnr-printer',
			'lnr lnr-enter',
			'lnr lnr-exit',
			'lnr lnr-graduation-hat',
			'lnr lnr-music-note',
			'lnr lnr-film-play',
			'lnr lnr-camera-video',
			'lnr lnr-camera',
			'lnr lnr-picture',
			'lnr lnr-book',
			'lnr lnr-bookmark',
			'lnr lnr-user',
			'lnr lnr-users',
			'lnr lnr-shirt',
			'lnr lnr-store',
			'lnr lnr-cart',
			'lnr lnr-tag',
			'lnr lnr-phone-handset',
			'lnr lnr-phone',
			'lnr lnr-pushpin',
			'lnr lnr-map-marker',
			'lnr lnr-map',
			'lnr lnr-location',
			'lnr lnr-screen',
			'lnr lnr-bubble',
			'lnr lnr-heart-pulse',
			'lnr lnr-gift',
			'lnr lnr-diamond',
			'lnr lnr-linearicons',
			'lnr lnr-dinner',
			'lnr lnr-coffee-cup',
			'lnr lnr-leaf',
			'lnr lnr-paw',
			'lnr lnr-rocket',
			'lnr lnr-briefcase',
			'lnr lnr-bus',
			'lnr lnr-car',
			'lnr lnr-train',
			'lnr lnr-bicycle',
			'lnr lnr-wheelchair',
			'lnr lnr-select',
			'lnr lnr-earth',
			'lnr lnr-smile',
			'lnr lnr-sad',
			'lnr lnr-neutral',
			'lnr lnr-mustache',
			'lnr lnr-alarm',
			'lnr lnr-bullhorn',
			'lnr lnr-volume-high',
			'lnr lnr-volume-medium',
			'lnr lnr-volume-low',
			'lnr lnr-volume',
			'lnr lnr-mic',
			'lnr lnr-hourglass',
			'lnr lnr-history',
			'lnr lnr-clock',
			'lnr lnr-download',
			'lnr lnr-upload',
			'lnr lnr-bug',
			'lnr lnr-link',
			'lnr lnr-unlink',
			'lnr lnr-thumbs-up',
			'lnr lnr-thumbs-down',

		);

		$tabs['hf-linear-icons'] = array(
			'name' => 'hf-linear-icons',
			'label' => esc_html__('Hexa - Linear Icons', 'hexacore'),
			'labelIcon' => 'hf-icon',
			'prefix' => 'lnr',
			'displayPrefix' => 'lnr',
			'url' => HEXACORE_ADDONS_URL . 'assets/css/linearicons.css',
			'icons' => $linear_icons,
			'ver' => '1.0.0',
		);

		return $tabs;
	}

	/**
	 * Register controls
	 *
	 * @param Controls_Manager $controls_Manager
	 */

	public function register_controls(Controls_Manager $controls_Manager)
	{
		include_once(HEXACORE_ADDONS_DIR . '/controls/hexagradient.php');
		$hexagradient = 'HexaCore\Elementor\Controls\Group_Control_HexaGradient';
		$controls_Manager->add_group_control($hexagradient::get_type(), new $hexagradient());

		include_once(HEXACORE_ADDONS_DIR . '/controls/hexabggradient.php');
		$hexabggradient = 'HexaCore\Elementor\Controls\Group_Control_HexaBGGradient';
		$controls_Manager->add_group_control($hexabggradient::get_type(), new $hexabggradient());
	}

	// campaign_template_fun
	public function campaign_template_fun($campaign_template)
	{

		if ((get_post_type() == 'campaign') && is_single()) {
			$campaign_template_file_path = __DIR__ . '/template/single-campaign.php';
			$campaign_template           = $campaign_template_file_path;
		}
		if ((get_post_type() == 'tribe_events') && is_single()) {
			$campaign_template_file_path = __DIR__ . '/template/single-event.php';
			$campaign_template           = $campaign_template_file_path;
		}
		if ((get_post_type() == 'etn') && is_single()) {
			$campaign_template_file_path = __DIR__ . '/template/single-etn.php';
			$campaign_template           = $campaign_template_file_path;
		}

		if (!$campaign_template) {
			return $campaign_template;
		}
		return $campaign_template;
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct()
	{
		// Register widgets
		add_action('elementor/widgets/register', [$this, 'register_widgets']);
		// Register editor scripts
		add_action('elementor/editor/after_enqueue_scripts', [$this, 'editor_scripts']);
		add_action('elementor/elements/categories_registered', [$this, 'hexa_core_elementor_category']);
		// Register custom controls
		add_action('elementor/controls/controls_registered', [$this, 'register_controls']);
		add_action('elementor/controls/register_style_controls', [$this, 'register_style_rols']);
		add_filter('elementor/icons_manager/additional_tabs', [$this, 'hexa_add_custom_icons_tab']);
		add_action('elementor/editor/after_enqueue_scripts', [$this, 'hexa_enqueue_editor_scripts']);
		add_filter('template_include', [$this, 'campaign_template_fun'], 99);
		// frontend style and scripts
		//add_action('elementor/frontend/after_register_styles', [$this, 'hexa_enqueue_frontend_styles'], 99);
		//add_action('elementor/frontend/after_register_scripts', [$this, 'hexa_enqueue_frontend_scripts'], 99);
	}
}

// Instantiate Plugin Class
Hexa_Core_Plugin::instance();
