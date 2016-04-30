<?php 

/**
 * @author Bill Minozzi
 * @copyright 2016
 */

function bd_search($is_show_room) {
     global $postNumber, $wp, $post, $page_id;
     

    
$my_title = __("Search", 'boatdealer');

if (!isset($_GET['meta_year']))
{
   $_GET['meta_year'] = ''; 
}
if (!isset($_GET['meta_price']))
{
   $_GET['meta_price'] = ''; 
}
if (!isset($_GET['meta_con']))
{
   $_GET['meta_con'] = ''; 
}
if (!isset($_GET['postNumber']))
{
   $_GET['postNumber'] = ''; 
}


if ($is_show_room == '0')
{


  // $output  .=  '<div class="bd-search-span">'.$my_title.'</div>'; 
   $searchlabel = 'search-label-widget';
   $selectboxmeta = 'select-box-meta-widget';
   $selectbox = 'select-box-widget'; 
   $inputbox = 'input-box-widget'; 
   $searchItem = 'searchItem-widget';
   $searchItem2 = 'searchItem2-widget';
   $bdsubmitwrap = 'bd-submitBtn-widget';
   $bd_search_box = 'bd-search-box-widget';
   $current_page_url  = esc_url( home_url().'/bd_show_room_2/');
   $bd_search_type = 'search-widget';
   
}
elseif($is_show_room == '1')
{
    
  
  //   $output  .=  '<h2>'.$my_title.'</h2>'; 

    $searchlabel = 'search-label'; 
    $selectboxmeta = 'select-box-meta'; 
    $selectbox = 'select-box'; 
    $inputbox = 'input-box'; 
    $searchItem = 'searchItem';
    $searchItem2 = 'searchItem2';
    $bdsubmitwrap = 'bd-submitBtn';
    $bd_search_box = 'bd-search-box';
    $current_page_url  = home_url( esc_url( add_query_arg( NULL, NULL ) ) );
    $bd_search_type = 'page';
}

elseif($is_show_room == '2')
{
    
  
  //   $output  .=  '<h2>'.$my_title.'</h2>'; 

    $searchlabel = 'search-label'; 
    $selectboxmeta = 'select-box-meta'; 
    $selectbox = 'select-box'; 
    $inputbox = 'input-box'; 
    $searchItem = 'searchItem';
    $searchItem2 = 'searchItem2';
    $bdsubmitwrap = 'bd-submitBtn';
    $bd_search_box = 'bd-search-box';
    $current_page_url  = esc_url( home_url().'/bd_show_room_2/');
    $bd_search_type = 'search-widget';
}


$output ='<div class="'.$bd_search_box.'">';



$output .='<div class="bd-search-cuore"><div class="bd-search-cuore-fields">
		<form method="get" id="searchform3" action="'.$current_page_url.'">';
      

if( isset($page_id))        
   {if( $page_id <> '0')
        {$output .='        <input type="hidden" name="page_id" value="'.$page_id.'" />';
    }}
    
        
$output .='			<div class="'.$searchItem.'">
						<span class="'.$searchlabel.'">' . __('Price', 'boatdealer') . ':</span> 
						<select class="'.$selectbox.'" name="meta_price">
							<option '.(($_GET['meta_price'] == '') ? 'selected="selected"' : '' ).' value =""> ' . __('Any', 'boatdealer') . ' </option>
							<option '.(($_GET['meta_price'] == '1') ? 'selected="selected"' : '' ).'  value ="1"> 0-10,000 </option>
							<option '.(($_GET['meta_price'] == '2') ? 'selected="selected"' : '' ).'  value ="2"> 10,000-20,000</option>
							<option '.(($_GET['meta_price'] == '3') ? 'selected="selected"' : '' ).'  value ="3"> 20,000-30,000 </option>
							<option '.(($_GET['meta_price'] == '4') ? 'selected="selected"' : '' ).'  value ="4"> 30,000-50,000</option>
							<option '.(($_GET['meta_price'] == '5') ? 'selected="selected"' : '' ).'  value ="5"> 50,000-75,000 </option>
							<option '.(($_GET['meta_price'] == '6') ? 'selected="selected"' : '' ).'  value ="6"> 75,000-100,000 </option>
							<option '.(($_GET['meta_price'] == '7') ? 'selected="selected"' : '' ).'  value ="7"> 100,000-125,000 </option>
							<option '.(($_GET['meta_price'] == '8') ? 'selected="selected"' : '' ).'  value ="8"> 125,000-150,000 </option>
							<option '.(($_GET['meta_price'] == '9') ? 'selected="selected"' : '' ).'  value ="9"> 150,000-200,000 </option>
							<option '.(($_GET['meta_price'] == '10') ? 'selected="selected"' : '' ).'  value ="10"> 200,000+ </option>
						</select> 
					</div>';
			 $output .= ' 
					<div class="'.$searchItem2.'">
						<span class="'.$searchlabel.'">' . __('Year', 'boatdealer') . ':</span> 
                        <select class="'.$selectboxmeta.'" name="meta_year">
							<option '.(($_GET['meta_year'] == '') ? 'selected="selected"' : '' ).' value =""> ' . __('Any', 'boatdealer') . ' </option>';
                               $_year = date("Y");
                               $w = 50;                     
                               for($i = 0; $i <= $w; $i++)
                               {
                    
                                $year = $_year - $i;
                                $output .= '<option ';
                                $output .= (($_GET['meta_year'] == $year) ? 'selected="selected"' : '' );
                                $output .= 'value ="';
                                $output .= $year;
                                $output .= '">';
                                $output .= $year;
                                $output .= '</option>';
                               }  
                    	   	   $output .= '</select>
                               
					</div><!--end of item -->
                    
					<div class="'.$searchItem.'">
						<span class="'.$searchlabel.'">' . __('New/Used', 'boatdealer') . ':</span> 
                        <select class="'.$selectboxmeta.'" name="meta_con">
							<option '.(($_GET['meta_con'] == '') ? 'selected="selected"' : '' ).' value =""> ' . __('Any', 'boatdealer') . ' </option>
							<option '.(($_GET['meta_con'] == 'New') ? 'selected="selected"' : '' ).'  value ="New"> ' . __('New', 'boatdealer') . '</option>
							<option '.(($_GET['meta_con'] == 'Used') ? 'selected="selected"' : '' ).'  value ="Used"> ' . __('Used', 'boatdealer') . '</option>
							<option '.(($_GET['meta_con'] == 'Damaged') ? 'selected="selected"' : '' ).'  value ="Damaged"> ' . __('Damaged', 'boatdealer') . '</option>

						</select>  
					</div>
					<div class="bd-submitBtnWrap"> 
						<input type="hidden" name="bd_post_type" value="boats" />
						<input type="submit" name="submit" id="'.$bdsubmitwrap.'" value=" ' . __('Search', 'boatdealer') . '" />
					</div> 
                    <!--end of item -->';
                    
          $output .= '<input type="hidden" name="postNumber" value="' .$postNumber .'" />';
          $output .= '<input type="hidden" name="bd_search_type" value="' .$bd_search_type.'" />';  
                 
                    

          $output .= '</form></div></div></div>  <!-- end of Basic -->';
          
          return $output;
         

}