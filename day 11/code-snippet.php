<?php

add_action('rest_api_init', function () {

    register_rest_route(
        'travel/v1',
        '/message',
        array(
            'methods'  => 'GET',
            'callback' => 'travel_message',
            'permission_callback' => '__return_true',
        )
    );

});

function travel_message() {

    return array(
        'message' => 'Welcome to Traverse Travel!'
    );

}