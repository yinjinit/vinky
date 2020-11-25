<?php
/**
 * Primary Header Section.
 *
 * @package   Vinky
 * @since     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Vinky_Site_Branding_Section' ) ) {

	/**
	 * Register Vinky Customizer Primary Header Customizer Options.
	 */
	class Vinky_Site_Branding_Section {

		/**
		 * Constructor. Instantiate the customizer.
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function __construct() {
			if ( is_admin() || is_customize_preview() ) {
				add_action( 'customize_register', array( $this, 'register_controls' ) );
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
		public function register_controls( $wp_customize ) {
			/**
			 * Override Settings
			 */
			$wp_customize->get_setting( 'custom_logo' )->transport = 'refresh';

			/**
			 * Override Controls
			 */
			$wp_customize->get_control( 'custom_logo' )->priority = 1;
			$wp_customize->get_control( 'custom_logo' )->section  = 'site_branding';

			$wp_customize->add_setting(
				'heading_custom_logo',
				array(
					'type' => 'theme_mod',
				)
			);

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
					'type'      => 'theme_mod',
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
					'type'      => 'theme_mod',
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
					'type'      => 'theme_mod',
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
					'type'      => 'theme_mod',
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
				'logo_width',
				array(
					'type'      => 'theme_mod',
					'transport' => 'postMessage',
					'default'   => Vinky_Customizer::get_default_option( 'logo_width' ),
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Slider_Control(
				$wp_customize,
				'logo_width',
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

			$wp_customize->add_setting(
				'heading_typography',
				array(
					'type' => 'theme_mod',
				)
			);

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
					'default'           => Vinky_Customizer::get_default_option( 'display_blogname' ),
					'sanitize_callback' => array( 'Vinky_Customizer', 'sanitize_checkbox' ),
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
					'sanitize_callback' => array( 'Vinky_Customizer', 'sanitize_checkbox' ),
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
					'type'      => 'theme_mod',
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
					'type'      => 'theme_mod',
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
					'type'      => 'theme_mod',
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
				'blogname_font_weight',
				array(
					'type'      => 'theme_mod',
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'blogname_font_weight',
				array(
					'label'    => __( 'Font Weight', 'vinky' ),
					'property' => 'font-weight',
					'section'  => 'site_branding',
				)
			) );

			$wp_customize->add_setting(
				'blogname_font_style',
				array(
					'type'      => 'theme_mod',
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'blogname_font_style',
				array(
					'label'    => __( 'Font Style', 'vinky' ),
					'property' => 'font-style',
					'section'  => 'site_branding',
				)
			) );

			$wp_customize->add_setting(
				'blogname_text_transform',
				array(
					'type'      => 'theme_mod',
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
					'type'      => 'theme_mod',
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
					'type'      => 'theme_mod',
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
					'type'      => 'theme_mod',
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
					'type'      => 'theme_mod',
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
				'blogdescription_font_weight',
				array(
					'type'      => 'theme_mod',
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'blogdescription_font_weight',
				array(
					'label'    => __( 'Font Weight', 'vinky' ),
					'property' => 'font-weight',
					'section'  => 'site_branding',
				)
			) );

			$wp_customize->add_setting(
				'blogdescription_font_style',
				array(
					'type'      => 'theme_mod',
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'blogdescription_font_style',
				array(
					'label'    => __( 'Font Style', 'vinky' ),
					'property' => 'font-style',
					'section'  => 'site_branding',
				)
			) );

			$wp_customize->add_setting(
				'blogdescription_text_transform',
				array(
					'type'      => 'theme_mod',
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
					'type'      => 'theme_mod',
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
					'type'      => 'theme_mod',
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
						'blogname_font_weight',
						'blogname_font_style',
						'blogname_text_transform',
						'blogname_line_height',
						'blogname_letter_spacing',
					),
					'blogdescription_typo' => array(
						'blogdescription_font_family',
						'blogdescription_font_size',
						'blogdescription_font_weight',
						'blogdescription_font_style',
						'blogdescription_text_transform',
						'blogdescription_line_height',
						'blogdescription_letter_spacing',
					),
				)
			);
		}
	}
}

new Vinky_Site_Branding_Section();
