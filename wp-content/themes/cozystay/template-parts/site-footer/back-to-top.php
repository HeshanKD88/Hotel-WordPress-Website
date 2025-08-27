<?php
$cozystay_is_customize_preview = false;
if ( cozystay_module_enabled( 'cozystay_show_back_to_top_button' ) || ( $cozystay_is_customize_preview = cozystay_is_customize_preview() ) ) : ?>
    <a href="#" class="to-top<?php if ( $cozystay_is_customize_preview ): ?> hide<?php endif; ?>" aria-label="<?php esc_attr_e( 'Site Scroll to Top Icon', 'cozystay' ); ?>"></a><?php
endif;
