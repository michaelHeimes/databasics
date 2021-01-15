<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package DATABASICS
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php get_template_part('template-parts/hero', 'integration'); ?>

	<?php
	while (have_posts()) : the_post();
		$full_company_name = get_field('integration_full_company_name');
		$logo_white        = get_field('integration_logo_white');
		$logo_color        = get_field('integration_logo_color');
		$integration       = get_field('integration_integration');
		$intro_copy        = get_field('integration_intro_copy');
		$benefits          = get_field('integration_benefits');
		$outro_copy        = get_field('integration_outro_copy');
		?>
	<section class="integration--intro background-color--white">
		<div class="container">
			<div class="better-integration--grid">
				<img src="<?php echo wp_make_link_relative(wp_get_attachment_image_src(260, 'icon-65')[0]); ?>" />
				<img src="<?php echo wp_make_link_relative(get_stylesheet_directory_uri() . '/images/integrations/plus-sign-blue.png'); ?>" />
				<img src="<?php echo wp_make_link_relative($logo_color['sizes']['integration-thumb']); ?>" class="company-logo" />
			</div><!-- .better-integration__grid -->
			<h2><?php the_title(); ?></h2>
			<h3>DATABASICS Open Data Integrations: <?php echo $integration; ?></h3>
			<?php
			if ($intro_copy) :
				echo wpautop($intro_copy);
			endif;
			?>
		</div><!-- .container -->
	</section><!-- .integration__intro -->

	<?php if ($benefits) : ?>
	<section class="integration--benefits background-color--light-gray">
		<div class="container">
			<ul>
				<?php foreach ($benefits as $benefit) : ?>
					<li>
						<div class="feature-icon">
							<i class="fas fa-check"></i>
						</div>
						<?php echo $benefit['feature_copy']; ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</div><!-- .container -->
	</section><!-- .integration-benefits -->
	<?php endif; ?>

	<?php if ($outro_copy) : ?>
	<section class="integration--outro background-color--white">
		<div class="container">
			<?php echo wpautop($outro_copy); ?>
		</div><!-- .container -->
	</section><!-- .integration__outro -->
	<?php endif; ?>

	<?php endwhile; // End of the loop. ?>

	<?php get_template_part('template-parts/content-block', 'recent-posts'); ?>

</main><!-- #main -->

<?php
get_footer();
