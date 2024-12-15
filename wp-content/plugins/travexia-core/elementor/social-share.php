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
class Hexa_Social_Share extends Widget_Base
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
        return 'hf-social-share';
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
        return __('Social Share', 'hexacore');
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
            'content_section',
            [
                'label' => __('Content', 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'social_share',
            [
                'label' => __('Social Share Buttons', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => [
                    'facebook'  => __('Facebook', 'hexacore'),
                    'twitter' => __('Twitter', 'hexacore'),
                    'google'  => __('Google Plus', 'hexacore'),
                    'linkedin'  => __('Linkedin', 'hexacore'),
                    'buffer' => __('Buffer', 'hexacore'),
                    'digg'  => __('Digg', 'hexacore'),
                    'reddit' => __('Reddit', 'hexacore'),
                    'tumbleupon'  => __('Tumbleupon', 'hexacore'),
                    'tumblr' => __('Tumblr', 'hexacore'),
                    'vk' => __('Vk', 'hexacore'),
                    'email' => __('Email', 'hexacore'),
                    'print' => __('Print', 'hexacore'),
                ],
                'default' => ['facebook', 'twitter', 'linkedin'],
            ]
        );

        $this->add_responsive_control(
            'text_align',
            [
                'label' => __('Alignment', 'hexacore'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'hexacore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'hexacore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'hexacore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hexa-social-share' => 'text-align: {{VALUE}};',
                ],
                'default' => 'left',
                'toggle' => true,
            ]
        );

        $this->end_controls_section();
    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->hexa_section_style_controls('social_section', 'Section Style', '.ele-section');

        //Style
        $this->start_controls_section(
            'icon_section',
            [
                'label' => __('Icon', 'hexacore'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'select_color',
            [
                'label' => __('Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'default_color',
                'options' => [
                    'default_color'  => __('Official Color', 'hexacore'),
                    'custom_color' => __('Custom', 'hexacore'),
                ],
            ]
        );
        $this->add_control(
            'social_bgcolor',
            [
                'label' => __('Primary Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .hexa-social-share a' => 'background-color: {{VALUE}};'
                ],
                'condition' => [
                    'select_color' => 'custom_color',
                ]
            ]
        );
        $this->add_control(
            'social_color',
            [
                'label' => __('Secondary Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .hexa-social-share a' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'select_color' => 'custom_color',
                ]
            ]
        );
        $this->add_responsive_control(
            'social_size',
            [
                'label' => __('Size', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hexa-social-share a' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'social_padding',
            [
                'label' => __('Padding', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .hexa-social-share a' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'social_space',
            [
                'label' => __('Spacing', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hexa-social-share a:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_control(
            'social_border_radius',
            [
                'label' => __('Border Radius', 'hexacore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .hexa-social-share a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
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

        global $post;
        // Get current page URL 
        $postURL = urlencode(get_permalink());

        // Get current page title
        $postTitle = htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');

        // Get Post Thumbnail for pinterest
        $postThumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');

        // Get current page excerpt
        $postExcerpt = wp_strip_all_tags(get_the_excerpt(), true);

        // Get site name
        $site_title = get_bloginfo('name');

        // Construct sharing URL without using any script
        $twitterURL = 'https://twitter.com/intent/tweet?text=' . $postTitle . '&amp;url=' . $postURL . '&amp;via=' . $site_title;
        $linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $postURL . '&amp;title=' . $postTitle;
        $googleURL = 'https://plus.google.com/share?url=' . $postURL;
        $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u=' . $postURL;
        $bufferURL = 'https://bufferapp.com/add?url=' . $postURL . '&amp;text=' . $postTitle;
        $diggURL = 'https://www.digg.com/submit?url=' . $postURL;
        $redditURL = 'https://reddit.com/submit?url=' . $postURL . '&amp;title=' . $postTitle;
        $stumbleuponURL = 'https://www.stumbleupon.com/submit?url=' . $postURL . '&amp;title=' . $postTitle;
        $tumblrURL = 'https://www.tumblr.com/share/link?url=' . $postURL . '&amp;title=' . $postTitle;
        $vkURL = 'https://vk.com/share.php?url=' . $postURL;
        $mailURL = 'mailto:?Subject=' . $postTitle . '&amp;Body=I%20saw%20this%20and%20thought%20of%20you!%20 ' . $postURL;



        $variable = '';
        $variable .= '<div class="hexa-social-share">';
        foreach ($settings['social_share'] as $item) {
            if ($item == 'facebook') {
                $variable .= '<a class="share-facebook" href="' . $facebookURL . '" target="_blank"><i class="fab fa-facebook-f"></i></a>';
            }
            if ($item == 'twitter') {
                $variable .= '<a class="share-twitter" href="' . $twitterURL . '" target="_blank"><i class="fab fa-twitter"></i></a>';
            }
            if ($item == 'google') {
                $variable .= '<a class="share-google" href="' . $googleURL . '" target="_blank"><i class="fab fa-google-plus-g"></i></a>';
            }
            if ($item == 'linkedin') {
                $variable .= '<a class="share-linkedin" href="' . $linkedInURL . '" target="_blank"><i class="fab fa-linkedin-in"></i></a>';
            }
            if ($item == 'buffer') {
                $variable .= '<a class="share-buffer" href="' . $bufferURL . '" target="_blank"><i class="fab fa-buffer"></i></a>';
            }
            if ($item == 'digg') {
                $variable .= '<a class="share-digg" href="' . $diggURL . '" target="_blank"><i class="fab fa-digg"></i></a>';
            }
            if ($item == 'reddit') {
                $variable .= '<a class="share-reddit" href="' . $redditURL . '" target="_blank"><i class="fab fa-reddit"></i></a>';
            }
            if ($item == 'tumbleupon') {
                $variable .= '<a class="share-tumbleupon" href="' . $stumbleuponURL . '" target="_blank"><i class="fab fa-stumbleupon"></i></a>';
            }
            if ($item == 'tumblr') {
                $variable .= '<a class="share-tumblr" href="' . $tumblrURL . '" target="_blank"><i class="fab fa-tumblr"></i></a>';
            }
            if ($item == 'vk') {
                $variable .= '<a class="share-vk" href="' . $vkURL . '" target="_blank"><i class="fab fa-vk"></i></a>';
            }
            if ($item == 'email') {
                $variable .= '<a class="share-email" href="' . $mailURL . '"><i class="fa fa-envelope"></i></a>';
            }
            if ($item == 'print') {
                $variable .= '<a class="share-print" href="javascript:;" onclick="window.print()"><i class="fa fa-print"></i></a>';
            }
        }
        $variable .= '</div>';

        echo $variable;
    }
}

$widgets_manager->register(new Hexa_Social_Share());
