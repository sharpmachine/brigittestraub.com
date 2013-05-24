<?php
/*
Plugin Name: Youtube with fancy zoom
Plugin URI: http://www.gopiplus.com/work/2010/07/18/youtube-with-fancy-zoom/
Description: Youtube with fancy zoom plugin is a media viewing application that supports webs most popular youtube video. This is a jQuery based fancy zoom.  
Author: Gopi.R
Version: 9.0
Author URI: http://www.gopiplus.com/work/2010/07/18/youtube-with-fancy-zoom/
Donate link: http://www.gopiplus.com/work/2010/07/18/youtube-with-fancy-zoom/
*/

global $wpdb, $wp_version;
define("WP_G_YWFZ_TABLE", $wpdb->prefix . "g_ywfz");

function g_ywfz_show() 
{
	include_once("inc/ywfz_widget.php");
}

function g_ywfz_install() 
{
	global $wpdb;
	
	if($wpdb->get_var("show tables like '". WP_G_YWFZ_TABLE . "'") != WP_G_YWFZ_TABLE) 
	{
		$wpdb->query("
			CREATE TABLE `". WP_G_YWFZ_TABLE . "` (
				`ywfz_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
				`ywfz_title` VARCHAR( 1024 ) NOT NULL ,
				`ywfz_watch` VARCHAR( 1024 ) NOT NULL ,
				`ywfz_code` VARCHAR( 100 ) NOT NULL ,
				`ywfz_img` VARCHAR( 200 ) NOT NULL ,
				`ywfz_size` VARCHAR( 10 ) NOT NULL ,
				`ywfz_imglink` VARCHAR( 1024 ) NOT NULL ,
				`ywfz_status` VARCHAR( 10 ) NOT NULL ,
				`ywfz_sidebar` VARCHAR( 10 ) NOT NULL ,
				`ywfz_expire` DATE NOT NULL
				) ENGINE = MYISAM ;
			");
		$sSql = "insert into `". WP_G_YWFZ_TABLE . "` set `ywfz_title`='Continuous rss scrolling drupal module', ";
		$sSql = $sSql . "`ywfz_watch`='http://www.youtube.com/watch?v=5TSPlykcdYk', ";
		$sSql = $sSql . "`ywfz_code`='5TSPlykcdYk', ";
		$sSql = $sSql . "`ywfz_img`='Youtube Thumbnail', ";
		$sSql = $sSql . "`ywfz_size`='0', `ywfz_imglink`='', ";
		$sSql = $sSql . "`ywfz_status`='Yes', `ywfz_sidebar`='Yes';";
		$wpdb->query($sSql);
		$sSql = "insert into `". WP_G_YWFZ_TABLE . "` set";
		$sSql = $sSql . " `ywfz_title`='Email newsletter wordpress plugin',";
		$sSql = $sSql . "`ywfz_watch`='http://www.youtube.com/watch?v=m0kWQOI8HOg',";
		$sSql = $sSql . "`ywfz_code`='m0kWQOI8HOg',";
		$sSql = $sSql . "`ywfz_img`='Youtube Thumbnail', ";
		$sSql = $sSql . "`ywfz_size`='0', `ywfz_imglink`='', ";
		$sSql = $sSql . "`ywfz_status`='Yes', `ywfz_sidebar`='Yes';";
		$wpdb->query($sSql);
	}
	
	add_option('g_ywfz_title', "Youtube Video");
	add_option('g_ywfz_width', "200");
	add_option('g_ywfz_height', "150");
	add_option('g_ywfz_rand', "5");
}

function g_ywfz_widget($args) 
{
	extract($args);
	echo $before_widget . $before_title;
	echo get_option('g_ywfz_title');
	echo $after_title;
	g_ywfz_show();
	echo $after_widget;
}

function g_ywfz_admin_option() 
{
	
	?>
    <div class="wrap">
    <?php
    $mainurl = get_option('siteurl')."/wp-admin/options-general.php?page=youtube-with-fancy-zoom/youtube-with-fancy-zoom.php";
    ?>
    <h2>Youtube with fancy zoom</h2>
    <?php
	global $wpdb;
    @$AID=@$_GET["AID"];
    @$AC=@$_GET["AC"];
    @$rand=$_GET["rand"];
    $submittext = "Insert";
	if($AC <> "DEL" and trim(@$_POST['ywfz_title']) <>"") { include_once("inc/ywfz_insert.php"); }
    if($AC=="DEL" && $AID > 0) { include_once("inc/ywfz_delete.php"); }
    if(@$AID<>"" and @$AC <> "DEL")
    {
        $data = $wpdb->get_results("select * from ".WP_G_YWFZ_TABLE." where ywfz_id=$AID limit 1");
        if ( empty($data) ) 
        {
            echo "";
            return;
        }
        $data = $data[0];
        //encode strings
        if ( !empty($data) ) $ywfz_title_x = htmlspecialchars(stripslashes($data->ywfz_title)); 
        if ( !empty($data) ) $ywfz_watch_x = htmlspecialchars(stripslashes($data->ywfz_watch));
        if ( !empty($data) ) $ywfz_code_x = htmlspecialchars(stripslashes($data->ywfz_code));
        if ( !empty($data) ) $ywfz_img_x = htmlspecialchars(stripslashes($data->ywfz_img));
		if ( !empty($data) ) $ywfz_size_x = htmlspecialchars(stripslashes($data->ywfz_size));
		if ( !empty($data) ) $ywfz_imglink_x = htmlspecialchars(stripslashes($data->ywfz_imglink));
		if ( !empty($data) ) $ywfz_status_x = htmlspecialchars(stripslashes($data->ywfz_status));
		if ( !empty($data) ) $ywfz_sidebar_x = htmlspecialchars(stripslashes($data->ywfz_sidebar));
		if ( !empty($data) ) $ywfz_id_x = htmlspecialchars(stripslashes($data->ywfz_id));
        $submittext = "Update";
    }
    ?>
    <?php include_once("inc/ywfz_form.php"); ?>
	<div align="right" style="padding-top:5px;padding-bottom:5px;;float:right;"> 
	<input name="text_management" lang="text_management" class="button-primary" onClick="location.href='options-general.php?page=youtube-with-fancy-zoom/youtube-with-fancy-zoom.php'" value="Go to - Video management" type="button" />
	<input name="setting_management" lang="setting_management" class="button-primary" onClick="location.href='options-general.php?page=youtube-with-fancy-zoom/ywfz_widget_setting.php'" value="Go to - Setting Page" type="button" />
	<input name="Help1" lang="publish" class="button-primary" onclick="_ywfz_help()" value="Help" type="button" />
	</div>
    <?php include_once("inc/ywfz_manage.php"); ?>
    <?php include_once("ywfz_help.php"); ?>
</div>
    <?php
}

function g_ywfz_control()
{
	echo '<p>Youtube with fancy zoom.<br> To change the setting go to Youtube with fancy zoom link under SETTING TAB.';
	echo '<br><a href="options-general.php?page=youtube-with-fancy-zoom/ywfz_widget_setting.php">';
	echo 'click here</a>.</p>';
	
}

function g_ywfz_widget_init() 
{
	if(function_exists('wp_register_sidebar_widget')) 	
	{
		wp_register_sidebar_widget('g_ywfz', 'Youtube with fancy zoom', 'g_ywfz_widget');
	}
	if(function_exists('wp_register_widget_control')) 	
	{
		wp_register_widget_control('g_ywfz', array('Youtube with fancy zoom', 'widgets'), 'g_ywfz_control');
	} 
}

function g_ywfz_deactivation() 
{
	delete_option('g_ywfz_title');
	delete_option('g_ywfz_width');
	delete_option('g_ywfz_height');
	delete_option('g_ywfz_rand');
}

function g_ywfz_add_to_menu() 
{
	add_options_page('Youtube fancy zoom', 'Youtube fancy zoom', 'manage_options', __FILE__, 'g_ywfz_admin_option' );
	add_options_page('Youtube fancy zoom', '', 'manage_options', "youtube-with-fancy-zoom/ywfz_widget_setting.php",'' );
}

if (is_admin()) 
{
	add_action('admin_menu', 'g_ywfz_add_to_menu');
}

add_action('admin_menu', 'g_ywfz_add_to_menu');
add_action("plugins_loaded", "g_ywfz_widget_init");
register_activation_hook(__FILE__, 'g_ywfz_install');
register_deactivation_hook(__FILE__, 'g_ywfz_deactivation');
add_action('init', 'g_ywfz_widget_init');

add_filter('the_content','g_ywfz_show_filter');

function g_ywfz_show_filter($content){
	return 	preg_replace_callback('/\[YoutubeFancyZoom=(.*?)\]/sim','g_ywfz_show_filter_Callback',$content);
}

function g_ywfz_show_filter_Callback($matches) 
{
	//echo $matches[1];
	$g_ywfz_pp = "";
	$ywfz_code = $matches[1];
	$g_ywfz_siteurl = get_option('siteurl');
	$g_ywfz_pluginurl = $g_ywfz_siteurl . "/wp-content/plugins/youtube-with-fancy-zoom/";
	global $wpdb;

	$sSql = "select * from ". WP_G_YWFZ_TABLE . " where ywfz_code='".$ywfz_code."'";
	$data = $wpdb->get_results($sSql);
	
    $g_ywfz_pp = $g_ywfz_pp . '<script type="text/javascript" src="'.$g_ywfz_pluginurl.'includes/jquery.min.js"></script>';
	$g_ywfz_pp = $g_ywfz_pp . '<link rel="stylesheet" href="'.$g_ywfz_pluginurl.'includes/youtube-with-fancy-zoom.css" type="text/css" media="screen" charset="utf-8" />';
	$g_ywfz_pp = $g_ywfz_pp . '<script src="'.$g_ywfz_pluginurl.'includes/youtube-with-fancy-zoom.js" type="text/javascript" charset="utf-8"></script>';
	
	if ( ! empty($data) ) 
	{
		foreach ( $data as $data ) 
		{ 
			if($data->ywfz_img == 'Youtube Thumbnail')
			{
				$imgsource = '<img src="http://img.youtube.com/vi/'.$data->ywfz_code.'/2.jpg" alt="'.$data->ywfz_title.'" />';
			}
			else
			{
				$imgsource = '<img src="'.$data->ywfz_imglink.'" alt="'.$data->ywfz_title.'" />';
			}	

			$g_ywfz_pp = $g_ywfz_pp . '<div class="gallery ywfz">'; 
				$g_ywfz_pp = $g_ywfz_pp . '<a href="'.$data->ywfz_watch.'" rel="g_ywfz[post]" title="'.$data->ywfz_title.'">';
				$g_ywfz_pp = $g_ywfz_pp . $imgsource;
				$g_ywfz_pp = $g_ywfz_pp . '</a>';
			$g_ywfz_pp = $g_ywfz_pp . '</div>';

		}
	}
	$g_ywfz = "'g_ywfz'";
	$g_ywfz_theme = "'g_ywfz_theme'";
   	$g_ywfz_pp = $g_ywfz_pp . '<script type="text/javascript" charset="utf-8">';
	$g_ywfz_pp = $g_ywfz_pp . '$(document).ready(function(){$(".gallery a[rel^='.$g_ywfz.']").g_ywfz({theme:'.$g_ywfz_theme.'});});';
	$g_ywfz_pp = $g_ywfz_pp . '</script>';
	return $g_ywfz_pp;
}
?>
