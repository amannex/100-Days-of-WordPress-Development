<?php

/**
 * Day 30 — WordPress REST API
 */


/**
 * Register REST route.
 */
register_rest_route(
    'day30/v1',
    '/properties',
    array(
        'methods' =>
            WP_REST_Server::READABLE,

        'callback' =>
            'day30_get_properties',

        'permission_callback' =>
            '__return_true',
    )
);


/**
 * Get request parameter.
 */
$city = $request->get_param(
    'city'
);


/**
 * Create REST response.
 */
return rest_ensure_response(
    array(
        'success' => true,
        'data'    => array(),
    )
);


/**
 * Explicit REST response.
 */
return new WP_REST_Response(
    array(
        'message' => 'Success',
    ),
    200
);


/**
 * REST error.
 */
return new WP_Error(
    'not_found',
    'Resource not found.',
    array(
        'status' => 404,
    )
);


/**
 * Permission callback.
 */
$permission_callback = function () {

    return current_user_can(
        'manage_options'
    );
};


/**
 * Get option.
 */
$value = get_option(
    'day29_currency',
    'INR'
);


/**
 * Query properties.
 */
$properties = get_posts(
    array(
        'post_type'      => 'property',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
    )
);


/**
 * Get post meta.
 */
$city = get_post_meta(
    $property_id,
    '_property_city',
    true
);


/**
 * Get featured image.
 */
$image = get_the_post_thumbnail_url(
    $property_id,
    'large'
);