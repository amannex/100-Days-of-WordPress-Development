<?php
/**
 * Day 27 — WordPress Hooks
 *
 * Actions
 * Filters
 * Priority
 * Accepted Arguments
 * Custom Hooks
 */


/**
 * ACTION EXAMPLE
 *
 * Add a message to the footer.
 */
function day27_footer_message() {

    echo '<p class="day27-message">';
    echo 'Built with WordPress';
    echo '</p>';

}

add_action(
    'wp_footer',
    'day27_footer_message'
);


/**
 * FILTER EXAMPLE
 *
 * Modify property titles.
 */
function day27_property_title(
    $title,
    $post_id
) {

    if (
        get_post_type(
            $post_id
        ) !== 'property'
    ) {

        return $title;
    }

    return '🏠 ' . $title;
}

add_filter(
    'the_title',
    'day27_property_title',
    10,
    2
);


/**
 * FILTER EXAMPLE
 *
 * Add property price after content.
 */
function day27_property_details(
    $content
) {

    if (
        ! is_singular('property')
    ) {

        return $content;
    }


    $price = get_post_meta(
        get_the_ID(),
        '_property_price',
        true
    );


    if ( ! $price ) {

        return $content;
    }


    $formatted_price =
        number_format_i18n(
            $price
        );


    $details = sprintf(
        '<p><strong>Monthly Rent:</strong> ₹%s</p>',
        esc_html(
            $formatted_price
        )
    );


    return $content . $details;
}

add_filter(
    'the_content',
    'day27_property_details'
);


/**
 * PRIORITY EXAMPLE
 */
function day27_first_message() {

    error_log(
        'First function'
    );
}


function day27_second_message() {

    error_log(
        'Second function'
    );
}


add_action(
    'init',
    'day27_first_message',
    5
);


add_action(
    'init',
    'day27_second_message',
    20
);


/**
 * CUSTOM ACTION
 */
function day27_trigger_property_action(
    $post_id
) {

    do_action(
        'day27_property_created',
        $post_id
    );
}


/**
 * Listen to custom action.
 */
function day27_property_created_handler(
    $post_id
) {

    error_log(
        'Property created: ' . $post_id
    );
}

add_action(
    'day27_property_created',
    'day27_property_created_handler',
    10,
    1
);


/**
 * CUSTOM FILTER
 */
function day27_property_name() {

    $name = apply_filters(
        'day27_property_name',
        'Luxury Villa'
    );

    return $name;
}


/**
 * Modify custom filter.
 */
function day27_change_property_name(
    $name
) {

    return 'Featured ' . $name;
}

add_filter(
    'day27_property_name',
    'day27_change_property_name'
);