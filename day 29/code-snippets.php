<?php

/**
 * Day 29 — WordPress Admin & Settings API
 */


/**
 * Add admin menu.
 */
add_action(
    'admin_menu',
    'day29_register_admin_menu'
);


function day29_register_admin_menu() {

    add_menu_page(
        'Property Manager',
        'Property Manager',
        'manage_options',
        'day29-settings',
        'day29_settings_page'
    );
}


/**
 * Register setting.
 */
add_action(
    'admin_init',
    'day29_register_settings'
);


function day29_register_settings() {

    register_setting(
        'day29_settings_group',
        'day29_currency',
        array(
            'sanitize_callback' =>
                'sanitize_text_field',
        )
    );
}


/**
 * Get option.
 */
$currency = get_option(
    'day29_currency',
    'INR'
);


/**
 * Update option manually.
 */
update_option(
    'day29_currency',
    'INR'
);


/**
 * Delete option.
 */
delete_option(
    'day29_currency'
);


/**
 * Settings section.
 */
add_settings_section(
    'day29_section',
    'General Settings',
    'day29_section_callback',
    'day29-settings'
);


/**
 * Settings field.
 */
add_settings_field(
    'day29_currency',
    'Currency',
    'day29_currency_callback',
    'day29-settings',
    'day29_section'
);


/**
 * Settings form.
 */
settings_fields(
    'day29_settings_group'
);

do_settings_sections(
    'day29-settings'
);

submit_button();