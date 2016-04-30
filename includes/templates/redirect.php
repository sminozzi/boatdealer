<?php 
/**
 * @author Bill Minozzi
 * @copyright 2016
 
 */
 

add_action("template_redirect", 'bd_template_redirect'); 
function bd_template_redirect() {
	global $wp;
	global $query;
	global $wp_query;
    


    
 if(isset($_GET['bd_search_type']))
  {
    
    if(trim($_GET['bd_search_type']) == 'search-widget')
    {

        $bd_search_type = $_GET['bd_search_type'];
        
      
        include(BDPATH.'includes/templates/template-showroom2.php');
        die(); 
     }    
  
 }   
    
 
 if(is_single())
   {
    if(have_posts())
     {include(BDPATH.'includes/templates/template-single.php');}
   }
   
   
    if(isset($wp->query_vars["bd_post_type"]))
    {
        
        if ($wp->query_vars["bd_post_type"] == "boats") {
         
            include(BDPATH.'includes/templates/template-single.php');
            die(); 
            
        } 
    }
     
 }
    
