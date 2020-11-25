<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Vinky
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$sidebar = apply_filters( 'vinky_get_sidebar', 'sidebar-1' );

echo '<div ';
	echo vinky_attr(
		'sidebar',
		array(
			'id'    => 'secondary',
			'class' => join( ' ', vinky_get_secondary_class() ),
			'role'  => 'complementary',
		)
	);
	echo '>';
	?>

	<div class="sidebar-main" <?php echo apply_filters( 'vinky_sidebar_data_attrs', '', $sidebar ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>

		<?php do_action( 'vinky_sidebars_before' ); ?>

		<?php if ( is_active_sidebar( $sidebar ) ) : ?>

			<?php dynamic_sidebar( $sidebar ); ?>

		<?php endif; ?>

		<?php do_action( 'vinky_sidebars_after' ); ?>

	</div><!-- .sidebar-main -->
</div><!-- #secondary -->
