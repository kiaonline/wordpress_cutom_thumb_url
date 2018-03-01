# wordpress_cutom_thumb_url
Automatically rezise a thumbnail and insert as post attachment

Use:

inside the functions.php file, enter the line below:

require_once('get_custom_post_thumbnail_url.php');

This code works as wordpress function get_the_post_thumbnail_url(int|WP_Post $post = null, string|array $size = 'post-thumbnail')

but with one diference, it will create the thumnail in runtime if nox exists

in your code call:

get_custom_post_thumbnail_url(int|WP_Post $post = null, string|array $size = 'post-thumbnail',$crop = true);

# example
The code below create a thumbnail with 200 pixel width and 200 pixel height
<?php echo get_custom_post_thumbnail_url(null,'200x200');?>