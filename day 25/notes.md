# Day 25 — Dynamic Property Card + Custom Post Type

## Topics Learned

- Custom Post Types
- register_post_type()
- show_in_rest
- Custom Meta Boxes
- Post Meta
- get_post_meta()
- update_post_meta()
- WP_Query
- Dynamic Gutenberg Blocks
- render.php
- Featured Images
- Server-side rendering
- get_block_wrapper_attributes()
- wp_reset_postdata()

---

## Custom Post Type

A Custom Post Type allows WordPress to store
content types other than normal Posts and Pages.

Example:

Property

Other examples:

- Products
- Events
- Courses
- Team Members
- Jobs
- Testimonials

---

## register_post_type()

Custom Post Types are registered using:

register_post_type()

Example:

register_post_type(
    'property',
    array(
        'public' => true
    )
);

---

## show_in_rest

Setting:

show_in_rest => true

makes the Custom Post Type available through
the WordPress REST API.

Example:

/wp-json/wp/v2/property

---

## Post Meta

WordPress can store additional information
against a post.

Example:

_property_city

_property_price

_property_bedrooms

Functions:

get_post_meta()

update_post_meta()

---

## WP_Query

WP_Query retrieves posts or Custom Post Types
from the WordPress database.

Example:

$query = new WP_Query(
    array(
        'post_type' => 'property'
    )
);

---

## Featured Image

A Custom Post Type must support:

thumbnail

to use WordPress Featured Images.

Example:

'supports' => array(
    'title',
    'editor',
    'thumbnail'
)

---

## Dynamic Gutenberg Block

The Property List block doesn't store the
property HTML in the page.

Instead:

Page loads

↓

render.php

↓

WP_Query

↓

Property data

↓

HTML

---

## render.php

render.php generates the frontend output
of a dynamic Gutenberg block.

---

## wp_reset_postdata()

After using a custom WP_Query loop,
use:

wp_reset_postdata();

This restores the original global
WordPress post data.

---

## Output Escaping

esc_html()

For text.

esc_url()

For URLs.

esc_attr()

For HTML attributes.

---

## Project Flow

Property CPT

↓

Property Data

↓

Featured Image

↓

Custom Fields

↓

WP_Query

↓

Dynamic Gutenberg Block

↓

Property Cards

---

## Real-World Applications

The same architecture can be used for:

- Property websites
- Job portals
- Course websites
- Event websites
- Product catalogs
- Restaurant listings
- Team directories

---

## Key Learnings

Today I connected multiple WordPress
development concepts into one project.

I learned how to:

1. Create a Custom Post Type.
2. Add custom fields.
3. Store post metadata.
4. Query custom content.
5. Build a dynamic Gutenberg block.
6. Retrieve featured images.
7. Render dynamic content using PHP.
8. Create reusable property cards.

---

## Next Steps

Learn:

- WordPress Security
- Nonces
- Capability checks
- Sanitization
- Validation
- Secure form processing