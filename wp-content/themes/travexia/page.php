<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hexa
 */

get_header();

?>

<div class="hexa-area postbox-area pt-120 pb-120" >
	<div class="entry-content">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="content-wrapper">
						<?php
						if (have_posts()) :
							while (have_posts()) : the_post();
								get_template_part('template-parts/post-type/content', 'page');
							endwhile;
						else :
							get_template_part('template-parts/post-type/content', 'none');
						endif;
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();
