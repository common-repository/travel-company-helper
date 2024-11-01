<?php
/**
 * Register `Service` post type
 */
function custom_post_type() {
	
	// Service Labels
	$service_labels = array(
		'name' => __("Service", 'travel-company-helper'),
		'singular_name' => __("Service", 'travel-company-helper'),
		'menu_name' => 'Services',
		'add_new' => __("Add New", 'travel-company-helper'),
		'add_new_item' => __("Add New Service",'travel-company-helper'),
		'edit_item' => __("Edit Service",'travel-company-helper'),
		'new_item' => __("New Service",'travel-company-helper'),
		'view_item' => __("View Service",'travel-company-helper'),
		'search_items' => __("Search Services",'travel-company-helper'),
		'not_found' =>  __("No Service Found",'travel-company-helper'),
		'not_found_in_trash' => __("No Service Found in Trash",'travel-company-helper'),
		'parent_item_colon' => '',
	);

	// Service Arguments
	$service_args = array(
		'labels' => $service_labels,
		'public' => true,
		'has_archive' => true,
		'show_in_menu'		=> true,
		'menu_position' => 8,
		'exclude_from_search' => false,
		'menu_icon'	=> 'dashicons-admin-page',
		'rewrite' => false,
		'supports' => array('title', 'editor', 'thumbnail'),
		'taxonomies' => array('service_categories','post_tag')
	);
	// Register post type
	register_post_type( 'service' , $service_args );
}

add_action( 'init', 'custom_post_type');

function travel_company_service_taxonomy() {  
    register_taxonomy(  
        'service_categories', 
        'service',        //post type name
        array(  
            'hierarchical' => true,  
            'label' => 'Category',
            'query_var' => true
        )  
    );  
}  

add_action( 'init', 'travel_company_service_taxonomy');

/*
* Load metabox admin styles
*/
function load_metabox_admin_styles(){
	wp_enqueue_style( 'metabox-style', plugins_url().'/assets/css/meta-box.css' );
}

add_action( 'admin_enqueue_scripts','load_metabox_admin_styles');

// Service Meta Box
require_once('metabox/travel-company-service-meta-boxes.php');

