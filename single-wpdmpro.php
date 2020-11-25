<?php
/**
 * The template for displaying all single form
 *
 * @link       https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package    WordPress
 * @subpackage Vinky
 * @since      1.0.0
 */

get_header();

/* Start the Loop */
while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/content/content-wpdmpro' );

endwhile; // End of the loop.

get_footer();
