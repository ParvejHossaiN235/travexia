<?php

get_header();

?>

<div class="hexa-header-area">
    <?php
    while (have_posts()) :
        the_post();
        the_content();
    endwhile;
    ?>
</div>