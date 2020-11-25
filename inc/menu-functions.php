<?php
/**
 * Functions and filters related to the menus.
 *
 * Makes the default WordPress navigation use an HTML structure similar
 * to the Navigation block.
 *
 * @link       https://make.wordpress.org/themes/2020/07/06/printing-navigation-block-html-from-a-legacy-menu-in-themes/
 *
 * @package    WordPress
 * @subpackage Vinky
 * @since      1.0.0
 */

/**
 * Add a toggle icon to sub-menu items that has sub-menus.
 * An icon is added using CSS depending on the value of aria-expanded.
 *
 * @param string   $title The menu item's title.
 * @param WP_Post  $item  The current menu item.
 * @param stdClass $args  An object of wp_nav_menu() arguments.
 *
 * @return string Nav menu item start element.
 * @since 1.0.0
 */
function vinky_add_sub_menu_toggle_icon( $title, $item, $args ) {
	if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {
		$title .= '<i class="vky-icon vky-icon-add"></i>';
	}

	return $title;
}

add_filter( 'nav_menu_item_title', 'vinky_add_sub_menu_toggle_icon', 10, 3 );

/**
 * Displays SVG icons in the footer navigation.
 *
 * @param string   $title The menu item's starting HTML output.
 * @param WP_Post  $item  Menu item data object.
 * @param stdClass $args  An object of wp_nav_menu() arguments.
 *
 * @return string The menu item output with social icon.
 */
function vinky_nav_menu_social_icons( $title, $item, $args ) {
	// Change text inside social links menu if there is supported URL.
	if ( 'social' === $args->theme_location ) {
		$socials = array( 'facebook', 'twitter', 'linkedin', 'youtube' );

		foreach ( $socials as $social ) {
			if ( false !== strpos( $item->url, $social ) ) {
				$title = '<i class="vky-icon vky-icon-' . $social . '"></i><span class="screen-reader-text">' . $title . '</span>';
			}
		}
	}

	return $title;
}

add_filter( 'nav_menu_item_title', 'vinky_nav_menu_social_icons', 10, 3 );

if ( ! function_exists( 'vinky_primary_nav_last_item' ) ) :

	/**
	 * Header Custom Menu Item
	 *
	 * @param array $items Nav menu item array.
	 * @param array $args  Nav menu item arguments array.
	 *
	 * @return array       Modified menu item array.
	 * @since 1.0.0
	 */
	function vinky_primary_nav_last_item( $items, $args ) {

		if (
			isset( $args->theme_location ) &&
			'primary' === $args->theme_location &&
			'' !== vinky_get_setting( 'primary_nav_last_item' ) &&
			! vinky_get_setting( 'take_last_item_outside' )
		) {
			$markup = vinky_get_primary_nav_last_item();

			if ( $markup ) {
				$items .= '<li class="menu-item menu-item-last">' . $markup . '</li>';
			}
		}

		return $items;
	}

	add_filter( 'wp_nav_menu_items', 'vinky_primary_nav_last_item', 10, 2 );

endif;

/**
 * Header Custom Menu Item
 */
if ( ! function_exists( 'vinky_get_primary_nav_last_item' ) ) :

	/**
	 * Last Menu Item Markup
	 *
	 * @since 1.0.0
	 */
	function vinky_get_primary_nav_last_item() {

		$last_item = vinky_get_setting( 'primary_nav_last_item' );

		ob_start();
		?>

		<div class="menu-extra menu-extra-<?php echo esc_attr( $last_item ); ?>">

			<?php
			if ( 'mega-menu' === $last_item ) {
				get_template_part( 'template-parts/mega-menu/mega-menu' );
			} else {
				get_template_part( 'template-parts/header/header', $last_item );
			}
			?>

		</div>

		<?php
		$markup = ob_get_clean();

		return apply_filters( 'vinky_get_primary_nav_last_item_markup', $markup );
	}

endif;
