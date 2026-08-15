
<?php
/**
 * Day 22 — Gutenberg Block Development Part 2
 *
 * Register the custom Property Card block.
 */


/**
 * Register Block
 */
function day22_register_block() {

    register_block_type(
        __DIR__
    );

}

add_action(
    'init',
    'day22_register_block'
);