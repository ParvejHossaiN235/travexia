<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hexa
 */

$link_video  = get_post_meta(get_the_ID(), 'post_video', true);
$video_images = function_exists('rwmb_meta') ? rwmb_meta('bg_video', array('size' => 'full')) : '';
$categories = get_the_terms($post->ID, 'category');
$hexa_blog_cat = get_theme_mod('hexa_blog_cat', false);

if (is_single()) : ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('postbox-item-details format-video'); ?>>
        <?php if (!empty($link_video) || !empty($video_images)) : ?>
            <div class="postbox-thumb postbox-video p-relative">
                <?php foreach ($video_images as $image) {  ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="<?php echo esc_attr($image['width']); ?>" height="<?php echo esc_attr($image['height']); ?>">
                <?php } ?>
                <?php if (!empty($link_video)) : ?>
                    <a href="<?php echo esc_url($link_video); ?>" class="postbox-video-btn popup-video tpvideo-icon-anim"><i class="fas fa-play"></i></a>
                <?php endif; ?>
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
        <article id="post-<?php the_ID(); ?>" <?php post_class('postbox-item format-video postbox-thumb-box mb-80'); ?>>
            <?php if (!empty($link_video) || !empty($video_images)) : ?>
                <div class="postbox-thumb postbox-video p-relative postbox-main-thumb mb-35">
                    <?php foreach ($video_images as $image) {  ?>
                        <a href="<?php the_permalink(); ?>">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="<?php echo esc_attr($image['width']); ?>" height="<?php echo esc_attr($image['height']); ?>">
                        </a>
                    <?php } ?>
                    <?php if (!empty($link_video)) : ?>
                        <a href="<?php echo esc_url($link_video); ?>" class=" it-choose-play pulse popup-video"><i class="fas fa-play"></i></a>
                    <?php endif; ?>
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