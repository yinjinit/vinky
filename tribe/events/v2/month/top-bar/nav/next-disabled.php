<?php
/**
 * View: Top Bar Navigation Next Disabled Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/month/top-bar/nav/next-disabled.php
 *
 * See more documentation about our views templating system.
 *
 * @link    http://m.tri.be/1aiy
 *
 * @var string $formatted_grid_date The current calendar grid date in
 * @version 1.0.0
 * @package Vinky
 */

$timestamp = strtotime( $formatted_grid_date );
$timestamp = strtotime( '+1 month', $timestamp );
$month     = date( 'F', $timestamp );
?>
<li class="tribe-events-c-top-bar__nav-list-item">
	<button
		class="tribe-common-c-btn-icon tribe-common-c-btn-icon--caret-right tribe-events-c-top-bar__nav-link tribe-events-c-top-bar__nav-link--next"
		aria-label="<?php esc_attr_e( 'Next month', 'vinky' ); ?>"
		title="<?php esc_attr_e( 'Next month', 'vinky' ); ?>"
		disabled
	>
		<span><?php echo esc_html( $month ); ?></span>
		<i class="vky-icon vky-icon-tri-right"></i>
	</button>
</li>
