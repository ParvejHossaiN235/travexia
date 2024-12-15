<?php

namespace HexaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Hexa Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Hexa_Footer_list extends Widget_Base
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
        return 'hf-footer-list';
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
        return __('Footer List', 'hexacore');
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
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'hexacore'),
                    'layout-2' => esc_html__('Layout 2', 'hexacore'),
                    'layout-3' => esc_html__('Layout 3', 'hexacore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // Service group
        $this->start_controls_section(
            'hexa_services',
            [
                'label' => esc_html__('Footer List', 'hexacore'),
                'description' => esc_html__('Control all the style settings from Style tab', 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'hexa_footer_title',
            [
                'label' => esc_html__('Title', 'hexacore'),
                'description' => hexa_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Footer Title', 'hexacore'),
                'label_block' => true,
            ]
        );


        $this->add_control(
            'hexa_footer_2_column',
            [
                'label' => esc_html__('Enable 2 Columns', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'hexacore'),
                'label_off' => esc_html__('No', 'hexacore'),
                'return_value' => 'yes',
                'default' => 0,
                'separator' => 'before',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'hexa_footer_link_switcher',
            [
                'label' => esc_html__('Add Footer link', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'hexacore'),
                'label_off' => esc_html__('No', 'hexacore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'hexa_footer_btn_text',
            [
                'label' => esc_html__('Link Text', 'hexacore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Link Text', 'hexacore'),
                'title' => esc_html__('Enter link text', 'hexacore'),
                'label_block' => true,
                'condition' => [
                    'hexa_footer_link_switcher' => 'yes'
                ],
            ]
        );
        $repeater->add_control(
            'hexa_footer_link_type',
            [
                'label' => esc_html__('Footer Link Type', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'hexa_footer_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'hexa_footer_link',
            [
                'label' => esc_html__('Footer Link link', 'hexacore'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'hexacore'),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'hexa_footer_link_type' => '1',
                    'hexa_footer_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'hexa_footer_list',
            [
                'label' => esc_html__('Footer - List', 'hexacore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'hexa_footer_btn_text' => esc_html__('Footer Link 1', 'hexacore'),
                    ],
                    [
                        'hexa_footer_btn_text' => esc_html__('Footer Link 2', 'hexacore')
                    ],
                    [
                        'hexa_footer_btn_text' => esc_html__('Footer Link 3', 'hexacore')
                    ]
                ],
                'title_field' => '{{{ hexa_footer_btn_text }}}',
            ]
        );
        $this->end_controls_section();
    }

    protected function style_tab_content()
    {
        $this->hexa_section_style_controls('footer_section', 'Section - Style', '.hf-el-section');
        $this->hexa_basic_style_controls('section_heading', 'Section - Title', '.hf-el-heading');
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

        <?php if ($settings['hexa_design_layout']  == 'layout-2') :
            $this->add_render_attribute('title_args', 'class', 'sectionTitle__big');
        ?>

            <div class="footer-widget footer-col-2 mb-40 hf-el-section <?php echo $settings['hexa_footer_2_column'] ? "enable-2-columns" : NULL; ?>">
                <?php if (!empty($settings['hexa_footer_title'])) : ?>
                    <h4 class="footer-widget-title mb-15 hf-el-heading"><?php echo esc_html($settings['hexa_footer_title']); ?></h4>
                <?php endif; ?>
                <div class="footer-widget-link">
                    <ul>
                        <?php foreach ($settings['hexa_footer_list'] as $key => $item) :
                            // Link
                            if ('2' == $item['hexa_footer_link_type']) {
                                $link = get_permalink($item['hexa_footer_page_link']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['hexa_footer_link']['url']) ? $item['hexa_footer_link']['url'] : '';
                                $target = !empty($item['hexa_footer_link']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['hexa_footer_link']['nofollow']) ? 'nofollow' : '';
                            }
                        ?>
                            <li>
                                <a class="hf-el-title" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>"><?php echo hexa_kses($item['hexa_footer_btn_text']); ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

        <?php elseif ($settings['hexa_design_layout']  == 'layout-3') :
            $this->add_render_attribute('title_args', 'class', 'sectionTitle__big');
        ?>

            <div class="footer-bg3">
                <div class="footer-widget footer-hover-two footer-3-col-2 hf-el-section pl-30 mb-40 <?php echo $settings['hexa_footer_2_column'] ? "enable-2-columns" : NULL; ?>">
                    <?php if (!empty($settings['hexa_footer_title'])) : ?>
                        <h4 class="footer-widget-title mb-15 hf-el-heading"><?php echo esc_html($settings['hexa_footer_title']); ?></h4>
                    <?php endif; ?>
                    <div class="footer-widget-link">
                        <ul>
                            <?php foreach ($settings['hexa_footer_list'] as $key => $item) :
                                // Link
                                if ('2' == $item['hexa_footer_link_type']) {
                                    $link = get_permalink($item['hexa_footer_page_link']);
                                    $target = '_self';
                                    $rel = 'nofollow';
                                } else {
                                    $link = !empty($item['hexa_footer_link']['url']) ? $item['hexa_footer_link']['url'] : '';
                                    $target = !empty($item['hexa_footer_link']['is_external']) ? '_blank' : '';
                                    $rel = !empty($item['hexa_footer_link']['nofollow']) ? 'nofollow' : '';
                                }
                            ?>
                                <li>
                                    <a class="hf-el-title" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>"><?php echo hexa_kses($item['hexa_footer_btn_text']); ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

        <?php else :
            $this->add_render_attribute('title_args', 'class', 'title');
        ?>


            <div class="footer-widget tpfooter-hover footer-5-col-2 mb-40 hf-el-section <?php echo $settings['hexa_footer_2_column'] ? "enable-2-columns" : NULL; ?>">
                <?php if (!empty($settings['hexa_footer_title'])) : ?>
                    <h4 class="footer-widget-title mb-15 hf-el-heading"><?php echo esc_html($settings['hexa_footer_title']); ?></h4>
                <?php endif; ?>
                <div class="footer-widget-link">
                    <ul>
                        <?php foreach ($settings['hexa_footer_list'] as $key => $item) :
                            // Link
                            if ('2' == $item['hexa_footer_link_type']) {
                                $link = get_permalink($item['hexa_footer_page_link']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['hexa_footer_link']['url']) ? $item['hexa_footer_link']['url'] : '';
                                $target = !empty($item['hexa_footer_link']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['hexa_footer_link']['nofollow']) ? 'nofollow' : '';
                            }
                        ?>
                            <li>
                                <a class="hf-el-title" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>"><?php echo hexa_kses($item['hexa_footer_btn_text']); ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

<?php endif;
    }
}

$widgets_manager->register(new Hexa_Footer_list());
