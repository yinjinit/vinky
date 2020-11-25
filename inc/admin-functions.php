<?php
/**
 * Functions which enhance the admin backend by hooking into WordPress
 *
 * @since           1.0.0
 * @subpackage      Vinky
 * @package         WordPress
 */

/**
 * Resource admin columns
 *
 * @param array $columns Array columns.
 *
 * @return array
 */
function vinky_resource_columns( $columns ) {
	$column_meta = array(
		'file_url' => __( 'File Url', 'vinky' ),
	);
	$columns     = array_slice( $columns, 0, 2, true ) + $column_meta + array_slice( $columns, 2, null, true );

	unset( $columns['url'] );

	return $columns;
}

add_filter( 'manage_lana_download_posts_columns', 'vinky_resource_columns', 99 );

/**
 * Resources admin columns
 *
 * @param string $column  Admin column.
 * @param int    $post_id Post id.
 */
function vinky_resource_admin_columns( $column, $post_id ) {

	if ( 'file_url' === $column ) {
		echo '<input type="text" class="resource-url widefat" value="' . esc_attr( get_post_meta( $post_id, 'lana_download_file_url', true ) ) . '" readonly>';
	}
}

add_action( 'manage_lana_download_posts_custom_column', 'vinky_resource_admin_columns', 10, 2 );
