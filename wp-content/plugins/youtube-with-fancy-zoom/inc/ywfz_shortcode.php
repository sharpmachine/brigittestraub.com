<?php
	$g_ywfz_siteurl = get_option('siteurl');
	$g_ywfz_pluginurl = $g_ywfz_siteurl . "/wp-content/plugins/youtube-with-fancy-zoom/";
	global $wpdb;
	extract(shortcode_atts(array('code' => 'nocode',	'value' => 'novalue',), $atts));
	$ywfz_code = "{$code}";
	$sSql = "select * from ". WP_G_YWFZ_TABLE . " where ywfz_code='".$ywfz_code."'";
	$data = $wpdb->get_results($sSql);
	?>
    <script type="text/javascript" src="<?php echo $g_ywfz_pluginurl; ?>includes/jquery.min.js"></script>
	<link rel="stylesheet" href="<?php echo $g_ywfz_pluginurl; ?>includes/youtube-with-fancy-zoom.css" type="text/css" media="screen" charset="utf-8" />
	<script src="<?php echo $g_ywfz_pluginurl; ?>includes/youtube-with-fancy-zoom.js" type="text/javascript" charset="utf-8"></script>
	<?php
	if ( ! empty($data) ) 
	{
		foreach ( $data as $data ) 
		{ 
			if($data->ywfz_img == 'Youtube Thumbnail')
			{
				$imgsource = '<img src="http://img.youtube.com/vi/'.$data->ywfz_code.'/2.jpg" alt="" />';
			}
			else
			{
				$imgsource = '<img src="'.$data->ywfz_imglink.'" alt="" />';
			}	
			?>
			<div class="gallery ywfz"> 
				<a href="<?php echo $data->ywfz_watch; ?>" rel="g_ywfz" title="<?php echo $data->ywfz_title; ?>"> 
					<?php echo $imgsource; ?>
				</a> 
			</div>
			<?php
		}
	}
	?>
   <!-- <script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		$(".gallery a[rel^='g_ywfz']").g_ywfz({theme:'g_ywfz_theme'});
	});
	</script>-->
    <?php
?>