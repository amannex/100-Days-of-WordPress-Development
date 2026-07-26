<?php

if (
    isset( $_POST['submit'] ) &&
    isset( $_POST['tour_nonce'] ) &&
    wp_verify_nonce( $_POST['tour_nonce'], 'save_tour' )
) {

    $name  = sanitize_text_field( $_POST['name'] );
    $email = sanitize_email( $_POST['email'] );

    if ( is_email( $email ) ) {

        echo '<p>';
        echo esc_html( $name );
        echo '</p>';

        echo '<p>';
        echo esc_html( $email );
        echo '</p>';
    }
}