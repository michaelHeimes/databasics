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
 * @package DATABASICS
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php get_template_part('template-parts/hero'); ?>

	<?php while (have_posts()) : the_post(); ?>

		<div class="container">

			<?php
			if (post_password_required()) :
				echo get_the_password_form();
			else :
				get_template_part('template-parts/content', 'page');
			endif;
			?>

		<?php endwhile; // End of the loop.
		?>
	</div>

</main><!-- #main -->

<?php
get_footer();
