<?php
/**
 * Customizer Control: typography.
 *
 * @package     Vinky
 * @author      Vinky
 * @copyright   Copyright (c) 2020, Vinky
 * @link        https://www.vinky.com/
 * @since       1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Typography control.
 */
final class Vinky_Customize_Google_Fonts_Control extends WP_Customize_Control {

	/**
	 * Control type.
	 *
	 * @since 1.0.0
	 * @var string $type
	 */
	public $type = 'dgw-google-fonts';

	/**
	 * Font type representing css font property. (example: 'font-family').
	 *
	 * @since 1.0.0
	 * @var string $property
	 */
	public $property = '';

	/**
	 * Renders the content for a control based on the type
	 * of control specified when this class is initialized.
	 *
	 * @return void
	 * @since  1.0.0
	 * @access protected
	 */
	protected function render_content() {
		$input_id         = '_customize-input-' . $this->id;
		$description_id   = '_customize-description-' . $this->id;
		$describedby_attr = ( ! empty( $this->description ) ) ? ' aria-describedby="' . esc_attr( $description_id ) . '" ' : '';
		?>

		<div class="dgw-headline">

			<?php if ( ! empty( $this->label ) ) : ?>
				<label for="<?php echo esc_attr( $input_id ); ?>"
					class="customize-control-title"><?php echo esc_html( $this->label ); ?></label>
			<?php endif; ?>

			<?php if ( ! empty( $this->description ) ) : ?>
				<span id="<?php echo esc_attr( $description_id ); ?>"
					class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<?php endif; ?>

		</div>

		<div class="dgw-wrapper">
			<input
				type="hidden"
				<?php $this->link(); ?>
				value="<?php echo esc_attr( $this->value() ); ?>"
			/>

			<select
				id="<?php echo esc_attr( $input_id ); ?>"
				class="dgw-control-google-fonts"
				<?php echo esc_attr( $describedby_attr ); ?>
			>
				<option
					value=""><?php esc_html_e( 'Select a font', 'vinky' ); ?></option>
				<?php
				$fonts = Vinky_Font_Families::get_google_fonts();

				// Add Google Fonts.
				foreach ( $fonts as $name => $font ) {
					$category = ! empty( $font['category'] ) ? $font['category'] : 'sans-serif';

					echo '<option value="\'' . esc_attr( $name ) . '\', ' . esc_attr( $category ) . '">' . esc_html( $name ) . '</option>';
				}
				?>
			</select>

			<div class="dgw-font-buttons">
				<button type="button" class="button add-new-font"
					aria-label="Add or remove fonts" aria-expanded="true"
					aria-controls="available-fonts"><?php echo esc_html( 'Add Font' ); ?></button>
			</div>

			<ul class="dgw-selected-fonts"></ul>

			<?php

			$localize_array = array(
				'googleFonts' => Vinky_Font_Families::get_google_fonts(),
			);

			wp_localize_script( 'vinky-customize-preview', 'vinkyCustomizer', $localize_array );
			?>

		</div>

		<?php
	}

}
