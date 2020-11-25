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

if ( ! class_exists( 'Vinky_Primary_Nav_Section' ) ) {

	/**
	 * Register Vinky Customizer Primary Header Customizer Options.
	 */
	class Vinky_Primary_Nav_Section extends Vinky_Section {

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
				'primary_nav_full_width',
				array(
					'capability'        => 'edit_theme_options',
					'sanitize_callback' => array( 'Vinky_Customizer', 'sanitize_checkbox' ),
				)
			);

			$wp_customize->add_control( new WP_Customize_Control(
				$wp_customize,
				'primary_nav_full_width',
				array(
					'label'    => esc_html__( 'Make Full width', 'vinky' ),
					'type'     => 'checkbox',
					'section'  => 'primary_nav',
					'priority' => 1,
				)
			) );

			$wp_customize->add_setting(
				'primary_nav_height',
				array(
'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Slider_Control(
				$wp_customize,
				'primary_nav_height',
				array(
					'label'       => esc_html__( 'Header Height', 'vinky' ),
					'section'     => 'primary_nav',
					'responsive'  => false,
					'input_attrs' => array(
						'min'  => 30,
						'max'  => 300,
						'step' => 1,
					),
					'priority'    => 1,
				)
			) );

			$wp_customize->add_setting(
				'primary_nav_background',
				array(
'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Color_Control(
				$wp_customize,
				'primary_nav_background',
				array(
					'label'    => __( 'Background Color', 'vinky' ),
					'priority' => 1,
					'section'  => 'primary_nav',
				)
			) );

			$wp_customize->add_setting( 'heading_primary_nav' );

			$wp_customize->add_control( new Vinky_Customize_Heading_Control(
				$wp_customize,
				'heading_primary_nav',
				array(
					'label'    => esc_html__( 'Menu', 'vinky' ),
					'section'  => 'primary_nav',
					'priority' => 1,
				)
			) );

			$wp_customize->add_setting(
				'primary_nav_last_item',
				array(
					'transport' => 'edit_theme_options',
				)
			);

			$wp_customize->add_control( new WP_Customize_Control(
				$wp_customize,
				'primary_nav_last_item',
				array(
					'label'    => esc_html__( 'Last Item in Menu', 'vinky' ),
					'type'     => 'select',
					'choices'  => array(
						''          => 'None',
						'search'    => 'Search',
						'button'    => 'Button',
						'widget'    => 'Widget',
						'mega-menu' => 'Mega Menu',
					),
					'section'  => 'primary_nav',
					'priority' => 2,
				)
			) );

			$wp_customize->add_setting(
				'hide_last_item_on_mobile',
				array(
					'transport' => 'edit_theme_options',
				)
			);

			$wp_customize->add_control( new WP_Customize_Control(
				$wp_customize,
				'hide_last_item_on_mobile',
				array(
					'label'    => esc_html__( 'Hide Last Item on Mobile Menu', 'vinky' ),
					'type'     => 'checkbox',
					'section'  => 'primary_nav',
					'priority' => 3,
				)
			) );

			$wp_customize->add_setting(
				'take_last_item_outside',
				array(
					'transport' => 'edit_theme_options',
				)
			);

			$wp_customize->add_control( new WP_Customize_Control(
				$wp_customize,
				'take_last_item_outside',
				array(
					'label'    => esc_html__( 'Take Last Item Outside Menu', 'vinky' ),
					'type'     => 'checkbox',
					'section'  => 'primary_nav',
					'priority' => 4,
				)
			) );

			$wp_customize->add_setting( 'heading_menu_style' );

			$wp_customize->add_control( new Vinky_Customize_Heading_Control(
				$wp_customize,
				'heading_menu_style',
				array(
					'label'    => esc_html__( 'Menu Style', 'vinky' ),
					'section'  => 'primary_nav',
					'priority' => 5,
				)
			) );

			$wp_customize->add_setting( 'primary_nav_typo' );

			$wp_customize->add_control( new Vinky_Customize_Group_Control(
				$wp_customize,
				'primary_nav_typo',
				array(
					'label'    => __( 'Typography', 'vinky' ),
					'section'  => 'primary_nav',
					'priority' => 6,
				)
			) );

			$wp_customize->add_setting(
				'primary_nav_font_family',
				array(
'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'primary_nav_font_family',
				array(
					'label'    => __( 'Font Family', 'vinky' ),
					'property' => 'font-family',
					'section'  => 'primary_nav',
					'priority' => 7,
				)
			) );

			$wp_customize->add_setting(
				'primary_nav_font_size',
				array(
'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'primary_nav_font_size',
				array(
					'label'    => __( 'Font Size', 'vinky' ),
					'property' => 'font-size',
					'section'  => 'primary_nav',
					'priority' => 8,
				)
			) );

			$wp_customize->add_setting(
				'primary_nav_font_variant',
				array(
'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'primary_nav_font_variant',
				array(
					'label'    => __( 'Font Variant', 'vinky' ),
					'property' => 'font-variant',
					'section'  => 'primary_nav',
					'priority' => 9,
				)
			) );

			$wp_customize->add_setting(
				'primary_nav_text_transform',
				array(
'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Typography_Control(
				$wp_customize,
				'primary_nav_text_transform',
				array(
					'label'    => __( 'Text Transform', 'vinky' ),
					'property' => 'text-transform',
					'section'  => 'primary_nav',
					'priority' => 10,
				)
			) );

			$wp_customize->add_setting(
				'primary_nav_line_height',
				array(
'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Slider_Control(
				$wp_customize,
				'primary_nav_line_height',
				array(
					'label'       => __( 'Line Height', 'vinky' ),
					'input_attrs' => array(
						'min'  => 0.1,
						'max'  => 30,
						'step' => 0.1,
					),
					'section'     => 'primary_nav',
					'priority'    => 11,
				)
			) );

			$wp_customize->add_setting(
				'primary_nav_letter_spacing',
				array(
'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Slider_Control(
				$wp_customize,
				'primary_nav_letter_spacing',
				array(
					'label'       => __( 'Letter Spacing', 'vinky' ),
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),
					'responsive'  => false,
					'section'     => 'primary_nav',
					'priority'    => 12,
				)
			) );

			$wp_customize->add_setting(
				'primary_nav_color_link',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Color_Control(
				$wp_customize,
				'primary_nav_color_link',
				array(
					'label'    => __( 'Link Color', 'vinky' ),
					'section'  => 'primary_nav',
					'priority' => 13,
				)
			) );

			$wp_customize->add_setting(
				'primary_nav_color_active',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Color_Control(
				$wp_customize,
				'primary_nav_color_active',
				array(
					'label'    => __( 'Active Link Color', 'vinky' ),
					'priority' => 14,
					'section'  => 'primary_nav',
				)
			) );

			$wp_customize->add_setting( 'heading_sub_menu' );

			$wp_customize->add_control( new Vinky_Customize_Heading_Control(
				$wp_customize,
				'heading_sub_menu',
				array(
					'label'    => esc_html__( 'Sub Menu', 'vinky' ),
					'section'  => 'primary_nav',
					'priority' => 15,
				)
			) );

			$wp_customize->add_setting(
				'sub_menu_animation',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new WP_Customize_Control(
				$wp_customize,
				'sub_menu_animation',
				array(
					'label'    => esc_html__( 'Animation', 'vinky' ),
					'type'     => 'select',
					'choices'  => array(
						''          => 'Default',
						'fade'      => 'Fade',
						'side-down' => 'Slide Down',
						'side-up'   => 'Slide Up',
					),
					'section'  => 'primary_nav',
					'priority' => 16,
				)
			) );

			$wp_customize->add_setting(
				'sub_menu_background',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Color_Control(
				$wp_customize,
				'sub_menu_background',
				array(
					'label'    => __( 'Background', 'vinky' ),
					'section'  => 'primary_nav',
					'priority' => 17,
				)
			) );

			$wp_customize->add_setting(
				'sub_menu_color_link',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Color_Control(
				$wp_customize,
				'sub_menu_color_link',
				array(
					'label'    => __( 'Link Color', 'vinky' ),
					'section'  => 'primary_nav',
					'priority' => 18,
				)
			) );

			$wp_customize->add_setting(
				'sub_menu_color_active',
				array(
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( new Vinky_Customize_Color_Control(
				$wp_customize,
				'sub_menu_color_active',
				array(
					'label'    => __( 'Active Link Color', 'vinky' ),
					'section'  => 'primary_nav',
					'priority' => 19,
				)
			) );

			Vinky_Customizer::update_group(
				array(
					'primary_nav_typo' => array(
						'primary_nav_font_family',
						'primary_nav_font_size',
						'primary_nav_font_variant',
						'primary_nav_text_transform',
						'primary_nav_line_height',
						'primary_nav_letter_spacing',
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
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'primary_nav_height', '--primary-nav--height', 'px' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'primary_nav_background', '--primary-nav--background' );

			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'primary_nav_font_family', '--primary-nav--font-family' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'primary_nav_font_size', '--primary-nav--font-size' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'primary_nav_font_variant', '--primary-nav--font-variant' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'primary_nav_text_transform', '--primary-nav--text-transform' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'primary_nav_line_height', '--primary-nav--line-height' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'primary_nav_letter_spacing', '--primary-nav--letter-spacing' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'primary_nav_color_link', '--primary-nav--color-link' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'primary_nav_color_active', '--primary-nav--color-active' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'sub_menu_background', '--sub-menu--background' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'sub_menu_color_link', '--sub-menu--color-link' );
			$theme_css .= Vinky_Dynamic_Styles::generate_custom_css_variable( 'sub_menu_color_active', '--sub-menu--color-active' );

			return $theme_css;
		}
	}
}

new Vinky_Primary_Nav_Section();
