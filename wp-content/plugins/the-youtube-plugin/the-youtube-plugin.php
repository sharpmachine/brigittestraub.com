<?php
/*
Plugin Name: The YouTube Plugin
Plugin URI: http://www.couponcondo.com/plugins/the-youtube-plugin
Description: Show recent YouTube videos from 1 account or for a specific search term as a widget on your blog!
Version: 1.0.3
Author: CouponCondo.com
Author URI: http://www.couponcondo.com
*/

/*  Copyright 2011 Coupon Condo - E-Mail: support@couponcondo.com

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Hook for adding admin menus
add_action('admin_menu', 'youtube_plugin_plugin_add_pages');
add_action('wp_head','youtube_plugin_delete_cache');
add_action('delete_youtube_plugin_cache','delete_youtube_plugin_cache');

// action function for above hook
function youtube_plugin_plugin_add_pages() {
    add_options_page('YouTube Plugin', 'YouTube Plugin', 'administrator', 'youtube', 'youtube_plugin_options_page');
}

function youtube_plugin_options_page() {

    // variables for the field and option names 
    $opt_name = 'youtube_plugin_account';
    $opt_name_2 = 'youtube_plugin_limit';
	$opt_name_3 = 'youtube_plugin_query';
	$opt_name_4 = 'youtube_plugin_title2';
    $opt_name_5 = 'youtube_plugin_plugin_support';
    $opt_name_6 = 'youtube_plugin_title';
    $opt_name_7 = 'youtube_plugin_desc';
    $opt_name_9 = 'youtube_plugin_cache';
    $opt_name_11 = 'youtube_plugin_color';
    $opt_name_12 = 'youtube_plugin_size';
    $opt_name_13 = 'youtube_plugin_widgetuser';

    $hidden_field_name = 'youtube_plugin_submit_hidden';

    $data_field_name = 'youtube_plugin_account';
    $data_field_name_2 = 'youtube_plugin_limit';
	$data_field_name_3 = 'youtube_plugin_query';
	$data_field_name_4 = 'youtube_plugin_title2';
    $data_field_name_5 = 'youtube_plugin_plugin_support';
    $data_field_name_6 = 'youtube_plugin_title';
    $data_field_name_7 = 'youtube_plugin_desc';
    $data_field_name_9 = 'youtube_plugin_cache';
    $data_field_name_11 = 'youtube_plugin_color';
    $data_field_name_12 = 'youtube_plugin_size';
    $data_field_name_13 = 'youtube_plugin_widgetuser';

    // Read in existing option value from database
    $opt_val = get_option( $opt_name );
    $opt_val_2 = get_option($opt_name_2);
	$opt_val_3 = get_option($opt_name_3);
	$opt_val_4 = get_option($opt_name_4);
    $opt_val_5 = get_option($opt_name_5);
    $opt_val_6 = get_option($opt_name_6);
    $opt_val_7 = get_option($opt_name_7);
    $opt_val_9 = get_option($opt_name_9);
    $opt_val_11 = get_option($opt_name_11);
    $opt_val_12 = get_option($opt_name_12);
    $opt_val_13 = get_option($opt_name_13);
    
if ($_POST['delcache']=="true") {
update_option("youtube_plugin_cachey", "");
update_option("youtube_plugin_cachey2", "");
}
    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $opt_val = $_POST[ $data_field_name ];
        $opt_val_2 = $_POST[$data_field_name_2];
		$opt_val_3 = $_POST[$data_field_name_3];
		$opt_val_4 = $_POST[$data_field_name_4];
        $opt_val_5 = $_POST[$data_field_name_5];
        $opt_val_6 = $_POST[$data_field_name_6];
        $opt_val_7 = $_POST[$data_field_name_7];
        $opt_val_9 = $_POST[$data_field_name_9];
        $opt_val_11 = $_POST[$data_field_name_11];
        $opt_val_12 = $_POST[$data_field_name_12];
        $opt_val_13 = $_POST[$data_field_name_13];

        // Save the posted value in the database
        update_option( $opt_name, $opt_val );
        update_option( $opt_name_2, $opt_val_2 );
		update_option( $opt_name_3, $opt_val_3 );
		update_option( $opt_name_4, $opt_val_4 );
        update_option( $opt_name_5, $opt_val_5 );
        update_option( $opt_name_6, $opt_val_6 ); 
        update_option( $opt_name_7, $opt_val_7 ); 
        update_option( $opt_name_9, $opt_val_9 );
        update_option( $opt_name_11, $opt_val_11 );
        update_option( $opt_name_12, $opt_val_12 );
        update_option( $opt_name_13, $opt_val_13 );
		update_option("youtube_plugin_cachey", "");
		update_option("youtube_plugin_cachey2", "");

        // Put an options updated message on the screen

?>
<div class="updated"><p><strong><?php _e('Options saved.', 'pl_trans_domain' ); ?></strong></p></div>
<?php

    }

    // Now display the options editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'YouTube Plugin Settings', 'pl_trans_domain' ) . "</h2>";

    // options form
   
    $change3 = get_option("youtube_plugin_plugin_support");
    $change6 = get_option("youtube_plugin_cache");
    $change7 = get_option("youtube_plugin_widgetuser");
    $change8 = get_option("youtube_plugin_desc");

if ($change3=="Yes") {
$change3="checked";
$change31="";
} else {
$change3="";
$change31="checked";
}

if ($change5=="user" || $change5=="") {
$change5="checked";
$change51="";
} else {
$change5="";
$change51="checked";
}

if ($change7=="user" || $change7=="") {
$change7="checked";
$change71="";
} else {
$change7="";
$change71="checked";
}

if ($change8=="Yes") {
$change8="checked";
$change81="";
} else {
$change8="";
$change81="checked";
}

if ($opt_val_9=="") {
$opt_val_9=10;
}

if ($opt_val_12=="") {
$opt_val_12=2;
}

    ?>
	
<form name="form1" method="post" action="">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

<h3>User Videos Widget Options</h3>
<p><?php _e("Widget Title:", 'pl_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_6; ?>" value="<?php echo $opt_val_6; ?>" size="50">
</p><hr />

<p><?php _e("YouTube Username:", 'pl_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name; ?>" value="<?php echo $opt_val; ?>" size="20">
</p><hr />

<p><?php _e("Display video description?", 'pl_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_7; ?>" value="Yes" <?php echo $change8; ?>>Yes
<input type="radio" name="<?php echo $data_field_name_7; ?>" value="No" <?php echo $change81; ?> >No
</p><hr />

<p><?php _e("Link Widget Title to Profile?", 'pl_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_13; ?>" value="Yes" <?php echo $change7; ?>>Yes
<input type="radio" name="<?php echo $data_field_name_13; ?>" value="No" <?php echo $change71; ?> >No
</p><hr />

<h3>Search Results Videos Widget Options</h3>
<p><?php _e("Search Widget Title:", 'pl_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_4; ?>" value="<?php echo $opt_val_4; ?>" size="50">
</p><hr />

<p><?php _e("Search Query:", 'pl_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_3; ?>" value="<?php echo $opt_val_3; ?>" size="20">
</p><hr />

<h3>General Options</h3>
<p><?php _e("Number of Videos to Show:", 'pl_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_2; ?>" value="<?php echo $opt_val_2; ?>" size="3">
</p><hr />

<p><?php _e("How long should the cache last for?", 'pl_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_9; ?>" value="<?php echo $opt_val_9; ?>" size="4"> Minutes
</p><hr />

<p><?php _e("Support this plugin?", 'pl_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_5; ?>" value="Yes" <?php echo $change3; ?>>Yes
<input type="radio" name="<?php echo $data_field_name_5; ?>" value="No" <?php echo $change31; ?> >No
</p><hr />

<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Update Options', 'pl_trans_domain' ) ?>" />
</p><hr />

</form>

<h3>Delete Cache</h3>

<p>This plugin stores the results of the YouTube for a brief period of time in order to lower requests to the YouTube API. If something has changed and you don't want to wait for the cache to refresh, press the button below.</p>

<form action="" method="post"><input type="hidden" name="delcache" value="true" /><input type="submit" value="Delete Cache" /></form><br /><br />
</div>
<?php
 
}

function youtube_plugin_delete_cache() {
$optionyoutubecache = get_option("youtube_plugin_cache");

$optionyoutubecache=$optionyoutubecache*60;

$schedule=wp_next_scheduled("delete_youtube_plugin_cache");

if ($schedule=="") {
wp_schedule_single_event(time()+$optionyoutubecache, 'delete_youtube_plugin_cache'); 
}
}

function delete_youtube_plugin_cache() {
update_option("youtube_plugin_cachey", "");
update_option("youtube_plugin_cachey2", "");
}

function show_youtube_plugin_user($args) {

extract($args);

  $widget_title = get_option("youtube_plugin_title"); 
  $max_tracks = get_option("youtube_plugin_limit");  
  $optionyoutube = get_option("youtube_plugin_account");
  $supportplugin = get_option("youtube_plugin_plugin_support"); 
  $optionyoutubecache = get_option("youtube_plugin_cache");
  $youtubechoice = "user";
  $youtubequery = get_option("youtube_plugin_query");
  $fontcolor = get_option("youtube_plugin_color");
  $widgetuser = get_option("youtube_plugin_widgetuser");

if ($max_tracks=="" || $max_tracks==0) {
$max_tracks=5;
}

if ($widget_title=="") {
$widget_title="YouTube";
}
  
if (!$optionyoutube=="") {

$widget_title=str_replace("%user%", $optionyoutube, $widget_title);

$doc = new DOMDocument();
$usr = new DOMDocument();

if ($youtubechoice=="" || $youtubechoice=="user") {
$docload='http://gdata.youtube.com/feeds/api/users/'.$optionyoutube.'/uploads';
} else if ($youtubechoice=="search") {
$docload='http://gdata.youtube.com/feeds/api/videos?q='.$youtubequery.'&max-results='.$max_tracks.'&v=2';
}

if($doc->load($docload)) {

  $i = 1;

$usrload='http://gdata.youtube.com/feeds/api/users/'.$optionyoutube;

if ($usr->load($usrload)) {

foreach ($doc->getElementsByTagName('entry') as $node) {
    $t_usr = $node->getElementsByTagName('media:thumbnail')->item(0);
    $usr_pic = $t_usr->nodeValue;	
}
}

$cachey = get_option("youtube_plugin_cachey");

if (!$cachey=="") {
if (!$optionyoutubecache=="0") {
echo $cachey;

youtube_plugin_delete_cache();
}

} else {
$youtubedisp="";

if ($widgetuser=="Yes") {
$widget_title="<a href='http://www.youtube.com/user/".$optionyoutube."'>".$widget_title."</a>";
}

  $youtubedisp .= $before_widget;

$youtubedisp .= "<img src='".$usr_pic."' align='left' />".$before_title; 

  $youtubedisp .= $widget_title.$after_title."<br /><ul>";

  foreach ($doc->getElementsByTagName('entry') as $node) {

    $t_title = $node->getElementsByTagName('title')->item(0);
    $title = $t_title->nodeValue;	
	$t_url = $node->getElementsByTagName('id')->item(0);
	$url = $t_url->nodeValue;
	$t_content = $node->getElementsByTagName('content')->item(0);
	$content = $t_content->nodeValue;
	
if ($youtubechoice=="" || $youtubechoice=="user") {
ereg("http://gdata.youtube.com/feeds/api/videos/(.)(.)(.)(.)(.)(.)(.)(.)(.)(.)(.)",$url,$regs);
} else if ($youtubechoice=="search") {
ereg("video:(.)(.)(.)(.)(.)(.)(.)(.)(.)(.)(.)",$url,$regs);
}

$ending="{$regs[1]}{$regs[2]}{$regs[3]}{$regs[4]}{$regs[5]}{$regs[6]}{$regs[7]}{$regs[8]}{$regs[9]}{$regs[10]}{$regs[11]}";

$url = "http://www.youtube.com/watch?v=".$ending;

if (get_option('youtube_plugin_size')=="") {
update_option('youtube_plugin_size', '2');
}

if (get_option("youtube_plugin_desc")=="Yes") {
    $youtubedisp .= '<li><a href="'.$url.'">'.$title.'</a><br />'.$content.'</li>';
} else {
    $youtubedisp .= '<li><a href="'.$url.'">'.$title.'</a></li>';
}
 
    if($i++ >= $max_tracks) break;
  }

  $youtubedisp .= "</ul>";
  
if ($supportplugin=="Yes" || $supportplugin=="") {
$youtubedisp .= "<p style='font-size:x-small'>YouTube Plugin made by <a href='http://www.open-office-download.net'>Open Office</a>.</p>";
}

$youtubedisp .= $after_widget;

echo $youtubedisp;

update_option("youtube_plugin_cachey", $youtubedisp);

}

}

}

}

function show_youtube_plugin_query($args) {

extract($args);

  $widget_title = get_option("youtube_plugin_title2"); 
  $max_tracks = get_option("youtube_plugin_limit");  
  $optionyoutube = get_option("youtube_plugin_account");
  $supportplugin = get_option("youtube_plugin_plugin_support"); 
  $optionyoutubecache = get_option("youtube_plugin_cache");
  $youtubechoice = "search";
  $youtubequery = get_option("youtube_plugin_query");
  $fontcolor = get_option("youtube_plugin_color");
  
if ($max_tracks=="" || $max_tracks==0) {
$max_tracks=5;
}

if ($widget_title=="") {
$widget_title="YouTube";
}
  
if (!$optionyoutube=="") {

$widget_title=str_replace("%user%", $optionyoutube, $widget_title);

$doc = new DOMDocument();

if ($youtubechoice=="" || $youtubechoice=="user") {
$docload='http://gdata.youtube.com/feeds/api/users/'.$optionyoutube.'/uploads';
} else if ($youtubechoice=="search") {
$docload='http://gdata.youtube.com/feeds/api/videos?q='.$youtubequery.'&max-results='.$max_tracks.'&v=2';
}
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $docload);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$xml_string = curl_exec($ch);
curl_close($ch);

if ($doc->loadXML($xml_string)) {


  $i = 1;

$cachey = get_option("youtube_plugin_cachey2");

if (!$cachey=="") {
if (!$optionyoutubecache=="0") {
echo $cachey;

youtube_plugin_delete_cache();
}

} else {
$youtubedisp="";

  $youtubedisp .= $before_widget.$before_title; 

  $youtubedisp .= $widget_title.$after_title."<br /><ul>";

  foreach ($doc->getElementsByTagName('entry') as $node) {

    $t_title = $node->getElementsByTagName('title')->item(0);
    $title = $t_title->nodeValue;	
	$t_url = $node->getElementsByTagName('id')->item(0);
	$url = $t_url->nodeValue;
	$t_content = $node->getElementsByTagName('content')->item(0);
	$content = $t_content->nodeValue;
	
if ($youtubechoice=="" || $youtubechoice=="user") {
ereg("http://gdata.youtube.com/feeds/api/videos/(.)(.)(.)(.)(.)(.)(.)(.)(.)(.)(.)",$url,$regs);
} else if ($youtubechoice=="search") {
ereg("video:(.)(.)(.)(.)(.)(.)(.)(.)(.)(.)(.)",$url,$regs);
}

$ending="{$regs[1]}{$regs[2]}{$regs[3]}{$regs[4]}{$regs[5]}{$regs[6]}{$regs[7]}{$regs[8]}{$regs[9]}{$regs[10]}{$regs[11]}";

$url = "http://www.youtube.com/watch?v=".$ending;

if (get_option('youtube_plugin_size')=="") {
update_option('youtube_plugin_size', '2');
}

    $youtubedisp .= '<li><a href="'.$url.'">'.$title.'</a></li>';
 
    if($i++ >= $max_tracks) break;
  }

  $youtubedisp .= "</ul>";
  
if ($supportplugin=="Yes" || $supportplugin=="") {
$youtubedisp .= "<p style='font-size:x-small'>YouTube Plugin made by <a href='http://www.open-office-download.net'>Open Office</a>.</p>";
}

$youtubedisp .= $after_widget;

echo $youtubedisp;

update_option("youtube_plugin_cachey2", $youtubedisp);

}

}

}

}

function init_youtube_plugin_widget() {
register_sidebar_widget("YouTube User Videos", "show_youtube_plugin_user");
register_sidebar_widget("YouTube Search Query Videos", "show_youtube_plugin_query");
}

add_action("plugins_loaded", "init_youtube_plugin_widget");

?>
