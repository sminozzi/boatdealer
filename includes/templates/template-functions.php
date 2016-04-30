<?php 
/**
 * @author Bill Minozzi
 * @copyright 2016
 */
 
 function content_detail (){?>
    <div class="boat-content">
        <div id="sliderWrapper">
             <div class="featuredTitle"> 
             <?php echo __('Features', 'boatdealer');?> </div>
  			 <div class="featuredBot">
             <?php if (get_post_meta(get_the_ID(), 'boat-engine', 'true') != '') { ?>
             <div class="featuredList">             
             <span class="botBold"> <?php echo __('Engine', 'boatdealer');?>: </span><?php echo get_post_meta(get_the_ID(), 'boat-engine', 'true');?> 
             </div><!-- End of featured list --><?php } ?>
             
             
             <?php if (get_post_meta(get_the_ID(), 'boat-type', 'true') != '') { ?>
             <div class="featuredList">             
             <span class="botBold"> <?php echo __('Boat Type', 'boatdealer');?>: </span><?php echo get_post_meta(get_the_ID(), 'boat-type', 'true');?> 
             </div><!-- End of featured list --><?php } ?>
            
             <?php if (get_post_meta(get_the_ID(), 'boat-make', 'true') != '') { ?>
             <div class="featuredList">             
             <span class="botBold"><?php echo __('Make', 'boatdealer');?>: </span><?php echo get_post_meta(get_the_ID(), 'boat-make', 'true');?> 
             </div><!-- End of featured list --><?php } ?>
             
             <?php if (get_post_meta(get_the_ID(), 'boat-fuel', 'true') != '') { ?>
             <div class="featuredList">             
             <span class="botBold"><?php echo __('Fuel Type', 'boatdealer');?>: </span><?php echo get_post_meta(get_the_ID(), 'boat-fuel', 'true');?> 
             </div><!-- End of featured list --><?php } ?>
             
             <?php if (get_post_meta(get_the_ID(), 'boat-fuel-capacity', 'true') != '') { ?>
             <div class="featuredList">             
             <span class="botBold"><?php echo __('Fuel Capacity', 'boatdealer');?> (<?php echo get_option('bd_liter', 'Liters')?>): </span><?php echo get_post_meta(get_the_ID(), 'boat-fuel-capacity', 'true');?> 
             </div><!-- End of featured list --><?php } ?>           
             
             
             <?php if (get_post_meta(get_the_ID(), 'LOA-mpg', 'true') != '') { ?>
             <div class="featuredList">             
             <span class="botBold"><?php echo __('Lenght', 'boatdealer');?> (<?php echo get_option('bd_lenght', 'Feet')?>): </span><?php echo get_post_meta(get_the_ID(), 'LOA-mpg', 'true');?> 
             </div><!-- End of featured list --><?php } ?>
             
             
             
             <?php if (get_post_meta(get_the_ID(), 'boat-capacity', 'true') != '') { ?>
             <div class="featuredList">             
             <span class="botBold"> <?php echo __('Passenger Capacity', 'boatdealer');?>: </span><?php echo get_post_meta(get_the_ID(), 'boat-capacity', 'true');?> 
             </div><!-- End of featured list --><?php } ?>
             
          
            
             <?php if (get_post_meta(get_the_ID(), 'boat-int', 'true') != '') { ?>
             <div class="featuredList">             
             <span class="botBold"> <?php echo __('Interior Color', 'boatdealer');?>: </span><?php echo get_post_meta(get_the_ID(), 'boat-int', 'true');?> 
             </div><!-- End of featured list --><?php } ?>
             
             
             <?php if (get_post_meta(get_the_ID(), 'boat-mat', 'true') != '') { ?>
             <div class="featuredList">             
             <span class="botBold"> <?php echo __('Interior Material', 'boatdealer');?>: </span><?php echo get_post_meta(get_the_ID(), 'boat-mat', 'true');?> 
             </div><!-- End of featured list --><?php } ?>
             </div><!-- End of featured bot -->
             </div><!-- end of slide two -->
             <!-- <div> -->
             <div class="featuredTitle"> 
             <?php echo __('Options', 'boatdealer');?> </div>
  			 <div class="featuredBot">
             <?php function bot_taxonomy( $taxonomy ) {
					  $terms = get_the_terms( get_the_id(), $taxonomy );
                     $return = '';
					 if ( $terms ) {
						 foreach($terms as $term) {
						       $return .= '<div class="featuredList">'.$term->name.'</div>';
                            } 
					     }
					 return $return;
                   } 
                 $output = bot_taxonomy( 'features' );
                 echo $output;
             ?>
      </div> <!-- end of Slider Content --> 
      </div> <!-- end of Slider Wrapper -->          
      <?php }
      
      
      
 function content_info () { ?>
 <div class="contentInfo">
 
         <div class="boatPriceSingle">
         	<?php 
            $price = get_post_meta(get_the_ID(), 'boat-price', true);
                if (!empty($price))
                     {$price =   number_format_i18n($price,0);}
    		if ( $price <> '') {
    			echo currency().$price;
    		}else {
    		 echo __('Call for Price', 'boatdealer');	
    		}
    		?> 
         </div>
         
         <div class="boatContent">
         	<?php the_content(); ?>
         </div>   
            
         <div class="boatModel"> 
             <?php 
             $terms = get_the_terms( get_the_id(), 'model' );
        	 if ( $terms ) {
        		 $i = 1;	 
        		 foreach($terms as $term) {
        			 if ($i != 1) {$preterm = 'model';} else {$preterm = 'Make';}	 
                     $preterm = __('Model', 'boatdealer');
        			 echo '<span class="preTerm">'.$preterm. ': '. $term->name.'</span>';
        			 $i++;
        		 } 
        	 } 
             ?>
        </div>
            <div class="boatDetail">
            	<div class="botBasicRow"><span class="singleInfo"><?php echo __('Year', 'boatdealer');?>: </span> <?php echo get_post_meta(get_the_ID(), 'boat-year', 'true'); ?></div>
                <div class="botBasicRow"><span class="singleInfo"><?php echo __(get_option('bd_measure', 'Miles'), 'boatdealer')?>: </span> <?php echo get_post_meta(get_the_ID(), 'boat-miles', 'true'); ?></div>
                <div class="botBasicRow"><span class="singleInfo"><?php echo __('Cond', 'boatdealer');?>: </span> <?php echo get_post_meta(get_the_ID(), 'boat-con', 'true'); ?></div>
               <div class="botBasicRow"><span class="singleInfo">HP:&nbsp; </span> <?php echo get_post_meta(get_the_ID(), 'boat-hp', 'true'); ?></div>
            </div>
            
             <div class="boatMake"></div> 
 </div>	 
 <?php }
 

function boat_detail() {
  echo '<div class="boat-content">';
	while ( have_posts() ) : the_post(); 
     title_detail();
      content_info (); 
      ?> 
     <div class="boatcontentWrap">
	 <?php content_detail (); ?>
     </div><?php
     return;
	 endwhile; // end of the loop.
     echo '</div>';
}
function title_detail(){ ?>
    <div class="boat-detail-title">  <?php the_title(); ?> </div>
<?php }



require_once(BDPATH . "assets/php/mr_image_resize.php");
function theme_thumb($url, $width, $height=0, $align='') {

        if (get_the_post_thumbnail()=='') {
    	  	$url = BDIMAGES.'image-no-available.jpg';
		}
       return mr_image_resize($url, $width, $height, true, $align, false);
}