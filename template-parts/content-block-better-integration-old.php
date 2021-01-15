<?php
$better_integrations = [
	[
		'image' => wp_make_link_relative(get_stylesheet_directory_uri() . '/images/integrations/db-logo.png'),
	],
	[
		'image' => wp_make_link_relative(get_stylesheet_directory_uri() . '/images/integrations/plus-sign.png'),
	],
];

$better_integration_integrations = get_sub_field('better_integration_integrations');

if (is_array($better_integration_integrations) && count($better_integration_integrations)) :
	foreach ($better_integration_integrations as $integration) :
		$image = wp_get_attachment_image_src(get_post_thumbnail_id($integration->ID), 'product-info-nav')[0];

		if ($image) :
			$better_integrations[] = [
				'image' => $image,
				'link'  => wp_make_link_relative(get_permalink($integration->ID)),
			];
		endif;
	endforeach;
else :
	$default_integrations = [
		'microsoft-dynamics-gp',
		'dynamics365',
		'sage-intacct',
		'netsuite',
		'adp',
	];

	foreach ($default_integrations as $default) :
		$_integration = get_page_by_path($default, OBJECT, 'integration');

		$better_integrations[] = [
			'image' => wp_make_link_relative(wp_get_attachment_image_src(get_post_thumbnail_id($_integration->ID), 'product-info-nav')[0]),
			'link' => wp_make_link_relative(get_permalink($_integration->ID)),
		];
	endforeach;
endif;
?>

<section class="better-integration background-color--gray">
	<div class="container">
		<h2><span>Integrations</span></h2>

		<div class="better-integration--grid">
			<?php
			foreach ($better_integrations as $integration) :
				if (array_key_exists('link', $integration)) :
					echo '<a href="' . $integration['link'] . '">';
				endif;
			?><img src="<?php echo $integration['image']; ?>" /><?php
				if (array_key_exists('link', $integration)) :
					echo '</a>';
				endif;
			endforeach;
			?>
		</div><!-- .better-integration__grid -->
	</div><!-- .container -->
</section><!-- .better-integration -->