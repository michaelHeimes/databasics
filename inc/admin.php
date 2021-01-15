<?php

/**
 * DATABASICS Admin Customizer
 *
 * @package DATABASICS
 */

// Move Yoast to bottom
add_filter('wpseo_metabox_prio', function () {
	return 'low';
});

// hide Duplicate Post notifications
remove_action('network_admin_notices', 'duplicate_post_show_update_notice');
remove_action('admin_notices', 'duplicate_post_show_update_notice');
remove_action('wp_ajax_duplicate_post_dismiss_notice', 'duplicate_post_dismiss_notice');

// allow XML file uploads
add_filter('upload_mimes', function ($mimes) {
	return array_merge($mimes, [
		'svg|svgz' => 'image/svg+xml',
		'ico'      => 'image/x-icon',
		'xml'      => 'application/xml'
	]);
});