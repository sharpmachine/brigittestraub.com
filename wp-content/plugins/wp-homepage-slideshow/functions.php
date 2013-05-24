<?php
function hss_get_def_settings()
{
	$hss_settings = array('bannerWidth' => '700',
			'bannerHeight' => '220',
			'autoSlideTime' => '10',
			'showPlay' => '1',
			'backgroundColor' => 'FFFFFF',
			'imagewidth' => '510',
			'gradientColor1' => 'E1ED91',
			'gradientColor2' => 'AFCB5A',
			'menuColor' => 'ebf3e0',
			'menuOverColor' => '7DAA20',
			'menuTextColor' => '21428c',
			'menuOverTextColor' => 'ffffff',
			'transitionTime' => '1',
			'menutransition' => '0.2',
			'menuScrollSpeed' => '15',
			'descbox_visible' => 'yes',
			'boxwidth' => '250',
			'boxheight' => '160',
			'infoFontSizeBig' => '16',
			'infoFontSizeSmall' => '12',
			'menuFontSize' => '12',
			'transition_type' => 'easeIn',
			'transition' => 'left',
			'cornerRadius' => '55',
			'box_x' => '200',
			'box_y' => '20',
			'button_width' => '100',
			'FindMoreColorBack' => '095373',
			'FindMoreColorText' => 'ffffff',
			'FindMoreAlpha' => '0.3',
			'FindMoreName' => 'View More',
			'FindMoreButtonColor' => 'f4c301',
			'FindMoreButtonTextColor' => 'ffffff',
			'pic' => 'modules/mod_homepageslideshow/models/sample_image_1.png&#13;modules/mod_homepageslideshow/models/sample_image_2.png&#13;modules/mod_homepageslideshow/models/sample_image_3.png&#13;modules/mod_homepageslideshow/models/sample_image_4.png',
			'menutxt' => 'News one&#13;News two&#13;News three&#13;News four',
			'showDesBigTxt' => '1',
			'bigtext' => 'Title one&#13;Title two&#13;Titlethree&#13;Title four',
			'showDesSmlTxt' => '1',
			'stext' => 'Description one&#13;Description two&#13;Description three&#13;Description four',
			'links' => 'http://xmlswf.com&#13;http://xmlswf.com&#13;http://xmlswf.com&#13;http://xmlswf.com&#13;',
			'target' => '_self',
			'wmode' => 'transparent'
			);
	return $hss_settings;
}
function __get_hss_xml_settings()
{
	$ops = get_option('hss_settings', array());
	
	$xml_settings ='	<baseDef autoSlideTime="'.$ops['autoSlideTime'].'"   gradientColor1="0x'.$ops['gradientColor1'].'"  showPlay="'.$ops['showPlay'].'"  gradientColor2="0x'.$ops['gradientColor2'].'"  menuColor="0x'.$ops['menuColor'].'" menuOverColor="0x'.$ops['menuOverColor'].'" menuTextColor= "0x'.$ops['menuTextColor'].'" menuOverTextColor="0x'.$ops['menuOverTextColor'].'" transitionTime="'.$ops['transitionTime'].'" menutransition="'.$ops['menutransition'].'" menuScrollSpeed ="'.$ops['menuScrollSpeed'].'" boxwidth="'.$ops['boxwidth'].'" boxheight="'.$ops['boxheight'].'" infoFontSizeBig="'.$ops['infoFontSizeBig'].'" infoFontSizeSmall="'.$ops['infoFontSizeSmall'].'" menuFontSize="'.$ops['menuFontSize'].'"
	transform="null" 
	transition="'.$ops['transition'].'"
	transition_type="'.$ops['transition_type'].'"
	cornerRadius="'.$ops['cornerRadius'].'"
	box_x="'.$ops['box_x'].'"
	box_y="'.$ops['box_y'].'"
	button_width="'.$ops['button_width'].'"
	description_box_visible="'.($ops['descbox_visible']=="yes"?"true":"false").'"
	/>';

	return $xml_settings;
}
function hss_get_album_dir($album_id)
{
	global $ghss;
	$album_dir = HSS_PLUGIN_UPLOADS_DIR . "/{$album_id}_uploadfolder";
	return $album_dir;
}
/**
 * Get album url
 * @param $album_id
 * @return unknown_type
 */
function hss_get_album_url($album_id)
{
	global $ghss;
	$album_url = HSS_PLUGIN_UPLOADS_URL . "/{$album_id}_uploadfolder";
	return $album_url;
}
function hss_get_table_actions(array $tasks)
{
	?>
	<div class="bulk_actions">
		<form action="" method="post" class="bulk_form">Bulk action
			<select name="task">
				<?php foreach($tasks as $t => $label): ?>
				<option value="<?php print $t; ?>"><?php print $label; ?></option>
				<?php endforeach; ?>
			</select>
			<button class="button-secondary do_bulk_actions" type="submit">Do</button>
		</form>
	</div>
	<?php 
}
function shortcode_display_hss_gallery($atts)
{
	$vars = shortcode_atts( array(
									'cats' => '',
									'imgs' => '',
								), 
							$atts );
	//extract( $vars );
	
	$ret = display_hss_gallery($vars);
	return $ret;
}
function display_hss_gallery($vars)
{
	global $wpdb, $ghss;
	$ops = get_option('hss_settings', array());
	//print_r($ops);
	$albums = null;
	$images = null;
	$cids = trim($vars['cats']);
	if (strlen($cids) != strspn($cids, "0123456789,")) {
		$cids = '';
		$vars['cats'] = '';
	}
	$imgs = trim($vars['imgs']);
	if (strlen($imgs) != strspn($imgs, "0123456789,")) {
		$imgs = '';
		$vars['imgs'] = '';
	}
	$categories = '';
	$xml_filename = '';
	if( !empty($cids) && $cids{strlen($cids)-1} == ',')
	{
		$cids = substr($cids, 0, -1);
	}
	if( !empty($imgs) && $imgs{strlen($imgs)-1} == ',')
	{
		$imgs = substr($imgs, 0, -1);
	}
	//check for xml file
	if( !empty($vars['cats']) )
	{
		$xml_filename = "cat_".str_replace(',', '', $cids) . '.xml';	
	}
	elseif( !empty($vars['imgs']))
	{
		$xml_filename = "image_".str_replace(',', '', $imgs) . '.xml';
	}
	else
	{
		$xml_filename = "hss_all.xml";
	}
	//die(HSS_PLUGIN_XML_DIR . '/' . $xml_filename);


	
	if( !empty($vars['cats']) )
	{
		$query = "SELECT * FROM {$wpdb->prefix}hss_albums WHERE album_id IN($cids) AND status = 1 ORDER BY `order` ASC";
		//print $query;
		$albums = $wpdb->get_results($query, ARRAY_A);
		foreach($albums as $key => $album)
		{
			$images = $ghss->hss_get_album_images($album['album_id']);
			if ($images && !empty($images) && is_array($images)) {
				$album_dir = hss_get_album_url($album['album_id']);//HSS_PLUGIN_UPLOADS_URL . '/' . $album['album_id']."_".$album['name'];
				foreach($images as $key => $img)
				{
					if( $img['status'] == 0 ) continue;
						
					$categories .= '	<pic url="'.$img['link'].'" target="'.$ops['target'].'"  
					FindMoreColorBack="0x'.$ops['FindMoreColorBack'].'"  FindMoreColorText="0x'.$ops['FindMoreColorText'].'" FindMoreAlpha="'.$ops['FindMoreAlpha'].'" FindMoreButtonColor="0x'.$ops['FindMoreButtonColor'].'" FindMoreButtonTextColor ="0x'.$ops['FindMoreButtonTextColor'].'" ';

					$categories .= " pic=\"".str_replace(" ","-",$album_dir)."/big/{$img['image']}\">";

					$categories .=  '<FindMoreName><![CDATA['.$ops['FindMoreName'].']]></FindMoreName> ';
					
					if ($ops['showDesBigTxt'] == 1) {

							$FindMoreText = '<![CDATA['.$img['description'].']]>';
					}else{
					$FindMoreText = '';
					}
					$categories .=  '<FindMoreText>'.$FindMoreText.'</FindMoreText> ';
					if ($ops['showDesSmlTxt'] == 1) {
						$FindMoreSText = '<![CDATA['.$img['description2'].']]>';
					}else{
					$FindMoreSText = '';
					}
					$categories .=  '<FindMoreSText>'.$FindMoreSText.'</FindMoreSText> ';
					$categories .=  '<menuText><![CDATA['.$img['title'].']]></menuText>
						</pic>	
					';
				}
			}
		}
		//$xml_filename = "cat_".str_replace(',', '', $cids) . '.xml';
	}
	elseif( !empty($vars['imgs']))
	{
		$query = "SELECT * FROM {$wpdb->prefix}hss_images WHERE image_id IN($imgs) AND status = 1 ORDER BY `order` ASC";
		$images = $wpdb->get_results($query, ARRAY_A);
		if ($images && !empty($images) && is_array($images)) {
			foreach($images as $key => $img)
			{
				$album = $ghss->hss_get_album($img['category_id']);
				$album_dir = hss_get_album_url($album['album_id']);//HSS_PLUGIN_UPLOADS_URL . '/' . $album['album_id']."_".$album['name'];
				if( $img['status'] == 0 ) continue;
				
				$categories .= '	<pic url="'.$img['link'].'" target="'.$ops['target'].'"  
				FindMoreColorBack="0x'.$ops['FindMoreColorBack'].'"  FindMoreColorText="0x'.$ops['FindMoreColorText'].'" FindMoreAlpha="'.$ops['FindMoreAlpha'].'" FindMoreButtonColor="0x'.$ops['FindMoreButtonColor'].'" FindMoreButtonTextColor ="0x'.$ops['FindMoreButtonTextColor'].'" ';

				$categories .= " pic=\"".str_replace(" ","-",$album_dir)."/big/{$img['image']}\">";

				$categories .=  '<FindMoreName><![CDATA['.$ops['FindMoreName'].']]></FindMoreName> ';
				
				if ($ops['showDesBigTxt'] == 1) {

						$FindMoreText = '<![CDATA['.$img['description'].']]>';
				}else{
				$FindMoreText = '';
				}
				$categories .=  '<FindMoreText>'.$FindMoreText.'</FindMoreText> ';
				if ($ops['showDesSmlTxt'] == 1) {
					$FindMoreSText = '<![CDATA['.$img['description2'].']]>';
				}else{
				$FindMoreSText = '';
				}
				$categories .=  '<FindMoreSText>'.$FindMoreSText.'</FindMoreSText> ';
				$categories .=  '<menuText><![CDATA['.$img['title'].']]></menuText>
					</pic>	
				';
			}
		}
	}
	//no values paremeters setted
	else//( empty($vars['cats']) && empty($vars['imgs']))
	{
		$query = "SELECT * FROM {$wpdb->prefix}hss_albums WHERE status = 1 ORDER BY `order` ASC";
		$albums = $wpdb->get_results($query, ARRAY_A);
		foreach($albums as $key => $album)
		{
			$images = $ghss->hss_get_album_images($album['album_id']);
			$album_dir = hss_get_album_url($album['album_id']);//HSS_PLUGIN_UPLOADS_URL . '/' . $album['album_id']."_".$album['name'];
			if ($images && !empty($images) && is_array($images)) {
				foreach($images as $key => $img)
				{
					if($img['status'] == 0 ) continue;
					
					$categories .= '	<pic url="'.$img['link'].'" target="'.$ops['target'].'"  
					FindMoreColorBack="0x'.$ops['FindMoreColorBack'].'"  FindMoreColorText="0x'.$ops['FindMoreColorText'].'" FindMoreAlpha="'.$ops['FindMoreAlpha'].'" FindMoreButtonColor="0x'.$ops['FindMoreButtonColor'].'" FindMoreButtonTextColor ="0x'.$ops['FindMoreButtonTextColor'].'" ';

					$categories .= " pic=\"".str_replace(" ","-",$album_dir)."/big/{$img['image']}\">";

					$categories .=  '<FindMoreName><![CDATA['.$ops['FindMoreName'].']]></FindMoreName> ';
					
					if ($ops['showDesBigTxt'] == 1) {

							$FindMoreText = '<![CDATA['.$img['description'].']]>';
					}else{
					$FindMoreText = '';
					}
					$categories .=  '<FindMoreText>'.$FindMoreText.'</FindMoreText> ';
					if ($ops['showDesSmlTxt'] == 1) {
						$FindMoreSText = '<![CDATA['.$img['description2'].']]>';
					}else{
					$FindMoreSText = '';
					}
					$categories .=  '<FindMoreSText>'.$FindMoreSText.'</FindMoreSText> ';
						$categories .=  '<menuText><![CDATA['.$img['title'].']]></menuText>
							</pic>	
					';
				}
			}
		}
		//$xml_filename = "hss_all.xml";
	}
	
	$xml_tpl = __get_hss_xml_template();
	$settings = __get_hss_xml_settings();
	$xml = str_replace(array('{settings}', '{categories}'), 
						array($settings, $categories), $xml_tpl);
	//write new xml file
	$thisSetting = hss_get_def_settings();
	$fh = fopen(HSS_PLUGIN_XML_DIR . '/' . $xml_filename, 'w+');
	fwrite($fh, $xml);
	fclose($fh);
	//print "<h3>Generated filename: $xml_filename</h3>";
	//print $xml;
	if( file_exists(HSS_PLUGIN_XML_DIR . '/' . $xml_filename ) )
	{
		$fh = fopen(HSS_PLUGIN_XML_DIR . '/' . $xml_filename, 'r');
		$xml = fread($fh, filesize(HSS_PLUGIN_XML_DIR . '/' . $xml_filename));
		fclose($fh);
		//print "<h3>Getting xml file from cache: $xml_filename</h3>";
		$ret_str = '<script type="text/javascript" src="'.HSS_PLUGIN_URL.'/js/swfobject.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript" src="'.HSS_PLUGIN_URL.'/js/jquery.touchSwipe.js"></script>
<script type="text/javascript">
		
		var flashvars = {
			maxwidth: "'.$ops['bannerWidth'].'",
			maxheight: "'.$ops['bannerHeight'].'",
			imagewidth: "'.$ops['imagewidth'].'",
			baseColor: "'.$ops['baseColor'].'",
			xmlfileurl: "'.HSS_PLUGIN_URL.'/xml/'.$xml_filename.'"
		};
		var params = {
			bgcolor: "'.$ops['backgroundColor'].'",
			wmode  : "'.$ops['wmode'].'"
		};
		
		var attributes = {
			id: "homepage_slideshow"
		};
		
		pluginPath = "'.HSS_PLUGIN_URL.'";
		filename = "'.$xml_filename.'";
		
		swfobject.embedSWF("'.HSS_PLUGIN_URL.'/js/wp-hss.swf", "homepageSlideshowInner", "'.$ops['bannerWidth'].'px", "'.$ops['bannerHeight'].'<?php echo $bannerHeight; ?>px", "10.0.0", false, flashvars, params, attributes);

</script>
<script type="text/javascript" src="'.HSS_PLUGIN_URL.'/js/jquery.homepage.slider.js"></script>
<div id="homepageSlideshow"><div id="homepageSlideshowInner"></div></div>';
		$not_used_now = "
		<script language=\"javascript\">AC_FL_RunContent = 0;</script>
<script src=\"".HSS_PLUGIN_URL."/js/AC_RunActiveContent.js\" language=\"javascript\"></script>

		<script language=\"javascript\"> 
	if (AC_FL_RunContent == 0) {
		alert(\"This page requires AC_RunActiveContent.js.\");
	} else {
		AC_FL_RunContent(
			'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0',
			'width', '".$ops['bannerWidth']."',
			'height', '".$ops['bannerHeight']."',
			'src', '".HSS_PLUGIN_URL."/js/wp_homepageslideshow',
			'quality', 'high',
			'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
			'align', 'middle',
			'play', 'true',
			'loop', 'true',
			'scale', 'showall',
			'wmode', '".$ops['wmode']."',
			'devicefont', 'false',
			'id', 'xmlswf_vmhss',
			'bgcolor', '".$ops['backgroundColor']."',
			'name', 'xmlswf_vmhss',
			'menu', 'true',
			'allowFullScreen', 'true',
			'allowScriptAccess','sameDomain',
			'movie', '".HSS_PLUGIN_URL."/js/wp_homepageslideshow',
			'salign', '',
			'flashVars','url=".HSS_PLUGIN_URL."/xml/$xml_filename'
			); //end AC code
	}
</script>
";
//echo HSS_PLUGIN_UPLOADS_URL."<hr>";
//		print $xml;
		return $ret_str;
	}
	return true;
}
function __get_hss_xml_template()
{
	$xml_tpl = '<?xml version="1.0" encoding="iso-8859-1"?>

<slideshow >
{settings}
{categories}
</slideshow>';
	return $xml_tpl;
}
?>