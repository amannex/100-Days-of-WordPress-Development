# Day 32 — WordPress REST API: Update

## Today's Goal

Learn how to update an existing
WordPress property through a REST API.

---

## CRUD

CRUD means:

Create
Read
Update
Delete

REST API mapping:

POST → Create
GET → Read
PUT/PATCH → Update
DELETE → Delete

---

# Update Endpoint

Endpoint:

PUT /wp-json/day32/v1/properties/{id}

Example:

PUT /wp-json/day32/v1/properties/104

The `104` is the property ID.

---

# Route Parameter

The route:

/properties/(?P<id>\d+)

captures the property ID.

Example:

/properties/104

becomes:

id = 104

---

# WP_REST_Request

The incoming request can be accessed
using WP_REST_Request.

Example:

function day32_update_property(
    WP_REST_Request $request
) {

}

---

# Getting URL Parameters

Use:

$request->get_param('id');

Example:

$property_id = absint(
    $request->get_param('id')
);

---

# Getting JSON

Use:

$data = $request->get_json_params();

Example:

{
    "price": 22000
}

---

# wp_update_post()

Used to update an existing
WordPress post.

Example:

wp_update_post(
    array(
        'ID' => $property_id,
        'post_title' => $title,
    )
);

---

# wp_insert_post vs wp_update_post

wp_insert_post():

Creates a post.

wp_update_post():

Updates an existing post.

---

# Updating Post Meta

Use:

update_post_meta(
    $property_id,
    '_property_price',
    $price
);

---

# Partial Updates

A client may send:

{
    "price": 25000
}

Only the price should change.

Use:

if ( isset( $data['price'] ) ) {

    // Update price.
}

This prevents unrelated fields
from being overwritten.

---

# Checking Resource Existence

Use:

$property = get_post(
    $property_id
);

If it doesn't exist:

return new WP_Error(
    'property_not_found',
    'Property not found.',
    array(
        'status' => 404,
    )
);

---

# HTTP Status Codes

200:

Successful update.

400:

Bad request.

403:

Forbidden.

404:

Resource not found.

---

# Post Type Validation

Always make sure the requested
resource is actually a property.

Example:

if (
    $property->post_type !== 'property'
) {

    return new WP_Error(
        'invalid_property',
        'Not a property.',
        array(
            'status' => 400,
        )
    );
}

---

# PUT vs PATCH

PUT:

Generally used for replacing or
updating a resource.

PATCH:

Generally used for partial updates.

Example PATCH:

{
    "price": 25000
}

Only price changes.

---

# Permission

The endpoint should be protected.

Example:

'permission_callback' => function () {

    return current_user_can(
        'edit_posts'
    );
}

---

# Object-Level Authorization

A future improvement:

Check whether the current user
is actually allowed to modify
the specific property.

Example:

User A owns property 104.

User B should not automatically
be able to update property 104.

---

# API Flow

PUT request
    ↓
Extract property ID
    ↓
Find property
    ↓
Check existence
    ↓
Check post type
    ↓
Get JSON
    ↓
Validate
    ↓
Sanitize
    ↓
Update post
    ↓
Update metadata
    ↓
Return 200

---

# Testing

Test:

1. Valid update
2. Partial update
3. Non-existing property
4. Invalid price
5. Empty title
6. Unauthorized request
7. Verify using GET

---

# Important Functions

wp_insert_post()
→ Create

wp_update_post()
→ Update

get_post()
→ Retrieve post

get_post_meta()
→ Retrieve metadata

update_post_meta()
→ Update metadata

---

# Day 32 Challenge

Add support for:

- Description
- Address
- Bathrooms
- Property type

Then test partial updates.

Example:

{
    "bathrooms": 2
}

Only bathrooms should change.

---

# Interview Questions

## What is PUT?

An HTTP method generally used for
updating/replacing a resource.

## What is PATCH?

An HTTP method generally used for
partial updates.

## What is wp_update_post()?

A WordPress function used to update
an existing post.

## How do you get a route parameter?

Using:

$request->get_param('id');

## Why check whether a post exists?

To avoid updating a resource that
doesn't exist.

## What does 404 mean?

The requested resource was not found.

## Why use isset() during updates?

To update only fields provided
by the client.

## What is object-level authorization?

Checking whether the current user
is allowed to modify the specific
resource being requested.

## Difference between wp_insert_post()
and wp_update_post()?

wp_insert_post() creates a post.

wp_update_post() updates an existing post.