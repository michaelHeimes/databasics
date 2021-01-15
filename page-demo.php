<?php

/**
 * Template Name: Request a Demo
 *
 * @package DATABASICS
 */

get_header();

$demo_video_embed  = get_field('demo_video_embed');
$demo_video_upload = get_field('demo_video');
?>

<main id="primary" class="site-main">

	<?php get_template_part('template-parts/hero'); ?>

	<?php get_template_part('template-parts/content-blocks'); ?>

<?php /*
	<section class="request-demo background-color--white">
		<div class="container">
			<div class="request-demo--wrap">
				<?php if ($demo_video_embed || $demo_video_upload) : ?>
				<div class="demo-video">

				<?php if ($demo_video_embed) : ?>
				<div class="demo-embed">
					<div class="demo-embed-center">
						<h2>See our solution in action.</h2>
						<div class="demo-embed-wrap">
							<?php echo background_vimeo_embed($demo_video_embed); ?>
						</div>
					</div>
				</div><!-- .video-embed -->
				<?php elseif ($demo_video_upload) : ?>
					<video controls="controls" muted="muted" width="<?php echo $demo_video_upload['width']; ?>" height="<?php echo $demo_video_upload['height']; ?>">
						<source src="<?php echo wp_make_link_relative($demo_video_upload['url']); ?>" type="<?php echo $demo_video_upload['mime_type']; ?>">
					</video>
				<?php endif; ?>

				</div><!-- .demo-video -->
				<?php endif; ?>
				<div class="request-demo-form">

<!--[if lte IE 8]>
<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
<![endif]-->
<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
<script>
  hbspt.forms.create({
      portalId: "2107769",
      formId: "d1be7018-46a2-45b2-ada0-f68100771402"
});
</script>

				</div><!-- .request-demo-form -->
			</div><!-- .request-demo__wrap -->
		</div><!-- .container -->
	</section><!-- .request-demo-form -->
*/ ?>

</main><!-- #main -->

<?php
get_footer();


