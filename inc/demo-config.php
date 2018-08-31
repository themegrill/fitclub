<?php
/**
 * Functions for configuring demo importer.
 *
 * @package Importer/Functions
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Setup demo importer config.
 *
 * @deprecated 1.5.0
 *
 * @param  array $demo_config Demo config.
 * @return array
 */
function fitclub_demo_importer_packages( $packages ) {
	$new_packages = array(
		'fitclub-free' => array(
			'name'    => esc_html__( 'FitClub', 'fitclub' ),
			'preview' => 'https://demo.themegrill.com/fitclub/',
		),
		'fitclub-pro'  => array(
			'name'     => esc_html__( 'FitClub Pro', 'fitclub' ),
			'preview'  => 'https://demo.themegrill.com/fitclub-pro/',
			'pro_link' => 'https://themegrill.com/themes/fitclub/',
		),
	);

	return array_merge( $new_packages, $packages );
}

add_filter( 'themegrill_demo_importer_packages', 'fitclub_demo_importer_packages' );
