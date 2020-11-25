<?php
/**
 * Vinky functions and definitions
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Vinky
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'vinky_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @return void
	 *
	 * @since 1.0.0
	 */
	function vinky_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'vinky', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
		add_theme_support( 'title-tag' );

		/**
		 * Add post-formats support.
		 */
		add_theme_support(
			'post-formats',
			array(
				'link',
				'aside',
				'gallery',
				'image',
				'quote',
				'status',
				'video',
				'audio',
				'chat',
			)
		);

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );

		/**
		 * Theme Support
		 */
		// Add theme support for Custom Logo.
		add_theme_support(
			'custom-logo',
			array(
				'width'                => 180,
				'height'               => 60,
				'flex-width'           => true,
				'flex-height'          => true,
				'unlink-homepage-logo' => true,
			)
		);

		add_theme_support( 'custom-background' );
		add_theme_support( 'video' );

		/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
		add_theme_support(
			'html5',
			array(
				'navigation-widgets',
				'search-form',
				'gallery',
				'caption',
				'style',
				'script',
				'comment-form',
				'comment-list',
			)
		);

		// Customize Selective Refresh Widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Custom background color.
		add_theme_support(
			'custom-background',
			array(
				'default-color' => 'd1e4dd',
			)
		);

		/*
		* Adds starter content to highlight the theme on fresh sites.
		* This is done conditionally to avoid loading the starter content on every
		* page load, as it is a one-off operation only needed once in the customizer.
		*/
		if ( is_customize_preview() ) {
			// phpcs:ignore
			require get_template_directory() . '/inc/starter-content.php';
			add_theme_support( 'starter-content', vinky_get_starter_content() );
		}

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add support for custom line height controls.
		add_theme_support( 'custom-line-height' );

		// Add support for experimental link color control.
		add_theme_support( 'experimental-link-color' );

		// Add support for experimental cover block spacing.
		add_theme_support( 'experimental-custom-spacing' );

		// Add support for custom units.
		add_theme_support( 'custom-units' );

		// WooCommerce.
		add_theme_support( 'woocommerce' );

		// Native AMP Support.
		if ( true === apply_filters( 'vinky_amp_support', true ) ) {
			add_theme_support(
				'amp',
				apply_filters(
					'vinky_amp_theme_features',
					array(
						'paired' => true,
					)
				)
			);
		}

		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'vinky' ),
				'social'  => __( 'Socials', 'vinky' ),
			)
		);
	}
}
add_action( 'after_setup_theme', 'vinky_setup' );

/**
 * Enqueue scripts and styles.
 *
 * @return void
 * @since 1.0.0
 */
function vinky_scripts() {
	// Note, the is_IE global variable is defined by WordPress and is used
	// to detect if the current browser is internet explorer.
	global $is_IE;

	if ( $is_IE ) {
		// If IE 11 or below, use a flattened stylesheet with static values replacing CSS Variables.
		wp_enqueue_style(
			'vinky-style',
			get_template_directory_uri() . '/assets/css/ie.css',
			array(),
			wp_get_theme()->get( 'Version' )
		);
	} else {
		// If not IE, use the standard stylesheet.
		wp_enqueue_style(
			'vinky-style',
			get_template_directory_uri() . '/style.css',
			array(),
			wp_get_theme()->get( 'Version' )
		);
	}

	// RTL support.
	wp_style_add_data( 'vinky-style', 'rtl', 'replace' );

	// Threaded comment reply styles.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Flexibility.js for flexbox IE10 support.
	wp_enqueue_script(
		'vinky-flexibility',
		get_theme_file_uri( 'assets/js/flexibility.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
	wp_add_inline_script(
		'vinky-flexibility',
		'flexibility(document.documentElement);'
	);
	wp_script_add_data( 'vinky-flexibility', 'conditional', 'IE' );

	// Polyfill for CustomEvent for IE.
	wp_register_script(
		'vinky-ie11-polyfills',
		get_theme_file_uri( 'assets/js/polyfill.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);

	wp_enqueue_script(
		'vinky-navigation',
		get_theme_file_uri( 'assets/js/navigation.js' ),
		array(
			'vinky-ie11-polyfills',
		),
		wp_get_theme()->get( 'Version' ),
		true
	);

	$vinky_localize = array(
		'breakPoint' => vinky_get_setting( 'header_mobile_breakpoint' ),
		// Header Break Point.
		'isRtl'      => is_rtl(),
	);

	wp_localize_script(
		'vinky-navigation',
		'vinky',
		apply_filters( 'vinky_script_localize', $vinky_localize )
	);

	// Comment assets.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'vinky_scripts' );

// Setup helper functions for Vinky theme.
require_once get_template_directory() . '/inc/common-functions.php';

// Enhance admin backend by hooking into WordPress.
require get_template_directory() . '/inc/admin-functions.php';

// Enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/template-functions.php';

// Menu functions and filters.
require get_template_directory() . '/inc/menu-functions.php';

// Custom template tags for the theme.
require get_template_directory() . '/inc/template-tags.php';

// Register widget area.
require get_template_directory() . '/inc/widgets.php';

// Customizer settings.
require_once get_template_directory() . '/inc/customizer/class-vinky-customizer.php';
require_once get_template_directory() . '/inc/classes/class-vinky-dynamic-styles.php';

// Font helpers.
require get_template_directory() . '/inc/fonts/class-vinky-font-families.php';
