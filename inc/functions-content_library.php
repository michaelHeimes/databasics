<?php
// -----------------------------------------------------------------------------
//! Autocomplete
// -----------------------------------------------------------------------------

function db_load_scripts()
{

	// Content Lib page
	if (is_page('content-library')) {
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-autocomplete');
	}

	wp_deregister_script('wp-embed');
}
add_action('wp_enqueue_scripts', 'db_load_scripts');

// -----------------------------------------------------------------------------
//! Set Ajax Localized Variable
// -----------------------------------------------------------------------------


function databasics_load_content_library()
{
	$localized = [
		'ajaxUrl'  => admin_url('admin-ajax.php'),
		'siteUrl'  => get_site_url(),
		'themeDir' => get_bloginfo('template_url')
	];

	wp_register_script('content_libraryjs', get_template_directory_uri() . '/js/content_library.js', ['jquery'], filemtime(get_theme_file_path('/js/content_library.js')), true);
	wp_localize_script('content_libraryjs', 'localized', $localized);

	// content_library page specific JS
	if (is_page('content-library')) {
		wp_enqueue_script('content_libraryjs', get_template_directory_uri() . '/js/content_library.js', ['jquery'], filemtime(get_theme_file_path('/js/content_library.js')), true);
	}
}
add_action('wp_enqueue_scripts', 'databasics_load_content_library');


// -----------------------------------------------------------------------------
//! REST API
// -----------------------------------------------------------------------------

// -----------------------------------------------------------------------------
//! Register routes
// -----------------------------------------------------------------------------

add_action('rest_api_init', function () {
	register_rest_route('databasics/v2', '/content_library/', [
		'methods'             => 'GET',
		'callback'            => 'content_library_get_posts',
		'permission_callback' => '__return_true'
	]);
});

// -----------------------------------------------------------------------------
//! Get content_library
// -----------------------------------------------------------------------------

function content_library_get_posts($data)
{
	$out = [
		'total_posts' => 0,
		'posts'       => [],
	];
	$args = [
		'post_type'      => ['content-library'],
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

	while ($query->have_posts()) : $query->the_post();
		//Get the Type tax
		$type_names = [];
		$types      = get_the_terms(null, 'content-library-type');

		if ($types) {
			foreach ($types as $type) {
				$type_names[] = $type->name;
			}
		}

		//Get the solutions tax
		$solution_names = [];
		$solutions      = get_the_terms(null, 'content-library-solution');

		if ($solutions) {
			foreach ($solutions as $solution) {
				$solution_names[] = $solution->name;
			}
		}


		//Determine if it's new
		$isNew      = get_field('is_new');
		$isFeatured = get_field('is_featured');

		if ($isFeatured) {
			$postDate = '<div class="trio-tag is-blue">Featured</div>';
		} elseif ($isNew) {
			$postDate = '<div class="trio-tag is-yellow">New</div>';
		} else {
			$postDate = '';
		}


		//Get the Photo or show defautl
		$photo = get_template_directory_uri() . '/images/content_library-default.jpg';

		if ('' != get_the_post_thumbnail()) {
			$photo = wp_get_attachment_image_src(get_post_thumbnail_id(), 'content_library-thumb')[0];
		}

		$altLink = get_field('content_url');
		if($altLink){
			$link = $altLink;
		}else {
			$link = get_the_permalink();
		}

		//Pass vars to JS
		$obj = [
			'title'     => get_the_title(),
			'link'      => $link,
			'date'      => $postDate,
			'photo'     => $photo,
			'types'     => $type_names,
			'solutions' => $solution_names
		];
		$out['posts'][] = $obj;

	endwhile;

	$out['total_posts'] = $query->found_posts;

	return json_encode($out);
}
