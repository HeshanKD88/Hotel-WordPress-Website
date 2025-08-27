<?php
    $pid = $post->ID;
    $rooms_gallery_ids = get_post_meta( $pid, 'loftocean_rooms_gallery_ids', true );
    $has_rooms_gallery = ! empty( $rooms_gallery_ids ); ?>

    <p class="hide-if-no-js">
        <span class="rooms-gallery-description"><?php esc_html_e( 'If you would like a different gallery to be displayed in the room list, add the gallery here.', 'loftocean' ); ?></span>
    </p>
    <div class="gallery-has-image-wrapper"<?php if ( ! $has_rooms_gallery ) : ?> style="display: none;"<?php endif; ?>>
        
            <ul class="gallery-preview-list"><?php
            if ( $has_rooms_gallery ) :
                $rooms_gallery_ids_array = explode( ',', $rooms_gallery_ids );
                foreach ( $rooms_gallery_ids_array as $gid ) : ?>
                    <li><a href="#" class="set-gallery"><?php echo wp_get_attachment_image( $gid, array( 60, 9999999 ) ); ?></a></li><?php
                endforeach;
            endif; ?>
            </ul>
        </p>
        <p class="hide-if-no-js howto set-gallery-desc"><?php esc_html_e( 'Click the images to edit or update', 'loftocean' ); ?></p>
        <p class="hide-if-no-js"><a href="#" class="remove-gallery"><?php esc_html_e( 'Remove gallery', 'loftocean' ); ?></a></p>
    </div>
    <div class="gallery-no-image-wrapper"<?php if ( $has_rooms_gallery ) : ?> style="display: none;"<?php endif; ?>>
        <p class="hide-if-no-js">
            <a href="#" class="set-gallery"><?php esc_html_e( 'Add Gallery', 'loftocean' ); ?></a>
        </p>
    </div>
    <input type="hidden" id="loftocean_rooms_gallery_ids" name="loftocean_rooms_gallery_ids" value="<?php echo esc_attr( $rooms_gallery_ids ); ?>" />
