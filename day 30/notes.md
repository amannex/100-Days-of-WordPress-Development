# Day 30 — WordPress REST API

## Topics Learned

- REST API
- REST endpoint
- API route
- Namespace
- API versioning
- HTTP methods
- register_rest_route()
- WP_REST_Request
- WP_REST_Response
- rest_ensure_response()
- WP_Error
- permission_callback
- REST API parameters
- Custom Property API
- Querying WordPress data
- Returning JSON

---

# What Is an API?

An API allows different software systems
to communicate with each other.

Example:

React frontend
    ↓
REST API
    ↓
WordPress
    ↓
Database

---

# What Is REST?

REST is an architectural style commonly
used for web APIs.

Resources can be accessed through URLs.

Example:

/properties

/properties/101

---

# HTTP Methods

GET:

Read data.

POST:

Create data.

PUT/PATCH:

Update data.

DELETE:

Delete data.

---

# WordPress REST API

WordPress includes a built-in REST API.

Example:

/wp-json/wp/v2/posts

Custom Post Types can be exposed using:

show_in_rest => true

---

# REST Namespace

Example:

day30/v1

The namespace helps organize and version
custom API routes.

---

# REST Route

Example:

/properties

Combined with namespace:

/wp-json/day30/v1/properties

---

# register_rest_route()

Registers a custom REST API endpoint.

Example:

register_rest_route(
    'day30/v1',
    '/properties',
    array(
        'methods' =>
            WP_REST_Server::READABLE,

        'callback' =>
            'day30_get_properties',

        'permission_callback' =>
            '__return_true',
    )
);

---

# rest_api_init

Custom REST routes should be registered
using the rest_api_init hook.

Example:

add_action(
    'rest_api_init',
    'register_routes'
);

---

# WP_REST_Request

Represents an incoming REST API request.

Example:

function callback(
    WP_REST_Request $request
) {

    $id = $request->get_param(
        'id'
    );
}

---

# Request Parameters

Example URL:

/properties?city=Noida

Retrieve:

$city = $request->get_param(
    'city'
);

---

# rest_ensure_response()

Ensures data is returned as a REST
response.

Example:

return rest_ensure_response(
    $data
);

---

# WP_REST_Response

Can be used to explicitly create
a REST response.

Example:

return new WP_REST_Response(
    $data,
    200
);

---

# WP_Error

Used for API errors.

Example:

return new WP_Error(
    'not_found',
    'Property not found.',
    array(
        'status' => 404,
    )
);

---

# Permission Callback

REST routes should define a
permission_callback.

Public route:

'permission_callback' =>
    '__return_true'

Protected route:

'permission_callback' => function () {

    return current_user_can(
        'manage_options'
    );
}

---

# HTTP Status Codes

200 = Success

201 = Created

400 = Bad Request

401 = Unauthorized

403 = Forbidden

404 = Not Found

500 = Server Error

---

# Property API

Created:

GET /wp-json/day30/v1/properties

Returns all published properties.

Created:

GET /wp-json/day30/v1/properties/101

Returns one property.

Created:

GET /wp-json/day30/v1/properties?city=Noida

Returns properties filtered by city.

---

# API Response

Example:

{
    "id": 101,
    "title": "Luxury 2BHK",
    "city": "Noida",
    "price": "18000",
    "bedrooms": "2",
    "featured": true,
    "image": "image-url"
}

---

# Headless WordPress

WordPress can act as the backend
while another application provides
the frontend.

Example:

React
    ↓
REST API
    ↓
WordPress
    ↓
MySQL

---

# Day 30 Project

Extended the Property Manager plugin
with a custom REST API.

Endpoints:

GET /wp-json/day30/v1/properties

GET /wp-json/day30/v1/properties/{id}

GET /wp-json/day30/v1/properties?city={city}

---

# Important Security Concepts

Public data can use:

__return_true

Private data should use a
proper permission callback.

Never expose sensitive information
through a public endpoint.

---

# Important Functions

register_rest_route()

WP_REST_Request

WP_REST_Response

rest_ensure_response()

WP_Error

current_user_can()

get_post_meta()

get_posts()

---

# Interview Questions

## What is REST API?

An API architecture that uses
resources and HTTP methods to
communicate between applications.

## What is register_rest_route()?

It registers a custom REST API route
in WordPress.

## What is a namespace?

A namespace organizes API routes and
helps prevent naming conflicts.

## Why use /v1?

It allows API versioning.

Example:

/day30/v1/properties

Later:

/day30/v2/properties

## What is WP_REST_Request?

It represents the incoming REST
API request.

## What is WP_REST_Response?

It represents an explicit REST API
response.

## What is WP_Error?

It represents an error condition.

## Why use permission_callback?

To control who can access an endpoint.

## What is headless WordPress?

WordPress is used primarily as a
backend/content management system,
while another application handles
the frontend.

---

# Day 30 Practice

1. Create the custom REST API.
2. Return all properties.
3. Return one property.
4. Add city filtering.
5. Add property image.
6. Add property price.
7. Add bedroom count.
8. Add featured status.
9. Add a permission callback.
10. Test every endpoint.