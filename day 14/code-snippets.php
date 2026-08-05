<?php

global $wpdb;

// Get total posts
$post_count = $wpdb->get_var(
    "SELECT COUNT(*) FROM {$wpdb->posts}"
);

echo esc_html( $post_count );

// Safe query
$id = 1;

$post = $wpdb->get_row(
    $wpdb->prepare(
        "SELECT * FROM {$wpdb->posts} WHERE ID = %d",
        $id
    )
);

if ( $post ) {
    echo esc_html( $post->post_title );
}