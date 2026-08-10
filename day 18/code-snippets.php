<?php
/**
 * Day 18 — WordPress Cron
 *
 * Topics:
 * - Schedule events
 * - Custom intervals
 * - Cleanup
 * - One-time events
 */


/**
 * 1. Add Custom Cron Interval
 */
function day18_custom_schedule( $schedules ) {

    $schedules['every_30_minutes'] = array(
        'interval' => 1800,
        'display'  => 'Every 30 Minutes'
    );

    return $schedules;
}

add_filter(
    'cron_schedules',
    'day18_custom_schedule'
);


/**
 * 2. Schedule Event
 */
function day18_schedule_event() {

    if ( ! wp_next_scheduled( 'day18_cleanup' ) ) {

        wp_schedule_event(
            time(),
            'every_30_minutes',
            'day18_cleanup'
        );
    }
}

register_activation_hook(
    __FILE__,
    'day18_schedule_event'
);


/**
 * 3. Cron Callback
 */
function day18_cleanup_callback() {

    error_log(
        'Running scheduled cleanup...'
    );

    // Example:
    // Delete expired bookings
    // Remove temporary data
    // Send emails
}

add_action(
    'day18_cleanup',
    'day18_cleanup_callback'
);


/**
 * 4. One-Time Event
 */
function day18_schedule_single_event() {

    wp_schedule_single_event(
        time() + 60,
        'day18_send_notification'
    );
}

add_action(
    'init',
    'day18_schedule_single_event'
);


function day18_send_notification() {

    error_log(
        'One-time notification executed.'
    );
}

add_action(
    'day18_send_notification',
    'day18_send_notification'
);


/**
 * 5. Remove Scheduled Event
 */
function day18_remove_event() {

    $timestamp = wp_next_scheduled(
        'day18_cleanup'
    );

    if ( $timestamp ) {

        wp_unschedule_event(
            $timestamp,
            'day18_cleanup'
        );
    }
}

register_deactivation_hook(
    __FILE__,
    'day18_remove_event'
);