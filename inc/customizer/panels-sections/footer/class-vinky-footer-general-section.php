<?php
/**
 * Footer Layout Section.
 *
 * @since     1.0.0
 * @package   Vinky
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Vinky_Footer_General_Section' ) ) {

	/**
	 * Register Vinky Customizer Primary Header Customizer Options.
	 */
	class Vinky_Footer_General_Section extends Vinky_Section {

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
				'footer_full_width',
				array(
					'capability' => 'edit_theme_options',
				)
			);

			$wp_customize->add_control( new WP_Customize_Control(
				$wp_customize,
				'footer_full_width',
				array(
					'label'    => esc_html__( 'Make Full Width', 'vinky' ),
					'section'  => 'footer_layout',
					'type'     => 'checkbox',
					'priority' => 1,
				)
			) );
		}
	}
}

new Vinky_Footer_General_Section();
