<?php
/*
Plugin Name: Mailing List Easytoolbox
Plugin URI: http://easytoolbox.net/
Description: Plugin mailinglist for EasyToolBox
Author: Galline Frédéric
Version: 1.0
Author URI: http://www.galline.fr/
*/


class mailinglist extends WP_Widget {


    function mailinglist() {
		//les options du widget vont Ãªtre le nom de la classe (classname) et sa description
		$widget_ops = array('classname' => 'mailinglist', 'description' => __( "Add an automatic MailingList through Feedburner") );
		//les contrÃ´les permettent de dÃ©finir les dimensions du widget dans l'administration WP
		//$control_ops = array('width' => 300, 'height' => 300);
		//dans la parenthÃ¨se centrale, Ã©crivez le nom du widget qui apparaÃ®tra dans l'admin de WP
		$this->WP_Widget('mailinglist', __('[ETB] Mailing list'), $widget_ops);
		
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
        <form style="border:0px solid #ccc;padding:3px;text-align:left;" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php $feedburner; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true"><p><input type="text" style="width:100%" name="email"/><input type="hidden" value="<?php $feedburner; ?>" name="uri"/><input type="hidden" name="loc" value="<?php bloginfo('language'); ?>"/><input type="submit" value="Go" /></p></form>

        <?php

        
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
	    $instance = $old_instance; 
	    $instance['title'] = strip_tags(stripslashes($new_instance['title']));
	    return $instance;
	}

    function form($instance) {
    	
    	
    	$instance = wp_parse_args( (array) $instance, array('title'=>'Mailing List') );
    	
        $title = htmlspecialchars($instance['title']);

  ?>
		
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'easytoolbox'); ?>
                    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
                </label>
            </p>
            <hr>
            <p><small><?php _e('This widget will use the mailing list option Feedburner. To work correctly, go into your interface and start feedburner [email subscription] in the [publicize]. Then click save at the bottom of the page.', 'easytoolbox'); ?></small></p>
            <p><?php _e('Direct Link', 'easytoolbox'); ?><a href="http://feedburner.google.com" target="blank">FeedBurner</a></p>
<?php            
    }

} // class mailinglist

add_action('widgets_init', create_function('', 'return register_widget("mailinglist");'));


?>