<?php
/*
Plugin Name: Travel Tools
Description: Adds travel-related functionality.
Version: 1.0.0
Author: Aman Saifi
*/

function travel_tools_activate() {
    flush_rewrite_rules();
}

register_activation_hook(
    __FILE__,
    'travel_tools_activate'
);

function travel_greeting_shortcode() {
    return '<h2>Welcome to Traverse Travel!</h2>';
}

add_shortcode(
    'travel_greeting',
    'travel_greeting_shortcode'
);