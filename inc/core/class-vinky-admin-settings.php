<?php
/**
 * Admin settings helper
 *
 * @link        https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package     Vinky
 * @author      Vinky
 * @copyright   Copyright (c) 2020, Vinky
 * @link        https://www.vinkythemes.com/
 * @since       Vinky 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Vinky_Admin_Settings' ) ) {

	/**
	 * Vinky Admin Settings
	 */
	class Vinky_Admin_Settings {

		/**
		 * Menu page title
		 *
		 * @since 1.0
		 * @var string $menu_page_title
		 */
		public static $menu_page_title;

		/**
		 * Page title
		 *
		 * @since 1.0
		 * @var array $page_title
		 */
		public static $page_title = 'Vinky';

		/**
		 * Plugin slug
		 *
		 * @since 1.0
		 * @var array $plugin_slug
		 */
		public static $plugin_slug = 'vinky';

		/**
		 * Default Menu position
		 *
		 * @since 1.0
		 * @var array $default_menu_position
		 */
		public static $default_menu_position = 'themes.php';

		/**
		 * Current Slug
		 *
		 * @since 1.0
		 * @var array $current_slug
		 */
		public static $current_slug = 'general';

		/**
		 * Constructor
		 */
		public function __construct() {

			if ( ! is_admin() ) {
				return;
			}

			add_action( 'after_setup_theme', __CLASS__ . '::init_admin_settings', 99 );
		}

		/**
		 * Admin settings init
		 */
		public static function init_admin_settings() {
			self::$menu_page_title = apply_filters( 'vinky_menu_page_title', __( 'Vinky Options', 'vinky' ) );
			self::$page_title      = apply_filters( 'vinky_page_title', __( 'Vinky', 'vinky' ) );
			self::$plugin_slug     = self::get_theme_page_slug();

			add_action( 'admin_enqueue_scripts', __CLASS__ . '::enqueue_styles' );
			add_action( 'admin_enqueue_scripts', __CLASS__ . '::register_scripts' );

			if ( ! is_customize_preview() ) {
				add_action( 'admin_enqueue_scripts', __CLASS__ . '::admin_submenu_css' );
			}

			$requested_page = isset( $_REQUEST['page'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['page'] ) ) : '';// phpcs:ignore WordPress.Security.NonceVerification.Recommended

			if ( strpos( $requested_page, self::$plugin_slug ) !== false ) {

				add_action( 'admin_enqueue_scripts', __CLASS__ . '::enqueue_scripts' );

				// Let extensions hook into saving.
				do_action( 'vinky_admin_settings_scripts' );

				if ( defined( 'VINKY_EXT_VER' ) && version_compare( VINKY_EXT_VER, '2.5.0', '<' ) ) {
					self::save_settings();
				}
			}

			add_action( 'admin_menu', __CLASS__ . '::add_admin_menu', 99 );

			add_action( 'vinky_menu_general_action', __CLASS__ . '::general_page' );

			add_action( 'vinky_header_right_section', __CLASS__ . '::top_header_right_section' );

			add_action( 'vinky_welcome_page_right_sidebar_content', __CLASS__ . '::vinky_welcome_page_knowledge_base_section', 11 );
			add_action( 'vinky_welcome_page_right_sidebar_content', __CLASS__ . '::vinky_welcome_page_community_section', 12 );
			add_action( 'vinky_welcome_page_right_sidebar_content', __CLASS__ . '::vinky_welcome_page_five_star_section', 13 );

			add_action( 'vinky_welcome_page_content', __CLASS__ . '::vinky_welcome_page_content' );
			add_action( 'vinky_welcome_page_content', __class__ . '::vinky_available_plugins', 30 );

			// AJAX.
			add_action( 'wp_ajax_vinky-sites-plugin-activate', __CLASS__ . '::required_plugin_activate' );
			add_action( 'wp_ajax_vinky-sites-plugin-deactivate', __CLASS__ . '::required_plugin_deactivate' );

			add_action( 'admin_notices', __CLASS__ . '::register_notices' );
			add_action( 'vinky_notice_before_markup', __CLASS__ . '::notice_assets' );
		}

		/**
		 * Save All admin settings here
		 */
		public static function save_settings() {

			// Only admins can save settings.
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			// Let extensions hook into saving.
			do_action( 'vinky_admin_settings_save' );
		}

		/**
		 * Theme options page Slug getter including White Label string.
		 *
		 * @return string Theme Options Page Slug.
		 * @since 1.0.0
		 */
		public static function get_theme_page_slug() {
			return apply_filters( 'vinky_theme_page_slug', self::$plugin_slug );
		}

		/**
		 * Ask Theme Rating
		 *
		 * @since 1.0.0
		 */
		public static function register_notices() {
			// Force Vinky welcome notice on theme activation.
			if ( current_user_can( 'install_plugins' ) && ! defined( 'VINKY_SITES_NAME' ) && '1' === get_option( 'fresh_site' ) ) {

				wp_enqueue_script( 'vinky-admin-settings' );
				$image_path           = get_theme_file_uri( 'inc/assets/images/vinky-logo.svg' );
				$vky_sites_notice_btn = array();

				$vky_sites_notice_btn['button_text'] = __( 'Import Layout', 'vinky' );
				$vky_sites_notice_btn['link']        = 'edit.php?post_type=vky_templates';
				$vky_sites_notice_btn['class']      .= ' button button-primary';

				$vinky_sites_notice_args = array(
					'id'                         => 'vinky-sites-on-active',
					'type'                       => 'info',
					'message'                    => sprintf(
						'<div class="notice-image">
							<img src="%1$s" class="custom-logo" alt="Vinky" itemprop="logo"></div>
							<div class="notice-content">
								<h2 class="notice-heading">
									%2$s
								</h2>
								<p>%3$s</p>
								<div class="vinky-review-notice-container">
									<a class="%4$s" %5$s>%6$s</a>
								</div>
							</div>',
						$image_path,
						__( 'Thank you for installing Vinky!', 'vinky' ),
						__( 'Vinky provides dozens of <a href="https://www.vinkythemes.com/pre-made">pre-made layout</a> to build your website faster. Import your favorite site or a specific page from the layout packs.', 'vinky' ),
						esc_attr( $vky_sites_notice_btn['class'] ),
						'href="' . vinky_get_prop( $vky_sites_notice_btn, 'link', '' ) . '"',
						esc_html( $vky_sites_notice_btn['button_text'] )
					),
					'priority'                   => 5,
					'display-with-other-notices' => false,
					'show_if'                    => true,
				);

				Vinky_Notices::add_notice(
					$vinky_sites_notice_args
				);
			}
		}

		/**
		 * Enqueue Vinky Notices CSS.
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public static function notice_assets() {
			wp_enqueue_style( 'vinky-notices', get_theme_file_uri( 'inc/assets/css/vinky-notices.css' ), array(), wp_get_theme()->get( 'Version' ) );
			wp_style_add_data( 'vinky-notices', 'rtl', 'replace' );
		}

		/**
		 * Register admin scripts.
		 *
		 * @param String $hook Screen name where the hook is fired.
		 *
		 * @return void
		 */
		public static function register_scripts( $hook ) {
			/**
			 * Filters the Admin JavaScript handles added
			 *
			 * @param array array of the javascript handles.
			 *
			 * @since v1.4.10
			 */
			$js_handle = apply_filters(
				'vinky_admin_script_handles',
				array(
					'jquery',
					'wp-color-picker',
				)
			);

			// Add customize-base handle only for the Customizer Preview Screen.
			if ( true === is_customize_preview() ) {
				$js_handle[] = 'customize-base';
			}

			if ( in_array(
				$hook,
				array(
					'post.php',
					'post-new.php',
				),
				true
			) ) {
				$post_types = get_post_types( array( 'public' => true ) );
				$screen     = get_current_screen();
				$post_type  = $screen->id;

				if ( in_array( $post_type, (array) $post_types, true ) ) {

					echo '<style class="vinky-meta-box-style">
						.block-editor-page #side-sortables #vinky_settings_meta_box select { min-width: 84%; padding: 3px 24px 3px 8px; height: 20px; }
						.block-editor-page #normal-sortables #vinky_settings_meta_box select { min-width: 200px; }
						.block-editor-page .edit-post-meta-boxes-area #poststuff #vinky_settings_meta_box h2.hndle { border-bottom: 0; }
						.block-editor-page #vinky_settings_meta_box .component-base-control__field, .block-editor-page #vinky_settings_meta_box .block-editor-page .transparent-header-wrapper, .block-editor-page #vinky_settings_meta_box .adv-header-wrapper, .block-editor-page #vinky_settings_meta_box .stick-header-wrapper, .block-editor-page #vinky_settings_meta_box .disable-section-meta div { margin-bottom: 8px; }
						.block-editor-page #vinky_settings_meta_box .disable-section-meta div label { vertical-align: inherit; }
						.block-editor-page #vinky_settings_meta_box .post-attributes-label-wrapper { margin-bottom: 4px; }
						#side-sortables #vinky_settings_meta_box select { min-width: 100%; }
						#normal-sortables #vinky_settings_meta_box select { min-width: 200px; }
					</style>';
				}
			}
			/* Add CSS for the Submenu for BSF plugins added in Appearance Menu */

			if ( ! is_customize_preview() ) {
				self::enqueue_scripts();
			}
		}

		/**
		 * Enqueues the needed CSS/JS for the builder's admin settings page.
		 *
		 * @since 1.0
		 */
		public static function enqueue_styles() {
			wp_enqueue_style( 'vinky-admin-settings', get_theme_file_uri( 'inc/assets/css/vinky-admin-menu-settings.css' ), array(), wp_get_theme()->get( 'Version' ) );
			wp_style_add_data( 'vinky-admin-settings', 'rtl', 'replace' );
		}

		/**
		 * Enqueues scripts to use in admin pages.
		 *
		 * @since 1.0
		 */
		public static function enqueue_scripts() {
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			wp_register_script(
				'vinky-admin-settings',
				get_theme_file_uri( 'inc/assets/js/vinky-admin-menu-settings.js' ),
				array(
					'jquery',
					'wp-util',
					'updates',
				),
				wp_get_theme()->get( 'Version' ),
				false
			);

			$localize = array(
				'ajaxUrl'                           => admin_url( 'admin-ajax.php' ),
				'btnActivating'                     => __( 'Activating Importer Plugin ', 'vinky' ) . '&hellip;',
				'vinkySitesLink'                    => admin_url( 'themes.php?page=' ),
				'vinkySitesLinkTitle'               => __( 'See Library &#187;', 'vinky' ),
				'recommendedPluginActivatingText'   => __( 'Activating', 'vinky' ) . '&hellip;',
				'recommendedPluginDeactivatingText' => __( 'Deactivating', 'vinky' ) . '&hellip;',
				'recommendedPluginActivateText'     => __( 'Activate', 'vinky' ),
				'recommendedPluginDeactivateText'   => __( 'Deactivate', 'vinky' ),
				'recommendedPluginSettingsText'     => __( 'Settings', 'vinky' ),
				'vinkyPluginManagerNonce'           => wp_create_nonce( 'vinky-recommended-plugin-nonce' ),
			);
			wp_localize_script( 'vinky-admin-settings', 'vinky', apply_filters( 'vinky_theme_js_localize', $localize ) );

			// Script.
			wp_enqueue_script( 'vinky-admin-settings' );

			if ( ! file_exists( WP_PLUGIN_DIR . '/vinky-sites/vinky-sites.php' ) && is_plugin_inactive( 'vinky-pro-sites/vinky-pro-sites.php' ) ) {
				// For starter site plugin popup detail "Details &#187;" on Vinky Options page.
				wp_enqueue_script( 'plugin-install' );
				wp_enqueue_script( 'thickbox' );
				wp_enqueue_style( 'thickbox' );
			}
		}

		/**
		 * Get and return page URL
		 *
		 * @param string $menu_slug Menu name.
		 *
		 * @return  string page url
		 * @since 1.0
		 */
		public static function get_page_url( $menu_slug ) {

			$parent_page = self::$default_menu_position;

			if ( strpos( $parent_page, '?' ) !== false ) {
				$query_var = '&page=' . self::$plugin_slug;
			} else {
				$query_var = '?page=' . self::$plugin_slug;
			}

			$parent_page_url = admin_url( $parent_page . $query_var );

			$url = $parent_page_url . '&action=' . $menu_slug;

			return esc_url( $url );
		}

		/**
		 * Add main menu
		 *
		 * @since 1.0
		 */
		public static function add_admin_menu() {

			$page_title     = self::$page_title;
			$options_title  = $page_title . ' ' . esc_html__( 'Options', 'vinky' );
			$builder_title  = esc_html__( 'Theme Builder', 'vinky' );
			$layout_title   = esc_html__( 'Layout Packs', 'vinky' );
			$capability     = 'manage_options';
			$page_menu_slug = self::$plugin_slug . '_options';
			$page_menu_func = __CLASS__ . '::menu_callback';

			if ( apply_filters( 'vinky_dashboard_admin_menu', true ) ) {
				add_theme_page( $options_title, $options_title, $capability, $page_menu_slug, $page_menu_func );
				add_theme_page( $builder_title, $builder_title, $capability, 'edit.php?page=vky_theme_builder' );
				add_theme_page( $layout_title, $layout_title, $capability, 'edit.php?post_type=vky_templates' );
			} else {
				do_action( 'vinky_register_admin_menu', $page_title, $capability, $page_menu_slug, $page_menu_func );
			}
		}

		/**
		 * Menu callback
		 *
		 * @since 1.0
		 */
		public static function menu_callback() {

			$current_slug = isset( $_GET['action'] ) ? sanitize_text_field( wp_unslash( $_GET['action'] ) ) : self::$current_slug; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

			$current_slug      = str_replace( '-', '_', $current_slug );
			$vky_wrapper_class = apply_filters( 'vinky_welcome_wrapper_class', array( $current_slug ) );

			?>
			<div
				class="vky-menu-page-wrapper wrap vky-clear <?php echo esc_attr( implode( ' ', $vky_wrapper_class ) ); ?>">
				<?php do_action( 'vinky_menu_' . esc_attr( $current_slug ) . '_action' ); ?>
			</div>
			<?php
		}

		/**
		 * Include general page
		 *
		 * @since 1.0
		 */
		public static function general_page() {
			require_once get_template_directory() . '/inc/core/view-general.php';// phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		}

		/**
		 * Include Welcome page right side knowledge base content
		 *
		 * @since 1.0.0
		 */
		public static function vinky_welcome_page_knowledge_base_section() {
			?>

			<div class="postbox">
				<h2 class="hndle vky-normal-cursor">
					<span class="dashicons dashicons-book"></span>
					<span><?php esc_html_e( 'Knowledge Base', 'vinky' ); ?></span>
				</h2>
				<div class="inside">
					<p>
						<?php esc_html_e( 'Not sure how something works? Take a peek at the knowledge base and learn.', 'vinky' ); ?>
					</p>
					<?php
					$vinky_knowledge_base_doc_link      = apply_filters( 'vinky_knowledge_base_documentation_link', vinky_get_pro_url( 'https://www.vinkythemes.com/docs/', 'vinky-dashboard', 'visit-documentation', 'welcome-page' ) );
					$vinky_knowledge_base_doc_link_text = apply_filters( 'vinky_knowledge_base_documentation_link_text', __( 'Visit Knowledge Base &#187;', 'vinky' ) );

					printf(
						/* translators: %1$s: Vinky Knowledge doc link. */
						'%1$s',
						! empty( $vinky_knowledge_base_doc_link ) ? '<a href=' . esc_url( $vinky_knowledge_base_doc_link ) . ' target="_blank" rel="noopener">' . esc_html( $vinky_knowledge_base_doc_link_text ) . '</a>' :
							esc_html( $vinky_knowledge_base_doc_link_text )
					);
					?>
				</div>
			</div>
			<?php
		}

		/**
		 * Include Welcome page right side Vinky community content
		 *
		 * @since 1.0.0
		 */
		public static function vinky_welcome_page_community_section() {
			?>

			<div class="postbox">
				<h2 class="hndle vky-normal-cursor">
					<span class="dashicons dashicons-groups"></span>
					<span>
						<?php
						printf(
							/* translators: %1$s: Vinky Theme name. */
							esc_html__( '%1$s Community', 'vinky' ),
							esc_html( self::$page_title )
						);
						?>
				</h2>
				<div class="inside">
					<p>
						<?php
						printf(
							/* translators: %1$s: Vinky Theme name. */
							esc_html__( 'Join the community of super helpful %1$s users. Say hello, ask questions, give feedback and help each other!', 'vinky' ),
							esc_html( self::$page_title )
						);
						?>
					</p>
					<?php
					$vinky_community_group_link      = apply_filters( 'vinky_community_group_link', 'https://community.vinkythemes.com' );
					$vinky_community_group_link_text = apply_filters( 'vinky_community_group_link_text', __( 'Join Our Community &#187;', 'vinky' ) );

					printf(
						/* translators: %1$s: Vinky Knowledge doc link. */
						'%1$s',
						! empty( $vinky_community_group_link ) ? '<a href=' . esc_url( $vinky_community_group_link ) . ' target="_blank" rel="noopener">' . esc_html( $vinky_community_group_link_text ) . '</a>' :
							esc_html( $vinky_community_group_link_text )
					);
					?>
				</div>
			</div>
			<?php
		}

		/**
		 * Include Welcome page right side Five Star Support
		 *
		 * @since 1.0.0
		 */
		public static function vinky_welcome_page_five_star_section() {
			?>

			<div class="postbox">
				<h2 class="hndle vky-normal-cursor">
					<span class="dashicons dashicons-sos"></span>
					<span><?php esc_html_e( 'Five Star Support', 'vinky' ); ?></span>
				</h2>
				<div class="inside">
					<p>
						<?php
						printf(
							/* translators: %1$s: Vinky Theme name. */
							esc_html__( 'Got a question? Get in touch with %1$s developers. We\'re happy to help!', 'vinky' ),
							esc_html( self::$page_title )
						);
						?>
					</p>
					<?php
					$vinky_support_link      = apply_filters( 'vinky_support_link', vinky_get_pro_url( 'https://www.vinkythemes.com/contact/', 'vinky-dashboard', 'submit-a-ticket', 'welcome-page' ) );
					$vinky_support_link_text = apply_filters( 'vinky_support_link_text', __( 'Submit a Ticket &#187;', 'vinky' ) );

					printf(
						/* translators: %1$s: Vinky Knowledge doc link. */
						'%1$s',
						! empty( $vinky_support_link ) ? '<a href=' . esc_url( $vinky_support_link ) . ' target="_blank" rel="noopener">' . esc_html( $vinky_support_link_text ) . '</a>' :
							esc_html( $vinky_support_link_text )
					);
					?>
				</div>
			</div>
			<?php
		}

		/**
		 * Include Welcome page content
		 *
		 * @since 1.0.0
		 */
		public static function vinky_welcome_page_content() {

			// Quick settings.
			$quick_settings = apply_filters(
				'vinky_quick_settings',
				array(
					'logo-favicon' => array(
						'title'     => __( 'Upload Logo', 'vinky' ),
						'dashicon'  => 'dashicons-format-image',
						'quick_url' => admin_url( 'customize.php?autofocus[control]=custom_logo' ),
					),
					'colors'       => array(
						'title'     => __( 'Set Colors', 'vinky' ),
						'dashicon'  => 'dashicons-admin-customizer',
						'quick_url' => admin_url( 'customize.php?autofocus[section]=background-colors' ),
					),
					'typography'   => array(
						'title'     => __( 'Customize Fonts', 'vinky' ),
						'dashicon'  => 'dashicons-editor-textcolor',
						'quick_url' => admin_url( 'customize.php?autofocus[section]=typography' ),
					),
					'layout'       => array(
						'title'     => __( 'Layout Options', 'vinky' ),
						'dashicon'  => 'dashicons-layout',
						'quick_url' => admin_url( 'customize.php?autofocus[section]=general_layout' ),
					),
					'header'       => array(
						'title'     => __( 'Header Options', 'vinky' ),
						'dashicon'  => 'dashicons-align-center',
						'quick_url' => admin_url( 'customize.php?autofocus[panel]=headers' ),
					),
					'blog-layout'  => array(
						'title'     => __( 'Blog layout', 'vinky' ),
						'dashicon'  => 'dashicons-welcome-write-blog',
						'quick_url' => admin_url( 'customize.php?autofocus[section]=blog' ),
					),
					'footer'       => array(
						'title'     => __( 'Footer Settings', 'vinky' ),
						'dashicon'  => 'dashicons-admin-generic',
						'quick_url' => admin_url( 'customize.php?autofocus[section]=footers' ),
					),
					'sidebars'     => array(
						'title'     => __( 'Sidebar Options', 'vinky' ),
						'dashicon'  => 'dashicons-align-left',
						'quick_url' => admin_url( 'customize.php?autofocus[section]=sidebars' ),
					),
				)
			);
			?>
			<div class="postbox">
				<h2 class="hndle vky-normal-cursor">
					<span><?php esc_html_e( 'Links to Customizer Settings:', 'vinky' ); ?></span>
				</h2>
				<div class="vky-quick-setting-section">
					<?php
					if ( ! empty( $quick_settings ) ) :
						?>
						<div class="vky-quick-links">
							<ul class="vky-flex">
								<?php
								foreach ( (array) $quick_settings as $key => $link ) {
									echo '<li class=""><span class="dashicons ' . esc_attr( $link['dashicon'] ) . '"></span><a class="vky-quick-setting-title" href="' . esc_url( $link['quick_url'] ) . '" target="_blank" rel="noopener">' . esc_html( $link['title'] ) . '</a></li>';
								}
								?>
							</ul>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<?php
		}

		/**
		 * Include Welcome page content
		 *
		 * @since 1.0.0
		 */
		public static function vinky_available_plugins() {

			$vinky_addon_tagline = apply_filters(
				'vinky_available_plugins',
				sprintf(
					/* translators: %1s Vinky Theme */
					__( 'Extend %1s with free plugins!', 'vinky' ),
					vinky_get_theme_name()
				)
			);

			$recommended_plugins = apply_filters(
				'vinky_recommended_plugins',
				array(
					'customizer-search'    =>
						array(
							'plugin-name'        => __( 'Customizer Search', 'vinky' ),
							'plugin-init'        => 'customizer-search/customizer-search.php',
							'settings-link'      => admin_url( 'customize.php' ),
							'settings-link-text' => 'Settings',
						),

					'vinky-bulk-edit'      =>
						array(
							'plugin-name'        => __( 'Vinky Bulk Edit', 'vinky' ),
							'plugin-init'        => 'vinky-bulk-edit/vinky-bulk-edit.php',
							'settings-link'      => '',
							'settings-link-text' => 'Settings',
						),

					'vinky-widgets'        =>
						array(
							'plugin-name'        => __( 'Vinky Widgets', 'vinky' ),
							'plugin-init'        => 'vinky-widgets/vinky-widgets.php',
							'settings-link'      => admin_url( 'widgets.php' ),
							'settings-link-text' => 'Settings',
						),

					'custom-fonts'         =>
						array(
							'plugin-name'        => __( 'Custom Fonts', 'vinky' ),
							'plugin-init'        => 'custom-fonts/custom-fonts.php',
							'settings-link'      => admin_url( 'edit-tags.php?taxonomy=bsf_custom_fonts' ),
							'settings-link-text' => 'Settings',
						),

					'custom-typekit-fonts' =>
						array(
							'plugin-name'        => __( 'Custom Typekit Fonts', 'vinky' ),
							'plugin-init'        => 'custom-typekit-fonts/custom-typekit-fonts.php',
							'settings-link'      => admin_url( 'themes.php?page=custom-typekit-fonts' ),
							'settings-link-text' => 'Settings',
						),

					'sidebar-manager'      =>
						array(
							'plugin-name'        => __( 'Sidebar Manager', 'vinky' ),
							'plugin-init'        => 'sidebar-manager/sidebar-manager.php',
							'settings-link'      => admin_url( 'edit.php?post_type=bsf-sidebar' ),
							'settings-link-text' => 'Settings',
						),
				)
			);

			if ( apply_filters( 'vinky_show_free_extend_plugins', true ) ) {
				?>

				<div class="postbox">
					<h2 class="hndle vky-normal-cursor vky-addon-heading vky-flex">
						<span><?php echo esc_html( $vinky_addon_tagline ); ?></span>
					</h2>
					<div class="vky-addon-list-section">
						<?php
						if ( ! empty( $recommended_plugins ) ) :
							?>
							<div>
								<ul class="vky-addon-list">
									<?php
									foreach ( $recommended_plugins as $slug => $plugin ) {

										// If display condition for the plugin does not meet, skip the plugin from displaying.
										if ( isset( $plugin['display'] ) && false === $plugin['display'] ) {
											continue;
										}

										$plugin_active_status = '';
										if ( is_plugin_active( $plugin['plugin-init'] ) ) {
											$plugin_active_status = ' active';
										}

										echo '<li ' . esc_attr(
											vinky_attr(
												'vinky-recommended-plugin-' . esc_attr( $slug ),
												array(
													'id' => esc_attr( $slug ),
													'class' => 'vinky-recommended-plugin' . $plugin_active_status,
													'data-slug' => $slug,
												)
											)
										) . '>';

										echo '<a href="' . esc_url( self::build_wrong_plugin_link( $slug ) ) . '" target="_blank">';
										echo esc_html( $plugin['plugin-name'] );
										echo '</a>';

										echo '<div class="vky-addon-link-wrapper">';

										if ( ! is_plugin_active( $plugin['plugin-init'] ) ) {

											if ( file_exists( WP_CONTENT_DIR . '/plugins/' . $plugin['plugin-init'] ) ) {
												echo '<a ' . esc_attr(
													vinky_attr(
														'vinky-activate-recommended-plugin',
														array(
															'data-slug'               => $slug,
															'href'                    => '#',
															'data-init'               => $plugin['plugin-init'],
															'data-settings-link'      => esc_url( $plugin['settings-link'] ),
															'data-settings-link-text' => $plugin['settings-link-text'],
														)
													)
												) . '>';

												esc_html_e( 'Activate', 'vinky' );

												echo '</a>';

											} else {

												echo sprintf(
													'<a %s>',
													esc_attr(
														vinky_attr(
															'vinky-install-recommended-plugin',
															array(
																'data-slug'               => $slug,
																'href'                    => '#',
																'data-init'               => $plugin['plugin-init'],
																'data-settings-link'      => esc_url( $plugin['settings-link'] ),
																'data-settings-link-text' => $plugin['settings-link-text'],
															)
														)
													)
												);

												esc_html_e( 'Activate', 'vinky' );

												echo '</a>';
											}
										} else {

											echo sprintf(
												'<a %s>',
												esc_attr(
													vinky_attr(
														'vinky-deactivate-recommended-plugin',
														array(
															'data-slug'               => $slug,
															'href'                    => '#',
															'data-init'               => $plugin['plugin-init'],
															'data-settings-link'      => esc_url( $plugin['settings-link'] ),
															'data-settings-link-text' => $plugin['settings-link-text'],
														)
													)
												)
											);

											esc_html_e( 'Deactivate', 'vinky' );

											echo '</a>';

											if ( '' !== $plugin['settings-link'] ) {

												echo sprintf(
													'<a %s>',
													esc_attr(
														vinky_attr(
															'vinky-recommended-plugin-links',
															array(
																'data-slug' => $slug,
																'href'      => $plugin['settings-link'],
															)
														)
													)
												);

												echo esc_html( $plugin['settings-link-text'] );

												echo '</a>';
											}
										}

										echo '</div>';

										echo '</li>';
									}
									?>
								</ul>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<?php
			}

		}

		/**
		 * Build plugin's page URL on WordPress.org
		 * https://wordpress.org/plugins/{plugin-slug}
		 *
		 * @param String $slug plugin slug.
		 *
		 * @return String Plugin URL on WordPress.org
		 * @since 1.0.0
		 */
		private static function build_wrong_plugin_link( $slug ) {
			return esc_url( trailingslashit( 'https://wordpress.org/plugins/' . $slug ) );
		}

		/**
		 * Required Plugin Activate
		 *
		 * @since 1.0.0
		 */
		public static function required_plugin_activate() {
			self::check_wp_nounce();

			// Nothing to do.
		}

		/**
		 * Required Plugin Activate
		 *
		 * @since 1.0.0
		 */
		public static function required_plugin_deactivate() {

			self::check_wp_nounce();

			// phpcs:disable
			$plugin_init = isset( $_POST['init'] ) ? sanitize_text_field( wp_unslash( $_POST['init'] ) ) : '';

			// phpcs:enable
			deactivate_plugins( $plugin_init, '', false );

			wp_send_json_success(
				array(
					'success' => true,
					'message' => __( 'Plugin Successfully Deactivated', 'vinky' ),
				)
			);

		}

		/**
		 * Check WordPress Nounce before activating/deactivating required plugins.
		 */
		public static function check_wp_nounce() {
			$nonce = ( isset( $_POST['nonce'] ) ) ? sanitize_key( $_POST['nonce'] ) : '';

			if ( false === wp_verify_nonce( $nonce, 'vinky-recommended-plugin-nonce' ) ) {
				wp_send_json_error( esc_html( __( 'WordPress Nonce not validated.', 'vinky' ) ) );
			}

			if ( ! current_user_can( 'install_plugins' ) || ! isset( $_POST['init'] ) || ! sanitize_text_field( wp_unslash( $_POST['init'] ) ) ) {
				wp_send_json_error(
					array(
						'success' => false,
						'message' => __( 'No plugin specified', 'vinky' ),
					)
				);
			}
		}

		/**
		 * Vinky Header Right Section Links
		 *
		 * @since 1.0.0
		 */
		public static function top_header_right_section() {

			$top_links = apply_filters(
				'vinky_header_top_links',
				array(
					'vinky-theme-info' => array(
						'title' => __( 'Fast & Fully Customizable WordPress theme!', 'vinky' ),
					),
				)
			);

			if ( ! empty( $top_links ) ) {
				?>
				<div class="vky-top-links">
					<ul>
						<?php
						foreach ( (array) $top_links as $key => $info ) {
							/* translators: %1$s: Top Link URL wrapper, %2$s: Top Link URL, %3$s: Top Link URL target attribute */
							printf(
								'<li><%1$s %2$s %3$s > %4$s </%1$s>',
								isset( $info['url'] ) ? 'a' : 'span',
								isset( $info['url'] ) ? 'href="' . esc_url( $info['url'] ) . '"' : '', // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								isset( $info['url'] ) ? 'target="_blank" rel="noopener"' : '', // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								$info['title']// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							);
						}
						?>
					</ul>
				</div>
				<?php
			}
		}

		/**
		 * Add custom CSS for admin area sub menu icons.
		 *
		 * @since 1.0.0
		 */
		public static function admin_submenu_css() {
			?>
			<style class="vinky-menu-appearance-style">
				#menu-appearance a[href^="edit.php?post_type=vinky-"]:before,
				#menu-appearance a[href^="themes.php?page=vinky-"]:before,
				#menu-appearance a[href^="edit.php?post_type=vinky_"]:before,
				#menu-appearance a[href^="edit-tags.php?taxonomy=bsf_custom_fonts"]:before,
				#menu-appearance a[href^="themes.php?page=custom-typekit-fonts"]:before,
				#menu-appearance a[href^="edit.php?post_type=bsf-sidebar"]:before {
					content: "\21B3";
					margin-right: 0.5em;
					opacity: 0.5;
				}
			</style>
			<?php
		}
	}

	new Vinky_Admin_Settings();
}
