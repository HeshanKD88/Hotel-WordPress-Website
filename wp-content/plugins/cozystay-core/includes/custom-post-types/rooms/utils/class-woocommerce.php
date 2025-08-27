<?php
namespace LoftOcean\Room;

if ( ! class_exists( '\LoftOcean\Room\Room_WooCommerce' ) ) {
    class Room_WooCommerce {
        /**
        * String Post type
        */
        protected $post_type = 'loftocean_room';
        /**
        * Is WooCommerce checkout page
        */
        protected $is_woocommerce_checkout_page = false;
        /*
        * Room Extra Services
        */
        protected $extra_services = array();
        /*
        * If tax is enabled
        */
        protected $is_tax_enabled = false;
        /*
        * If price includes tax
        */
        protected $tax_included = false;
        /*
        * Tax rates
        */
        protected $tax_rates = array();
        /**
        * Construction function
        */
        public function __construct() {
            $this->set_tax();

            add_action( 'woocommerce_after_order_itemmeta', array( $this, 'woocommerce_order_details' ), 10, 3 );
            add_action( 'woocommerce_after_cart_item_name', array( $this, 'woocommerce_cart_item_product' ), 99, 2 );
            add_action( 'woocommerce_order_item_meta_end', array( $this, 'woocommerce_email_item_details' ), 99, 4 );
            add_action( 'woocommerce_review_order_before_cart_contents', array( $this, 'is_checkout_page' ) );
            add_action( 'woocommerce_review_order_after_cart_contents', array( $this, 'disable_checkout_page' ) );
           // add_action( 'admin_print_footer_scripts-woocommerce_page_wc-orders', array( $this, 'load_admin_css' ) );

            add_action( 'admin_print_footer_scripts', array( $this, 'load_admin_css' ) );

            add_action( 'init', array( $this, 'get_extra_services' ), 99 );
            add_action( 'woocommerce_before_save_order_items', array( $this, 'update_order_items' ), 99, 2 );
            add_action( 'woocommerce_before_save_order_item', array( $this, 'update_order_item' ), 99, 1 );
            add_action( 'woocommerce_order_item_add_line_buttons', array( $this, 'add_room_button' ), 99, 1 );
            add_action( 'wp_ajax_loftocean-search-room', array( $this, 'search_rooms' ) );
            add_action( 'wp_ajax_loftocean_add_order_room_item', array( $this, 'add_order_item' ) );
            add_action( 'woocommerce_ajax_order_items_removed', array( $this, 'after_remove_order_items' ), 99, 4 );
            add_action( 'loftocean_load_room_reservation_utils_assets', array( $this, 'load_reservation_utils_assets' ) );

            add_filter( 'woocommerce_admin_html_order_item_class', array( $this, 'woocommerce_order_row_class' ), 19, 3 );
            add_filter( 'woocommerce_cart_item_thumbnail', array( $this, 'woocommerce_cart_item_thumbnail' ), 99, 3 );
            add_filter( 'woocommerce_admin_order_item_thumbnail', array( $this, 'woocommerce_admin_order_item_thumbnail' ), 99, 3 );
            add_filter( 'woocommerce_cart_item_quantity', array( $this, 'woocommerce_cart_item_quantity' ), 99, 3 );
            add_filter( 'woocommerce_get_item_data', array( $this, 'output_room_details' ), 999, 2 );
            add_filter( 'woocommerce_bulk_action_ids',  array( $this, 'before_delete_orders' ), 999999, 3 );
            add_filter( 'wp_count_posts', array( $this, 'product_counts' ), 999, 3 );
        }
        /*
        * Tax details
        */
        protected function set_tax() {
            $this->is_tax_enabled = \LoftOcean\is_tax_enabled();
            if ( $this->is_tax_enabled ) {
                $this->tax_included = ( 'yes' == get_option( 'woocommerce_prices_include_tax' ) );
            }
        }
        /**
        * Woocommerce order details
        */
        public function woocommerce_order_details( $item_id, $item, $order ) {
            if ( 'WC_Order_Item_Product' !== get_class( $item ) ) return;

            $room_id = get_post_meta( $item->get_product_id(), '_loftocean_booking_id', true );
            if ( ! empty( $room_id ) && ( $this->post_type == get_post_type( $room_id ) ) ) {
                $variation_id = $item->get_variation_id();
                $room_order_item_data = \LoftOcean\get_room_product_variation_data( $variation_id, 'data' );

                $room_extra_services = $this->get_room_enabled_extra_services( $room_id );
                $has_custom_extra_services = $this->has_custom_extra_services( $room_extra_services );

                require LOFTOCEAN_DIR . 'includes/custom-post-types/rooms/order/room-item-details.php';
                require LOFTOCEAN_DIR . 'includes/custom-post-types/rooms/order/order-item-room-edit.php';
            }
        }
        /**
        * Woocommerce cart item details
        */
        public function woocommerce_cart_item_product( $item, $cart_index ) { 
            if ( isset( $item[ 'loftocean_booking_data' ] ) && ( $this->post_type == get_post_type( $item[ 'loftocean_booking_data' ][ 'loftocean_booking_id' ] ) ) ) {
                $room_order_item_data = $item[ 'loftocean_booking_data' ];
                require LOFTOCEAN_DIR . 'includes/custom-post-types/rooms/order/room-item-details.php';
            }
        }
        /**
        * Woocommerce email item details
        */
        public function woocommerce_email_item_details( $item_id, $item, $order, $plain_text ) {
            if ( 'WC_Order_Item_Product' !== get_class( $item ) ) return;

            $room_id = get_post_meta( $item->get_product_id(), '_loftocean_booking_id', true );
            if ( ! empty( $room_id ) && ( $this->post_type == get_post_type( $room_id ) ) ) {
                $variation_id = $item->get_variation_id();
                $room_order_item_data = \LoftOcean\get_room_product_variation_data( $variation_id, 'data' );

                require LOFTOCEAN_DIR . 'includes/custom-post-types/rooms/order/room-item-details.php';
            }
        }
        /**
        * Mark is WooCommerce checkout page
        */
        public function is_checkout_page() {
            $this->is_woocommerce_checkout_page = true;
        }
        /**
        * Output room details for checkout page
        */
        public function output_room_details( $data, $item ) {
            if ( $this->is_woocommerce_checkout_page && isset( $item[ 'loftocean_booking_data' ] ) && ( $this->post_type == get_post_type( $item[ 'loftocean_booking_data' ][ 'loftocean_booking_id' ] ) ) ) {
                $room_order_item_data = $item[ 'loftocean_booking_data' ];
                require LOFTOCEAN_DIR . 'includes/custom-post-types/rooms/order/room-item-details.php';
            }
            return $data;
        }
        /**
        * Disable WooCommerce checkout page
        */
        public function disable_checkout_page() {
            $this->is_woocommerce_checkout_page = false;
        }
        /**
        * Woocommerce cart item quantity
        */
        public function woocommerce_cart_item_quantity( $product_quantity, $cart_item_key, $cart_item ) {
            if ( isset( $cart_item[ 'loftocean_booking_data' ] ) && ( $this->post_type == get_post_type( $cart_item[ 'loftocean_booking_data' ][ 'loftocean_booking_id' ] ) ) ) {
                return $product_quantity . '<div class="quantity">-</div>'; 
            }
            return $product_quantity;
        }
        /**
        * Woocommerce cart item details
        */
        public function woocommerce_cart_item_thumbnail( $thumbnail, $item, $cart_index ) {
            if ( isset( $item[ 'loftocean_booking_data' ] ) && ( $this->post_type == get_post_type( $item[ 'loftocean_booking_data' ][ 'loftocean_booking_id' ] ) ) ) {
                return get_the_post_thumbnail( $item[ 'loftocean_booking_data' ][ 'loftocean_booking_id' ], 'thumbnail' );
            }
            return $thumbnail;
        }
        /**
        * Woocommerce admin order item details
        */
        public function woocommerce_admin_order_item_thumbnail( $thumbnail, $item_id, $item ) {
            $room_id = get_post_meta( $item->get_product_id(), '_loftocean_booking_id', true );
            if ( ! empty( $room_id ) && ( $this->post_type == get_post_type( $room_id ) ) ) {
                return get_the_post_thumbnail( $room_id, 'thumbnail' );
            }
            return $thumbnail;
        }
        /*
        * WooCommerce order row class
        */
        public function woocommerce_order_row_class( $class, $item, $order ) {
            if ( 'WC_Order_Item_Product' !== get_class( $item ) ) return $class;

            $room_id = get_post_meta( $item->get_product_id(), '_loftocean_booking_id', true );
            if ( ! empty( $room_id ) && ( $this->post_type == get_post_type( $room_id ) ) ) { 
                return empty( $class ) ? 'loftocean-room-product-row' : $class . ' loftocean-room-product-row'; 
            }
            return $class;
        }
        /*
        * Load admin css for woocommerce order page
        */
        public function load_admin_css() { 
            global $post;

            if ( ( isset( $_GET[ 'page' ] ) && ( 'wc-orders' == $_GET[ 'page' ] ) ) || ( isset( $_GET[ 'post_type' ] ) && ( 'shop_order' == $_GET[ 'post_type' ] ) ) || ( is_object( $post ) && isset( $post->post_type ) && ( 'shop_order' == $post->post_type ) ) ) { 
                do_action( 'loftocean_load_admin_css' );
                do_action( 'loftocean_jquery_ui' );
                do_action( 'loftocean_load_room_reservation_utils_assets' );

                $deps = array( 'jquery', 'moment', 'wp-util', 'jquery-ui-datepicker', 'wc-admin-meta-boxes', 'wc-backbone-modal', 'selectWoo', 'wc-clipboard', 'loftocean_room_reservation_utils' );
                wp_enqueue_script( 'loftocean_room_product_edit', LOFTOCEAN_ASSETS_URI . 'scripts/admin/rooms/woocommerce/room-edit-product.min.js', $deps, LOFTOCEAN_ASSETS_VERSION, true );
                require_once LOFTOCEAN_DIR . 'template-parts/admin-order/tmpl-admin-order-add-room-item.php';
            }
        }
        /*
        * Load room reservation utils assets
        */
        public function load_reservation_utils_assets() {
            wp_enqueue_script( 'moment', LOFTOCEAN_ASSETS_URI . 'libs/daterangepicker/moment.min.js', array(), '2.18.1', true );
            wp_enqueue_script( 'loftocean-base64', LOFTOCEAN_ASSETS_URI . 'libs/base64/base64.min.js', array(), LOFTOCEAN_ASSETS_VERSION, true );
            wp_enqueue_script( 'loftocean_room_reservation_utils', LOFTOCEAN_ASSETS_URI . 'scripts/common/room-reservation-utils.min.js', array( 'jquery', 'moment', 'loftocean-base64' ), LOFTOCEAN_ASSETS_VERSION, true );
            wp_localize_script( 
                'loftocean_room_reservation_utils', 
                'loftoceanRoomReservationUtilsData', 
                array( 
                    'i18nText' => apply_filters( 'loftocean_room_reservation_message', array() ),
                    'allRoomsUnavailableDates' => apply_filters( 'loftocean_get_all_rooms_unavailable_dates', array() ) 
                ) 
            );
        }
        /*
        * Product Counts
        */
        public function product_counts( $count, $type, $perm ) { 
            if ( ( 'product' == $type ) && is_object( $count ) && isset( $count->publish ) && ( $count->publish > 0 ) ) {
                global $wpdb; 
                $query = "SELECT COUNT( * ) FROM {$wpdb->posts} p, {$wpdb->postmeta} pm WHERE p.post_type = %s AND p.post_status = 'publish' AND p.ID = pm.post_id && pm.meta_key = '_loftocean_booking_id' && pm.meta_value != ''";
                $results = $wpdb->get_col( $wpdb->prepare( $query, $type ) ); 
                if ( \LoftOcean\is_valid_array( $results ) ) {
                    $count->publish = max( $count->publish - $results[ 0 ], 0 );
                }
            }

            return $count;
        }
        /*
        * Get extra services
        */
        public function get_extra_services() {
            $this->extra_services = apply_filters( 'loftocean_get_room_extra_services', array() );
            if ( \LoftOcean\is_valid_array( $this->extra_services ) ) {
                $services = array();
                $currency = \LoftOcean\get_current_currency();
                $currency_settings = \LoftOcean\get_current_currency_settings();
                $auto_method_label = array(
                    'night' => esc_html__( ' / Night', 'loftocean' ),
                    'person' => esc_html__( ' / Person', 'loftocean' ),
                    'night-person' => esc_html__( ' / Night / Person', 'loftocean' ),
                    'night-room' => esc_html__( ' / Night / Room', 'loftocean' ),
                    'custom-person-adult' => esc_html__( ' / Adult', 'loftocean' ),
                    'custom-person-child' => esc_html__( ' / Child', 'loftocean' ),
                    'custom-night-person-adult' => esc_html__( ' / Night / Adult', 'loftocean' ),
                    'custom-night-person-child' => esc_html__( ' / Night / Child', 'loftocean' )
                );
                foreach( $this->extra_services as $es ) {
                    $price = $es[ 'price' ];
                    $method = $es[ 'method' ];
                    $auto_method = $es[ 'auto_method' ];
                    $display_prices = array( 'price', 'custom_adult_price', 'custom_child_price' );
                    foreach( $display_prices as $dp ) {
                        $es[ 'display_' . $dp ] = empty( $es[ $dp ] ) ? $es[ $dp ] : \LoftOcean\get_formatted_price( $es[ $dp ], $currency_settings );
                    }

                    $es[ 'label_text' ] = $currency[ 'left' ] . $es[ 'display_price' ] . $currency[ 'right' ] . ( 'fixed' == $method ? '' : ( 'auto_custom' == $method ? $auto_method_label[ 'night' ] : '' ) . ' ' . $es[ 'custom_price_appendix_text' ] );
                    if ( 'auto' == $method ) {
                        if ( in_array( $auto_method, array( 'person', 'night-person' ) ) && ( ( ! empty( $es[ 'custom_adult_price' ] ) ) || ( ! empty( $es[ 'custom_child_price' ] ) ) ) ) {
                            $price_array = array();
                            if ( ! empty( $es[ 'custom_adult_price' ] ) ) {
                                array_push( $price_array,  $currency[ 'left' ] . $es[ 'display_custom_adult_price' ] . $currency[ 'right' ] . $auto_method_label[ 'custom-' . $auto_method . '-adult' ] );
                            }
                            if ( ! empty( $es[ 'custom_child_price' ] ) ) {
                                array_push( $price_array, $currency[ 'left' ] . $es[ 'display_custom_child_price' ] . $currency[ 'right' ] . $auto_method_label[ 'custom-' . $auto_method . '-child' ] );
                            }
                            $es[ 'label_text' ] = implode( ', ', $price_array );
                        } else {
                            $es[ 'label_text' ] = $currency[ 'left' ] . $es[ 'display_price' ] . $currency[ 'right' ] . $auto_method_label[ $auto_method ];
                        }
                    }

                    $services[ $es[ 'term_id' ] ] = $es;
                }
                $this->extra_services = $services;
            }
        }
        /*
        * Check if have custom extra services
        */
        protected function has_custom_extra_services( $extra_services ) {
            if ( \LoftOcean\is_valid_array( $extra_services ) ) {
                foreach ( $extra_services as $res ) {
                    if ( ( '' !== $res[ 'effective_time' ] ) && \LoftOcean\is_valid_array( $res[ 'custom_effective_time_slots' ] ) ) {
                        return true;
                    }
                }
            }
            return false;
        }
        /*
        * Get extra services enabled for a room
        */
        protected function get_room_enabled_extra_services( $room_id ) {
            $enabled_services = apply_filters( 'loftocean_get_room_extra_services_enabled', array(), $room_id );
            $services = array();
            if ( \LoftOcean\is_valid_array( $enabled_services ) ) {
                foreach ( $enabled_services as $esi ) {
                    if ( isset( $this->extra_services[ $esi ] ) ) {
                        array_push( $services, $this->extra_services[ $esi ] );
                    }
                }
            }
            return $services;
        }
        /*
        *
        */
        public function update_order_items( $order_id, $items ) {
            if ( isset( $items[ 'room_details' ] ) && \LoftOcean\is_valid_array( $items[ 'room_details' ] ) ) {
                $order = \wc_get_order( $order_id );
                if ( $this->is_tax_enabled ) {
                    $tax_for = \LoftOcean\get_tax_location();
                    $this->tax_rates = \WC_Tax::find_rates( $tax_for );
                }
                $check_status = \loftOcean\get_room_booked_status();
                $need_update_availability = in_array( $order->get_status(), $check_status );

                $need_update_availability ? update_post_meta( $order_id, '_loftocean_room_order_updated', 'yes' ) : '';

                foreach ( $items[ 'room_details' ] as $item_id => $data ) {
                    if ( isset( $data[ 'status' ] ) && empty( $data[ 'status' ] ) ) {
                        continue;
                    }

                    $room_name = get_post_field( 'post_title', $data[ 'roomID' ], 'raw' ); 
                    if ( false === get_post_status( $data[ 'roomID' ] ) ) {
                         $order->add_order_note( sprintf( 
                                /* translators: room name */
                                __( 'Room "%s" doesn\'t exist.', 'loftocean' )
                                , $room_name 
                            ), false, false );
                    } else {
                        $item = \WC_Order_Factory::get_order_item( absint( $item_id ) );
                        $variation_id = $item->get_variation_id();
                        $previous_data = \LoftOcean\get_room_product_variation_data( $variation_id, 'data' );
                        $has_previous_data = \LoftOcean\is_valid_array( $previous_data ) && isset( $previous_data[ 'check_in' ], $previous_data[ 'check_out' ] );
                        // reset previous reservation
                        if ( $need_update_availability && $has_previous_data ) {
                            for ( $i = $previous_data[ 'check_in' ]; $i < $previous_data[ 'check_out' ]; $i = strtotime( '+1 day', $i ) ) {
                                do_action( 'loftocean_update_room_order', array( 'room_id' => $data[ 'roomID' ], 'check_in' => $i, 'number' => $previous_data[ 'room_num_search' ] ), 'unpaid' );
                            }
                        }
                        $results = apply_filters( 'loftocean_woocommerce_order_admin_update_check_item', array( 'pass_validation' => false ), $data );
                        if ( $results[ 'pass_validation' ] ) { 
                            if ( $need_update_availability ) {
                                for ( $i = $results[ 'data' ][ 'check_in' ]; $i < $results[ 'data' ][ 'check_out' ]; $i = strtotime( '+1 day', $i ) ) {
                                    do_action( 'loftocean_update_room_order', array( 'room_id' => $data[ 'roomID' ], 'check_in' => $i, 'number' => $results[ 'data' ][ 'room_num_search' ] ), 'paid' );
                                }
                            }
                            update_post_meta( $variation_id, '_regular_price', $results[ 'data' ][ 'total_price' ] );
                            \LoftOcean\update_room_product_variation_data( $variation_id, $results[ 'data' ], 'data' );

                            ob_start();
                            $room_order_item_data = $results[ 'data' ];
                            require LOFTOCEAN_DIR . 'includes/custom-post-types/rooms/order/room-item-details.php';
                            $order_details = ob_get_clean();

                            $wc_product = wc_get_product( $variation_id ); 
                            $wc_product->set_description( $order_details );
                            $wc_product->save();

                            $order->add_order_note( sprintf( 
                                /* translators: room name */
                                __( 'Order item "%s" updated.', 'loftocean' )
                                , $room_name 
                            ), false, true );
                        } else {
                            $error_message = \LoftOcean\Utils\Room_Reservation::$message;
                            if ( ! empty( $error_message ) ) {
                                if ( $need_update_availability && $has_previous_data ) {
                                    for ( $i = $previous_data[ 'check_in' ]; $i < $previous_data[ 'check_out' ]; $i = strtotime( '+1 day', $i ) ) {
                                        do_action( 'loftocean_update_room_order', array( 'room_id' => $data[ 'roomID' ], 'check_in' => $i, 'number' => $previous_data[ 'room_num_search' ] ), 'paid' );
                                    }
                                }
                                $order->add_order_note( sprintf( 
                                    /* translators: 1: room name 2: error message detail 3: variance ID */
                                    __( 'Update to room "%1$s (variation ID: %3$s)" failed. Here is the details: %2$s', 'loftocean' ), 
                                    $room_name, 
                                    '<br>' . $error_message,
                                    $variation_id
                                ), false, false );
                            } 
                        }
                    }
                }
            }
        }
        /*
        * Update order item
        */
        public function update_order_item( $item ) {
            if ( 'WC_Order_Item_Product' !== get_class( $item ) ) return;

            $room_id = get_post_meta( $item->get_product_id(), '_loftocean_booking_id', true );
            if ( ! empty( $room_id ) && ( $this->post_type == get_post_type( $room_id ) ) ) {
                $room_order_item_data = \LoftOcean\get_room_product_variation_data( $item->get_variation_id(), 'data' );
                if ( isset( $room_order_item_data[ 'total_price' ] ) ) {
                    $props = array(
                        'total'     => $room_order_item_data[ 'total_price' ],
                        'subtotal'  => $room_order_item_data[ 'total_price' ]
                    );
                    if ( $this->is_tax_enabled ) {
                        $taxes = \WC_Tax::calc_tax( $room_order_item_data[ 'total_price' ], $this->tax_rates, $this->tax_included );
                        if ( \LoftOcean\is_valid_array( $taxes ) ) {
                            $tax = 0;
                            foreach ( $taxes as $t ) {
                                $tax += $t;
                            }
                            if ( $this->tax_included ) {
                                $price_exclude_tax = $room_order_item_data[ 'total_price' ] - $tax;
                                $props[ 'total' ] = $price_exclude_tax;
                                $props[ 'subtotal' ] = $price_exclude_tax;
                            }
                            $item->set_taxes( array(
                                'total'    => $taxes,
                                'subtotal' => $taxes
                            ) );
                        }
                    }
                    $item->set_props( $props );
                }
            }
        }
        /*
        * Add room button
        */
        public function add_room_button( $order ) { ?>
            <button type="button" class="button add-order-room-item"><?php esc_html_e( 'Add Room', 'loftocean' ); ?></button><?php
        }
        /*
        * Search room
        */
        public function search_rooms() {
            check_ajax_referer( 'search-products', 'security' );

            if ( empty( $term ) && isset( $_GET['term'] ) ) {
                $term = (string) \wc_clean( \wp_unslash( $_GET['term'] ) );
            }

            if ( empty( $term ) ) {
                wp_die();
            }

            $search_results = new \WP_Query( array( 'post_type' => $this->post_type, 'posts_per_page' => 30, 'offset' => 0, 'post_status' => 'publish', 's' => $term ) ); 
            $rooms = array();
            while( $search_results->have_posts() ) {
                $search_results->the_post();
                $rooms[ get_the_ID() ] = rawurldecode( wp_strip_all_tags( get_the_title() ) );
            }
            wp_reset_postdata();

            wp_send_json( apply_filters( 'loftocean_woocommerce_json_search_found_rooms', $rooms ) );
        }
        /**
        * Add order item via ajax. Used on the edit order screen in WP Admin.
        *
        * @throws Exception If order is invalid.
        */
        public function add_order_item() {
            check_ajax_referer( 'order-item', 'security' );

            if ( ! current_user_can( 'edit_shop_orders' ) ) {
                wp_die( -1 );
            }

            if ( ! isset( $_POST[ 'order_id' ] ) ) {
                throw new \Exception( __( 'Invalid order', 'loftocean' ) );
            }
            $order_id = absint( wp_unslash( $_POST[ 'order_id' ] ) );

            // If we passed through items it means we need to save first before adding a new one.
            $items = ( ! empty( $_POST[ 'items' ] ) ) ? wp_unslash( $_POST[ 'items' ] ) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized

            $items_to_add = isset( $_POST[ 'data' ] ) ? array_filter( \wp_unslash( (array) $_POST[ 'data' ] ) ) : array(); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized

            try {
                $response = $this->maybe_add_order_item( $order_id, $items, $items_to_add );
                wp_send_json_success( $response );
            } catch ( \Exception $e ) {
                wp_send_json_error( array( 'error' => $e->getMessage() ) );
            }
        }

        /**
         * Add order item via AJAX. This is refactored for better unit testing.
         *
         * @param int          $order_id     ID of order to add items to.
         * @param string|array $items        Existing items in order. Empty string if no items to add.
         * @param array        $items_to_add Array of items to add.
         *
         * @return array     Fragments to render and notes HTML.
         * @throws Exception When unable to add item.
         */
        protected function maybe_add_order_item( $order_id, $items, $items_to_add ) {
            try {
                $order = wc_get_order( $order_id );

                if ( ! $order ) {
                    throw new Exception( __( 'Invalid order', 'loftocean' ) );
                }

                if ( ! empty( $items ) ) {
                    $save_items = array();
                    \parse_str( $items, $save_items );
                    \wc_save_order_items( $order->get_id(), $save_items );
                }

                // Add items to order.
                $order_notes = array();
                $added_items = array();

                foreach ( $items_to_add as $item ) {
                    if ( ! isset( $item[ 'id' ] ) || empty( $item[ 'id' ] ) ) {
                        continue;
                    }
                    $room_id = absint( $item[ 'id' ] );
                    $room_title = get_post_field( 'post_title', $room_id );
                    $product = apply_filters( 'loftocean_woocommerce_get_order_room_item', false, $room_id, array( 'title' => $room_title , 'data' => $this->get_default_data( $room_id ) ) );

                    if ( false === $product ) {
                        array_push( $order_notes, sprintf( 
                            // translators: %s: room title
                            __( 'Create order item for room "%s" failed', 'loftocean' ), get_post_field( $room_id, 'post_title', 'raw' ) 
                        ) );
                        continue;
                    }

                    $item_id = $order->add_product( $product, 1, array( 'order' => $order ) );
                    $item = apply_filters( 'woocommerce_ajax_order_item', $order->get_item( $item_id ), $item_id, $order, $product );
                    $added_items[ $item_id ] = $item;
                    array_push( $order_notes, strip_tags( $room_title ) );

                    // We do not perform any stock operations here because they will be handled when order is moved to a status where stock operations are applied (like processing, completed etc).
                    do_action( 'woocommerce_ajax_add_order_item_meta', $item_id, $item, $order );
                } 

                $this->update_order_room_ids( $order );

                $order->add_order_note( sprintf( 
                    /* translators: %s item name. */
                    __( 'Added line items: %s', 'loftocean' ), 
                    implode( ', ', $order_notes ) 
                ), false, true );

                do_action( 'woocommerce_ajax_order_items_added', $added_items, $order );

                $data = get_post_meta( $order_id );

                // Get HTML to return.
                ob_start();
                include WC_ABSPATH . 'includes/admin/meta-boxes/views/html-order-items.php';
                $items_html = ob_get_clean();

                ob_start();
                $notes = wc_get_order_notes( array( 'order_id' => $order_id ) );
                include WC_ABSPATH . 'includes/admin/meta-boxes/views/html-order-notes.php';
                $notes_html = ob_get_clean();

                return array(
                    'html'       => $items_html,
                    'notes_html' => $notes_html,
                );
            } catch ( Exception $e ) {
                throw $e; // Forward exception to caller.
            }
        }
        /*
        * Get default data for room item
        */
        protected function get_default_data( $room_id ) {
            $timestamp = strtotime( date( 'Y-m-d' ) );
            return array(
                'room_id' => $room_id,
                'uuid4' => \wp_generate_uuid4(),
                'original_room_price' => 0,
                'room_price' => 0,
                'check_in' => $timestamp,
                'check_out' => $timestamp,
                'room_num_search' => 1,
                'adult_number' => 1,
                'child_number' => 0,
                'extra_services' => array(
                    'services' => array(),
                    'titles' => array(),
                    'prices' => array(),
                    'customAdultPrice' => array(),
                    'customChildPrice' => array(),
                    'method' => array(),
                    'unit' => array(),
                    'label' => array(),
                    'quantity' => array()
                ),
                'extra_price' => 0,
                'extra_type' => 'services',
                'discount_details' => 0,
                'total_price' => 0
            );
        }
        /*
        * Update order room ids
        */
        protected function update_order_room_ids( $order ) {
            \LoftOcean\update_order_roomIDs( $order );
        }
        /*
        * After remove order item
        */
        public function after_remove_order_items( $item_id, $item, $changed_stock, $order ) {
            if ( false !== $item ) {
                $room_id = get_post_meta( $item->get_product_id(), '_loftocean_booking_id', true );
                if ( ! empty( $room_id ) && ( $this->post_type == get_post_type( $room_id ) ) ) {
                    $check_status = \loftOcean\get_room_booked_status();
                    $need_update_availability = in_array( $order->get_status(), $check_status );

                    $room_order_item_data = \LoftOcean\get_room_product_variation_data( $item->get_variation_id(), 'data' );
                    if ( $need_update_availability ) {
                        for ( $i = $room_order_item_data[ 'check_in' ]; $i < $room_order_item_data[ 'check_out' ]; $i = strtotime( '+1 day', $i ) ) {
                            do_action( 'loftocean_update_room_order', array( 'room_id' => $room_id, 'check_in' => $i, 'number' => $room_order_item_data[ 'room_num_search' ] ), 'unpaid' );
                        }
                    }
                }
            }

            $this->update_order_room_ids( $order );
        }
        /*
        * Before delete orders
        */
        public function before_delete_orders( $ids, $action, $type ) {
            if ( ( 'order' === $type ) && \LoftOcean\is_valid_array( $ids ) && ( 'delete' == $action ) ) {
                $check_status = \loftOcean\get_room_booked_status();
                foreach ( $ids as $id ) {
                    $order = \wc_get_order( $id );
                    delete_post_meta( $id, '_loftocean_room_order_updated' );

                    $previous_status = $order->get_meta( '_wp_trash_meta_status' );
                    $order_status = $order->get_status(); 
                    $need_update_availability = in_array( ( ( 'trash' == $order_status ) ? substr( $previous_status, 3 ) : $order_status ), $check_status );  

                    if ( ( ! $order ) || ( ! $need_update_availability ) ) {
                        continue;
                    }

                    $items = $order->get_items();
                    foreach ( $items as $item ) {
                        $room_id = get_post_meta( $item->get_product_id(), '_loftocean_booking_id', true );
                        if ( ( ! empty( $room_id ) ) && ( $this->post_type == get_post_type( $room_id ) ) ) {
                            $variation_id = $item->get_variation_id();
                            $data = \LoftOcean\get_room_product_variation_data( $variation_id, 'data' );
                            $has_valid_data = \LoftOcean\is_valid_array( $data ) && isset( $data[ 'check_in' ], $data[ 'check_out' ] );
                            if ( $has_valid_data ) {
                                for ( $i = $data[ 'check_in' ]; $i < $data[ 'check_out' ]; $i = strtotime( '+1 day', $i ) ) {
                                    do_action( 'loftocean_update_room_order', array( 'room_id' => $room_id, 'check_in' => $i, 'number' => $data[ 'room_num_search' ] ), 'unpaid' );
                                }
                            }
                        }
                    }
                }
            }

            return $ids;
        }
    }
    new Room_WooCommerce();
}
