<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hexa
 */
$categories = get_the_terms($post->ID, 'category');
$hexa_blog_cat = get_theme_mod('hexa_blog_cat', false);

if (is_single()) : ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('postbox-item-details format-search'); ?>>
        <?php if (has_post_thumbnail()) : ?>
            <div class="postbox-thumb postbox-main-thumb mb-35">
                <?php the_post_thumbnail('full', ['class' => 'img-responsive']); ?>
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
        <article id="post-<?php the_ID(); ?>" <?php post_class('postbox-item format-search mb-80'); ?>>
            <?php if (has_post_thumbnail()) : ?>
                <div class="postbox-thumb postbox-main-thumb mb-35">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('full', ['class' => 'img-responsive']); ?>
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