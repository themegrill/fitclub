/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function ( $ ) {
	// Site title
	wp.customize( 'blogname', function ( value ) {
		value.bind( function ( to ) {
			$( '#site-title a' ).text( to );
		} );
	} );

	// Site description.
	wp.customize( 'blogdescription', function ( value ) {
		value.bind( function ( to ) {
			$( '#site-description' ).text( to );
		} );
	} );

	// Primary color option
	wp.customize( 'fitclub_primary_color', function ( value ) {
		value.bind( function ( primaryColor ) {
			// Store internal style for primary color
			var primaryColorStyle = '<style id="fitclub-internal-primary-color"> .navigation .nav-links a,' +
			'.bttn,button,input[type="button"],input[type="reset"],input[type="submit"],.navigation .nav-links a:hover,' +
			'.bttn:hover,button,input[type="button"]:hover,input[type="reset"]:hover,input[type="submit"]:hover,.reply .comment-reply-link,' +
			'.comment-reply-link:hover,.form-submit .submit:hover,#site-navigation ul li > a:before,#site-navigation ul li > a:before,' +
			'.slider-caption-wrapper .caption-title::after,.tg-tribe-events-list-widget .section-title,.tg-tribe-events-list-widget .section-title::after,' +
			'.tg-tribe-events-list-widget .tribe-events-widget-link ,#tribe-events .tribe-events-button,#tribe-events .tribe-events-button:hover,#tribe_events_filters_wrapper input[type="submit"],' +
			'.tribe-events-button,.tribe-events-button.tribe-active:hover,.datepicker table tr td span:hover,.datepicker-months th:hover,.datepicker thead tr:first-child th:hover,' +
			'.datepicker tfoot tr th:hover ,#tribe-events-content .tribe-events-calendar td.tribe-events-present.mobile-active:hover,.tribe-events-calendar td.tribe-events-present.mobile-active,' +
			'.tribe-events-calendar td.tribe-events-present.mobile-active div[id*="tribe-events-daynum-"],.tribe-events-calendar td.tribe-events-present.mobile-active div[id*="tribe-events-daynum-"] a ,' +
			'.tribe-events-notices,#tribe-events .tribe-events-button,#tribe-events .tribe-events-button:hover,#tribe_events_filters_wrapper input[type="submit"],.tribe-events-button,' +
			'.tribe-events-button.tribe-active:hover,.tribe-events-button.tribe-inactive,.tribe-events-button:hover,.tribe-events-calendar td.tribe-events-present div[id*="tribe-events-daynum-"],' +
			'.tribe-events-calendar td.tribe-events-present div[id*="tribe-events-daynum-"] > a ,#tribe-events-content .tribe-events-calendar .mobile-active:hover,' +
			'#tribe-events-content .tribe-events-calendar td.tribe-events-othermonth.mobile-active,#tribe-events-content .tribe-events-calendar td.tribe-events-othermonth.mobile-active div[id*="tribe-events-daynum-"],' +
			'#tribe-events-content .tribe-events-calendar td.tribe-events-othermonth.mobile-active div[id*="tribe-events-daynum-"] a,.tribe-events-calendar .mobile-active div[id*="tribe-events-daynum-"],' +
			'.tribe-events-calendar .mobile-active div[id*="tribe-events-daynum-"] a,.tribe-events-calendar td.mobile-active,.class-title:before,.class-title:hover:before,.widget_service_block .class-read-more:hover,' +
			'.widget_about_block .about-btn:hover,.widget_testimonial_block .bx-controls a:hover ,.widget_call_to_action_block .cta-readmore:hover ,.blog-desc-wrap:after,.blog-title:hover:after ,.trainer-readmore:hover,' +
			'.posted-on:hover .month,.blog-content-wrapper .post-date,.page-header,.previous a::after,.next a::after { background: ' + primaryColor + ' } ' +
			'a ,.logged-in-as a,.widget_archive a:hover::before,' +
			'.widget_categories a:hover:before,.widget_pages a:hover:before,.widget_meta a:hover:before,.widget_recent_comments a:hover:before,.widget_recent_entries a:hover:before,.widget_rss a:hover:before,' +
			'.widget_nav_menu a:hover:before,.widget_archive li a:hover,.widget_categories li a:hover,.widget_pages li a:hover,.widget_meta li a:hover,.widget_recent_comments li a:hover,.widget_recent_entries li a:hover,' +
			'.widget_rss li a:hover,.widget_nav_menu li a:hover,.widget_tag_cloud a:hover ,#site-navigation ul li:hover a,#site-navigation ul li.current-menu-item a,#site-navigation ul li.current-menu-ancestor a,.slider-caption-wrapper .caption-sub,' +
			'.slider-caption-wrapper .slider-readmore:hover,#tribe-events-content .tribe-events-calendar div[id*="tribe-events-event-"] h3.tribe-events-month-event-title a:hover,#tribe-events-content .tribe-events-tooltip h4,#tribe_events_filters_wrapper .tribe_events_slider_val,' +
			'.single-tribe_events a.tribe-events-gcal,.single-tribe_events a.tribe-events-ical,.section-title span:before,.section-title span::after,.class-title a:hover,.about-title span,.about-btn-wrapper::before,.testimonial-desc::before,.blog-title a:hover,.blog-readmore:hover,' +
			'.blog-wrapper .bx-controls a i:hover,#top-footer .widget-title span:before,#top-footer .widget-title span::after,#top-footer .footer-block li:hover a,#top-footer .footer-block li:hover:before,#top-footer .widget_tag_cloud a:hover,#bottom-footer li a:hover,' +
			'#bottom-footer .copyright a:hover,.trainer-page-title a:hover,.entry-title a:hover,.single-page-header .entry-title,.search-icon:hover i,#site-navigation .menu-toggle:hover::before,.entry-meta a:hover,.previous a, .next a { color: ' + primaryColor + ' }' +
			'#site-navigation ul.sub-menu li.current-menu-item >a,#site-navigation ul.sub-menu li.current-menu-ancestor > a,#site-navigation ul.sub-menu > li:hover > a,.trainer-img img,.trainer-readmore:hover,.widget_tag_cloud a:hover,.slider-caption-wrapper .slider-readmore:hover,' +
			'#home-slider #bx-pager a.active,#home-slider #bx-pager a:hover,.widget_about_block .about-btn:hover,.widget_testimonial_block .bx-controls a:hover,.widget_call_to_action_block .cta-readmore:hover,.blog-wrapper .bx-controls a i:hover,.testimonial-image,' +
			'.page-template-template-team .entry-thumbnail,.tribe-events-notices,#top-footer .widget_tag_cloud a:hover,#header-text #site-description,.previous a, .next a{ border-color: ' + primaryColor + ' }' +
			'.tg-tribe-events-list-widget .section-title::before{ border-left-color:' + primaryColor + ' }' +
			'.class-content-wrapper{ border-top-color:' + primaryColor + ' }' +
			'@media (max-width: 767px) { #site-navigation ul li:hover a,#site-navigation ul li.current-menu-item a,#site-navigation ul li.current-menu-ancestor a,' +
			'.scrollup,.scrollup:hover,.scrollup:active,.scrollup:focus { color:#ffffff; } #site-navigation ul li:hover,#site-navigation ul li.current-menu-item,#site-navigation ul li.current-menu-ancestor,' +
			'#site-navigation ul.sub-menu li.current-menu-item,#site-navigation ul.sub-menu li.current-menu-ancestor,#site-navigation ul.sub-menu > li:hover { background:' + primaryColor + '}</style>';

			// Remove previously create internal style and add new one.
			$( 'head #fitclub-internal-primary-color' ).remove();
			$( 'head' ).append( primaryColorStyle );
		}
		);
	} );
})( jQuery );