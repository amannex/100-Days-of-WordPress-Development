<?php
/**
 * Day 23 — Gutenberg Block Development Part 3
 */


/**
 * Register Property Card Block
 */
function day23_register_block() {

    register_block_type(
        __DIR__
    );

}

add_action(
    'init',
    'day23_register_block'
);