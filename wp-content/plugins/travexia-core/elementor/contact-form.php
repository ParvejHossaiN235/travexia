<?php

namespace HexaCore\Widgets;

use Elementor\Widget_Base;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Hexa Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Hexa_Contact_Form extends Widget_Base
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
		return 'hf-contact-form';
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
		return __('Contact Form', 'hexacore');
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


	public function get_hexa_contact_form()
	{
		if (!class_exists('WPCF7')) {
			return;
		}
		$hexa_contact_form = array();
		$hexa_contact_form_args  = array('posts_per_page' => -1, 'post_type' => 'wpcf7_contact_form');
		$hexa_contact_forms      = get_posts($hexa_contact_form_args);
		$hexa_contact_form       = ['0' => esc_html__('Select Form', 'hexacore')];
		if ($hexa_contact_forms) {
			foreach ($hexa_contact_forms as $hexa_form) {
				$hexa_contact_form[$hexa_form->ID] = $hexa_form->post_title;
			}
		} else {
			$hexa_contact_form[esc_html__('No contact form found', 'hexacore')] = 0;
		}
		return $hexa_contact_form;
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
			'corntact_form_section',
			[
				'label' => esc_html__('Contact Form', 'hexacore'),
				'type'    => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'hexa_select_contact_form',
			[
				'label'   => esc_html__('Select Form', 'hexacore'),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '0',
				'options' => $this->get_hexa_contact_form(),
			]
		);

		$this->end_controls_section();
	}

	protected function style_tab_content()
	{
		$this->hexa_input_style_controls('contact_form', 'Form - Style', '.hexa-input', '.hexa-textarea');
		$this->hexa_button_style_controls('form_button', 'Button - Style', '.hexa-el-btn');
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

		<?php if ($settings['hexa_design_layout']  == 'layout_2') : ?>

			<div class="contact-form">

				<?php if (!empty($settings['hexa_select_contact_form'])) : ?>
					<?php echo do_shortcode('[contact-form-7  id="' . $settings['hexa_select_contact_form'] . '"]'); ?>
				<?php else : ?>
					<?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'hexacore') . '</p></div>'; ?>
				<?php endif; ?>
			</div>

		<?php else : ?>

			<div class="hexa-contact-form hexa-form">
				<?php if (!empty($settings['hexa_select_contact_form'])) : ?>
					<?php echo do_shortcode('[contact-form-7  id="' . $settings['hexa_select_contact_form'] . '"]'); ?>
				<?php else : ?>
					<?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'hexacore') . '</p></div>'; ?>
				<?php endif; ?>
			</div>

<?php endif;
	}
}

$widgets_manager->register(new Hexa_Contact_Form());
