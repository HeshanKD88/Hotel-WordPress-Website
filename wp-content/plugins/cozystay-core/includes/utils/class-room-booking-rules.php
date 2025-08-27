<?php
namespace LoftOcean\Utils\Room;
if ( ! class_exists( '\LoftOcean\Utils\Room\Booking_Rules' ) ) {
    class Booking_Rules {
        /**
        * Error message
        */
        protected $message = '';
        /**
        * String Post type
        */
        protected $post_type = 'loftocean_room';
        /**
        * Booking Rules Taxomony
        */
        protected $rule_taxonomy = 'lo_room_booking_rules';
        /**
        * Room type taxonomy
        */
        protected $room_type_taxonomy = 'lo_room_type';
        /**
        * Construction function
        */
        public function __construct() {
            add_action( 'loftocean_room_search_booking_rules', array( $this, 'check_search_page_rules' ), 10, 2 );
            add_filter( 'loftocean_room_single_booking_rules', array( $this, 'check_single_room_rules' ), 10, 2 );
            add_filter( 'loftocean_room_get_unavailble_date', array( $this, 'get_single_room_unavailable_dates' ), 10, 2 );
            add_filter( 'loftocean_get_all_rooms_unavailable_dates', array( $this, 'get_all_rooms_unavailable_dates' ) );
        }
        /**
        * Check booking rules for room search page
        */
        public function check_search_page_rules( $query, $query_vars ) {
            if ( ! apply_filters( 'loftocean_room_search_page_enable_booking_rules', false ) ) return;

            if ( \LoftOcean\is_valid_array( $query_vars ) && isset( $query_vars[ 'checkin' ], $query_vars[ 'checkout' ] ) && ( $query_vars[ 'checkout' ] > $query_vars[ 'checkin' ] ) ) {
                $checkin = $query_vars[ 'checkin' ];
                $checkout = $query_vars[ 'checkout' ];
                $rules = get_terms( array(  'taxonomy' => $this->rule_taxonomy, 'hide_empty' => true, 'fields' => 'ids', 'orderby' => 'meta_value_num', 'order' => 'ASC', 'meta_key' => 'priority' ) );
                if ( ! is_wp_error( $rules ) && \LoftOcean\is_valid_array( $rules ) ) {
                    $excluded_rules = array();
                    $matched_checkin_rule_id = \LoftOcean\get_matched_rule_item( $rules, $checkin );
                    $matched_checkout_rule_id = \LoftOcean\get_matched_rule_item( $rules, $checkout );

                    if ( ( false !== $matched_checkin_rule_id ) || ( false !== $matched_checkout_rule_id ) ) {
                        $rule_passed = $this->check_matched_rules( $matched_checkin_rule_id, $matched_checkout_rule_id, array(
                            'checkin_stamp' => $query_vars[ 'checkin' ],
                            'checkout_stamp' => $query_vars[ 'checkout' ],
                            'days' => ( $query_vars[ 'checkout' ] - $query_vars[ 'checkin' ] ) / LOFTICEAN_SECONDS_IN_DAY,
                            'day_of_week_checkin' => 'day' . date( 'w', $query_vars[ 'checkin' ] ),
                            'day_of_week_checkout' => 'day' . date( 'w', $query_vars[ 'checkout' ] )
                        ) );
                        if ( ! $rule_passed ) { 
                            ( false === $matched_checkin_rule_id ) ? '' : array_push( $excluded_rules, $matched_checkin_rule_id );
                            ( false === $matched_checkout_rule_id ) ? '' : array_push( $excluded_rules, $matched_checkout_rule_id );
                            $excluded_rules = array_unique( $excluded_rules );
                        }

                        if ( \LoftOcean\is_valid_array( $excluded_rules ) ) { 
                            $query->set( 'tax_query', array( array( 'taxonomy' => $this->rule_taxonomy, 'field' => 'term_id', 'terms' => $excluded_rules, 'operator' => 'NOT IN' ) ) );
                        }
                    }
                }
            }
        }
        /**
        * Check booking rules for single room page
        */
        public function check_single_room_rules( $status, $data ) {
            if ( \LoftOcean\is_valid_array( $data ) && isset( $data[ 'room_id' ], $data[ 'checkin' ], $data[ 'checkout' ] ) && ( $this->post_type == get_post_type( $data[ 'room_id' ] ) ) ) {
                $rules = apply_filters( 'loftocean_get_room_current_booking_rules', array(), $data[ 'room_id' ] );
                if ( \LoftOcean\is_valid_array( $rules ) ) {
                    $matched_checkin_rule_id = \LoftOcean\get_matched_rule_item( $rules, $data[ 'checkin' ] );
                    $matched_checkout_rule_id = \LoftOcean\get_matched_rule_item( $rules, $data[ 'checkout' ] );
                    if ( ( false !== $matched_checkin_rule_id ) || ( false !== $matched_checkout_rule_id ) ) {
                        $rule_passed = $this->check_matched_rules( $matched_checkin_rule_id, $matched_checkout_rule_id, array(
                            'checkin_stamp' => $data[ 'checkin' ],
                            'checkout_stamp' => $data[ 'checkout' ],
                            'days' => ( $data[ 'checkout' ] - $data[ 'checkin' ] ) / LOFTICEAN_SECONDS_IN_DAY,
                            'day_of_week_checkin' => 'day' . date( 'w', $data[ 'checkin' ] ),
                            'day_of_week_checkout' => 'day' . date( 'w', $data[ 'checkout' ] )
                        ) );
                        if ( ! $rule_passed ) {
                            $message = '';
                            if ( $custom_time_range ) {
                                $message = sprintf(
                                    // translators: 1/2: date string
                                    esc_html__( 'From %1$s to %2$s, ', 'loftocean' ),
                                    date( 'F j, Y', $start_date ),
                                    date( 'F j, Y', $end_date )
                                );
                            } else {
                                $message = '';
                                $this->message = ucfirst( $this->message );
                            }
                            $message = esc_html__( 'Your reservation conflicts with the following booking rules for this room:', 'loftocean' ) . '<br>' . $message;
                            \LoftOcean\Utils\Room_Reservation::set_message( $message . $this->message );
                            return false;
                        }
                    }
                }
            }
            return $status;
        }
        /**
        * Get unavailable date for a specific single room
        */
        public function get_single_room_unavailable_dates( $dates, $data ) {
            if ( \LoftOcean\is_valid_array( $data ) && isset( $data[ 'room_id' ] ) && ( $this->post_type == get_post_type( $data[ 'room_id' ] ) ) ) {
                $rules = apply_filters( 'loftocean_get_room_current_booking_rules', array(), $data[ 'room_id' ] );
                if ( \LoftOcean\is_valid_array( $rules ) ) {
                    return $this->get_unavailble_dates( $rules );
                }
            }
            return array();
        }
        /*
        * Get all rooms unavailable dates 
        */
        public function get_all_rooms_unavailable_dates( $dates ) {
            $rules = apply_filters( 'loftocean_get_all_rooms_booking_rules', array() );
            return \LoftOcean\is_valid_array( $rules ) ? $this->get_unavailble_dates( $rules ) : array();
        }
        /*
        * Get booking rule unavailable dates
        */
        protected function get_unavailble_dates( $rules ) {
            $dates = array();
            if ( \LoftOcean\is_valid_array( $rules ) ) {
                foreach ( $rules as $rule_id ) {
                    $start_date = get_term_meta( $rule_id, 'start_date', true );
                    $end_date = get_term_meta( $rule_id, 'end_date', true );

                    $is_custom_date = ( 'custom' == get_term_meta( $rule_id, 'time_range', true ) );
                    $index = $is_custom_date ? $start_date . '-' . $end_date : 'all';

                    if ( ! isset( $dates[ $index ] ) ) {
                        $dates[ $index ] = array( 'type' => $is_custom_date ? 'custom' : 'all', 'start' => $start_date, 'end' => $end_date, 'checkin' => array(), 'checkout' => array(), 'in_advance' => array(), 'stay_length' => array() );
                        $details = \LoftOcean\merge_array( array(
                            'stay_length' => array(
                                'general' => array( 'enable' => '', 'min' => 0, 'max' => 0 ),
                                'custom' => array(
                                    'enable' => '',
                                    'day1' => array( 'min' => 0, 'max' => 0 ),
                                    'day2' => array( 'min' => 0, 'max' => 0 ),
                                    'day3' => array( 'min' => 0, 'max' => 0 ),
                                    'day4' => array( 'min' => 0, 'max' => 0 ),
                                    'day5' => array( 'min' => 0, 'max' => 0 ),
                                    'day6' => array( 'min' => 0, 'max' => 0 ),
                                    'day0' => array( 'min' => 0, 'max' => 0 ),
                                )
                            ),
                            'no_checkin_checkout_date' => array(
                                'enable' => '',
                                'checkin' => array( 'day0' => '', 'day1' => '', 'day2' => '', 'day3' => '', 'day4' => '', 'day5' => '', 'day6' => '' ),
                                'checkout' => array( 'day0' => '', 'day1' => '', 'day2' => '', 'day3' => '', 'day4' => '', 'day5' => '', 'day6' => '' )
                            ),
                            'in_advance' => array( 'enable' => '', 'max' => 0, 'min' => 0 )
                        ), get_term_meta( $rule_id, 'rule_details', true ) );

                        if ( ( 'on' == $details[ 'stay_length' ][ 'general' ][ 'enable' ] ) || ( 'on' == $details[ 'stay_length' ][ 'custom' ][ 'enable' ] ) ) {
                            $keys = array( 'day0', 'day1', 'day2', 'day3', 'day4', 'day5', 'day6' );
                            $stay_length = array_fill_keys( $keys, array( 'min' => 0, 'max' => 0 ) );
                            if ( 'on' == $details[ 'stay_length' ][ 'general' ][ 'enable' ] ) {
                                foreach ( $keys as $key ) {
                                    $stay_length = $this->update_stay_length( $details[ 'stay_length' ][ 'general' ], $key, $stay_length );
                                }
                            }
                            if ( 'on' == $details[ 'stay_length' ][ 'custom' ][ 'enable' ] ) {
                                foreach( $keys as $key ) {
                                    $stay_length = $this->update_stay_length( $details[ 'stay_length' ][ 'custom' ][ $key ], $key, $stay_length );
                                }
                            }
                            $dates[ $index ][ 'stay_length' ] = $stay_length;
                        }
                        if ( 'on' == $details[ 'no_checkin_checkout_date' ][ 'enable' ] ) {
                            $checkins = array();
                            $checkouts = array();
                            foreach ( $details[ 'no_checkin_checkout_date' ][ 'checkin' ] as $day => $val ) {
                                ( 'on' == $val ) ? array_push( $checkins, $day ) : '';
                            }
                            foreach ( $details[ 'no_checkin_checkout_date' ][ 'checkout' ] as $day => $val ) {
                                ( 'on' == $val ) ? array_push( $checkouts, $day ) : '';
                            }
                            if ( \LoftOcean\is_valid_array( $checkins ) ) {
                                $dates[ $index ][ 'checkin' ] = $checkins;
                            }
                            if ( \LoftOcean\is_valid_array( $checkouts ) ) {
                                $dates[ $index ][ 'checkout' ] = $checkouts;
                            }
                        }
                        if ( 'on' == $details[ 'in_advance' ][ 'enable' ] ) {
                            $has_min_in_advance = ! empty( $details[ 'in_advance' ][ 'min' ] );
                            $has_max_in_advance = ! empty( $details[ 'in_advance' ][ 'max' ] );
                            if ( $has_max_in_advance || $has_min_in_advance ) {
                                $dates[ $index ][ 'in_advance' ] = array(
                                    'min' => $has_min_in_advance ? $details[ 'in_advance' ][ 'min' ] : 0,
                                    'max' => $has_max_in_advance ? $details[ 'in_advance' ][ 'max' ] : 0
                                );
                            }
                        }
                    }
                }
            }
            return array_values( $dates );
        }
        /**
        * Check stay length
        */
        protected function update_stay_length( $data, $key, $value ) {
            $value_keys = array( 'min', 'max' );
            foreach( $value_keys as $vk ) {
                if ( ( ! empty( $data[ $vk ] ) ) && ( $data[ $vk ] > 0 ) ) {
                    $value[ $key ][ $vk ] = $data[ $vk ];
                }
            }
            return $value;
        }
        /**
        * Check macthed rules
        */
        protected function check_matched_rules( $checkin_rule_id, $checkout_rule_id, $query_vars ) {
            $list = array(
                'day1' => esc_html__( 'Mondays', 'loftocean' ),
                'day2' => esc_html__( 'Tuesdays', 'loftocean' ),
                'day3' => esc_html__( 'Wednesdays', 'loftocean' ),
                'day4' => esc_html__( 'Thursdays', 'loftocean' ),
                'day5' => esc_html__( 'Fridays', 'loftocean' ),
                'day6' => esc_html__( 'Saturdays', 'loftocean' ),
                'day0' => esc_html__( 'Sundays', 'loftocean' )
            );
            $checkin = $query_vars[ 'checkin_stamp' ];
            $checkout = $query_vars[ 'checkout_stamp' ];

            $rule_details = array(
                'stay_length' => array(
                    'general' => array( 'enable' => '', 'min' => '', 'max' => '' ),
                    'custom' => array(
                        'enable' => '',
                        'day0' => array( 'min' => '', 'max' => '' ),
                        'day1' => array( 'min' => '', 'max' => '' ),
                        'day2' => array( 'min' => '', 'max' => '' ),
                        'day3' => array( 'min' => '', 'max' => '' ),
                        'day4' => array( 'min' => '', 'max' => '' ),
                        'day5' => array( 'min' => '', 'max' => '' ),
                        'day6' => array( 'min' => '', 'max' => '' )
                    )
                ),
                'no_checkin_checkout_date' => array(
                    'enable' => '',
                    'checkin' => array( 'day0' => '', 'day1' => '', 'day2' => '', 'day3' => '', 'day4' => '', 'day5' => '', 'day6' => '' ),
                    'checkout' => array( 'day0' => '', 'day1' => '', 'day2' => '', 'day3' => '', 'day4' => '', 'day5' => '', 'day6' => '' )
                ),
                'in_advance' => array( 'enable' => '', 'min' => '', 'max' => '' )
            );
            if ( false !== $checkin_rule_id ) {
                $checkin_rule = get_term_meta( $checkin_rule_id, 'rule_details', true );
                $fields = array( 'stay_length', 'no_checkin_checkout_date', 'in_advance' );
                foreach ( $fields as $field ) {
                    if ( isset( $checkin_rule[ $field ] ) ) {
                        $rule_details[ $field ] = $checkin_rule[ $field ];
                    }
                }
                if ( isset( $rule_details[ 'no_checkin_checkout_date' ], $rule_details[ 'no_checkin_checkout_date' ][ 'checkout' ] ) && ( $checkin_rule_id !== $checkout_rule_id ) ) {
                    $rule_details[ 'no_checkin_checkout_date' ][ 'checkout' ] = array( 'day0' => '', 'day1' => '', 'day2' => '', 'day3' => '', 'day4' => '', 'day5' => '', 'day6' => '' );
                }
            }
            if ( ( false !== $checkout_rule_id ) && ( $checkin_rule_id !== $checkout_rule_id ) ) {
                $checkout_rule = get_term_meta( $checkout_rule_id, 'rule_details', true );
                if ( isset( $checkout_rule[ 'no_checkin_checkout_date' ], $checkout_rule[ 'no_checkin_checkout_date' ][ 'enable' ], $checkout_rule[ 'no_checkin_checkout_date' ][ 'checkout' ] ) && ( 'on' == $checkout_rule[ 'no_checkin_checkout_date' ][ 'enable' ] ) ) {
                    if ( '' == $rule_details[ 'no_checkin_checkout_date' ][ 'enable' ] ) {
                        $rule_details[ 'no_checkin_checkout_date' ][ 'checkin' ] = array( 'day0' => '', 'day1' => '', 'day2' => '', 'day3' => '', 'day4' => '', 'day5' => '', 'day6' => '' );
                    }
                    $rule_details[ 'no_checkin_checkout_date' ][ 'enable' ] = 'on';
                    $rule_details[ 'no_checkin_checkout_date' ][ 'checkout' ] = $checkout_rule[ 'no_checkin_checkout_date' ][ 'checkout' ];
                }
            } 

            // Check stay length
            $stay_length = $rule_details[ 'stay_length' ];
            $stay_length_to_check = array( 'min' => '', 'max' => '' );
            $check_properties = array( 'min', 'max' );
            if ( 'on' == $stay_length[ 'general' ][ 'enable' ] ) {
                $general_stay_length = $stay_length[ 'general' ];
                foreach( $check_properties as $property ) {
                    if ( ! empty( $general_stay_length[ $property ] ) ) {
                        $stay_length_to_check[ $property ] = $general_stay_length[ $property ];
                    }
                }
            }
            if ( 'on' == $stay_length[ 'custom' ][ 'enable' ] ) {
                $custom_stay_length = $rule_details[ 'stay_length' ][ 'custom' ][ $query_vars[ 'day_of_week_checkin' ] ];
                foreach( $check_properties as $property ) {
                    if ( ! empty( $custom_stay_length[ $property ] ) ) {
                        $stay_length_to_check[ $property ] = $custom_stay_length[ $property ];
                    }
                }
            }
            if ( ! empty( $stay_length_to_check[ 'min' ] ) && ( absint( $stay_length_to_check[ 'min' ] ) > $query_vars[ 'days' ] ) ) {
                $this->message = sprintf(
                    // translators: 1: day of week, 2: day count
                    esc_html__( 'if you check in on %1$s, the minimum stay for this room is %2$s days.', 'loftocean' ),
                    date( 'l', $query_vars[ 'checkin_stamp' ] ),
                    $stay_length_to_check[ 'min' ]
                );
                return false;
            }
            if ( ! empty( $stay_length_to_check[ 'max' ] ) && ( absint( $stay_length_to_check[ 'max' ] ) < $query_vars[ 'days' ] ) ) {
                $this->message = sprintf(
                    // translators: 1: day of week, 2: day count
                    esc_html__( 'if you check in on %1$s, the maximum stay for this room is %2$s days.', 'loftocean' ),
                    date( 'l', $query_vars[ 'checkin_stamp' ] ),
                    $stay_length_to_check[ 'max' ]
                );
                return false;
            }

            // No checkin checkout check
            if ( 'on' == $rule_details[ 'no_checkin_checkout_date' ][ 'enable' ] ) {
                if ( 'on' == $rule_details[ 'no_checkin_checkout_date' ][ 'checkin' ][ $query_vars[ 'day_of_week_checkin' ] ] ) {
                    $weekdays = array();
                    foreach ( $list as $i => $l ) {
                        if ( 'on' == $rule_details[ 'no_checkin_checkout_date' ][ 'checkin' ][ $i ] ) {
                            array_push( $weekdays, $l );
                        }
                    }
                    $this->message = sprintf(
                        // translators: 1: day of the week
                        esc_html__( 'this room cannot be checked in on the following days: %s.', 'loftocean' ),
                        implode( ', ', $weekdays )
                    );
                    return false;
                }
                if ( 'on' == $rule_details[ 'no_checkin_checkout_date' ][ 'checkout' ][ $query_vars[ 'day_of_week_checkout' ] ] ) {
                    $weekdays = array();
                    foreach ( $list as $i => $l ) {
                        if ( 'on' == $rule_details[ 'no_checkin_checkout_date' ][ 'checkout' ][ $i ] ) {
                            array_push( $weekdays, $l );
                        }
                    }
                    $this->message = sprintf(
                        // translators: 1: day of the week
                        esc_html__( 'this room cannot be checked out on the following days: %s.', 'loftocean' ),
                        implode( ', ', $weekdays )
                    );
                    return false;
                }
            }
            // Booking in advance check
            if ( 'on' == $rule_details[ 'in_advance' ][ 'enable' ] ) {
                $days_in_advance = ( $query_vars[ 'checkin_stamp' ] - strtotime( date( 'Y-m-d' ) ) ) / LOFTICEAN_SECONDS_IN_DAY;
                if ( ! empty( $rule_details[ 'in_advance' ][ 'min' ] ) && ( absint( $rule_details[ 'in_advance' ][ 'min' ] ) > $days_in_advance ) ) {
                    $this->message = sprintf(
                        // translators: 1: day of the week
                        esc_html__( 'this room can only be booked at least %s days before check in.', 'loftocean' ),
                        $rule_details[ 'in_advance' ][ 'min' ]
                    );
                    return false;
                }
                if ( ! empty( $rule_details[ 'in_advance' ][ 'max' ] ) && ( absint( $rule_details[ 'in_advance' ][ 'max' ] ) < $days_in_advance ) ) {
                    $this->message = sprintf(
                        // translators: 1: day of the week
                        esc_html__( 'this room can only be booked no more than %s days before check in.', 'loftocean' ),
                        $rule_details[ 'in_advance' ][ 'max' ]
                    );
                    return false;
                }
            }
            return true;
        }
    }
    new \LoftOcean\Utils\Room\Booking_Rules();
}
