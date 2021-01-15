<?php
$feature_grid_background_color      = get_sub_field('feature_grid_background_color');
$feature_grid_title                 = get_sub_field('feature_grid_title');
$feature_grid_title_uppercase       = get_sub_field('feature_grid_title_uppercase');
$feature_grid_copy                  = get_sub_field('feature_grid_copy');
$feature_grid_grid_items            = get_sub_field('feature_grid_grid_items');
$feature_grid_grid_item_color       = strtolower(get_sub_field('feature_grid_grid_item_color'));
$feature_grid_grid_item_hover_color = strtolower(get_sub_field('feature_grid_grid_item_hover_color'));

$background_colors = [
	'white'  => '#fff',
	'yellow' => '#fde021',
	'blue'   => '#00a0df',
	'gray'   => '#4a4f54',
];

$svg_icons = [
	'360',
	'bell',
	'chart',
	'clipboard-check',
	'employee',
	'globe',
	'graph',
	'shield',
];

?>

<section class="content-block content-block--feature-grid background-color--<?php echo $feature_grid_background_color; ?>">
	<div class="container">
		<div class="content-block--feature-grid--content">
			<?php if ($feature_grid_title) : ?>
			<h2<?php if ($feature_grid_title_uppercase) { echo ' class="text-uppercase"'; } ?>><?php echo $feature_grid_title ?></h2>
			<?php endif; ?>

			<?php
			if ($feature_grid_copy) :
				echo wpautop($feature_grid_copy);
			endif;
			?>

			<?php
			if ($feature_grid_grid_items) :
				echo '<div class="grid-item--container">';

				foreach ($feature_grid_grid_items as $grid_item) :
					$grid_item_icon  = $grid_item['grid_item_icon'];
					$grid_item_label = $grid_item['grid_item_label'];
					$grid_item_blurb = $grid_item['grid_item_blurb'];

					if ($grid_item_icon == 'random') :
						$grid_item_icon = $svg_icons[array_rand($svg_icons)];
					endif;
					?>
					<div class="grid-item">
						<div class="grid-item-inner">
							<div class="grid-item--hover" style="background-color: <?php echo $background_colors[$feature_grid_grid_item_hover_color]; ?>;">
								<div class="grid-item-hover-inner">
									<?php
									if ($grid_item_label) :
										echo '<h4>' . $grid_item_label . '</h4>';
									endif;
									?>
									<?php
									if ($grid_item_blurb) :
										echo wpautop($grid_item_blurb);
									endif;
									?>
								</div>
							</div><!-- .grid-item__hover -->
							<div class="grid-item--contents" style="background-color: <?php echo $background_colors[$feature_grid_grid_item_color]; ?>;">
							<?php if ($grid_item_icon) : ?>
								<div class="grid-item--contents--icon">
									<?php echo file_get_contents(get_theme_file_path('images/svgs/icons/' . $grid_item_icon . '.svg')); ?>
								</div><!-- .grid-item__contents__icon -->
							<?php endif; ?>
							<?php if ($grid_item_label) : ?>
								<div class="grid-item--contents--text">
									<?php echo $grid_item_label; ?>
								</div><!-- .grid-item__contents__text -->
							<?php endif; ?>
							</div><!-- .grid-item__contents -->
						</div>
					</div><!-- .grid-item -->
					<?php
				endforeach;
				echo '</div><!-- .grid-item__container -->';
			endif;
			?>
		</div><!-- .content-block__feature-grid__content -->
	</div><!-- .container -->
</section><!-- .content-block__feature-grid -->
