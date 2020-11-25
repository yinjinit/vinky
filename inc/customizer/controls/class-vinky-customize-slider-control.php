<?php
/**
 * Customizer Control: slider.
 *
 * Creates a jQuery slider control.
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
 * Responsive Slider control (range).
 */
class Vinky_Customize_Slider_Control extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'vky-slider';

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $suffix = '';

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $responsive = true;

	/**
	 * Render the control's content.
	 *
	 * @access protected
	 */
	protected function render_content() {
		$input_id         = '_customize-input-' . $this->id;
		$description_id   = '_customize-description-' . $this->id;
		$describedby_attr = ( ! empty( $this->description ) ) ? ' aria-describedby="' . esc_attr( $description_id ) . '" ' : '';
		$values           = explode( ',', $this->value() );
		$value_desktop    = $values[0];
		?>
		<div class="vky-headline">
			<?php if ( ! empty( $this->label ) ) : ?>
				<label class="customize-control-title" for="<?php echo esc_attr( $input_id ); ?>"><?php echo esc_html( $this->label ); ?></label>
			<?php endif; ?>
			<?php if ( ! empty( $this->description ) ) : ?>
				<span id="<?php echo esc_attr( $description_id ); ?>" class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<?php endif; ?>

			<?php if ( $this->responsive ) : ?>
				<?php print_devices(); ?>
			<?php endif; ?>
		</div>
		<div class="vky-flex">
			<input
				type="hidden"
				<?php $this->link(); ?>
				<?php if ( ! isset( $this->input_attrs['value'] ) ) : ?>
					value="<?php echo esc_attr( $value_desktop ); ?>"
				<?php endif; ?>
				data-reset_value="<?php echo esc_attr( $this->setting->default ); ?>"
			/>
			<input
				type="range"
				<?php $this->input_attrs(); ?>
				<?php if ( ! isset( $this->input_attrs['value'] ) ) : ?>
					value="<?php echo esc_attr( $value_desktop ); ?>"
				<?php endif; ?>
			/>
			<input
				type="number"
				id="<?php echo esc_attr( $input_id ); ?>"
				<?php echo esc_attr( $describedby_attr ); ?>
				<?php $this->input_attrs(); ?>
				<?php if ( ! isset( $this->input_attrs['value'] ) ) : ?>
					value="<?php echo esc_attr( $value_desktop ); ?>"
				<?php endif; ?>
			/>

			<?php if ( ! empty( $this->suffix ) ) : ?>
				<span class="vky-unit-suffix"><?php echo esc_html( $this->suffix ); ?></span>
			<?php endif; ?>

			<div class="vky-reset-slider">
				<span class="dashicons dashicons-image-rotate"></span>
			</div>
		</div>
		<?php
	}
}
