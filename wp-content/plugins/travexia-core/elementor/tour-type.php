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
class Hexa_Tour_Type extends Widget_Base
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
		return 'hf-tour-type';
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
		return __('Tour Type', 'hexacore');
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
			'section_tour_type',
			[
				'label' => __('Tour Type list', 'hexacore'),
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
				'placeholder' => __('Tour type title', 'hexacore'),
				'default' => __('Tour type title', 'hexacore'),
			]
		);
		$repeater->add_control(
			'locs',
			[
				'label' => __('Locaton', 'hexacore'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
				'placeholder' => __('Tour type location', 'hexacore'),
				'default' => __('Paris, France', 'hexacore'),
			]
		);

		$repeater->add_control(
			'image',
			[
				'label' => esc_html__('Image', 'hexacore'),
				'type'  => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
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
			'tour_types',
			[
				'label'       => '',
				'show_label'  => false,
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'title' => __('Tour type title #1', 'hexacore'),
					],
					[
						'title' => __('Tour type title #2', 'hexacore'),
					],
					[
						'title' => __('Tour type title #3', 'hexacore'),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'image_size',
				'exclude' => ['1536x1536', '2048x2048'],
				'include' => [],
				'default' => 'full',
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
			'section_box_style',
			[
				'label' => __('Card Style', 'hexacore'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->end_controls_section();

		$this->hexa_basic_style_controls('tour_type_title', 'Title - Style', '.hexa-el-title');
		$this->hexa_icon_style_controls('tour_type_text', 'Text - Style', '.hexa-el-text');
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

			<!-- destination-area-start -->
			<div class="tr-destination-area tr-destination-style-2">

				<div class="row justify-content-center">
					<?php foreach ($settings['tour_types'] as $key => $item) :
						if (!empty($item['link']['url'])) {
							$this->add_link_attributes('link_' . $key, $item['link']);
						}
						$image = $item['image']['url'];

					?>
						<div class="col-xl-<?php echo esc_attr($desktop_column); ?> col-lg-<?php echo esc_attr($laptop_column); ?> col-md-<?php echo esc_attr($tablet_column); ?> col-sm-<?php echo esc_attr($mobile_column); ?> wow itfadeUp" data-wow-duration=".9s" data-wow-delay=".3s">
							<div class="tr-destination-item mb-5">
								<?php if (!empty($image)) : ?>
									<div class="tr-destination-thumb fix">
										<img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($item['title']); ?>">
									</div>
								<?php endif; ?>
								<div class="tr-destination-content text-center">
									<?php if (!empty($item['title'])) : ?>
										<h4 class="tr-destination-title hexa-el-title">
											<a class="border-line-black" <?php echo $this->get_render_attribute_string('link_' . $key); ?>>
												<?php echo esc_html($item['title']); ?>
											</a>
										</h4>
									<?php endif; ?>
									<?php if (!empty($item['locs'])) : ?>
										<span class="hexa-el-text"><?php echo esc_html($item['locs']); ?></span>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endforeach ?>
				</div>

			</div>
			<!-- destination-area-end -->

		<?php else : ?>

			<!-- destination-area-start -->
			<div class="tr-destination-area  p-relative z-index-1">

				<div class="row row-gap-30 justify-content-center">
					<?php foreach ($settings['tour_types'] as $key => $item) :
						if (!empty($item['link']['url'])) {
							$this->add_link_attributes('link_' . $key, $item['link']);
						}
						$image = $item['image']['url'];

					?>
						<div class="col-xl-<?php echo esc_attr($desktop_column); ?> col-lg-<?php echo esc_attr($laptop_column); ?> col-md-<?php echo esc_attr($tablet_column); ?> col-sm-<?php echo esc_attr($mobile_column); ?> wow itfadeUp" data-wow-duration=".9s" data-wow-delay=".3s">
							<div class="tr-destination-item">
								<?php if (!empty($image)) : ?>
									<div class="tr-destination-thumb fix">
										<img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($item['title']); ?>">
									</div>
								<?php endif; ?>
								<div class="tr-destination-content text-center">
									<?php if (!empty($item['title'])) : ?>
										<h4 class="tr-destination-title hexa-el-title">
											<a class="border-line-black" <?php echo $this->get_render_attribute_string('link_' . $key); ?>>
												<?php echo esc_html($item['title']); ?>
											</a>
										</h4>
									<?php endif; ?>
									<?php if (!empty($item['locs'])) : ?>
										<span class="hexa-el-text"><?php echo esc_html($item['locs']); ?></span>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endforeach ?>
				</div>
			</div>
			<!-- destination-area-end -->


<?php endif;
	}
}

$widgets_manager->register(new Hexa_Tour_Type());
