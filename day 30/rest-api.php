<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


/**
 * Register REST API routes.
 */
function day30_register_rest_routes() {

    /**
     * Get all properties.
     */
    register_rest_route(
        'day30/v1',
        '/properties',
        array(
            'methods'             =>
                WP_REST_Server::READABLE,

            'callback'            =>
                'day30_get_properties',

            'permission_callback' =>
                '__return_true',
        )
    );


    /**
     * Get single property.
     */
    register_rest_route(
        'day30/v1',
        '/properties/(?P<id>\d+)',
        array(
            'methods'             =>
                WP_REST_Server::READABLE,

            'callback'            =>
                'day30_get_property',

            'permission_callback' =>
                '__return_true',
        )
    );
}


add_action(
    'rest_api_init',
    'day30_register_rest_routes'
);


/**
 * Get all properties.
 */
function day30_get_properties(
    WP_REST_Request $request
) {

    $city = $request->get_param(
        'city'
    );


    $args = array(
        'post_type'      => 'property',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
    );


    if ( ! empty( $city ) ) {

        $args['meta_query'] = array(
            array(
                'key'     => '_property_city',
                'value'   => sanitize_text_field(
                    $city
                ),
                'compare' => 'LIKE',
            ),
        );
    }


    $properties = get_posts(
        $args
    );


    $response = array();


    foreach (
        $properties as $property
    ) {

        $response[] = array(
            'id' => $property->ID,

            'title' => get_the_title(
                $property->ID
            ),

            'slug' => $property->post_name,

            'city' => get_post_meta(
                $property->ID,
                '_property_city',
                true
            ),

            'price' => get_post_meta(
                $property->ID,
                '_property_price',
                true
            ),

            'bedrooms' => get_post_meta(
                $property->ID,
                '_property_bedrooms',
                true
            ),

            'featured' => (bool) get_post_meta(
                $property->ID,
                '_property_featured',
                true
            ),

            'image' => get_the_post_thumbnail_url(
                $property->ID,
                'large'
            ),
        );
    }


    return rest_ensure_response(
        $response
    );
}


/**
 * Get a single property.
 */
function day30_get_property(
    WP_REST_Request $request
) {

    $property_id = absint(
        $request->get_param( 'id' )
    );


    $property = get_post(
        $property_id
    );


    if (
        ! $property ||
        'property' !== $property->post_type
    ) {

        return new WP_Error(
            'property_not_found',
            'Property not found.',
            array(
                'status' => 404,
            )
        );
    }


    return rest_ensure_response(
        array(
            'id' => $property->ID,

            'title' => get_the_title(
                $property->ID
            ),

            'slug' => $property->post_name,

            'city' => get_post_meta(
                $property->ID,
                '_property_city',
                true
            ),

            'price' => get_post_meta(
                $property->ID,
                '_property_price',
                true
            ),

            'bedrooms' => get_post_meta(
                $property->ID,
                '_property_bedrooms',
                true
            ),

            'featured' => (bool) get_post_meta(
                $property->ID,
                '_property_featured',
                true
            ),

            'image' => get_the_post_thumbnail_url(
                $property->ID,
                'large'
            ),
        )
    );
}