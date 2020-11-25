<?php
/**
 * View: Top Bar - Navigation
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/month/top-bar/nav.php
 *
 * See more documentation about our views templating system.
 *
 * @link    http://m.tri.be/1aiy
 *
 * @var string $prev_url The URL to the previous page, if any, or an empty
 *      string.
 * @var string $next_url The URL to the next page, if any, or an empty string.
 * @package Vinky
 * @version 1.0.0
 */
?>
<nav class="tribe-events-c-top-bar__nav tribe-common-a11y-hidden">
	<ul class="tribe-events-c-top-bar__nav-list">
		<?php
		if ( ! empty( $prev_url ) ) {
			$this->template( 'month/top-bar/nav/prev' );
		} else {
			$this->template( 'month/top-bar/nav/prev-disabled' );
		}
		?>

		<?php $this->template( 'components/top-bar/today' ); ?>

		<?php
		if ( ! empty( $next_url ) ) {
			$this->template( 'month/top-bar/nav/next' );
		} else {
			$this->template( 'month/top-bar/nav/next-disabled' );
		}
		?>
	</ul>
</nav>
