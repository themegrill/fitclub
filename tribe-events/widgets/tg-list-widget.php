<?php
/**
 * Events List Widget Template
 * This is the template for the output of the events list widget.
 * All the items are turned on and off through the widget admin.
 * There is currently no default styling, which is needed.
 *
 * This view contains the filters required to create an effective events list widget view.
 *
 * This overrides the default view of The Events Calendar plugin.
 *
 * @return string
 *
 * @package TribeEventsCalendar
 * @subpackage FitClub
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>
<?php
$events_label_plural = tribe_get_event_label_plural();

$posts = apply_filters( 'tg_tribe_get_list_widget_events', TG_Tribe__Events__List_Widget::$posts );

// Check if any event posts are found.
if ( $posts ) : ?>
	<div class="tg-events">
	<ol class="hfeed vcalendar tg-events-wrapper">
		<?php
		// Setup the post data for each event.
		foreach ( $posts as $post ) :
			setup_postdata( $post );
			?>
			<li class="tribe-events-list-widget-events <?php tribe_events_event_classes() ?>">

				<?php do_action( 'tribe_events_list_widget_before_the_event_title' ); ?>
				<!-- Event Title -->
				<h4 class="entry-title summary">
					<a href="<?php echo esc_url( tribe_get_event_link() ); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h4>

				<?php do_action( 'tribe_events_list_widget_after_the_event_title' ); ?>
				<!-- Event Time -->

				<?php do_action( 'tribe_events_list_widget_before_the_meta' ) ?>

				<div class="duration">
					<?php echo tribe_events_event_schedule_details(); ?>
				</div>

				<?php do_action( 'tribe_events_list_widget_after_the_meta' ) ?>
			</li>
		<?php
		endforeach;
		?>
	</ol><!-- .hfeed -->
	</div>

	<p class="tribe-events-widget-link">
		<a href="<?php echo esc_url( tribe_get_events_link() ); ?>" rel="bookmark"><?php printf( esc_html__( 'View All %s', 'fitclub' ), $events_label_plural ); ?></a>
	</p>

<?php
// No events were found.
else : ?>
	<p class="no-event"><?php printf( esc_html__( 'There are no upcoming %s at this time.', 'fitclub' ), strtolower( $events_label_plural ) ); ?></p>
<?php
endif;
?>