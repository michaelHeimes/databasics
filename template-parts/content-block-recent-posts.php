<?php
$resources = get_sub_field('resources');

if (!$resources) :
	$resources = get_field('resources', 'option');
endif;

if ($resources) :
?>
<section class="content-block content-block--recent-posts background-color--white">
	<div class="container">
		<h2>Resources</h2>
		<div class="content-block--recent-posts--wrapper">
			<?php foreach ($resources as $resource) : ?>
				<div class="content-block--recent-posts--post">
					<a href="<?php echo $resource['link']['url']; ?>"<?php if ($resource['link']['target']) { echo ' target="' . $resource['link']['target'] . '"'; } ?>>
						<div class="recent-post-image">
							<img src="<?php echo wp_make_link_relative($resource['image']['sizes']['media-block']); ?>" />
						</div>
						<div class="recent-post-text">
							<div class="recent-post-category">
								<?php echo $resource['title']; ?>
							</div>
							<div class="recent-post-title">
								<span><?php echo $resource['copy']; ?></span> &gt;
							</div>
						</div>
					</a>
				</div>
			<?php endforeach; ?>
		</div><!-- .content-block__recent-posts__wrapper -->
	</div><!-- .container -->
</section><!-- .content-block__recent-posts -->
<?php
endif;