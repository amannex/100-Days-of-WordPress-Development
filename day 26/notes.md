# Day 26 — WordPress Security

## Topics Learned

- Nonces
- Sanitization
- Validation
- Escaping
- Capability checks
- current_user_can()
- Secure form handling
- Autosave checks
- Revision checks
- $wpdb->prepare()
- Secure custom-field saving

---

# WordPress Security Flow

User Input

↓

Nonce Verification

↓

Capability Check

↓

Autosave / Revision Check

↓

Sanitization

↓

Validation

↓

Save to Database

↓

Escape Output

↓

HTML

---

# Nonces

A WordPress nonce is used to help verify that
a request/action comes from an expected context.

Create:

wp_nonce_field()

Verify:

wp_verify_nonce()

Example:

wp_nonce_field(
    'save_property',
    'property_nonce'
);

---

# Important

A nonce is NOT an authorization system.

Nonce:

"Is this request associated with the expected
action/context?"

Capability:

"Is this user allowed to perform this action?"

Both can be required.

---

# Capability Checks

Use:

current_user_can()

Example:

if (
    ! current_user_can(
        'edit_post',
        $post_id
    )
) {
    return;
}

---

# Sanitization

Sanitization cleans incoming data before
storing or processing it.

Examples:

sanitize_text_field()

sanitize_email()

esc_url_raw()

absint()

sanitize_key()

---

# Validation

Validation checks whether data meets
expected rules.

Example:

Bedrooms should be between 1 and 20.

if (
    $bedrooms < 1 ||
    $bedrooms > 20
) {
    return;
}

---

# Escaping

Escaping protects output based on where
the data is being displayed.

Text:

esc_html()

URL:

esc_url()

HTML attribute:

esc_attr()

---

# Sanitization vs Escaping

Sanitization:

Input
↓

Clean data
↓

Store/process

Escaping:

Stored data
↓

Make safe for output
↓

HTML

---

# Autosave

WordPress performs autosaves.

Check:

if (
    defined('DOING_AUTOSAVE') &&
    DOING_AUTOSAVE
) {
    return;
}

---

# Revisions

Avoid processing revisions:

if (
    wp_is_post_revision($post_id)
) {
    return;
}

---

# Secure Database Queries

Use:

$wpdb->prepare()

when dynamic values are inserted
into SQL queries.

Never directly concatenate
untrusted user input into SQL.

---

# Common Security Mistakes

1. Trusting $_POST
2. Trusting $_GET
3. Printing database values without escaping
4. Not checking user capabilities
5. Not using nonces where appropriate
6. Building SQL with raw user input
7. Confusing sanitization with validation
8. Assuming a nonce provides authorization

---

# Key Learning

Secure WordPress development means:

Sanitize input.

Validate input.

Authorize actions.

Escape output.

Use prepared SQL queries.

---

# Security Checklist

Before saving submitted data:

[ ] Is the expected field present?

[ ] Is the nonce valid?

[ ] Is the user authorized?

[ ] Is this an autosave?

[ ] Is this a revision?

[ ] Is the input sanitized?

[ ] Is the input valid?

[ ] Is the output escaped?

[ ] Is SQL prepared?

---

# Practice

Take the Property Custom Post Type
from Day 25.

Make its custom fields secure using:

- Nonce
- Capability check
- Sanitization
- Validation
- Autosave check
- Revision check
- Escaping

---

# Interview Concepts

## What is a nonce?

A nonce helps verify that a request is associated
with an expected action and context.

## Does a nonce provide authorization?

No.

Authorization should be handled with
capability checks such as current_user_can().

## What is sanitization?

Cleaning input before storing or processing it.

## What is escaping?

Making data safe for a specific output context.

## What is validation?

Checking whether input meets expected rules.

## Why use $wpdb->prepare()?

To safely construct SQL queries containing
dynamic values.