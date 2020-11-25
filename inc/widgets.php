<?php
/**
 * Functions related to widgets and sidebar areas.
 *
 * @package     Vinky
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register widget area.
 */
if ( ! function_exists( 'vinky_widgets_init' ) ) :

	/**
	 * Register widget area.
	 *
	 * @see https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	function vinky_widgets_init() {

		/**
		 * Register Main Sidebar
		 */
		register_sidebar(
			array(
				'name'          => esc_html__( 'Main Sidebar', 'vinky' ),
				'id'            => 'main-sidebar',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

		/**
		 * Register Header Widgets area
		 */
		register_sidebar(
			array(
				'name'          => esc_html__( 'Header Widget', 'vinky' ),
				'id'            => 'header-widget',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Mega Menu Sidebar', 'vinky' ),
				'id'            => 'mega-menu',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

		/**
		 * Register Footer Widgets area
		 */
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer Widget 1', 'vinky' ),
				'id'            => 'footer-widget-1',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer Widget 2', 'vinky' ),
				'id'            => 'footer-widget-2',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer Widget 3', 'vinky' ),
				'id'            => 'footer-widget-3',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer Widget 4', 'vinky' ),
				'id'            => 'footer-widget-4',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer Bottom Widget', 'vinky' ),
				'id'            => 'footer-widget-bottom',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Events Top Bar', 'vinky' ),
				'id'            => 'events-top-bar',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

		// Add custom widgets.
		register_widget( 'Vinky_Latest_News_Widget' );
	}

	add_action( 'widgets_init', 'vinky_widgets_init' );

endif;

// phpcs:disable

require get_template_directory() . '/inc/widgets/class-vinky-latest-news-widget.php';

// phpcs:enable
