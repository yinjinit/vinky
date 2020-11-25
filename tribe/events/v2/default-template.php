<?php
/**
 * View: Default Template for Events
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/default-template.php
 *
 * See more documentation about our views templating system.
 *
 * @link    http://m.tri.be/1aiy
 *
 * @version 5.0.0
 */

use Tribe\Events\Views\V2\Template_Bootstrap;

get_header();

$bg_img = vinky_get_setting( 'event_background_image' );

if ( ! empty( $bg_img ) ) {
	?>

	<style>
		.page-header {
			background-image: url(<?php echo esc_url( $bg_img ); ?>);
		}
	</style>

	<?php
}
?>

	<div class="page-header">
		<div class="container">
			<h1 class="page-title"><?php esc_html_e( 'Events', 'vinky' ); ?></h1>
		</div>
	</div>

	<div class="events-top-bar">
		<div class="container">
			<?php
			if ( is_active_sidebar( 'events-top-bar' ) ) {
				dynamic_sidebar( 'events-top-bar' );
			}
			?>
		</div>
	</div>

	<div class="events-view-wrapper">
		<div class="container">
			<?php
			echo tribe( Template_Bootstrap::class )->get_view_html(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			?>
		</div>
	</div>

<?php
get_footer();
