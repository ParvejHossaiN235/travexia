<?php

get_header();

?>

<div class="hexa-megamenu">
    <?php
    while (have_posts()) :
        the_post();
        the_content();
    endwhile;
    ?>
</div>