<?php 
/**
 * @author Bill Minozzi
 * @copyright 2016
 */
           
$meta_box['boats'] = array( 
		'id' => 'listing-details', 
		'title' => 'Page Options', 
		'context' => 'normal', 
		'priority' => 'high', 
		'fields' => array( 
			array(
				'name' => 'Price',
				'desc' => __('No special characters here ("$" "," "."), the plugin will auto format the number.', 'boatdealer'),
				'id' => 'boat-price',
				'type' => 'text',
				'default' => ''
			),
	       array(
				'name' => 'Make',
				'desc' => __('Make', 'boatdealer'),
				'id' => 'boat-make',
				'type' => 'text',
				'default' => ''
			),
			array(

				'name' => 'Featured',
				'desc' => __('Mark to show up at Featured Widget.', 'boatdealer'),
				'id' => 'boat-featured',
				'type' => 'checkbox'

				),

			array(
				'name' => 'Year',
				'desc' => __('The year of the model. Only numbers, no point, no comma.', 'boatdealer'),
				'id' => 'boat-year',
				'type' => 'text',
				'default' => ''
			),
			 array(
				'name' => 'HP',
				'desc' => __('Engine HP. Only numbers, no point, no comma.', 'boatdealer'),
				'id' => 'boat-hp',
				'type' => 'text',
				'default' => ''				
				),
                
           
			array(
				'name' => 'Condition',
				'desc' => __('The amount of miles on this boat. Only numbers, no point, no comma.', 'boatdealer'),
				'id' => 'boat-con',
				'type' => 'select',
				'options' => array (
				'New' => 'New',
				'Used' => 'Used',
				'Damaged' => 'Damaged',
				),
				'default' => ''
			),
            
            	array(

				'name' => get_option("bd_measure", "Miles"),

				'desc' => __('The amount of '.get_option("bd_measure", "Miles").' on the engine. Only numbers, no point, no comma.', 'boatdealer'),

				'id' => 'boat-miles',

				'type' => 'text',

				'default' => ''

			),
            	
            array(
				'name' => 'LOA',
				'desc' => __('Lengh Of Boat in '). get_option('bd_lenght', 'Feet') . '.' . __('Only numbers. No point, no comma.' , 'boatdealer'),
				'id' => 'LOA-mpg',
				'type' => 'text',
				'default' => ''
			    ),
			array(
				'name' => 'Fuel Capacity',
				'desc' => __('Fuel Capacity in ') . get_option('bd_liter', 'Liter') . '.' . __('Only numbers. No point, no comma.' , 'boatdealer'),
				'id' => 'boat-fuel-capacity',
				'type' => 'text',
				'default' => ''				
				),
			array(
				'name' => 'Passenger Capacity',
				'desc' => __('Passenger Capacity. Only numbers.', 'boatdealer'),
				'id' => 'boat-capacity',
				'type' => 'text',
				'default' => ''				
				),								
			array(
				'name' => 'Boat Type',
				'desc' => __('What kind of Boat is this', 'boatdealer'),
				'id' => 'boat-type',
				'type' => 'select',
				'options' => array (
				'Airboat' => 'Power',
				'Banana boat' => 'Sail'
				)),
                
       			array(        
				'name' => 'Fuel Type',
				'desc' => __('Fuel Type.', 'boatdealer'),
				'id' => 'boat-fuel',
				'type' => 'select',
				'options' => array (
				'Airboat' => 'Diesel',
				'Banana boat' => 'Gasoline'
				)),
			array(
				'name' => 'Engine',
				'desc' => __('Engine eg: Johnson', 'boatdealer'),
				'id' => 'boat-engine',
				'type' => 'text',				
				'default' => ''
			),
			array(
				'name' => 'Interior Color',
				'desc' => __('Color of the Interior', 'boatdealer'),
				'id' => 'boat-int',
				'type' => 'text',				
				'default' => ''
			),
			array(
				'name' => 'Interior Material',
				'desc' => __('Interior Material', 'boatdealer'),
				'id' => 'boat-mat',
				'type' => 'text',				
				'default' => ''
			) 
		)
	);
add_action('admin_menu', 'listing_add_box');
update_option( 'meta_boxes', $meta_box );
function listing_add_box() {
	global $meta_box;
	foreach($meta_box as $post_type => $value) {
		add_meta_box($value['id'], $value['title'], 'listing_format_box', $post_type, $value['context'], $value['priority']);
	}
}
function listing_format_box() {
	global $meta_box, $post;
            wp_enqueue_style('meta', '/wp-content/plugins/boatdealer/includes/post-type/meta.css'); 
				 ?>
 <?php
	echo '<input type="hidden" name="listing_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	foreach ($meta_box[$post->post_type]['fields'] as $field) {
		$meta = get_post_meta($post->ID, $field['id'], true);
		$title = $field['name'];
		echo '<div class="boxes">'.
		'<div class="box-label"><label for="'. $field['id'] .'">'. $title = str_replace("_", " ",$title) . '</label></div>'.
		'<div class="box-content"><p>';
		switch ($field['type']) {
			case 'roomArea':
				echo '<div class="roomArea"></div>';
				break;
			case 'newArea':
				echo '<div class="newArea"></div>';
				break;
			case 'saveBTN':
				echo '<a id="geocode" class="button">Save Address</a>';
				break;
			case 'mapPre':
				echo '<div id="addresspreview" style="float: right; width: 200px; height: 140px; border: 1px solid #DFDFDF;"></div>';
				break;
				case 'address':
				echo '<label for ="'. $field['id']. '" </label>';
				echo '<input type="text" name="'. $field['id']. '" class="'. $field['name'] .'" id="'. $field['id'] .'" value="'. ($meta ? $meta : $field['default']) . '" size="30" style="width:97%" />'. '<br />'. $field['desc'];
				break;
			case 'text':
           	    echo '<input type="text" name="'. $field['id']. '" class="'. $field['name'] .'" id="'. $field['id'] .'" value="'. ($meta ? $meta : $field['default']) . '" size="30" style="width:97%" />'. '<br />'. $field['desc'];
				break;
			case 'textarea':
				echo '<textarea name="'. $field['id']. '" id="'. $field['id']. '" class="'. $field['name'] .'" cols="60" rows="4" style="width:97%">'. ($meta ? $meta : $field['default']) . '</textarea>'. '<br />'. $field['desc'];
				break;
			case 'select':
				echo '<select name="'. $field['id'] . '" id="'. $field['id'] .  '" class="'. $field['name'] .'">';
				foreach ($field['options'] as $option) {
					echo '<option '. ( $meta == $option ? ' selected="selected"' : '' ) . '>'. $option . '</option>';
				}
				echo '</select>';
				break;
			case 'tagging':
				echo '<input type="text" name="'. $field['id']. '" class="'. $field['name'] .'" id="'. $field['id'] .'" value="'. ($meta ? $meta : $field['default']) . '" size="30" style="width:97%" />'. '<br />'. $field['desc'];
				foreach ($field['options'] as $option) {
					echo '<div class="tag-click-'.$field['id'].'" id="'.$option.'">'.$option .' </div>';
				}
				break;
			case 'radio':
				foreach ($field['options'] as $option) {
					echo '<input type="radio" name="' . $field['id'] . '" value="' . $option['value'] . '"' . ( $meta == $option['value'] ? ' checked="checked"' : '' ) . ' />' . $option['name'];
				}
				break;
			case 'checkbox':
				echo '<div class = "checkboxSlide">';
				echo '<input type="checkbox" class="'. $field['name'] .'" value="enabled" name="' . $field['id'] . '" id="CheckboxSlide"' . ( $meta ? ' checked="checked"' : '' ) . '<br />'. $field['desc'];
			  	echo '</div>';
				break;
			case 'checkbox-custom':
				echo '<div class = "checkboxSlide2">';
				echo '<input type="checkbox" class="'. $field['name'] .'" value="enabled" name="' . $field['id'] . '" id="CheckboxSlide2"' . ( $meta ? ' checked="checked"' : '' ) . ' />';
				echo '</div>';
				break;
			case 'room':
				echo '<div class="add">ADD </div>';
				echo '<div class="remove">REMOVE</div>';
				echo '<select name="'. $field['id'] . '" id="'. $field['id'] . '" class="'. $field['name'] . '">';
				foreach ($field['options'] as $option) {
					echo '<option '. ( $meta == $option ? ' selected="selected"' : '' ) . '>'. $option . '</option> ' ;
				}
				echo '</select>';
				break;				
		}
		echo       '</div> </div>';
	}
echo '<div class="clear"> </div>';	
}

add_action('save_post', 'bd_listing_save_data');

function bd_listing_save_data($post_id) {
    
    global $meta_box,  $post;

    if( !is_object($post) ) 
     return;
      

    if(! isset($meta_box[$post->post_type]['fields']))
    {
        return;
    }

    //Verify nonce

    if( isset($_POST['listing_meta_box_nonce']))
    {
        if (!wp_verify_nonce($_POST['listing_meta_box_nonce'], basename(__FILE__))) {

            return $post_id;
        }
    }
 

    //Check autosave

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {

        return $post_id;

    }

 

    //Check permissions

 if( isset($_POST['post_type']) )
  {
        
    if ('page' == $_POST['post_type']) {

        if (!current_user_can('edit_page', $post_id)) {

            return $post_id;

        }

    } elseif (!current_user_can('edit_post', $post_id)) {

        return $post_id;

    }
  }
  else
    return;
    
    

    foreach ($meta_box[$post->post_type]['fields'] as $field) {

        $old = get_post_meta($post_id, $field['id'], true);

        
        if(    isset($_POST[$field['id']])      )
            {$new = $_POST[$field['id']];}
        else
           {$new = '';}
                

        if ($new && $new != $old) {

            update_post_meta($post_id, $field['id'], $new);

        } elseif ('' == $new && $old) {

            delete_post_meta($post_id, $field['id'], $old);

        }

    }

}