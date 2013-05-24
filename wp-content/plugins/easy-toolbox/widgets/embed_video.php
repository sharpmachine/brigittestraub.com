<?php
/*
Plugin Name: Add script Google Adsence
Plugin URI: http://easytoolbox.net/
Description: Plugin embed_wdgt for EasyToolBox
Author: Galline Frédéric
Version: 1.0
Author URI: http://www.galline.fr/
*/


class embed_wdgt extends WP_Widget {


    function embed_wdgt() {
		$widget_ops = array('classname' => 'embed_wdgt', 'description' => __('Add an Embed vidéo script', 'easytoolbox'));
		$this->WP_Widget('embed_wdgt', __('[ETB] Embed Vidéo', 'easytoolbox'), $widget_ops);			
		}
	
	
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '&nbsp;' : $instance['title']);
        $code_embed = empty($instance['code_embed']) ? '&nbsp;' : apply_filters('code_embed', $instance['code_embed']);
        
        
        $width = "100%";
        $height = "auto";
		$patterns = array();
		$patterns[0] = '/width="(.*?)"/';
		$patterns[1] = '/height="(.*?)"/';
		$replacements = array();
		$replacements[0] = 'width="' . $width . '"';
		$replacements[1] = 'height="' . $height . '"';
		
		$embedCode = preg_replace($patterns, $replacements, $code_embed);
		
               
      
     
        echo $before_widget;
        
        
        if (!empty($instance['title'])){
			echo $before_title . $title . $after_title;
        }
        
        echo $embedCode;
		echo $after_widget;
    }

    function update($new_instance, $old_instance) {
	    $instance = $old_instance; 
	    $instance['title'] = strip_tags(stripslashes($new_instance['title']));
	    $instance['code_embed'] = $new_instance['code_embed'];
	    return $instance;
	}

    function form($instance) {
    	$instance = wp_parse_args( (array) $instance, array('title'=>'', 'code_embed'=>'') );
    	
        $title = htmlspecialchars($instance['title']);
        $code_embed = $instance['code_embed'];
          ?>
		
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','easytoolbox'); ?>
                    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
                </label>
            </p>
   
			<p>
				<label for="<?php echo $this->get_field_id('code_embed'); ?>" ><?php _e('Code embed','easytoolbox'); ?>
					<textarea id="<?php echo $this->get_field_id('code_embed'); ?>" name="<?php echo $this->get_field_name('code_embed'); ?>" type="text" class="widefat" rows="4"><?=$code_embed?></textarea>
				</label>
			</p>
           
            
<?php            
    }

} // class embed_wdgt

add_action('widgets_init', create_function('', 'return register_widget("embed_wdgt");'));


?>