<?php
$highlight_blurb_background_color = get_sub_field('highlight_blurb_background_color');
$highlight_blurb_copy_dark        = get_sub_field('highlight_blurb_copy_dark');
$highlight_blurb_copy_blue        = get_sub_field('highlight_blurb_copy_blue');
$highlight_blurb_container_css    = get_sub_field('highlight_blurb_container_css');
?>

<section class="content-block content-block--highlight-blurb background-color--<?php echo $highlight_blurb_background_color; ?>">
	<div class="container">
		<div class="content-block--highlight-blurb--text <?php echo $highlight_blurb_container_css; ?>">
			<?php if ($highlight_blurb_copy_dark) : ?>
				<p class="highlight-blurb-dark"><?php echo $highlight_blurb_copy_dark; ?></p>
			<?php endif; ?>

			<?php if ($highlight_blurb_copy_blue) : ?>
				<p class="highlight-blurb-blue"><?php echo $highlight_blurb_copy_blue; ?></p>
			<?php endif; ?>


		</div><!-- .content-block__highlight-blurb__text -->
	</div><!-- .container -->
</section><!-- .content-block__highlight-blurb -->