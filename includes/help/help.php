<?php

/**
 * @author Bill Minozzi
 * @copyright 2016
 */


if(is_admin())
{
    if(isset($_GET['post_type'])){
        if ($_GET['post_type'] == 'boats')
          {
              add_filter('contextual_help', 'bd_contextual_help', 10, 3);
    
          }
    }
  
}  


function bd_contextual_help($contextual_help, $screen_id, $screen)
{

    $myhelp = '<br> The easiest way to manage, list and sell your boats online.';
    $myhelp .= '<br />';
    
    $myhelp .= 'Take a look at our Start Up Guide <a href="/wp-admin/edit.php?post_type=boats&page=settings" target="_self">here.</a>';
    $myhelp .= '<br />';
    $myhelp .= 'You can find also our complete OnLine Guide  <a href="http://boatdealerplugin.com/guide/" target="_self">here.</a>';

     
    $screen->add_help_tab(array(
        'id' => 'bd-overview-tab',
        'title' => __('Overview', 'boatdealer'),
        'content' => '<p>' . $myhelp . '</p>',
        ));
    return $contextual_help;
} 



?>