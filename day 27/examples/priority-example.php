<?php

function day27_priority_low() {

    error_log(
        'Priority 5'
    );
}

function day27_priority_high() {

    error_log(
        'Priority 20'
    );
}


add_action(
    'init',
    'day27_priority_low',
    5
);


add_action(
    'init',
    'day27_priority_high',
    20
);