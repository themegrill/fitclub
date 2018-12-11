<?php
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
											$title_attribute     = esc_attr( get_the_title( $post->ID ) );
											$thumb_id            = get_post_thumbnail_id( get_the_ID() );
											$img_altr            = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
											$img_alt             = ! empty( $img_altr ) ? $img_altr : $title_attribute;
											$post_thumbnail_attr = array(
												'title' => esc_attr( $title_attribute ),
												'alt'   => esc_attr( $img_alt ),
											);
											the_post_thumbnail('fitclub-featured-image', $post_thumbnail_attr);
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
