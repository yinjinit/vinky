<?php
/**
 * Template for 404
 *
 * @package     Vinky
 * @author      Vinky
 * @copyright   Copyright (c) 2020, Vinky
 * @link        https://www.vinky.com/
 * @since 1.0.0
 */

?>
<div class="vky-404-layout-1">

	<?php vinky_the_title( '<header class="page-header"><h1 class="page-title">', '</h1></header><!-- .page-header -->' ); ?>

	<div class="page-content">

		<div class="page-sub-title">
			<?php esc_html_e( 'It looks like the link pointing here was faulty. Maybe try searching?', 'vinky' ); ?>
		</div>

		<div class="vky-404-search">
			<?php the_widget( 'WP_Widget_Search' ); ?>
		</div>

	</div><!-- .page-content -->
</div>
