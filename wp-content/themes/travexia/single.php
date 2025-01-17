<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package travexia
 */

get_header();

$row_swipe = (!empty(get_theme_mod('single_post_layout')) ? get_theme_mod('single_post_layout') : 'right-sidebar');
$post_column = is_active_sidebar('post-sidebar') ? 'col-xl-8 col-lg-8 col-md-12' : 'col-xl-12 col-lg-12 col-md-12';
$related_post = get_theme_mod('related_post', false);
?>

<div class="hexa-area postbox-area pt-100 pb-100">
    <div class="entry-content">
        <div class="container">
            <div class="row row-gap-50 <?php echo esc_attr($row_swipe); ?>">
                <div class="<?php echo esc_attr($post_column); ?>">
                    <div class="content-wrapper">
                        <?php while (have_posts()) : the_post();

                            get_template_part('template-parts/post-type/content', get_post_format());

                            // If comments are open or we have at least one comment, load up the comment template.
                            if (comments_open() || get_comments_number()) :
                                comments_template();
                            endif;

                        endwhile; // End of the loop.
                        ?>
                    </div>
                </div>
                <?php if (is_active_sidebar('post-sidebar')) { ?>
                    <div class="col-xl-4 col-lg-4 col-md-12">
                        <div class="widget-wrapper sidebar-right">
                            <?php get_sidebar(); ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if (!empty($related_post)) { ?>
                    <div class="col-12">
                        <?php get_template_part('template-parts/post-meta/related'); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
