=== CozyStay ===
Author: loftocean
Requires at least: WordPress 6.0
Tested up to: WordPress 6.7
Version: 1.7.0
License: GPL-2.0-or-later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: full-width-template, left-sidebar, right-sidebar, custom-background, custom-colors, custom-header, custom-menu, editor-style, featured-images, rtl-language-support, sticky-post, threaded-comments, translation-ready

== Description ==
CozyStay is a Hotel Booking WordPress theme.

== Copyright ==
(c) Copyright Loft.Ocean 2023 to 2025 loftocean.com

CozyStay bundles the following third-party resources:

HTML5 Shiv v3.7.3, @afarkas @jdalton @jon_neal @rem
Licenses: MIT/GPL2
Source: https://github.com/aFarkas/html5shiv

Font Awesome Free 6.6.0, by @fontawesome - Copyright 2024 Fonticons, Inc
License - Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License, https://fontawesome.com/license/free
Source: https://fontawesome.com

Elegant Icon Font, Copyright (c) Elegant Themes
Licenses: GPL v2.0 and MIT license, http://www.gnu.org/licenses/gpl-2.0.html, https://opensource.org/licenses/MIT
Source: https://www.elegantthemes.com/blog/resources/elegant-icon-font

Modernizr v2.8.3, copyright (c) Faruk Ates, Paul Irish, Alex Sexton
Licenses: BSD and MIT, www.modernizr.com/license/
Source: www.modernizr.com

FitVids 1.1, Copyright 2013, Chris Coyier
Licenses: WTFPL, http://sam.zoy.org/wtfpl/
Source: http://fitvidsjs.com/

Slick Slider 1.6.0, Ken Wheeler
Licensed: MIT, https://github.com/kenwheeler/slick/blob/master/LICENSE
Source: http://kenwheeler.github.io/slick/

Zap Calendar iCalendar Library, Copyright (C) 2006 - 2017 by Dan Cogliano
Licenses: GNU GPLv3 http://www.gnu.org/licenses/gpl.html
Source: https://icalendar.org/php-library.html

All photos are licensed under The Unsplash License (https://unsplash.com/license)

== Changelog ==
= 1.7.0 =
* New: Choose whether to not check for room availability when importing external bookings
* New: Option to show booking rules on all room search forms if the rule-set applies to all rooms
* New: Added a button to delete all imported bookings
* Improved: After modifying the external calendar link, automatically clear old data imported via the original calendar link 
* Improved: Keep data structure consistent in various cases
* Fixed: Potential issues when dynamically checking whether the check-in date in the order has expired during the payment process
* Fixed: Potential issues when manually adding and editing room orders under old versions of WooCommerce
* Fixed: Minor CSS Issues
* Updated: Required plugin CozyStay Core updated to v1.7

= 1.6.0 =
* New: Manually create and edit room orders in the WordPress dashboard
* New: Support for adding external links to room posts
* New: Option to skip room search results page when only one search result is found
* New: Supporting for adding description text for each extra service item
* New: Supporting for setting Variable Pricing for special time ranges
* New: Supporting for adding galleries specifically for display in room listings (separate from the gallery at the top of the single room page)
* Improved: Layout and style of WooCommerce Block Cart and Checkout pages
* Improved: Compatibility with Elementor Pro
* Fixed: Compatibility issue between CS Gallery widget and WPML
* Fixed: Potential issues when multiple booking rules for different time ranges are applied at the same time
* Fixed: Potential issues when importing elements from CozyStay Template Library
* Fixed: Warnings displayed when debug mode is enabled
* Updated: Required plugin CozyStay Core updated to v1.6.0

= 1.5.1 =
* New: CS Mini Cart - Option to change icon color and hover color
* New: CS Mobile Menu Toggle - Option to change color and hover color
* New: 70+ new hotel icons
* New: Option to set whether nouns should be plural when number of guests is 0
* Improved: Compatibility with WooCommerce version 9.x
* Improved: Accessibility of background images, Call To Actions, Fancy Cards, etc.
* Fixed: Issue with dynamic detection of number of available rooms during checkout
* Fixed: When adding a new menu item, its mega menu option did not appear immediately
* Fixed: "0 Child" changed to "0 Children"
* Fixed: Minor CSS Issues
* Updated: Required plugin CozyStay Core updated to v1.5.1

= 1.5.0 =
* New: Added "Variable Pricing" feature, which allows users to set different prices for the same room based on the number of guests staying
* New: Added option to change "room" in room URLs to other words
* New: Flexible Price Rules - Long Stay Discounts - Support for adding custom stay length
* New: Room Booking Form - Option to combine "Check In" and "Check Out" into a single item "Dates"
* New: CS Reservation Filter widget - For "Block" Style, added an option to combine "Check In" and "Check Out" into a single item "Dates"
* New: Room Booking Form - Option to display total cost details by default (click to collapse/expand)
* New: Room Booking Form - Option to always display total cost details (can no longer be collapsed)
* New: Room Booking Form - Option to always display Base (Room) Price Breakdown or click to display
* New: Support for adding optional age description text for Adults and Children
* New: Option to set a maximum number of adults in a room
* New: Option to set a maximum number of children in a room
* New: Weekend Prices - Support for changing the days when weekend prices take effect
* New: Social Media Icon - X
* Improved: Room Booking Form - When trying to add guests/adults/children that exceed the limit, the "+/-" button will no longer be clickable and a corresponding prompt will be displayed
* Improved: Hide "Apply" and "Cancel" buttons of Availability Calendar if theme's built-in booking form is not enabled
* Improved: Room Search & Booking Form - Improved hints and highlighting when selecting check-in and check-out dates
* Fixed: Minor issues with iCal Sync
* Fixed: Minor issues with WPML
* Fixed: Weekend Prices related issues
* Fixed: A few words on the "Cart" and "Checkout" pages could not be translated
* Fixed: Slider bug in RTL mode
* Fixed: Minor CSS Issues
* Updated: Font Awesome updated to v6.6
* Updated: Required plugin CozyStay Core updated to v1.5.0

= 1.4.0 =
* New: Support for synchronizing room bookings with OTA via iCal
* New: Room Settings - Support showing bookings for the room in calendar view
* New: Room Settings - Room Facility - Added custom text input boxes for each item
* New: Extra Services - New pricing method: Item Price * User Set Quantity * Nights
* New: Extra Services - Support setting quantity range for "User Set Quantity"
* New: Option to change date format in room search/booking forms
* New: Added more room facility icons
* New: Room facility reset button on multilingual websites
* New: Option to automatically fill in the selected items from the room search form into the booking form
* New: Option to allow room booking rules to take effect on the search results page
* New: Option to remove Similar Rooms section on single room pages
* New: Option to change the section title of Similar Rooms section
* New: CS Rooms - Option to control the number of room facility icons displayed
* New: CS Mini Cart - Show Item Indicator
* New: CS Mini Cart - Options to set Item Indicator background and text color
* New: For developers - Added API to add custom fields at the front and end of the room search form
* Improved: The text of the day of the week in the calendar is automatically translated with language switching
* Improved: Extra Services - Support for entering prices with decimal points
* Improved: Synchronize the remaining quantity of the same room in different languages on multi-language websites
* Improved: Theme Optmization for Elementor Flexbox Container
* Improved: Compatibility with Elementor's Inline Font Icons feature
* Improved: Optimized room price related code to avoid potential bugs in rare cases
* Improved: Avoid warning messages when saving room editing page in some rare cases
* Fixed: Few texts on the shopping cart/checkout page could not be translated
* Fixed: Gallery and slider flickering when scrolling up and down on mobile devices
* Fixed: Minor compatibility issues with Elementor Pro
* Fixed: Unable to switch languages on room search results page when using Polylang/WPML
* Fixed: An error message appeared after enabling shipping fee in WooCommerce
* Fixed: CS Blog - Post source not working properly when there are multiple CS Blog widgets on the same page
* Fixed: Potential download issue in CozyStay Template Library
* Fixed: Minor CSS Issues
* Updated: Google Fonts List
* Updated: Required plugin CozyStay Core updated to v1.4.0

= 1.3.0 =
* New: Support for WooCommerce's Currency Options features (Price Format)
* New: Optimized support for WooCommerce’s Taxes feature
* New: Option to change the title for Availability Calendar on single room pages
* New: Room Booking Form - Rooms - Using the actual remaining number of rooms as the upper limit of the selectable number
* New: Option to hide Rooms/Adults/Children in the Room Booking Form
* New: Room Booking Form - Calendar - Optimized detection of Minimum Stay & Maximum Stay
* New: Room Booking Form - Calendar - Tooltips for Minimum Stay & Maximum Stay
* New: Display room booking details on Checkout Page 
* Improved: Compatibility with PHP 8.2
* Fixed: When the number of rooms selected when booking is the same as the number of rooms set, the remaining number of rooms does not change after the order is submitted
* Fixed: Compatibility issues between theme's custom Elementor elements and WPML
* Fixed: Minor CSS Issues
* Updated: Required plugin CozyStay Core updated to v1.3.0

= 1.2.0 =
* New: Show/Hide Availability Calendar on single room pages
* New: Options to change colors of Availability Calendar
* New: Extra Services - Effective Time
* New: Extra Services - Set as obligatory
* New: Extra Services - Set Adult Price & Child Price
* New: Option to change the Read More button text for all Rooms List
* New: Room Booking Form - Calendar - Tooltips
* New: Room Search & Booking Form - Options to change colors of the dropdown & calendar
* Improved: Room Search & Booking Form - Calendar change to Date Range Picker
* Improved: Room Booking Form - Other optimizations for calendar dates
* Fixed: Button pop-up window covers the main content
* Fixed: The problem that the checkout date in the room search form can be earlier than the check-in date
* Fixed: Room facilities contain duplicate options
* Updated: Required plugin CozyStay Core updated to v1.2.0

= 1.1.0 =
* New: Option to set Weekend Price (Friday and Saturday)
* New: Flexible Price Rules Feature
* New: Booking Rules Feature
* New: Set Seasonal Price or any time range discount
* New: Set Early Bird Discount
* New: Set Last-minute Discount
* New: Set Long Stay Discounts: Weekly & Monthly
* New: Set Stay Length: Minimum Stay & Maximum Stay
* New: Set Stay Length by Check-in Day
* New: Set No Check-in and No Check-out Days
* New: Set how far in advance guests can book
* New: The total price of the booking form can be expanded to display the details of price components when booking a room
* New: Single room editing page - Room Settings - Availability Tab - Display the remaining number of the current room in the calendar
* Improved: Compatibility with WordPress 6.3
* Fixed: Single room editing page - Room Settings - Availability Tab - can only display the current month's information
* Fixed: Minor CSS Issues
* Updated: Required plugin CozyStay Core updated to v1.1.0

= 1.0.0 =
* Initial Release