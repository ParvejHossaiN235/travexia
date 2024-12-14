<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hexa
 */

$gallery_images = function_exists('rwmb_meta') ? rwmb_meta('post_gallery', array('size' => 'full')) : '';
$categories = get_the_terms($post->ID, 'category');

if (is_single()) : ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('postbox-item-details format-gallery'); ?>>
        <?php if (!empty($gallery_images)) : ?>
            <div class="postbox-thumb postbox-slider swiper-container p-relative">
                <div class="swiper-wrapper">
                    <?php foreach ($gallery_images as $image) {  ?>

                        <div class="item-image swiper-slide">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="<?php echo esc_attr($image['width']); ?>" height="<?php echo esc_attr($image['height']); ?>">
                        </div>

                    <?php } ?>
                </div>
                <div class="postbox-nav">
                    <button class="postbox-slider-button-next"><i class="fal fa-arrow-right"></i></button>
                    <button class="postbox-slider-button-prev"><i class="fal fa-arrow-left"></i></button>
                </div>
            </div>
        <?php endif; ?>
        <div class="postbox-content">
            <?php get_template_part('template-parts/post-meta/meta'); ?>

            <div class="postbox-text">
                <?php the_content(); ?>
                <?php
                wp_link_pages([
                    'before'      => '<div class="page-links">' . esc_html__('Pages:', 'hexa-theme'),
                    'after'       => '</div>',
                    'link_before' => '<span class="page-number">',
                    'link_after'  => '</span>',
                ]);
                ?>
            </div>
            <!-- post tatgs and social share -->
            <?php if (!empty(hexa_get_tag()) || !empty(get_theme_mod('post_socials'))) : ?>
                <div class="postbox-share">
                    <div class="postbox-tags">
                        <?php print hexa_get_tag(); ?>
                    </div>
                    <div class="postbox-social">
                        <?php if (get_theme_mod('post_socials')) hexa_socials_share(); ?>
                    </div>
                </div>
            <?php endif; ?>
            <!-- post author -->
            <?php if (get_theme_mod('author_box')) hexa_author_info_box(); ?>
            <!-- single post nav -->
            <?php if (get_theme_mod('post_nav')) hexa_single_post_nav(); ?>
        </div>
    </article>

<?php else : ?>

    <div class="<?php hexa_blog_style(); ?>">
        <article id="post-<?php the_ID(); ?>" <?php post_class('postbox-item format-gallery mb-50'); ?>>
            <?php if (!empty($gallery_images)) : ?>
                <div class="postbox-thumb postbox-slider swiper-container p-relative">
                    <div class="swiper-wrapper">
                        <?php foreach ($gallery_images as $image) {  ?>

                            <div class="item-image swiper-slide">
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="<?php echo esc_attr($image['width']); ?>" height="<?php echo esc_attr($image['height']); ?>">
                            </div>

                        <?php } ?>
                    </div>
                    <div class="postbox-nav">
                        <button class="postbox-slider-button-next"><i class="fal fa-arrow-right"></i></button>
                        <button class="postbox-slider-button-prev"><i class="fal fa-arrow-left"></i></button>
                    </div>
                </div>
            <?php endif; ?>
            <div class="postbox-content">
                <?php get_template_part('template-parts/post-meta/meta'); ?>
                <h3 class="postbox-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>
                <div class="postbox-text">
                    <?php the_excerpt(); ?>
                </div>
                <?php get_template_part('template-parts/post-meta/readmore'); ?>
            </div>
        </article>
    </div>

<?php endif; ?>