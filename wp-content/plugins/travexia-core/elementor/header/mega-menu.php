<?php

namespace HexaCore\Widgets;

use \Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Hexa_Menu_Demo extends Widget_Base
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
		return 'hf-mega-menu';
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
		return __('Mega Menu', 'hexacore');
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
		return ['hexacore_header'];
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

	protected $nav_menu_index = 1;

	/**
	 * Retrieve the menu index.
	 *
	 * Used to get index of nav menu.
	 *
	 * @since 1.3.0
	 * @access protected
	 *
	 * @return string nav index.
	 */
	protected function get_nav_menu_index()
	{
		return $this->nav_menu_index++;
	}

	private function get_available_menus()
	{

		$menus = wp_get_nav_menus();

		$options = [];

		foreach ($menus as $menu) {
			$options[$menu->slug] = $menu->name;
		}

		return $options;
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

		$this->start_controls_section(
			'hexa_list_sec',
			[
				'label' => esc_html__('Image List', 'hexacore'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'hexa_menu_title',
			[
				'label'   => esc_html__('Title', 'hexacore'),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__('Default-value', 'hexacore'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'hexa_image',
			[
				'type' => Controls_Manager::MEDIA,
				'label' => __('Image', 'hexacore'),
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$repeater->add_control(
			'hexa_button_title',
			[
				'label'   => esc_html__('Button Title', 'hexacore'),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__('Button 1', 'hexacore'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'hexa_button_url',
			[
				'label'   => esc_html__('Button URL', 'hexacore'),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__('#', 'hexacore'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'hexa_menu_list',
			[
				'label'       => esc_html__('Menu List', 'hexacore'),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'hexa_menu_title'   => esc_html__('Menu Item 1', 'hexacore'),
					],
					[
						'hexa_menu_title'   => esc_html__('Menu Item 2', 'hexacore'),
					],
					[
						'hexa_menu_title'   => esc_html__('Menu Item 3', 'hexacore'),
					],
				],
				'title_field' => '{{{ hexa_menu_title }}}',
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'medium_large',
				'separator' => 'before',
				'exclude' => [
					'custom'
				]
			]
		);

		$this->end_controls_section();
	}

	protected function style_tab_content()
	{
		$this->hexa_section_style_controls('section', 'Section', '.hf-el-section');
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


?>

		<div class="row gx-6 row-cols-1 row-cols-md-2 row-cols-xl-5 row-cols-xxl-5 hf-el-section">

			<?php foreach ($settings['hexa_menu_list'] as $key => $item) :
				if (!empty($item['hexa_image']['url'])) {
					$hexa_image_url = !empty($item['hexa_image']['id']) ? wp_get_attachment_image_url($item['hexa_image']['id'], $settings['thumbnail_size']) : $item['hexa_image']['url'];
					$hexa_image_alt = get_post_meta($item["hexa_image"]["id"], "_wp_attachment_image_alt", true);
				}

			?>
				<div class="col homemenu">
					<?php if (!empty($hexa_image_url)) : ?>
						<div class="homemenu-thumb mb-15">
							<img class="tpMegaImg" src="<?php echo esc_url($hexa_image_url); ?>" alt="<?php echo esc_attr($hexa_image_alt); ?>">
							<?php if (!empty($item['hexa_button_title'])) : ?>
								<div class="homemenu-btn">
									<a class="hf-menu-btn megaBtn" href="<?php echo esc_url($item['hexa_button_url']); ?>"><?php echo hexa_kses($item['hexa_button_title']); ?></a>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>
					<div class="homemenu-content text-center">
						<?php if (!empty($item['hexa_menu_title'])) : ?>
							<h4 class="homemenu-title megaTitle">
								<?php if (!empty($item['hexa_button_url'])) : ?>
									<a href="<?php echo esc_url($item['hexa_button_url']); ?>"><?php echo hexa_kses($item['hexa_menu_title']); ?></a>
								<?php else : ?>
									<?php echo hexa_kses($item['hexa_menu_title']); ?>
								<?php endif; ?>
							</h4>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>

		</div>

<?php
	}
}

$widgets_manager->register(new Hexa_Menu_Demo());
