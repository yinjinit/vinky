<?php
/**
 * The template for displaying archive pages
 *
 * @link       https://codex.wordpress.org/Template_Hierarchy
 *
 * @package    WordPress
 * @subpackage Twenty_Seventeen
 * @since      1.0
 * @version    1.0
 */

get_header();

$wpdm_category = get_queried_object();

$icon = \WPDM\libs\CategoryHandler::icon( $wpdm_category->term_id ); // phpcs:ignore

if ( '' !== $icon ) { ?>
	<style>
		.page-header {
			background-image: url('<?php echo esc_url( $icon ); ?>');
		}
	</style>
<?php } ?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main">
			<header class="page-header">
				<div class="container">
					<h1 class="page-title"><?php echo single_cat_title( '', false ); ?></h1>
				</div>
			</header>

			<?php if ( have_posts() ) : ?>

				<div class="vky-forms-header">
					<div class="container flex justify-content-end">
						<div class="vky-forms-pagination">
							<?php vinky_pagination(); ?>
						</div>
					</div>
				</div>

				<div class="vky-forms-archive">
					<div class="container">
						<ul class="flex">
							<?php
							while ( have_posts() ) {
								the_post();
								?>

								<li class="vky-form-item clearfix">
									<div class="entry-wrapper">
										<div class="entry-content">
											<a href="<?php the_permalink(); ?>" class="entry-title">
												<i class="vky-icon vky-icon-form"></i>
												<span><?php the_title(); ?></span>
											</a>
											<div class="entry-excerpt"><?php the_excerpt(); ?></div>
										</div>
										<div class="entry-footer flex justify-content-end">
											<?php
											$pack         = new \WPDM\Package(); // phpcs:ignore
											$download_url = $pack->getDownloadURL( get_the_ID(), '' );
											$files        = $pack->getFiles( get_the_ID() );

											$attach_url = '';

											if ( ! empty( $files ) ) {
												$upload_dir = wp_upload_dir();

												$attach_url = rtrim( $upload_dir['baseurl'], '/' ) . '/download-manager-files/' . $files[0];
											}

											?>
											<a class="button-download" rel="nofollow" href="javascript:;" onclick="location.href='<?php echo esc_url( $download_url ); ?>';return false;">
												<i class="vky-icon vky-icon-download"></i><?php echo esc_html__( 'Download', 'vinky' ); ?>
											</a>
											<a class="button-view" href="<?php echo esc_url( $attach_url ); ?>">
												<i class="vky-icon vky-icon-view"></i><?php echo esc_html__( 'View', 'vinky' ); ?>
											</a>

											<a class="button-details" href="<?php the_permalink(); ?>">
												<i class="vky-icon  vky-icon-search"></i><?php echo esc_html__( 'Details', 'vinky' ); ?>
											</a>
										</div>
									</div>
								</li>

								<?php
							}
							?>
						</ul>

						<?php vinky_pagination_button(); ?>
					</div>
				</div>

				<div class="vky-forms-footer">
					<div class="container flex justify-content-end">
						<div class="vky-forms-pagination">
							<?php vinky_pagination(); ?>
						</div>
					</div>
				</div>

				<?php
			else :

				echo '<p>' . esc_html__( 'Not found.', 'vinky' ) . '</p>';

			endif;
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
