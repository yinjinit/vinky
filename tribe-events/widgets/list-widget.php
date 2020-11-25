<?php
/**
 * Events List Widget Template
 * This is the template for the output of the events list widget.
 * All the items are turned on and off through the widget admin.
 * There is currently no default styling, which is needed.
 *
 * Overridden the /views/widgets/list-widget.php.
 *
 * @return string
 *
 * @version 4.5.13
 * @package TribeEventsCalendar
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_plural           = tribe_get_event_label_plural();
$events_label_plural_lowercase = tribe_get_event_label_plural_lowercase();

$event_posts = tribe_get_list_widget_events();

// Check if any event posts are found.
if ( $event_posts ) : ?>

	<ol class="tribe-list-widget">
		<?php
		// Setup the post data for each event.
		foreach ( $event_posts as $event_post ) {
			setup_postdata( $event_post );
			?>
			<li class="tribe-events-list-widget-events <?php tribe_events_event_classes(); ?>">
				<?php
				/**
				 * Fire an action before the list widget featured image
				 */
				do_action( 'tribe_events_list_widget_before_the_event_image' );

				/**
				 * Allow the default post thumbnail size to be filtered
				 *
				 * @param $size
				 */
				$thumbnail_size = apply_filters( 'tribe_events_list_widget_thumbnail_size', array( 57, 57 ) );

				/**
				 * Filters whether the featured image link should be added to the Events List Widget
				 *
				 * @param bool $featured_image_link Whether the featured image link should be added or not
				 *
				 * @since 4.5.13
				 */
				$featured_image_link = apply_filters( 'tribe_events_list_widget_featured_image_link', true );
				$post_thumbnail      = get_the_post_thumbnail( $event_post, $thumbnail_size );

				if ( $featured_image_link ) {
					$post_thumbnail = '<a href="' . esc_url( tribe_get_event_link() ) . '">' . $post_thumbnail . '</a>';
				}
				?>
				<div class="tribe-event-image">
					<?php
					echo $post_thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					?>
				</div>
				<?php

				/**
				 * Fire an action after the list widget featured image
				 */
				do_action( 'tribe_events_list_widget_after_the_event_image' );
				?>

				<div class="tribe-event-content">
					<?php do_action( 'tribe_events_list_widget_before_the_event_title' ); ?>
					<!-- Event Title -->
					<a class="tribe-event-title" href="<?php echo esc_url( tribe_get_event_link() ); ?>" rel="bookmark"><?php echo esc_html( get_the_title( $event_post ) ); ?></a>

					<?php do_action( 'tribe_events_list_widget_after_the_event_title' ); ?>
					<!-- Event Time -->

					<div class="tribe-event-excerpt">
						<?php echo esc_html( get_the_excerpt( $event_post ) ); ?>
					</div>

					<?php do_action( 'tribe_events_list_widget_before_the_meta' ); ?>

					<div class="tribe-event-duration">
						<?php
						echo tribe_events_event_schedule_details(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						?>
					</div>

				</div>

				<?php do_action( 'tribe_events_list_widget_after_the_meta' ); ?>

			</li>

			<?php
		}
		?>
	</ol><!-- .tribe-list-widget -->

	<p class="tribe-events-widget-link">
		<a href="<?php echo esc_url( tribe_get_events_link() ); ?>" rel="bookmark"><?php printf( 'View All %s', esc_html( $events_label_plural ) ); ?></a>
	</p>

	<?php
else :
	?>
	<p><?php printf( 'There are no upcoming %s at this time.', esc_html( $events_label_plural_lowercase ) ); ?></p>
	<?php
endif;
