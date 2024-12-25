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
class Hexa_Iconlist extends Widget_Base
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
		return 'hf-icon-list';
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
		return __('Icon List', 'hexacore');
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
			'section_icon_list',
			[
				'label' => __('Icon List', 'hexacore'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'text',
			[
				'label' => __('Text', 'hexacore'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __('List Menu Item', 'hexacore'),
				'default' => __('List Menu Item', 'hexacore'),
			]
		);

		$repeater->add_control(
			'icon_type',
			[
				'label' => __('Icon Type', 'hexacore'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'font',
				'options' => [
					'font' 	=> __('Font Icon', 'hexacore'),
					'image' => __('Image Icon', 'hexacore'),
					'class' => __('Custom Icon', 'hexacore'),
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
					'url' => get_template_directory_uri() . '/images/analysis.png',
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
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('flaticon-world-globe', 'hexacore'),
				'condition' => [
					'icon_type' => 'class',
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
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
				],
			]
		);

		$this->add_control(
			'menu_list',
			[
				'label'       => '',
				'show_label'  => false,
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'text' => __('List Menu Item #1', 'hexacore'),
					],
					[
						'text' => __('List Menu Item #2', 'hexacore'),
					],
					[
						'text' => __('List Menu Item #3', 'hexacore'),
					],
				],
				'title_field' => '{{{ text }}}',
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

		$this->hexa_card_style_controls('icon_card', 'Wrpper - Style', '.hexa-el-card');
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

			<div class="tr-contact-box">
				<ul>
					<?php foreach ($settings['menu_list'] as $key => $item) :
						if (!empty($item['link']['url'])) {
							$this->add_link_attributes('link_' . $key, $item['link']);
						}
					?>
						<li class="hexa-el-card">
							<span>
								<?php if ($item['icon_type'] == 'font') {
									\Elementor\Icons_Manager::render_icon($item['icon_font'], ['aria-hidden' => 'true']);
								} ?>
								<?php if ($item['icon_type'] == 'image') { ?><img src="<?php echo esc_attr($item['icon_image']['url']); ?>" alt="<?php echo esc_attr($item['title']); ?>"><?php } ?>
								<?php if ($item['icon_type'] == 'class') { ?><i class="<?php echo esc_attr($item['icon_class']); ?>"></i><?php } ?>
								<?php if (!empty($item['text'])) : ?>
									<a class="hexa-el-icon-text" <?php echo $this->get_render_attribute_string('link_' . $key); ?>>
										<?php echo esc_html($item['text']); ?>
									</a>
								<?php endif; ?>
							</span>
						</li>
					<?php endforeach ?>
				</ul>
			</div>

		<?php else : ?>

			<div class="hexa-list-wrapper">
				<ul class="hexa-icon-list <?php echo esc_attr($settings['view']); ?>">
					<?php foreach ($settings['menu_list'] as $key => $item) :
						if (!empty($item['link']['url'])) {
							$this->add_link_attributes('link_' . $key, $item['link']);
						}
					?>
						<li>
							<?php if (!empty($item['icon_type'] == 'font') || !empty($item['icon_type'] == 'image') || !empty($item['icon_type'] == 'class')) : ?>
								<span class="hexa-icon hexa-el-icon">
									<?php if ($item['icon_type'] == 'font') {
										\Elementor\Icons_Manager::render_icon($item['icon_font'], ['aria-hidden' => 'true']);
									} ?>
									<?php if ($item['icon_type'] == 'image') { ?><img src="<?php echo esc_attr($item['icon_image']['url']); ?>" alt="<?php echo esc_attr($item['title']); ?>"><?php } ?>
									<?php if ($item['icon_type'] == 'class') { ?><i class="<?php echo esc_attr($item['icon_class']); ?>"></i><?php } ?>
								</span>
							<?php endif; ?>
							<?php if (!empty($item['text'])) : ?>
								<a class="hexa-el-icon-text" <?php echo $this->get_render_attribute_string('link_' . $key); ?>>
									<span class="ot-icon-list-text"><?php echo esc_html($item['text']); ?></span>
								</a>
							<?php endif; ?>
						</li>
					<?php endforeach ?>
				</ul>
			</div>

<?php endif;
	}
}

$widgets_manager->register(new Hexa_Iconlist());
