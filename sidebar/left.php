<?php
/**
 * The Left sidebar widget area.
 *
 * @package ThemeGrill
 * @subpackage FitClub
 * @since FitClub 1.0
 */
?>

<div id="secondary">
	<?php do_action( 'fitclub_before_left_sidebar' ); ?>

		<?php if ( ! dynamic_sidebar( 'fitclub_left_sidebar' ) ) :

			the_widget( 'WP_Widget_Text',
				array(
					'title'  => esc_html__( 'Example Widget', 'fitclub' ),
					'text'   => sprintf( esc_html__( 'This is an example widget to show how the Left Sidebar looks by default. You can add custom widgets from the %swidgets screen%s in the admin. If custom widgets is added than this will be replaced by those widgets.', 'fitclub' ), current_user_can( 'edit_theme_options' ) ? '<a href="' . esc_url( admin_url( 'widgets.php' ) ) . '">' : '', current_user_can( 'edit_theme_options' ) ? '</a>' : '' ),
					'filter' => true,
				),
				array(
					'before_widget' => '<aside class="widget widget_text clearfix">',
					'after_widget'  => '</aside>',
					'before_title'  => '<h3 class="widget-title"><span>',
					'after_title'   => '</span></h3>'
				)
			);
		endif;

	do_action( 'fitclub_after_left_sidebar' ); ?>
</div>