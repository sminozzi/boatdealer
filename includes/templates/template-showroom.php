<?php 
/**
 * @author Bill Minozzi
 * @copyright 2016
 */
 
function show_boats($atts) { 
    
    if(isset($atts['option']))
        {$bd_option = trim($atts['option']);}
    else
        {$bd_option =  '';}
        
  
 	$output = '<div id="boat_content">';
    
                    
    if (!isset($_GET['submit'])) {
        $_GET['submit'] = '';
    }
    else
      $submit = $_GET['submit'];

    if (isset($_GET['post_type'])) {
        $post_type = $_GET['post_type'];
    }
    

    if (isset($_GET['postNumber'])) {
        $postNumber = $_GET['postNumber'];
    }
    
    
    if( empty($postNumber))
      {$postNumber = get_option('bd_quantity', 6);}
 
    $output .= bd_search (1);
     
        if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } elseif (get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }
        
        
       global $wp_query;
       wp_reset_query();
                
        if (isset($submit)) {

            require_once(BDPATH.'includes/search/search_get_par.php');
                
            $args = array(
                'post_type' => 'boats',
                'showposts' => $postNumber,
                'paged' => $paged,
                'meta_query' => array(
                    array($yearKey => $yearName, $yearVal => $year),
                    array(
                        'key' => 'boat-price',
                        'value' => array($priceMin, $priceMax),
                        'type' => 'numeric',
                        'compare' => 'BETWEEN'),
                    array($conKey => $conName, $conVal => $con),
                    ),
                );
        } else {
        
           
            $args = array(
                'post_type' => 'boats',
                'showposts' => $postNumber,
                'paged' => $paged,
                'order' => 'DESC'); 
        
        }      
           

        $wp_query = new WP_Query($args);
       
        $qposts = $wp_query->post_count;
        
        $ctd = 0;
        

        $output .= '<div class="boatGallery">';
        $output .= '<div class="bd_container">';  
        
        
        while ($wp_query->have_posts()):
            $wp_query->the_post();
            $ctd++;
            $image_id = get_post_thumbnail_id();
            $image_url = wp_get_attachment_image_src($image_id, 'medium', true);
            $price = get_post_meta(get_the_ID(), 'boat-price', true);
            if (!empty($price))
                 {$price =   number_format_i18n($price,0);}
            $image = str_replace("-" . $image_url[1] . "x" . $image_url[2], "", $image_url[0]);
            $thumb = theme_thumb($image, 800, 400, 'br'); // Crops from bottom right 
            $hp = get_post_meta(get_the_ID(), 'boat-hp', true);
            $year = get_post_meta(get_the_ID(), 'boat-year', true);
            
            
            
            $output .= '<div>';
            $output .=  '<a href="' . get_permalink() . '">';
            $output .= '<div class="bd_gallery_2016">';
            $output .=  '<img class="bd_caption_img" src="' . $thumb .'" alt="'. get_the_title() . '" />';
            
            
            $output .= '<div class="bd_caption_text">';
            $output .= ($price <> '' ? currency() . $price : __('Call for Price', 'boatdealer'));
            $output .= '<br />';
            $output .= ($hp <> '' ? $hp .' Hp <br />' : '');
            $output .= ($year <> '' ? __('Year', 'boatdealer') .': '. $year : '');
            $output .= '</div>';
            $output .= '<div class="boatTitle">' . get_the_title() . '</div>';
      
           $output .= '</a>';             
            
            $output .= '</div>';
            

            $output .= '</div>';       
             
             
            if ($ctd < $qposts) {
                if ($ctd % 3 == 0) {
                    $output .= '</div>';
                    $output .= '<div class="bd_container">';
                }
            }
            
        endwhile;
      
        
        $output .= '</div>'; 

        $output .= '<div class="boat_navigation">';
        
        $output .= '';
        ob_start();

          the_posts_pagination( array(
        	'mid_size' => 2,
        	'prev_text' => __( 'Back', 'textdomain' ),
        	'next_text' => __( 'Onward', 'textdomain' ),
        ) );


        $output .= ob_get_contents();
        ob_end_clean();   
         
        $output .= '</div>';
        $output .= '</div>';
        
       wp_reset_postdata(); 
       wp_reset_query(); 
       
      if($qposts < 1)
       { $output .=  '<h4>' . __('Not Found !') .'</h4>' ;}
       
      return $output;

}

 add_shortcode( 'boat_dealer', 'show_boats' );

?>