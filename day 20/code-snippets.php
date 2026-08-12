<?php
/**
 * Day 20 — WordPress REST API Authentication
 */

/**
 * Register Routes
 */
add_action(
    'rest_api_init',
    function () {

        register_rest_route(

            'travel/v1',

            '/properties',

            array(

                'methods' => 'GET',

                'callback' => 'day20_properties',

                'permission_callback' => '__return_true'

            )

        );


        register_rest_route(

            'travel/v1',

            '/property/(?P<id>\d+)',

            array(

                'methods' => 'GET',

                'callback' => 'day20_single_property',

                'permission_callback' => '__return_true'

            )

        );

    }
);


/**
 * Latest Properties
 */
function day20_properties() {

    $query = new WP_Query(

        array(

            'post_type' => 'property',

            'posts_per_page' => 5

        )

    );

    $properties = array();

    while ( $query->have_posts() ) {

        $query->the_post();

        $properties[] = array(

            'id' => get_the_ID(),

            'title' => get_the_title(),

            'url' => get_permalink()

        );

    }

    wp_reset_postdata();

    return rest_ensure_response(
        $properties
    );

}


/**
 * Single Property
 */
function day20_single_property(
    WP_REST_Request $request
) {

    $id = absint(
        $request->get_param( 'id' )
    );

    $post = get_post( $id );

    if ( ! $post ) {

        return new WP_Error(

            'property_not_found',

            'Property not found.',

            array(
                'status' => 404
            )

        );

    }

    return rest_ensure_response(

        array(

            'id' => $post->ID,

            'title' => $post->post_title,

            'content' => apply_filters(
                'the_content',
                $post->post_content
            )

        )

    );

}


/**
 * Protected Endpoint Example
 */
register_rest_route(

    'travel/v1',

    '/admin',

    array(

        'methods' => 'GET',

        'callback' => function () {

            return array(

                'message' => 'Authorized'

            );

        },

        'permission_callback' => function () {

            return current_user_can(
                'manage_options'
            );

        }

    )

);