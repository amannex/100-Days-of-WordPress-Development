<?php
/**
 * Day 21 — Gutenberg Block Development
 */


/**
 * 1. Register Block
 */
function day21_register_blocks() {

    register_block_type(

        __DIR__ . '/build/property-card'

    );

}

add_action(

    'init',

    'day21_register_blocks'

);


/**
 * 2. Dynamic Block
 */
function day21_render_property_card(

    $attributes

) {

    $price = isset(

        $attributes['price']

    ) ? $attributes['price'] : '';



    $city = isset(

        $attributes['city']

    ) ? $attributes['city'] : '';



    $bedrooms = isset(

        $attributes['bedrooms']

    ) ? $attributes['bedrooms'] : '';



    ob_start();

    ?>

    <div class="property-card">

        <h2>

            <?php echo esc_html(

                $city

            ); ?>

        </h2>

        <p>

            Price:
            ₹<?php echo esc_html(

                $price

            ); ?>

        </p>

        <p>

            Bedrooms:
            <?php echo esc_html(

                $bedrooms

            ); ?>

        </p>

    </div>

    <?php

    return ob_get_clean();

}


/**
 * 3. Example block.json
 *
 * {
 *   "apiVersion":3,
 *   "name":"travel/property-card",
 *   "title":"Property Card",
 *   "category":"widgets",
 *   "icon":"admin-home",
 *   "supports":{
 *       "html":false
 *   }
 * }
 */