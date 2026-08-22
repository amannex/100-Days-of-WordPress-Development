<?php

/**
 * Custom Action
 */

do_action(
    'day27_custom_action',
    123
);


function day27_custom_action_handler(
    $value
) {

    error_log(
        'Custom action value: ' . $value
    );
}


add_action(
    'day27_custom_action',
    'day27_custom_action_handler',
    10,
    1
);


/**
 * Custom Filter
 */

$value = apply_filters(
    'day27_custom_filter',
    'Hello'
);


function day27_custom_filter_handler(
    $value
) {

    return $value . ' WordPress';
}


add_filter(
    'day27_custom_filter',
    'day27_custom_filter_handler'
);