<?php
/* ----------------------------------------------------------------------------------- */
# Create post_type
/* ----------------------------------------------------------------------------------- */
add_action('init', 'create_photo_post_type');

function create_photo_post_type() {
    $capability_type = 'photo';
    $args = array(
        'labels' => array(
            'name' => __('Photos', SHORT_NAME),
            'singular_name' => __('Photos', SHORT_NAME),
            'add_new' => __('Thêm mới', SHORT_NAME),
            'add_new_item' => __('Add new Photo', SHORT_NAME),
            'new_item' => __('New Photo', SHORT_NAME),
            'edit' => __('Chỉnh sửa', SHORT_NAME),
            'edit_item' => __('Edit Photo', SHORT_NAME),
            'view' => __('View Photo', SHORT_NAME),
            'view_item' => __('View Photo', SHORT_NAME),
            'search_items' => __('Search Photos', SHORT_NAME),
            'not_found' => __('No Photo found', SHORT_NAME),
            'not_found_in_trash' => __('No Photo found in trash', SHORT_NAME),
        ),
        'public' => true,
        'show_ui' => true,
        'publicy_queryable' => true,
        'exclude_from_search' => true,
        'menu_position' => 5,
        'hierarchical' => false,
        'query_var' => true,
        'supports' => array(
            'title', 'thumbnail'
        ),
        'rewrite' => array('slug' => 'photo', 'with_front' => false),
        'can_export' => true,
        'description' => __('Photo description here.'),
//        'capability_type' => $capability_type,
//        'capabilities' => array(
//            'edit_post' => 'edit_photo',
//            'read_post' => 'read_photo',
//            'delete_post' => 'delete_photo',
//            'edit_posts' => 'edit_photos',
//            'edit_others_posts' => 'edit_others_photos',
//            'publish_posts' => 'publish_photos',
//            'read_private_posts' => 'read_private_photos',
//            'create_posts' => 'create_photos',
//        ),
    );

    register_post_type('photo', $args);
}

/* ----------------------------------------------------------------------------------- */
# Create taxonomy
/* ----------------------------------------------------------------------------------- */
/* add_action('init', 'create_photo_taxonomies');

  function create_photo_taxonomies(){
  register_taxonomy('photo_category', 'photo', array(
  'hierarchical' => true,
  'labels' => array(
  'name' => __('Photo Categories'),
  'singular_name' => __('Photo Categories'),
  'add_new' => __('Add New'),
  'add_new_item' => __('Add New Category'),
  'new_item' => __('New Category'),
  'search_items' => __('Search Categories'),
  ),
  ));
  } */
/* ----------------------------------------------------------------------------------- */
# Meta box
/* ----------------------------------------------------------------------------------- */

/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://metabox.io/docs/registering-meta-boxes/
 */
add_filter('rwmb_meta_boxes', 'photo_register_meta_boxes');

/**
 * Register meta boxes
 *
 * Remember to change "your_prefix" to actual prefix in your project
 *
 * @param array $meta_boxes List of meta boxes
 *
 * @return array
 */
function photo_register_meta_boxes($meta_boxes) {
    /**
     * prefix of meta keys (optional)
     * Use underscore (_) at the beginning to make keys hidden
     * Alt.: You also can make prefix empty to disable it
     */
    // Better has an underscore as last sign
    $prefix = 'photo_';

    // 1st meta box
    $meta_boxes[] = array(
        'id' => 'standard',
        'title' => __('Photo Images', SHORT_NAME),
        'post_types' => array('photo'),
        'context' => 'normal',
        'priority' => 'high',
        'autosave' => true,
        'fields' => array(
            array(
                'id' => "{$prefix}images",
                'name' => __("Image reviews", SHORT_NAME),
                'type' => 'image_advanced',
                // Delete image from Media Library when remove it from post meta?
                // Note: it might affect other posts if you use same image for multiple posts
                'force_delete' => false,
            )
        )
    );

    return $meta_boxes;
}