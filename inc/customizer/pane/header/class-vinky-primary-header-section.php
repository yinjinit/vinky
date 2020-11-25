<?php
/**
 * Primary Header Section.
 *
 * @package   Vinky
 * @since     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Vinky_Primary_Header_Section' ) ) {

	/**
	 * Register Vinky Customizer Primary Header Customizer Options.
	 */
	class Vinky_Primary_Header_Section {

		/**
		 * Constructor. Instantiate the customizer.
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function __construct() {
			if ( is_admin() || is_customize_preview() ) {
				add_action( 'customize_register', array( $this, 'register_controls' ) );
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
		public function register_controls( $wp_customize ) {
			$wp_customize->add_setting(
				'header_full_width',
				array(
					'capability'        => 'edit_theme_options',
					'sanitize_callback' => array( 'Vinky_Customizer', 'sanitize_checkbox' ),
				)
			);

			$wp_customize->add_control( new WP_Customize_Control(
				$wp_customize,
				'header_full_width',
				array(
					'label'    => esc_html__( 'Make Full width', 'vinky' ),
					'type'     => 'checkbox',
					'section'  => 'primary_header',
					'priority' => 1,
				)
			) );

			$wp_customize->add_setting(
				'header_mobile_breakpoint',
				array(
					'type'      => 'theme_mod',
					'transport' => 'postMessage',
					'default'   => Vinky_Customizer::get_default_option( 'header_mobile_breakpoint' ),
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Slider_Control(
				$wp_customize,
				'header_mobile_breakpoint',
				array(
					'label'       => esc_html__( 'Mobile Breakpoint', 'vinky' ),
					'section'     => 'primary_header',
					'priority'    => 2,
					'responsive'  => false,
					'input_attrs' => array(
						'min'  => 600,
						'max'  => 1920,
						'step' => 1,
					),
				)
			) );
		}
	}
}

new Vinky_Primary_Header_Section();
