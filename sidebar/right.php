<?php
/**
 * The Right sidebar widget area.
 *
 * @package ThemeGrill
 * @subpackage FitClub
 * @since FitClub 1.0
 */
?>

<div id="secondary">
	<?php do_action( 'fitclub_before_sidebar' ); ?>

		<?php if ( ! dynamic_sidebar( 'fitclub_right_sidebar' ) ) :

			the_widget( 'WP_Widget_Text',
				array(
					'title'  => __( 'Example Widget', 'fitclub' ),
					'text'   => sprintf( __( 'This is an example widget to show how the Right Sidebar looks by default. You can add custom widgets from the %swidgets screen%s in the admin. If custom widgets is added than this will be replaced by those widgets.', 'fitclub' ), current_user_can( 'edit_theme_options' ) ? '<a href="' . admin_url( 'widgets.php' ) . '">' : '', current_user_can( 'edit_theme_options' ) ? '</a>' : '' ),
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

	do_action( 'fitclub_after_sidebar' ); ?>
</div>