<?php 

define( 'TEMPLATE_URL', get_template_directory_uri() );
define( 'DOMAIN', 'marpan' );

/* theme */

add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style' ) );

register_nav_menus( array(
	'header'   => 'Header',
	'footer'   => 'Footer',
	'services' => 'Services',
) );

add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );

// add_theme_support( 'widgets' );
// add_action( 'widgets_init', 'marpan_register_widgets' );
// function marpan_register_widgets() {
	// register_sidebar( array(
		// 'name'         => 'Footer',
		// 'id'           => 'sidebar-footer',
		// 'before_title' => '<div class="widgettitle">',
		// 'after_title'  => '</div>',
	// ));
// }

add_image_size( 'marpan-promo', 1920, 405, true );
add_image_size( 'marpan-modal', 428, 444, true );
add_image_size( 'marpan-full-hd', 1920, 1080, false );

// add_post_type_support( 'page', 'excerpt' );
// function marpan_excerpt_length( $length ){
    // return INF;
// }
// add_filter( 'excerpt_length', 'marpan_excerpt_length', 999 );

add_filter( 'use_default_gallery_style', '__return_false' );
add_filter( 'show_admin_bar', '__return_false' );

add_filter( 'big_image_size_threshold', '__return_false' );

/* content */

remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');

/* clear head */

function marpan_disable_emoji() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action('init', 'marpan_disable_emoji');

remove_action( 'wp_head', 'feed_links_extra', 3 ); 
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); 
remove_action( 'wp_head', 'adjacent_pomarpan_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_pomarpan_rel_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );
remove_action( 'wp_head', 'wp_resource_hints', 2 );
add_filter(
	'template_redirect',
	function() {
		if( is_page() ){
			remove_action( 'wp_head', 'rel_canonical' );
		}
	}
);
add_filter( 'the_generator', '__return_empty_string' );

/* scripts */

add_action( 'wp_footer', 'marpan_deregister_scripts' );
function marpan_deregister_scripts() {
	wp_deregister_script( 'wp-embed' );
}

add_action( 'wp_enqueue_scripts', 'marpan_enqueue_scripts' );
function marpan_enqueue_scripts() {
	wp_enqueue_style( 'styles', TEMPLATE_URL . '/css/styles.css' );
	
	wp_deregister_script( 'jquery-core' );
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery-core', TEMPLATE_URL . '/js/jquery.min.js', false, null, true );
	wp_register_script( 'jquery', false, array('jquery-core'), null, true );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'scripts', TEMPLATE_URL . '/js/scripts.js', array('jquery-core'), false, true );
}

add_action( 'admin_enqueue_scripts', 'marpan_admin_enqueue_scripts' );
function marpan_admin_enqueue_scripts() {
	wp_enqueue_style( 'styles-admin', TEMPLATE_URL . '/css/admin.css' );
	wp_enqueue_script( 'scripts-admin', TEMPLATE_URL . '/js/admin.js', array( 'jquery-core', 'carbon-fields-vendor' ), false, true );
}

/* email */

add_filter( 'wp_mail_content_type', 'marpan_wp_mail_content_type' );
function marpan_wp_mail_content_type( $content_type ) {
	return 'text/html';
}

add_filter( 'wp_mail_from', 'marpan_mail_from' );
function marpan_mail_from( $original_email_address ) {
	return get_bloginfo('admin_email');
}

add_filter( 'wp_mail_from_name', 'marpan_mail_from_name' );
function marpan_mail_from_name( $original_email_from ) {
	return get_bloginfo('name');
}

/* languages */

// add_action( 'after_setup_theme', 'marpan_load_theme_textdomain' );
 
// function marpan_load_theme_textdomain() {
	// load_theme_textdomain( DOMAIN, TEMPLATEPATH . '/languages' );
// }

/* admin menu */

add_action( 'admin_menu', function() {
	remove_menu_page( 'upload.php' );
	add_menu_page( __('Библиотека файлов'), __('Медиафайлы'), 'manage_options', 'upload.php', '', 'dashicons-admin-media', 24 ); 
});

?>