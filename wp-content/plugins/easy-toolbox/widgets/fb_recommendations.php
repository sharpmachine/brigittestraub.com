<?php
/*
Plugin Name: Facebook Recommendations Easytoolbox
Plugin URI: http://easytoolbox.net/
Description: Plugin fbrecommendations for EasyToolBox
Author: Galline Frédéric
Version: 1.0
Author URI: http://www.galline.fr/
*/


class fbrecommendations extends WP_Widget {


    function fbrecommendations() {
		//les options du widget vont Ãªtre le nom de la classe (classname) et sa description
		$widget_ops = array('classname' => 'fbrecommendations', 'description' => __( "Add facebook's recommendations") );
		//les contrÃ´les permettent de dÃ©finir les dimensions du widget dans l'administration WP
		//$control_ops = array('width' => 300, 'height' => 300);
		//dans la parenthÃ¨se centrale, Ã©crivez le nom du widget qui apparaÃ®tra dans l'admin de WP
		$this->WP_Widget('fbrecommendations', __('[ETB] Facebook Recommendations'), $widget_ops);
		
		wp_enqueue_script('jscolor', 
			WP_PLUGIN_URL."/easy-toolbox/js/jscolor/jscolor.js");
			
	}
	

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '&nbsp;' : $instance['title']);
        $facebook = get_option('etb_facebook');
               
        echo $before_widget;
        
        
        if (!empty($instance['title'])){
			echo $before_title . $title . $after_title;
        }
        ?>
        <iframe src="http://www.facebook.com/plugins/recommendations.php?site=<?php echo bloginfo('url') ?>&amp;width=<?php echo $instance['width'] ?>&amp;height=<?php echo $instance['height']; ?>&amp;header=<?php echo $instance['showheader'] ?>&amp;colorscheme=<?php echo $instance['colorscheme'] ?>&amp;border_color=%23<?php echo $instance['border_color'] ?>" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:<?php echo $instance['width'] ?>; height:<?php echo $instance['height'] ?>px" allowTransparency="true"></iframe>

        <?php
      
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
	    $instance = $old_instance; 
	    $instance['title'] = strip_tags(stripslashes($new_instance['title']));
	    $instance['width'] = strip_tags(stripslashes($new_instance['width']));
	    $instance['height'] = strip_tags(stripslashes($new_instance['height']));
		$instance['border_color'] = strip_tags(stripslashes($new_instance['border_color']));
		$instance['colorscheme'] = strip_tags(stripslashes($new_instance['colorscheme']));
		$instance['showheader'] = strip_tags(stripslashes($new_instance['showheader']));
		return $instance;
	}

    function form($instance) {
    	
    	
    	$instance = wp_parse_args( (array) $instance, array('title'=>'Facebook Recommendations', 'width'=>'200', 'height'=>'300', 'border_color'=>'', 'colorscheme'=>'light', 'showheader'=>'') );
    	
        $title = htmlspecialchars($instance['title']);
        $width = htmlspecialchars($instance['width']);
        $height = htmlspecialchars($instance['height']);
        $border_color = htmlspecialchars($instance['border_color']);
        $colorscheme = htmlspecialchars($instance['colorscheme']);
        $showheader = esc_attr($instance['showheader']);		
		$showheader = $showheader ? 'checked="checked"' : '';
        

  ?>
		
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>">Titre
                    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
                </label>
            </p>
            
            <p>
                <label for="<?php echo $this->get_field_id('width'); ?>">Largeur en Pixel
                    <input class="widefat" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo $width; ?>" />
                </label>
            </p>
            
            <p>
                <label for="<?php echo $this->get_field_id('height'); ?>">Hauteur en pixel
                    <input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $height; ?>" />
                </label>
            </p>
            
            <p>
				<label for="<?php echo $this->get_field_id('showheader'); ?>"> 
					<input	class="checkbox" id="<?php echo $this->get_field_id('showheader'); ?>" name="<?php echo $this->get_field_name('showheader'); ?>" type="checkbox" <?php echo $showheader; ?> />
					<?php _e('Show Header'); ?>
				</label>
			</p>
            
            <p>
	            <label for="<?php echo $this->get_field_id('border_color'); ?>">Couleur de la bordure
	            	<input class="fbact_color_picker {hash:true,required:false,pickerPosition:'top'} widefat" id="<?php echo $this->get_field_id('border_color'); ?>" name="<?php echo $this->get_field_name('border_color'); ?>" type="text" value="<?php echo $border_color; ?>" />
	      		</label>
            </p>
            
            <p>
				<label for="<?php echo $this->get_field_id('colorscheme'); ?>"><?php _e('Color Scheme'); ?> 
					<select	class="widefat" id="<?php echo $this->get_field_id('colorscheme'); ?>" name="<?php echo $this->get_field_name('colorscheme'); ?>">
							<?php
								$colorscheme_array = array('light'=>'light','dark'=>'dark','evil'=>'evil');
								foreach($colorscheme_array as $fbact_text=>$fbact_value){
									echo '<option value="'.$fbact_value.'"';
									if ($fbact_value==$colorscheme){echo ' selected="selected"';}
									echo '>'.$fbact_text.'</option> ';
								}
							?>
					</select>
				</label>
			</p>

            
            <hr>
            <p><small>The Recommendations plugin shows personalized recommendations to your users.</small></p>
            
		<script type="text/javascript">       
			jscolor.init();
			var colorPickerArray = [];
		
			jQuery('input.fbact_color_picker').each(function(index) {
		
				var oldID = document.getElementById(jQuery(this).attr('id'));
				var myCol = jQuery(this).val();
				colorPickerArray[index] = new  jscolor.color(oldID, {hash:false,required:false,pickerPosition:'top'});
				colorPickerArray[index].fromString((myCol) ? myCol : "CCCCCF");
			});
		</script>
<?php            
    }

} // class fbrecommendations

add_action('widgets_init', create_function('', 'return register_widget("fbrecommendations");'));


?>