<?php
/**
 * Template for Blog
 *
 * @package     Vinky
 * @author      Vinky
 * @copyright   Copyright (c) 2020, Vinky
 * @link        https://www.vinkythemes.com/
 * @since 1.0.0
 */

?>
<div>

	<div class="post-content vky-col-md-12">

		<?php?>

		<div class="entry-content clear"
			<?php
				echo vinky_attr(
					'article-entry-content-blog-layout',
					array(
						'class' => '',
					)
				);
				?>
		>

			<?php do_action( 'vinky_entry_content_before' ); ?>

			<?php vinky_the_excerpt(); ?>

			<?php do_action( 'vinky_entry_content_after' ); ?>

			<?php
				wp_link_pages(
					array(
						'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'vinky' ),
						'after'       => '</div>',
						'link_before' => '<span class="page-link">',
						'link_after'  => '</span>',
					)
				);
				?>
		</div><!-- .entry-content -->
	</div><!-- .post-content -->

</div> <!-- .blog-layout-1 -->
