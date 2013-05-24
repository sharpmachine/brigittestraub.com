<?php

	$g_ywfz_siteurl = get_option('siteurl');
	$g_ywfz_pluginurl = $g_ywfz_siteurl . "/wp-content/plugins/youtube-with-fancy-zoom/";
	$g_ywfz_width = get_option('g_ywfz_width');
	if(is_numeric($g_ywfz_width))
	{
		$w = 'width="'.$g_ywfz_width.'"';
	} 
	else
	{
		$w = "";
	}
	$g_ywfz_height = get_option('g_ywfz_height');
	if(is_numeric($g_ywfz_height))
	{
		$h = 'Height="'.$g_ywfz_height.'"';
	} 
	else
	{
		$h = "";
	}
	
	
	$g_ywfz_rand = get_option('g_ywfz_rand');
	if(!is_numeric($g_ywfz_rand)){$g_ywfz_rand = 1;} 
	global $wpdb;
	$hidden = "";
	$sSql = "select * from ". WP_G_YWFZ_TABLE . " where ywfz_status='YES' ORDER BY rand() limit 0,$g_ywfz_rand";
	$data = $wpdb->get_results($sSql);
	?>
    <script type="text/javascript" src="<?php echo $g_ywfz_pluginurl; ?>includes/jquery.min.js"></script>
	<link rel="stylesheet" href="<?php echo $g_ywfz_pluginurl; ?>includes/youtube-with-fancy-zoom.css" type="text/css" media="screen" charset="utf-8" />
	<script src="<?php echo $g_ywfz_pluginurl; ?>includes/youtube-with-fancy-zoom.js" type="text/javascript" charset="utf-8"></script>
	
	<?php
	if ( ! empty($data) ) 
	{
		$i=0;
		foreach ( $data as $data ) 
		{ 
			if($data->ywfz_img == 'Youtube Thumbnail')
			{
				$imgsource = '<img src="http://img.youtube.com/vi/'.$data->ywfz_code.'/'.$data->ywfz_size.'.jpg" '.$w.' '.$h.' alt="'.$data->ywfz_title.'" />';
			}
			else
			{
				$imgsource = '<img src="'.$data->ywfz_imglink.'" '.$w.' '.$h.' alt="'.$data->ywfz_title.'" />';
			}	
			if($i==0)
			{
			?>
			 <div class="gallery clearfix">
				<a href="<?php echo $data->ywfz_watch; ?>" rel="g_ywfz[gallery]" title="<?php echo $data->ywfz_title; ?>"> 
					<?php echo $imgsource; ?>
				</a> 
			</div>
			<?php
			}
			else
			{
			 	$hidden =  $hidden .'<a href="' . $data->ywfz_watch . '" rel="g_ywfz[gallery]" title="'. $data->ywfz_title . '"></a>';
			}
			$i = $i + 1;
		}
	}
	?>
    <?php echo $hidden; ?>
    <script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		$(".gallery a[rel^='g_ywfz']").g_ywfz({theme:'g_ywfz_theme'});
	});
	</script>
    <?php
?>