/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function( $ ) {
	"use strict";

	
	/* Main Header */
	wp.customize( 'cleanblog_homeintro_image', function( value ) {
		value.bind( function( to ) {

			0 === $.trim( to ).length ?
				$( '.main-head-wrapper' ).css( 'background-image', '' ) :
				$( '.main-head-wrapper' ).css( 'background-image', 'url( ' + to + ')' );

		});
	});

	wp.customize( 'peacock_mainheader_title', function( value ) {
		value.bind( function( to ) {
			$( '.site-heading h2' ).text( to );
		});
	});
	
	wp.customize( 'peacock_mainheader_subtitle', function( value ) {
		value.bind( function( to ) {
			$( '.site-heading p' ).text( to );
		});
	});
	
})( jQuery );