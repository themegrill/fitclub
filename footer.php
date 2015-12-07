<?php
/**
 * Theme Footer Section for our theme.
 *
 * Displays all of the footer section and closing of the #page div.
 *
 * @package ThemeGrill
 * @subpackage FitClub
 * @since FitClub 1.0
 */
?>
</div><!-- .body-content-wrapper -->
	<footer id="colophon" role="contentinfo">

		<?php get_template_part('sidebar/footer'); ?>

		<div id="bottom-footer">
			<div class="tg-container">
				<?php do_action( 'fitclub_footer_copyright' ); ?>

				<?php
				wp_nav_menu(
					array(
						'theme_location'   => 'footer',
						'menu_id'          => 'footermenu',
						'container'        => 'nav',
						'container_class'  => 'footer-menu',
						'fallback_cb'      => false
					)
				);
				?>
			</div>
		</div>
	</footer>
	<a href="#" class="scrollup"><i class="fa fa-angle-up"> </i> </a>
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
