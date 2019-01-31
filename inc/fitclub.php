<?php
/**
 * FitClub functions and definitions
 *
 * @package    ThemeGrill
 * @subpackage FitClub
 * @since      FitClub 1.0
 */

if ( ! function_exists( 'fitclub_entry_meta' ) ) :
	/**
	 * Display meta description of post.
	 */
	function fitclub_entry_meta() {
		if ( 'post' == get_post_type() && get_theme_mod( 'fitclub_postmeta', '' ) == '' ) :
			echo '<div class="entry-meta">';

			?>
			<?php if ( get_theme_mod( 'fitclub_postmeta_author', '' ) == '' ) { ?>
			<span class="byline author vcard"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo get_the_author(); ?>"><i class="fa fa-user"></i><?php echo esc_html( get_the_author() ); ?></a></span>
		<?php }

			if ( ! post_password_required() && comments_open() && get_theme_mod( 'fitclub_postmeta_comment', '' ) == '' ) { ?>
				<span class="comments-link"><i class="fa fa-comments-o"></i><?php comments_popup_link( esc_html__( '0 Comment', 'fitclub' ), esc_html__( '1 Comment', 'fitclub' ), esc_html__( ' % Comments', 'fitclub' ) ); ?></span>
			<?php }

			if ( has_category() && get_theme_mod( 'fitclub_postmeta_category', '' ) == '' ) { ?>
				<span class="cat-links"><i class="fa fa-folder-open"></i><?php the_category( ', ' ); ?></span>
			<?php }

			$tags_list = get_the_tag_list( '<span class="tag-links">', ', ', '</span>' );
			if ( $tags_list && get_theme_mod( 'fitclub_postmeta_tags', '' ) == '' ) {
				echo $tags_list;
			}

			echo '</div>';
		endif;
	}
endif;

if ( ! function_exists( 'fitclub_layout_class' ) ) :
	/**
	 * Return the layout as selected by user
	 */
	function fitclub_layout_class() {
		global $post;
		$classes = '';

		if ( $post ) {
			$layout_meta = get_post_meta( $post->ID, 'fitclub_page_layout', true );
		}

		if ( is_home() ) {
			$queried_id  = get_option( 'page_for_posts' );
			$layout_meta = get_post_meta( $queried_id, 'fitclub_page_layout', true );
		}

		if ( empty( $layout_meta ) || is_archive() || is_search() ) {
			$layout_meta = 'default_layout';
		}

		$fitclub_default_layout      = get_theme_mod( 'fitclub_default_layout', 'right_sidebar' );
		$fitclub_default_page_layout = get_theme_mod( 'fitclub_default_page_layout', 'right_sidebar' );
		$fitclub_default_post_layout = get_theme_mod( 'fitclub_default_single_post_layout', 'right_sidebar' );

		if ( $layout_meta == 'default_layout' ) {
			if ( is_page() ) {
				if ( $fitclub_default_page_layout == 'right_sidebar' ) {
					$classes = 'right_sidebar';
				} elseif ( $fitclub_default_page_layout == 'left_sidebar' ) {
					$classes = 'left-sidebar';
				} elseif ( $fitclub_default_page_layout == 'no_sidebar_full_width' ) {
					$classes = 'no-sidebar-full-width';
				} elseif ( $fitclub_default_page_layout == 'no_sidebar_content_centered' ) {
					$classes = 'no-sidebar';
				}
			} elseif ( is_single() ) {
				if ( $fitclub_default_post_layout == 'right_sidebar' ) {
					$classes = 'right_sidebar';
				} elseif ( $fitclub_default_post_layout == 'left_sidebar' ) {
					$classes = 'left-sidebar';
				} elseif ( $fitclub_default_post_layout == 'no_sidebar_full_width' ) {
					$classes = 'no-sidebar-full-width';
				} elseif ( $fitclub_default_post_layout == 'no_sidebar_content_centered' ) {
					$classes = 'no-sidebar';
				}
			} elseif ( $fitclub_default_layout == 'right_sidebar' ) {
				$classes = 'right_sidebar';
			} elseif ( $fitclub_default_layout == 'left_sidebar' ) {
				$classes = 'left-sidebar';
			} elseif ( $fitclub_default_layout == 'no_sidebar_full_width' ) {
				$classes = 'no-sidebar-full-width';
			} elseif ( $fitclub_default_layout == 'no_sidebar_content_centered' ) {
				$classes = 'no-sidebar';
			}
		} elseif ( $layout_meta == 'right_sidebar' ) {
			$classes = 'right_sidebar';
		} elseif ( $layout_meta == 'left_sidebar' ) {
			$classes = 'left-sidebar';
		} elseif ( $layout_meta == 'no_sidebar_full_width' ) {
			$classes = 'no-sidebar-full-width';
		} elseif ( $layout_meta == 'no_sidebar_content_centered' ) {
			$classes = 'no-sidebar';
		}

		return $classes;
	}
endif;

if ( ! function_exists( 'fitclub_sidebar_select' ) ) :
	/**
	 * Function to select the sidebar
	 */
	function fitclub_sidebar_select() {
		global $post;

		if ( $post ) {
			$layout_meta = get_post_meta( $post->ID, 'fitclub_page_layout', true );
		}

		if ( is_home() ) {
			$queried_id  = get_option( 'page_for_posts' );
			$layout_meta = get_post_meta( $queried_id, 'fitclub_page_layout', true );
		}

		if ( empty( $layout_meta ) || is_archive() || is_search() ) {
			$layout_meta = 'default_layout';
		}

		$fitclub_default_layout      = get_theme_mod( 'fitclub_default_layout', 'right_sidebar' );
		$fitclub_default_page_layout = get_theme_mod( 'fitclub_default_page_layout', 'right_sidebar' );
		$fitclub_default_post_layout = get_theme_mod( 'fitclub_default_single_post_layout', 'right_sidebar' );

		if ( $layout_meta == 'default_layout' ) {
			if ( is_page() ) {
				if ( $fitclub_default_page_layout == 'right_sidebar' ) {
					get_template_part( 'sidebar/right' );
				} elseif ( $fitclub_default_page_layout == 'left_sidebar' ) {
					get_template_part( 'sidebar/left' );
				}
			} elseif ( is_single() ) {
				if ( $fitclub_default_post_layout == 'right_sidebar' ) {
					get_template_part( 'sidebar/right' );
				} elseif ( $fitclub_default_post_layout == 'left_sidebar' ) {
					get_template_part( 'sidebar/left' );
				}
			} elseif ( $fitclub_default_layout == 'right_sidebar' ) {
				get_template_part( 'sidebar/right' );
			} elseif ( $fitclub_default_layout == 'left_sidebar' ) {
				get_template_part( 'sidebar/left' );
			}
		} elseif ( $layout_meta == 'right_sidebar' ) {
			get_template_part( 'sidebar/right' );
		} elseif ( $layout_meta == 'left_sidebar' ) {
			get_template_part( 'sidebar/left' );
		}
	}
endif;

/**
 * Change hex code to RGB
 * Source: https://css-tricks.com/snippets/php/convert-hex-to-rgb/#comment-1052011
 */
function fitclub_hex2rgb( $hexstr ) {
	$int = hexdec( $hexstr );
	$rgb = array( "red" => 0xFF & ( $int >> 0x10 ), "green" => 0xFF & ( $int >> 0x8 ), "blue" => 0xFF & $int );
	$r   = $rgb['red'];
	$g   = $rgb['green'];
	$b   = $rgb['blue'];

	return "rgba($r,$g,$b, 0.85)";
}

/**
 * Generate darker color
 * Source: http://stackoverflow.com/questions/3512311/how-to-generate-lighter-darker-color-with-php
 */
function fitclub_darkcolor( $hex, $steps ) {
	// Steps should be between -255 and 255. Negative = darker, positive = lighter
	$steps = max( - 255, min( 255, $steps ) );

	// Normalize into a six character long hex string
	$hex = str_replace( '#', '', $hex );
	if ( strlen( $hex ) == 3 ) {
		$hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
	}

	// Split into three parts: R, G and B
	$color_parts = str_split( $hex, 2 );
	$return      = '#';

	foreach ( $color_parts as $color ) {
		$color  = hexdec( $color ); // Convert to decimal
		$color  = max( 0, min( 255, $color + $steps ) ); // Adjust color
		$return .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT ); // Make two char hex code
	}

	return $return;
}

add_action( 'wp_head', 'fitclub_custom_css', 100 );
/**
 * Hooks the Custom Internal CSS to head section
 */
function fitclub_custom_css() {

	$primary_color   = esc_attr( get_theme_mod( 'fitclub_primary_color', '#32c4d1' ) );
	$primary_opacity = fitclub_hex2rgb( $primary_color );
	$primary_dark    = fitclub_darkcolor( $primary_color, - 20 );

	$fitclub_internal_css = '';
	if ( $primary_color != '#32c4d1' ) {
		$fitclub_internal_css = '
.navigation .nav-links a,.bttn,button,input[type="button"],input[type="reset"],input[type="submit"],.navigation .nav-links a:hover,.bttn:hover,button,input[type="button"]:hover,input[type="reset"]:hover,input[type="submit"]:hover,.reply .comment-reply-link,.comment-reply-link:hover,.form-submit .submit:hover,#site-navigation ul li > a:before,#site-navigation ul li > a:before,.slider-caption-wrapper .caption-title::after,.tg-tribe-events-list-widget .section-title,.tg-tribe-events-list-widget .section-title::after,.tg-tribe-events-list-widget .tribe-events-widget-link ,#tribe-events .tribe-events-button,#tribe-events .tribe-events-button:hover,#tribe_events_filters_wrapper input[type="submit"],.tribe-events-button,.tribe-events-button.tribe-active:hover,.datepicker table tr td span:hover,.datepicker-months th:hover,.datepicker thead tr:first-child th:hover,.datepicker tfoot tr th:hover ,#tribe-events-content .tribe-events-calendar td.tribe-events-present.mobile-active:hover,.tribe-events-calendar td.tribe-events-present.mobile-active,.tribe-events-calendar td.tribe-events-present.mobile-active div[id*="tribe-events-daynum-"],.tribe-events-calendar td.tribe-events-present.mobile-active div[id*="tribe-events-daynum-"] a ,.tribe-events-notices,#tribe-events .tribe-events-button,#tribe-events .tribe-events-button:hover,#tribe_events_filters_wrapper input[type="submit"],.tribe-events-button,.tribe-events-button.tribe-active:hover,.tribe-events-button.tribe-inactive,.tribe-events-button:hover,.tribe-events-calendar td.tribe-events-present div[id*="tribe-events-daynum-"],.tribe-events-calendar td.tribe-events-present div[id*="tribe-events-daynum-"] > a ,#tribe-events-content .tribe-events-calendar .mobile-active:hover,#tribe-events-content .tribe-events-calendar td.tribe-events-othermonth.mobile-active,#tribe-events-content .tribe-events-calendar td.tribe-events-othermonth.mobile-active div[id*="tribe-events-daynum-"],#tribe-events-content .tribe-events-calendar td.tribe-events-othermonth.mobile-active div[id*="tribe-events-daynum-"] a,.tribe-events-calendar .mobile-active div[id*="tribe-events-daynum-"],.tribe-events-calendar .mobile-active div[id*="tribe-events-daynum-"] a,.tribe-events-calendar td.mobile-active,.class-title:before,.class-title:hover:before,.widget_service_block .class-read-more:hover,.widget_about_block .about-btn:hover,.widget_testimonial_block .bx-controls a:hover ,.widget_call_to_action_block .cta-readmore:hover ,.blog-desc-wrap:after,.blog-title:hover:after ,.trainer-readmore:hover,.posted-on:hover .month,.blog-content-wrapper .post-date,.page-header,.previous a::after,.next a::after { background: ' . $primary_color . ' } a ,.logged-in-as a,.widget_archive a:hover::before,.widget_categories a:hover:before,.widget_pages a:hover:before,.widget_meta a:hover:before,.widget_recent_comments a:hover:before,.widget_recent_entries a:hover:before,.widget_rss a:hover:before,.widget_nav_menu a:hover:before,.widget_archive li a:hover,.widget_categories li a:hover,.widget_pages li a:hover,.widget_meta li a:hover,.widget_recent_comments li a:hover,.widget_recent_entries li a:hover,.widget_rss li a:hover,.widget_nav_menu li a:hover,.widget_tag_cloud a:hover ,#site-navigation ul li:hover a,#site-navigation ul li.current-menu-item a,#site-navigation ul li.current-menu-ancestor a,.slider-caption-wrapper .caption-sub,.slider-caption-wrapper .slider-readmore:hover,#tribe-events-content .tribe-events-calendar div[id*="tribe-events-event-"] h3.tribe-events-month-event-title a:hover,#tribe-events-content .tribe-events-tooltip h4,#tribe_events_filters_wrapper .tribe_events_slider_val,.single-tribe_events a.tribe-events-gcal,.single-tribe_events a.tribe-events-ical,.section-title span:before,.section-title span::after,.class-title a:hover,.about-title span,.about-btn-wrapper::before,.testimonial-desc::before,.blog-title a:hover,.blog-readmore:hover,.blog-wrapper .bx-controls a i:hover,#top-footer .widget-title span:before,#top-footer .widget-title span::after,#top-footer .footer-block li:hover a,#top-footer .footer-block li:hover:before,#top-footer .widget_tag_cloud a:hover,#bottom-footer li a:hover,#bottom-footer .copyright a:hover,.trainer-page-title a:hover,.entry-title a:hover,.single-page-header .entry-title,.search-icon:hover i,#site-navigation .menu-toggle:hover::before,.entry-meta a:hover,.previous a, .next a { color: ' . $primary_color . ' } #site-navigation ul.sub-menu li.current-menu-item >a,#site-navigation ul.sub-menu li.current-menu-ancestor > a,#site-navigation ul.sub-menu > li:hover > a,.trainer-img img,.trainer-readmore:hover,.widget_tag_cloud a:hover,.slider-caption-wrapper .slider-readmore:hover,#home-slider #bx-pager a.active,#home-slider #bx-pager a:hover,.widget_about_block .about-btn:hover,.widget_testimonial_block .bx-controls a:hover,.widget_call_to_action_block .cta-readmore:hover,.blog-wrapper .bx-controls a i:hover,.testimonial-image,.page-template-template-team .entry-thumbnail,.tribe-events-notices,#top-footer .widget_tag_cloud a:hover,#header-text #site-description,.previous a, .next a{ border-color: ' . $primary_color . ' }.tg-tribe-events-list-widget .section-title::before{ border-left-color:' . $primary_color . ' } .class-content-wrapper{ border-top-color:' . $primary_color . ' } .trainer-content-wrapper, .scrollup{ background: ' . $primary_opacity . ' } .posted-on:hover .date,.navigation .nav-links a:hover,.bttn:hover, button:hover, input[type="button"]:hover,input[type="reset"]:hover,input[type="submit"]:hover,.sub-toggle,#site-navigation ul.sub-menu li.current-menu-item >a,#site-navigation ul.sub-menu li.current-menu-ancestor > a,#site-navigation ul.sub-menu > li:hover > a { background: ' . $primary_dark . ' }
	a:hover,a:focus,a:active, #site-title a:hover{ color: ' . $primary_dark . '; }.sub-toggle { border-color: ' . $primary_dark . '; } @media (max-width: 767px) { #site-navigation ul li:hover a,#site-navigation ul li.current-menu-item a,#site-navigation ul li.current-menu-ancestor a,.scrollup,.scrollup:hover,.scrollup:active,.scrollup:focus { color:#ffffff; } #site-navigation ul li:hover,#site-navigation ul li.current-menu-item,#site-navigation ul li.current-menu-ancestor,#site-navigation ul.sub-menu li.current-menu-item,#site-navigation ul.sub-menu li.current-menu-ancestor,#site-navigation ul.sub-menu > li:hover { background:' . $primary_color . '}
	}';
	}

	if ( ! empty( $fitclub_internal_css ) ) {
		?>
		<style type="text/css"><?php echo $fitclub_internal_css; ?></style>
		<?php
	}

	$fitclub_custom_css = get_theme_mod( 'fitclub_custom_css' );
	if ( $fitclub_custom_css && ! function_exists( 'wp_update_custom_css_post' ) ) {
		echo '<!-- ' . get_bloginfo( 'name' ) . ' Custom Styles -->';
		?>
		<style type="text/css"><?php echo esc_html( $fitclub_custom_css ); ?></style>
		<?php
	}
}

add_action( 'fitclub_footer_copyright', 'fitclub_footer_copyright_info', 10 );
/**
 * Function to show the footer info, copyright information
 */
if ( ! function_exists( 'fitclub_footer_copyright_info' ) ) :
	function fitclub_footer_copyright_info() {
		$site_link = '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" >' . get_bloginfo( 'name', 'display' ) . '</a>';

		$tg_link = '<a href="' . 'https://themegrill.com/themes/fitclub' . '" target="_blank" title="' . esc_attr__( 'ThemeGrill', 'fitclub' ) . '" rel="author">' . esc_html__( 'ThemeGrill', 'fitclub' ) . '</a>';

		$default_footer_value = '<span class="copyright-text">' . sprintf( esc_html__( 'Copyright &copy; %1$s %2$s.', 'fitclub' ), date( 'Y' ), $site_link ) . ' ' . sprintf( esc_html__( 'Design By: %1$s', 'fitclub' ), $tg_link ) . '</span>';

		$fitclub_footer_copyright_info = '<div class="copyright">' . $default_footer_value . '</div>';
		echo $fitclub_footer_copyright_info;
	}
endif;

if ( ! function_exists( 'fitclub_header_title' ) ) :
	/**
	 * Render header title for the header bar
	 */
	function fitclub_header_title() {
		if ( is_archive() ) {
			if ( fitclub_is_tribe_page() ) {
				$fitclub_header_title = tribe_get_events_title();
			} else {
				$fitclub_header_title = get_the_archive_title();
			}
		} elseif ( is_404() ) {
			$fitclub_header_title = esc_html__( 'Page NOT Found', 'fitclub' );
		} elseif ( is_search() ) {
			$search_title         = sprintf( esc_html__( 'Search Results for: %s', 'fitclub' ), '<span>' . get_search_query() . '</span>' );
			$fitclub_header_title = $search_title;
		} elseif ( is_page() ) {
			$fitclub_header_title = get_the_title();
		} elseif ( is_single() ) {
			$fitclub_header_title = get_the_title();
		} elseif ( is_home() ) {
			$queried_id           = get_option( 'page_for_posts' );
			$fitclub_header_title = get_the_title( $queried_id );
		} else {
			$fitclub_header_title = '';
		}

		return $fitclub_header_title;

	}
endif;

if ( ! function_exists( 'fitclub_tribe_alter_event_archive_titles' ) ) :
	/*
	 * Alters event's archive titles
	 */
	function fitclub_tribe_alter_event_archive_titles( $depth ) {

		// Modify the titles here
		// Some of these include %1$s and %2$s, these will be replaced with relevant dates
		$title_upcoming = esc_html__( 'Upcoming Events', 'fitclub' ); // List View: Upcoming events
		$title_past     = esc_html__( 'Past Events', 'fitclub' ); // List view: Past events
		$title_range    = esc_html__( 'Events for %1$s - %2$s', 'fitclub' ); // List view: range of dates being viewed
		$title_month    = esc_html__( 'Events for %1$s', 'fitclub' ); // Month View, %1$s = the name of the month
		$title_day      = esc_html__( 'Events for %1$s', 'fitclub' ); // Day View, %1$s = the day
		$title_all      = esc_html__( 'All events for %s', 'fitclub' ); // showing all recurrences of an event, %s = event title
		$title_week     = esc_html__( 'Events for week of %s', 'fitclub' ); // Week view

		// Don't modify anything below this unless you know what it does
		global $wp_query;
		$tribe_ecp   = Tribe__Events__Main::instance();
		$date_format = apply_filters( 'tribe_events_pro_page_title_date_format', tribe_get_date_format( true ) );

		// Default Title
		$title = $title_upcoming;

		// If there's a date selected in the tribe bar, show the date range of the currently showing events
		if ( isset( $_REQUEST['tribe-bar-date'] ) && $wp_query->have_posts() ) {

			if ( $wp_query->get( 'paged' ) > 1 ) {
				// if we're on page 1, show the selected tribe-bar-date as the first date in the range
				$first_event_date = tribe_get_start_date( $wp_query->posts[0], false );
			} else {
				//otherwise show the start date of the first event in the results
				$first_event_date = tribe_format_date( $_REQUEST['tribe-bar-date'], false );
			}

			$last_event_date = tribe_get_end_date( $wp_query->posts[ count( $wp_query->posts ) - 1 ], false );
			$title           = sprintf( $title_range, $first_event_date, $last_event_date );
		} elseif ( tribe_is_past() ) {
			$title = $title_past;
		}

		// Month view title
		if ( tribe_is_month() ) {
			$title = sprintf(
				$title_month,
				date_i18n( tribe_get_option( 'monthAndYearFormat', 'F Y' ), strtotime( tribe_get_month_view_date() ) )
			);
		}

		// Single view title
		if ( tribe_is_event() && is_single() ) {
			$title = get_the_title();
		}

		// Day view title
		if ( tribe_is_day() ) {
			$title = sprintf(
				$title_day,
				date_i18n( tribe_get_date_format( true ), strtotime( $wp_query->get( 'start_date' ) ) )
			);
		}

		// All recurrences of an event
		if ( function_exists( 'tribe_is_showing_all' ) && tribe_is_showing_all() ) {
			$title = sprintf( $title_all, get_the_title() );
		}

		// Week view title
		if ( function_exists( 'tribe_is_week' ) && tribe_is_week() ) {
			$title = sprintf(
				$title_week,
				date_i18n( $date_format, strtotime( tribe_get_first_week_day( $wp_query->get( 'start_date' ) ) ) )
			);
		}

		if ( is_tax( $tribe_ecp->get_event_taxonomy() ) && $depth ) {
			$cat   = get_queried_object();
			$title = $cat->name;
		}

		return $title;
	}
endif;

add_filter( 'tribe_get_events_title', 'fitclub_tribe_alter_event_archive_titles', 11, 2 );

if ( ! function_exists( 'fitclub_is_tribe_page' ) ) :
	/* Check if current page is a tribe page (listing, single ...) */
	function fitclub_is_tribe_page() {
		wp_reset_postdata();//reset custom query
		if ( class_exists( 'TRIBE__EVENTS__MAIN' ) ) {
			if ( tribe_is_month() && ! is_tax() ) { // Month View Page
				return true;
			} elseif ( tribe_is_month() && is_tax() ) { // Month View Category Page

				return true;

			} elseif ( tribe_is_past() || tribe_is_upcoming() && ! is_tax() ) { // List View Page

				return true;

			} elseif ( tribe_is_past() || tribe_is_upcoming() && is_tax() ) { // List View Category Page

				return true;

			} elseif ( tribe_is_day() && ! is_tax() ) { // Day View Page

				return true;

			} elseif ( tribe_is_day() && is_tax() ) { // Day View Category Page

				return true;

			} elseif ( tribe_is_event() && is_single() ) { // Single Events

				return true;

			}
		}

		return false;
	}
endif;

// Displays the site logo
if ( ! function_exists( 'fitclub_the_custom_logo' ) ) {
	/**
	 * Displays the optional custom logo.
	 */
	function fitclub_the_custom_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}
	}
}

/**
 * Migrate any existing theme CSS codes added in Customize Options to the core option added in WordPress 4.7
 */
function fitclub_custom_css_migrate() {
	if ( function_exists( 'wp_update_custom_css_post' ) ) {
		$custom_css = get_theme_mod( 'fitclub_custom_css' );
		if ( $custom_css ) {
			$core_css = wp_get_custom_css(); // Preserve any CSS already added to the core option.
			$return   = wp_update_custom_css_post( $core_css . $custom_css );
			if ( ! is_wp_error( $return ) ) {
				// Remove the old theme_mod, so that the CSS is stored in only one place moving forward.
				remove_theme_mod( 'fitclub_custom_css' );
			}
		}
	}
}

add_action( 'after_setup_theme', 'fitclub_custom_css_migrate' );

/*
 *Related posts.
 */
if ( ! function_exists( 'fitclub_related_posts_function' ) ) {

	function fitclub_related_posts_function() {
		wp_reset_postdata();
		global $post;

		// Define shared post arguments
		$args = array(
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
			'ignore_sticky_posts'    => 1,
			'orderby'                => 'rand',
			'post__not_in'           => array( $post->ID ),
			'posts_per_page'         => 3,
		);

		// Related by categories.
		if ( get_theme_mod( 'fitclub_related_posts', 'categories' ) == 'categories' ) {
			$cats                 = wp_get_post_categories( $post->ID, array( 'fields' => 'ids' ) );
			$args['category__in'] = $cats;
		}

		// Related by tags.
		if ( get_theme_mod( 'fitclub_related_posts', 'categories' ) == 'tags' ) {
			$tags            = wp_get_post_tags( $post->ID, array( 'fields' => 'ids' ) );
			$args['tag__in'] = $tags;

			if ( ! $tags ) {
				$break = true;
			}
		}

		$query = ! isset( $break ) ? new WP_Query( $args ) : new WP_Query();

		return $query;
	}
}

if ( ! function_exists( 'fitclub_pingback_header' ) ) :

	/**
	 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
	 */
	function fitclub_pingback_header() {
		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
		}
	}

endif;

add_action( 'wp_head', 'fitclub_pingback_header' );
