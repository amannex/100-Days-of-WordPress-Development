<?php
/**
 * Day 26 — WordPress Security
 */


/**
 * Register Property Post Type
 */
function day26_register_property_post_type() {

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
        )
    );
}

add_action(
    'init',
    'day26_register_property_post_type'
);


/**
 * Add Property Meta Box
 */
function day26_add_property_meta_box() {

    add_meta_box(
        'day26_property_details',
        'Property Details',
        'day26_property_meta_box_html',
        'property',
        'normal',
        'high'
    );
}

add_action(
    'add_meta_boxes',
    'day26_add_property_meta_box'
);


/**
 * Display Meta Box
 */
function day26_property_meta_box_html(
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

    /*
     * Security nonce.
     */
    wp_nonce_field(
        'day26_save_property',
        'day26_property_nonce'
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
 * Securely save Property Meta
 */
function day26_save_property_meta(
    $post_id
) {

    /*
     * 1. Check nonce exists.
     */
    if (
        ! isset(
            $_POST['day26_property_nonce']
        )
    ) {
        return;
    }


    /*
     * 2. Verify nonce.
     */
    if (
        ! wp_verify_nonce(
            $_POST['day26_property_nonce'],
            'day26_save_property'
        )
    ) {
        return;
    }


    /*
     * 3. Ignore autosaves.
     */
    if (
        defined('DOING_AUTOSAVE') &&
        DOING_AUTOSAVE
    ) {
        return;
    }


    /*
     * 4. Ignore revisions.
     */
    if (
        wp_is_post_revision(
            $post_id
        )
    ) {
        return;
    }


    /*
     * 5. Check permissions.
     */
    if (
        ! current_user_can(
            'edit_post',
            $post_id
        )
    ) {
        return;
    }


    /*
     * 6. Sanitize city.
     */
    if (
        isset(
            $_POST['property_city']
        )
    ) {

        $city = sanitize_text_field(
            $_POST['property_city']
        );

        update_post_meta(
            $post_id,
            '_property_city',
            $city
        );
    }


    /*
     * 7. Sanitize and validate price.
     */
    if (
        isset(
            $_POST['property_price']
        )
    ) {

        $price = absint(
            $_POST['property_price']
        );

        if (
            $price >= 0 &&
            $price <= 100000000
        ) {

            update_post_meta(
                $post_id,
                '_property_price',
                $price
            );
        }
    }


    /*
     * 8. Sanitize and validate bedrooms.
     */
    if (
        isset(
            $_POST['property_bedrooms']
        )
    ) {

        $bedrooms = absint(
            $_POST['property_bedrooms']
        );

        if (
            $bedrooms >= 1 &&
            $bedrooms <= 20
        ) {

            update_post_meta(
                $post_id,
                '_property_bedrooms',
                $bedrooms
            );
        }
    }
}

add_action(
    'save_post_property',
    'day26_save_property_meta'
);