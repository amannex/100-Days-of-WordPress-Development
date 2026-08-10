# Day 18 — WordPress Cron

## Topics Learned

- WP-Cron
- wp_schedule_event()
- wp_schedule_single_event()
- wp_next_scheduled()
- wp_unschedule_event()
- Custom Cron Intervals
- Scheduled Background Tasks

## What is WP-Cron?

WP-Cron is WordPress's scheduling system.

Unlike Linux Cron, it runs when someone visits the website.

## Scheduling Events

Recurring:

wp_schedule_event()

One-Time:

wp_schedule_single_event()

## Prevent Duplicate Events

Use:

wp_next_scheduled()

before scheduling.

## Removing Events

Use:

wp_unschedule_event()

during plugin deactivation.

## Custom Schedules

Use the

cron_schedules

filter to create custom intervals.

## Common Uses

- Backup plugins
- Email reminders
- Subscription renewals
- Cleanup tasks
- Cache clearing
- Sitemap generation
- Expired listings

## Key Learnings

- WP-Cron automates background tasks.
- Schedule events only once.
- Always remove events on plugin deactivation.
- Custom intervals can be created.
- Cron callbacks are attached to action hooks.