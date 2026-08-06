<?php
/**
 * Day 15 - WordPress Post Meta & Metadata API
 *
 * Topics:
 * - Custom Post Type
 * - Custom Meta Box
 * - Nonce Security
 * - Saving Post Meta
 * - Retrieving Post Meta
 * - Meta Query
 */


/**
 * 1. Register Property Custom Post Type
 */
function day15_register_property_cpt() {

    register_post_type(
        'property',
        array(
            'labels' => array(
                'name'          => 'Properties',
                'singular_name' => 'Property',
                'add_new_item'  => 'Add New Property',
                'edit_item'     => 'Edit Property',
            ),

            'public'       => true,
            'has_archive'  => true,
            'show_in_rest' => true,

            'supports' => array(
                'title',
                'editor',
                'thumbnail'
            ),
        )
    );
}

add_action( 'init', 'day15_register_property_cpt' );


/**
 * 2. Add Property Details Meta Box
 */
function day15_add_property_meta_box() {

    add_meta_box(
        'property_details',
        'Property Details',
        'day15_property_meta_box_callback',
        'property',
        'normal',
        'default'
    );
}

add_action(
    'add_meta_boxes',
    'day15_add_property_meta_box'
);


/**
 * 3. Display Meta Box Fields
 */
function day15_property_meta_box_callback( $post ) {

    $rent = get_post_meta(
        $post->ID,
        'property_rent',
        true
    );

    $bedrooms = get_post_meta(
        $post->ID,
        'property_bedrooms',
        true
    );

    $city = get_post_meta(
        $post->ID,
        'property_city',
        true
    );

    // Security nonce.
    wp_nonce_field(
        'day15_save_property_details',
        'day15_property_nonce'
    );

    ?>

    <p>
        <label for="property_rent">
            Monthly Rent
        </label>

        <br>

        <input
            type="number"
            id="property_rent"
            name="property_rent"
            value="<?php echo esc_attr( $rent ); ?>"
        >
    </p>


    <p>
        <label for="property_bedrooms">
            Bedrooms
        </label>

        <br>

        <input
            type="number"
            id="property_bedrooms"
            name="property_bedrooms"
            value="<?php echo esc_attr( $bedrooms ); ?>"
        >
    </p>


    <p>
        <label for="property_city">
            City
        </label>

        <br>

        <input
            type="text"
            id="property_city"
            name="property_city"
            value="<?php echo esc_attr( $city ); ?>"
        >
    </p>

    <?php
}


/**
 * 4. Save Property Metadata
 */
function day15_save_property_meta( $post_id ) {

    // Check nonce exists.
    if ( ! isset( $_POST['day15_property_nonce'] ) ) {
        return;
    }

    // Verify nonce.
    if (
        ! wp_verify_nonce(
            sanitize_text_field(
                wp_unslash( $_POST['day15_property_nonce'] )
            ),
            'day15_save_property_details'
        )
    ) {
        return;
    }

    // Prevent autosave processing.
    if (
        defined( 'DOING_AUTOSAVE' )
        && DOING_AUTOSAVE
    ) {
        return;
    }

    // Check user permission.
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }


    /*
     * Save Rent
     */
    if ( isset( $_POST['property_rent'] ) ) {

        $rent = absint(
            $_POST['property_rent']
        );

        update_post_meta(
            $post_id,
            'property_rent',
            $rent
        );
    }


    /*
     * Save Bedrooms
     */
    if ( isset( $_POST['property_bedrooms'] ) ) {

        $bedrooms = absint(
            $_POST['property_bedrooms']
        );

        update_post_meta(
            $post_id,
            'property_bedrooms',
            $bedrooms
        );
    }


    /*
     * Save City
     */
    if ( isset( $_POST['property_city'] ) ) {

        $city = sanitize_text_field(
            wp_unslash( $_POST['property_city'] )
        );

        update_post_meta(
            $post_id,
            'property_city',
            $city
        );
    }
}

add_action(
    'save_post_property',
    'day15_save_property_meta'
);


/**
 * 5. Example: Retrieve Property Metadata
 */

$property_id = 10; // Example post ID.

$rent = get_post_meta(
    $property_id,
    'property_rent',
    true
);

$bedrooms = get_post_meta(
    $property_id,
    'property_bedrooms',
    true
);

$city = get_post_meta(
    $property_id,
    'property_city',
    true
);


/**
 * 6. Example Meta Query
 *
 * Get properties with rent <= 20,000.
 */

$property_query = new WP_Query(
    array(
        'post_type'      => 'property',
        'posts_per_page' => 10,

        'meta_query' => array(
            array(
                'key'     => 'property_rent',
                'value'   => 20000,
                'compare' => '<=',
                'type'    => 'NUMERIC',
            ),
        ),
    )
);


/**
 * 7. Display Query Results
 */

if ( $property_query->have_posts() ) {

    while ( $property_query->have_posts() ) {

        $property_query->the_post();

        $rent = get_post_meta(
            get_the_ID(),
            'property_rent',
            true
        );

        $city = get_post_meta(
            get_the_ID(),
            'property_city',
            true
        );

        echo '<h2>';
        echo esc_html( get_the_title() );
        echo '</h2>';

        echo '<p>Rent: ₹';
        echo esc_html( $rent );
        echo '</p>';

        echo '<p>City: ';
        echo esc_html( $city );
        echo '</p>';
    }
}

wp_reset_postdata();