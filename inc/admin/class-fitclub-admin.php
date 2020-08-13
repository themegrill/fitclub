<?php
/**
 * FitClub Admin Class.
 *
 * @author  ThemeGrill
 * @package FitClub
 * @since   1.0.7
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'FitClub_Admin' ) ) :
	/**
	 * FitClub_Admin Class.
	 */
	class FitClub_Admin {
		/**
		 * Constructor.
		 */
		public function __construct() {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}

		/**
		 * Localize array for import button AJAX request.
		 */
		public function enqueue_scripts() {
			wp_enqueue_style( 'fitclub-admin-style', get_template_directory_uri() . '/inc/admin/css/admin.css', array(), FITCLUB_THEME_VERSION );

			wp_enqueue_script( 'fitclub-plugin-install-helper', get_template_directory_uri() . '/inc/admin/js/plugin-handle.js', array( 'jquery' ), FITCLUB_THEME_VERSION, true );

			$welcome_data = array(
				'uri'      => esc_url( admin_url( '/themes.php?page=demo-importer&browse=all&fitclub-hide-notice=welcome' ) ),
				'btn_text' => esc_html__( 'Processing...', 'fitclub' ),
				'nonce'    => wp_create_nonce( 'fitclub_demo_import_nonce' ),
			);

			wp_localize_script( 'fitclub-plugin-install-helper', 'fitclubRedirectDemoPage', $welcome_data );
		}
	}

endif;

return new FitClub_Admin();
