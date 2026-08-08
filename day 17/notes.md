# Day 17 — WordPress Roles & Capabilities

## Topics Learned

- WordPress Roles
- WordPress Capabilities
- add_role()
- remove_role()
- get_role()
- add_cap()
- remove_cap()
- current_user_can()
- Custom Post Type capabilities
- Role-based authorization

## Default WordPress Roles

WordPress provides:

- Administrator
- Editor
- Author
- Contributor
- Subscriber

## Roles vs Capabilities

A role is a collection of capabilities.

Example:

Property Owner

Capabilities:

- read
- upload_files
- edit_properties
- publish_properties

## Checking Permissions

Use:

current_user_can()

Example:

current_user_can( 'edit_posts' );

Authorization should generally check capabilities rather
than checking a user's role name.

## Creating Roles

Custom roles can be created using:

add_role()

Example:

Property Owner

## Modifying Roles

Retrieve:

get_role()

Add permission:

add_cap()

Remove permission:

remove_cap()

## Security

Nonces and capabilities solve different problems.

Nonce:
Helps verify that a request/action is intentional and
originates from an expected WordPress context.

Capability:
Determines whether the current user is authorized to
perform the operation.

Sensitive actions often require both.

## Key Learnings

- Roles are collections of capabilities.
- Capabilities determine what users can do.
- Prefer capability checks over role-name checks.
- current_user_can() checks permissions.
- Custom roles are useful for application-specific users.
- Custom CPT capabilities provide better access control.
- Roles can be created during plugin activation.

## Real-World Uses

- Membership Websites
- Property Platforms
- LMS Platforms
- Multi-Vendor Websites
- Job Portals
- Client Dashboards
- Editorial Websites