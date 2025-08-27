<?php
    if ( empty( $room_order_item_data ) ) return;

    $checkin = $room_order_item_data[ 'check_in' ];
    $checkout = $room_order_item_data[ 'check_out' ];
    $room_order_extra_services = $room_order_item_data[ 'extra_services' ];
    $hide_fields = apply_filters( 'loftocean_room_reservation_form_hide_fields', array_fill_keys( array( 'room', 'adult', 'child' ), false ) );
    $hide_child = $hide_fields[ 'child' ];
    $hide_adult = $hide_fields[ 'adult' ];
    $hide_room = $hide_fields[ 'room' ];
    $hide_wrap = $hide_room && $hide_child && $hide_adult;
    $checkin = date( 'Y-m-d', $checkin );
    $checkout = date( 'Y-m-d', $checkout );

    $setting_name_prefix = 'room_details[' . $item_id . ']';
    $reservation_data = apply_filters( 'loftocean_get_room_booking_data', array(), $room_order_item_data[ 'room_id' ] );

    $reservation_data[ 'extraServices' ] = $room_extra_services;
    $reservation_data[ 'hasCustomExtraServices' ] = $has_custom_extra_services;
    $reservation_data[ 'selectedServices' ] = \LoftOcean\is_valid_array( $room_order_extra_services ) ? $room_order_extra_services : false;

    $data_to_remove = array( 
        'i18nText', 'addRoomToCartAjaxAction', 'ajaxURL', 'availabilityCalendarText', 'cartPage', 'pricePerPerson', 
        'variablePrices', 'passParamsFromSearchResultPage', 'currency', 'currencySettings', 'searchResultParams', 'roomID', 'customVariablePrices',
        'getFlexiblePriceRuleAjaxAction', 'hasFlexibilePriceRules', 'isTaxEnabled', 'taxIncluded', 'taxRate', 'displayDateFormat', 'maximalMonthsAllowedForBooking'
    );
    foreach( $data_to_remove as $dtr ) {
        if ( isset( $reservation_data[ $dtr ] ) ) {
            unset( $reservation_data[ $dtr ] );
        }
    } ?>


<div class="edit-cs-room-order-item edit" data-room-id="<?php echo esc_attr( $room_order_item_data[ 'room_id' ] ); ?>" style="display: none;" data-reservation-data="<?php echo base64_encode( json_encode( $reservation_data ) ); ?>">
    <input type="hidden" name="<?php echo $setting_name_prefix; ?>[roomID]" value="<?php echo esc_attr( $room_order_item_data[ 'room_id' ] ); ?>">
    <input type="hidden" name="<?php echo $setting_name_prefix; ?>[status]" value="" class="room-order-item-status" style="display: none;">
    <div class="form-field-wrapper dates-field">
        <p class="form-field cs_check_in_date_field">
            <label for=""><?php esc_html_e( 'Check In', 'loftocean' ); ?></label>
            <input type="text" class="short" name="<?php echo $setting_name_prefix; ?>[checkin]" value="<?php echo esc_attr( $checkin ); ?>" data-value="<?php echo esc_attr( $checkin ); ?>" readonly>
        </p>
        <p class="form-field cs_check_out_date_field">
            <label for=""><?php esc_html_e( 'Check Out', 'loftocean' ); ?></label>
            <input type="text" class="short" name="<?php echo $setting_name_prefix; ?>[checkout]" value="<?php echo esc_attr( $checkout ); ?>" data-value="<?php echo esc_attr( $checkout ); ?>" readonly>
        </p>
    </div><?php 
    if ( ! $hide_wrap ) : ?>
        <div class="form-field-wrapper room-details-fields"><?php
        if ( ! $hide_room ) :
            $start_timestamp = strtotime( $checkin );
            $end_timestamp = strtotime( $checkout );
            $price_list = $reservation_data[ 'priceList' ];
            $max_room_number = isset( $price_list[ $start_timestamp ] ) ? $price_list[ $start_timestamp ][ 'available_number' ] : 0;
            for( $i = $start_timestamp; $i < $end_timestamp; $i += LOFTICEAN_SECONDS_IN_DAY ) {
                if ( isset( $price_list[ $i ] ) && ( 'available' == $price_list[ $i ][ 'status' ] ) && ( $max_room_number > $price_list[ $i ][ 'available_number' ] ) ) {
                    $max_room_number = $price_list[ $i ][ 'available_number' ];
                } 
            } ?>

            <p class="form-field cs_room_number_field">
                <label for=""><?php esc_html_e( 'Rooms', 'loftocean' ); ?></label>
                <input type="number" class="short" name="<?php echo $setting_name_prefix; ?>[room-quantity]" value="<?php echo esc_attr( $room_order_item_data[ 'room_num_search' ] ); ?>">
                <span class="description room-description"><?php printf(
                    // translators: %s room available number
                    esc_html__( '%s rooms available for the chosen dates.', 'loftocean' ), 
                    '<span class="max-room-number">' . $max_room_number . '</span>'
                ); ?></span>
            </p><?php
        endif;
        $message = '';
        $has_min_guest = is_numeric( $reservation_data[ 'guestLimitation' ][ 'min' ] ) && ( $reservation_data[ 'guestLimitation' ][ 'min' ] > 0 );
        $has_max_guest = is_numeric( $reservation_data[ 'guestLimitation' ][ 'max' ] ) && ( $reservation_data[ 'guestLimitation' ][ 'max' ] > 0 );
        if ( $has_min_guest || $has_max_guest ) {
            $message_array = array();
            array_push( $message_array, $has_min_guest ? $reservation_data[ 'guestLimitation' ][ 'min' ] : 1 );
            $has_max_guest ? array_push( $message_array,  $reservation_data[ 'guestLimitation' ][ 'max' ] ) : '';
            $message = '<span class="description total-guest-description">' . sprintf(
                // translators: total guest capacity
                $has_max_guest ? esc_html__( 'Occupancy: %s guests.', 'loftocean' ) : esc_html__( 'Occupancy: %s guests or more.', 'loftocean' ),
                $has_max_guest ? implode( '-', $message_array ) : $message_array[ 0 ]
            ) . '</span>';
        }
        if ( ! $hide_adult ) : ?>
            <p class="form-field cs_adults_number_field">
                <label for=""><?php esc_html_e( 'Adults', 'loftocean' ); ?></label>
                <input type="number" class="short" name="<?php echo $setting_name_prefix; ?>[adult-quantity]" value="<?php echo esc_attr( $room_order_item_data[ 'adult_number' ] ); ?>"><?php 
                echo $message;
                $message = '';
                if ( is_numeric( $reservation_data[ 'guestLimitation' ][ 'maxAdult' ] ) && ( $reservation_data[ 'guestLimitation' ][ 'maxAdult' ] > 0 ) ) : ?> 
                    <span class="description max-adults-description"><?php printf(
                        // translators: max adult number per room
                        esc_html__( 'Adults: up to %s.', 'loftocean' ),
                        $reservation_data[ 'guestLimitation' ][ 'maxAdult' ]
                    ); ?></span><?php
                endif; ?>
            </p><?php
        endif;
        if ( ! $hide_child ) : ?>
            <p class="form-field cs_children_number_field">
                <label for=""><?php esc_html_e( 'Children', 'loftocean' ); ?></label>
                <input type="number" class="short" name="<?php echo $setting_name_prefix; ?>[child-quantity]" value="<?php echo esc_attr( $room_order_item_data[ 'child_number' ] ); ?>"> <?php 
                echo $message;
                if ( is_numeric( $reservation_data[ 'guestLimitation' ][ 'maxChild' ] ) && ( $reservation_data[ 'guestLimitation' ][ 'maxChild' ] > 0 ) ) : ?> 
                    <span class="description max-children-description"><?php printf(
                        // translators: max adult number per room
                        esc_html__( 'Children: up to %s.', 'loftocean' ),
                        $reservation_data[ 'guestLimitation' ][ 'maxChild' ]
                    ); ?></span><?php
                endif; ?>
            </p><?php
        endif; ?>
        </div><?php
    endif;

    if ( \LoftOcean\is_valid_array( $room_extra_services ) ) : ?>
        <p class="form-field cs_extra_services_field"><strong><?php esc_html_e( 'Extra Services', 'loftocean' ); ?></strong></p><?php
        $checkin_timestamp = $room_order_item_data[ 'check_in' ];
        $checkout_timestamp = $room_order_item_data[ 'check_out' ];
        $service_prefix = 'extra_service_';
        foreach ( $room_extra_services as $res ) :
            $ignore_current_extra_service = true;
            if ( ( '' !== $res[ 'effective_time' ] ) && \LoftOcean\is_valid_array( $res[ 'custom_effective_time_slots' ] ) ) {
                $pass_deactivated = true;
                $is_activated = ( 'activated' == $res[ 'effective_time' ] );
                foreach ( $res[ 'custom_effective_time_slots' ] as $cets ) {
                    if ( ( empty(  $cets[ 'start_timestamp' ] ) || ( $cets[ 'start_timestamp' ] <= $checkin_timestamp ) )
                        && ( empty( $cets[ 'end_timstamp' ] ) || ( $cets[ 'end_timstamp' ] >= $checkout_timestamp ) ) ) {
                        if ( $is_activated ) {
                            $ignore_current_extra_service = false;
                        } else {
                            $pass_deactivated = false;
                        }
                        break;
                    }
                }
                if ( ( ! $is_activated ) && $pass_deactivated ) {
                    $ignore_current_extra_service = false;
                }
            } else {
                $ignore_current_extra_service = false;
            }

            if ( $ignore_current_extra_service ) continue;

            $is_obligatory = ! empty( $res[ 'obligatory' ] );
            $service_id = $service_prefix . $res[ 'term_id' ];
            $service_enabled = isset( $room_order_extra_services[ 'services' ][ $service_id ] ) || $is_obligatory;
            $checkbox_name = $setting_name_prefix . '[extra_service_id][' . $service_id . ']';
            $checkbox_id = str_replace( array( '[', ']' ), array( '-', '' ), $checkbox_name ); ?>
            <div class="form-field cs_extra_services_field">
                <input 
                    class="checkbox<?php if ( $is_obligatory ) : ?> obligatory<?php endif; ?>" 
                    type="checkbox" 
                    name="<?php echo $checkbox_name; ?>" 
                    id="<?php echo esc_attr( $checkbox_id ); ?>" 
                    value="<?php echo esc_attr( $res[ 'term_id' ] ); ?>"
                    <?php if ( $service_enabled ) : ?> checked<?php endif; ?>
                    <?php if ( $is_obligatory ) : ?> readonly onClick="return false;"<?php endif; ?>
                >
                <label for="<?php echo esc_attr( $checkbox_id ); ?>"><?php echo esc_html( $res[ 'name' ] . ' (' . $res[ 'label_text' ] . ')' ); ?> </label><?php
                if ( in_array( $res[ 'method' ], array( 'custom', 'auto_custom' ) ) ) :
                    $minimum_quantity = ( ! empty( $res[ 'custom_minimum_quantity' ] ) ) && is_numeric( $res[ 'custom_minimum_quantity' ] ) ? $res[ 'custom_minimum_quantity' ] : '';
                    $maximum_quantity = ( ! empty( $res[ 'custom_maximum_quantity' ] ) ) && is_numeric( $res[ 'custom_maximum_quantity' ] ) ? $res[ 'custom_maximum_quantity' ] : '';
                    $default_quantity = 1; $attr_min = 1; $attr_max = '';
                    if ( ( ! empty( $minimum_quantity ) ) && ( $minimum_quantity  > 0 ) ) {
                        $default_quantity = $minimum_quantity;
                        $attr_min = $minimum_quantity;
                    }
                    if ( ( ! empty( $maximum_quantity ) ) && ( $maximum_quantity > 0 ) ) {
                        $attr_max = $maximum_quantity;
                    }
                    if ( $service_enabled && isset( $room_order_extra_services[ 'quantity' ][ $service_id ] ) ) {
                        $default_quantity = max( $room_order_extra_services[ 'quantity' ][ $service_id ], $default_quantity );
                    } ?>
                    <label><small class="times">×</small></label> 
                    <input 
                        class="cs_extra_services_quantity" 
                        type="number" 
                        name="<?php echo $setting_name_prefix; ?>[extra_service_quantity][<?php echo esc_attr( $service_id ); ?>]" 
                        value="<?php echo esc_attr( $default_quantity ); ?>" 
                        <?php if ( ! empty( $attr_min ) ) : ?> min="<?php echo esc_attr( $attr_min ); ?>"<?php endif; ?>
                        <?php if ( ! empty( $attr_max ) ) : ?> max="<?php echo esc_attr( $attr_max ); ?>"<?php endif; ?>
                    ><?php
                endif; ?>
                <div class="hidden-fiedls">
                    <input type="hidden" name="<?php echo $setting_name_prefix; ?>[extra_service_price][<?php echo esc_attr( $service_id ); ?>]" value="<?php echo esc_attr( $res[ 'price' ] ); ?>" />
                    <input type="hidden" name="<?php echo $setting_name_prefix; ?>[extra_service_calculating_method][<?php echo esc_attr( $service_id ); ?>]" value="<?php echo esc_attr( $res[ 'method' ] ); ?>" />
                    <input type="hidden" name="<?php echo $setting_name_prefix; ?>[extra_service_title][<?php echo esc_attr( $service_id ); ?>]" value="<?php echo esc_attr( $res[ 'name' ] ); ?>" />
                    <input type="hidden" name="<?php echo $setting_name_prefix; ?>[extra_service_price_label][<?php echo esc_attr( $service_id ); ?>]" value="<?php echo esc_attr( $res[ 'label_text' ] ); ?>" /><?php
                    if ( 'auto' == $res[ 'method' ] ) : ?>
                        <input type="hidden" name="<?php echo $setting_name_prefix; ?>[extra_service_auto_calculating_unit][<?php echo esc_attr( $service_id ); ?>]" value="<?php echo esc_attr( $res[ 'auto_method' ] ); ?>" /><?php
                        if ( in_array( $res[ 'auto_method' ], array( 'person', 'night-person' ) ) && ( ( ! empty( $res[ 'custom_adult_price' ] ) ) || ( ! empty( $res[ 'custom_child_price' ] ) ) ) ) : ?>
                            <input type="hidden" name="<?php echo $setting_name_prefix; ?>[extra_service_auto_calculating_custom_adult_price][<?php echo esc_attr( $service_id ); ?>]" value="<?php echo esc_attr( $res[ 'custom_adult_price' ] ); ?>" />
                            <input type="hidden" name="<?php echo $setting_name_prefix; ?>[extra_service_auto_calculating_custom_child_price][<?php echo esc_attr( $service_id ); ?>]" value="<?php echo esc_attr( $res[ 'custom_child_price' ] ); ?>" /><?php
                        endif; 
                    endif; ?>
                </div>
            </div><?php
        endforeach;
    endif; ?>
</div>