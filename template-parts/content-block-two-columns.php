<?php
$two_columns_left_column      = get_sub_field('two_columns_left_column');
$two_columns_right_column     = get_sub_field('two_columns_right_column');
$two_columns_background_color = get_sub_field('two_columns_background_color');
?>

<section class="content-block content-block--two-columns background-color--<?php echo $two_columns_background_color; ?>">
	<div class="container">
		<div class="content-block--two-columns--wrap">
			<?php
			foreach ([$two_columns_left_column, $two_columns_right_column] as $column) :
				$title     = $column['title'];
				$uppercase = $column['title_uppercase'];
				$copy      = $column['copy'];
			?>
				<div class="content-block--two-columns--text">
					<?php if ($title) : ?>
						<h2<?php if ($uppercase) { echo ' class="text-uppercase"'; } ?>><?php echo $title ?></h2>
					<?php endif; ?>
					<?php if ($copy) : ?>
						<?php echo $copy; ?>
					<?php endif; ?>
				</div><!-- .content-block__two-columns__text -->
			<?php endforeach; ?>
		</div><!-- .content-block__two-columns__wrap -->
	</div><!-- .container -->
</section><!-- .content-block__two-columns -->