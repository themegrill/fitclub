<?php
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
										$thumb_id            = get_post_thumbnail_id( get_the_ID() );
										$img_altr            = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
										$img_alt             = ! empty( $img_altr ) ? $img_altr : $title_attribute;
										$post_thumbnail_attr = array(
											'alt' => esc_attr( $img_alt ),
										);
										the_post_thumbnail( 'fitclub-team', $post_thumbnail_attr );
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
