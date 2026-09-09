# Day 34 — REST API Quality

## Topic

REST API Pagination, Filtering, Searching, Ordering and Response Design.

---

## Learning Objectives

Today I learned how to improve a WordPress REST API by supporting:

* Pagination
* Query parameters
* Filtering
* Searching
* Ordering
* Input sanitization
* Input validation
* Structured API responses
* Pagination metadata
* `WP_Query` based API queries

---

# 1. Pagination

Pagination divides a large dataset into smaller pages.

Example:

```text
100 properties
10 properties per page

Page 1 → 1–10
Page 2 → 11–20
Page 3 → 21–30
```

WordPress supports pagination through:

```php
'paged' => $page,
'posts_per_page' => $per_page
```

---

# 2. Query Parameters

Query parameters modify an API request.

Example:

```http
/properties?page=2&per_page=10
```

Parameters:

```text
page = 2
per_page = 10
```

Multiple parameters use:

```text
&
```

---

# 3. Filtering

Filtering returns records matching a condition.

Example:

```http
/properties?city=Delhi
```

This can be implemented using `meta_query`.

Example:

```php
'meta_query' => [
    [
        'key'   => '_city',
        'value' => 'Delhi',
    ]
]
```

---

# 4. Searching

WordPress provides the `s` argument for text searching.

Example:

```php
$query_args['s'] = $search;
```

Request:

```http
/properties?search=apartment
```

---

# 5. Ordering

Results can be ordered using:

```php
'orderby' => 'date',
'order'   => 'DESC',
```

Example:

```http
/properties?orderby=date&order=DESC
```

Allowed values should be validated rather than accepting arbitrary input.

---

# 6. Sanitization

Sanitization cleans or normalizes input.

Example:

```php
sanitize_text_field($value);
```

For numeric values:

```php
absint($value);
```

---

# 7. Validation

Validation checks whether input is acceptable.

Example:

```php
return $value >= 1 && $value <= 50;
```

Important distinction:

```text
Sanitize → clean the input

Validate → check whether the input is allowed
```

---

# 8. Pagination Metadata

A good API should provide pagination information.

Example:

```json
{
    "meta": {
        "page": 1,
        "per_page": 10,
        "total_items": 125,
        "total_pages": 13
    }
}
```

This allows the frontend to implement pagination or infinite scrolling.

---

# 9. Structured API Responses

Instead of returning only:

```json
[]
```

the API can return:

```json
{
    "data": [],
    "meta": {},
    "filters": {}
}
```

This creates a clearer API contract for frontend applications.

---

# 10. Property Manager Endpoint

The Day 34 endpoint is:

```http
GET /wp-json/day34/v1/properties
```

Supported parameters:

```text
page
per_page
search
city
property_type
orderby
order
```

Example:

```http
/wp-json/day34/v1/properties?page=2&per_page=10&city=Delhi&property_type=apartment
```

---

# 11. WP_Query

The main query uses:

```php
WP_Query
```

Example:

```php
$query = new WP_Query([
    'post_type'      => 'property',
    'posts_per_page' => $per_page,
    'paged'          => $page,
]);
```

---

# 12. API Design Principle

A production-style API should follow a predictable pipeline:

```text
Request
  ↓
Get parameters
  ↓
Sanitize
  ↓
Validate
  ↓
Build query
  ↓
Execute query
  ↓
Transform data
  ↓
Build response
  ↓
Return REST response
```

---

# 13. Important Security Principle

Never blindly trust client input.

Examples that should be validated:

```text
page
per_page
orderby
order
filters
```

Allowlisting acceptable values is often safer than accepting arbitrary values.

---

# 14. Challenges

## ⭐

Add property status filtering:

```http
?status=available
```

## ⭐⭐

Add minimum and maximum price filters:

```http
?min_price=20000&max_price=50000
```

## ⭐⭐

Add bedroom filtering:

```http
?bedrooms=2
```

## ⭐⭐⭐

Build a complete property search endpoint supporting:

```text
city
property_type
min_price
max_price
bedrooms
page
per_page
orderby
order
```

---

# 15. Key Takeaways

The most important lessons from Day 34 are:

1. Large API collections should be paginated.
2. Query parameters allow clients to control API behavior.
3. Filtering and searching solve different problems.
4. `WP_Query` is powerful for WordPress data retrieval.
5. API input should be sanitized and validated.
6. `orderby` and similar parameters should use allowlists.
7. Pagination metadata helps frontend applications.
8. Structured API responses create better API contracts.
9. Performance should be considered when designing collection endpoints.
10. WordPress-native solutions are useful, but database architecture matters at larger scale.

---

## Day 34 Endpoint

```http
GET /wp-json/day34/v1/properties
```

Example:

```http
GET /wp-json/day34/v1/properties?page=1&per_page=10&city=Delhi&property_type=apartment
```
