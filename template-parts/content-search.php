<?php

/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DATABASICS
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>

		<?php if ('post' === get_post_type()) : ?>
			<div class="entry-meta">
				<?php
				databasics_posted_on();
				databasics_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php // databasics_post_thumbnail(); ?>

	<div class="entry-summary">
		<?php
		if (get_post_type() == 'page' && have_rows('content_blocks')) :
			while (have_rows('content_blocks')) : the_row();
				if (get_row_layout() == 'intro') :
					echo wpautop(substr(strip_tags(get_sub_field('intro_copy')), 0, 150) . '... <a href="#">Read More</a>');
					break;
				endif;
			endwhile;
		elseif (get_post_type() == 'post' || get_post_type() == 'page') :
			the_excerpt();
		elseif (get_post_type() == 'integration') :
			echo wpautop(substr(strip_tags(get_field('integration_intro_copy')), 0, 150) . '... <a href="#">Read More</a>');
		endif;
		?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php databasics_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->