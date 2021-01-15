<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package DATABASICS
 */

get_header();
$hero_title            = 'Search Results';
$hero_subtitle         = sprintf(esc_html__('%s', 'databasics'), get_search_query());
$hero_background_media = '';
$hero_copy             = '';
$hero_background_color = 'blue';

global $wp_query;
?>

<main id="primary" class="site-main">

	<?php include(get_template_directory() . '/template-parts/hero.php'); ?>

	<section class="search-results--wrap">
		<div class="container">
			<?php if (have_posts()) : ?>
				<div>
					<p><strong><?php
					$per_page = array_key_exists('pp', $_GET) ? intval($_GET['pp']) : 10;
					if ($per_page > $wp_query->found_posts) :
						$per_page = $wp_query->found_posts;
					endif;
					$found_posts = $wp_query->found_posts;
					$paged = get_query_var('paged') ? get_query_var('paged') : 1;
					$from  = $paged == 1 ? 1 : ($paged - 1) * 10 + 1;
					$to    = $found_posts > ($paged * 10) ? $paged * 10 : $found_posts;
					if ($found_posts != 0) :
						echo 'Showing ' . $from . '-' . $to . ' of ' . $found_posts . ' results';
					else :
						echo 'Showing ' . $found_posts . ' results';
					endif;
					?></strong></p>
				</div>
			<?php
				/* Start the Loop */
				while (have_posts()) :
					the_post();

					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part('template-parts/content', 'search');

				endwhile;

				the_posts_navigation();

			else :

				get_template_part('template-parts/content', 'none');

			endif;
			?>
		</div>
	</section>

</main><!-- #main -->

<?php
get_footer();
