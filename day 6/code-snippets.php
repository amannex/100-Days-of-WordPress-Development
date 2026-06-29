<?php

function aman_register_tour_taxonomy() {

    register_taxonomy(
        'tour_type',
        'tour',
        array(
            'label'        => 'Tour Types',
            'public'       => true,
            'hierarchical' => true
        )
    );

}

add_action(
    'init',
    'aman_register_tour_taxonomy'
);