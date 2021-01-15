<?php

/**
 * POST TYPES
 *
 * Registration for any custom post types or taxonomies
 *
 */

// -----------------------------------------------------------------------------
//! SHORTHAND LABELS
// -----------------------------------------------------------------------------

function shorthand_post_type_labels($singular_name, $plural_name = '', $array_key_overrides = []) {

	if (empty($plural_name)) :
		$plural_name = $singular_name . 's';
	endif;

	$labels = [
		'name'                       => $plural_name,
		'singular_name'              => $singular_name,
		'add_new'                    => 'Add New',
		'add_new_item'               => 'Add New ' . $singular_name,
		'edit_item'                  => 'Edit ' . $singular_name,
		'new_item'                   => 'New ' . $singular_name,
		'view_item'                  => 'View ' . $singular_name,
		'search_items'               => 'Search ' . $plural_name,
		'not_found'                  => 'No ' . $plural_name . ' Found',
		'not_found_in_trash'         => 'No ' . $plural_name . ' Found in Trash',
		'parent_item_colon'          => 'Parent ' . $singular_name . ':',
		'all_items'                  => 'All ' . $plural_name,
		'attributes'                 => $singular_name . ' Attributes',
		'separate_items_with_commas' => 'Separate ' . strtolower($plural_name) . ' with commas',
		'choose_from_most_used'      => 'Choose from the most used ' . strtolower($plural_name),
	];

	$labels = array_merge($labels, $array_key_overrides);

	return $labels;
}


// -----------------------------------------------------------------------------
//! REGISTER CUSTOM POST TYPES
// -----------------------------------------------------------------------------

add_action('init', function () {

	// -----------------------------------------------------------------------------
	// CONTENT LIBRARY CUSTOM POST TYPE
	// -----------------------------------------------------------------------------
	$clLabels = [
		'name'               => 'Content Library',
		'singular_name'      => 'Content',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Content',
		'edit_item'          => 'Edit Content',
		'new_item'           => 'New Content',
		'view_item'          => 'View Content',
		'search_items'       => 'Search Content',
		'not_found'          => 'No Content Found',
		'not_found_in_trash' => 'No Content Found in Trash',
		'parent_item_colon'  => 'Parent Content:',
		'all_items'          => 'All Content',
		'attributes'         => 'Content Attributes'
	];
	register_post_type('content-library', [
		'labels'              => $clLabels,
		'public'              => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'show_ui'             => true,
		'show_in_nav_menus'   => true,
		'show_in_menu'        => true,
		'query_var'           => true,
		'capability_type'     => 'post',
		'has_archive'         => false,
		'hierarchical'        => true,
		'menu_icon'           => 'dashicons-admin-page',
		'menu_position'       => null,
		'supports'            => ['title', 'thumbnail', 'page-attributes', 'revisions'],
	]);


	// -----------------------------------------------------------------------------
	// INTEGRATION CUSTOM POST TYPE
	// -----------------------------------------------------------------------------

	register_post_type('integration', [
		'labels'              => shorthand_post_type_labels('Integration'),
		'public'              => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'show_ui'             => true,
		'show_in_nav_menus'   => true,
		'show_in_menu'        => true,
		'query_var'           => true,
		'capability_type'     => 'post',
		'has_archive'         => false,
		'hierarchical'        => true,
		'menu_icon'           => 'dashicons-layout',
		'menu_position'       => null,
		'supports'            => ['title', 'thumbnail', 'page-attributes', 'revisions'],
	]);


	// -----------------------------------------------------------------------------
	// PARTNER CUSTOM POST TYPE
	// -----------------------------------------------------------------------------

	register_post_type('partner', [
		'labels'              => shorthand_post_type_labels('Partner'),
		'public'              => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'show_ui'             => true,
		'show_in_nav_menus'   => true,
		'show_in_menu'        => true,
		'query_var'           => true,
		'capability_type'     => 'post',
		'has_archive'         => false,
		'hierarchical'        => true,
		'menu_icon'           => 'dashicons-id-alt',
		'menu_position'       => null,
		'supports'            => ['title', 'thumbnail', 'page-attributes', 'revisions'],
	]);
});



// -----------------------------------------------------------------------------
//! Custom Taxonomies
// -----------------------------------------------------------------------------

add_action('init', 'create_contentlib_taxonomies', 0);

function create_contentlib_taxonomies()
{

	// -----------------------------------------------------------------------------
	//! Integrations post type
	// -----------------------------------------------------------------------------

	$labels = [
		'name'              => _x('Types', 'taxonomy general name', 'databasics'),
		'singular_name'     => _x('Type', 'taxonomy singular name', 'databasics'),
		'search_items'      => __('Search Types', 'databasics'),
		'all_items'         => __('All Types', 'databasics'),
		'parent_item'       => __('Parent Type', 'databasics'),
		'parent_item_colon' => __('Parent Type:', 'databasics'),
		'edit_item'         => __('Edit Type', 'databasics'),
		'update_item'       => __('Update Type', 'databasics'),
		'add_new_item'      => __('Add New Type', 'databasics'),
		'new_item_name'     => __('New Type Name', 'databasics'),
		'menu_name'         => __('Type', 'databasics'),
	];

	$args = [
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => ['slug' => 'integration-library-type'],
	];

	register_taxonomy('integration-library-type', ['integration'], $args);


	// -----------------------------------------------------------------------------
	//! Content Library post type
	// -----------------------------------------------------------------------------

	$labels = [
		'name'              => _x('Types', 'taxonomy general name', 'databasics'),
		'singular_name'     => _x('Type', 'taxonomy singular name', 'databasics'),
		'search_items'      => __('Search Types', 'databasics'),
		'all_items'         => __('All Types', 'databasics'),
		'parent_item'       => __('Parent Type', 'databasics'),
		'parent_item_colon' => __('Parent Type:', 'databasics'),
		'edit_item'         => __('Edit Type', 'databasics'),
		'update_item'       => __('Update Type', 'databasics'),
		'add_new_item'      => __('Add New Type', 'databasics'),
		'new_item_name'     => __('New Type Name', 'databasics'),
		'menu_name'         => __('Type', 'databasics'),
	];

	$args = [
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => ['slug' => 'content-library-type'],
	];

	register_taxonomy('content-library-type', ['content-library'], $args);

	$labels = [
		'name'              => _x('Solutions', 'taxonomy general name', 'databasics'),
		'singular_name'     => _x('Solution', 'taxonomy singular name', 'databasics'),
		'search_items'      => __('Search Solutions', 'databasics'),
		'all_items'         => __('All Solutions', 'databasics'),
		'parent_item'       => __('Parent Solution', 'databasics'),
		'parent_item_colon' => __('Parent Solution:', 'databasics'),
		'edit_item'         => __('Edit Solution', 'databasics'),
		'update_item'       => __('Update Solution', 'databasics'),
		'add_new_item'      => __('Add New Solution', 'databasics'),
		'new_item_name'     => __('New Solution Name', 'databasics'),
		'menu_name'         => __('Solution', 'databasics'),
	];

	$args = [
		'hierarchical'          => true,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => ['slug' => 'content-library-solution'],
	];

	register_taxonomy('content-library-solution', 'content-library', $args);


	// -----------------------------------------------------------------------------
	//! Partners post type
	// -----------------------------------------------------------------------------

	$labels = [
		'name'              => _x('Types', 'taxonomy general name', 'databasics'),
		'singular_name'     => _x('Type', 'taxonomy singular name', 'databasics'),
		'search_items'      => __('Search Types', 'databasics'),
		'all_items'         => __('All Types', 'databasics'),
		'parent_item'       => __('Parent Type', 'databasics'),
		'parent_item_colon' => __('Parent Type:', 'databasics'),
		'edit_item'         => __('Edit Type', 'databasics'),
		'update_item'       => __('Update Type', 'databasics'),
		'add_new_item'      => __('Add New Type', 'databasics'),
		'new_item_name'     => __('New Type Name', 'databasics'),
		'menu_name'         => __('Type', 'databasics'),
	];

	$args = [
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => ['slug' => 'partner-type'],
	];

	register_taxonomy('partner-type', ['partner'], $args);
}
