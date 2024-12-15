<?php

/**
 * Portfolio single template file
 *
 * @package  WordPress
 * @subpackage  hexacore
 */

get_header();
?>

<div class="portfolio-content">
   <div class="content-wrapper">
      <?php
      while (have_posts()) : the_post();
         the_content();
      endwhile; // End of the loop.
      ?>
   </div>
</div>

<?php
get_footer();
