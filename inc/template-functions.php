<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package DATABASICS
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
add_filter('body_class', function ($classes) {
	global $post;

	// Adds a class of hfeed to non-singular pages.
	if (!is_singular()) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if (!is_active_sidebar('sidebar-1')) {
		$classes[] = 'no-sidebar';
	}

	if (!is_search() && !is_404()) :
		foreach ($classes as $key => $class) {
			if ($class === $post->post_type) {
				unset($classes[$key]);
			}
		}

		$classes[] = 'post-type-' . $post->post_type;
		$classes[] = $post->post_type . '-' . $post->post_name;
	endif;

	if (is_front_page()) :
		$classes[] = 'front-page';
	endif;

	return $classes;
});

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
add_action('wp_head', function () {
	if (is_singular() && pings_open()) {
		printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
	}
});

// -----------------------------------------------------------------------------
//! GET POST ID BY SLUG
// -----------------------------------------------------------------------------

if (!function_exists('get_id_by_slug')) :
	function get_id_by_slug($slug, $output = OBJECT, $post_type = 'page') {
		global $wpdb;

		$query = 'SELECT ' . $wpdb->posts . '.ID FROM ' . $wpdb->posts . ' WHERE ' . $wpdb->posts . '.post_name = \'' . $slug . '\' AND ' . $wpdb->posts . '.post_type = \'' . $post_type . '\' LIMIT 1';

		$results = $wpdb->get_results($query, $output);

		$ID = 0;

		foreach ($results as $page) :
			$ID = $page->ID;
		endforeach;

		if (intval($ID)) :
			return intval($ID);
		endif;

		return NULL;
	}
endif;

/**
 * Remove portrait, title, byline from video embeds
 */

if (!function_exists('background_embed')) :
	function background_embed($iframe = '', $args = [], $echo = false)
	{
		// check if it's a vimeo embed
		preg_match('/(vimeo\.com)/', $iframe, $matches);
		if (count($matches) >= 2) :
			return background_vimeo_embed($iframe, $args, $echo);
		endif;

		// check if it's a youtube embed
		preg_match('/(youtube\.com|youtu.be)/', $iframe, $matches);
		if (count($matches) >= 2) :
			return background_youtube_embed($iframe, $args, $echo);
		endif;

		return $iframe;
	}
endif;

// Vimeo
if (!function_exists('background_vimeo_embed')) :
	function background_vimeo_embed($iframe = '', $args = [], $echo = false) {
		global $wp_version;

		// check that it has a url for the iframe
		preg_match('/src="(.+?)"/', $iframe, $matches);

		if (count($matches) < 2) :
			return $iframe;
		endif;

		$src = $matches[1];

		// Add extra parameters to src and replcae HTML.
		$default_args = [
			'color'    => '00a0df',
			'title'    => 0,
			'byline'   => 0,
			'portrait' => 0,
			'muted'    => 1,
		];
		$params  = array_merge($default_args, $args);
		$new_src = add_query_arg($params, $src);
		$iframe  = str_replace($src, $new_src, $iframe);

		// Add extra attributes to iframe HTML.
		$attributes = 'frameborder="0"';
		$iframe     = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);

		// add Vimeo script (maybe)
		if (!wp_script_is('vimeo-player')) :
			wp_enqueue_script('vimeo-player', '//player.vimeo.com/api/player.js', [], $wp_version, true);
		endif;

		if (!$echo) :
			return $iframe;
		endif;

		echo $iframe;
	}
endif;


// YouTube
if (!function_exists('background_youtube_embed')) :
	function background_youtube_embed($iframe = '', $args = [], $echo = false) {
		global $wp_version;

		// check if it's a youtube embed
		preg_match('/(youtube\.com|youtu.be)/', $iframe, $matches);
		if (count($matches) < 2) :
			return $iframe;
		endif;

		// check that it has a url for the iframe
		preg_match('/src="(.+?)"/', $iframe, $matches);

		if (count($matches) < 2) :
			return $iframe;
		endif;

		$src = $matches[1];

		if (preg_match('^((?:https?:)?\/\/)?((?:www|m)\.)?((?:youtube\.com|youtu.be))(\/(?:[\w\-]+\?v=|embed\/|v\/)?)([\w\-]+)(\S+)?$', $src, $matches)) :
			$id = $matches[1];
		endif;

		// Add extra parameters to src and replcae HTML.
		$default_args = [
			'enablejsapi'    => 1,
			'disablekb'      => 1,
			'controls'       => 0,
			'rel'            => 0,
			'iv_load_policy' => 3,
			'cc_load_policy' => 0,
			'playsinline'    => 1,
			'showinfo'       => 0,
			'modestbranding' => 1,
			'fs'             => 0,
			'mute'           => 1,
			'autoplay'       => 1,
			'loop'           => 1,
		];
		$params  = array_merge($default_args, $args);
		$new_src = add_query_arg($params, $src);
		$iframe  = str_replace($src, $new_src, $iframe);

		// Add extra attributes to iframe HTML.
		$attributes = 'frameborder="0"';
		$iframe     = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);

		// add Vimeo script (maybe)
		if (!wp_script_is('youtube-player-api')) :
			wp_enqueue_script('youtube-player-api', '//www.youtube.com/player_api', [], $wp_version, true);
		endif;

		if (!$echo) :
			return $iframe;
		endif;

		echo $iframe;
	}
endif;