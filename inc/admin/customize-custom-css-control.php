<?php
if ( ! function_exists( 'wp_update_custom_css_post' ) ) {
 class FitClub_Custom_CSS_Control extends WP_Customize_Control {
   public $type = 'custom_css';

      public function render_content() {
      ?>
      <label>
         <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
         <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
      </label>
      <?php
   }
 }
}
function fitclub_customm_css_migrate() {
 	if ( get_option( 'fitclub_custom_css_transfer' ) ) {
 		return;
 	}
 
 	$theme_custom_css = get_theme_mod( 'fitclub_custom_css', '' );
 	if ( ! empty( $theme_custom_css ) && function_exists( 'wp_update_custom_css_post' ) ) {
 		$wordpress_core_css = wp_get_custom_css(); // Preserve any CSS already added to the core option.
 		$return = wp_update_custom_css_post( $wordpress_core_css . $theme_custom_css );
 		if ( ! is_wp_error( $return ) ) {
 			// Set the transfer as complete
 			update_option( 'fitclub_custom_css_transfer', 1 );
 			// Remove the old theme_mod option for the Custom CSS Box provided via theme
 			remove_theme_mod( 'fitclub_custom_css' );
 		}
 	}
 }
 
 add_action( 'after_setup_theme', 'fitclub_customm_css_migrate' );