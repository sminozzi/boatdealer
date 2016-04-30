<?php 

/**
 * @author Bill Minozzi
 * @copyright 2016
 */
 
function boatdealer_RecentWidget() {
	register_widget( 'RecentWidget' );
}
add_action( 'widgets_init', 'boatdealer_RecentWidget' );


class RecentWidget extends WP_Widget {
     
    
       public function __construct() {
        parent::__construct(
        'RecentWidget',         
        'Recent Boats',                
        array( 'description' => __('A list of Recent Boats', 'boatdealer'), ) 
        );
    }   
   
    


	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'amount' => '','Fwidth' => '','Fheight' => '') );
        if(isset($instance['Ramount']))
          {$Ramount = $instance['Ramount'];}
        else
          {$Ramount = 3;}
		echo '<p>
			<label for="'.$this->get_field_id('Ramount').'">
				Number of Boats to show: <input maxlength="1" size="1" id="'. $this->get_field_id('Ramount') .'" name="'. $this->get_field_name('Ramount') .'" type="text" value="'. esc_attr($Ramount) .'" />
			</label>
		</p>';
	}
	function update($new_instance, $old_instance) { 
		$instance = $old_instance;
        if(is_numeric($new_instance['Ramount']))
		    {$instance['Ramount'] = $new_instance['Ramount'];}
      	return $instance;
	}
	function widget($args, $instance) {
	   
       
     
       
		extract($args, EXTR_SKIP);

        
		$Ramount = empty($instance['Ramount']) ? ' ' : apply_filters('widget_title', $instance['Ramount']); 
		if($Ramount == '') {$Ramount = 3; }
        ?>
	    <div class="sideTitle"> <?php echo __('New Arrivals', 'boatdealer');?> </div><?php 
		$args = array(
			'post_type'      => 'boats',
			'order'    => 'DESC',
			'showposts' => $Ramount,
		);
        $_query3 = new WP_Query( $args );
    
    
    $output = '<div class="bd-listing-wrap"> <div class="boatGallery">';
        
        
        

        
	while ($_query3->have_posts()) : $_query3->the_post();
		$image_id = get_post_thumbnail_id();
		$image_url = wp_get_attachment_image_src($image_id,'medium', true);	
        $price = get_post_meta(get_the_ID(), 'boat-price', true);
            if (!empty($price))
                 {$price =   number_format_i18n($price,0);}
		$image = str_replace("-".$image_url[1]."x".$image_url[2], "", $image_url[0]);
		$featured = trim(get_post_meta(get_the_ID(), 'boat-featured', true));
        $thumb = theme_thumb($image, 800, 600, 'br'); // Crops from bottom right
        $hp = get_post_meta(get_the_ID(), 'boat-hp', true);
        $year = get_post_meta(get_the_ID(), 'boat-year', true);


       
  
  
            $output .= '<div>';
            $output .=  '<a href="' . get_permalink() . '">';
            $output .= '<div class="bd_gallery_2016_widget">';
            $output .=  '<img class="bd_caption_img_widget" src="' . $thumb .'" alt="'. get_the_title() . '" />';
            
            
            
            $output .= '<div class="bd_caption_text_widget">';
            $output .= ($price <> '' ? currency() . $price : __('Call for Price', 'boatdealer'));
            $output .= '<br />';
            $output .= ($hp <> '' ? $hp .' Hp <br />' : '');
            $output .= ($year <> '' ? __('Year', 'boatdealer') .': '. $year : '');
            $output .= '</div>';
            $output .= '<div class="boatTitle-widget">' . get_the_title() . '</div>';
           
            $output .= '</div>';
            
            $output .= '</a>';
            $output .= '</div>';     
        
            $output .= '<br />';        
          
 
		endwhile; 
        $output .= '</div></div>'; 
        echo $output;

	}
}



function boatdealer_FeaturedWidget() {
	register_widget( 'FeaturedWidget' );
}
add_action( 'widgets_init', 'boatdealer_FeaturedWidget' );


class featuredWidget extends WP_Widget {

    public function __construct() {
        parent::__construct(
        'FeaturedWidget',         
        'Featured Boats',                
        array( 'description' => __('A list of Featured Boats', 'boatdealer'), ) 
        );
    } 



	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'amount' => '') );
		$amount = $instance['amount'];
		echo '<p>
			<label for="'.$this->get_field_id('amount').'">
				Number of Boats to show: <input maxlength="1" size="1" id="'. $this->get_field_id('amount') .'" name="'. $this->get_field_name('amount') .'" type="text" value="'. esc_attr($amount) .'" maxlength="3" size="3" />
			</label>

		</p>';
	}
	function update($new_instance, $old_instance) { 
		$instance = $old_instance;
        
        if(is_numeric($new_instance['amount']))
		    {$instance['amount'] = $new_instance['amount'];}       
		return $instance;
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		$amount = empty($instance['amount']) ? ' ' : apply_filters('widget_title', $instance['amount']); 
		if($amount == '') {$amount = 3; }
    ?>
	
        <div class="sideTitle"> 
        <?php echo __('Featured Boats', 'boatdealer');?> 
        </div><?php 
		$args = array(
			'post_type'      => 'boats',
			'order'    => 'DESC',
			'showposts' => $amount,
			'meta_query' => array(
								array(
										'key' => 'boat-featured',
										'value' => 'enabled',
									  )
								   )
		);
        $_query2 = new WP_Query( $args );
        
        
        
        
        
		$output = '<div class="bd-listing-wrap"> <div class="boatGallery">';
		while ($_query2->have_posts()) : $_query2->the_post();
		$image_id = get_post_thumbnail_id();
		$image_url = wp_get_attachment_image_src($image_id,'medium', true);	
		$price = number_format_i18n(get_post_meta(get_the_ID(), 'boat-price', true),0);
		$image = str_replace("-".$image_url[1]."x".$image_url[2], "", $image_url[0]);
		$featured = get_post_meta(get_the_ID(), 'boat-featured', true);
        $thumb = theme_thumb($image, 800, 600, 'br'); // Crops from bottom right
        $hp = get_post_meta(get_the_ID(), 'boat-hp', true);
        $year = get_post_meta(get_the_ID(), 'boat-year', true);
		
        
            $output .= '<div>';
            $output .=  '<a href="' . get_permalink() . '">';
            $output .= '<div class="bd_gallery_2016_widget">';
            $output .=  '<img class="bd_caption_img_widget" src="' . $thumb .'" alt="'. get_the_title() . '" />';
            
            
            
            $output .= '<div class="bd_caption_text_widget">';
            $output .= ($price <> '' ? currency() . $price : __('Call for Price', 'boatdealer'));
            $output .= '<br />';
            $output .= ($hp <> '' ? $hp .' Hp <br />' : '');
            $output .= ($year <> '' ? __('Year', 'boatdealer') .': '. $year : '');
            $output .= '</div>';
            $output .= '<div class="boatTitle-widget">' . get_the_title() . '</div>';
           
            
            $output .= '</div>';
            
            $output .= '</a>';
            $output .= '</div>';     
        
            $output .= '<br />';
        
        
        
        endwhile; 
        $output .= '</div></div>'; 
        echo $output;
        

	}
    
 
    
}


 
add_action( 'widgets_init', create_function('', 'return register_widget("SearchWidget");') );
class SearchWidget extends WP_Widget {

    
    
public function __construct() {
        parent::__construct(
        'SearchWidget',         
        'Search Boats',                
        array( 'description' => __('Search Boats', 'boatdealer'), ) 
        );
}     
    
    
    
    
	function SearchWidget()	{
		$widget_ops = array('classname' => 'SearchWidget', 'description' => 'Search Cars' );
		$this->WP_Widget('SearchWidget', 'Search Widget', $widget_ops);
	}
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'bd_search_name' => '') );
		$bd_search_name = $instance['bd_search_name'];
		echo '<p>
			<label for="'.$this->get_field_id('bd_search_name').'">';
				echo __('Title', 'boatdealer');
                echo ': <input class="widefat" id="'. $this->get_field_id('bd_search_name') .'" name="'. $this->get_field_name('bd_search_name') .'" type="text" value="'. esc_attr($bd_search_name) .'" />
			</label>
		</p>';
	}
	function update($new_instance, $old_instance) { 
		$instance = $old_instance;
		$instance['bd_search_name'] = $new_instance['bd_search_name'];
		return $instance;
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
        
        
		$bd_search_name = empty($instance['bd_search_name']) ? ' ' : apply_filters('widget_title', $instance['bd_search_name']); 
		if(trim($bd_search_name) == '') {$bd_search_name = __('Search', 'boatdealer'); }        
        

        
        echo '<div class="sideTitle">';
        echo $bd_search_name;
        echo '</div>';        

		echo bd_search(0);

	}   
    
}


