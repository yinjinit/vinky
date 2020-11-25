<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Vinky
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

</div><!-- #content -->

<footer id="colophon" class="site-footer" role="contentinfo">

	<?php
	get_template_part( 'template-parts/footer/footer-widgets' );
	get_template_part( 'template-parts/footer/footer-bottom' );
	?>

</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
