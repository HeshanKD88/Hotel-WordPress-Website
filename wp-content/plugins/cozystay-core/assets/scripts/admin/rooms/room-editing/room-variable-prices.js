( function( $ ) {
	"use strict";
	var $customVariablePricesWrap = $( '.csvp-groups-wrapper' ),
		pricePerPersonEnabled = false,
		showCustomVariablePrices = false,
		$addMoreBtn = $customVariablePricesWrap.find( '.button.new-csvp-item-btn' ),
		byPersonPricesDefaultData = { 'adult_number': '', 'child_number': '', 'guest_number': '', 'price': '', 'weekend_price': '' },
		byNightPricesDefaultData = { 'adult_number': '', 'adult_price': '', 'child_number': '', 'child_price': '', 'guest_number': '', 'price': '', 'weekend_adult_price': '', 'weekend_child_price': '', 'weekend_price': '' },
		defaultData = { 
			'title': loftoceanRoomEditingVariablePrices.i18n.defaultCustomVariablePriceItemTitle, 
			'date_range': [ { 'start_date': '', 'end_date': '' } ], 
			'enable_guest_group': '', 
			'enable_weekend_price': '', 
			'per_person': [ byPersonPricesDefaultData ], 
			'nightly': [ byNightPricesDefaultData ] 
		},
		customVariablePricesData = ( 'undefined' != typeof loftoceanRoomEditingVariablePrices ) && loftoceanRoomEditingVariablePrices.hasOwnProperty( 'custom' ) && loftoceanRoomEditingVariablePrices.custom.length ? loftoceanRoomEditingVariablePrices.custom : [ defaultData ],
		customVariablePriceDateRangeItemTmpl = wp.template( 'loftocean-room-custom-variable-price-date-range-item' ),
		customVariablePriceItemTmpl = wp.template( 'loftocean-room-custom-variable-price-item' ),
		variablePriceItemTmpl = wp.template( 'loftocean-room-variable-prices' );

	if ( $customVariablePricesWrap.length ) {
		var $panel = $( '.panel-wrap.room-data-settings' );
		$panel.on( 'change', 'input[name=loftocean_room_price_by_people]', function( e ) {
			if ( this.checked ) {
				pricePerPersonEnabled = true;
				$customVariablePricesWrap.find( '.variable-price-by-guest.loftocean-variable-price' ).removeClass( 'hide' );
				$customVariablePricesWrap.find( '.variable-price-by-room.loftocean-variable-price' ).addClass( 'hide' );
			} else {
				pricePerPersonEnabled = false;
				$customVariablePricesWrap.find( '.variable-price-by-guest.loftocean-variable-price' ).addClass( 'hide' );
				$customVariablePricesWrap.find( '.variable-price-by-room.loftocean-variable-price' ).removeClass( 'hide' );
			}
		} ).on( 'change', '.csvp-groups-wrapper > .checkbox-field > [type=checkbox]', function( e ) {
			if ( this.checked ) { 
				$( this ).parent().siblings( '.csvp-item, .new-csvp-item-btn' ).removeClass( 'hide' );
				showCustomVariablePrices = true;
			} else { 
				$( this ).parent().siblings( '.csvp-item, .new-csvp-item-btn' ).addClass( 'hide' );
				showCustomVariablePrices = false;
			}
		} ).on( 'click', '.loftocean-variable-price tfoot .button', function( e ) {
			e.preventDefault();
			e.stopPropagation();

			var $btn = $( this ), currentIndex = $btn.data( 'current-index' ), type =$btn.data( 'current-type' ), newItem;
			currentIndex = isNaN( currentIndex ) ? 0 : currentIndex;
			type = [ 'regular', 'per-person' ].includes( type ) ? type : 'regular';

			newItem = variablePriceItemTmpl( { 'index': currentIndex, 'namePrefix': $btn.data( 'name-prefix' ), 'type': type, 'byPersonData': byPersonPricesDefaultData, 'byNightData': byNightPricesDefaultData } );
            if ( newItem.length ) {
                $btn.data( 'current-index', ++ currentIndex );
                $btn.closest( 'table' ).find( 'tbody' ).append( newItem );
            }
		} ).on( 'click', '.loftocean-variable-price .variable-actions .button', function( e ) {
			e.preventDefault();
			e.stopPropagation();
			var $item = $( this ).closest( 'tr' );
			$item.siblings( 'tr' ).length ? $item.remove() : $item.find( 'input' ).val( '' );

		} );

		$customVariablePricesWrap.on( 'click', '.date-range-list-wrap .date-picker', function( e ) {
			if ( ! $( this ).data( 'date-picker-inited' ) ) {
				var $this = $( this );
				$this.datepicker( { 'dateFormat': 'yy-mm-dd' } ).datepicker( 'show' ).data( 'date-picker-inited', true );
			}
		} ).on( 'click', '.csvp-item .csvp-item-header .csvp-item-remove', function( e ) {
			e.preventDefault();
			e.stopPropagation();

			$( this ).closest( '.csvp-item' ).remove();
		} ).on( 'click', '.add-time-slot', function( e ) {
			e.preventDefault();
			e.stopPropagation();
			var $dateRangeWrap = $( this ).closest( '.date-range-list-wrap' ),
				currentIndex = $dateRangeWrap.data( 'current-index' ),
				newItem = customVariablePriceDateRangeItemTmpl( { 'namePrefix': $dateRangeWrap.data( 'name-prefix' ), 'index': currentIndex } );

			if ( newItem ) {
				$( this ).parent().after( newItem );
				$dateRangeWrap.data( ++ currentIndex );
			}

		} ).on( 'click', '.delete-time-slot', function( e ) {
			e.preventDefault();
			e.stopPropagation();
			var $item = $( this ).parent();
			$item.siblings( '.multi-items-wrapper' ).length ? $item.remove() : $item.find( 'input' ).val( '' );
		} ).on( 'keyup', '.csvp-item .item-title-field input', function( e ) {
			var val = $( '<div>' ).html( $( this ).val() ).text();
			$( this ).closest( '.csvp-item-content' ).siblings( '.csvp-item-header' ).find( '.csvp-item-title' ).html( val ? val : '&nbsp;' );
		} ).on( 'click', '.csvp-item .csvp-item-header .csvp-item-toggle.expand', function( e ) {
			e.preventDefault();
			e.stopPropagation();

            var $itemDetails = $( this ).closest( '.csvp-item-header' ).siblings( '.csvp-item-content' );
            if ( $itemDetails.length ) { 
            	$itemDetails.show();
            	$( this ).addClass( 'hidden' ).siblings( '.csvp-item-toggle' ).removeClass( 'hidden' );
            }
		} ).on( 'click', '.csvp-item .csvp-item-header .csvp-item-toggle.fold', function( e ) {
			e.preventDefault();
			e.stopPropagation();

            var $itemDetails = $( this ).closest( '.csvp-item-header' ).siblings( '.csvp-item-content' );
            if ( $itemDetails.length ) { 
            	$itemDetails.hide();
            	$( this ).addClass( 'hidden' ).siblings( '.csvp-item-toggle' ).removeClass( 'hidden' );
            }
		} ).on( 'change', '.enable-person-group', function( e ) {
			var $tables = $( this ).closest( '.controls-row' ).find( '.loftocean-variable-price' );
			this.checked ? $tables.addClass( 'has-guest-group' ) : $tables.removeClass( 'has-guest-group' );
		} ).on( 'change', '.enable-weekend-price', function( e ) {
			var $tables = $( this ).closest( '.controls-row' ).find( '.loftocean-variable-price' );
			this.checked ? $tables.addClass( 'has-weekend-price' ) : $tables.removeClass( 'has-weekend-price' );
		} );

		$addMoreBtn.on( 'click', function( e ) {
			e.preventDefault();
			e.stopPropagation();

			var currentIndex = $addMoreBtn.data( 'current-index' ),
				newItem = customVariablePriceItemTmpl( { 'index': currentIndex, 'list': [ defaultData ], 'priceByPersonEnabled': pricePerPersonEnabled, 'hide': false } );
            if ( newItem ) {
            	var $newItem = $( newItem );
                $addMoreBtn.data( 'current-index', ++ currentIndex );
                $addMoreBtn.before( $newItem );

               	$newItem.find( '.loftocean-variable-price tfoot .button' ).trigger( 'click' );
            }
		} );

		pricePerPersonEnabled = $panel.find( 'input[name=loftocean_room_price_by_people]' )[0].checked;
		showCustomVariablePrices = $( '.csvp-groups-wrapper > .checkbox-field > [type=checkbox]' )[0].checked;
		if ( customVariablePricesData.length ) {
			var currentIndex = $addMoreBtn.data( 'current-index' ), counting = 0;
			customVariablePricesData.forEach( function( cvpd ) {
				var newItem = customVariablePriceItemTmpl( { 'index': currentIndex, 'list': [ cvpd ], 'priceByPersonEnabled': pricePerPersonEnabled, 'hide': ! showCustomVariablePrices, 'hideContent': ( counting > 0 ) } );
	            if ( newItem.length ) {
	            	var $newItem = $( newItem );
	                $addMoreBtn.before( $newItem );
	                currentIndex ++;
	                counting ++;

	                var priceItems = [ { 'type': 'regular', 'property': cvpd.nightly, 'selector': '.variable-price-by-room' }, { 'type': 'per_person', 'property': cvpd.per_person, 'selector': '.variable-price-by-guest' } ];
	                priceItems.forEach( function( pi ) {
	                	var $newBtn = $newItem.find( pi.selector + ' tfoot .button' ),
	                		$newTable = $newItem.find( pi.selector + ' tbody' ),
	                		newItemCount = 0; 
	                	pi.property.forEach( function( p, ii ) {
	                		var pitem = variablePriceItemTmpl( { 'index': ii, 'namePrefix': $newBtn.data( 'name-prefix' ), 'type': pi.type, 'byPersonData': p, 'byNightData': p } );
	                		if ( pitem ) {
	                			$newTable.append( pitem );
	                			newItemCount ++;
	                		}
	                	} );
	                	$newBtn.data( 'current-index', newItemCount );
	                } );
	            }
	        } );
	        $addMoreBtn.data( 'current-index', currentIndex );
		}
		showCustomVariablePrices ? $addMoreBtn.removeClass( 'hide' ) : $addMoreBtn.addClass( 'hide' );

		$customVariablePricesWrap.sortable( {
	    	'items': '> .csvp-item',
	    	'handle': '.csvp-item-header'
	    } );
	}
} )( jQuery );