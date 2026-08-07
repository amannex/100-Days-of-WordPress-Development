# Day 16 — WordPress AJAX

## Topics Learned

- AJAX in WordPress
- admin-ajax.php
- wp_ajax_
- wp_ajax_nopriv_
- wp_localize_script()
- AJAX Nonces
- Fetch API
- wp_send_json_success()
- wp_send_json_error()

## What is AJAX?

AJAX allows the browser to communicate with the server
without reloading the entire webpage.

WordPress provides admin-ajax.php for handling traditional
AJAX requests.

## AJAX Flow

User Action
↓
JavaScript
↓
admin-ajax.php
↓
PHP Callback
↓
WordPress
↓
JSON Response
↓
JavaScript
↓
Update UI

## wp_ajax_

Used for authenticated/logged-in users.

Example:

add_action(
    'wp_ajax_load_posts',
    'load_posts'
);

## wp_ajax_nopriv_

Used when logged-out visitors should also be able to make
the AJAX request.

Example:

add_action(
    'wp_ajax_nopriv_load_posts',
    'load_posts'
);

## Security

AJAX requests should use nonces when appropriate.

Create nonce:

wp_create_nonce()

Verify nonce:

check_ajax_referer()

## Returning JSON

Success:

wp_send_json_success();

Error:

wp_send_json_error();

## Key Learnings

- AJAX prevents unnecessary page reloads.
- WordPress traditional AJAX uses admin-ajax.php.
- JavaScript sends an action parameter.
- WordPress maps the action to a PHP callback.
- wp_ajax_ handles authenticated users.
- wp_ajax_nopriv_ handles unauthenticated users.
- Nonces help protect AJAX requests.
- WordPress can return structured JSON responses.

## Real-World Uses

- Load More Posts
- Live Search
- Property Filters
- Form Submission
- Wishlist
- Booking Availability
- Cart Updates
- Like/Favorite Buttons