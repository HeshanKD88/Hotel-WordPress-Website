( function( $ ) {
	"use strict";

	function changeItemName( defaultValue, extensions, args ) {
		if ( args[ 'cartItem' ][ 'description' ] && $( args[ 'cartItem' ][ 'description' ] ).find( '.cs-room-order-date' ).length ) {
			return defaultValue + args[ 'cartItem' ][ 'description' ];
		} 
		return defaultValue;
	}

	function changeItemClass( defaultValue, extensions, args ) {
		if ( args[ 'cartItem' ][ 'description' ] && $( args[ 'cartItem' ][ 'description' ] ).find( '.cs-room-order-date' ).length ) {
			return defaultValue + 'cs-room-item';
		} 
		return defaultValue;
	}

	window.wc.blocksCheckout.registerCheckoutFilters( 'example-extension', { itemName: changeItemName, cartItemClass: changeItemClass } );
} ) ( jQuery );