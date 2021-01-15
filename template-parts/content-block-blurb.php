<?php
$blurb_background_color    = get_sub_field('blurb_background_color');
$blurb_title               = get_sub_field('blurb_title');
$blurb_title_uppercase     = get_sub_field('blurb_title_uppercase');
$blurb_subtitle            = get_sub_field('blurb_subtitle');
$blurb_copy                = get_sub_field('blurb_copy');
$blurb_button              = get_sub_field('blurb_button');
$blurb_blurb_container_css = get_sub_field('blurb_container_css');
?>

<section class="content-block content-block--blurb background-color--<?php echo $blurb_background_color; ?>">
	<div class="container">
		<div class="content-block--blurb--text <?php echo $blurb_blurb_container_css; ?>">
			<?php if ($blurb_title) : ?>
			<h2<?php if ($blurb_title_uppercase) { echo ' class="text-uppercase"'; } ?>><?php echo $blurb_title ?></h2>
			<?php endif; ?>

			<?php if ($blurb_subtitle) : ?>
			<h3><?php echo $blurb_subtitle ?></h3>
			<?php endif; ?>

			<?php
			if ($blurb_copy) :
				echo wpautop($blurb_copy);
			endif;
			?>

			<?php
			if ($blurb_button) :
				$target = $blurb_button['target'] ? ' target="' . $blurb_button['target'] . '"' : '';
				?>
				<a href="<?php echo $blurb_button['url']; ?>" class="button button--blue"<?php echo $target; ?>><?php echo $blurb_button['title']; ?></a>
				<?php
			endif;
			?>
		</div><!-- .content-block__blurb__text -->
	</div><!-- .container -->
</section><!-- .content-block__blurb -->