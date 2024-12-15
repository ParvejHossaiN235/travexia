<?php

namespace HexaCore\Widgets;

if (!defined('ABSPATH')) exit; // Exit if accessed directly



/**
 * Get a translatable string with allowed html tags.
 *
 * @param string $level Allowed levels are basic and intermediate
 * @return string
 */
function hexa_get_allowed_html_desc($level = 'basic')
{
    if (!in_array($level, ['basic', 'intermediate', 'advance'])) {
        $level = 'basic';
    }

    $tags_str = '<' . implode('>,<', array_keys(hexa_get_allowed_html_tags($level))) . '>';
    return sprintf(__('This input field has support for the following HTML tags: %1$s', 'hexacore'), '<code>' . esc_html($tags_str) . '</code>');
}

/**
 * Get a list of all the allowed html tags.
 *
 * @param string $level Allowed levels are basic and intermediate
 * @return array
 */
function hexa_get_allowed_html_tags($level = 'basic')
{
    $allowed_html = [
        'b' => [],
        'i' => [
            'class' => [],
        ],
        'u' => [],
        'em' => [],
        'br' => [],
        'abbr' => [
            'title' => [],
        ],
        'span' => [
            'class' => [],
        ],
        'strong' => [],
    ];

    if ($level === 'intermediate') {
        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
            'target' => [],
        ];
    }

    if ($level === 'advance') {
        $allowed_html['ul'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['ol'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['li'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
            'target' => [],
        ];
    }
    return $allowed_html;
}

// WP kses allowed tags
function hexa_kses($raw)
{

    $allowed_tags = array(
        'a'                         => array(
            'class'   => array(),
            'href'    => array(),
            'rel'  => array(),
            'title'   => array(),
            'target' => array(),
        ),
        'abbr'                      => array(
            'title' => array(),
        ),
        'b'                         => array(),
        'blockquote'                => array(
            'cite' => array(),
        ),
        'cite'                      => array(
            'title' => array(),
        ),
        'code'                      => array(),
        'del'                    => array(
            'datetime'   => array(),
            'title'      => array(),
        ),
        'dd'                     => array(),
        'div'                    => array(
            'class'   => array(),
            'title'   => array(),
            'style'   => array(),
        ),
        'dl'                     => array(),
        'dt'                     => array(),
        'em'                     => array(),
        'h1'                     => array(
            'class'   => array(),
        ),
        'h2'                     => array(
            'class'   => array(),
        ),
        'h3'                     => array(
            'class'   => array(),
        ),
        'h4'                     => array(
            'class'   => array(),
        ),
        'h5'                     => array(
            'class'   => array(),
        ),
        'h6'                     => array(
            'class'   => array(),
        ),
        'i'                         => array(
            'class' => array(),
        ),
        'img'                    => array(
            'alt'  => array(),
            'class'   => array(),
            'height' => array(),
            'src'  => array(),
            'width'   => array(),
        ),
        'li'                     => array(
            'class' => array(),
        ),
        'ol'                     => array(
            'class' => array(),
        ),
        'p'                         => array(
            'class' => array(),
        ),
        'q'                         => array(
            'cite'    => array(),
            'title'   => array(),
        ),
        'span'                      => array(
            'class'   => array(),
            'title'   => array(),
            'style'   => array(),
        ),
        'iframe'                 => array(
            'width'         => array(),
            'height'     => array(),
            'scrolling'     => array(),
            'frameborder'   => array(),
            'allow'         => array(),
            'src'        => array(),
        ),
        'strike'                 => array(),
        'br'                     => array(),
        'strong'                 => array(),
        'data-wow-duration'            => array(),
        'data-wow-delay'            => array(),
        'data-wallpaper-options'       => array(),
        'data-stellar-background-ratio'   => array(),
        'ul'                     => array(
            'class' => array(),
        ),
        'svg' => array(
            'class' => true,
            'aria-hidden' => true,
            'aria-labelledby' => true,
            'role' => true,
            'xmlns' => true,
            'width' => true,
            'height' => true,
            'fill' => true,
            'viewbox' => true, // <= Must be lower case!
        ),
        'g'     => array('fill' => true),
        'title' => array('title' => true),
        'path'  => array(
            'd' => true,
            'fill' => true,
            'stroke' => true,
            'stroke-width' => true,
            'stroke-linecap' => true,
            'stroke-linejoin' => true,

        ),
    );

    if (function_exists('wp_kses')) { // WP is here
        $allowed = wp_kses($raw, $allowed_tags, []);
    } else {
        $allowed = $raw;
    }

    return $allowed;
}

/**
 * Check elementor version
 *
 * @param string $version
 * @param string $operator
 * @return bool
 */
if (!function_exists('hexa_is_elementor_version')) {
    function hexa_is_elementor_version($operator = '<', $version = '2.6.0')
    {
        return defined('ELEMENTOR_VERSION') && version_compare(ELEMENTOR_VERSION, $version, $operator);
    }
}

/**
 * Render icon html with backward compatibility
 *
 * @param array $settings
 * @param string $old_icon_id
 * @param string $new_icon_id
 * @param array $attributes
 */


if (!function_exists('hexa_render_icon')) {
    function hexa_render_icon($settings = [], $old_icon_id = 'icon', $new_icon_id = 'selected_icon', $attributes = [])
    {
        // Check if its already migrated
        $migrated = isset($settings['__fa4_migrated'][$new_icon_id]);
        // Check if its a new widget without previously selected icon using the old Icon control
        $is_new = empty($settings[$old_icon_id]);

        $attributes['aria-hidden'] = 'true';

        if (hexa_is_elementor_version('>=', '2.6.0') && ($is_new || $migrated)) {
            \Elementor\Icons_Manager::render_icon($settings[$new_icon_id], $attributes);
        } else {
            if (empty($attributes['class'])) {
                $attributes['class'] = $settings[$old_icon_id];
            } else {
                if (is_array($attributes['class'])) {
                    $attributes['class'][] = $settings[$old_icon_id];
                } else {
                    $attributes['class'] .= ' ' . $settings[$old_icon_id];
                }
            }
            printf('<i %s></i>', \Elementor\Utils::render_html_attributes($attributes));
        }
    }
}


/**
 * Get all types of post.
 *
 * @param string $post_type
 *
 * @return array
 */
function get_post_list($post_type = 'any')
{
    return get_query_post_list($post_type);
}


/**
 * @param string $post_type
 * @param int $limit
 * @param string $search
 * @return array
 */
function get_query_post_list($post_type = 'any', $limit = -1, $search = '')
{
    global $wpdb;
    $where = '';
    $data = [];

    if (-1 == $limit) {
        $limit = '';
    } elseif (0 == $limit) {
        $limit = "limit 0,1";
    } else {
        $limit = $wpdb->prepare(" limit 0,%d", esc_sql($limit));
    }

    if ('any' === $post_type) {
        $in_search_post_types = get_post_types(['exclude_from_search' => false]);
        if (empty($in_search_post_types)) {
            $where .= ' AND 1=0 ';
        } else {
            $where .= " AND {$wpdb->posts}.post_type IN ('" . join(
                "', '",
                array_map('esc_sql', $in_search_post_types)
            ) . "')";
        }
    } elseif (!empty($post_type)) {
        $where .= $wpdb->prepare(" AND {$wpdb->posts}.post_type = %s", esc_sql($post_type));
    }

    if (!empty($search)) {
        $where .= $wpdb->prepare(" AND {$wpdb->posts}.post_title LIKE %s", '%' . esc_sql($search) . '%');
    }

    $query = "select post_title,ID  from $wpdb->posts where post_status = 'publish' $where $limit";
    $results = $wpdb->get_results($query);
    if (!empty($results)) {
        foreach ($results as $row) {
            $data[$row->ID] = $row->post_title;
        }
    }
    return $data;
}

/**
 * Get all elementor page templates
 *
 * @param null $type
 *
 * @return array
 */
function get_elementor_templates($type = null)
{
    $options = [];

    if ($type) {
        $args = [
            'post_type' => 'elementor_library',
            'posts_per_page' => -1,
        ];
        $args['tax_query'] = [
            [
                'taxonomy' => 'elementor_library_type',
                'field' => 'slug',
                'terms' => $type,
            ],
        ];

        $page_templates = get_posts($args);

        if (!empty($page_templates) && !is_wp_error($page_templates)) {
            foreach ($page_templates as $post) {
                $options[$post->ID] = $post->post_title;
            }
        }
    } else {
        $options = get_query_post_list('elementor_library');
    }

    return $options;
}

/**
 * Slugify
 */
if (!function_exists('hexa_slugify')) {
    function hexa_slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}

// Use the following code to get ride of autop (automatic <p> tag) and line breaking tag (<br> tag).
add_filter('wpcf7_autop_or_not', '__return_false');

/**
 * Element Common Functions
 */
trait HexaCoreElementFunctions
{
    /**
     * @param null $control_id
     * @param string $control_name
     * @param string $selector
     */


    /*
    *  Section style control
    1. $control_id -> Tab ID
    2. $control_name -> Tab Title
    3. $control_selector -> Selector Class or ID
    */
    protected function hexa_section_style_controls($control_id = null, $control_name = null, $control_selector = null)
    {

        $this->start_controls_section(
            'hexa_' . $control_id . '_area_styling',
            [
                'label' => esc_html__($control_name, 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'hexa_' . $control_id . 'area_background',
                'label' => esc_html__('Background Color', 'hexacore'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image', 'video'],
                'selector' => '{{WRAPPER}} ' . $control_selector . '',
            ]
        );
        $this->add_responsive_control(
            'hexa_' . $control_id . '_area_padding',
            [
                'label' => esc_html__('Padding', 'hexacore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'hexa_' . $control_id . 'area_border',
                'selector' => '{{WRAPPER}} ' . $control_selector . '',
            ]
        );
        $this->add_responsive_control(
            'hexa_' . $control_id . '_area_border_radius',
            [
                'label' => esc_html__('Border Radius', 'hexacore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();
    }

    /*
    *  Basic style control
    1. $control_id -> Tab ID
    2. $control_name -> Tab Title
    3. $control_selector -> Selector Class or ID
    */
    protected function hexa_basic_style_controls($control_id = null, $control_name = null, $control_selector = null)
    {

        $this->start_controls_section(
            'hexa_' . $control_id . '_styling',
            [
                'label' => esc_html__($control_name, 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs('hexa_' . $control_id . '_basic_tabs');
        // Normal State Tab
        $this->start_controls_tab('hexa_' . $control_id . '_text_normal', ['label' => esc_html__('Normal', 'hexacore')]);
        $this->add_control(
            'hexa_' . $control_id . '_text_color',
            [
                'label' => esc_html__('Text Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'    => 'hexa_' . $control_id . '_text_bg_color',
                'label' => __('Background Color', 'hexacore'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image', 'video'],
                'selector' => '{{WRAPPER}} ' . $control_selector . '',
            ]
        );
        $this->end_controls_tab();
        // Hover State Tab
        $this->start_controls_tab('hexa_' . $control_id . '_text_hover', ['label' => esc_html__('Hover', 'hexacore')]);
        $this->add_control(
            'hexa_' . $control_id . '_text_hcolor',
            [
                'label' => esc_html__('Text Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ':is(:hover, :focus)' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'    => 'hexa_' . $control_id . '_bg_hcolor',
                'label' => __('Background Color', 'hexacore'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image', 'video'],
                'selector' => '{{WRAPPER}} ' . $control_selector . ':is(:hover, :focus)',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'hexa_' . $control_id . '_typography',
                'label' => esc_html__('Typography', 'hexacore'),
                'selector' => '{{WRAPPER}} ' . $control_selector . '',
            ]
        );
        $this->add_responsive_control(
            'hexa_' . $control_id . '_padding',
            [
                'label' => esc_html__('Padding', 'hexacore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'hexa_' . $control_id . '_margin',
            [
                'label' => esc_html__('Margin', 'hexacore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->end_controls_section();
    }

    /*
    *  Basic style control two
    1. $control_id -> Tab ID
    2. $control_name -> Tab Title
    3. $control_selector -> Selector Class or ID
    4. $control_selector2 -> Selector Class or ID 2
    */
    protected function hexa_basic_style_controls_two($control_id = null, $control_name = null, $control_selector = null, $control_selector2 = null)
    {
        $this->start_controls_section(
            'hexa_' . $control_id . '_styling',
            [
                'label' => esc_html__($control_name, 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs('hexa_' . $control_id . '_basic_tabs');
        // Normal State Tab
        $this->start_controls_tab('hexa_' . $control_id . '_text_normal', ['label' => esc_html__('Normal', 'hexacore')]);
        $this->add_control(
            'hexa_' . $control_id . '_text_color',
            [
                'label' => esc_html__('Text Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ' ' . $control_selector2 => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'    => 'hexa_' . $control_id . '_bg_color',
                'label' => __('Background Color', 'hexacore'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image', 'video'],
                'selector' => '{{WRAPPER}} ' . $control_selector . ' ' . $control_selector2,
            ]
        );
        $this->end_controls_tab();
        // Hover State Tab
        $this->start_controls_tab('hexa_' . $control_id . '_text_hover', ['label' => esc_html__('Hover', 'hexacore')]);
        $this->add_control(
            'hexa_' . $control_id . '_text_hcolor',
            [
                'label' => esc_html__('Text Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ':is(:hover, :focus) ' . $control_selector2 => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'    => 'hexa_' . $control_id . '_bg_color',
                'label' => __('Background Color', 'hexacore'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image', 'video'],
                'selector' => '{{WRAPPER}} ' . $control_selector . ':is(:hover, :focus) ' . $control_selector2,
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'hexa_' . $control_id . '_typography',
                'label' => esc_html__('Typography', 'hexacore'),
                'selector' => '{{WRAPPER}} ' . $control_selector . ' ' . $control_selector2,
            ]
        );
        $this->add_responsive_control(
            'hexa_' . $control_id . '_padding',
            [
                'label' => esc_html__('Padding', 'hexacore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ' ' . $control_selector2 => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'hexa_' . $control_id . '_margin',
            [
                'label' => esc_html__('Margin', 'hexacore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ' ' . $control_selector2 => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->end_controls_section();
    }

    /*
    *  Button style control
    1. $control_id -> Tab ID
    2. $control_name -> Tab Title
    3. $control_selector -> Selector Class or ID
    */
    protected function hexa_button_style_controls($control_id = null, $control_name = null, $control_selector = null)
    {
        $this->start_controls_section(
            'hexa_' . $control_id . '_button',
            [
                'label' => esc_html__($control_name, 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'hexa_' . $control_id . '_typography',
                'selector' => '{{WRAPPER}} ' . $control_selector . '',
            ]
        );
        $this->start_controls_tabs('hexa_' . $control_id . '_button_tabs');
        // Normal State Tab
        $this->start_controls_tab('hexa_' . $control_id . '_btn_normal', ['label' => esc_html__('Normal', 'hexacore')]);
        $this->add_control(
            'hexa_' . $control_id . '_btn_normal_text_color',
            [
                'label' => esc_html__('Text Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'    => 'hexa_' . $control_id . '_btn_normal_bg_color',
                'label' => __('Background Color', 'hexacore'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image', 'video'],
                'selector' => '{{WRAPPER}} ' . $control_selector . '',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'hexa_' . $control_id . '_btn_normal_border',
                'selector' => '{{WRAPPER}} ' . $control_selector . '',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'hexa_' . $control_id . '_btn_box_shadow',
                'label' => esc_html__('Box Shadow', 'hexacore'),
                'selector' => '{{WRAPPER}} ' . $control_selector . '',
            ]
        );
        $this->end_controls_tab();
        // Hover State Tab
        $this->start_controls_tab('hexa_' . $control_id . '_btn_hover', ['label' => esc_html__('Hover', 'hexacore')]);
        $this->add_control(
            'hexa_' . $control_id . '_btn_hover_text_color',
            [
                'label' => esc_html__('Text Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ':is(:hover, :focus)' => 'color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'    => 'hexa_' . $control_id . '_btn_hover_bg_color',
                'label' => __('Background Color', 'hexacore'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image', 'video'],
                'selector' => '{{WRAPPER}} ' . $control_selector . ':is(:hover, :focus)',
            ]
        );
        $this->add_control(
            'hexa_' . $control_id . '_btn_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ':is(:hover, :focus)' => 'border-color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'hexa_' . $control_id . '_btn_hover_box_shadow',
                'label' => esc_html__('Box Shadow', 'hexacore'),
                'selector' => '{{WRAPPER}} ' . $control_selector . ':is(:hover, :focus)',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
            'hexa_' . $control_id . '_btn_border_radius',
            [
                'label' => __('Border Radius', 'hexacore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'hexa_' . $control_id . '_btn_padding',
            [
                'label' => esc_html__('Padding', 'hexacore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'hexa_' . $control_id . '_btn_margin',
            [
                'label' => esc_html__('Margin', 'hexacore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    /*
    *  Button style control two
    1. $control_id -> Tab ID
    2. $control_name -> Tab Title
    3. $control_selector -> Selector Class or ID
    4. $control_selector2 -> Selector Class or ID 2
    */
    protected function hexa_button_style_controls_two($control_id = null, $control_name = null, $control_selector = null, $control_selector2 = null)
    {
        $this->start_controls_section(
            'hexa_' . $control_id . '_button',
            [
                'label' => esc_html__($control_name, 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'hexa_' . $control_id . '_typography',
                'selector' => '{{WRAPPER}} ' . $control_selector . ' ' . $control_selector2,
            ]
        );
        $this->start_controls_tabs('hexa_' . $control_id . '_button_tabs');
        // Normal State Tab
        $this->start_controls_tab('hexa_' . $control_id . '_btn_normal', ['label' => esc_html__('Normal', 'hexacore')]);
        $this->add_control(
            'hexa_' . $control_id . '_btn_normal_text_color',
            [
                'label' => esc_html__('Text Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ' ' . $control_selector2 => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'    => 'hexa_' . $control_id . '_btn_normal_bg_color',
                'label' => __('Background Color', 'hexacore'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image', 'video'],
                'selector' => '{{WRAPPER}} ' . $control_selector . ' ' . $control_selector2,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'hexa_' . $control_id . '_btn_normal_border',
                'selector' => '{{WRAPPER}} ' . $control_selector . ' ' . $control_selector2,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'hexa_' . $control_id . '_btn_box_shadow',
                'label' => esc_html__('Box Shadow', 'hexacore'),
                'selector' => '{{WRAPPER}} ' . $control_selector . ' ' . $control_selector2,
            ]
        );
        $this->end_controls_tab();
        // Hover State Tab
        $this->start_controls_tab('hexa_' . $control_id . '_btn_hover', ['label' => esc_html__('Hover', 'hexacore')]);
        $this->add_control(
            'hexa_' . $control_id . '_btn_hover_text_color',
            [
                'label' => esc_html__('Text Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ':is(:hover, :focus) ' . $control_selector2 => 'color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'    => 'hexa_' . $control_id . '_btn_hover_bg_color',
                'label' => __('Background Color', 'hexacore'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image', 'video'],
                'selector' => '{{WRAPPER}} ' . $control_selector . ':is(:hover, :focus) ' . $control_selector2,
            ]
        );
        $this->add_control(
            'hexa_' . $control_id . '_btn_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ':is(:hover, :focus) ' . $control_selector2 => 'border-color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'hexa_' . $control_id . '_btn_hover_box_shadow',
                'label' => esc_html__('Box Shadow', 'hexacore'),
                'selector' => '{{WRAPPER}} ' . $control_selector . ':is(:hover, :focus) ' . $control_selector2,
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
            'hexa_' . $control_id . '_btn_border_radius',
            [
                'label' => __('Border Radius', 'hexacore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ' ' . $control_selector2 => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'hexa_' . $control_id . '_btn_padding',
            [
                'label' => esc_html__('Padding', 'hexacore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ' ' . $control_selector2 => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'hexa_' . $control_id . '_btn_margin',
            [
                'label' => esc_html__('Margin', 'hexacore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ' ' . $control_selector2 => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    /*
    *  Icon style control
    1. $control_id -> Tab ID
    2. $control_name -> Tab Title
    3. $control_selector -> Selector Class or ID
    */
    protected function hexa_icon_style_controls($control_id = null, $control_name = null, $control_selector = null)
    {
        $this->start_controls_section(
            'hexa_' . $control_id . '_media_style',
            [
                'label' => esc_html__($control_name, 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'hexa_' . $control_id . '_icon_size',
            [
                'label' => esc_html__('Size', 'elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'vw', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} ' . $control_selector . ' svg' => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->start_controls_tabs('hexa_' . $control_id . '_icon_tabs');
        // Normal State Tab
        $this->start_controls_tab('hexa_' . $control_id . '_icon_normal', ['label' => esc_html__('Normal', 'hexacore')]);
        $this->add_control(
            'hexa_' . $control_id . '_normal_color',
            [
                'label' => esc_html__('Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} ' . $control_selector . ' svg' => 'fill: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'hexa_' . $control_id . '_icon_normal_bg',
            [
                'label' => esc_html__('Background Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'hexa_' . $control_id . '_icon_normal_border',
                'selector' => '{{WRAPPER}} ' . $control_selector . '',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'hexa_' . $control_id . '_icon_box_shadow',
                'label' => esc_html__('Box Shadow', 'hexacore'),
                'selector' => '{{WRAPPER}} ' . $control_selector . '',
            ]
        );
        $this->end_controls_tab();
        // Hover State Tab
        $this->start_controls_tab('hexa_' . $control_id . '_icon_hover', ['label' => esc_html__('Hover', 'hexacore')]);
        $this->add_control(
            'hexa_' . $control_id . '_hover_color',
            [
                'label' => esc_html__('Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ':is(:hover, :focus)' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} ' . $control_selector . ':is(:hover, :focus) svg' => 'fill: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'hexa_' . $control_id . '_icon_hover_bg',
            [
                'label' => esc_html__('Background Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ':is(:hover, :focus)' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'hexa_' . $control_id . '_icon_hover_border',
            [
                'label' => esc_html__('Border Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ':is(:hover, :focus)' => 'border-color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'hexa_' . $control_id . '_icon_hover_box_shadow',
                'label' => esc_html__('Box Shadow', 'hexacore'),
                'selector' => '{{WRAPPER}} ' . $control_selector . ':is(:hover, :focus)',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
            'hexa_' . $control_id . '_icon_border_radius',
            [
                'label' => esc_html__('Border Radius', 'elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'hexa_' . $control_id . '_icon_spacing',
            [
                'label' => esc_html__('Margin', 'hexacore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'hexa_' . $control_id . '_icon_width',
            [
                'label' => esc_html__('Width', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 600,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'width: {{SIZE}}{{UNIT}} !important;',
                ]
            ]
        );
        $this->add_responsive_control(
            'hexa_' . $control_id . '_icon_height',
            [
                'label' => esc_html__('Height', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 600,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'height: {{SIZE}}{{UNIT}} !important;',
                ]
            ]
        );
        $this->add_responsive_control(
            'hexa_' . $control_id . '_icon_lheight',
            [
                'label' => esc_html__('Line Height', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 600,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'line-height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'hexa_' . $control_id . '_icon_display',
            [
                'label' => __('Display', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'inline-block',
                'options' => [
                    'block' => __('Block', 'hexacore'),
                    'inline-block' => __('Inline Block', 'hexacore'),
                    'inline' => __('Inline', 'hexacore'),
                ],
                'selectors'    => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'display: {{VALUE}} !important;',
                ]
            ]
        );
        $this->add_responsive_control(
            'hexa_' . $control_id . '_icon_align',
            [
                'label' => __('Icon Align', 'hexacore'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
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
                    ],
                ],
                'selectors'    => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'text-align: {{VALUE}} !important;',
                ]
            ]
        );
        $this->end_controls_section();
    }

    /*
    *  Icon style control two
    1. $control_id -> Tab ID
    2. $control_name -> Tab Title
    3. $control_selector -> Selector Class or ID
    4. $control_selector2 -> Selector Class or ID 2
    */
    protected function hexa_icon_style_controls_two($control_id = null, $control_name = null, $control_selector = null, $control_selector2 = null)
    {
        $this->start_controls_section(
            'hexa_' . $control_id . '_media_style',
            [
                'label' => esc_html__($control_name, 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'hexa_' . $control_id . '_icon_size',
            [
                'label' => esc_html__('Size', 'elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'vw', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ' ' . $control_selector2 => 'font-size: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} ' . $control_selector . ' ' . $control_selector2 . ' svg' => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->start_controls_tabs('hexa_' . $control_id . '_icon_tabs');
        // Normal State Tab
        $this->start_controls_tab('hexa_' . $control_id . '_icon_normal', ['label' => esc_html__('Normal', 'hexacore')]);
        $this->add_control(
            'hexa_' . $control_id . '_normal_color',
            [
                'label' => esc_html__('Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ' ' . $control_selector2 => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} ' . $control_selector . ' ' . $control_selector2 . ' svg' => 'fill: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'hexa_' . $control_id . '_icon_normal_bg',
            [
                'label' => esc_html__('Background Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ' ' . $control_selector2 => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'hexa_' . $control_id . '_icon_normal_border',
                'selector' => '{{WRAPPER}} ' . $control_selector . ' ' . $control_selector2,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'hexa_' . $control_id . '_icon_box_shadow',
                'label' => esc_html__('Box Shadow', 'hexacore'),
                'selector' => '{{WRAPPER}} ' . $control_selector . ' ' . $control_selector2,
            ]
        );
        $this->end_controls_tab();
        // Hover State Tab
        $this->start_controls_tab('hexa_' . $control_id . '_icon_hover', ['label' => esc_html__('Hover', 'hexacore')]);
        $this->add_control(
            'hexa_' . $control_id . '_hover_color',
            [
                'label' => esc_html__('Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ':is(:hover, :focus) ' . $control_selector2  => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} ' . $control_selector . ':is(:hover, :focus) ' . $control_selector2 . ' svg' => 'fill: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'hexa_' . $control_id . '_icon_hover_bg',
            [
                'label' => esc_html__('Background Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ':is(:hover, :focus) ' . $control_selector2 => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'hexa_' . $control_id . '_icon_hover_border',
            [
                'label' => esc_html__('Border Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ':is(:hover, :focus) ' . $control_selector2 => 'border-color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'hexa_' . $control_id . '_icon_hover_box_shadow',
                'label' => esc_html__('Box Shadow', 'hexacore'),
                'selector' => '{{WRAPPER}} ' . $control_selector . ':is(:hover, :focus) ' . $control_selector2,
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
            'hexa_' . $control_id . '_icon_border_radius',
            [
                'label' => esc_html__('Border Radius', 'elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ' ' . $control_selector2 => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'hexa_' . $control_id . '_icon_spacing',
            [
                'label' => esc_html__('Margin', 'hexacore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ' ' . $control_selector2 => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'hexa_' . $control_id . '_icon_width',
            [
                'label' => esc_html__('Width', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 600,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ' ' . $control_selector2 => 'width: {{SIZE}}{{UNIT}} !important;',
                ]
            ]
        );
        $this->add_responsive_control(
            'hexa_' . $control_id . '_icon_height',
            [
                'label' => esc_html__('Height', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 600,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ' ' . $control_selector2 => 'height: {{SIZE}}{{UNIT}} !important;',
                ]
            ]
        );
        $this->add_responsive_control(
            'hexa_' . $control_id . '_icon_lheight',
            [
                'label' => esc_html__('Line Height', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 600,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ' ' . $control_selector2 => 'line-height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'hexa_' . $control_id . '_icon_display',
            [
                'label' => __('Display', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'inline-block',
                'options' => [
                    'block' => __('Block', 'hexacore'),
                    'inline-block' => __('Inline Block', 'hexacore'),
                    'inline' => __('Inline', 'hexacore'),
                ],
                'selectors'    => [
                    '{{WRAPPER}} ' . $control_selector . ' ' . $control_selector2 => 'display: {{VALUE}} !important;',
                ]
            ]
        );
        $this->add_responsive_control(
            'hexa_' . $control_id . '_icon_align',
            [
                'label' => __('Icon Align', 'hexacore'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
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
                    ],
                ],
                'selectors'    => [
                    '{{WRAPPER}} ' . $control_selector . ' ' . $control_selector2 => 'text-align: {{VALUE}} !important;',
                ]
            ]
        );
        $this->end_controls_section();
    }

    /*
    *  Card style control
    1. $control_id -> Tab ID
    2. $control_name -> Tab Title
    3. $control_selector -> Selector Class or ID
    */
    protected function hexa_card_style_controls($control_id = null, $control_name = null, $control_selector = null)
    {
        $this->start_controls_section(
            'hexa_' . $control_id . '_card_styling',
            [
                'label' => esc_html__($control_name, 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs('hexa_' . $control_id . '_card_tabs');
        // Normal State Tab
        $this->start_controls_tab('hexa_' . $control_id . '_card_normal', ['label' => esc_html__('Normal', 'hexacore')]);
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'hexa_' . $control_id . '_card_background',
                'label' => esc_html__('Background Color', 'hexacore'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image', 'video'],
                'selector' => '{{WRAPPER}} ' . $control_selector . '',
            ]
        );
        $this->end_controls_tab();
        // Hover State Tab
        $this->start_controls_tab('hexa_' . $control_id . '_card_hover', ['label' => esc_html__('Hover', 'hexacore')]);
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'hexa_' . $control_id . '_card_hvr_background',
                'label' => esc_html__('Background Color', 'hexacore'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image', 'video'],
                'selector' => '{{WRAPPER}} ' . $control_selector . ':is(:hover, :focus)',
            ]
        );
        $this->add_control(
            'hexa_' . $control_id . '_card_hvr_border_color',
            [
                'label' => esc_html__('Border Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ':is(:hover, :focus) ' => 'border-color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'hexa_' . $control_id . '_card_hvr_box_shadow',
                'label' => esc_html__('Box Shadow', 'hexacore'),
                'selector' => '{{WRAPPER}} ' . $control_selector . ':is(:hover, :focus)',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'hexa_' . $control_id . '_card_padding',
            [
                'label' => esc_html__('Padding', 'hexacore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'hexa_' . $control_id . '_card_border',
                'selector' => '{{WRAPPER}} ' . $control_selector . '',
            ]
        );
        $this->add_responsive_control(
            'hexa_' . $control_id . '_card_border_radius',
            [
                'label' => esc_html__('Border Radius', 'hexacore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'hexa_' . $control_id . '_card_box_shadow',
                'label' => esc_html__('Box Shadow', 'hexacore'),
                'selector' => '{{WRAPPER}} ' . $control_selector . '',
            ]
        );
        $this->end_controls_section();
    }

    /*
    *  Hero Slider style control
    1. $control_id -> Tab ID
    2. $control_name -> Tab Title
    3. $control_selector -> Selector Class or ID
    */
    protected function hexa_slider_style_controls($control_id = null, $control_name = null, $control_selector = null)
    {
        $this->start_controls_section(
            'hexa_' . $control_id . '_slide_styling',
            [
                'label' => esc_html__($control_name, 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'hexa_' . $control_id . '_slide_height',
            [
                'label' => esc_html__('Height', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'responsive' => true,
                'size_units' => ['px', '%', 'em', 'rem', 'vw', 'custom'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'hexa_' . $control_id . '_slide_size',
            [
                'label' => esc_html__('Background Size', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'responsive' => true,
                'options' => [
                    '' => esc_html__('Default', 'hexacore'),
                    'auto' => esc_html__('Auto', 'hexacore'),
                    'cover' => esc_html__('Cover', 'hexacore'),
                    'contain' => esc_html__('Contain', 'hexacore'),
                    'initial' => esc_html__('Custom', 'hexacore'),
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector => 'background-size: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'hexa_' . $control_id . '_slide_width',
            [
                'label' => esc_html__('Width', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'responsive' => true,
                'size_units' => ['px', '%', 'em', 'rem', 'vw', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'required' => true,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector => 'background-size: {{SIZE}}{{UNIT}} auto',

                ],
                'condition' => [
                    'hexa_' . $control_id . '_slide_size' => ['initial'],
                ],
            ]
        );
        $this->add_responsive_control(
            'hexa_' . $control_id . '_slide_position',
            [
                'label' => esc_html__('Background Position', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'responsive' => true,
                'options' => [
                    'center center' => esc_html__('Center Center', 'hexacore'),
                    'center left' => esc_html__('Center Left', 'hexacore'),
                    'center right' => esc_html__('Center Right', 'hexacore'),
                    'top center' => esc_html__('Top Center', 'hexacore'),
                    'top left' => esc_html__('Top Left', 'hexacore'),
                    'top right' => esc_html__('Top Right', 'hexacore'),
                    'bottom center' => esc_html__('Bottom Center', 'hexacore'),
                    'bottom left' => esc_html__('Bottom Left', 'hexacore'),
                    'bottom right' => esc_html__('Bottom Right', 'hexacore'),
                ],
                'default' => 'center center',
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector => 'background-position: {{VALUE}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'hexa_' . $control_id . '_slide_repeater',
            [
                'label' => esc_html__('Background Repeat', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'no-repeat',
                'responsive' => true,
                'options' => [
                    '' => esc_html__('Default', 'hexacore'),
                    'no-repeat' => esc_html__('No-repeat', 'hexacore'),
                    'repeat' => esc_html__('Repeat', 'hexacore'),
                    'repeat-x' => esc_html__('Repeat-x', 'hexacore'),
                    'repeat-y' => esc_html__('Repeat-y', 'hexacore'),
                ],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector => 'background-repeat: {{VALUE}};',
                ]
            ]
        );
        $background_overlay_selector = '{{WRAPPER}} ' .  $control_selector . '::before, {{WRAPPER}} ' .  $control_selector . '::after ';
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'hexa_' . $control_id . '_background_overlay',
                'selector' => $background_overlay_selector,
                'fields_options' => [
                    'background' => [
                        'selectors' => [
                            $background_overlay_selector => 'background-color: {{VALUE}};',
                        ],
                    ]
                ]
            ]
        );

        $this->add_responsive_control(
            'hexa_' . $control_id . '_overlay_opacity',
            [
                'label' => esc_html__('Opacity', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => .5,
                ],
                'range' => [
                    'px' => [
                        'max' => 1,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ' .  $control_selector . '::before, 
                    {{WRAPPER}} ' .  $control_selector . '::after ' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'hexa_' . $control_id . '_slide_padding',
            [
                'label' => esc_html__('Padding', 'hexacore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'hexa_' . $control_id . '_slide_border_radius',
            [
                'label' => esc_html__('Border Radius', 'hexacore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();
    }

    /*  
    * Hexa Image Style Controls 
    1. $control_id -> Tab ID
    2. $control_name -> Tab Title
    3. $control_selector -> Selector Class or ID
    */

    protected function hexa_img_style_controls($control_id = null, $control_name = null, $control_selector = null)
    {

        $this->start_controls_section(
            'hexa_' . $control_id . '_image',
            [
                'label' => esc_html__($control_name, 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'hexa_' . $control_id . '_image_width',
            [
                'label' => esc_html__('Width', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'hexa_' . $control_id . '_image_height',
            [
                'label' => esc_html__('Height', 'hexacore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],

                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'hexa_' . $control_id . '_image_margin',
            [
                'label' => esc_html__('Margin', 'hexacore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'hexa_' . $control_id . '_image_padding',
            [
                'label' => esc_html__('Padding', 'hexacore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'hexa_' . $control_id . '_image_radius',
            [
                'label' => esc_html__('Border Radius', 'hexacore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /*      
    * Hexa Input Style Controls
    1. $control_id -> Tab ID
    2. $control_name -> Tab Title
    3. $control_selector -> Selector Class or ID
    */

    protected function hexa_input_style_controls($control_id = null, $control_name = null, $control_selector = null, $control_selector2 = null)
    {
        /**
         * Button One
         */
        $this->start_controls_section(
            'hexa_' . $control_id . '_input',
            [
                'label' => esc_html__($control_name, 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'hexa_' . $control_id . '_input_typography',
                'selector' => '{{WRAPPER}} ' . $control_selector . ' , {{WRAPPER}} ' . $control_selector2 . '',
            ]
        );


        $this->start_controls_tabs('hexa_' . $control_id . '_input_tabs');

        // Normal State Tab
        $this->start_controls_tab('hexa_' . $control_id . '_input_normal', ['label' => esc_html__('Normal', 'hexacore')]);

        $this->add_control(
            'hexa_' . $control_id . '_input_normal_text_color',
            [
                'label' => esc_html__('Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ', {{WRAPPER}} ' . $control_selector2 . '' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hexa_' . $control_id . '_input_normal_bg_color',
            [
                'label' => esc_html__('Background Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ', {{WRAPPER}} ' . $control_selector2 . '' => 'background: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'hexa_' . $control_id . '_input_normal_placeholder_color',
            [
                'label' => esc_html__('Placeholder Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '::placeholder, {{WRAPPER}} ' . $control_selector2 . '::placeholder' => 'color: {{VALUE}} !important;',
                ],
            ]
        );


        $this->add_control(
            'hexa_' . $control_id . '_input_normal_border_color',
            [
                'label' => esc_html__('Border Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ', {{WRAPPER}} ' . $control_selector2 . '' => 'border-color: {{VALUE}} !important;;',
                ],
            ]

        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'hexa_' . $control_id . '_input_box_shadow',
                'label' => esc_html__('Box Shadow', 'hexacore'),
                'selector' => '{{WRAPPER}} ' . $control_selector . ', {{WRAPPER}} ' . $control_selector2 . '',
            ]
        );



        $this->add_control(
            'hexa_' . $control_id . '_input_border_radius',
            [
                'label' => esc_html__('Border Radius', 'hexacore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ',{{WRAPPER}} ' . $control_selector2 . '' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // Focus State Tab
        $this->start_controls_tab('hexa_' . $control_id . '_input_hover', ['label' => esc_html__('Focus', 'hexacore')]);

        $this->add_control(
            'hexa_' . $control_id . '_input_hover_bg_color',
            [
                'label' => esc_html__('Background Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ':focus,{{WRAPPER}} ' . $control_selector2 . ':focus' => 'background: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'hexa_' . $control_id . '_input_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'hexacore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ':focus,{{WRAPPER}} ' . $control_selector2 . ':focus' => 'border-color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'hexa_' . $control_id . '_input_hover_box_shadow',
                'label' => esc_html__('Box Shadow', 'hexacore'),
                'selector' => '{{WRAPPER}} ' . $control_selector . ':focus,{{WRAPPER}} ' . $control_selector2 . ':focus',
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'hexa_' . $control_id . '_input_padding',
            [
                'label' => esc_html__('Padding', 'hexacore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ',{{WRAPPER}} ' . $control_selector2 . '' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'hexa_' . $control_id . '_input_margin',
            [
                'label' => esc_html__('Margin', 'hexacore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ',{{WRAPPER}} ' . $control_selector2 . '' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /*
    *  Animation control
    1. $control_id -> Tab ID
    2. $control_name -> Tab Title
    3. $control_selector -> Selector Class or ID
    */
    protected function hexa_animation_controls($control_id = null, $control_name = null)
    {
        $this->start_controls_section(
            'hexa_' . $control_id . '_section_anim',
            [
                'label' => esc_html__($control_name, 'hexacore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'hexa_' . $control_id . '_ani_name',
            [
                'label'     => __('Animation Name', 'hexacore'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => '',
                'label_block' => true,
                'options'   => [
                    ''                    => __('Default', 'hexacore'),
                    'hfFadeIn'          => __('Fade In', 'hexacore'),
                    'hfSlideInLeft'     => __('Slide In Left', 'hexacore'),
                    'hfSlideInRight'    => __('Slide In Right', 'hexacore'),
                    'hfSlideInDown'     => __('Slide In Down', 'hexacore'),
                    'hfSlideInUp'       => __('Slide In Up', 'hexacore'),
                    'hfZoomIn'          => __('Zoom In', 'hexacore'),
                    'hfZoomOut'         => __('Zoom Out', 'hexacore'),
                    'hfRotateIn'        => __('Rotate In', 'hexacore'),
                    'hfBounceIn'           => __('Bounce In', 'hexacore'),
                    'hfBounceInLeft'     => __('Bounce In Left', 'hexacore'),
                    'hfBounceInRight'     => __('Bounce In Right', 'hexacore'),
                    'hfBounceInDown'     => __('Bounce In Down', 'hexacore'),
                    'hfBounceInUp'         => __('Bounce In Up', 'hexacore'),
                    'hfFlipInX'         => __('Flip In X', 'hexacore'),
                    'hfFlipInY'         => __('Flip In Y', 'hexacore'),
                ],
            ]
        );
        $this->add_control(
            'hexa_' . $control_id . 'ani_duration',
            [
                'label'     => __('Animation Duration (ms)', 'hexacore'),
                'type'      => \Elementor\Controls_Manager::NUMBER,
                'min' => 100,
                'max' => 10000,
                'step' => 50,
                'default' => 700,
                'condition' => [
                    'hexa_' . $control_id . '_ani_name!'     => '',
                ],
            ]
        );
        $this->add_control(
            'hexa_' . $control_id . '_ani_delay',
            [
                'label'     => __('Animation Delay (ms)', 'hexacore'),
                'type'      => \Elementor\Controls_Manager::NUMBER,
                'min'       => 0,
                'max'       => 10000,
                'step'      => 50,
                'default'   => 300,
                'condition' => [
                    'hexa_' . $control_id . '_ani_name!'     => '',
                ],

            ]
        );
        $this->end_controls_section();
    }
}
