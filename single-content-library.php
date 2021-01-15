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

	
	<?php get_template_part('template-parts/hero-content'); ?>
		
	<section class="content-block content-block--blurb background-color--white split-content-block">
		<div class="container">
			<div class="split-content-block-image">
				<?php echo wp_get_attachment_image( get_field('content_image'), 'content-single' ); ?>
				
			</div>
			<div class="content-block--blurb--text text-align--left">
				<?php the_field('content_text'); ?>
	
			</div>
			
		</div>
		
		<div class="content-form">
			<?php if(get_field('content_form_title')): ?>
				<h2 class="content-form-title"><?php the_field('content_form_title'); ?></h2>
			<?php endif; ?>
			
			<?php the_field('form_code'); ?>
		</div>
	</section>

</main>

<?php
get_footer();
