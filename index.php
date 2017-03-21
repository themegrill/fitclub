<?php
/**
 * Index Template of FitClub Theme.
 *
 * @package ThemeGrill
 * @subpackage FitClub
 * @since FitClub 1.0
 */

get_header(); ?>

	<?php do_action( 'fitclub_before_body_content' );

	$fitclub_layout = fitclub_layout_class();
	?>

	<div id="content" class="site-content">
		<main id="main" class="clearfix <?php echo esc_attr($fitclub_layout); ?>">
			<div class="tg-container">
				<div id="primary" class="content-area">

					<?php if ( have_posts() ) :

						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content', get_post_format() );

						endwhile;

						get_template_part( 'navigation', 'none' );

					else :

						get_template_part( 'no-results', 'none' );

					endif; ?>
				</div><!-- #primary -->
				<?php fitclub_sidebar_select(); ?>
			</div>
		</main>
	</div>

	<?php do_action( 'fitclub_after_body_content' ); ?>

<?php get_footer(); ?>