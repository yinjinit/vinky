<?php
/**
 * Color Control class
 *
 * @package    WordPress
 * @subpackage vinky
 * @since      1.0.0
 */

/**
 * Customize Color Control class.
 *
 * @since 1.0.0
 *
 * @see   WP_Customize_Control
 */
class Vinky_Customize_Color_Control extends WP_Customize_Control {
	/**
	 * The control type.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $type = 'dgw-color';

	/**
	 * Enqueue control related scripts/styles.
	 *
	 * @access public
	 *
	 * @return void
	 * @since  1.0.0
	 */
	public function enqueue() {
		parent::enqueue();

		// Enqueue the scripts and styles.
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script(
			'vinky-color-alpha',
			get_theme_file_uri( 'assets/js/wp-color-picker-alpha.js' ),
			array( 'wp-color-picker' ),
			wp_get_theme()->get( 'Version' ),
			true
		);

		wp_enqueue_style( 'wp-color-picker' );
	}

	/**
	 * Render the control's content.
	 *
	 * @access protected
	 */
	protected function render_content() {
		$input_id         = '_customize-input-' . $this->id;
		$description_id   = '_customize-description-' . $this->id;
		$describedby_attr = ( ! empty( $this->description ) ) ? ' aria-describedby="' . esc_attr( $description_id ) . '" ' : '';
		?>

		<?php if ( ! empty( $this->label ) ) : ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php endif; ?>
		<?php if ( ! empty( $this->description ) ) : ?>
			<span id="<?php echo esc_attr( $description_id ); ?>"
				class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
		<?php endif; ?>

		<input
			type="text"
			id="<?php echo esc_attr( $input_id ); ?>"
			class="dgw-color-picker-alpha"
			placeholder="<?php echo esc_html( '#RRGGBB' ); ?>"
			data-alpha="true"
			<?php echo esc_html( $describedby_attr ); ?>
			<?php $this->input_attrs(); ?>
			<?php if ( ! isset( $this->input_attrs['value'] ) ) : ?>
				value="<?php echo esc_attr( $this->value() ); ?>"
			<?php endif; ?>
			<?php $this->link(); ?>
		/>

		<?php
	}
}
