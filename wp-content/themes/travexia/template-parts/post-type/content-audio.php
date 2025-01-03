<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package travexia
 */

$link_audio  = get_post_meta(get_the_ID(), 'post_audio', true);

$categories = get_the_terms($post->ID, 'category');
$travexia_blog_cat = get_theme_mod('travexia_blog_cat', false);

if (is_single()) : ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('postbox-item-details postbox-details-wrapper format-audio'); ?>>
        <?php if (!empty($link_audio)) : ?>
            <div class="postbox-thumb postbox-audio postbox-main-thumb mb-35">
                <a href="<?php the_permalink(); ?>">
                    <?php echo wp_oembed_get($link_audio); ?>
                </a>
            </div>
        <?php endif; ?>

        <div class="postbox-content postbox-content-box">
            <?php get_template_part('template-parts/post-meta/meta'); ?>

            <div class="postbox-text">
                <h3 class="postbox-title mb-25">
                    <?php the_title(); ?>
                </h3>
                <?php the_content(); ?>
                <?php
                wp_link_pages([
                    'before'      => '<div class="page-links">' . esc_html__('Pages:', 'travexia'),
                    'after'       => '</div>',
                    'link_before' => '<span class="page-number">',
                    'link_after'  => '</span>',
                ]);
                ?>
            </div>
            <!-- post tatgs and social share -->
            <?php if (!empty(travexia_get_tag()) || !empty(get_theme_mod('post_socials'))) : ?>
                <div class="postbox-tag-box mb-45 d-flex justify-content-between align-items-center g-10 flex-wrap">
                    <?php if (!empty(travexia_get_tag())) : ?>
                        <div class="postbox-tags postbox-tag d-flex align-items-start">
                            <h3 class="postbox-tag-title">
                                <?php esc_html_e('Tag', 'travexia'); ?>
                            </h3>
                            <div class="postbox-tag-content tagcloud">
                                <?php print travexia_get_tag(); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty(get_theme_mod('post_socials'))) : ?>
                        <div class="postbox-social d-flex align-items-center">
                            <h3 class="postbox-tag-title">
                                <?php esc_html_e('Share', 'travexia'); ?>
                            </h3>

                            <div class="postbox-share-s">
                                <?php if (get_theme_mod('post_socials')) travexia_socials_share(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <!-- post author -->
            <?php if (get_theme_mod('author_box')) travexia_author_info_box(); ?>
            <!-- single post nav -->
            <?php if (get_theme_mod('post_nav')) travexia_single_post_nav(); ?>
        </div>

    </article>

<?php else : ?>

    <div class="<?php travexia_blog_style(); ?>">
        <article id="post-<?php the_ID(); ?>" <?php post_class('postbox-item format-audio mb-80'); ?>>
            <?php if (!empty($link_audio)) : ?>
                <div class="postbox-thumb postbox-audio postbox-main-thumb mb-35">
                    <a href="<?php the_permalink(); ?>">
                        <?php echo wp_oembed_get($link_audio); ?>
                    </a>
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