<?php
/**
 * Register customizer panels and sections.
 *
 * @package     Vinky
 * @author      Vinky
 * @copyright   Copyright (c) 2020, Vinky
 * @link        https://www.vinkythemes.com/
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register customizer panels and sections.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 *
 * @return void
 * @since  1.0.0
 */
function register_pane( $wp_customize ) {

	/**
	 * Global Panel
	 */
	$wp_customize->add_panel(
		'general_settings',
		array(
			'priority' => 10,
			'title'    => esc_html__( 'General Settings', 'vinky' ),
		)
	);

	// Update the Site Identity section to be inside Global Settings.
	$wp_customize->add_section(
		'title_tagline',
		array(
			'title'    => esc_html__( 'Site Identity', 'vinky' ),
			'panel'    => 'general_settings',
			'priority' => 0,
		)
	);

	// Layout Settings section.
	$wp_customize->add_section(
		'general_layout',
		array(
			'title'    => esc_html__( 'Layout Settings', 'vinky' ),
			'panel'    => 'general_settings',
			'priority' => 6,
		)
	);

	// Typography Section.
	$wp_customize->add_section(
		'typography',
		array(
			'title'    => esc_html__( 'Typography', 'vinky' ),
			'panel'    => 'general_settings',
			'priority' => 7,
		)
	);

	// Fonts Section.
	$wp_customize->add_section(
		'fonts',
		array(
			'title'    => esc_html__( 'Available Fonts', 'vinky' ),
			'section'  => 'typography',
			'panel'    => 'general_settings',
			'priority' => 8,
		)
	);

	// Colors Section.
	$wp_customize->get_section( 'colors' )->panel    = 'general_settings';
	$wp_customize->get_section( 'colors' )->priority = 9;

	// Background Section.
	$wp_customize->get_section( 'background_image' )->panel    = 'general_settings';
	$wp_customize->get_section( 'background_image' )->priority = 10;
	$wp_customize->get_section( 'background_image' )->title    = __( 'Background', 'vinky' );

	/**
	 * Header & Navigation Panel
	 */
	$wp_customize->add_panel(
		'headers',
		array(
			'title'    => esc_html__( 'Header & Navigation', 'vinky' ),
			'priority' => 11,
		)
	);

	// Primary Header section.
	$wp_customize->add_section(
		'site_branding',
		array(
			'title'    => esc_html__( 'Site Branding', 'vinky' ),
			'panel'    => 'headers',
			'priority' => 1,
		)
	);

	// Primary Header section.
	$wp_customize->add_section(
		'primary_header',
		array(
			'title'    => esc_html__( 'Primary Header', 'vinky' ),
			'panel'    => 'headers',
			'priority' => 2,
		)
	);

	// Primary Menu.
	$wp_customize->add_section(
		'primary_menu',
		array(
			'title'    => esc_html__( 'Primary Menu', 'vinky' ),
			'panel'    => 'headers',
			'priority' => 3,
		)
	);

	/**
	 * Footer Panel
	 */
	$wp_customize->add_panel(
		'footers',
		array(
			'title'    => esc_html__( 'Footer', 'vinky' ),
			'priority' => 12,
		)
	);

	// Footer Layout.
	$wp_customize->add_section(
		'footer_layout',
		array(
			'title'    => esc_html__( 'Layout', 'vinky' ),
			'panel'    => 'footers',
			'priority' => 1,
		)
	);

	// Footer Widgets.
	$wp_customize->add_section(
		'footer_widgets',
		array(
			'title'    => esc_html__( 'Widgets', 'vinky' ),
			'panel'    => 'footers',
			'priority' => 2,
		)
	);

	/**
	 * Blog Panel
	 */
	$wp_customize->add_panel(
		'blog',
		array(
			'title'    => esc_html__( 'Blog', 'vinky' ),
			'priority' => 13,
		)
	);

	// Blog/Archive Options.
	$wp_customize->add_section(
		'blog_archive',
		array(
			'title'    => esc_html__( 'Blog / Archive', 'vinky' ),
			'panel'    => 'blog',
			'priority' => 1,
		)
	);

	// Blog Single Options.
	$wp_customize->add_section(
		'blog_single',
		array(
			'title'    => esc_html__( 'Single Post', 'vinky' ),
			'panel'    => 'blog',
			'priority' => 2,
		)
	);

	/**
	 * Sidebar Panel.
	 */
	$wp_customize->add_section(
		'sidebars',
		array(
			'priority' => 14,
			'title'    => esc_html__( 'Sidebar', 'vinky' ),
		)
	);

	/**
	 * Buttons Panel.
	 */
	$wp_customize->add_panel(
		'buttons',
		array(
			'title'    => esc_html__( 'Buttons', 'vinky' ),
			'priority' => 15,
		)
	);
}
add_action( 'customize_register', 'register_pane' );

// phpcs:disable WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
require get_template_directory() . '/inc/customizer/pane/global/class-vinky-site-identity-section.php';
require get_template_directory() . '/inc/customizer/pane/global/class-vinky-all-fonts-section.php';
require get_template_directory() . '/inc/customizer/pane/global/class-vinky-layout-section.php';
require get_template_directory() . '/inc/customizer/pane/global/class-vinky-colors-section.php';
require get_template_directory() . '/inc/customizer/pane/global/class-vinky-background-section.php';
require get_template_directory() . '/inc/customizer/pane/header/class-vinky-site-branding-section.php';
require get_template_directory() . '/inc/customizer/pane/header/class-vinky-primary-header-section.php';
// phpcs:enable WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
