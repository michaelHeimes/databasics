<?php

/**
 * Template Name: Industries
 *
 * @package DATABASICS
 */

get_header();
global $post;
?>

<main id="primary" class="site-main">

	<?php get_template_part('template-parts/hero-industry'); ?>

	<?php
	if (post_password_required($post)) :
		echo get_the_password_form();
	else :
		get_template_part('template-parts/content-blocks');
	endif;
	?>

</main><!-- #main -->

<?php
get_footer();
