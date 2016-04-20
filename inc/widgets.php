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

// Service Widget
class fitclub_service_widget extends WP_Widget {
	function __construct() {
		$widget_ops = array(
			'classname'   => 'widget_service_block',
			'description' => esc_html__( 'Display some pages as services.', 'fitclub' )
		);
		$control_ops = array(
			'width'  => 200,
			'height' => 250
		);
		parent::__construct( false, $name = esc_html__( 'TG: Service Widget', 'fitclub' ), $widget_ops, $control_ops);
	}

	function form( $instance ) {
		$defaults['title']   = '';
		$defaults['number']  = '3';

		$instance = wp_parse_args( (array) $instance, $defaults );

		$title           =  $instance['title'];
		$number          =  $instance[ 'number' ];
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'fitclub' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of pages to display:', 'fitclub' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo absint($number); ?>" size="3" />
		</p>

		<p><?php esc_html_e( 'Note: Create the pages and select Service Template to display Services pages.', 'fitclub' ); ?></p>
	<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance                      = $old_instance;
		$instance[ 'title' ]           = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'number' ]          = absint( $new_instance[ 'number' ] );

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		global $post;
		$title           = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '');
		$number          = isset( $instance[ 'number' ] ) ? absint( $instance[ 'number' ] ) : 3;

		$page_array = array();
		$pages = get_pages();

		// Gets the page with service template.
		foreach ( $pages as $page ) {
			$page_id       = $page->ID;
			$template_name = get_post_meta( $page_id, '_wp_page_template', true );
			if( $template_name == 'page-templates/template-service.php' ) {
				array_push( $page_array, $page_id );
			}
		}

		$get_service_pages = new WP_Query( array(
			'posts_per_page'      => $number,
			'post_type'           =>  array( 'page' ),
			'post__in'            => $page_array,
			'orderby'             => 'date'
		) );

		echo $before_widget; ?>
		<div  class="section-wrapper">
			<div class="tg-container">
				<div class="classes-wrapper">
					<?php if( !empty( $title ) ) echo $before_title .'<span>'. esc_html($title) .'</span>'. $after_title; ?>

					<?php
					if( !empty( $page_array ) ) {
						$count = 0; ?>
					<div class="classes-block-wrapper clearfix">
						<div class="tg-column-wrapper">

						<?php
						while( $get_service_pages->have_posts() ):$get_service_pages->the_post();

						if ( $count % 3 == 0 && $count > 1 ) { ?> <div class='clearfix'></div> <?php } ?>

							<div class="tg-column-3">
							<?php
							if( has_post_thumbnail() ) {
									$image_class = 'class_img';
									$services_top = get_the_post_thumbnail( $post->ID, 'fitclub-featured-image' );
								?>
									<figure class="<?php echo $image_class; ?>">
										<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" alt="<?php the_title_attribute(); ?>"><?php echo $services_top; ?></a>
									</figure>
								<?php } ?>

								<div class="class-content-wrapper">
									<h5 class="class-title"><a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" alt="<?php the_title_attribute(); ?>"> <?php echo esc_html( get_the_title() ); ?></a></h5>

									<div class="class-content">
										<?php the_excerpt(); ?>
									</div>

									<a class="class-read-more" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> <?php esc_html_e( 'Learn More', 'fitclub' ) ?></a>
								</div>
							</div>
						<?php $count++;
						endwhile; ?>
						 </div>
					</div>
					<?php
					// Reset Post Data
					wp_reset_postdata();
					} ?>
				</div>
			</div>
		</div>
	<?php echo $after_widget;
	}
}

// Featured Page/About Us Widget
class fitclub_about_us_widget extends WP_Widget {
	function __construct() {
		$widget_ops = array(
			'classname'   => 'widget_about_block',
			'description' => esc_html__( 'Show your about page.', 'fitclub' )
		);
		$control_ops = array(
			'width'  => 200,
			'height' => 250
		);
		parent::__construct( false, $name = esc_html__( 'TG: About Widget', 'fitclub' ), $widget_ops, $control_ops);
	}

	function form( $instance ) {
		$defaults[ 'background_color' ] = '#575757';
		$defaults[ 'background_image' ] = '';
		$defaults[ 'title' ]            = '';
		$defaults[ 'page_id' ]          = '';
		$defaults[ 'button_text' ]      = '';
		$defaults[ 'button_url' ]       = '';
		$defaults[ 'button_icon' ]      = '';

		$instance = wp_parse_args( (array) $instance, $defaults );

		$title            = $instance[ 'title' ];
		$background_color = $instance[ 'background_color' ];
		$background_image = $instance[ 'background_image' ];
		$page_id          = $instance[ 'page_id' ];
		$button_text      = $instance[ 'button_text' ];
		$button_url       = $instance[ 'button_url' ];
		$button_icon      = $instance[ 'button_icon' ];
		?>
		<p>
		<strong><?php esc_html_e( 'Design Settings:', 'fitclub' ); ?></strong><br />

		<label for="<?php echo $this->get_field_id( 'background_color' ); ?>"><?php esc_html_e( 'Background Color:', 'fitclub' ); ?></label><br />
			<input class="my-color-picker" type="text" data-default-color="#575757" id="<?php echo $this->get_field_id( 'background_color' ); ?>" name="<?php echo $this->get_field_name( 'background_color' ); ?>" value="<?php echo esc_attr($background_color); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'background_image' ); ?>"> <?php esc_html_e( 'Background Image:', 'fitclub' ); ?> </label> <br />

		<?php
		if ( $background_image  != '' ) :
			echo '<img id="' . $this->get_field_id( 'background_image' . 'preview') . '"src="' . esc_url($background_image) . '"style="max-width: 250px;" /><br />';
		endif;
		?>
		<input type="text" class="widefat custom_media_url" id="<?php echo $this->get_field_id( 'background_image' ); ?>" name="<?php echo $this->get_field_name( 'background_image' ); ?>" value="<?php echo esc_url($background_image); ?>" style="margin-top: 5px;"/>

		<input type="button" class="button button-primary custom_media_button" id="custom_media_button_action" name="<?php echo $this->get_field_name( 'background_image' ); ?>" value="<?php esc_attr_e( 'Upload Image', 'fitclub' ); ?>" style="margin-top: 5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id( 'background_image' ); ?>' ); return false;"/>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'fitclub' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>

		<p><?php esc_html_e('Select a page to display Title, Excerpt and Featured image.', 'fitclub') ?></p>
		<label for="<?php echo $this->get_field_id( 'page_id' ); ?>"><?php esc_html_e( 'Page', 'fitclub' ); ?>:</label>

		<?php wp_dropdown_pages( array(
			'show_option_none'  => ' ',
			'name'              => $this->get_field_name( 'page_id' ),
			'selected'          => absint($page_id)
			) );
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php esc_html_e( 'Button Text:', 'fitclub' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text" value="<?php echo esc_attr($button_text); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'button_url' ); ?>"><?php esc_html_e( 'Button Redirect Link:', 'fitclub' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'button_url' ); ?>" name="<?php echo $this->get_field_name( 'button_url' ); ?>" type="text" value="<?php echo esc_url($button_url); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'button_icon' ); ?>"><?php esc_html_e( 'Button Icon Class:', 'fitclub' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'button_icon' ); ?>" name="<?php echo $this->get_field_name( 'button_icon' ); ?>" placeholder="fa-cog" type="text" value="<?php echo esc_attr($button_icon); ?>" />
		</p>

		<p>
		<?php
		$url = 'http://fontawesome.io/icons/';
		$link = sprintf( wp_kses( __( '<a href="%s" target="_blank">Refer here</a> For Icon Class', 'fitclub' ), array(  'a' => array( 'href' => array() ) ) ), esc_url( $url ) );
		echo $link;
		?>
		</p>
		<?php
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'background_color'] = esc_attr($new_instance['background_color']);
		$instance[ 'background_image'] = esc_url_raw( $new_instance['background_image'] );
		$instance[ 'title' ]           = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'page_id' ]         = absint( $new_instance[ 'page_id' ] );
		$instance[ 'button_text' ]     = strip_tags( $new_instance[ 'button_text' ] );
		$instance[ 'button_url' ]      = esc_url_raw( $new_instance[ 'button_url' ] );
		$instance[ 'button_icon' ]     = strip_tags( $new_instance[ 'button_icon' ] );

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		global $post;
		$background_color = isset( $instance[ 'background_color' ] ) ? $instance[ 'background_color' ] : '';
		$background_image = isset( $instance[ 'background_image' ] ) ? $instance[ 'background_image' ] : '';
		$page_id          = isset( $instance[ 'page_id' ] ) ? absint( $instance[ 'page_id' ] ) : '';
		$button_text      = isset( $instance[ 'button_text' ] ) ?  $instance[ 'button_text' ] : '';
		$button_url       = isset( $instance[ 'button_url' ] ) ?  $instance[ 'button_url' ] : '#';
		$button_icon      = isset( $instance[ 'button_icon' ] ) ? $instance[ 'button_icon' ] : '';

		$bg_style = '';
		$bg_class = 'image-background';
		if ( !empty( $background_image ) ) {
			$bg_style = 'background:url(' . esc_url($background_image) . ') scroll no-repeat center top/cover;';
		} else {
			$bg_style = 'background-color:' . esc_attr($background_color) . ';';
			$bg_class = 'no-image';
		}
		echo $before_widget; ?>
		<div class="section-wrapper <?php echo esc_attr($bg_class); ?>" style="<?php echo $bg_style; ?>">
			<div class="tg-container">

				<?php if( $page_id ) : ?>
				<div class="about-wrapper clearfix">
				<?php
				$the_query = new WP_Query( 'page_id='.$page_id );
					while( $the_query->have_posts() ):$the_query->the_post();
						$title_attribute = the_title_attribute( 'echo=0' );

						$output  = '<h3 class="about-title"> <a href="' . esc_url( get_permalink() ) . '" title="' . $title_attribute . '" alt ="' . $title_attribute . '">' . esc_html ( get_the_title() ). '</a></h3>';

						$output .= '<div class="about-content">' . get_the_content('', true) . '</div>';

						$output .= '<div class="about-btn-wrapper">';

						$output .= '<a class="about-btn" href="'. esc_url( get_permalink() ) . '">' . esc_html__( 'Read more', 'fitclub' ) . '</a>';

						if ( !empty ( $button_text ) ) {
							$output .= '<a class="about-btn" href="' . esc_url($button_url) . '">' .esc_html($button_text). ' <i class="fa ' . esc_attr($button_icon) . '"></i></a>';
						}

						$output .= '</div>';
						echo $output;
						?>
					</div>
					<?php if( has_post_thumbnail() ) : ?>
						<div class="about-img-wrapper clearfix">
						<?php the_post_thumbnail( 'fitclub-about' ); ?>
						</div>
					<?php endif; ?>
					<?php endwhile;

					// Reset Post Data
					wp_reset_postdata(); ?>
			</div><!-- .about-content-wrapper -->
				<?php endif; ?>
		</div><!-- .tg-container -->
	<?php echo $after_widget;
	}
}

// Call to action widget
class fitclub_call_to_action_widget extends WP_Widget {
	function __construct() {
		$widget_ops = array(
			'classname'   => 'widget_call_to_action_block',
			'description' => esc_html__( 'Use this widget to show the call to action section.', 'fitclub' )
		);
		$control_ops = array(
			'width'  => 200,
			'height' => 250
		);
		parent::__construct( false, $name = esc_html__( 'TG: Call To Action Widget', 'fitclub' ), $widget_ops, $control_ops);
	}

	function form( $instance ) {
		$defaults[ 'background_color' ] = '#32c4d1';
		$defaults[ 'background_image' ] = '';
		$defaults[ 'text' ]             = '';
		$defaults[ 'button_text' ]      = '';
		$defaults[ 'button_url' ]       = '';

		$instance = wp_parse_args( (array) $instance, $defaults );

		$background_color = $instance[ 'background_color' ];
		$background_image = $instance[ 'background_image' ];
		$text             = $instance[ 'text' ];
		$button_text      = $instance[ 'button_text' ];
		$button_url       = $instance[ 'button_url' ];
		?>
		<p>
			<strong><?php esc_html_e( 'Design Settings:', 'fitclub' ); ?></strong><br />
			<label for="<?php echo $this->get_field_id( 'background_color' ); ?>"><?php esc_html_e( 'Background Color:', 'fitclub' ); ?></label><br />
			<input class="my-color-picker" type="text" data-default-color="#32c4d1" id="<?php echo $this->get_field_id( 'background_color' ); ?>" name="<?php echo $this->get_field_name( 'background_color' ); ?>" value="<?php echo esc_attr($background_color); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'background_image' ); ?>"> <?php esc_html_e( 'Image:', 'fitclub' ); ?> </label> <br />

			<?php
			if ( $background_image  != '' ) :
				echo '<img id="' . $this->get_field_id( 'background_image' . 'preview') . '"src="' . esc_url($background_image) . '"style="max-width: 250px;" /><br />';
			endif;
			?>
			<input type="text" class="widefat custom_media_url" id="<?php echo $this->get_field_id( 'background_image' ); ?>" name="<?php echo $this->get_field_name( 'background_image' ); ?>" value="<?php echo esc_url($background_image); ?>" style="margin-top: 5px;"/>

			<input type="button" class="button button-primary custom_media_button" id="custom_media_button_action" name="<?php echo $this->get_field_name( 'background_image' ); ?>" value="<?php esc_attr_e( 'Upload Image', 'fitclub' ); ?>" style="margin-top: 5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id( 'background_image' ); ?>' ); return false;"/>
		</p>

		<strong><?php esc_html_e( 'Other Settings :', 'fitclub' ); ?></strong><br />

		<?php esc_html_e( 'Call to Action Main Text','fitclub' ); ?>
		<textarea class="widefat" rows="3" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo esc_textarea($text); ?></textarea>
		<p>
			<label for="<?php echo $this->get_field_id('button_text'); ?>"><?php esc_html_e( 'Button Text:', 'fitclub' ); ?></label>
			<input id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php echo esc_attr($button_text); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('button_url'); ?>"><?php esc_html_e( 'Button Redirect Link:', 'fitclub' ); ?></label>
			<input id="<?php echo $this->get_field_id('button_url'); ?>" name="<?php echo $this->get_field_name('button_url'); ?>" type="text" value="<?php echo esc_url($button_url); ?>" />
		</p>
	<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['background_color'] =  esc_attr( $new_instance['background_color'] );
		$instance['background_image'] =  esc_url_raw( $new_instance['background_image'] );

		$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed

		$instance[ 'button_text' ] = strip_tags( $new_instance[ 'button_text' ] );
		$instance[ 'button_url' ]  = esc_url_raw( $new_instance[ 'button_url' ] );
		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		global $post;
		$background_color = isset( $instance[ 'background_color' ] ) ? $instance[ 'background_color' ] : '';
		$background_image = isset( $instance[ 'background_image' ] ) ? $instance[ 'background_image' ] : '';
		$text             = isset( $instance[ 'text' ] ) ? $instance[ 'text' ] : '';
		$button_text      = isset( $instance[ 'button_text' ] ) ? $instance[ 'button_text' ] : '';
		$button_url       = isset( $instance[ 'button_url' ] ) ?  $instance[ 'button_url' ] : '';

		echo $before_widget;
		$bg_style = '';
		$bg_class = 'image-background';
		if ( !empty( $background_image ) ) {
			$bg_style = 'background:url(' . esc_url($background_image) . ') scroll no-repeat center top/cover;';
		} else {
			$bg_style = 'background-color:' . esc_attr($background_color) . ';';
			$bg_class = 'no-image';
		}
		?>
		<div class="section-wrapper <?php echo esc_attr($bg_class); ?>" style="<?php echo $bg_style; ?>">
			<div class="bg-overlay"></div>
			<div class="tg-container">
				<div class="cta-wrapper">
					<?php if( !empty( $text ) ) { ?>
						<h3 class="cta-title"><?php echo esc_html($text); ?></h3>
					<?php } ?>
					<?php if( !empty( $button_text ) ) { ?>
					<a class="cta-readmore" href="<?php echo esc_url($button_url); ?>"><?php echo esc_html($button_text); ?></a>
					<?php } ?>
				</div>
			</div>
		</div>
	<?php echo $after_widget;
	}
}

// Testimonial Widget
class fitclub_testimonial_widget extends WP_Widget {
	function __construct() {
		$widget_ops = array(
			'classname'   => 'widget_testimonial_block',
			'description' => esc_html__( 'Display some pages as testimonial.', 'fitclub' )
		);
		$control_ops = array(
			'width'  => 200,
			'height' => 250
		);
		parent::__construct( false, $name = esc_html__( 'TG: Testimonial Widget', 'fitclub' ), $widget_ops, $control_ops);
	}

	function form( $instance ) {
		$defaults[ 'background_color' ] = '#575757';
		$defaults[ 'background_image' ] = '';
		$defaults['title']              = '';
		$defaults['number']             = 3;

		$instance = wp_parse_args( (array) $instance, $defaults );

		$background_color = $instance[ 'background_color' ];
		$background_image = $instance[ 'background_image' ];
		$title            = $instance['title'];
		$number           = $instance[ 'number' ];
		?>

		<p>
			<strong><?php esc_html_e( 'Design Settings:', 'fitclub' ); ?></strong><br />
			<label for="<?php echo $this->get_field_id( 'background_color' ); ?>"><?php esc_html_e( 'Background Color:', 'fitclub' ); ?></label><br />
			<input class="my-color-picker" type="text" data-default-color="#32c4d1" id="<?php echo $this->get_field_id( 'background_color' ); ?>" name="<?php echo $this->get_field_name( 'background_color' ); ?>" value="<?php echo esc_attr($background_color); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'background_image' ); ?>"> <?php esc_html_e( 'Image:', 'fitclub' ); ?> </label> <br />

			<?php
			if ( $background_image  != '' ) :
				echo '<img id="' . $this->get_field_id( 'background_image' . 'preview') . '"src="' . esc_url($background_image) . '"style="max-width: 250px;" /><br />';
			endif;
			?>
			<input type="text" class="widefat custom_media_url" id="<?php echo $this->get_field_id( 'background_image' ); ?>" name="<?php echo $this->get_field_name( 'background_image' ); ?>" value="<?php echo esc_url($background_image); ?>" style="margin-top: 5px;"/>

			<input type="button" class="button button-primary custom_media_button" id="custom_media_button_action" name="<?php echo $this->get_field_name( 'background_image' ); ?>" value="<?php esc_attr_e( 'Upload Image', 'fitclub' ); ?>" style="margin-top: 5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id( 'background_image' ); ?>' ); return false;"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'fitclub' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of pages to display:', 'fitclub' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo absint($number); ?>" size="3" />
		</p>

		<p><?php esc_html_e( 'Note: Create the pages and select Testimonial Template to display Testimonial pages.', 'fitclub' ); ?></p>
	<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance                      = $old_instance;

		$instance['background_color']  =  esc_attr($new_instance['background_color']);
		$instance['background_image']  =  esc_url_raw( $new_instance['background_image'] );
		$instance[ 'title' ]           =  strip_tags( $new_instance[ 'title' ] );
		$instance[ 'number' ]          =  absint( $new_instance[ 'number' ] );

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		global $post;
		$background_color = isset( $instance[ 'background_color' ] ) ? $instance[ 'background_color' ] : '';
		$background_image = isset( $instance[ 'background_image' ] ) ? $instance[ 'background_image' ] : '';
		$title            = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '');
		$number           = isset( $instance[ 'number' ] ) ? absint( $instance[ 'number' ] ) : 3;

		$page_array = array();
		$pages = get_pages();

		// Gets the page with service template.
		foreach ( $pages as $page ) {
			$page_id       = $page->ID;
			$template_name = get_post_meta( $page_id, '_wp_page_template', true );
			if( $template_name == 'page-templates/template-testimonial.php' ) {
				array_push( $page_array, $page_id );
			}
		}

		$get_testimonial_pages = new WP_Query( array(
			'posts_per_page'      => $number,
			'post_type'           =>  array( 'page' ),
			'post__in'            => $page_array,
			'orderby'             => 'date'
		) );

		$bg_style = '';
		$bg_class = 'image-background';
		if ( !empty( $background_image ) ) {
			$bg_style = 'background-image:url(' . esc_url($background_image) . ');scroll no-repeat center top/cover;';
		} else {
			$bg_style = 'background-color:' . esc_attr($background_color) . ';';
			$bg_class = 'no-image';
		}
		echo $before_widget; ?>
		<div  class="section-wrapper <?php echo esc_attr($bg_class); ?>" style="<?php echo $bg_style; ?>">
			<div class="bg-overlay"></div>
			<div class="tg-container">
				<div class="testimonial-wrapper">
					<?php if( !empty( $title ) ) echo $before_title .'<span>'.esc_html($title).'</span>'. $after_title; ?>

					<?php
					if( !empty( $page_array ) ) {
						$count = 0; ?>
							<ul class="bxslider">
							<?php
							while( $get_testimonial_pages->have_posts() ):$get_testimonial_pages->the_post(); ?>

								<li>
									<div class="testimonial-content-wrapper clearfix">
									<?php
									if( has_post_thumbnail() ) {
											$image_class = 'testimonial-image';
											$testimonial_top = get_the_post_thumbnail( $post->ID, 'fitclub-testimonial' );
										?>
											<figure class="<?php echo esc_attr($image_class); ?>">
												<?php echo $testimonial_top; ?>
											</figure>
										<?php } ?>

										<div class="testimonial-desc-wrapper">
											<div class="testimonial-desc">
												<?php the_excerpt(); ?>
											</div>
											<div class="testimonial-author"><?php echo esc_html( get_the_title() ); ?></div>
										</div>
									</div>
								</li>
							<?php
							endwhile; ?>
						</ul>
					<?php
					// Reset Post Data
					wp_reset_postdata();
					} ?>
				</div>
			</div>
		</div>
	<?php echo $after_widget;
	}
}

// Team Widget
class fitclub_team_widget extends WP_Widget {
	function __construct() {
		$widget_ops = array(
			'classname'   => 'widget_team_block',
			'description' => esc_html__( 'Show your Team Members.', 'fitclub' )
		);
		$control_ops = array(
			'width'  => 200,
			'height' => 250
		);

		parent::__construct( false, $name = esc_html__( 'TG: Our Team Widget', 'fitclub' ), $widget_ops, $control_ops);
	}

	function form( $instance ) {
		$defaults['title']              = '';
		$defaults['number']             = 3;

		$instance         = wp_parse_args( (array) $instance, $defaults );

		$title            = $instance[ 'title' ];
		$number           = $instance[ 'number' ];
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'fitclub' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of pages to display:', 'fitclub' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo absint($number); ?>" size="3" />
		</p>
		<p><?php esc_html_e( 'Note: Create the pages and select Team Template to display Our Team pages.', 'fitclub' ); ?></p>
		<?php }

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ]      = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'number' ]     = absint( $new_instance[ 'number' ] );

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		global $post;
		$title  = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '');
		$number = isset( $instance[ 'number' ] ) ? absint( $instance[ 'number' ] ) : 3;

		$page_array = array();
		$pages = get_pages();
		// get the pages associated with Our Team Template.
		foreach ( $pages as $page ) {
			$page_id = $page->ID;
			$template_name = get_post_meta( $page_id, '_wp_page_template', true );
			if( $template_name == 'page-templates/template-team.php' ) {
				array_push( $page_array, $page_id );
			}
		}

		$get_featured_pages = new WP_Query( array(
			'posts_per_page'        => $number,
			'post_type'             =>  array( 'page' ),
			'post__in'              => $page_array,
			'orderby'               => 'date'
		) );

		echo $before_widget; ?>
		<div class="section-wrapper">
			<div class="tg-container">
				<div class="trainer-wrapper tg-column-wrapper">
					<?php if( !empty( $title ) ) echo $before_title .'<span>'. esc_html($title) .'</span>'. $after_title; ?>

					<?php if( !empty ( $page_array ) ) : ?>
					<?php while( $get_featured_pages->have_posts() ):$get_featured_pages->the_post();

						$title_attribute = the_title_attribute( 'echo=0' ); ?>

						<div class="trainer-block tg-column-3">
							<figure class="trainer-img">
								<?php
								if( has_post_thumbnail() ) {
									the_post_thumbnail( 'fitclub-team' );
								} else {
										echo '<img src="' . get_template_directory_uri() . '/images/placeholder-team.jpg' . '">';
								}
								?>
							</figure>
							<div class="trainer-content-wrapper">
								<h3 class="trainer-title">
									<a href="<?php echo get_permalink() ?>" title="<?php echo $title_attribute; ?>" alt ="<?php echo $title_attribute; ?>"><?php the_title(); ?></a>
								</h3>
								<div class="trainer-content">
									<?php the_excerpt(); ?>
								</div>
								<div class="trainer-author">
								<?php
								$fitclub_designation = get_post_meta( $post->ID, 'fitclub_designation', true );
                                 if( !empty( $fitclub_designation ) ) {
									$fitclub_designation = isset( $fitclub_designation ) ? esc_attr( $fitclub_designation ) : '';
								}
								echo esc_html ( $fitclub_designation );
								?>
								</div>
							</div>

						</div><!-- .tg-column-3 -->
						<?php
						endwhile;

						// Reset Post Data
						wp_reset_postdata();
						endif; ?>
				</div>
			</div><!-- .tg-container -->
		</div><!-- .section-wrapper -->

		<?php echo $after_widget;
	}
}


// Featured Post Widget
class fitclub_featured_posts_widget extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname'   => 'widget_featured_posts_block',
			'description' => esc_html__( 'Display latest posts or posts of specific category', 'fitclub')
		);
		$control_ops = array(
			'width'  => 200,
			'height' => 250
		);
		parent::__construct( false,$name= esc_html__( 'TG: Featured Posts', 'fitclub' ),$widget_ops);
	}

	function form( $instance ) {
		$defaults[ 'title' ]      = '';
		$defaults[ 'number' ]     = 3;
		$defaults[ 'type' ]       = 'latest';
		$defaults[ 'category' ]   = '';

		$instance = wp_parse_args( (array) $instance, $defaults );


		$title       = $instance[ 'title' ];
		$number      = $instance[ 'number' ];
		$type        = $instance[ 'type' ];
		$category    = $instance[ 'category' ];
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'fitclub' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of posts to display:', 'fitclub' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo absint($number); ?>" size="3" />
		</p>

		<p>
			<input type="radio" <?php checked( sanitize_text_field($type), 'latest' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="latest"/><?php esc_html_e( 'Show latest Posts', 'fitclub' );?><br />
			<input type="radio" <?php checked( sanitize_text_field($type),'category' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="category"/><?php esc_html_e( 'Show posts from a category', 'fitclub' );?><br />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php esc_html_e( 'Select category', 'fitclub' ); ?>:</label>
			<?php wp_dropdown_categories( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'category' ), 'selected' => absint($category) ) ); ?>
		</p>

		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance[ 'title' ]       = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'number' ]      = absint( $new_instance[ 'number' ] );
		$instance[ 'type' ]        = sanitize_text_field( $new_instance[ 'type' ] );
		$instance[ 'category' ]    = absint( $new_instance[ 'category' ] );
		$instance[ 'button_text' ] = strip_tags( $new_instance[ 'button_text' ] );
		$instance[ 'button_url' ]  = esc_url_raw( $new_instance[ 'button_url' ] );

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		global $post;
		$title       = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '');
		$number      = isset( $instance[ 'number' ] ) ?  absint( $instance[ 'number' ] ) : 3;
		$type        = isset( $instance[ 'type' ] ) ? sanitize_text_field( $instance[ 'type' ] ) : 'latest' ;
		$category    = isset( $instance[ 'category' ] ) ? absint( $instance[ 'category' ] ) : '';

		if( $type == 'latest' ) {
			$get_featured_posts = new WP_Query( array(
				'posts_per_page'        => $number,
				'post_type'             => 'post',
				'ignore_sticky_posts'   => true
		) );
		}
		else {
		$get_featured_posts = new WP_Query( array(
			'posts_per_page'        => $number,
			'post_type'             => 'post',
			'category__in'          => $category
		) );
	}

	echo $before_widget; ?>

	<div class="section-wrapper">
		<div class="tg-container">
			<?php if ( !empty( $title ) ) { echo $before_title .'<span>'. esc_html($title) .'</span>'. $after_title; } ?>

			<div class="blog-wrapper">
				<ul class="blog-slider">
					<?php
					while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post(); ?>
					<li>
						<div class="blog-content-wrapper">
							<?php
							$time_string = '<time class="post-date" datetime="%1$s">%2$s</time>';

							$time_string = printf( $time_string,
								esc_attr( get_the_date( 'c' ) ),
								esc_html( get_the_date( 'M j' ) )
								);

							?>
							<figure class="blog-img">
								<?php
								if( has_post_thumbnail() ) {
									the_post_thumbnail('fitclub-featured-image');
								} else { ?>
									<img src='<?php echo get_template_directory_uri(); ?>/images/placeholder-blog.jpg' alt='<?php esc_attr_e('Blog Image', 'fitclub');?>' />
								<?php } ?>
							</figure>

							<div class="blog-desc-wrap">

								<h4 class="blog-title"> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a></h4>

								<div class="blog-desc">
									<?php the_excerpt(); ?>
								</div>

								<a class="blog-readmore" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> <?php echo esc_html__( 'Read more' , 'fitclub' ) ?></a>
							</div>
						</div>
					</li>
					<?php
						endwhile;
					?>
				</ul>
			</div><!-- .blog-wrapper -->
		</div><!-- .tg-container -->
	</div><!-- .section-wrapper -->
	<?php
		// Reset Post Data
		wp_reset_postdata();
		echo $after_widget;
	}
}