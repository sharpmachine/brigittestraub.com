<?php
/*
Plugin Name: Follow Me Easytoolbox
Plugin URI: http://easytoolbox.net/
Description: Plugin followme for EasyToolBox
Author: Galline Frédéric
Version: 1.0
Author URI: http://www.galline.fr/
*/


class followme extends WP_Widget {


    function followme() {
		$widget_ops = array('classname' => 'followme', 'description' => __( "Add social network logos in your Sidebar") );
		$this->WP_Widget('followme', __('[ETB] Follow Me'), $widget_ops);
		
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
        
        $twitter = get_option('etb_twitter');
		if (!empty($twitter)) {echo '<a href="http://twitter.com/'.$twitter.'" target="blank" rel="nofollow"><img src="'.WP_PLUGIN_URL.'/easy-toolbox/widgets/icon-pool/Twitter.png" alt="Twitter" title="Suivez nous sur Twitter" style="border:none;padding-top:10px;padding-right:10px;vertical-align:middle;"></a>';}
		
		$facebook = get_option('etb_facebook');
		if (!empty($facebook)) {echo '<a href="http://facebook.com/'.$facebook.'" target="blank" rel="nofollow"><img src="'.WP_PLUGIN_URL.'/easy-toolbox/widgets/icon-pool/Facebook.png" alt="Facebook" title="Notre page facebook" style="border:none;padding-top:10px;padding-right:10px;vertical-align:middle;"></a>';}
		
		$feedburner = get_option('etb_feedburner');
		if (!empty($feedburner)) {echo '<a href="http://feeds.feedburner.com/'.$feedburner.'" target="blank" rel="nofollow"><img src="'.WP_PLUGIN_URL.'/easy-toolbox/widgets/icon-pool/RSS.png" alt="Flux RSS" title="Notre flux RSS" style="border:none;padding-top:10px;padding-right:10px;vertical-align:middle;"></a>';}
		
		if (empty($feedburner)) {echo '<a href="'.get_bloginfo('rss2_url').'" target="blank" rel="nofollow"><img src="'.WP_PLUGIN_URL.'/easy-toolbox/widgets/icon-pool/RSS.png" alt="Flux RSS" title="Notre flux RSS" style="border:none;padding-top:10px;padding-right:10px;vertical-align:middle;"></a>';}
		
		$flickr = get_option('etb_flickr');
		if (!empty($flickr)) {echo '<a href="http://www.flickr.com/photos/'.$flickr.'" target="blank" rel="nofollow"><img src="'.WP_PLUGIN_URL.'/easy-toolbox/widgets/icon-pool/Flickr.png" alt="Flickr" titles="Nos photos Flickr" style="border:none;padding-top:10px;padding-right:10px;vertical-align:middle;"></a>';}
		
		$netvibes = get_option('etb_netvibes');
		if (!empty($netvibes) && !empty($feedburner)) {echo '<a href="http://www.netvibes.com/subscribe.php?type=rss&url=http://feeds.feedburner.com/'.$feedburner.'" target="blank" rel="nofollow"><img src="'.WP_PLUGIN_URL.'/easy-toolbox/widgets/icon-pool/netvibes.png" alt="Netvibes" title="Netvibes" style="border:none;padding-top:10px;padding-right:10px;vertical-align:middle;"></a>';}

		if (!empty($netvibes) && empty($feedburner)) {echo '<a href="http://www.netvibes.com/subscribe.php?type=rss&url='.get_bloginfo('rss2_url').'" target="blank" rel="nofollow"><img src="'.WP_PLUGIN_URL.'/easy-toolbox/widgets/icon-pool/netvibes.png" alt="netvibes" title="Netvibes" style="border:none;padding-top:10px;padding-right:10px;vertical-align:middle;"></a>';}

		$youtube = get_option('etb_youtube');
		if (!empty($youtube)) {echo '<a href="http://youtube.com/'.$youtube.'" target="blank" rel="nofollow"><img src="'.WP_PLUGIN_URL.'/easy-toolbox/widgets/icon-pool/YouTube.png" alt="Youtube" title="Youtube vidéos" style="border:none;padding-top:10px;padding-right:10px;vertical-align:middle;"></a>';}
		
		$dailymotion = get_option('etb_dailymotion');
		if (!empty($dailymotion)) {echo '<a href="http://dailymotion.com/'.$dailymotion.'" target="blank" rel="nofollow"><img src="'.WP_PLUGIN_URL.'/easy-toolbox/widgets/icon-pool/Dailymotion.png" alt="Dailymotion" title="Dailymotion vidéos" style="border:none;padding-top:10px;padding-right:10px;vertical-align:middle;"></a>';}
		
		$itunes = get_option('etb_itunes');
		if (!empty($itunes)) {echo '<a href="'.$itunes.'" target="blank" rel="nofollow"><img src="'.WP_PLUGIN_URL.'/easy-toolbox/widgets/icon-pool/Podcast.png" alt="Podcast" title="Abonnez vous au Podcast" style="border:none;padding-top:10px;padding-right:10px;vertical-align:middle;"></a>';}

        
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
	    $instance = $old_instance; 
	    $instance['title'] = strip_tags(stripslashes($new_instance['title']));
	    return $instance;
	}

    function form($instance) {
    	
    	
    	$instance = wp_parse_args( (array) $instance, array('title'=>'Follow Me') );
    	
        $title = htmlspecialchars($instance['title']);

  ?>
       


            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'easytoolbox'); ?>
                    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
                </label>
            </p>
            
            <p>
            <hr>
            <?php _e('Example', 'easytoolbox'); ?><br/>
            <?php
            $twitter = get_option('etb_twitter');
		if (!empty($twitter)) {echo '<a href="http://twitter.com/'.$twitter.'" target="blank" rel="nofollow"><img src="'.WP_PLUGIN_URL.'/easy-toolbox/widgets/icon-pool/Twitter.png" alt="Twitter" title="Suivez nous sur Twitter" style="border:none;padding-top:10px;padding-right:10px;vertical-align:middle;"></a>';}
		
		$facebook = get_option('etb_facebook');
		if (!empty($facebook)) {echo '<a href="http://facebook.com/'.$facebook.'" target="blank" rel="nofollow"><img src="'.WP_PLUGIN_URL.'/easy-toolbox/widgets/icon-pool/Facebook.png" alt="Facebook" title="Notre page facebook" style="border:none;padding-top:10px;padding-right:10px;vertical-align:middle;"></a>';}
		
		$feedburner = get_option('etb_feedburner');
		if (!empty($feedburner)) {echo '<a href="http://feeds.feedburner.com/'.$feedburner.'" target="blank" rel="nofollow"><img src="'.WP_PLUGIN_URL.'/easy-toolbox/widgets/icon-pool/RSS.png" alt="Flux RSS" title="Notre flux RSS" style="border:none;padding-top:10px;padding-right:10px;vertical-align:middle;"></a>';}
		
		if (empty($feedburner)) {echo '<a href="'.get_bloginfo('rss2_url').'" target="blank" rel="nofollow"><img src="'.WP_PLUGIN_URL.'/easy-toolbox/widgets/icon-pool/RSS.png" alt="Flux RSS" title="Notre flux RSS" style="border:none;padding-top:10px;padding-right:10px;vertical-align:middle;"></a>';}
		
		$flickr = get_option('etb_flickr');
		if (!empty($flickr)) {echo '<a href="http://flickr.com/'.$flickr.'" target="blank" rel="nofollow"><img src="'.WP_PLUGIN_URL.'/easy-toolbox/widgets/icon-pool/Flickr.png" alt="Flickr" titles="Nos photos Flickr" style="border:none;padding-top:10px;padding-right:10px;vertical-align:middle;"></a>';}
		
		$netvibes = get_option('etb_netvibes');
		if (!empty($netvibes) && !empty($feedburner)) {echo '<a href="http://www.netvibes.com/subscribe.php?type=rss&url=http://feeds.feedburner.com/'.$feedburner.'" target="blank" rel="nofollow"><img src="'.WP_PLUGIN_URL.'/easy-toolbox/widgets/icon-pool/netvibes.png" alt="Netvibes" title="Netvibes" style="border:none;padding-top:10px;padding-right:10px;vertical-align:middle;"></a>';}

		if (!empty($netvibes) && empty($feedburner)) {echo '<a href="http://www.netvibes.com/subscribe.php?type=rss&url='.get_bloginfo('rss2_url').'" target="blank" rel="nofollow"><img src="'.WP_PLUGIN_URL.'/easy-toolbox/widgets/icon-pool/netvibes.png" alt="netvibes" title="Netvibes" style="border:none;padding-top:10px;padding-right:10px;vertical-align:middle;"></a>';}

		$youtube = get_option('etb_youtube');
		if (!empty($youtube)) {echo '<a href="http://youtube.com/'.$youtube.'" target="blank" rel="nofollow"><img src="'.WP_PLUGIN_URL.'/easy-toolbox/widgets/icon-pool/YouTube.png" alt="Youtube" title="Youtube vidéos" style="border:none;padding-top:10px;padding-right:10px;vertical-align:middle;"></a>';}
		
		$dailymotion = get_option('etb_dailymotion');
		if (!empty($dailymotion)) {echo '<a href="http://dailymotion.com/'.$dailymotion.'" target="blank" rel="nofollow"><img src="'.WP_PLUGIN_URL.'/easy-toolbox/widgets/icon-pool/Dailymotion.png" alt="Dailymotion" title="Dailymotion vidéos" style="border:none;padding-top:10px;padding-right:10px;vertical-align:middle;"></a>';}
		
		$itunes = get_option('etb_itunes');
		if (!empty($itunes)) {echo '<a href="'.$itunes.'" target="blank" rel="nofollow"><img src="'.WP_PLUGIN_URL.'/easy-toolbox/widgets/icon-pool/Podcast.png" alt="Podcast" title="Abonnez vous au Podcast" style="border:none;padding-top:10px;padding-right:10px;vertical-align:middle;"></a>';}
            ?></p>
             
        <?php
    }

} // class followme

add_action('widgets_init', create_function('', 'return register_widget("followme");'));


?>