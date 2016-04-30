<?php 
/**
 * @author Bill Minozzi
 * @copyright 2016
 */
 
add_action('init', 'boatPosts');
function boatPosts () {
	register_post_type( 'boats', 
		array( 
			'labels' => array(
				'name' => 'Boats',
				'all_items' => 'All Boats',
				'singular_name' => 'Boats',
				'add_new_item' => 'Add Boats',
				'edit_item' => 'Edit Boats',
				'search_items' => 'Search Boats',
				'view_item' => 'View Boats',
				'not_found' => 'No Boats Found',
				'not_found_in_trash' => 'No Boats Found in Trash',
				'menu_name' => 'Boats For Sale'
			),
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'has_archive' => true,
			'supports' => array (
				'title',
				'page-attributes',
				'editor',
				'thumbnail',
			),
			'taxonomies' => array(
				'model',
				// 'make',
				'features',
			),
			'exclude_from_search' => false,
			'_builtin' => false,
			'hierarchical' => false,
			'rewrite' => array("slug" => "boat"),
		)
	);
};


add_action('init', 'bd_taxonomies');
function bd_taxonomies() { 
	register_taxonomy( 'model', 'boats', array(
			'labels' => array(
				// 'name' => _x('model', 'taxonomy general name', 'boatdealer'),
				'name' => 'Model',
				'singular_name' => 'Model',
				'search_items' => 'Search Model',
				'popular_items' => 'Popular Model',
				'all_items' => 'All Model',
				'parent_item' => __( 'Parent Model' , 'boatdealer'),
  				'parent_item_colon' => __( 'Parent Model:', 'boatdealer' ),
				'edit_item' => __( 'Edit Model', 'boatdealer' ), 
				'update_item' => __( 'Update Model', 'boatdealer' ),
				'add_new_item' => __( 'Add New Model', 'boatdealer' ),
				'new_item_name' => __( 'New Model', 'boatdealer' ),
				'separate_items_with_commas' => __( 'Separate Model with commas', 'boatdealer' ),
				'add_or_remove_items' => __( 'Add or Remove Model', 'boatdealer' ),
				'choose_from_most_used' => __( 'Choose from the most used Model', 'boatdealer' ),
				'menu_name' => 'Model' ,
			),
			'hierarchical' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'Model' ),
			'public' => true
		)
	);
  


register_taxonomy( 'features', 'boats', array(
			'labels' => array(
				// 'name' => _x('features', 'taxonomy general name', 'boatdealer'),
				'name' => 'features',
				'singular_name' => 'Features',
				'search_items' => 'Search Features',
				'popular_items' => 'Popular Features',
				'all_items' => 'All Features',
				'parent_item' => __( 'Parent Features', 'boatdealer' ),
  				'parent_item_colon' => __( 'Parent Features:' ),
				'edit_item' => __( 'Edit Features', 'boatdealer' ), 
				'update_item' => __( 'Update Features', 'boatdealer' ),
				'add_new_item' => __( 'Add New Features', 'boatdealer' ),
				'new_item_name' => __( 'New Features' , 'boatdealer'),
				'separate_items_with_commas' => __( 'Separate Features with commas', 'boatdealer' ),
				'add_or_remove_items' => __( 'Add or Remove Features' , 'boatdealer'),
				'choose_from_most_used' => __( 'Choose from the most used Features', 'boatdealer' ),
				'menu_name' => 'Features',
			),
			'hierarchical' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'Features' ),
			'public' => true
		)
	);
    

}

function custom_listing_save_data($post_id) {
    global $meta_box,  $post;
    

    if( isset($_POST['listing_meta_box_nonce']))
    {
        if (!wp_verify_nonce($_POST['listing_meta_box_nonce'], basename(__FILE__))) {
            return $post_id;
        }
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    
    if ( isset($_POST['post_type']))
     { 
        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }
    }
    
      
}
 
add_action('save_post', 'custom_listing_save_data');



add_image_size('featured_preview', 55, 55, true);
 
 // GET FEATURED IMAGE
function bd_get_featured_image($post_ID) {
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);
    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');
        return $post_thumbnail_img[0];
    }
}

// ADD NEW COLUMN
function bd_columns_head($defaults) {

    $defaults['boat-price'] = 'Price';
    $defaults['boat-featured'] = 'Featured';
    $defaults['boat-hp'] = 'HP';
    $defaults['boat-year'] = 'Year';
    $defaults['LOA-mpg'] = 'Lenght';
    $defaults['featured_image'] = 'Featured Image';
    
    return $defaults;
}
 
// SHOW THE FEATURED IMAGE
function bd_columns_content($column_name, $post_ID) {
    if ($column_name == 'featured_image') {
        $post_featured_image = bd_get_featured_image($post_ID);
        if ($post_featured_image) {
            echo '<img src="' . $post_featured_image . '" width="150px" />';
        }
        else
          {echo '<img src="/wp-content/plugins/boatdealer/assets/images/image-no-available.jpg" width="150px" />';}

    }
    elseif ($column_name == 'boat-year'){
         echo get_post_meta( $post_ID, 'boat-year', true ); 
        
    }
    elseif ($column_name == 'boat-hp'){
         echo get_post_meta( $post_ID, 'boat-hp', true ); 
        
    }
    elseif ($column_name == 'boat-price'){
         
         $price = get_post_meta( $post_ID, 'boat-price', true );
         if(! empty($price)) 
            echo  currency() . $price ; 
         else
            echo  __('Call For Price', 'boatdealer', 'boatdealer');
    }
    elseif ($column_name == 'LOA-mpg'){
         echo get_post_meta( $post_ID, 'LOA-mpg', true ); 
        
    }
    elseif ($column_name == 'boat-featured'){
         $r = get_post_meta( $post_ID, 'boat-featured', true ); 
        

         if($r == 'enabled')
           {echo 'Yes';}
         else
           {echo 'No';}

    }


}




if(isset($_GET['post_type'])){
    if ($_GET['post_type'] == 'boats')
      {
        add_filter('manage_posts_columns', 'bd_columns_head');
        add_action('manage_posts_custom_column', 'bd_columns_content', 10, 2);
      }
  }
