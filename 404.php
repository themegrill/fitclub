<?php
/**
 * The template for displaying 404 pages (Page Not Found).
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
					<section class="error-404 not-found">
						<div class="page-content tg-column-wrapper clearfix">

						<?php if ( ! dynamic_sidebar( 'fitclub_error_404_page_sidebar' ) ) : ?>
							<header class="page-header tg-column-2">
								<h1 class="page-title"><span class="Oops"><?php esc_html_e( 'Oops!', 'fitclub'); ?></span><?php esc_html_e( 'That page can&rsquo;t be found.' , 'fitclub' ); ?></h1>
							</header>

							<p class="message"><?php esc_html_e( 'It looks like nothing was found at this location. Try the search below.', 'fitclub' ); ?></p>

							<div class="error-wrap tg-column-2">
								<span class="num-404">
									<?php esc_html_e( '404', 'fitclub' ); ?>
								</span>
								<span class="error"><?php esc_html_e( 'error', 'fitclub' ); ?></span>
							</div>
							<div class="form-wrapper">
							<?php get_search_form(); ?>
							</div>
						<?php endif; ?>
						</div>
					</section>
				</div>
			</div>
		<?php fitclub_sidebar_select(); ?>
		</div>
		</main>
	</div>

	<?php do_action( 'fitclub_after_body_content' ); ?>

<?php get_footer(); ?>