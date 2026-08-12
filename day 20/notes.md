# Day 20 — WordPress REST API Authentication

## Topics Learned

- REST Routes
- register_rest_route()
- Namespaces
- HTTP Methods
- permission_callback
- WP_REST_Request
- JSON Responses
- WP_Error

## REST API Flow

Client

↓

REST Endpoint

↓

Permission Check

↓

Callback

↓

JSON Response

## HTTP Methods

GET

Read data

POST

Create

PUT

Update

DELETE

Delete

## Security

permission_callback()

should always protect sensitive endpoints.

Never expose admin functionality publicly.

## Request Object

Use:

WP_REST_Request

Read values:

$request->get_param()

## Response

Use:

rest_ensure_response()

Return errors with:

WP_Error

## Key Learnings

- REST APIs expose WordPress functionality.
- Custom endpoints use namespaces.
- HTTP methods determine CRUD operations.
- Permission callbacks secure endpoints.
- JSON is returned to the client.