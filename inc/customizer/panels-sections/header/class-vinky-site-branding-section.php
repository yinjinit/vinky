<?php
/**
 * Primary Header Section.
 *
 * @since     1.0.0
 * @package   Vinky
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Vinky_Site_Branding_Section' ) ) {

	/**
	 * Register Vinky Customizer Primary Header Customizer Options.
	 */
	class Vinky_Site_Branding_Section extends Vinky_Section {

		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function register( $wp_customize ) {
			/**
			 * Override Settings
			 */
			$wp_customize->get_setting( 'custom_logo' )->transport = 'refresh';

			/**
			 * Override Controls
			 */
			$wp_customize->get_control( 'custom_logo' )->priority = 1;
			$wp_customize->get_control( 'custom_logo' )->section  = 'site_branding';

			$wp_customize->add_setting( 'heading_custom_logo' );

			$wp_customize->add_control( new Vinky_Customize_Heading_Control(
				$wp_customize,
				'heading_custom_logo',
				array(
					'label'    => esc_html__( 'Site Logo', 'vinky' ),
					'section'  => 'site_branding',
					'priority' => 1,
				)
			) );

			$wp_customize->add_setting(
				'different_retina_logo',
				array(
					'transport' => 'refresh',
				)
			);

			$wp_customize->add_control( new WP_Customize_Control(
				$wp_customize,
				'different_retina_logo',
				array(
					'label'    => esc_html__( 'Different Logo For Retina Devices?', 'vinky' ),
					'type'     => 'checkbox',
					'section'  => 'site_branding',
					'priority' => 2,
				)
			) );

			$wp_customize->add_setting(
				'retina_logo',
				array(
					'transport' => 'refresh',
				)
			);

			$wp_customize->add_control( new WP_Customize_Cropped_Image_Control(
				$wp_customize,
				'retina_logo',
				array(
					'label'    => esc_html__( 'Retina Logo', 'vinky' ),
					'section'  => 'site_branding',
					'priority' => 3,
				)
			) );

			$wp_customize->add_setting(
				'different_mobile_logo',
				array(
					'transport' => 'refresh',
				)
			);

			$wp_customize->add_control( new WP_Customize_Control(
				$wp_customize,
				'different_mobile_logo',
				array(
					'label'    => esc_html__( 'Different Logo For Mobile Devices?', 'vinky' ),
					'type'     => 'checkbox',
					'section'  => 'site_branding',
					'priority' => 4,
				)
			) );

			$wp_customize->add_setting(
				'mobile_logo',
				array(
					'transport' => 'refresh',
				)
			);

			$wp_customize->add_control( new WP_Customize_Cropped_Image_Control(
				$wp_customize,
				'mobile_logo',
				array(
					'label'    => esc_html__( 'Mobile Logo', 'vinky' ),
					'section'  => 'site_branding',
					'priority' => 5,
				)
			) );

			$wp_customize->add_setting(
				'branding_logo_width',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Slider_Control(
				$wp_customize,
				'branding_logo_width',
				array(
					'label'       => esc_html__( 'Logo Width', 'vinky' ),
					'section'     => 'site_branding',
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 600,
					),
					'priority'    => 6,
				)
			) );

			$wp_customize->add_setting( 'heading_typography' );

			$wp_customize->add_control( new Vinky_Customize_Heading_Control(
				$wp_customize,
				'heading_typography',
				array(
					'label'    => esc_html__( 'Title & Tagline', 'vinky' ),
					'section'  => 'site_branding',
					'priority' => 7,
				)
			) );

			$wp_customize->add_setting(
				'display_blogname',
				array(
					'capability'        => 'edit_theme_options',
					'sanitize_callback' => array(
						'Vinky_Customizer',
						'sanitize_checkbox',
					),
				)
			);

			$wp_customize->add_control( new WP_Customize_Control(
				$wp_customize,
				'display_blogname',
				array(
					'label'    => esc_html__( 'Display Title', 'vinky' ),
					'type'     => 'checkbox',
					'section'  => 'site_branding',
					'priority' => 8,
				)
			) );

			$wp_customize->add_setting(
				'display_blogdescription',
				array(
					'capability'        => 'edit_theme_options',
					'sanitize_callback' => array(
						'Vinky_Customizer',
						'sanitize_checkbox',
					),
				)
			);

			$wp_customize->add_control( new WP_Customize_Control(
				$wp_customize,
				'display_blogdescription',
				array(
					'label'    => esc_html__( 'Display Tagline', 'vinky' ),
					'type'     => 'checkbox',
					'section'  => 'site_branding',
					'priority' => 9,
				)
			) );

			$wp_customize->add_setting(
				'inline_logo_and_blogname',
				array(
					'transport' => 'refresh',
				)
			);

			$wp_customize->add_control( new WP_Customize_Control(
				$wp_customize,
				'inline_logo_and_blogname',
				array(
					'label'    => esc_html__( 'Inline Logo, Title and Tagline', 'vinky' ),
					'type'     => 'checkbox',
					'section'  => 'site_branding',
					'priority' => 10,
				)
			) );

			$wp_customize->add_setting( 'blogname_typo' );

			$wp_customize->add_control( new Vinky_Customize_Group_Control(
				$wp_customize,
				'blogname_typo',
				array(
					'label'    => __( 'Title Typography', 'vinky' ),
					'section'  => 'site_branding',
					'priority' => 12,
				)
			) );

			$wp_customize->add_setting(
				'blogname_font_family',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'blogname_font_family',
				array(
					'label'    => __( 'Font Family', 'vinky' ),
					'property' => 'font-family',
					'section'  => 'site_branding',
				)
			) );

			$wp_customize->add_setting(
				'blogname_font_size',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'blogname_font_size',
				array(
					'label'    => __( 'Font Size', 'vinky' ),
					'property' => 'font-size',
					'section'  => 'site_branding',
				)
			) );

			$wp_customize->add_setting(
				'blogname_font_variant',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'blogname_font_variant',
				array(
					'label'    => __( 'Font Variant', 'vinky' ),
					'property' => 'font-variant',
					'section'  => 'site_branding',
				)
			) );

			$wp_customize->add_setting(
				'blogname_text_transform',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'blogname_text_transform',
				array(
					'label'    => __( 'Text Transform', 'vinky' ),
					'property' => 'text-transform',
					'section'  => 'site_branding',
				)
			) );

			$wp_customize->add_setting(
				'blogname_line_height',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Slider_Control(
				$wp_customize,
				'blogname_line_height',
				array(
					'label'       => __( 'Line Height', 'vinky' ),
					'input_attrs' => array(
						'min'  => 0.1,
						'max'  => 30,
						'step' => 0.1,
					),
					'section'     => 'site_branding',
				)
			) );

			$wp_customize->add_setting(
				'blogname_letter_spacing',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Slider_Control(
				$wp_customize,
				'blogname_letter_spacing',
				array(
					'label'       => __( 'Letter Spacing', 'vinky' ),
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),
					'responsive'  => false,
					'section'     => 'site_branding',
				)
			) );

			$wp_customize->add_setting( 'blogdescription_typo' );

			$wp_customize->add_control( new Vinky_Customize_Group_Control(
				$wp_customize,
				'blogdescription_typo',
				array(
					'label'    => __( 'Tagline Typography', 'vinky' ),
					'section'  => 'site_branding',
					'priority' => 12,
				)
			) );

			$wp_customize->add_setting(
				'blogdescription_font_family',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'blogdescription_font_family',
				array(
					'label'    => __( 'Font Family', 'vinky' ),
					'property' => 'font-family',
					'section'  => 'site_branding',
				)
			) );

			$wp_customize->add_setting(
				'blogdescription_font_size',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'blogdescription_font_size',
				array(
					'label'    => __( 'Font Size', 'vinky' ),
					'property' => 'font-size',
					'section'  => 'site_branding',
				)
			) );

			$wp_customize->add_setting(
				'blogdescription_font_variant',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'blogdescription_font_variant',
				array(
					'label'    => __( 'Font Variant', 'vinky' ),
					'property' => 'font-variant',
					'section'  => 'site_branding',
				)
			) );

			$wp_customize->add_setting(
				'blogdescription_text_transform',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'blogdescription_text_transform',
				array(
					'label'    => __( 'Text Transform', 'vinky' ),
					'property' => 'text-transform',
					'section'  => 'site_branding',
				)
			) );

			$wp_customize->add_setting(
				'blogdescription_line_height',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Slider_Control(
				$wp_customize,
				'blogdescription_line_height',
				array(
					'label'       => __( 'Line Height', 'vinky' ),
					'input_attrs' => array(
						'min'  => 0.1,
						'max'  => 30,
						'step' => 0.1,
					),
					'section'     => 'site_branding',
				)
			) );

			$wp_customize->add_setting(
				'blogdescription_letter_spacing',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Slider_Control(
				$wp_customize,
				'blogdescription_letter_spacing',
				array(
					'label'       => __( 'Letter Spacing', 'vinky' ),
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),
					'responsive'  => false,
					'section'     => 'site_branding',
				)
			) );

			Vinky_Customizer::update_dependency(
				array(
					'retina_logo'              => array(
						'different_retina_logo',
						'===',
						true,
					),
					'mobile_logo'              => array(
						'different_mobile_logo',
						'===',
						true,
					),
					'inline_logo_and_blogname' => array(
						'conditions' => array(
							array( 'display_blogname', '===', true ),
							array( 'display_blogdescription', '===', true ),
						),
						'operator'   => 'OR',
					),
					'blogname_typo'            => array(
						'display_blogname',
						'===',
						true,
					),
					'blogdescription_typo'     => array(
						'display_blogdescription',
						'===',
						true,
					),
				)
			);

			Vinky_Customizer::update_group(
				array(
					'blogname_typo'        => array(
						'blogname_font_family',
						'blogname_font_size',
						'blogname_font_variant',
						'blogname_text_transform',
						'blogname_line_height',
						'blogname_letter_spacing',
					),
					'blogdescription_typo' => array(
						'blogdescription_font_family',
						'blogdescription_font_size',
						'blogdescription_font_variant',
						'blogdescription_text_transform',
						'blogdescription_line_height',
						'blogdescription_letter_spacing',
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
			if ( vinky_get_setting( 'custom_logo' ) ) {
				$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'branding_logo_width', '--branding-logo--width', 'px', true );
			}

			if ( vinky_get_setting( 'display_blogname' ) === true ) {
				$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'blogname_font_family', '--branding--title-font-family' );
				$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'blogname_font_size', '--branding--title-font-size' );
				$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'blogname_font_variant', '--branding--title-font-variant' );
				$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'blogname_text_transform', '--branding--title-text-transform' );
				$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'blogname_line_height', '--branding--title-line-height' );
				$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'blogname_letter_spacing', '--branding--title-letter-spacing' );
			}

			if ( vinky_get_setting( 'display_blogdescription' ) === true ) {
				$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'blogdescription_font_family', '--branding--title-font-family' );
				$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'blogdescription_font_size', '--branding--title-font-size' );
				$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'blogdescription_font_variant', '--branding--title-font-variant' );
				$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'blogdescription_text_transform', '--branding--title-text-transform' );
				$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'blogdescription_line_height', '--branding--title-line-height' );
				$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'blogdescription_letter_spacing', '--branding--title-letter-spacing' );
			}

			return $theme_css;
		}
	}
}

new Vinky_Site_Branding_Section();
