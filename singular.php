<?php
/**
 * The template for displaying all pages, single posts and attachments
 *
 * This is a new template file that WordPress introduced in
 * version 4.3: https://core.trac.wordpress.org/changeset/32846
 * Note that it uses conditional logic to display
 * different content based on the post type.
 *
 * Adapted from Twenty Sixteen
 *
 * @package ThemeGrill
 * @subpackage FitClub
 * @since FitClub 1.0
 */

get_header(); ?>

	<?php do_action( 'fitclub_before_body_content' );

	$fitclub_layout = fitclub_layout_class(); ?>

	<div id="content" class="site-content">
		<main id="main" class="clearfix <?php echo esc_attr($fitclub_layout); ?>">
			<div class="tg-container">

				<div id="primary">

					<div id="content-2">
						<?php
						// Start the loop.
						while ( have_posts() ) : the_post();

							// Include the page content template.
							if ( is_singular( 'page' ) ) {
								get_template_part( 'template-parts/content', 'page' );
							} else {
								get_template_part( 'template-parts/content', 'single' );
							}

							if ( ( ! is_page() ) && ( ( get_theme_mod( 'fitclub_author_bio_setting', 0 ) == 1 ) && ( get_the_author_meta( 'description' ) ) ) ) {
							?>
								<div class="author-box clearfix">
									<div class="author-img"><?php echo get_avatar( get_the_author_meta( 'user_email' ), '100' ); ?></div>
									<div class="author-description-wrapper">
										<h4 class="author-name"><?php the_author_meta( 'display_name' ); ?></h4>

										<p class="author-description"><?php the_author_meta( 'description' ); ?></p>
									</div>
								</div>
								<?php
							}

							if ( ( ! is_page() ) && ( get_theme_mod( 'fitclub_related_posts_activate', 0 ) == 1 ) ) {
								get_template_part( 'inc/related-posts' );
							}

							do_action( 'fitclub_before_comments_template' );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) {
								comments_template();
							}

							do_action ( 'fitclub_after_comments_template' );

							get_template_part('navigation', 'none');

							// End of the loop.
						endwhile;
						?>
					</div>

				</div><!-- #primary -->

				<?php fitclub_sidebar_select(); ?>

			</div>
		</main><!-- #main -->
	</div><!-- #content -->

	<?php do_action( 'fitclub_after_body_content' ); ?>

<?php get_footer(); ?>
