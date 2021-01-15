<?php
$gravity_form_intro            = get_sub_field('gravity_form_intro');
$gravity_form_form             = get_sub_field('gravity_form_form');
$gravity_form_background_color = get_sub_field('gravity_form_background_color');
?>

<section class="content-block content-block--gravity-form background-color--<?php echo $gravity_form_background_color; ?>">
	<div class="container">
		<div class="content-block--gravity-form--wrap">
			<?php if ($gravity_form_intro) : ?>
				<?php echo $gravity_form_intro; ?>
			<?php endif; ?>
			<?php if ($gravity_form_form && function_exists('gravity_form')) : ?>
				<div class="content-block--gravity-form--form">
					<?php gravity_form($gravity_form_form['id'], false, true, false, '', true, 1); ?>
				</div><!-- .content-block__gravity-form__form -->
			<?php endif; ?>
		</div><!-- .content-block__gravity-form__wrap -->
	</div><!-- .container -->
</section><!-- .content-block__gravity-form -->