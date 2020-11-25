<?php
/**
 * Primary Navigation Section.
 *
 * @since     1.0.0
 * @package   Vinky
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Vinky_Post_Type_Header_Section' ) ) {

	/**
	 * Register Vinky Customizer Primary Header Customizer Options.
	 */
	class Vinky_Post_Type_Header_Section extends Vinky_Section {

		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function register( $wp_customize ) {

			$post_types = array(
				'resource'    => esc_html__( 'Resources', 'vinky' ),
				'form'        => esc_html__( 'Forms', 'vinky' ),
				'event'       => esc_html__( 'Events', 'vinky' ),
				'post'        => esc_html__( 'Posts', 'vinky' ),
				'quick_links' => esc_html__( 'Quick Links', 'vinky' ),
				'search'      => esc_html__( 'Search', 'vinky' ),
			);

			foreach ( $post_types as $slug => $name ) {
				$wp_customize->add_setting(
					$slug . '_background_image'
				);

				$wp_customize->add_control(
					new WP_Customize_Image_Control(
						$wp_customize,
						$slug . '_background_image',
						array(
							'section' => 'post_type_header',
							'label'   => $name . ' Header Background',
						)
					)
				);
			}
		}
	}
}

new Vinky_Post_Type_Header_Section();
