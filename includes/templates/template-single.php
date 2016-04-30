
<?php

/**
 * @author Bill Minozzi
 * @copyright 2016
 */


$my_theme =  strtolower(wp_get_theme());


if ($my_theme == 'twenty fourteen')
{
?>
<style type="text/css">
<!--
	.site::before {
    width: 0px !important;
}
-->
</style>
<?php 
}


 get_header(); 
 ?>
	    <div id="container2">     
            <div id="content2" role="main">
				<?php boat_detail ();
                
                $bd_my_contact_page = trim(get_option('bd_my_contact_page', ''));
                
                if( !empty($bd_my_contact_page))
                
                {
                echo '<center>';
                echo '<button onClick="parent.location.href=\''.$bd_my_contact_page.'\'" type="submit">';
                echo __('Contact Us', 'boatdealer');
                echo '</button> <br /> </center>';
                } ?>
                
			</div> 
            
		</div>
<?php 



$sidebar_search_page_result = get_option('sidebar_search_page_result', 'yes');

if($sidebar_search_page_result == 'yes')
   {

        $registered_sidebars = wp_get_sidebars_widgets();
        foreach( $registered_sidebars as $sidebar_name => $sidebar_widgets ) {
        	if( $sidebar_name != 'wp_inactive_widgets' ) unregister_sidebar( $sidebar_name );
        }

}



get_footer(); 


?>
