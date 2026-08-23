# Day 29 — WordPress Admin Menu & Settings API

## Topics Learned

- Admin menu
- add_menu_page()
- add_submenu_page()
- admin_menu
- Settings API
- register_setting()
- add_settings_section()
- add_settings_field()
- settings_fields()
- do_settings_sections()
- submit_button()
- get_option()
- update_option()
- delete_option()
- Settings sanitization
- Admin capabilities

---

# Admin Menu

Plugins can add custom pages to the
WordPress dashboard.

Function:

add_menu_page()

Example:

add_menu_page(
    'Property Manager',
    'Property Manager',
    'manage_options',
    'day29-settings',
    'day29_settings_page'
);

---

# Submenu

Use:

add_submenu_page()

This allows a plugin to create multiple
admin pages.

Example structure:

Property Manager
    ↓
    ├── Dashboard
    ├── Settings
    └── Help

---

# Capability

Admin pages should check whether the
current user has permission.

For settings pages:

manage_options

is commonly used.

Example:

if (
    ! current_user_can(
        'manage_options'
    )
) {
    return;
}

---

# Settings API

The Settings API provides WordPress's
standard system for creating and storing
plugin settings.

Main functions:

register_setting()

add_settings_section()

add_settings_field()

settings_fields()

do_settings_sections()

submit_button()

---

# register_setting()

Registers a setting with WordPress.

Example:

register_setting(
    'my_group',
    'my_option'
);

---

# Sanitization

Settings should be sanitized.

Example:

register_setting(
    'my_group',
    'my_option',
    array(
        'sanitize_callback' =>
            'sanitize_text_field',
    )
);

---

# Settings Section

Groups related settings.

Example:

add_settings_section(
    'general_section',
    'General Settings',
    'section_callback',
    'settings-page'
);

---

# Settings Field

Creates an individual field.

Example:

add_settings_field(
    'currency',
    'Currency',
    'currency_callback',
    'settings-page',
    'general_section'
);

---

# Get Option

Retrieve a saved option:

$value = get_option(
    'my_option',
    'default value'
);

---

# Update Option

Manually update an option:

update_option(
    'my_option',
    'new value'
);

---

# Delete Option

Delete an option:

delete_option(
    'my_option'
);

---

# Settings Form

The standard Settings API form:

<form method="post" action="options.php">

    <?php

    settings_fields(
        'my_group'
    );

    do_settings_sections(
        'settings-page'
    );

    submit_button();

    ?>

</form>

---

# Why Use the Settings API?

It provides a standard WordPress way
to create plugin settings.

Benefits:

- Standard admin UI
- Security handling
- Capability checks
- Settings registration
- Sanitization
- WordPress integration

---

# Day 29 Project

Extended the Day 28 Property Manager.

Added:

Property Manager
    ↓
Settings

Settings:

- Currency
- Contact Email
- Properties Per Page
- Featured Properties

---

# Architecture

Plugin
    ↓
Admin Menu
    ↓
Settings Page
    ↓
Settings API
    ↓
WordPress Options
    ↓
get_option()

---

# Important Security Concepts

Settings should:

1. Check capabilities.
2. Register settings properly.
3. Sanitize values.
4. Escape values when displaying them.

---

# Example

Save:

sanitize_text_field()

Retrieve:

get_option()

Display:

esc_html()
esc_attr()

---

# Day 29 Practice

Build a settings page with:

1. Currency
2. Contact email
3. Properties per page
4. Featured properties toggle

Then use those settings inside
your Property Manager plugin.

---

# Interview Questions

## What is add_menu_page()?

It creates a top-level admin menu page.

## What is add_submenu_page()?

It creates a submenu under an existing
admin menu.

## What is the Settings API?

A WordPress API for registering,
displaying and managing plugin settings.

## What does register_setting() do?

Registers a setting with WordPress.

## What does get_option() do?

Retrieves a saved WordPress option.

## What does update_option() do?

Creates or updates a WordPress option.

## What does delete_option() do?

Deletes an option.

## Why sanitize settings?

To ensure submitted data is cleaned and
handled safely before storage.

## Why use manage_options?

It restricts access to users who have
the capability to manage site options.