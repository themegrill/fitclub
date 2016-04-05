<?php
/**
 * This fucntion is responsible for rendering metaboxes in single post area
 *
 * @package ThemeGrill
 * @subpackage FitClub
 * @since FitClub 1.0
 */

add_action( 'add_meta_boxes', 'fitclub_add_custom_box' );
/**
 * Add Meta Boxes.
 */
function fitclub_add_custom_box() {
	// Adding layout meta box for Page
	add_meta_box( 'page-layout', esc_html__( 'Select Layout', 'fitclub' ), 'fitclub_layout_call', 'page', 'side', 'default' );
	// Adding layout meta box for Post
	add_meta_box( 'page-layout', esc_html__( 'Select Layout', 'fitclub' ), 'fitclub_layout_call', 'post', 'side', 'default' );
	//Adding designation meta box
	add_meta_box( 'team-designation', esc_html__( 'Our Team Designation', 'fitclub' ), 'fitclub_designation_call', 'page', 'side'	);
}

/****************************************************************************************/

global $fitclub_page_layout, $fitclub_metabox_field_icons, $fitclub_metabox_field_designation;
$fitclub_page_layout = array(
							'default-layout' 	=> array(
														'id'			=> 'fitclub_page_layout',
														'value' 		=> 'default_layout',
														'label' 		=> esc_html__( 'Default Layout', 'fitclub' )
														),
							'right-sidebar' 	=> array(
														'id'			=> 'fitclub_page_layout',
														'value' 		=> 'right_sidebar',
														'label' 		=> esc_html__( 'Right Sidebar', 'fitclub' )
														),
							'left-sidebar' 	=> array(
														'id'			=> 'fitclub_page_layout',
														'value' 		=> 'left_sidebar',
														'label' 		=> esc_html__( 'Left Sidebar', 'fitclub' )
														),
							'no-sidebar-full-width' => array(
															'id'			=> 'fitclub_page_layout',
															'value' 		=> 'no_sidebar_full_width',
															'label' 		=> esc_html__( 'No Sidebar Full Width', 'fitclub' )
															),
							'no-sidebar-content-centered' => array(
															'id'			=> 'fitclub_page_layout',
															'value' 		=> 'no_sidebar_content_centered',
															'label' 		=> esc_html__( 'No Sidebar Content Centered', 'fitclub' )
															)
						);

$fitclub_metabox_field_designation = array(
	array(
		'id'			=> 'fitclub_designation',
		'label' 		=> esc_html__( 'Team designation', 'fitclub' )
	)
);

/****************************************************************************************/

function fitclub_layout_call() {
	global $fitclub_page_layout;
	fitclub_meta_form( $fitclub_page_layout );
}

function fitclub_designation_call() {
	global $fitclub_metabox_field_designation;
	fitclub_meta_form( $fitclub_metabox_field_designation );
}


/**
 * Displays metabox to for select layout option
 */
function fitclub_meta_form( $fitclub_metabox_field ) {
	global $post;

	// Use nonce for verification
	wp_nonce_field( basename( __FILE__ ), 'custom_meta_box_nonce' );

	foreach ( $fitclub_metabox_field as $field ) {
		$layout_meta = get_post_meta( $post->ID, $field['id'], true );
		switch( $field['id'] ) {

			// Layout
			case 'fitclub_page_layout':
				if( empty( $layout_meta ) ) { $layout_meta = 'default_layout'; } ?>

				<input class="post-format" type="radio" name="<?php echo esc_attr($field['id']); ?>" value="<?php echo esc_attr($field['value']); ?>" <?php checked( $field['value'], $layout_meta ); ?>/>
				<label class="post-format-icon"><?php echo esc_html($field['label']); ?></label><br/>
				<?php

			break;

			// Team Designation
			case 'fitclub_designation':
				esc_html_e( 'Show designation in Our Team Widget.', 'fitclub' );
				echo '<input type="text" name="'.$field['id'].'" value="'.esc_attr($layout_meta).'"/><br>';

			break;
		}
	}
}

add_action('save_post', 'fitclub_save_custom_meta');
/**
 * save the custom metabox data
 * @hooked to save_post hook
 */
function fitclub_save_custom_meta( $post_id ) {
	global $fitclub_page_layout, $fitclub_metabox_field_icons, $fitclub_metabox_field_designation, $post;

	// Verify the nonce before proceeding.
   if ( !isset( $_POST[ 'custom_meta_box_nonce' ] ) || !wp_verify_nonce( $_POST[ 'custom_meta_box_nonce' ], basename( __FILE__ ) ) )
		return;

	// Stop WP from clearing custom fields on autosave
   if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)
		return;

	if ('page' == $_POST['post_type']) {
		if (!current_user_can( 'edit_page', $post_id ) )
			return $post_id;
	}
	elseif (!current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	foreach ( $fitclub_page_layout as $field ) {
		//Execute this saving function
		$old = get_post_meta( $post_id, $field['id'], true);
		$new = sanitize_text_field($_POST[$field['id']]);
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	} // end foreach

	if ('page' == $_POST['post_type']) {

		// loop through fields and save the data
		foreach ( $fitclub_metabox_field_designation as $field ) {
			$old = get_post_meta( $post_id, $field['id'], true );
			$new = sanitize_text_field($_POST[$field['id']]);
			if ($new && $new != $old) {
				update_post_meta( $post_id,$field['id'],$new );
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		} // end foreach
	}
}