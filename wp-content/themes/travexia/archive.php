<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hexa
 */

get_header();

$row_swipe = (!empty(get_theme_mod('blog_layout')) ? get_theme_mod('blog_layout') : 'right-sidebar');
$post_column = is_active_sidebar('post-sidebar') ? 'col-xl-8 col-lg-8 col-md-12' : 'col-xl-12 col-lg-12 col-md-12';

?>

<div class="hexa-area postbox-area pt-120 pb-120" >
	<div class="entry-content">
		<div class="container">
			<div class="row row-gap-50 <?php echo $row_swipe; ?>">
				<div class="<?php echo $post_column; ?>">
					<div class="content-wrapper">
						<?php if (get_the_archive_description()) { ?>
							<div class="des-category d-none">
								<?php echo '<h3>' . single_cat_title('', false) . '</h3>';
								the_archive_description(); ?>
							</div>
						<?php }
						if (have_posts()) : ?>
							<div class="row">
								<?php while (have_posts()) : the_post(); ?>
									<?php
									/*
								* Include the Post-Type-specific template for the content.
								* If you want to override this in a child theme, then include a file
								* called content-___.php (where ___ is the Post Type name) and that will be used instead.
								*/
									get_template_part('template-parts/post-type/content', get_post_format());
									?>
								<?php endwhile; ?>
							</div>
							<div class="hexa-pagination">
								<?php hexa_posts_navigation(); ?>
							</div>
						<?php
						else :
							get_template_part('template-parts/post-type/content', 'none');
						endif;
						?>
					</div>
				</div>
				<?php if (is_active_sidebar('post-sidebar')) { ?>
					<div class="col-xl-4 col-lg-4 col-md-12">
						<div class="widget-wrapper">
							<?php get_sidebar(); ?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();
