<?php
if (isset($cb_intro)) {
	$intro_background_color = $cb_intro['intro_background_color'];
	$intro_title            = $cb_intro['intro_title'];
	$intro_title_uppercase  = $cb_intro['intro_title_uppercase'];
	$intro_copy             = $cb_intro['intro_copy'];
	$intro_button           = $cb_intro['intro_button'];
} else {
	$intro_background_color = get_sub_field('intro_background_color');
	$intro_title            = get_sub_field('intro_title');
	$intro_title_uppercase  = get_sub_field('intro_title_uppercase');
	$intro_copy             = get_sub_field('intro_copy');
	$intro_button           = get_sub_field('intro_button');
}
?>

<section class="content-block content-block--intro background-color--<?php echo $intro_background_color; ?>">
	<div class="container">
		<div class="content-block--intro--text">
			<?php if ($intro_title) : ?>
			<h2<?php if ($intro_title_uppercase) { echo ' class="text-uppercase"'; } ?>><?php echo $intro_title ?></h2>
			<?php endif; ?>

			<?php
			if ($intro_copy) :
				echo wpautop($intro_copy);
			endif;
			?>

			<?php
			if ($intro_button) :
				$target = $intro_button['target'] ? ' target="' . $intro_button['target'] . '"' : '';
				?>
				<a href="<?php echo $intro_button['url']; ?>" class="button button--blue"<?php echo $target; ?>><?php echo $intro_button['title']; ?></a>
				<?php
			endif;
			?>
		</div><!-- .content-block__intro__text -->
	</div><!-- .container -->
</section><!-- .content-block__intro -->