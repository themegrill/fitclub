<?php
/**
 * Template Name: Team Collection Template
 *
 * Displays the pages which use Team Template.
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
					<?php
					$page_array = array();
					$pages = get_pages();
					// get the pages associated with Team Template.
					foreach ( $pages as $page ) {
						$page_id = $page->ID;
						$template_name = get_post_meta( $page_id, '_wp_page_template', true );
						if( $template_name == 'page-templates/template-team.php' ) {
							array_push( $page_array, $page_id );
						}
					}

					$get_featured_pages = new WP_Query( array(
						'posts_per_page'        => -1,
						'post_type'             =>  array( 'page' ),
						'post__in'              => $page_array,
						'orderby'               => 'date'
					) );

					?>

					<?php if( !empty ( $page_array ) ) : ?>

					<div class="trainer-collecton-wrapper tg-column-wrapper">
						<?php
						$i = 1;
						while( $get_featured_pages->have_posts() ):$get_featured_pages->the_post();

						$title_attribute = the_title_attribute( 'echo=0' ); ?>

						<div class="trainer-collection tg-column-3 tg-column-bottom-margin">
							<figure class="trainer-page-img">
							<?php
								if( has_post_thumbnail() ) {
									the_post_thumbnail( 'fitclub-team' );
								} else {
									echo '<img src="' . get_template_directory_uri() . '/images/placeholder-team.jpg' . '">';
								}
							?>
							<?php
								$fitclub_designation = get_post_meta( $post->ID, 'fitclub_designation', true );
	                             if( !empty( $fitclub_designation ) ) {
									$fitclub_designation = isset( $fitclub_designation ) ? esc_attr( $fitclub_designation ) : ''; ?>
									<span class="trainer-category"><?php echo esc_html ( $fitclub_designation ); ?></span>
								<?php
								}
							?>
							</figure>
							<div class="trainer-page-content-wrapper">
								<h3 class="trainer-page-title">
									<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo $title_attribute; ?>" alt ="<?php echo $title_attribute; ?>"><?php the_title(); ?></a>
								</h3>
								<div class="trainer-page-content">
									<?php the_excerpt(); ?>
								</div>
								<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo $title_attribute; ?>" class="trainer-readmore"><?php esc_html_e('Read More', 'fitclub'); ?></a>
							</div>

						</div><!-- .tg-column-3 -->
						<?php if ( $i%3 == 0 ) { ?>
							<div class="clearfix"></div>
						<?php }
						$i++;
						endwhile;
						// Reset Post Data
						wp_reset_query();
						endif; ?>
					</div><!-- .trainer-collection-wrapper -->
				</div><!-- #primary -->
				<?php fitclub_sidebar_select(); ?>
			</div><!-- .tg-container -->
		</main><!-- #main -->
	</div><!-- #content -->

	<?php do_action( 'fitclub_after_body_content' ); ?>

<?php get_footer(); ?>