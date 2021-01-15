<?php

/**
 * DATABASICS Advanced Custom Fields
 *
 * @package DATABASICS
 */

add_action('acf/init', function () {
	// Check function exists.
	if (function_exists('acf_add_options_page')) {
		// Add parent.
		$parent = acf_add_options_page(array(
			'page_title'  => __('Theme General Settings'),
			'menu_title'  => __('Theme Settings'),
			'redirect'    => false,
		));

		// Add sub page.
		// $child = acf_add_options_page(array(
		// 	'page_title'  => __('Social Settings'),
		// 	'menu_title'  => __('Social'),
		// 	'parent_slug' => $parent['menu_slug'],
		// ));
	}
});

// clean up leading/trailing white space in text/textarea fields
function trim_whitespace($value, $post_id, $field) {
	return trim($value);
}
add_filter('acf/update_value/type=text', 'trim_whitespace', 10, 3);
add_filter('acf/update_value/type=textarea', 'trim_whitespace', 10, 3);

/**
 * Apply ACF 'hide on screen' from all applicable field groups
 * instead of just the first one to appear on the edit page
 *
 * Note: this isn't working properly, so instead are applying
 *       '-1' order to the Content Blocks section to hide the_content
 */
// add_filter('acf/load_field_groups', function ($field_groups) {
// 	global $post;

// 	if (is_object($post) && $post->ID && $post->post_type) :
// 		$args = [
// 			'post_id'   => $post->ID,
// 			'post_type' => $post->post_type
// 		];

// 		$hide_on_screen = [];

// 		foreach ($field_groups as $key => $field_group) :
// 			if (acf_get_field_group_visibility($field_group, $args)) :
// 				if (!isset($first_field)) :
// 					$first_field = $key;
// 				endif;

// 				if (is_array($field_group['hide_on_screen']) && count($field_group['hide_on_screen']) > 0) :
// 					$hide_on_screen = $hide_on_screen + $field_group['hide_on_screen'];
// 				endif;
// 			endif;
// 		endforeach;

// 		$field_groups[$first_field]['hide_on_screen'] = array_unique($hide_on_screen);

// 		if (intval($post->ID) === intval(get_option('page_on_front')) && empty($field_groups[$first_field]['hide_on_screen'])) :
// 			$field_groups[$first_field]['hide_on_screen'] = ['the_content'];
// 		endif;
// 	endif;

// 	return $field_groups;
// });

/**
 * Get video thumbnail and save to post meta
 */
add_filter('acf/update_value/name=hero_background_embed', function ($value, $post_id, $field) {
	// check if it's a vimeo embed
	if (preg_match('/(vimeo\.com)/', $value)) :
		preg_match('/(?:https?:\/\/)?(?:www.)?(?:player.)?vimeo.com\/([\d^\/]+).*/', $value, $matches);
		$video_id = $matches[1];

		$response = wp_remote_get('https://vimeo.com/api/oembed.json?url=https://vimeo.com/' . $video_id);

		if (is_array($response) && !is_wp_error($response)) :
			$headers = $response['headers']; // array of http header lines
			$body    = json_decode($response['body'], true); // use the content

			if ($body && array_key_exists('thumbnail_url', $body)) :
				update_post_meta($post_id, 'hero_background_embed_thumb', $body['thumbnail_url']);
			endif;
		endif;
	elseif (preg_match('/(youtube\.com|youtu.be)/', $value)) :
		preg_match('^((?:https?:)?\/\/)?((?:www|m)\.)?((?:youtube\.com|youtu.be))(\/(?:[\w\-]+\?v=|embed\/|v\/)?)([\w\-]+)(\S+)?$', $value , $matches);
		$video_id = $matches[1];

		update_post_meta($post_id, 'hero_background_embed_thumb', '//img.youtube.com/vi/' . $video_id . '/0.jpg');
	else :
		update_post_meta($post_id, 'hero_background_embed_thumb', '');
	endif;

	return $value;
}, 10, 3);