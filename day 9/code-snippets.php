<?php

function aman_customize_register($wp_customize) {

    $wp_customize->add_section(
        'footer_settings',
        array(
            'title' => 'Footer Settings'
        )
    );

    $wp_customize->add_setting('footer_text');

    $wp_customize->add_control(
        'footer_text',
        array(
            'label'   => 'Footer Text',
            'section' => 'footer_settings',
            'type'    => 'text'
        )
    );

}

add_action('customize_register', 'aman_customize_register');