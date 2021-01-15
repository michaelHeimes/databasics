<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package DATABASICS
 */

get_header();
?>

<main id="primary" class="site-main">

	<section class="error-404 not-found margin--y-4 padding--x-2">
		<div class="container">
			<header class="page-header text-align--center">
				<h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'databasics'); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p class="text-align--center"><?php esc_html_e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'databasics'); ?></p>

				<?php get_search_form(); ?>
			</div><!-- .page-content -->
		</div>
	</section><!-- .error-404 -->

</main><!-- #main -->

<?php
get_footer();
