<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package travexia
 */

$quote_text  = get_post_meta(get_the_ID(), 'post_quote', true);
$quote_name  = get_post_meta(get_the_ID(), 'quote_name', true);

if ($quote_text) : ?>

    <div id="post-<?php the_ID(); ?>" <?php post_class('postbox_quote__item format-quote mb-50'); ?>>
        <div class="post-text">
            <?php the_content(); ?>
        </div>
    </div>

<?php else : ?>

    <div id="post-<?php the_ID(); ?>" <?php post_class('postbox_quote__item format-quote mb-50'); ?>>
        <div class="post-text">
            <?php the_content(); ?>
            <!-- single post nav -->
            <?php if (get_theme_mod('post_nav')) travexia_single_post_nav(); ?>
        </div>
    </div>

<?php endif; ?>