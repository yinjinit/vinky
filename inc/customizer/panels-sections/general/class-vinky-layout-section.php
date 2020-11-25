<?php
/**
 * Customizer Site Layout Settings.
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
	class Vinky_Layout_Section extends Vinky_Section {

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
'transport' => 'postMessage',
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
						'min'  => 768,
						'max'  => 1920,
						'step' => 1,
					),
				)
			) );

			$wp_customize->add_setting(
				'sidebar_width',
				array(
'transport' => 'postMessage',
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

		/**
		 * Add dynamic styles using css variables.
		 *
		 * @param string $theme_css Custom css variables.
		 *
		 * @return string Css variables string.
		 */
		public function dynamic_style( $theme_css ) {
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'content_width', '--content-width', 'px' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'sidebar_width', '--sidebar--width', '%' );

			return $theme_css;
		}
	}
}

new Vinky_Layout_Section();
