<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hexa
 */

$quote_text  = get_post_meta(get_the_ID(), 'post_quote', true);
$quote_name  = get_post_meta(get_the_ID(), 'quote_name', true);

if ($quote_text) : ?>

    <div class="col-12">
        <blockquote id="post-<?php the_ID(); ?>" <?php post_class('postbox-item mb-50'); ?>>
            <span>
                <i class="flaticon-edit-tools-1"></i>
            </span>
            <div class="quote-text">
                <?php echo esc_html($quote_text); ?>
                <span><?php echo esc_html($quote_name); ?></span>
            </div>
        </blockquote>
    </div>

<?php else : ?>

    <div class="col-12">
        <blockquote id="post-<?php the_ID(); ?>" <?php post_class('postbox-item mb-50'); ?>>
            <span>
                <i class="flaticon-edit-tools-1"></i>
            </span>
            <div class="quote-text">
                <?php the_content(); ?>
            </div>
        </blockquote>
    </div>

<?php endif; ?>