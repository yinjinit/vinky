<?php
/**
 * Footer Bottom Bar Section.
 *
 * @since     1.0.0
 * @package   Vinky
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Vinky_Footer_Bottom_Section' ) ) {

	/**
	 * Register Vinky Customizer Primary Header Customizer Options.
	 */
	class Vinky_Footer_Bottom_Section extends Vinky_Section {

		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function register( $wp_customize ) {
			$wp_customize->add_setting( 'footer_bottom_typo' );

			$wp_customize->add_control( new Vinky_Customize_Group_Control(
				$wp_customize,
				'footer_bottom_typo',
				array(
					'label'    => __( 'Typography', 'vinky' ),
					'section'  => 'footer_bottom',
					'priority' => 1,
				)
			) );

			$wp_customize->add_setting(
				'footer_bottom_font_family',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'footer_bottom_font_family',
				array(
					'label'    => __( 'Font Family', 'vinky' ),
					'property' => 'font-family',
					'section'  => 'footer_bottom',
					'priority' => 2,
				)
			) );

			$wp_customize->add_setting(
				'footer_bottom_font_size',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'footer_bottom_font_size',
				array(
					'label'    => __( 'Font Size', 'vinky' ),
					'property' => 'font-size',
					'section'  => 'footer_bottom',
					'priority' => 3,
				)
			) );

			$wp_customize->add_setting(
				'footer_bottom_font_variant',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'footer_bottom_font_variant',
				array(
					'label'    => __( 'Font Variant', 'vinky' ),
					'property' => 'font-variant',
					'section'  => 'footer_bottom',
					'priority' => 4,
				)
			) );

			$wp_customize->add_setting(
				'footer_bottom_text_transform',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'footer_bottom_text_transform',
				array(
					'label'    => __( 'Text Transform', 'vinky' ),
					'property' => 'text-transform',
					'section'  => 'footer_bottom',
					'priority' => 5,
				)
			) );

			$wp_customize->add_setting(
				'footer_bottom_line_height',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Slider_Control(
				$wp_customize,
				'footer_bottom_line_height',
				array(
					'label'       => __( 'Line Height', 'vinky' ),
					'input_attrs' => array(
						'min'  => 0.1,
						'max'  => 30,
						'step' => 0.1,
					),
					'section'     => 'footer_bottom',
					'priority'    => 6,
				)
			) );

			$wp_customize->add_setting(
				'footer_bottom_letter_spacing',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Slider_Control(
				$wp_customize,
				'footer_bottom_letter_spacing',
				array(
					'label'       => __( 'Letter Spacing', 'vinky' ),
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),
					'responsive'  => false,
					'section'     => 'footer_bottom',
					'priority'    => 7,
				)
			) );

			$wp_customize->add_setting(
				'footer_bottom_color_link',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Color_Control(
				$wp_customize,
				'footer_bottom_color_link',
				array(
					'label'    => __( 'Link Color', 'vinky' ),
					'section'  => 'footer_bottom',
					'priority' => 8,
				)
			) );

			$wp_customize->add_setting(
				'footer_bottom_color_active',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Color_Control(
				$wp_customize,
				'footer_bottom_color_active',
				array(
					'label'    => __( 'Active Link Color', 'vinky' ),
					'priority' => 9,
					'section'  => 'footer_bottom',
				)
			) );

			$wp_customize->add_setting(
				'footer_bottom_background',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Color_Control(
				$wp_customize,
				'footer_bottom_background',
				array(
					'label'    => __( 'Background Color', 'vinky' ),
					'priority' => 10,
					'section'  => 'footer_bottom',
				)
			) );

			Vinky_Customizer::update_group(
				array(
					'footer_bottom_typo' => array(
						'footer_bottom_font_family',
						'footer_bottom_font_size',
						'footer_bottom_font_variant',
						'footer_bottom_text_transform',
						'footer_bottom_line_height',
						'footer_bottom_letter_spacing',
					),
				)
			);
		}

		/**
		 * Add dynamic styles using css variables.
		 *
		 * @param string $theme_css Custom css variables.
		 *
		 * @return string Css variables string.
		 */
		public function dynamic_style( $theme_css ) {
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_bottom_background', '--footer-bottom--background' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_bottom_font_family', '--footer-bottom--font-family' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_bottom_font_size', '--footer-bottom--font-size' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_bottom_font_variant', '--footer-bottom--font-variant' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_bottom_text_transform', '--footer-bottom--text-transform' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_bottom_line_height', '--footer-bottom--line-height' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_bottom_letter_spacing', '--footer-bottom--letter-spacing' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_bottom_color_link', '--footer-bottom--color-link' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_bottom_color_active', '--footer-bottom--color-active' );
			return $theme_css;
		}
	}
}

new Vinky_Footer_Bottom_Section();
