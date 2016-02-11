<?php
/**
 * The template used for displaying post content.
 *
 * @package ThemeGrill
 * @subpackage FitClub
 * @since FitClub 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php do_action( 'fitclub_before_post_content' );

	the_title( sprintf( '<h2 class="entry-title"><a href="%s" title="%s">', esc_url( get_permalink() ), the_title_attribute('echo=0') ), '</a></h2>' );

	// Post thumbnail.
	if ( has_post_thumbnail() ) { ?>
		<div class="entry-thumbnail">
		<?php
			the_post_thumbnail( 'fitclub-featured-post' );
		?>
		</div> <!-- entry-thumbnail -->
	<?php } ?>
		<div class="entry-content-text-wrapper clearfix">
			<?php
			$class = 'no-date';
			if ( get_theme_mod('fitclub_postmeta', '') == '' && get_theme_mod('fitclub_postmeta_date', '') == '' ):
				$class = '';
			?>
			<span class="posted-on">
				<a href="<?php esc_url( get_permalink() ); ?>">
					<span class="date">
						<?php esc_attr( the_time(' d ') ); ?>
					</span>
					<span class="month">
						<?php esc_attr( the_time(' M ') ); ?>
					</span>
				</a>
			</span>
			<?php endif; ?>
			<div class="entry-content-wrapper <?php echo $class; ?>">
				<?php fitclub_entry_meta(); ?>
				<div class="entry-content">
					<?php
					global $more;
					$more = 0;
					if( get_theme_mod( 'fitclub_content_show', 'show_fullcontent' ) == 'show_excerpt' ) {
						the_excerpt(); ?>
					<div class="entry-btn">
						<a class="btn" title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'fitclub' ); ?>
						</a>
					</div>
					<?php }
					else {
						the_content( '<span>'. esc_html__( 'Read more', 'fitclub' ) .'</span>' );
					} ?>
				</div>
			</div>
		</div>

	<?php do_action( 'fitclub_after_post_content' ); ?>
</article>