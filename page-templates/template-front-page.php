<?php
/**
 * Template Name: Front Page Template
 *
 * @package ThemeGrill
 * @subpackage fitclub
 * @since 1.0.2
 */
?>

<?php get_header(); ?>

	<?php do_action( 'fitclub_before_content' ); ?>

	<?php if( is_active_sidebar( 'fitclub_frontpage_section' ) ) {
		if( !dynamic_sidebar( 'fitclub_frontpage_section' ) ):
		endif;
	} ?>

	<?php do_action( 'fitclub_after_content' ); ?>

<?php get_footer(); ?>