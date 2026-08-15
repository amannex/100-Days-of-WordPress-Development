# Day 21 — Gutenberg Block Development

## Topics Learned

- Gutenberg Editor
- Blocks
- block.json
- register_block_type()
- Static Blocks
- Dynamic Blocks
- Block Attributes
- render_callback

## What is Gutenberg?

Gutenberg is WordPress's block editor.

Everything in the editor is a block.

Examples:

- Paragraph
- Heading
- Gallery
- Image
- Button

## Static Blocks

Store HTML directly inside the post.

Examples:

- Paragraph
- Heading
- Image

## Dynamic Blocks

Generated every page load.

Examples:

- Latest Posts
- Latest Comments
- WooCommerce Products

## block.json

Defines:

- Name
- Category
- Icon
- Supports
- Assets

## Registering Blocks

Use:

register_block_type()

## Block Attributes

Blocks store data using attributes.

Example:

Price

City

Bedrooms

## Key Learnings

- Gutenberg replaces the classic editor.
- Blocks are reusable content components.
- block.json is the configuration file.
- Dynamic blocks generate content on every request.
- Static blocks save HTML inside posts.