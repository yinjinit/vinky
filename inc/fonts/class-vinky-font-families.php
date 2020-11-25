<?php
/**
 * Helper class for font settings.
 *
 * @package     Vinky
 * @author      Vinky
 * @copyright   Copyright (c) 2020, Vinky
 * @link        https://www.vinky.com/
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Font info class for System and Google fonts.
 */
if ( ! class_exists( 'Vinky_Font_Families' ) ) :

	/**
	 * Font info class for System and Google fonts.
	 */
	final class Vinky_Font_Families {

		/**
		 * Custom Fonts
		 *
		 * @since 1.0.0
		 * @var array
		 */
		private static $custom_fonts = array();

		/**
		 * System Fonts
		 *
		 * @since 1.0.0
		 * @var array
		 */
		private static $system_fonts = array();

		/**
		 * Google Fonts
		 *
		 * @since 1.0.0
		 * @var array
		 */
		private static $google_fonts = array();

		/**
		 * Get System Fonts
		 *
		 * @since 1.0.0
		 *
		 * @return array All the system fonts in Vinky
		 */
		public static function get_system_fonts() {
			if ( empty( self::$system_fonts ) ) {
				self::$system_fonts = array(
					'Helvetica' => array(
						'fallback' => 'Verdana, Arial, sans-serif',
						'weights'  => array(
							'300',
							'400',
							'700',
						),
					),
					'Verdana'   => array(
						'fallback' => 'Helvetica, Arial, sans-serif',
						'weights'  => array(
							'300',
							'400',
							'700',
						),
					),
					'Arial'     => array(
						'fallback' => 'Helvetica, Verdana, sans-serif',
						'weights'  => array(
							'300',
							'400',
							'700',
						),
					),
					'Times'     => array(
						'fallback' => 'Georgia, serif',
						'weights'  => array(
							'300',
							'400',
							'700',
						),
					),
					'Georgia'   => array(
						'fallback' => 'Times, serif',
						'weights'  => array(
							'300',
							'400',
							'700',
						),
					),
					'Courier'   => array(
						'fallback' => 'monospace',
						'weights'  => array(
							'300',
							'400',
							'700',
						),
					),
				);
			}

			return apply_filters( 'vinky_system_fonts', self::$system_fonts );
		}

		/**
		 * Custom Fonts
		 *
		 * @since 1.0.0
		 *
		 * @return array All the custom fonts in Vinky
		 */
		public static function get_custom_fonts() {
			return apply_filters( 'vinky_custom_fonts', self::$custom_fonts );
		}

		/**
		 * Google Fonts used in vinky.
		 * array is generated from the google-fonts.json file.
		 *
		 * @since 1.0.0
		 *
		 * @return array array of Google Fonts.
		 */
		public static function get_google_fonts() {

			if ( empty( self::$google_fonts ) ) {

				/**
				 * Deprecating the Filter to change the Google Fonts JSON file path.
				 *
				 * @since 1.0.0
				 * @param string $json_file File where google fonts json format added.
				 * @return array
				 */
				$google_fonts_file = apply_filters( 'vinky_google_fonts_php_file', get_template_directory() . '/inc/fonts/google-fonts.php' );

				if ( ! file_exists( $google_fonts_file ) ) {
					return array();
				}

				self::$google_fonts = include $google_fonts_file;// phpcs:ignore
			}

			return apply_filters( 'vinky_google_fonts', self::$google_fonts );
		}

	}

endif;
