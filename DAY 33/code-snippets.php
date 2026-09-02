<?php

/**
 * Day 33 — REST API DELETE
 */


/**
 * Register DELETE route.
 */
register_rest_route(
    'day33/v1',
    '/properties/(?P<id>\d+)',
    array(
        'methods' =>
            WP_REST_Server::DELETABLE,

        'callback' =>
            'day33_delete_property',

        'permission_callback' =>
            function () {

                return current_user_can(
                    'delete_posts'
                );
            },
    )
);


/**
 * Get property ID.
 */
$property_id = absint(
    $request->get_param('id')
);


/**
 * Find property.
 */
$property = get_post(
    $property_id
);


/**
 * Check existence.
 */
if ( ! $property ) {

    return new WP_Error(
        'property_not_found',
        'Property not found.',
        array(
            'status' => 404,
        )
    );
}


/**
 * Check post type.
 */
if (
    $property->post_type !== 'property'
) {

    return new WP_Error(
        'invalid_property',
        'The requested resource is not a property.',
        array(
            'status' => 400,
        )
    );
}


/**
 * Delete property.
 *
 * false means move to Trash.
 */
$deleted = wp_delete_post(
    $property_id,
    false
);


/**
 * Check deletion.
 */
if ( ! $deleted ) {

    return new WP_Error(
        'delete_failed',
        'Property could not be deleted.',
        array(
            'status' => 500,
        )
    );
}


/**
 * Return response.
 */
return new WP_REST_Response(
    array(
        'success' => true,

        'message' =>
            'Property deleted successfully.',

        'data' => array(
            'id' =>
                $property_id,
        ),
    ),
    200
);