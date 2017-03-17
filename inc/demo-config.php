<?php
/**
 * Functions for configuring demo importer.
 *
 * @author   ThemeGrill
 * @category Admin
 * @package  Importer/Functions
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Setup demo importer packages.
 *
 * @param  array $packages
 * @return array
 */
function fitclub_demo_importer_packages( $packages ) {
	$new_packages = array(
		'fitclub-free' => array(
			'name'    => esc_html__( 'FitClub', 'fitclub' ),
			'preview' => 'https://demo.themegrill.com/fitclub/',
		),
	);

	return array_merge( $new_packages, $packages );
}
add_filter( 'themegrill_demo_importer_packages', 'fitclub_demo_importer_packages' );
