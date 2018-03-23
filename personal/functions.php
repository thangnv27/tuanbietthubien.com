<?php
/* ----------------------------------------------------------------------------------- */
# adds the plugin initalization scripts that add styles and functions
/* ----------------------------------------------------------------------------------- */
if(!current_theme_supports('deactivate_layerslider')) require_once( "config-layerslider/config.php" );//layerslider plugin

######## BLOCK CODE NAY LUON O TREN VA KHONG DUOC XOA ##########################
include 'includes/config.php';
include 'libs/HttpFoundation/Request.php';
include 'libs/HttpFoundation/Response.php';
include 'libs/HttpFoundation/Session.php';
include 'libs/custom.php';
include 'libs/common-scripts.php';
include 'libs/meta-box.php';
include 'libs/theme_functions.php';
include 'libs/theme_settings.php';
include 'libs/template-tags.php';
######## END: BLOCK CODE NAY LUON O TREN VA KHONG DUOC XOA ##########################
include 'includes/custom-post.php';
include 'includes/widgets/ads.php';
include 'includes/widgets/category-posts-list.php';
include 'includes/widgets/category-posts-first-thumb.php';
include 'includes/product.php';
//include 'includes/product-metabox.php';
include 'includes/service.php';
include 'includes/feedback.php';
include 'includes/logo.php';
include 'includes/photo.php';
include 'includes/project.php';
include 'ajax.php';

if (is_admin()) {
    $basename_excludes = array('plugins.php', 'plugin-install.php', 'plugin-editor.php', 'themes.php', 'theme-editor.php', 
        'tools.php', 'import.php', 'export.php');
    if (in_array($basename, $basename_excludes)) {
//        wp_redirect(admin_url());
    }

    include 'includes/plugins-required.php';
    
    // Add filter
    add_filter( 'enter_title_here', 'ppo_change_title_text' );
    
    // Add action
    add_action('admin_menu', 'custom_remove_menu_pages');
    add_action('admin_menu', 'remove_menu_editor', 102);
}

/**
 * Remove admin menu
 */
function custom_remove_menu_pages() {
    remove_menu_page('edit-comments.php');
//    remove_menu_page('plugins.php');
    remove_menu_page('tools.php');
}

function remove_menu_editor() {
//    remove_submenu_page('themes.php', 'themes.php');
//    remove_submenu_page('themes.php', 'theme-editor.php');
//    remove_submenu_page('plugins.php', 'plugin-editor.php');
    remove_submenu_page('options-general.php', 'options-writing.php');
    remove_submenu_page('options-general.php', 'options-discussion.php');
    remove_submenu_page('options-general.php', 'options-media.php');
}

/* ----------------------------------------------------------------------------------- */
# Setup Theme
/* ----------------------------------------------------------------------------------- */
if (!function_exists("ppo_theme_setup")) {

    function ppo_theme_setup() {
        /*
	 * Make theme available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Fourteen, use a find and
	 * replace to change 'twentyfourteen' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( SHORT_NAME, get_template_directory() . '/languages' );
        
        ## Enable Links Manager (WP 3.5 or higher)
        add_filter('pre_option_link_manager_enabled', '__return_true');

        // This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 
            'css/editor-style.css',
            '/genericons/genericons.css',
            get_stylesheet_directory_uri(), 
        ) );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

        ## Post Thumbnails
        if (function_exists('add_theme_support')) {
            add_theme_support('post-thumbnails');
        }
        add_image_size('360x220', 360, 220, true); // Post thumbnail
        add_image_size('600x600', 600, 600, true); // Product thumbnail

        ## Post formats
        add_theme_support('post-formats', array('video'));
//        add_theme_support('post-formats', array('link', 'quote', 'gallery', 'video', 'image', 'audio', 'aside'));

        ## Add support for featured content.
	add_theme_support( 'featured-content', array(
            'featured_content_filter' => 'ppo_get_featured_posts',
            'max_posts' => 6,
	));

        ## Register menu location
        register_nav_menus(array(
            'primary' => 'Primary Location',
            'primary2' => 'Primary2 Location',
            'top' => 'Top Location',
            'footer' => 'Footer Location',
        ));

        // Front-end remove admin bar
        if (!current_user_can('administrator') && !current_user_can('editor') && !is_admin()) {
            show_admin_bar(false);
        }
    }

}

add_action('after_setup_theme', 'ppo_theme_setup');

/**
 * Enqueue scripts and styles for the front end.
 */
function ppo_enqueue_scripts() {
    // Add Bootstrap stylesheet
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.6' );
    
    // Add font awesome
    wp_enqueue_style( SHORT_NAME . '-font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.6.3' );
    
    // Add Genericons font, used in the main stylesheet.
    wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.0.3' );
    
    // Add colorbox stylesheet
    wp_enqueue_style( SHORT_NAME . '-colorbox', get_template_directory_uri() . '/colorbox/colorbox.css', array(), '1.4.33' );
    
    // Add Bootstrap stylesheet
//    wp_enqueue_style( 'jquery-ui', '//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css', array(), '1.11.4' );
    
    // Add refineslide stylesheet
    if(is_singular('photo')){
        wp_enqueue_style( SHORT_NAME . '-refineslide', get_template_directory_uri() . '/css/refineslide.css', array(), FALSE );
    }
    
    // Add animate stylesheet
    wp_enqueue_style( SHORT_NAME . '-animate', get_template_directory_uri() . '/css/animate.css', array(), FALSE );
    
    // Add font styles
    wp_enqueue_style( SHORT_NAME . '-Roboto-Condensed', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic&subset=latin,vietnamese', array(), false );

    // Load our main stylesheet.
    wp_enqueue_style( SHORT_NAME . '-style', get_stylesheet_uri() );
    
    // Add wordpress default stylesheet
    wp_enqueue_style( 'wp-default', get_template_directory_uri() . '/css/wp-default.css', array(), FALSE );
    
    // Add common stylesheet
    wp_enqueue_style( SHORT_NAME . '-common', get_template_directory_uri() . '/css/common.css', array(), FALSE );

    // Load the Internet Explorer specific stylesheet.
    wp_enqueue_style( SHORT_NAME . '-ie', get_template_directory_uri() . '/css/ie.css', array( SHORT_NAME . '-style' ), '20131205' );
    wp_style_add_data( SHORT_NAME . '-ie', 'conditional', 'lt IE 9' );
/*
    if ( is_singular() && comments_open() ) {
        // Add comment stylesheet
        wp_enqueue_style( 'comment', get_template_directory_uri() . '/css/comment.css', array(), FALSE );
        
        wp_enqueue_script( 'comment-reply' );
    }
*/
    // Add kwicks script
//    wp_enqueue_script( SHORT_NAME . '-script', get_template_directory_uri() . '/js/app.js', array( 'jquery' ), '20150315', true );
    if(!is_admin()){
        wp_enqueue_script('ajax.js', get_bloginfo('template_directory') . "/js/ajax.js", array('jquery'), false, true);
    }
}

add_action( 'wp_enqueue_scripts', 'ppo_enqueue_scripts' );

/* ----------------------------------------------------------------------------------- */
# Widgets init
/* ----------------------------------------------------------------------------------- */
if (!function_exists("ppo_widgets_init")) {

    // Register Sidebar
    function ppo_widgets_init() {
        register_sidebar(array(
            'id' => 'sidebar',
            'name' => __('Sidebar', SHORT_NAME),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
    }

    // Register widgets
    register_widget('Ads_Widget');
    register_widget('Category_Posts_List_Widget');
    register_widget('Category_Posts_First_Thumb_Widget');
}

add_action('widgets_init', 'ppo_widgets_init');

//PPO Feed all post type
function ppo_feed_request($qv) {
    if (isset($qv['feed']))
        $qv['post_type'] = get_post_types();
    return $qv;
}

add_filter('request', 'ppo_feed_request');

function getLocale() {
    $locale = "vn";
    if (get_query_var("lang") != null) {
        $locale = get_query_var("lang");
    } else if (function_exists("qtrans_getLanguage")) {
        $locale = qtrans_getLanguage();
    } else if (defined('ICL_LANGUAGE_CODE')) {
        $locale = ICL_LANGUAGE_CODE;
    }
    if ($locale == "vi") {
        $locale = "vn";
    }
    return $locale;
}

/**
 * Override wp title for add new/edit a post
 * 
 * @param string $title
 * @return string
 */
function ppo_change_title_text( $title ){
    $screen = get_current_screen();
 
    switch ($screen->post_type) {
        case 'product':
            $title = 'Tên sản phẩm';
            break;
        case 'service':
            $title = 'Tên dịch vụ';
            break;
        case 'feedback':
            $title = 'Họ và tên';
            break;
        default:
            break;
    }
 
     return $title;
}
/* ----------------------------------------------------------------------------------- */
# Custom Login / Logout
/* ----------------------------------------------------------------------------------- */

function redirect_after_logout() {
//    $login_page  = get_page_link(get_option(SHORT_NAME . "_pageLoginID"));
//    wp_redirect( $login_page . "?login=false" );
    wp_redirect(home_url());
    exit;
}

add_action('wp_logout','redirect_after_logout');

/**
* Render the contents of the given template to a string and returns it.
* @param    string  $template_name  The name of the template to render (without .php)
* @param    array   $attributes     The PHP variables for the template
*
* @return   string                  The contents of the template.
*/
function get_template_html($template_name, $attributes = null) {
    if (!$attributes) {
        $attributes = array();
    }

    ob_start();
    do_action('personalize_div_before_' . $template_name);
    require( $template_name . '.php' );
    do_action('personalize_div_before_' . $template_name);
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}

/* ----------------------------------------------------------------------------------- */
# Custom search
/* ----------------------------------------------------------------------------------- */
add_action('pre_get_posts', 'custom_search_filter');

function custom_search_filter($query) {
    if (!is_admin() && $query->is_main_query()) {
        if($query->is_search){
            $query->set('posts_per_page', 9);
            $query->set('post_type', 'product');
            
            $cat = intval(getRequest('pcat'));
            $location = intval(getRequest('location'));
            $price = intval(getRequest('price'));
            $tax_query = array(
                'relation' => 'AND',
            );
            if($location > 0){
                array_push($tax_query, array(
                    'taxonomy' => 'product_location',
                    'field' => 'id',
                    'terms' => $location,
                ));
            }
            if($cat > 0){
                array_push($tax_query, array(
                    'taxonomy' => 'product_cat',
                    'field' => 'id',
                    'terms' => $cat,
                ));
            }
            if($price > 0){
                array_push($tax_query, array(
                    'taxonomy' => 'product_price',
                    'field' => 'id',
                    'terms' => $price,
                ));
            }
            if(!empty($location) or !empty($price)){
                $query->set('tax_query', $tax_query);
            }
        }
        if ($query->is_archive and is_tax('product_cat')) {
            $location = intval(getRequest('location'));
            $price = intval(getRequest('price'));
            $tax_query = array(
                'relation' => 'AND',
            );
            if($location > 0){
                array_push($tax_query, array(
                    'taxonomy' => 'product_location',
                    'field' => 'id',
                    'terms' => $location,
                ));
            }
            if($price > 0){
                array_push($tax_query, array(
                    'taxonomy' => 'product_price',
                    'field' => 'id',
                    'terms' => $price,
                ));
            }
            if(!empty($location) or !empty($price)){
                $query->set('tax_query', $tax_query);
            }
            $query->set('posts_per_page', 9);
        }
    }
    return $query;
}

/**
 * Getter function for Featured Content Plugin.
 *
 * @return array An array of WP_Post objects.
 */
function ppo_get_featured_posts() {
    /**
     * Filter the featured posts to return in Twenty Fourteen.
     *
     * @param array|bool $posts Array of featured posts, otherwise false.
     */
    return apply_filters( 'ppo_get_featured_posts', array() );
}

/**
 * A helper conditional function that returns a boolean value.
 *
 * @return bool Whether there are featured posts.
 */
function ppo_has_featured_posts() {
    return ! is_paged() && (bool) ppo_get_featured_posts();
}