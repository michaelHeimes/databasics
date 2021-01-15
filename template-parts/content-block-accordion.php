<?php
$accordion_title            = get_sub_field('accordion_title');
$accordion_title_uppercase  = get_sub_field('accordion_title_uppercase');
$accordion_sections         = get_sub_field('accordion_sections');
$accordion_background_color = get_sub_field('accordion_background_color');
?>

<section class="content-block content-block--accordion background-color--<?php echo $accordion_background_color; ?>">
	<div class="container">
		<?php if ($accordion_title) : ?>
		<h2<?php if ($accordion_title_uppercase) { echo ' class="text-uppercase"'; } ?>><?php echo $accordion_title ?></h2>
		<?php endif; ?>
		<div class="content-block--accordion--wrap">
			<?php
			foreach ($accordion_sections as $section) :
				$title = $section['title'];
				$copy  = $section['copy'];

				if ($title && $copy) :
			?>
				<div class="content-block--accordion--section collapsed">
					<h2 class="section-title"><?php echo $title ?> <i class="fas fa-chevron-down"></i></h2>
					<div class="section-copy" style="display: none;">
						<?php echo $copy; ?>
						<p><a href="mailto:<?php echo antispambot('careers@data-basics.com'); ?>" class="button button--blue button--rounded">Send Resume</a></p>
					</div>
				</div><!-- .content-block__accordion__section -->
			<?php
				endif;
			endforeach;
			?>
		</div><!-- .content-block__accordion__wrap -->
	</div><!-- .container -->
</section><!-- .content-block__accordion -->