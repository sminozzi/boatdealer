<?php

/**
 * @author Bill Minozzi
 * @copyright 2016
 */

   
remove_shortcode('gallery');
add_shortcode('gallery', 'bd_parse_gallery_shortcode');


function bd_parse_gallery_shortcode($atts) {
 
    wp_register_script( 'flexslider', get_bloginfo('wpurl').'/wp-content/plugins/boatdealer/includes/gallery/js/jquery.flexslider-min.js', array('jquery'), null, false);
 	wp_enqueue_script('flexslider');

    global $post;
    
    if(count($atts) < 1)return;
    if( empty($atts['ids'])) return;
    
   
    $ids = $atts['ids'];
    $include = $atts['ids'];
    $orderby = 'menu_order ASC, ID ASC';
    $id = $post->ID;
    $itemtag = 'dl';
    $iconta = 'dt';
    $captiontag = 'dd';
    $columns = 3;
    $size = 'big';
    $link = 'file';
    
    $args = array(
        'post_type' => 'attachment',
        'post_status' => 'inherit',
        'post_mime_type' => 'image',
        'orderby' => $orderby
    );
 
    if ( !empty($include) )
        $args['include'] = $include;
    else {
        $args['post_parent'] = $id;
        $args['numberposts'] = -1;
    }
 
    $images = get_posts($args);

    echo '<div class="bd1_slider_container">';
    echo '<div class="bd1_slider">';

    echo '<section class="slider">';
      
    echo '<div class="flexslider">';
    
    echo '<ul class="slides">';
  
     
    foreach ( $images as $image ) {     
        $caption = $image->post_excerpt;
 
        $description = $image->post_content;
        if($description == '') $description = $image->post_title;
 
        $image_alt = get_post_meta($image->ID,'_wp_attachment_image_alt', true);
 
         echo '<li>'.wp_get_attachment_link($image->ID, $size).'</li>'; 
         
    }
    
    echo '</ul>';
    
    echo '</section>';    
    
    echo '</div>';
    echo '</div>';
    echo '</div>';
  

?>
  	<script type="text/javascript">
    
		$(window).load(function() {
		  	$('.flexslider').flexslider();
            }); 
	</script>  

<?php    
}
?>
