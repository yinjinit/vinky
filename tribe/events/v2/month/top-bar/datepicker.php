<?php
/**
 * View: Top Bar - Date Picker
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/month/top-bar/datepicker.php
 *
 * See more documentation about our views templating system.
 *
 * @link    http://m.tri.be/1aiy
 *
 * @version 5.0.1
 *
 * @var string    $now                        The current date and time in the
 *      `Y-m-d H:i:s` format.
 * @var string    $grid_date                  The current calendar grid date in
 *      the `Y-m-d` format.
 * @var string    $formatted_grid_date        The current calendar grid date in
 *      the format specified by the "Month and year format" option.
 * @var string    $formatted_grid_date_mobile The current calendar grid date in
 *      the format specified by the "Compact Date Format" option.
 * @var object    $date_formats               Object containing the date
 *      formats.
 * @var \DateTime $the_date                   The Month current date object.
 * @package Vinky
 */

use Tribe__Date_Utils as Dates;

$default_date        = $now;
$selected_date_value = $this->get( array( 'bar', 'date' ), $default_date );
$datepicker_date     = Dates::build_date_object( $selected_date_value )->format( $date_formats->compact );
?>
<div class="tribe-events-c-top-bar__datepicker">
	<button
		class="tribe-common-h3 tribe-common-h--alt tribe-events-c-top-bar__datepicker-button"
		data-js="tribe-events-top-bar-datepicker-button"
		type="button"
		aria-label="<?php esc_attr_e( 'Click to toggle datepicker', 'vinky' ); ?>"
		title="<?php esc_attr_e( 'Click to toggle datepicker', 'vinky' ); ?>"
	>
		<time
			datetime="<?php echo esc_attr( $the_date->format( 'Y-m' ) ); ?>"
			class="tribe-events-c-top-bar__datepicker-time"
		>
			<span class="tribe-events-c-top-bar__datepicker-mobile">
				<?php
				$timestamp = strtotime( $formatted_grid_date );
				$yr        = date( 'Y', $timestamp );
				$month     = date( 'F', $timestamp );

				echo $month . ' ' . esc_html__( ' Events', 'vinky' ) . ' ' . $yr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>
			</span>
			<span class="tribe-events-c-top-bar__datepicker-desktop tribe-common-a11y-hidden">
				<?php
				$timestamp = strtotime( $formatted_grid_date );
				$yr        = date( 'Y', $timestamp );
				$month     = date( 'F', $timestamp );

				echo $month . ' ' . esc_html__( ' Events', 'vinky' ) . ' ' . $yr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>
			</span>
		</time>
	</button>
	<label
		class="tribe-events-c-top-bar__datepicker-label tribe-common-a11y-visual-hide"
		for="tribe-events-top-bar-date"
	>
		<?php esc_html_e( 'Select date.', 'vinky' ); ?>
	</label>
	<input
		type="text"
		class="tribe-events-c-top-bar__datepicker-input tribe-common-a11y-visual-hide"
		data-js="tribe-events-top-bar-date"
		id="tribe-events-top-bar-date"
		name="tribe-events-views[tribe-bar-date]"
		value="<?php echo esc_attr( $datepicker_date ); ?>"
		tabindex="-1"
		autocomplete="off"
		readonly="readonly"
	/>
	<div class="tribe-events-c-top-bar__datepicker-container" data-js="tribe-events-top-bar-datepicker-container"></div>
</div>
