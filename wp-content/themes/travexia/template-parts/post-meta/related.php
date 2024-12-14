<?php

/**
 * Template part for displaying related post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portlu
 */

$post_related_title = get_theme_mod('post_related_title', __('You May Also Like', 'portlu'));
$post_read_more = get_theme_mod('post_read_more', 'Read More');
?>

<div class="postbox__related">
    <?php if (!empty($post_related_title)) : ?>
        <h4 class="postbox__related-title mb-35"><?php echo hexa_kses($post_related_title); ?></h4>
    <?php endif; ?>
    <div class="row g-5">
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
                <div class="col-xl-6 col-lg-12 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                    <div class="blog__wrap blog__item style-five">

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="blog__thumb is-hover">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail(); ?>
                                </a>
                                <div class="blog__tag">
                                    <a href="<?php print esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="blog__content bg-solid">
                            <div class="blog__meta">
                                <span>
                                    <i class="fa-light fa-calendar"></i>
                                    <?php the_time('M d, Y'); ?>
                                </span>
                                <span>
                                    <i class="fa-light fa-comment"></i>
                                    <?php comments_number(); ?>
                                </span>
                            </div>
                            <h5 class="blog__title">
                                <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title()); ?></a>
                            </h5>
                            <div class="blog__btn">
                                <a class="bd-btn bordered-light is-btn-anim" href="<?php the_permalink(); ?>">
                                    <span class="bd-btn-inner">
                                        <span class="bd-btn-normal"><?php print esc_html($post_read_more); ?></span>
                                        <span class="bd-btn-hover"><?php print esc_html($post_read_more); ?></span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
            wp_reset_postdata(); // Reset the query
        } else {
            echo 'No related posts found.';
        }
        ?>
    </div>
</div>