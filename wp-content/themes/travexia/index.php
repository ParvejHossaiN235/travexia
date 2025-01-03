<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package travexia
 */

get_header();

$row_swipe = (!empty(get_theme_mod('blog_layout')) ? get_theme_mod('blog_layout') : 'right-sidebar');
$post_column = is_active_sidebar('post-sidebar') ? 'col-xl-8 col-lg-8 col-md-12' : 'col-xl-12 col-lg-12 col-md-12';

?>

<div class="hexa-area postbox-area pt-120 pb-100">
	<div class="entry-content">
		<div class="container">
			<div class="row row-gap-50 <?php echo esc_attr($row_swipe); ?>">
				<div class="<?php echo esc_attr($post_column); ?>">
					<div class="content-wrapper">
						<?php
						if (have_posts()) :
							if (is_home() && !is_front_page()) :
						?>
								<header>
									<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
								</header>
							<?php endif; ?>
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
								<?php travexia_posts_navigation(); ?>
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
						<div class="widget-wrapper sidebar-right">
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
