<?php

/**
 * Template Name: Landing Page
 *
 * @package DATABASICS
 */

get_header();
global $post;
?>

<main id="primary" class="site-main">

	<?php $background_color = get_field('background_color'); ?>
	<section class="lpIntro background-color--<?php echo $background_color; ?>">
		<div class="container">
			<div class="lp-left">
				
				<?php if(get_field('lp_left_title')) : ?>
					<h1 class="text-color--<?php the_field('lp_left_title_color'); ?>"><?php the_field('lp_left_title'); ?></h1>
				<?php endif; ?>
				<?php if(get_field('lp_left_subtitle')) : ?>
					<h2 class="text-color--<?php the_field('lp_left_subtitle_color'); ?>"><?php the_field('lp_left_subtitle'); ?></h2>
				<?php endif; ?>
				<div class="text-color--<?php the_field('lp_left_content_color'); ?>">
					<?php if(get_field('lp_left_content')) : ?>
						<?php the_field('lp_left_content'); ?>
					<?php endif; ?>
				</div>
				<?php if(get_field('lp_left_image')) : ?>
					<div class="lp-image">
						<?php echo wp_get_attachment_image( get_field('lp_left_image'), 'lp-image' ); ?>
					</div>
				<?php endif; ?>
				<?php if( have_rows('lp_left_ctas') ): ?>
					<div class="lp-ctas">
					<?php 
						while( have_rows('lp_left_ctas') ): the_row(); 
						$link = get_sub_field('button');
						if($link){
							$linkTarget = $link['target'] ? $link['target'] : '_self';					
						}
					?>
						<a href="<?php echo $link['url']; ?>" class="button button--blue button--rounded" target="<?php echo $linkTarget; ?>"><?php echo $link['title']; ?></a>
					<?php endwhile; ?>
					</div>
				<?php endif; ?>
			</div>
			<div class="lp-right">
				<?php if(get_field('lp_right_image')) : ?>
					<div class="lp-image">
						<?php echo wp_get_attachment_image( get_field('lp_right_image'), 'lp-image' ); ?>
					</div>
				<?php endif; ?>
				
				<?php if(get_field('lp_right_title')) : ?>
					<h2 class="text-color--<?php the_field('lp_right_title_color'); ?>"><?php the_field('lp_right_title'); ?></h2>
				<?php endif; ?>
				<?php if(get_field('lp_right_subtitle')) : ?>
					<h3 class="text-color--<?php the_field('lp_right_subtitle_color'); ?>"><?php the_field('lp_right_subtitle'); ?></h2>
				<?php endif; ?>
				<div class="text-color--<?php the_field('lp_left_content_color'); ?> center">
				<?php if(get_field('lp_right_content')) : ?>
					<?php the_field('lp_right_content'); ?>
				<?php endif; ?>
				</div>
				
				<?php if(get_field('lp_right_form_title')) : ?>
					<h2 class="text-color--<?php the_field('lp_right_form_title_color'); ?>"><?php the_field('lp_right_form_title'); ?></h2>
				<?php endif; ?>
				
				<?php if(get_field('lp_form')) : ?>
					<?php the_field('lp_form'); ?>
				<?php endif; ?>
				
				
				<?php if( have_rows('lp_right_ctas') ): ?>
					<div class="lp-ctas">
					<?php 
						while( have_rows('lp_right_ctas') ): the_row(); 
						$link = get_sub_field('button');
						if($link){
							$linkTarget = $link['target'] ? $link['target'] : '_self';					
						}
					?>
						<a href="<?php echo $link['url']; ?>" class="button button--blue button--rounded" target="<?php echo $linkTarget; ?>"><?php echo $link['title']; ?></a>
					<?php endwhile; ?>
					</div>
				<?php endif; ?>
				
			</div>
		</div>	
	</section>
	
	<div id="nav-waypoint"></div>
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
