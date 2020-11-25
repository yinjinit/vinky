<?php
/**
 * Primary Navigation Section.
 *
 * @package   Vinky
 * @since     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Vinky_Secondary_Nav_Section' ) ) {

	/**
	 * Register Vinky Customizer Primary Header Customizer Options.
	 */
	class Vinky_Secondary_Nav_Section extends Vinky_Section {

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
				'disable_secondary_nav',
				array(
					'capability'        => 'edit_theme_options',
					'sanitize_callback' => array( 'Vinky_Customizer', 'sanitize_checkbox' ),
				)
			);

			$wp_customize->add_control( new WP_Customize_Control(
				$wp_customize,
				'disable_secondary_nav',
				array(
					'label'    => esc_html__( 'Disable Secondary Menu', 'vinky' ),
					'type'     => 'checkbox',
					'section'  => 'secondary_nav',
					'priority' => 1,
				)
			) );

			$wp_customize->add_setting(
				'secondary_nav_full_width',
				array(
					'capability'        => 'edit_theme_options',
					'sanitize_callback' => array( 'Vinky_Customizer', 'sanitize_checkbox' ),
				)
			);

			$wp_customize->add_control( new WP_Customize_Control(
				$wp_customize,
				'secondary_nav_full_width',
				array(
					'label'    => esc_html__( 'Make Full width', 'vinky' ),
					'type'     => 'checkbox',
					'section'  => 'secondary_nav',
					'priority' => 2,
				)
			) );

			$wp_customize->add_setting(
				'secondary_nav_show_search',
				array(
					'capability'        => 'edit_theme_options',
					'sanitize_callback' => array( 'Vinky_Customizer', 'sanitize_checkbox' ),
				)
			);

			$wp_customize->add_control( new WP_Customize_Control(
				$wp_customize,
				'secondary_nav_show_search',
				array(
					'label'    => esc_html__( 'Show Search', 'vinky' ),
					'type'     => 'checkbox',
					'section'  => 'secondary_nav',
					'priority' => 3,
				)
			) );

			$wp_customize->add_setting(
				'secondary_nav_show_login',
				array(
					'capability'        => 'edit_theme_options',
					'sanitize_callback' => array( 'Vinky_Customizer', 'sanitize_checkbox' ),
				)
			);

			$wp_customize->add_control( new WP_Customize_Control(
				$wp_customize,
				'secondary_nav_show_login',
				array(
					'label'    => esc_html__( 'Show Login/Logout', 'vinky' ),
					'type'     => 'checkbox',
					'section'  => 'secondary_nav',
					'priority' => 4,
				)
			) );

			$wp_customize->add_setting(
				'secondary_nav_show_divider',
				array(
					'capability'        => 'edit_theme_options',
					'sanitize_callback' => array( 'Vinky_Customizer', 'sanitize_checkbox' ),
				)
			);

			$wp_customize->add_control( new WP_Customize_Control(
				$wp_customize,
				'secondary_nav_show_divider',
				array(
					'label'    => esc_html__( 'Show Separator', 'vinky' ),
					'type'     => 'checkbox',
					'section'  => 'secondary_nav',
					'priority' => 5,
				)
			) );

			$wp_customize->add_setting(
				'secondary_nav_height',
				array(
'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Slider_Control(
				$wp_customize,
				'secondary_nav_height',
				array(
					'label'       => esc_html__( 'Header Height', 'vinky' ),
					'section'     => 'secondary_nav',
					'responsive'  => false,
					'input_attrs' => array(
						'min'  => 30,
						'max'  => 300,
						'step' => 1,
					),
					'priority'    => 6,
				)
			) );

			$wp_customize->add_setting(
				'secondary_nav_background',
				array(
'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Color_Control(
				$wp_customize,
				'secondary_nav_background',
				array(
					'label'    => __( 'Background Color', 'vinky' ),
					'section'  => 'secondary_nav',
					'priority' => 7,
				)
			) );

			$wp_customize->add_setting( 'heading_secondary_nav' );

			$wp_customize->add_control( new Vinky_Customize_Heading_Control(
				$wp_customize,
				'heading_secondary_nav',
				array(
					'label'    => esc_html__( 'Top Bar', 'vinky' ),
					'section'  => 'secondary_nav',
					'priority' => 8,
				)
			) );

			$wp_customize->add_setting(
				'secondary_nav_font_family',
				array(
'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'secondary_nav_font_family',
				array(
					'label'    => __( 'Font Family', 'vinky' ),
					'property' => 'font-family',
					'section'  => 'secondary_nav',
					'priority' => 9,
				)
			) );

			$wp_customize->add_setting(
				'secondary_nav_font_size',
				array(
'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'secondary_nav_font_size',
				array(
					'label'      => __( 'Font Size', 'vinky' ),
					'property'   => 'font-size',
					'section'    => 'secondary_nav',
					'responsive' => 'false',
					'priority'   => 10,
				)
			) );

			$wp_customize->add_setting(
				'secondary_nav_font_variant',
				array(
'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'secondary_nav_font_variant',
				array(
					'label'    => __( 'Font Variant', 'vinky' ),
					'property' => 'font-variant',
					'section'  => 'secondary_nav',
					'priority' => 11,
				)
			) );

			$wp_customize->add_setting(
				'secondary_nav_text_transform',
				array(
'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'secondary_nav_text_transform',
				array(
					'label'    => __( 'Text Transform', 'vinky' ),
					'property' => 'text-transform',
					'section'  => 'secondary_nav',
					'priority' => 12,
				)
			) );

			$wp_customize->add_setting(
				'secondary_nav_line_height',
				array(
'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Slider_Control(
				$wp_customize,
				'secondary_nav_line_height',
				array(
					'label'       => __( 'Line Height', 'vinky' ),
					'input_attrs' => array(
						'min'  => 0.1,
						'max'  => 30,
						'step' => 0.1,
					),
					'section'     => 'secondary_nav',
					'priority'    => 13,
				)
			) );

			$wp_customize->add_setting(
				'secondary_nav_letter_spacing',
				array(
'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Slider_Control(
				$wp_customize,
				'secondary_nav_letter_spacing',
				array(
					'label'       => __( 'Letter Spacing', 'vinky' ),
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),
					'responsive'  => false,
					'section'     => 'secondary_nav',
					'priority'    => 14,
				)
			) );

			$wp_customize->add_setting(
				'secondary_nav_color_link',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Color_Control(
				$wp_customize,
				'secondary_nav_color_link',
				array(
					'label'    => __( 'Link Color', 'vinky' ),
					'section'  => 'secondary_nav',
					'priority' => 15,
				)
			) );

			$wp_customize->add_setting(
				'secondary_nav_color_active',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Color_Control(
				$wp_customize,
				'secondary_nav_color_active',
				array(
					'label'    => __( 'Active Link Color', 'vinky' ),
					'priority' => 16,
					'section'  => 'secondary_nav',
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
			if ( vinky_get_setting( 'disable_secondary_nav' ) ) {
				$theme_css .= '--secondary-nav--height: 0;';
				return $theme_css;
			}

			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'secondary_nav_height', '--secondary-nav--height', 'px' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'secondary_nav_background', '--secondary-nav--background' );

			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'secondary_nav_font_family', '--secondary-nav--font-family' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'secondary_nav_font_size', '--secondary-nav--font-size' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'secondary_nav_font_variant', '--secondary-nav--font-variant' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'secondary_nav_text_transform', '--secondary-nav--text-transform' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'secondary_nav_line_height', '--secondary-nav--line-height' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'secondary_nav_letter_spacing', '--secondary-nav--letter-spacing' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'secondary_nav_color_link', '--secondary-nav--color-link' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'secondary_nav_color_active', '--secondary-nav--color-active' );

			return $theme_css;
		}
	}
}

new Vinky_Secondary_Nav_Section();
