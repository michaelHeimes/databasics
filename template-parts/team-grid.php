<?php
$team_grid = get_field('team_grid');



$team_grid_title                 = get_sub_field('team_grid_title');
$team_grid_title_uppercase       = get_sub_field('team_grid_title_uppercase');
$team_grid_copy                  = get_sub_field('team_grid_copy');
$team_grid_grid_items            = get_sub_field('team_grid_grid_items');
$team_grid_grid_item_color       = strtolower(get_sub_field('team_grid_grid_item_color'));
$team_grid_grid_item_hover_color = strtolower(get_sub_field('team_grid_grid_item_hover_color'));

if ($team_grid) :
?>

<section class="team-grid background-color--white">
	<div class="container">
		<div class="team-grid--content">
			<div class="grid-item--container">
			<?php
			foreach ($team_grid as $grid_item) :
				$grid_item_name  = $grid_item['name'];
				$grid_item_title = $grid_item['title'];
				$grid_item_bio   = $grid_item['bio'];
				$grid_item_photo = $grid_item['photo'];
				?>
				<div class="grid-item">
					<div class="grid-item-inner">
						<div class="grid-item--hover">
							<div class="grid-item-hover-inner">
								<?php
								if ($grid_item_name) :
									echo '<h4>' . $grid_item_name . '</h4>';
								endif;
								?>
								<?php
								if ($grid_item_bio) :
									echo wpautop($grid_item_bio);
								endif;
								?>
							</div>
						</div><!-- .grid-item__hover -->
						<div class="grid-item--contents">
						<?php if ($grid_item_photo) : ?>
							<div class="grid-item--contents--photo">
								<img src="<?php echo $grid_item_photo['sizes']['team-grid']; ?>" alt="<?php echo $grid_item_photo['alt']; ?>" />
							</div><!-- .grid-item__contents__photo -->
						<?php endif; ?>
						<?php if ($grid_item_name) : ?>
							<div class="grid-item--contents--text">
								<h4><?php echo $grid_item_name; ?></h4>
								<?php if ($grid_item_title) : ?>
									<p><?php echo $grid_item_title; ?></p>
								<?php endif; ?>
							</div><!-- .grid-item__contents__text -->
						<?php endif; ?>
						</div><!-- .grid-item__contents -->
					</div><!-- .grid-item-inner -->
				</div><!-- .grid-item -->
				<?php
			endforeach;
			?>
			</div><!-- .grid-item__container -->
		</div><!-- .team-grid__content -->
	</div><!-- .container -->
</section><!-- .team-grid -->

<?php
endif;