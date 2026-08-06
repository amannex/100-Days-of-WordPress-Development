# Day 15 - WordPress Post Meta

## Topics Learned

- WordPress Metadata API
- add_post_meta()
- get_post_meta()
- update_post_meta()
- delete_post_meta()
- Custom Meta Boxes
- save_post
- meta_query

## Key Learnings

- Post meta stores additional information about posts.
- Post meta is stored in wp_postmeta.
- update_post_meta() creates or updates metadata.
- get_post_meta() retrieves metadata.
- Custom meta boxes can provide fields in the admin editor.
- meta_query can filter posts using metadata.

## Security

When saving custom metadata:

- Verify nonce
- Check user capabilities
- Sanitize input
- Escape output