( function( $ ) {
	"use strict";

	var $orderItems = $( '#woocommerce-order-items' ), displayFormat = 'YYYY-MM-DD', checkinDate, checkoutDate, minDate = moment(), 
		maxDate = moment().add( '2', 'months' ), roomDatas = {}, defaultCalendar = { 'startDate': null, 'endDate': null },
		extraServiceTmpl = wp.template( 'loftocean-room-extra-services' );
	// Block order section
	function block() {
		$orderItems.block( {
			message: null,
			overlayCSS: {
				background: '#fff',
				opacity: 0.6
			}
		} );
	}
	// Unblock order section
	function unblock() {
		$orderItems.unblock();
	}
	function getUtils( elem ) {
		var $item = $( elem ).closest( '.edit-cs-room-order-item' );
		if ( ! $item.data( 'utils' ) ) {
			var utils = new loftoceanRoomReservationUtils( $item.data( 'reservation-data' ) ? JSON.parse( Base64.decode( $item.data( 'reservation-data' ) ) ) : {} );
			$item.data( 'utils', utils );

		}
		return $item.data( 'utils' )
	}
	// Checkin datepicker checking before display
	function checkinDates( elem, date ) { 
		var utils = getUtils( elem ); 
		return utils.showCheckinDates( moment( date ) );
	}
	// checkout datepicker checking before display
	function checkoutDates( elem, date ) {
		var utils = getUtils( elem ); 
		return utils.showCheckoutDates( moment( date ), moment( $( elem ).closest( '.form-field-wrapper' ).find( '.cs_check_in_date_field input[type=text]' ).val() ) );
	}
	$( document ).ready( function() {
		// Event handlers
		$orderItems.on( 'click', '.loftocean-room-product-row .cs_check_in_date_field input[type=text]', function( e ) {
			e.preventDefault();
			if ( ! $( this ).data( 'date-picker-inited' ) ) {
				var $this = $( this );
				$this.datepicker( { 
					'dateFormat': 'yy-mm-dd', 
					'minDate': 0, 
					'beforeShowDay': function( d ) {
						var result = checkinDates( $this, d ); 
						if ( result[ 0 ] && ( result[ 1 ].includes( 'checkin' ) || result[ 1 ].includes( 'disabled' ) ) ) {
							result[ 1 ] += ' ui-datepicker-unselectable ui-state-disabled';
						}
						return result;
					},
					'onSelect': function( date, inst ) {
						$this.closest( '.form-field-wrapper' ).find( '.cs_check_out_date_field input[type=text]' ).val( '' );
						$this.trigger( 'change' );
					} 
				} ).datepicker( 'show' ).data( 'date-picker-inited', true );
			}
		} )
		.on( 'click', '.loftocean-room-product-row .cs_check_out_date_field input[type=text]', function( e ) {
			e.preventDefault();
			var $this = $( this );
			if ( ! $this.data( 'date-picker-inited' ) ) {
				$this.datepicker( { 
					'dateFormat': 'yy-mm-dd', 
					'minDate': 1, 
					'beforeShowDay': function( d ) { 
						var result = checkoutDates( $this, d ); 
						if ( result[ 0 ] && ( result[ 1 ].includes( 'checkout' ) || result[ 1 ].includes( 'disabled' ) ) ) {
							result[ 1 ] += ' ui-datepicker-unselectable ui-state-disabled';
						}
						return result;
					},
					'onSelect': function( date, inst ) {
						var utils = getUtils( $this ), $fieldWrap = $this.closest( '.form-field-wrapper' ), 
							checkin = $fieldWrap.find( '.cs_check_in_date_field input[type=text]' ).val(), 
							$roomMessage = $fieldWrap.siblings( '.room-details-fields' ).find( '.description.room-description' ),
							currentList = utils.getEnabledExtraServiceList( checkin, date );  
						if ( false !== currentList ) {
							var $wrap = $this.closest( '.edit-cs-room-order-item' );
							$wrap.find( '.cs_extra_services_field' ).remove();
							if ( Array.isArray( currentList ) && currentList.length ) {
								$wrap.append( extraServiceTmpl( { 'itemID': $this.closest( '.loftocean-room-product-row' ).data( 'order_item_id' ), 'services': currentList, 'selectedServices': utils.data.selectedServices } ) );
							}
						} 
						if ( $roomMessage.length ) { 
							if ( checkin && date ) {
								var currentRoomLimit = utils.getRoomLimitation( checkin, date ); 
								false === currentRoomLimit ? $roomMessage.hide() : $roomMessage.find( '.max-room-number' ).text( currentRoomLimit ).show();
							} else {
								$roomMessage.hide();
							}
						}
						$this.trigger( 'change' );
					}
				} ).datepicker( 'show' ).data( 'date-picker-inited', true );
			}
			if ( ! $this.val() ) {
				var currentCheckinDate = $this.closest( '.form-field-wrapper' ).find( '.cs_check_in_date_field input[type=text]' ).val();
				if ( currentCheckinDate ) {
					var currentCheckinMoment = moment( currentCheckinDate );
					currentCheckinMoment.isValid() ? $this.datepicker( 'setDate', currentCheckinMoment.add( '1', 'day' ).format( displayFormat ) ).val( '' ) : '';
				}
			}
		} )
		.on( 'click', '.button.add-order-room-item', function() {
			$( this ).WCBackboneModal( {
				template: 'wc-modal-add-room'
			} );

			return false;
		} )
		.on( 'change keyup', 'input', function( e ) {
			$( this ).closest( '.edit-cs-room-order-item' ).find( '.room-order-item-status' ).val( 'updated' );
		} )

		var backbone = {
			init: function( e, target ) {
				if ( 'wc-modal-add-room' === target ) {
					$( document.body ).trigger( 'wc-enhanced-select-init' );
				}
			},
			response: function( e, target, data ) {
				if ( 'wc-modal-add-room' === target ) {
					// Build array of data.
					var item_table      = $( this ).find( 'table.widefat' ),
						item_table_body = item_table.find( 'tbody' ),
						rows            = item_table_body.find( 'tr' ),
						add_items       = [];

					$( rows ).each( function() {
						add_items.push( { 'id': $( this ).find( ':input[name="item_id"]' ).val() } );
					} );

					return backbone.add_items( add_items );
				}
			},

			add_items: function( add_items ) {
				block();

				var data = {
					action   : 'loftocean_add_order_room_item',
					order_id : woocommerce_admin_meta_boxes.post_id,
					security : woocommerce_admin_meta_boxes.order_item_nonce,
					data     : add_items
				};

				// Check if items have changed, if so pass them through so we can save them before adding a new item.
				if ( 'true' === $( 'button.cancel-action' ).attr( 'data-reload' ) ) {
					data.items = $( 'table.woocommerce_order_items :input[name], .wc-order-totals-items :input[name]' ).serialize();
				}

				data = this.filter_data( 'add_items', data );

				$.ajax({
					type: 'POST',
					url: woocommerce_admin_meta_boxes.ajax_url,
					data: data,
					success: function( response ) {
						if ( response.success ) {
							$( '#woocommerce-order-items' ).find( '.inside' ).empty();
							$( '#woocommerce-order-items' ).find( '.inside' ).append( response.data.html );

							// Update notes.
							if ( response.data.notes_html ) {
								$( 'ul.order_notes' ).empty();
								$( 'ul.order_notes' ).append( $( response.data.notes_html ).find( 'li' ) );
							}

							// wc_meta_boxes_order_items.reloaded_items();
							unblock();
						} else {
							unblock();
							window.alert( response.data.error );
						}
					},
					complete: function() {
						window.wcTracks.recordEvent( 'order_edit_add_room', {
							order_id: woocommerce_admin_meta_boxes.post_id,
							status: $( '#order_status' ).val()
						} );
					},
					dataType: 'json'
				} );
			},
			filter_data: function( handle, data ) {
				const filteredData = $( '#woocommerce-order-items' )
					.triggerHandler(
						'woocommerce_order_meta_box_${handle}_ajax_data',
						[ data ]
					);

				if ( filteredData ) {
					return filteredData;
				}

				return data;
			}
		};
		$( document.body )
			.on( 'wc_backbone_modal_loaded', backbone.init )
			.on( 'wc_backbone_modal_response', backbone.response );
	} );
} )( jQuery );