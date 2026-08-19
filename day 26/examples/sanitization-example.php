<?php

/**
 * Sanitization Examples
 */


$name = sanitize_text_field(
    $_POST['name']
);


$email = sanitize_email(
    $_POST['email']
);


$url = esc_url_raw(
    $_POST['url']
);


$number = absint(
    $_POST['number']
);


$key = sanitize_key(
    $_POST['key']
);