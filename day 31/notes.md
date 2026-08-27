# Day 31 — WordPress REST API: POST

## Topics Learned

- POST requests
- Creating REST API endpoints
- WP_REST_Server::CREATABLE
- WP_REST_Request
- get_json_params()
- Permission callbacks
- current_user_can()
- Input validation
- Input sanitization
- wp_insert_post()
- update_post_meta()
- WP_Error
- HTTP 201 Created
- REST API authentication concepts

---

# GET vs POST

GET:

Used to retrieve data.

POST:

Used to create data.

Example:

GET /properties

POST /properties

---

# POST Endpoint

Created:

POST /wp-json/day31/v1/properties

Purpose:

Create a new Property.

---

# CREATABLE

WordPress provides:

WP_REST_Server::CREATABLE

for REST requests that create resources.

It represents:

POST

---

# WP_REST_Request

Represents the incoming REST API request.

Example:

function callback(
    WP_REST_Request $request
) {

}

---

# Get JSON Body

Use:

$data = $request->get_json_params();

Example request:

{
    "title": "2BHK Apartment",
    "city": "Noida",
    "price": 18000,
    "bedrooms": 2
}

---

# Sanitization

Sanitization cleans incoming data.

Example:

$title = sanitize_text_field(
    $title
);

For integers:

$price = absint(
    $price
);

---

# Validation

Validation checks whether data
meets business rules.

Example:

if ( $price <= 0 ) {

    return new WP_Error(
        'invalid_price',
        'Price must be greater than zero.',
        array(
            'status' => 400,
        )
    );
}

---

# Sanitization vs Validation

Sanitization:

Clean the data.

Validation:

Check whether the data is acceptable.

Both are important.

---

# Permission Callback

Protected endpoints should use
a permission callback.

Example:

'permission_callback' => function () {

    return current_user_can(
        'edit_posts'
    );
}

---

# Why Permissions Matter

Without permission checks,
an unauthorized user could potentially
create content.

Flow:

Request
    ↓
Permission Check
    ↓
Allowed?
    ├── No → 403
    └── Yes → Continue

---

# wp_insert_post()

Creates a WordPress post.

Example:

$post_id = wp_insert_post(
    array(
        'post_title'  => $title,
        'post_type'   => 'property',
        'post_status' => 'publish',
    ),
    true
);

---

# Checking wp_insert_post()

The second argument can make
WordPress return WP_Error on failure.

Example:

if (
    is_wp_error(
        $post_id
    )
) {

    return $post_id;
}

---

# Post Metadata

Property-specific data can be stored
using post meta.

Example:

update_post_meta(
    $post_id,
    '_property_city',
    $city
);

---

# HTTP 201

201 means:

Created.

It is appropriate when a POST request
successfully creates a new resource.

Example:

return new WP_REST_Response(
    $data,
    201
);

---

# Error Codes

400:

Bad Request.

403:

Forbidden.

404:

Not Found.

500:

Server Error.

---

# API Flow

Client
    ↓
POST request
    ↓
REST route
    ↓
Permission check
    ↓
Read JSON
    ↓
Validate
    ↓
Sanitize
    ↓
wp_insert_post()
    ↓
update_post_meta()
    ↓
201 Created

---

# Property API

Created:

POST /wp-json/day31/v1/properties

Input:

{
    "title": "Beautiful 2BHK",
    "city": "Noida",
    "price": 18000,
    "bedrooms": 2
}

Response:

{
    "success": true,
    "data": {
        "id": 104,
        "title": "Beautiful 2BHK",
        "city": "Noida",
        "price": 18000,
        "bedrooms": 2
    }
}

---

# Testing

Test:

1. Valid property
2. Missing title
3. Missing city
4. Invalid price
5. Invalid bedrooms
6. Unauthenticated request
7. Verify created property using GET

---

# Day 31 Practice

Create a POST endpoint that supports:

- Title
- Description
- City
- Address
- Price
- Bedrooms
- Bathrooms
- Property type

Validate and sanitize every field.

---

# Interview Questions

## What is POST?

An HTTP method commonly used to
create a new resource.

## What is WP_REST_Server::CREATABLE?

A WordPress REST API constant representing
a creatable request, normally POST.

## What is get_json_params()?

It retrieves JSON data sent in the
REST request body.

## Why validate API input?

To ensure incoming data satisfies
the application's requirements.

## Why sanitize API input?

To clean data before processing or
storing it.

## What does wp_insert_post() do?

Creates a WordPress post and returns
the post ID or an error.

## What is HTTP 201?

It means a resource was successfully
created.

## Why use permission_callback?

To control who is allowed to access
a REST endpoint.

## What is current_user_can()?

It checks whether the current user
has a specific WordPress capability.

## What is WP_Error?

A WordPress object used to represent
an error condition.