<?php
/**
 * Base colors.
 *
 * @package   Vinky
 * @since     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Vinky_Colors_Section' ) ) {

	/**
	 * Register Vinky Customizer Primary Header Customizer Options.
	 */
	class Vinky_Colors_Section {

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
				'text_color',
				array(
					'type'      => 'theme_mod',
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Color_Control(
				$wp_customize,
				'text_color',
				array(
					'label'    => esc_html__( 'Text Color', 'vinky' ),
					'section'  => 'colors',
					'priority' => 1,
				)
			) );

			$wp_customize->add_setting(
				'heading_color',
				array(
					'type'      => 'theme_mod',
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Color_Control(
				$wp_customize,
				'heading_color',
				array(
					'label'    => esc_html__( 'Heading Color', 'vinky' ),
					'section'  => 'colors',
					'priority' => 1,
				)
			) );

			$wp_customize->add_setting(
				'link_color',
				array(
					'type'      => 'theme_mod',
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Color_Control(
				$wp_customize,
				'link_color',
				array(
					'label'    => esc_html__( 'Link Color', 'vinky' ),
					'section'  => 'colors',
					'priority' => 1,
				)
			) );

			$wp_customize->add_setting(
				'link_hover_color',
				array(
					'type'      => 'theme_mod',
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Color_Control(
				$wp_customize,
				'link_hover_color',
				array(
					'label'    => esc_html__( 'Link Color', 'vinky' ),
					'section'  => 'colors',
					'priority' => 1,
				)
			) );
		}
	}
}

new Vinky_Colors_Section();
