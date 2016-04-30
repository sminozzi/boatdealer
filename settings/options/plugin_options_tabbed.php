<?php 
/**
 * @author Bill Minozzi
 * @copyright 2016
 */
namespace BoatDealer\WP\Settings;

$mypage = new Page('Settings', array('type' => 'submenu2', 'parent_slug' => 'my-menu'));
   
$settings = array();


$msg = '<big>
<p><b>'.
__('Thanks for install Boat Dealer Plugin. The easiest way to manage, list and sell your boats online.', 'boatdealer')
.'<br /><br />
</b><font size="4">'.
__('Follow this steps', 'boatdealer')
.':</p>
<p>&nbsp;</p>
<p>1.'.
__(' Go to Boat Settings tab and choose your currency, metric system etc...', 'boatdealer')
.' </font></p>
<p>&nbsp;</p>

<p><font size="4">2.'. 
__('Go to your Pages and chose one (or more) page where you want show the boats. ', 'boatdealer')
.'</font></p>
<br />'.
__('Paste this shortcode there', 'boatdealer') 
.':&nbsp; &nbsp;  <b> [boat_dealer] </b>
<p>'.
__('Click Update to Save', 'boatdealer')
.'</p>

<p>&nbsp;</p>
<p><font size="4">3. '.
__('Go to Model and Add some models', 'boatdealer')
.'</font></p>
<p>
Dashboard =&gt; Boats For Sale  =&gt; Model
</p>
<p>'.
__('For example ', 'boatdealer')
.'</p>
<p>a)'. 
__('Sport', 'boatdealer')
.'</p>
<p>b)'. 
__('Fishing', 'boatdealer')
.'</p>
<p>'.
__('and so on...', 'boatdealer')
.'</p>
<p>&nbsp;</p>
<p><font size="4">4.'. 
__('Go to Features and Add some', 'boatdealer')
.'</font></p>
<p>
Dashboard =&gt; Boats For Sale =&gt; Features
</p>
<p>'.
__('For example', 'boatdealer') 
.'</p>
<p>a)'. 
__('Cabin', 'boatdealer')
.'</p>
<p>b) '.
__('Bathroom', 'boatdealer')
.'</p>
<p>'.
__('and so on...', 'boatdealer')
.'</p>
<p>&nbsp;</p>

<p><font size="4">
5. '.
__('Go to Boats for Sale and Choose Add New', 'boatdealer')
.'</font></p>
<p>
Dashboard =&gt; Boats For Sale =&gt;Add New
</p>
<p>'.
__('Fill Out all info', 'boatdealer')
.'</p>
<p>'.
__('Add one Featured Image', 'boatdealer')
.'.</p>

<p>

<strong>'.
__('Load images ', 'boatdealer')
.':</strong>
<br />'.
__('Just create one wordpress gallery. Our plugin will create automatically one nice slider gallery.
For details how to create a wordpress gallery, check the wordpress site.', 'boatdealer')
.'
</p>


<p>'.
__('Click Publish to Save.', 'boatdealer')
.'</p>



<p>&nbsp;</p>
<p><font size="4">6. '. 
__('We have 3 dedicated Widgets', 'boatdealer')
.':</font></p>
<ul>
  <li>'.
__('  Recent Boats', 'boatdealer')
.'  </li>
  <li>' .
__('Featured Boats', 'boatdealer')
.'  </li>
  <li>' .
__('Boats Search', 'boatdealer')
.'  </li>
</ul>
<p>'.
__('To install, just go to ', 'boatdealer')

.'Dashboard=&gt; Appearance=&gt; Widgets '. 

__('and install them', 'boatdealer')
.'.</p>
<p>&nbsp;</p>
<p><font size="4">';

$msg .= 
__("That's all. I hope you enjoy it ", 'boatdealer') ;

$msg .= '.</p> </big>' ;


$settings['StartUp Guide']['StartUp Guide'] = array('info' => $msg );
$fields = array();
 
       
$settings['StartUp Guide']['StartUp Guide']['fields'] = $fields;



$settings['Boat Settings']['Boat Settings'] = array('info' => __('Choose your currency, metric system and so on.','boatdealer'));
$fields = array();


$fields[] = array(
	'type' 	=> 'select',
	'name' 	=> 'bdcurrency',
	'label' => __('Currency', 'boatdealer'),
	'select_options' => array(
		array('value'=>'Dollar', 'label' => 'Dollar'),
		array('value'=>'Euro', 'label' => 'Euro'),
		array('value'=>'AUD', 'label' => 'Australian Dollar'),
		array('value'=>'Pound', 'label' => 'Pound'),
		array('value'=>'Real', 'label' => 'Brazil Real'),
		array('value'=>'Yen', 'label' => 'Yen'),
		array('value'=>'Universal', 'label' => 'Universal')     
		)			
	);
    
    $fields[] = array(
	'type' 	=> 'select',
	'name' 	=> 'bd_measure',
	'label' => __('Miles - Km - Hours','boatdealer'),
	'select_options' => array(
		array('value'=>'Miles', 'label' => __('Miles', 'boatdealer')),
		array('value'=>'Kms', 'label' => __('Kms', 'boatdealer')),
		array('value'=>'Hours', 'label' => __('Hours', 'boatdealer'))
		)			
	);
    
    
    $fields[] = array(
	'type' 	=> 'select',
	'name' 	=> 'bd_liter',
	'label' => __('Liters - Gallons','boatdealer'),
	'select_options' => array(
		array('value'=>'Liters', 'label' => __('Liters', 'boatdealer')),
		array('value'=>'Gallons', 'label' => __('Gallons', 'boatdealer')),
		)			
	);
    
    
    $fields[] = array(
	'type' 	=> 'select',
	'name' 	=> 'bd_lenght',
	'label' => __('Feet - Meters','boatdealer'),
	'select_options' => array(
		array('value'=>'Feet', 'label' => __('Feet', 'boatdealer')),
		array('value'=>'Meters', 'label' => __('Meters', 'boatdealer') ),
		)			
	);
    
	$fields[] =	array(
            	'type' 	=> 'select',
				'name' => 'bd_quantity',
				'label' => __('How many boats would you like to display per page?', 'boatdealer'),
				'select_options' => array (
                		array('value'=>'3', 'label' => '3'),
	                	array('value'=>'6', 'label' => '6'),
                		array('value'=>'9', 'label' => '9'),
	                	array('value'=>'12', 'label' => '12'),
                		array('value'=>'15', 'label' => '15'),
	                	array('value'=>'18', 'label' => '18'),
	         	)
 	); 
    
 
$fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'sidebar_search_page_result',
	'label' => __('Remove Sidebar from Search Result Page').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),

		)			
	);
 
 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'bd_overwrite_gallery',
	'label' => __('Replace the Wordpress Gallery with Flexslider Gallery').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),

		)			
	);   
    

$fields[] = array(
	'type' 	=> 'text',
	'name' 	=> 'bd_my_contact_page',
	'label' => __('Fill out your contact page URL if you want a Contact Us button at bottom of the individual boat page' ,'boatdealer').
    '.<br />example:<br />http://mysite.com/contact'
	); 
    
 
       
$settings['Boat Settings']['Boat Settings']['fields'] = $fields;

     

 

$msg = __('Where is the updated OnLine Manual?', 'boatdealer');
$msg .= '<br />';
$msg .= '<a href="http://boatdealerplugin.com/guide/" target="_self">http://boatdealerplugin.com/guide/</a>';

$msg .= '<br />';$msg .= '<br />';

$msg .= __('Where is the complete updated OnLine FAQ page?' , 'boatdealer');
$msg .= '<br />';
$msg .= '<a href="http://boatdealerplugin.com/faq/" target="_self">http://boatdealerplugin.com/faq/</a>';

$msg .= '<br />';$msg .= '<br />';
$msg .= __('Where is the demo online?' , 'boatdealer');
$msg .= '<br />';
$msg .= '<a href="http://boatdealerplugin.com/demo/" target="_self">http://boatdealerplugin.com/demo/</a>';

$msg .= '<br />';$msg .= '<br />';


$msg .= __('Where is the complete online updated StartUp Guide?' , 'boatdealer');
$msg .= '<br />';
$msg .= '<a href="http://boatdealerplugin.com/startup-guide/" target="_self">http://boatdealerplugin.com/startup-guide/</a>';

$msg .= '<br />';$msg .= '<br />';
$msg .= __('Where is the donation page?' , 'boatdealer');
$msg .= '<br />';
$msg .= '<a href="http://boatdealerplugin.com/donate/" target="_self">http://boatdealerplugin.com/donate/</a>';

$msg .= '<br />';$msg .= '<br />';

$msg .= __('How can i get support?' , 'boatdealer');
$msg .= '<br />';
$msg .= '<a href="http://boatdealerplugin.com/contact/" target="_self">http://boatdealerplugin.com/contact/</a>';

$msg .= '<br />';$msg .= '<br />';
$msg .= __('Where is the language file?' , 'boatdealer');
$msg .= '<br />';
$msg .= __('We have an english language file ready to translate to another language.' , 'boatdealer');
$msg .= '<br />';
$msg .= 'Path: /plugins/boatdealer/language/';



$settings['Faq']['Faq'] = array('info' => $msg );
$fields = array();
 
       
$settings['Faq']['Faq']['fields'] = $fields;


new OptionPageBuilderTabbed($mypage, $settings);

