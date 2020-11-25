<?php
/**
 * Vinky Customizer Section Base.
 *
 * @package     Vinky
 * @author      Vinky
 * @since       1.0.0
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Customizer Sanitizes
 *
 * @since 1.0.0
 */
if ( ! class_exists( 'Vinky_Section' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class Vinky_Section {

		/**
		 * Constructor
		 */
		public function __construct() {
			if ( is_admin() || is_customize_preview() ) {
				add_action( 'customize_register', array( $this, 'register' ) );
			}

			add_filter( 'vinky_dynamic_style_variables', array( $this, 'dynamic_style' ) );
		}

		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function register( $wp_customize ) {}

		/**
		 * Add dynamic styles using css variables.
		 *
		 * @param string $theme_css Custom css variables.
		 *
		 * @return string Css variables string.
		 */
		public function dynamic_style( $theme_css ) {
			return $theme_css;
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new Vinky_Section();
