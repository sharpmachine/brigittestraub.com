<?php

function new_content($content) {

$post_page = get_option('etb_post_page');


if ($post_page == 'post'){
	$button = is_single();
} elseif ($post_page == 'page'){
	$button = is_page();
} elseif ($post_page == 'both' || $post_page == ''){
	$button = is_single() or is_page();
}
	

if ($button) {

$url=get_permalink(); 

// Facebook LIKE
$choix_like = get_option('etb_choix_like');
$id_apps_facebook = get_option('etb_idapps_facebook');
$colorscheme = get_option('etb_colorscheme_facebook');
$font = get_option('etb_font_facebook');
$layout = get_option('etb_layout_facebook');
$lang = get_bloginfo('language');
$lang = str_replace("-", "_", $lang);

if ($layout == "button_count") {
	$width = "90";
	$height="20";
	$show_face = "false";
}

if ($layout == "standard") {
	
	if (get_option('etb_show_faces_facebook') != "true") {
		$show_face = "false";
		$width = "450";
		$height = "35";
	}
	else {
		$show_face = get_option('etb_show_faces_facebook');
		$width = "450";
		$height = "80";
	}
}

	// iFrame
	if ($choix_like != "" and empty($id_apps_facebook)) {

	$fb_like='<iframe src="http://www.facebook.com/plugins/like.php?locale='.$lang.'&href='.$url.'&amp;layout='.$layout.'&amp;show_faces='.$show_face.'&amp;width='.$width.'&amp;action=like&amp;font='.$font.'&amp;colorscheme='.$colorscheme.'" scrolling="no" frameborder="0" allowTransparency="true" style="border:none; overflow:hidden; width:'.$width.'px; height:'.$height.'px;"></iframe>';
	
}



	// XFBML 
	elseif ($choix_like != "" and !empty($id_apps_facebook)) {
	$fb_like= '<fb:like href="'.urlencode(get_permalink($post->ID)).'" layout="'.$layout.'" show-faces="'.$show_face.'" width="'.$width.'" action="like" colorscheme="'.$colorscheme.'" font="'.$font.'"></fb:like>';
}
else {$fb_like = "";}

// Twitter button
	$choix_tweet = get_option('etb_choix_tweet');
	$choix_tweet_format = get_option('etb_tweet_format');
	$twitter_login = get_option('etb_twitter');
	

if ($choix_tweet_format == "vertical" or $choix_tweet_format == "none") {
	$width_twiter = "65";
} else {
	$width_twiter = "110";
}
	
	
	if (!empty($twitter_login) and $choix_tweet != "") {
	$twitter='<a href="http://twitter.com/share" rel="nofollow" class="twitter-share-button" data-count="'.$choix_tweet_format.'" data-via="'.$twitter_login.'"></a><script type="text/javascript" src="http://platform.twitter.com/widgets.js" style="padding-left:10px;" ></script>';
	}	
	else {$twitter = "";}
	
	
	
// Google +1 button
	$choix_plusone = get_option('etb_choix_plusone');
	$choix_plusone_format = get_option('etb_plusone_format');
	

if ($choix_plusone_format == "vertical" or $choix_plusone_format == "none") {
	$width_plusone = "65";
} else {
	$width_plusone = "110";
}
	
	
if ( $choix_plusone != "") {
		
	$plusone='<g:plusone size="'.$choix_plusone_format.'"></g:plusone>';
	
}	
	
	
	
	 

//Share	 
$choix_share = get_option('etb_choix_share');

if ($choix_share != "") {   
	global $post;
	setup_postdata($post);
	$description=strip_tags(substr($post->post_content,0,300));

	$partager = '<div style="padding:0;text-decoration:none;"><a href="http://easytoolbox.net" alt="Plugin All in One for Wordpress : Easytoolbox" title="Plugin All in One for Wordpress : Easytoolbox" target="blanck" style="cursor:default;text-decoration:none;color:#666666;">'. __('Share', 'easytoolbox').' </a></div>';     

	// Facebook
	$facebook='<a href="http://www.facebook.com/sharer.php?u='.htmlspecialchars($url).'&t='.get_the_title().'" rel="nofollow" target="_blank"><img src="'.get_bloginfo('wpurl').'/wp-content/plugins/easy-toolbox/scripts/icon-share/facebook.gif" alt="Facebook" title="share on facebook"></a>';
	
	// netvibes
	$netvibes='<a href="http://www.netvibes.com/share?url='.htmlspecialchars($url).'&title='.get_the_title().'" rel="nofollow" target="_blank"><img src="'.get_bloginfo('wpurl').'/wp-content/plugins/easy-toolbox/scripts/icon-share/netvibes.png" alt="Netvibes" title="share on netvibes" ></a>';
	    
	// Delicious
	    $etb_delicious='<a href="http://del.icio.us/post?url='.urlencode(get_permalink($post->ID)).'&title='.urlencode(get_the_title()).'&notes='.$description.'" rel="nofollow" target="_blank"><img src="'.get_bloginfo('wpurl').'/wp-content/plugins/easy-toolbox/scripts/icon-share/delicious.png" alt="Delicious" title="Share on Del.ico.us"></a>';

	// Technoratie	    
	    $technoratie='<a href="http://technorati.com/cosmos/search.html?url='.urlencode(get_permalink($post->ID)).'" rel="nofollow" target="_blank"><img src="'.get_bloginfo('wpurl').'/wp-content/plugins/easy-toolbox/scripts/icon-share/technorati.png" alt="Technorati" title="Save on Technorati"></a>';
	    
	// Wikio
	$wikio='<a href="http://www.wikio.fr/vote?url='.$url.'" target="_blank" rel="nofollow"><img src="http://www.wikio.fr/shared/img/vote/wikio2.gif" alt="Wikio" title="Share on Wikio"/></a>';

	// DIGG  
	    $digg='<a href="http://digg.com/submit?phase=2&url='.urlencode(get_permalink($post->ID)).'" rel="nofollow" target="blank"><img src="'.get_bloginfo('wpurl').'/wp-content/plugins/easy-toolbox/scripts/icon-share/digg.gif" alt="Digg" title="Share on DIGG"></a>';	    

	// Easytoolbox  
	    $etb='<a href="http://easytoolbox.net" target="blank"><img src="'.get_bloginfo('wpurl').'/wp-content/plugins/easy-toolbox/scripts/icon-share/plugin_link.png" alt="Plugin Wordpress EasyToolbox. SEO, facebook, twitter, adsence and more" title="Plugin Wordpress EasyToolbox. SEO, facebook, twitter, adsence and more"></a>';	    
}	

	// Adsense

$choix_adsense = get_option('etb_choix_adsense');
$ad_content = get_option('etb_ad_content');
$google_ad_content_top = "\n".get_option('etb_google_ad_content_top')."\n";
$google_ad_content_bottom = "\n".get_option('etb_google_ad_content_bottom')."\n";
$count = get_option('etb_count_content');
$adsense = get_option('etb_google_id');

	// Ad_haut
	if ($choix_adsense == "1" && ($ad_content == "1" || $ad_content == "3") && is_single()){
		$ad_top = $google_ad_content_top;
				}
	else {$ad_top = "";}
	// Ad_bas
	if ($choix_adsense == "1" && ($ad_content == "2" || $ad_content == "3") && is_single()) {
		$ad_bottom = '<div class="ads">'.$google_ad_content_bottom.'</div>';
		} else {
		$ad_bottom = "";
		}
?>
<STYLE type="text/css"><!--
.social  {margin:0px;padding:0px;height:20px;width:100%;float:none;text-decoration:none;}
.social a {margin:0 !important;padding:0 !important;text-decoration:none;}
.social a:hover {margin:0 !important;padding:0 !important;text-decoration:none !important;}
.social ul {display:inline;margin:0 !important;padding:0 !important;}
.social li {display:block !important;float:left;list-style-type:none;margin:0px;padding:0px;}
.social img {border:0 none;width:20px;height:20px;margin:0px;padding:0px 8px 0px 0px;}
.social img a {margin:0;padding:0;}

.twitter  {margin:0px;padding:0px 10px 10px 0;width:<?php echo $width_twiter ?>px;float:left;}
.facebook  {margin:0 0 10px 0px;padding:0px 0 10px 0px;width:<?php echo $width ?>px;}

.ads  {margin:0px;padding:0px;padding-top:10px;width:450px;}
--></STYLE>
<?php

	if ($choix_share != "") { 
	$logo_share = '<div class="social"><ul><li>'.$facebook.'</li><li>'.$netvibes.'</li><li>'.$etb_delicious.'</li><li>'.$technoratie.'</li><li>'.$wikio.'</li><li>'.$digg.'</li><li>'.$etb.'</li></ul></div>'."\n";
	} else {
	$logo_share = "\n";
	}
	
	$content=$ad_top.$content."\n".'<div class="twitter">'.$twitter.'</div>'.'<div class="plusone">'.$plusone.'</div>'."\n"."\n".'<div class="facebook">'.$fb_like.'</div><br/>'.$logo_share.$ad_bottom;
	}
	   
	   return $content;
}
	
add_filter('the_content', 'new_content');	

?>