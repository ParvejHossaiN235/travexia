<?php

$post_related_switch = get_theme_mod('post_related_switch', false);
$row_swipe = (!empty(get_theme_mod('single_post_layout')) ? get_theme_mod('single_post_layout') : 'right-sidebar');
$post_column = is_active_sidebar('post-sidebar') ? 'col-xl-8 col-lg-8 col-md-12' : 'col-xl-8 col-lg-8 col-md-12 mx-auto';

while (have_posts()) :
    the_post();
?>
    <!-- postbox area start -->
    <section class="hexa-area postbox-area pt-120 pb-100" >
        <div class="container">
            <div class="row ">
                <div class="col-xxl-12">
                    <div class="postbox__wrapper style-three">
                        <div class="row row-gap-50 <?php echo esc_attr($row_swipe); ?>">
                            <div class="<?php echo esc_attr($post_column); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="postbox__top">
                                        <div class="postbox__thumb">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('full', ['class' => 'img-responsive']); ?>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="postbox__main-wrapper">
                                    <div class="post-content mb-30">
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
                                    <!-- post navigation -->
                                    <?php if (get_theme_mod('post_nav')) hexa_single_post_nav(); ?>

                                    <?php if (!empty(hexa_get_tag()) || !empty(get_theme_mod('post_socials'))) : ?>
                                        <!-- post share -->
                                        <div class="postbox__share-wrapper">
                                            <div class="row align-items-center">
                                                <div class="col-xl-7">
                                                    <?php print hexa_get_tag(); ?>
                                                </div>
                                                <div class="col-xl-5 mt-30 mt-xl-0">
                                                    <?php if (get_theme_mod('post_socials')) hexa_socials_share(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <!-- post author -->
                                    <?php if (get_theme_mod('author_box')) hexa_author_info_box(); ?>
                                    <!-- related post -->
                                    <?php if ($post_related_switch) : ?>
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

                                                $author_bio_avatar_size = 65;
                                                $author_post  = get_the_author_meta('author_post', $post->post_author);

                                                $related_portfolios = new RelatedPosts($current_post_id, $post_type, $cat_texonomy);
                                                $related_posts = $related_portfolios->get_related_posts();

                                                if (!empty($related_posts)) {
                                                    foreach ($related_posts as $post) {
                                                        setup_postdata($post);
                                                        $categories = get_the_terms($post->ID, 'category');
                                                ?>
                                                        <div class="col-xl-6 col-lg-12 col-md-6 wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                                                            <section class="blog__wrap blog__item style-two bg-solid">
                                                                <?php if (has_post_thumbnail()) : ?>
                                                                    <div class="blog__thumb">
                                                                        <a href="<?php the_permalink(); ?>">
                                                                            <?php the_post_thumbnail(); ?>
                                                                        </a>
                                                                        <div class="blog__btn-circle">
                                                                            <a href="<?php the_permalink(); ?>" class="circle-btn is-bg-white">
                                                                                <span class="icon__box">
                                                                                    <i class="fa-regular fa-arrow-right-long"></i>
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <div class="blog__content">
                                                                    <div class="blog__content-top">
                                                                        <div class="blog__tag">
                                                                            <a href="<?php print esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                                                                        </div>
                                                                        <div class="blog__meta">
                                                                            <span>
                                                                                <i class="fa-light fa-calendar"></i>
                                                                                <?php the_time('M d, Y'); ?>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <h5 class="blog__title">
                                                                        <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title()); ?></a>
                                                                    </h5>
                                                                    <div class="blog__content-bottom">
                                                                        <div class="blog__author">
                                                                            <div class="blog__author-thumb">
                                                                                <a href="<?php print esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                                                                    <?php print get_avatar(get_the_author_meta('user_email'), $author_bio_avatar_size, '', '', ['class' => 'media-object img-circle']); ?>
                                                                                </a>
                                                                            </div>
                                                                            <div class="blog__author-info">
                                                                                <span class="blog__author-title"><?php print ucwords(get_the_author()); ?></span>
                                                                                <span class="blog__author-designation">
                                                                                    <?php echo esc_html($author_post); ?>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </section>
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
                                    <?php endif; ?>
                                    <!-- comment -->
                                    <div class="postbox__comment-wrapper">
                                        <?php
                                        // If comments are open or we have at least one comment, load up the comment template.
                                        if (comments_open() || get_comments_number()) :
                                            comments_template();
                                        endif;
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php if (is_active_sidebar('post-sidebar')) { ?>
                                <div class="col-xl-4 col-lg-4 col-md-12">
                                    <div class="sidebar-wrapper">
                                        <?php get_sidebar(); ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- postbox area end -->

<?php
endwhile;
wp_reset_query();
?>