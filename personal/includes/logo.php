<?php
/* ----------------------------------------------------------------------------------- */
# Create post_type
/* ----------------------------------------------------------------------------------- */
add_action('init', 'create_logo_post_type');

function create_logo_post_type() {
    $capability_type = 'logo';
    $args = array(
        'labels' => array(
            'name' => __('Logos', SHORT_NAME),
            'singular_name' => __('Logos', SHORT_NAME),
            'add_new' => __('Thêm mới', SHORT_NAME),
            'add_new_item' => __('Add new Logo', SHORT_NAME),
            'new_item' => __('New Logo', SHORT_NAME),
            'edit' => __('Chỉnh sửa', SHORT_NAME),
            'edit_item' => __('Edit Logo', SHORT_NAME),
            'view' => __('View Logo', SHORT_NAME),
            'view_item' => __('View Logo', SHORT_NAME),
            'search_items' => __('Search Logos', SHORT_NAME),
            'not_found' => __('No Logo found', SHORT_NAME),
            'not_found_in_trash' => __('No Logo found in trash', SHORT_NAME),
        ),
        'public' => false,
        'show_ui' => true,
        'publicy_queryable' => true,
        'exclude_from_search' => true,
        'menu_position' => 5,
        'hierarchical' => false,
        'query_var' => true,
        'supports' => array(
            'title',
        ),
        'rewrite' => array('slug' => 'logo', 'with_front' => false),
        'can_export' => true,
        'description' => __('Logo description here.'),
//        'capability_type' => $capability_type,
//        'capabilities' => array(
//            'edit_post' => 'edit_logo',
//            'read_post' => 'read_logo',
//            'delete_post' => 'delete_logo',
//            'edit_posts' => 'edit_logos',
//            'edit_others_posts' => 'edit_others_logos',
//            'publish_posts' => 'publish_logos',
//            'read_private_posts' => 'read_private_logos',
//            'create_posts' => 'create_logos',
//        ),
    );

    register_post_type('logo', $args);
}

/* ----------------------------------------------------------------------------------- */
# Create taxonomy
/* ----------------------------------------------------------------------------------- */
/* add_action('init', 'create_logo_taxonomies');

  function create_logo_taxonomies(){
  register_taxonomy('logo_category', 'logo', array(
  'hierarchical' => true,
  'labels' => array(
  'name' => __('Logo Categories'),
  'singular_name' => __('Logo Categories'),
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

$logo_meta_box = array(
    'id' => 'logo-meta-box',
    'title' => __('Thông tin', SHORT_NAME),
    'page' => 'logo',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => __('Hình ảnh', SHORT_NAME),
            'desc' => __('Có thể điền URL ảnh hoặc chọn ảnh từ thư viện. Size: 300x150 px', SHORT_NAME),
            'id' => 'logo_img',
            'type' => 'text',
            'std' => '',
            'btn' => 'logo_img',
        ),
        array(
            'name' => __('Liên kết', SHORT_NAME),
            'desc' => '',
            'id' => 'logo_link',
            'type' => 'text',
            'std' => '',
        ),
        array(
            'name' => __('Sắp xếp', SHORT_NAME),
            'desc' => '',
            'id' => 'order_item',
            'type' => 'text',
            'std' => '1',
        ),
));
// Add logo meta box
if (is_admin()) {
    add_action('admin_menu', 'logo_add_box');
    add_action('save_post', 'logo_add_box');
    add_action('save_post', 'logo_save_data');
}

/**
 * Add meta box
 * @global array $logo_meta_box
 */
function logo_add_box() {
    global $logo_meta_box;
    add_meta_box($logo_meta_box['id'], $logo_meta_box['title'], 'logo_show_box', $logo_meta_box['page'], $logo_meta_box['context'], $logo_meta_box['priority']);
}

/**
 * Callback function to show fields in logo meta box
 * @global array $logo_meta_box
 * @global Object $post
 */
function logo_show_box() {
    // Use nonce for verification
    global $logo_meta_box, $post;
    custom_output_meta_box($logo_meta_box, $post);
}
/**
 * Save data from logo meta box
 * @global array $logo_meta_box
 * @param int $post_id
 * @return 
 */
function logo_save_data($post_id) {
    global $logo_meta_box;
    custom_save_meta_box($logo_meta_box, $post_id);
    
}