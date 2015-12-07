<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @package ThemeGrill
 * @subpackage FitClub
 * @since FitClub 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php do_action( 'fitclub_below_post_content' ); ?>

	<header class="single-page-header">
		<h2 class="entry-title"><?php the_title(); ?></h2>
		<?php
		$fitclub_designation = get_post_meta( $post->ID, 'fitclub_designation', true );
		if( !empty( $fitclub_designation ) ) {
			$fitclub_designation = isset( $fitclub_designation ) ? esc_attr( $fitclub_designation ) : ''; ?>
			<span class="single-trainer-category"><?php echo esc_html ( $fitclub_designation ); ?></span>
		<?php } ?>
	</header>

	<?php
	if ( has_post_thumbnail() ) { ?>
		<div class="entry-thumbnail">
			<?php
				the_post_thumbnail( 'fitclub-team' );
			?>
		</div>
	<?php } ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'fitclub' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'fitclub' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->

	<?php do_action( 'fitclub_after_post_content' ); ?>
</article><!-- #post-## -->

