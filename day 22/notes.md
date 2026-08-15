# Day 22 — Gutenberg Block Development Part 2

## Topics Learned

- edit.js
- save.js
- index.js
- useBlockProps()
- RichText
- InspectorControls
- PanelBody
- TextControl
- SelectControl
- Block Attributes
- @wordpress/scripts

## edit.js

edit.js controls the editing experience inside
the Gutenberg editor.

It can contain interactive controls and components.

## save.js

save.js defines the markup that is saved into
the post content for a static block.

## useBlockProps()

useBlockProps() adds WordPress block properties
and recommended classes/attributes to the block.

For the saved markup:

useBlockProps.save()

## RichText

RichText provides an editable WordPress-style
rich text component.

Example:

RichText
    tagName="h2"
    value={attributes.title}

## InspectorControls

InspectorControls allows developers to add
custom settings to the Gutenberg sidebar.

## Block Attributes

Attributes store data belonging to a block.

Example:

- title
- city
- price
- bedrooms

## @wordpress/scripts

@wordpress/scripts provides the build tooling
needed for modern WordPress JavaScript development.

Commands:

npm install

npm start

npm run build

## Static Block Flow

Editor

↓

edit.js

↓

Block Attributes

↓

save.js

↓

Saved HTML

## Key Learnings

- edit.js controls the editor experience.
- save.js controls saved markup for static blocks.
- Attributes store block data.
- InspectorControls creates sidebar settings.
- RichText provides editable content.
- WordPress provides React-based components for block development.