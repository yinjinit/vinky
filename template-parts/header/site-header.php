<?php
/**
 * Displays the site header.
 *
 * @package    WordPress
 * @subpackage Twenty_Twenty_One
 * @since      1.0.0
 */

$wrapper_classes   = array();
$wrapper_classes[] = 'site-header';

if ( has_custom_logo() ) {
	$wrapper_classes[] = 'has-logo';
}

if ( has_nav_menu( 'primary' ) ) {
	$wrapper_classes[] = 'has-menu';
}

$is_full_width = vinky_get_setting( 'primary_nav_full_width' );
?>

<header id="masthead"
	class="<?php esc_attr( join( ' ', $wrapper_classes ) ); ?>"
	role="banner">
	<div class="<?php echo $is_full_width ? 'container-fluid' : 'container'; ?>">
		<?php get_template_part( 'template-parts/header/site-branding' ); ?>
		<?php get_template_part( 'template-parts/header/site-nav' ); ?>
	</div>
</header><!-- #masthead -->
