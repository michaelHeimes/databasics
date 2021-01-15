<?php
$product_info_items = get_sub_field('product_info_items');

if (is_null($product_info_items)) :
	$product_info_items = get_field('product_info_items', get_id_by_slug('front-page'));
endif;

if ($product_info_items) :
	$product_infos = [];

	foreach ($product_info_items as $product_info_item) :
		$_info_item_title  = explode(' ', $product_info_item['info_item_title'], 2);
		$_info_item_button = $product_info_item['info_item_button'];
		$_info_item_image  = $product_info_item['info_item_image'];

		$_info_item = [
			'pager'  => $product_info_item['info_item_nav_label'],
			'title'  => 'Better <span>' . $_info_item_title[1] . '</span>',
			'copy'   => wpautop($product_info_item['info_item_copy']),
			'button' => null,
			'image'  => null,
		];

		// setup the button if it exists
		if ($_info_item_button) :
			$_info_item['button'] = [
				'label' => $_info_item_button['title'],
				'link'  => $_info_item_button['url'],
			];
		endif;

		// setup the image if it exists
		if ($_info_item_image) :
			$_info_item['image'] = $_info_item_image;
		endif;

		$product_infos[] = $_info_item;
	endforeach;
endif;

if (isset($product_infos) && count($product_infos)) :
?>

<section class="product-info background-color--yellow slick--loading">
	<div class="container">
		<h2 class="text-uppercase">Better in Every Way that Matters</h2>
		<?php include(get_stylesheet_directory() . '/template-parts/loading-spinner.php'); ?>
		<ul class="product-info--slider--nav">
			<?php foreach ($product_infos as $key => $product_info) : ?>
				<li <?php echo $key === 0 ? 'class="active" ' : ''; ?>data-id="product-info-<?php echo $key + 1; ?>">
					<?php echo $product_info['pager']; ?>
				</li>
			<?php endforeach; ?>
		</ul><!-- .product-info__slider__nav -->
		<div class="product-info--slider--wrap">
			<ul class="product-info--slider">
				<?php foreach ($product_infos as $key => $product_info) : ?>
					<li data-id="product-info-<?php echo $key + 1; ?>">
						<div class="product-info--container">
							<div class="product-info--image">
								<?php if (array_key_exists('image', $product_info) && !is_null($product_info['image'])) : ?>
									<img src="<?php echo wp_make_link_relative($product_info['image']['sizes']['media-block']); ?>" />
								<?php else : ?>
									<img src="<?php echo wp_make_link_relative(get_stylesheet_directory_uri() . '/images/iPhone.png'); ?>" />
								<?php endif; ?>
							</div><!-- .product-info__image -->
							<div class="product-info--copy">
								<h2><?php echo $product_info['title']; ?></h2>
								<?php echo wpautop($product_info['copy']); ?>
								<?php if ($product_info['button']) : ?>
									<a href="<?php echo $product_info['button']['link']; ?>" class="button button--blue"><?php echo $product_info['button']['label']; ?></a>
								<?php endif; ?>
							</div><!-- .product-info__copy -->
						</div><!-- .product-info__container -->
					</li><!-- #product-info-<?php echo $key + 1; ?> -->
				<?php endforeach; ?>
			</ul><!-- .product-info__slider -->
		</div><!-- .product-info__slider__wrap -->
	</div><!-- .container -->
</section><!-- .product-info -->

<?php
endif;