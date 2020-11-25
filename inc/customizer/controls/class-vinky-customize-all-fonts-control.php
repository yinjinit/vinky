<?php
/**
 * Customizer Control: typography.
 *
 * @package     Vinky
 * @author      Vinky
 * @copyright   Copyright (c) 2020, Vinky
 * @link        https://www.vinkythemes.com/
 * @since       1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Typography control.
 */
final class Vinky_Customize_All_Fonts_Control extends WP_Customize_Control {

	/**
	 * Control type.
	 *
	 * @since 1.0.0
	 * @var string $type
	 */
	public $type = 'vky-all-fonts';

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

		<div class="vky-headline">

			<?php if ( ! empty( $this->label ) ) : ?>
				<label for="<?php echo esc_attr( $input_id ); ?>"
					class="customize-control-title"><?php echo esc_html( $this->label ); ?></label>
			<?php endif; ?>

			<?php if ( ! empty( $this->description ) ) : ?>
				<span id="<?php echo esc_attr( $description_id ); ?>"
					class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<?php endif; ?>

		</div>

		<div class="vky-wrapper">
			<input
				type="hidden"
				<?php $this->link(); ?>
				value="<?php echo esc_attr( $this->value() ); ?>"
			/>

			<select
				id="<?php echo esc_attr( $input_id ); ?>"
				class="vky-control-all-fonts"
				<?php echo esc_attr( $describedby_attr ); ?>
			>
				<option
					value=""><?php esc_html_e( 'Select a font', 'vinky' ); ?></option>
				<?php
				$custom_fonts = Vinky_Font_Families::get_custom_fonts();
				$system_fonts = Vinky_Font_Families::get_system_fonts();
				$google_fonts = Vinky_Font_Families::get_google_fonts();

				// Add Custom Fonts.
				if ( ! empty( $custom_fonts ) ) {
					echo '<optgroup label="' . esc_html__( 'Custom Fonts', 'vinky' ) . '">';

					foreach ( $custom_fonts as $name => $variants ) {
						echo '<option value="' . esc_attr( $name ) . '">' . esc_html( $name ) . '</option>';
					}

					echo '</optgroup>';
				}

				echo '<optgroup label="' . esc_html__( 'Other System Fonts', 'vinky' ) . '">';

				// Add System Fonts.
				foreach ( $system_fonts as $name => $variants ) {
					echo '<option value="' . esc_attr( $name ) . '">' . esc_html( $name ) . '</option>';
				}

				echo '</optgroup>';

				// Add Google Fonts.
				echo '<optgroup label="' . esc_html__( 'Google', 'vinky' ) . '">';

				foreach ( $google_fonts as $name => $font ) {
					$category = vinky_get_prop( $font, 'category', 'sans-serif' );

					echo '<option value="\'' . esc_attr( $name ) . '\', ' . esc_attr( $category ) . '">' . esc_html( $name ) . '</option>';
				}

				echo '</optgroup>';
				?>
			</select>

			<div class="vky-font-buttons">
				<button type="button" class="button add-new-font"
					aria-label="Add or remove fonts" aria-expanded="true"
					aria-controls="available-fonts"><?php echo esc_html( 'Add Font' ); ?></button>
			</div>

			<ul class="vky-selected-fonts"></ul>

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
