<?php
/**
 * @package Feedjit
 * @author Feedjit Inc.
 * @version 1.0.2
 */
/*
Plugin Name: Feedjit Live Traffic Feed
Plugin URI: http://feedjit.com/
Description: Feedjit's Live Traffic Feed shows your recent visitors in your blog side-bar. Click the "Watch in Real-Time" link at the bottom to watch your visitors arrive on your site in real-time, see where they came from, what browser and operating system they're running, which page they land on and what they click to leave. 
Author: Feedjit Inc.
Version: 1.0.2
Author URI: http://feedjit.com/
*/
function feedjit_version(){ return '1.0.2'; }
function feedjit_widget(){
	$o = get_option('feedjit_options');
	echo '<script type="text/javascript" src="http://feedjit.com/serve/?' . 
		'wid=38f288b0ffbe9e18' . 
		'&amp;pid=0' . 
		'&amp;proid=0' . 
		'&amp;vv=693' . 
		'&amp;dd=' . 
		'&amp;bc=' . $o['backgroundColor'] . 
		'&amp;tc=' . $o['textColor'] .
		'&amp;brd1=' . $o['borderColor'] . 
		'&amp;lnk=' . $o['linkColor'] . 
		'&amp;hc=' . $o['headingColor'] .
		'&amp;hfc=' . $o['headerFooterColor'] .
		'&amp;btn=' . $o['buttonColor'] .
		'&amp;ww=' . $o['width'] .
		'&amp;tft=3' .
				'"></script><noscript><a href="http://feedjit.com/">Feedjit Live Traffic Feed</a></noscript>';
}
function feedjit_control(){
	$o = get_option('feedjit_options');
	if($_POST['fj_dataSent']){
		foreach(array('width', 'backgroundColor', 'textColor', 'headingColor', 'borderColor', 'linkColor', 'headerFooterColor', 'buttonColor') as $key){
			$fjkey = 'fj_' . $key;
			$o[$key] = $_POST[$fjkey];
		}
		update_option('feedjit_options', $o);
	}
	echo(
		'<input type="hidden" name="fj_dataSent" value="1" /><table border="0" cellpadding="2" cellspacing="0">' .
		'<tr><td>Width in pixels:</td><td><input type="text" name="fj_width" value="' . $o['width'] . '" size="3" /></td></tr>' .
		'<tr><td>Background color:</td><td><input class="feedjitColor" type="text" name="fj_backgroundColor" value="' . $o['backgroundColor'] . '" size="6" /></td></tr>' .
		'<tr><td>Text color:</td><td><input class="feedjitColor" type="text" name="fj_textColor" value="' . $o['textColor'] . '" size="6" /></td></tr>' .
		'<tr><td>Heading color:</td><td><input class="feedjitColor" type="text" name="fj_headingColor" value="' . $o['headingColor'] . '" size="6" /></td></tr>' .
		'<tr><td>Border color:</td><td><input class="feedjitColor" type="text" name="fj_borderColor" value="' . $o['borderColor'] . '" size="6" /></td></tr>' .
		'<tr><td>Link color:</td><td><input class="feedjitColor" type="text" name="fj_linkColor" value="' . $o['linkColor'] . '" size="6" /></td></tr>' .
		
		'<tr><td>Header/Footer:</td><td><input class="feedjitColor" type="text" name="fj_headerFooterColor" value="' . $o['headerFooterColor'] . '" size="6" /></td></tr>' .
		'<tr><td>Button color:</td><td><input class="feedjitColor" type="text" name="fj_buttonColor" value="' . $o['buttonColor'] . '" size="6" /></td></tr>' .
		
				'</table>' .
		'<script type="text/javascript">jscolor.init();</script>'

		
	);
}
function feedjit_loaded(){
	feedjit_setDefaultOpts();
	$widget_ops = array('classname' => 'Feedjit', 'description' => "Feedjit Live Traffic Feed." );
	wp_register_sidebar_widget('feedjit_widget', 'Feedjit', 'feedjit_widget', $widget_ops);
	register_widget_control('feedjit_widget', 'feedjit_control');
}
function feedjit_setDefaultOpts(){
	$defaults = array(
		'width' => 200,
		'backgroundColor' => '000000',
		'textColor' => 'F5F5F5',
		'headingColor' => 'FFFFFF',
		'borderColor' => '454545',
		'linkColor' => 'C95050',
		'headerFooterColor' => '5C5A5A',
		'buttonColor' => '8A0214',
				);

	$o = get_option('feedjit_options');
	$missing = false;
	if(! $o){
		$missing = true;
	} else {
		foreach(array_keys($defaults) as $k){
			if((! isset($o[$k])) && (! preg_match("/(?:hideLogo|hideLinks|wHead)/", $k)) ){
				$missing = true;
				break;
			}
		}
	}
	if($missing){
		update_option('feedjit_options', $defaults);
	}
}
function feedjit_head(){
	echo '<script type="text/javascript">var feedjit_pid="0"; var feedjit_wid="38f288b0ffbe9e18"; var feedjit_proid="0"; var feedjit_version="1.0.2";</script><script type="text/javascript" src="http://feedjit.com/js/wp/wp.js"></script>';
}

add_action('plugins_loaded','feedjit_loaded');
add_action('admin_head', 'feedjit_head');

