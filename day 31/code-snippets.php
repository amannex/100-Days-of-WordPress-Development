<?php

/**
 * Day 31 — REST API POST
 */


/**
 * Register POST route.
 */
register_rest_route(
    'day31/v1',
    '/properties',
    array(
        'methods' =>
            WP_REST_Server::CREATABLE,

        'callback' =>
            'day31_create_property',

        'permission_callback' =>
            function () {

                return current_user_can(
                    'edit_posts'
                );
            },
    )
);


/**
 * Get JSON request body.
 */
$data = $request->get_json_params();


/**
 * Get parameter.
 */
$title = $data['title'] ?? '';


/**
 * Sanitize text.
 */
$title = sanitize_text_field(
    $title
);


/**
 * Convert to positive integer.
 */
$price = absint(
    $data['price']
);


/**
 * Validate.
 */
if ( $price <= 0 ) {

    return new WP_Error(
        'invalid_price',
        'Price must be greater than zero.',
        array(
            'status' => 400,
        )
    );
}


/**
 * Create WordPress post.
 */
$post_id = wp_insert_post(
    array(
        'post_title'  => $title,
        'post_type'   => 'property',
        'post_status' => 'publish',
    ),
    true
);


/**
 * Check error.
 */
if (
    is_wp_error(
        $post_id
    )
) {

    return $post_id;
}


/**
 * Save metadata.
 */
update_post_meta(
    $post_id,
    '_property_city',
    $city
);


update_post_meta(
    $post_id,
    '_property_price',
    $price
);


/**
 * Return 201 Created.
 */
return new WP_REST_Response(
    array(
        'success' => true,
        'data' => array(
            'id' => $post_id,
        ),
    ),
    201
);