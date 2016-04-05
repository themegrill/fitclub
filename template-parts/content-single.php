<?php
/**
 * Template part for displaying single posts.
 *
 * @package ThemeGrill
 * @subpackage FitClub
 * @since FitClub 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php do_action( 'fitclub_before_post_content' ); ?>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' );

		if ( has_post_thumbnail() ) { ?>
			<div class="entry-thumbnail">
			<?php
			the_post_thumbnail( 'fitclub-featured-post' );
			?>
			</div>
		<?php } ?>
	</header><!-- .entry-header -->

	<div class="entry-content-text-wrapper clearfix">
		<?php
		$class = 'no-date';
		if ( get_theme_mod('fitclub_postmeta', '') == '' && get_theme_mod('fitclub_postmeta_date', '') == '' ):
			$class = 'with-date';
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
				<?php the_content(); ?>
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'fitclub' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->
		</div>
	</div>

	<footer class="entry-footer">
	</footer><!-- .entry-footer -->

	<?php do_action( 'fitclub_after_post_content' ); ?>
</article><!-- #post-## -->

