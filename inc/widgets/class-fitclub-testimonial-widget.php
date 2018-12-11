<?php
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

		<div class="media-uploader" id="<?php echo $this->get_field_id( 'background_image' ); ?>">
			<div class="custom_media_preview">
				<?php if ( $background_image != '' ) : ?>
					<img class="custom_media_preview_default" src="<?php echo esc_url( $background_image ); ?>" style="max-width:100%;" />
				<?php endif; ?>
			</div>
			<input type="text" class="widefat custom_media_input" id="<?php echo $this->get_field_id( 'background_image' ); ?>" name="<?php echo $this->get_field_name( 'background_image' ); ?>" value="<?php echo esc_url( $background_image ); ?>" style="margin-top:5px;" />
			<button class="custom_media_upload button button-secondary button-large" id="<?php echo $this->get_field_id( 'background_image' ); ?>" data-choose="<?php esc_attr_e( 'Choose an image', 'fitclub' ); ?>" data-update="<?php esc_attr_e( 'Use image', 'fitclub' ); ?>" style="width:100%;margin-top:6px;margin-right:30px;"><?php esc_html_e( 'Select an Image', 'fitclub' ); ?></button>
		</div>
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
											$title_attribute     = esc_attr( get_the_title( $post->ID ) );
											$thumb_id = get_post_thumbnail_id( get_the_ID() );
											$img_altr = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
											$img_alt = ! empty( $img_altr ) ? $img_altr : $title_attribute;
											$post_thumbnail_attr = array(
												'alt' => esc_attr( $img_alt ),
											);
											$testimonial_top = get_the_post_thumbnail( $post->ID, 'fitclub-testimonial', $post_thumbnail_attr );
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
