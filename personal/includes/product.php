<?php
/* ----------------------------------------------------------------------------------- */
# Create post_type
/* ----------------------------------------------------------------------------------- */
add_action('init', 'create_product_post_type');

function create_product_post_type(){
    register_post_type('product', array(
        'labels' => array(
            'name' => __('Products', SHORT_NAME),
            'singular_name' => __('Products', SHORT_NAME),
            'add_new' => __('Add new', SHORT_NAME),
            'add_new_item' => __('Add new Product', SHORT_NAME),
            'new_item' => __('New Product', SHORT_NAME),
            'edit' => __('Edit', SHORT_NAME),
            'edit_item' => __('Edit Product', SHORT_NAME),
            'view' => __('View Product', SHORT_NAME),
            'view_item' => __('View Product', SHORT_NAME),
            'search_items' => __('Search Products', SHORT_NAME),
            'not_found' => __('No Product found', SHORT_NAME),
            'not_found_in_trash' => __('No Product found in trash', SHORT_NAME),
        ),
        'public' => true,
        'show_ui' => true,
        'publicy_queryable' => true,
        'exclude_from_search' => false,
        'menu_position' => 20,
        'hierarchical' => false,
        'query_var' => true,
        'supports' => array(
            'title', 'editor', 'author', 'thumbnail', 'comments', 
            //'custom-fields', 'excerpt', 
        ),
        'rewrite' => array('slug' => 'san-pham', 'with_front' => false),
        'can_export' => true,
        'description' => __('Product description here.', SHORT_NAME),
        'taxonomies' => array('post_tag'),
    ));
}
/* ----------------------------------------------------------------------------------- */
# Create taxonomy
/* ----------------------------------------------------------------------------------- */
add_action('init', 'create_product_taxonomies');

function create_product_taxonomies(){
    register_taxonomy('product_cat', 'product', array(
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'query_var' => true,
        'labels' => array(
            'name' => __('Product Categories', SHORT_NAME),
            'singular_name' => __('Product Categories', SHORT_NAME),
            'add_new' => __('Add new', SHORT_NAME),
            'add_new_item' => __('Add New Category', SHORT_NAME),
            'new_item' => __('New Category', SHORT_NAME),
            'search_items' => __('Search Categories', SHORT_NAME),
        ),
        'rewrite' => array('slug' => 'product_category', 'with_front' => false),
    ));
    register_taxonomy('product_location', 'product', array(
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'query_var' => true,
        'labels' => array(
            'name' => __('Locations', SHORT_NAME),
            'singular_name' => __('Locations', SHORT_NAME),
            'add_new' => __('Add new', SHORT_NAME),
            'add_new_item' => __('Add New Location', SHORT_NAME),
            'new_item' => __('New Location', SHORT_NAME),
            'search_items' => __('Search Locations', SHORT_NAME),
        ),
        'rewrite' => array('slug' => 'product_location', 'with_front' => false),
    ));
    register_taxonomy('product_price', 'product', array(
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'query_var' => true,
        'labels' => array(
            'name' => __('Prices', SHORT_NAME),
            'singular_name' => __('Prices', SHORT_NAME),
            'add_new' => __('Add new', SHORT_NAME),
            'add_new_item' => __('Add New Price', SHORT_NAME),
            'new_item' => __('New Price', SHORT_NAME),
            'search_items' => __('Search Prices', SHORT_NAME),
        ),
        'rewrite' => array('slug' => 'product_price', 'with_front' => false),
    ));
}

// Show filter
add_action('restrict_manage_posts','restrict_product_by_product_category');
function restrict_product_by_product_category() {
    global $wp_query, $typenow;
    if ($typenow=='product') {
        $taxonomies = array('product_cat');
        foreach ($taxonomies as $taxonomy) {
            $category = get_taxonomy($taxonomy);
            wp_dropdown_categories(array(
                'show_option_all' =>  __("$category->label"),
                'taxonomy'        =>  $taxonomy,
                'name'            =>  $taxonomy,
                'orderby'         =>  'name',
                'selected'        =>  $wp_query->query['term'],
                'hierarchical'    =>  true,
                'depth'           =>  3,
                'show_count'      =>  true, // Show # listings in parens
                'hide_empty'      =>  true, // Don't show businesses w/o listings
            ));
        }
    }
}

// Get post where filter condition

add_filter( 'posts_where' , 'products_where' );
function products_where($where) {
    if (is_admin()) {
        global $wpdb;
        
        $wp_posts = $wpdb->posts;
        $term_relationships = $wpdb->term_relationships;
        $term_taxonomy = $wpdb->term_taxonomy;

        $product_category = intval(getRequest('product_cat'));
        if ($product_category > 0) {
            $where .= " AND $wp_posts.ID IN (SELECT DISTINCT {$term_relationships}.object_id FROM {$term_relationships} 
                WHERE {$term_relationships}.term_taxonomy_id IN (
                    SELECT DISTINCT {$term_taxonomy}.term_taxonomy_id FROM {$term_taxonomy} ";
            
            if ($product_category > 0) {
                $where .= " WHERE {$term_taxonomy}.term_id = $product_category 
                                AND {$term_taxonomy}.taxonomy = 'product_cat') )";
            }
                            
//            $where = str_replace("AND 0 = 1", "", $where);
            $where = str_replace("0 = 1", "1 = 1", $where);
        }
    }
    return $where;
}
/* ----------------------------------------------------------------------------------- */
# Meta box
/* ----------------------------------------------------------------------------------- */
$product_meta_box = array(
    'id' => 'product-meta-box',
    'title' => __('Information', SHORT_NAME),
    'page' => 'product',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => __('Mã sản phẩm', SHORT_NAME),
            'desc' => '',
            'id' => 'code',
            'type' => 'text',
            'std' => '',
        ),
        array(
            'name' => __('<strike>Giá thị trường</strike>', SHORT_NAME),
            'desc' => '',
            'id' => 'old_price',
            'type' => 'text',
            'std' => '',
        ),
        array(
            'name' => __('Giá bán', SHORT_NAME),
            'desc' => 'Example: 100000',
            'id' => 'price',
            'type' => 'text',
            'std' => '',
        ),
//        array(
//            'name' => __('Sale (%)', SHORT_NAME),
//            'desc' => 'Example: 10',
//            'id' => 'sale',
//            'type' => 'text',
//            'std' => '0',
//        ),
        array(
            'name' => __('Popular product', SHORT_NAME),
            'desc' => '',
            'id' => 'is_most',
            'type' => 'radio',
            'std' => '',
            'options' => array(
                '1' => 'Yes',
                '0' => 'No'
            )
        ),
));

// Add product meta box
if(is_admin()){
    add_action('admin_menu', 'product_add_box');
    add_action('save_post', 'product_add_box');
    add_action('save_post', 'product_save_data');
//    add_action('publish_product', 'product_publish_data');
}

function product_add_box(){
    global $product_meta_box;
    add_meta_box($product_meta_box['id'], $product_meta_box['title'], 'product_show_box', $product_meta_box['page'], $product_meta_box['context'], $product_meta_box['priority']);
}
/**
 * Callback function to show fields in product meta box
 * @global array $product_meta_box
 * @global Object $post
 * @global array $area_fields
 */
function product_show_box() {
    global $product_meta_box, $post;
    custom_output_meta_box($product_meta_box, $post);    
}
/**
 * Save data from product meta box
 * @global array $product_meta_box
 * @param Object $post_id
 * @return 
 */
function product_save_data($post_id) {
    global $product_meta_box;
    custom_save_meta_box($product_meta_box, $post_id);
}
/*
function product_publish_data($post_id){
    $purchases = get_post_meta($post_id, "purchases", true);
    
    if(!$purchases or $purchases == ""){
        if( ( $_POST['post_status'] == 'publish' ) && ( $_POST['original_post_status'] != 'publish' ) ) {
            update_post_meta($post_id, 'purchases', 0);
        }
    }
    
    return $post_id;
}

/***************************************************************************/

// ADD NEW COLUMN  
function product_columns_head($defaults) {
    unset($defaults['date']);
    unset($defaults['comments']);
    $defaults['cat'] = __('Categories', SHORT_NAME);
    $defaults['date'] = __('Date');
    $defaults['is_most'] = __('Nổi bật', SHORT_NAME);
    return $defaults;
}

// SHOW THE COLUMN
function product_columns_content($column_name, $post_id) {
    switch ($column_name) {
        case 'cat':
            $taxonomy = 'product_cat';
            $terms = get_the_terms($post_id, $taxonomy);
            if(is_array($terms)){
                foreach ($terms as $key => $term) {
                    echo '<a href="' . get_edit_tag_link($term->term_id, $taxonomy) . '" target="_blank">' . $term->name . '</a>';
                    if($key < count($terms) - 1){
                        echo ", ";
                    }
                }
            }
            break;
        case 'is_most':
            $is_most = get_post_meta( $post_id, 'is_most', true );
            if($is_most == 1){
                echo '<a href="edit.php?update_is_most=true&post_id=' . $post_id . '&is_most=' . $is_most . '&redirect_to=' . urlencode(getCurrentRquestUrl()) . '">Yes</a>';
            }else{
                echo '<a href="edit.php?update_is_most=true&post_id=' . $post_id . '&is_most=' . $is_most . '&redirect_to=' . urlencode(getCurrentRquestUrl()) . '">No</a>';
            }
            break;
        default:
            break;
    }
}

// Update is most stataus
function update_product_is_most(){
    if(getRequest('update_is_most') == 'true'){
        $post_id = getRequest('post_id');
        $is_most = getRequest('is_most');
        $redirect_to = urldecode(getRequest('redirect_to'));
        if($is_most == 1){
            update_post_meta($post_id, 'is_most', 0);
        }else{
            update_post_meta($post_id, 'is_most', 1);
        }
        header("location: $redirect_to");
        exit();
    }
}

add_filter('manage_product_posts_columns', 'product_columns_head');  
add_action('manage_product_posts_custom_column', 'product_columns_content', 10, 2);  
add_filter('admin_init', 'update_product_is_most');

// Sortable columns

function sortable_product_columns( $columns ) {  
    $columns['is_most'] = 'is_most';
    return $columns;
}

function product_column_orderby( $query ) {  
    if( ! is_admin() )  
        return;  
  
    $orderby = $query->get( 'orderby');  
  
    switch ($orderby) {
        case 'is_most':
            $query->set('meta_key','is_most');  
            $query->set('orderby','meta_value_num');  
            break;
        default:
            break;
    }
}

add_filter( 'manage_edit-product_sortable_columns', 'sortable_product_columns' );  
add_action( 'pre_get_posts', 'product_column_orderby' );  