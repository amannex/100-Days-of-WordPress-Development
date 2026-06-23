<?php

function aman_theme_assets() {

    wp_enqueue_style(
        'theme-style',
        get_stylesheet_uri()
    );

    wp_enqueue_script(
        'theme-js',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        '1.0',
        true
    );
}

add_action(
    'wp_enqueue_scripts',
    'aman_theme_assets'
);