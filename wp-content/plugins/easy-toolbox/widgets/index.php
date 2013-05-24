<?php 
	
	include 'followme.php';
	include 'embed_video.php';
	
	$facebook = get_option('etb_facebook');
	if (!empty($facebook)) {
	include 'fb_recent_activity.php';
	include 'fb_recommendations.php';
	}
	
	$adsense = get_option('etb_choix_adsense');
	if (!empty($adsense)) {
	include 'adsense.php';
	}
	
	$feedburner = get_option('etb_feedburner');
	if (!empty($feedburner)) {
	include 'mailinglist.php';
	}
	
	$twitter = get_option('etb_twitter');
	if (!empty($twitter)) {
	include 'twitter.php';
	}
	
	$twitter = get_option('etb_twitter');
	if (!empty($twitter)) {
	include 'twitter_follow.php';
	}
	
	

	
?>