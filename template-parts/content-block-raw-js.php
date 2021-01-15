<?php
$wrap_container          = get_sub_field('wrap_container');
$raw_js                  = get_sub_field('raw_js');
$raw_js_background_color = get_sub_field('raw_js_background_color');
$raw_js_container_css    = get_sub_field('raw_js_container_css');

if ($wrap_container) :
	?>
<section class="content-block content-block--raw-js background-color--<?php echo $raw_js_background_color; ?> <?php echo $raw_js_container_css; ?>">
	<div class="container">
		<div class="content-block--raw-js--contents">

	<?php
endif;

echo $raw_js;

if ($wrap_container) :
	?>

		</div><!-- .content-block__raw-js__contents -->
	</div><!-- .container -->
</section><!-- .content-block__raw-js -->
	<?php
endif;