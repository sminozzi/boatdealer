<?php

/**
 * @author Bill Minozzi
 * @copyright 2016
 */



 function currency () {

	if (get_option('bdcurrency') == 'Dollar') {return "$";}	
	if (get_option('bdcurrency') == 'Pound') {return "&pound;";}
	if (get_option('bdcurrency') == 'Yen') {return "&yen;";}
	if (get_option('bdcurrency') == 'Euro') {return "&euro;";}
	if (get_option('bdcurrency') == 'Universal') {return "&curren;";}
	if (get_option('bdcurrency') == 'AUD') {return "AUD";}
  	if (get_option('bdcurrency') == 'Real') {return "$R";}

}


function bd_localization_init_fail() {
                     echo '<div class="error notice">
                     <br />
                     BoatDealerPlugin: Could not load the localization file (Language file).
                     <br />
                     Please, take a look the online Guide item Plugin Setup => Language.
                     <br /><br />
                     </div>';
                  
} 

function bd_theme_was_activated() {
    
                echo '<div class="updated"><p>';
                $bd_msg = '<h3>BoatDealer Plugin was activated! </h3>';
                $bd_msg .= '<h4>For details and help, take a look at Boats For Sale (settings) at your left menu <br />';
                
                $bd_url = '  <a href="edit.php?post_type=boats&page=settings">or click here</a>';
    
                $bd_msg .=  $bd_url;
                echo $bd_msg;
                echo "</p></h3></div>";
                  
}


if(is_admin())
{
    
            if(get_theme_mod('bd_was_activated', '0') == '1')
            {
                add_action( 'admin_notices', 'bd_theme_was_activated' );
                set_theme_mod('bd_was_activated', '0'); 
            } 
    
    
    add_action('admin_notices', 'boat_dealer_admin_notice');
    
    function boat_dealer_admin_notice() {
    
              $bd_track_ignore = get_theme_mod('bd_track_ignore', '0'); 
    
              if ( isset($_GET['bd_track_ignore']) ) {
                 $bd_track_ignore = esc_html($_GET['bd_track_ignore']);
                 set_theme_mod('bd_track_ignore', $bd_track_ignore);
               }   

    
        if ( $bd_track_ignore == '0'  ) {
    
            echo '<div class="updated"><p>';
            $bd_msg = 'Allow BoatDealer know you installed this plugin?';
            $bd_msg .= ' (Only the domain name information will be send). <br />';
            $bd_msg .= 'No other info neither sensitive data is tracked.';
            $bd_msg .= ' This can help us to improve the plugin.<br />'; 
            $bd_url = '  <a href="?bd_track_ignore=2"> OK </a>';
            $bd_url .= ' | <a href="?bd_track_ignore=1">No, Dismiss</a>';
            $bd_msg .=  $bd_url;
            echo $bd_msg;
            echo "</p></div>";
    
        }
        if ( $bd_track_ignore == '2'  ) {
            
                    $url = "http://BoatDealerPlugin.com/httpapi.php";
                    $domain_name =  get_site_url();
                    $urlParts = parse_url($domain_name);
                    $domain_name = preg_replace('/^www\./', '', $urlParts['host']);
                    $response = wp_remote_post( $url, array(
                    	'method' => 'POST',
                    	'timeout' => 45,
                    	'redirection' => 5,
                    	'httpversion' => '1.0',
                    	'blocking' => true,
                    	'headers' => array(),
                    	'body' => array( 
                           'domain_name' => $domain_name,
                           'version' => '1'
                           ),
                    	'cookies' => array()
                        )
                    );
                    
                    set_theme_mod('bd_track_ignore', '3');
                    
                     if ( is_wp_error( $response ) ) 
                        {
                         $error_message = $response->get_error_message();
                         echo "Something went wrong: $error_message";
                        } 
              }
    }

}   

?>