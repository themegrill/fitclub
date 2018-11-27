<?php
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
											$title_attribute            = esc_attr( get_the_title( $post->ID ) );
											$post_thumbnail_attr = array(
												'alt' => esc_attr( $title_attribute ),
											);
											$services_top = get_the_post_thumbnail( $post->ID, 'fitclub-featured-image', $post_thumbnail_attr );
											?>
											<figure class="<?php echo $image_class; ?>">
												<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php echo $services_top; ?></a>
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
