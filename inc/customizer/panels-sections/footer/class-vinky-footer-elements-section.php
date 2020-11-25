<?php
/**
 * Footer Elements Section.
 *
 * @since     1.0.0
 * @package   Vinky
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Vinky_Footer_Elements_Section' ) ) {

	/**
	 * Register Vinky Customizer Primary Header Customizer Options.
	 */
	class Vinky_Footer_Elements_Section extends Vinky_Section {

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
				'footer_show_socials',
				array(
					'capability' => 'edit_theme_options',
				)
			);

			$wp_customize->add_control( new WP_Customize_Control(
				$wp_customize,
				'footer_show_socials',
				array(
					'label'    => __( 'Show Social Icons', 'vinky' ),
					'section'  => 'footer_elements',
					'type'     => 'checkbox',
					'priority' => 1,
				)
			) );

			$wp_customize->add_setting(
				'footer_social_size',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Slider_Control(
				$wp_customize,
				'footer_social_size',
				array(
					'label'       => __( 'Icon Size', 'vinky' ),
					'input_attrs' => array(
						'min'  => 10,
						'max'  => 200,
						'step' => 1,
					),
					'section'     => 'footer_elements',
					'priority'    => 2,
				)
			) );

			$wp_customize->add_setting(
				'footer_social_item_size',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Slider_Control(
				$wp_customize,
				'footer_social_item_size',
				array(
					'label'       => __( 'Icon Item Size', 'vinky' ),
					'input_attrs' => array(
						'min'  => 10,
						'max'  => 200,
						'step' => 1,
					),
					'section'     => 'footer_elements',
					'priority'    => 2,
				)
			) );

			$wp_customize->add_setting(
				'footer_social_color_link',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Color_Control(
				$wp_customize,
				'footer_social_color_link',
				array(
					'label'    => __( 'Link Color', 'vinky' ),
					'section'  => 'footer_elements',
					'priority' => 3,
				)
			) );

			$wp_customize->add_setting(
				'footer_social_color_active',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Color_Control(
				$wp_customize,
				'footer_social_color_active',
				array(
					'label'    => __( 'Active Link Color', 'vinky' ),
					'priority' => 4,
					'section'  => 'footer_elements',
				)
			) );

			$wp_customize->add_setting(
				'footer_social_background',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Color_Control(
				$wp_customize,
				'footer_social_background',
				array(
					'label'    => __( 'Icon Background', 'vinky' ),
					'priority' => 5,
					'section'  => 'footer_elements',
				)
			) );

			$wp_customize->add_setting(
				'footer_disable_copyright',
				array(
					'capability' => 'edit_theme_options',
				)
			);

			$wp_customize->add_control( new WP_Customize_Control(
				$wp_customize,
				'footer_disable_copyright',
				array(
					'label'    => __( 'Disable Copyright', 'vinky' ),
					'section'  => 'footer_elements',
					'type'     => 'checkbox',
					'priority' => 6,
				)
			) );

			$wp_customize->add_setting(
				'footer_copyright',
				array(
					'capability' => 'edit_theme_options',
				)
			);

			$wp_customize->add_control( new WP_Customize_Control(
				$wp_customize,
				'footer_copyright',
				array(
					'label'    => __( 'Copyright', 'vinky' ),
					'section'  => 'footer_elements',
					'type'     => 'textarea',
					'priority' => 7,
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
			if ( vinky_get_setting( 'footer_show_socials' ) ) {
				$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_social_size', '--footer-social--size', 'px' );
				$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_social_item_size', '--footer-social--item-size', 'px' );
				$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_social_color_link', '--footer-social--color-link' );
				$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_social_color_active', '--footer-social--color-active' );
				$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'footer_social_background', '--footer-social--background' );
			}

			return $theme_css;
		}
	}
}

new Vinky_Footer_Elements_Section();
