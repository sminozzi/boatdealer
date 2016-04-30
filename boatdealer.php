<?php /*
Plugin Name: BoatDealer 
Plugin URI: http://boatdealerplugin.com
Description: The easiest way to manage, list and sell your boats online.
Version: 1.42
Text Domain: boatdealer
Domain Path: /language
Author: Bill Minozzi
Author URI: http://boatdealerplugin.com
License:     GPL2
Copyright (c) 2016 Bill Minozzi

 
BoatDealer is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
BoatDealer is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with BoatDealer. If not, see {License URI}.


Permission is hereby granted, free of charge subject to the following conditions:

The above copyright notice and this FULL permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
DEALINGS IN THE SOFTWARE.
*/


if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


define('BDVERSION', '1.42' );
define('BDPATH', plugin_dir_path(__file__) );
define('BDURL', plugin_dir_url(__file__));
define('BDIMAGES', plugin_dir_url(__file__).'assets/images/');


if(is_admin())
    {
        if(isset($_GET['post_type'])){
            if ($_GET['post_type'] == 'boats')
              {
                  $path = dirname(plugin_basename( __FILE__ )) . '/language/';
                  $loaded = load_plugin_textdomain( 'boatdealer', false, $path);
                  if (!$loaded AND get_locale() <> 'en_US') {  
                       add_action( 'admin_notices', 'bd_localization_init_fail' );
                  }
              }
        }
    } 
else
    {
             add_action( 'plugins_loaded', 'bd_localization_init' );

    }    

        
function bd_localization_init() {
    $path = dirname(plugin_basename( __FILE__ )) . '/language/';
    $loaded = load_plugin_textdomain( 'boatdealer', false, $path);
    
} 
    
function BoatDealer_plugin_settings_link($links) { 
  $settings_link = '<a href="edit.php?post_type=boats&page=settings">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}
 
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'BoatDealer_plugin_settings_link' );


require_once (BDPATH. "settings/load-plugin.php");

require_once (BDPATH. "settings/options/plugin_options_tabbed.php");

require_once(BDPATH.'includes/help/help.php');

require_once(BDPATH.'includes/functions/functions.php'); 
    
require_once(BDPATH.'includes/post-type/meta-box.php'); 

require_once(BDPATH.'includes/post-type/post-functions.php'); 

require_once(BDPATH.'includes/templates/template-functions.php');
 
require_once(BDPATH.'includes/templates/redirect.php'); 

require_once(BDPATH.'includes/widgets/widgets.php');

require_once(BDPATH.'includes/search/search-function.php'); 

require_once(BDPATH.'includes/templates/template-showroom.php');

$bd_overwrite_gallery = strtolower(get_option('bd_overwrite_gallery', 'yes'));

if($bd_overwrite_gallery == 'yes')
   {
     require_once(BDPATH.'includes/gallery/gallery.php');
   }

              
add_action( 'wp_enqueue_scripts', 'bd_add_stylesheet' );

    function bd_add_stylesheet() {
      wp_enqueue_style( 'show-room' , get_bloginfo('wpurl').'/wp-content/plugins/boatdealer/includes/templates/show-room.css');
      wp_enqueue_style( 'pluginStyleGeneral' , get_bloginfo('wpurl').'/wp-content/plugins/boatdealer/includes/templates/template-style.css');
      wp_enqueue_style( 'pluginStyleSearch2' , get_bloginfo('wpurl').'/wp-content/plugins/boatdealer/includes/search/style-search-box.css');
      wp_enqueue_style( 'pluginStyleSearch3' , get_bloginfo('wpurl').'/wp-content/plugins/boatdealer/includes/widgets/style-search-widget.css');
      wp_enqueue_style( 'pluginStyleGeneral4' , get_bloginfo('wpurl').'/wp-content/plugins/boatdealer/includes/gallery/css/flexslider.css');
    } 
    

    
if(! is_admin())
{
    function bd_modify_jquery() {
        if ( !is_admin() ) {
            ob_start();
            wp_deregister_script( 'jquery' );
            ob_end_clean(); 
            wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js', false, '2.2.2' );
            wp_enqueue_script( 'jquery' );
        }
   }

    add_action( 'init', 'bd_modify_jquery' );

    function bd_activated() {

      set_theme_mod('bd_was_activated', '1');
    }
    register_activation_hook( __FILE__, 'bd_activated' );
    
}
?>