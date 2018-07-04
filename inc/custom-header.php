<?php
/**
 * FitClub functions and definitions
 *
 * @package    ThemeGrill
 * @subpackage FitClub
 * @since      FitClub 1.0.9
 */

/**
 * Setup the WordPress core custom header feature.
 */
function fitclub_custom_header_setup() {
	// Add Image Headers / Video Headers in 4.7
	add_theme_support( 'custom-header', array(
		'width'       => 2000,
		'height'      => 400,
		'flex-height' => true,
		'flex-width'  => true,
		'video'       => true,
		'header-text' => false,
	) );
}

add_action( 'after_setup_theme', 'fitclub_custom_header_setup' );

// Filter the get_header_image_tag() for option of adding the link back to home page option
function fitclub_header_image_markup( $html, $header, $attr ) {
	$output = '';

	if ( ( get_theme_mod( 'fitclub_slider_activation', '' ) == 0 ) || ( ( get_theme_mod( 'fitclub_slider_activation', '' ) == 1 ) && ! is_front_page() ) ) {
		$header_image = get_header_image();

		if ( ! empty( $header_image ) ) {
			$output .= '<div class="header-image-wrap"><img src="' . esc_url( $header_image ) . '" class="header-image" width="' . get_custom_header()->width . '" height="' . get_custom_header()->height . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '"></div>';
		}
	}

	return $output;
}

function fitclub_header_image_markup_filter() {
	add_filter( 'get_header_image_tag', 'fitclub_header_image_markup', 10, 3 );
}

add_action( 'fitclub_header_image_markup_render', 'fitclub_header_image_markup_filter' );
