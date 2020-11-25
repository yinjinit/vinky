<?php
/**
 * Vinky Theme Customizer
 *
 * @since       1.0.0
 * @author      Vinky
 * @copyright   Copyright (c) 2020, Vinky
 * @link        https://www.vinky.com/
 * @package     Vinky
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Customizer Loader
 */
if ( ! class_exists( 'Vinky_Customizer' ) ) {

	/**
	 * Customizer Loader
	 *
	 * @since 1.0.0
	 */
	class Vinky_Customizer {

		/**
		 * All groups parent-child relation array data.
		 *
		 * @access Public
		 * @since  1.0.0
		 * @var array
		 */
		private static $group_arr = array();

		/**
		 * Customizer Dependency array.
		 *
		 * @access Private
		 * @since  1.0.0
		 * @var array
		 */
		private static $dependency_arr = array();

		/**
		 * Constructor
		 */
		public function __construct() {
			/**
			 * Customizer
			 */
			add_action( 'customize_preview_init', array( $this, 'preview_init' ) );

			if ( is_admin() || is_customize_preview() ) {
				add_action( 'customize_register', array( $this, 'register' ) );
			}

			add_action( 'customize_controls_enqueue_scripts', array(
				$this,
				'enqueue_scripts',
			) );

			add_filter(
				'customize_dynamic_setting_args',
				array(
					$this,
					'customize_dynamic_setting_args',
				),
				10,
				2
			);
		}

		/**
		 * Add postMessage support for some of Theme Customizer controls.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 *
		 * @since 1.0.0
		 */
		public function register( $wp_customize ) {
			/**
			 * Global Panel
			 */
			$wp_customize->add_panel(
				'general_settings',
				array(
					'priority' => 10,
					'title'    => esc_html__( 'General Settings', 'vinky' ),
				)
			);

			// Update the Site Identity section to be inside Global Settings.
			$wp_customize->add_section(
				'title_tagline',
				array(
					'title'    => esc_html__( 'Site Identity', 'vinky' ),
					'panel'    => 'general_settings',
					'priority' => 0,
				)
			);

			// Layout Settings section.
			$wp_customize->add_section(
				'general_layout',
				array(
					'title'    => esc_html__( 'Layout Settings', 'vinky' ),
					'panel'    => 'general_settings',
					'priority' => 6,
				)
			);

			// Typography Section.
			$wp_customize->add_section(
				'typography',
				array(
					'title'    => esc_html__( 'Typography', 'vinky' ),
					'panel'    => 'general_settings',
					'priority' => 7,
				)
			);

			// Fonts Section.
			$wp_customize->add_section(
				'fonts',
				array(
					'title'    => esc_html__( 'Google Fonts', 'vinky' ),
					'section'  => 'typography',
					'panel'    => 'general_settings',
					'priority' => 8,
				)
			);

			// Colors Section.
			$wp_customize->get_section( 'colors' )->panel    = 'general_settings';
			$wp_customize->get_section( 'colors' )->priority = 9;

			// Background Section.
			$wp_customize->get_section( 'background_image' )->panel    = 'general_settings';
			$wp_customize->get_section( 'background_image' )->priority = 10;
			$wp_customize->get_section( 'background_image' )->title    = __( 'Background', 'vinky' );

			/**
			 * Header & Navigation Panel
			 */
			$wp_customize->add_panel(
				'headers',
				array(
					'title'    => esc_html__( 'Header & Navigation', 'vinky' ),
					'priority' => 11,
				)
			);

			// Primary Header section.
			$wp_customize->add_section(
				'site_branding',
				array(
					'title'    => esc_html__( 'Site Branding', 'vinky' ),
					'panel'    => 'headers',
					'priority' => 1,
				)
			);

			// Primary Header section.
			$wp_customize->add_section(
				'primary_header',
				array(
					'title'    => esc_html__( 'Primary Header', 'vinky' ),
					'panel'    => 'headers',
					'priority' => 2,
				)
			);

			// Primary Menu.
			$wp_customize->add_section(
				'primary_nav',
				array(
					'title'    => esc_html__( 'Primary Menu', 'vinky' ),
					'panel'    => 'headers',
					'priority' => 3,
				)
			);

			// Top Bar section.
			$wp_customize->add_section(
				'secondary_nav',
				array(
					'title'    => esc_html__( 'Secondary Menu', 'vinky' ),
					'panel'    => 'headers',
					'priority' => 4,
				)
			);

			// Page Header section.
			$wp_customize->add_section(
				'post_type_header',
				array(
					'title'    => esc_html__( 'Post Type Header', 'vinky' ),
					'panel'    => 'headers',
					'priority' => 5,
				)
			);

			/**
			 * Footer Panel
			 */
			$wp_customize->add_panel(
				'footers',
				array(
					'title'    => esc_html__( 'Footer', 'vinky' ),
					'priority' => 12,
				)
			);

			// Footer Layout.
			$wp_customize->add_section(
				'footer_layout',
				array(
					'title'    => esc_html__( 'Layout', 'vinky' ),
					'panel'    => 'footers',
					'priority' => 1,
				)
			);

			// Footer Widgets.
			$wp_customize->add_section(
				'footer_widgets',
				array(
					'title'    => esc_html__( 'Widgets', 'vinky' ),
					'panel'    => 'footers',
					'priority' => 2,
				)
			);

			// Footer Widgets.
			$wp_customize->add_section(
				'footer_elements',
				array(
					'title'    => esc_html__( 'Elements', 'vinky' ),
					'panel'    => 'footers',
					'priority' => 3,
				)
			);

			// Footer Widgets.
			$wp_customize->add_section(
				'footer_top',
				array(
					'title'    => esc_html__( 'Top Bar', 'vinky' ),
					'panel'    => 'footers',
					'priority' => 4,
				)
			);

			// Footer Widgets.
			$wp_customize->add_section(
				'footer_bottom',
				array(
					'title'    => esc_html__( 'Bottom Bar', 'vinky' ),
					'panel'    => 'footers',
					'priority' => 5,
				)
			);

			/**
			 * Blog Panel
			 */
			$wp_customize->add_panel(
				'blog',
				array(
					'title'    => esc_html__( 'Blog', 'vinky' ),
					'priority' => 13,
				)
			);

			// Blog/Archive Options.
			$wp_customize->add_section(
				'blog_archive',
				array(
					'title'    => esc_html__( 'Blog / Archive', 'vinky' ),
					'panel'    => 'blog',
					'priority' => 1,
				)
			);

			// Blog Single Options.
			$wp_customize->add_section(
				'blog_single',
				array(
					'title'    => esc_html__( 'Single Post', 'vinky' ),
					'panel'    => 'blog',
					'priority' => 2,
				)
			);

			/**
			 * Sidebar Panel.
			 */
			$wp_customize->add_section(
				'sidebars',
				array(
					'priority' => 14,
					'title'    => esc_html__( 'Sidebar', 'vinky' ),
				)
			);

			/**
			 * Buttons Panel.
			 */
			$wp_customize->add_panel(
				'buttons',
				array(
					'title'    => esc_html__( 'Buttons', 'vinky' ),
					'priority' => 15,
				)
			);
		}

		/**
		 * Enqueue css and js files.
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function enqueue_scripts() {
			wp_enqueue_style( 'vinky-select2', get_theme_file_uri( 'assets/css/select2.min.css' ), null, wp_get_theme()->get( 'Version' ) );
			wp_enqueue_script( 'vinky-select2', get_theme_file_uri( 'assets/js/select2.min.js' ), array( 'jquery' ), wp_get_theme()->get( 'Version' ), true );

			// Customizer Controls.
			wp_enqueue_style( 'vinky-customizer-controls', get_theme_file_uri( 'assets/css/customize-controls.css' ), null, wp_get_theme()->get( 'Version' ) );
			wp_enqueue_script( 'vinky-customize-controls', get_theme_file_uri( 'assets/js/customize-controls.js' ), array(
				'vinky-color-alpha',
				'vinky-select2',
			), wp_get_theme()->get( 'Version' ), true );

			$custom_fonts = Vinky_Font_Families::get_custom_fonts();
			$google_fonts = Vinky_Font_Families::get_google_fonts();

			wp_localize_script(
				'vinky-customize-controls',
				'vinkyControls',
				apply_filters(
					'vinky_theme_customize_localize',
					array(
						'dependencies' => self::$dependency_arr,
						'relations'    => self::$group_arr,
						'googleFonts'  => $google_fonts,
						'customFonts'  => $custom_fonts,
					)
				)
			);
		}

		/**
		 * Customizer Preview Init
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function preview_init() {
			wp_enqueue_script(
				'vinky-customize-preview',
				get_theme_file_uri( 'assets/js/customize-preview.js' ),
				array( 'customize-preview', 'customize-selective-refresh', 'jquery' ),
				wp_get_theme()->get( 'Version' ),
				true
			);

			wp_localize_script(
				'vinky-customize-preview',
				'vinkyCustomizer',
				array(
					'googleFonts' => Vinky_Font_Families::get_google_fonts(),
				)
			);
		}

		/**
		 * Update dependency in the dependency array.
		 *
		 * @param array $arr Dependency array.
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public static function update_dependency( $arr ) {
			self::$dependency_arr = array_merge( self::$dependency_arr, $arr );
		}

		/**
		 * Update group array.
		 *
		 * @param array $arr Sub group array.
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public static function update_group( $arr ) {
			self::$group_arr = array_merge( self::$group_arr, $arr );
		}

		/**
		 * Set default theme option values.
		 *
		 * @access private
		 * @return mixed default values of the theme.
		 * @since  1.0.0
		 */
		private static function default_options() {
			// Defaults list of options.
			return apply_filters(
				'vinky_default_options',
				array(
					/**
					 * Global Settings.
					 */

					// Layout Settings.
					'content_width'            => 1200,
					'sidebar_width'            => 21,

					// Colors.
					'text_color'               => '#28303d',
					'heading_color'            => '#28303d',
					'link_color'               => '#8ac6d1',
					'hover_color'              => '#d22628',

					// Site Branding.
					'branding_logo_width'      => 100,
					'display_blogname'         => true,
					'blogname_typo'            => array(
						'family'         => 'inherit',
						'variant'        => 'inherit',
						'transform'      => 'inherit',
						'line-height'    => 'inherit',
						'letter-spacing' => 0,
					),

					/**
					 * Header & Navigation.
					 */

					// Primary Header.
					'header_layout'            => 1,
					'header_mobile_breakpoint' => 767,
					'primary_nav_height'       => 66,
					'mobile_header_layout'     => 1,

					// Primary Menu.
					'primary_nav_color_link'   => '#28303d',
					'primary_nav_color_active' => '#d22628',
					'sub_menu_color_link'      => '#28303d',
					'sub_menu_color_active'    => '#d22628',

					// Secondary Menu.
					'disable_secondary_nav'    => true,
				)
			);
		}

		/**
		 * Get default setting by its id.
		 *
		 * @param string $id Customize Setting ID.
		 */
		public static function get_default_setting( $id ) {
			$defaults = self::default_options();
			$value    = false;

			if ( isset( $defaults[ $id ] ) ) {
				$value = $defaults[ $id ];
			}

			return $value;
		}

		/**
		 * Get default value of a option.
		 *
		 * @access public
		 *
		 * @param array  $args Array of properties for the Setting object.
		 * @param string $id   Customize Setting ID.
		 */
		public function customize_dynamic_setting_args( $args, $id ) {


			if ( ! isset( $args['default'] ) ) {
				$defaults = self::default_options();

				if ( isset( $defaults[ $id ] ) ) {
					$args['default'] = $defaults[ $id ];
				}
			}

			return $args;
		}

		/**
		 * Sanitize boolean for checkbox.
		 *
		 * @access public
		 *
		 * @param bool $checked Whether or not a box is checked.
		 *
		 * @return bool
		 * @since  1.0.0
		 *
		 */
		public static function sanitize_checkbox( $checked = null ) {
			return (bool) isset( $checked ) && true === $checked;
		}

		/**
		 * Render the site title for the selective refresh partial.
		 *
		 * @access public
		 *
		 * @return void
		 * @since  1.0.0
		 *
		 */
		public function partial_blogname() {
			bloginfo( 'name' );
		}

		/**
		 * Render the site tagline for the selective refresh partial.
		 *
		 * @access public
		 *
		 * @return void
		 * @since  1.0.0
		 *
		 */
		public function partial_blogdescription() {
			bloginfo( 'description' );
		}
	}
}

new Vinky_Customizer();

// phpcs:disable WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

// Customizer Panels and Sections.
$panels_sections_dir = get_template_directory() . '/inc/customizer/panels-sections/';

require $panels_sections_dir . 'class-vinky-section.php';
require $panels_sections_dir . 'general/class-vinky-site-identity-section.php';
require $panels_sections_dir . 'general/class-vinky-google-fonts-section.php';
require $panels_sections_dir . 'general/class-vinky-layout-section.php';
require $panels_sections_dir . 'general/class-vinky-colors-section.php';
require $panels_sections_dir . 'general/class-vinky-background-section.php';
require $panels_sections_dir . 'header/class-vinky-site-branding-section.php';
require $panels_sections_dir . 'header/class-vinky-primary-header-section.php';
require $panels_sections_dir . 'header/class-vinky-primary-nav-section.php';
require $panels_sections_dir . 'header/class-vinky-post-type-header-section.php';
require $panels_sections_dir . 'header/class-vinky-secondary-nav-section.php';
require $panels_sections_dir . 'footer/class-vinky-footer-general-section.php';
require $panels_sections_dir . 'footer/class-vinky-footer-widgets-section.php';
require $panels_sections_dir . 'footer/class-vinky-footer-elements-section.php';
require $panels_sections_dir . 'footer/class-vinky-footer-top-section.php';
require $panels_sections_dir . 'footer/class-vinky-footer-bottom-section.php';

// Customizer custom controls.
if ( class_exists( 'WP_Customize_Control' ) ) {
	$controls_dir = get_template_directory() . '/inc/customizer/custom-controls/';

	require $controls_dir . 'class-vinky-customize-heading-control.php';
	require $controls_dir . 'class-vinky-customize-group-control.php';

	require $controls_dir . 'class-vinky-customize-slider-control.php';
	require $controls_dir . 'class-vinky-customize-google-fonts-control.php';
	require $controls_dir . 'class-vinky-customize-typography-control.php';
	require $controls_dir . 'class-vinky-customize-color-control.php';
}

// phpcs:enable WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
