<?php
add_filter('add_to_cart_fragments', 'hexa_woocommerce_header_add_to_cart_fragment');
add_action('wp_print_scripts', 'hexa_de_script', 100);

function hexa_de_script()
{
	wp_dequeue_script('wc-cart-fragments');
	return true;
}

function hexa_woocommerce_header_add_to_cart_fragment($fragments)
{
	global $woocommerce;
	ob_start();
	hexa_get_cart_contents();
	$fragments['.cart'] = ob_get_clean();
	return $fragments;
}

function hexa_get_cart_contents()
{
	global $woocommerce;
?>
	<div class="cart mini-cart-inner">
		<a class="mini-cart" href="#" title="<?php echo esc_attr__('View your shopping cart', 'hexa'); ?>">
			<span class="title-cart"><i class="las la-shopping-cart"></i></span>
			<span class="mini-cart-items">
				<?php
				if (!is_admin()) {
					echo WC()->cart->get_cart_contents_count();
				}
				?>
			</span>
		</a>
		<div class="minicart-content">
			<?php woocommerce_mini_cart(); ?>
		</div>
		<div class="minicart-overlay"></div>
	</div>
<?php
}



/**
 * Get image size
 */
if (!function_exists('hexa_get_image_size')) :
	function hexa_get_image_size($size = 'thumbnail')
	{
		global $_wp_additional_image_sizes;
		$sizes = array();
		foreach (get_intermediate_image_sizes() as $_size) {
			if (in_array($_size, array('thumbnail', 'medium', 'large'))) {
				$width = get_option("{$_size}_size_w");
				$height = get_option("{$_size}_size_h");
				$sizes[$_size]['width']  = $width;
				$sizes[$_size]['height'] = $height;
				$sizes[$_size]['crop']   = (bool) get_option("{$_size}_crop");
			} elseif (isset($_wp_additional_image_sizes[$_size])) {
				$width = $_wp_additional_image_sizes[$_size]['width'];
				$height = $_wp_additional_image_sizes[$_size]['height'];
				$sizes[$_size] = array(
					'width'  => $width,
					'height' => $height,
					'crop'   => $_wp_additional_image_sizes[$_size]['crop'],
				);
			}
		}
		return isset($sizes[$size]) ? $sizes[$size] : array();
	}
endif;

function hexa_get_post_thumbnail($size = 'thumbnail', $css_class = '', $attributes = false)
{

	global $post;

	$thumbnail_id = get_post_thumbnail_id();
	$html = hexa_get_image_html($thumbnail_id, $size, $css_class, $attributes);

	return $html;
}

function hexa_get_image_html($attachment_id, $size = 'thumbnail', $css_class = '', $attr = false)
{

	$html = '';
	$image = wp_get_attachment_image_src($attachment_id, $size);
	if ($image) {
		list($src, $width, $height) = $image;
		$hwstring = image_hwstring($width, $height);
		$size_class = $size;
		if (is_array($size_class)) {
			$size_class = join('x', $size_class);
		}
		$attachment = get_post($attachment_id);

		$default_attr = array(
			'src'    => $src,
			'class'    => "attachment-$size_class size-$size_class " . $css_class,
			'alt'    => trim(strip_tags(get_post_meta($attachment_id, '_wp_attachment_image_alt', true))),
		);

		$attr = wp_parse_args($attr, $default_attr);
		if (empty($attr['srcset'])) {
			$image_meta = wp_get_attachment_metadata($attachment_id);
			if (is_array($image_meta)) {
				$size_array = array(absint($width), absint($height));
				$srcset = wp_get_attachment_image_srcset($attachment_id, $size, $image_meta);
				$sizes = wp_calculate_image_sizes($size_array, $src, $image_meta, $attachment_id);

				if ($srcset && ($sizes || !empty($attr['sizes']))) {
					$attr['srcset'] = $srcset;

					if (empty($attr['sizes'])) {
						$attr['sizes'] = $sizes;
					}
				}
			}
		}

		$attr = apply_filters('wp_get_attachment_image_attributes', $attr, $attachment, $size);
		$attr = array_map('esc_attr', $attr);
		$html .= rtrim("<img $hwstring");
		foreach ($attr as $name => $value) {
			$html .= " $name=" . '"' . $value . '"';
		}
		$html .= ' />';
	} else {
		$src = get_template_directory_uri() . '/assets/images/thumbnail-default.png';
		$dimensions        = hexa_get_image_size($size);
		$hwstring         = image_hwstring($dimensions['width'], $dimensions['height']);
		$size_class     = $size;
		if (is_array($size_class)) {
			$size_class = join('x', $size_class);
		}
		$default_attr = array(
			'src'    => $src,
			'class'    => "attachment-$size_class size-$size_class " . $css_class,
			'alt'    => esc_attr__('Place holder', 'hexa'),
		);
		$attr = wp_parse_args($attr, $default_attr);
		$attr = array_map('esc_attr', $attr);
		$html .= rtrim("<img $hwstring");
		foreach ($attr as $name => $value) {
			$html .= " $name=" . '"' . $value . '"';
		}
		$html .= ' />';
	}

	return $html;
}


if (!function_exists('hexa_wc_get_gallery_html')) {
	/**
	 * Get HTML for a gallery
	 * @since 1.0
	 */
	function hexa_wc_get_gallery_html($gallery_image_ids, $main_image = false)
	{
		$gallery_output = '';

		foreach ($gallery_image_ids as $gallery_image_id) {
			$gallery_output .= hexa_wc_get_gallery_image_html($gallery_image_id, $main_image);
		}
		return $gallery_output;
	}
}

if (!function_exists('hexa_wc_get_gallery_image_html')) {
	/**
	 * Get Product Gallery Image HTML
	 * @since 1.0
	 */
	function hexa_wc_get_gallery_image_html($attachment_id, $main_image = false)
	{
		$flexslider        = (bool) apply_filters('woocommerce_single_product_flexslider_enabled', get_theme_support('wc-product-gallery-slider'));
		$gallery_thumbnail = wc_get_image_size('gallery_thumbnail');
		$thumbnail_size    = apply_filters('woocommerce_gallery_thumbnail_size', array($gallery_thumbnail['width'], $gallery_thumbnail['height']));
		$image_size        = apply_filters('woocommerce_gallery_image_size', $flexslider || $main_image ? 'woocommerce_single' : $thumbnail_size);
		$full_size         = apply_filters('woocommerce_gallery_full_size', apply_filters('woocommerce_product_thumbnails_large_size', 'full'));
		$thumbnail_src     = wp_get_attachment_image_src($attachment_id, $thumbnail_size);
		if (empty($thumbnail_src)) {
			return;
		}
		$full_src          = wp_get_attachment_image_src($attachment_id, $full_size);
		$alt_text          = trim(wp_strip_all_tags(get_post_meta($attachment_id, '_wp_attachment_image_alt', true)));
		if ($main_image) {
			$image             = wp_get_attachment_image(
				$attachment_id,
				$image_size,
				false,
				apply_filters(
					'woocommerce_gallery_image_html_attachment_image_params',
					array(
						'title'                   => _wp_specialchars(get_post_field('post_title', $attachment_id), ENT_QUOTES, 'UTF-8', true),
						'data-caption'            => _wp_specialchars(get_post_field('post_excerpt', $attachment_id), ENT_QUOTES, 'UTF-8', true),
						'data-src'                => esc_url($full_src[0]),
						'data-large_image'        => esc_url($full_src[0]),
						'data-large_image_width'  => esc_attr($full_src[1]),
						'data-large_image_height' => esc_attr($full_src[2]),
						'class'                   => esc_attr($main_image ? 'wp-post-image' : ''),
					),
					$attachment_id,
					$image_size,
					$main_image
				)
			);
			return '<div data-thumb="' . esc_url($thumbnail_src[0]) . '" data-thumb-alt="' . esc_attr($alt_text) . '" class="woocommerce-product-gallery__image swiper-slide"><a href="' . esc_url($full_src[0]) . '">' . $image . '</a></div>';
		} else {
			return '<div class="hexa-gallery-thumbnail-image swiper-slide"><button class="custom-button">' . wp_get_attachment_image($attachment_id, $image_size) . '</button></div>';
		}
	}
}

if (!function_exists('hexa_wc_gallery_thumbnail_image_size')) {
	function hexa_wc_gallery_thumbnail_image_size($size)
	{
		$size['width']  = 150;
		$size['height'] = 150;
		return $size;
	}
	add_filter('woocommerce_get_image_size_gallery_thumbnail', 'hexa_wc_gallery_thumbnail_image_size');
}
