<?php
/**
 * Site Identity Options.
 *
 * @package   Vinky
 * @since     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Vinky_Site_Identity_Section' ) ) {

	/**
	 * Register Vinky Customizer Site identity Customizer Options.
	 */
	class Vinky_Site_Identity_Section {
		/**
		 * Constructor.
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function __construct() {
			if ( is_admin() || is_customize_preview() ) {
				add_action( 'customize_register', array( $this, 'customize_register' ) );
			}
		}

		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 *
		 * @since 1.0.0
		 */
		public function customize_register( $wp_customize ) {
			/**
			 * Override Sections
			 */
			$wp_customize->get_section( 'title_tagline' )->priority = 1;

			/**
			 * Override Settings
			 */
			$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

			$wp_customize->selective_refresh->add_partial(
				'blogname',
				array(
					'selector'        => '.site-title',
					'render_callback' => array( 'Vinky_Customizer', 'partial_blogname' ),
				)
			);

			$wp_customize->selective_refresh->add_partial(
				'blogdescription',
				array(
					'selector'        => '.site-description',
					'render_callback' => array( 'Vinky_Customizer', 'partial_blogdescription' ),
				)
			);
		}
	}
}

new Vinky_Site_Identity_Section();
