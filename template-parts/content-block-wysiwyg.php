<?php
$wysiwyg_copy = get_sub_field('wysiwyg_copy');
?>

<section class="content-block content-block--wysiwyg background-color--white">
	<div class="container">
		<div class="content-block--wysiwyg--text">
			<?php
			if ($wysiwyg_copy) :
				echo wpautop($wysiwyg_copy);
			endif;
			?>
		</div><!-- .content-block__wysiwyg__text -->
	</div><!-- .container -->
</section><!-- .content-block__wysiwyg -->