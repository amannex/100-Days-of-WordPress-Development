# Day 19 — WordPress Transients API

## Topics Learned

- Caching
- Transients API
- set_transient()
- get_transient()
- delete_transient()
- Site Transients
- Cache Expiration

## What is a Transient?

A transient is temporary cached data stored by WordPress.

Unlike options, transients automatically expire.

## Functions

Store:

set_transient()

Retrieve:

get_transient()

Delete:

delete_transient()

## Cache Miss

get_transient() returns false if:

- Cache expired
- Cache doesn't exist

Always check:

if ( false === $value )

## Site Transients

For multisite installations:

- set_site_transient()
- get_site_transient()
- delete_site_transient()

## Expiration Constants

- MINUTE_IN_SECONDS
- HOUR_IN_SECONDS
- DAY_IN_SECONDS
- WEEK_IN_SECONDS
- MONTH_IN_SECONDS
- YEAR_IN_SECONDS

## Best Uses

- API Responses
- Featured Posts
- Weather Data
- Exchange Rates
- Reports
- Analytics

## Avoid Caching

- User Sessions
- Nonces
- Shopping Carts
- Frequently Changing Data

## Key Learnings

- Transients improve performance.
- Expired transients return false.
- Cached queries reduce database load.
- Delete cache when underlying data changes.