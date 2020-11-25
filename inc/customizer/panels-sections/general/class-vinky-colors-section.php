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
	class Vinky_Colors_Section extends Vinky_Section {

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
				'hover_color',
				array(
'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Color_Control(
				$wp_customize,
				'hover_color',
				array(
					'label'    => esc_html__( 'Hover Color', 'vinky' ),
					'section'  => 'colors',
					'priority' => 1,
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
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'text_color', '--global--color-primary' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'heading_color', '--entry-header--color' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'link_color', '--global--color-link' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'hover_color', '--global--color-link-hover' );

			return $theme_css;
		}
	}
}

new Vinky_Colors_Section();
