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
final class Vinky_Customize_Typography_Control extends WP_Customize_Control {

	/**
	 * Control type.
	 *
	 * @since 1.0.0
	 * @var string $type
	 */
	public $type = 'vky-typography';

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
		$input_id       = '_customize-input-' . $this->id;
		$description_id = '_customize-description-' . $this->id;
		?>

			<div class="vky-headline">
				<?php if ( ! empty( $this->label ) ) : ?>
					<label for="<?php echo esc_attr( $input_id ); ?>" class="customize-control-title"><?php echo esc_html( $this->label ); ?></label>
				<?php endif; ?>

				<?php if ( ! empty( $this->description ) ) : ?>
					<span id="<?php echo esc_attr( $description_id ); ?>" class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php endif; ?>

				<?php if ( in_array( $this->property, array( 'font-size', 'line-height' ), true ) ) : ?>
					<?php print_devices(); ?>
				<?php endif; ?>
			</div>

			<div class="vky-wrapper">
				<?php
				switch ( $this->property ) {
					case 'font-family':
						$this->render_font_family();
						break;
					case 'font-size':
						$this->render_font_size();
						break;
					case 'font-weight':
						$this->render_font_weight();
						break;
					case 'font-style':
						$this->render_font_style();
						break;
					case 'text-transform':
						$this->render_text_transform();
						break;
				}
				?>
			</div>

		<?php
	}

	/**
	 * Render font-family property.
	 *
	 * @return void
	 * @since  1.0.0
	 *
	 * @access private
	 */
	private function render_font_family() {
		$input_id         = '_customize-input-' . $this->id;
		$description_id   = '_customize-description-' . $this->id;
		$describedby_attr = ( ! empty( $this->description ) ) ? ' aria-describedby="' . esc_attr( $description_id ) . '" ' : '';
		?>

		<select
			class="vky-control-all-fonts"
			id="<?php echo esc_attr( $input_id ); ?>"
			<?php echo esc_attr( $describedby_attr ); ?>
			<?php $this->link(); ?>
		>
			<?php
			echo '<option value="inherit" ' . selected( $this->value(), 'inherit', false ) . '>' . esc_html__( 'Inherit', 'vinky' ) . '</option>';

			echo '<optgroup label="' . esc_html__( 'Other System Fonts', 'vinky' ) . '">';

			$system_fonts = Vinky_Font_Families::get_system_fonts();
			$google_fonts = Vinky_Font_Families::get_google_fonts();

			foreach ( $system_fonts as $name => $variants ) {
				echo '<option value="' . esc_attr( $name ) . '" ' . selected( $this->value(), $name, false ) . '>' . esc_html( $name ) . '</option>';
			}

			// Add Custom Font List Into Customizer.
			do_action( 'vinky_customizer_font_list', '' );

			echo '<optgroup label="Google">';

			foreach ( $google_fonts as $name => $font ) {
				$category = vinky_get_prop( $font, 'sans-serif' );

				echo '<option value="\'' . esc_attr( $name ) . '\', ' . esc_attr( $category ) . '" ' . selected( $this->value(), $name, false ) . '>' . esc_html( $name ) . '</option>';

			}
			?>
		</select>

		<?php
	}

	/**
	 * Render font-size property.
	 *
	 * @return void
	 * @since  1.0.0
	 *
	 * @access private
	 */
	private function render_font_size() {
		$input_id         = '_customize-input-' . $this->id;
		$description_id   = '_customize-description-' . $this->id;
		$describedby_attr = ( ! empty( $this->description ) ) ? ' aria-describedby="' . esc_attr( $description_id ) . '" ' : '';
		?>

		<input
			type="hidden"
			<?php $this->link(); ?>
			<?php if ( ! isset( $this->input_attrs['value'] ) ) : ?>
				value="<?php echo esc_attr( $this->value() ); ?>"
			<?php endif; ?>
			data-reset_value="<?php echo esc_attr( $this->setting->default ); ?>"
		/>

		<?php
		$values = array( '', 'px' );

		if ( $this->value() ) {
			$values = explode( ',', $this->value() );
		}
		?>

		<div class="vky-flex">
			<input
				type="number"
				id="<?php echo esc_attr( $input_id ); ?>"
				<?php echo esc_attr( $describedby_attr ); ?>
				min="1"
				step="1"
				<?php $this->input_attrs(); ?>
				<?php if ( ! isset( $this->input_attrs['value'] ) ) : ?>
					value="<?php echo esc_attr( $values[0] ); ?>"
				<?php endif; ?>
			/>

			<?php $units = array( 'px', 'em' ); ?>

			<select class="vky-control-unit">
				<?php foreach ( $units as $unit ) : ?>
					<option value="<?php echo esc_attr( $unit ); ?>" <?php selected( $unit, $values[1], true ); ?>><?php echo esc_attr( $unit ); ?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<?php
	}

	/**
	 * Render font-weight property.
	 *
	 * @return void
	 * @since  1.0.0
	 *
	 * @access private
	 */
	private function render_font_weight() {
		$input_id         = '_customize-input-' . $this->id;
		$description_id   = '_customize-description-' . $this->id;
		$describedby_attr = ( ! empty( $this->description ) ) ? ' aria-describedby="' . esc_attr( $description_id ) . '" ' : '';
		?>

		<select
			class="vky-control-font-weight"
			id="<?php echo esc_attr( $input_id ); ?>"
			<?php echo esc_attr( $describedby_attr ); ?>
			<?php $this->link(); ?>
		>
			<?php
			$available_weights = array(
				'inherit' => 'Inherit',
				'100'     => 'Thin 100',
				'200'     => 'Extra-Light 200',
				'300'     => 'Light 300',
				'400'     => 'Normal 400',
				'500'     => 'Medium 500',
				'600'     => 'Semi-Bold 600',
				'700'     => 'Bold 700',
				'800'     => 'Extra-Bold 800',
				'900'     => 'Ultra-Bold 900',
			);

			foreach ( $available_weights as $key => $weight ) {
				echo '<option value="' . esc_attr( $key ) . '" ' . selected( $key, $this->value() ) . '>' . esc_html( $weight ) . '</option>';
			}
			?>
		</select>

		<?php
	}

	/**
	 * Render font-style property.
	 *
	 * @return void
	 * @since  1.0.0
	 *
	 * @access private
	 */
	private function render_font_style() {
		$input_id         = '_customize-input-' . $this->id;
		$description_id   = '_customize-description-' . $this->id;
		$describedby_attr = ( ! empty( $this->description ) ) ? ' aria-describedby="' . esc_attr( $description_id ) . '" ' : '';
		?>

		<select
			class="vky-control-font-style"
			id="<?php echo esc_attr( $input_id ); ?>"
			<?php echo esc_attr( $describedby_attr ); ?>
			<?php $this->link(); ?>
		>
			<?php
			$available_styles = array(
				'inherit',
				'italic',
			);

			foreach ( $available_styles as $style ) {
				echo '<option value="' . esc_attr( $style ) . '" ' . selected( $style, $this->value() ) . '>' . esc_html( ucfirst( $style ) ) . '</option>';
			}
			?>
		</select>

		<?php
	}

	/**
	 * Render text-transform property.
	 *
	 * @return void
	 * @since  1.0.0
	 *
	 * @access private
	 */
	private function render_text_transform() {
		$input_id         = '_customize-input-' . $this->id;
		$description_id   = '_customize-description-' . $this->id;
		$describedby_attr = ( ! empty( $this->description ) ) ? ' aria-describedby="' . esc_attr( $description_id ) . '" ' : '';
		?>

		<select
			class="vky-control-text-transform"
			id="<?php echo esc_attr( $input_id ); ?>"
			<?php echo esc_attr( $describedby_attr ); ?>
			<?php $this->link(); ?>
		>
			<?php
			$choices = array(
				'inherit',
				'none',
				'capitalize',
				'uppercase',
				'lowercase',
			);

			foreach ( $choices as $choice ) {
				echo '<option value="' . esc_attr( $choice ) . '" ' . selected( $this->value(), $choice, false ) . '>' . esc_html( ucfirst( $choice ) ) . '</option>';
			}
			?>
		</select>

		<?php
	}

	/**
	 * Render font-variant property.
	 *
	 * @return void
	 * @since  1.0.0
	 *
	 * @access private
	 */
	private function render_all_fonts() {
		$input_id         = '_customize-input-' . $this->id;
		$description_id   = '_customize-description-' . $this->id;
		$describedby_attr = ( ! empty( $this->description ) ) ? ' aria-describedby="' . esc_attr( $description_id ) . '" ' : '';
		?>

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
			<option value=""><?php esc_html_e( 'Select a font', 'vinky' ); ?></option>
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
			<button type="button" class="button add-new-font" aria-label="Add or remove fonts" aria-expanded="true" aria-controls="available-fonts"><?php echo esc_html( 'Add Font' ); ?></button>
		</div>

		<ul class="vky-selected-fonts"></ul>

		<?php

		$localize_array = array(
			'headerBreakpoint'            => vinky_header_break_point(),
			'includeAnchorsInHeadingsCss' => Vinky_Dynamic_CSS::anchors_in_css_selectors_heading(),
			'googleFonts'                 => Vinky_Font_Families::get_google_fonts(),
		);

		wp_localize_script( 'vinky-customize-preview', 'vinkyCustomizer', $localize_array );
	}
}
