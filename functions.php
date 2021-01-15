<?php

/**
 * DATABASICS functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package DATABASICS
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

if (!function_exists('databasics_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function databasics_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on DATABASICS, use a find and replace
		 * to change 'databasics' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('databasics', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			[
				'main'    => esc_html__('Main', 'databasics'),
				'utility' => esc_html__('Utility', 'databasics'),
				'footer'  => esc_html__('Footer', 'databasics'),
			]
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			[
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			]
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'databasics_custom_background_args',
				[
					'default-color' => 'ffffff',
					'default-image' => '',
				]
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			[
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			]
		);

		// Add custom image sizes
		add_image_size('media-block', 590, 440);
		add_image_size('icon-65', 65, 65);
		add_image_size('product-info-nav', 150, 50);
		add_image_size('customer-successes-nav', 150, 50);
		add_image_size('customer-successes-image', 250);
		add_image_size('content_library-thumb', 300, 220, true);
		add_image_size('integration_library-thumb', 300, 220);
		add_image_size('partner-thumb', 300, 220);
		add_image_size('team-grid', 300, 285);
		add_image_size('integration-thumb', 150, 150);
		add_image_size('hero-bg', 1600, 500, true);
		add_image_size('content-single', 400, 5000, true);
		add_image_size('lp-image', 560, 5000, false);
	}
endif;
add_action('after_setup_theme', 'databasics_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function databasics_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters('databasics_content_width', 640);
}
add_action('after_setup_theme', 'databasics_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function databasics_widgets_init() {
	register_sidebar([
		'name'          => esc_html__('Footer', 'databasics'),
		'id'            => 'footer',
		// 'description'   => esc_html__('Add widgets here.', 'databasics'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	]);

	register_sidebar([
		'name'          => esc_html__('Social', 'databasics'),
		'id'            => 'social',
		// 'description'   => esc_html__('Add widgets here.', 'databasics'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	]);
}
add_action('widgets_init', 'databasics_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function databasics_scripts() {
	wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;900&amp;family=Roboto:wght@300;400;500;700&amp;display=swap');

	wp_enqueue_style('databasics-style', get_stylesheet_directory_uri() . '/css/style.css', [], filemtime(get_stylesheet_directory() . '/css/style.css'));
	wp_style_add_data('databasics-style', 'rtl', 'replace');

	wp_enqueue_script('databasics-slick', get_stylesheet_directory_uri() . '/js/libs/slick.min.js', [], filemtime(get_stylesheet_directory() . '/js/libs/slick.min.js'), true);
	wp_enqueue_script('databasics-waypoints', get_stylesheet_directory_uri() . '/js/libs/jquery.waypoints.min.js', [], filemtime(get_stylesheet_directory() . '/js/libs/jquery.waypoints.min.js'), true);

	wp_enqueue_script('databasics-video-modal', get_stylesheet_directory_uri() . '/js/video-modal.js', ['jquery'], filemtime(get_stylesheet_directory() . '/js/video-modal.js'), true);

	wp_enqueue_script('databasics-scripts', get_stylesheet_directory_uri() . '/js/scripts.js', ['jquery', 'databasics-slick'], filemtime(get_stylesheet_directory() . '/js/scripts.js'), true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'databasics_scripts');

/**
 * Enable WP Admin customizations.
 */
require get_template_directory() . '/inc/admin.php';

/**
 * Implement ACF settings
 */
require get_template_directory() . '/inc/acf.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Include custom post types declaractions.
 */
require get_template_directory() . '/inc/post-types.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * Content Library AJAX Stuff.
 */
require get_template_directory() . '/inc/functions-content_library.php';
require get_template_directory() . '/inc/functions-integration_library.php';
require get_template_directory() . '/inc/functions-partners.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}
