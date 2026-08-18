<?php
/**
 * Day 25 — Dynamic Property Card
 *
 * Custom Post Type
 * Custom Meta Fields
 * Dynamic Gutenberg Block
 */


/**
 * Register Property Post Type
 */
function day25_register_property_post_type() {

    register_post_type(
        'property',
        array(

            'labels' => array(
                'name'          => 'Properties',
                'singular_name' => 'Property',
            ),

            'public' => true,

            'show_in_rest' => true,

            'menu_icon' =>
                'dashicons-building',

            'supports' => array(
                'title',
                'editor',
                'thumbnail',
            ),

            'has_archive' => true,

            'rewrite' => array(
                'slug' => 'properties',
            ),
        )
    );
}

add_action(
    'init',
    'day25_register_property_post_type'
);


/**
 * Add Property Meta Box
 */
function day25_add_property_meta_box() {

    add_meta_box(
        'property_details',
        'Property Details',
        'day25_property_meta_box_html',
        'property',
        'normal',
        'high'
    );
}

add_action(
    'add_meta_boxes',
    'day25_add_property_meta_box'
);


/**
 * Meta Box HTML
 */
function day25_property_meta_box_html(
    $post
) {

    $city = get_post_meta(
        $post->ID,
        '_property_city',
        true
    );

    $price = get_post_meta(
        $post->ID,
        '_property_price',
        true
    );

    $bedrooms = get_post_meta(
        $post->ID,
        '_property_bedrooms',
        true
    );

    ?>

    <p>

        <label for="property_city">
            City
        </label>

        <input
            type="text"
            id="property_city"
            name="property_city"
            value="<?php echo esc_attr(
                $city
            ); ?>"
            class="widefat"
        >

    </p>


    <p>

        <label for="property_price">
            Monthly Price
        </label>

        <input
            type="number"
            id="property_price"
            name="property_price"
            value="<?php echo esc_attr(
                $price
            ); ?>"
            class="widefat"
        >

    </p>


    <p>

        <label for="property_bedrooms">
            Bedrooms
        </label>

        <input
            type="number"
            id="property_bedrooms"
            name="property_bedrooms"
            value="<?php echo esc_attr(
                $bedrooms
            ); ?>"
            class="widefat"
        >

    </p>

    <?php
}


/**
 * Save Property Meta
 */
function day25_save_property_meta(
    $post_id
) {

    if (
        isset(
            $_POST['property_city']
        )
    ) {

        update_post_meta(
            $post_id,
            '_property_city',
            sanitize_text_field(
                $_POST['property_city']
            )
        );

    }


    if (
        isset(
            $_POST['property_price']
        )
    ) {

        update_post_meta(
            $post_id,
            '_property_price',
            absint(
                $_POST['property_price']
            )
        );

    }


    if (
        isset(
            $_POST['property_bedrooms']
        )
    ) {

        update_post_meta(
            $post_id,
            '_property_bedrooms',
            absint(
                $_POST['property_bedrooms']
            )
        );

    }
}

add_action(
    'save_post_property',
    'day25_save_property_meta'
);


/**
 * Register Gutenberg Block
 */
function day25_register_block() {

    register_block_type(
        __DIR__
    );

}

add_action(
    'init',
    'day25_register_block'
);