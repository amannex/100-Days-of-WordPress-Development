<?php

function travel_register_settings() {

    register_setting(
        'travel_settings_group',
        'travel_phone'
    );

}

add_action(
    'admin_init',
    'travel_register_settings'
);

$phone = get_option('travel_phone');

echo esc_html($phone);