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

		<?php
		$system_status = get_field('system_status')['system_status'];

		if ($system_status == 'Offline') :
			$offline_status = get_field('system_status')['offline_status'];
		endif;

		if ($system_status == 'Other') :
			$system_status = get_field('system_status')['other_status'];
		endif;
		?>

		<div class="system-status system-status--<?php echo strtolower($system_status); ?> background-color--yellow">
			<div class="container">
				<h2>System Status: <span><?php echo $system_status; ?></span></h2>
				<?php
				if (isset($offline_status) && $offline_status) :
					echo wpautop($offline_status);
				endif;
				?>
			</div><!-- .container -->
		</div><!-- .system-status -->

		<?php
		$intro_copy = get_field('intro');

		if ($intro_copy) :
		?>
		<section class="content-block content-block--intro background-color--white">
			<div class="container">
				<div class="content-block--intro--text">
					<?php echo wpautop($intro_copy); ?>
				</div><!-- .content-block__intro__text -->
			</div><!-- .container -->
		</section><!-- .content-block__intro -->
		<?php endif; ?>

		<div class="container">
			<?php
			$support_links = get_field('support_links');

			if ($support_links) :
			?>
				<div class="support-links-grid">
					<?php
					foreach ($support_links as $support_link) :
						$title = $support_link['title'];
						$icon  = $support_link['icon'];
						$blurb = $support_link['blurb'];
						$link  = $support_link['link'];
					?>
						<a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>" class="grid-item text-align--center">
							<div class="support-icon"><?php echo $icon; ?></div>
							<div class="support-title"><?php echo $title; ?></div>
							<div class="support-text"><?php echo wpautop($blurb); ?></div>
						</a><!-- .grid-item -->
					<?php endforeach; ?>
				</div><!-- .support-links-grid -->
			<?php
			endif;
			?>

		<?php endwhile; // End of the loop.
		?>
		</div>

</main><!-- #main -->

<?php
get_footer();
