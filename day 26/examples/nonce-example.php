<?php

/**
 * Nonce Example
 */


/*
 * Create nonce.
 */

wp_nonce_field(
    'save_property',
    'property_nonce'
);


/*
 * Verify nonce.
 */

if (
    ! isset(
        $_POST['property_nonce']
    )
) {
    return;
}


if (
    ! wp_verify_nonce(
        $_POST['property_nonce'],
        'save_property'
    )
) {
    return;
}
