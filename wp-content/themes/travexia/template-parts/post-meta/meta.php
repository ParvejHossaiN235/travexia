<?php

/**
 * Template part for displaying post meta
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hexa
 */

$categories = get_the_terms($post->ID, 'category');
$blog_author = get_theme_mod('blog_author', true);
$blog_date = get_theme_mod('blog_date', true);
$blog_comments = get_theme_mod('blog_comments', true);
$blog_cat = get_theme_mod('blog_cat', false);

?>

<div class="postbox-meta mb-20">
   <?php if (!empty($blog_author)) : ?>
      <span><a href="<?php print esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><i class="fa-solid fa-user"></i> <?php echo esc_html__('By', 'hexa-theme'); ?> <?php print ucwords(get_the_author()); ?></a></span>
   <?php endif; ?>
   
   <?php if (!empty($blog_cat)) : ?>
      <span><a href="<?php print esc_url(get_category_link($categories[0]->term_id)); ?>"><i class="fa-regular fa-folder-open"></i> <?php echo esc_html($categories[0]->name); ?></a></span>
   <?php endif; ?>

   <?php if (!empty($blog_comments)) : ?>
      <span><a href="<?php comments_link(); ?>"><i class="fa-regular fa-comments"></i> <?php comments_number(); ?></a></span>
   <?php endif; ?>

   
</div>