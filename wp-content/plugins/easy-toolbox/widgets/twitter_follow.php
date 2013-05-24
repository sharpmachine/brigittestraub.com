<?php
/*
Plugin Name: Epershand First Widget
Plugin URI: http://easytoolbox.net/
Description: Plugin Twitter for EasyToolBox
Author: Galline Frédéric
Version: 1.0
Author URI: http://www.galline.fr/
*/


class twitterfollow extends WP_Widget {

    function twitterfollow() {
		$widget_ops = array('classname' => 'twitterfollow', 'description' => __( "Add twitter button 'follow me'") );
		$this->WP_Widget('twitterfollow', __('Follow me on twitter button'), $widget_ops);
			
	}
	

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '&nbsp;' : $instance['title']);
        $twitter = get_option('etb_twitter');
        $colorscheme = htmlspecialchars($instance['colorscheme']);
        $lang = htmlspecialchars($instance['lang']);
        $showcount = htmlspecialchars($instance['showcount']);
               
        echo $before_widget;
        
        
        if (!empty($instance['title'])){
			echo $before_title . $title . $after_title;
        }
        
        
        
        if ($colorscheme=="light"){
        ?>	
        
        <a href="http://twitter.com/<? echo $twitter ?>" class="twitter-follow-button" data-lang="<? echo $lang ?>" data-show-count="<? echo $showcount ?>">Follow @<? echo $twitter ?></a>
		<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
		
		<?php }else{ ?>
		
        <a href="http://twitter.com/<? echo $twitter ?>" class="twitter-follow-button" data-button="grey" data-text-color="#FFFFFF" data-link-color="#00AEFF" data-lang="fr" data-show-count="<? echo $showcount ?>">Follow @<? echo $twitter ?></a>
		<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
        <?php
		}
       
        
        
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
	    $instance = $old_instance; 
	    $instance['lang'] = strip_tags(stripslashes($new_instance['lang']));
	    $instance['colorscheme'] = strip_tags(stripslashes($new_instance['colorscheme']));
	    $instance['showcount'] = strip_tags(stripslashes($new_instance['showcount']));
	
	    return $instance;
	}

    function form($instance) {
    	
    	
    	$instance = wp_parse_args( (array) $instance, array('lang'=>'', 'colorscheme'=>'light', 'showcount'=>'true') );
    	
        $lang = htmlspecialchars($instance['lang']);
        $twitter = get_option('etb_twitter');
        $colorscheme = htmlspecialchars($instance['colorscheme']);
        $showcount = htmlspecialchars($instance['showcount']);
        
  ?>
       
                  
            <p>
				<label for="<?php echo $this->get_field_id('lang'); ?>"><?php _e('Language options', 'easytoolbox'); ?> 
					<select	class="widefat" id="<?php echo $this->get_field_id('lang'); ?>" name="<?php echo $this->get_field_name('lang'); ?>">
							<?php
								$lang_array = array('German'=>'de','English'=>'en', 'Korean'=>'ko', 'Spanish'=>'es', 'French'=>'fr', 'Italian'=>'it', 'Japanese'=>'ja', 'Russian'=>'ru','Turkish'=>'tr');
								foreach($lang_array as $fbact_text=>$fbact_value){
									echo '<option value="'.$fbact_value.'"';
									if ($fbact_value==$lang){echo ' selected="selected"';}
									echo '>'.$fbact_text.'</option> ';
								}
							?>
					</select>
				</label>
			</p>
			
            <p>
				<label for="<?php echo $this->get_field_id('colorscheme'); ?>"><?php _e('What color background will be used?', 'easytoolbox'); ?> 
					<select	class="widefat" id="<?php echo $this->get_field_id('colorscheme'); ?>" name="<?php echo $this->get_field_name('colorscheme'); ?>">
							<?php
								$colorscheme_array = array('light'=>'light','dark'=>'dark');
								foreach($colorscheme_array as $fbact_text=>$fbact_value){
									echo '<option value="'.$fbact_value.'"';
									if ($fbact_value==$colorscheme){echo ' selected="selected"';}
									echo '>'.$fbact_text.'</option> ';
								}
							?>
					</select>
				</label>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('showcount'); ?>"><?php _e('Show follower count?', 'easytoolbox'); ?> 
					<select	class="widefat" id="<?php echo $this->get_field_id('showcount'); ?>" name="<?php echo $this->get_field_name('showcount'); ?>">
							<?php
								$showcount_array = array('yes'=>'true','no'=>'false');
								foreach($showcount_array as $fbact_text=>$fbact_value){
									echo '<option value="'.$fbact_value.'"';
									if ($fbact_value==$showcount){echo ' selected="selected"';}
									echo '>'.$fbact_text.'</option> ';
								}
							?>
					</select>
				</label>
			</p>

            


        <?php
    }

} // class twitterfollow

add_action('widgets_init', create_function('', 'return register_widget("twitterfollow");'));


?>