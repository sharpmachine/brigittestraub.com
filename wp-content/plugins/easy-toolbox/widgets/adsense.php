<?php
/*
Plugin Name: Add script Google Adsence
Plugin URI: http://easytoolbox.net/
Description: Plugin adsense_wdgt for EasyToolBox
Author: Galline Frédéric
Version: 1.0
Author URI: http://www.galline.fr/
*/


class adsense_wdgt extends WP_Widget {


    function adsense_wdgt() {
		$widget_ops = array('classname' => 'adsense_wdgt', 'description' => __('Add advertising to your Sidebar', 'easytoolbox'));
		$this->WP_Widget('adsense_wdgt', __('Advertising script', 'easytoolbox'), $widget_ops);			
		}
	
 
	
	
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '&nbsp;' : $instance['title']);
        $code_adsense = empty($instance['code_adsense']) ? '&nbsp;' : apply_filters('code_adsense', $instance['code_adsense']);
        $count = get_option('etb_count_content');
        $google_id = get_option('etb_google_id');
        $gadsense = get_option('gadsense');
		if (empty($google_id)) {
		$pub=substr(strstr($code_adsense, 'pub-'), 'p', 20); 
		update_option('etb_google_id',$pub);
		}
     
        echo $before_widget;
        
        
        if (!empty($instance['title'])){
			echo $before_title . $title . $after_title;
        }
        
        echo $code_adsense;
		echo $after_widget;
    }

    function update($new_instance, $old_instance) {
	    $instance = $old_instance; 
	    $instance['title'] = strip_tags(stripslashes($new_instance['title']));
	    $instance['code_adsense'] = $new_instance['code_adsense'];
	    return $instance;
	}

    function form($instance) {
    	$instance = wp_parse_args( (array) $instance, array('title'=>'', 'code_adsense'=>'') );
    	
        $title = htmlspecialchars($instance['title']);
        $code_adsense = $instance['code_adsense'];
          ?>
		
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','easytoolbox'); ?>
                    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
                </label>
            </p>
   
			<p>
				<label for="<?php echo $this->get_field_id('code_adsense'); ?>" ><?php _e('Paste your script here','easytoolbox'); ?>
					<textarea id="<?php echo $this->get_field_id('code_adsense'); ?>" name="<?php echo $this->get_field_name('code_adsense'); ?>" type="text" class="widefat" rows="4"><?=$code_adsense?></textarea>
				</label>
			</p>
           
            <hr>
            <p><small><?php _e('Get Code : ','easytoolbox'); ?> <a target="blank" href="https://www.google.com/adsense/adsense-products">Google Adsense</a></small></p>
            
<?php            
    }

} // class adsense_wdgt

add_action('widgets_init', create_function('', 'return register_widget("adsense_wdgt");'));


?>