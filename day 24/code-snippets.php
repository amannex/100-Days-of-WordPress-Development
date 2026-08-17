<?php
/**
 * Day 24 — Dynamic Gutenberg Block
 */


/**
 * Register Dynamic Block
 */
function day24_register_block() {

    register_block_type(
        __DIR__
    );

}

add_action(
    'init',
    'day24_register_block'
);