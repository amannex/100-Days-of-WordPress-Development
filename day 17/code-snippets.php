<?php
/**
 * Day 17 — WordPress Roles & Capabilities
 *
 * Topics:
 * - Custom Roles
 * - Custom Capabilities
 * - current_user_can()
 * - CPT capabilities
 */


/**
 * 1. Create Custom Role
 *
 * Run during plugin activation.
 */
function day17_create_roles() {

    add_role(
        'property_owner',
        'Property Owner',
        array(
            'read'         => true,
            'upload_files' => true
        )
    );


    add_role(
        'property_manager',
        'Property Manager',
        array(
            'read'         => true,
            'upload_files' => true
        )
    );


    /**
     * Property Owner
     */
    $owner = get_role(
        'property_owner'
    );

    if ( $owner ) {

        $owner->add_cap(
            'edit_properties'
        );

        $owner->add_cap(
            'publish_properties'
        );
    }


    /**
     * Property Manager
     */
    $manager = get_role(
        'property_manager'
    );

    if ( $manager ) {

        $manager->add_cap(
            'edit_properties'
        );

        $manager->add_cap(
            'publish_properties'
        );

        $manager->add_cap(
            'delete_properties'
        );

        $manager->add_cap(
            'edit_others_properties'
        );
    }
}


register_activation_hook(
    __FILE__,
    'day17_create_roles'
);


/**
 * 2. Register Property CPT
 */
function day17_register_property_cpt() {

    register_post_type(
        'property',
        array(

            'labels' => array(

                'name' =>
                    'Properties',

                'singular_name' =>
                    'Property'

            ),

            'public' =>
                true,

            'show_in_rest' =>
                true,

            'has_archive' =>
                true,


            /**
             * Custom capabilities.
             */
            'capability_type' => array(
                'property',
                'properties'
            ),

            'map_meta_cap' =>
                true,


            'supports' => array(
                'title',
                'editor',
                'thumbnail'
            )

        )
    );
}


add_action(
    'init',
    'day17_register_property_cpt'
);


/**
 * 3. Example Capability Check
 */
function day17_permission_example() {

    if (
        current_user_can(
            'edit_properties'
        )
    ) {

        echo esc_html(
            'You can edit properties.'
        );

    } else {

        echo esc_html(
            'Permission denied.'
        );
    }
}


/**
 * 4. Create Admin Menu
 */
function day17_admin_menu() {

    add_menu_page(

        'Property Management',

        'Properties',

        'edit_properties',

        'property-management',

        'day17_admin_page',

        'dashicons-admin-home',

        25
    );
}


add_action(
    'admin_menu',
    'day17_admin_menu'
);


/**
 * 5. Admin Page
 */
function day17_admin_page() {

    if (
        ! current_user_can(
            'edit_properties'
        )
    ) {

        wp_die(
            esc_html__(
                'You do not have permission.',
                'day17'
            )
        );
    }

    ?>

    <div class="wrap">

        <h1>
            Property Management
        </h1>

        <p>
            Manage your properties here.
        </p>

    </div>

    <?php
}


/**
 * 6. Example AJAX Permission Check
 */
function day17_delete_property() {

    check_ajax_referer(
        'property_nonce',
        'nonce'
    );


    if (
        ! current_user_can(
            'delete_properties'
        )
    ) {

        wp_send_json_error(
            array(
                'message' =>
                    'Permission denied.'
            ),
            403
        );
    }


    wp_send_json_success(
        array(
            'message' =>
                'User has permission.'
        )
    );
}


add_action(
    'wp_ajax_day17_delete_property',
    'day17_delete_property'
);