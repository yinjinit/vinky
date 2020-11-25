<?php
/**
 * All available fonts.
 *
 * @package   Vinky
 * @since     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Vinky_All_Fonts_Section' ) ) {

	/**
	 * Register Vinky Customizer Primary Header Customizer Options.
	 */
	class Vinky_All_Fonts_Section {

		/**
		 * Constructor.
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function __construct() {
			if ( is_admin() || is_customize_preview() ) {
				add_action( 'customize_register', array( $this, 'register' ) );
			}
		}

		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function register( $wp_customize ) {

			$wp_customize->add_setting(
				'all_fonts',
				array(
					'type'      => 'theme_mod',
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_All_Fonts_Control(
				$wp_customize,
				'all_fonts',
				array(
					'label'       => esc_html__( 'Fonts', 'vinky' ),
					'description' => esc_html__( 'Only selected Font Variants will be loaded from Google Fonts.', 'vinky' ),
					'section'     => 'fonts',
					'priority'    => 2,
				)
			) );
		}
	}
}

new Vinky_All_Fonts_Section();
