<?php
/**
 * Customizer Group Control
 *
 * @package Vinky
 * @since   1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Vinky_Customize_Group_Control' ) && class_exists( 'WP_Customize_Control' ) ) :

	/**
	 * A Settings group control.
	 */
	class Vinky_Customize_Group_Control extends WP_Customize_Control {


		/**
		 * The control type.
		 *
		 * @access public
		 * @var string
		 */
		public $type = 'vky-group';

		/**
		 * Render the control's content.
		 *
		 * @see WP_Customize_Control::render_content()
		 */
		protected function render_content() {
			?>

				<div class="vky-headline">
					<?php if ( ! empty( $this->label ) ) { ?>
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<?php } ?>
					<span class="vky-toggle-indicator"></span>
				</div>
				<div class="vky-fields-wrapper">
					<ul class="vky-fields"></ul>
				</div>

			<?php
		}
	}

endif;
