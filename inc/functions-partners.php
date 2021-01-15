<?php
// -----------------------------------------------------------------------------
//! Autocomplete
// -----------------------------------------------------------------------------

function partner_load_scripts()
{

	// Content Lib page
	if (is_page('partners')) {
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-autocomplete');
	}

	wp_deregister_script('wp-embed');
}
add_action('wp_enqueue_scripts', 'partner_load_scripts');

// -----------------------------------------------------------------------------
//! Set Ajax Localized Variable
// -----------------------------------------------------------------------------


function databasics_load_partners()
{

	$localized = [
		'ajaxUrl'  => admin_url('admin-ajax.php'),
		'siteUrl'  => get_site_url(),
		'themeDir' => get_bloginfo('template_url')
	];

	wp_register_script('partnersjs', get_template_directory_uri() . '/js/partners.js', ['jquery'], filemtime(get_theme_file_path('/js/partners.js')), true);
	wp_localize_script('partnersjs', 'localized', $localized);

	// partners page specific JS
	if (is_page('partners')) {
		wp_enqueue_script('partnersjs', get_template_directory_uri() . '/js/partners.js', ['jquery'], filemtime(get_theme_file_path('/js/partners.js')), true);
	}
}
add_action('wp_enqueue_scripts', 'databasics_load_partners');


// -----------------------------------------------------------------------------
//! REST API
// -----------------------------------------------------------------------------

// -----------------------------------------------------------------------------
//! Register routes
// -----------------------------------------------------------------------------

add_action('rest_api_init', function () {
	register_rest_route('databasics/v2', '/partners/', [
		'methods'             => 'GET',
		'callback'            => 'partners_get_posts',
		'permission_callback' => '__return_true'
	]);
});

// -----------------------------------------------------------------------------
//! Get partners
// -----------------------------------------------------------------------------

function partners_get_posts($data)
{
	$out = [
		'total_posts' => 0,
		'posts' => []
	];
	$args = [
		'post_type'      => ['partner'],
		'posts_per_page' => $data['per_page'],
		'orderby'        => $data['orderby'],
		'order'          => $data['order'],
		// 'post_status'    => 'any',
		's'              => $data['search'],
		'paged'          => $data['page'],
	];

	$tax_queries = $data['tax_queries'] ? $data['tax_queries'] : [];

	if (count($tax_queries)) :
		foreach ($data['tax_queries'] as $tax_query) {
			$obj = [
				'taxonomy' => $tax_query['taxonomy'],
				'field'    => $tax_query['field'],
				'terms'    => $tax_query['terms'],
			];
			$args['tax_query'][] = $obj;
		}
	endif;

	$query = new WP_Query($args);

	if (empty($query->posts)) {
		return json_encode($out);
	}

	$terms = [];
	$out['terms'] = [];

	while ($query->have_posts()) : $query->the_post();
		//Get the Type tax
		$type_names = [];
		$types      = get_the_terms(null, 'partner-type');

		if ($types) {
			foreach ($types as $type) {
				$type_names[] = $type->name;

				if (!in_array($type->name, $terms)) {
					$terms[] = $type->name;
				}
			}
		}

		//Get the Photo or show defautl
		$photo = get_template_directory_uri() . '/images/content_library-default.jpg';
		if ('' != get_the_post_thumbnail()) {
			$photo = wp_get_attachment_image_src(get_post_thumbnail_id(), 'partner-thumb')[0];
		}

		//Pass vars to JS
		$obj = [
			'title' => get_the_title(),
			'link'  => get_field('partner_link'),
			'blurb' => get_field('partner_blurb'),
			'photo' => $photo,
			'types' => $type_names,
		];

		$out['posts'][] = $obj;

	endwhile;

	foreach (get_terms('partner-type', [
		'orderby' => 'term_order',
		'order'   => 'ASC',
	]) as $term) :
		if (in_array($term->name, $terms)) :
			$out['terms'][] = $term->name;
		endif;
	endforeach;

	$out['total_posts'] = $query->found_posts;

	return json_encode($out);
}
