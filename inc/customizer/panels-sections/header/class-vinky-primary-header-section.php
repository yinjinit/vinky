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
	class Vinky_Primary_Header_Section extends Vinky_Section {

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
				'header_mobile_breakpoint',
				array(
'transport' => 'postMessage',
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
