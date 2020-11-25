<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Vinky
 * @since 1.0.0
 */

get_header();
?>

	<header class="page-header">
		<div class="container">
			<h1 class="page-title"><?php esc_html_e( 'Nothing here', 'vinky' ); ?></h1>
		</div>
	</header><!-- .page-header -->

	<div class="error-404 not-found">
		<div class="container">
			<div class="page-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'vinky' ); ?></p>
			</div><!-- .page-content -->
		</div>
	</div><!-- .error-404 -->

<?php
get_footer();
