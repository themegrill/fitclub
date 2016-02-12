<?php
/**
 * Template part for displaying results in search pages.
 *
 * @package ThemeGrill
 * @subpackage FitClub
 * @since FitClub 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>
	<?php do_action( 'fitclub_before_post_content' ); ?>

	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
			<?php fitclub_entry_meta(); ?>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
	</footer><!-- .entry-footer -->

	<?php do_action( 'fitclub_after_post_content' ); ?>
</article><!-- #post-## -->
