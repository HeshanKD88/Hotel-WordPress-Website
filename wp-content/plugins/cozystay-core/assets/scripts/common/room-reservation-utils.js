( function( $, window ) {
	"use strict";

	var dateFormat = 'YYYY-MM-DD', dayTime = 86400, todayTimestamp,
		i18nText = loftoceanRoomReservationUtilsData.i18nText;

	function getTimeStamp( date ) { 
        if ( typeof date != 'undefined' && ! date.getTime ) {
            date = new Date();
        }
        return Math.floor( date.getTime() / dayTime / 1000 ) * dayTime;
    }

    todayTimestamp = getTimeStamp( '' );

	window.loftoceanRoomReservationUtils = function( d ) { 
		this.setData( d );
		this.setDisabledDates();
	}

	window.loftoceanDatePickerValidate = {
		'instance': false,
		'defaultDates': false,
		'checkDefaultDates': function( checkin, checkout ) {
			if ( false !== this.defaultDates ) return this.defaultDates;

			var self = this, i = 0, j = 0, max = 90, currentStartDate = checkin.clone(), currentEndDate = null;
			while ( i ++ < max ) {
				var startDateStatus = this.checkDate( currentStartDate, { 'startDate': null, 'endDate': null } );
				if ( ( ! startDateStatus[0] ) || ( startDateStatus[1] && startDateStatus[1].split( ' ' ).includes( 'checkin-unavailable' ) ) ) {
					currentStartDate.add( '1', 'day' );
					continue;
				}

				j = 0; currentEndDate = currentStartDate.clone().add( '1', 'day' );
				var checkoutValidationArgs = { 'startDate': currentStartDate, 'endDate': null };
				while ( j ++ < max ) {
					var endDateStatus = this.checkDate( currentEndDate, checkoutValidationArgs );
					if ( ( ! endDateStatus[0] ) || ( endDateStatus[1] && endDateStatus[ 1 ].split( ' ' ).includes( 'checkout-unavailable' ) ) ) {
						currentEndDate.add( '1', 'day' );
						continue;
					}
					self.defaultDates = { 'checkin': currentStartDate, 'checkout': currentEndDate };
					return self.defaultDates;
				}
				currentStartDate.add( '1', 'day' );
			}
			this.defaultDates = { 'checkin': checkin, 'checkout': checkout };
			return this.defaultDates;
		},
		'checkDate': function( date, drp ) {
			if ( false == this.instance ) {
				this.instance = new loftoceanRoomReservationUtils( { 'unavailableDates': loftoceanRoomReservationUtilsData.allRoomsUnavailableDates, 'priceList': {} } );
			}
			date = date.format( dateFormat );
			if ( typeof drp === 'undefined' || ( ( null === drp.startDate ) && ( null !== drp.endDate ) ) ) { 
				return [ true, '', '' ];
			} else { 
				var notSetEndDateYet = ( typeof drp !== 'undefined' && null !== drp.startDate && null === drp.endDate ),
					d = new Date( date ), dayOfWeek = 'day' + d.getDay(), currentTimstamp = getTimeStamp( d ), classes = [], messages = [],
					checkinRuleItem = false, currentDateRuleItem = this.instance.getMatchedBookingRule( currentTimstamp ); 

				checkinRuleItem = notSetEndDateYet ? this.instance.getMatchedBookingRule( getTimeStamp( new Date( drp.startDate.format( dateFormat ) ) ) ) : false;  

				if ( false !== currentDateRuleItem ) {
					if ( currentDateRuleItem.checkin && currentDateRuleItem.checkin.length && currentDateRuleItem.checkin.includes( dayOfWeek ) ) {
						classes.push( 'no-checkin', 'checkin-unavailable' );
						messages.push( i18nText.noCheckin );
					}

					if ( notSetEndDateYet ) {
						if ( currentDateRuleItem.checkout && currentDateRuleItem.checkout.length && currentDateRuleItem.checkout.includes( dayOfWeek ) ) {
							classes.push( 'no-checkout', 'checkout-unavailable' );
							messages.push( i18nText.noCheckout );
						}
					} else {
						if ( currentDateRuleItem[ 'in_advance' ] ) {
							let inAdvanceItem = currentDateRuleItem[ 'in_advance' ];
							if ( inAdvanceItem.min && ( ( ( currentTimstamp - todayTimestamp ) / dayTime ) < inAdvanceItem.min ) ) {
								classes.push( 'disabled', 'checkin-unavailable' );
							}
							if ( inAdvanceItem.max && ( ( ( currentTimstamp - todayTimestamp ) / dayTime ) > inAdvanceItem.max ) ) {
								classes.push( 'checkin-unavailable' );
								if ( ( 'undefined' === typeof drp ) || ( null === drp.startDate || null !== drp.endDate ) ) {
									classes.push( 'disabled' );
								}
							}
						}
					}
				}

				if ( ( false !== checkinRuleItem ) && notSetEndDateYet && checkinRuleItem[ 'stay_length' ] ) {
					var startDateTimestamp = getTimeStamp( new Date( drp.startDate.format( dateFormat ) ) ),
						startDayOfWeek = 'day' + drp.startDate.day();

					if ( currentTimstamp > startDateTimestamp ) {
						let stayLengthItem = checkinRuleItem[ 'stay_length' ], daysAfterStart = ( currentTimstamp - startDateTimestamp ) / dayTime;

						if ( stayLengthItem[ startDayOfWeek ] ) {
							if ( stayLengthItem[ startDayOfWeek ][ 'min' ] && ( daysAfterStart < stayLengthItem[ startDayOfWeek ][ 'min' ] ) ) {
								classes.push( 'minimal-stay-unavailable', 'checkout-unavailable' );
								messages.push( stayLengthItem[ startDayOfWeek ][ 'min' ] + i18nText.minimum );
							}
							if ( stayLengthItem[ startDayOfWeek ][ 'max' ] && ( daysAfterStart > stayLengthItem[ startDayOfWeek ][ 'max' ] ) ) {
								classes.push( 'off', 'disabled', 'maximal-stay-unavailable', 'checkout-unavailable' );
								messages.push( stayLengthItem[ startDayOfWeek ][ 'max' ] + i18nText.maximum );
							}
						}
					}
				} 
				return [ true, classes.length ? classes.join( ' ' ) : '', messages.length ? messages.join( ', ' ) : '' ];
			} 
			return [ true, '', '' ];
		}
	}

	loftoceanRoomReservationUtils.prototype = {
		data: {},
		disabledStartDates: [],
		disabledEndDates: [],
		setData: function( d ) {
			this.data = d;
		},
		checkTaxes: function( price, data ) {
			if ( this.data.isTaxEnabled ) {
				if ( this.data.taxIncluded ) {
					var taxes = this.calculateIncludedTax( price );
					data.tax = this.checkOutputNumberFormat( taxes.totalTax );
					data.taxDetails = taxes.taxDetails;
				} else {
					var taxes = this.calculateExcludeTax( price );
					data.tax = this.checkOutputNumberFormat( taxes.totalTax );
					data.taxDetails = taxes.taxDetails;
					data.beforeTax = data.totalPrice;
					data.totalPrice = this.checkOutputNumberFormat( add( data.totalOriginalPrice, taxes.totalTax ), true );
				}
			}
		},
		calculateIncludedTax: function( price ) {
			var precision = this.add( this.data.currencySettings.precision, 2 ),
				taxes = this.data.taxRate, taxDetails = [],
				priceBeforeTax = price, currentPrice = 0;
			if ( taxes[ 'reversed_compound_rates' ] && taxes[ 'reversed_compound_rates' ].length ) {
				for ( var i = 0; i < taxes[ 'reversed_compound_rates' ].length; i ++ ) {
					currentPrice = priceBeforeTax;
					priceBeforeTax = this.multiplication( priceBeforeTax, ( 100 / ( 100 + taxes[ 'reversed_compound_rates' ][ i ][ 'rate' ] ) ) );
					priceBeforeTax = Number( priceBeforeTax ).toFixed( precision );
					taxDetails.unshift( { 'tax': this.checkOutputNumberFormat( this.subtraction( currentPrice, priceBeforeTax ) ), 'label': taxes[ 'reversed_compound_rates' ][ i ][ 'label' ] } );
				}
			}
			if ( taxes[ 'regular_rates' ] && taxes[ 'regular_rates' ].length ) {
				var rateSum = 100;
				for ( var i = 0; i < taxes[ 'regular_rates' ].length; i ++ ) {
					rateSum = this.add( rateSum, taxes[ 'regular_rates' ][ i ][ 'rate' ] );
				}
				priceBeforeTax = this.multiplication( priceBeforeTax, 100 / rateSum );
				priceBeforeTax = Number( priceBeforeTax ).toFixed( precision );

				for ( i -= 1; i >= 0; i -- ) {
					taxDetails.push( { 'tax': this.checkOutputNumberFormat( this.multiplication( priceBeforeTax, taxes[ 'regular_rates' ][ i ][ 'rate' ] / 100 ) ), 'label': taxes[ 'regular_rates' ][ i ][ 'label' ] } );
				}
			}
			return { 'totalTax': this.subtraction( price, priceBeforeTax ), 'taxDetails': taxDetails };
		},
		calculateExcludeTax: function( price ) {
			var taxes = this.data.taxRate,
				priceForCompound = price, totalTax = 0, taxDetails = [];

			if ( taxes[ 'regular_rates' ] && taxes[ 'regular_rates' ].length ) {
				var currentTax = 0
				for ( var i = 0; i < taxes[ 'regular_rates' ].length; i ++ ) {
					currentTax = this.multiplication( price, ( taxes[ 'regular_rates' ][ i ][ 'rate' ] / 100 ) );
					taxDetails.push( { 'tax': this.checkOutputNumberFormat( currentTax ), 'label': taxes[ 'regular_rates' ][ i ][ 'label' ] } );
					totalTax = this.add( totalTax, currentTax );
				}
				priceForCompound = this.add( price, totalTax );
			}
			if ( taxes[ 'compound_rates' ] && taxes[ 'compound_rates' ].length ) {
				var compoundTax = 0;
				for ( var i = 0; i < taxes[ 'compound_rates' ].length; i ++ ) {
					compoundTax = this.multiplication( priceForCompound, ( taxes[ 'compound_rates' ][ i ][ 'rate' ] / 100 ) );
					totalTax = this.add( totalTax, compoundTax );
					priceForCompound = this.add( priceForCompound, compoundTax );
					taxDetails.push( { 'tax': this.checkOutputNumberFormat( compoundTax ), 'label': taxes[ 'compound_rates' ][ i ][ 'label' ] } );
				}
			}
			return { 'totalTax': totalTax, 'taxDetails': taxDetails };
		},
		checkOutputNumberFormat: function( num, ignoreSymbal ) {
			var m = 0, tmpNum = 0, numStr = '', thousand = 1000;
	        num = ( 'undefined' == typeof num ) ? 0 : ( isNumber( num ) ? num : 0 );
			try { m = ( '' + num ).split( '.' )[1].length; } catch( e ) { m = 0; }
	        num = Number( num ).toFixed( m ? Math.max( 0, this.data.currencySettings.precision ) : 0 );
			num = ( '' + num ).split( '.' );

			numStr = Number( num[ 0 ] );
			if ( this.data.currencySettings.thousandSeparator ) {
				tmpNum = Number( num[ 0 ] );
				if ( tmpNum > thousand ) {
					numStr = ( tmpNum + '' ).substr( -3 )
					tmpNum = Math.floor( tmpNum / thousand );
					while ( tmpNum > thousand ) {
						numStr = ( tmpNum + '' ).substr( -3 ) + this.data.currencySettings.thousandSeparator + numStr;
						tmpNum = Math.floor( tmpNum / thousand );
					}
					if ( tmpNum > 0 ) {
						numStr = tmpNum + this.data.currencySettings.thousandSeparator + numStr;
					}
				}
			}
			if ( ( num.length > 1 ) && ( Number( num[ 1 ] ) > 0 ) && this.data.currencySettings.precision && this.data.currencySettings.decimalSeparator ) {
				numStr += this.data.currencySettings.decimalSeparator + num[ 1 ];
			}

			return ignoreSymbal ? numStr : this.data.currency[ 'left' ] + numStr + this.data.currency[ 'right' ];
	    },
	    add: function( arg1, arg2 ) {
			var m1, m2, m, sum = 0;
			try { m1 = ( '' + arg1 ).split( '.' )[1].length; } catch( e ) { m1 = 0; }
			try { m2 = ( '' + arg2 ).split( '.' )[1].length; } catch( e ) { m2 = 0; }
			m = Math.max( m1, m2 );
			sum = ( arg1 * Math.pow( 10, m ) + arg2 * Math.pow( 10, m ) ) / Math.pow( 10, m );
			return sum.toFixed( m ) ;
		},
		subtraction: function( arg1, arg2 ) {
			return this.add( arg1, ( - arg2 ) );
		},
		multiplication: function( arg1, arg2 ) {
			var m1, m2, result = 0;
			try { m1 = ( '' + arg1 ).split( '.' )[1].length; } catch( e ) { m1 = 0; }
			try { m2 = ( '' + arg2 ).split( '.' )[1].length; } catch( e ) { m2 = 0; }
			result = ( arg1 * Math.pow( 10, m1 ) ) * ( arg2 * Math.pow( 10, m2 ) ) / Math.pow( 10, ( m1 + m2 ) );
			return result.toFixed( m1 + m2 );
		},
		setDisabledDates: function() {
			var self = this;
			$.each( this.data.priceList, function( i, item ) {
				if ( ( 'unavailable' == item.status ) || ( item.available_number < 1 ) ) {
					self.disabledStartDates.push( item.start );
					self.disabledEndDates.push( item.end );
				}
			} );
		},
		showCheckinDates: function( date ) {
			date = date.format( dateFormat );
			if ( this.disabledStartDates.includes( date ) ) {
				return [ false, '', '' ];
			} else {
				var d = new Date( date ), dayOfWeek = 'day' + d.getDay(), currentTimstamp = getTimeStamp( d ), classes = [], messages = [],
					unavailableDates = this.getMatchedBookingRule( currentTimstamp );
				if ( false !== unavailableDates ) {
					if ( unavailableDates[ 'in_advance' ] ) {
						let inAdvanceItem = unavailableDates[ 'in_advance' ];
						if ( inAdvanceItem.min && ( ( ( currentTimstamp - todayTimestamp ) / dayTime ) < inAdvanceItem.min ) ) {
							classes.push( 'disabled', 'checkin-unavailable' );
						}
						if ( inAdvanceItem.max && ( ( ( currentTimstamp - todayTimestamp ) / dayTime ) > inAdvanceItem.max ) ) {
							classes.push( 'checkin-unavailable' );
						}
					}
					if ( unavailableDates.checkin.length ) {
						let disabledCheckItem = unavailableDates.checkin;
						if ( disabledCheckItem.includes( dayOfWeek ) ) {
							classes.push( 'no-checkin', 'checkin-unavailable' );
							messages.push( i18nText.noCheckin );
						}
					}
				}
				return [ true, classes.length ? classes.join( ' ' ) : '', messages.length ? messages.join( ', ' ) : '' ];
			}
		},
		showCheckoutDates: function( date, currentCheckin ) {
			var self = this;
			date = date.format( dateFormat );
			if ( this.disabledEndDates.includes( date ) || ( ! moment( currentCheckin ).isValid() ) ) {
				return [ false, '', '' ];
			} else {
				if ( ! moment( date ).isAfter( currentCheckin ) ) return [ false, '', '' ];

				var currentVerifyDate = currentCheckin.clone(), validEndDate = moment( date );
				currentVerifyDate.add( '1', 'day' );
				while ( currentVerifyDate.isBefore( validEndDate ) ) {
					if ( self.disabledStartDates.includes( currentVerifyDate.format( dateFormat ) ) ) {
						return [ false, '', '' ];
					}
					currentVerifyDate.add( '1', 'day' );
				}

				var d = new Date( date ), dayOfWeek = 'day' + d.getDay(), currentTimstamp = getTimeStamp( d ), classes = [], messages = [],
					startDateTimestamp = getTimeStamp( new Date( currentCheckin.format( dateFormat ) ) ), 
					unavailableStayLengthDates = this.getMatchedBookingRule( startDateTimestamp ), 
					unavailableDates = this.getMatchedBookingRule( currentTimstamp );

				if ( ( false !== unavailableDates ) && ( unavailableDates.checkout.length ) ) {
					let disabledCheckItem = unavailableDates.checkout;
					if ( disabledCheckItem.includes( dayOfWeek ) ) {
						classes.push( 'no-checkout', 'checkout-unavailable' );
						messages.push( i18nText.noCheckout );
					}
				}
				if ( ( false !== unavailableStayLengthDates ) && ( unavailableStayLengthDates[ 'stay_length' ] ) ) {
					var startDayOfWeek = 'day' + currentCheckin.day();
					if ( currentTimstamp > startDateTimestamp ) {
						let stayLengthItem = unavailableStayLengthDates[ 'stay_length' ], daysAfterStart = ( currentTimstamp - startDateTimestamp ) / dayTime;
						if ( stayLengthItem[ startDayOfWeek ] ) {
							if ( stayLengthItem[ startDayOfWeek ][ 'min' ] && ( daysAfterStart < stayLengthItem[ startDayOfWeek ][ 'min' ] ) ) {
								classes.push( 'minimal-stay-unavailable', 'checkout-unavailable' );
								messages.push( stayLengthItem[ startDayOfWeek ][ 'min' ] + i18nText.minimum );
							}
							if ( stayLengthItem[ startDayOfWeek ][ 'max' ] && ( daysAfterStart > stayLengthItem[ startDayOfWeek ][ 'max' ] ) ) {
								classes.push( 'off', 'disabled', 'maximal-stay-unavailable', 'checkout-unavailable' );
								messages.push( stayLengthItem[ startDayOfWeek ][ 'max' ] + i18nText.maximum );
							}
						}
					}
				}
				return [ true, classes.length ? classes.join( ' ' ) : '', messages.length ? messages.join( ', ' ) : '' ];
			}
		},
		getEnabledExtraServiceList: function( checkin, checkout ) {
			if ( this.data.hasCustomExtraServices ) {
				var currentList = [], self = this;
				checkin = getTimeStamp( new Date( checkin ) ); 
				checkout = getTimeStamp( new Date( checkout ) ); 
				self.data.extraServices.forEach( function( item ) {
					if ( ( '' !== item.effective_time ) && item.custom_effective_time_slots.length ) {
						var passDeactivated = true, isActivated = ( 'activated' == item.effective_time );
						for ( let i = 0; i < item.custom_effective_time_slots.length; i ++ ) {
							var cets = item.custom_effective_time_slots[ i ];
							if ( ( ( ! cets.start_timestamp ) || ( cets.start_timestamp <= checkin ) )
								&& ( ( ! cets.end_timstamp ) || ( cets.end_timstamp >= checkout ) ) ) {
								if ( isActivated ) {
									currentList.push( $.extend( {}, item ) );
								} else {
									passDeactivated = false;
								}
								break;
							}
						}
						if ( ( ! isActivated ) && passDeactivated ) {
							currentList.push( $.extend( {}, item ) );
						}
					} else {
						currentList.push( $.extend( {}, item ) );
					}
				} );
				return currentList;
			}
			return false;
		},
		getRoomLimitation: function( checkin, checkout ) {
			var lowest = false, checkinTimestamp = getTimeStamp( new Date( checkin ) ), 
				checkoutTimestamp = getTimeStamp( new Date( checkout ) ), lists = this.data.priceList; 

			for ( var i = checkinTimestamp; i < checkoutTimestamp; i += dayTime ) { 
				if ( lists[ i ] && ( 'available' == lists[ i ][ 'status' ] ) && ( ! ! lists[ i ][ 'available_number' ] ) ) {
					if ( ( false === lowest ) || ( Number( lists[ i ][ 'available_number' ] ) < lowest ) ) {
						lowest = Number( lists[ i ][ 'available_number' ] );
					}
				}
			}
			return lowest;
		},
		getMatchedBookingRule: function( date ) { 
			if ( this.data.unavailableDates && this.data.unavailableDates.length ) {
				var currentItemIndex = -1, currentStartDate = NaN, currentEndDate = NaN;
				this.data.unavailableDates.forEach( function( item, index ) { 
					var isCustom = ( 'custom' == item[ 'type' ] ), 
						startDate = isCustom ? parseInt( item[ 'start' ], 10 ) : NaN, endDate = isCustom ? parseInt( item[ 'end' ], 10 ) : NaN,
						isStartDateNotSet = isNaN( startDate ), isEndDateNotSet = isNaN( endDate );

					if ( ( ! isCustom ) || ( ( isStartDateNotSet || ( startDate <= date ) ) && ( isEndDateNotSet || ( endDate >= date ) ) ) ) { 
						if ( currentItemIndex < 0 ) {
							currentItemIndex = index;
							currentStartDate = startDate;
							currentEndDate = endDate;
						} else if ( isCustom && ( ( ! isStartDateNotSet ) || ( ! isEndDateNotSet ) ) && ( ( currentStartDate + '-' + currentEndDate ) !== ( startDate + '-' + endDate ) ) ) {
							var isCurrentStartDateNotSet = isNaN( currentStartDate ), isCurrentEndDateNotSet = isNaN( currentEndDate ),
								afterCurrentStartDate = ( ! isStartDateNotSet ) && ( isCurrentStartDateNotSet || ( startDate >= currentStartDate ) ),
								beforeCurrentEndDate = ( ! isEndDateNotSet ) && ( isCurrentEndDateNotSet || ( endDate < currentEndDate ) );

							if ( isCurrentStartDateNotSet && isCurrentEndDateNotSet && ( ( ! isStartDateNotSet ) || ( ! isEndDateNotSet ) ) ) {
								currentItemIndex = index;
								currentStartDate = startDate;
								currentEndDate = endDate;
							}
							else if ( ( isStartDateNotSet && isCurrentStartDateNotSet && ( ! isCurrentEndDateNotSet ) && beforeCurrentEndDate ) 
								|| ( isEndDateNotSet && isCurrentEndDateNotSet && ( ! isCurrentStartDateNotSet ) && afterCurrentStartDate ) 
								|| ( afterCurrentStartDate && beforeCurrentEndDate ) ) {

								currentItemIndex = index;
								currentStartDate = startDate;
								currentEndDate = endDate;
							}
						}
					}
				} );
				return ( currentItemIndex > -1 ) ? this.data.unavailableDates[ currentItemIndex ] : false;
			}
			return false;
		}
	}
} ) ( jQuery, window );