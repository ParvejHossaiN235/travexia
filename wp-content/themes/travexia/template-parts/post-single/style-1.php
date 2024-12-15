<?php

/**
 * The template for displaying single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package hexa
 */

$row_swipe = (!empty(get_theme_mod('single_post_layout')) ? get_theme_mod('single_post_layout') : 'right-sidebar');
$post_column = is_active_sidebar('post-sidebar') ? 'col-xl-8 col-lg-8 col-md-12' : 'col-xl-12 col-lg-12 col-md-12';

?>

<div class="hexa-area postbox-area pt-120 pb-100" >
    <div class="entry-content">
        <div class="container">
            <div class="row row-gap-50 <?php echo $row_swipe; ?>">
                <div class="<?php echo $post_column; ?>">
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
                        <div class="widget-wrapper sidebar-right" >
                            <?php get_sidebar(); ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>