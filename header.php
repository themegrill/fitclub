<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="body-content-wrapper">
 *
 * @package    ThemeGrill
 * @subpackage FitClub
 * @since      FitClub 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'fitclub_before' ); ?>
<?php
$slide = 0;
for ( $i = 1; $i <= 4; $i ++ ) {
	$page_id = get_theme_mod( 'fitclub_slide' . $i );
	if ( ! empty ( $page_id ) ) {
		$slide ++;
	}
}

if ( ( function_exists( 'the_custom_header_markup' ) && has_header_video() ) || ( get_theme_mod( 'fitclub_slider_activation', 0 ) == 1 ) ) {
	$class = "slider-active";
} elseif ( ( ( $slide < 1 ) || get_theme_mod( 'fitclub_slider_activation', 0 ) != 1 ) && is_front_page() && ! is_home() ) {
	$class = "no-slider";
} else {
	$class = "slider-active";
}
?>
<div id="page" class="hfeed site <?php echo esc_attr( $class ); ?>">
	<?php do_action( 'fitclub_before_header' ); ?>

	<header id="masthead" class="site-header" role="banner">
		<div class="header-wrapper clearfix">
			<div class="tg-container">
				<div class="top-header clearfix">
					<?php if ( ( get_theme_mod( 'fitclub_logo_placement', 'header_text_only' ) == 'show_both' || get_theme_mod( 'fitclub_logo_placement', 'header_text_only' ) == 'header_logo_only' ) ) { ?>
						<div class="logo">

							<?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo( $blog_id = 0 ) ) {
								fitclub_the_custom_logo();
							} ?>

						</div> <!-- logo end -->
					<?php }
					$screen_reader = 'logo';
					if ( get_theme_mod( 'fitclub_logo_placement', 'header_text_only' ) == 'header_logo_only' || get_theme_mod( 'fitclub_logo_placement', 'header_text_only' ) == 'disable' ) {
						$screen_reader = 'screen-reader-text';
					}
					?>

					<div id="header-text" class="<?php echo esc_attr( $screen_reader ); ?>">
						<?php if ( is_front_page() || is_home() ) : ?>
							<h1 id="site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
							</h1>
						<?php else : ?>
							<h3 id="site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
							</h3>
						<?php endif;
						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) : ?>
							<p id="site-description"><?php echo $description; ?></p>
						<?php endif;
						?>
					</div><!-- #header-text -->

					<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'social',
							'menu_id'         => 'menu-social-menu',
							'container'       => 'nav',
							'container_class' => 'social-icons-wrapper',
							'fallback_cb'     => 'false',
						)
					);

					?>
				</div>

				<div class="header-menu-wrapper clearfix">
					<nav id="site-navigation" class="main-navigation" role="navigation">
						<div class="menu-toggle hide"><?php esc_html_e( 'Menu', 'fitclub' ); ?></div>
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'menu_id'        => 'primary-menu',
							)
						);
						?>
					</nav><!-- #site-navigation -->

					<div class="search-wrapper">
						<div class="search-icon">
							<i class="fa fa-search"> </i>
						</div> <!-- search-icon end -->
						<div class="header-search-box">
							<div class="close"><i class="fa fa-close"></i></div>
							<?php get_search_form(); ?>
						</div> <!-- header-search-box end -->
					</div> <!-- search-wrapper end -->

				</div> <!-- header-menu-wrapper end -->
			</div>
		</div> <!-- header-wrapper end -->
	</header>

	<?php if ( ( function_exists( 'the_custom_header_markup' ) && ( ( get_theme_mod( 'fitclub_slider_activation', '' ) == 0 ) || ( ( get_theme_mod( 'fitclub_slider_activation', '' ) == 1 ) && ! is_front_page() ) ) ) || ( function_exists( 'the_custom_header_markup' ) && is_home() ) ) :
		do_action( 'himalayas_header_image_markup_render' );
		the_custom_header_markup();
	else :
		if ( get_theme_mod( 'fitclub_slider_activation' ) == 0 ) {
			$header_image = get_header_image();
			?>
			<div class="header-image-wrap">
				<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
			</div>
			<?php
		}

	endif; ?>

	<?php do_action( 'fitclub_after_header' ); ?>

	<div class="body-content-wrapper">

		<?php
		if ( get_theme_mod( 'fitclub_slider_activation' ) == '1' && is_front_page() && ! is_home() ) {
			get_template_part( 'template-parts/content', 'slider' );
		}

		if ( ! is_front_page() && ! is_singular( 'post' ) && ! is_404() ) { ?>
			<div class="page-header clearfix">
				<div class="tg-container">
					<h2 class="entry-title"><?php echo fitclub_header_title(); ?></h2>
				</div>
			</div>
		<?php }
		?>
