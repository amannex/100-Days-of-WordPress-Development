# Day 24 — Dynamic Gutenberg Blocks

## Topics Learned

- Dynamic Gutenberg Blocks
- render.php
- render callback concept
- WP_Query
- Dynamic block attributes
- get_block_wrapper_attributes()
- save: () => null
- Server-side rendering
- Output escaping

---

## Static vs Dynamic Blocks

### Static Block

The block saves its HTML using save.js.

Flow:

Editor
↓
edit.js
↓
save.js
↓
Saved HTML

---

### Dynamic Block

The block generates HTML using PHP.

Flow:

Editor
↓
Block saved
↓
render.php
↓
WP_Query
↓
WordPress Database
↓
HTML

---

## render.php

render.php contains the PHP responsible for
generating the frontend output of a dynamic block.

Example:

render.php

↓

WP_Query

↓

Database

↓

HTML

---

## save: () => null

Dynamic blocks normally don't need save.js
to generate their frontend HTML.

Instead:

save: () => null

is used.

PHP generates the output.

---

## WP_Query

WP_Query retrieves WordPress content from
the database.

Example:

new WP_Query(
    array(
        'post_type' => 'property'
    )
);

---

## Dynamic Block Attributes

Attributes can control how the dynamic
block behaves.

Example:

numberOfProperties

This allows the editor to choose how many
properties should be displayed.

---

## Output Escaping

Important WordPress escaping functions:

esc_html()
For text.

esc_url()
For URLs.

esc_attr()
For HTML attributes.

---

## get_block_wrapper_attributes()

This function provides the appropriate
wrapper attributes and classes for a block.

Example:

<div <?php echo get_block_wrapper_attributes(); ?>>

---

## Why Dynamic Blocks?

Dynamic blocks are useful when content
changes frequently.

Examples:

- Latest Posts
- Latest Products
- Property Listings
- Event Listings
- Related Posts
- User Information
- WooCommerce Products

---

## Real-World Example

A property website can have a:

Latest Properties

block.

Instead of manually updating the page,
WordPress can query the latest published
properties automatically.

---

## Key Learnings

- Dynamic blocks render on the server.
- render.php can generate frontend HTML.
- WP_Query can retrieve dynamic content.
- save.js is not required for frontend markup.
- Dynamic blocks are useful for database-driven content.
- Output should always be escaped appropriately.

---

## Practice

Build a dynamic block that displays:

- Latest 5 properties
- Property title
- Excerpt
- Permalink

---

## Next Step

Learn:

- Dynamic block attributes
- render_callback
- Block editor controls
- Custom post type integration
- REST API + Gutenberg