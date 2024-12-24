<?php

namespace HexaCore\Widgets;

use \Elementor\Widget_Base;


if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Hexa Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Hexa_Tour_Acitivities extends Widget_Base
{

	use \HexaCore\Widgets\HexaCoreElementFunctions;

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'hf-tour-activities';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return __('Tour Acitivties', 'hexacore');
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'hf-icon';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories()
	{
		return ['hexacore'];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends()
	{
		return ['hexacore'];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls()
	{
		$this->register_controls_section();
		$this->style_tab_content();
	}

	protected function register_controls_section()
	{
		// layout Panel
		$this->start_controls_section(
			'hexa_layout',
			[
				'label' => esc_html__('Design Layout', 'hexacore'),
			]
		);
		$this->add_control(
			'hexa_design_layout',
			[
				'label' => esc_html__('Select Layout', 'hexacore'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'layout_1' => esc_html__('Layout 1', 'hexacore'),
					'layout_2' => esc_html__('Layout 2', 'hexacore'),
				],
				'default' => 'layout_1',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_tour_activities',
			[
				'label' => __('Tour Activities', 'hexacore'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title',
			[
				'label' => __('Title', 'hexacore'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __('Type your activities name', 'hexacore'),
				'default' => __('Tour Activities', 'hexacore'),
			]
		);

		$repeater->add_control(
			'text',
			[
				'label' => __('Text', 'hexacore'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
				'placeholder' => __('Type your activities desc', 'hexacore'),
				'default' => __('We have been operating for over a decade to our providing top notch', 'hexacore'),
			]
		);

		$repeater->add_control(
			'icon_type',
			[
				'label' => __('Icon Type', 'hexacore'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'svg',
				'options' => [
					'font' 	=> __('Font Icon', 'hexacore'),
					'image' => __('Image Icon', 'hexacore'),
					'svg' => __('SVG Code', 'hexacore'),
				]
			]
		);
		$repeater->add_control(
			'icon_font',
			[
				'label' => __('Icon', 'hexacore'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'label_block' => true,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
				'condition' => [
					'icon_type' => 'font',
				]
			]
		);
		$repeater->add_control(
			'icon_image',
			[
				'label' => esc_html__('Image', 'hexacore'),
				'type'  => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_type' => 'image',
				]
			]
		);
		$repeater->add_control(
			'icon_class',
			[
				'label' => __('Custom Class', 'hexacore'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __('<svg width="63" height="64" viewBox="0 0 63 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M61.9688 0.515625H23.375C23.1056 0.515625 22.8473 0.622628 22.6568 0.813095C22.4664 1.00356 22.3594 1.26189 22.3594 1.53125V2.54688H19.3125C19.0431 2.54688 18.7848 2.65388 18.5943 2.84434C18.4039 3.03481 18.2969 3.29314 18.2969 3.5625V28.9531H16.2656C16.0769 28.953 15.8919 29.0055 15.7313 29.1047C15.5707 29.204 15.441 29.3459 15.3566 29.5148L13.6067 33.0156H10.1719V29.9688C10.1719 29.6994 10.0649 29.4411 9.8744 29.2506C9.68394 29.0601 9.42561 28.9531 9.15625 28.9531H5.09375C4.82439 28.9531 4.56606 29.0601 4.3756 29.2506C4.18513 29.4411 4.07812 29.6994 4.07812 29.9688V33.0156H3.0625C2.25442 33.0156 1.47943 33.3366 0.908034 33.908C0.336634 34.4794 0.015625 35.2544 0.015625 36.0625V60.4375C0.015625 61.2456 0.336634 62.0206 0.908034 62.592C1.47943 63.1634 2.25442 63.4844 3.0625 63.4844H41.6562C42.4643 63.4844 43.2393 63.1634 43.8107 62.592C44.3821 62.0206 44.7031 61.2456 44.7031 60.4375V45.2031H59.9375C60.2069 45.2031 60.4652 45.0961 60.6557 44.9057C60.8461 44.7152 60.9531 44.4569 60.9531 44.1875V41.1406H61.9688C62.2381 41.1406 62.4964 41.0336 62.6869 40.8432C62.8774 40.6527 62.9844 40.3944 62.9844 40.125V1.53125C62.9844 1.26189 62.8774 1.00356 62.6869 0.813095C62.4964 0.622628 62.2381 0.515625 61.9688 0.515625ZM20.3281 4.57812H22.3594V28.9531H20.3281V4.57812ZM16.8933 30.9844H27.8255L28.8411 33.0156H15.8777L16.8933 30.9844ZM42.2534 33.0755L44.4208 28.7409L47.1406 30.7812C47.3164 30.9131 47.5303 30.9844 47.75 30.9844C47.9697 30.9844 48.1836 30.9131 48.3594 30.7812L51.0792 28.7409L56.263 39.1094H44.7031V36.0625C44.7029 35.3582 44.4588 34.6757 44.0121 34.1312C43.5655 33.5866 42.9441 33.2136 42.2534 33.0755ZM38.6094 33.0156H36.5781V30.9844H38.6094V33.0156ZM47.75 28.6992L45.344 26.8955L47.75 22.0834L50.156 26.8955L47.75 28.6992ZM40.6406 31.7603V29.9688C40.6406 29.6994 40.5336 29.4411 40.3432 29.2506C40.1527 29.0601 39.8944 28.9531 39.625 28.9531H35.5625C35.2931 28.9531 35.0348 29.0601 34.8443 29.2506C34.6539 29.4411 34.5469 29.6994 34.5469 29.9688V33.0156H32.1277L37.5938 22.0834L41.5364 29.9688L40.6406 31.7603ZM6.10938 30.9844H8.14062V33.0156H6.10938V30.9844ZM42.6719 60.4375C42.6719 60.7069 42.5649 60.9652 42.3744 61.1557C42.1839 61.3461 41.9256 61.4531 41.6562 61.4531H3.0625C2.79314 61.4531 2.53481 61.3461 2.34434 61.1557C2.15388 60.9652 2.04688 60.7069 2.04688 60.4375V36.0625C2.04688 35.7931 2.15388 35.5348 2.34434 35.3443C2.53481 35.1539 2.79314 35.0469 3.0625 35.0469H41.6562C41.9256 35.0469 42.1839 35.1539 42.3744 35.3443C42.5649 35.5348 42.6719 35.7931 42.6719 36.0625V60.4375ZM58.9219 43.1719H44.7031V41.1406H58.9219V43.1719ZM60.9531 39.1094H58.5339L48.6641 19.3585C48.5702 19.2011 48.4371 19.0708 48.2778 18.9803C48.1184 18.8898 47.9383 18.8422 47.7551 18.8422C47.5718 18.8422 47.3917 18.8898 47.2324 18.9803C47.073 19.0708 46.9399 19.2011 46.8461 19.3585L42.6719 27.6978L38.5078 19.3585C38.414 19.2011 38.2809 19.0708 38.1215 18.9803C37.9622 18.8898 37.7821 18.8422 37.5988 18.8422C37.4156 18.8422 37.2355 18.8898 37.0761 18.9803C36.9168 19.0708 36.7837 19.2011 36.6898 19.3585L30.4844 31.7603L29.3672 29.5148C29.2824 29.3452 29.1519 29.2027 28.9904 29.1034C28.8288 29.0041 28.6427 28.9521 28.4531 28.9531H24.3906V2.54688H60.9531V39.1094Z" fill="currentcolor" />
                              <path d="M22.3594 37.0781C20.1498 37.0781 17.9898 37.7333 16.1526 38.9609C14.3154 40.1885 12.8835 41.9333 12.0379 43.9747C11.1923 46.0161 10.9711 48.2624 11.4022 50.4295C11.8332 52.5967 12.8973 54.5873 14.4597 56.1497C16.0221 57.7121 18.0127 58.7761 20.1799 59.2072C22.347 59.6383 24.5933 59.417 26.6347 58.5715C28.6761 57.7259 30.4209 56.294 31.6485 54.4568C32.876 52.6196 33.5313 50.4596 33.5313 48.25C33.5278 45.2881 32.3496 42.4485 30.2552 40.3541C28.1609 38.2598 25.3213 37.0816 22.3594 37.0781ZM22.3594 57.3906C20.5515 57.3906 18.7843 56.8545 17.2811 55.8501C15.778 54.8458 14.6064 53.4182 13.9145 51.748C13.2227 50.0777 13.0417 48.2399 13.3944 46.4668C13.7471 44.6936 14.6176 43.0649 15.896 41.7866C17.1743 40.5083 18.803 39.6377 20.5761 39.285C22.3492 38.9323 24.1871 39.1133 25.8573 39.8052C27.5276 40.497 28.9551 41.6686 29.9595 43.1717C30.9639 44.6749 31.5 46.4422 31.5 48.25C31.4973 50.6734 30.5334 52.9968 28.8198 54.7104C27.1062 56.424 24.7828 57.3879 22.3594 57.3906Z" fill="currentcolor" />
                              <path d="M22.3594 41.1406C20.9533 41.1406 19.5788 41.5576 18.4096 42.3388C17.2405 43.12 16.3293 44.2303 15.7912 45.5294C15.2531 46.8284 15.1123 48.2579 15.3866 49.637C15.6609 51.0161 16.338 52.2828 17.3323 53.2771C18.3266 54.2714 19.5933 54.9485 20.9724 55.2228C22.3515 55.4971 23.7809 55.3563 25.08 54.8182C26.3791 54.2801 27.4894 53.3689 28.2706 52.1998C29.0518 51.0306 29.4688 49.6561 29.4688 48.25C29.4666 46.3651 28.7169 44.5581 27.3841 43.2253C26.0513 41.8925 24.2442 41.1428 22.3594 41.1406ZM22.3594 53.3281C21.355 53.3281 20.3732 53.0303 19.5381 52.4723C18.703 51.9143 18.0522 51.1212 17.6678 50.1933C17.2835 49.2654 17.1829 48.2444 17.3788 47.2593C17.5748 46.2742 18.0584 45.3694 18.7686 44.6592C19.4788 43.949 20.3836 43.4654 21.3687 43.2694C22.3537 43.0735 23.3748 43.1741 24.3027 43.5584C25.2306 43.9428 26.0237 44.5937 26.5817 45.4287C27.1397 46.2638 27.4375 47.2456 27.4375 48.25C27.4359 49.5963 26.9004 50.887 25.9484 51.839C24.9964 52.791 23.7057 53.3265 22.3594 53.3281Z" fill="currentcolor" />
                              <path d="M30.4844 16.7645H40.6406C41.7181 16.7645 42.7514 16.3365 43.5132 15.5746C44.2751 14.8127 44.7031 13.7794 44.7031 12.702C44.7031 11.6245 44.2751 10.5912 43.5132 9.82935C42.7514 9.06748 41.7181 8.63947 40.6406 8.63947C40.6061 8.63947 40.5736 8.64861 40.5391 8.64962C40.306 7.50167 39.6832 6.46961 38.7762 5.7283C37.8692 4.98699 36.7339 4.58203 35.5625 4.58203C34.3911 4.58203 33.2558 4.98699 32.3488 5.7283C31.4418 6.46961 30.819 7.50167 30.5859 8.64962C30.5514 8.64962 30.5189 8.63947 30.4844 8.63947C29.4069 8.63947 28.3736 9.06748 27.6118 9.82935C26.8499 10.5912 26.4219 11.6245 26.4219 12.702C26.4219 13.7794 26.8499 14.8127 27.6118 15.5746C28.3736 16.3365 29.4069 16.7645 30.4844 16.7645ZM30.4844 10.6707C31.0231 10.6707 31.5398 10.8847 31.9207 11.2657C32.3016 11.6466 32.5156 12.1632 32.5156 12.702H34.5469C34.5447 12.0002 34.3603 11.311 34.0117 10.702C33.6631 10.0929 33.1623 9.58482 32.5583 9.22751C32.6584 8.50185 33.0177 7.83693 33.57 7.35564C34.1222 6.87434 34.83 6.60919 35.5625 6.60919C36.295 6.60919 37.0028 6.87434 37.555 7.35564C38.1073 7.83693 38.4666 8.50185 38.5667 9.22751C37.9627 9.58482 37.4619 10.0929 37.1133 10.702C36.7647 11.311 36.5803 12.0002 36.5781 12.702H38.6094C38.6094 12.3002 38.7285 11.9075 38.9517 11.5735C39.1749 11.2394 39.4921 10.9791 39.8633 10.8253C40.2345 10.6716 40.6429 10.6314 41.0369 10.7097C41.4309 10.7881 41.7929 10.9816 42.0769 11.2657C42.361 11.5497 42.5545 11.9117 42.6328 12.3057C42.7112 12.6997 42.671 13.1081 42.5173 13.4793C42.3635 13.8505 42.1032 14.1677 41.7691 14.3909C41.4351 14.6141 41.0424 14.7332 40.6406 14.7332H30.4844C29.9457 14.7332 29.429 14.5192 29.0481 14.1383C28.6671 13.7573 28.4531 13.2407 28.4531 12.702C28.4531 12.1632 28.6671 11.6466 29.0481 11.2657C29.429 10.8847 29.9457 10.6707 30.4844 10.6707Z" fill="currentcolor" />
                              <path d="M49.7812 12.7031C50.5847 12.7031 51.3702 12.4649 52.0383 12.0185C52.7063 11.5721 53.227 10.9376 53.5345 10.1953C53.842 9.45295 53.9224 8.63612 53.7657 7.84807C53.6089 7.06002 53.222 6.33616 52.6539 5.76801C52.0857 5.19985 51.3619 4.81294 50.5738 4.65619C49.7858 4.49943 48.9689 4.57989 48.2266 4.88737C47.4843 5.19485 46.8498 5.71555 46.4034 6.38362C45.957 7.0517 45.7188 7.83714 45.7188 8.64063C45.7188 9.71807 46.1468 10.7514 46.9086 11.5132C47.6705 12.2751 48.7038 12.7031 49.7812 12.7031ZM49.7812 6.60938C50.183 6.60938 50.5757 6.72851 50.9098 6.9517C51.2438 7.1749 51.5041 7.49214 51.6579 7.8633C51.8116 8.23446 51.8518 8.64288 51.7735 9.0369C51.6951 9.43093 51.5016 9.79286 51.2176 10.0769C50.9335 10.361 50.5716 10.5545 50.1775 10.6328C49.7835 10.7112 49.3751 10.671 49.0039 10.5173C48.6328 10.3635 48.3155 10.1032 48.0923 9.76913C47.8691 9.43509 47.75 9.04237 47.75 8.64063C47.75 8.10191 47.964 7.58525 48.3449 7.20432C48.7259 6.82338 49.2425 6.60938 49.7812 6.60938Z" fill="currentcolor" />
                           </svg>', 'hexacore'),
				'condition' => [
					'icon_type' => 'svg',
				]
			]
		);

		$repeater->add_control(
			'link',
			[
				'label' => __('Link', 'hexacore'),
				'type' => \Elementor\Controls_Manager::URL,
				'label_block' => true,
				'placeholder' => __('https://your-link.com', 'hexacore'),
				'options' => ['url', 'is_external', 'nofollow'],
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => false,
				],
			]
		);

		$this->add_control(
			'acitvities_list',
			[
				'label'       => '',
				'show_label'  => false,
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'title' => __('Tour Activities #1', 'hexacore'),
					],
					[
						'title' => __('Tour Activities #2', 'hexacore'),
					],
					[
						'title' => __('Tour Activities #3', 'hexacore'),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_column_settings',
			[
				'label' => esc_html__('Column Settings', 'hexacore'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'desktop_column',
			[
				'label' => esc_html__('Columns for Desktop', 'hexacore'),
				'description' => esc_html__('Screen width equal to or greater than 1200px', 'hexacore'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					12 => esc_html__('1 Columns', 'hexacore'),
					6 => esc_html__('2 Columns', 'hexacore'),
					4 => esc_html__('3 Columns', 'hexacore'),
					3 => esc_html__('4 Columns', 'hexacore'),
					2 => esc_html__('6 Columns', 'hexacore'),
				],
				'separator' => 'before',
				'default' => '3',
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'laptop_column',
			[
				'label' => esc_html__('Columns for Laptop', 'hexacore'),
				'description' => esc_html__('Screen width equal to or greater than 992px', 'hexacore'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					12 => esc_html__('1 Columns', 'hexacore'),
					6 => esc_html__('2 Columns', 'hexacore'),
					4 => esc_html__('3 Columns', 'hexacore'),
					3 => esc_html__('4 Columns', 'hexacore'),
					2 => esc_html__('6 Columns', 'hexacore'),
				],
				'separator' => 'before',
				'default' => '3',
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'tablet_column',
			[
				'label' => esc_html__('Columns for Tablet', 'hexacore'),
				'description' => esc_html__('Screen width equal to or greater than 768px', 'hexacore'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					12 => esc_html__('1 Columns', 'hexacore'),
					6 => esc_html__('2 Columns', 'hexacore'),
					4 => esc_html__('3 Columns', 'hexacore'),
					3 => esc_html__('4 Columns', 'hexacore'),
					2 => esc_html__('6 Columns', 'hexacore'),
				],
				'separator' => 'before',
				'default' => '4',
				'style_transfer' => true,
			]
		);
		$this->add_control(
			'mobile_column',
			[
				'label' => esc_html__('Columns for Mobile', 'hexacore'),
				'description' => esc_html__('Screen width less than 768px', 'hexacore'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					12 => esc_html__('1 Columns', 'hexacore'),
					6 => esc_html__('2 Columns', 'hexacore'),
					4 => esc_html__('3 Columns', 'hexacore'),
					3 => esc_html__('4 Columns', 'hexacore'),
					2 => esc_html__('6 Columns', 'hexacore'),
				],
				'separator' => 'before',
				'default' => '6',
				'style_transfer' => true,
			]
		);

		$this->end_controls_section();
	}

	protected function style_tab_content()
	{
		$this->start_controls_section(
			'section_menu_list',
			[
				'label' => __('List', 'hexacore'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'view',
			[
				'label' => __('Layout', 'hexacore'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'd-flex flex-column list-unstyled',
				'options' => [
					'd-flex flex-column list-unstyled' => [
						'title' => __('Default', 'hexacore'),
						'icon' => 'eicon-editor-list-ul',
					],
					'd-flex flex-row list-unstyled' => [
						'title' => __('Inline', 'hexacore'),
						'icon' => 'eicon-ellipsis-h',
					],
				],
				'render_type' => 'template', /*Live load*/
			]
		);

		$this->add_responsive_control(
			'space_between',
			[
				'label' => __('Space Between', 'hexacore'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .hexa-icon-list' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'list_menu_align',
			[
				'label' => __('Alignment', 'hexacore'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => __('Left', 'hexacore'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __('Center', 'hexacore'),
						'icon' => 'eicon-text-align-center',
					],
					'flex-end' => [
						'title' => __('Right', 'hexacore'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors'	=> [
					'{{WRAPPER}} .hexa-icon-list' => 'justify-content: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();

		$this->hexa_basic_style_controls('list_title', 'Text - Style', '.hexa-el-icon-text');
		$this->hexa_icon_style_controls('mlist_icon', 'Icon - Style', '.hexa-el-icon');
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		extract($settings);
?>

		<?php if ($settings['hexa_design_layout']  == 'layout_2') : ?>

			<!-- memorise-area-start -->
			<div class="tr-memorise-area tr-memorise-style-3 ">
				<div class="row row-gap-30">
					<?php foreach ($settings['acitvities_list'] as $key => $item) :
						if (!empty($item['link']['url'])) {
							$this->add_link_attributes('link_' . $key, $item['link']);
						}
					?>
						<div class="col-xl-<?php echo esc_attr($desktop_column); ?> col-lg-<?php echo esc_attr($laptop_column); ?> col-md-<?php echo esc_attr($tablet_column); ?> col-sm-<?php echo esc_attr($mobile_column); ?> wow itfadeUp" data-wow-duration=".9s" data-wow-delay=".3s">
							<div class="tr-memorise-item">
								<?php if (!empty($item['icon_type'] == 'font') || !empty($item['icon_type'] == 'image') || !empty($item['icon_type'] == 'svg')) : ?>
									<div class="tr-memorise-icon mb-40">
										<span class="hexa-el-icon">
											<?php if ($item['icon_type'] == 'font') {
												\Elementor\Icons_Manager::render_icon($item['icon_font'], ['aria-hidden' => 'true']);
											} ?>
											<?php if ($item['icon_type'] == 'image') { ?>
												<img src="<?php echo esc_attr($item['icon_image']['url']); ?>" alt="<?php echo esc_attr($item['title']); ?>">
											<?php } ?>
											<?php if ($item['icon_type'] == 'svg') { ?>
												<?php echo $item['icon_class']; ?>
											<?php } ?>
										</span>
									</div>
								<?php endif; ?>
								<div class="tr-memorise-content">
									<?php if (!empty($item['title'])) : ?>
										<h4 class="tr-memorise-title hexa-el-title">
											<a class="border-line-white" <?php echo $this->get_render_attribute_string('link_' . $key); ?>>
												<?php echo esc_html($item['title']); ?>
											</a>
										</h4>
									<?php endif; ?>
									<?php if (!empty($item['text'])) : ?>
										<p class="mt-25 mb-0">
											<?php echo esc_html($item['text']); ?>
										</p>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endforeach ?>
				</div>
			</div>
			<!-- memorise-area-end -->

		<?php else : ?>

			<!-- memorise-area-start -->
			<div class="tr-memorise-area tr-memorise-style-2 p-relative">
				<div class="row">
					<?php foreach ($settings['acitvities_list'] as $key => $item) :
						if (!empty($item['link']['url'])) {
							$this->add_link_attributes('link_' . $key, $item['link']);
						}
					?>
						<div class="col-xl-<?php echo esc_attr($desktop_column); ?> col-lg-<?php echo esc_attr($laptop_column); ?> col-md-<?php echo esc_attr($tablet_column); ?> col-sm-<?php echo esc_attr($mobile_column); ?> wow itfadeUp" data-wow-duration=".9s" data-wow-delay=".3s">
							<div class="tr-memorise-item d-flex align-items-center">
								<?php if (!empty($item['icon_type'] == 'font') || !empty($item['icon_type'] == 'image') || !empty($item['icon_type'] == 'svg')) : ?>
									<div class="tr-memorise-icon">
										<span class="hexa-el-icon">
											<?php if ($item['icon_type'] == 'font') {
												\Elementor\Icons_Manager::render_icon($item['icon_font'], ['aria-hidden' => 'true']);
											} ?>
											<?php if ($item['icon_type'] == 'image') { ?>
												<img src="<?php echo esc_attr($item['icon_image']['url']); ?>" alt="<?php echo esc_attr($item['title']); ?>">
											<?php } ?>
											<?php if ($item['icon_type'] == 'svg') { ?>
												<?php echo $item['icon_class']; ?>
											<?php } ?>
										</span>
									</div>
								<?php endif; ?>
								<div class="tr-memorise-content">
									<?php if (!empty($item['title'])) : ?>
										<h4 class="tr-memorise-title hexa-el-title">
											<a class="border-line-white" <?php echo $this->get_render_attribute_string('link_' . $key); ?>>
												<?php echo esc_html($item['title']); ?>
											</a>
										</h4>
									<?php endif; ?>
									<?php if (!empty($item['text'])) : ?>
										<p class="mt-25 mb-0">
											<?php echo esc_html($item['text']); ?>
										</p>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endforeach ?>
				</div>
			</div>
			<!-- memorise-area-end -->



<?php endif;
	}
}

$widgets_manager->register(new Hexa_Tour_Acitivities());
