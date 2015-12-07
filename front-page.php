<?php
/**
 * Front Page
 *
 * @package FitClub
 */

get_header(); ?>
	<div id="content" class="site-content">
	<?php
	if( is_active_sidebar( 'fitclub_frontpage_section' ) ) {
		if ( !dynamic_sidebar( 'fitclub_frontpage_section' ) ):
			endif;
	}

	$fitclub_layout = fitclub_layout_class();
	?>
	<?php
	if( get_theme_mod( 'fitclub_frontpage_content' , 0 ) != 1 ): ?>
		<main id="main" class="clearfix <?php echo $fitclub_layout; ?>">
			<div class="tg-container">
				<div id="primary" class="content-area">

					<?php
					if ( have_posts() ):
						while ( have_posts() ) : the_post();

							if ( is_front_page() && is_home() ) {
								get_template_part( 'template-parts/content', get_post_format() );
							} elseif ( is_front_page() ) {
								get_template_part( 'template-parts/content', 'page' );
							}
						endwhile;
						get_template_part( 'navigation', 'none' );
					else:
						get_template_part( 'no-results', 'none' );
					endif;
					?>
				</div>
				<?php fitclub_sidebar_select(); ?>
			</div>
		</main>
	<?php endif; ?>
	</div>

<?php get_footer(); ?>