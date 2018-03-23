<?php
/* ----------------------------------------------------------------------------------- */
# Create post_type
/* ----------------------------------------------------------------------------------- */
add_action('init', 'create_service_post_type');

function create_service_post_type() {
    $args = array(
        'labels' => array(
            'name' => __('Services', SHORT_NAME),
            'singular_name' => __('Services', SHORT_NAME),
            'add_new' => __('Add new', SHORT_NAME),
            'add_new_item' => __('Add new Service', SHORT_NAME),
            'new_item' => __('New Service', SHORT_NAME),
            'edit' => __('Edit', SHORT_NAME),
            'edit_item' => __('Edit Service', SHORT_NAME),
            'view' => __('View Service', SHORT_NAME),
            'view_item' => __('View Service', SHORT_NAME),
            'search_items' => __('Search Services', SHORT_NAME),
            'not_found' => __('No Service found', SHORT_NAME),
            'not_found_in_trash' => __('No Service found in trash', SHORT_NAME),
        ),
        'public' => true,
        'show_ui' => true,
        'publicy_queryable' => true,
        'exclude_from_search' => false,
        'menu_position' => 5,
        'hierarchical' => false,
        'query_var' => true,
        'supports' => array(
            'title', 'editor'
        ),
        'rewrite' => array('slug' => 'service', 'with_front' => false),
        'can_export' => true,
        'description' => __('Service description here.', SHORT_NAME)
    );

    register_post_type('service', $args);
}