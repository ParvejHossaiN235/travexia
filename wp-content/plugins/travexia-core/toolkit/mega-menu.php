<?php

// Mega menu functions
function hexa_mega_menu_custom_fields($item_id, $item)
{
    $menu_item_elementor_template = get_post_meta($item_id, '_menu_item_elementor_template', true);
    $menu_item_width = get_post_meta($item_id, '_menu_item_width', true);
    $post_args = array(
        'post_status' => 'publish',
        'post_type'   => 'hexa_megamenu',
        'posts_per_page' => -1,
    );
    $pro_query = new WP_Query($post_args);
?>

    <div class="hexa_megamenu_options">
        <div class="hexa-field-elementor-template description description-wide">
            <label for="menu_item_elementor-template-<?php echo esc_attr($item_id); ?>">
                <?php esc_html_e('Mega Menu', 'hexacore'); ?><br />
                <select class="widefat code edit-menu-item-custom" id="menu_item_elementor_template-<?php echo esc_attr($item_id); ?>" name="menu_item_elementor_template[<?php echo esc_attr($item_id); ?>]">
                    <option value="-1"><?php echo esc_html__('Select A Menu', 'hexacore') ?></option>
                    <?php while ($pro_query->have_posts()) : $pro_query->the_post(); ?>
                        <?php $selected = ($menu_item_elementor_template == get_the_ID()) ? "selected='selected'" : ''; ?>
                        <option value="<?php echo esc_attr(get_the_ID()) ?>" <?php echo esc_attr($selected); ?>><?php echo esc_html(get_the_title()) ?></option>
                    <?php endwhile; ?>
                </select>
            </label>

            <label for="menu_item_width-<?php echo esc_attr($item_id); ?>">
                <?php esc_html_e('Width', 'hexacore'); ?><br />
                <input class="description-wide" type="number" id="menu_item_width-<?php echo esc_attr($item_id); ?>" name="menu_item_width[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($menu_item_width); ?>">
            </label>

        </div>
    </div>

<?php
    wp_reset_postdata(); // Reset the query

}

add_action('wp_nav_menu_item_custom_fields', 'hexa_mega_menu_custom_fields', 10, 2);

function save_hexa_mega_menu_custom_fields($item_id, $menu_item_db_id, $menu_item_args)
{
    if (isset($_POST['menu_item_width'][$menu_item_db_id])) {
        $width = intval($_POST['menu_item_width'][$menu_item_db_id]);
        update_post_meta($menu_item_db_id, '_menu_item_width', $width);
    }
}

add_action('wp_update_nav_menu_item', 'save_hexa_mega_menu_custom_fields', 10, 3);

function hexa_mega_menu_update($item_id, $menu_item_db_id)
{
    if (!empty($_POST['menu_item_elementor_template'][$menu_item_db_id])) {
        $template_id = intval($_POST['menu_item_elementor_template'][$menu_item_db_id]);
        update_post_meta($menu_item_db_id, '_menu_item_elementor_template', $template_id);
    }
}

add_action('wp_update_nav_menu_item', 'hexa_mega_menu_update', 10, 2);
