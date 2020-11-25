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
final class Vinky_Customize_Typography_Control extends WP_Customize_Control {

	/**
	 * Control type.
	 *
	 * @since 1.0.0
	 * @var string $type
	 */
	public $type = 'dgw-typography';

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

		<div class="dgw-headline">
			<?php if ( ! empty( $this->label ) ) : ?>
				<label for="<?php echo esc_attr( $input_id ); ?>" class="customize-control-title"><?php echo esc_html( $this->label ); ?></label>
			<?php endif; ?>

			<?php if ( ! empty( $this->description ) ) : ?>
				<span id="<?php echo esc_attr( $description_id ); ?>" class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<?php endif; ?>

			<?php
			if ( in_array( $this->property,
				array(
					'font-size',
					'line-height',
				),
				true ) ) :
				?>
				<?php print_devices(); ?>
			<?php endif; ?>
		</div>

		<div class="dgw-wrapper">
			<?php
			switch ( $this->property ) {
				case 'font-family':
					$this->render_font_family();
					break;
				case 'font-size':
					$this->render_font_size();
					break;
				case 'font-variant':
					$this->render_font_variant();
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
			class="dgw-control-font-family"
			id="<?php echo esc_attr( $input_id ); ?>"
			<?php echo esc_attr( $describedby_attr ); ?>
			<?php $this->link(); ?>
		>
			<?php
			echo '<option value="inherit" ' . selected( $this->value(), 'inherit', false ) . '>' . esc_html__( 'Inherit', 'vinky' ) . '</option>';

			echo '<optgroup label="' . esc_html__( 'Other System Fonts', 'vinky' ) . '">';

			$system_fonts = Vinky_Font_Families::get_system_fonts();

			foreach ( $system_fonts as $name => $variants ) {
				echo '<option value="' . esc_attr( $name ) . '" ' . selected( $this->value(), $name, false ) . '>' . esc_html( $name ) . '</option>';
			}

			// Add Custom Font List Into Customizer.
			do_action( 'vinky_customizer_font_list', '' );

			$selected_fonts = vinky_get_setting( 'google_fonts' );
			$selected_fonts = json_decode( $selected_fonts );

			if ( ! empty( $selected_fonts ) ) {
				$google_fonts = Vinky_Font_Families::get_google_fonts();

				echo '<optgroup label="Google">';

				foreach ( $selected_fonts as $name => $variants ) {
					$font = $google_fonts[ $name ];
					echo '<option value="\'' . esc_attr( $name ) . '\', ' . esc_attr( $font['category'] ) . '" data-variants="' . esc_attr( wp_json_encode( $variants ) ) . '" ' . selected( $this->value(), $name, false ) . '>' . esc_html( $name ) . '</option>';
				}

				echo '</optgroup>';
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

		<div class="dgw-flex">
			<input
				type="number"
				id="<?php echo esc_attr( $input_id ); ?>"
				<?php echo esc_attr( $describedby_attr ); ?>
				min="1"
				step="1"
				<?php $this->link(); ?>
				<?php $this->input_attrs(); ?>
				<?php if ( ! isset( $this->input_attrs['value'] ) ) : ?>
					value="<?php echo esc_attr( $this->value() ); ?>"
				<?php endif; ?>
				data-reset_value="<?php echo esc_attr( $this->setting->default ); ?>"
			/>

			<span class="dgw-control-unit">px</span>
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
	private function render_font_variant() {
		$input_id         = '_customize-input-' . $this->id;
		$description_id   = '_customize-description-' . $this->id;
		$describedby_attr = ( ! empty( $this->description ) ) ? ' aria-describedby="' . esc_attr( $description_id ) . '" ' : '';
		?>

		<select
			class="dgw-control-font-variant"
			id="<?php echo esc_attr( $input_id ); ?>"
			<?php echo esc_attr( $describedby_attr ); ?>
			<?php $this->link(); ?>
			data-value="<?php echo esc_attr( $this->value() ); ?>"
		>
			<option value="inherit" <?php selected( 'inherit', $this->value() ); ?>><?php esc_html_e( 'Inherit', 'vinky' ); ?></option>
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
			class="dgw-control-font-style"
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
			class="dgw-control-text-transform"
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
}
