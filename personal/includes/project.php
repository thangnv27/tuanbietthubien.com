<?php
/* ----------------------------------------------------------------------------------- */
# Create post_type
/* ----------------------------------------------------------------------------------- */
add_action('init', 'create_project_post_type');

function create_project_post_type(){
    register_post_type('project', array(
        'labels' => array(
            'name' => __('Projects', SHORT_NAME),
            'singular_name' => __('Projects', SHORT_NAME),
            'add_new' => __('Add new', SHORT_NAME),
            'add_new_item' => __('Add new Project', SHORT_NAME),
            'new_item' => __('New Project', SHORT_NAME),
            'edit' => __('Edit', SHORT_NAME),
            'edit_item' => __('Edit Project', SHORT_NAME),
            'view' => __('View Project', SHORT_NAME),
            'view_item' => __('View Project', SHORT_NAME),
            'search_items' => __('Search Projects', SHORT_NAME),
            'not_found' => __('No Project found', SHORT_NAME),
            'not_found_in_trash' => __('No Project found in trash', SHORT_NAME),
        ),
        'public' => true,
        'show_ui' => true,
        'publicy_queryable' => true,
        'exclude_from_search' => false,
        'menu_position' => 20,
        'hierarchical' => false,
        'query_var' => true,
        'supports' => array(
            'title', 'editor', 'thumbnail', 
            //'custom-fields', 'excerpt', 'author', 'comments', 
        ),
        'rewrite' => array('slug' => 'project', 'with_front' => false),
        'can_export' => true,
        'description' => __('Project description here.', SHORT_NAME),
//        'taxonomies' => array('post_tag'),
    ));
}

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
add_filter('rwmb_meta_boxes', 'project_register_meta_boxes');

/**
 * Register meta boxes
 *
 * Remember to change "your_prefix" to actual prefix in your project
 *
 * @param array $meta_boxes List of meta boxes
 *
 * @return array
 */
function project_register_meta_boxes($meta_boxes) {
    /**
     * prefix of meta keys (optional)
     * Use underscore (_) at the beginning to make keys hidden
     * Alt.: You also can make prefix empty to disable it
     */
    // Better has an underscore as last sign
    $prefix = 'project_';

    // 1st meta box
    $meta_boxes[] = array(
        'id' => 'standard',
        'title' => __('Project Images', SHORT_NAME),
        'post_types' => array('project'),
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