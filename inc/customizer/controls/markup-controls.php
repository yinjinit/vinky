<?php
/**
 * Vinky Theme Customizer Controls Markup.
 *
 * @package Vinky
 * @since   1.0.0
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Print Responsive Devices Html.
 *
 * @return void
 */
function print_devices() {
	?>
	<div class="devices-wrapper">
		<div class="devices">
			<button type="button" class="preview-desktop active"
				data-device="desktop">
				<i class="dashicons dashicons-desktop"></i>
			</button>
			<button type="button" class="preview-tablet" data-device="tablet">
				<i class="dashicons dashicons-tablet"></i>
			</button>
			<button type="button" class="preview-mobile" data-device="mobile">
				<i class="dashicons dashicons-smartphone"></i>
			</button>
		</div>
	</div>
	<?php
}
