<?php
$customer_successes = get_sub_field('customer_successes_repeater');
$customer_successes_background_color = get_sub_field('customer_successes_background_color');
if(!$customer_successes_background_color){
	$customer_successes_background_color = 'yellow';
}

if ($customer_successes) :
?>

<section class="customer-successes background-color--<?php echo $customer_successes_background_color; ?> slick--loading">
	<div class="container">
		<h2>Customer Successes</h2>
		<?php include(get_stylesheet_directory() . '/template-parts/loading-spinner.php'); ?>
		<div class="customer-successes--slider--wrap">
			<ul class="customer-successes--slider">
				<?php foreach ($customer_successes as $key => $customer_success) : ?>
				<li data-id="customer-success-<?php echo $key + 1; ?>">
					<div class="customer-container">
						<div class="customer-comment">
							<?php echo $customer_success['customer_comment']; ?>
						</div><!-- .customer-comment -->
						<div class="customer-image">
							<?php if ($customer_success['large_image']) : ?>
							<div class="customer-logo">
								<img src="<?php echo wp_make_link_relative($customer_success['logo']['sizes']['customer-successes-image']); ?>" alt="<?php echo $customer_success['logo']['alt']; ?>" />
							</div>
							<img src="<?php echo wp_make_link_relative($customer_success['large_image']['sizes']['media-block']); ?>" alt="<?php echo $customer_success['large_image']['alt']; ?>" />
							<?php endif; ?>
						</div><!-- .customer-image -->
					</div><!-- .customer-container -->
				</li><!-- #customer-success-<?php echo $key + 1; ?> -->
				<?php endforeach; ?>
			</ul><!-- .customer-successes__slider -->
			<ul class="customer-successes--slider--nav">
				<?php foreach ($customer_successes as $key => $customer_success) : ?>
				<li <?php echo $key === 0 ? 'class="active" ' : ''; ?>data-id="customer-success-<?php echo $key + 1; ?>">
					<div class="slick-pager">
						<img src="<?php echo wp_make_link_relative($customer_success['logo']['sizes']['customer-successes-nav']); ?>" alt="<?php echo $customer_success['company_name']; ?>" />
					</div><!-- .slick-pager -->
				</li>
				<?php endforeach; ?>
			</ul><!-- .customer-successes__slider__nav -->
			<?php /*
			<ul class="customer-successes--slider--prev-next">

			</ul><!-- .customer-successes__slider__prev-next -->
			*/ ?>
		</div><!-- .customer-successes__slider__wrap -->
	</div><!-- .container -->
</section><!-- .customer-successes -->

<?php endif;