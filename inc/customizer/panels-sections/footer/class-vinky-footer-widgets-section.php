<?php
/**
 * Footer Widgets Section.
 *
 * @since     1.0.0
 * @package   Vinky
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Vinky_Footer_Widgets_Section' ) ) {

	/**
	 * Register Vinky Customizer Primary Header Customizer Options.
	 */
	class Vinky_Footer_Widgets_Section extends Vinky_Section {

		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function register( $wp_customize ) {
			$wp_customize->add_setting( 'footer_widget_body_typo' );

			$wp_customize->add_control( new Vinky_Customize_Group_Control(
				$wp_customize,
				'footer_widget_body_typo',
				array(
					'label'    => __( 'Body Typography', 'vinky' ),
					'section'  => 'footer_widgets',
					'priority' => 1,
				)
			) );

			$wp_customize->add_setting(
				'footer_widget_body_font_family',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'footer_widget_body_font_family',
				array(
					'label'    => __( 'Font Family', 'vinky' ),
					'property' => 'font-family',
					'section'  => 'footer_widgets',
					'priority' => 2,
				)
			) );

			$wp_customize->add_setting(
				'footer_widget_body_font_size',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'footer_widget_body_font_size',
				array(
					'label'    => __( 'Font Size', 'vinky' ),
					'property' => 'font-size',
					'section'  => 'footer_widgets',
					'priority' => 3,
				)
			) );

			$wp_customize->add_setting(
				'footer_widget_body_font_variant',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'footer_widget_body_font_variant',
				array(
					'label'    => __( 'Font Variant', 'vinky' ),
					'property' => 'font-variant',
					'section'  => 'footer_widgets',
					'priority' => 4,
				)
			) );

			$wp_customize->add_setting(
				'footer_widget_body_text_transform',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'footer_widget_body_text_transform',
				array(
					'label'    => __( 'Text Transform', 'vinky' ),
					'property' => 'text-transform',
					'section'  => 'footer_widgets',
					'priority' => 5,
				)
			) );

			$wp_customize->add_setting(
				'footer_widget_body_line_height',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Slider_Control(
				$wp_customize,
				'footer_widget_body_line_height',
				array(
					'label'       => __( 'Line Height', 'vinky' ),
					'input_attrs' => array(
						'min'  => 0.1,
						'max'  => 30,
						'step' => 0.1,
					),
					'section'     => 'footer_widgets',
					'priority'    => 6,
				)
			) );

			$wp_customize->add_setting(
				'footer_widget_body_letter_spacing',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Slider_Control(
				$wp_customize,
				'footer_widget_body_letter_spacing',
				array(
					'label'       => __( 'Letter Spacing', 'vinky' ),
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),
					'responsive'  => false,
					'section'     => 'footer_widgets',
					'priority'    => 7,
				)
			) );

			$wp_customize->add_setting(
				'footer_widget_body_color_text',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Color_Control(
				$wp_customize,
				'footer_widget_body_color_text',
				array(
					'label'    => __( 'Body Text Color', 'vinky' ),
					'section'  => 'footer_widgets',
					'priority' => 8,
				)
			) );

			$wp_customize->add_setting(
				'footer_widget_body_color_active',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Color_Control(
				$wp_customize,
				'footer_widget_body_color_active',
				array(
					'label'    => __( 'Body Active Link Color', 'vinky' ),
					'priority' => 9,
					'section'  => 'footer_widgets',
				)
			) );

			$wp_customize->add_setting( 'footer_widget_header_typo' );

			$wp_customize->add_control( new Vinky_Customize_Group_Control(
				$wp_customize,
				'footer_widget_header_typo',
				array(
					'label'    => __( 'Header Typography', 'vinky' ),
					'section'  => 'footer_widgets',
					'priority' => 10,
				)
			) );

			$wp_customize->add_setting(
				'footer_widget_header_font_family',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'footer_widget_header_font_family',
				array(
					'label'    => __( 'Font Family', 'vinky' ),
					'property' => 'font-family',
					'section'  => 'footer_widgets',
					'priority' => 11,
				)
			) );

			$wp_customize->add_setting(
				'footer_widget_header_font_size',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'footer_widget_header_font_size',
				array(
					'label'    => __( 'Font Size', 'vinky' ),
					'property' => 'font-size',
					'section'  => 'footer_widgets',
					'priority' => 12,
				)
			) );

			$wp_customize->add_setting(
				'footer_widget_header_font_variant',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'footer_widget_header_font_variant',
				array(
					'label'    => __( 'Font Variant', 'vinky' ),
					'property' => 'font-variant',
					'section'  => 'footer_widgets',
					'priority' => 13,
				)
			) );

			$wp_customize->add_setting(
				'footer_widget_header_text_transform',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'footer_widget_header_text_transform',
				array(
					'label'    => __( 'Text Transform', 'vinky' ),
					'property' => 'text-transform',
					'section'  => 'footer_widgets',
					'priority' => 14,
				)
			) );

			$wp_customize->add_setting(
				'footer_widget_header_line_height',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Slider_Control(
				$wp_customize,
				'footer_widget_header_line_height',
				array(
					'label'       => __( 'Line Height', 'vinky' ),
					'input_attrs' => array(
						'min'  => 0.1,
						'max'  => 30,
						'step' => 0.1,
					),
					'section'     => 'footer_widgets',
					'priority'    => 15,
				)
			) );

			$wp_customize->add_setting(
				'footer_widget_header_letter_spacing',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Slider_Control(
				$wp_customize,
				'footer_widget_header_letter_spacing',
				array(
					'label'       => __( 'Letter Spacing', 'vinky' ),
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),
					'responsive'  => false,
					'section'     => 'footer_widgets',
					'priority'    => 16,
				)
			) );

			$wp_customize->add_setting(
				'footer_widget_header_color_text',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Color_Control(
				$wp_customize,
				'footer_widget_header_color_text',
				array(
					'label'    => __( 'Header Text Color', 'vinky' ),
					'section'  => 'footer_widgets',
					'priority' => 17,
				)
			) );

			$wp_customize->add_setting(
				'footer_widget_header_color_active',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Color_Control(
				$wp_customize,
				'footer_widget_header_color_active',
				array(
					'label'    => __( 'Header Active Link Color', 'vinky' ),
					'priority' => 18,
					'section'  => 'footer_widgets',
				)
			) );

			$wp_customize->add_setting(
				'footer_widget_background',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Color_Control(
				$wp_customize,
				'footer_widget_background',
				array(
					'label'    => __( 'Background', 'vinky' ),
					'priority' => 18,
					'section'  => 'footer_widgets',
				)
			) );

			Vinky_Customizer::update_group(
				array(
					'footer_widget_body_typo'   => array(
						'footer_widget_body_font_family',
						'footer_widget_body_font_size',
						'footer_widget_body_font_variant',
						'footer_widget_body_text_transform',
						'footer_widget_body_line_height',
						'footer_widget_body_letter_spacing',
					),
					'footer_widget_header_typo' => array(
						'footer_widget_header_font_family',
						'footer_widget_header_font_size',
						'footer_widget_header_font_variant',
						'footer_widget_header_text_transform',
						'footer_widget_header_line_height',
						'footer_widget_header_letter_spacing',
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
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_widget_background', '--footer-widget--background' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_widget_body_font_family', '--footer-widget-body--font-family' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_widget_body_font_size', '--footer-widget-body--font-size' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_widget_body_font_variant', '--footer-widget-body--font-variant' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_widget_body_text_transform', '--footer-widget-body--text-transform' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_widget_body_line_height', '--footer-widget-body--line-height' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_widget_body_letter_spacing', '--footer-widget-body--letter-spacing' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_widget_body_color_text', '--footer-widget-body--color-text' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_widget_body_color_active', '--footer-widget-body--color-active' );

			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_widget_header_background', '--footer-widget-header--background' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_widget_header_font_family', '--footer-widget-header--font-family' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_widget_header_font_size', '--footer-widget-header--font-size' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_widget_header_font_variant', '--footer-widget-header--font-variant' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_widget_header_text_transform', '--footer-widget-header--text-transform' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_widget_header_line_height', '--footer-widget-header--line-height' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_widget_header_letter_spacing', '--footer-widget-header--letter-spacing' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_widget_header_color_text', '--footer-widget-header--color-text' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_widget_header_color_active', '--footer-widget-header--color-active' );

			return $theme_css;
		}
	}
}

new Vinky_Footer_Widgets_Section();
