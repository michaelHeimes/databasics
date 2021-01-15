<?php
$latest_count = $latest_count ?? 3;

$latest_posts = new WP_Query([
	'post_type'      => 'post',
	'posts_per_page' => $latest_count,
]);