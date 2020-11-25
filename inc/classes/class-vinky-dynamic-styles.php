<?php
/**
 * Dynamic CSS styles.
 *
 * @package    WordPress
 * @subpackage Vinky
 * @since      1.0.0
 */

/**
 * This class is in charge of css customization via the Customizer.
 */
class Vinky_Dynamic_Styles {

	/**
	 * Instantiate the object.
	 *
	 * @access public
	 *
	 * @since  1.0.0
	 */
	public function __construct() {

		// Enqueue color variables for customizer & frontend.
		add_action(
			'wp_enqueue_scripts',
			array(
				$this,
				'dynamic_style_variables',
			) 
		);

		// Enqueue color variables for editor.
		add_action(
			'enqueue_block_editor_assets',
			array(
				$this,
				'editor_custom_color_variables',
			)
		);

		// Add body-class if needed.
		add_filter( 'body_class', array( $this, 'body_class' ) );
	}

	/**
	 * Determine the luminance of the given color and then return #fff or #000 so
	 * that our text is always readable.
	 *
	 * @access public
	 *
	 * @param string $background_color The background color.
	 *
	 * @return string (hex color)
	 * @since  1.0.0
	 */
	public function custom_get_readable_color( $background_color ) {
		return ( 127 < $this->get_relative_luminance_from_hex( $background_color ) ) ? '#000' : '#fff';
	}

	/**
	 * Get value from customizer setting id and set it to css variable.
	 *
	 * @param string  $id           Customizer setting id.
	 * @param string  $css_variable Css variable.
	 * @param string  $suffix       Css value suffix.
	 * @param boolean $responsive   Is responsive.
	 *
	 * @return string Css Variable/value set string.
	 */
	public static function generate_custom_css_variable( $id, $css_variable, $suffix = '', $responsive = false ) {
		$theme_css = '';
		$setting   = vinky_get_setting( $id );

		if ( Vinky_Customizer::get_default_setting( $id ) !== $setting && ! empty( $setting ) ) {
			if ( $responsive ) {
				if ( ! is_array( $setting ) ) {
					$setting = array( $setting );
				}

				$device_suffixes = array( '', '-tablet', '-mobile' );

				foreach ( $setting as $index => $value ) {
					if ( ! ! $value ) {
						$theme_css .= $css_variable . $device_suffixes[ $index ] . ': ' . $value . $suffix . ';';
					}
				}
			} elseif ( strpos( $id, '_font_variant' ) !== false ) {
				$variant = explode( ',', $setting );

				$font_styles  = array( 'normal', 'italic' );
				$css_variable = str_replace( '-font-variant', '-font-style', $css_variable );
				$theme_css   .= $css_variable . ': ' . $font_styles[ intval( $variant[0] ) ] . $suffix . ';';

				$css_variable = str_replace( '-font-style', '-font-weight', $css_variable );
				$theme_css   .= $css_variable . ': ' . $variant[1] . $suffix . ';';
			} elseif ( strpos( $id, '_font_size' ) !== false ) {
				$theme_css .= $css_variable . ': ' . $setting . 'px' . $suffix . ';';
			} else {
				$theme_css .= $css_variable . ': ' . $setting . $suffix . ';';
			}
		}

		return $theme_css;
	}

	/**
	 * Generate custom style variables.
	 *
	 * Adjust the color value of the CSS variables depending on the background
	 * color theme mod. Both text and link colors needs to be updated. The code
	 * below needs to be updated, because the colors are no longer theme mods.
	 *
	 * @access public
	 *
	 * @param string|null $context Can be "editor" or null.
	 *
	 * @return string
	 * @since  1.0.0
	 */
	public function generate_dynamic_style_variables( $context = null ) {

		$theme_css  = 'editor' === $context ? ':root .editor-styles-wrapper{' : ':root{';
		$theme_css  = apply_filters( 'vinky_dynamic_style_variables', $theme_css );
		$theme_css .= '}';

		return $theme_css;
	}

	/**
	 * Customizer & frontend custom color variables.
	 *
	 * @access public
	 *
	 * @return void
	 * @since  1.0.0
	 */
	public function dynamic_style_variables() {
		wp_add_inline_style( 'vinky-style', $this->generate_dynamic_style_variables() );
	}

	/**
	 * Editor custom color variables.
	 *
	 * @access public
	 *
	 * @return void
	 * @since  1.0.0
	 */
	public function editor_custom_color_variables() {
		wp_enqueue_style(
			'vinky-custom-color-overrides',
			get_theme_file_uri( 'assets/css/custom-color-overrides.css' ),
			array(),
			(string) filemtime( get_theme_file_path( 'assets/css/custom-color-overrides.css' ) )
		);
		if ( 'd1e4dd' !== strtolower( vinky_get_setting( 'background_color', 'D1E4DD' ) ) ) {
			wp_add_inline_style( 'vinky-custom-color-overrides', $this->generate_dynamic_style_variables( 'editor' ) );
		}
	}

	/**
	 * Get luminance from a HEX color.
	 *
	 * @access public
	 *
	 * @param string $hex The HEX color.
	 *
	 * @return int Returns a number (0-255).
	 * @since  1.0.0
	 */
	public function get_relative_luminance_from_hex( $hex ) {

		// Remove the "#" symbol from the beginning of the color.
		$hex = ltrim( $hex, '#' );

		// Make sure we have 6 digits for the below calculations.
		if ( 3 === strlen( $hex ) ) {
			$hex = substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) . substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) . substr( $hex, 2, 1 ) . substr( $hex, 2, 1 );
		}

		// Get red, green, blue.
		$red   = hexdec( substr( $hex, 0, 2 ) );
		$green = hexdec( substr( $hex, 2, 2 ) );
		$blue  = hexdec( substr( $hex, 4, 2 ) );

		// Calculate the luminance.
		$lum = ( 0.2126 * $red ) + ( 0.7152 * $green ) + ( 0.0722 * $blue );

		return (int) round( $lum );
	}

	/**
	 * Adds a class to <body> if the background-color is dark.
	 *
	 * @access public
	 *
	 * @param array $classes The existing body classes.
	 *
	 * @return array
	 * @since  1.0.0
	 */
	public function body_class( $classes ) {
		$background_color = vinky_get_setting( 'background_color' );

		if ( 127 > $this->get_relative_luminance_from_hex( $background_color ) ) {
			$classes[] = 'is-background-dark';
		}

		return $classes;
	}
}

new Vinky_Dynamic_Styles();
