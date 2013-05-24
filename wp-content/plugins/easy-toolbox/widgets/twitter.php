<?php
/*
Plugin Name: Epershand First Widget
Plugin URI: http://easytoolbox.net/
Description: Plugin Twitter for EasyToolBox
Author: Galline Frédéric
Version: 1.0
Author URI: http://www.galline.fr/
*/


class twittergoodies extends WP_Widget {

    function twittergoodies() {
		$widget_ops = array('classname' => 'twittergoodies', 'description' => __( "Add your last tweets with the Twitter Goodies") );
		$this->WP_Widget('twittergoodies', __('[ETB] Your last tweets'), $widget_ops);
		
		wp_enqueue_script('jscolor', 
			WP_PLUGIN_URL."/easy-toolbox/js/jscolor/jscolor.js");
			
	}
	

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '&nbsp;' : $instance['title']);
        $twitter = get_option('etb_twitter');
               
        echo $before_widget;
        
        
        if (!empty($instance['title'])){
			echo $before_title . $title . $after_title;
        }
        
        ?>
        <script src="http://widgets.twimg.com/j/2/widget.js"></script>
		<script>
		new TWTR.Widget({
		  version: 2,
		  type: 'profile',
		  rpp: 4,
		  interval: 6000,
		  width: 'auto',
		  height: 300,
		  theme: {
		     shell: {
		      background: '<?php echo $instance["background"]; ?>',
		      color: '<?php echo $instance["color"]; ?>'
		    },
		    tweets: {
		      background: '<?php echo $instance["background2"]; ?>',
		      color: '<?php echo $instance["text"]; ?>',
		      links: '<?php echo $instance["link"]; ?>'
		    }
		  },
		  features: {
		    scrollbar: false,
		    loop: true,
		    live: false,
		    hashtags: true,
		    timestamp: true,
		    avatars: false,
		    behavior: 'all'
		  }
		}).render().setUser("<?php echo $twitter; ?>").start();
		</script>		
        <?php
        
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
	    $instance = $old_instance; 
	    $instance['title'] = strip_tags(stripslashes($new_instance['title']));
	    $instance['background'] = $new_instance['background'];
	    $instance['color'] = $new_instance['color'];
	    $instance['background2'] = $new_instance['background2'];
	    $instance['text'] = $new_instance['text'];
	    $instance['link'] = $new_instance['link'];
	
	    return $instance;
	}

    function form($instance) {
    	
    	
    	$instance = wp_parse_args( (array) $instance, array('title'=>'', 'background'=>'999999', 'color'=>'fff', 'background2'=>'fff', 'text'=>'666666', 'link'=>'222222') );
    	
        $title = htmlspecialchars($instance['title']);
        $background = htmlspecialchars($instance['background']);
        $color = htmlspecialchars($instance['color']);
        $background2 = htmlspecialchars($instance['background2']);
        $text = htmlspecialchars($instance['text']);
        $link = htmlspecialchars($instance['link']);
        $twitter = get_option('etb_twitter');
  ?>
       


            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'easytoolbox'); ?>
                    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
                </label>
            </p>
                  
            <p>
	            <label for="<?php echo $this->get_field_id('background'); ?>"><?php _e('Widget Color', 'easytoolbox'); ?>
	            	<input class="fbact_color_picker {hash:true,required:false,pickerPosition:'top'} widefat" id="<?php echo $this->get_field_id('background'); ?>" name="<?php echo $this->get_field_name('background'); ?>" type="text" value="<?php echo $background; ?>" />
	      		</label>
            </p>
            
            <p>
	            <label for="<?php echo $this->get_field_id('color'); ?>"><?php _e('Login Color', 'easytoolbox'); ?>
	            	<input class="fbact_color_picker {hash:true,required:false,pickerPosition:'top'} widefat" id="<?php echo $this->get_field_id('color'); ?>" name="<?php echo $this->get_field_name('color'); ?>" type="text" value="<?php echo $color; ?>" />
	            </label>
            </p>
            
            <p>
	            <label for="<?php echo $this->get_field_id('background2'); ?>"><?php _e('Background Color', 'easytoolbox'); ?>
	            	<input class="fbact_color_picker {hash:true,required:false,pickerPosition:'top'} widefat" id="<?php echo $this->get_field_id('background2'); ?>" name="<?php echo $this->get_field_name('background2'); ?>" type="text" value="<?php echo $background2; ?>" />
	            </label>
            </p>
            
            <p>
	            <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Fonts Color', 'easytoolbox'); ?>
	            	<input class="fbact_color_picker {hash:true,required:false,pickerPosition:'top'} widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo $text; ?>" />
	            </label>
            </p>
            
            <p>
	            <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link Color', 'easytoolbox'); ?>
	            	<input class="fbact_color_picker {hash:true,required:false,pickerPosition:'top'} widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo $link; ?>" />
	            </label>
            </p>
            
 
		<script type="text/javascript">       
			jscolor.init();
			var colorPickerArray = [];
		
			jQuery('input.fbact_color_picker').each(function(index) {
		
				var oldID = document.getElementById(jQuery(this).attr('id'));
				var myCol = jQuery(this).val();
				colorPickerArray[index] = new  jscolor.color(oldID, {hash:true,required:false,pickerPosition:'top'});
				colorPickerArray[index].fromString((myCol) ? myCol : "#CCCCCF");
			});
		</script>

        <?php
    }

} // class twittergoodies

add_action('widgets_init', create_function('', 'return register_widget("twittergoodies");'));


?>