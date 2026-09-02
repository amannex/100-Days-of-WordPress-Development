# Day 33 — WordPress REST API: DELETE

## Today's Goal

Learn how to delete an existing
WordPress property through a REST API.

This completes the basic CRUD cycle.

---

# CRUD

CRUD means:

Create
Read
Update
Delete

REST mapping:

POST   → Create
GET    → Read
PUT    → Update
PATCH  → Partial Update
DELETE → Delete

---

# DELETE Endpoint

Endpoint:

DELETE /wp-json/day33/v1/properties/{id}

Example:

DELETE /wp-json/day33/v1/properties/104

The number 104 represents the
property ID.

---

# Registering DELETE Routes

WordPress provides:

WP_REST_Server::DELETABLE

for delete operations.

Example:

'methods' =>
    WP_REST_Server::DELETABLE

---

# Getting the Route Parameter

Use:

$request->get_param('id');

Example:

$property_id = absint(
    $request->get_param('id')
);

---

# Checking Existence

Use:

$property = get_post(
    $property_id
);

If the property doesn't exist:

return new WP_Error(
    'property_not_found',
    'Property not found.',
    array(
        'status' => 404,
    )
);

---

# Checking Post Type

Before deleting, verify that
the resource is actually a property.

Example:

if (
    $property->post_type !== 'property'
) {

    return new WP_Error(
        'invalid_property',
        'The requested resource is not a property.',
        array(
            'status' => 400,
        )
    );
}

---

# Permission

Delete endpoints should be protected.

Example:

'permission_callback' => function () {

    return current_user_can(
        'delete_posts'
    );
}

---

# Authentication vs Authorization

Authentication:

Who are you?

Authorization:

Are you allowed to perform
this operation?

---

# wp_delete_post()

WordPress provides:

wp_delete_post()

to delete a post.

Example:

wp_delete_post(
    $property_id,
    false
);

---

# Trash vs Permanent Delete

false:

Move to Trash when applicable.

true:

Permanently delete.

Example:

wp_delete_post(
    $property_id,
    false
);

This is safer for many CMS workflows.

---

# Soft Delete

Soft deletion means the resource
is moved to Trash instead of being
immediately destroyed.

Flow:

Property
   ↓
Trash
   ↓
Potential recovery

---

# Hard Delete

Hard deletion means permanently
removing the resource.

Flow:

Property
   ↓
Permanent deletion

Use carefully.

---

# Error Status Codes

400:

Bad request.

403:

Forbidden.

404:

Resource not found.

500:

Server error.

---

# DELETE Flow

DELETE request
    ↓
Extract property ID
    ↓
Find property
    ↓
Exists?
    ├── No → 404
    └── Yes
          ↓
     Check post type
          ↓
     Check permission
          ↓
      Delete/Trash
          ↓
       Success?
       ├── No → 500
       └── Yes → 200

---

# Complete CRUD

Day 30:

GET → Read

Day 31:

POST → Create

Day 32:

PUT → Update

Day 33:

DELETE → Delete

The Property API now supports
the basic CRUD operations.

---

# CRUD Example

Create:

POST /properties

Read:

GET /properties

Read one:

GET /properties/104

Update:

PUT /properties/104

Delete:

DELETE /properties/104

---

# Important Functions

wp_insert_post()
→ Create

get_post()
→ Retrieve

wp_update_post()
→ Update

wp_delete_post()
→ Delete

---

# Security

Never blindly expose a destructive
endpoint to anonymous users.

Avoid:

'permission_callback' =>
    '__return_true'

for protected operations.

---

# Object-Level Authorization

A future improvement is checking
whether the current user owns or is
otherwise authorized to modify the
specific property.

Example:

User A owns Property 104.

User B should not automatically
be able to delete Property 104.

---

# Day 33 Practice

Create the DELETE endpoint.

Requirements:

1. Extract property ID.
2. Check existence.
3. Check post type.
4. Check permissions.
5. Move property to Trash.
6. Return success response.
7. Handle errors.

---

# Advanced Challenge

Support:

DELETE /properties/104?force=true

force=false:

Move to Trash.

force=true:

Permanently delete.

Think about authorization before
implementing permanent deletion.

---

# Interview Questions

## What is CRUD?

Create, Read, Update, Delete.

## Which HTTP method is used for deletion?

DELETE.

## What is wp_delete_post()?

A WordPress function used to delete
a post.

## What does the second parameter of
wp_delete_post() control?

It determines whether the post is
permanently deleted rather than moved
to Trash.

## What is HTTP 404?

The requested resource was not found.

## What is HTTP 403?

The request is understood but the
current user is not permitted to
perform the operation.

## Why protect DELETE endpoints?

Because deletion is a destructive
operation and can cause data loss.

## Authentication vs Authorization?

Authentication identifies the user.

Authorization determines what the
user is allowed to do.

## What is object-level authorization?

Checking whether the user is allowed
to perform an operation on a specific
resource.

Example:

Can this user delete Property 104?

---

# Day 33 Milestone

You have now built the basic REST
CRUD lifecycle:

POST
  ↓
Create property

GET
  ↓
Read property

PUT
  ↓
Update property

DELETE
  ↓
Delete property