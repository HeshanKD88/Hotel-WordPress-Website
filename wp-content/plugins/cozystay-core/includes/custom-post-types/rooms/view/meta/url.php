<?php
    $pid = $post->ID;
    $url = get_post_meta( $pid, 'loftocean_room_url', true ); ?>

    <div class="loftocean-room-url-wrapper">
        <textarea id="loftocean_room_url" name="loftocean_room_url" style="width: 100%;" rows="4"><?php echo esc_url( $url ); ?></textarea>
        <p class="description"><?php esc_html_e( 'Enter the external URL to the room.', 'loftocean' ); ?></p>
    </div>
    
