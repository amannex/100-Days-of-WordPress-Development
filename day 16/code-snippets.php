<?php
/**
 * Day 16 — WordPress AJAX
 *
 * Topics:
 * - Enqueue JavaScript
 * - wp_localize_script()
 * - AJAX actions
 * - Nonces
 * - WP_Query
 * - JSON responses
 */


/**
 * 1. Enqueue AJAX JavaScript
 */
function day16_enqueue_scripts() {

    wp_enqueue_script(
        'day16-ajax',
        plugin_dir_url( __FILE__ ) . 'ajax.js',
        array(),
        '1.0.0',
        true
    );


    /**
     * Pass PHP data to JavaScript.
     */
    wp_localize_script(
        'day16-ajax',
        'day16_ajax',
        array(

            'ajax_url' => admin_url(
                'admin-ajax.php'
            ),

            'nonce' => wp_create_nonce(
                'day16_nonce'
            )

        )
    );
}

add_action(
    'wp_enqueue_scripts',
    'day16_enqueue_scripts'
);


/**
 * 2. AJAX Callback
 */
function day16_load_posts() {

    /**
     * Verify AJAX nonce.
     */
    check_ajax_referer(
        'day16_nonce',
        'nonce'
    );


    /**
     * Query latest posts.
     */
    $query = new WP_Query(
        array(
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => 3
        )
    );


    $posts = array();


    /**
     * Build response.
     */
    while ( $query->have_posts() ) {

        $query->the_post();

        $posts[] = array(

            'id' => get_the_ID(),

            'title' => get_the_title(),

            'url' => get_permalink()

        );
    }


    wp_reset_postdata();


    /**
     * Return JSON.
     */
    wp_send_json_success(
        $posts
    );
}


/**
 * 3. Logged-in AJAX action
 */
add_action(
    'wp_ajax_day16_load_posts',
    'day16_load_posts'
);


/**
 * 4. Logged-out AJAX action
 */
add_action(
    'wp_ajax_nopriv_day16_load_posts',
    'day16_load_posts'
);