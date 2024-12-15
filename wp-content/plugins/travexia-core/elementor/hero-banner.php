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
class Hexa_Hero_Banner extends Widget_Base
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
        return 'hf-hero-banner';
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
        return __('Hero Banner', 'hexacore');
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


    protected static function get_profile_names()
    {
        return [
            '500px' => esc_html__('500px', 'hexacore'),
            'apple' => esc_html__('Apple', 'hexacore'),
            'behance' => esc_html__('Behance', 'hexacore'),
            'bitbucket' => esc_html__('BitBucket', 'hexacore'),
            'codepen' => esc_html__('CodePen', 'hexacore'),
            'delicious' => esc_html__('Delicious', 'hexacore'),
            'deviantart' => esc_html__('DeviantArt', 'hexacore'),
            'digg' => esc_html__('Digg', 'hexacore'),
            'dribbble' => esc_html__('Dribbble', 'hexacore'),
            'email' => esc_html__('Email', 'hexacore'),
            'facebook-f' => esc_html__('Facebook', 'hexacore'),
            'flickr' => esc_html__('Flicker', 'hexacore'),
            'foursquare' => esc_html__('FourSquare', 'hexacore'),
            'github' => esc_html__('Github', 'hexacore'),
            'houzz' => esc_html__('Houzz', 'hexacore'),
            'instagram' => esc_html__('Instagram', 'hexacore'),
            'jsfiddle' => esc_html__('JS Fiddle', 'hexacore'),
            'linkedin' => esc_html__('LinkedIn', 'hexacore'),
            'medium' => esc_html__('Medium', 'hexacore'),
            'pinterest' => esc_html__('Pinterest', 'hexacore'),
            'product-hunt' => esc_html__('Product Hunt', 'hexacore'),
            'reddit' => esc_html__('Reddit', 'hexacore'),
            'slideshare' => esc_html__('Slide Share', 'hexacore'),
            'snapchat' => esc_html__('Snapchat', 'hexacore'),
            'soundcloud' => esc_html__('SoundCloud', 'hexacore'),
            'spotify' => esc_html__('Spotify', 'hexacore'),
            'stack-overflow' => esc_html__('StackOverflow', 'hexacore'),
            'tripadvisor' => esc_html__('TripAdvisor', 'hexacore'),
            'tumblr' => esc_html__('Tumblr', 'hexacore'),
            'twitch' => esc_html__('Twitch', 'hexacore'),
            'twitter' => esc_html__('Twitter', 'hexacore'),
            'vimeo' => esc_html__('Vimeo', 'hexacore'),
            'vk' => esc_html__('VK', 'hexacore'),
            'website' => esc_html__('Website', 'hexacore'),
            'whatsapp' => esc_html__('WhatsApp', 'hexacore'),
            'wordpress' => esc_html__('WordPress', 'hexacore'),
            'xing' => esc_html__('Xing', 'hexacore'),
            'yelp' => esc_html__('Yelp', 'hexacore'),
            'youtube' => esc_html__('YouTube', 'hexacore'),
        ];
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
                    // 'layout-3' => esc_html__('Layout 3', 'hexacore'),
                    // 'layout-4' => esc_html__('Layout 4', 'hexacore'),
                    // 'layout-5' => esc_html__('Layout 5', 'hexacore'),
                ],
                'default' => 'layout_1',
            ]
        );

        $this->end_controls_section();

        // hero slider
        $this->start_controls_section(
            'section_hero_slider',
            [
                'label' => __('Banner Content', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'image',
            [
                'label' => __('Image', 'hexacore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'bg_image',
            [
                'label' => __('Background Image', 'hexacore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => __('Subtitle', 'hexacore'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Banner subtitle', 'hexacore'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Banner title', 'hexacore'),
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
                'default' => 'h1',
            ]
        );

        $this->add_control(
            'desc',
            [
                'label' => __('Description', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => '10',
                'label_block' => true,
                'default' => __('Cum sociis natoque penatibus et magnis dis parturient montes.', 'hexacore'),
            ]
        );

        $this->add_control(
            'btn_text',
            [
                'label' => __('Button One', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Click here', 'hexacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'btn_link',
            [
                'label' => esc_html__('Link One', 'hexacore'),
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
            'btn_text2',
            [
                'label' => __('Button Two', 'hexacore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Click here', 'hexacore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'btn_link2',
            [
                'label' => esc_html__('Link Two', 'hexacore'),
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


        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'simage_size',
                'exclude' => ['1536x1536', '2048x2048'],
                'include' => [],
                'default' => 'full',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'social_profile',
            [
                'label' => esc_html__('Social Profiles', 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'hexa_design_layout' => 'layout_2'
                ]
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Profile Name', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'select2options' => [
                    'allowClear' => false,
                ],
                'options' => self::get_profile_names()
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Profile Link', 'hexacore'),
                'placeholder' => esc_html__('Add your profile link', 'hexacore'),
                'type' => \Elementor\Controls_Manager::URL,
                'label_block' => true,
                'autocomplete' => false,
                'show_external' => false,
                'condition' => [
                    'name!' => 'email'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $this->add_control(
            'profiles',
            [
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(name.slice(0,1).toUpperCase() + name.slice(1)) #>',
                'default' => [
                    [
                        'link' => ['url' => 'https://facebook.com/'],
                        'name' => 'facebook-f'
                    ],
                    [
                        'link' => ['url' => 'https://linkedin.com/'],
                        'name' => 'linkedin'
                    ],
                    [
                        'link' => ['url' => 'https://twitter.com/'],
                        'name' => 'twitter'
                    ]
                ],
            ]
        );

        $this->end_controls_section();
    }

    // style_tab_content
    protected function style_tab_content()
    {

        $this->hexa_section_style_controls('banner_section', 'Section Style', '.ele-section');
        $this->hexa_basic_style_controls('section_subtitle', 'Section - Subtitle', '.hf-el-subtitle');
        $this->hexa_basic_style_controls('section_title', 'Section - Title', '.hf-el-title');
        $this->hexa_basic_style_controls('section_desc', 'Section - Description', '.hf-el-content');
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

?>

        <?php if ($settings['hexa_design_layout']  == 'layout-2') :

            $image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src($settings['image']['id'], 'simage_size', $settings);
            if (empty($image_url)) {
                $image_url = \Elementor\Utils::get_placeholder_image_src();
            }
            $image_html = '<img src="' . esc_attr($image_url) . '" alt="' . esc_attr($settings['title']) . '">';

            // button one
            if (!empty($settings['btn_link']['url'])) {
                $this->add_link_attributes('button', $settings['btn_link']);
            }
            $this->add_render_attribute('button', 'class', 'bd-btn is-btn-anim hexa-el-btn');

        ?>


            <div class="hfcontact-info-social">
                <?php
                foreach ($settings['profiles'] as $profile) :
                    $icon = $profile['name'];
                    $url = esc_url($profile['link']['url']);
                    printf(
                        '<a target="_blank" rel="noopener"  href="%s" class="elementor-repeater-item-%s"><i class="hf-el-rep-social mr-5 hf-el-sicon fa-brands fa-%s" aria-hidden="true"></i></a>',
                        $url,
                        esc_attr($profile['_id']),
                        esc_attr($icon)
                    );
                endforeach;
                ?>
            </div>

        <?php else :

            //bg image
            $bg_image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src($settings['bg_image']['id'], 'simage_size', $settings);
            if (empty($bg_image_url)) {
                $bg_image_url = \Elementor\Utils::get_placeholder_image_src();
            }
            // normal image
            $image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src($settings['image']['id'], 'simage_size', $settings);
            if (empty($image_url)) {
                $image_url = \Elementor\Utils::get_placeholder_image_src();
            }
            $image_html = '<img src="' . esc_attr($image_url) . '" alt="' . esc_attr($settings['title']) . '">';
            // button one
            if (!empty($settings['btn_link']['url'])) {
                $this->add_link_attributes('button', $settings['btn_link']);
            }
            $this->add_render_attribute('button', 'class', 'bd-btn is-btn-anim hexa-el-btn');
            // button two
            if (!empty($settings['btn_link2']['url'])) {
                $this->add_link_attributes('button2', $settings['btn_link2']);
            }
            $this->add_render_attribute('button2', 'class', 'bd-btn is-btn-anim hexa-el-btn2');

            //title
            $this->add_render_attribute('title', 'class', 'banner__title large wow fadeInUp hexa-el-title');
            $this->add_render_attribute('title', 'data-wow-delay', '0.3s');
            $this->add_render_attribute('title', 'data-wow-duration', '0.7s');
            $title_html = sprintf('<%1$s %2$s>%3$s</%1$s>', $html_tag, $this->get_render_attribute_string('title'), $title);

        ?>
            <!-- Banner area start -->
            <section class="banner__area banner-height d-flex align-items-center style-two p-relative fix">
                <?php if (!empty($settings['bg_image']['url'])) : ?>
                    <div class="bg__thumb-position include-bg" data-background="<?php echo esc_attr($bg_image_url); ?>"></div>
                <?php endif; ?>
                <!-- social -->
                <div class="theme__social banner-social style-two">
                    <a href="#"><i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="#"><i class="icon-twiter"></i>
                    </a>
                    <a href="#"><i class="fa-brands fa-linkedin"></i>
                    </a>
                    <a href="#"><i class="fa-brands fa-behance"></i>
                    </a>
                </div>
                <!-- when slide active remove this class -->
                <div class="swiper banner__active overflow-visible">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide banner_more_item">
                            <div class="container">
                                <div class="row align-items-center gy-5">
                                    <div class="col-xxl-5 col-xl-6 col-lg-6">
                                        <div class="banner__content p-relative">

                                            <?php if (!empty($settings['title'])) {
                                                echo $title_html;
                                            } ?>

                                            <?php if (!empty($settings['desc'])) : ?>
                                                <p class="wow fadeInUp" data-wow-delay=".4s" data-wow-duration=".9s">
                                                    <?php echo wp_kses_post($settings['desc']); ?>
                                                </p>
                                            <?php endif; ?>

                                            <div class="banner__btn wow fadeInUp" data-wow-delay=".6s" data-wow-duration="1.1s">
                                                <a <?php echo $this->get_render_attribute_string('button'); ?>>
                                                    <span class="bd-btn-inner">
                                                        <span class="bd-btn-normal">
                                                            <?php echo wp_kses_post($settings['btn_text']); ?>
                                                        </span>
                                                        <span class="bd-btn-hover">
                                                            <?php echo wp_kses_post($settings['btn_text']); ?>
                                                        </span>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-7 col-xl-6 col-lg-6">
                                        <div class="banner__thumb-wrapper wow fadeInRight" data-wow-delay=".8s" data-wow-duration="1.2s">
                                            <div class="banner__bg"></div>
                                            <div class="banner__thumb">
                                                <?php if (!empty($settings['image']['url'])) {
                                                    echo wp_kses_post($image_html);
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Banner area end -->




<?php endif;
    }
}

$widgets_manager->register(new Hexa_Hero_Banner());
