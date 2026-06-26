<?php

function aman_register_portfolio_cpt() {

    register_post_type(
        'portfolio',
        array(
            'label'       => 'Portfolio',
            'public'      => true,
            'has_archive' => true,
            'menu_icon'   => 'dashicons-portfolio',
            'supports'    => array(
                'title',
                'editor',
                'thumbnail'
            )
        )
    );

}

add_action(
    'init',
    'aman_register_portfolio_cpt'
);