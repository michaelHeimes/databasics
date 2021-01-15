<?php
if (!isset($hero_title)) :
	$hero_title = get_field('hero_title');

	if (empty($hero_title)) :
		$hero_title = get_the_title();
	endif;
endif;

if (!isset($hero_subtitle)) :
	$hero_subtitle = get_field('hero_subtitle');
endif;

if (!isset($hero_copy)) :
	$hero_copy = get_field('hero_copy');
endif;

if (!isset($hero_background_media)) :
	$hero_background_media = get_field('hero_background_media');
endif;

$hero_background_image = get_field('hero_background_image');
$hero_background_video = get_field('hero_background_video');
$hero_background_embed = get_field('hero_background_embed');

if (!isset($hero_background_color)) :
	$hero_background_color = get_field('hero_background_color');
endif;

$hero_classes          = ['hero'];
$hero_background_embed_thumb = '';

if ($hero_background_media) :
	$hero_classes[] = 'hero-' . $hero_background_media;
else :
	$hero_classes[] = 'hero-no-media';
endif;

if (is_front_page()) :
	$hero_classes[] = 'front-page';
endif;

if ($hero_background_color) :
	$hero_classes[] = 'background-color--' . $hero_background_color;
endif;

if ($hero_background_media == 'embed') :
	$hero_background_embed_thumb = get_post_meta(get_the_ID(), 'hero_background_embed_thumb', true);
endif;
?>
<section class="<?php echo implode(' ', $hero_classes); ?>">
	<?php if ($hero_background_media == 'image' && $hero_background_image) : ?>
		<div class="hero-media" style="background-image: url('<?php echo wp_make_link_relative($hero_background_image['sizes']['hero-bg']); ?>');"></div><!-- .hero-media -->
	<?php elseif ($hero_background_media == 'embed' && $hero_background_embed) : ?>
		<div class="hero-media"<?php if ($hero_background_embed_thumb) { echo ' style="background-image: url(' . $hero_background_embed_thumb . ');"'; } ?>>
			<div class="video-embed">
				<?php echo background_embed($hero_background_embed, [
					'autoplay'   => 1,
					'loop'       => 1,
					'autopause'  => 0,
					'background' => 1,
					'mute'       => 1,
				]); ?>
			</div><!-- .video-embed -->
		</div><!-- .hero-media -->
	<?php elseif ($hero_background_media == 'video' && $hero_background_video) : ?>
		<div class="hero-media">
			<video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
				<source src="<?php echo wp_make_link_relative($hero_background_video['url']); ?>" type="video/mp4">
			</video>
		</div><!-- .hero-media -->
	<?php endif; ?>
	<div class="container">
		<div class="hero-text">

			<?php
			if ($hero_title) :
				echo '<h1>' . $hero_title . '</h1>';
			endif;
			?>

			<?php
			if ($hero_subtitle) :
				echo '<h2>' . $hero_subtitle . '</h2>';
			endif;
			?>

			<?php
			if ($hero_copy) :
				echo wpautop($hero_copy);
			endif;
			?>

		</div><!-- .hero-text -->
	</div><!-- .container -->
</section><!-- .hero -->
<div id="nav-waypoint"></div>
<?php if ($hero_background_media == 'embed' && $hero_background_embed) : ?>
	<script>
		jQuery(document).ready(function($) {
			var heroIframe = document.querySelector('.hero-media .video-embed iframe');
			var heroPlayer = new Vimeo.Player(heroIframe);

			heroPlayer.on('loaded', function() {
				console.log('player.js loaded the video!');
			});

			heroPlayer.on('play', function() {
				console.log('player.js played the video!');
			});

			heroPlayer.getVideoTitle().then(function(title) {
				console.log('player.js title:', title);
			});
		});
	</script>
<?php endif; ?>