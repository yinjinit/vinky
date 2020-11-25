<?php
/**
 * The template for displaying all single posts
 *
 * @link       https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package    WordPress
 * @subpackage Vinky
 * @since      1.0.0
 */

get_header();

$bg_img = vinky_get_setting( 'post_background_image' );

if ( '' !== $bg_img ) {
	?>
	<style>
		.page-header {
			background-image: url('<?php echo esc_url( $bg_img ); ?>');
		}
	</style>
	<?php
}
?>

	<header class="page-header">
		<div class="container">
			<h1 class="page-title"><?php esc_html_e( 'News', 'vinky' ); ?></h1>
		</div>
	</header>

	<div class="post-single">
		<div class="container">
			<div class="row">
				<div class="content-wrapper col-auto">

					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content/content-single' );

						if ( is_singular( 'attachment' ) ) {
							// Parent post navigation.
							the_post_navigation(
								array(
									/* translators: %s: parent post link */
									'prev_text' => sprintf( __( '<span class="meta-nav">Published in</span><span class="post-title">%s</span>', 'vinky' ), '%title' ),
								)
							);
						}

					endwhile; // End of the loop.
					?>
				</div><!-- content-area -->
				<div class="sidebar col">
					<?php
					if ( is_active_sidebar( 'main-sidebar' ) ) {
						dynamic_sidebar( 'main-sidebar' );
					}
					?>
				</div><!-- .sidebar -->
			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- .single -->

	<footer class="page-footer">
		<div class="container">
			<?php
			$r = new WP_Query(
				array(
					'posts_per_page'      => 4,
					'no_found_rows'       => true,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true,
				)
			);

			if ( ! $r->have_posts() ) {
				return;
			}
			?>

			<div class="latest-news">
				<h2 class="latest-news-title"><?php esc_html_e( 'The Latest News', 'vinky' ); ?></h2>

				<ul class="latest-news-list">
					<?php foreach ( $r->posts as $recent_post ) : ?>
						<li class="flex align-items-start">
							<div class="entry-wrapper">
								<div class="entry-thumbnail">
									<?php echo get_the_post_thumbnail( $recent_post->ID, array( 57, 57 ) ); ?>
								</div>
								<div class="entry-content">
									<a class="entry-title" href="<?php the_permalink( $recent_post->ID ); ?>"><?php echo esc_html( get_the_title( $recent_post->ID ) ); ?></a>
									<div class="entry-excerpt">
										<?php the_excerpt(); ?>
									</div>
									<div class="entry-meta">
										<?php vinky_entry_meta(); ?>
									</div>
								</div>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
			</div><!-- .latest-news -->
		</div><!-- .container -->
	</footer>

<?php
get_footer();
