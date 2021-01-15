<?php
if (!isset($hero_title)) :
	$hero_title = get_field('content_title');

	if (empty($hero_title)) :
		$hero_title = get_the_title();
	endif;
endif;

if (!isset($hero_subtitle)) :
	$hero_subtitle = get_field('content_subtitle');
endif;

?>
<section class="hero-no-media hero background-color--blue">
	<div class="container">
		<div class="hero-text">

			<?php
			if ($hero_title) :
				echo '<h2 class="hero-title">' . $hero_title . '</h2>';
			endif;
			?>

			<?php
			if ($hero_subtitle) :
				echo '<h1 class="hero-copy">' . $hero_subtitle . '</h1>';
			endif;
			?>

		</div><!-- .hero-text -->
	</div><!-- .container -->
</section><!-- .hero -->
<div id="nav-waypoint"></div>
