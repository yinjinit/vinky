<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core
 * features.
 *
 * @package Vinky
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'vinky_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	function vinky_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time> <time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		printf(
		/* translators: 2: author link. 3: author name*/
			'<span class="posted-on">%1$s</span>',
			$time_string // phpcs:ignore WordPress.Security.EscapeOutput
		);
	}
}

/**
 * Vinky get post thumbnail image.
 */
if ( ! function_exists( 'vinky_get_post_thumbnail' ) ) {

	/**
	 * Vinky get post thumbnail image
	 *
	 * @param string  $before Markup before thumbnail image.
	 * @param string  $after  Markup after thumbnail image.
	 * @param boolean $echo   Output print or return.
	 *
	 * @return string|void
	 * @since 1.0.0
	 */
	function vinky_get_post_thumbnail( $before = '', $after = '', $echo = true ) {

		$output = '';

		$is_singular = is_singular();

		$featured_image = true;

		$is_featured_image = vinky_get_setting( 'vky-featured-img' );

		if ( 'disabled' === $is_featured_image ) {
			$featured_image = false;
		}

		$featured_image = apply_filters( 'vinky_featured_image_enabled', $featured_image );

		$blog_post_thumb   = vinky_get_setting( 'blog-post-structure' );
		$single_post_thumb = vinky_get_setting( 'blog_single-post-structure' );

		if ( (
				( ! $is_singular && is_array( $blog_post_thumb ) && in_array( 'image', $blog_post_thumb, true ) ) ||
				( is_single() && is_array( $single_post_thumb ) && in_array( 'single-image', $single_post_thumb, true ) ) || is_page()
			) &&
			has_post_thumbnail() ) {

			if ( $featured_image && ( ! ( $is_singular ) || ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) ) ) {

				$post_thumb = apply_filters(
					'vinky_featured_image_markup',
					get_the_post_thumbnail(
						get_the_ID(),
						apply_filters( 'vinky_post_thumbnail_default_size', 'large' ),
						apply_filters( 'vinky_post_thumbnail_itemprop', '' )
					)
				);

				if ( '' !== $post_thumb ) {
					$output .= '<div class="post-thumb-img-content post-thumb">';
					if ( ! $is_singular ) {
						$output .= apply_filters(
							'vinky_blog_post_featured_image_link_before',
							'<a href="' . get_permalink() . '">'
						);
					}
					$output .= $post_thumb;
					if ( ! $is_singular ) {
						$output .= apply_filters( 'vinky_blog_post_featured_image_link_after', '</a>' );
					}
					$output .= '</div>';
				}
			}
		}

		if ( ! $is_singular ) {
			$output = apply_filters( 'vinky_blog_post_featured_image_after', $output );
		}

		$output = apply_filters( 'vinky_get_post_thumbnail', $output, $before, $after );

		if ( $echo ) {
			echo $before . $output . $after; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} else {
			return $before . $output . $after;
		}
	}
}

if ( ! function_exists( 'vinky_pagination' ) ) {
	/**
	 * Print the pagination navigation.
	 *
	 * @param int|bool $total  Total number of entries.
	 * @param int|bool $number Number of entries per page.
	 *
	 * @return void
	 *
	 * @since 1.0.0
	 */
	function vinky_pagination( $total = false, $number = false ) {
		global $wp_rewrite, $wp_query;

		if ( ( ! $total || ! $number ) && isset( $wp_query->max_num_pages ) ) {
			$total_pages = $wp_query->max_num_pages;
		} else {

			if ( $total <= $number ) {
				return;
			}

			$total_pages = ceil( $total / $number );
		}


		isset( $wp_query->query_vars['paged'] ) && $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

		$args = array(
			'format'    => '?paged=%#%',
			'total'     => $total_pages,
			'current'   => $current,
			'type'      => 'array',
			'prev_text' => '<i class="vky-icon vky-icon-arrow-left"></i>',
			'next_text' => '<i class="vky-icon vky-icon-arrow-right"></i>',
			'end_size'  => 0,
			'mid_size'  => 0,

		);

		$links = paginate_links( $args );

		switch ( $current ) {
			case 1:
				$prev = '';
				$next = $links[ count( $links ) - 1 ];
				break;
			case $total_pages:
				$prev = $links[0];
				$next = '';
				break;
			default:
				$prev = $links[0];
				$next = $links[ count( $links ) - 1 ];
		}
		?>

		<div class="vky-pagination">
			<span class="vky-pagination-current"><?php echo $current . ' of ' . $total_pages; // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
			<?php echo $prev; // phpcs:ignore WordPress.Security.EscapeOutput ?>
			<input class="vky-pagination-input" type="number" value="<?php echo esc_html( $current ); ?>"/>
			<?php

			// Setting up default values based on the current URL.
			$pagenum_link = html_entity_decode( get_pagenum_link(), ENT_COMPAT, 'UTF-8' );
			$url_parts    = explode( '?', $pagenum_link );

			// URL base depends on permalink settings.
			$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
			$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/{REPLACE_NUMBER}', 'paged' ) : '?paged={REPLACE_NUMBER}';

			// Append the format placeholder to the base URL.
			$link = trailingslashit( $url_parts[0] ) . $format;

			if ( isset( $url_parts[1] ) ) {
				// Find the format argument.
				$format       = explode( '?', $link );
				$format_query = isset( $format[1] ) ? $format[1] : '';
				wp_parse_str( $format_query, $format_args );

				// Find the query args of the requested URL.
				wp_parse_str( $url_parts[1], $url_query_args );

				// Remove the format argument from the array of query arguments, to avoid overwriting custom format.
				foreach ( $format_args as $format_arg => $format_arg_value ) {
					unset( $url_query_args[ $format_arg ] );
				}

				$query_args = urlencode_deep( $url_query_args );

				if ( $query_args ) {
					$link = add_query_arg( $query_args, $link );
				}
			}
			?>

			<input type="hidden" class="vky-pagination-hidden" value="<?php echo esc_attr( $link ); ?>"/>
			<input type="hidden" class="vky-pagination-total" value="<?php echo esc_attr( $total_pages ); ?>"/>

			<?php echo $next; // phpcs:ignore WordPress.Security.EscapeOutput ?>

		</div>

		<?php
	}
}

if ( ! function_exists( 'vinky_pagination_button' ) ) {
	/**
	 * Print the page next/prev navigation.
	 *
	 * @param int|bool $total  Total number of entries.
	 * @param int|bool $number Number of entries per page.
	 *
	 * @return void
	 *
	 * @since 1.0.0
	 */
	function vinky_pagination_button( $total = false, $number = false ) {
		global $wp_query;

		if ( ( ! $total || ! $number ) && isset( $wp_query->max_num_pages ) ) {
			$total_pages = $wp_query->max_num_pages;
		} else {

			if ( $total <= $number ) {
				return;
			}

			$total_pages = ceil( $total / $number );
		}

		isset( $wp_query->query_vars['paged'] ) && $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

		$args = array(
			'format'    => '?paged=%#%',
			'total'     => $total_pages,
			'current'   => $current,
			'type'      => 'array',
			'prev_text' => esc_html__( 'Prev Page', 'vinky' ),
			'next_text' => esc_html__( 'Next Page', 'vinky' ),
			'end_size'  => 0,
			'mid_size'  => 0,

		);

		$links = paginate_links( $args );

		switch ( $current ) {
			case 1:
				$prev = '';
				$next = $links[ count( $links ) - 1 ];
				break;
			case $total_pages:
				$prev = $links[0];
				$next = '';
				break;
			default:
				$prev = $links[0];
				$next = $links[ count( $links ) - 1 ];
		}
		?>

		<div class="vky-page-navigator">
			<?php echo $prev; // phpcs:ignore WordPress.Security.EscapeOutput ?>
			<?php echo $next; // phpcs:ignore WordPress.Security.EscapeOutput ?>
		</div>

		<?php
	}
}

if ( ! function_exists( 'vinky_entry_meta' ) ) {
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 * Footer entry meta is displayed differently in archives and single posts.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	function vinky_entry_meta() {

		// Early exit if not a post.
		if ( 'post' !== get_post_type() ) {
			return;
		}

		// Posted on.
		vinky_posted_on();

		// Edit post link.
		edit_post_link(
			sprintf(
				wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers. */
					__( 'Edit %s', 'vinky' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				'<span class="screen-reader-text">' . get_the_title() . '</span>'
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
}
