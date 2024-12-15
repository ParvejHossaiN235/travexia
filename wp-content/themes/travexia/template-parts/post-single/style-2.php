<?php

$categories = get_the_terms($post->ID, 'category');
$author_bio_avatar_size = 65;

$post_related_switch = get_theme_mod('post_related_switch', false);
$row_swipe = (!empty(get_theme_mod('single_post_layout')) ? get_theme_mod('single_post_layout') : 'right-sidebar');
$post_column = is_active_sidebar('post-sidebar') ? 'col-xl-8 col-lg-8 col-md-12' : 'col-xl-8 col-lg-8 col-md-12 mx-auto';

while (have_posts()) :
    the_post();
?>

    <!-- postbox area start -->
    <section class="hexa-area postbox-area pt-120 pb-100" >
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-10 col-lg-10 col-md-10">
                    <div class="section__title-wrapper section__title-space">
                        <h2 class="section__title"><?php the_title(); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-xxl-12">
                    <div class="postbox__wrapper style-two mt-10">
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

                                    <div class="postbox__meta-wrapper">
                                        <div class="postbox__meta-item">
                                            <div class="postbox__meta-author">
                                                <div class="postbox__meta-author-thumb">
                                                    <a href="<?php print esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                                        <?php print get_avatar(get_the_author_meta('user_email'), $author_bio_avatar_size, '', '', ['class' => 'media-object img-circle']); ?>
                                                    </a>
                                                </div>
                                                <div class="postbox__meta-content">
                                                    <span class="postbox__meta-type">
                                                        <?php echo esc_html__('Author', 'portlu'); ?>
                                                    </span>
                                                    <p class="postbox__meta-name">
                                                        <?php print ucwords(get_the_author()); ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="postbox__meta-item">
                                            <div class="postbox__meta-content">
                                                <span class="postbox__meta-type">
                                                    <?php echo esc_html__('Published', 'portlu'); ?>
                                                </span>
                                                <p class="postbox__meta-name"><?php the_time('M d, Y'); ?></p>
                                            </div>
                                        </div>
                                        <div class="postbox__meta-item">
                                            <div class="postbox__meta-content">
                                                <span class="postbox__meta-type"><?php comments_number(); ?></span>
                                                <p class="postbox__meta-name">
                                                    <a href="<?php comments_link(); ?>">
                                                        <?php echo esc_html__('Join the conversation', 'portlu'); ?>
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="post-content mb-30">
                                        <?php the_content(); ?>
                                        <?php
                                        wp_link_pages([
                                            'before'      => '<div class="page-links">' . esc_html__('Pages:', 'portlu'),
                                            'after'       => '</div>',
                                            'link_before' => '<span class="page-number">',
                                            'link_after'  => '</span>',
                                        ]);
                                        ?>
                                    </div>
                                    <!-- post navigation -->
                                    <?php if (get_theme_mod('post_nav')) hexa_single_post_nav(); ?>
                                    <!-- post share -->
                                    <?php if (!empty(hexa_get_tag()) || !empty(get_theme_mod('post_socials'))) : ?>
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
                                        <?php get_template_part('template-parts/post-meta/related'); ?>
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