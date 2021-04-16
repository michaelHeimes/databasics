<?php
$two_columns_left_column      = get_sub_field('two_columns_left_column');
$two_columns_right_column     = get_sub_field('two_columns_right_column');
$top_two_columns_background_color = get_sub_field('top_two_columns_background_color');
$bottom_cta_background_color = get_sub_field('bottom_cta_background_color');
?>

<section class="content-block content-block--three-cta-set top background-color--<?php echo $top_two_columns_background_color; ?>">
	<div class="container">
		<div class="content-block--three-cta-set--wrap">
			
			<?php
			foreach ([$two_columns_left_column, $two_columns_right_column] as $column) :
				$large_title = $column['large_title'];
				$small_title = $column['smaller_title'];
				$copy      = $column['copy'];
				$link = $column['link'];
			?>
				<div class="content-block--three-cta-set--text text-center">
					
					<h2>
						<?php if ($large_title) : ?>
							<span class="lg-title"><?php echo $large_title ?></span>
						<?php endif; ?>
						<?php if ($small_title) : ?>
							<span class="sm-title"><?php echo $small_title ?></span>
						<?php endif; ?>						
					</h2>
					
					<?php if ($copy) : ?>
						<div class="break"></div>
						<div class="copy-wrap">
							<?php echo $copy; ?>
						</div>
					<?php endif; ?>
										
					<?php if ($link) : ?>
					<div class="btn-wrap text-center">
						<a class="btn-link" href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>"><?php echo esc_html( $link['title'] ); ?></a>
					</div>
					<?php endif;?>
					
				</div><!-- .content-block__two-columns__text -->
			<?php endforeach; ?>
		</div><!-- .content-block__two-columns__wrap -->
				
	</div><!-- .container -->
</section><!-- .content-block__two-columns -->



<section class="content-block content-block--three-cta-set bottom background-color--<?php echo $bottom_cta_background_color; ?>">
	<div class="container">

		<div class="content-block--three-cta-set--wrap">
			<div class="content-block--three-cta-set--text text-center">
				<?php if( have_rows('bottom_row') ):?>
					<?php while ( have_rows('bottom_row') ) : the_row();?>	
					
						<?php
							$large_title = get_sub_field('large_title');
							$small_title = get_sub_field('smaller_title');
							$copy      = get_sub_field('copy');
							$link = get_sub_field('link');
						?>
					
						<h2>
							<?php if ($large_title) : ?>
								<span class="lg-title"><?php echo $large_title ?></span>
							<?php endif; ?>
							<?php if ($small_title) : ?>
								<span class="sm-title"><?php echo $small_title ?></span>
							<?php endif; ?>						
						</h2>
						
						<?php if ($copy) : ?>
							<div class="copy-wrap">
								<?php echo $copy; ?>
							</div>
						<?php endif; ?>
											
						<?php if ($link) : ?>
						<div class="btn-wrap text-center">
							<a class="btn-link" href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>"><?php echo esc_html( $link['title'] ); ?></a>		
						</div>
						<?php endif;?>				
				
					<?php endwhile;?>
				<?php endif;?>
			</div>
		</div>
		
	</div>
</section>