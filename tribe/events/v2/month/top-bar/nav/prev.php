<?php
/**
 * View: Top Bar Navigation Previous Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/month/top-bar/nav/prev.php
 *
 * See more documentation about our views templating system.
 *
 * @link    http://m.tri.be/1aiy
 *
 * @var string $prev_url            The URL to the previous page, if any, or an
 *      empty string.
 * @var string $formatted_grid_date The current calendar grid date in
 * @version 1.0.0
 * @package Vinky
 *
 */
$timestamp = strtotime( $formatted_grid_date );
$timestamp = strtotime( '-1 month', $timestamp );
$month     = date( 'F', $timestamp );

?>
<li class="tribe-events-c-top-bar__nav-list-item">
	<a
		href="<?php echo esc_url( $prev_url ); ?>"
		class="tribe-common-c-btn-icon tribe-common-c-btn-icon--caret-left tribe-events-c-top-bar__nav-link tribe-events-c-top-bar__nav-link--prev"
		aria-label="<?php esc_attr_e( 'Previous month', 'vinky' ); ?>"
		title="<?php esc_attr_e( 'Previous month', 'vinky' ); ?>"
		data-js="tribe-events-view-link"
	>
		<i class="vky-icon vky-icon-tri-left"></i>
		<span><?php echo esc_html( $month ); ?></span>
	</a>
</li>
