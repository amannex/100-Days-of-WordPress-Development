<?php

/**
 * Day 34
 *
 * REST API Quality:
 * Pagination, Filtering, Searching & Ordering
 */

/**
 * Register Properties Collection Endpoint
 */
add_action('rest_api_init', function () {

    register_rest_route('day34/v1', '/properties', [
        'methods'  => WP_REST_Server::READABLE,

        'callback' => 'day34_get_properties',

        'permission_callback' => '__return_true',

        'args' => [

            'page' => [
                'default'           => 1,
                'sanitize_callback' => 'absint',
                'validate_callback' => function ($value) {
                    return absint($value) >= 1;
                },
            ],

            'per_page' => [
                'default'           => 10,
                'sanitize_callback' => 'absint',
                'validate_callback' => function ($value) {
                    return absint($value) >= 1 && absint($value) <= 50;
                },
            ],

            'search' => [
                'sanitize_callback' => 'sanitize_text_field',
            ],

            'city' => [
                'sanitize_callback' => 'sanitize_text_field',
            ],

            'property_type' => [
                'sanitize_callback' => 'sanitize_text_field',
            ],

            'orderby' => [
                'default'           => 'date',
                'sanitize_callback' => 'sanitize_key',
                'validate_callback' => function ($value) {
                    return in_array(
                        $value,
                        ['date', 'title', 'modified'],
                        true
                    );
                },
            ],

            'order' => [
                'default'           => 'DESC',
                'sanitize_callback' => 'strtoupper',
                'validate_callback' => function ($value) {
                    return in_array(
                        strtoupper($value),
                        ['ASC', 'DESC'],
                        true
                    );
                },
            ],
        ],
    ]);
});


/**
 * Get Properties
 */
function day34_get_properties(WP_REST_Request $request)
{
    /*
     * ------------------------------------------------
     * 1. Get Query Parameters
     * ------------------------------------------------
     */

    $page = absint($request->get_param('page'));

    if ($page < 1) {
        $page = 1;
    }

    $per_page = absint($request->get_param('per_page'));

    if ($per_page < 1) {
        $per_page = 10;
    }

    // Maximum API page size
    $per_page = min($per_page, 50);

    $search = $request->get_param('search');
    $city = $request->get_param('city');
    $property_type = $request->get_param('property_type');

    $orderby = $request->get_param('orderby');

    if (!in_array(
        $orderby,
        ['date', 'title', 'modified'],
        true
    )) {
        $orderby = 'date';
    }

    $order = strtoupper($request->get_param('order'));

    if (!in_array($order, ['ASC', 'DESC'], true)) {
        $order = 'DESC';
    }


    /*
     * ------------------------------------------------
     * 2. Build WP_Query Arguments
     * ------------------------------------------------
     */

    $query_args = [
        'post_type'      => 'property',
        'post_status'    => 'publish',
        'posts_per_page' => $per_page,
        'paged'          => $page,
        'orderby'        => $orderby,
        'order'          => $order,
    ];


    /*
     * ------------------------------------------------
     * 3. Search
     * ------------------------------------------------
     */

    if (!empty($search)) {
        $query_args['s'] = sanitize_text_field($search);
    }


    /*
     * ------------------------------------------------
     * 4. Build Meta Query
     * ------------------------------------------------
     */

    $meta_query = [];


    /*
     * Filter by City
     */

    if (!empty($city)) {

        $meta_query[] = [
            'key'     => '_city',
            'value'   => sanitize_text_field($city),
            'compare' => '=',
        ];
    }


    /*
     * Filter by Property Type
     */

    if (!empty($property_type)) {

        $meta_query[] = [
            'key'     => '_property_type',
            'value'   => sanitize_text_field($property_type),
            'compare' => '=',
        ];
    }


    /*
     * Add Meta Query only when needed
     */

    if (!empty($meta_query)) {

        $query_args['meta_query'] = $meta_query;
    }


    /*
     * ------------------------------------------------
     * 5. Execute Query
     * ------------------------------------------------
     */

    $query = new WP_Query($query_args);


    /*
     * ------------------------------------------------
     * 6. Build API Response
     * ------------------------------------------------
     */

    $properties = [];


    if ($query->have_posts()) {

        while ($query->have_posts()) {

            $query->the_post();

            $property_id = get_the_ID();

            $properties[] = [
                'id' => $property_id,

                'title' => get_the_title(),

                'content' => get_the_content(),

                'city' => get_post_meta(
                    $property_id,
                    '_city',
                    true
                ),

                'property_type' => get_post_meta(
                    $property_id,
                    '_property_type',
                    true
                ),

                'price' => get_post_meta(
                    $property_id,
                    '_price',
                    true
                ),

                'bedrooms' => get_post_meta(
                    $property_id,
                    '_bedrooms',
                    true
                ),

                'date' => get_the_date(
                    'c'
                ),
            ];
        }

        wp_reset_postdata();
    }


    /*
     * ------------------------------------------------
     * 7. Pagination Metadata
     * ------------------------------------------------
     */

    $total_items = (int) $query->found_posts;

    $total_pages = (int) $query->max_num_pages;


    /*
     * ------------------------------------------------
     * 8. Return Structured Response
     * ------------------------------------------------
     */

    return new WP_REST_Response(
        [
            'data' => $properties,

            'meta' => [
                'page'        => $page,
                'per_page'    => $per_page,
                'total_items' => $total_items,
                'total_pages' => $total_pages,
            ],

            'filters' => [
                'search'        => $search,
                'city'          => $city,
                'property_type' => $property_type,
                'orderby'       => $orderby,
                'order'         => $order,
            ],
        ],
        200
    );
}