<?php
/**
 * Day 19 — WordPress Transients API
 *
 * Topics:
 * - set_transient()
 * - get_transient()
 * - delete_transient()
 * - Cache database queries
 */


/**
 * 1. Store a transient
 */
set_transient(
    'featured_tours',
    array(
        'Goa',
        'Manali',
        'Dubai'
    ),
    HOUR_IN_SECONDS
);


/**
 * 2. Retrieve a transient
 */
$tours = get_transient(
    'featured_tours'
);

if ( false !== $tours ) {

    foreach ( $tours as $tour ) {

        echo esc_html( $tour ) . '<br>';
    }
}


/**
 * 3. Delete a transient
 */
delete_transient(
    'featured_tours'
);


/**
 * 4. Cache a WP_Query
 */
$featured_posts = get_transient(
    'featured_posts'
);

if ( false === $featured_posts ) {

    $query = new WP_Query(
        array(
            'post_type'      => 'post',
            'posts_per_page' => 5
        )
    );

    $featured_posts = $query->posts;

    set_transient(
        'featured_posts',
        $featured_posts,
        HOUR_IN_SECONDS
    );

    wp_reset_postdata();
}


/**
 * 5. Display cached posts
 */
if ( ! empty( $featured_posts ) ) {

    foreach ( $featured_posts as $post ) {

        echo '<h3>';
        echo esc_html( $post->post_title );
        echo '</h3>';
    }
}


/**
 * 6. Site Transient Example
 */
set_site_transient(
    'daily_statistics',
    array(
        'visitors' => 1250,
        'bookings' => 42
    ),
    DAY_IN_SECONDS
);

$stats = get_site_transient(
    'daily_statistics'
);

if ( false !== $stats ) {

    echo esc_html(
        'Visitors: ' . $stats['visitors']
    );
}