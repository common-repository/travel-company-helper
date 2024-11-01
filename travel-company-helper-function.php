<?php

/*
* Function to list Popular trips
*/
function travel_company_helper_track_post_views($postId) {
    if (!is_single())
        return;
    if (empty($postId)) {
        global $post;
        $postId = $post->ID;
    }

    travel_company_helper_set_post_views($postId);
}

add_action('wp_head', 'travel_company_helper_track_post_views');

function travel_company_helper_set_post_views($postID) {
    $count_key = 'travel_company_helper_track_post_views';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

//To keep the count accurate, lets get rid of prefetching
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

/*
* Function to list post categories in customizer options
*/
 function travel_company_helper_get_categories( $select = true, $taxonomy = 'category', $slug = false ){
        
        /* Option list of all categories */
        $categories = array();
        if( $select ) $categories[''] = __( 'Choose Category', 'travel-company-helper' );
        
        if( taxonomy_exists( $taxonomy ) ){
            $args = array( 
                'hide_empty' => false,
                'taxonomy'   => $taxonomy 
            );
            
            $catlists = get_terms( $args );
            
            foreach( $catlists as $category ){
                if( $slug ){
                    $categories[$category->slug] = $category->name;
                }else{
                    $categories[$category->term_id] = $category->name;    
                }        
            }
        }
        return $categories;
    }
   