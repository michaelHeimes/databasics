<?php
if ($cb_intro) {
	$media_block_title       = $cb_media_block['media_block_title'];
	$media_block_subtitle    = $cb_media_block['media_block_subtitle'];
	$media_block_copy        = $cb_media_block['media_block_copy'];
	$media_block_media_type  = $cb_media_block['media_block_media_type'];
	$media_block_image       = $cb_media_block['media_block_image'];
	$media_block_video_embed = $cb_media_block['media_block_video_embed'];
	$media_block_button      = $cb_media_block['media_block_button'];
} else {
	$media_block_title       = get_sub_field('media_block_title');
	$media_block_subtitle    = get_sub_field('media_block_subtitle');
	$media_block_copy        = get_sub_field('media_block_copy');
	$media_block_media_type  = get_sub_field('media_block_media_type');
	$media_block_image       = get_sub_field('media_block_image');
	$media_block_video_embed = get_sub_field('media_block_video_embed');
	$media_block_button      = get_sub_field('media_block_button');
}


$media_block_video_embed_video_id = $media_block_video_embed;
preg_match('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $media_block_video_embed, $match);
$media_block_video_embed_video_url = $match[0];
preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $media_block_video_embed_video_url, $match);
$media_block_video_embed_video_id = $match[1];
?>

<section class="content-block content-block--media-block background-color--white">
	<div class="container">
		<div class="content-block--media-block--media">
			<?php if ($media_block_media_type == 'image') : ?>
				<img src="<?php echo wp_make_link_relative($media_block_media['sizes']['media-block']); ?>" alt="<?php echo $media_block_media['alt']; ?>" />
			<?php elseif ($media_block_media_type == 'video') : ?>
				<div class="video-embed video-embed--modal" data-youtube-id="<?php echo $media_block_video_embed_video_id; ?>">
					<img src="https://img.youtube.com/vi/<?php echo $media_block_video_embed_video_id; ?>/maxresdefault.jpg" />
				</div><!-- .video-embed__modal -->
			<?php endif; ?>
		</div><!-- .content-block__media-block__media -->
		<div class="content-block--media-block--text">
			<h2>
				<?php echo $media_block_title; ?>
				<?php if ($media_block_subtitle) : ?>
					<span><?php echo $media_block_subtitle; ?></span>
				<?php endif; ?>
			</h2>
			<?php
			if ($media_block_copy) :
				echo wpautop($media_block_copy);
			endif;
			?>

			<?php
			if ($media_block_button) :
				$target = $media_block_button['target'] ? ' target="' . $media_block_button['target'] . '"' : '';
			?>
				<a href="<?php echo $media_block_button['url']; ?>" class="button button--blue" <?php echo $target; ?>><?php echo $media_block_button['title']; ?></a>
			<?php
			endif;
			?>
		</div><!-- .content-block__media-block__text -->
	</div><!-- .container -->
</section><!-- .content-block__media-block -->
