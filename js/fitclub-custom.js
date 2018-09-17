jQuery( document ).ready( function() {

	/**
	 * Search.
	 */
	var searchBox = jQuery( '.search-wrapper .header-search-box' ),
		showHideSearch;

	showHideSearch = function( action ) {

		if( 'hide' === action ) {
			searchBox.removeClass( 'active' );

		} else if( 'toggle' === action ) {

			searchBox.toggleClass( 'active' );

			// Focus on input.
			if( searchBox.hasClass( 'active' ) ) {

				setTimeout( function() {
					jQuery( '.header-search-box input.search-field' ).focus();
				}, 500 );

			}

		}

	};

	// Toggle search box on clicking search icon.
	jQuery( '.search-wrapper .search-icon' ).click( function() {
		showHideSearch( 'toggle' );
	} );

	// Hide search box on esc key.
	jQuery( document ).on( 'keyup', function( e ) {

		if( searchBox.hasClass( 'active' ) && e.keyCode === 27 ) {
			showHideSearch( 'hide' );
		}

	} );

	// Hide search box on click close icon.
	jQuery( '.search-wrapper .header-search-box .close' ).click( function() {
		jQuery( '.search-wrapper .header-search-box' ).removeClass( 'active' );
	} );

	/**
	 * Menu.
	 */
	jQuery( '#site-navigation .menu-toggle' ).click( function() {
		jQuery( '#site-navigation .menu' ).slideToggle( 'slow' );
	} );

	jQuery( '#site-navigation .menu-item-has-children' ).append( '<span class="sub-toggle"> <i class="fa fa-angle-right"></i> </span>' );

	jQuery( '#site-navigation .sub-toggle' ).click( function() {
		jQuery( this ).parent( '.menu-item-has-children' ).children( 'ul.sub-menu' ).first().slideToggle( '1000' );
		jQuery( this ).children( '.fa-angle-right' ).first().toggleClass( 'fa-angle-down' );
	} );

	jQuery( '.scrollup' ).click( function() {
		jQuery( 'html, body' ).animate( {
			scrollTop: 0
		}, 2000 );
		return false;
	} );

	if( typeof jQuery.fn.bxSlider !== 'undefined' ) {
		jQuery( '#home-slider .bxslider' ).bxSlider( {
			auto: true,
			mode: 'fade',
			caption: true,
			pagerCustom: '#bx-pager',
			controls: false
		} );

		jQuery( '.widget_testimonial_block .bxslider' ).bxSlider( {
			auto: false,
			pager: false,
			caption: true
		} );

		jQuery( '.blog-slider' ).bxSlider( {
			minSlides: 1,
			maxSlides: 8,
			slideWidth: 380,
			slideMargin: 30,
			pager: false,
			nextText: '<i class="fa fa-angle-right"></i>',
			prevText: '<i class="fa fa-angle-left"></i>'
		} );
	}
} );
jQuery( document ).on( 'click', '#site-navigation .menu li.menu-item-has-children > a', function( event ) {
	var menuClass = jQuery( this ).parent( '.menu-item-has-children' );
	if( !menuClass.hasClass( 'focus' ) ) {
		menuClass.addClass( 'focus' );
		event.preventDefault();
		menuClass.children( '.sub-menu' ).css( {
			'display': 'block'
		} );
	}
} );
