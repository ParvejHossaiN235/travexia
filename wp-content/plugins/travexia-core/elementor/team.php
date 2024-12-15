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
class Hexa_Team extends Widget_Base
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
        return 'hf-team';
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
        return __('Team', 'hexacore');
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

        // member list
        $this->start_controls_section(
            'team_content_section',
            [
                'label' => __('Team Member', 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'member_image',
            [
                'label' => esc_html__('Photo', 'hexacore'),
                'type'  => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_control(
            'member_name',
            [
                'label' => esc_html__('Name', 'hexacore'),
                'type'  => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Coriss Ambady', 'hexacore'),
            ]
        );

        $this->add_control(
            'member_extra',
            [
                'label' => esc_html__('Extra/Job', 'hexacore'),
                'type'  => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Financial Analyst', 'hexacore'),
            ]
        );

        $this->add_control(
            'member_desc',
            [
                'label' => esc_html__('Description', 'hexacore'),
                'type'  => \Elementor\Controls_Manager::TEXTAREA,
                'default' => '',
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'title',
            [
                'label'   => esc_html__('Name', 'hexacore'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Social', 'hexacore'),
            ]
        );

        $repeater->add_control(
            'social_icon',
            [
                'label' => esc_html__('Icon', 'hexacore'),
                'type'  => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fab fa-twitter',
                    'library' => 'fa-brand',
                ],
            ]
        );
        $repeater->add_control(
            'item_icon_color',
            [
                'label' => esc_html__('Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-social {{CURRENT_ITEM}}' => 'color: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_control(
            'item_icon_bgcolor',
            [
                'label' => esc_html__('Background Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-social {{CURRENT_ITEM}}' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_control(
            'social_link',
            [
                'label' => esc_html__('Link', 'hexacore'),
                'type'  => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __('your-link.com', 'hexacore'),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'social_share',
            [
                'label'       => esc_html__('Socials', 'hexacore'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'show_label'  => true,
                'default'     => [
                    [
                        'title'       => esc_html__('Facebook', 'hexacore'),
                        'social_link' => esc_html__('https://www.facebook.com/', 'hexacore'),
                        'social_icon' => [
                            'value' => 'fab fa-facebook-f',
                            'library' => 'fa-brand',
                        ],

                    ],
                    [
                        'title'       => esc_html__('Instagram', 'hexacore'),
                        'social_link' => esc_html__('https://www.instagram.com/', 'hexacore'),
                        'social_icon' => [
                            'value' => 'fab fa-instagram',
                            'library' => 'fa-brand',
                        ],

                    ],
                    [
                        'title'       => esc_html__('Linkedin', 'hexacore'),
                        'social_link' => esc_html__('https://www.linkedin.com/', 'hexacore'),
                        'social_icon' => [
                            'value' => 'fab fa-linkedin-in',
                            'library' => 'fa-brand',
                        ],

                    ]
                ],
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{title}}}',
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __('Link To Details', 'hexacore'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://', 'hexacore'),
            ]
        );

        $this->end_controls_section();
    }

    protected function style_tab_content()
    {
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

        <?php if ($settings['hexa_design_layout'] === 'layout-2') :
            $this->add_render_attribute('title_args', 'class', 'hf-section-title');
        ?>


        <?php else :

            $image_html = \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings, 'member_image_size', 'member_image');
            $tname = $settings['member_name'];

            if (!empty($settings['link']['url'])) {
                $this->add_link_attributes('m_link', $settings['link']);
                $tname = '<a ' . $this->get_render_attribute_string('m_link') . '>' . $tname . '</a>';
            }
        ?>

            <div class="team__wrap team__item text-center">
                <?php if ($settings['member_image']['url']) { ?>
                    <div class="team__thumb bg-solid">
                        <a href="<?php echo $this->get_render_attribute_string('m_link'); ?>">
                            <?php echo wp_kses_post($image_html); ?>
                        </a>
                    </div>
                <?php } ?>

                <div class="team__content">
                    <h6 class="team__title">
                        <?php echo wp_kses_post($tname); ?>
                    </h6>
                    <span class="team__designation">
                        <?php $this->print_unescaped_setting('member_extra') ?>
                    </span>
                    <?php if ($settings['member_desc']) {
                        echo '<p class="mb-2">' . wp_kses_post($settings['member_desc']) . '</p>';
                    } ?>

                    <?php if (!empty($settings['social_share'])) : ?>
                        <div class="team__social">
                            <ul>
                                <?php foreach ($settings['social_share'] as $key => $social) : ?>
                                    <?php
                                    $link_key = 'link_' . $key;
                                    $this->add_render_attribute($link_key, 'class', [
                                        strtolower($social['title']),
                                        'elementor-repeater-item-' . $social['_id'],
                                    ]);
                                    $this->add_link_attributes($link_key, $social['social_link']);
                                    ?>
                                    <li>
                                        <a <?php $this->print_render_attribute_string($link_key); ?>>
                                            <?php \Elementor\Icons_Manager::render_icon($social['social_icon'], ['aria-hidden' => 'true']); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
<?php endif;
    }
}

$widgets_manager->register(new Hexa_Team());
