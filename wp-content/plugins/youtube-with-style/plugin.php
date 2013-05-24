<?php
/*
Plugin Name: Youtube with Style
Plugin URI: http://wordpress.org/extend/plugins/youtube-with-style/
Description: Show You Tube videos with a custom stylish player, also create a playlist, and search in real time via the youtube api.
Date: October, 4th, 2012
Version: 9.0
Author: Chris McCoy
Author URI: http://github.com/chrismccoy
*/

function yt_add_tab($tabs) {
	$tabs['search'] = __('You Tube'); 
	return $tabs;
}

add_filter('media_upload_tabs', 'yt_add_tab');

function yt_tab_content() {
           wp_iframe('media_search_video_form');
           break;
}

add_action('media_upload_search', 'yt_tab_content');

function yt_scripts() {
	    wp_enqueue_style('search_video_css', plugins_url('css/search.css',__FILE__));
	    wp_enqueue_script('json_eval', plugins_url('js/json.js',__FILE__));
	    wp_enqueue_script('search_video_js', plugins_url('js/search-video.js',__FILE__));
}

add_action('admin_enqueue_scripts', 'yt_scripts');

function yt_frontend_scripts() {
	    wp_enqueue_script('jquery');
	    wp_enqueue_script('swfobject');
}

add_action('wp_enqueue_scripts', 'yt_frontend_scripts');

function media_search_video_form() {
	media_upload_header();
        $post_id = $_GET['post_id'];
	include(plugin_dir_path(__FILE__) . '/lib/search-video.php');
}

function yt_search_video() {
	if (isset($_POST['uri'])) {
		$uri = $_POST['uri'];
	}
	else {
		$q = isset($_POST['q']) ? urlencode($_POST['q']) : 'wordpress';
		$orderby = isset($_POST['orderby']) ? $_POST['orderby'] : 'relevance';
		$uri = "http://gdata.youtube.com/feeds/api/videos?q=$q&orderby=$orderby&max-results=12&v=2&alt=json";
	}
	
	$feed = wp_remote_retrieve_body(wp_remote_get( $uri ));
	@header('Content-type: application/json; charset=UTF-8');
	die($feed);
}

add_action('wp_ajax_search_video', 'yt_search_video');

function youtube_shortcode($atts,$content){  
    global $post;
    extract(shortcode_atts(array('width' => 400,'height' => 300,), $atts));

    return '
	<script type="text/javascript">
		var flashvars = {};
		flashvars.v = "'.$content.'";
		flashvars.autoplay = "false";
		flashvars.blur = "10";
		flashvars.c_side_padding = "175";
		flashvars.play_pos_x = "center";
		flashvars.play_pos_y = "center";
		var params = {};
		params.bgcolor = "#000000";
		params.allowFullScreen = "true";
		var attributes = {};
		attributes.id = "myplayer";
		swfobject.embedSWF("' . plugin_dir_url(__FILE__) . 'lib/player.swf", "youtube-'.$post->ID.'", "'.$width.'", "'.$height.'", "9.0.0", false, flashvars, params, attributes);
	</script> <div id="youtube-'.$post->ID.'">please install flash</div>';
} 

add_shortcode('youtube', 'youtube_shortcode');
