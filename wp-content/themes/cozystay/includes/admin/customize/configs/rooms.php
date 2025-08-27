<?php
/**
* Customize section rooms configuration files.
*/


if ( ! class_exists( 'CozyStay_Customize_Rooms' ) && cozystay_is_theme_core_activated() ) {
	class CozyStay_Customize_Rooms extends CozyStay_Customize_Configuration_Base {
		/**
		* String panel id
		*/
		public $panel_id = 'cozystay_panel_rooms';
		/**
		* Array default customize option values
		*/
		public $defaults = array();
		/**
		* Int current section priority
		*/
		protected $section_priority = 0;
		/**
		* Boolean is theme core activated
		*/
		protected $is_theme_core_activated = false;
		/**
		* Register customize settings/control/panel/sections for current configuration class
		* @param object
		*/
		public function register_controls( $wp_customize ) {
			global $cozystay_default_settings;
			$this->defaults = $cozystay_default_settings;
			$this->is_theme_core_activated = cozystay_is_theme_core_activated();

			$this->add_panel( $wp_customize );
			$this->add_section_list( $wp_customize );
			$this->add_section_search_booking_form( $wp_customize );
			$this->add_section_availability_calendar( $wp_customize );
			$this->add_section_reservation_form( $wp_customize );
			$this->add_section_similar_rooms( $wp_customize );
			$this->add_section_search_page( $wp_customize );
		}
		/**
		* Register panel
		*/
		protected function add_panel( $wp_customize ) {
			$wp_customize->add_panel( $this->panel_id, array(
				'title' 	=> esc_html__( 'Rooms', 'cozystay' ),
				'priority' 	=> 65
			) );
		}
		/**
		* Register section list
		*/
		protected function add_section_list( $wp_customize ) {
			$defaults = $this->defaults;
			$this->section_priority += 5;
			$section_id = 'cozystay_rooms_section_list';
			$wp_customize->add_section( $section_id, array(
				'title' => esc_html__( 'Room List', 'cozystay' ),
				'panel' => $this->panel_id,
				'priority' => $this->section_priority
			) );

			$wp_customize->add_setting( new WP_Customize_Setting( $wp_customize, 'cozystay_room_list_read_more_button_text', array(
				'default'   		=> $defaults[ 'cozystay_room_list_read_more_button_text' ],
				'transport'			=> 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
			) ) );
			$wp_customize->add_control( new CozyStay_Customize_Control( $wp_customize, 'cozystay_room_list_read_more_button_text', array(
				'type'		=> 'text',
				'label'		=> esc_html__( 'Read More Button Text', 'cozystay' ),
				'section'	=> $section_id,
				'settings' 	=> 'cozystay_room_list_read_more_button_text',
			) ) );
		}
		/**
		* Register section search/booking form
		*/
		protected function add_section_search_booking_form( $wp_customize ) {
			$defaults = $this->defaults;
			$this->section_priority += 5;
			$section_id = 'cozystay_rooms_section_search_booking_form';
			$wp_customize->add_section( $section_id, array(
				'title' => esc_html__( 'Search / Booking Form', 'cozystay' ),
				'panel' => $this->panel_id,
				'priority' => $this->section_priority
			) );

			$wp_customize->add_setting( new WP_Customize_Setting( $wp_customize, 'cozystay_room_booking_search_form_autofill_from_url', array(
				'default'			=> $defaults['cozystay_room_booking_search_form_autofill_from_url'],
				'transport'			=> 'postMessage',
				'sanitize_callback' => 'CozyStay_Utils_Sanitize::sanitize_checkbox'
			) ) );

			$wp_customize->add_setting( new CozyStay_Customize_Setting( $wp_customize, 'cozystay_room_booking_search_form_display_date_format', array(
				'default'			=> $defaults['cozystay_room_booking_search_form_display_date_format'],
				'transport'			=> 'refresh',
				'sanitize_callback' => 'CozyStay_Utils_Sanitize::sanitize_choice'
			) ) );

			$wp_customize->add_setting( new WP_Customize_Setting( $wp_customize, 'cozystay_room_booking_search_form_dropdown_background', array(
				'default' 			=> $defaults['cozystay_room_booking_search_form_dropdown_background'],
				'transport' 		=> 'refresh',
				'sanitize_callback' => 'sanitize_hex_color'
			) ) );
			$wp_customize->add_setting( new WP_Customize_Setting( $wp_customize, 'cozystay_room_booking_search_form_dropdown_text_color', array(
				'default' 			=> $defaults['cozystay_room_booking_search_form_dropdown_text_color'],
				'transport'			=> 'refresh',
				'sanitize_callback' => 'sanitize_hex_color'
			) ) );
			$wp_customize->add_setting( new WP_Customize_Setting( $wp_customize, 'cozystay_room_booking_search_form_dropdown_border_color', array(
				'default' 			=> $defaults['cozystay_room_booking_search_form_dropdown_border_color'],
				'transport'			=> 'refresh',
				'sanitize_callback' => 'sanitize_hex_color'
			) ) );

			$wp_customize->add_setting( new WP_Customize_Setting( $wp_customize, 'cozystay_room_booking_search_calendar_colors_title', array(
				'default' 			=> '',
				'transport'			=> 'postMessage',
				'sanitize_callback' => 'CozyStay_Utils_Sanitize::sanitize_empty'
			) ) );
			$wp_customize->add_setting( new WP_Customize_Setting( $wp_customize, 'cozystay_room_calendar_date_border_color', array(
				'default' 			=> $defaults['cozystay_room_calendar_date_border_color'],
				'transport'			=> 'refresh',
				'sanitize_callback' => 'sanitize_hex_color'
			) ) );
			$wp_customize->add_setting( new WP_Customize_Setting( $wp_customize, 'cozystay_room_calendar_available_date_background', array(
				'default' 			=> $defaults['cozystay_room_calendar_available_date_background'],
				'transport'			=> 'refresh',
				'sanitize_callback' => 'sanitize_hex_color'
			) ) );
			$wp_customize->add_setting( new WP_Customize_Setting( $wp_customize, 'cozystay_room_calendar_start_end_date_background', array(
				'default' 			=> $defaults['cozystay_room_calendar_start_end_date_background'],
				'transport'			=> 'refresh',
				'sanitize_callback' => 'sanitize_hex_color'
			) ) );
			$wp_customize->add_setting( new WP_Customize_Setting( $wp_customize, 'cozystay_room_calendar_start_end_date_text_color', array(
				'default' 			=> $defaults['cozystay_room_calendar_start_end_date_text_color'],
				'transport'			=> 'refresh',
				'sanitize_callback' => 'sanitize_hex_color'
			) ) );
			$wp_customize->add_setting( new WP_Customize_Setting( $wp_customize, 'cozystay_room_calendar_in_range_date_background', array(
				'default' 			=> $defaults['cozystay_room_calendar_in_range_date_background'],
				'transport'			=> 'refresh',
				'sanitize_callback' => 'sanitize_hex_color'
			) ) );
			$wp_customize->add_setting( new WP_Customize_Setting( $wp_customize, 'cozystay_room_calendar_in_range_date_text_color', array(
				'default' 			=> $defaults['cozystay_room_calendar_in_range_date_text_color'],
				'transport'			=> 'refresh',
				'sanitize_callback' => 'sanitize_hex_color'
			) ) );
			$wp_customize->add_setting( new WP_Customize_Setting( $wp_customize, 'cozystay_room_calendar_hover_highlight', array(
				'default' 			=> $defaults['cozystay_room_calendar_hover_highlight'],
				'transport'			=> 'refresh',
				'sanitize_callback' => 'sanitize_hex_color'
			) ) );


			$wp_customize->add_control( new CozyStay_Customize_Control( $wp_customize, 'cozystay_room_booking_search_form_autofill_from_url', array(
				'type' 			=> 'checkbox',
				'label_first'	=> true,
				'label' 		=> esc_html__( 'Auto Fill In The Selected Items From The Search Form Into The Booking Form', 'cozystay' ),
				'section' 		=> $section_id,
				'settings' 		=> 'cozystay_room_booking_search_form_autofill_from_url'
			) ) );
			$wp_customize->add_control( new CozyStay_Customize_Control( $wp_customize, 'cozystay_room_booking_search_form_display_date_format', array(
				'type' 		=> 'select',
				'label' 	=> esc_html__( 'Date Format', 'cozystay' ),
				'section' 	=> $section_id,
				'settings' 	=> 'cozystay_room_booking_search_form_display_date_format',
				'choices' 	=> array(
					'YYYY-MM-DD' => esc_html__( 'YYYY-MM-DD', 'cozystay' ),
					'YYYY-DD-MM' => esc_html__( 'YYYY-DD-MM', 'cozystay' ),
					'MM-DD-YYYY' => esc_html__( 'MM-DD-YYYY', 'cozystay' ),
					'DD-MM-YYYY' => esc_html__( 'DD-MM-YYYY', 'cozystay' ),
					'YYYY/MM/DD' => esc_html__( 'YYYY/MM/DD', 'cozystay' ),
					'YYYY/DD/MM' => esc_html__( 'YYYY/DD/MM', 'cozystay' ),
					'MM/DD/YYYY' => esc_html__( 'MM/DD/YYYY', 'cozystay' ),
					'DD/MM/YYYY' => esc_html__( 'DD/MM/YYYY', 'cozystay' )
				)
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cozystay_room_booking_search_form_dropdown_background', array(
				'label'		=> esc_html__( 'Dropdown Background', 'cozystay' ),
				'section' 	=> $section_id,
				'settings'	=> 'cozystay_room_booking_search_form_dropdown_background'
			) ) );
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cozystay_room_booking_search_form_dropdown_text_color', array(
				'label'		=> esc_html__( 'Dropdown Text Color', 'cozystay' ),
				'section' 	=> $section_id,
				'settings'	=> 'cozystay_room_booking_search_form_dropdown_text_color'
			) ) );
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cozystay_room_booking_search_form_dropdown_border_color', array(
				'label'		=> esc_html__( 'Dropdown Border Color', 'cozystay' ),
				'section' 	=> $section_id,
				'settings'	=> 'cozystay_room_booking_search_form_dropdown_border_color'
			) ) );

			$wp_customize->add_control( new CozyStay_Customize_Control( $wp_customize, 'cozystay_room_booking_search_calendar_colors_title', array(
				'type'		=> 'title_only',
				'label'		=> esc_html__( 'Calendar Colors', 'cozystay' ),
				'section' 	=> $section_id,
				'settings'	=> 'cozystay_room_booking_search_calendar_colors_title'
			) ) );
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cozystay_room_calendar_date_border_color', array(
				'label'		=> esc_html__( 'Date Border Color', 'cozystay' ),
				'section' 	=> $section_id,
				'settings'	=> 'cozystay_room_calendar_date_border_color'
			) ) );
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cozystay_room_calendar_available_date_background', array(
				'label'		=> esc_html__( 'Available Date Background', 'cozystay' ),
				'section' 	=> $section_id,
				'settings'	=> 'cozystay_room_calendar_available_date_background'
			) ) );
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cozystay_room_calendar_start_end_date_background', array(
				'label'		=> esc_html__( 'Start / End Date Background', 'cozystay' ),
				'section' 	=> $section_id,
				'settings'	=> 'cozystay_room_calendar_start_end_date_background'
			) ) );
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cozystay_room_calendar_start_end_date_text_color', array(
				'label'		=> esc_html__( 'Start / End Date Text Color', 'cozystay' ),
				'section' 	=> $section_id,
				'settings'	=> 'cozystay_room_calendar_start_end_date_text_color'
			) ) );
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cozystay_room_calendar_in_range_date_background', array(
				'label'		=> esc_html__( 'In Range Date Background', 'cozystay' ),
				'section' 	=> $section_id,
				'settings'	=> 'cozystay_room_calendar_in_range_date_background'
			) ) );
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cozystay_room_calendar_in_range_date_text_color', array(
				'label'		=> esc_html__( 'In Range Date Text Color', 'cozystay' ),
				'section' 	=> $section_id,
				'settings'	=> 'cozystay_room_calendar_in_range_date_text_color'
			) ) );
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cozystay_room_calendar_hover_highlight', array(
				'label'		=> esc_html__( 'Hover Highlight', 'cozystay' ),
				'section' 	=> $section_id,
				'settings'	=> 'cozystay_room_calendar_hover_highlight'
			) ) );
		}
		/**
		* Register section availability calendar
		*/
		protected function add_section_availability_calendar( $wp_customize ) {
			$defaults = $this->defaults;
			$this->section_priority += 5;
			$section_id = 'cozystay_rooms_section_availability_calendar';
			$wp_customize->add_section( $section_id, array(
				'title' => esc_html__( 'Availability Calendar', 'cozystay' ),
				'panel' => $this->panel_id,
				'priority' => $this->section_priority
			) );

			$wp_customize->add_setting( new WP_Customize_Setting( $wp_customize, 'cozystay_room_availability_calendar_enable', array(
				'default'			=> $defaults['cozystay_room_availability_calendar_enable'],
				'transport'			=> 'refresh',
				'sanitize_callback' => 'CozyStay_Utils_Sanitize::sanitize_checkbox'
			) ) );

			$wp_customize->add_setting( new CozyStay_Customize_Setting( $wp_customize, 'cozystay_room_availability_calendar_section_title', array(
				'default'			=> $defaults['cozystay_room_availability_calendar_section_title'],
				'transport'			=> 'refresh',
				'sanitize_callback' => 'sanitize_text_field',
				'dependency' 		=> array(
					'cozystay_room_availability_calendar_enable' => array( 'value' => array( 'on' ) )
				)
			) ) );

			$wp_customize->add_setting( new WP_Customize_Setting( $wp_customize, 'cozystay_room_availability_calendar_colors_title', array(
				'default' 			=> '',
				'transport'			=> 'postMessage',
				'sanitize_callback' => 'CozyStay_Utils_Sanitize::sanitize_empty'
			) ) );
			$wp_customize->add_setting( new WP_Customize_Setting( $wp_customize, 'cozystay_room_availability_calendar_start_end_date_background', array(
				'default' 			=> $defaults['cozystay_room_availability_calendar_start_end_date_background'],
				'transport'			=> 'refresh',
				'sanitize_callback' => 'sanitize_hex_color'
			) ) );
			$wp_customize->add_setting( new WP_Customize_Setting( $wp_customize, 'cozystay_room_availability_calendar_start_end_date_text_color', array(
				'default' 			=> $defaults['cozystay_room_availability_calendar_start_end_date_text_color'],
				'transport'			=> 'refresh',
				'sanitize_callback' => 'sanitize_hex_color'
			) ) );
			$wp_customize->add_setting( new WP_Customize_Setting( $wp_customize, 'cozystay_room_availability_calendar_in_range_date_background', array(
				'default' 			=> $defaults['cozystay_room_availability_calendar_in_range_date_background'],
				'transport'			=> 'refresh',
				'sanitize_callback' => 'sanitize_hex_color'
			) ) );
			$wp_customize->add_setting( new WP_Customize_Setting( $wp_customize, 'cozystay_room_availability_calendar_in_range_date_text_color', array(
				'default' 			=> $defaults['cozystay_room_availability_calendar_in_range_date_text_color'],
				'transport'			=> 'refresh',
				'sanitize_callback' => 'sanitize_hex_color'
			) ) );
			$wp_customize->add_setting( new WP_Customize_Setting( $wp_customize, 'cozystay_room_availability_calendar_hover_highlight', array(
				'default' 			=> $defaults['cozystay_room_availability_calendar_hover_highlight'],
				'transport'			=> 'refresh',
				'sanitize_callback' => 'sanitize_hex_color'
			) ) );

			$wp_customize->add_control( new CozyStay_Customize_Control( $wp_customize, 'cozystay_room_availability_calendar_enable', array(
				'type' 			=> 'checkbox',
				'label_first'	=> true,
				'label'			=> esc_html__( 'Display the Availability Calendar on single room pages', 'cozystay' ),
				'section'		=> $section_id,
				'settings' 		=> 'cozystay_room_availability_calendar_enable',
			) ) );

			$wp_customize->add_control( new CozyStay_Customize_Control( $wp_customize, 'cozystay_room_availability_calendar_section_title', array(
				'type'				=> 'text',
				'label'				=> esc_html__( 'Availability Section Title', 'cozystay' ),
				'section'			=> $section_id,
				'settings' 			=> 'cozystay_room_availability_calendar_section_title',
				'active_callback' 	=> array( $this, 'customize_control_active_cb' )
			) ) );

			$wp_customize->add_control( new CozyStay_Customize_Control( $wp_customize, 'cozystay_room_availability_calendar_colors_title', array(
				'type'		=> 'title_only',
				'label'		=> esc_html__( 'Calendar Colors', 'cozystay' ),
				'section' 	=> $section_id,
				'settings'	=> 'cozystay_room_availability_calendar_colors_title'
			) ) );
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cozystay_room_availability_calendar_start_end_date_background', array(
				'label'		=> esc_html__( 'Start / End Date Background', 'cozystay' ),
				'section' 	=> $section_id,
				'settings'	=> 'cozystay_room_availability_calendar_start_end_date_background'
			) ) );
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cozystay_room_availability_calendar_start_end_date_text_color', array(
				'label'		=> esc_html__( 'Start / End Date Text Color', 'cozystay' ),
				'section' 	=> $section_id,
				'settings'	=> 'cozystay_room_availability_calendar_start_end_date_text_color'
			) ) );
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cozystay_room_availability_calendar_in_range_date_background', array(
				'label'		=> esc_html__( 'In Range Date Background', 'cozystay' ),
				'section' 	=> $section_id,
				'settings'	=> 'cozystay_room_availability_calendar_in_range_date_background'
			) ) );
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cozystay_room_availability_calendar_in_range_date_text_color', array(
				'label'		=> esc_html__( 'In Range Date Text Color', 'cozystay' ),
				'section' 	=> $section_id,
				'settings'	=> 'cozystay_room_availability_calendar_in_range_date_text_color'
			) ) );
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cozystay_room_availability_calendar_hover_highlight', array(
				'label'		=> esc_html__( 'Hover Highlight', 'cozystay' ),
				'section' 	=> $section_id,
				'settings'	=> 'cozystay_room_availability_calendar_hover_highlight'
			) ) );
		}
		/**
		* Register section reservation form
		*/
		protected function add_section_reservation_form( $wp_customize ) {
			$defaults = $this->defaults;
			$this->section_priority += 5;
			$section_id = 'cozystay_rooms_section_reservation_form';
			$wp_customize->add_section( $section_id, array(
				'title' => esc_html__( 'Booking Form Items', 'cozystay' ),
				'panel' => $this->panel_id,
				'priority' => $this->section_priority
			) );

			$wp_customize->add_setting( new WP_Customize_Setting( $wp_customize, 'cozystay_room_reservation_form_hide_field_room', array(
				'default'			=> $defaults['cozystay_room_reservation_form_hide_field_room'],
				'transport'			=> 'refresh',
				'sanitize_callback' => 'CozyStay_Utils_Sanitize::sanitize_checkbox'
			) ) );
			$wp_customize->add_setting( new WP_Customize_Setting( $wp_customize, 'cozystay_room_reservation_form_hide_field_adult', array(
				'default'			=> $defaults['cozystay_room_reservation_form_hide_field_adult'],
				'transport'			=> 'refresh',
				'sanitize_callback' => 'CozyStay_Utils_Sanitize::sanitize_checkbox'
			) ) );
			$wp_customize->add_setting( new WP_Customize_Setting( $wp_customize, 'cozystay_room_reservation_form_hide_field_child', array(
				'default'			=> $defaults['cozystay_room_reservation_form_hide_field_child'],
				'transport'			=> 'refresh',
				'sanitize_callback' => 'CozyStay_Utils_Sanitize::sanitize_checkbox'
			) ) );
			$wp_customize->add_setting( new WP_Customize_Setting( $wp_customize, 'cozystay_room_reservation_form_merge_checkin_checkout', array(
				'default'			=> $defaults['cozystay_room_reservation_form_merge_checkin_checkout'],
				'transport'			=> 'refresh',
				'sanitize_callback' => 'CozyStay_Utils_Sanitize::sanitize_checkbox'
			) ) );

			$wp_customize->add_setting( new WP_Customize_Setting( $wp_customize, 'cozystay_room_total_cost_settings', array(
				'default' 			=> '',
				'transport'			=> 'postMessage',
				'sanitize_callback' => 'CozyStay_Utils_Sanitize::sanitize_empty'
			) ) );
			$wp_customize->add_setting( new WP_Customize_Setting( $wp_customize, 'cozystay_room_total_cost_details', array(
				'default' 			=> $defaults['cozystay_room_total_cost_details'],
				'transport'			=> 'refresh',
				'sanitize_callback' => 'CozyStay_Utils_Sanitize::sanitize_choice'
			) ) );
			$wp_customize->add_setting( new WP_Customize_Setting( $wp_customize, 'cozystay_room_base_price_breakdown', array(
				'default' 			=> $defaults['cozystay_room_base_price_breakdown'],
				'transport'			=> 'refresh',
				'sanitize_callback' => 'CozyStay_Utils_Sanitize::sanitize_choice'
			) ) );

			$wp_customize->add_control( new CozyStay_Customize_Control( $wp_customize, 'cozystay_room_reservation_form_hide_field_room', array(
				'type' 			=> 'checkbox',
				'label_first'	=> true,
				'label'			=> esc_html__( 'Hide "Rooms"', 'cozystay' ),
				'section'		=> $section_id,
				'settings' 		=> 'cozystay_room_reservation_form_hide_field_room'
			) ) );
			$wp_customize->add_control( new CozyStay_Customize_Control( $wp_customize, 'cozystay_room_reservation_form_hide_field_adult', array(
				'type' 			=> 'checkbox',
				'label_first'	=> true,
				'label'			=> esc_html__( 'Hide "Adults"', 'cozystay' ),
				'section'		=> $section_id,
				'settings' 		=> 'cozystay_room_reservation_form_hide_field_adult'
			) ) );
			$wp_customize->add_control( new CozyStay_Customize_Control( $wp_customize, 'cozystay_room_reservation_form_hide_field_child', array(
				'type' 			=> 'checkbox',
				'label_first'	=> true,
				'label'			=> esc_html__( 'Hide "Children"', 'cozystay' ),
				'section'		=> $section_id,
				'settings' 		=> 'cozystay_room_reservation_form_hide_field_child'
			) ) );

			$wp_customize->add_control( new CozyStay_Customize_Control( $wp_customize, 'cozystay_room_reservation_form_merge_checkin_checkout', array(
				'type' 			=> 'checkbox',
				'label_first'	=> true,
				'label'			=> esc_html__( 'Merge "Check In" and "Check Out"', 'cozystay' ),
				'section'		=> $section_id,
				'settings' 		=> 'cozystay_room_reservation_form_merge_checkin_checkout'
			) ) );

			$wp_customize->add_control( new CozyStay_Customize_Control( $wp_customize, 'cozystay_room_total_cost_settings', array(
				'type'		=> 'title_only',
				'label'		=> esc_html__( 'Total Cost Settings', 'cozystay' ),
				'section' 	=> $section_id,
				'settings'	=> 'cozystay_room_total_cost_settings'
			) ) );
			$wp_customize->add_control( new CozyStay_Customize_Control( $wp_customize, 'cozystay_room_total_cost_details', array(
				'type' 		=> 'select',
				'label'		=> esc_html__( 'Total Cost Details', 'cozystay' ),
				'section'	=> $section_id,
				'settings' 	=> 'cozystay_room_total_cost_details',
				'choices' 	=> array(
					'default-hide' 	=> esc_html__( 'Hide by default', 'cozystay' ),
					'default-show' 	=> esc_html__( 'Display by default', 'cozystay' ),
					'always-show'	=> esc_html__( 'Always display', 'cozystay' )
				)
			) ) );
			$wp_customize->add_control( new CozyStay_Customize_Control( $wp_customize, 'cozystay_room_base_price_breakdown', array(
				'type' 		=> 'select',
				'label'		=> esc_html__( 'Base (Room) Price Breakdown', 'cozystay' ),
				'section'	=> $section_id,
				'settings' 	=> 'cozystay_room_base_price_breakdown',
				'choices' 	=> array(
					'' 	=> esc_html__( 'Click to display', 'cozystay' ),
					'always-show' => esc_html__( 'Always display', 'cozystay' )
				)
			) ) );
		}
		/**
		* Register section similar rooms section
		*/
		protected function add_section_similar_rooms( $wp_customize ) {
			$defaults = $this->defaults;
			$this->section_priority += 5;
			$section_id = 'cozystay_rooms_section_similar_rooms';
			$wp_customize->add_section( $section_id, array(
				'title' => esc_html__( 'Similar Rooms', 'cozystay' ),
				'panel' => $this->panel_id,
				'priority' => $this->section_priority
			) );

			$wp_customize->add_setting( new WP_Customize_Setting( $wp_customize, 'cozystay_rooms_hide_similar_rooms_section', array(
				'default'			=> $defaults['cozystay_rooms_hide_similar_rooms_section'],
				'transport'			=> 'refresh',
				'sanitize_callback' => 'CozyStay_Utils_Sanitize::sanitize_checkbox'
			) ) );
			$wp_customize->add_setting( new CozyStay_Customize_Setting( $wp_customize, 'cozystay_rooms_similar_rooms_section_title', array(
				'default'			=> apply_filters( 'loftocean_simiar_rooms_section_title', $defaults['cozystay_rooms_similar_rooms_section_title'] ),
				'transport'			=> 'refresh',
				'sanitize_callback' => 'sanitize_text_field',
				'dependency' 		=> array(
					'cozystay_rooms_hide_similar_rooms_section' => array( 'value' => array( '' ) )
				)
			) ) );

			$wp_customize->add_control( new CozyStay_Customize_Control( $wp_customize, 'cozystay_rooms_hide_similar_rooms_section', array(
				'type' 			=> 'checkbox',
				'label_first'	=> true,
				'label'			=> esc_html__( 'Hide Similar Rooms section', 'cozystay' ),
				'section'		=> $section_id,
				'settings' 		=> 'cozystay_rooms_hide_similar_rooms_section',
			) ) );
			$wp_customize->add_control( new CozyStay_Customize_Control( $wp_customize, 'cozystay_rooms_similar_rooms_section_title', array(
				'type'				=> 'text',
				'label'				=> esc_html__( 'Simiar Rooms Section Title', 'cozystay' ),
				'section'			=> $section_id,
				'settings' 			=> 'cozystay_rooms_similar_rooms_section_title',
				'active_callback' 	=> array( $this, 'customize_control_active_cb' )
			) ) );
		}
		/**
		* Register section search page
		*/
		protected function add_section_search_page( $wp_customize ) {
			$defaults = $this->defaults;
			$this->section_priority += 5;
			$section_id = 'cozystay_rooms_section_search_page';
			$wp_customize->add_section( $section_id, array(
				'title' => esc_html__( 'Search Results', 'cozystay' ),
				'panel' => $this->panel_id,
				'priority' => $this->section_priority
			) );

			$wp_customize->add_setting( new WP_Customize_Setting( $wp_customize, 'cozystay_rooms_search_page_enable_booking_rules', array(
				'default'			=> $defaults['cozystay_rooms_search_page_enable_booking_rules'],
				'transport'			=> 'refresh',
				'sanitize_callback' => 'CozyStay_Utils_Sanitize::sanitize_checkbox'
			) ) );

			$wp_customize->add_control( new CozyStay_Customize_Control( $wp_customize, 'cozystay_rooms_search_page_enable_booking_rules', array(
				'type' 			=> 'checkbox',
				'label_first'	=> true,
				'label'			=> esc_html__( 'Booking Rules Take Effect On The Search Results Page', 'cozystay' ),
				'description'	=> esc_html__( 'Enabling this feature may result in fewer search results', 'cozystay' ),
				'section'		=> $section_id,
				'settings' 		=> 'cozystay_rooms_search_page_enable_booking_rules'
			) ) );
		}
	}
	new CozyStay_Customize_Rooms();
}
