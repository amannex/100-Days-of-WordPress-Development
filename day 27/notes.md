# Day 27 — WordPress Hooks

## Topics Learned

- WordPress Hooks
- Actions
- Filters
- add_action()
- add_filter()
- Hook priority
- Accepted arguments
- do_action()
- apply_filters()
- Creating custom hooks
- Modifying WordPress functionality

---

# What Is a Hook?

A hook is a point in WordPress where
developers can attach custom functionality.

Instead of modifying WordPress core files,
developers use hooks to extend or modify
WordPress.

---

# Two Types of Hooks

WordPress has two primary types:

1. Actions
2. Filters

---

# Actions

Actions are used when you want to
perform an operation.

Examples:

- Register a Custom Post Type
- Add content to a page
- Send an email
- Create a log
- Register scripts
- Run custom functionality

Syntax:

add_action(
    'hook_name',
    'callback_function'
);

---

# Filters

Filters are used when you want to
modify existing data.

Examples:

- Modify post titles
- Modify post content
- Modify excerpts
- Modify HTML
- Change values

Syntax:

add_filter(
    'hook_name',
    'callback_function'
);

---

# Action vs Filter

Action:

DO something.

Filter:

CHANGE something.

Actions generally do not need to return
the value they receive.

Filters should return the modified value.

---

# Example Action

function my_function() {

    echo 'Hello';

}

add_action(
    'wp_footer',
    'my_function'
);

---

# Example Filter

function my_filter(
    $title
) {

    return '🔥 ' . $title;

}

add_filter(
    'the_title',
    'my_filter'
);

---

# Hook Priority

Default priority:

10

Example:

add_action(
    'init',
    'function_one',
    5
);

add_action(
    'init',
    'function_two',
    20
);

Lower priority numbers run earlier.

Order:

5
↓
10
↓
20

---

# Accepted Arguments

Some hooks pass arguments to
callback functions.

Example:

add_filter(
    'the_title',
    'my_function',
    10,
    2
);

The final 2 means the callback can
receive two arguments.

---

# Custom Actions

Developers can create their own actions.

do_action(
    'my_custom_action',
    $value
);

Other developers can listen:

add_action(
    'my_custom_action',
    'my_function'
);

---

# Custom Filters

Developers can create custom filters.

$value = apply_filters(
    'my_custom_filter',
    $value
);

Other developers can modify it:

add_filter(
    'my_custom_filter',
    'my_function'
);

---

# Why Hooks Matter

Hooks allow WordPress developers to
extend functionality without modifying
WordPress core.

This provides:

- Better maintainability
- Better compatibility
- Easier updates
- Plugin extensibility
- Theme extensibility

---

# Common Hooks

Actions:

init
wp_enqueue_scripts
admin_init
wp_footer
wp_head
save_post

Filters:

the_title
the_content
the_excerpt
body_class
post_class

---

# Important Rule

Never modify WordPress core files
to add custom functionality.

Use hooks whenever an appropriate
hook exists.

---

# Property Project Example

A property title can be modified:

add_filter(
    'the_title',
    'property_title',
    10,
    2
);

A property price can be added
to the content:

add_filter(
    'the_content',
    'property_details'
);

---

# Mental Model

Action:

WordPress
↓
Hook
↓
Your function
↓
Continue

Filter:

WordPress data
↓
Hook
↓
Your function
↓
Modified data
↓
Continue

---

# Key Learning

Actions are for doing something.

Filters are for modifying something.

add_action() attaches a function to
an action.

add_filter() attaches a function to
a filter.

do_action() triggers a custom action.

apply_filters() runs a value through
a custom filter.

---

# Practice

Build a small plugin that:

1. Adds a footer message.
2. Adds an emoji to Property titles.
3. Adds property price to Property content.
4. Uses hook priority.
5. Creates one custom action.
6. Creates one custom filter.

---

# Interview Questions

## What is a WordPress hook?

A hook is a point in WordPress where
developers can attach custom functionality.

## What is an action?

An action allows developers to execute
custom code at a particular point.

## What is a filter?

A filter allows developers to modify
data before it is used or displayed.

## Difference between action and filter?

Actions perform operations.

Filters modify values and should return
the modified value.

## What is hook priority?

Priority determines the order in which
callbacks attached to the same hook execute.

## What is do_action()?

It triggers an action hook.

## What is apply_filters()?

It passes a value through a filter hook
and returns the modified value.