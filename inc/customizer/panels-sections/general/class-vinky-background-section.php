<?php
/**
 * Base Background colors.
 *
 * @package   Vinky
 * @since     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Vinky_Background_Section' ) ) {

	/**
	 * Register Vinky Customizer Primary Header Customizer Options.
	 */
	class Vinky_Background_Section extends  Vinky_Section {

		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function register( $wp_customize ) {
			$wp_customize->get_control( 'background_color' )->priority = 1;
			$wp_customize->get_control( 'background_color' )->section  = 'background_image';
		}
	}
}

new Vinky_Background_Section();
