<?php
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
			$bg_style = 'background-image:url(' . esc_url($background_image) . ');';
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

