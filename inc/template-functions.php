<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @since           1.0.0
 * @subpackage      Vinky
 * @package         WordPress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'vinky_page_layout' ) ) {

	/**
	 * Site Sidebar
	 *
	 * Default 'right sidebar' for overall site.
	 */
	function vinky_page_layout() {

		if ( is_singular() ) {

			// If post meta value is empty,
			// Then get the POST_TYPE sidebar.
			$layout = vinky_get_setting( 'site-sidebar-layout', '', true );

			if ( empty( $layout ) ) {

				$post_type = get_post_type();

				if ( 'post' === $post_type || 'page' === $post_type || 'product' === $post_type ) {
					$layout = vinky_get_setting( 'single-' . get_post_type() . '-sidebar-layout' );
				}

				if ( 'default' === $layout || empty( $layout ) ) {

					// Get the global sidebar value.
					// NOTE: Here not used `true` in the below function call.
					$layout = vinky_get_setting( 'site-sidebar-layout' );
				}
			}
		} else {

			if ( is_search() ) {

				// Check only post type archive option value.
				$layout = vinky_get_setting( 'archive-post-sidebar-layout' );

				if ( 'default' === $layout || empty( $layout ) ) {

					// Get the global sidebar value.
					// NOTE: Here not used `true` in the below function call.
					$layout = vinky_get_setting( 'site-sidebar-layout' );
				}
			} else {

				$post_type = get_post_type();
				$layout    = '';

				if ( 'post' === $post_type ) {
					$layout = vinky_get_setting( 'archive-' . get_post_type() . '-sidebar-layout' );
				}

				if ( 'default' === $layout || empty( $layout ) ) {

					// Get the global sidebar value.
					// NOTE: Here not used `true` in the below function call.
					$layout = vinky_get_setting( 'site-sidebar-layout' );
				}
			}
		}

		return apply_filters( 'vinky_page_layout', $layout );
	}
}

/**
 * Add a pingback url auto-discovery header for singularly identifiable
 * articles.
 */
function vinky_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}

add_action( 'wp_head', 'vinky_pingback_header' );

/**
 * Adds custom classes to the array of body classes.
 */
if ( ! function_exists( 'vinky_body_class' ) ) {

	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 *
	 * @return array
	 * @since 1.0.0
	 */
	function vinky_body_class( $classes ) {

		if ( vinky_is_amp_endpoint() ) {
			$classes[] = 'vky-amp';
		}

		// Current Vinky version.
		$classes[] = esc_attr( 'vinky-' . wp_get_theme()->get( 'Version' ) );

		return $classes;
	}
}

add_filter( 'body_class', 'vinky_body_class' );

/**
 * Displays the class names for the header element.
 *
 * @since 1.0.0
 */
function vinky_header_class() {
	// Separates class names with a single space, collates class names for body element.
	echo 'class="' . esc_attr( join( ' ', vinky_get_header_class() ) ) . '"';
}

/**
 * Retrieves an array of the class names for the body element.
 *
 * @return string[] Array of class names.
 * @since 1.0.0
 */
function vinky_get_header_class() {
	$classes                  = array( 'site-header' );
	$inline_logo_and_blogname = vinky_get_setting( 'inline_logo_and_blogname' );

	// Add class if Inline Logo & Site Title.
	if ( $inline_logo_and_blogname ) {
		$classes[] = 'vky-inline-brandings';
	}

	$menu_item    = vinky_get_setting( 'primary_nav_last_item' );
	$outside_menu = vinky_get_setting( 'take_last_item_outside' );

	if ( 'none' !== $menu_item && $outside_menu ) {
		$classes[] = 'last-item-outside';
	} else {
		$classes[] = 'last-item-inside';
	}

	/**
	 * Add class for header width
	 */
	$header_layout        = vinky_get_setting( 'header_layout' );
	$mobile_header_layout = vinky_get_setting( 'mobile_header_layout' );
	$sub_menu_animation   = vinky_get_setting( 'header_submenu_animation' );

	$classes[] = 'header-' . $header_layout;
	$classes[] = 'mobile-header-' . $mobile_header_layout;
	$classes[] = 'submenu-with-border';

	if ( ! empty( $sub_menu_animation ) ) {
		$classes[] = 'sub-menu-animation-' . esc_attr( $sub_menu_animation );
	}

	$classes = array_unique( $classes );

	$classes = array_map( 'sanitize_html_class', $classes );

	return apply_filters( 'vinky_get_header_classes', $classes );
}

/**
 * Vinky entry header class.
 */
if ( ! function_exists( 'vinky_entry_header_class' ) ) {

	/**
	 * Vinky entry header class
	 *
	 * @since 1.0.0
	 */
	function vinky_entry_header_class() {

		$post_id                    = vinky_get_post_id();
		$classes                    = array();
		$title_markup               = get_the_title( $post_id );
		$thumb_markup               = vinky_get_post_thumbnail( '', '', false );
		$post_meta_markup           = get_post_meta( '' );
		$blog_single_post_structure = vinky_get_setting( 'blog_single-post-structure' );

		if ( ! $blog_single_post_structure || ( 'single-image' === $blog_single_post_structure[0] && empty( $thumb_markup ) && 'single-title-meta' !== $blog_single_post_structure[1] ) ) {
			$classes[] = 'vky-header-without-markup';
		} elseif ( empty( $title_markup ) && empty( $thumb_markup ) && ( is_page() || empty( $post_meta_markup ) ) ) {
			$classes[] = 'vky-header-without-markup';
		} else {

			if ( empty( $title_markup ) ) {
				$classes[] = 'vky-no-title';
			}

			if ( empty( $thumb_markup ) ) {
				$classes[] = 'vky-no-thumbnail';
			}

			if ( is_page() || empty( $post_meta_markup ) ) {
				$classes[] = 'vky-no-meta';
			}
		}

		$classes = array_unique( apply_filters( 'vinky_entry_header_class', $classes ) );
		$classes = array_map( 'sanitize_html_class', $classes );

		echo esc_attr( join( ' ', $classes ) );
	}
}

/**
 * Vinky Pagination
 */
if ( ! function_exists( 'vinky_number_pagination' ) ) {

	/**
	 * Vinky Pagination
	 *
	 * @return void            Generate & echo pagination markup.
	 * @since 1.0.0
	 */
	function vinky_number_pagination() {
		global $numpages;
		$enabled = apply_filters( 'vinky_pagination_enabled', true );

		if ( isset( $numpages ) && $enabled ) {
			ob_start();
			echo "<div class='vky-pagination'>";
			the_posts_pagination(
				array(
					'prev_text'    => '<span class="vky-left-arrow">&larr;</span> ' . __( 'Previous Page', 'vinky' ),
					'next_text'    => __( 'Next Page', 'vinky' ) . ' <span class="vky-right-arrow">&rarr;</span>',
					'taxonomy'     => 'category',
					'in_same_term' => true,
				)
			);
			echo '</div>';
			$output = ob_get_clean();
			echo apply_filters( 'vinky_pagination_markup', $output ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
}

add_action( 'vinky_pagination', 'vinky_number_pagination' );

/**
 * Creates continue reading text
 */
function vinky_continue_reading_text() {
	$continue_reading = sprintf(
	/* translators: %s: Name of current post. */
		wp_kses( esc_html__( 'Continue reading %s', 'vinky' ), array( 'span' => array( 'class' => array() ) ) ),
		the_title( '<span class="screen-reader-text">', '</span>', false )
	);

	return $continue_reading;
}

/**
 * Print Responsive Devices Html.
 *
 * @return void
 */
function print_devices() {
	?>
	<div class="devices-wrapper">
		<div class="devices">
			<button type="button" class="preview-desktop active"
				data-device="desktop">
				<i class="dashicons dashicons-desktop"></i>
			</button>
			<button type="button" class="preview-tablet" data-device="tablet">
				<i class="dashicons dashicons-tablet"></i>
			</button>
			<button type="button" class="preview-mobile" data-device="mobile">
				<i class="dashicons dashicons-smartphone"></i>
			</button>
		</div>
	</div>
	<?php
}

