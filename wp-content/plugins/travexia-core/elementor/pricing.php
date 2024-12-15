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
class Hexa_Pricing extends Widget_Base
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
        return 'hf-pricing';
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
        return __('Pricing', 'hexacore');
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

        $this->start_controls_section(
            '_section_design_title',
            [
                'label' => __('Design Style', 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'hexa_design_layout',
            [
                'label' => esc_html__('Select Layout', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'layout_1' => esc_html__('Layout 1', 'hexacore'),
                    //'layout_2' => esc_html__('Layout 2', 'hexacore'),
                ],
                'default' => 'layout_1',
            ]
        );

        $this->add_control(
            'active_price',
            [
                'label' => __('Active Price', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'hexacore'),
                'label_off' => __('Hide', 'hexacore'),
                'return_value' => 'yes',
                'default' => false,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        // Header
        $this->start_controls_section(
            'section_header_price',
            [
                'label' => __('Header', 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => __('Title', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Basic', 'hexacore'),
            ]
        );
        $this->add_control(
            'desc',
            [
                'label' => __('Description', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => __('An introductory section that provides an overview of the document', 'hexacore'),
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_pricing_price',
            [
                'label' => __('Pricing', 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'currency',
            [
                'label' => __('Currency', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    '' => __('None', 'hexacore'),
                    'baht' => '&#3647; ' . _x('Baht', 'Currency Symbol', 'hexacore'),
                    'bdt' => '&#2547; ' . _x('BD Taka', 'Currency Symbol', 'hexacore'),
                    'dollar' => '&#36; ' . _x('Dollar', 'Currency Symbol', 'hexacore'),
                    'euro' => '&#128; ' . _x('Euro', 'Currency Symbol', 'hexacore'),
                    'franc' => '&#8355; ' . _x('Franc', 'Currency Symbol', 'hexacore'),
                    'guilder' => '&fnof; ' . _x('Guilder', 'Currency Symbol', 'hexacore'),
                    'krona' => 'kr ' . _x('Krona', 'Currency Symbol', 'hexacore'),
                    'lira' => '&#8356; ' . _x('Lira', 'Currency Symbol', 'hexacore'),
                    'peso' => '&#8369; ' . _x('Peso', 'Currency Symbol', 'hexacore'),
                    'pound' => '&#163; ' . _x('Pound Sterling', 'Currency Symbol', 'hexacore'),
                    'real' => 'R$ ' . _x('Real', 'Currency Symbol', 'hexacore'),
                    'ruble' => '&#8381; ' . _x('Ruble', 'Currency Symbol', 'hexacore'),
                    'indian_rupee' => '&#8377; ' . _x('Rupee (Indian)', 'Currency Symbol', 'hexacore'),
                    'shekel' => '&#8362; ' . _x('Shekel', 'Currency Symbol', 'hexacore'),
                    'won' => '&#8361; ' . _x('Won', 'Currency Symbol', 'hexacore'),
                    'yen' => '&#165; ' . _x('Yen/Yuan', 'Currency Symbol', 'hexacore'),
                    'custom' => __('Custom', 'hexacore'),
                ],
                'default' => 'dollar',
            ]
        );

        $this->add_control(
            'currency_custom',
            [
                'label' => __('Custom Symbol', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'currency' => 'custom',
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $this->add_control(
            'price',
            [
                'label' => __('Price', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '9.99',
                'dynamic' => [
                    'active' => true
                ]
            ]
        );
        $this->add_control(
            'month_year',
            [
                'label' => __('Month / Year', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Monthly',
                'dynamic' => [
                    'active' => true
                ]
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_feature_price',
            [
                'label' => __('Features', 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_features',
            [
                'label' => __('Show', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'hexacore'),
                'label_off' => __('Hide', 'hexacore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'feature_unavailable',
            [
                'label' => __('Feature Hide ?', 'bdevs-element'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-element'),
                'label_off' => __('Hide', 'bdevs-element'),
                'return_value' => 'yes',
                'default' => 0,
                'style_transfer' => true,
            ]
        );
        $repeater->add_control(
            'icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'class',
                'options' => [
                    'icon' => esc_html__('Icon', 'hexacore'),
                    'class' => esc_html__('Class', 'hexacore'),
                ],
            ]
        );
        $repeater->add_control(
            'icon_class',
            [
                'label' => __('Custom Class', 'hexacore'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('fa-regular fa-check', 'hexacore'),
                'condition' => [
                    'icon_type' => 'class',
                ]
            ]
        );
        $repeater->add_control(
            'selected_icon',
            [
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'label_block' => true,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
                'condition' => [
                    'icon_type' => 'icon',
                ]
            ]
        );
        $repeater->add_control(
            'feature_text',
            [
                'label' => __('Feature Text', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Exciting Feature', 'hexacore'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->add_control(
            'features_list',
            [
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'show_label' => false,
                'default' => [
                    [
                        'feature_text' => __('Standard Feature', 'hexacore'),
                        'hexa_check_icon' => 'fa fa-check',
                    ],
                    [
                        'feature_text' => __('Another Great Feature', 'hexacore'),
                        'hexa_check_icon' => 'fa fa-check',
                    ],
                    [
                        'feature_text' => __('Obsolete Feature', 'hexacore'),
                        'hexa_check_icon' => 'fa fa-close',
                    ],
                ],
                'title_field' => '{{{ feature_text }}}',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'hexa_button_section',
            [
                'label' => esc_html__('Button', 'hexacore'),
            ]
        );

        $this->add_control(
            'btn_text',
            [
                'label' => esc_html__('Label', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Click Here', 'hexacore'),
                'title' => esc_html__('Enter button text', 'hexacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'btn_link',
            [
                'label' => esc_html__('link', 'hexacore'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'hexacore'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                ],
                'label_block' => true,
            ]
        );
        $this->end_controls_section();
    }



    // style_tab_content
    protected function style_tab_content()
    {
        $this->hexa_section_style_controls('pricing_section', 'Section - Style', '.hf-el-section');
    }

    private static function get_currency_symbol($symbol_name)
    {
        $symbols = [
            'baht' => '&#3647;',
            'bdt' => '&#2547;',
            'dollar' => '&#36;',
            'euro' => '&#128;',
            'franc' => '&#8355;',
            'guilder' => '&fnof;',
            'indian_rupee' => '&#8377;',
            'pound' => '&#163;',
            'peso' => '&#8369;',
            'peseta' => '&#8359',
            'lira' => '&#8356;',
            'ruble' => '&#8381;',
            'shekel' => '&#8362;',
            'rupee' => '&#8360;',
            'real' => 'R$',
            'krona' => 'kr',
            'won' => '&#8361;',
            'yen' => '&#165;',
        ];

        return isset($symbols[$symbol_name]) ? $symbols[$symbol_name] : '';
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

        <?php if ($settings['hexa_design_layout']  == 'layout-2') : ?>

        <?php else :

            if (!empty($settings['btn_link']['url'])) {
                $this->add_link_attributes('button', $settings['btn_link']);
            }
            $this->add_render_attribute('button', 'class', 'bd-btn bordered-light w-100 hexa-el-btn');

            if ($settings['currency'] === 'custom') {
                $currency = $settings['currency_custom'];
            } else {
                $currency = self::get_currency_symbol($settings['currency']);
            }
            $item_active = $settings['active_price'] ? 'active' : '';
        ?>


            <div class="pricing__wrapper pricing__item style-three">
                <div class="pricing__content">
                    <?php if (!empty($title)) : ?>
                        <h5 class="large pricing__title">
                            <?php echo wp_kses_post($title); ?>
                        </h5>
                    <?php endif; ?>
                    <?php if (!empty($desc)) : ?>
                        <p class="pricing__description">
                            <?php echo wp_kses_post($desc); ?>
                        </p>
                    <?php endif; ?>
                    <?php if (!empty($price)) : ?>
                        <h2 class="pricing__amount">
                            <span class="dollar-sign color-primary"><?php echo esc_html($currency); ?></span>
                            <?php echo wp_kses_post($price); ?>
                            <span class="duration"><?php echo wp_kses_post($month_year); ?></span>
                        </h2>
                    <?php endif; ?>
                </div>
                <?php if (!empty($show_features)) : ?>
                    <div class="pricing__feature">
                        <ul class="pricing__list">
                            <?php foreach ($settings['features_list'] as $key => $item) : ?>
                                <li class="<?php echo $item['feature_unavailable'] ? "inactive" : NULL; ?>">
                                    <?php if ($item['icon_type'] == 'icon') : ?>
                                        <?php if (!empty($item['selected_icon']['value'])) : ?>
                                            <span class="hexa-el-icon hexa-icon icon__box">
                                                <?php \Elementor\Icons_Manager::render_icon($item['selected_icon'], ['aria-hidden' => 'true']); ?>
                                            </span>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <?php if (!empty($item['icon_class'])) : ?>
                                            <span class="hexa-el-icon hexa-icon icon__box">
                                                <i class="<?php echo esc_attr($item['icon_class']); ?>"></i>
                                            </span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <p><?php echo wp_kses_post($item['feature_text']); ?></p>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php if (!empty($btn_text)) : ?>
                    <div class="pricing__btn">
                        <a <?php echo $this->get_render_attribute_string('button'); ?>>
                            <?php $this->print_unescaped_setting('btn_text'); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

<?php endif;
    }
}

$widgets_manager->register(new Hexa_Pricing());
