<?php
/**
 * Template Name: Service Template
 *
 * Displays the Service Template of the theme.
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
				<div id="primary">
					<div id="content-2">
						<?php while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content', 'page' );

							do_action( 'fitclub_before_comments_template' );
							// If comments are open or we have at least one comment, load up the comment template
							if ( comments_open() || '0' != get_comments_number() )
								comments_template();
			      			do_action ( 'fitclub_after_comments_template' );

						endwhile; ?>
					</div><!-- #content-2 -->
				</div><!-- #primary -->
				<?php fitclub_sidebar_select(); ?>
			</div>
		</main>
	</div>

	<?php do_action( 'fitclub_after_body_content' ); ?>

<?php get_footer(); ?>