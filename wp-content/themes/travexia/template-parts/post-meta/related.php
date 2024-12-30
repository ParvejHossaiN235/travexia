<?php

/**
 * Template part for displaying related post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portlu
 */

$post_related_title = get_theme_mod('post_related_title', __('You May Also Like', 'hexa-theme'));
$post_read_more = get_theme_mod('post_read_more', 'Read More');
?>

<div class="postbox__related">
    <?php if (!empty($post_related_title)) : ?>
        <h4 class="postbox__related-title mb-35"><?php echo wp_kses_post($post_related_title); ?></h4>
    <?php endif; ?>
    <div class="row row-gap-30">
        <?php
        global $post;
        $current_post_id = $post->ID;
        $post_type = 'post';
        $cat_texonomy = 'category';

        $related_portfolios = new RelatedPosts($current_post_id, $post_type, $cat_texonomy);
        $related_posts = $related_portfolios->get_related_posts();

        if (!empty($related_posts)) {
            foreach ($related_posts as $post) {
                setup_postdata($post);
                $categories = get_the_terms($post->ID, 'category');
        ?>
                <div class="col-xl-4 col-lg-4 col-md-6 wow itfadeUp" data-wow-delay=".3s">

                    <div class="postbox-thumb-box mb-30">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="postbox-main-thumb mb-35">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail(); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="postbox-content-box">
                            <?php get_template_part('template-parts/post-meta/meta'); ?>
                            <h4 class="postbox-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h4>
                            <div class="postbox-text">
                                <?php //the_excerpt(); 
                                ?>
                                <?php echo wp_trim_words(get_the_content(), 15); ?>
                            </div>
                            <?php get_template_part('template-parts/post-meta/readmore'); ?>
                        </div>
                    </div>
                </div>
        <?php
            }
            wp_reset_postdata(); // Reset the query
        } else {
            echo '<p class="mt-15">' . __('No related posts found.', 'hexa-theme') . '</p>';
        }
        ?>
    </div>
</div>