<?php

/**
 * Feedbacks Menu Page
 */

# Custom feedback post type
add_action('init', 'create_feedback_post_type');

function create_feedback_post_type(){
    register_post_type('feedback', array(
        'labels' => array(
            'name' => __('Feedbacks', SHORT_NAME),
            'singular_name' => __('Feedbacks', SHORT_NAME),
            'add_new' => __('Add new', SHORT_NAME),
            'add_new_item' => __('Add new Feedback', SHORT_NAME),
            'new_item' => __('New Feedback', SHORT_NAME),
            'edit' => __('Edit', SHORT_NAME),
            'edit_item' => __('Edit Feedback', SHORT_NAME),
            'view' => __('View Feedback', SHORT_NAME),
            'view_item' => __('View Feedback', SHORT_NAME),
            'search_items' => __('Search Feedbacks', SHORT_NAME),
            'not_found' => __('No Feedback found', SHORT_NAME),
            'not_found_in_trash' => __('No Feedback found in trash', SHORT_NAME),
        ),
        'public' => false,
        'show_ui' => true,
        'publicy_queryable' => true,
        'exclude_from_search' => false,
        'menu_position' => 5,
        'hierarchical' => false,
        'query_var' => true,
        'supports' => array(
            'title', 'editor', 'thumbnail',
            //'custom-fields', 'comments', 'author','excerpt',
        ),
        'rewrite' => array('slug' => 'feedback', 'with_front' => false),
        'can_export' => true,
        'description' => __('Feedback description here.', SHORT_NAME)
    ));
}

# Custom feedback taxonomies
/*add_action('init', 'create_feedback_taxonomies');

function create_feedback_taxonomies(){
    register_taxonomy('feedback_category', 'feedback', array(
        'hierarchical' => true,
        'labels' => array(
            'name' => __('Feedback Categories'),
            'singular_name' => __('Feedback Categories'),
            'add_new' => __('Add New'),
            'add_new_item' => __('Add New Category'),
            'new_item' => __('New Category'),
            'search_items' => __('Search Categories'),
        ),
    ));
}*/
/*
# feedback meta box
$feedback_meta_box = array(
    'id' => 'feedback-meta-box',
    'title' => 'Thông tin chung',
    'page' => 'feedback',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Họ và tên',
            'desc' => '',
            'id' => 'ho_ten',
            'type' => 'text',
            'std' => '',
        ),
));

// Add feedback meta box
if(is_admin()){
    add_action('admin_menu', 'feedback_add_box');
    add_action('save_post', 'feedback_add_box');
    add_action('save_post', 'feedback_save_data');
}

function feedback_add_box(){
    global $feedback_meta_box;
    add_meta_box($feedback_meta_box['id'], $feedback_meta_box['title'], 'feedback_show_box', $feedback_meta_box['page'], $feedback_meta_box['context'], $feedback_meta_box['priority']);
}

// Callback function to show fields in feedback meta box
function feedback_show_box() {
    // Use nonce for verification
    global $feedback_meta_box, $post;

    custom_output_meta_box($feedback_meta_box, $post);
}

// Save data from feedback meta box
function feedback_save_data($post_id) {
    global $feedback_meta_box;
    custom_save_meta_box($feedback_meta_box, $post_id);
}*/