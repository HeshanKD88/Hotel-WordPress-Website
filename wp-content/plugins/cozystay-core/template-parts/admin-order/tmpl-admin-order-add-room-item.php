<script type="text/template" id="tmpl-wc-modal-add-room">
    <div class="wc-backbone-modal">
        <div class="wc-backbone-modal-content">
            <section class="wc-backbone-modal-main" role="main">
                <header class="wc-backbone-modal-header">
                    <h1><?php esc_html_e( 'Add Room', 'loftocean' ); ?></h1>
                    <button class="modal-close modal-close-link dashicons dashicons-no-alt">
                        <span class="screen-reader-text">Close modal panel</span>
                    </button>
                </header>
                <article>
                    <form action="" method="post">
                        <table class="widefat">
                            <thead>
                                <tr>
                                    <th><?php esc_html_e( 'Room', 'loftocean' ); ?></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <?php
                                $row = '<td><select class="wc-product-search" name="item_id" data-action="loftocean-search-room" data-allow_clear="true" data-display_stock="true" data-exclude_type="variable" data-placeholder="' . esc_attr__( 'Search for a room&hellip;', 'loftocean' ) . '"></select></td><td></td>';
                            ?>
                            <tbody data-row="<?php // echo esc_attr( $row ); ?>">
                                <tr>
                                    <?php echo $row; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </article>
                <footer>
                    <div class="inner">
                        <button id="btn-ok" class="button button-primary button-large"><?php esc_html_e( 'Add', 'loftocean' ); ?></button>
                    </div>
                </footer>
            </section>
        </div>
    </div>
    <div class="wc-backbone-modal-backdrop modal-close"></div>
</script>

<script id="tmpl-loftocean-room-extra-services" type="text/template">
    <p class="form-field cs_extra_services_field"><strong><?php esc_html_e( 'Extra Services', 'loftocean' ); ?></strong></p><#
    var settingNamePrefix = 'room_details[' + data.itemID + ']', 
        servicePrefix = 'extra_service_',
        selectedServices = data[ 'selectedServices' ], 
        hasSelectedServices = ( 'undefined' != typeof selectedServices[ 'services' ] );

    data.services.forEach( function( item ) { 
        var serviceID = servicePrefix + item[ 'term_id' ],
            isObligatory = ( 'yes' == item[ 'obligatory' ] );
            serviceEnabled =  ( hasSelectedServices && selectedServices[ 'services' ].hasOwnProperty( serviceID ) ) || isObligatory;
            checkboxName = settingNamePrefix + '[extra_service_id][' + serviceID + ']';
            checkboxID = checkboxName.replace( '[', '-' ).replace( ']', '' ); #>

        <div class="form-field cs_extra_services_field">
            <input class="checkbox<# if ( isObligatory ) { #> obligatory<# } #>" type="checkbox" name="{{{ checkboxName }}}" id="{{{ checkboxID }}}" value="{{{ item[ 'term_id' ] }}}"<# if ( serviceEnabled ) { #> checked<# } #><# if ( isObligatory ) { #> readonly onClick="return false;"<# } #>>
            <label for="{{{ checkboxID }}}">{{{ item[ 'name' ] }}} ({{{ item[ 'label_text' ] }}}) </label><#
            if ( [ 'custom', 'auto_custom' ].includes( item[ 'method' ] ) ) {
                var minimumQuantity = item[ 'custom_minimum_quantity' ] && ( ! Number.isNaN( item[ 'custom_minimum_quantity' ] ) ) ? item[ 'custom_minimum_quantity' ] : false,
                    maximumQuantity = item[ 'custom_maximum_quantity' ] && ( ! Number.isNaN( item[ 'custom_maximum_quantity' ] ) ) ? item[ 'custom_maximum_quantity' ] : false,
                    defaultQuantity = 1, attrMin = 1, attrMax = '';

                if ( ( false !== minimumQuantity ) && ( minimumQuantity  > 0 ) ) {
                    defaultQuantity = minimumQuantity;
                    attrMin = minimumQuantity;
                }
                if ( ( false !== maximumQuantity ) && ( maximumQuantity > 0 ) ) {
                    attrMax = maximumQuantity;
                }
                if ( serviceEnabled && hasSelectedServices && selectedServices[ 'quantity' ].hasOwnProperty( serviceID ) ) {
                    defaultQuantity = Math.max( selectedServices[ 'quantity' ][ serviceID ], defaultQuantity );
                } #>
                <label><small class="times">×</small></label> 
                <input 
                    class="cs_extra_services_quantity" 
                    type="number" 
                    name="{{{ settingNamePrefix }}}[extra_service_quantity][{{{ serviceID }}}]" 
                    value="{{{ defaultQuantity }}}" 
                    <# if ( ! Number.isNaN( attrMin ) ) { #> min="{{{ attrMin }}}"<# } #>
                    <# if ( ! Number.isNaN( attrMax ) ) { #> max="{{{ attrMax }}}"<# } #>
                ><#
            } #>
            <div class="hidden-fiedls">
                <input type="hidden" name="{{{ settingNamePrefix }}}[extra_service_price][{{{ serviceID }}}]" value="{{{ item[ 'price' ] }}}" />
                <input type="hidden" name="{{{ settingNamePrefix }}}[extra_service_calculating_method][{{{ serviceID }}}]" value="{{{ item[ 'method' ] }}}" />
                <input type="hidden" name="{{{ settingNamePrefix }}}[extra_service_title][{{{ serviceID }}}]" value="{{{ item[ 'name' ] }}}" />
                <input type="hidden" name="{{{ settingNamePrefix }}}[extra_service_price_label][{{{ serviceID }}}]" value="{{{ item[ 'label_text' ] }}}" /><#
                if ( 'auto' == item[ 'method' ] ) { #>
                    <input type="hidden" name="{{{ settingNamePrefix }}}[extra_service_auto_calculating_unit][{{{ serviceID }}}]" value="{{{ item[ 'auto_method' ] }}}" /><#
                    if ( [ 'person', 'night-person' ].includes( item[ 'auto_method' ] ) && ( ( ! Number.isNaN( item[ 'custom_adult_price' ] ) ) || ( ! Number.isNaN( item[ 'custom_child_price' ] ) ) ) ) { #>
                        <input type="hidden" name="{{{ settingNamePrefix }}}[extra_service_auto_calculating_custom_adult_price][{{{ serviceID }}}]" value="{{{ item[ 'custom_adult_price' ] }}}" />
                        <input type="hidden" name="{{{ settingNamePrefix }}}[extra_service_auto_calculating_custom_child_price][{{{ serviceID }}}]" value="{{{ item[ 'custom_child_price' ] }}}" /><#
                    } 
                } #>
            </div>
        </div><#
    } ); #>
</script>
