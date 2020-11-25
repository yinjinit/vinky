<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Vinky
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<?php if ( vinky_page_layout() === 'left-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

	<div id="primary" class="content-area">

		<?php
		if ( apply_filters( 'vinky_the_title_enabled', true ) ) {

			if ( is_category() ) {
				?>

				<section class="vky-archive-description">
					<h1 class="page-title vky-archive-title"><?php echo single_cat_title(); ?></h1>
					<?php echo wp_kses_post( wpautop( get_the_archive_description() ) ); ?>
				</section>

				<?php

				// Tag.
			} elseif ( is_tag() ) {
				?>

				<section class="vky-archive-description">
					<h1 class="page-title vky-archive-title"><?php echo single_tag_title(); ?></h1>
					<?php echo wp_kses_post( wpautop( get_the_archive_description() ) ); ?>
				</section>

				<?php
			} else {
				?>

				<section class="vky-archive-description">
					<?php the_archive_title( '<h1 class="page-title vky-archive-title">', '</h1>' ); ?>
					<?php echo wp_kses_post( wpautop( get_the_archive_description() ) ); ?>
				</section>

				<?php
			}
		}
		?>

		<?php
		if ( have_posts() ) :

			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content/content-excerpt' );

			endwhile;

		else :

			get_template_part( 'template-parts/content/content-none' );

		endif;
		?>

	</div><!-- #primary -->

<?php if ( vinky_page_layout() === 'right-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer(); ?>
