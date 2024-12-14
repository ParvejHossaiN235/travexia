<?php

/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hexa
 */

$sidebar = 'post-sidebar';

if (!is_active_sidebar($sidebar)) {
	return;
}
?>

<?php dynamic_sidebar($sidebar); ?>
