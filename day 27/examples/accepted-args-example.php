<?php

function day27_accepted_arguments(
    $title,
    $post_id
) {

    error_log(
        'Title: ' . $title
    );

    error_log(
        'Post ID: ' . $post_id
    );

    return $title;
}


add_filter(
    'the_title',
    'day27_accepted_arguments',
    10,
    2
);