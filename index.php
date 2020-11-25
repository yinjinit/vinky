<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Vinky
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

$bg_img = vinky_get_setting( 'post_background_image' );

if ( '' !== $bg_img ) { ?>
	<style>
		.page-header {
			background-image: url('<?php echo esc_url( $bg_img ); ?>');
		}
	</style>
<?php } ?>

<div id="primary" class="content-area">

	<main id="main" class="site-main">

		<header class="page-header">
			<div class="container">
				<h1 class="page-title"><?php esc_html_e( 'News', 'vinky' ); ?></h1>
			</div>
		</header>

		<div class="post-archive">
			<div class="container">
				<div class="row">
					<div class="content-wrapper col-auto">
						<?php
						if ( have_posts() ) {
							while ( have_posts() ) {
								the_post();
								get_template_part( 'template-parts/content/content' );
							}
						} else {
							get_template_part( 'template-parts/content/content-none' );
						}
						?>
					</div>
					<div class="sidebar col">
						<?php
						if ( is_active_sidebar( 'main-sidebar' ) ) {
							dynamic_sidebar( 'main-sidebar' );
						}
						?>
					</div>
				</div>
			</div>
		</div>

		<footer class="page-footer">
			<div class="container flex justify-content-end">
				<?php vinky_pagination(); ?>
			</div>
		</footer>

	</main><!-- #main -->

</div><!-- #primary -->

<?php get_footer(); ?>
