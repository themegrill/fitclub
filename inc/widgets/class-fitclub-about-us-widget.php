<?php
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
			$bg_style = 'background-image:url(' . esc_url($background_image) . ');';
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
