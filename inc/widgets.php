<?php
/**
 * Contains all the functions related to sidebar and widget.
 *
 * @package ThemeGrill
 * @subpackage FitClub
 * @since FitClub 1.0
 */

add_action( 'widgets_init', 'fitclub_widgets_init' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function fitclub_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'fitclub' ),
		'id'            => 'fitclub_right_sidebar',
		'description'   => esc_html__( 'Show widgets at Right side', 'fitclub' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'fitclub' ),
		'id'            => 'fitclub_left_sidebar',
		'description'   => esc_html__( 'Show widgets at Left side', 'fitclub' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( '404 Page Sidebar', 'fitclub' ),
		'id'            => 'fitclub_error_404_page_sidebar',
		'description'   => esc_html__( 'Show widgets at 404 Error Page', 'fitclub' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Front Page Sidebar', 'fitclub' ),
		'id'            => 'fitclub_frontpage_section',
		'description'   => esc_html__( 'Show widgets at Front Page Content Section', 'fitclub'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="section-title">',
		'after_title'   => '</h3>',
	) );

	$footer_sidebar_count = get_theme_mod('fitclub_footer_widgets', '4');

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar 1', 'fitclub' ),
		'id'            => 'fitclub_footer_sidebar1',
		'description'   => esc_html__( 'Show widgets at Footer section', 'fitclub' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>',
	) );

	if ( $footer_sidebar_count >= 2 ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Sidebar 2', 'fitclub' ),
			'id'            => 'fitclub_footer_sidebar2',
			'description'   => esc_html__( 'Show widgets at Footer section', 'fitclub' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title"><span>',
			'after_title'   => '</span></h4>',
		) );
	}

	if ( $footer_sidebar_count >= 3 ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Sidebar 3', 'fitclub' ),
			'id'            => 'fitclub_footer_sidebar3',
			'description'   => esc_html__( 'Show widgets at Footer section', 'fitclub' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title"><span>',
			'after_title'   => '</span></h4>',
		) );
	}

	if ($footer_sidebar_count >= 4 ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Sidebar 4', 'fitclub' ),
			'id'            => 'fitclub_footer_sidebar4',
			'description'   => esc_html__( 'Show widgets at Footer section', 'fitclub' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title"><span>',
			'after_title'   => '</span></h4>',
		) );
	}

	// Widgets Registration
	register_widget( "fitclub_service_widget" );
	register_widget( "fitclub_about_us_widget" );
	register_widget( "fitclub_call_to_action_widget" );
	register_widget( "fitclub_testimonial_widget" );
	register_widget( "fitclub_team_widget" );
	register_widget( "fitclub_featured_posts_widget" );
}

/**
 * Include Fitclub widgets class.
 */
// Class: TG: Service Widget.
require_once get_template_directory() . '/inc/widgets/class-fitclub-service-widget.php';

// Class: TG: About Widget.
require_once get_template_directory() . '/inc/widgets/class-fitclub-about-us-widget.php';

// Class: TG: Call To Action Widget.
require_once get_template_directory() . '/inc/widgets/class-fitclub-call-to-action-widget.php';

// Class: TG: Testimonial Widget.
require_once get_template_directory() . '/inc/widgets/class-fitclub-testimonial-widget.php';

// Class: TG: Our Team Widget.
require_once get_template_directory() . '/inc/widgets/class-fitclub-team-widget.php';

// Class: TG: Featured Posts Widget.
require_once get_template_directory() . '/inc/widgets/class-fitclub-featured-posts-widget.php';
