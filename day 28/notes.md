# Day 28 — WordPress Plugin Development

## Topics Learned

- What is a WordPress plugin?
- Plugin structure
- Plugin header
- Plugin entry point
- Plugin constants
- require_once
- Activation hooks
- Deactivation hooks
- Custom Post Types inside plugins
- Enqueueing CSS
- Enqueueing JavaScript
- Admin hooks
- Frontend hooks
- Plugin architecture

---

# What Is a Plugin?

A WordPress plugin is a package of code
that extends WordPress functionality.

Plugins can add:

- Custom Post Types
- Shortcodes
- REST APIs
- Admin pages
- Settings
- Gutenberg blocks
- Database functionality
- Third-party integrations

---

# Theme vs Plugin

Theme:

- Design
- Layout
- Templates
- Presentation

Plugin:

- Functionality
- Business logic
- Data
- APIs
- Integrations

A property management system should
generally be implemented as plugin
functionality rather than tightly coupling
the data to a theme.

---

# Plugin Header

WordPress identifies a plugin through
its plugin header.

Example:

Plugin Name: Day 28 Property Manager
Description: Property management plugin.
Version: 1.0.0
Author: Your Name

---

# ABSPATH Check

Use:

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

This prevents direct execution of the
plugin file.

---

# Plugin Constants

Example:

define(
    'DAY28_VERSION',
    '1.0.0'
);

define(
    'DAY28_PLUGIN_DIR',
    plugin_dir_path( __FILE__ )
);

define(
    'DAY28_PLUGIN_URL',
    plugin_dir_url( __FILE__ )
);

---

# Activation Hook

Runs when the plugin is activated.

Example:

register_activation_hook(
    __FILE__,
    'activation_function'
);

Common uses:

- Create database tables
- Set default options
- Register initial configuration
- Flush rewrite rules

---

# Deactivation Hook

Runs when the plugin is deactivated.

Example:

register_deactivation_hook(
    __FILE__,
    'deactivation_function'
);

Common use:

- Flush rewrite rules
- Stop scheduled processes
- Perform temporary cleanup

Do not automatically delete
important user data during deactivation.

---

# Deactivation vs Uninstall

Deactivation:

Plugin stops running.

Data usually remains.

Uninstallation:

Plugin is removed.

Plugin-specific data may be removed
if the developer intentionally implements
an uninstall process.

---

# Enqueueing CSS

Use:

wp_enqueue_style()

Example:

wp_enqueue_style(
    'day28-style',
    DAY28_PLUGIN_URL . 'assets/css/style.css',
    array(),
    DAY28_VERSION
);

---

# Enqueueing JavaScript

Use:

wp_enqueue_script()

Example:

wp_enqueue_script(
    'day28-script',
    DAY28_PLUGIN_URL . 'assets/js/script.js',
    array(),
    DAY28_VERSION,
    true
);

---

# Frontend Assets

Frontend assets are normally registered
using:

wp_enqueue_scripts

Example:

add_action(
    'wp_enqueue_scripts',
    'my_assets'
);

---

# Admin Assets

Admin-specific assets can use:

admin_enqueue_scripts

---

# Plugin Architecture

Instead of keeping everything in one file:

plugin.php

Separate functionality:

includes/
admin/
public/
assets/

This makes the plugin easier to maintain.

---

# Main Plugin File

The main plugin file acts as the
entry point.

It can:

- Define constants
- Load other files
- Register activation hooks
- Register deactivation hooks

---

# Important Functions

plugin_dir_path()

Returns the filesystem path
of the plugin.

plugin_dir_url()

Returns the URL of the plugin.

require_once

Loads another PHP file.

register_activation_hook()

Runs during activation.

register_deactivation_hook()

Runs during deactivation.

wp_enqueue_style()

Loads CSS.

wp_enqueue_script()

Loads JavaScript.

---

# Day 28 Project

Created:

Day 28 Property Manager

Features:

- Property Custom Post Type
- Plugin architecture
- Activation hook
- Deactivation hook
- Admin notice
- Frontend CSS
- Frontend JavaScript

---

# Architecture

Main Plugin
    ↓
Load Files
    ↓
Post Types
Admin
Public
    ↓
Hooks
    ↓
WordPress

---

# Key Learning

A professional WordPress developer
should avoid putting large amounts of
functionality directly into functions.php.

Reusable functionality should generally
live inside a plugin.

---

# Practice

Create your own plugin.

The plugin should:

1. Register a Property CPT.
2. Display an admin notice.
3. Load CSS.
4. Load JavaScript.
5. Use an activation hook.
6. Use a deactivation hook.
7. Use separate files.
8. Use WordPress hooks.

---

# Interview Questions

## What is a WordPress plugin?

A package of PHP code that extends
WordPress functionality.

## What is a plugin header?

Metadata at the beginning of the main
plugin file that WordPress uses to
identify the plugin.

## What is register_activation_hook()?

It registers a function that executes
when a plugin is activated.

## What is register_deactivation_hook()?

It registers a function that executes
when a plugin is deactivated.

## Why use wp_enqueue_script()?

To properly load JavaScript using
WordPress's asset management system.

## Why separate plugin files?

To improve maintainability,
organization, debugging and scalability.

## Theme vs plugin?

Themes primarily control presentation.

Plugins primarily provide functionality.