<?php
// -----------------------------------------------------------------------------
//! Autocomplete
// -----------------------------------------------------------------------------

function integration_load_scripts()
{

	// Content Lib page
	if (is_page('integrations')) {
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-autocomplete');
	}

	wp_deregister_script('wp-embed');
}
add_action('wp_enqueue_scripts', 'integration_load_scripts');

// -----------------------------------------------------------------------------
//! Set Ajax Localized Variable
// -----------------------------------------------------------------------------


function databasics_load_integration_library() {

	$localized = [
		'ajaxUrl'  => admin_url('admin-ajax.php'),
		'siteUrl'  => get_site_url(),
		'themeDir' => get_bloginfo('template_url')
	];

	wp_register_script('integration_libraryjs', get_template_directory_uri() . '/js/integration_library.js', ['jquery'], filemtime(get_theme_file_path('/js/integration_library.js')), true);
	wp_localize_script('integration_libraryjs', 'localized', $localized);

	// integration_library page specific JS
	if (is_page('integrations')) {
		wp_enqueue_script('integration_libraryjs', get_template_directory_uri() . '/js/integration_library.js', ['jquery'], filemtime(get_theme_file_path('/js/integration_library.js')), true);
	}
}
add_action('wp_enqueue_scripts', 'databasics_load_integration_library');


// -----------------------------------------------------------------------------
//! REST API
// -----------------------------------------------------------------------------

// -----------------------------------------------------------------------------
//! Register routes
// -----------------------------------------------------------------------------

add_action('rest_api_init', function () {
	register_rest_route('databasics/v2', '/integration_library/', [
		'methods'             => 'GET',
		'callback'            => 'integration_library_get_posts',
		'permission_callback' => '__return_true'
	]);
});

// -----------------------------------------------------------------------------
//! Get integration_library
// -----------------------------------------------------------------------------

function integration_library_get_posts($data) {
	$out = [
		'total_posts' => 0,
		'posts'       => []
	];
	$args = [
		'post_type'      => ['integration'],
		'posts_per_page' => $data['per_page'],
		'orderby'        => $data['orderby'],
		'order'          => $data['order'],
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

	$terms        = [];
	$out['terms'] = [];

	while ($query->have_posts()) : $query->the_post();
		//Get the Type tax
		$type_names = [];
		$types      = get_the_terms(null, 'integration-library-type');
		
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
			$photo = wp_get_attachment_image_src(get_post_thumbnail_id(), 'integration_library-thumb')[0];
		}
		
		
	
		
		//Pass vars to JS
		$obj = [
			'altlinkurl' => $alt_link_url,
			'altlinktarget' => $alt_link_target,
			'title' => get_the_title(),
			'link'  => null,
			'target' => '',
			'blurb' => wpautop(get_field('library_blurb')),
			'photo' => $photo,
			'types' => $type_names,
		];


		// check if we should be linking to the integration
		
		$alt_link = get_field('alternative_link');
		
		if ( !empty( $alt_link ) ) {
			
			$obj['link'] = $alt_link['url'];
			$obj['target'] = $alt_link['target'];		
		
		} else {

			$integration_benefits = get_field('integration_benefits');
			if (is_array($integration_benefits) && count($integration_benefits)) :
				$obj['link'] = get_the_permalink();
			endif;			
		
		}	


		
		


		$out['posts'][] = $obj;

	endwhile;

	foreach (get_terms('integration-library-type', [
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
