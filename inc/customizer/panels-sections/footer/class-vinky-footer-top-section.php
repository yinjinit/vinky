<?php
/**
 * Footer Top Bar Section.
 *
 * @since     1.0.0
 * @package   Vinky
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Vinky_Footer_Top_Section' ) ) {

	/**
	 * Register Vinky Customizer Primary Header Customizer Options.
	 */
	class Vinky_Footer_Top_Section extends Vinky_Section {

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
				'footer_logo_width',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Slider_Control(
				$wp_customize,
				'footer_logo_width',
				array(
					'label'       => esc_html__( 'Logo Width', 'vinky' ),
					'section'     => 'footer_top',
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 600,
					),
					'priority'    => 2,
				)
			) );

			$wp_customize->add_setting( 'footer_top_typo' );

			$wp_customize->add_control( new Vinky_Customize_Group_Control(
				$wp_customize,
				'footer_top_typo',
				array(
					'label'    => esc_html__( 'Typography', 'vinky' ),
					'section'  => 'footer_top',
					'priority' => 3,
				)
			) );

			$wp_customize->add_setting(
				'footer_top_font_family',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'footer_top_font_family',
				array(
					'label'    => esc_html__( 'Font Family', 'vinky' ),
					'property' => 'font-family',
					'section'  => 'footer_top',
					'priority' => 2,
				)
			) );

			$wp_customize->add_setting(
				'footer_top_font_size',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'footer_top_font_size',
				array(
					'label'    => esc_html__( 'Font Size', 'vinky' ),
					'property' => 'font-size',
					'section'  => 'footer_top',
					'priority' => 3,
				)
			) );

			$wp_customize->add_setting(
				'footer_top_font_variant',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'footer_top_font_variant',
				array(
					'label'    => esc_html__( 'Font Variant', 'vinky' ),
					'property' => 'font-variant',
					'section'  => 'footer_top',
					'priority' => 4,
				)
			) );

			$wp_customize->add_setting(
				'footer_top_text_transform',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'footer_top_text_transform',
				array(
					'label'    => esc_html__( 'Text Transform', 'vinky' ),
					'property' => 'text-transform',
					'section'  => 'footer_top',
					'priority' => 5,
				)
			) );

			$wp_customize->add_setting(
				'footer_top_line_height',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Slider_Control(
				$wp_customize,
				'footer_top_line_height',
				array(
					'label'       => esc_html__( 'Line Height', 'vinky' ),
					'input_attrs' => array(
						'min'  => 0.1,
						'max'  => 30,
						'step' => 0.1,
					),
					'section'     => 'footer_top',
					'priority'    => 6,
				)
			) );

			$wp_customize->add_setting(
				'footer_top_letter_spacing',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Slider_Control(
				$wp_customize,
				'footer_top_letter_spacing',
				array(
					'label'       => esc_html__( 'Letter Spacing', 'vinky' ),
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),
					'responsive'  => false,
					'section'     => 'footer_top',
					'priority'    => 7,
				)
			) );

			$wp_customize->add_setting(
				'footer_top_color_link',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Color_Control(
				$wp_customize,
				'footer_top_color_link',
				array(
					'label'    => esc_html__( 'Link Color', 'vinky' ),
					'section'  => 'footer_top',
					'priority' => 8,
				)
			) );

			$wp_customize->add_setting(
				'footer_top_color_active',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Color_Control(
				$wp_customize,
				'footer_top_color_active',
				array(
					'label'    => esc_html__( 'Active Link Color', 'vinky' ),
					'priority' => 9,
					'section'  => 'footer_top',
				)
			) );

			$wp_customize->add_setting(
				'footer_top_background',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Color_Control(
				$wp_customize,
				'footer_top_background',
				array(
					'label'    => esc_html__( 'Background Color', 'vinky' ),
					'priority' => 10,
					'section'  => 'footer_top',
				)
			) );

			Vinky_Customizer::update_group(
				array(
					'footer_top_typo' => array(
						'footer_top_font_family',
						'footer_top_font_size',
						'footer_top_font_variant',
						'footer_top_text_transform',
						'footer_top_line_height',
						'footer_top_letter_spacing',
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
			if ( vinky_get_setting( 'footer_logo' ) ) {
				$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_logo_width', '--footer-logo--width', 'px', true );
			}

			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_top_background', '--footer-top--background' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_top_font_family', '--footer-top--font-family' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_top_font_size', '--footer-top--font-size' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_top_font_variant', '--footer-top--font-variant' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_top_text_transform', '--footer-top--text-transform' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_top_line_height', '--footer-top--line-height' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_top_letter_spacing', '--footer-top--letter-spacing' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_top_color_link', '--footer-top--color-link' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_top_color_active', '--footer-top--color-active' );

			return $theme_css;
		}
	}
}

new Vinky_Footer_Top_Section();
