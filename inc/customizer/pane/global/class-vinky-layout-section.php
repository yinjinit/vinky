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

if ( ! class_exists( 'Vinky_Layout_Section' ) ) {

	/**
	 * Register Vinky Customizer Primary Header Customizer Options.
	 */
	class Vinky_Layout_Section {

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
				'content_width',
				array(
					'type'      => 'theme_mod',
					'transport' => 'postMessage',
					'default'   => Vinky_Customizer::get_default_option( 'content_width' ),
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Slider_Control(
				$wp_customize,
				'content_width',
				array(
					'label'       => esc_html__( 'Content Width', 'vinky' ),
					'section'     => 'general_layout',
					'priority'    => 1,
					'responsive'  => false,
					'input_attrs' => array(
						'min'  => 960,
						'max'  => 1920,
						'step' => 1,
					),
				)
			) );

			$wp_customize->add_setting(
				'sidebar_width',
				array(
					'type'      => 'theme_mod',
					'transport' => 'postMessage',
					'default'   => Vinky_Customizer::get_default_option( 'sidebar_width' ),
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Slider_Control(
				$wp_customize,
				'sidebar_width',
				array(
					'label'       => esc_html__( 'Sidebar Width', 'vinky' ),
					'section'     => 'general_layout',
					'priority'    => 2,
					'input_attrs' => array(
						'min'  => 15,
						'max'  => 33,
						'step' => 1,
					),
				)
			) );
		}
	}
}

new Vinky_Layout_Section();
