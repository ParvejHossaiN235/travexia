<?php

/**
 * The main template file
 *
 * @package  WordPress
 * @subpackage  hexacore
 */

?>

<div class="hexa-footer-area">
   <?php
   while (have_posts()) :
      the_post();
      the_content();
   endwhile;
   ?>
</div>

<?php get_footer();  ?>