<?php

namespace HexaCore\Widgets;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;


if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Hexa Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Hexa_Heading extends Widget_Base
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
		return 'hf-heading';
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
		return __('Heading', 'hexacore');
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
					//'layout-2' => esc_html__('Layout 2', 'hexacore'),
					//'layout-3' => esc_html__('Layout 3', 'hexacore'),
				],
				'default' => 'layout_1',
			]
		);
		$this->end_controls_section();

		// title/content
		$this->start_controls_section(
			'content_section',
			[
				'label' => __('Section Heading', 'hexacore'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label' => __('Subtitle', 'hexacore'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => __('Hexa Subtitle', 'hexacore'),
				'placeholder' => __('Enter your subtitle', 'hexacore'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => 'Title',
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => __('Funden Title', 'hexacore'),
				'placeholder' => __('Enter your title', 'hexacore'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'title_link',
			[
				'label' => esc_html__('Title Link', 'hexacore'),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => ['url', 'is_external', 'nofollow'],
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => false,
				],
				'label_block' => true,
			]
		);
		$this->add_control(
			'title_tag',
			[
				'label' => __('Title HTML Tag', 'hexacore'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h2',
			]
		);

		$this->add_control(
			'desc',
			[
				'label' => 'Description',
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => __('Funden Description', 'hexacore'),
				'placeholder' => __('Enter your description', 'hexacore'),
				'label_block' => true,
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __('Alignment', 'hexacore'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start'    => [
						'title' => __('Left', 'hexacore'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __('Center', 'hexacore'),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => __('Right', 'hexacore'),
						'icon' => 'eicon-text-align-right',
					]
				],
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
				'default' => '',
			]
		);

		$this->end_controls_section();
	}

	protected function style_tab_content()
	{
		$this->hexa_section_style_controls('heading_section', 'Section - Style', '.hexa-el-section');
		//Style title
		$this->hexa_basic_style_controls('heading_subtitle', 'Subtitle - Style', '.hexa-el-subtitle');
		//Style title
		$this->hexa_basic_style_controls('title', 'Title - Style', '.hexa-el-title');
		//Style description
		$this->hexa_basic_style_controls('desc', 'Decription - Style', '.hexa-el-desc');
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
		$html_tag = $settings['title_tag'];
		$title = $settings['title'];
		$this->add_render_attribute('subtitle', 'class', 'hexa-el-subtitle d-inline-block');
		$this->add_render_attribute('title', 'class', 'hexa-el-title');
		$this->add_render_attribute('description', 'class', 'hexa-el-desc');
		if (!empty($settings['title_link']['url'])) {
			$this->add_link_attributes('title_link', $settings['title_link']);
			$title = sprintf('<a %1$s>%2$s</a>', $this->get_render_attribute_string('title_link'), $title);
		}
		$title_html = sprintf('<%1$s %2$s>%3$s</%1$s>', $html_tag, $this->get_render_attribute_string('title'), $title);
		$subtitle_html = sprintf('<span %1$s>%2$s</span>', $this->get_render_attribute_string('subtitle'), $settings['subtitle']);
		$desc_html = sprintf('<p %1$s>%2$s</p>', $this->get_render_attribute_string('description'), $settings['desc']);
?>

		<?php if ($settings['hexa_design_layout']  == 'layout_2') : ?>


		<?php else : ?>
			<div class="hexa-heading">
				<?php if (!empty($settings['subtitle'])) {
					echo $subtitle_html;
				} ?>
				<?php if (!empty($settings['title'])) {
					echo $title_html;
				} ?>
				<?php if (!empty($settings['desc'])) {
					echo $desc_html;
				} ?>
			</div>
<?php endif;
	}
}


$widgets_manager->register(new Hexa_Heading());
