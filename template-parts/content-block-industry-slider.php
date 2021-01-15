<section class="content-block content-block--industry-slider background-color--yellow">
	<div class="container">
		<h2>How Databasics Helps <?php the_title(); ?></h2>
		<div class="content-block--industry-slider-slick">

			<?php if (have_rows('industry_slider_blocks')) : ?>
				<?php while (have_rows('industry_slider_blocks')) : the_row(); ?>

					<div class="industry-slide">
						<h3 class="industry-slide-title"><span><?php the_sub_field('title_blue'); ?></span> <?php the_sub_field('title_dark'); ?></h3>
						<?php the_sub_field('text'); ?>
						<?php
						$link = get_sub_field('button');
						if ($link) :
							$link_url    = $link['url'];
							$link_title  = $link['title'];
							$link_target = $link['target'] ? $link['target'] : '_self';
						?>
							<a class="button button--blue" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
						<?php endif; ?>

					</div>

				<?php endwhile; ?>
			<?php endif; ?>

		</div>
	</div>
</section>