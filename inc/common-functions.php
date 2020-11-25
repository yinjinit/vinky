<?php
/**
 * Common functions for Vinky Theme.
 *
 * @package     Vinky
 * @author      Vinky
 * @copyright   Copyright (c) 2020, vinky
 * @link        https://www.vinky.com/
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Check if we're being delivered AMP
 *
 * @return bool
 */
function vinky_is_amp_endpoint() {
	return function_exists( 'is_amp_endpoint' ) && is_amp_endpoint();
}

/**
 * Return Theme options.
 */
if ( ! function_exists( 'vinky_get_setting' ) ) {

	/**
	 * Return Theme options.
	 *
	 * @param string       $id      Customize setting id.
	 * @param string|false $default Option default value.
	 * @param int|false    $post_id Post id in case for the id is meta data of that post.
	 *
	 * @return Mixed                  Return option value.
	 */
	function vinky_get_setting( $id, $default = false, $post_id = false ) {
		if ( ! $default ) {
			$default = Vinky_Customizer::get_default_setting( $id );
		}

		$value = get_theme_mod( $id, $default );

		return apply_filters( "vinky_get_setting_{$id}", $value, $default );
	}
}

/**
 * Return current content layout
 */
if ( ! function_exists( 'vinky_get_content_layout' ) ) {

	/**
	 * Return current content layout
	 *
	 * @return boolean  content layout.
	 * @since 1.0.0
	 */
	function vinky_get_content_layout() {

		if ( is_singular() ) {

			// If post meta value is empty,
			// Then get the POST_TYPE content layout.
			$content_layout = vinky_get_setting( 'site-content-layout', '' );

			if ( empty( $content_layout ) ) {

				$post_type = get_post_type();

				if ( 'post' === $post_type || 'page' === $post_type ) {
					$content_layout = vinky_get_setting( 'single-' . get_post_type() . '-content-layout' );
				}

				if ( 'default' === $content_layout || empty( $content_layout ) ) {

					// Get the GLOBAL content layout value.
					// NOTE: Here not used `true` in the below function call.
					$content_layout = vinky_get_setting( 'site-content-layout', 'full-width' );
				}
			}
		} else {

			$content_layout = '';
			$post_type      = get_post_type();

			if ( 'post' === $post_type ) {
				$content_layout = vinky_get_setting( 'archive-' . get_post_type() . '-content-layout' );
			}

			if ( is_search() ) {
				$content_layout = vinky_get_setting( 'archive-post-content-layout' );
			}

			if ( 'default' === $content_layout || empty( $content_layout ) ) {

				// Get the GLOBAL content layout value.
				// NOTE: Here not used `true` in the below function call.
				$content_layout = vinky_get_setting( 'site-content-layout', 'full-width' );
			}
		}

		return apply_filters( 'vinky_get_content_layout', $content_layout );
	}
}

/**
 * Helper function to get the current post id.
 */
if ( ! function_exists( 'vinky_get_post_id' ) ) {

	/**
	 * Get post ID.
	 *
	 * @return integer Post ID.
	 */
	function vinky_get_post_id() {

		global $post;

		$post_id = 0;

		if ( is_home() ) {
			$post_id = get_option( 'page_for_posts' );
		} elseif ( is_archive() ) {
			global $wp_query;
			$post_id = $wp_query->get_queried_object_id();
		} elseif ( isset( $post->ID ) && ! is_search() && ! is_category() ) {
			$post_id = $post->ID;
		}

		return $post_id;
	}
}

/**
 * Display classes for secondary div
 */
if ( ! function_exists( 'vinky_secondary_class' ) ) {

	/**
	 * Retrieve the classes for the secondary element as an array.
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 * @return void        echo classes.
	 */
	function vinky_secondary_class( $class = '' ) {

		// Separates classes with a single space, collates classes for body element.
		echo 'class="' . esc_attr( join( ' ', vinky_get_secondary_class( $class ) ) ) . '"';
	}
}

/**
 * Retrieve the classes for the secondary element as an array.
 */
if ( ! function_exists( 'vinky_get_secondary_class' ) ) {

	/**
	 * Retrieve the classes for the secondary element as an array.
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 * @return array        Return array of classes.
	 */
	function vinky_get_secondary_class( $class = '' ) {

		// array of class names.
		$classes = array();

		// default class from widget area.
		$classes[] = 'widget-area';

		// secondary base class.
		$classes[] = 'secondary';

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {

			// Ensure that we always coerce class to being an array.
			$class = array();
		}

		// Filter secondary div class names.
		$classes = apply_filters( 'vinky_secondary_class', $classes, $class );

		$classes = array_map( 'sanitize_html_class', $classes );

		return array_unique( $classes );
	}
}
