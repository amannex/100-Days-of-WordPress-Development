<?php

/**
 * Day 32 — Updating WordPress Properties
 */


/*
 * Register an editable route.
 */
register_rest_route(
    'day32/v1',
    '/properties/(?P<id>\d+)',
    array(
        'methods' =>
            'PUT',

        'callback' =>
            'day32_update_property',

        'permission_callback' =>
            function () {

                return current_user_can(
                    'edit_posts'
                );
            },
    )
);


/*
 * Get ID from URL.
 */
$property_id = absint(
    $request->get_param('id')
);


/*
 * Get post.
 */
$property = get_post(
    $property_id
);


/*
 * Check if post exists.
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


/*
 * Check post type.
 */
if (
    $property->post_type !== 'property'
) {

    return new WP_Error(
        'invalid_property',
        'Not a property.',
        array(
            'status' => 400,
        )
    );
}


/*
 * Get JSON body.
 */
$data = $request->get_json_params();


/*
 * Check whether title was provided.
 */
if (
    isset( $data['title'] )
) {

    $title = sanitize_text_field(
        $data['title']
    );

    wp_update_post(
        array(
            'ID' =>
                $property_id,

            'post_title' =>
                $title,
        )
    );
}


/*
 * Update city.
 */
if (
    isset( $data['city'] )
) {

    $city = sanitize_text_field(
        $data['city']
    );

    update_post_meta(
        $property_id,
        '_property_city',
        $city
    );
}


/*
 * Update price.
 */
if (
    isset( $data['price'] )
) {

    $price = absint(
        $data['price']
    );

    update_post_meta(
        $property_id,
        '_property_price',
        $price
    );
}


/*
 * Update bedrooms.
 */
if (
    isset( $data['bedrooms'] )
) {

    $bedrooms = absint(
        $data['bedrooms']
    );

    update_post_meta(
        $property_id,
        '_property_bedrooms',
        $bedrooms
    );
}


/*
 * Return response.
 */
return new WP_REST_Response(
    array(
        'success' => true,
        'message' =>
            'Property updated successfully.',
        'data' => array(
            'id' =>
                $property_id,
        ),
    ),
    200
);