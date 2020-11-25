<?php
/**
 * The template for displaying search results pages
 *
 * @link       https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package    WordPress
 * @subpackage Twenty_Twenty_One
 * @since      1.0.0
 */

get_header();

$bg_img = vinky_get_setting( 'search_background_image' );

if ( '' !== $bg_img ) {
	?>
	<style>
		.page-header {
			background-image: url('<?php echo esc_url( $bg_img ); ?>');
		}
	</style>
	<?php
}
?>

	<header class="page-header">
		<div class="container">
			<h1 class="page-title">
				<?php
				printf(
				/* translators: %s: search term. */
					esc_html__( 'Results for "%s"', 'vinky' ),
					'<span class="page-description search-term">' . esc_html( get_search_query() ) . '</span>'
				);
				?>
			</h1>
		</div>
	</header><!-- .page-header -->

<?php
if ( have_posts() ) {
	?>

	<div class="search-result">
		<div class="container">
			<?php
			// Start the Loop.
			while ( have_posts() ) {
				the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content/content-excerpt', get_post_format() );
			} // End the loop.
			?>

			<div class="flex justify-content-center">
				<?php vinky_pagination_button(); ?>
			</div>
		</div>
	</div>

	<footer class="page-footer">
		<div class="container flex justify-content-end">
			<?php
			// Previous/next page navigation.
			vinky_pagination();
			?>
		</div>
	</footer>

	<?php
} else {
	// If no content, include the "No posts found" template.
	get_template_part( 'template-parts/content/content-none' );
}

get_footer();
