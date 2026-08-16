# Day 23 — Gutenberg Block Development Part 3

## Topics Learned

- MediaUpload
- MediaUploadCheck
- InspectorControls
- SelectControl
- URLInput
- InnerBlocks
- InnerBlocks.Content
- Block styling
- Media attributes

---

## MediaUpload

MediaUpload allows a Gutenberg block to select
media from the WordPress Media Library.

Example:

MediaUpload

The selected media can provide:

- ID
- URL
- Alt text
- Width
- Height
- Other attachment information

---

## MediaUploadCheck

MediaUploadCheck helps ensure that the current
user has the required permissions to use the
Media Library.

---

## Storing Media

A block can store information about selected media
using attributes.

Example:

imageId

imageUrl

---

## InspectorControls

InspectorControls adds custom settings to the
Gutenberg editor's sidebar.

Useful components include:

- TextControl
- SelectControl
- ToggleControl
- PanelBody
- URLInput

---

## SelectControl

SelectControl creates dropdown fields.

Example:

Property Type

- Apartment
- Villa
- Studio
- PG

---

## URLInput

URLInput allows editors to enter or select a URL.

It can be used for:

- Buttons
- Links
- External websites
- Internal pages

---

## InnerBlocks

InnerBlocks allows other Gutenberg blocks
to be placed inside a custom block.

Example:

Property Card

├── Paragraph
└── Button

---

## InnerBlocks.Content

InnerBlocks.Content outputs the nested blocks
when the block is saved.

---

## Block Styling

Blocks can have their own CSS.

Example:

style.css

Important considerations:

- Responsive design
- Editor appearance
- Frontend appearance
- Reusable classes

---

## Key Learnings

- MediaUpload connects blocks to the Media Library.
- InspectorControls creates sidebar settings.
- SelectControl creates dropdown settings.
- URLInput handles URLs.
- InnerBlocks makes custom blocks composable.
- Block attributes store configuration and content.
- CSS controls the visual presentation.

---

## Practice Project

Build a Property Card with:

- Property image
- Property title
- City
- Price
- Bedrooms
- Property type
- Description
- Button

---

## Real-World Applications

Custom blocks can be used for:

- Property Cards
- Product Cards
- Testimonials
- Team Members
- Pricing Tables
- Course Cards
- Event Cards
- Service Cards
- Hero Sections