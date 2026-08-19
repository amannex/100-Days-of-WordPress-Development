<?php

/**
 * WordPress Security Quick Reference
 */


/**
 * SANITIZATION
 */

$text = sanitize_text_field(
    $value
);

$email = sanitize_email(
    $value
);

$url = esc_url_raw(
    $value
);

$number = absint(
    $value
);


/**
 * VALIDATION
 */

if (
    $number < 1 ||
    $number > 100
) {
    return;
}


/**
 * AUTHORIZATION
 */

if (
    ! current_user_can(
        'edit_post',
        $post_id
    )
) {
    return;
}


/**
 * NONCE
 */

wp_nonce_field(
    'my_action',
    'my_nonce'
);


if (
    ! wp_verify_nonce(
        $_POST['my_nonce'],
        'my_action'
    )
) {
    return;
}


/**
 * ESCAPING
 */

echo esc_html(
    $text
);

echo esc_url(
    $url
);

echo esc_attr(
    $attribute
);


/**
 * SQL
 */

global $wpdb;

$query = $wpdb->prepare(
    "
    SELECT *
    FROM {$wpdb->posts}
    WHERE ID = %d
    ",
    $post_id
);